<?php
ob_start();

require_once('config/database.php');
require_once('config/config.php');
require_once('includes/session.php');

$thongBaoLoi = '';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['btnLogin'])) {
    $tenDN = $_POST['txtName'];
    $matKhau = $_POST['txtPass'];

    if (empty($tenDN) || empty($matKhau)) {
        $thongBaoLoi = "Vui lòng nhập đầy đủ thông tin đăng nhập";
    } else {
        $sql = "SELECT * FROM KhachHang WHERE (TenKH='$tenDN' OR Email='$tenDN') AND TrangThai=1";
        $ketQua = mysqli_query($conn, $sql);

        if (mysqli_num_rows($ketQua) > 0) {
            $thongTinUser = mysqli_fetch_assoc($ketQua);

            if (password_verify($matKhau, $thongTinUser['MatKhau'])) {
                $_SESSION['user'] = $thongTinUser;

                $maKH = $thongTinUser['MaKH'];
                $sqlCapNhat = "UPDATE KhachHang SET NgayCapNhat = NOW() WHERE MaKH = '$maKH'";
                mysqli_query($conn, $sqlCapNhat);

                $linkChuyen = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : 'index.php';
                unset($_SESSION['redirect_url']);

                header("Location: $linkChuyen");
                exit;
            } else {
                $thongBaoLoi = "Mật khẩu không chính xác";
            }
        } else {
            $thongBaoLoi = "Tên đăng nhập hoặc email không tồn tại";
        }
    }
}

require_once('layouts/client/header.php');
?>

<main>
    <div class="container">
        <div class="auth-container login-container">
            <div class="auth-form-container fade-in" style="animation-delay: 0.2s;">
                <div class="auth-header">
                    <h2>Đăng Nhập</h2>
                    <p>Đăng nhập để mua sắm dễ dàng hơn tại Milky World</p>
                </div>

                <?php if (!empty($thongBaoLoi)): ?>
                    <div class="auth-alert error">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $thongBaoLoi; ?>
                    </div>
                <?php endif; ?>

                <form method="post" class="auth-form" id="form-login">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="txtName">Tên đăng nhập hoặc Email <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <span class="input-icon"><i class="fas fa-user"></i></span>
                                <input
                                    type="text"
                                    id="txtName"
                                    name="txtName"
                                    placeholder="Nhập tên đăng nhập hoặc email"
                                    value="<?php echo isset($tenDN) ? htmlspecialchars($tenDN) : ''; ?>"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="txtPass">Mật khẩu <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <span class="input-icon"><i class="fas fa-lock"></i></span>
                                <input
                                    type="password"
                                    id="txtPass"
                                    name="txtPass"
                                    placeholder="Nhập mật khẩu"
                                    required>
                                <button type="button" class="password-toggle" id="nutToggleMK">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group forgot-password-group">
                            <a href="#" class="forgot-password">Quên mật khẩu?</a>
                        </div>
                    </div>

                    <div class="form-row">
                        <button type="submit" name="btnLogin" class="btn btn-primary btn-auth">
                            <i class="fas fa-sign-in-alt"></i> Đăng nhập
                        </button>
                    </div>
                </form>

                <div class="auth-footer">
                    <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
                </div>
            </div>

            <div class="auth-image scale-in" style="animation-delay: 0.3s;">
                <img src="assets/images/auth-login.svg" alt="Đăng nhập" onerror="this.src='assets/images/logo.png'; this.style.maxWidth='250px';">
            </div>
        </div>
    </div>
</main>

<script>
    window.onload = function() {
        var nutHienMK = document.getElementById('nutToggleMK');
        var oMatKhau = document.getElementById('txtPass');
        var formDN = document.getElementById('form-login');
        var oTenDN = document.getElementById('txtName');

        nutHienMK.onclick = function() {
            if (oMatKhau.type == 'password') {
                oMatKhau.type = 'text';
                nutHienMK.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                oMatKhau.type = 'password';
                nutHienMK.innerHTML = '<i class="fas fa-eye"></i>';
            }
        };

        formDN.onsubmit = function(e) {
            var coLoi = false;

            if (oTenDN.value.trim() == '') {
                coLoi = true;
                hienThiLoi(oTenDN, 'Vui lòng nhập tên đăng nhập hoặc email');
            } else {
                xoaLoi(oTenDN);
            }

            if (oMatKhau.value.trim() == '') {
                coLoi = true;
                hienThiLoi(oMatKhau, 'Vui lòng nhập mật khẩu');
            } else {
                xoaLoi(oMatKhau);
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
    };
</script>

<?php
require_once('layouts/client/footer.php');
ob_end_flush();
?>