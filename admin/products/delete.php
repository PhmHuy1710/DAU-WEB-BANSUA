<?php
require_once("../../layouts/admin/header.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $maSP = trim($_GET['id']);

    $sqlSP = "SELECT HinhAnh FROM SanPham WHERE MaSP = ?";
    $stmtCheck = mysqli_prepare($conn, $sqlSP);
    mysqli_stmt_bind_param($stmtCheck, "s", $maSP);
    mysqli_stmt_execute($stmtCheck);
    $kqSP = mysqli_stmt_get_result($stmtCheck);

    if ($row = mysqli_fetch_assoc($kqSP)) {

        if (!empty($row['HinhAnh'])) {
            $hinhAnh = $row['HinhAnh'];
            $linkAnh = "../../assets/images/products/" . $hinhAnh;

            if (file_exists($linkAnh)) {
                unlink($linkAnh);
            }
        }

        $folderAnh = "../../assets/images/products/";
        $duoiAnh = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        foreach ($duoiAnh as $dinhDang) {
            $tenFile = $maSP . '.' . $dinhDang;
            $duongDanFile = $folderAnh . $tenFile;

            if (file_exists($duongDanFile)) {
                unlink($duongDanFile);
            }
        }

        $sqlDelete = "DELETE FROM SanPham WHERE MaSP = ?";
        $stmtDelete = mysqli_prepare($conn, $sqlDelete);
        mysqli_stmt_bind_param($stmtDelete, "s", $maSP);
        $kq = mysqli_stmt_execute($stmtDelete);

        if ($kq) {
            $_SESSION['thongBao'] = "Đã xóa sản phẩm " . $maSP . " thành công!";
            $_SESSION['loaiThongBao'] = "success";
        } else {
            $_SESSION['thongBao'] = "Lỗi khi xóa sản phẩm: " . mysqli_error($conn);
            $_SESSION['loaiThongBao'] = "danger";
        }
    } else {
        $_SESSION['thongBao'] = "Không tìm thấy sản phẩm có mã " . $maSP;
        $_SESSION['loaiThongBao'] = "warning";
    }
} else {
    $_SESSION['thongBao'] = "Không xác định được mã sản phẩm cần xóa";
    $_SESSION['loaiThongBao'] = "danger";
}

header("Location: index.php");
exit();
