<?php
require_once("../../layouts/admin/header.php");

function randomMaSP($maTH, $conn)
{
	$soNgauNhien = rand(10, 99);
	$maSP = $maTH . $soNgauNhien;

	$sql = "SELECT COUNT(*) AS dem FROM sanpham WHERE MaSP = ?";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, "s", $maSP);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_assoc($result);

	if ($row['dem'] > 0) {
		return randomMaSP($maTH, $conn);
	}

	return $maSP;
}

$thongBao = '';
$loaiThongBao = '';

if (isset($_POST['btnThem'])) {
	$tensp = trim($_POST['txtTen']);
	$madm = trim($_POST['txtMadm']);
	$mth = trim($_POST['txtMth']);
	$tl = trim($_POST['txtTl']);
	$gia = trim($_POST['txtGia']);
	$soluong = trim($_POST['SoLuong']);
	$donvi = trim($_POST['DonVi']);
	$trangthai = isset($_POST['TrangThai']) ? trim($_POST['TrangThai']) : 'con_hang';
	$mota = isset($_POST['MoTa']) ? trim($_POST['MoTa']) : '';

	$masp = randomMaSP($mth, $conn);

	$tenHinhAnh = "";

	if (isset($_FILES['HinhAnh']) && $_FILES['HinhAnh']['error'] == 0) {
		$uploadDir = "../../assets/images/products/";

		if (!is_dir($uploadDir)) {
			mkdir($uploadDir, 0755, true);
		}

		$fileInfo = pathinfo($_FILES['HinhAnh']['name']);
		$fileExt = strtolower($fileInfo['extension']);
		$allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

		if (in_array($fileExt, $allowedExt)) {
			$tenHinhAnh = $masp . "." . $fileExt;
			$uploadPath = $uploadDir . $tenHinhAnh;

			if (move_uploaded_file($_FILES['HinhAnh']['tmp_name'], $uploadPath)) {
			} else {
				$thongBao = "Không thể upload hình ảnh!";
				$loaiThongBao = "danger";
			}
		} else {
			$thongBao = "Chỉ chấp nhận file hình ảnh (jpg, jpeg, png, gif, webp)!";
			$loaiThongBao = "danger";
		}
	}

	if (empty($thongBao)) {
		$sql = "INSERT INTO sanpham(MaSP, TenSP, MaDM, MaTH, TrongLuong, DonVi, Gia, HinhAnh, SoLuong, TrangThai, MoTa) 
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_bind_param($stmt, "ssssssdsiss", $masp, $tensp, $madm, $mth, $tl, $donvi, $gia, $tenHinhAnh, $soluong, $trangthai, $mota);
		$kq = mysqli_stmt_execute($stmt);

		if ($kq) {
			$thongBao = "Thêm sản phẩm thành công! Mã sản phẩm: " . $masp;
			$loaiThongBao = "success";
			$_POST = array();
		} else {
			$thongBao = "Thêm sản phẩm không thành công! " . mysqli_error($conn);
			$loaiThongBao = "danger";
		}
	}
}

$sqlDM = "SELECT MaDM, TenDM FROM danhmuc ORDER BY TenDM";
$resultDM = mysqli_query($conn, $sqlDM);

$sqlTH = "SELECT MaTH, TenTH FROM thuonghieu ORDER BY TenTH";
$resultTH = mysqli_query($conn, $sqlTH);
?>

<div class="section-heading">
	<h2>Thêm mới Sản phẩm</h2>
	<p>Mã sản phẩm sẽ được tạo tự động dựa vào mã thương hiệu</p>
</div>

<?php if (!empty($thongBao)): ?>
	<div class="alert alert-<?php echo $loaiThongBao; ?>">
		<?php echo $thongBao; ?>
	</div>
<?php endif; ?>

