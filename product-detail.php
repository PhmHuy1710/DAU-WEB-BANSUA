<?php
ob_start();
require_once('layouts/client/header.php');
require_once('includes/session.php');

if (isset($_GET['id'])) {
    $maSP = mysqli_real_escape_string($conn, $_GET['id']);
    $truyVanSP = "SELECT sp.*, dm.TenDM, th.TenTH, th.HinhAnh as BrandLogo
                    FROM SanPham sp
                    LEFT JOIN DanhMuc dm ON sp.MaDM = dm.MaDM
                    LEFT JOIN ThuongHieu th ON sp.MaTH = th.MaTH
                    WHERE sp.MaSP = '$maSP'";
    $ketQuaSP = mysqli_query($conn, $truyVanSP);

    if (!$ketQuaSP || mysqli_num_rows($ketQuaSP) == 0) {
        header('Location: products.php');
        exit;
    }

    $sanPham = mysqli_fetch_assoc($ketQuaSP);
    $hinhSP = !empty($sanPham['HinhAnh']) ? 'assets/images/products/' . $sanPham['HinhAnh'] : 'assets/images/default-image.jpg';
    $hinhTH = !empty($sanPham['BrandLogo']) ? 'assets/images/brands/' . $sanPham['BrandLogo'] : 'assets/images/default-image.jpg';
}
?>

