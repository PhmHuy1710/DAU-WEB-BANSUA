<?php
require_once("../../layouts/admin/header.php");


if (isset($_POST['btnThem'])) {
	$masp = $_POST['txtMasp'];
	$tensp = $_POST['txtTen'];
	$madm = $_POST['txtMadm'];
	$mth = $_POST['txtMth'];
	$tl = $_POST['txtTl'];
	$gia = $_POST['txtGia'];
	$trangthai = $_POST['Trangthai'];


	$sql = "INSERT INTO sanpham(MaSP, TenSP, MaDM, MaTH, TrongLuong, Gia, TrangThai) 
            VALUES(?, ?, ?, ?, ?, ?, ?)";

	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, "ssssisd", $masp, $tensp, $madm, $mth, $tl, $gia, $trangthai);
	$kq = mysqli_stmt_execute($stmt);

	if ($kq) {
		header("Location: products.php");
		exit();
	} else {
		echo "Thêm sản phẩm không thành công! " . mysqli_error($conn);
	}
}

// Lấy danh sách danh mục
$sqlDM = "SELECT MaDM, TenDM FROM danhmuc ORDER BY TenDM";
$resultDM = mysqli_query($conn, $sqlDM);

// Lấy danh sách thương hiệu
$sqlTH = "SELECT MaTH, TenTH FROM thuonghieu ORDER BY TenTH";
$resultTH = mysqli_query($conn, $sqlTH);

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thêm mới Sản phẩm</title>
</head>

<body>
	<div class="admin-content">
		<div class="section-heading">
			<h2>Thêm mới Sản phẩm</h2>
		</div>

		<div class="data-table-container">
			<div class="data-table-header">
				<h3 class="data-table-title">Nhập thông tin sản phẩm</h3>
			</div>

			<form method="post">
				<table>
					<tr>
						<td>Mã sản phẩm</td>
						<td>
							<input type="text" required name="txtMasp" placeholder="Nhập mã sản phẩm">
						</td>
					</tr>
					<tr>
						<td>Tên sản phẩm</td>
						<td>
							<input type="text" required name="txtTen" placeholder="Nhập tên sản phẩm">
						</td>
					</tr>
					<tr>
						<td>Danh mục</td>
						<td>
							<select name="txtMadm" required>
								<option value="">-- Chọn danh mục --</option>
								<?php while ($dm = mysqli_fetch_assoc($resultDM)) : ?>
									<option value="<?php echo $dm['MaDM']; ?>"><?php echo $dm['TenDM']; ?></option>
								<?php endwhile; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Thương hiệu</td>
						<td>
							<select name="txtMth" required>
								<option value="">-- Chọn thương hiệu --</option>
								<?php while ($th = mysqli_fetch_assoc($resultTH)) : ?>
									<option value="<?php echo $th['MaTH']; ?>"><?php echo $th['TenTH']; ?></option>
								<?php endwhile; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Trọng lượng</td>
						<td>
							<input type="number" name="txtTl" required placeholder="Nhập trọng lượng">
						</td>
					</tr>
					<tr>
						<td>Giá</td>
						<td>
							<input type="number" name="txtGia" required placeholder="Nhập giá sản phẩm">
						</td>
					</tr>
					<tr>
						<td>Trạng thái</td>
						<td>
							<select name="Trangthai">
								<option value="con_hang">Còn hàng</option>
								<option value="het_hang">Hết hàng</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" value="Thêm" name="btnThem" class="btnThem">
						</td>
						<td>
							<input type="reset" value="Hủy" name="btnHuy">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>

</html>