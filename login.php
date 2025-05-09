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
        $sqlDN = "SELECT * FROM KhachHang WHERE (TenKH=? OR Email=?) AND TrangThai=1";
        $stmtDN = mysqli_prepare($conn, $sqlDN);

        if ($stmtDN) {
            mysqli_stmt_bind_param($stmtDN, "ss", $tenDN, $tenDN);
            mysqli_stmt_execute($stmtDN);
            $ketQuaDN = mysqli_stmt_get_result($stmtDN);

            if (mysqli_num_rows($ketQuaDN) > 0) {
                $dongDN = mysqli_fetch_assoc($ketQuaDN);

                if (password_verify($matKhau, $dongDN['MatKhau'])) {
                    $_SESSION['user'] = $dongDN;

                    $sqlCapNhat = "UPDATE KhachHang SET NgayCapNhat = NOW() WHERE MaKH = ?";
                    $stmtCapNhat = mysqli_prepare($conn, $sqlCapNhat);
                    mysqli_stmt_bind_param($stmtCapNhat, "s", $dongDN['MaKH']);
                    mysqli_stmt_execute($stmtCapNhat);
                    mysqli_stmt_close($stmtCapNhat);

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

            mysqli_stmt_close($stmtDN);
        } else {
            $thongBaoLoi = "Lỗi hệ thống, vui lòng thử lại sau";
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
                <img src="assets/images/login-illustration.svg" alt="Đăng nhập" onerror="this.src='assets/images/logo.png'; this.style.maxWidth='250px';">
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nutToggleMK = document.getElementById('nutToggleMK');
        const oMatKhau = document.getElementById('txtPass');

        if (nutToggleMK && oMatKhau) {
            nutToggleMK.addEventListener('click', function() {
                const kieuInput = oMatKhau.getAttribute('type') === 'password' ? 'text' : 'password';
                oMatKhau.setAttribute('type', kieuInput);

                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        }

        const formLogin = document.getElementById('form-login');

        if (formLogin) {
            formLogin.addEventListener('submit', function(e) {
                let hopLe = true;
                const oTenDN = document.getElementById('txtName');
                const oMatKhau = document.getElementById('txtPass');

                if (!oTenDN.value.trim()) {
                    hopLe = false;
                    hienLoiInput(oTenDN, 'Vui lòng nhập tên đăng nhập hoặc email');
                } else {
                    anLoiInput(oTenDN);
                }

                if (!oMatKhau.value.trim()) {
                    hopLe = false;
                    hienLoiInput(oMatKhau, 'Vui lòng nhập mật khẩu');
                } else {
                    anLoiInput(oMatKhau);
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
    });
</script>

<?php
require_once('layouts/client/footer.php');
ob_end_flush();
?>