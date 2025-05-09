<?php
require_once("../config/database.php");
require_once("../layouts/admin/header.php");


if (isset($_POST['btnThem'])) {
    $masp= $_POST['txtMasp'];
    $tensp = $_POST['txtTen'];
    $mth = $_POST['txtMth'];
    $mth = $_POST['txtTl'];
    $gia = $_POST['txtGia'];
    $trangthai = $_POST['Trangthai'];


    $sql = "insert into sanpham(MaSP, TenSP, MaTH, TrongLuong, Gia, TrangThai) 
            values('$masp', '$tensp', '$mth', '$tl', '$gia', '$trangthai')";
    $kq = mysqli_query($conn, $sql);

    if ($kq) {
        header("Location: products.php");
        exit();
    } else {
        echo "Thêm sản phẩm không thành công !" . mysqli_error($conn);
    }
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thêm mới Sản phẩm</title>
</head>
<body>
	<form method="post">
		<table>
            <tr>
				<td>Mã sản phẩm</td>
				<td>
					<input type="text" required name="txtMasp">
				</td>
			</tr>
			<tr>
				<td>Tên sản phẩm</td>
				<td>
					<input type="text" required name="txtTen">
				</td>
			</tr>
			<tr>
				<td>Mã thương hiệu</td>
				<td>
					<input type="text" name="txtMth" required>
				</td>
			</tr>
            <tr>
				<td>Trọng lượng</td>
				<td>
					<input type="text" name="txtTl" required>
				</td>
			</tr>
            <tr>
                <td>Giá</td>
                <td>
                    <input type="text" name="txtGia" required>
                </td>

			<tr>
				<td>Trạng thái</td>
				<td>
					<select name="Trangthai">
						<option value="Còn hàng">Còn hàng</option>
						<option value="Hết hàng">Hết hàng</option>
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