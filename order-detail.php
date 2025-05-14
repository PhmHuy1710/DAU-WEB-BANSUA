<?php
require_once('config/database.php');
require_once('config/config.php');
require_once('includes/session.php');

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: orders.php');
    exit;
}

$maDH = $_GET['id'];
$maKH = $_SESSION['user']['MaKH'];

$sql = "SELECT hd.MaHD, hd.TongTien, hd.TongTienGoc, 
        CAST(hd.TrangThai AS CHAR) AS TrangThai, 
        hd.TenNguoiNhan, hd.DiaChi, hd.SoDienThoai, hd.GhiChu, 
        hd.NgayTao, hd.NgayCapNhat
        FROM hoadon hd
        JOIN khachhang kh ON hd.MaKH = kh.MaKH
        WHERE hd.MaHD = '$maDH' AND hd.MaKH = '$maKH'";
$kq = mysqli_query($conn, $sql);

if (mysqli_num_rows($kq) == 0) {
    header('Location: orders.php');
    exit;
}

$thongTinDH = mysqli_fetch_assoc($kq);

$sqlSP = "SELECT ct.MaSP, ct.SoLuong, ct.Gia, sp.TenSP, sp.HinhAnh, sp.TrongLuong, sp.DonVi, th.TenTH
                FROM chitiethoadon ct
                JOIN sanpham sp ON ct.MaSP = sp.MaSP
                JOIN thuonghieu th ON sp.MaTH = th.MaTH
                WHERE ct.MaHD = '$maDH'";
$kqSP = mysqli_query($conn, $sqlSP);

