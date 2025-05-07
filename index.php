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

<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
                <div class="col-lg-6 fade-in" style="animation-delay: 0.2s; animation-play-state: running;">
                    <h1 class="display-4 fw-bold mb-4">Milky <span class="text-primary">Thế Giới Sữa</span></h1>
                    <p class="lead mb-4">Cung cấp các sản phẩm sữa chất lượng từ các thương hiệu uy tín hàng đầu thế giới với giá cả hợp lý.</p>
                    <form action="<?php echo 'products.php?search='; ?>" method="GET" class="mb-4">
                        <div class="input-group input-group-lg">
                            <input type="text" name="search" class="form-control" placeholder="Tìm sản phẩm sữa...">
                            <button class="btn btn-primary action-btn" type="submit">
                                <i class="fas fa-search"></i> Tìm kiếm
                            </button>
                        </div>
                    </form>
                    <div class="d-flex gap-3">
                        <a href="/products" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-box me-2"></i>Tất cả sản phẩm
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center slide-in-right" style="animation-play-state: running;">
                    <img src="/assets/images/logo.png" alt="Milky Hero" class="img-fluid hero-image" onerror="this.src='/public/assets/images/logo.png'; this.style.maxHeight='300px';">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="new-products-section py-5 bg-light">
   <div class="container">
      <div class="section-heading mb-5">
         <h2>Sản Phẩm Mới Nhất</h2>
      </div>
      <div class="row g-4">
        <?php
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $productImage = !empty($row['HinhAnh']) ? '/assets/images/products/' . $row['HinhAnh'] : 'assets/images/default-image.jpg';
                $productId = $row['MaSP'];
                $productName = $row['TenSP'];
                $productPrice = number_format($row['Gia'], 0, ',', '.');
                $productBrand = isset($row['TenTH']) ? $row['TenTH'] : 'Không xác định';
            ?>

         <div class="col-md-4 scale-in" style="animation-delay: 0s; animation-play-state: paused;">
            <div class="product-card card h-100 position-relative">
               <div class="product-overlay"></div>
               <img src="<?php echo $productImage; ?>" class="card-img-top" alt="<?php echo $productName; ?>">
               <div class="card-body">
                  <h5 class="card-title"><?php echo $productName; ?></h5>
                  <p class="card-text">
                     <small class="text-muted"><?php echo $productBrand; ?></small>
                  </p>
                  <p class="price mb-3"><?php echo $productPrice; ?>đ</p>
                  <div class="product-actions">
                     <a href="<?php echo 'product-detail.php?id=' . $productId; ?>" class="btn btn-primary action-btn">
                     <i class="fas fa-eye me-1"></i> Chi tiết
                     </a>
                  </div>
               </div>
            </div>

         </div>
         <?php } ?> <?php } else { ?> <div class="col-12 text-center">Không có sản phẩm nào</div> <?php } ?>

      </div>
   </div>
</section>

<section class="features-section py-5 bg-light">
    <div class="container">
        <div class="section-heading mb-5">
            <h2>Tại Sao Chọn Chúng Tôi</h2>
        </div>

        <div class="row g-4 text-center">
            <div class="col-md-4 fade-in" style="animation-delay: 0.1s; animation-play-state: running;">
                <div class="feature-card">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-shipping-fast fa-3x text-primary"></i>
                    </div>
                    <h3>Giao Hàng Nhanh</h3>
                    <p>Giao hàng miễn phí trong vòng 24h cho tất cả đơn hàng trên 500.000đ</p>
                </div>
            </div>

            <div class="col-md-4 fade-in" style="animation-delay: 0.3s; animation-play-state: running;">
                <div class="feature-card">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-certificate fa-3x text-primary"></i>
                    </div>
                    <h3>Sản Phẩm Chính Hãng</h3>
                    <p>Cam kết 100% sản phẩm chất lượng, nguồn gốc rõ ràng</p>
                </div>
            </div>

            <div class="col-md-4 fade-in" style="animation-delay: 0.5s; animation-play-state: running;">
                <div class="feature-card">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-headset fa-3x text-primary"></i>
                    </div>
                    <h3>Hỗ Trợ 24/7</h3>
                    <p>Đội ngũ tư vấn viên luôn sẵn sàng hỗ trợ bạn mọi lúc</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
require_once('layouts/client/footer.php');
?>