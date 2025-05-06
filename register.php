<?php
require_once('layouts/header.php');
require_once('config/database.php');
require_once('config/config.php');
require_once('includes/session.php');

// Initialize error message variable
$error_message = '';

if (isset($_POST['btnRegister'])) {
    // Get form data
    $name = trim($_POST['txtName']);
    $email = trim($_POST['txtEmail']);
    $pass = trim($_POST['txtPass']);
    $repass = trim($_POST['txtRePass']);
    
    // Validate form data
    if (empty($name)) {
        $error_message = "Vui lòng nhập tên đăng nhập";
    } elseif (empty($email)) {
        $error_message = "Vui lòng nhập email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Email không hợp lệ";
    } elseif (empty($pass)) {
        $error_message = "Vui lòng nhập mật khẩu";
    } elseif (empty($repass)) {
        $error_message = "Vui lòng nhập lại mật khẩu";
    } elseif ($pass !== $repass) {
        $error_message = "Mật khẩu không khớp";
    } else {
        // Check if email already exists
        $check_sql = "SELECT * FROM KhachHang WHERE Email = ?";
        $check_stmt = mysqli_prepare($conn, $check_sql);
        mysqli_stmt_bind_param($check_stmt, "s", $email);
        mysqli_stmt_execute($check_stmt);
        $check_result = mysqli_stmt_get_result($check_stmt);
        
        if (mysqli_num_rows($check_result) > 0) {
            $error_message = "Email đã tồn tại trong hệ thống";
        } else {
            // Define variables for empty values
            $diaChi = '';
            $soDienThoai = '';
            $vaiTro = 'user';
            $avatar = '';
            
            // Insert new user
            $sql = "INSERT INTO KhachHang (TenKH, Email, MatKhau, DiaChi, SoDienThoai, VaiTro, Avatar, NgayTao, NgayCapNhat) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssssss", $name, $email, $pass, $diaChi, $soDienThoai, $vaiTro, $avatar);
            
            if (mysqli_stmt_execute($stmt)) {
                echo '<script>
                    alert("Đăng ký thành công");
                    window.location.href = "login.php";
                </script>';
                exit;
            } else {
                $error_message = "Đăng ký thất bại: " . mysqli_error($conn);
            }
            
            mysqli_stmt_close($stmt);
        }
        
        mysqli_stmt_close($check_stmt);
    }
}
?>
<!DOCTYPE html>
<html>
<head>	
	<title>Đăng ký</title>
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<style type="text/css">
		.form{
            margin: 0 auto;
            margin-top: 100px;
			width: 350px;
			/*height: 450px;*/
			padding: 20px;
			box-shadow: 0 0 10px 5px grey;
		}
		input{
			display: block;
			width: 100%;
			padding: 7px 5px;
			margin-top: 5px;
			margin-bottom: 15px;
			border-radius: 3px;
			border: 1px solid grey;
		}
		input[type="submit"]{
			background: #07A99F;
			color: white;
			border-radius: 5px;
			padding: 9px 5px;
			cursor: pointer;
			transition: 0.5s;
			margin-top: 25px;
			margin-bottom: 0;
		}
		input[type="submit"]:hover{
			opacity: 0.7;
		}
		input::placeholder{
			font-size: 12px;
		}
		.error-message {
			color: red;
			margin-top: 10px;
			margin-bottom: 10px;
		}
		.login-link {
			margin-top: 10px;
		}
	</style>		
</head>
<body>		
	<div class="container">
		<div class="form">
			<div class="title" style="text-align: center; margin-bottom: 25px;">
				<h2 style="margin-bottom: 12px;">THÀNH VIÊN ĐĂNG KÝ</h2>
				<p>Cùng nhau học lập trình miễn phí <i class='bx bxs-heart' style="color: red;"></i></p>
			</div>
			<form method="post">
				<label for="txtName">Tên đăng nhập <span style="color: red;">*</span></label>
				<input type="text" id="txtName" name="txtName" placeholder="Vd: Thanh Sơn" autocomplete="off" 
					value="<?php echo isset($_POST['txtName']) ? htmlspecialchars($_POST['txtName']) : ''; ?>">

				<label for="txtEmail">Email <span style="color: red;">*</span></label>
				<input type="email" id="txtEmail" name="txtEmail" placeholder="vd: abc@gmail.com" 
					value="<?php echo isset($_POST['txtEmail']) ? htmlspecialchars($_POST['txtEmail']) : ''; ?>">

				<label for="txtPass">Mật khẩu <span style="color: red;">*</span></label>
				<input type="password" id="txtPass" name="txtPass" placeholder="Nhập mật khẩu">

				<label for="txtRePass">Nhập lại mật khẩu <span style="color: red;">*</span></label>
				<input type="password" id="txtRePass" name="txtRePass" placeholder="Nhập lại mật khẩu">
				
				<?php if (!empty($error_message)): ?>
				<div class="error-message">
					<?php echo $error_message; ?>
				</div>
				<?php endif; ?>
				
				<div class="login-link">
					<a href="login.php">Đã có tài khoản? Đăng nhập</a>
				</div>

				<input type="submit" name="btnRegister" value="Đăng ký">
			</form>
		</div>
	</div>
</body>
</html>
