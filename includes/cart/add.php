<?php
session_start();
$MaSP = $_GET["MaSP"];
$MaKH = $_GET["MaKH"];
$action = (int)$_GET["SoLuong"];

require_once("../../config/database.php");

$sql_tonkho = "SELECT SoLuong FROM sanpham WHERE MaSP = '$MaSP'";
$result_tonkho = mysqli_query($conn, $sql_tonkho);
$row_tonkho = mysqli_fetch_assoc($result_tonkho);
$soLuongTonKho = $row_tonkho['SoLuong'];

if ($action > $soLuongTonKho) {
    $_SESSION['thongbao'] = "Chỉ còn $soLuongTonKho sản phẩm trong kho!";
    $_SESSION['loai_thongbao'] = "warning";
    mysqli_close($conn);
    header("location:../../product-detail.php?id=$MaSP");
    exit();
}

$sql_get = "SELECT SoLuong FROM giohang WHERE MaSP = '$MaSP' AND MaKH = '$MaKH'";
$result = mysqli_query($conn, $sql_get);

if ($row = mysqli_fetch_assoc($result)) {
    $soLuong = $row['SoLuong'] + $action;

    if ($soLuong > $soLuongTonKho) {
        $soLuong = $soLuongTonKho;
        $_SESSION['thongbao'] = "Số lượng đã được điều chỉnh theo số lượng tồn kho";
        $_SESSION['loai_thongbao'] = "warning";
    }

    $sql_update = "UPDATE giohang SET SoLuong = $soLuong WHERE MaSP = '$MaSP' AND MaKH = '$MaKH'";
    if (mysqli_query($conn, $sql_update)) {
        $_SESSION['thongbao'] = "Sản phẩm đã được cập nhật trong giỏ hàng";
        $_SESSION['loai_thongbao'] = "success";
    } else {
        $_SESSION['thongbao'] = "Cập nhật thất bại: " . mysqli_error($conn);
        $_SESSION['loai_thongbao'] = "error";
    }
} else {
    $sql_insert = "INSERT INTO giohang (MaKH, MaSP, SoLuong, NgayTao) VALUES ('$MaKH', '$MaSP', $action, NOW())";
    if (mysqli_query($conn, $sql_insert)) {
        $_SESSION['thongbao'] = "Sản phẩm đã được thêm vào giỏ hàng";
        $_SESSION['loai_thongbao'] = "success";
    } else {
        $_SESSION['thongbao'] = "Thêm mới thất bại: " . mysqli_error($conn);
        $_SESSION['loai_thongbao'] = "error";
    }
}

mysqli_close($conn);
header("location:../../product-detail.php?id=$MaSP");
