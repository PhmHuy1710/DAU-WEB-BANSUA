<?php
$MaSP = $_GET["MaSP"];
$MaKH = $_GET["MaKH"];
$action = $_GET["action"];

require_once("database.php");

$sql_get = "SELECT SoLuong FROM giohang WHERE MaSP = '$MaSP' AND MaKH = '$MaKH'";
$result = mysqli_query($conn, $sql_get);

if ($row = mysqli_fetch_assoc($result)) {
    $soLuong = $row['SoLuong'];
    if ($action == 'up') {
        $soLuong = $soLuong + 1;
    } else if ($action == 'down') {
        $soLuong = $soLuong - 1;
        if ($soLuong <= 0) {
            $sql_del = "DELETE FROM giohang WHERE MaSP = '$MaSP' AND MaKH = '$MaKH'";
            mysqli_query($conn, $sql_del);
            mysqli_close($conn);
            header("location:../cart.php");
            exit();
        }
    }
    else if ($action == 'delete') {
        $sql_del = "DELETE FROM giohang WHERE MaSP = '$MaSP' AND MaKH = '$MaKH'";
        mysqli_query($conn, $sql_del);
        mysqli_close($conn);
        header("location:../cart.php");
        exit();
    }


    $sql_update = "UPDATE giohang SET SoLuong = $soLuong WHERE MaSP = '$MaSP' AND MaKH = '$MaKH'";
    if (mysqli_query($conn, $sql_update)) {
        echo "Cập nhật thành công";
        mysqli_close($conn);
        header("location:../cart.php");
    } else {
        echo "Cập nhật thất bại";
    }
}
?>

