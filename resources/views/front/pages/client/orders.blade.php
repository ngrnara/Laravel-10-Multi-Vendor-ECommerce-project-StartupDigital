@extends('front.layout.pages-layout') @section('pageTitle', isset($pageTitle) ? $pageTitle : 'Riwayat Transaksi')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-4">Riwayat Transaksi Belanja</h3>

            <ul class="nav nav-tabs mb-4" id="orderTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">
                        Belum Bayar <span class="badge badge-warning">{{ $pendingOrders->count() }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ongoing-tab" data-toggle="tab" href="#ongoing" role="tab" aria-controls="ongoing" aria-selected="false">
                        Dalam Proses <span class="badge badge-info">{{ $ongoingOrders->count() }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">
                        Selesai <span class="badge badge-success">{{ $completedOrders->count() }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="cancelled-tab" data-toggle="tab" href="#cancelled" role="tab" aria-controls="cancelled" aria-selected="false">
                        Dibatalkan <span class="badge badge-danger">{{ $cancelledOrders->count() }}</span>
                    </a>
                </li>
            </ul>

            <div class="tab-content" id="orderTabsContent">
                
                <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    @include('front.pages.client.partials.order-list', ['orders' => $pendingOrders, 'statusType' => 'Pending'])
                </div>

                <div class="tab-pane fade" id="ongoing" role="tabpanel" aria-labelledby="ongoing-tab">
                    @include('front.pages.client.partials.order-list', ['orders' => $ongoingOrders, 'statusType' => 'Ongoing'])
                </div>

                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                    @include('front.pages.client.partials.order-list', ['orders' => $completedOrders, 'statusType' => 'Completed'])
                </div>

                <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                    @include('front.pages.client.partials.order-list', ['orders' => $cancelledOrders, 'statusType' => 'Cancelled'])
                </div>

            </div>
        </div>
    </div>
</div>
@endsection