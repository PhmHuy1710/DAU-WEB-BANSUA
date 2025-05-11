<?php
require_once("../../config/database.php");
require_once("../../layouts/admin/header.php");

// Kiểm tra tham số 'id' trong URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Tham số ID không hợp lệ!";
    exit;
}

$id = $_GET['id'];

// Lấy thông tin khách hàng từ cơ sở dữ liệu
$sql = "SELECT * FROM khachhang WHERE MaKH = '$id'";
$kq = mysqli_query($conn, $sql);

if (!$kq || mysqli_num_rows($kq) == 0) {
    echo "Không tìm thấy khách hàng!";
    exit;
}

$row = mysqli_fetch_assoc($kq);

// Xử lý cập nhật thông tin khách hàng
if (isset($_POST["btnCapNhat"])) {
    $makh = $_POST['txtMakh'];
    $ten = $_POST['txtTen'];
    $email = $_POST['txtEmail'];
    $pass = password_hash($_POST['txtPass'], PASSWORD_DEFAULT);
    $vaitro = $_POST['sltVaitro'];

    $sql = "UPDATE khachhang SET MaKH='$makh', TenKH='$ten', Email='$email', MatKhau='$pass', VaiTro='$vaitro' WHERE MaKH='$id'";
    $kq = mysqli_query($conn, $sql);

    if ($kq) {
        mysqli_close($conn);
        header("Location: index.php");
        exit;
    } else {
        echo "Cập nhật dữ liệu thất bại! " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cập nhật khách hàng</title>
</head>

<body>
    <div class="section-heading fade-in">
		<h2>Sửa thông tin khách hàng</h2>
	</div>

    <div class="container">
        <form method="post">
            <table class="table-form fade-in">
                <tr>
                    <td>Mã khách hàng</td>
                    <td>
                        <input type="text" required name="txtMakh" value="<?php echo htmlspecialchars($row['MaKH']); ?>">
                    </td>
                </tr>
                <tr>
                    <td>Tên khách hàng</td>
                    <td>
                        <input type="text" required name="txtTen" value="<?php echo htmlspecialchars($row['TenKH']); ?>">
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="text" name="txtEmail" required value="<?php echo htmlspecialchars($row['Email']); ?>">
                    </td>
                </tr>
                <tr>
                    <td>Mật khẩu</td>
                    <td>
                        <input type="text" name="txtPass" required value="<?php echo htmlspecialchars($row['MatKhau']); ?>">
                    </td>
                </tr>
                <tr>
                    <td>Vai trò</td>
                    <td>
                        <select name="sltVaitro">
                            <option value="User" <?php echo $row['VaiTro'] == 'User' ? 'selected' : ''; ?>>User</option>
                            <option value="Admin" <?php echo $row['VaiTro'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Đồng ý" name="btnCapNhat" class="btn btn-primary">
                    </td>
                    <td>
                        <a href="index.php" class="btn btn-secondary">Hủy</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    
</body>

</html>