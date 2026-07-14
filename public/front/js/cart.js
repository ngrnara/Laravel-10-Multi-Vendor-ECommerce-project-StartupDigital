(function () {
    var selectAll = document.getElementById('select-all');
    var checkoutBtn = document.getElementById('checkout-btn');
    if (!selectAll || !checkoutBtn) return;

    var itemCheckboxes = document.querySelectorAll('.cart-item-checkbox');

    function updateCheckoutButton() {
        var anyChecked = Array.prototype.some.call(itemCheckboxes, function (cb) {
            return cb.checked;
        });
        checkoutBtn.disabled = !anyChecked;
    }

    function updateSelectAll() {
        var allChecked = itemCheckboxes.length > 0 && Array.prototype.every.call(itemCheckboxes, function (cb) {
            return cb.checked;
        });
        selectAll.checked = allChecked;
    }

    selectAll.addEventListener('change', function () {
        itemCheckboxes.forEach(function (cb) {
            cb.checked = selectAll.checked;
        });
        updateCheckoutButton();
    });

    itemCheckboxes.forEach(function (cb) {
        cb.addEventListener('change', function () {
            updateSelectAll();
            updateCheckoutButton();
        });
    });

    updateCheckoutButton();
})();
