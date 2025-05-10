<?php
ob_start();
include_once 'layouts/client/header.php';
include_once 'includes/session.php';

if (!empty($_GET['id'])) {
    $maSP = $_GET['id'];
    $maSP = mysqli_real_escape_string($conn, $maSP);

    $sqlSP = "SELECT sp.*, dm.TenDM, th.TenTH, th.HinhAnh AS LogoTH
            FROM SanPham sp
            LEFT JOIN DanhMuc dm ON dm.MaDM = sp.MaDM
            LEFT JOIN ThuongHieu th ON th.MaTH = sp.MaTH
            WHERE sp.MaSP = '$maSP'";

    $kqSP = mysqli_query($conn, $sqlSP);

    if (!$kqSP || mysqli_num_rows($kqSP) < 1) {
        header('Location: products.php');
        die;
    }

    $sp = mysqli_fetch_assoc($kqSP);

    $hinhSP = empty($sp['HinhAnh']) ? 'assets/images/default-image.jpg' : 'assets/images/products/' . $sp['HinhAnh'];
    $hinhTH = empty($sp['LogoTH']) ? 'assets/images/default-image.jpg' : 'assets/images/brands/' . $sp['LogoTH'];
}
?>

<main>
    <div class="container">
        <div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fas fa-home"></i> Trang chủ</a></li>
                <li><a href="products.php"><i class="fas fa-box"></i> Sản phẩm</a></li>
                <?php if (!empty($sp['MaDM']) && !empty($sp['TenDM'])): ?>
                    <li><a href="products.php?category=<?php echo $sp['MaDM']; ?>"><i class="fas fa-th-list"></i> <?php echo $sp['TenDM']; ?></a></li>
                <?php endif; ?>
                <li class="active"><span><i class="fas fa-info-circle"></i> <?php echo $sp['TenSP']; ?></span></li>
            </ul>
        </div>

        <?php if (!empty($sp)): ?>
            <div class="grid-container product-detail-container">
                <div class="product-detail-left fade-in" style="animation-delay: 0.2s;">
                    <div class="product-detail-image">
                        <img src="<?php echo $hinhSP; ?>" alt="<?php echo $sp['TenSP']; ?>" class="main-image">
                        <?php if (!empty($sp['TenTH'])): ?>
                            <div class="product-brand-badge">
                                <img src="<?php echo $hinhTH; ?>" alt="<?php echo $sp['TenTH']; ?>" class="brand-badge-image">
                                <span><?php echo $sp['TenTH']; ?></span>
                            </div>
                        <?php endif; ?>
                        <?php echo ($sp['SoLuong'] > 0)
                            ? '<div class="product-status in-stock"><i class="fas fa-check-circle"></i> Còn hàng</div>'
                            : '<div class="product-status out-of-stock"><i class="fas fa-times-circle"></i> Hết hàng</div>';
                        ?>
                    </div>
                </div>

                <div class="product-detail-right scale-in" style="animation-delay: 0.3s;">
                    <h1 class="product-detail-title"><?php echo $sp['TenSP']; ?></h1>

                    <div class="product-meta">
                        <div class="meta-item">
                            <span class="meta-label"><i class="fas fa-industry"></i> Thương hiệu:</span>
                            <span class="meta-value"><?php echo $sp['TenTH']; ?></span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label"><i class="fas fa-th-list"></i> Danh mục:</span>
                            <span class="meta-value"><?php echo $sp['TenDM']; ?></span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label"><i class="fas fa-weight"></i> Khối lượng:</span>
                            <span class="meta-value"><?php echo $sp['TrongLuong'] . ' ' . $sp['DonVi']; ?></span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label"><i class="fas fa-box"></i> Tình trạng:</span>
                            <span class="meta-value <?php echo ($sp['SoLuong'] > 0) ? 'text-success' : 'text-danger'; ?>">
                                <?php echo ($sp['SoLuong'] > 0) ? 'Còn ' . $sp['SoLuong'] . ' sản phẩm' : 'Hết hàng'; ?>
                            </span>
                        </div>
                    </div>

                    <div class="product-price">
                        <span class="current-price"><?php echo number_format($sp['Gia'], 0, ',', '.'); ?>đ</span>
                    </div>

                    <div class="product-description">
                        <h3 class="description-title">Mô tả sản phẩm</h3>
                        <div class="description-content">
                            <?php echo (!empty($sp['MoTa']))
                                ? $sp['MoTa']
                                : '<p><em><strong>' . $sp['TenSP'] . '</strong></em> dạng bịch tiện lợi, bổ sung chất đạm, canxi, Vitamin B2, kali. Sữa tươi <em><strong>' . $sp['TenTH'] . '</strong></em> là nhãn hiệu sữa tươi được rất nhiều trẻ em lẫn người lớn ưa chuộng, bổ dung đầy đủ dinh đưỡng cho hoạt động ngày dài.</p>'; ?>
                        </div>
                    </div>

                    <?php if (isLoggedIn()): ?>
                        <form method="POST" action="cart.php" class="cart-form">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="product_id" value="<?php echo $sp['MaSP']; ?>">

                            <div class="quantity-controls">
                                <label for="quantity">Số lượng:</label>
                                <div class="quantity-wrapper">
                                    <button type="button" class="quantity-btn minus-btn" id="nutGiam"><i class="fas fa-minus"></i></button>
                                    <input type="number" id="soLuong" name="quantity" value="1" min="1" max="<?php echo $sp['SoLuong']; ?>" class="quantity-input">
                                    <button type="button" class="quantity-btn plus-btn" id="nutTang"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>

                            <div class="product-actions">
                                <a href="add.php?MaSP=<?php echo $row['MaSP']; ?>&MaKH=<?php echo $row['MaKH']; ?> &soluong=<?php echo $row['soluong']; ?>" class="btn btn-primary add-to-cart-btn" >
                                    <i class="fas fa-shopping-cart"></i> Thêm vào giỏ
                                </a>
                                <a href="products.php" class="btn btn-outline-primary continue-btn">
                                    <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
                                </a>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="product-actions">
                            <a href="login.php" class="btn btn-primary">Đăng nhập để mua hàng</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">Không tìm thấy sản phẩm.</div>
        <?php endif; ?>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nutGiam = document.getElementById('nutGiam');
        const nutTang = document.getElementById('nutTang');
        const soLuong = document.getElementById('soLuong');

        if (nutGiam && nutTang && soLuong) {
            const slToiDa = parseInt(soLuong.getAttribute('max')) || 99;

            nutGiam.addEventListener('click', function() {
                const giaTriHienTai = parseInt(soLuong.value);
                if (giaTriHienTai > 1) {
                    soLuong.value = giaTriHienTai - 1;
                }
            });

            nutTang.addEventListener('click', function() {
                const giaTriHienTai = parseInt(soLuong.value);
                if (giaTriHienTai < slToiDa) {
                    soLuong.value = giaTriHienTai + 1;
                }
            });

            soLuong.addEventListener('change', function() {
                let giaTriMoi = parseInt(this.value);

                if (isNaN(giaTriMoi) || giaTriMoi < 1) {
                    giaTriMoi = 1;
                } else if (giaTriMoi > slToiDa) {
                    giaTriMoi = slToiDa;
                }

                this.value = giaTriMoi;
            });
        }
    });
</script>

<?php include_once 'layouts/client/footer.php';
ob_end_flush(); ?>