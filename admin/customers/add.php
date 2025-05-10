<?php
require_once("../../config/database.php");
require_once("../../layouts/admin/header.php");


if (isset($_POST['btnThem'])) {
    $makh = $_POST['txtMakh'];
    $ten = $_POST['txtTen'];
    $email = $_POST['txtEmail'];
    $pass = $_POST['txtPass'];
    $vaitro = $_POST['sltVaitro'];

    $sql = "INSERT INTO khachhang(makh, tenkh, email, matkhau, vaitro) VALUES('$makh', '$ten', '$email', '$pass', '$vaitro')";
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
	<h2>Thêm khách hàng mới</h2>
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