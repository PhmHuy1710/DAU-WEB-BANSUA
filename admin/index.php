<?php
require_once("../layouts/admin/header.php");
?>

<style>
    .banner {
        margin-top: 20px;
        width: 100%;
        height: 70px;
        background: #60B5FF;
        border-radius: 10px;
    }

    .banner h2 {
        padding: 8px;
        font-size: 30px;
        color:white#ccc;
        text-align: center;
        font-size: 40px;

    }

    .main {
        margin: 20px;
        display: flex;
        justify-content: space-between;
    }

    .item {
        width: 250px;
        height: 150px;
        text-align: center;
        border: 1px solid #ccc;
        margin: 10px;
        display: inline-block;
        border-radius: 10px;
        font-size: 20px;
        padding-top: 10px;
        background:rgb(224, 244, 45);
    }

    .item-title a {
        text-decoration: none;
    }

    .item-description {
        margin-top: 20px;
        font-size: 20px;
        font-weight: bold;
    }
</style>

<body>

    <div class="container">
        <div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
            <ul class="breadcrumb">
                <li class="active"><a><i class="fas fa-home"></i> Trang chủ</a></li>

            </ul>
        </div>
        <div class="banner">
            <h2>Thống Kê</h2>
        </div>
        <div class="main">
            <div class="item">
                <div class="item-title">
                    <a class="" href="products/index.php" style="color:blue;">SẢN PHẨM</a>
                </div>
                <div class="item-description">
                    <?php
                    $sql = "SELECT COUNT(*) AS TongSoLuong FROM SanPham";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $tongSoLuong = $row['TongSoLuong'];
                    ?>
                    <p><?php echo $tongSoLuong; ?></p>
                </div>
            </div>
            <div class="item">
                <div class="item-title">
                    <a class="" href="customers/index.php" style="color:blue;">KHÁCH HÀNG</a>
                </div>
                <div class="item-description">
                    <?php
                    $sql = "SELECT COUNT(*) AS TongSoLuong FROM KhachHang";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $tongSoLuong = $row['TongSoLuong'];
                    ?>
                    <p><?php echo $tongSoLuong; ?></p>
                </div>
            </div>
            <div class="item">
                <div class="item-title">
                    <a class="" href="orders/index.php" style="color:blue;">ĐƠN HÀNG</a>
                </div>
                <div class="item-description">
                    <?php
                    $sql = "SELECT COUNT(*) AS TongSoLuong FROM HoaDon";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $tongSoLuong = $row['TongSoLuong'];
                    ?>
                    <p><?php echo $tongSoLuong; ?></p>
                </div>
            </div>
            <div class="item">
                <div class="item-title">
                    <a class="" href="brands/index.php" style="color:blue;">THƯƠNG HIỆU</a>
                </div>
                <div class="item-description">
                    <?php
                    $sql = "SELECT COUNT(*) AS TongSoLuong FROM ThuongHieu";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $tongSoLuong = $row['TongSoLuong'];
                    ?>
                    <p><?php echo $tongSoLuong; ?></p>
                </div>
            </div>
        </div>

    </div>
</body>