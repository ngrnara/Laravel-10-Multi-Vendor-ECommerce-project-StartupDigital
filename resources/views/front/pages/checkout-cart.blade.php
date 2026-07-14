@extends('front.layout.pages-layout')
@section('pageTitle', $pageTitle)
@section('content')
<section class="log-in-section section-b-space">
    <div class="container-fluid-lg w-100">

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('cart.checkout.store') }}" id="checkout-form">
            @csrf
            @foreach ($cartItemIds as $id)
                <input type="hidden" name="cart_item_ids[]" value="{{ $id }}">
            @endforeach
            <input type="hidden" id="order-subtotal" value="{{ $subtotal }}">
            <input type="hidden" id="admin-fee" value="{{ $adminFee }}">
            <input type="hidden" id="cities-url-base" value="{{ url('/account/checkout/cities') }}">

            <div class="row g-4">
                <div class="col-12">
                    <div class="border rounded p-3">
                        <h6 class="text-uppercase border-bottom pb-2 mb-3">Produk Dipesan</h6>
                        @foreach ($cartItems as $item)
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <img src="/images/products/{{ $item->product->product_image }}" alt="{{ $item->product->name }}"
                                    style="width: 56px; height: 56px; object-fit: cover; border-radius: 6px;">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $item->product->name }}</h6>
                                    <span class="text-muted">Rp {{ number_format($item->product->price, 0, ',', '.') }} x {{ $item->quantity }}</span>
                                </div>
                                <div class="theme-color fw-bold">
                                    Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @include('front.pages.partials.checkout-shipping-form', ['provinces' => $provinces, 'couriers' => $couriers, 'client' => $client])

                @include('front.pages.partials.checkout-order-summary', ['adminFee' => $adminFee])
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script src="/front/js/checkout-cart.js"></script>
@endpush
