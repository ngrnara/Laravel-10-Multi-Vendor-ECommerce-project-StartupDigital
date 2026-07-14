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

<style>
    .courier-option.selected {
        border-color: var(--theme-color, #2b6e4f) !important;
        background-color: rgba(43, 110, 79, 0.06);
    }
</style>
