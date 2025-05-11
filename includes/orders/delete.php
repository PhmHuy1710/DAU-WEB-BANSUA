<?php
require_once('../../config/database.php');
require_once('../../config/config.php');
require_once('../../includes/session.php');

if (!isLoggedIn()) {
    header('Location: ../../login.php');
    exit;
}

$MaKH = $_SESSION['user']['MaKH'];

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "Không tìm thấy đơn hàng cần hủy";
    header('Location: ../../orders.php');
    exit;
}

$MaHD = $_GET['id'];

$sql = "SELECT * FROM hoadon 
        WHERE MaHD = '$MaHD' AND MaKH = '$MaKH' AND TrangThai = 'cho_duyet'";
$kq = mysqli_query($conn, $sql);

if (mysqli_num_rows($kq) == 0) {
    $_SESSION['error'] = "Đơn hàng không tồn tại hoặc không thể hủy";
    header('Location: ../../orders.php');
    exit;
}

$sqlUpdate = "UPDATE hoadon SET TrangThai = 'da_huy' WHERE MaHD = '$MaHD'";
$kqUpdate = mysqli_query($conn, $sqlUpdate);

if ($kqUpdate) {
    $sqlCTHD = "SELECT MaSP, SoLuong FROM chitiethoadon WHERE MaHD = '$MaHD'";
    $kqCTHD = mysqli_query($conn, $sqlCTHD);

    while ($hoaDon = mysqli_fetch_assoc($kqCTHD)) {
        $MaSP = $hoaDon['MaSP'];
        $SoLuong = $hoaDon['SoLuong'];

        $sqlUpdate_sp = "UPDATE sanpham SET SoLuong = SoLuong + $SoLuong WHERE MaSP = '$MaSP'";
        mysqli_query($conn, $sqlUpdate_sp);
    }

    $_SESSION['success'] = "Đã hủy đơn hàng thành công";
} else {
    $_SESSION['error'] = "Có lỗi xảy ra khi hủy đơn hàng";
}

header('Location: ../../orders.php');
exit;
