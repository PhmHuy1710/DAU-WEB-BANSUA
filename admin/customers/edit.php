<?php
require_once("../../config/database.php");
require_once("../../layouts/admin/header.php");

$id = $_GET['id'];

$sql = "select * from khachhang where makh = '$id'";
$kq = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($kq);

if (isset($_GET["btnCapnhat"])) {
	$makh = $_GET['txtMakh'];
	$ten = $_GET['txtTen'];
	$email = $_GET['txtEmail'];
	$pass = password_hash($_GET['txtPass'], PASSWORD_DEFAULT);
	$vaitro = $_GET['sltVaitro'];

	$sql = "update khachhang set MaKH='$makh', TenKH='$ten', Email='$email', MatKhau='$pass', VaiTro='$vaitro' where MaKH='$id'";
	$kq = mysqli_query($conn, $sql);

	if ($kq) {
		mysqli_close($conn);
		echo "Cập nhật thành công!";
		header("location: index.php");
	} else {
		echo "Cập nhật dữ liệu thất bại!" . mysqli_error($conn);
	}
}


?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cập nhật khách hàng</title>
</head>

<body>
	<h2>Sửa khách hàng</h2>
	<form method="post">
		<table>
			<tr>
				<td>Mã khách hàng</td>
				<td>
					<input type="text" required name="txtMakh" value="<?php echo $row['MaKH']; ?>">
				</td>
			</tr>
			<tr>
				<td>Tên khách hàng</td>
				<td>
					<input type="text" required name="txtTen" value="<?php echo $row['TenKH']; ?>">
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>
					<input type="text" name="txtEmail" required value="<?php echo $row['Email']; ?>">
				</td>
			</tr>
			<tr>
				<td>Mật khẩu</td>
				<td>
					<input type="text" name="txtPass" required>
				</td>
			</tr>
			<tr>
				<td>Vai trò</td>
				<td>
					<select name="sltVaitro">
						<option value="Admin" <?php echo $row['VaiTro'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
						<option value="User" <?php echo $row['VaiTro'] == 'User' ? 'selected' : ''; ?>>User</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" value="Đồng ý" name="btnCapNhat">
				</td>
				<td>
					<a href="index.php" class="btn btn-secondary">Hủy</a>
				</td>
			</tr>
		</table>
	</form>
</body>

</html>