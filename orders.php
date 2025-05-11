<?php
require_once('config/database.php');
require_once('config/config.php');
require_once('includes/session.php');

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

require_once('layouts/client/header.php');
$maKH = $_SESSION['user']['MaKH'];

$sql = "SELECT hd.MaHD, hd.TongTien, 
        CAST(hd.TrangThai AS CHAR) AS TrangThai, 
        hd.TenNguoiNhan, hd.DiaChi, hd.SoDienThoai, hd.GhiChu, hd.NgayTao
        FROM hoadon hd
        JOIN khachhang kh ON hd.MaKH = kh.MaKH
        WHERE hd.MaKH = '$maKH'
        ORDER BY hd.NgayTao DESC";
$result = mysqli_query($conn, $sql);

?>
<div class="container">
    <div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
        <ul class="breadcrumb">
            <li><a href="index.php"><i class="fas fa-home"></i> Trang chủ</a></li>
            <li class="active"><i class="fa-solid fa-file-invoice"></i> Đơn hàng</li>
        </ul>
    </div>
    <?php if (mysqli_num_rows($result) > 0) { ?>
        <div class="products-container" style="margin-top: 20px;">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="product-item fade-in" style="animation-delay: 0.3s;">
                    <div class="product-card">
                        <div class="product-content">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <h3 class="product-title">#<?php echo $row['MaHD']; ?></h3>
                                <?php
                                $TagTT = '';
                                $TextTT = '';
                                $trangThai = $row['TrangThai'];

                                switch ($trangThai) {
                                    case 'cho_duyet':
                                        $TagTT = 'bg-warning';
                                        $TextTT = 'Chờ xác nhận';
                                        break;
                                    case 'dang_xu_ly':
                                        $TagTT = 'bg-primary';
                                        $TextTT = 'Đang xử lý';
                                        break;
                                    case 'dang_giao':
                                        $TagTT = 'bg-info';
                                        $TextTT = 'Đang giao';
                                        break;
                                    case 'da_giao':
                                        $TagTT = 'bg-success';
                                        $TextTT = 'Đã giao';
                                        break;
                                    case 'da_huy':
                                        $TagTT = 'bg-danger';
                                        $TextTT = 'Đã hủy';
                                        break;
                                    default:
                                        $TagTT = 'bg-secondary';
                                        $TextTT = 'Không xác định (' . htmlspecialchars($trangThai) . ')';
                                }
                                ?>
                                <span class="badge <?php echo $TagTT; ?>" style="padding: 8px 12px; border-radius: 20px; color: white;"><?php echo $TextTT; ?></span>
                            </div>

                            <div class="product-info">
                                <p><i class="fa-solid fa-calendar"></i> Ngày đặt: <?php echo date('d/m/Y H:i', strtotime($row['NgayTao'])); ?></p>
                                <p><i class="fa-solid fa-user"></i> Người nhận: <?php echo $row['TenNguoiNhan']; ?></p>
                                <p><i class="fa-solid fa-phone"></i> SĐT: <?php echo $row['SoDienThoai']; ?></p>
                                <p><i class="fa-solid fa-location-dot"></i> Địa chỉ: <?php echo $row['DiaChi']; ?></p>
                                <?php if (!empty($row['GhiChu'])): ?>
                                    <p><i class="fa-solid fa-comment"></i> Ghi chú: <?php echo $row['GhiChu']; ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="product-price">
                                <?php echo number_format($row['TongTien'], 0, ',', '.'); ?> VNĐ
                            </div>

                            <div class="product-actions">
                                <a href="order-detail.php?id=<?php echo $row['MaHD']; ?>" class="action-btn btn-detail">
                                    <i class="fa-solid fa-circle-info"></i> Chi tiết
                                </a>
                                <?php if ($trangThai == 'cho_duyet') { ?>
                                    <a href="includes/orders/delete.php?id=<?php echo $row['MaHD']; ?>" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?');" class="action-btn btn-danger" style="background-color: var(--danger-color); color: white;">
                                        <i class="fa-solid fa-ban"></i> Hủy đơn
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="text-center" style="text-align: center; height: 400px; margin-top: 40px;">
            <img src="assets/images/cart.png" alt="Không có đơn hàng" style="width: 200px; height: 200px;">
            <h2>Bạn chưa có đơn hàng nào</h2>
            <p>Hãy tiếp tục mua sắm để tạo đơn hàng</p>
            <button class="btn btn-primary" style="margin-top: 20px;">
                <a href="products.php" style="color: white; text-decoration: none;">Mua sắm ngay</a>
            </button>
        </div>
    <?php } ?>
</div>
<?php
require_once('layouts/client/footer.php');
?>