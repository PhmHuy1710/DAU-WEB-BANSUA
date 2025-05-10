<?php
$MaSP = $_GET["MaSP"];
$MaKH = $_GET["MaKH"];
$action = (int)$_GET["SoLuong"];

require_once("config/database.php");

$sql_get = "SELECT SoLuong FROM giohang WHERE MaSP = '$MaSP' AND MaKH = '$MaKH'";
$result = mysqli_query($conn, $sql_get);

if ($row = mysqli_fetch_assoc($result)) {
    $soLuong = $row['SoLuong'] + $action;
    $sql_update = "UPDATE giohang SET SoLuong = $soLuong WHERE MaSP = '$MaSP' AND MaKH = '$MaKH'";
    if (mysqli_query($conn, $sql_update)) {
        echo "Cập nhật thành công";
    } else {
        echo "Cập nhật thất bại: " . mysqli_error($conn);
    }
} else {
    $sql_insert = "INSERT INTO giohang (MaKH, MaSP, SoLuong, NgayTao) VALUES ('$MaKH', '$MaSP', $action, NOW())";
    if (mysqli_query($conn, $sql_insert)) {
        echo "Thêm mới thành công";
    } else {
        echo "Thêm mới thất bại: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
header("location:product-detail.php?id=$MaSP");
?>