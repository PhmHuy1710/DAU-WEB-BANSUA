<?php
require_once('layouts/client/header.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm - <?php echo SITE_NAME; ?></title>
</head>

<?php

$brand_sql = "SELECT * FROM ThuongHieu ORDER BY TenTH ASC";
$brand_result = mysqli_query($conn, $brand_sql);

$product_sql = "SELECT * FROM SanPham ORDER BY TenSP ASC";
$product_result = mysqli_query($conn, $product_sql);
?>

<body>
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="brand-sidebar">
                    <h4 class="sidebar-title">Thương hiệu</h4>
                    <ul class="brand-list">
                        <?php
                        if (mysqli_num_rows($brand_result) > 0) {
                            while ($row = mysqli_fetch_assoc($brand_result)) {
                                $brandImage = !empty($row['HinhAnh']) ? '/assets/images/brands/' . $row['HinhAnh'] : 'assets/images/default-image.jpg';
                                $brandId = $row['MaTH'];
                                $brandName = $row['TenTH'];
                        ?>
                                <li class="brand-item">
                                    <a href="products.php?brand=<?php echo $brandId; ?>" class="brand-link">
                                        <img src="<?php echo $brandImage; ?>" alt="<?php echo $brandName; ?>" class="brand-icon">
                                        <span class="brand-name"><?php echo $brandName; ?></span>
                                    </a>
                                </li>
                        <?php
                            }
                        } else {
                            echo '<li class="no-brands">Không có thương hiệu nào</li>';
                        }
                        
                        ?>
                    </ul>
                </div>
            </div>

            <div class="col-lg-9 col-md-8">
                <div class="products-container">
                    <h2 class="section-title">Danh sách sản phẩm</h2>
                    <div class="row">
                        <?php 
                        if(mysqli_num_rows($product_result) > 0){
                            while($row = mysqli_fetch_assoc($product_result)){
                                $productImage = !empty($row['HinhAnh']) ? '/assets/images/products/' . $row['HinhAnh'] : 'assets/images/default-image.jpg';
                                $productId = $row['MaSP'];
                                $productName = $row['TenSP'];
                                $productPrice = $row['Gia'];
                            ?>
                       


                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card product-card">
                                <div class="product-image">
                                    <img src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <div class="product-info">
                                        <h5 class="card-title"><?php echo $productName; ?></h5>
                                        <p class="card-text"><?php echo $productPrice; ?></p>
                                        <a href="product.php?id=<?php echo $productId; ?>" class="btn btn-primary">Xem chi tiết</a>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                        <?php
                        }
                        } else {
                            echo '<div class="col-12 text-center">Không có sản phẩm nào</div>';
                        }
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
require_once('layouts/client/footer.php');
?>