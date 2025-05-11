<?php
$maSP = $_GET["MaSP"];
$maKH = $_GET["MaKH"];
$action = $_GET["action"];

require_once("../../config/database.php");

$sql_sp = "SELECT SoLuong FROM sanpham WHERE MaSP = '$maSP'";
$kq_sp = mysqli_query($conn, $sql_sp);
$row_sp = mysqli_fetch_assoc($kq_sp);
$slTonKho = $row_sp['SoLuong'];

$sql_get = "SELECT SoLuong FROM giohang WHERE MaSP = '$maSP' AND MaKH = '$maKH'";
$kq = mysqli_query($conn, $sql_get);

if ($row = mysqli_fetch_assoc($kq)) {
    $soLuong = $row['SoLuong'];
    if ($action >= 1) {
        if ($action <= $slTonKho) {
            $soLuong = $action;
        } else {
            $soLuong = $slTonKho;
            session_start();
            $_SESSION['thongbao'] = "Số lượng đã được điều chỉnh theo số lượng tồn kho";
            $_SESSION['loai_thongbao'] = "warning";
        }
    } else if ($action <= 0) {
        $soLuong = $soLuong;
    }
    $sql = "UPDATE giohang SET SoLuong = $soLuong WHERE MaSP = '$maSP' AND MaKH = '$maKH'";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("location:../../cart.php");
    } else {
        echo "Cập nhật thất bại: " . mysqli_error($conn);
    }
}
