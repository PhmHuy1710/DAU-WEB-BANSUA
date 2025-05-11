<?php
require_once("../../config/database.php");
require_once("../../layouts/admin/header.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM HoaDon WHERE MaHD = '$id'";
    $kq = mysqli_query($conn, $sql);

    if ($kq) {
        header("Location: index.php");
        exit();
    } else {
        echo "Xóa đơn hàng không thành công!";
    }
}
