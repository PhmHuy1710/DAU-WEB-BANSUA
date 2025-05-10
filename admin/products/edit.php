<?php
require_once("../../layouts/admin/header.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$maSP = $_GET['id'];

// Sử dụng prepared statement để tránh SQL injection
$sql = "SELECT * FROM SanPham WHERE MaSP = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $maSP);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    echo "<div class='alert alert-danger'>Không tìm thấy sản phẩm!</div>";
    exit();
}

$row = mysqli_fetch_assoc($result);

// Xử lý khi form được submit
if (isset($_POST['btnCapNhat'])) {
    $tensp = $_POST['txtTen'];
    $madm = $_POST['txtMadm'];
    $mth = $_POST['txtMth'];
    $tl = $_POST['txtTl'];
    $donvi = $_POST['DonVi'];
    $gia = $_POST['txtGia'];
    $soluong = $_POST['SoLuong'];
    $mota = $_POST['MoTa'];

    $tenHinhAnh = $row['HinhAnh']; // Giữ nguyên hình ảnh cũ nếu không upload mới

    // Xử lý upload hình ảnh mới nếu có
    if (isset($_FILES['HinhAnh']) && $_FILES['HinhAnh']['error'] == 0) {
        $uploadDir = "../../assets/images/products/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileInfo = pathinfo($_FILES['HinhAnh']['name']);
        $fileExt = strtolower($fileInfo['extension']);
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($fileExt, $allowedExt)) {
            $tenHinhAnh = $maSP . "." . $fileExt;
            $uploadPath = $uploadDir . $tenHinhAnh;

            // Xóa hình cũ nếu có
            if (!empty($row['HinhAnh']) && file_exists($uploadDir . $row['HinhAnh'])) {
                unlink($uploadDir . $row['HinhAnh']);
            }

            if (move_uploaded_file($_FILES['HinhAnh']['tmp_name'], $uploadPath)) {
                // Upload thành công
            } else {
                echo "<div class='alert alert-danger'>Không thể upload hình ảnh!</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Chỉ chấp nhận file hình ảnh (jpg, jpeg, png, gif, webp)!</div>";
        }
    }

    // Cập nhật dữ liệu vào database
    $sql = "UPDATE SanPham SET 
            TenSP = ?, 
            MaDM = ?, 
            MaTH = ?, 
            TrongLuong = ?, 
            DonVi = ?, 
            Gia = ?, 
            SoLuong = ?, 
            MoTa = ?, 
            HinhAnh = ? 
            WHERE MaSP = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssisdssss", $tensp, $madm, $mth, $tl, $donvi, $gia, $soluong, $mota, $tenHinhAnh, $maSP);
    $kq = mysqli_stmt_execute($stmt);

    if ($kq) {
        echo "<div class='alert alert-success'>Cập nhật sản phẩm thành công!</div>";


        $sql = "SELECT * FROM SanPham WHERE MaSP = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $maSP);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<div class='alert alert-danger'>Cập nhật sản phẩm thất bại! " . mysqli_error($conn) . "</div>";
    }
}


$sqlDM = "SELECT MaDM, TenDM FROM DanhMuc ORDER BY TenDM";
$resultDM = mysqli_query($conn, $sqlDM);

$sqlTH = "SELECT MaTH, TenTH FROM ThuongHieu ORDER BY TenTH";
$resultTH = mysqli_query($conn, $sqlTH);
?>

<div class="section-heading">
    <h2>Sửa sản phẩm</h2>
    <p>Mã sản phẩm: <?php echo $maSP; ?></p>
</div>

<div class="data-table-container">
    <div class="data-table-header">
        <h3 class="data-table-title">Thông tin sản phẩm</h3>
        <div class="data-table-actions">
            <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>
    </div>

    <form method="post" enctype="multipart/form-data">
        <table class="form-table">
            <tr>
                <td><label for="txtTen">Tên sản phẩm</label></td>
                <td>
                    <input type="text" id="txtTen" name="txtTen" value="<?php echo htmlspecialchars($row['TenSP']); ?>" required placeholder="Nhập tên sản phẩm">
                </td>
            </tr>
            <tr>
                <td><label for="txtMadm">Danh mục</label></td>
                <td>
                    <select id="txtMadm" name="txtMadm" required>
                        <option value="">-- Chọn danh mục --</option>
                        <?php while ($dm = mysqli_fetch_assoc($resultDM)) : ?>
                            <option value="<?php echo $dm['MaDM']; ?>" <?php echo ($row['MaDM'] == $dm['MaDM']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($dm['TenDM']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="txtMth">Thương hiệu</label></td>
                <td>
                    <select id="txtMth" name="txtMth" required>
                        <option value="">-- Chọn thương hiệu --</option>
                        <?php while ($th = mysqli_fetch_assoc($resultTH)) : ?>
                            <option value="<?php echo $th['MaTH']; ?>" <?php echo ($row['MaTH'] == $th['MaTH']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($th['TenTH']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="txtTl">Trọng lượng</label></td>
                <td>
                    <input type="number" id="txtTl" name="txtTl" value="<?php echo $row['TrongLuong']; ?>" required placeholder="Nhập trọng lượng">
                </td>
            </tr>
            <tr>
                <td><label for="DonVi">Đơn vị</label></td>
                <td>
                    <select id="DonVi" name="DonVi" required>
                        <option value="g" <?php echo ($row['DonVi'] == 'g') ? 'selected' : ''; ?>>g</option>
                        <option value="ml" <?php echo ($row['DonVi'] == 'ml') ? 'selected' : ''; ?>>ml</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="txtGia">Giá</label></td>
                <td>
                    <input type="number" id="txtGia" name="txtGia" value="<?php echo $row['Gia']; ?>" required placeholder="Nhập giá sản phẩm">
                </td>
            </tr>
            <tr>
                <td><label for="MoTa">Mô tả</label></td>
                <td>
                    <textarea id="MoTa" name="MoTa" rows="4" placeholder="Nhập mô tả sản phẩm"><?php echo htmlspecialchars($row['MoTa']); ?></textarea>
                </td>
            </tr>
            <tr>
                <td><label for="HinhAnh">Hình ảnh</label></td>
                <td>
                    <input type="file" id="HinhAnh" name="HinhAnh" accept="image/*">
                    <p class="form-hint">Để trống nếu không muốn thay đổi hình ảnh</p>

                    <?php if (!empty($row['HinhAnh'])): ?>
                        <div class="current-image">
                            <p>Hình ảnh hiện tại:</p>
                            <img src="../../assets/images/products/<?php echo $row['HinhAnh']; ?>" alt="Hình ảnh sản phẩm" class="product-image">
                        </div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td><label for="SoLuong">Số lượng</label></td>
                <td>
                    <input type="number" id="SoLuong" name="SoLuong" value="<?php echo $row['SoLuong']; ?>" required placeholder="Nhập số lượng">
                </td>
            </tr>
            <tr>
                <td colspan="2" class="form-buttons">
                    <input type="submit" value="Cập nhật" name="btnCapNhat" class="btn btn-primary">
                    <a href="index.php" class="btn btn-secondary">Hủy</a>
                </td>
            </tr>
        </table>
    </form>
</div>