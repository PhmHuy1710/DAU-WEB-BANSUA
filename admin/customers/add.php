<?php
require_once("../../config/database.php");
require_once("../../layouts/admin/header.php");


if (isset($_POST['btnThem'])) {
	$maKH = $_POST['txtMakh'];
	$ten = $_POST['txtTen'];
	$email = $_POST['txtEmail'];
	$pass = password_hash($_POST['txtPass'], PASSWORD_DEFAULT);
	$vaitro = $_POST['sltVaitro'];

	$sql = "INSERT INTO khachhang(makh, tenkh, email, matkhau, vaitro) VALUES('$maKH', '$ten', '$email', '$pass', '$vaitro')";
	$kq = mysqli_query($conn, $sql);

	if ($kq) {
		header("Location: index.php");
		exit();
	} else {
		echo "Thêm khách hàng không thành công !" . mysqli_error($conn);
	}
}


?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thêm mới khách hàng</title>
</head>

<body>
	<div class="section-heading fade-in">
		<h2>Thêm mới khách hàng</h2>
	</div>

	<div class="container">
		<form method="post">
			<table class="table-form fade-in">
				<tr>
					<td>Mã khách hàng</td>
					<td>
						<input type="text" required name="txtMakh" placeholder="Nhập mã khách hàng mới">
					</td>
				</tr>
				<tr>
					<td>Tên khách hàng</td>
					<td>
						<input type="text" required name="txtTen" placeholder="Nhập tên khách hàng mới">
					</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>
						<input type="text" name="txtEmail" required placeholder="Nhập email ">
					</td>
				</tr>
				<tr>
					<td>Mật khẩu</td>
					<td>
						<input type="text" name="txtPass" required placeholder="Nhập mật khẩu">
					</td>
				</tr>
				<tr>
					<td>Vai trò</td>
					<td>
						<select name="sltVaitro">
							<option value="User">User</option>
							<option value="Admin">Admin</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" value="Thêm khách hàng" name="btnThem" class="btn btn-primary">
					</td>
					<td>
						<a href="index.php" class="btn btn-secondary">Quay lại</a>
					</td>
				</tr>
			</table>
		</form>
	</div>

</body>

</html>