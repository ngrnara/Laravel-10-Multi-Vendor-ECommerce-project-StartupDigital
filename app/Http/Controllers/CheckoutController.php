<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Product;
use App\Models\Province;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use constDefaults;

class CheckoutController extends Controller
{
    protected function couriers(): array
    {
        return [
            'pos' => ['label' => 'Pos Indonesia', 'cost' => 15000],
            'jne' => ['label' => 'JNE', 'cost' => 20000],
            'tiki' => ['label' => 'TIKI', 'cost' => 18000],
        ];
    }

    protected function shippingFormData(): array
    {
        return [
            'provinces' => Province::orderBy('name')->get(),
            'couriers' => $this->couriers(),
            'adminFee' => constDefaults::ADMIN_FEE,
            'client' => Auth::guard('client')->user(),
        ];
    }

    protected function cityBelongsToProvince(int $cityId, int $provinceId): bool
    {
        return City::where('id', $cityId)->where('province_id', $provinceId)->exists();
    }

    public function index(Request $request, Product $product)
    {
        abort_unless($product->visibility == 1, 404);

        $quantity = max(1, (int) $request->query('qty', 1));

        return view('front.pages.checkout', array_merge($this->shippingFormData(), [
            'pageTitle' => 'Checkout',
            'product' => $product,
            'quantity' => $quantity,
        ]));
    }

    public function getCities(Province $province)
    {
        return City::where('province_id', $province->id)
            ->orderBy('name')
            ->get(['id', 'name']);
    }

    public function store(Request $request, Product $product)
    {
        abort_unless($product->visibility == 1, 404);

        $couriers = $this->couriers();

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'recipient_address' => 'required|string',
            'postal_code' => 'required|string|max:10',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'courier' => ['required', Rule::in(array_keys($couriers))],
        ]);

        if (!$this->cityBelongsToProvince((int) $validated['city_id'], (int) $validated['province_id'])) {
            return back()->withErrors([
                'city_id' => 'Kab/Kota yang dipilih tidak sesuai dengan provinsi.',
            ])->withInput();
        }

        $unitPrice = (float) $product->price;
        $quantity = (int) $validated['quantity'];
        $subtotal = $unitPrice * $quantity;
        $shippingCost = (float) $couriers[$validated['courier']]['cost'];
        $adminFee = (float) constDefaults::ADMIN_FEE;
        $total = $subtotal + $shippingCost + $adminFee;

        $order = DB::transaction(function () use ($product, $unitPrice, $quantity, $subtotal, $validated, $shippingCost, $adminFee, $total) {
            $order = Order::create([
                'client_id' => Auth::guard('client')->id(),
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_price' => $unitPrice,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
                'recipient_address' => $validated['recipient_address'],
                'postal_code' => $validated['postal_code'],
                'province_id' => $validated['province_id'],
                'city_id' => $validated['city_id'],
                'courier' => $validated['courier'],
                'shipping_cost' => $shippingCost,
                'admin_fee' => $adminFee,
                'total' => $total,
                'status' => 'Pending',
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_price' => $unitPrice,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ]);

            return $order;
        });

        return redirect()->route('client.checkout.success', $order->id);
    }

    public function cartCheckout(Request $request)
    {
        $ids = array_map('intval', (array) $request->query('cart_item_ids', []));

        if (empty($ids)) {
            return redirect()->route('cart.index')->with('error', 'Pilih minimal satu produk untuk checkout.');
        }

        $cartItems = CartItem::with('product')
            ->whereIn('id', $ids)
            ->where('client_id', Auth::guard('client')->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Produk yang dipilih tidak ditemukan di keranjang.');
        }

        $subtotal = $cartItems->sum(fn ($item) => $item->quantity * $item->product->price);

        return view('front.pages.checkout-cart', array_merge($this->shippingFormData(), [
            'pageTitle' => 'Checkout',
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'cartItemIds' => $cartItems->pluck('id')->all(),
        ]));
    }

    public function cartCheckoutStore(Request $request)
    {
        $couriers = $this->couriers();

        $validated = $request->validate([
            'cart_item_ids' => 'required|array|min:1',
            'cart_item_ids.*' => 'integer|exists:cart_items,id',
            'recipient_address' => 'required|string',
            'postal_code' => 'required|string|max:10',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'courier' => ['required', Rule::in(array_keys($couriers))],
        ]);

        $cartItems = CartItem::with('product')
            ->whereIn('id', $validated['cart_item_ids'])
            ->where('client_id', Auth::guard('client')->id())
            ->get();

        abort_if($cartItems->isEmpty(), 403);

        if (!$this->cityBelongsToProvince((int) $validated['city_id'], (int) $validated['province_id'])) {
            return back()->withErrors([
                'city_id' => 'Kab/Kota yang dipilih tidak sesuai dengan provinsi.',
            ])->withInput();
        }

        $orderSubtotal = $cartItems->sum(fn ($item) => $item->quantity * $item->product->price);
        $shippingCost = (float) $couriers[$validated['courier']]['cost'];
        $adminFee = (float) constDefaults::ADMIN_FEE;
        $total = $orderSubtotal + $shippingCost + $adminFee;

        $order = DB::transaction(function () use ($cartItems, $validated, $shippingCost, $adminFee, $total) {
            $order = Order::create([
                'client_id' => Auth::guard('client')->id(),
                'recipient_address' => $validated['recipient_address'],
                'postal_code' => $validated['postal_code'],
                'province_id' => $validated['province_id'],
                'city_id' => $validated['city_id'],
                'courier' => $validated['courier'],
                'shipping_cost' => $shippingCost,
                'admin_fee' => $adminFee,
                'total' => $total,
                'status' => 'Pending',
            ]);

            foreach ($cartItems as $item) {
                $itemSubtotal = $item->quantity * $item->product->price;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'product_price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $itemSubtotal,
                ]);
            }

            CartItem::whereIn('id', $cartItems->pluck('id'))
                ->where('client_id', Auth::guard('client')->id())
                ->delete();

            return $order;
        });

        return redirect()->route('client.checkout.success', $order->id);
    }

    public function success(Order $order)
    {
        abort_unless($order->client_id === Auth::guard('client')->id(), 403);

        $order->load(['product', 'province', 'city', 'items.product']);

        return view('front.pages.checkout-success', [
            'pageTitle' => 'Pesanan Berhasil',
            'order' => $order,
        ]);
    }
}
