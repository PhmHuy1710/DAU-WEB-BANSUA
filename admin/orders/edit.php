<?php
require_once("../../layouts/admin/header.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}


$maHD = $_GET['id'];

$sql = "SELECT hoadon.*, khachhang.tenKH, khachhang.SoDienThoai, hoadon.DiaChi, hoadon.TongTienGoc, hoadon.TongTien 
    FROM hoadon 
    JOIN khachhang ON hoadon.MaKH = khachhang.MaKH 
    WHERE hoadon.MaHD = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $maHD);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) == 0) {
    echo "<div class='alert alert-danger'>Không tìm thấy hóa đơn!</div>";
    exit();
}

$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "<div class='alert alert-danger'>Không tìm thấy dữ liệu hóa đơn!</div>";
    exit();
}



if (isset($_POST['btnCapNhat'])) {
    $TrangThai = $_POST['TrangThai'];
    $sql = "UPDATE hoadon SET 
        TrangThai = ?
        WHERE MaHD = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $TrangThai, $maHD);
    $kq = mysqli_stmt_execute($stmt);
}

?>
<?php if (!empty($thongBao)): ?>
    <div class="alert alert-<?php echo $loaiThongBao; ?>">
        <?php echo $thongBao; ?>
    </div>
<?php endif; ?>
<div class="section-heading">
    <h2>Sửa hóa đơn</h2>
    <p>Mã hóa đơn <?php echo $maHD; ?></p>
</div>
<div class="container">
	<div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
		<ul class="breadcrumb">
			<li><a href="../index.php"><i class="fas fa-home"></i> Dashboard</a></li>
			<li><a href="index.php"><i class="fas fa-shopping-cart"></i></i>Quản lý hóa đơn</a></li>
			<li class="active"><i class="fas fa-plus"></i> Sửa hóa đơn</li>
		</ul>
	</div>
	<div class="table-header">
		<a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
	</div>
    <form method="post" enctype="multipart/form-data">
        <table class="table-form fade-in">
            <tr>
                <td><label for="TenNguoiNhan">Tên người nhận</label></td>
                <td>
                    <?php echo ($row['TenNguoiNhan'] ?? ''); ?>
                </td>
            </tr>
            <tr>
                <td><label for="diachi">Địa chỉ</label></td>
                <td>
                    <?php echo ($row['DiaChi'] ?? ''); ?>
                </td>
            </tr>
            <tr>
                <td><label for="SoDienThoai">Số điện thoại</label></td>
                <td>
                    <?php echo ($row['SoDienThoai'] ?? ''); ?>
                </td>
            </tr>
            <tr>
                <td><label for="TongTienGoc">Tổng tiền góc</label></td>
                <td>
                    <?php 
                        $TongTienGoc = isset($row['TongTienGoc']) && is_numeric($row['TongTienGoc']) ? $row['TongTienGoc'] : 0;
                        echo number_format($TongTienGoc, 0, ',', '.') . ' VNĐ';
                    ?>
                </td>
            </tr>
            <tr>
                <td><label for="TongTien">Tổng tiền</label></td>
                <td>
                    <?php 
                        $tongTien = isset($row['TongTien']) && is_numeric($row['TongTien']) ? $row['TongTien'] : 0;
                        echo number_format($tongTien, 0, ',', '.') . ' VNĐ';
                    ?>
                </td>
            </tr>
            <tr>
                <td><label for="TrangThai">Trạng thái</label></td>
                <td>
                    <select class="table-select" id="TrangThai" name="TrangThai" required>
                        <option value="cho_duyet" <?php echo ((isset($_POST['TrangThai']) ? $_POST['TrangThai'] : $row['TrangThai']) == 'cho_duyet') ? 'selected' : ''; ?>>Chờ duyệt</option>
                        <option value="dang_xu_ly" <?php echo ((isset($_POST['TrangThai']) ? $_POST['TrangThai'] : $row['TrangThai']) == 'dang_xu_ly') ? 'selected' : ''; ?>>Đang xử lý</option>
                        <option value="dang_giao" <?php echo ((isset($_POST['TrangThai']) ? $_POST['TrangThai'] : $row['TrangThai']) == 'dang_giao') ? 'selected' : ''; ?>>Đang giao</option>
                        <option value="da_giao" <?php echo ((isset($_POST['TrangThai']) ? $_POST['TrangThai'] : $row['TrangThai']) == 'da_giao') ? 'selected' : ''; ?>>Đã giao</option>
                        <option value="da_huy" <?php echo ((isset($_POST['TrangThai']) ? $_POST['TrangThai'] : $row['TrangThai']) == 'da_huy') ? 'selected' : ''; ?>>Đã huỷ</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2">
					<div class="table-button">
						<input type="submit" value="Cập nhật" name="btnCapNhat" class="btn btn-primary">
					</div>
				</td>
            </tr>
        </table>
    </form>
</div>

<style>
    .product-image {
        max-width: 150px;
        max-height: 150px;
        object-fit: contain;
        border: 1px solid #ddd;
        margin-top: 10px;
    }

    .current-image {
        margin-top: 10px;
    }

    .form-hint {
        font-size: 0.8rem;
        color: #666;
        margin-top: 5px;
    }

    .alert {
        padding: 10px 15px;
        margin-bottom: 15px;
        border-radius: 4px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>