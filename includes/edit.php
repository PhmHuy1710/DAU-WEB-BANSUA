<?php
$MaSP = $_GET["MaSP"];
$MaKH = $_GET["MaKH"];
$action = $_GET["action"];

require_once("database.php");

$sql_get = "SELECT SoLuong FROM giohang WHERE MaSP = '$MaSP' AND MaKH = '$MaKH'";
$result = mysqli_query($conn, $sql_get);

if ($row = mysqli_fetch_assoc($result)) {
    $soLuong = $row['SoLuong'];
    if ($action >= 1) {
        $soLuong = $action;
    } else if ($action <= 0) {
        $soLuong= $soLuong;
    }
    $sql_update = "UPDATE giohang SET SoLuong = ? WHERE MaSP = ? AND MaKH = ?";
    $stmt = mysqli_prepare($conn, $sql_update);
    mysqli_stmt_bind_param($stmt, "iss", $soLuong, $MaSP, $MaKH);
    if (mysqli_stmt_execute($stmt)) {
        echo "Cập nhật thành công";
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("location:../cart.php");
    } else {
        echo "Cập nhật thất bại";
    }
}
?>

