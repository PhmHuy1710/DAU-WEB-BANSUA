<?php
ob_start();

require_once('config/database.php');
require_once('config/config.php');
require_once('includes/session.php');

$thongBaoLoi = '';
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
        $thongBaoLoi = "Vui lòng nhập tên đăng nhập";
    } elseif (strlen($tenDN) < 3) {
        $thongBaoLoi = "Tên đăng nhập phải có ít nhất 3 ký tự";
    } elseif (empty($email)) {
        $thongBaoLoi = "Vui lòng nhập email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $thongBaoLoi = "Email không hợp lệ";
    } elseif (empty($matKhau)) {
        $thongBaoLoi = "Vui lòng nhập mật khẩu";
    } elseif (strlen($matKhau) < 6) {
        $thongBaoLoi = "Mật khẩu phải có ít nhất 6 ký tự";
    } elseif (empty($nhapLaiMK)) {
        $thongBaoLoi = "Vui lòng nhập lại mật khẩu";
    } elseif ($matKhau !== $nhapLaiMK) {
        $thongBaoLoi = "Mật khẩu không khớp";
    } else {
        $sqlKTTen = "SELECT * FROM KhachHang WHERE TenKH = ?";
        $stmtKTTen = mysqli_prepare($conn, $sqlKTTen);
        mysqli_stmt_bind_param($stmtKTTen, "s", $tenDN);
        mysqli_stmt_execute($stmtKTTen);
        $ketQuaKTTen = mysqli_stmt_get_result($stmtKTTen);

        if (mysqli_num_rows($ketQuaKTTen) > 0) {
            $thongBaoLoi = "Tên đăng nhập đã tồn tại";
            mysqli_stmt_close($stmtKTTen);
        } else {
            mysqli_stmt_close($stmtKTTen);

            $sqlKTEmail = "SELECT * FROM KhachHang WHERE Email = ?";
            $stmtKTEmail = mysqli_prepare($conn, $sqlKTEmail);
            mysqli_stmt_bind_param($stmtKTEmail, "s", $email);
            mysqli_stmt_execute($stmtKTEmail);
            $ketQuaKTEmail = mysqli_stmt_get_result($stmtKTEmail);

            if (mysqli_num_rows($ketQuaKTEmail) > 0) {
                $thongBaoLoi = "Email đã tồn tại trong hệ thống";
                mysqli_stmt_close($stmtKTEmail);
            } else {
                mysqli_stmt_close($stmtKTEmail);

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

                    $sqlKTID = "SELECT MaKH FROM KhachHang WHERE MaKH = ?";
                    $stmtKTID = mysqli_prepare($conn, $sqlKTID);
                    mysqli_stmt_bind_param($stmtKTID, "s", $maKH);
                    mysqli_stmt_execute($stmtKTID);
                    mysqli_stmt_store_result($stmtKTID);

                    if (mysqli_stmt_num_rows($stmtKTID) == 0) {
                        $kiemTraID = false;
                    }

                    mysqli_stmt_close($stmtKTID);
                }

                $mkMaHoa = password_hash($matKhau, PASSWORD_DEFAULT);

                $sqlThem = "INSERT INTO KhachHang (MaKH, TenKH, Email, MatKhau, DiaChi, SoDienThoai, VaiTro, Avatar, TrangThai, NgayTao, NgayCapNhat)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
                $stmtThem = mysqli_prepare($conn, $sqlThem);
                mysqli_stmt_bind_param($stmtThem, "ssssssssi", $maKH, $tenDN, $email, $mkMaHoa, $diaChi, $dienThoai, $vaiTro, $avatar, $trangThai);

                if (mysqli_stmt_execute($stmtThem)) {
                    $thongBaoTC = "Đăng ký thành công! Vui lòng đăng nhập để tiếp tục.";

                    $tenDN = $email = $matKhau = $nhapLaiMK = $sdt = '';

                    // Tu dang nhap sau khi dang ky thanh cong.
                    /*
                    $_SESSION['user'] = array(
                        'MaKH' => $maKH,
                        'TenKH' => $tenDN,
                        'Email' => $email,
                        'DiaChi' => $diaChi,
                        'SoDienThoai' => $dienThoai,
                        'VaiTro' => $vaiTro,
                        'Avatar' => $avatar,
                        'TrangThai' => $trangThai
                    );
                    header('Location: index.php');
                    exit;
                    */
                } else {
                    $thongBaoLoi = "Đăng ký thất bại: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmtThem);
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
                    <?php if (!empty($thongBaoLoi)): ?>
                        <div class="auth-alert error">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $thongBaoLoi; ?>
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
    document.addEventListener('DOMContentLoaded', function() {
        const nutToggleMK = document.getElementById('nutToggleMK');
        const oMatKhau = document.getElementById('txtPass');
        const nutToggleNhapLaiMK = document.getElementById('nutToggleNhapLaiMK');
        const oNhapLaiMK = document.getElementById('txtRePass');

        if (nutToggleMK && oMatKhau) {
            nutToggleMK.addEventListener('click', function() {
                const kieuInput = oMatKhau.getAttribute('type') === 'password' ? 'text' : 'password';
                oMatKhau.setAttribute('type', kieuInput);

                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        }

        if (nutToggleNhapLaiMK && oNhapLaiMK) {
            nutToggleNhapLaiMK.addEventListener('click', function() {
                const kieuInput = oNhapLaiMK.getAttribute('type') === 'password' ? 'text' : 'password';
                oNhapLaiMK.setAttribute('type', kieuInput);

                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        }

        const formDangKy = document.getElementById('form-dangky');

        if (formDangKy) {
            formDangKy.addEventListener('submit', function(e) {
                let hopLe = true;
                const oTenDN = document.getElementById('txtName');
                const oEmail = document.getElementById('txtEmail');
                const oMatKhau = document.getElementById('txtPass');
                const oNhapLaiMK = document.getElementById('txtRePass');
                const oSDT = document.getElementById('txtPhone');

                if (!oTenDN.value.trim()) {
                    hopLe = false;
                    hienLoiInput(oTenDN, 'Vui lòng nhập tên đăng nhập');
                } else if (oTenDN.value.trim().length < 3) {
                    hopLe = false;
                    hienLoiInput(oTenDN, 'Tên đăng nhập phải có ít nhất 3 ký tự');
                } else {
                    anLoiInput(oTenDN);
                }

                if (!oEmail.value.trim()) {
                    hopLe = false;
                    hienLoiInput(oEmail, 'Vui lòng nhập email');
                } else if (!kiemTraEmail(oEmail.value.trim())) {
                    hopLe = false;
                    hienLoiInput(oEmail, 'Email không hợp lệ');
                } else {
                    anLoiInput(oEmail);
                }

                if (!oMatKhau.value.trim()) {
                    hopLe = false;
                    hienLoiInput(oMatKhau, 'Vui lòng nhập mật khẩu');
                } else if (oMatKhau.value.trim().length < 6) {
                    hopLe = false;
                    hienLoiInput(oMatKhau, 'Mật khẩu phải có ít nhất 6 ký tự');
                } else {
                    anLoiInput(oMatKhau);
                }

                if (!oNhapLaiMK.value.trim()) {
                    hopLe = false;
                    hienLoiInput(oNhapLaiMK, 'Vui lòng nhập lại mật khẩu');
                } else if (oNhapLaiMK.value.trim() !== oMatKhau.value.trim()) {
                    hopLe = false;
                    hienLoiInput(oNhapLaiMK, 'Mật khẩu không khớp');
                } else {
                    anLoiInput(oNhapLaiMK);
                }

                if (oSDT.value.trim() && !kiemTraSDT(oSDT.value.trim())) {
                    hopLe = false;
                    hienLoiInput(oSDT, 'Số điện thoại không hợp lệ');
                } else {
                    anLoiInput(oSDT);
                }

                if (!hopLe) {
                    e.preventDefault();
                }
            });
        }

        function hienLoiInput(oInput, thongBao) {
            const nhomForm = oInput.closest('.form-group');
            let oLoi = nhomForm.querySelector('.input-error');

            if (!oLoi) {
                oLoi = document.createElement('div');
                oLoi.className = 'input-error';
                nhomForm.appendChild(oLoi);
            }

            oLoi.textContent = thongBao;
            nhomForm.classList.add('has-error');
        }

        function anLoiInput(oInput) {
            const nhomForm = oInput.closest('.form-group');
            const oLoi = nhomForm.querySelector('.input-error');

            if (oLoi) {
                oLoi.textContent = '';
            }

            nhomForm.classList.remove('has-error');
        }

        function kiemTraEmail(email) {
            const reEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return reEmail.test(email.toLowerCase());
        }

        function kiemTraSDT(sdt) {
            const reSDT = /^[0-9]{10,11}$/;
            return reSDT.test(sdt);
        }
    });
</script>

<?php
require_once('layouts/client/footer.php');
ob_end_flush();
?>