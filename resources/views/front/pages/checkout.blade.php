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

                <div class="col-lg-8">
                    <div class="border rounded p-4">
                        <h6 class="text-uppercase border-bottom pb-2 mb-3">Pengiriman</h6>

                        <div class="mb-3">
                            <label class="form-label">Dikirim Ke</label>
                            <textarea name="recipient_address" class="form-control" rows="3" required>{{ old('recipient_address', $client->address) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kode POS</label>
                            <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code') }}" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="form-label">Provinsi</label>
                                <select name="province_id" id="province_id" class="form-select" required>
                                    <option value="">-- Pilih Provinsi --</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kab/Kota</label>
                                <select name="city_id" id="city_id" class="form-select" required disabled>
                                    <option value="">-- Pilih Kab/Kota --</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block">Jasa Pengiriman</label>
                            <div class="d-flex flex-wrap gap-3">
                                @foreach ($couriers as $key => $courier)
                                    <label class="courier-option border rounded p-3 text-center {{ $loop->first ? 'selected' : '' }}"
                                        style="cursor:pointer; min-width: 150px;">
                                        <input type="radio" name="courier" value="{{ $key }}" data-cost="{{ $courier['cost'] }}"
                                            class="form-check-input d-block mx-auto mb-2" {{ $loop->first ? 'checked' : '' }} required>
                                        <span class="fw-bold d-block">{{ $courier['label'] }}</span>
                                        <small class="text-muted">Rp {{ number_format($courier['cost'], 0, ',', '.') }}</small>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label">Biaya Pengiriman</label>
                            <input type="text" id="shipping-cost-display" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="border rounded p-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Pesanan</span>
                            <span id="summary-subtotal">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Biaya Pengiriman</span>
                            <span id="summary-shipping">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Biaya Admin</span>
                            <span id="summary-admin-fee">Rp {{ number_format($adminFee, 0, ',', '.') }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total Bayar</strong>
                            <strong id="summary-total">Rp 0</strong>
                        </div>
                        <button type="submit" class="btn btn-animation w-100">Proses Checkout</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<style>
    .courier-option.selected {
        border-color: var(--theme-color, #2b6e4f) !important;
        background-color: rgba(43, 110, 79, 0.06);
    }
</style>
@endsection

@push('scripts')
<script src="/front/js/checkout.js"></script>
@endpush
