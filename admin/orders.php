<?php
require_once("../layouts/admin/header.php");

$hdSQL = "SELECT * FROM hoadon";
$kq = mysqli_query($conn, $hdSQL);
?>
<style>
    
</style>
<div class="container">
    <div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
        <ul class="breadcrumb">
            <li><a href="index.php"><i class="fas fa-home"></i> Dashboad</a></li>
            <li class="active">
                <span><i class="fas fa-box"></i> Quản Lý hóa đơn</span>
            </li>
        </ul>
        <div class="main">
                <h2>Quản lý hóa đơn</h2>
                <input type="submit" value="+Thêm hóa đơn" class="btnThem" >
            </div>
            <div class="inf">
                <h2>Danh sách hóa đơn</h2>
            </div>
            <table border="1px" >
                <tr>
                    <th>Mã HĐ</th>
                    <th>Mã KH</th>
                    <th>Tổng tiền</th>
                    <th>Tổng tiền gốc</th>
                    <th>Trạng thái</th>
                    <th>Tên người nhận</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($kq)) {
                    ?>
                    <td><?php echo $row['MaHD']; ?></td>
                    <td><?php echo $row['MaKH']; ?></td>
                    <td><?php echo $row['TongTien']; ?></td>
                    <td><?php echo $row['TongTienGoc']; ?></td>
                    <td><?php echo $row['TrangThai']; ?></td>
                    <td><?php echo $row['TenNguoiNhan']; ?></td>
                    <td><?php echo $row['DiaChi']; ?></td>
                    <td><?php echo $row['SoDienThoai']; ?></td>
                    <td><?php echo $row['NgayTao']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['MaHD']; ?>">Sửa</a> | 
                        <a href="delete.php?id=<?php echo $row['MaHD']; ?>">Xóa</a>
                    </td>
                    <?php
                }
                ?>
            </table>
    </div>
    <div class="row">

    </div>
</div>