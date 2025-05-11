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

	if (isset($_FILES['HinhAnh']) && $_FILES['HinhAnh']['error'] == 0) {
		$uploadDir = "../../assets/images/brands/";
		if (!is_dir($uploadDir)) {
			mkdir($uploadDir, 0755, true);
		}

		$tenFile = $_FILES['HinhAnh']['name'];
		$fileExt = strtolower(pathinfo($tenFile, PATHINFO_EXTENSION));
		$choPhep = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

		if (in_array($fileExt, $choPhep)) {
			$tenHinhAnh = $maTH . '.' . $fileExt;
			$duongDanFile = $uploadDir . $tenHinhAnh;

			if (move_uploaded_file($_FILES['HinhAnh']['tmp_name'], $duongDanFile)) {
			} else {
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
			header("Location: index.php");
			$thongBao = "Thêm sản phẩm thành công! Mã sản phẩm: " . $maTH;
			$loaiThongBao = "success";
			exit();
		} else {
			$thongBao = "Thêm thương hiệu không thành công! " . mysqli_error($conn);
			$loaiThongBao = "danger";
		}
	}
}
?>
<div class="section-heading fade-in">
	<h2>Thêm mới thương hiệu</h2>
</div>

<?php if (!empty($thongBao)): ?>
	<div class="alert alert-<?php echo $loaiThongBao; ?>">
		<?php echo $thongBao; ?>
	</div>
<?php endif; ?>
<div class="container">
	<div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
		<ul class="breadcrumb">
			<li><a href="../index.php"><i class="fas fa-home"></i> Dashboard</a></li>
			<li><a href="index.php"><i class="fas fa-building"></i>Quản lý thương hiệu</a></li>
			<li class="active"><i class="fas fa-plus"></i> Thêm thương hiệu</li>
		</ul>
	</div>
	<div class="table-header fade-in" style="animation-delay: 0.1s;">
		<a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
	</div>
	<?php if ($thongBao): ?>
		<div class="alert alert-<?php echo $loaiThongBao; ?>"><?php echo $thongBao; ?></div>
	<?php endif; ?>
	<form method="post" enctype="multipart/form-data">
		<table class="table-form fade-in">
			<tr>
				<td><label for="txtMaTH">Mã thương hiệu<span class="required">*</span></td>
				<td>
					<input type="text" required name="txtMaTH" id="txtMaTH">
				</td>
			</tr>
			<tr>
				<td><label for="txtTenTH">Tên thương hiệu<span class="required">*</span></label></td>
				<td>
					<input type="text" required name="txtTenTH" id="txtTenTH">
				</td>
				</td>
			</tr>
			<tr>
				<td><label for="HinhAnh">Hình ảnh<span class="required">*</span></td>
				<td>
					<input type="file" id="HinhAnh" name="HinhAnh" accept="image/*" required>
					<p>Chấp nhận các định dạng: jpg, jpeg, png, gif, webp</p>
				</td>
			</tr>
			<tr>
				<td><label for="txtMoTa">Mô tả<span class="required">*</span></td>
				<td>
					<input type="text" id="txtMoTa" name="txtMoTa" required>
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