<?php
require_once("../../config/database.php");
require_once("../../layouts/admin/header.php");

$thongBao = "";
$loaiThongBao = "";

if (isset($_POST['btnThem'])) {
	$maTH = $_POST['txtMaTH'];
	$tenTH = $_POST['txtTenTH'];
	$moTa = $_POST['txtMoTa'];
	$tenHinhAnh = "";

	// Handle file upload
	if (isset($_FILES['HinhAnh']) && $_FILES['HinhAnh']['error'] == 0) {
		$uploadDir = "../../assets/images/products/";
		if (!is_dir($uploadDir)) {
			mkdir($uploadDir, 0755, true);
		}
		$fileInfo = pathinfo($_FILES['HinhAnh']['name']);
		$fileExt = strtolower($fileInfo['extension']);
		$allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
		if (in_array($fileExt, $allowedExt)) {
			$tenHinhAnh = uniqid('brand_') . "." . $fileExt;
			$uploadPath = $uploadDir . $tenHinhAnh;
			if (!move_uploaded_file($_FILES['HinhAnh']['tmp_name'], $uploadPath)) {
				$thongBao = "Không thể upload hình ảnh!";
				$loaiThongBao = "danger";
			}
		} else {
			$thongBao = "Chỉ chấp nhận file hình ảnh (jpg, jpeg, png, gif, webp)!";
			$loaiThongBao = "danger";
		}
	}

	if ($thongBao === "") {
		$sql = "INSERT INTO ThuongHieu(MaTH, TenTH, HinhAnh, MoTa) VALUES('$maTH', '$tenTH', '$tenHinhAnh', '$moTa')";
		$kq = mysqli_query($conn, $sql);
		if ($kq) {
			header("Location: brands.php");
			exit();
		} else {
			$thongBao = "Thêm thương hiệu không thành công! " . mysqli_error($conn);
			$loaiThongBao = "danger";
		}
	}
}
?>
<div class="container">
	<div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
		<ul class="breadcrumb">
			<li><a href="../index.php"><i class="fas fa-home"></i> Dashboard</a></li>
			<li><a href="index.php"><i class="fas fa-tags"></i> Quản lý thương hiệu</a></li>
			<li class="active"><i class="fas fa-plus"></i> Thêm thương hiệu</li>
		</ul>
	</div>
	<div class="table-header">
		<a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
	</div>
	<h2>Thêm thương hiệu mới</h2>
	<?php if ($thongBao): ?>
		<div class="alert alert-<?php echo $loaiThongBao; ?>"><?php echo $thongBao; ?></div>
	<?php endif; ?>
	<form method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Mã thương hiệu</td>
				<td>
					<input type="text" required name="txtMaTH" >
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
					<input type="file" name="HinhAnh" accept="image/*" required>
					<p>Chấp nhận các định dạng: jpg, jpeg, png, gif, webp</p>
				</td>
			</tr>
			<tr>
				<td>Mô tả</td>
				<td>
					<input type="text" name="txtMoTa" required>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="table-button">
						<input type="submit" value="Thêm thương hiệu" name="btnThem" class="btn btn-primary">
					</div>
				</td>
			</tr>
		</table>
	</form>
</div>
