<?php
require_once('../../config/database.php');
require_once('../../config/config.php');
require_once('../../includes/session.php');

if (!isLoggedIn()) {
    header('Location: ../../login.php');
    exit;
}

$maKH = $_SESSION['user']['MaKH'];

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['thongbao'] = "Không tìm thấy đơn hàng cần hủy";
    $_SESSION['loai_thongbao'] = "danger";
    header('Location: ../../orders.php');
    exit;
}

$maHD = $_GET['id'];

$sql = "SELECT * FROM hoadon 
        WHERE MaHD = '$maHD' AND MaKH = '$maKH' AND TrangThai = 'cho_duyet'";
$kq = mysqli_query($conn, $sql);

if (mysqli_num_rows($kq) == 0) {
    $_SESSION['thongbao'] = "Đơn hàng không tồn tại hoặc không thể hủy";
    $_SESSION['loai_thongbao'] = "danger";
    header('Location: ../../orders.php');
    exit;
}

$sqlUpdate = "UPDATE hoadon SET TrangThai = 'da_huy' WHERE MaHD = '$maHD'";
$kqUpdate = mysqli_query($conn, $sqlUpdate);

if ($kqUpdate) {
    $sqlCTHD = "SELECT MaSP, SoLuong FROM chitiethoadon WHERE MaHD = '$maHD'";
    $kqCTHD = mysqli_query($conn, $sqlCTHD);

    while ($hoaDon = mysqli_fetch_assoc($kqCTHD)) {
        $maSP = $hoaDon['MaSP'];
        $soLuong = $hoaDon['SoLuong'];

        $sqlUpdate_sp = "UPDATE sanpham SET SoLuong = SoLuong + $soLuong WHERE MaSP = '$maSP'";
        mysqli_query($conn, $sqlUpdate_sp);
    }

    $_SESSION['thongbao'] = "Đã hủy đơn hàng thành công";
    $_SESSION['loai_thongbao'] = "success";
} else {
    $_SESSION['thongbao'] = "Có lỗi xảy ra khi hủy đơn hàng";
    $_SESSION['loai_thongbao'] = "danger";
}

header('Location: ../../orders.php');
exit;
