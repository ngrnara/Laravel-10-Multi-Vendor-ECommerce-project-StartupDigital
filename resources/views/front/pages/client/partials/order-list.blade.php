@if($orders->isEmpty())
    <div class="text-center py-5">
        <p class="text-muted">Tidak ada data transaksi untuk kategori ini.</p>
    </div>
@else
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Produk</th>
                    <th>Qty</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                    <th>Aksi</th>
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
                            @if($order->status == 'Pending')
                                <span class="badge badge-warning">Menunggu Pembayaran</span>
                            @elseif($order->status == 'Processing')
                                <span class="badge badge-info">Diproses Seller</span>
                            @elseif($order->status == 'Shipped')
                                <span class="badge badge-primary">Dalam Pengiriman</span>
                            @elseif($order->status == 'Completed')
                                <span class="badge badge-success">Selesai</span>
                            @else
                                <span class="badge badge-danger">Batal</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('client.checkout.success', $order->id) }}" class="btn btn-sm btn-outline-secondary">
                                Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif