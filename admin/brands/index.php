<?php
require_once("../../layouts/admin/header.php");

$thSQL = "SELECT * FROM `thuonghieu` WHERE 1";
$kq = mysqli_query($conn, $thSQL);
?>

<body>
    <div class="container">
        <div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
            <ul class="breadcrumb">
                <li><a href="../index.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="active">
                    <span><i class="fas fa-building"></i>Quản lý thương hiệu</span>
                </li>
            </ul>
        </div>
        <div class="main fade-in" style="animation-delay: 0.1s;">
            <a href="add.php" class="btnThem">Thêm thương hiệu</a>
        </div>
        <div class="inf fade-in" style="animation-delay: 0.1s;">
            <h2>Danh sách thương hiệu</h2>
        </div>
        <table border="1px" class="fade-in" style="animation-delay: 0.1s;">
            <tr>
                <th>Mã TH</th>
                <th>Tên thương hiệu</th>
                <th>Hình ảnh</th>
                <th>Mô tả</th>

                <th>Hành động</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($kq)) {
            ?>
                <tr>
                    <td><?php echo $row['MaTH']; ?></td>
                    <td><?php echo $row['TenTH']; ?></td>
                    <td><img src="../../assets/images/brands/<?php echo $row['HinhAnh']; ?>" alt="Hình ảnh thương hiệu" style="width: 50px; height: 50px;"></td>
                    <td><?php echo $row['MoTa']; ?></td>

                    <td>
                        <a class="btn btn-primary" href="edit.php?id=<?php echo $row['MaTH']; ?>"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger" href="delete.php?id=<?php echo $row['MaTH']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>

    </div>

</body>