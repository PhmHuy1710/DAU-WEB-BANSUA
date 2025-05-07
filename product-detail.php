<?php
require_once('layouts/client/header.php');
?>

<?php
    $brand_sql = "SELECT * FROM ThuongHieu ORDER BY TenTH ASC";
    $brand_result = mysqli_query($conn, $brand_sql);

    $product_sql = "SELECT sp.*, dm.TenDM, th.TenTH
                FROM SanPham sp
                LEFT JOIN DanhMuc dm ON sp.MaDM = dm.MaDM
                LEFT JOIN ThuongHieu th ON sp.MaTH = th.MaTH";
    $product_result = mysqli_query($conn, $product_sql);

    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];
        $product_sql = "SELECT sp.*, dm.TenDM, th.TenTH
                        FROM SanPham sp
                        LEFT JOIN DanhMuc dm ON sp.MaDM = dm.MaDM
                        LEFT JOIN ThuongHieu th ON sp.MaTH = th.MaTH
                        WHERE sp.MaSP = '$product_id'";
        $product_result = mysqli_query($conn, $product_sql);
    }
    if (mysqli_num_rows($product_result) > 0) {
        $row = mysqli_fetch_assoc($product_result);
        $productImage = !empty($row['HinhAnh']) ? '/assets/images/products/' . $row['HinhAnh'] : 'assets/images/default-image.jpg';
        $productId = $row['MaSP'];
        $productName = $row['TenSP'];
        $productType = $row['TenDM'];
        $productBrand = $row['TenTH'];
        $productPrice = number_format($row['Gia'], 0, ',', '.');
        $productDescription = $row['MoTa'];
    }

?>

<div class="container py-4">
    <div class="row">
        <div class="col-md-12 mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-0">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none"><i class="fas fa-home me-1"></i>Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="/products.php" class="text-decoration-none"><i class="fas fa-box me-1"></i>Sản phẩm</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $productName; ?></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-5 mb-4 mb-lg-0">
            <div class="product-image-container position-relative">
                <img src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" class="img-fluid rounded-4 shadow-sm product-image w-100" style="cursor: zoom-in; object-fit: contain; background-color: #f8f9fa; height: 450px;">
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 h-100 fade-in show">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-2">

                        <?php if ($row['SoLuong'] > 0): ?>
                        <span class="badge bg-soft-success text-success px-3 py-2 rounded-pill">
                            <i class="fas fa-check-circle me-1"></i>Còn hàng
                        </span>
                        <?php else: ?>
                        <span class="badge bg-soft-danger text-danger px-3 py-2 rounded-pill">
                            <i class="fas fa-times-circle me-1"></i>Hết hàng
                        </span>
                        <?php endif; ?>
                    </div>

                    <h1 class="display-8 fw-bold text-primary mb-3"><?php echo $productName; ?></h1>

                    <div class="mb-4 align-items-center">
                        <div class="me-4 mb-2">
                            <span class="text-muted"><i class="fas fa-industry me-1"></i>Hãng sữa:</span>
                            <span class="ms-1 fw-medium"><?php echo $productBrand; ?></span>
                        </div>
                        <div class="me-4 mb-2">
                            <span class="text-muted"><i class="fas fa-prescription-bottle me-1"></i>Loại sữa:</span>
                            <span class="ms-1 fw-medium"><?php echo $productType; ?></span>
                        </div>
                        <div class="mb-2">
                            <span class="text-muted"><i class="fas fa-weight me-1"></i>Trọng lượng:</span>
                            <span class="ms-1 fw-medium">180ml</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-baseline mb-2">
                            <h2 class="display-8 text-danger fw-bold mb-0">
                                <?php echo $productPrice; ?>đ
                            </h2>
                        </div>

                        <div class="mb-3">
                            <?php if ($row['SoLuong'] > 0): ?>
                            <span class="text-success d-flex align-items-center">
                                <i class="fas fa-box-open me-2"></i>Còn <?php echo $row['SoLuong']; ?> sản phẩm trong kho
                            </span>
                            <?php else: ?>
                            <span class="text-danger d-flex align-items-center">
                                <i class="fas fa-exclamation-circle me-2"></i>Sản phẩm hiện đã hết hàng
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <form method="POST" action="/cart" class="d-flex flex-wrap align-items-center" id="add-to-cart-form">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">

                        <div class="quantity-selector me-3 mb-3">
                            <div class="input-group" style="max-width: 150px;">
                                <button class="btn btn-outline-primary" type="button" id="decrementBtn">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" class="form-control text-center border-primary" name="quantity" value="1" min="1" max="<?php echo $row['SoLuong']; ?>" id="quantityInput">
                                <button class="btn btn-outline-primary" type="button" id="incrementBtn">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg mb-3 px-4 py-2 rounded-pill shadow-sm" <?php echo ($row['SoLuong'] <= 0) ? 'disabled' : ''; ?>>
                            <i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 fade-in show">
                <div class="card-header bg-soft-primary border-0 py-3 rounded-top-4">
                    <h2 class="h4 mb-0 text-primary fw-bold"><i class="fas fa-info-circle me-2"></i>Thông tin chi tiết</h2>
                </div>
                <div class="card-body p-4">
                    <div id="formatted-description" class="description-content">
                        <p><em><strong>Thùng 48 bịch sữa tiệt trùng Dutch Lady hương dâu 180ml</strong></em> dạng bịch tiện lợi, bổ sung chất đạm, canxi, Vitamin B2, kali. Sữa tươi <em><strong>Dutch Lady</strong></em> là nhãn hiệu sữa tươi được rất nhiều trẻ em lẫn người lớn ưa chuộng, bổ dung đầy đủ dinh đưỡng cho hoạt động ngày dài.</p>
                        <table>
                            <thead>
                                <tr>
                                    <th><strong>Thông tin</strong></th>
                                    <th><strong>Chi tiết</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Loại sữa</td>
                                    <td>Sữa tươi tiệt trùng ít đường</td>
                                </tr>
                                <tr>
                                    <td>Dung tích</td>
                                    <td>180ml/hộp</td>
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
                                    <td>Bảo quản nơi khô ráo, thoáng mát, tránh ánh nắng chiếu trực tiếp.</td>
                                </tr>
                                <tr>
                                    <td>Lưu ý</td>
                                    <td>Không dùng cho trẻ dưới 1 tuổi. Sản phẩm cho 1 lần sử dụng</td>
                                </tr>
                                <tr>
                                    <td>Thương hiệu</td>
                                    <td>Dutch Lady (Hà Lan)</td>
                                </tr>
                                <tr>
                                    <td>Sản xuất tại</td>
                                    <td>Việt Nam</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
require_once('layouts/client/footer.php');
?>