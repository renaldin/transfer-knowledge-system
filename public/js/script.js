
// ================== HANDLE SHOW IMAGE
console.log('masukkkk')
function readImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#load_image').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$('#preview_image').change(function() {
    readImage(this);
})

function readImage1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#load_image_1').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$('#preview_image_1').change(function() {
    readImage1(this);
})

function readImage2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#load_image_2').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$('#preview_image_2').change(function() {
    readImage2(this);
})

function readImage3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#load_image_3').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$('#preview_image_3').change(function() {
    readImage3(this);
})
// ================== END HANDLE SHOW IMAGE

// ================== HANDLE TIMEOUT ALERT
window.setTimeout(function() {
    $(".alert").fadeTo(2000, 0).slideUp(2000, function() {
        $(this).remove();
    });
}, 8000);
// ================== END HANDLE TIMEOUT ALERT

// ================== HANDLE ONLY NUMBER
function handleNumberOnly(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
}
// ================== END HANDLE ONLY NUMBER

// ================== HANDLE SHOW PASSWORD
const togglePassword = document.getElementById("togglePassword")
if (togglePassword) {
    togglePassword.addEventListener("click", function () {
        var passwordField = document.getElementById("password");
        var iconPassword = document.getElementById("iconPassword");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            iconPassword.classList.remove("bi-eye-slash");
            iconPassword.classList.add("bi-eye");
        } else {
            passwordField.type = "password";
            iconPassword.classList.remove("bi-eye");
            iconPassword.classList.add("bi-eye-slash");
        }
    });
}
// ================== END HANDLE SHOW PASSWORD

