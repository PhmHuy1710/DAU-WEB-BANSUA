<?php
ob_start();

require_once('config/database.php');
require_once('config/config.php');
require_once('includes/session.php');

$errMsg = '';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['btnLogin'])) {
    $username = trim($_POST['txtName']);
    $password = trim($_POST['txtPass']);

    if (empty($username)) {
        $errMsg = "Vui lòng nhập tên đăng nhập";
    } elseif (empty($password)) {
        $errMsg = "Vui lòng nhập mật khẩu";
    } else {
        $sql = "SELECT * FROM KhachHang WHERE TenKH = ? OR Email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if (isset($row['TrangThai']) && $row['TrangThai'] == 0) {
                $errMsg = "Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.";
            } else {
                if (password_verify($password, $row['MatKhau'])) {
                    $_SESSION['user'] = $row;

                    $updateSql = "UPDATE KhachHang SET NgayCapNhat = NOW() WHERE MaKH = ?";
                    $updateStmt = mysqli_prepare($conn, $updateSql);
                    mysqli_stmt_bind_param($updateStmt, "s", $row['MaKH']);
                    mysqli_stmt_execute($updateStmt);
                    mysqli_stmt_close($updateStmt);

                    if (isset($_GET['redirect']) && !empty($_GET['redirect'])) {
                        header('Location: ' . $_GET['redirect']);
                    } else {
                        header('Location: index.php');
                    }
                    exit;
                } else {
                    $errMsg = "Tên đăng nhập hoặc mật khẩu không chính xác";
                }
            }
        } else {
            $errMsg = "Tên đăng nhập hoặc mật khẩu không chính xác";
        }

        mysqli_stmt_close($stmt);
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

                <?php if (!empty($errMsg)): ?>
                    <div class="auth-alert error">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $errMsg; ?>
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
        const togglePass = document.getElementById('togglePassword');
        const passInput = document.getElementById('txtPass');

        if (togglePass && passInput) {
            togglePass.addEventListener('click', function() {
                const inputType = passInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passInput.setAttribute('type', inputType);

                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        }

        const loginForm = document.getElementById('login-form');
        if (loginForm) {
            loginForm.addEventListener('submit', function(e) {
                let isValid = true;
                const nameInput = document.getElementById('txtName');
                const passInput = document.getElementById('txtPass');

                if (!nameInput.value.trim()) {
                    isValid = false;
                    showError(nameInput, 'Vui lòng nhập tên đăng nhập hoặc email');
                } else {
                    hideError(nameInput);
                }

                if (!passInput.value.trim()) {
                    isValid = false;
                    showError(passInput, 'Vui lòng nhập mật khẩu');
                } else {
                    hideError(passInput);
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });
        }

        function showError(field, message) {
            const formGroup = field.closest('.form-group');
            let errorEl = formGroup.querySelector('.input-error');

            if (!errorEl) {
                errorEl = document.createElement('div');
                errorEl.className = 'input-error';
                formGroup.appendChild(errorEl);
            }

            errorEl.textContent = message;
            formGroup.classList.add('has-error');
        }

        function hideError(field) {
            const formGroup = field.closest('.form-group');
            const errorEl = formGroup.querySelector('.input-error');

            if (errorEl) {
                errorEl.textContent = '';
            }

            formGroup.classList.remove('has-error');
        }
    });
</script>

<?php
require_once('layouts/client/footer.php');
ob_end_flush();
?>