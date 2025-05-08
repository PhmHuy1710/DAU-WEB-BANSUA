<?php
ob_start();

require_once('config/database.php');
require_once('config/config.php');
require_once('includes/session.php');

$error_message = '';
$success_message = '';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['btnRegister'])) {

    $name = trim($_POST['txtName']);
    $email = trim($_POST['txtEmail']);
    $pass = trim($_POST['txtPass']);
    $repass = trim($_POST['txtRePass']);
    $phone = isset($_POST['txtPhone']) ? trim($_POST['txtPhone']) : '';
    $agree = isset($_POST['agree']) ? true : false;

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

                $diaChi = '';
                $soDienThoai = $phone;
                $vaiTro = 'user';
                $avatar = null;
                $trangThai = 1;

                $maKH = '';
                $check_id = true;

                while ($check_id) {

                    $random_number = mt_rand(100, 999);
                    $maKH = 'KH' . $random_number;

                    $check_id_sql = "SELECT MaKH FROM KhachHang WHERE MaKH = ?";
                    $check_id_stmt = mysqli_prepare($conn, $check_id_sql);
                    mysqli_stmt_bind_param($check_id_stmt, "s", $maKH);
                    mysqli_stmt_execute($check_id_stmt);
                    mysqli_stmt_store_result($check_id_stmt);

                    if (mysqli_stmt_num_rows($check_id_stmt) == 0) {
                        $check_id = false;
                    }

                    mysqli_stmt_close($check_id_stmt);
                }

                $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

                $sql = "INSERT INTO KhachHang (MaKH, TenKH, Email, MatKhau, DiaChi, SoDienThoai, VaiTro, Avatar, TrangThai, NgayTao, NgayCapNhat)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ssssssssi", $maKH, $name, $email, $hashed_password, $diaChi, $soDienThoai, $vaiTro, $avatar, $trangThai);

                if (mysqli_stmt_execute($stmt)) {
                    $success_message = "Đăng ký thành công! Vui lòng đăng nhập để tiếp tục.";

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

<main>
    <div class="container">
        <div class="auth-container register-container">
            <div class="auth-form-container fade-in" style="animation-delay: 0.2s;">
                <div class="auth-header">
                    <h2>Đăng Ký Tài Khoản</h2>
                    <p>Tạo tài khoản để mua sắm dễ dàng hơn tại Milky World</p>
                </div>

                <?php if (!empty($success_message)): ?>
                    <div class="auth-alert success">
                        <i class="fas fa-check-circle"></i>
                        <div class="alert-content">
                            <p><?php echo $success_message; ?></p>
                            <a href="login.php" class="btn btn-primary btn-sm">Đăng nhập ngay</a>
                        </div>
                    </div>
                <?php else: ?>
                    <?php if (!empty($error_message)): ?>
                        <div class="auth-alert error">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" class="auth-form" id="register-form">
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
                                        value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>"
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
                                    <button type="button" class="password-toggle" id="togglePassword">
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
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="txtPhone">Số điện thoại (tùy chọn)</label>
                                <div class="input-wrapper">
                                    <span class="input-icon"><i class="fas fa-phone"></i></span>
                                    <input
                                        type="tel"
                                        id="txtPhone"
                                        name="txtPhone"
                                        placeholder="Nhập số điện thoại"
                                        value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group checkbox-group">
                            <div class="custom-checkbox">
                                <input type="checkbox" id="agree" name="agree" required>
                                <label for="agree">
                                    Tôi đồng ý với <a href="terms.php" target="_blank">điều khoản sử dụng</a> và <a href="privacy.php" target="_blank">chính sách bảo mật</a>
                                </label>
                            </div>
                        </div>

                        <button type="submit" name="btnRegister" class="btn btn-primary btn-auth">
                            <i class="fas fa-user-plus"></i> Đăng ký
                        </button>
                    </form>
                <?php endif; ?>

                <div class="auth-footer">
                    <p>Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
                </div>
            </div>

            <div class="auth-image register-image scale-in" style="animation-delay: 0.3s;">
                <img src="assets/images/register-illustration.svg" alt="Đăng ký" onerror="this.src='assets/images/logo.png'; this.style.maxWidth='250px';">
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('txtPass');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Toggle icon
                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        }

        // Password match validation
        const password = document.getElementById('txtPass');
        const confirmPassword = document.getElementById('txtRePass');

        function validatePassword() {
            if (confirmPassword.value && password.value !== confirmPassword.value) {
                showInputError(confirmPassword, 'Mật khẩu không khớp');
            } else if (confirmPassword.value) {
                hideInputError(confirmPassword);
            }
        }

        if (password && confirmPassword) {
            password.addEventListener('change', validatePassword);
            confirmPassword.addEventListener('keyup', validatePassword);
        }

        // Form validation
        const registerForm = document.getElementById('register-form');
        if (registerForm) {
            registerForm.addEventListener('submit', function(e) {
                let isValid = true;

                // Validate username
                const nameInput = document.getElementById('txtName');
                if (!nameInput.value.trim()) {
                    isValid = false;
                    showInputError(nameInput, 'Vui lòng nhập tên đăng nhập');
                } else if (nameInput.value.length < 3) {
                    isValid = false;
                    showInputError(nameInput, 'Tên đăng nhập phải có ít nhất 3 ký tự');
                } else {
                    hideInputError(nameInput);
                }

                // Validate email
                const emailInput = document.getElementById('txtEmail');
                if (!emailInput.value.trim()) {
                    isValid = false;
                    showInputError(emailInput, 'Vui lòng nhập email');
                } else if (!isValidEmail(emailInput.value)) {
                    isValid = false;
                    showInputError(emailInput, 'Email không hợp lệ');
                } else {
                    hideInputError(emailInput);
                }

                // Validate password
                const passwordInput = document.getElementById('txtPass');
                if (!passwordInput.value.trim()) {
                    isValid = false;
                    showInputError(passwordInput, 'Vui lòng nhập mật khẩu');
                } else if (passwordInput.value.length < 6) {
                    isValid = false;
                    showInputError(passwordInput, 'Mật khẩu phải có ít nhất 6 ký tự');
                } else {
                    hideInputError(passwordInput);
                }

                // Validate confirm password
                const confirmPasswordInput = document.getElementById('txtRePass');
                if (!confirmPasswordInput.value.trim()) {
                    isValid = false;
                    showInputError(confirmPasswordInput, 'Vui lòng nhập lại mật khẩu');
                } else if (passwordInput.value !== confirmPasswordInput.value) {
                    isValid = false;
                    showInputError(confirmPasswordInput, 'Mật khẩu không khớp');
                } else {
                    hideInputError(confirmPasswordInput);
                }

                // Validate terms agreement
                const agreeCheckbox = document.getElementById('agree');
                if (!agreeCheckbox.checked) {
                    isValid = false;
                    showCheckboxError(agreeCheckbox, 'Bạn phải đồng ý với điều khoản sử dụng');
                } else {
                    hideCheckboxError(agreeCheckbox);
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });
        }

        // Helper functions
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function showInputError(input, message) {
            const formGroup = input.closest('.form-group');
            formGroup.classList.add('error');

            // Create error message if it doesn't exist
            let errorElement = formGroup.querySelector('.input-error');
            if (!errorElement) {
                errorElement = document.createElement('div');
                errorElement.className = 'input-error';
                formGroup.appendChild(errorElement);
            }

            errorElement.textContent = message;
        }

        function hideInputError(input) {
            const formGroup = input.closest('.form-group');
            formGroup.classList.remove('error');

            const errorElement = formGroup.querySelector('.input-error');
            if (errorElement) {
                errorElement.remove();
            }
        }

        function showCheckboxError(checkbox, message) {
            const checkboxGroup = checkbox.closest('.checkbox-group');
            checkboxGroup.classList.add('error');

            let errorElement = checkboxGroup.querySelector('.input-error');
            if (!errorElement) {
                errorElement = document.createElement('div');
                errorElement.className = 'input-error';
                checkboxGroup.appendChild(errorElement);
            }

            errorElement.textContent = message;
        }

        function hideCheckboxError(checkbox) {
            const checkboxGroup = checkbox.closest('.checkbox-group');
            checkboxGroup.classList.remove('error');

            const errorElement = checkboxGroup.querySelector('.input-error');
            if (errorElement) {
                errorElement.remove();
            }
        }
    });
</script>

<?php
require_once('layouts/client/footer.php');

ob_end_flush();
?>