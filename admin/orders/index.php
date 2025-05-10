<?php
require_once("../../layouts/admin/header.php");

$thSQL = "SELECT *, hoadon.diachi AS DiaChiHoaDon FROM hoadon 
JOIN khachhang ON hoadon.MaKH = khachhang.MaKH";

$kq = mysqli_query($conn, $thSQL);
?>

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
        <div class="inf fade-in">
            <h2>Danh sách hóa đơn</h2>
        </div>
        <table class="fade-in" border="1px">
            <tr>
                <th>Mã HĐ</th>
                <th>Tên khách hàng</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Tiền gốc</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
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
                    <td><?php echo number_format($row['TongTienGoc']); ?>đ</td>
                    <td><?php echo number_format($row['TongTien']); ?>đ</td>
                    <td><?php
                        if ($row['TrangThai'] == 0) {
                            echo "Chưa thanh toán";
                        } else {
                            echo "Đã thanh toán";
                        }
                        ?>
                    </td>
                    <td><?php echo $row['NgayTao']; ?></td>
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