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
