@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title here')
@section('content')

<!-- CUSTOM STYLE UNTUK ELEMEN DI DALAM DASHBOARD -->
<style>
    .btn-lapakan {
        background-color: #0fa862 !important;
        border-color: #0fa862 !important;
        color: #ffffff !important;
    }
    .btn-lapakan:hover {
        background-color: #0da05c !important;
        border-color: #0da05c !important;
        color: #ffffff !important;
    }
    .btn-outline-lapakan {
        color: #0fa862 !important;
        border-color: #0fa862 !important;
    }
    .btn-outline-lapakan:hover {
        background-color: #0fa862 !important;
        border-color: #0fa862 !important;
        color: #ffffff !important;
    }
    .text-lapakan {
        color: #0fa862 !important;
    }
    .bg-light-lapakan {
        background-color: #e8f7f0 !important;
    }
    /* Breadcrumb "Dashboard" - ganti dari biru bawaan tema ke hijau */
    .breadcrumb-item.active,
    .breadcrumb-item a,
    .breadcrumb a {
        color: #0fa862 !important;
    }
</style>

<!-- HEADER DASHBOARD BARU (Bersih tanpa double logo) -->
<div class="mb-25 pd-20 card-box d-flex align-items-center justify-content-between">
    <div class="text-muted font-14">
        Portal Dashboard Penjual (Seller)
    </div>
    <div class="font-14 text-secondary">
        Lapak Ikan Resmi
    </div>
</div>

<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Halo, {{ Auth::guard('seller')->user()->name }} 👋</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        Dashboard
                    </li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <a href="{{ route('seller.product.add-product') }}" class="btn btn-lapakan">
                <i class="fa fa-plus mr-5"></i> Tambah Produk
            </a>
        </div>
    </div>
</div>

@if(!$shop)
<div class="alert alert-warning d-flex align-items-center justify-content-between mb-30" role="alert" style="border-left: 5px solid #ffc107;">
    <div>
        <strong>Toko Anda belum diatur.</strong>
        Lengkapilah nama &amp; deskripsi toko supaya pembeli lebih percaya sebelum membeli produk Anda.
    </div>
    <a href="{{ route('seller.shop-settings') }}" class="btn btn-sm btn-warning ml-20" style="color: #212529; font-weight: 600;">Atur Toko</a>
</div>
@endif

<!-- STAT CARDS -->
<div class="row pd-10">
    <div class="col-lg-3 col-md-6 col-sm-6 mb-30">
        <div class="card-box pd-20 height-100-p">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="mb-5 text-muted">Total Produk</p>
                    <h3 class="mb-0">{{ $totalProducts }}</h3>
                </div>
                <div class="icon-holder bg-light-lapakan rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                    <i class="bi bi-bag text-lapakan" style="font-size:20px;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 mb-30">
        <div class="card-box pd-20 height-100-p">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="mb-5 text-muted">Produk Aktif</p>
                    <h3 class="mb-0 text-lapakan" style="font-weight: bold;">{{ $activeProducts }}</h3>
                </div>
                <div class="icon-holder bg-light-lapakan rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                    <i class="bi bi-eye text-lapakan" style="font-size:20px;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 mb-30">
        <div class="card-box pd-20 height-100-p">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="mb-5 text-muted">Produk Nonaktif</p>
                    <h3 class="mb-0 text-secondary">{{ $inactiveProducts }}</h3>
                </div>
                <div class="icon-holder bg-light-gray rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                    <i class="bi bi-eye-slash text-secondary" style="font-size:20px;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 mb-30">
        <div class="card-box pd-20 height-100-p">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="mb-5 text-muted">Status Akun</p>
                    @if(Auth::guard('seller')->user()->status == 'Active')
                        <h5 class="mb-0"><span class="badge badge-success" style="background-color: #0fa862;">Active</span></h5>
                    @elseif(Auth::guard('seller')->user()->status == 'inReview')
                        <h5 class="mb-0"><span class="badge badge-warning" style="background-color: #ffc107; color: #212529;">In Review</span></h5>
                    @else
                        <h5 class="mb-0"><span class="badge badge-secondary">Pending</span></h5>
                    @endif
                </div>
                <div class="icon-holder rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px; background-color: #fff3cd;">
                    <i class="fa fa-user" style="font-size:20px;color:#ff9800;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- RECENT PRODUCTS -->
<div class="row pd-10">
    <div class="col-12">
        <div class="card-box pd-20 mb-30">
            <div class="d-flex align-items-center justify-content-between mb-20">
                <h5 class="mb-0">Produk Terbaru</h5>
                <a href="{{ route('seller.product.all-products') }}" class="font-14 text-lapakan" style="font-weight: 500;">Lihat semua &rarr;</a>
            </div>

            @if($recentProducts->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width:60px;">Gambar</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentProducts as $product)
                        <tr>
                            <td>
                                <img src="/images/products/{{ $product->product_image }}" alt="{{ $product->name }}"
                                     style="width:44px;height:44px;object-fit:cover;border-radius:6px; border: 1px solid #e0e0e0;">
                            </td>
                            <td style="font-weight: 500;">{{ $product->name }}</td>
                            <td>
                                @if($product->compare_price)
                                    <del class="text-muted mr-5" style="font-size: 13px;">Rp{{ number_format($product->compare_price) }}</del>
                                @endif
                                <span style="font-weight: 600; color: #212529;">Rp{{ number_format($product->price) }}</span>
                            </td>
                            <td>
                                @if($product->visibility == 1)
                                    <span class="badge badge-success" style="background-color: #0fa862;">Aktif</span>
                                @else
                                    <span class="badge badge-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="{{ route('seller.product.edit-product',['id'=>$product->id]) }}" class="btn btn-outline-lapakan btn-sm">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center pd-20">
                <p class="text-muted mb-15">Belum ada produk yang ditambahkan.</p>
                <a href="{{ route('seller.product.add-product') }}" class="btn btn-lapakan btn-sm">Tambah Produk Pertama</a>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection