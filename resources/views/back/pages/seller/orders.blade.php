@extends('back.layout.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Pesanan Masuk')

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Pesanan Masuk</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('seller.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pesanan Masuk</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="pd-20 card-box mb-30">
    <div class="clearfix mb-20">
        <div class="pull-left">
            <h4 class="text-blue h4">Daftar Transaksi Pembeli</h4>
            <p>Berikut adalah data pesanan masuk dari katalog produk toko Anda.</p>
        </div>
    </div>
    
    @if($orders->isEmpty())
        <div class="text-center py-5">
            <p class="text-muted font-16">Belum ada pesanan masuk dari pembeli.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-bordered dynamic-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Produk</th>
                        <th>Qty</th>
                        <th>Total Bayar</th>
                        <th>Alamat Pengiriman</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td><strong>{{ $order->product_name }}</strong></td>
                            <td>{{ $order->quantity }}</td>
                            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td>
                                <small>
                                    {{ $order->recipient_address }}, Kode Pos: {{ $order->postal_code }}
                                </small>
                            </td>
                            <td>
                                @if($order->status == 'Pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($order->status == 'Processing')
                                    <span class="badge badge-info">Diproses</span>
                                @elseif($order->status == 'Shipped')
                                    <span class="badge badge-primary">Dikirim</span>
                                @elseif($order->status == 'Completed')
                                    <span class="badge badge-success">Selesai</span>
                                @else
                                    <span class="badge badge-danger">Batal</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection