<?php
require_once("../../config/database.php");
require_once("../../layouts/admin/header.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$maHD = $_GET['id'];

$sql = "SELECT * FROM hoadon WHERE MaHD = '$maHD'";
$kq = mysqli_query($conn, $sql);

if (mysqli_num_rows($kq) == 0) {
    echo "<div class='alert alert-danger'>Không tìm thấy hóa đơn!</div>";
    exit();
}

$hoaDon = mysqli_fetch_assoc($kq);

if (isset($_POST['btnCapNhat'])) {
    $trangThai = isset($_POST['sltTrangThai']) ? $_POST['sltTrangThai'] : $hoaDon['TrangThai'];
    $tenNguoiNhan = isset($_POST['txtTenNguoiNhan']) ? $_POST['txtTenNguoiNhan'] : $hoaDon['TenNguoiNhan'];
    $diaChi = isset($_POST['txtDiaChi']) ? $_POST['txtDiaChi'] : $hoaDon['DiaChi'];
    $soDienThoai = isset($_POST['txtSoDienThoai']) ? $_POST['txtSoDienThoai'] : $hoaDon['SoDienThoai'];
    $ghiChu = isset($_POST['txtGhiChu']) ? $_POST['txtGhiChu'] : $hoaDon['GhiChu'];

    $trangThaiHopLe = ['cho_duyet', 'dang_xu_ly', 'dang_giao', 'da_giao', 'da_huy'];
    if (!in_array($trangThai, $trangThaiHopLe)) {
        $trangThai = $hoaDon['TrangThai'];
    }

    $sql = "UPDATE hoadon SET 
            TrangThai = '$trangThai',
            TenNguoiNhan = '$tenNguoiNhan',
            DiaChi = '$diaChi',
            SoDienThoai = '$soDienThoai',
            GhiChu = '$ghiChu'
            WHERE MaHD = '$maHD'";

    $kq = mysqli_query($conn, $sql);

    if ($kq) {
        echo "<div class='alert alert-success'>Cập nhật đơn hàng thành công!</div>";
        $sql = "SELECT * FROM hoadon WHERE MaHD = '$maHD'";
        $kq = mysqli_query($conn, $sql);
        $hoaDon = mysqli_fetch_assoc($kq);
    } else {
        echo "<div class='alert alert-danger'></div>Cập nhật đơn hàng thất bại! Lỗi: " . mysqli_error($conn) . "</div>";
    }
}

$sqlChiTiet = "SELECT cthd.*, sp.TenSP 
               FROM chitiethoadon cthd 
               JOIN sanpham sp ON cthd.MaSP = sp.MaSP 
               WHERE cthd.MaHD = '$maHD'";
$kqChiTiet = mysqli_query($conn, $sqlChiTiet);
?>

<div class="section-heading">
    <h2>Sửa đơn hàng</h2>
    <p>Mã đơn hàng: <?php echo $maHD; ?></p>
</div>

<div class="container">
    <div class="breadcrumb-container fade-in">
        <ul class="breadcrumb">
            <li><a href="../index.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="index.php"><i class="fas fa-shopping-cart"></i> Quản lý đơn hàng</a></li>
            <li class="active"><i class="fas fa-edit"></i> Sửa đơn hàng</li>
        </ul>
    </div>

    <div class="table-header">
        <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
    </div>

    <form method="post">
        <table class="table-form fade-in">
            <tr>
                <td><label for="sltTrangThai">Trạng thái</label></td>
                <td>
                    <select name="sltTrangThai" id="sltTrangThai">
                        <option value="cho_duyet" <?php echo ($hoaDon['TrangThai'] == 'cho_duyet') ? 'selected' : ''; ?>>Chờ duyệt</option>
                        <option value="dang_xu_ly" <?php echo ($hoaDon['TrangThai'] == 'dang_xu_ly') ? 'selected' : ''; ?>>Đang xử lý</option>
                        <option value="dang_giao" <?php echo ($hoaDon['TrangThai'] == 'dang_giao') ? 'selected' : ''; ?>>Đang giao</option>
                        <option value="da_giao" <?php echo ($hoaDon['TrangThai'] == 'da_giao') ? 'selected' : ''; ?>>Đã giao</option>
                        <option value="da_huy" <?php echo ($hoaDon['TrangThai'] == 'da_huy') ? 'selected' : ''; ?>>Đã hủy</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="txtTenNguoiNhan">Tên người nhận</label></td>
                <td>
                    <input type="text" id="txtTenNguoiNhan" name="txtTenNguoiNhan" value="<?php echo $hoaDon['TenNguoiNhan']; ?>" disabled>
                </td>
            </tr>
            <tr>
                <td><label for="txtDiaChi">Địa chỉ</label></td>
                <td>
                    <textarea id="txtDiaChi" name="txtDiaChi" rows="3"><?php echo $hoaDon['DiaChi']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td><label for="txtSoDienThoai">Số điện thoại</label></td>
                <td>
                    <input type="text" id="txtSoDienThoai" name="txtSoDienThoai" value="<?php echo $hoaDon['SoDienThoai']; ?>">
                </td>
            </tr>
            <tr>
                <td><label for="txtGhiChu">Ghi chú</label></td>
                <td>
                    <textarea id="txtGhiChu" name="txtGhiChu" rows="3"><?php echo $hoaDon['GhiChu']; ?></textarea>
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

    <h3>Chi tiết đơn hàng</h3>
    <table class="data-table fade-in">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($chiTiet = mysqli_fetch_assoc($kqChiTiet)): ?>
                <tr>
                    <td><?php echo $chiTiet['TenSP']; ?></td>
                    <td><?php echo $chiTiet['SoLuong']; ?></td>
                    <td><?php echo number_format($chiTiet['Gia'], 0, ',', '.'); ?> đ</td>
                    <td><?php echo number_format($chiTiet['Gia'] * $chiTiet['SoLuong'], 0, ',', '.'); ?> đ</td>
                </tr>
            <?php endwhile; ?>
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Tổng tiền:</strong></td>
                <td><strong><?php echo number_format($hoaDon['TongTien'], 0, ',', '.'); ?> đ</strong></td>
            </tr>
        </tbody>
    </table>
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