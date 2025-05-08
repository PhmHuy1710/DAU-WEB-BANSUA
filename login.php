<?php
ob_start();

require_once('config/database.php');
require_once('config/config.php');
require_once('includes/session.php');

$error_message = '';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['btnLogin'])) {
    $name = trim($_POST['txtName']);
    $pass = trim($_POST['txtPass']);

    if (empty($name)) {
        $error_message = "Vui lòng nhập tên đăng nhập";
    } elseif (empty($pass)) {
        $error_message = "Vui lòng nhập mật khẩu";
    } else {
        $sql = "SELECT * FROM KhachHang WHERE TenKH = ? OR Email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $name, $name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if (isset($row['TrangThai']) && $row['TrangThai'] == 0) {
                $error_message = "Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.";
            } else {
                // Verify password using password_verify for hashed passwords
                if (password_verify($pass, $row['MatKhau'])) {
                    $_SESSION['user'] = $row;

                    // Update last login time (optional)
                    $update_sql = "UPDATE KhachHang SET NgayCapNhat = NOW() WHERE MaKH = ?";
                    $update_stmt = mysqli_prepare($conn, $update_sql);
                    mysqli_stmt_bind_param($update_stmt, "s", $row['MaKH']);
                    mysqli_stmt_execute($update_stmt);
                    mysqli_stmt_close($update_stmt);

                    // Check if there's a redirect URL
                    if (isset($_GET['redirect']) && !empty($_GET['redirect'])) {
                        header('Location: ' . $_GET['redirect']);
                    } else {
                        header('Location: index.php');
                    }
                    exit;
                } else {
                    $error_message = "Tên đăng nhập hoặc mật khẩu không chính xác";
                }
            }
        } else {
            $error_message = "Tên đăng nhập hoặc mật khẩu không chính xác";
        }

        mysqli_stmt_close($stmt);
    }
}

require_once('layouts/client/header.php');
?>

<main class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h3 class="mb-0">Đăng Nhập</h3>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i> <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="txtName" class="form-label">Tên đăng nhập hoặc Email <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="txtName" name="txtName"
                                        placeholder="Nhập tên đăng nhập hoặc email"
                                        value="<?php echo isset($_POST['txtName']) ? htmlspecialchars($_POST['txtName']) : ''; ?>"
                                        required>
                                </div>
                                <div class="invalid-feedback">Vui lòng nhập tên đăng nhập hoặc email</div>
                            </div>

                            <div class="mb-4">
                                <label for="txtPass" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="txtPass" name="txtPass"
                                        placeholder="Nhập mật khẩu" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback">Vui lòng nhập mật khẩu</div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Ghi nhớ đăng nhập</label>
                                </div>
                                <a href="forgot-password.php" class="text-primary small">Quên mật khẩu?</a>
                            </div>

                            <div class="d-grid">
                                <button type="submit" name="btnLogin" class="btn btn-primary btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i> Đăng nhập
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small">Chưa có tài khoản? <a href="register.php" class="text-primary">Đăng ký ngay</a></div>
                    </div>
                </div>

                <!-- Social Login (Optional) -->
                <div class="mt-4 text-center">
                    <p class="text-muted mb-3">Hoặc đăng nhập với</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="#" class="btn btn-outline-primary social-btn">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger social-btn">
                            <i class="fab fa-google"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('txtPass');
    const icon = this.querySelector('i');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});

(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})()
</script>

<style>
.social-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}
.social-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
</style>

<?php
require_once('layouts/client/footer.php');

ob_end_flush();
?>