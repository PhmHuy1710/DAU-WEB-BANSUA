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
$sql = "SELECT * FROM ThuongHieu ORDER BY TenTH ASC";
$result = mysqli_query($conn, $sql);
?>

<body>
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="brand-sidebar">
                    <h4 class="sidebar-title">Thương hiệu</h4>
                    <ul class="brand-list">
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $brandImage = !empty($row['HinhAnh']) ? $row['HinhAnh'] : 'assets/images/default-image.jpg';
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
                        mysqli_close($conn);
                        ?>
                    </ul>
                </div>
            </div>

            <div class="col-lg-9 col-md-8">
                <div class="products-container">
                    <h2 class="section-title">Danh sách sản phẩm</h2>
                    <div class="row">

                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card product-card">
                                <div class="product-image">Sản phẩm 1</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card product-card">
                                <div class="product-image">Sản phẩm 2</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card product-card">
                                <div class="product-image">Sản phẩm 3</div>
                            </div>
                        </div>
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