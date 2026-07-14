<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $clientId = Auth::guard('client')->id();

        $cartItems = CartItem::with('product')
            ->where('client_id', $clientId)
            ->get();

        $total = $cartItems->sum(fn ($item) => $item->quantity * $item->product->price);

        return view('front.pages.cart', [
            'pageTitle' => 'Keranjang Belanja',
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);

        $clientId = Auth::guard('client')->id();
        $quantity = $request->input('quantity', 1);

        $existing = CartItem::where('client_id', $clientId)
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            $existing->quantity += $quantity;
            $existing->save();
        } else {
            CartItem::create([
                'client_id' => $clientId,
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        abort_unless($cartItem->client_id == Auth::guard('client')->id(), 403);

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Jumlah barang diperbarui.');
    }

    public function destroy(CartItem $cartItem)
    {
        abort_unless($cartItem->client_id == Auth::guard('client')->id(), 403);

        $cartItem->delete();

        return back()->with('success', 'Barang dihapus dari keranjang.');
    }
}
