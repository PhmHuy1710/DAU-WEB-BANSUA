<?php
require_once("../../layouts/admin/header.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $maSP = trim($_GET['id']);

    $sqlSP = "SELECT HinhAnh FROM SanPham WHERE MaSP = '$maSP'";
    $kqSP = mysqli_query($conn, $sqlSP);

    if ($row = mysqli_fetch_assoc($kqSP)) {
        if (!empty($row['HinhAnh'])) {
            $hinhAnh = $row['HinhAnh'];
            $linkAnh = "../../assets/images/products/" . $hinhAnh;

            if (file_exists($linkAnh)) {
                unlink($linkAnh);
            }
        }

        $folderAnh = "../../assets/images/products/";
        $danhSachDuoi = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        foreach ($danhSachDuoi as $duoi) {
            $tenFile = $maSP . '.' . $duoi;
            $duongDan = $folderAnh . $tenFile;

            if (file_exists($duongDan)) {
                unlink($duongDan);
            }
        }

        $sqlXoa = "DELETE FROM SanPham WHERE MaSP = '$maSP'";
        $kqXoa = mysqli_query($conn, $sqlXoa);

        if ($kqXoa) {
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
