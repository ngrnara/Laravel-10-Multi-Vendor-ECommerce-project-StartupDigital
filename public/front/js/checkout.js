(function () {
    var form = document.getElementById('checkout-form');
    if (!form) return;

    var provinceSelect = document.getElementById('province_id');
    var citySelect = document.getElementById('city_id');
    var citiesUrlBase = document.getElementById('cities-url-base').value;
    var quantityInput = document.getElementById('quantity');
    var unitPrice = parseFloat(document.getElementById('unit-price').value) || 0;
    var adminFee = parseFloat(document.getElementById('admin-fee').value) || 0;
    var shippingDisplay = document.getElementById('shipping-cost-display');

    function formatRupiah(value) {
        return 'Rp ' + Math.round(value).toLocaleString('id-ID');
    }

    function selectedCourierCost() {
        var checked = form.querySelector('input[name="courier"]:checked');
        return checked ? parseFloat(checked.getAttribute('data-cost')) || 0 : 0;
    }

    function recalculate() {
        var qty = parseInt(quantityInput.value, 10) || 1;
        var subtotal = unitPrice * qty;
        var shippingCost = selectedCourierCost();
        var total = subtotal + shippingCost + adminFee;

        document.getElementById('summary-subtotal').textContent = formatRupiah(subtotal);
        document.getElementById('summary-shipping').textContent = formatRupiah(shippingCost);
        document.getElementById('summary-total').textContent = formatRupiah(total);
        shippingDisplay.value = formatRupiah(shippingCost);
    }

    function updateCourierSelection() {
        document.querySelectorAll('.courier-option').forEach(function (label) {
            var input = label.querySelector('input[name="courier"]');
            label.classList.toggle('selected', input.checked);
        });
    }

    form.querySelectorAll('input[name="courier"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            updateCourierSelection();
            recalculate();
        });
    });

    quantityInput.addEventListener('input', recalculate);

    provinceSelect.addEventListener('change', function () {
        var provinceId = provinceSelect.value;
        citySelect.innerHTML = '<option value="">-- Pilih Kab/Kota --</option>';

        if (!provinceId) {
            citySelect.disabled = true;
            return;
        }

        citySelect.disabled = true;

        fetch(citiesUrlBase + '/' + provinceId)
            .then(function (response) { return response.json(); })
            .then(function (cities) {
                cities.forEach(function (city) {
                    var option = document.createElement('option');
                    option.value = city.id;
                    option.textContent = city.name;
                    citySelect.appendChild(option);
                });
                citySelect.disabled = false;
            })
            .catch(function () {
                citySelect.disabled = false;
            });
    });

    updateCourierSelection();
    recalculate();
})();
