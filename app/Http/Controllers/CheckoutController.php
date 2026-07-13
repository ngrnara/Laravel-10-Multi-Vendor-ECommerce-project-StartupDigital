<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Product;
use App\Models\Province;
use App\Models\City;
use App\Models\Order;
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

    public function index(Request $request, Product $product)
    {
        abort_unless($product->visibility == 1, 404);

        $quantity = max(1, (int) $request->query('qty', 1));
        $provinces = Province::orderBy('name')->get();
        $client = Auth::guard('client')->user();

        return view('front.pages.checkout', [
            'pageTitle' => 'Checkout',
            'product' => $product,
            'quantity' => $quantity,
            'provinces' => $provinces,
            'couriers' => $this->couriers(),
            'adminFee' => constDefaults::ADMIN_FEE,
            'client' => $client,
        ]);
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

        $cityBelongsToProvince = City::where('id', $validated['city_id'])
            ->where('province_id', $validated['province_id'])
            ->exists();

        if (!$cityBelongsToProvince) {
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

        return redirect()->route('client.checkout.success', $order->id);
    }

    public function success(Order $order)
    {
        abort_unless($order->client_id === Auth::guard('client')->id(), 403);

        $order->load(['product', 'province', 'city']);

        return view('front.pages.checkout-success', [
            'pageTitle' => 'Pesanan Berhasil',
            'order' => $order,
        ]);
    }
}
