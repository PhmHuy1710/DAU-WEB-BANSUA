<?php
require_once("../../config/database.php");
require_once("../../layouts/admin/header.php");


if (isset($_POST['btnThem'])) {
    $maTH = $_POST['txtMaTH'];
    $tenTH = $_POST['txtTenTH'];
    $hinhAnh = $_POST['txtHinhAnh'];
    $moTa = $_POST['txtMoTa'];

    $sql = "INSERT INTO ThuongHieu(MaTH, TenTH, HinhAnh, MoTa) VALUES('$maTH', '$tenTH', '$hinhAnh', '$moTa')";
    $kq = mysqli_query($conn, $sql);

    if ($kq) {
        header("Location: brands.php");
        exit();
    } else {
        echo "Thêm thương hiệu không thành công !" . mysqli_error($conn);
    }
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thêm mới thương hiệu</title>
</head>
<body>
	<h2>Thêm thương hiệu mới</h2>
	<form method="post">
		<table>
            <tr>
				<td>Mã thương hiệu</td>
				<td>
					<input type="text" required name="txtMaTH">
				</td>
			</tr>
			<tr>
				<td>Tên thương hiệu</td>
				<td>
					<input type="text" required name="txtTenTH">
				</td>
			</tr>
			<tr>
				<td>Hình ảnh</td>
				<td>
					<input type="text" name="txtHinhAnh" required>
				</td>
			</tr>
			<tr>
				<td>Mô tả</td>
				<td>
					<input type="text" name="txtMoTa" required>
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