<?php
$MaSP = $_GET["MaSP"];
$MaKH = $_GET["MaKH"];
$action = $_GET["action"];

require_once("../../config/database.php");

$sql_sp = "SELECT SoLuong FROM sanpham WHERE MaSP = '$MaSP'";
$kq_sp = mysqli_query($conn, $sql_sp);
$row_sp = mysqli_fetch_assoc($kq_sp);
$SLTonKho = $row_sp['SoLuong'];

$sql_get = "SELECT SoLuong FROM giohang WHERE MaSP = '$MaSP' AND MaKH = '$MaKH'";
$kq = mysqli_query($conn, $sql_get);

if ($row = mysqli_fetch_assoc($kq)) {
    $soLuong = $row['SoLuong'];
    if ($action >= 1) {
        if ($action <= $SLTonKho) {
            $soLuong = $action;
        } else {
            $soLuong = $SLTonKho;
            session_start();
            $_SESSION['thongbao'] = "Số lượng đã được điều chỉnh theo số lượng tồn kho";
            $_SESSION['loai_thongbao'] = "warning";
        }
    } else if ($action <= 0) {
        $soLuong = $soLuong;
    }
    $sql_update = "UPDATE giohang SET SoLuong = ? WHERE MaSP = ? AND MaKH = ?";
    $stmt = mysqli_prepare($conn, $sql_update);
    mysqli_stmt_bind_param($stmt, "iss", $soLuong, $MaSP, $MaKH);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("location:../../cart.php");
    } else {
        echo "Cập nhật thất bại";
    }
}