<div class="data-table-container">
	<div class="data-table-header">
		<h3 class="data-table-title">Nhập thông tin sản phẩm</h3>
		<div class="data-table-actions">
			<a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
		</div>
	</div>

	<form method="post" enctype="multipart/form-data">
		<table class="form-table">
			<tr>
				<td><label for="txtTen">Tên sản phẩm <span class="required">*</span></label></td>
				<td>
					<input type="text" id="txtTen" required name="txtTen" value="<?php echo isset($_POST['txtTen']) ? htmlspecialchars($_POST['txtTen']) : ''; ?>" placeholder="Nhập tên sản phẩm">
				</td>
			</tr>
			<tr>
				<td><label for="txtMadm">Danh mục <span class="required">*</span></label></td>
				<td>
					<select id="txtMadm" name="txtMadm" required>
						<option value="">-- Chọn danh mục --</option>
						<?php while ($dm = mysqli_fetch_assoc($resultDM)) : ?>
							<option value="<?php echo $dm['MaDM']; ?>" <?php echo (isset($_POST['txtMadm']) && $_POST['txtMadm'] == $dm['MaDM']) ? 'selected' : ''; ?>>
								<?php echo htmlspecialchars($dm['TenDM']); ?>
							</option>
						<?php endwhile; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="txtMth">Thương hiệu <span class="required">*</span></label></td>
				<td>
					<select id="txtMth" name="txtMth" required>
						<option value="">-- Chọn thương hiệu --</option>
						<?php while ($th = mysqli_fetch_assoc($resultTH)) : ?>
							<option value="<?php echo $th['MaTH']; ?>" <?php echo (isset($_POST['txtMth']) && $_POST['txtMth'] == $th['MaTH']) ? 'selected' : ''; ?>>
								<?php echo htmlspecialchars($th['TenTH']); ?>
							</option>
						<?php endwhile; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="txtTl">Trọng lượng <span class="required">*</span></label></td>
				<td>
					<input type="number" id="txtTl" name="txtTl" required value="<?php echo isset($_POST['txtTl']) ? htmlspecialchars($_POST['txtTl']) : ''; ?>" placeholder="Nhập trọng lượng (số)">
				</td>
			</tr>
			<tr>
				<td><label for="DonVi">Đơn vị <span class="required">*</span></label></td>
				<td>
					<select id="DonVi" name="DonVi" required>
						<option value="g" <?php echo (isset($_POST['DonVi']) && $_POST['DonVi'] == 'g') ? 'selected' : ''; ?>>g</option>
						<option value="ml" <?php echo (isset($_POST['DonVi']) && $_POST['DonVi'] == 'ml') ? 'selected' : ''; ?>>ml</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="txtGia">Giá <span class="required">*</span></label></td>
				<td>
					<input type="number" id="txtGia" name="txtGia" required value="<?php echo isset($_POST['txtGia']) ? htmlspecialchars($_POST['txtGia']) : ''; ?>" placeholder="Nhập giá sản phẩm (số)">
				</td>
			</tr>
			<tr>
				<td><label for="MoTa">Mô tả</label></td>
				<td>
					<textarea id="MoTa" name="MoTa" rows="4" placeholder="Nhập mô tả sản phẩm"><?php echo isset($_POST['MoTa']) ? htmlspecialchars($_POST['MoTa']) : ''; ?></textarea>
				</td>
			</tr>
			<tr>
				<td><label for="HinhAnh">Hình ảnh</label></td>
				<td>
					<input type="file" id="HinhAnh" name="HinhAnh" accept="image/*">
					<p class="form-hint">Chấp nhận các định dạng: jpg, jpeg, png, gif, webp</p>
				</td>
			</tr>
			<tr>
				<td><label for="SoLuong">Số lượng <span class="required">*</span></label></td>
				<td>
					<input type="number" id="SoLuong" name="SoLuong" required value="<?php echo isset($_POST['SoLuong']) ? htmlspecialchars($_POST['SoLuong']) : ''; ?>" placeholder="Nhập số lượng sản phẩm (số)">
				</td>
			</tr>
			<tr>
				<td><label for="TrangThai">Trạng thái</label></td>
				<td>
					<select id="TrangThai" name="TrangThai">
						<option value="con_hang" <?php echo (isset($_POST['TrangThai']) && $_POST['TrangThai'] == 'con_hang') ? 'selected' : ''; ?>>Còn hàng</option>
						<option value="het_hang" <?php echo (isset($_POST['TrangThai']) && $_POST['TrangThai'] == 'het_hang') ? 'selected' : ''; ?>>Hết hàng</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="form-buttons">
					<input type="submit" value="Thêm sản phẩm" name="btnThem" class="btn btn-primary">
					<input type="reset" value="Nhập lại" name="btnHuy" class="btn btn-secondary">
					<a href="index.php" class="btn btn-outline">Hủy</a>
				</td>
			</tr>
		</table>
	</form>
</div>