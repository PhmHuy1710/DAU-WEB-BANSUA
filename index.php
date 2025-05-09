<?php
require_once('layouts/client/header.php');

$truyVan = "SELECT sp.*, th.TenTH
         FROM SanPham sp
         LEFT JOIN ThuongHieu th ON sp.MaTH = th.MaTH
         ORDER BY sp.NgayTao DESC LIMIT 3";
$ketQua = mysqli_query($conn, $truyVan);

if (!$ketQua) {
    die("Query failed: " . mysqli_error($conn));
}

$truyVanTH = "SELECT * FROM ThuongHieu ORDER BY TenTH";
$ketQuaTH = mysqli_query($conn, $truyVanTH);

if (!$ketQuaTH) {
    die("Brand query failed: " . mysqli_error($conn));
}
?>

<section class="hero-section">
    <div class="container">
        <div class="hero-content fade-in" style="animation-delay: 0.2s;">
            <h1 class="hero-title">Milky <span>Thế Giới Sữa</span></h1>
            <p class="hero-description">Cung cấp các sản phẩm sữa chất lượng từ các thương hiệu uy tín hàng đầu thế giới với giá cả hợp lý.</p>
            <form action="<?php echo 'products.php?search='; ?>" method="GET" class="hero-search">
                <div class="search-group">
                    <input type="text" name="search" class="search-input" placeholder="Tìm sản phẩm sữa...">
                    <button class="search-button" type="submit">
                        <i class="fas fa-search"></i> <span>Tìm kiếm</span>
                    </button>
                </div>
            </form>
            <div class="hero-buttons">
                <a href="products.php" class="btn btn-primary btn-lg">
                    <i class="fas fa-box"></i>Xem sản phẩm
                </a>
                <a href="#brands" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-tag"></i>Thương hiệu
                </a>
            </div>
        </div>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <div class="section-heading">
            <h2>Sản Phẩm Mới Nhất</h2>
        </div>
        <div class="products-container">
            <?php
            if (mysqli_num_rows($ketQua) > 0) {
                while ($dong = mysqli_fetch_assoc($ketQua)) {
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
                                    <i class="fas fa-star"></i> Sản phẩm mới
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
                <?php } ?>
            <?php } else { ?>
                <div class="col-12 text-center">Không có sản phẩm nào</div>
            <?php } ?>
        </div>
    </div>
</section>

<section class="section section-light">
    <div class="container">
        <div class="section-heading">
            <h2>Tại Sao Chọn Chúng Tôi</h2>
        </div>

        <div class="features-container">
            <div class="feature-item fade-in" style="animation-delay: 0.1s;">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h3 class="feature-title">Giao Hàng Nhanh</h3>
                    <p class="feature-description">Giao hàng miễn phí trong vòng 24h cho tất cả đơn hàng trên 500.000đ</p>
                </div>
            </div>

            <div class="feature-item fade-in" style="animation-delay: 0.3s;">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3 class="feature-title">Sản Phẩm Chính Hãng</h3>
                    <p class="feature-description">Cam kết 100% sản phẩm chất lượng, nguồn gốc rõ ràng từ các nhà sản xuất uy tín</p>
                </div>
            </div>

            <div class="feature-item fade-in" style="animation-delay: 0.5s;">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="feature-title">Hỗ Trợ 24/7</h3>
                    <p class="feature-description">Đội ngũ tư vấn viên luôn sẵn sàng hỗ trợ bạn mọi lúc</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="brands" class="section section-white">
    <div class="container">
        <div class="section-heading">
            <h2>Thương Hiệu Nổi Bật</h2>
        </div>
        <div class="brands-container">
            <?php
            if (mysqli_num_rows($ketQuaTH) > 0) {
                while ($thuongHieu = mysqli_fetch_assoc($ketQuaTH)) {
                    $tenTH = $thuongHieu['TenTH'];
                    $anhTH = !empty($thuongHieu['HinhAnh']) ? 'assets/images/brands/' . $thuongHieu['HinhAnh'] : 'assets/images/default-image.jpg';
            ?>
                    <a href="products.php?brand=<?php echo $thuongHieu['MaTH']; ?>" class="brand-item scale-in" style="animation-delay: 0.2s;">
                        <img src="<?php echo $anhTH; ?>" alt="<?php echo $tenTH; ?>" class="brand-logo">
                        <div class="brand-name"><?php echo $tenTH; ?></div>
                    </a>
            <?php
                }
            } else {
                echo '<div class="no-brands">Không có thương hiệu nào</div>';
            }
            ?>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const linkThuongHieu = document.querySelector('a[href="#brands"]');
        if (linkThuongHieu) {
            linkThuongHieu.addEventListener('click', function(e) {
                e.preventDefault();
                const phanThuongHieu = document.getElementById('brands');
                if (phanThuongHieu) {
                    phanThuongHieu.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        }

        const formTimKiem = document.querySelector('.hero-search');
        if (formTimKiem) {
            formTimKiem.addEventListener('submit', function(e) {
                const nhapTimKiem = this.querySelector('.search-input');
                if (nhapTimKiem.value.trim() === '') {
                    e.preventDefault();
                    if (typeof window.showToast === 'function') {
                        window.showToast('Vui lòng nhập từ khóa tìm kiếm', 'info');
                    }
                }
            });
        }
    });
</script>

<?php require_once('layouts/client/footer.php'); ?>