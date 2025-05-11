<?php
require_once("../../layouts/admin/header.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $maTH = trim($_GET['id']);

    $sql = "SELECT HinhAnh FROM ThuongHieu WHERE MaTH = '$maTH'";
    $ketQua = mysqli_query($conn, $sql);

    if ($dong = mysqli_fetch_assoc($ketQua)) {
        if (!empty($dong['HinhAnh'])) {
            $hinhAnh = $dong['HinhAnh'];
            $duongDan = "../../assets/images/brands/" . $hinhAnh;

            if (file_exists($duongDan)) {
                unlink($duongDan);
            }
        }
    }

    $sql = "DELETE FROM ThuongHieu WHERE MaTH = '$maTH'";
    $kq = mysqli_query($conn, $sql);

    if ($kq) {
        $_SESSION['thongBao'] = "Xóa thương hiệu thành công!";
        $_SESSION['loaiThongBao'] = "success";
    } else {
        $_SESSION['thongBao'] = "Xóa thương hiệu không thành công! " . mysqli_error($conn);
        $_SESSION['loaiThongBao'] = "danger";
    }

    header("Location: index.php");
    exit();
}
