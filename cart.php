<?php
require_once('config/database.php');
require_once('config/config.php');
require_once('includes/session.php');

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

require_once('layouts/client/header.php');
$MaKH = $_SESSION['user']['MaKH'];

$sql = "SELECT sanpham.TenSP, sanpham.gia, giohang.SoLuong, giohang.MaKH, giohang.MaSP, 
        (sanpham.gia * giohang.SoLuong) AS ThanhTien
        FROM giohang
        JOIN sanpham ON giohang.MaSP = sanpham.MaSP
        WHERE giohang.MaKH = '$MaKH'
        GROUP BY sanpham.TenSP, sanpham.gia, giohang.SoLuong, giohang.MaKH, giohang.MaSP";
$kq = mysqli_query($conn, $sql);

if (!$kq) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<style>
    .sanpham-table {
        width: 70%;
        border-collapse: collapse;
    }

    .sanpham-table th,
    .sanpham-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    .sanpham-table th {
        background-color: #f2f2f2;
    }
</style>
<body>
    
    <div class="container">
        <div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fas fa-home"></i> Trang chủ</a></li>
                <li class="active"><i class="fas fa-shopping-cart"></i> Giỏ hàng</li>

            </ul>
        </div>
        <div class="row1">
  
        <?php if ($kq && mysqli_num_rows($kq) > 0) { ?>     
        <div class="col-12 text-center">
            <table class="sanpham-table">
                <tr>
                    <th id="ten">Tên sản phẩm</th>
                    <th id="gia">Giá</th>
                    <th id="soluong">Số lượng</th>
                    <th id="thanhtien">Thành Tiền</th>
                    <th id="thaoTac">Thao Tác</th>
                </tr>
                <?php
                
                    while ($row = mysqli_fetch_assoc($kq)) {
                ?>
                <tr>
                    <td>
                        <?php
                            echo $row["TenSP"];
                        ?>
                    </td>
                    <td>
                        <?php
                            echo $row["gia"];
                        ?>       
                    </td>
                    <td>
                        <a href="update.php?MaSP=<?php echo $row['MaSP']; ?>&MaKH=<?php echo $row['MaKH']; ?>&action=+"><i class="fa-solid fa-circle-plus"></i></a>
                        <?php
                            echo $row["SoLuong"];
                        ?>
                        <a 
                            <?php if ($row['SoLuong'] == 1): ?>
                                onclick="return confirm('Bạn có muốn xóa không?')"
                            <?php endif; ?>
                            href="update.php?MaSP=<?php echo $row['MaSP']; ?>&MaKH=<?php echo $row['MaKH']; ?>&action=-"><i class="fa-solid fa-circle-minus"></i>
                        </a>
                    </td>
                    <td>
                        <?php
                            echo $row["ThanhTien"];
                        ?>
                    </td>
                    <td>
                        <a onclick="return confirm('Bạn có muốn xóa không?')" href="xoa.php?MaSP=<?php echo $row['MaSP']; ?>&MaKH=<?php echo $row['MaKH']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                    </td>
                <?php
                    }
                ?>
            </table>
        </div>
        <div>
        <h4>Thông tin vận chuyển</h4>
        <table>
            <tr>
                <th>Họ tên</th>
                <th><input type="text" name="admin" placeholder="Administrator"></th>
                <th>Số điện thoại</th>
                <th><input type="text" name="phone" placeholder="Phone"></th>
            </tr>
            <tr>
                <th>Email</th>
                <th><input type="text" name="email" placeholder="Email"></th>
            </tr>
            <tr>    
                <th>Địa chỉ</th>
                <th><input type="text" name="address" placeholder="Address"></th>
            </tr>
            <tr>
                <th>Ghi chú thêm</th>
                <th><input type="text" name="note" placeholder="Note"></th>
            </tr>
        </table>
    </div>
        <?php
        } else {
            echo "  <div class='text-center' style='text-align: center; height: 400px; margin-top: 40px;'>
                        <img src='assets/images/tui.png' alt='Giỏ hàng trống' style='width: 200px; height: 200px;'>
                        <h2>Giỏ hàng của bạn trống</h2>
                        <p>Hãy thêm sản phẩm vào giỏ hàng để tiếp tục mua sắm</p>
                        <button class='btn btn-primary' style='margin-top: 20px;'>
                            <a href='products.php' style='color: white; text-decoration: none;'>Mua sắm ngay</a>
                        </button>
                    </div>";

        }
        ?>
        </div>
    
    <div class="">
        
    </div>
    
    </div>
</body>

<?php
require_once('layouts/client/footer.php');
?>