require_once('layouts/client/header.php');
?>
<style>
    .order-card {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        margin: 0 -15px;
    }

    .order-card-item {
        width: 100%;
        padding: 0 15px;
        margin-bottom: 30px;
        flex: 1;
        min-width: 300px;
    }

    .order-card-description {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .list-sp {
        width: 100%;
        overflow-x: auto;
        margin-top: 20px;
    }

    .table-sp {
        width: 100%;
        min-width: 700px;
        border-collapse: collapse;
    }

    .table-sp th,
    .table-sp td {
        padding: 10px;
        border-bottom: 1px solid #dee2e6;
    }

    .table-sp th {
        background-color: #f8f9fa;
    }

    .hang-sp:hover {
        background-color: #f8f9fa;
    }

    .order-button {
        width: 100%;
        text-align: center;
        margin-bottom: 30px;
    }

    .order-button a {
        margin: 0 5px;
    }
</style>
<div class="container">
    <div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
        <ul class="breadcrumb">
            <li><a href="index.php"><i class="fas fa-home"></i> Trang chủ</a></li>
            <li><a href="orders.php"><i class="fa-solid fa-file-invoice"></i> Đơn hàng</a></li>
            <li class="active"><i class="fa-solid fa-circle-info"></i> Chi tiết đơn hàng #<?php echo $maDH; ?></li>
        </ul>
    </div>

    <div class="section-heading">
        <h2>#<?php echo $maDH; ?></h2>
        <?php
        $tagTT = '';
        $textTT = '';
        $ttDH = $thongTinDH['TrangThai'];

        switch ($ttDH) {
            case 'cho_duyet':
                $tagTT = 'bg-warning';
                $textTT = 'Chờ xác nhận';
                break;
            case 'dang_xu_ly':
                $tagTT = 'bg-primary';
                $textTT = 'Đang xử lý';
                break;
            case 'dang_giao':
                $tagTT = 'bg-info';
                $textTT = 'Đang giao';
                break;
            case 'da_giao':
                $tagTT = 'bg-success';
                $textTT = 'Đã giao';
                break;
            case 'da_huy':
                $tagTT = 'bg-danger';
                $textTT = 'Đã hủy';
                break;
            default:
                $tagTT = 'bg-secondary';
                $textTT = 'Không xác định';
        }
        ?>
        <div style="text-align: center; margin-bottom: 20px;">
            <span class="badge <?php echo $tagTT; ?>"><?php echo $textTT; ?></span>
            <p><i class="fa-solid fa-calendar"></i> Ngày đặt: <?php echo date('d/m/Y H:i', strtotime($thongTinDH['NgayTao'])); ?></p>
        </div>
    </div>

    <div class="row">
        <div class="order-card">
            <div class="order-card-item">
                <div class="feature-card" style="text-align: left;">
                    <h4><i class="fa-solid fa-truck"></i> Thông tin giao hàng</h4>
                    <div class="shipping-info">
                        <p><strong>Người nhận:</strong> <?php echo $thongTinDH['TenNguoiNhan']; ?></p>
                        <p><strong>Số điện thoại:</strong> <?php echo $thongTinDH['SoDienThoai']; ?></p>
                        <p><strong>Địa chỉ:</strong> <?php echo $thongTinDH['DiaChi']; ?></p>
                        <?php if (!empty($thongTinDH['GhiChu'])): ?>
                            <p><strong>Ghi chú:</strong> <?php echo $thongTinDH['GhiChu']; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="order-card-item">
                <div class="feature-card" style="text-align: left;">
                    <h4><i class="fa-solid fa-receipt"></i> Tóm tắt đơn hàng</h4>
                    <div style="margin-top: 15px;">
                        <div class="order-card-description">
                            <span>Tổng tiền sản phẩm:</span>
                            <span><?php echo number_format($thongTinDH['TongTienGoc'], 0, ',', '.'); ?> VNĐ</span>
                        </div>
                        <div class="order-card-description">
                            <span>Phí ship:</span>
                            <span>0 VNĐ</span>
                        </div>
                        <div class="order-card-description">
                            <span>Giảm giá:</span>
                            <span>0 VNĐ</span>
                        </div>
                        <div class="order-card-description">
                            <span>Tổng tiền:</span>
                            <span><?php echo number_format($thongTinDH['TongTien'], 0, ',', '.'); ?> VNĐ</span>
                        </div>

                        <?php if ($ttDH == 'cho_duyet'): ?>
                            <div style="margin-top: 15px;">
                                <a href="includes/orders/delete.php?id=<?php echo $maDH; ?>" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này không?');" class="btn btn-danger" style="width: 100%;">
                                    <i class="fa-solid fa-ban"></i> Hủy đơn hàng
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div style="width: 100%; margin-bottom: 30px;">
            <div class="feature-card" style="text-align: left; padding: 20px; overflow: hidden;">
                <h4><i class="fa-solid fa-box"></i> Sản phẩm đã mua</h4>

                <div class="list-sp">
                    <table class="table-sp">
                        <thead>
                            <tr>
                                <th style="width: 50px; text-align: center;">STT</th>
                                <th style="width: 80px; text-align: center;">Hình ảnh</th>
                                <th style="text-align: left;">Sản phẩm</th>
                                <th style="width: 120px; text-align: right;">Đơn giá</th>
                                <th style="width: 80px; text-align: center;">Số lượng</th>
                                <th style="width: 120px; text-align: right;">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 1;
                            $tongSP = 0;
                            while ($sp = mysqli_fetch_assoc($kqSP)) {
                                $tienSP = $sp['SoLuong'] * $sp['Gia'];
                                $tongSP += $tienSP;
                            ?>
                                <tr class="hang-sp">
                                    <td style="text-align: center;"><?php echo $stt++; ?></td>
                                    <td style="text-align: center;">
                                        <?php if (!empty($sp['HinhAnh'])): ?>
                                            <img src="assets/images/products/<?php echo $sp['HinhAnh']; ?>" alt="<?php echo $sp['TenSP']; ?>" style="width: 50px; height: 50px; object-fit: cover;">
                                        <?php else: ?>
                                            <img src="<?php echo DEFAULT_IMAGE; ?>" alt="No image" style="width: 50px; height: 50px; object-fit: cover;">
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <div style="font-weight: 500;"><?php echo $sp['TenSP']; ?></div>
                                        <div style="font-size: 0.85rem; color: var(--secondary-color);">
                                            <?php echo $sp['TenTH']; ?> - <?php echo $sp['TrongLuong'] . ' ' . $sp['DonVi']; ?>
                                        </div>
                                    </td>
                                    <td style="text-align: right;"><?php echo number_format($sp['Gia'], 0, ',', '.'); ?> VNĐ</td>
                                    <td style="text-align: center;"><?php echo $sp['SoLuong']; ?></td>
                                    <td style="text-align: right;"><?php echo number_format($tienSP, 0, ',', '.'); ?> VNĐ</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="order-button">
            <a href="orders.php" class="btn btn-outline-primary">
                <i class="fa-solid fa-arrow-left"></i> Quay lại đơn hàng
            </a>
            <a href="index.php" class="btn btn-primary">
                <i class="fa-solid fa-home"></i> Về trang chủ
            </a>
        </div>
    </div>
</div>

<?php
require_once('layouts/client/footer.php');
?>