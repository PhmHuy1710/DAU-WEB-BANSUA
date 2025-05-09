<?php
require_once('layouts/client/header.php');

$queryTH = "SELECT * FROM ThuongHieu ORDER BY TenTH ASC";
$resultTH = mysqli_query($conn, $queryTH);

$locTH = "";
if (isset($_GET['brand']) && !empty($_GET['brand'])) {
    $maTH = mysqli_real_escape_string($conn, $_GET['brand']);
    $locTH = " WHERE sp.MaTH = '$maTH'";
}

$locTK = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $tuKhoa = mysqli_real_escape_string($conn, $_GET['search']);
    if (empty($locTH)) {
        $locTK = " WHERE sp.TenSP LIKE '%$tuKhoa%'";
    } else {
        $locTK = " AND sp.TenSP LIKE '%$tuKhoa%'";
    }
}

$locGia = "";
if (isset($_GET['price']) && !empty($_GET['price'])) {
    $khoangGia = explode('-', $_GET['price']);
    $giaMin = (int)$khoangGia[0];
    $giaMax = (int)$khoangGia[1];

    if ($giaMax === 0) {
        $locGia = (empty($locTH) && empty($locTK)) ?
            " WHERE sp.Gia >= $giaMin" :
            " AND sp.Gia >= $giaMin";
    } else {
        $locGia = (empty($locTH) && empty($locTK)) ?
            " WHERE sp.Gia BETWEEN $giaMin AND $giaMax" :
            " AND sp.Gia BETWEEN $giaMin AND $giaMax";
    }
}

$sqlSP = "SELECT sp.*, th.TenTH 
            FROM SanPham sp 
            LEFT JOIN ThuongHieu th ON sp.MaTH = th.MaTH" .
    $locTH . $locTK . $locGia .
    " ORDER BY sp.NgayTao DESC";
$kqSP = mysqli_query($conn, $sqlSP);

$tenTHHT = "";
if (isset($_GET['brand']) && !empty($_GET['brand'])) {
    $maTH = mysqli_real_escape_string($conn, $_GET['brand']);
    $sqlTH = "SELECT TenTH FROM ThuongHieu WHERE MaTH = '$maTH'";
    $kqTH = mysqli_query($conn, $sqlTH);
    if (mysqli_num_rows($kqTH) > 0) {
        $dongTH = mysqli_fetch_assoc($kqTH);
        $tenTHHT = $dongTH['TenTH'];
    }
}
?>

<main>
    <div class="container">
        <div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fas fa-home"></i> Trang chủ</a></li>
                <li class="active">
                    <?php if (!empty($tenTHHT)): ?>
                        <span><i class="fas fa-tag"></i> <?php echo $tenTHHT; ?></span>
                    <?php elseif (isset($_GET['search'])): ?>
                        <span><i class="fas fa-search"></i> Kết quả tìm kiếm</span>
                    <?php else: ?>
                        <span><i class="fas fa-box"></i> Tất cả sản phẩm</span>
                    <?php endif; ?>
                </li>
            </ul>
        </div>

        <div class="page-grid products-page-container">
            <aside class="products-sidebar fade-in" style="animation-delay: 0.2s;">
                <div class="sidebar-card brand-sidebar">
                    <h4 class="sidebar-title">Thương hiệu</h4>
                    <ul class="brand-list">
                        <li class="brand-item <?php echo !isset($_GET['brand']) ? 'active' : ''; ?>">
                            <a href="products.php" class="brand-link">
                                <i class="fas fa-list brand-icon-all"></i>
                                <span class="brand-name">Tất cả thương hiệu</span>
                            </a>
                        </li>
                        <?php
                        if (mysqli_num_rows($resultTH) > 0) {
                            while ($dongTH = mysqli_fetch_assoc($resultTH)) {
                                $hinhTH = !empty($dongTH['HinhAnh']) ? 'assets/images/brands/' . $dongTH['HinhAnh'] : 'assets/images/default-image.jpg';
                                $maTH = $dongTH['MaTH'];
                                $tenTH = $dongTH['TenTH'];
                                $dangHD = isset($_GET['brand']) && $_GET['brand'] === $maTH;
                        ?>
                                <li class="brand-item <?php echo $dangHD ? 'active' : ''; ?>">
                                    <a href="products.php?brand=<?php echo $maTH; ?>" class="brand-link">
                                        <img src="<?php echo $hinhTH; ?>" alt="<?php echo $tenTH; ?>" class="brand-icon">
                                        <span class="brand-name"><?php echo $tenTH; ?></span>
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

                <div class="sidebar-card product-filter">
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

            <div class="products-content fade-in" style="animation-delay: 0.3s;">
                <div class="products-header">
                    <h1 class="products-title">
                        <?php if (!empty($tenTHHT)): ?>
                            Sản phẩm <?php echo $tenTHHT; ?>
                        <?php elseif (isset($_GET['search'])): ?>
                            Kết quả tìm kiếm: "<?php echo htmlspecialchars($_GET['search']); ?>"
                        <?php else: ?>
                            Tất cả sản phẩm
                        <?php endif; ?>
                    </h1>
                    <div class="products-count">
                        Hiển thị <?php echo mysqli_num_rows($kqSP); ?> sản phẩm
                    </div>
                </div>

                <div class="products-container">
                    <?php
                    if (mysqli_num_rows($kqSP) > 0) {
                        while ($dong = mysqli_fetch_assoc($kqSP)) {
                            $hinhSP = !empty($dong['HinhAnh']) ? 'assets/images/products/' . $dong['HinhAnh'] : 'assets/images/default-image.jpg';
                            $maSP = $dong['MaSP'];
                            $tenSP = $dong['TenSP'];
                            $giaSP = number_format($dong['Gia'], 0, ',', '.');
                            $thuongHieu = isset($dong['TenTH']) ? $dong['TenTH'] : 'Không xác định';
                    ?>
                            <div class="product-item scale-in" style="animation-delay: 0.3s;">
                                <div class="product-card">
                                    <div class="product-image-container">
                                        <img src="<?php echo $hinhSP; ?>" class="product-image" alt="<?php echo $tenSP; ?>">
                                        <div class="product-overlay"></div>
                                        <div class="product-brand"><?php echo $thuongHieu; ?></div>
                                    </div>
                                    <div class="product-content">
                                        <h5 class="product-title"><?php echo $tenSP; ?></h5>
                                        <p class="product-info">
                                            <i class="fas fa-weight"></i> <?php echo $dong['TrongLuong'] . ' ' . $dong['DonVi']; ?>
                                        </p>
                                        <p class="product-price"><?php echo $giaSP; ?>đ</p>
                                        <div class="product-actions">
                                            <a href="<?php echo 'product-detail.php?id=' . $maSP; ?>" class="action-btn btn-detail">
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