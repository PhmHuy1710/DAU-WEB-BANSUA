<?php
ob_start();

require_once('config/database.php');
require_once('config/config.php');
require_once('includes/session.php');

$tbLoi = '';
$thongBaoTC = '';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['btnRegister'])) {
    $tenDN = trim($_POST['txtName']);
    $email = trim($_POST['txtEmail']);
    $matKhau = trim($_POST['txtPass']);
    $nhapLaiMK = trim($_POST['txtRePass']);
    $sdt = isset($_POST['txtPhone']) ? trim($_POST['txtPhone']) : '';

    if (empty($tenDN)) {
        $tbLoi = "Vui lòng nhập tên đăng nhập";
    } elseif (strlen($tenDN) < 3) {
        $tbLoi = "Tên đăng nhập phải có ít nhất 3 ký tự";
    } elseif (empty($email)) {
        $tbLoi = "Vui lòng nhập email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $tbLoi = "Email không hợp lệ";
    } elseif (empty($matKhau)) {
        $tbLoi = "Vui lòng nhập mật khẩu";
    } elseif (strlen($matKhau) < 6) {
        $tbLoi = "Mật khẩu phải có ít nhất 6 ký tự";
    } elseif (empty($nhapLaiMK)) {
        $tbLoi = "Vui lòng nhập lại mật khẩu";
    } elseif ($matKhau !== $nhapLaiMK) {
        $tbLoi = "Mật khẩu không khớp";
    } else {
        $sql = "SELECT * FROM KhachHang WHERE TenKH = '$tenDN'";
        $ketQua = mysqli_query($conn, $sql);

        if (mysqli_num_rows($ketQua) > 0) {
            $tbLoi = "Tên đăng nhập đã tồn tại";
        } else {
            $sql = "SELECT * FROM KhachHang WHERE Email = '$email'";
            $ketQua = mysqli_query($conn, $sql);

            if (mysqli_num_rows($ketQua) > 0) {
                $tbLoi = "Email đã tồn tại trong hệ thống";
            } else {
                $diaChi = '';
                $dienThoai = $sdt;
                $vaiTro = 'user';
                $avatar = null;
                $trangThai = 1;

                $maKH = '';
                $kiemTraID = true;

                while ($kiemTraID) {
                    $soNgauNhien = mt_rand(100, 999);
                    $maKH = 'KH' . $soNgauNhien;

                    $sql = "SELECT MaKH FROM KhachHang WHERE MaKH = '$maKH'";
                    $ketQua = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($ketQua) == 0) {
                        $kiemTraID = false;
                    }
                }

                $mkMaHoa = password_hash($matKhau, PASSWORD_DEFAULT);

                $sql = "INSERT INTO KhachHang (MaKH, TenKH, Email, MatKhau, DiaChi, SoDienThoai, VaiTro, Avatar, TrangThai, NgayTao, NgayCapNhat)
                        VALUES ('$maKH', '$tenDN', '$email', '$mkMaHoa', '$diaChi', '$dienThoai', '$vaiTro', '$avatar', $trangThai, NOW(), NOW())";

                if (mysqli_query($conn, $sql)) {
                    $thongBaoTC = "Đăng ký thành công! Vui lòng đăng nhập để tiếp tục.";
                    $tenDN = $email = $matKhau = $nhapLaiMK = $sdt = '';
                } else {
                    $tbLoi = "Đăng ký thất bại: " . mysqli_error($conn);
                }
            }
        }
    }
}

require_once('layouts/client/header.php');
?>

