<?php
require_once('layouts/client/header.php');

$sql = "SELECT sp.*, th.TenTH
         FROM SanPham sp
         LEFT JOIN ThuongHieu th ON sp.MaTH = th.MaTH
         ORDER BY sp.NgayTao DESC LIMIT 3";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Hãng sữa
$brand_sql = "SELECT * FROM ThuongHieu ORDER BY TenTH";
$brand_result = mysqli_query($conn, $brand_sql);

if (!$brand_result) {
    die("Brand query failed: " . mysqli_error($conn));
}
?>

<!-- Hero Section -->
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

<!-- New Products Section -->
<section class="new-products-section">
    <div class="container">
        <div class="section-heading">
            <h2>Sản Phẩm Mới Nhất</h2>
        </div>
        <div class="products-container">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
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
                                    <i class="fas fa-star"></i> Sản phẩm mới
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
                <?php } ?>
            <?php } else { ?>
                <div class="col-12 text-center">Không có sản phẩm nào</div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
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

<!-- Brands Section -->
<section id="brands" class="brands-section">
    <div class="container">
        <div class="section-heading">
            <h2>Thương Hiệu Nổi Bật</h2>
        </div>
        <div class="brands-container">
            <?php
            if (mysqli_num_rows($brand_result) > 0) {
                while ($brand = mysqli_fetch_assoc($brand_result)) {
                    $brandName = $brand['TenTH'];
                    $brandLogo = !empty($brand['HinhAnh']) ? 'assets/images/brands/' . $brand['HinhAnh'] : 'assets/images/default-image.jpg';
            ?>
                    <a href="products.php?brand=<?php echo $brand['MaTH']; ?>" class="brand-item scale-in" style="animation-delay: 0.2s;">
                        <img src="<?php echo $brandLogo; ?>" alt="<?php echo $brandName; ?>" class="brand-logo">
                        <div class="brand-name"><?php echo $brandName; ?></div>
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

<!-- JavaScript cho hiệu ứng -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Kích hoạt animation khi cuộn trang
        const fadeElements = document.querySelectorAll('.fade-in');
        const scaleElements = document.querySelectorAll('.scale-in');

        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        // Xử lý hiệu ứng fadeIn
        const fadeObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        fadeElements.forEach(el => {
            el.style.animationPlayState = 'paused';
            fadeObserver.observe(el);
        });

        // Xử lý hiệu ứng scaleIn
        const scaleObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        scaleElements.forEach(el => {
            el.style.animationPlayState = 'paused';
            scaleObserver.observe(el);
        });

        // Xử lý toast notification
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = 'toast-notification';

            if (type === 'success') {
                toast.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
                toast.style.backgroundColor = '#28a745';
            } else if (type === 'error') {
                toast.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
                toast.style.backgroundColor = '#dc3545';
            } else if (type === 'info') {
                toast.innerHTML = `<i class="fas fa-info-circle"></i> ${message}`;
                toast.style.backgroundColor = '#17a2b8';
            }

            document.body.appendChild(toast);

            // Hiển thị toast
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);

            // Ẩn toast sau 3 giây
            setTimeout(() => {
                toast.classList.remove('show');

                // Xóa toast khỏi DOM sau khi animation kết thúc
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }

        // Xử lý biểu mẫu tìm kiếm
        const searchForm = document.querySelector('.hero-search');
        if (searchForm) {
            searchForm.addEventListener('submit', function(e) {
                const searchInput = this.querySelector('.search-input');
                if (searchInput.value.trim() === '') {
                    e.preventDefault();
                    showToast('Vui lòng nhập từ khóa tìm kiếm', 'info');
                }
            });
        }

        // Tạo hiệu ứng scroll smooth đến phần Thương hiệu
        const brandLink = document.querySelector('a[href="#brands"]');
        if (brandLink) {
            brandLink.addEventListener('click', function(e) {
                e.preventDefault();
                const brandsSection = document.getElementById('brands');
                if (brandsSection) {
                    brandsSection.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        }
    });
</script>

<?php
require_once('layouts/client/footer.php');
?>