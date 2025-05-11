<?php
require_once("../../layouts/admin/header.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$maTH = $_GET['id'];

$sql = "SELECT * FROM thuonghieu WHERE MaTH = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $maTH);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    echo "<div class='alert alert-danger'>Không tìm thấy thương hiệu!</div>";
    exit();
}

$row = mysqli_fetch_assoc($result);

// Kiểm tra nếu $row có giá trị null
if (!$row) {
    echo "<div class='alert alert-danger'>Không tìm thấy dữ liệu thương hiệu!</div>";
    exit();
}

if (isset($_POST['btnCapNhat'])) {
    $tenTH = $_POST['txtTen'];
    $moTa = $_POST['MoTa'];

    $tenHinhAnh = $row['HinhAnh']; // Giữ nguyên hình ảnh cũ nếu không upload mới

    // Xử lý upload hình ảnh mới nếu có
    if (isset($_FILES['HinhAnh']) && $_FILES['HinhAnh']['error'] == 0) {
        $uploadDir = "../../assets/images/brands/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileInfo = pathinfo($_FILES['HinhAnh']['name']);
        $fileExt = strtolower($fileInfo['extension']);
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($fileExt, $allowedExt)) {
            $tenHinhAnh = $maTH . "." . $fileExt;
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
    $sql = "UPDATE thuonghieu SET TenTH = ?, MoTa = ?, HinhAnh = ? WHERE MaTH = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $tenTH, $moTa, $tenHinhAnh, $maTH);
    $kq = mysqli_stmt_execute($stmt);

    if ($kq) {
        echo "<div class='alert alert-success'>Cập nhật thương hiệu thành công!</div>";

        // Lấy lại dữ liệu mới
        $sql = "SELECT * FROM thuonghieu WHERE MaTH = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $maTH);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<div class='alert alert-danger'>Cập nhật thương hiệu thất bại! " . mysqli_error($conn) . "</div>";
    }
}

// Lấy danh sách thương hiệu  
$sqlTH = "SELECT MaTH, TenTH FROM ThuongHieu ORDER BY TenTH";
$resultTH = mysqli_query($conn, $sqlTH);
?>

<div class="section-heading">
    <h2>Sửa thương hiệu</h2>
    <p>Mã thương hiệu: <?php echo $maTH; ?></p>
</div>
<?php if (!empty($thongBao)): ?>
    <div class="alert alert-<?php echo $loaiThongBao; ?>">
        <?php echo $thongBao; ?>
    </div>
<?php endif; ?>
<div class="container">
    <div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
        <ul class="breadcrumb">
            <li><a href="../index.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="index.php"><i class="fas fa-building"></i>Quản lý thương hiệu</a></li>
            <li class="active"><i class="fas fa-plus"></i> Sửa thương hiệu</li>
        </ul>
    </div>
    <div class="table-header">
        <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
    </div>
    <form method="post" enctype="multipart/form-data">
        <table class="table-form fade-in">
            <tr>
                <td><label for="txtTen">Tên thương hiệu</label></td>
                <td>
                    <input type="text" id="txtTen" name="txtTen" value="<?php echo htmlspecialchars(isset($_POST['txtTen']) ? $_POST['txtTen'] : $row['TenTH']); ?>" placeholder="Nhập tên sản phẩm">
                </td>
            </tr>
            <tr>
                <td><label for="MoTa">Mô tả</label></td>
                <td>
                    <input type="text" id="MoTa" name="MoTa" rows="4" value="<?php echo htmlspecialchars(isset($_POST['MoTa']) ? $_POST['MoTa'] : $row['MoTa']); ?>" placeholder="Nhập tên sản phẩm">
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
                            <img src="../../assets/images/brands/<?php echo $row['HinhAnh']; ?>" alt="Hình ảnh sản phẩm" class="product-image">
                        </div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="table-button">
                        <input type="submit" value="Cập nhật" name="btnCapNhat" class="btn btn-primary">
                    </div>
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