<main>
    <div class="container">
        <div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fas fa-home"></i> Trang chủ</a></li>
                <li><a href="products.php"><i class="fas fa-box"></i> Sản phẩm</a></li>
                <?php if (isset($sanPham['MaDM']) && isset($sanPham['TenDM'])): ?>
                    <li><a href="products.php?category=<?php echo $sanPham['MaDM']; ?>"><i class="fas fa-th-list"></i> <?php echo $sanPham['TenDM']; ?></a></li>
                <?php endif; ?>
                <li class="active"><span><i class="fas fa-info-circle"></i> <?php echo $sanPham['TenSP']; ?></span></li>
            </ul>
        </div>

        <?php if (isset($sanPham)): ?>
            <div class="product-detail-container">
                <div class="product-detail-left fade-in" style="animation-delay: 0.2s;">
                    <div class="product-detail-image">
                        <img src="<?php echo $hinhSP; ?>" alt="<?php echo $sanPham['TenSP']; ?>" class="main-image">
                        <?php if (!empty($sanPham['TenTH'])): ?>
                            <div class="product-brand-badge">
                                <img src="<?php echo $hinhTH; ?>" alt="<?php echo $sanPham['TenTH']; ?>" class="brand-badge-image">
                                <span><?php echo $sanPham['TenTH']; ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($sanPham['SoLuong'] > 0): ?>
                            <div class="product-status in-stock"><i class="fas fa-check-circle"></i> Còn hàng</div>
                        <?php else: ?>
                            <div class="product-status out-of-stock"><i class="fas fa-times-circle"></i> Hết hàng</div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="product-detail-right scale-in" style="animation-delay: 0.3s;">
                    <h1 class="product-detail-title"><?php echo $sanPham['TenSP']; ?></h1>

                    <div class="product-meta">
                        <div class="meta-item">
                            <span class="meta-label"><i class="fas fa-industry"></i> Thương hiệu:</span>
                            <span class="meta-value"><?php echo $sanPham['TenTH']; ?></span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label"><i class="fas fa-th-list"></i> Danh mục:</span>
                            <span class="meta-value"><?php echo $sanPham['TenDM']; ?></span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label"><i class="fas fa-weight"></i> Khối lượng:</span>
                            <span class="meta-value"><?php echo $sanPham['TrongLuong'] . ' ' . $sanPham['DonVi']; ?></span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label"><i class="fas fa-box"></i> Tình trạng:</span>
                            <span class="meta-value <?php echo ($sanPham['SoLuong'] > 0) ? 'text-success' : 'text-danger'; ?>">
                                <?php echo ($sanPham['SoLuong'] > 0) ? 'Còn ' . $sanPham['SoLuong'] . ' sản phẩm' : 'Hết hàng'; ?>
                            </span>
                        </div>
                    </div>

                    <div class="product-price">
                        <span class="current-price"><?php echo number_format($sanPham['Gia'], 0, ',', '.'); ?>đ</span>
                    </div>

                    <div class="product-description">
                        <h3 class="description-title">Mô tả sản phẩm</h3>
                        <div class="description-content">
                            <?php if (!empty($sanPham['MoTa'])): ?>
                                <?php echo $sanPham['MoTa']; ?>
                            <?php else: ?>
                                <p><em><strong><?php echo $sanPham['TenSP']; ?></strong></em> dạng bịch tiện lợi, bổ sung chất đạm, canxi, Vitamin B2, kali. Sữa tươi <em><strong><?php echo $sanPham['TenTH']; ?></strong></em> là nhãn hiệu sữa tươi được rất nhiều trẻ em lẫn người lớn ưa chuộng, bổ dung đầy đủ dinh đưỡng cho hoạt động ngày dài.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php
                    if (isLoggedIn()) {
                        echo '
                    <form method="POST" action="cart.php" class="cart-form">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="product_id" value="' . $sanPham['MaSP'] . '">

                        <div class="quantity-controls">
                            <label for="quantity">Số lượng:</label>
                            <div class="quantity-wrapper">
                                <button type="button" class="quantity-btn minus-btn" id="decrementBtn"><i class="fas fa-minus"></i></button>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" max="' . $sanPham['SoLuong'] . '" class="quantity-input">
                                <button type="button" class="quantity-btn plus-btn" id="incrementBtn"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="product-actions">
                            <button type="submit" class="btn btn-primary add-to-cart-btn" ' . (($sanPham['SoLuong'] <= 0) ? 'disabled' : '') . '>
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
                                    <td><?php echo $sanPham['TenDM']; ?></td>
                                </tr>
                                <tr>
                                    <td>Dung tích/Khối lượng</td>
                                    <td><?php echo $sanPham['TrongLuong'] . ' ' . $sanPham['DonVi']; ?></td>
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
                                    <td><?php echo $sanPham['TenTH']; ?></td>
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
                                    <p>Đổi trả sản phẩm trong vòng 7 ngày nếu có lỗi từ nhà sản xuất.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="related-products fade-in" style="animation-delay: 0.5s;">
                <h2 class="section-heading">Sản phẩm tương tự</h2>
                <div class="products-grid">
                    <?php
                    if (isset($sanPham['MaDM'])) {
                        $maDM = $sanPham['MaDM'];
                        $maSPHT = $sanPham['MaSP'];
                        $truyVanLQ = "SELECT sp.*, th.TenTH
                                       FROM SanPham sp
                                       LEFT JOIN ThuongHieu th ON sp.MaTH = th.MaTH
                                       WHERE sp.MaDM = '$maDM' AND sp.MaSP != '$maSPHT'
                                       ORDER BY RAND() LIMIT 4";
                        $ketQuaLQ = mysqli_query($conn, $truyVanLQ);

                        if (mysqli_num_rows($ketQuaLQ) > 0) {
                            while ($spLienQuan = mysqli_fetch_assoc($ketQuaLQ)) {
                                $hinhSPLQ = !empty($spLienQuan['HinhAnh']) ? 'assets/images/products/' . $spLienQuan['HinhAnh'] : 'assets/images/default-image.jpg';
                                $giaSPLQ = number_format($spLienQuan['Gia'], 0, ',', '.');
                    ?>
                                <div class="product-item scale-in" style="animation-delay: 0.2s;">
                                    <div class="product-card">
                                        <div class="product-image-container">
                                            <img src="<?php echo $hinhSPLQ; ?>" class="product-image" alt="<?php echo $spLienQuan['TenSP']; ?>">
                                            <div class="product-overlay"></div>
                                            <div class="product-brand"><?php echo $spLienQuan['TenTH']; ?></div>
                                        </div>
                                        <div class="product-content">
                                            <h5 class="product-title"><?php echo $spLienQuan['TenSP']; ?></h5>
                                            <p class="product-price"><?php echo $giaSPLQ; ?>đ</p>
                                            <div class="product-actions">
                                                <a href="<?php echo 'product-detail.php?id=' . $spLienQuan['MaSP']; ?>" class="action-btn btn-detail">
                                                    <i class="fas fa-eye"></i> Chi tiết
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                        } else {
                            echo '<div class="no-products">Không có sản phẩm tương tự.</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">Không tìm thấy sản phẩm.</div>
        <?php endif; ?>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nutTab = document.querySelectorAll('.tab-btn');
        const thanhPhanTab = document.querySelectorAll('.tab-panel');

        nutTab.forEach(button => {
            button.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');

                nutTab.forEach(btn => btn.classList.remove('active'));
                thanhPhanTab.forEach(panel => panel.classList.remove('active'));

                this.classList.add('active');
                document.getElementById(tabId + '-panel').classList.add('active');
            });
        });

        const nutTang = document.getElementById('incrementBtn');
        const nutGiam = document.getElementById('decrementBtn');
        const nhapSL = document.getElementById('quantity');

        if (nutTang && nutGiam && nhapSL) {
            const maxSL = parseInt(nhapSL.getAttribute('max'));

            nutTang.addEventListener('click', function() {
                let giaTriHT = parseInt(nhapSL.value);
                if (giaTriHT < maxSL) {
                    nhapSL.value = giaTriHT + 1;
                }
            });

            nutGiam.addEventListener('click', function() {
                let giaTriHT = parseInt(nhapSL.value);
                if (giaTriHT > 1) {
                    nhapSL.value = giaTriHT - 1;
                }
            });

            nhapSL.addEventListener('change', function() {
                let giaTriHT = parseInt(this.value);
                if (isNaN(giaTriHT) || giaTriHT < 1) {
                    this.value = 1;
                } else if (giaTriHT > maxSL) {
                    this.value = maxSL;
                }
            });
        }
    });
</script>

<?php
require_once('layouts/client/footer.php');
ob_end_flush();
?>