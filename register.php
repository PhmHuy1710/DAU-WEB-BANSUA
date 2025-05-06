<?php
ob_start();

require_once('config/database.php');
require_once('config/config.php');
require_once('includes/session.php');

// Initialize error message variable
$error_message = '';
$success_message = '';

// Check if user is already logged in
if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['btnRegister'])) {
    // Get form data
    $name = trim($_POST['txtName']);
    $email = trim($_POST['txtEmail']);
    $pass = trim($_POST['txtPass']);
    $repass = trim($_POST['txtRePass']);
    $phone = isset($_POST['txtPhone']) ? trim($_POST['txtPhone']) : '';
    $agree = isset($_POST['agree']) ? true : false;

    // Validate form data
    if (empty($name)) {
        $error_message = "Vui lòng nhập tên đăng nhập";
    } elseif (strlen($name) < 3) {
        $error_message = "Tên đăng nhập phải có ít nhất 3 ký tự";
    } elseif (empty($email)) {
        $error_message = "Vui lòng nhập email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Email không hợp lệ";
    } elseif (empty($pass)) {
        $error_message = "Vui lòng nhập mật khẩu";
    } elseif (strlen($pass) < 6) {
        $error_message = "Mật khẩu phải có ít nhất 6 ký tự";
    } elseif (empty($repass)) {
        $error_message = "Vui lòng nhập lại mật khẩu";
    } elseif ($pass !== $repass) {
        $error_message = "Mật khẩu không khớp";
    } elseif (!$agree) {
        $error_message = "Bạn phải đồng ý với điều khoản sử dụng";
    } else {
        // Check if username already exists
        $check_name_sql = "SELECT * FROM KhachHang WHERE TenKH = ?";
        $check_name_stmt = mysqli_prepare($conn, $check_name_sql);
        mysqli_stmt_bind_param($check_name_stmt, "s", $name);
        mysqli_stmt_execute($check_name_stmt);
        $check_name_result = mysqli_stmt_get_result($check_name_stmt);

        if (mysqli_num_rows($check_name_result) > 0) {
            $error_message = "Tên đăng nhập đã tồn tại";
            mysqli_stmt_close($check_name_stmt);
        } else {
            mysqli_stmt_close($check_name_stmt);

            // Check if email already exists
            $check_email_sql = "SELECT * FROM KhachHang WHERE Email = ?";
            $check_email_stmt = mysqli_prepare($conn, $check_email_sql);
            mysqli_stmt_bind_param($check_email_stmt, "s", $email);
            mysqli_stmt_execute($check_email_stmt);
            $check_email_result = mysqli_stmt_get_result($check_email_stmt);

            if (mysqli_num_rows($check_email_result) > 0) {
                $error_message = "Email đã tồn tại trong hệ thống";
                mysqli_stmt_close($check_email_stmt);
            } else {
                mysqli_stmt_close($check_email_stmt);

                // Define variables for empty values
                $diaChi = '';
                $soDienThoai = $phone;
                $vaiTro = 'user';
                $avatar = null;
                $trangThai = 1;

                // Mã hóa mật khẩu bằng password_hash
                $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

                // Insert new user
                $sql = "INSERT INTO KhachHang (TenKH, Email, MatKhau, DiaChi, SoDienThoai, VaiTro, Avatar, TrangThai, NgayTao, NgayCapNhat)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "sssssssi", $name, $email, $hashed_password, $diaChi, $soDienThoai, $vaiTro, $avatar, $trangThai);

                if (mysqli_stmt_execute($stmt)) {
                    $success_message = "Đăng ký thành công! Vui lòng đăng nhập để tiếp tục.";

                    // Clear form data after successful registration
                    $name = $email = $pass = $repass = $phone = '';
                } else {
                    $error_message = "Đăng ký thất bại: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt);
            }
        }
    }
}

require_once('layouts/client/header.php');
?>

<main class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h3 class="mb-0">Đăng Ký Tài Khoản</h3>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <?php if (!empty($success_message)): ?>
                            <div class="alert alert-success" role="alert">
                                <i class="fas fa-check-circle me-2"></i> <?php echo $success_message; ?>
                                <div class="mt-3">
                                    <a href="login.php" class="btn btn-primary">Đăng nhập ngay</a>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php if (!empty($error_message)): ?>
                                <div class="alert alert-danger" role="alert">
                                    <i class="fas fa-exclamation-circle me-2"></i> <?php echo $error_message; ?>
                                </div>
                            <?php endif; ?>

                            <form method="post" class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="txtName" class="form-label">Tên đăng nhập <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" id="txtName" name="txtName"
                                                placeholder="Nhập tên đăng nhập"
                                                value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>"
                                                required minlength="3">
                                        </div>
                                        <div class="form-text">Tên đăng nhập phải có ít nhất 3 ký tự</div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="txtEmail" class="form-label">Email <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control" id="txtEmail" name="txtEmail"
                                                placeholder="Nhập địa chỉ email"
                                                value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"
                                                required>
                                        </div>
                                        <div class="form-text">Chúng tôi sẽ không chia sẻ email của bạn với bất kỳ ai</div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="txtPass" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control" id="txtPass" name="txtPass"
                                                placeholder="Nhập mật khẩu" required minlength="6">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <div class="form-text">Mật khẩu phải có ít nhất 6 ký tự</div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="txtRePass" class="form-label">Nhập lại mật khẩu <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control" id="txtRePass" name="txtRePass"
                                                placeholder="Nhập lại mật khẩu" required>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-4">
                                        <label for="txtPhone" class="form-label">Số điện thoại (tùy chọn)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            <input type="tel" class="form-control" id="txtPhone" name="txtPhone"
                                                placeholder="Nhập số điện thoại"
                                                value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>">
                                        </div>
                                    </div>

                                    <div class="col-12 mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="agree" name="agree" required>
                                            <label class="form-check-label" for="agree">
                                                Tôi đồng ý với <a href="terms.php" target="_blank">điều khoản sử dụng</a> và <a href="privacy.php" target="_blank">chính sách bảo mật</a>
                                            </label>
                                            <div class="invalid-feedback">
                                                Bạn phải đồng ý với điều khoản sử dụng
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" name="btnRegister" class="btn btn-primary btn-lg">
                                        <i class="fas fa-user-plus me-2"></i> Đăng ký
                                    </button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small">Đã có tài khoản? <a href="login.php" class="text-primary">Đăng nhập ngay</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
// Show/hide password
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

// Form validation
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

// Password match validation
const password = document.getElementById('txtPass');
const confirmPassword = document.getElementById('txtRePass');

function validatePassword() {
    if (password.value !== confirmPassword.value) {
        confirmPassword.setCustomValidity('Mật khẩu không khớp');
    } else {
        confirmPassword.setCustomValidity('');
    }
}

password.addEventListener('change', validatePassword);
confirmPassword.addEventListener('keyup', validatePassword);
</script>

<?php
require_once('layouts/client/footer.php');

// End output buffering and flush the output
ob_end_flush();
?>