// ================== FORM FILTER
document.addEventListener('DOMContentLoaded', function() {
    var formDetailInvoiceForm = document.getElementById('detailInvoiceForm');
    var productForm = document.getElementById('productForm');
    var stockForm = document.getElementById('stockForm');
    var bayarFormModal = document.getElementById('bayarFormModal');
    var filterStockForm = document.getElementById('filterStockForm');
    var filterInvoiceForm = document.getElementById('filterInvoiceForm');
    var filterDownlineForm = document.getElementById('filterDownlineForm');

    if (formDetailInvoiceForm) {
        let add = document.getElementById('add');
        let bill = document.getElementById('bill');
        let remainingBalance = document.getElementById('remaining_balance');
        let latitudeStore = document.getElementById('latitude_store').value;
        let longitudeStore = document.getElementById('longitude_store').value;

        let addValue = removeFormatting(add.value);
        let billValue = removeFormatting(bill.value);
        let remaining = parseInt(addValue) - parseInt(billValue);

        add.value = formatRupiah(addValue);
        remainingBalance.value = remaining.toLocaleString('id-ID');
        add.addEventListener('keyup', function (e) {
            let addValue = removeFormatting(add.value);
            let billValue = removeFormatting(bill.value);
            let remaining = parseInt(addValue) - parseInt(billValue);

            add.value = formatRupiah(addValue);
            remainingBalance.value = remaining.toLocaleString('id-ID');
        });

        function getCoordinates() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    const currentLatitude = document.getElementById('latitude').value = latitude;
                    const currentLongitude = document.getElementById('longitude').value = longitude;
                    const distance = getDistanceBetweenPoints(currentLatitude, currentLongitude, latitudeStore, longitudeStore);
                    document.getElementById('distance').value = distance.meters.toFixed(2);
                    document.getElementById('absensi').value = distance.meters < 100 ? 'Hadir': 'Tidak Hadir';
                }, function(error) {
                    console.error('Error getting location:', error.message);
                });
            } else {
                console.log('Geolocation is not supported by your browser.');
            }
        }

        function getDistanceBetweenPoints(lat1, lon1, lat2, lon2) {
            const theta = lon1 - lon2;
            let miles = Math.acos(
                Math.sin(deg2rad(lat1)) * Math.sin(deg2rad(lat2)) +
                Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * Math.cos(deg2rad(theta))
            );

            miles = rad2deg(miles);
            miles = miles * 60 * 1.1515;
            const feet = miles * 5280;
            const yards = feet / 3;
            const kilometers = miles * 1.609344;
            const meters = kilometers * 1000;

            return {
                miles: miles,
                feet: feet,
                yards: yards,
                kilometers: kilometers,
                meters: meters
            };
        }

        function deg2rad(deg) {
            return deg * (Math.PI / 180);
        }

        function rad2deg(rad) {
            return rad * (180 / Math.PI);
        }

        getCoordinates();
    }

    if(productForm) {
        let purchasePrice = document.getElementById('purchase_price')
        let sellPriceCash = document.getElementById('sell_price_cash')
        let sellPriceTempo = document.getElementById('sell_price_tempo')

        let purchasePriceValue = removeFormatting(purchasePrice.value);
        let sellPriceCashValue = removeFormatting(sellPriceCash.value);
        let sellPriceTempoValue = removeFormatting(sellPriceTempo.value);

        purchasePrice.value = formatRupiah(purchasePriceValue);
        sellPriceCash.value = formatRupiah(sellPriceCashValue);
        sellPriceTempo.value = formatRupiah(sellPriceTempoValue);

        purchasePrice.addEventListener('keyup', function (e) {
            let purchasePriceValue = removeFormatting(purchasePrice.value);
            purchasePrice.value = formatRupiah(purchasePriceValue);
        });

        sellPriceCash.addEventListener('keyup', function (e) {
            let sellPriceCashValue = removeFormatting(sellPriceCash.value);
            sellPriceCash.value = formatRupiah(sellPriceCashValue);
        });

        sellPriceTempo.addEventListener('keyup', function (e) {
            let sellPriceTempoValue = removeFormatting(sellPriceTempo.value);
            sellPriceTempo.value = formatRupiah(sellPriceTempoValue);
        });
    }

    if(stockForm) {
        let purchasePrice = document.getElementById('purchase_price')
        let sellPriceCash = document.getElementById('sell_price_cash')
        let sellPriceTempo = document.getElementById('sell_price_tempo')

        let purchasePriceValue = removeFormatting(purchasePrice.value);
        let sellPriceCashValue = removeFormatting(sellPriceCash.value);
        let sellPriceTempoValue = removeFormatting(sellPriceTempo.value);

        purchasePrice.value = formatRupiah(purchasePriceValue);
        sellPriceCash.value = formatRupiah(sellPriceCashValue);
        sellPriceTempo.value = formatRupiah(sellPriceTempoValue);

        purchasePrice.addEventListener('keyup', function (e) {
            let purchasePriceValue = removeFormatting(purchasePrice.value);
            purchasePrice.value = formatRupiah(purchasePriceValue);
        });

        sellPriceCash.addEventListener('keyup', function (e) {
            let sellPriceCashValue = removeFormatting(sellPriceCash.value);
            sellPriceCash.value = formatRupiah(sellPriceCashValue);
        });

        sellPriceTempo.addEventListener('keyup', function (e) {
            let sellPriceTempoValue = removeFormatting(sellPriceTempo.value);
            sellPriceTempo.value = formatRupiah(sellPriceTempoValue);
        });
    }

    if(bayarFormModal) {
        let totalPay = document.getElementById('total_pay')

        let totalPayValue = removeFormatting(totalPay.value);

        totalPay.value = formatRupiah(totalPayValue);

        totalPay.addEventListener('keyup', function (e) {
            let totalPayValue = removeFormatting(totalPay.value);
            totalPay.value = formatRupiah(totalPayValue);
        });
    }

    if(filterStockForm) {
        var filterByDropdown = document.getElementById('filter_by');
        var produkLabel = document.querySelector('label[for="id_product"]');
        var siteLabel = document.querySelector('label[for="id_site"]');
        var dateFromLabel = document.querySelector('label[for="date_from"]');
        var dateToLabel = document.querySelector('label[for="date_to"]');

        var produkForm = document.getElementById('id_product');
        var siteForm = document.getElementById('id_site');
        var dateFromForm = document.getElementById('date_from');
        var dateToForm = document.getElementById('date_to');

        produkLabel.style.display = 'none';
        siteLabel.style.display = 'none';
        dateFromLabel.style.display = 'none';
        dateToLabel.style.display = 'none';

        produkForm.style.display = 'none';
        siteForm.style.display = 'none';
        dateFromForm.style.display = 'none';
        dateToForm.style.display = 'none';

        filterByDropdown.addEventListener('change', function () {
            produkLabel.style.display = 'none';
            siteLabel.style.display = 'none';
            dateFromLabel.style.display = 'none';
            dateToLabel.style.display = 'none';

            produkForm.style.display = 'none';
            siteForm.style.display = 'none';
            dateFromForm.style.display = 'none';
            dateToForm.style.display = 'none';

            if (filterByDropdown.value === 'Produk') {
                produkLabel.style.display = 'block';
                produkForm.style.display = 'block';
                produkForm.required = true;
                siteForm.required = false;
                dateFromForm.required = false;
                dateToForm.required = false
            } else if (filterByDropdown.value === 'Site') {
                siteLabel.style.display = 'block';
                siteForm.style.display = 'block';
                siteForm.required = true;
                produkForm.required = false;
                dateFromForm.required = false;
                dateToForm.required = false
            } else if (filterByDropdown.value === 'Tanggal') {
                dateFromLabel.style.display = 'block';
                dateToLabel.style.display = 'block';
                dateFromForm.style.display = 'block';
                dateToForm.style.display = 'block';
                dateFromForm.required = true;
                dateToForm.required = true
                siteForm.required = false;
                produkForm.required = false;
            }
        });
    }

    if(filterInvoiceForm) {
        var filterByDropdown = document.getElementById('filter_by');
        var userLabel = document.querySelector('label[for="id_user"]');
        var dateFromLabel = document.querySelector('label[for="date_from"]');
        var dateToLabel = document.querySelector('label[for="date_to"]');

        var userForm = document.getElementById('id_user');
        var dateFromForm = document.getElementById('date_from');
        var dateToForm = document.getElementById('date_to');

        userLabel.style.display = 'none';
        dateFromLabel.style.display = 'none';
        dateToLabel.style.display = 'none';

        userForm.style.display = 'none';
        dateFromForm.style.display = 'none';
        dateToForm.style.display = 'none';

        filterByDropdown.addEventListener('change', function () {
            userLabel.style.display = 'none';
            dateFromLabel.style.display = 'none';
            dateToLabel.style.display = 'none';

            userForm.style.display = 'none';
            dateFromForm.style.display = 'none';
            dateToForm.style.display = 'none';

            if (filterByDropdown.value === 'Tanggal') {
                dateFromLabel.style.display = 'block';
                dateToLabel.style.display = 'block';
                dateFromForm.style.display = 'block';
                dateToForm.style.display = 'block';
                dateFromForm.required = true;
                dateToForm.required = true;
                userForm.required = false;
            } else if (filterByDropdown.value === 'Sales') {
                userLabel.style.display = 'block';
                userForm.style.display = 'block';
                userForm.required = true;
                dateFromForm.required = false;
                dateToForm.required = false
            }
        });
    }

    if(filterDownlineForm) {
        var filterByDropdown = document.getElementById('filter_by');
        var userLabel = document.querySelector('label[for="id_user"]');
        var siteLabel = document.querySelector('label[for="id_site"]');

        var userForm = document.getElementById('id_user');
        var siteForm = document.getElementById('id_site');

        userLabel.style.display = 'none';
        siteLabel.style.display = 'none';

        userForm.style.display = 'none';
        siteForm.style.display = 'none';

        filterByDropdown.addEventListener('change', function () {
            userLabel.style.display = 'none';
            siteLabel.style.display = 'none';

            userForm.style.display = 'none';
            siteForm.style.display = 'none';

            if (filterByDropdown.value === 'Sales') {
                userLabel.style.display = 'block';
                userForm.style.display = 'block';
                userForm.required = true;
                siteForm.required = false;
            } else if (filterByDropdown.value === 'Site') {
                siteLabel.style.display = 'block';
                siteForm.style.display = 'block';
                siteForm.required = true;
                userForm.required = false;
            }
        });
    }

    function formatRupiah(angka, prefix) {
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix === undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function removeFormatting(value) {
        return value.replace(/[^\d]/g, '');
    }
});
// ================== END FORM FILTER

// ================== MODAL DELETE
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-delete');
    console.log(deleteButtons)
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const deleteModalHref = this.getAttribute('data-href');
            const deleteModalContent = this.getAttribute('data-content');
            
            const existingModal = document.getElementById('deleteModal');
            if (existingModal) {
                existingModal.remove();
            }

            const modalHtml = `
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>${deleteModalContent}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                <a href="${deleteModalHref}" type="button" class="btn btn-danger btn-sm">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', modalHtml);
            $('#deleteModal').modal('show');
        });
    });
});
// ================== END MODAL DELETE

// ================== FORM PAGE
document.addEventListener('DOMContentLoaded', function() {
    var projectForm = document.getElementById('projectForm');

    if(projectForm) {
        let dp = document.getElementById('dp')
        let dpValue = removeFormatting(dp.value);
        dp.value = formatRupiah(dpValue);
        dp.addEventListener('keyup', function (e) {
            let dpValue = removeFormatting(dp.value);
            dp.value = formatRupiah(dpValue);
        });
    }

    function formatRupiah(angka, prefix) {
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix === undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function removeFormatting(value) {
        return value.replace(/[^\d]/g, '');
    }
});
// ================== END FORM PAGE