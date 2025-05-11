<?php
require_once("../../layouts/admin/header.php");

function taoMaSanPham($maTH, $conn)
{
	$soRandom = rand(100, 999);
	$maSP = $maTH . $soRandom;

	$sql = "SELECT COUNT(*) AS dem FROM sanpham WHERE MaSP = '$maSP'";
	$ketQua = mysqli_query($conn, $sql);
	$dong = mysqli_fetch_assoc($ketQua);

	if ($dong['dem'] > 0) {
		return taoMaSanPham($maTH, $conn);
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
	$mota = isset($_POST['MoTa']) ? trim($_POST['MoTa']) : '';

	$masp = taoMaSanPham($mth, $conn);

	$tenAnh = "";

	if (isset($_FILES['HinhAnh']) && $_FILES['HinhAnh']['error'] == 0) {
		$upThuMuc = "../../assets/images/products/";

		if (!is_dir($upThuMuc)) {
			mkdir($upThuMuc, 0755, true);
		}

		$infoFile = pathinfo($_FILES['HinhAnh']['name']);
		$duoiFile = strtolower($infoFile['extension']);
		$allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

		if (in_array($duoiFile, $allowedExt)) {
			$tenAnh = $masp . "." . $duoiFile;
			$uploadPath = $upThuMuc . $tenAnh;

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
		$sql = "INSERT INTO sanpham(MaSP, TenSP, MaDM, MaTH, TrongLuong, DonVi, Gia, HinhAnh, SoLuong, MoTa) 
				VALUES('$masp', '$tensp', '$madm', '$mth', '$tl', '$donvi', $gia, '$tenAnh', $soluong, '$mota')";
		$kq = mysqli_query($conn, $sql);

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

<div class="section-heading fade-in">
	<h2>Thêm mới sản phẩm</h2>
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
			<li><a href="../products/index.php"><i class="fas fa-box"></i> Quản lý sản phẩm</a></li>
			<li class="active"><i class="fas fa-plus"></i> Thêm sản phẩm</li>
		</ul>
	</div>
	<div class="table-header fade-in">
		<a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
	</div>

	<form method="post" enctype="multipart/form-data">
		<table class="table-form fade-in">
			<tr>
				<td><label for="txtTen">Tên sản phẩm <span class="required">*</span></label></td>
				<td>
					<input type="text" id="txtTen" required name="txtTen" value="<?php echo isset($_POST['txtTen']) ? htmlspecialchars($_POST['txtTen']) : ''; ?>" placeholder="Nhập tên sản phẩm">
				</td>
			</tr>
			<tr>
				<td><label for="txtMadm">Danh mục <span class="required">*</span></label></td>
				<td>
					<select class="table-select" id="txtMadm" name="txtMadm" required>
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
					<select class="table-select" id="txtMth" name="txtMth" required>
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
					<select class="table-select" id="DonVi" name="DonVi" required>
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
					<p>Chấp nhận các định dạng: jpg, jpeg, png, gif, webp</p>
				</td>
			</tr>
			<tr>
				<td><label for="SoLuong">Số lượng <span class="required">*</span></label></td>
				<td>
					<input type="number" id="SoLuong" name="SoLuong" required value="<?php echo isset($_POST['SoLuong']) ? htmlspecialchars($_POST['SoLuong']) : ''; ?>" placeholder="Nhập số lượng sản phẩm (số)">
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<div class="table-button">
						<input type="submit" value="Thêm sản phẩm" name="btnThem" class="btn btn-primary">
					</div>

				</td>
			</tr>
		</table>
	</form>
</div>