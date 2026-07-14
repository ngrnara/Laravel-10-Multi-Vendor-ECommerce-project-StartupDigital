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

        <form method="POST" action="{{ route('client.checkout.store', $product->id) }}" id="checkout-form">
            @csrf
            <input type="hidden" id="unit-price" value="{{ $product->price }}">
            <input type="hidden" id="admin-fee" value="{{ $adminFee }}">
            <input type="hidden" id="cities-url-base" value="{{ url('/account/checkout/cities') }}">

            <div class="row g-4">
                <div class="col-12">
                    <div class="border rounded p-3 d-flex align-items-center gap-3">
                        <img src="/images/products/{{ $product->product_image }}" alt="{{ $product->name }}"
                            style="width: 64px; height: 64px; object-fit: cover; border-radius: 6px;">
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ $product->name }}</h6>
                            <span class="theme-color">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                        <div style="width: 90px;">
                            <label class="form-label mb-1">Jumlah</label>
                            <input type="number" name="quantity" id="quantity" class="form-control"
                                value="{{ $quantity }}" min="1" required>
                        </div>
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
<script src="/front/js/checkout.js"></script>
@endpush
