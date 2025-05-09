<?php
ob_start();

require_once('config/database.php');
require_once('config/config.php');
require_once('includes/session.php');

$loiTB = '';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['btnLogin'])) {
    $tenDN = trim($_POST['txtName']);
    $matKhau = trim($_POST['txtPass']);

    if (empty($tenDN)) {
        $loiTB = "Vui lòng nhập tên đăng nhập";
    } elseif (empty($matKhau)) {
        $loiTB = "Vui lòng nhập mật khẩu";
    } else {
        $truyVan = "SELECT * FROM KhachHang WHERE TenKH = ? OR Email = ?";
        $ketNoi = mysqli_prepare($conn, $truyVan);
        mysqli_stmt_bind_param($ketNoi, "ss", $tenDN, $tenDN);
        mysqli_stmt_execute($ketNoi);
        $ketQua = mysqli_stmt_get_result($ketNoi);

        if (mysqli_num_rows($ketQua) > 0) {
            $dong = mysqli_fetch_assoc($ketQua);

            if (isset($dong['TrangThai']) && $dong['TrangThai'] == 0) {
                $loiTB = "Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.";
            } else {
                if (password_verify($matKhau, $dong['MatKhau'])) {
                    $_SESSION['user'] = $dong;

                    $truyVanCN = "UPDATE KhachHang SET NgayCapNhat = NOW() WHERE MaKH = ?";
                    $ketNoiCN = mysqli_prepare($conn, $truyVanCN);
                    mysqli_stmt_bind_param($ketNoiCN, "s", $dong['MaKH']);
                    mysqli_stmt_execute($ketNoiCN);
                    mysqli_stmt_close($ketNoiCN);

                    if (isset($_GET['redirect']) && !empty($_GET['redirect'])) {
                        header('Location: ' . $_GET['redirect']);
                    } else {
                        header('Location: index.php');
                    }
                    exit;
                } else {
                    $loiTB = "Tên đăng nhập hoặc mật khẩu không chính xác";
                }
            }
        } else {
            $loiTB = "Tên đăng nhập hoặc mật khẩu không chính xác";
        }

        mysqli_stmt_close($ketNoi);
    }
}

require_once('layouts/client/header.php');
?>

<main>
    <div class="container">
        <div class="auth-container">
            <div class="auth-form-container fade-in" style="animation-delay: 0.2s;">
                <div class="auth-header">
                    <h2>Đăng Nhập</h2>
                    <p>Chào mừng bạn quay trở lại với Milky World</p>
                </div>

                <?php if (!empty($loiTB)): ?>
                    <div class="auth-alert error">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $loiTB; ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="" class="auth-form" id="login-form">
                    <div class="form-group">
                        <label for="txtName">Tên đăng nhập hoặc Email</label>
                        <div class="input-wrapper">
                            <span class="input-icon"><i class="fas fa-user"></i></span>
                            <input
                                type="text"
                                id="txtName"
                                name="txtName"
                                placeholder="Nhập tên đăng nhập hoặc email"
                                value="<?php echo isset($_POST['txtName']) ? htmlspecialchars($_POST['txtName']) : ''; ?>"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txtPass">Mật khẩu</label>
                        <div class="input-wrapper">
                            <span class="input-icon"><i class="fas fa-lock"></i></span>
                            <input
                                type="password"
                                id="txtPass"
                                name="txtPass"
                                placeholder="Nhập mật khẩu"
                                required>
                            <button type="button" class="password-toggle" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" id="rememberMe" name="rememberMe">
                            <label for="rememberMe">Ghi nhớ đăng nhập</label>
                        </div>
                        <a href="forgot-password.php" class="forgot-password">Quên mật khẩu?</a>
                    </div>

                    <button type="submit" name="btnLogin" class="btn btn-primary btn-auth">
                        <i class="fas fa-sign-in-alt"></i> Đăng nhập
                    </button>

                    <div class="auth-divider">
                        <span>Hoặc đăng nhập với</span>
                    </div>

                    <div class="social-login">
                        <a href="#" class="social-btn facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-btn google">
                            <i class="fab fa-google"></i>
                        </a>
                    </div>
                </form>

                <div class="auth-footer">
                    <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
                </div>
            </div>

            <div class="auth-image scale-in" style="animation-delay: 0.3s;">
                <img src="assets/images/login-illustration.svg" alt="Đăng nhập" onerror="this.src='assets/images/logo.png'; this.style.maxWidth='250px';">
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nutHienMK = document.getElementById('togglePassword');
        const nhapMK = document.getElementById('txtPass');

        if (nutHienMK && nhapMK) {
            nutHienMK.addEventListener('click', function() {
                const kieuNhap = nhapMK.getAttribute('type') === 'password' ? 'text' : 'password';
                nhapMK.setAttribute('type', kieuNhap);

                const bieu = this.querySelector('i');
                bieu.classList.toggle('fa-eye');
                bieu.classList.toggle('fa-eye-slash');
            });
        }

        const formDN = document.getElementById('login-form');
        if (formDN) {
            formDN.addEventListener('submit', function(e) {
                let hopLe = true;
                const nhapTen = document.getElementById('txtName');
                const nhapMK = document.getElementById('txtPass');

                if (!nhapTen.value.trim()) {
                    hopLe = false;
                    hienThiLoi(nhapTen, 'Vui lòng nhập tên đăng nhập hoặc email');
                } else {
                    anLoi(nhapTen);
                }

                if (!nhapMK.value.trim()) {
                    hopLe = false;
                    hienThiLoi(nhapMK, 'Vui lòng nhập mật khẩu');
                } else {
                    anLoi(nhapMK);
                }

                if (!hopLe) {
                    e.preventDefault();
                }
            });
        }

        function hienThiLoi(truong, thongBao) {
            const nhomForm = truong.closest('.form-group');
            let phanTuLoi = nhomForm.querySelector('.input-error');

            if (!phanTuLoi) {
                phanTuLoi = document.createElement('div');
                phanTuLoi.className = 'input-error';
                nhomForm.appendChild(phanTuLoi);
            }

            phanTuLoi.textContent = thongBao;
            nhomForm.classList.add('has-error');
        }

        function anLoi(truong) {
            const nhomForm = truong.closest('.form-group');
            const phanTuLoi = nhomForm.querySelector('.input-error');

            if (phanTuLoi) {
                phanTuLoi.textContent = '';
            }

            nhomForm.classList.remove('has-error');
        }
    });
</script>

<?php
require_once('layouts/client/footer.php');
ob_end_flush();
?>