<?php
require_once("../../layouts/admin/header.php");

$spSQL = "SELECT sp.*, th.TenTH FROM SanPham sp JOIN ThuongHieu th ON sp.MaTH = th.MaTH";
$kq = mysqli_query($conn, $spSQL);
?>
<div class="container">
    <div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
        <ul class="breadcrumb">
            <li><a href="index.php"><i class="fas fa-home"></i> Trang chủ</a></li>
            <li class="active">
                <span><i class="fas fa-box"></i> Quản Lý Sản Phẩm</span>
            </li>
        </ul>

        <?php if (isset($_SESSION['thongBao']) && !empty($_SESSION['thongBao'])): ?>
            <div class="alert alert-<?php echo $_SESSION['loaiThongBao']; ?>">
                <?php
                echo $_SESSION['thongBao'];
                unset($_SESSION['thongBao']);
                unset($_SESSION['loaiThongBao']);
                ?>
            </div>
        <?php endif; ?>

        <div class="main">
            <a href="add.php" class="btnThem" style="text-align: center;">Thêm sản phẩm</a>
        </div>

        <h2 style="text-align: center;">Danh sách sản phẩm</h2>
        <table border="1px">
            <tr>
                <th>Mã SP</th>
                <th>Tên sản phẩm</th>
                <th>Hình Ảnh</th>
                <th>Thương Hiệu</th>
                <th>Trọng lượng</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($kq)) {
            ?>
                <tr>
                    <td><?php echo $row['MaSP']; ?></td>
                    <td><?php echo $row['TenSP']; ?></td>
                    <td>
                        <?php
                        $hinhSP = !empty($row['HinhAnh']) ? '../../assets/images/products/' . $row['HinhAnh'] : '../../assets/images/default-image.jpg';
                        ?>
                        <img src="<?php echo $hinhSP; ?>" alt="Hình ảnh sản phẩm" style="width: 50px; height: 50px;">
                    </td>
                    <td><?php echo $row['TenTH']; ?></td>
                    <td><?php echo $row['TrongLuong']; ?>
                        <?php echo $row['DonVi']; ?>
                    </td>
                    <td><?php echo number_format($row['Gia'], 0, ',', '.'); ?>đ</td>
                    <td><?php echo $row['SoLuong']; ?></td>
                    <td><?php echo $row['NgayTao']; ?></td>
                    <td>
                        <a class="btn btn-primary" href="edit.php?id=<?php echo $row['MaSP']; ?>"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger" href="delete.php?id=<?php echo $row['MaSP']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <div class="row">

    </div>
</div>