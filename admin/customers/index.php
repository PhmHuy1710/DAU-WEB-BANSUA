<?php
require_once("../../layouts/admin/header.php");

$khSQL = "SELECT * FROM khachhang";
$kq = mysqli_query($conn, $khSQL);
?>

<body>
    <div class="container">
        <div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="active">
                    <span><i class="fas fa-envelope"></i>Quản lý khách hàng</span>
                </li>
            </ul>
        </div>
        <div class="main">
            <a href="add.php" class="btnThem">Thêm khách hàng</a>
        </div>
        <div class="inf">
            <h2>Danh sách khách hàng</h2>
        </div>
        <table border="1px">
            <tr>
                <th>Mã KH</th>
                <th>Tên khách hàng</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Vai Trò</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($kq)) {
            ?>
                <tr>
                    <td><?php echo $row['MaKH']; ?></td>
                    <td><?php echo $row['TenKH']; ?></td>
                    <td><?php echo $row['DiaChi']; ?></td>
                    <td><?php echo $row['SoDienThoai']; ?></td>
                    <td><?php echo $row['Email']; ?></td>
                    <td><?php echo $row['VaiTro']; ?></td>
                    <td><?php echo $row['NgayTao']; ?></td>
                    <td>
                        <a class="btn btn-primary" href="edit.php?id=<?php echo $row['MaKH']; ?>"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger" href="delete.php?id=<?php echo $row['MaKH']; ?>" 
                        onclick="return confirm('Bạn có chắc chắn muốn xóa khách hàng này?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>

    </div>

</body>