<main>
    <div class="container">
        <div class="auth-container register-container">
            <div class="auth-form-container fade-in" style="animation-delay: 0.2s;">
                <div class="auth-header">
                    <h2>Đăng Ký Tài Khoản</h2>
                    <p>Tạo tài khoản để mua sắm dễ dàng hơn tại Milky World</p>
                </div>

                <?php if (!empty($thongBaoTC)): ?>
                    <div class="auth-alert success">
                        <i class="fas fa-check-circle"></i>
                        <div class="alert-content">
                            <p><?php echo $thongBaoTC; ?></p>
                            <a href="login.php" class="btn btn-primary btn-sm">Đăng nhập ngay</a>
                        </div>
                    </div>
                <?php else: ?>
                    <?php if (!empty($tbLoi)): ?>
                        <div class="auth-alert error">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $tbLoi; ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" class="auth-form" id="form-dangky">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="txtName">Tên đăng nhập <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <span class="input-icon"><i class="fas fa-user"></i></span>
                                    <input
                                        type="text"
                                        id="txtName"
                                        name="txtName"
                                        placeholder="Nhập tên đăng nhập"
                                        value="<?php echo isset($tenDN) ? htmlspecialchars($tenDN) : ''; ?>"
                                        required
                                        minlength="3">
                                </div>
                                <div class="input-help">Tên đăng nhập phải có ít nhất 3 ký tự</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="txtEmail">Email <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <span class="input-icon"><i class="fas fa-envelope"></i></span>
                                    <input
                                        type="email"
                                        id="txtEmail"
                                        name="txtEmail"
                                        placeholder="Nhập địa chỉ email"
                                        value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"
                                        required>
                                </div>
                                <div class="input-help">Chúng tôi sẽ không chia sẻ email của bạn với bất kỳ ai</div>
                            </div>
                        </div>

                        <div class="form-row two-columns">
                            <div class="form-group">
                                <label for="txtPass">Mật khẩu <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                                    <input
                                        type="password"
                                        id="txtPass"
                                        name="txtPass"
                                        placeholder="Nhập mật khẩu"
                                        required
                                        minlength="6">
                                    <button type="button" class="password-toggle" id="nutToggleMK">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="input-help">Mật khẩu phải có ít nhất 6 ký tự</div>
                            </div>

                            <div class="form-group">
                                <label for="txtRePass">Nhập lại mật khẩu <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                                    <input
                                        type="password"
                                        id="txtRePass"
                                        name="txtRePass"
                                        placeholder="Nhập lại mật khẩu"
                                        required
                                        minlength="6">
                                    <button type="button" class="password-toggle" id="nutToggleNhapLaiMK">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="input-help">Nhập lại mật khẩu để xác nhận</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="txtPhone">Số điện thoại</label>
                                <div class="input-wrapper">
                                    <span class="input-icon"><i class="fas fa-phone"></i></span>
                                    <input
                                        type="tel"
                                        id="txtPhone"
                                        name="txtPhone"
                                        placeholder="Nhập số điện thoại"
                                        value="<?php echo isset($sdt) ? htmlspecialchars($sdt) : ''; ?>"
                                        pattern="[0-9]{10,11}">
                                </div>
                                <div class="input-help">Nhập số điện thoại để được hỗ trợ tốt hơn</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <button type="submit" name="btnRegister" class="btn btn-primary btn-auth btn-block">
                                <i class="fas fa-user-plus"></i> Đăng ký
                            </button>
                        </div>
                    </form>

                    <div class="auth-footer">
                        <p>Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="auth-image scale-in" style="animation-delay: 0.3s;">
                <img src="assets/images/auth-register.svg" alt="Đăng ký" onerror="this.src='assets/images/logo.png'; this.style.maxWidth='250px';">
            </div>
        </div>
    </div>
</main>

