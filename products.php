<?php
require_once('layouts/client/header.php');

$brand_sql = "SELECT * FROM ThuongHieu ORDER BY TenTH ASC";
$brand_result = mysqli_query($conn, $brand_sql);

// Xử lý lọc theo thương hiệu
$brand_filter = "";
if (isset($_GET['brand']) && !empty($_GET['brand'])) {
    $brand_id = mysqli_real_escape_string($conn, $_GET['brand']);
    $brand_filter = " WHERE sp.MaTH = '$brand_id'";
}

// Xử lý tìm kiếm
$search_filter = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_term = mysqli_real_escape_string($conn, $_GET['search']);
    if (empty($brand_filter)) {
        $search_filter = " WHERE sp.TenSP LIKE '%$search_term%'";
    } else {
        $search_filter = " AND sp.TenSP LIKE '%$search_term%'";
    }
}

$product_sql = "SELECT sp.*, th.TenTH 
                FROM SanPham sp 
                LEFT JOIN ThuongHieu th ON sp.MaTH = th.MaTH" .
    $brand_filter . $search_filter .
    " ORDER BY sp.NgayTao DESC";
$product_result = mysqli_query($conn, $product_sql);

// Lấy tên thương hiệu đang lọc (nếu có)
$current_brand_name = "";
if (isset($_GET['brand']) && !empty($_GET['brand'])) {
    $brand_id = mysqli_real_escape_string($conn, $_GET['brand']);
    $get_brand_sql = "SELECT TenTH FROM ThuongHieu WHERE MaTH = '$brand_id'";
    $get_brand_result = mysqli_query($conn, $get_brand_sql);
    if (mysqli_num_rows($get_brand_result) > 0) {
        $brand_row = mysqli_fetch_assoc($get_brand_result);
        $current_brand_name = $brand_row['TenTH'];
    }
}
?>

<main>
    <div class="container">
        <!-- Breadcrumb -->
        <div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fas fa-home"></i> Trang chủ</a></li>
                <li class="active">
                    <?php if (!empty($current_brand_name)): ?>
                        <span><i class="fas fa-tag"></i> <?php echo $current_brand_name; ?></span>
                    <?php elseif (isset($_GET['search'])): ?>
                        <span><i class="fas fa-search"></i> Kết quả tìm kiếm</span>
                    <?php else: ?>
                        <span><i class="fas fa-box"></i> Tất cả sản phẩm</span>
                    <?php endif; ?>
                </li>
            </ul>
        </div>

        <div class="products-page-container">
            <!-- Sidebar -->
            <aside class="products-sidebar fade-in" style="animation-delay: 0.2s;">
                <div class="brand-sidebar">
                    <h4 class="sidebar-title">Thương hiệu</h4>
                    <ul class="brand-list">
                        <li class="brand-item <?php echo !isset($_GET['brand']) ? 'active' : ''; ?>">
                            <a href="products.php" class="brand-link">
                                <i class="fas fa-list brand-icon-all"></i>
                                <span class="brand-name">Tất cả thương hiệu</span>
                            </a>
                        </li>
                        <?php
                        if (mysqli_num_rows($brand_result) > 0) {
                            while ($row = mysqli_fetch_assoc($brand_result)) {
                                $brandImage = !empty($row['HinhAnh']) ? 'assets/images/brands/' . $row['HinhAnh'] : 'assets/images/default-image.jpg';
                                $brandId = $row['MaTH'];
                                $brandName = $row['TenTH'];
                                $isActive = isset($_GET['brand']) && $_GET['brand'] === $brandId;
                        ?>
                                <li class="brand-item <?php echo $isActive ? 'active' : ''; ?>">
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

                <div class="product-filter">
                    <h4 class="sidebar-title">Bộ lọc</h4>
                    <form action="products.php" method="GET" class="filter-form">
                        <?php if (isset($_GET['brand'])): ?>
                            <input type="hidden" name="brand" value="<?php echo $_GET['brand']; ?>">
                        <?php endif; ?>

                        <div class="filter-group">
                            <label for="price-range">Khoảng giá</label>
                            <select name="price" id="price-range" class="filter-select">
                                <option value="">Tất cả mức giá</option>
                                <option value="0-50000">Dưới 50.000đ</option>
                                <option value="50000-100000">50.000đ - 100.000đ</option>
                                <option value="100000-500000">100.000đ - 500.000đ</option>
                                <option value="500000-0">Trên 500.000đ</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary filter-btn">
                            <i class="fas fa-filter"></i> Lọc
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Products List -->
            <div class="products-content fade-in" style="animation-delay: 0.3s;">
                <div class="products-header">
                    <h1 class="products-title">
                        <?php if (!empty($current_brand_name)): ?>
                            Sản phẩm <?php echo $current_brand_name; ?>
                        <?php elseif (isset($_GET['search'])): ?>
                            Kết quả tìm kiếm: "<?php echo htmlspecialchars($_GET['search']); ?>"
                        <?php else: ?>
                            Tất cả sản phẩm
                        <?php endif; ?>
                    </h1>
                    <div class="products-count">
                        Hiển thị <?php echo mysqli_num_rows($product_result); ?> sản phẩm
                    </div>
                </div>

                <div class="products-container">
                    <?php
                    if (mysqli_num_rows($product_result) > 0) {
                        while ($row = mysqli_fetch_assoc($product_result)) {
                            $productImage = !empty($row['HinhAnh']) ? 'assets/images/products/' . $row['HinhAnh'] : 'assets/images/default-image.jpg';
                            $productId = $row['MaSP'];
                            $productName = $row['TenSP'];
                            $productPrice = number_format($row['Gia'], 0, ',', '.');
                            $productBrand = isset($row['TenTH']) ? $row['TenTH'] : 'Không xác định';
                    ?>
                            <div class="product-item scale-in" style="animation-delay: 0.3s;">
                                <div class="product-card">
                                    <div class="product-image-container">
                                        <img src="<?php echo $productImage; ?>" class="product-image" alt="<?php echo $productName; ?>">
                                        <div class="product-overlay"></div>
                                        <div class="product-brand"><?php echo $productBrand; ?></div>
                                    </div>
                                    <div class="product-content">
                                        <h5 class="product-title"><?php echo $productName; ?></h5>
                                        <p class="product-info">
                                            <i class="fas fa-weight"></i> <?php echo $row['TrongLuong'] . ' ' . $row['DonVi']; ?>
                                        </p>
                                        <p class="product-price"><?php echo $productPrice; ?>đ</p>
                                        <div class="product-actions">
                                            <a href="<?php echo 'product-detail.php?id=' . $productId; ?>" class="action-btn btn-detail">
                                                <i class="fas fa-eye"></i> Chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<div class="no-products"><i class="fas fa-search"></i> Không tìm thấy sản phẩm nào</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require_once('layouts/client/footer.php');
?>