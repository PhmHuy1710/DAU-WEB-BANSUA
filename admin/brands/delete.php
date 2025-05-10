<?php
require_once("../../layouts/admin/header.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $maTH = trim($_GET['id']);

    $sqlCheck = "SELECT HinhAnh FROM ThuongHieu WHERE MaTH = ?";
    $stmtCheck = mysqli_prepare($conn, $sqlCheck);
    mysqli_stmt_bind_param($stmtCheck, "s", $maTH);
    mysqli_stmt_execute($stmtCheck);
    $resultCheck = mysqli_stmt_get_result($stmtCheck);

    if ($row = mysqli_fetch_assoc($resultCheck)) {
        if (!empty($row['HinhAnh'])) {
            $hinhAnh = $row['HinhAnh'];
            $duongDanHinhAnh = "../../assets/images/brands/" . $hinhAnh;

            if (file_exists($duongDanHinhAnh)) {
                unlink($duongDanHinhAnh);
            }
        }
    }

    $sqlDelete = "DELETE FROM ThuongHieu WHERE MaTH = ?";
    $stmtDelete = mysqli_prepare($conn, $sqlDelete);
    mysqli_stmt_bind_param($stmtDelete, "s", $maTH);
    $kq = mysqli_stmt_execute($stmtDelete);


    if ($kq) {
        $thongBao = "Xóa thương hiệu thành công!";
        $loaiThongBao = "success";
    } else {
        $thongBao = "Xóa thương hiệu không thành công!";
        $loaiThongBao = "danger";
    }

    header("Location: index.php");
    exit();
}
