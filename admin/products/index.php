<?php
require_once("../../layouts/admin/header.php");

$spSQL = "SELECT * FROM SanPham";
$kq = mysqli_query($conn, $spSQL);
?>
<style>

</style>
<div class="container">
    <div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
        <ul class="breadcrumb">
            <li><a href="index.php"><i class="fas fa-home"></i> Trang chủ</a></li>
            <li class="active">
                <span><i class="fas fa-box"></i> Quản Lý Sản Phẩm</span>
            </li>
        </ul>
        <div class="main">
            <h2>Quản lý sản phẩm</h2>
            <a href="add.php" class="btnThem">+Thêm sản phẩm</a>
        </div>
        <div class="inf">
            <h2>Danh sách sản phẩm</h2>
        </div>
        <table border="1px">
            <tr>
                <th>Mã SP</th>
                <th>Tên sản phẩm</th>
                <th>Mã TH</th>
                <th>Trọng lượng</th>
                <th>Giá</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($kq)) {
            ?>
                <tr>
                    <td><?php echo $row['MaSP']; ?></td>
                    <td><?php echo $row['TenSP']; ?></td>
                    <td><?php echo $row['MaTH']; ?></td>
                    <td><?php echo $row['TrongLuong']; ?></td>
                    <td><?php echo $row['Gia']; ?></td>
                    <td><?php echo $row['TrangThai']; ?></td>
                    <td><?php echo $row['NgayTao']; ?></td>
                    <td><a href="edit.php?id=<?php echo $row['MaSP']; ?>">Sửa</a> | <a href="delete.php?id=<?php echo $row['MaSP']; ?>">Xóa</a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <div class="row">

    </div>
</div>