@extends('front.layout.pages-layout')
@section('pageTitle', $pageTitle)
@section('content')
<section class="section-b-space">
    <div class="container-fluid-lg">
        <h3 class="mb-4">Keranjang Belanja</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($cartItems->isEmpty())
            <div class="text-center py-5">
                <p class="text-muted">Keranjang kamu masih kosong.</p>
                <a href="{{ route('home-page') }}" class="btn text-white" style="background-color:var(--theme-color);">Mulai Belanja</a>
            </div>
        @else
            <form id="cart-checkout-form" method="GET" action="{{ route('cart.checkout') }}"></form>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th style="width:40px;"><input type="checkbox" id="select-all"></th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th style="width:160px;">Jumlah</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" class="cart-item-checkbox" name="cart_item_ids[]" value="{{ $item->id }}" form="cart-checkout-form">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        @if ($item->product->product_image)
                                                <img src="/images/products/{{ $item->product->product_image }}" width="60" height="60" style="object-fit:cover;" class="rounded">
                                            @endif
                                        <span>{{ $item->product->name }}</span>
                                    </div>
                                </td>
                                <td>Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('cart.update', $item->id) }}" class="d-flex align-items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm" style="width:70px;">
                                        <button type="submit" class="btn btn-sm btn-outline-warning border border-2 border-warning ">Update</button>
                                    </form>
                                </td>
                                <td>Rp {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('cart.destroy', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm border border-2 border-danger btn-outline-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end align-items-center gap-3 mt-4">
                <h5 class="mb-0">Total: Rp {{ number_format($total, 0, ',', '.') }}</h5>
                <button type="submit" form="cart-checkout-form" id="checkout-btn" class="btn text-white px-4" style="background-color:var(--theme-color);" disabled>
                    Checkout
                </button>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script src="/front/js/cart.js"></script>
@endpush
