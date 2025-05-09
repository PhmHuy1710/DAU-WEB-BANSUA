<?php
require_once("../../layouts/admin/header.php");

$thSQL = "SELECT *, hoadon.diachi AS DiaChiHoaDon FROM hoadon 
JOIN khachhang ON hoadon.MaKH = khachhang.MaKH";

$kq = mysqli_query($conn, $thSQL);
?>
<!DOCTYPE html>
<html>
<style>
    .main h2 {}
</style>

<body>
    <div class="container">
        <div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="active">
                    <span><i class="fas fa-envelope"></i>Quản lý hóa đơn</span>
                </li>
            </ul>
        </div>
        <div class="main">
            <h2>Quản lý hóa đơn</h2>
            <a href="add.php" class="btnThem">+ Thêm hóa đơn</a>
        </div>
        <div class="inf">
            <h2>Danh sách hóa đơn</h2>
        </div>
        <table border="1px">
            <tr>
                <th>Mã HĐ</th>
                <th>Tên khách hàng</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Tiền góc</th>
                <th>Tổng tiền</th>
                <th>Hành động</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($kq)) {
            ?>
                <tr>
                    <td><?php echo $row['MaHD']; ?></td>
                    <td><?php echo $row['TenKH']; ?></td>
                    <td><?php echo $row['DiaChiHoaDon']; ?></td>
                    <td><?php echo $row['SoDienThoai']; ?></td>
                    <td><?php echo $row['TongTienGoc']; ?></td>
                    <td><?php echo $row['TongTien']; ?></td>
                    <td>
                        <a class="btn btn-primary" href="edit.php?id=<?php echo $row['MaHD']; ?>"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger" href="delete.php?id=<?php echo $row['MaHD']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa hóa đơn này?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>

    </div>

</body>

</html>