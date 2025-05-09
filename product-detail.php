<?php
ob_start();
require_once('layouts/client/header.php');
require_once('includes/session.php');
// Lấy thông tin sản phẩm
if (isset($_GET['id'])) {
    $product_id = mysqli_real_escape_string($conn, $_GET['id']);
    $product_sql = "SELECT sp.*, dm.TenDM, th.TenTH, th.HinhAnh as BrandLogo
                    FROM SanPham sp
                    LEFT JOIN DanhMuc dm ON sp.MaDM = dm.MaDM
                    LEFT JOIN ThuongHieu th ON sp.MaTH = th.MaTH
                    WHERE sp.MaSP = '$product_id'";
    $product_result = mysqli_query($conn, $product_sql);

    if (!$product_result || mysqli_num_rows($product_result) == 0) {
        header('Location: products.php');
        exit;
    }

    $product = mysqli_fetch_assoc($product_result);
    $productImage = !empty($product['HinhAnh']) ? 'assets/images/products/' . $product['HinhAnh'] : 'assets/images/default-image.jpg';
    $productBrandImage = !empty($product['BrandLogo']) ? 'assets/images/brands/' . $product['BrandLogo'] : 'assets/images/default-image.jpg';
}
?>

<main>
    <div class="container">
        <div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fas fa-home"></i> Trang chủ</a></li>
                <li><a href="products.php"><i class="fas fa-box"></i> Sản phẩm</a></li>
                <?php if (isset($product['MaDM']) && isset($product['TenDM'])): ?>
                    <li><a href="products.php?category=<?php echo $product['MaDM']; ?>"><i class="fas fa-th-list"></i> <?php echo $product['TenDM']; ?></a></li>
                <?php endif; ?>
                <li class="active"><span><i class="fas fa-info-circle"></i> <?php echo $product['TenSP']; ?></span></li>
            </ul>
        </div>

        <?php if (isset($product)): ?>
            <!-- Product Detail Section -->
            <div class="product-detail-container">
                <div class="product-detail-left fade-in" style="animation-delay: 0.2s;">
                    <div class="product-detail-image">
                        <img src="<?php echo $productImage; ?>" alt="<?php echo $product['TenSP']; ?>" class="main-image">
                        <?php if (!empty($product['TenTH'])): ?>
                            <div class="product-brand-badge">
                                <img src="<?php echo $productBrandImage; ?>" alt="<?php echo $product['TenTH']; ?>" class="brand-badge-image">
                                <span><?php echo $product['TenTH']; ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($product['SoLuong'] > 0): ?>
                            <div class="product-status in-stock"><i class="fas fa-check-circle"></i> Còn hàng</div>
                        <?php else: ?>
                            <div class="product-status out-of-stock"><i class="fas fa-times-circle"></i> Hết hàng</div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="product-detail-right scale-in" style="animation-delay: 0.3s;">
                    <h1 class="product-detail-title"><?php echo $product['TenSP']; ?></h1>

                    <div class="product-meta">
                        <div class="meta-item">
                            <span class="meta-label"><i class="fas fa-industry"></i> Thương hiệu:</span>
                            <span class="meta-value"><?php echo $product['TenTH']; ?></span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label"><i class="fas fa-th-list"></i> Danh mục:</span>
                            <span class="meta-value"><?php echo $product['TenDM']; ?></span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label"><i class="fas fa-weight"></i> Khối lượng:</span>
                            <span class="meta-value"><?php echo $product['TrongLuong'] . ' ' . $product['DonVi']; ?></span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label"><i class="fas fa-box"></i> Tình trạng:</span>
                            <span class="meta-value <?php echo ($product['SoLuong'] > 0) ? 'text-success' : 'text-danger'; ?>">
                                <?php echo ($product['SoLuong'] > 0) ? 'Còn ' . $product['SoLuong'] . ' sản phẩm' : 'Hết hàng'; ?>
                            </span>
                        </div>
                    </div>

                    <div class="product-price">
                        <span class="current-price"><?php echo number_format($product['Gia'], 0, ',', '.'); ?>đ</span>
                    </div>

                    <div class="product-description">
                        <h3 class="description-title">Mô tả sản phẩm</h3>
                        <div class="description-content">
                            <?php if (!empty($product['MoTa'])): ?>
                                <?php echo $product['MoTa']; ?>
                            <?php else: ?>
                                <p><em><strong><?php echo $product['TenSP']; ?></strong></em> dạng bịch tiện lợi, bổ sung chất đạm, canxi, Vitamin B2, kali. Sữa tươi <em><strong><?php echo $product['TenTH']; ?></strong></em> là nhãn hiệu sữa tươi được rất nhiều trẻ em lẫn người lớn ưa chuộng, bổ dung đầy đủ dinh đưỡng cho hoạt động ngày dài.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php
                    if (isLoggedIn()) {
                        echo '
                    <form method="POST" action="cart.php" class="cart-form">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="product_id" value="' . $product['MaSP'] . '">

                        <div class="quantity-controls">
                            <label for="quantity">Số lượng:</label>
                            <div class="quantity-wrapper">
                                <button type="button" class="quantity-btn minus-btn" id="decrementBtn"><i class="fas fa-minus"></i></button>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" max="' . $product['SoLuong'] . '" class="quantity-input">
                                <button type="button" class="quantity-btn plus-btn" id="incrementBtn"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="product-actions">
                            <button type="submit" class="btn btn-primary add-to-cart-btn" ' . (($product['SoLuong'] <= 0) ? 'disabled' : '') . '>
                                <i class="fas fa-shopping-cart"></i> Thêm vào giỏ
                            </button>
                            <a href="products.php" class="btn btn-outline-primary continue-btn">
                                <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
                            </a>
                        </div>';
                    } else {
                        echo '<div class="product-actions">
                                <a href="login.php" class="btn btn-primary">Đăng nhập để mua hàng</a>
                                </div>';
                    }
                    ?>
                    </form>

                </div>
            </div>

            <!-- Product Details Tabs -->
            <div class="product-tabs fade-in" style="animation-delay: 0.4s;">
                <div class="tabs-header">
                    <button class="tab-btn active" data-tab="details">Chi tiết sản phẩm</button>
                    <button class="tab-btn" data-tab="delivery">Thông tin giao hàng</button>
                </div>
                <div class="tabs-content">
                    <div class="tab-panel active" id="details-panel">
                        <div class="product-specifications">
                            <h3>Thông số sản phẩm</h3>
                            <table class="specs-table">
                                <tr>
                                    <td>Loại sữa</td>
                                    <td><?php echo $product['TenDM']; ?></td>
                                </tr>
                                <tr>
                                    <td>Dung tích/Khối lượng</td>
                                    <td><?php echo $product['TrongLuong'] . ' ' . $product['DonVi']; ?></td>
                                </tr>
                                <tr>
                                    <td>Phù hợp với</td>
                                    <td>Trẻ từ 1 tuổi trở lên</td>
                                </tr>
                                <tr>
                                    <td>Thành phần</td>
                                    <td>Sữa tươi, nước, bột sữa, đường,...</td>
                                </tr>
                                <tr>
                                    <td>Bảo quản</td>
                                    <td>Bảo quản nơi khô ráo, thoáng mát, tránh ánh nắng chiếu trực tiếp</td>
                                </tr>
                                <tr>
                                    <td>Thương hiệu</td>
                                    <td><?php echo $product['TenTH']; ?></td>
                                </tr>
                                <tr>
                                    <td>Sản xuất tại</td>
                                    <td>Việt Nam</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="tab-panel" id="delivery-panel">
                        <div class="delivery-info">
                            <div class="delivery-item">
                                <div class="delivery-icon">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="delivery-content">
                                    <h4>Giao hàng toàn quốc</h4>
                                    <p>Giao hàng nhanh chóng trong vòng 1-3 ngày đối với các thành phố lớn và 3-5 ngày đối với các tỉnh khác.</p>
                                </div>
                            </div>
                            <div class="delivery-item">
                                <div class="delivery-icon">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <div class="delivery-content">
                                    <h4>Thanh toán khi nhận hàng</h4>
                                    <p>Thanh toán khi nhận hàng (COD) hoặc chuyển khoản trước.</p>
                                </div>
                            </div>
                            <div class="delivery-item">
                                <div class="delivery-icon">
                                    <i class="fas fa-exchange-alt"></i>
                                </div>
                                <div class="delivery-content">
                                    <h4>Đổi trả linh hoạt</h4>
                                    <p>Đổi trả sản phẩm trong vòng 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



        <?php else: ?>
            <div class="product-not-found">
                <i class="fas fa-exclamation-circle"></i>
                <h2>Sản phẩm không tồn tại</h2>
                <p>Xin lỗi, chúng tôi không tìm thấy sản phẩm bạn đang tìm kiếm.</p>
                <a href="products.php" class="btn btn-primary">Xem tất cả sản phẩm</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Xử lý tăng giảm số lượng
        const quantityInput = document.getElementById('quantity');
        const decrementBtn = document.getElementById('decrementBtn');
        const incrementBtn = document.getElementById('incrementBtn');

        if (quantityInput && decrementBtn && incrementBtn) {
            const maxQuantity = parseInt(quantityInput.getAttribute('max')) || 99;

            decrementBtn.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });

            incrementBtn.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue < maxQuantity) {
                    quantityInput.value = currentValue + 1;
                }
            });

            quantityInput.addEventListener('change', function() {
                let currentValue = parseInt(this.value);
                if (isNaN(currentValue) || currentValue < 1) {
                    this.value = 1;
                } else if (currentValue > maxQuantity) {
                    this.value = maxQuantity;
                }
            });
        }

        // Xử lý tabs
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabPanels = document.querySelectorAll('.tab-panel');

        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Loại bỏ active khỏi tất cả các tab
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabPanels.forEach(panel => panel.classList.remove('active'));

                // Thêm active cho tab được nhấp
                this.classList.add('active');
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId + '-panel').classList.add('active');
            });
        });

        // Xử lý thêm vào giỏ hàng
        const addToCartForm = document.querySelector('.cart-form');
        if (addToCartForm) {
            addToCartForm.addEventListener('submit', function(e) {
                const quantityInput = this.querySelector('input[name="quantity"]');
                if (parseInt(quantityInput.value) < 1) {
                    e.preventDefault();
                    showToast('Vui lòng chọn số lượng hợp lệ', 'error');
                }
            });
        }

        // Hiển thị toast thông báo
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

            setTimeout(() => {
                toast.classList.add('show');
            }, 100);

            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }
    });
</script>

<?php
require_once('layouts/client/footer.php');
ob_end_flush(); // End output buffering
?>