<script>
    window.onload = function() {
        var nutHienMK = document.getElementById('nutToggleMK');
        var oMatKhau = document.getElementById('txtPass');
        var nutHienNhapLaiMK = document.getElementById('nutToggleNhapLaiMK');
        var oNhapLaiMK = document.getElementById('txtRePass');
        var formDangKy = document.getElementById('form-dangky');
        var oTenDN = document.getElementById('txtName');
        var oEmail = document.getElementById('txtEmail');
        var oSDT = document.getElementById('txtPhone');

        nutHienMK.onclick = function() {
            if (oMatKhau.type == 'password') {
                oMatKhau.type = 'text';
                nutHienMK.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                oMatKhau.type = 'password';
                nutHienMK.innerHTML = '<i class="fas fa-eye"></i>';
            }
        };

        nutHienNhapLaiMK.onclick = function() {
            if (oNhapLaiMK.type == 'password') {
                oNhapLaiMK.type = 'text';
                nutHienNhapLaiMK.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                oNhapLaiMK.type = 'password';
                nutHienNhapLaiMK.innerHTML = '<i class="fas fa-eye"></i>';
            }
        };

        formDangKy.onsubmit = function(e) {
            var coLoi = false;

            if (oTenDN.value.trim() == '') {
                coLoi = true;
                hienThiLoi(oTenDN, 'Vui lòng nhập tên đăng nhập');
            } else if (oTenDN.value.trim().length < 3) {
                coLoi = true;
                hienThiLoi(oTenDN, 'Tên đăng nhập phải có ít nhất 3 ký tự');
            } else {
                xoaLoi(oTenDN);
            }

            if (oEmail.value.trim() == '') {
                coLoi = true;
                hienThiLoi(oEmail, 'Vui lòng nhập email');
            } else if (!ktraEmail(oEmail.value.trim())) {
                coLoi = true;
                hienThiLoi(oEmail, 'Email không hợp lệ');
            } else {
                xoaLoi(oEmail);
            }

            if (oMatKhau.value.trim() == '') {
                coLoi = true;
                hienThiLoi(oMatKhau, 'Vui lòng nhập mật khẩu');
            } else if (oMatKhau.value.trim().length < 6) {
                coLoi = true;
                hienThiLoi(oMatKhau, 'Mật khẩu phải có ít nhất 6 ký tự');
            } else {
                xoaLoi(oMatKhau);
            }

            if (oNhapLaiMK.value.trim() == '') {
                coLoi = true;
                hienThiLoi(oNhapLaiMK, 'Vui lòng nhập lại mật khẩu');
            } else if (oNhapLaiMK.value.trim() != oMatKhau.value.trim()) {
                coLoi = true;
                hienThiLoi(oNhapLaiMK, 'Mật khẩu không khớp');
            } else {
                xoaLoi(oNhapLaiMK);
            }

            if (oSDT.value.trim() != '' && !ktraSDT(oSDT.value.trim())) {
                coLoi = true;
                hienThiLoi(oSDT, 'Số điện thoại không hợp lệ');
            } else {
                xoaLoi(oSDT);
            }

            if (coLoi) {
                e.preventDefault();
            }
        };

        function hienThiLoi(o, noiDung) {
            var nhomForm = o.parentNode.parentNode;

            var theLoi = nhomForm.querySelector('.input-error');

            if (!theLoi) {
                theLoi = document.createElement('div');
                theLoi.className = 'input-error';
                nhomForm.appendChild(theLoi);
            }

            theLoi.textContent = noiDung;
            nhomForm.classList.add('has-error');
        }

        function xoaLoi(o) {
            var nhomForm = o.parentNode.parentNode;

            var theLoi = nhomForm.querySelector('.input-error');

            if (theLoi) {
                theLoi.textContent = '';
            }

            nhomForm.classList.remove('has-error');
        }

        function ktraEmail(email) {
            if (email.indexOf('@') > 0) {
                var phanSauA = email.split('@')[1];
                return phanSauA.indexOf('.') > 0;
            }
            return false;
        }

        function ktraSDT(sdt) {
            if (sdt.length >= 10 && sdt.length <= 11) {
                for (var i = 0; i < sdt.length; i++) {
                    if (sdt.charAt(i) < '0' || sdt.charAt(i) > '9') {
                        return false;
                    }
                }
                return true;
            }
            return false;
        }
    };
</script>

<?php
require_once('layouts/client/footer.php');
ob_end_flush();
?>