<?php
$MaSP = $_GET["MaSP"];
$MaKH = $_GET["MaKH"];

require_once("config/database.php");
$sql = "DELETE FROM giohang WHERE MaSP = '$MaSP' AND MaKH = '$MaKH'";
$kq = mysqli_query($conn, $sql);
if($kq)
{
    mysqli_close($conn);
    header("location:cart.php");
}
else
{
    echo "xóa thất bại";
}
?>