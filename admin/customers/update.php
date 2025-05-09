<?php
require_once("../../config/database.php");
require_once("../../layouts/admin/header.php");

$id = $_GET['id'];

$sql = "select * from khachhang where makh = $id";
$kq = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($kq);

if(isset($_GET["btnCapnhat"])) {
    $makh = $_GET['txtMakh'];
    $ten = $_GET['txtTen'];
    $email = $_GET['txtEmail'];
    $pass = $_GET['txtPass'];
    $vaitro = $_GET['sltVaitro'];

    $sql = "update khachhang set makh='$makh', tenkh='$ten', email='$email', matkhau='$pass', vaitro='$vaitro' where id=$id";
    $kq = mysqli_query($conn, $sql);

    if($kq) {
        mysqli_close($conn);
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
					<input type="text" required name="txtMakh">
				</td>
			</tr>
			<tr>
				<td>Tên khách hàng</td>
				<td>
					<input type="text" required name="txtTen">
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>
					<input type="text" name="txtEmail" required>
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
						<option value="Admin">Admin</option>
						<option value="User">User</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" value="Thêm" name="btnThem">
				</td>
				<td>
					<input type="reset" value="Hủy" name="btnHuy">
				</td>
			</tr>
		</table>
	</form>
</body>
</html>