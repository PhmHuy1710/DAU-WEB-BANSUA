<?php
$MaSP = $_GET["MaSP"];
$MaKH = $_GET["MaKH"];
$action = $_GET["SoLuong"];

require_once("config/database.php");

$sql_get = "SELECT SoLuong FROM giohang WHERE MaSP = '$MaSP' AND MaKH = '$MaKH'";
$result = mysqli_query($conn, $sql_get);

if ($row = mysqli_fetch_assoc($result)) {
    $soLuong = $row['SoLuong'];
    $soLuong += $action;
    $sql_update = "INSERT IGNORE INTO GioHang (MaKH, MaSP, SoLuong, NgayTao)
                    VALUES ($MaKH, $MaSP, $action, NOW())";
    $stmt = mysqli_prepare($conn, $sql_update);
    mysqli_stmt_bind_param($stmt, "iss", $soLuong, $MaSP, $MaKH);
    if (mysqli_stmt_execute($stmt)) {
        echo "Cập nhật thành công";
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("location:cart.php");
    } else {
        echo "Cập nhật thất bại";
    }
}
