<?php
ob_start();

require_once('config/database.php');
require_once('config/config.php');
require_once('includes/session.php');

$loiTB = '';
$thanhCongTB = '';

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
    $dongY = isset($_POST['agree']) ? true : false;

    if (empty($tenDN)) {
        $loiTB = "Vui lòng nhập tên đăng nhập";
    } elseif (strlen($tenDN) < 3) {
        $loiTB = "Tên đăng nhập phải có ít nhất 3 ký tự";
    } elseif (empty($email)) {
        $loiTB = "Vui lòng nhập email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $loiTB = "Email không hợp lệ";
    } elseif (empty($matKhau)) {
        $loiTB = "Vui lòng nhập mật khẩu";
    } elseif (strlen($matKhau) < 6) {
        $loiTB = "Mật khẩu phải có ít nhất 6 ký tự";
    } elseif (empty($nhapLaiMK)) {
        $loiTB = "Vui lòng nhập lại mật khẩu";
    } elseif ($matKhau !== $nhapLaiMK) {
        $loiTB = "Mật khẩu không khớp";
    } elseif (!$dongY) {
        $loiTB = "Bạn phải đồng ý với điều khoản sử dụng";
    } else {
        $kiemTraTenTQ = "SELECT * FROM KhachHang WHERE TenKH = ?";
        $ketNoiTen = mysqli_prepare($conn, $kiemTraTenTQ);
        mysqli_stmt_bind_param($ketNoiTen, "s", $tenDN);
        mysqli_stmt_execute($ketNoiTen);
        $ketQuaTen = mysqli_stmt_get_result($ketNoiTen);

        if (mysqli_num_rows($ketQuaTen) > 0) {
            $loiTB = "Tên đăng nhập đã tồn tại";
            mysqli_stmt_close($ketNoiTen);
        } else {
            mysqli_stmt_close($ketNoiTen);

            $kiemTraEmailTQ = "SELECT * FROM KhachHang WHERE Email = ?";
            $ketNoiEmail = mysqli_prepare($conn, $kiemTraEmailTQ);
            mysqli_stmt_bind_param($ketNoiEmail, "s", $email);
            mysqli_stmt_execute($ketNoiEmail);
            $ketQuaEmail = mysqli_stmt_get_result($ketNoiEmail);

            if (mysqli_num_rows($ketQuaEmail) > 0) {
                $loiTB = "Email đã tồn tại trong hệ thống";
                mysqli_stmt_close($ketNoiEmail);
            } else {
                mysqli_stmt_close($ketNoiEmail);

                $diaChi = '';
                $soDienThoai = $sdt;
                $vaiTro = 'user';
                $avatar = null;
                $trangThai = 1;

                $maKH = '';
                $kiemTraID = true;

                while ($kiemTraID) {

                    $soNgauNhien = mt_rand(100, 999);
                    $maKH = 'KH' . $soNgauNhien;

                    $kiemTraIDTQ = "SELECT MaKH FROM KhachHang WHERE MaKH = ?";
                    $ketNoiID = mysqli_prepare($conn, $kiemTraIDTQ);
                    mysqli_stmt_bind_param($ketNoiID, "s", $maKH);
                    mysqli_stmt_execute($ketNoiID);
                    mysqli_stmt_store_result($ketNoiID);

                    if (mysqli_stmt_num_rows($ketNoiID) == 0) {
                        $kiemTraID = false;
                    }

                    mysqli_stmt_close($ketNoiID);
                }

                $matKhauMaHoa = password_hash($matKhau, PASSWORD_DEFAULT);

                $truyVan = "INSERT INTO KhachHang (MaKH, TenKH, Email, MatKhau, DiaChi, SoDienThoai, VaiTro, Avatar, TrangThai, NgayTao, NgayCapNhat)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
                $ketNoi = mysqli_prepare($conn, $truyVan);
                mysqli_stmt_bind_param($ketNoi, "ssssssssi", $maKH, $tenDN, $email, $matKhauMaHoa, $diaChi, $soDienThoai, $vaiTro, $avatar, $trangThai);

                if (mysqli_stmt_execute($ketNoi)) {
                    $thanhCongTB = "Đăng ký thành công! Vui lòng đăng nhập để tiếp tục.";

                    $tenDN = $email = $matKhau = $nhapLaiMK = $sdt = '';
                } else {
                    $loiTB = "Đăng ký thất bại: " . mysqli_error($conn);
                }

                mysqli_stmt_close($ketNoi);
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

                <?php if (!empty($thanhCongTB)): ?>
                    <div class="auth-alert success">
                        <i class="fas fa-check-circle"></i>
                        <div class="alert-content">
                            <p><?php echo $thanhCongTB; ?></p>
                            <a href="login.php" class="btn btn-primary btn-sm">Đăng nhập ngay</a>
                        </div>
                    </div>
                <?php else: ?>
                    <?php if (!empty($loiTB)): ?>
                        <div class="auth-alert error">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $loiTB; ?>
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
                                        value="<?php echo isset($sdt) ? htmlspecialchars($sdt) : ''; ?>"
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
        const nutHienMK = document.getElementById('togglePassword');
        const nhapMK = document.getElementById('txtPass');
        const nutHienNhapLaiMK = document.getElementById('toggleRePassword');
        const nhapLaiMK = document.getElementById('txtRePass');

        if (nutHienMK && nhapMK) {
            nutHienMK.addEventListener('click', function() {
                const kieuNhap = nhapMK.getAttribute('type') === 'password' ? 'text' : 'password';
                nhapMK.setAttribute('type', kieuNhap);

                const bieu = this.querySelector('i');
                bieu.classList.toggle('fa-eye');
                bieu.classList.toggle('fa-eye-slash');
            });
        }

        if (nutHienNhapLaiMK && nhapLaiMK) {
            nutHienNhapLaiMK.addEventListener('click', function() {
                const kieuNhap = nhapLaiMK.getAttribute('type') === 'password' ? 'text' : 'password';
                nhapLaiMK.setAttribute('type', kieuNhap);

                const bieu = this.querySelector('i');
                bieu.classList.toggle('fa-eye');
                bieu.classList.toggle('fa-eye-slash');
            });
        }

        const formDK = document.getElementById('register-form');

        if (formDK) {
            formDK.addEventListener('submit', function(e) {
                let hopLe = true;
                const nhapTen = document.getElementById('txtName');
                const nhapEmail = document.getElementById('txtEmail');
                const nhapMK = document.getElementById('txtPass');
                const nhapLaiMK = document.getElementById('txtRePass');
                const nhapSDT = document.getElementById('txtPhone');
                const nutDongY = document.getElementById('agree');

                if (!nhapTen.value.trim()) {
                    hopLe = false;
                    hienThiLoi(nhapTen, 'Vui lòng nhập tên đăng nhập');
                } else if (nhapTen.value.trim().length < 3) {
                    hopLe = false;
                    hienThiLoi(nhapTen, 'Tên đăng nhập phải có ít nhất 3 ký tự');
                } else {
                    anLoi(nhapTen);
                }

                if (!nhapEmail.value.trim()) {
                    hopLe = false;
                    hienThiLoi(nhapEmail, 'Vui lòng nhập email');
                } else if (!kiemTraEmail(nhapEmail.value.trim())) {
                    hopLe = false;
                    hienThiLoi(nhapEmail, 'Email không hợp lệ');
                } else {
                    anLoi(nhapEmail);
                }

                if (!nhapMK.value.trim()) {
                    hopLe = false;
                    hienThiLoi(nhapMK, 'Vui lòng nhập mật khẩu');
                } else if (nhapMK.value.trim().length < 6) {
                    hopLe = false;
                    hienThiLoi(nhapMK, 'Mật khẩu phải có ít nhất 6 ký tự');
                } else {
                    anLoi(nhapMK);
                }

                if (!nhapLaiMK.value.trim()) {
                    hopLe = false;
                    hienThiLoi(nhapLaiMK, 'Vui lòng nhập lại mật khẩu');
                } else if (nhapLaiMK.value.trim() !== nhapMK.value.trim()) {
                    hopLe = false;
                    hienThiLoi(nhapLaiMK, 'Mật khẩu không khớp');
                } else {
                    anLoi(nhapLaiMK);
                }

                if (nhapSDT.value.trim() && !kiemTraSDT(nhapSDT.value.trim())) {
                    hopLe = false;
                    hienThiLoi(nhapSDT, 'Số điện thoại không hợp lệ');
                } else {
                    anLoi(nhapSDT);
                }

                if (!nutDongY.checked) {
                    hopLe = false;
                    hienThiLoiCheckbox(nutDongY, 'Bạn phải đồng ý với điều khoản sử dụng');
                } else {
                    anLoiCheckbox(nutDongY);
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

        function hienThiLoiCheckbox(checkbox, thongBao) {
            const nhomCheckbox = checkbox.closest('.checkbox-group');
            let phanTuLoi = nhomCheckbox.querySelector('.input-error');

            if (!phanTuLoi) {
                phanTuLoi = document.createElement('div');
                phanTuLoi.className = 'input-error';
                nhomCheckbox.appendChild(phanTuLoi);
            }

            phanTuLoi.textContent = thongBao;
            nhomCheckbox.classList.add('has-error');
        }

        function anLoiCheckbox(checkbox) {
            const nhomCheckbox = checkbox.closest('.checkbox-group');
            const phanTuLoi = nhomCheckbox.querySelector('.input-error');

            if (phanTuLoi) {
                phanTuLoi.textContent = '';
            }

            nhomCheckbox.classList.remove('has-error');
        }

        function kiemTraEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email.toLowerCase());
        }

        function kiemTraSDT(sdt) {
            const re = /^[0-9]{10,11}$/;
            return re.test(sdt);
        }
    });
</script>

<?php
require_once('layouts/client/footer.php');
ob_end_flush();
?>