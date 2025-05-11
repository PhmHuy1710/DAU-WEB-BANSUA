<?php
$maSP = $_GET["MaSP"];
$maKH = $_GET["MaKH"];
$action = $_GET["action"];

require_once("../../config/database.php");

$sql_sp = "SELECT SoLuong FROM sanpham WHERE MaSP = '$maSP'";
$result_sp = mysqli_query($conn, $sql_sp);
$row_sp = mysqli_fetch_assoc($result_sp);
$slTonKho = $row_sp['SoLuong'];

$sql_get = "SELECT SoLuong FROM giohang WHERE MaSP = '$maSP' AND MaKH = '$maKH'";
$result = mysqli_query($conn, $sql_get);

if ($row = mysqli_fetch_assoc($result)) {
    $soLuong = $row['SoLuong'];
    if ($action == 'up') {
        if ($soLuong < $slTonKho) {
            $soLuong = $soLuong + 1;
        } else {
            session_start();
            $_SESSION['thongbao'] = "Không thể thêm số lượng. Đã đạt giới hạn tồn kho!";
            $_SESSION['loai_thongbao'] = "warning";
            mysqli_close($conn);
            header("location:../../cart.php");
            exit();
        }
    } else if ($action == 'down') {
        $soLuong = $soLuong - 1;
        if ($soLuong <= 0) {
            $sql_del = "DELETE FROM giohang WHERE MaSP = '$maSP' AND MaKH = '$maKH'";
            mysqli_query($conn, $sql_del);
            mysqli_close($conn);
            header("location:../../cart.php");
            exit();
        }
    } else if ($action == 'delete') {
        $sql_del = "DELETE FROM giohang WHERE MaSP = '$maSP' AND MaKH = '$maKH'";
        mysqli_query($conn, $sql_del);
        mysqli_close($conn);
        header("location:../../cart.php");
        exit();
    }

    $sql_update = "UPDATE giohang SET SoLuong = $soLuong WHERE MaSP = '$maSP' AND MaKH = '$maKH'";
    if (mysqli_query($conn, $sql_update)) {
        mysqli_close($conn);
        header("location:../../cart.php");
    } else {
        echo "Cập nhật thất bại";
    }
}
