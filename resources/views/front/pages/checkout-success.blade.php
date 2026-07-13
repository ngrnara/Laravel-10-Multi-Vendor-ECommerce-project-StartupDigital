@extends('front.layout.pages-layout')
@section('pageTitle', $pageTitle)
@section('content')
<section class="log-in-section section-b-space">
    <div class="container-fluid-lg w-100">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="border rounded p-4 text-center">
                    <i class="fa fa-check-circle theme-color" style="font-size: 48px;"></i>
                    <h4 class="mt-3 mb-1">Pesanan Berhasil Dibuat</h4>
                    <p class="text-muted mb-4">Pesanan Anda sedang menunggu diproses.</p>

                    <div class="text-start border rounded p-3 mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>No. Pesanan</span>
                            <strong>#{{ $order->id }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Produk</span>
                            <span>{{ $order->product_name }} x{{ $order->quantity }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Dikirim Ke</span>
                            <span class="text-end">{{ $order->recipient_address }}, {{ $order->city->name ?? '-' }}, {{ $order->province->name ?? '-' }} {{ $order->postal_code }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Jasa Pengiriman</span>
                            <span>{{ strtoupper($order->courier) }} - Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Bayar</span>
                            <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Status</span>
                            <span class="badge bg-warning text-dark">{{ $order->status }}</span>
                        </div>
                    </div>

                    <a href="{{ route('home-page') }}" class="btn btn-animation">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
