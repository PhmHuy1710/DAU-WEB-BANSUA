# Button
<a href="add.php?MaSP=<?php echo $sp['MaSP']; ?>&MaKH=<?php echo $kh['MaKH']; ?>&SoLuong=1" class="btn btn-primary add-to-cart-btn" id="btnThemVaoGio">
                                    <i class="fas fa-shopping-cart"></i> Thêm vào giỏ
                                </a>

# Javascript

document.addEventListener('DOMContentLoaded', function() {
        const nutGiam = document.getElementById('nutGiam');
        const nutTang = document.getElementById('nutTang');
        const soLuong = document.getElementById('soLuong');
        const btnThemVaoGio = document.getElementById('btnThemVaoGio');

        if (nutGiam && nutTang && soLuong) {
            const slToiDa = parseInt(soLuong.getAttribute('max')) || 99;

            nutGiam.addEventListener('click', function() {
                const giaTriHienTai = parseInt(soLuong.value);
                if (giaTriHienTai > 1) {
                    soLuong.value = giaTriHienTai - 1;
                    updateSLCart();
                }
            });

            nutTang.addEventListener('click', function() {
                const giaTriHienTai = parseInt(soLuong.value);
                if (giaTriHienTai < slToiDa) {
                    soLuong.value = giaTriHienTai + 1;
                    updateSLCart();
                }
            });

            soLuong.addEventListener('change', function() {
                let giaTriMoi = parseInt(this.value);

                if (isNaN(giaTriMoi) || giaTriMoi < 1) {
                    giaTriMoi = 1;
                } else if (giaTriMoi > slToiDa) {
                    giaTriMoi = slToiDa;
                }

                this.value = giaTriMoi;
                updateSLCart();
            });

            function updateSLCart() {
                if (btnThemVaoGio) {
                    const baseUrl = btnThemVaoGio.href.split('&SoLuong=')[0];
                    btnThemVaoGio.href = baseUrl + '&SoLuong=' + soLuong.value;
                }
            }

            updateSLCart();
        }
    });

