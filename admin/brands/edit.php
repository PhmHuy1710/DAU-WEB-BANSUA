<?php
require_once("../../layouts/admin/header.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$maSP = $_GET['id'];

// Sử dụng prepared statement để tránh SQL injection
$sql = "SELECT * FROM thuonghieu WHERE MaTH = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $maSP);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    echo "<div class='alert alert-danger'>Không tìm thấy thương hiệu!</div>";
    exit();
}

$row = mysqli_fetch_assoc($result);

// Xử lý khi form được submit
if (isset($_POST['btnCapNhat'])) {
    $tenTH = $_POST['txtTenTH'];
    $hinhAnh = $_POST['txtHinhAnh'];
    $moTa = $_POST['txtMoTa'];
    $ngayTao = $_POST['txtNgayTao'];
    $ngayCapNhat = $_POST['txtNgayCapNhat'];

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
    $sql = "UPDATE thuonghieu SET 
            TenTH = ?,
            MoTa = ?,
            HinhAnh = ?
            WHERE MaTH = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssisdsssss", $tenTH, $moTa, $hinhAnh, $ngayTao, $ngayCapNhat, $maSP);
    $kq = mysqli_stmt_execute($stmt);

    if ($kq) {
        echo "<div class='alert alert-success'>Cập nhật thương hiệu thành công!</div>";

        // Lấy lại dữ liệu mới
        $sql = "SELECT * FROM thuonghieu WHERE MaTH = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $maSP);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<div class='alert alert-danger'>Cập nhật thương hiệu thất bại! " . mysqli_error($conn) . "</div>";
    }
}

// Lấy danh sách danh mục
$sqlDM = "SELECT MaDM, TenDM FROM DanhMuc ORDER BY TenDM";
$resultDM = mysqli_query($conn, $sqlDM);

// Lấy danh sách thương hiệu  
$sqlTH = "SELECT MaTH, TenTH FROM ThuongHieu ORDER BY TenTH";
$resultTH = mysqli_query($conn, $sqlTH);
?>

<div class="section-heading">
    <h2>Sửa thương hiệu</h2>
    <p>Mã thương hiệu: <?php echo $maSP; ?></p>
</div>

<div class="data-table-container">
    <div class="data-table-header">
        <h3 class="data-table-title">Thông tin thương hiệu</h3>
        <div class="data-table-actions">
            <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>
    </div>

    <form method="post" enctype="multipart/form-data">
        <table class="form-table">
            <tr>
                <td><label for="txtTen">Tên thương hiệu</label></td>
                <td>
                    <input type="text" id="txtTen" name="txtTen" value="<?php echo htmlspecialchars($row['TenTH']); ?>" required placeholder="Nhập tên thương hiệu">
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
                            <img src="../../assets/images/brands/<?php echo $row['HinhAnh']; ?>" alt="Hình ảnh thương hiệu" class="brand-image" width="50px" height="50px">
                        </div>
                    <?php endif; ?>
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

<style>
    .product-image {
        max-width: 150px;
        max-height: 150px;
        object-fit: contain;
        border: 1px solid #ddd;
        margin-top: 10px;
    }

    .current-image {
        margin-top: 10px;
    }

    .form-hint {
        font-size: 0.8rem;
        color: #666;
        margin-top: 5px;
    }

    .alert {
        padding: 10px 15px;
        margin-bottom: 15px;
        border-radius: 4px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>