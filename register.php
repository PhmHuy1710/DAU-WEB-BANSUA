<?php
ob_start();

require_once('config/database.php');
require_once('config/config.php');
require_once('includes/session.php');

$errMsg = '';
$successMsg = '';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['btnRegister'])) {

    $username = trim($_POST['txtName']);
    $email = trim($_POST['txtEmail']);
    $password = trim($_POST['txtPass']);
    $rePassword = trim($_POST['txtRePass']);
    $phone = isset($_POST['txtPhone']) ? trim($_POST['txtPhone']) : '';
    $agree = isset($_POST['agree']) ? true : false;

    if (empty($username)) {
        $errMsg = "Vui lòng nhập tên đăng nhập";
    } elseif (strlen($username) < 3) {
        $errMsg = "Tên đăng nhập phải có ít nhất 3 ký tự";
    } elseif (empty($email)) {
        $errMsg = "Vui lòng nhập email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errMsg = "Email không hợp lệ";
    } elseif (empty($password)) {
        $errMsg = "Vui lòng nhập mật khẩu";
    } elseif (strlen($password) < 6) {
        $errMsg = "Mật khẩu phải có ít nhất 6 ký tự";
    } elseif (empty($rePassword)) {
        $errMsg = "Vui lòng nhập lại mật khẩu";
    } elseif ($password !== $rePassword) {
        $errMsg = "Mật khẩu không khớp";
    } elseif (!$agree) {
        $errMsg = "Bạn phải đồng ý với điều khoản sử dụng";
    } else {
        $checkNameSQL = "SELECT * FROM KhachHang WHERE TenKH = ?";
        $checkNameStmt = mysqli_prepare($conn, $checkNameSQL);
        mysqli_stmt_bind_param($checkNameStmt, "s", $username);
        mysqli_stmt_execute($checkNameStmt);
        $checkNameResult = mysqli_stmt_get_result($checkNameStmt);

        if (mysqli_num_rows($checkNameResult) > 0) {
            $errMsg = "Tên đăng nhập đã tồn tại";
            mysqli_stmt_close($checkNameStmt);
        } else {
            mysqli_stmt_close($checkNameStmt);

            $checkEmailSQL = "SELECT * FROM KhachHang WHERE Email = ?";
            $checkEmailStmt = mysqli_prepare($conn, $checkEmailSQL);
            mysqli_stmt_bind_param($checkEmailStmt, "s", $email);
            mysqli_stmt_execute($checkEmailStmt);
            $checkEmailResult = mysqli_stmt_get_result($checkEmailStmt);

            if (mysqli_num_rows($checkEmailResult) > 0) {
                $errMsg = "Email đã tồn tại trong hệ thống";
                mysqli_stmt_close($checkEmailStmt);
            } else {
                mysqli_stmt_close($checkEmailStmt);

                $address = '';
                $phoneNumber = $phone;
                $role = 'user';
                $avatar = null;
                $status = 1;

                $customerID = '';
                $checkID = true;

                while ($checkID) {

                    $randomNum = mt_rand(100, 999);
                    $customerID = 'KH' . $randomNum;

                    $checkIDSQL = "SELECT MaKH FROM KhachHang WHERE MaKH = ?";
                    $checkIDStmt = mysqli_prepare($conn, $checkIDSQL);
                    mysqli_stmt_bind_param($checkIDStmt, "s", $customerID);
                    mysqli_stmt_execute($checkIDStmt);
                    mysqli_stmt_store_result($checkIDStmt);

                    if (mysqli_stmt_num_rows($checkIDStmt) == 0) {
                        $checkID = false;
                    }

                    mysqli_stmt_close($checkIDStmt);
                }

                $hashedPass = password_hash($password, PASSWORD_DEFAULT);

                $insertSQL = "INSERT INTO KhachHang (MaKH, TenKH, Email, MatKhau, DiaChi, SoDienThoai, VaiTro, Avatar, TrangThai, NgayTao, NgayCapNhat)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
                $insertStmt = mysqli_prepare($conn, $insertSQL);
                mysqli_stmt_bind_param($insertStmt, "ssssssssi", $customerID, $username, $email, $hashedPass, $address, $phoneNumber, $role, $avatar, $status);

                if (mysqli_stmt_execute($insertStmt)) {
                    $successMsg = "Đăng ký thành công! Vui lòng đăng nhập để tiếp tục.";

                    $username = $email = $password = $rePassword = $phone = '';
                } else {
                    $errMsg = "Đăng ký thất bại: " . mysqli_error($conn);
                }

                mysqli_stmt_close($insertStmt);
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

                <?php if (!empty($successMsg)): ?>
                    <div class="auth-alert success">
                        <i class="fas fa-check-circle"></i>
                        <div class="alert-content">
                            <p><?php echo $successMsg; ?></p>
                            <a href="login.php" class="btn btn-primary btn-sm">Đăng nhập ngay</a>
                        </div>
                    </div>
                <?php else: ?>
                    <?php if (!empty($errMsg)): ?>
                        <div class="auth-alert error">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $errMsg; ?>
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
                                        value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>"
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
                                        required
                                        minlength="6">
                                    <button type="button" class="password-toggle" id="toggleRePassword">
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
                                        value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>"
                                        pattern="[0-9]{10,11}">
                                </div>
                                <div class="input-help">Nhập số điện thoại để được hỗ trợ tốt hơn</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group checkbox-group">
                                <div class="checkbox-wrapper">
                                    <input type="checkbox" id="agree" name="agree" required>
                                    <label for="agree">Tôi đồng ý với <a href="#">Điều khoản sử dụng</a> và <a href="#">Chính sách bảo mật</a> <span class="required">*</span></label>
                                </div>
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
                <img src="assets/images/register-illustration.svg" alt="Đăng ký" onerror="this.src='assets/images/logo.png'; this.style.maxWidth='250px';">
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePass = document.getElementById('togglePassword');
        const passInput = document.getElementById('txtPass');
        const toggleRePass = document.getElementById('toggleRePassword');
        const rePassInput = document.getElementById('txtRePass');

        if (togglePass && passInput) {
            togglePass.addEventListener('click', function() {
                const inputType = passInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passInput.setAttribute('type', inputType);

                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        }

        if (toggleRePass && rePassInput) {
            toggleRePass.addEventListener('click', function() {
                const inputType = rePassInput.getAttribute('type') === 'password' ? 'text' : 'password';
                rePassInput.setAttribute('type', inputType);

                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        }

        const registerForm = document.getElementById('register-form');

        if (registerForm) {
            registerForm.addEventListener('submit', function(e) {
                let isValid = true;
                const nameInput = document.getElementById('txtName');
                const emailInput = document.getElementById('txtEmail');
                const passInput = document.getElementById('txtPass');
                const rePassInput = document.getElementById('txtRePass');
                const phoneInput = document.getElementById('txtPhone');
                const agreeCheck = document.getElementById('agree');

                if (!nameInput.value.trim()) {
                    isValid = false;
                    showError(nameInput, 'Vui lòng nhập tên đăng nhập');
                } else if (nameInput.value.trim().length < 3) {
                    isValid = false;
                    showError(nameInput, 'Tên đăng nhập phải có ít nhất 3 ký tự');
                } else {
                    hideError(nameInput);
                }

                if (!emailInput.value.trim()) {
                    isValid = false;
                    showError(emailInput, 'Vui lòng nhập email');
                } else if (!validateEmail(emailInput.value.trim())) {
                    isValid = false;
                    showError(emailInput, 'Email không hợp lệ');
                } else {
                    hideError(emailInput);
                }

                if (!passInput.value.trim()) {
                    isValid = false;
                    showError(passInput, 'Vui lòng nhập mật khẩu');
                } else if (passInput.value.trim().length < 6) {
                    isValid = false;
                    showError(passInput, 'Mật khẩu phải có ít nhất 6 ký tự');
                } else {
                    hideError(passInput);
                }

                if (!rePassInput.value.trim()) {
                    isValid = false;
                    showError(rePassInput, 'Vui lòng nhập lại mật khẩu');
                } else if (rePassInput.value.trim() !== passInput.value.trim()) {
                    isValid = false;
                    showError(rePassInput, 'Mật khẩu không khớp');
                } else {
                    hideError(rePassInput);
                }

                if (phoneInput.value.trim() && !validatePhone(phoneInput.value.trim())) {
                    isValid = false;
                    showError(phoneInput, 'Số điện thoại không hợp lệ');
                } else {
                    hideError(phoneInput);
                }

                if (!agreeCheck.checked) {
                    isValid = false;
                    showCheckboxError(agreeCheck, 'Bạn phải đồng ý với điều khoản sử dụng');
                } else {
                    hideCheckboxError(agreeCheck);
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

        function showCheckboxError(checkbox, message) {
            const checkboxGroup = checkbox.closest('.checkbox-group');
            let errorEl = checkboxGroup.querySelector('.input-error');

            if (!errorEl) {
                errorEl = document.createElement('div');
                errorEl.className = 'input-error';
                checkboxGroup.appendChild(errorEl);
            }

            errorEl.textContent = message;
            checkboxGroup.classList.add('has-error');
        }

        function hideCheckboxError(checkbox) {
            const checkboxGroup = checkbox.closest('.checkbox-group');
            const errorEl = checkboxGroup.querySelector('.input-error');

            if (errorEl) {
                errorEl.textContent = '';
            }

            checkboxGroup.classList.remove('has-error');
        }

        function validateEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email.toLowerCase());
        }

        function validatePhone(phone) {
            const re = /^[0-9]{10,11}$/;
            return re.test(phone);
        }
    });
</script>

<?php
require_once('layouts/client/footer.php');
ob_end_flush();
?>