<?php
session_start();
require_once("../../config/database.php");
require_once("../../config/config.php");
require_once("../session.php");

if (!isLoggedIn()) {
    header("Location: ../../login.php");
    exit();
}

$maKH = $_SESSION['user']['MaKH'];
$ghiChu = isset($_POST['note']) ? $_POST['note'] : null;

$sql = "SELECT COUNT(*) as soSP FROM giohang WHERE MaKH = '$maKH'";
$kq = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($kq);

if ($row['soSP'] == 0) {
    $_SESSION['thongbao'] = "Giỏ hàng của bạn đang trống!";
    $_SESSION['loai_thongbao'] = "warning";
    header("Location: ../../cart.php");
    exit();
}

$sql = "SELECT * FROM khachhang WHERE MaKH = '$maKH'";
$kq = mysqli_query($conn, $sql);
$kh = mysqli_fetch_assoc($kq);

$sql = "SELECT g.MaSP, g.SoLuong, s.SoLuong as SLTonKho, s.TenSP
        FROM giohang g 
        JOIN sanpham s ON g.MaSP = s.MaSP 
        WHERE g.MaKH = '$maKH'";
$kq = mysqli_query($conn, $sql);

$KtraSP = false;
$thongBaoLoi = "Một số sản phẩm không đủ số lượng trong kho:<br>";

while ($sp = mysqli_fetch_assoc($kq)) {
    if ($sp['SoLuong'] > $sp['SLTonKho']) {
        $KtraSP = true;
        $thongBaoLoi .= "- {$sp['TenSP']}: Chỉ còn {$sp['SLTonKho']} sản phẩm (bạn đặt {$sp['SoLuong']})<br>";

        $maSP = $sp['MaSP'];
        $soLuongKho = $sp['SLTonKho'];
        mysqli_query($conn, "UPDATE giohang SET SoLuong = $soLuongKho WHERE MaKH = '$maKH' AND MaSP = '$maSP'");
    }
}

if ($KtraSP) {
    $_SESSION['thongbao'] = $thongBaoLoi;
    $_SESSION['loai_thongbao'] = "warning";
    header("Location: ../../cart.php");
    exit();
}

$sql = "SELECT SUM(s.Gia * g.SoLuong) as TongTien 
        FROM giohang g 
        JOIN sanpham s ON g.MaSP = s.MaSP 
        WHERE g.MaKH = '$maKH'";
$kq = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($kq);
$tongTien = $row['TongTien'];

$maHD = 'HD' . rand(1000, 9999);

$sql = "SELECT COUNT(*) as soLuong FROM hoadon WHERE MaHD = '$maHD'";
$kq = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($kq);
if ($row['soLuong'] > 0) {
    $maHD = 'HD' . rand(1000, 9999);
}

$sql = "INSERT INTO hoadon (MaHD, MaKH, TongTien, TongTienGoc, TrangThai, TenNguoiNhan, DiaChi, SoDienThoai, GhiChu)
        VALUES ('$maHD', '$maKH', $tongTien, $tongTien, 'cho_duyet', '{$kh['TenKH']}', '{$kh['DiaChi']}', '{$kh['SoDienThoai']}', '$ghiChu')";
$kq = mysqli_query($conn, $sql);

if (!$kq) {
    $_SESSION['thongbao'] = "Lỗi khi tạo hóa đơn: " . mysqli_error($conn);
    $_SESSION['loai_thongbao'] = "error";
    header("Location: ../../cart.php");
    exit();
}

$sql = "SELECT g.MaSP, g.SoLuong, s.Gia 
        FROM giohang g 
        JOIN sanpham s ON g.MaSP = s.MaSP 
        WHERE g.MaKH = '$maKH'";
$kq = mysqli_query($conn, $sql);

while ($sp = mysqli_fetch_assoc($kq)) {
    $maSP = $sp['MaSP'];
    $soLuong = $sp['SoLuong'];
    $gia = $sp['Gia'];

    $sql = "INSERT INTO chitiethoadon (MaHD, MaSP, SoLuong, Gia) 
            VALUES ('$maHD', '$maSP', $soLuong, $gia)";
    mysqli_query($conn, $sql);

    $sql = "UPDATE sanpham SET SoLuong = SoLuong - $soLuong WHERE MaSP = '$maSP'";
    mysqli_query($conn, $sql);
}

$sql = "DELETE FROM giohang WHERE MaKH = '$maKH'";
mysqli_query($conn, $sql);

$_SESSION['thongbao'] = "Đặt hàng thành công! Mã đơn hàng của bạn là: $maHD";
$_SESSION['loai_thongbao'] = "success";

header("Location: ../../order-detail.php?id=$maHD");
exit();
