<?php
require_once('config/database.php');
require_once('config/config.php');
require_once('includes/session.php');

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

require_once('layouts/client/header.php');
$maKH = $_SESSION['user']['MaKH'];

if (isset($_SESSION['thongbao']) && isset($_SESSION['loai_thongbao'])) {
    $thongbao = $_SESSION['thongbao'];
    $loaiThongBao = $_SESSION['loai_thongbao'];

    unset($_SESSION['thongbao']);
    unset($_SESSION['loai_thongbao']);
}

$sql = "SELECT sanpham.TenSP, sanpham.gia, sanpham.SoLuong AS SoLuongSP, giohang.SoLuong, giohang.MaKH, giohang.MaSP, 
        (sanpham.gia * giohang.SoLuong) AS ThanhTien
        FROM giohang
        JOIN sanpham ON giohang.MaSP = sanpham.MaSP
        WHERE giohang.MaKH = '$maKH'
        GROUP BY sanpham.TenSP, sanpham.gia, sanpham.SoLuong, giohang.SoLuong, giohang.MaKH, giohang.MaSP";
$kq = mysqli_query($conn, $sql);

$sql_KH = "SELECT TenKH, SoDienThoai, Email, DiaChi FROM khachhang WHERE MaKH = '$maKH'";
$kq_KH = mysqli_query($conn, $sql_KH);
$row_KH = mysqli_fetch_assoc($kq_KH);

if (!$kq) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<style>
    .card-container {
        width: 100%;
    }

    .col-11 {
        width: 65%;
        display: block;
        flex: 0 0 auto;
        float: left;
    }

    .feature-card {
        margin: 20px 0;
        padding: 30px;
        width: 100%;
        /* display: block; */
        float: left;
    }

    .feature-card th input {
        padding: 10px;
    }

    .feature-card button {
        margin-bottom: 20px;
    }

    .text-center {
        text-align: center;
        margin-top: 20px;
        width: 100%;
        display: block;
    }

    .sanpham-table {
        border-collapse: collapse;
        width: 100%;
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

    .col-12 {
        width: 33%;
        display: block;
        flex: 0 0 auto;
        float: right;
    }

    .shipping-info {
        width: 100%;
    }

    #input {
        height: 27px;
        border-radius: 10px;
    }

    .shipping-info tr th {
        padding: 10px;
        margin-top: 10px;
        width: 35%;
        text-align: left;
    }

    .btn-checkout {
        margin-top: 20px;
        display: block;
    }

    .btn-checkout button {
        width: 100%;
        height: 40px;
    }

    button a {
        font-weight: bold;
        text-decoration: none;
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

        <?php if (isset($thongbao) && isset($loaiThongBao)): ?>
            <div class="alert alert-<?php echo $loaiThongBao; ?> fade-in" style="animation-delay: 0.2s;">
                <?php echo $thongbao; ?>
            </div>
        <?php endif; ?>

        <div class="row1">
            <?php if ($kq && mysqli_num_rows($kq) > 0) { ?>
                <!-- <div class="feature-item fade-in" style="animation-delay: 0.3s;"> -->
                <div class="card-container" style="animation-delay: 0.3s;">
                    <div class="col-11">
                        <div class="feature-card">
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
                                            echo number_format($row['gia'], 0, ',', '.') . ' VNĐ';
                                            ?>
                                        </td>
                                        <td>
                                            <a href="includes/cart/update.php?MaSP=<?php echo $row['MaSP']; ?>&MaKH=<?php echo $row['MaKH']; ?>&action=up"><i class="fa-solid fa-circle-plus"></i></a>
                                            <input id="input" type="number" name="SoLuong" value="<?php echo $row['SoLuong']; ?>" min="1" max="<?php echo $row['SoLuongSP']; ?>" style="width:50px; text-align:center;"
                                                onchange="window.location.href='includes/cart/edit.php?MaSP=<?php echo $row['MaSP']; ?>&MaKH=<?php echo $row['MaKH']; ?>&action='+this.value;">
                                            <a
                                                <?php if ($row['SoLuong'] == 1): ?>
                                                onclick="return confirm('Bạn có muốn xóa không?')"
                                                <?php endif; ?>
                                                href="includes/cart/update.php?MaSP=<?php echo $row['MaSP']; ?>&MaKH=<?php echo $row['MaKH']; ?>&action=down"><i class="fa-solid fa-circle-minus"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <?php
                                            echo number_format($row['ThanhTien'], 0, ',', '.') . ' VNĐ';
                                            ?>
                                        </td>
                                        <td>
                                            <a onclick="return confirm('Bạn có muốn xóa không?')" href="includes/cart/update.php?MaSP=<?php echo $row['MaSP']; ?>&MaKH=<?php echo $row['MaKH']; ?>&action=delete"><i class="fa-solid fa-trash-can"></i></a>
                                        </td>
                                    <?php
                                }
                                    ?>
                            </table>
                        </div>
                        <div class="feature-card">
                            <table class="shipping-info" style="border: 1px solid #ddd; width: 100%; padding: 10px;">
                                <h4>Thông tin vận chuyển</h4>
                                <tr>
                                    <th>Họ tên</th>
                                    <th><input id="input" type="text" name="name" placeholder="Họ tên" value="<?php echo $row_KH['TenKH']; ?>" required></th>
                                    <th>Số điện thoại</th>
                                    <th><input id="input" type="text" name="phone" placeholder="Số điện thoại" value="<?php echo $row_KH['SoDienThoai']; ?>" required></th>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <th><input id="input" style="width: 267%;" type="text" name="email" placeholder="Email" value="<?php echo $row_KH['Email']; ?>" required></th>
                                </tr>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <th><input id="input" style="width: 267%;" type="text" name="address" placeholder="Địa chỉ" value="<?php echo $row_KH['DiaChi']; ?>" required></th>
                                </tr>
                                <tr>
                                    <th>Ghi chú thêm</th>
                                    <th><input id="input" style="width: 267%;" type="text" name="note" placeholder="Nhập ghi chú (nếu có)"></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="feature-card q1">
                            <h4>Mã giảm giá</h4>
                            <input id="input" type="text" name="discount_code" placeholder="Nhập mã giảm giá" style="padding: 20px;">
                            <button class='btn btn-primary' style='margin-top: 20px;'>
                                <a href='#' style='color: white; text-decoration: none;'>Áp dụng</a>
                            </button>
                        </div>
                        <div class="feature-card">
                            <h4>Phương thức thanh toán</h4>
                            <label style="cursor:pointer;">
                                <input type="radio" name="payment_method" value="cod" checked id="payment_cod">
                                Thanh toán khi nhận hàng (COD)
                                <p style="font-size: 12px; color: #888;">Thanh toán bằng tiền mặt khi nhận được hàng</p>
                            </label>
                            <br>
                            <label style="cursor:pointer;">
                                <input type="radio" name="payment_method" value="bank_transfer" disabled id="payment_bank">
                                Chuyển khoản ngân hàng
                                <p style="font-size: 12px; color: #888;">Tính năng đang được phát triển</p>
                            </label>
                            <br>
                        </div>
                        <div class="feature-card">
                            <h4>Tổng tiền</h4>
                            <p style="font-size: 20px; color: #333;">
                                <?php
                                $sql = "SELECT SUM(ThanhTien) AS TongTien FROM (
                                        SELECT sanpham.gia * giohang.SoLuong AS ThanhTien
                                        FROM giohang
                                        JOIN sanpham ON giohang.MaSP = sanpham.MaSP
                                        WHERE giohang.MaKH = '$maKH'
                                    ) AS TongTien";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                echo number_format($row['TongTien'], 0, ',', '.') . ' VNĐ';
                                ?>
                            </p>
                            <div class="btn-checkout">
                                <form method="post" action="includes/orders/add.php">
                                    <input type="hidden" name="payment_method" id="payment_method_hidden" value="cod">
                                    <input type="hidden" name="note" id="order_note_hidden" value="">
                                    <button type="submit" class='btn btn-primary'>
                                        <i class="fa-solid fa-credit-card"></i> TIẾN HÀNH THANH TOÁN
                                    </button>
                                </form>
                                <button class="btn btn-outline-primary">
                                    <a href='products.php' style="color: #60B5FF;" class="continue-shopping"><i class="fa-solid fa-arrow-left"></i> TIẾP TỤC MUA SẮM</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class='text-center' style='text-align: center; height: 400px; margin-top: 40px;'>
                    <img src='assets/images/cart.png' alt='Giỏ hàng trống' style='width: 200px; height: 200px;'>
                    <h2>Giỏ hàng của bạn trống</h2>
                    <p>Hãy thêm sản phẩm vào giỏ hàng để tiếp tục mua sắm</p>
                    <button class="btn btn-outline-primary" style="margin-top: 20px;">
                        <a href='products.php' style="color: #60B5FF;" class="continue-shopping"><i class="fa-solid fa-arrow-left"></i> TIẾP TỤC MUA SẮM</a>
                    </button>
                </div>
            <?php
            }
            ?>
        </div>



    </div>
</body>

<?php
require_once('layouts/client/footer.php');
?>

<script>
    // Truyền giá trị từ input payment và note vào form hidden
    document.addEventListener('DOMContentLoaded', function() {
        const paymentCod = document.getElementById('payment_cod');
        const paymentBank = document.getElementById('payment_bank');
        const paymentMethodHidden = document.getElementById('payment_method_hidden');
        const orderNoteHidden = document.getElementById('order_note_hidden');
        const noteInput = document.querySelector('input[name="note"]');

        if (paymentCod && paymentMethodHidden) {
            paymentCod.addEventListener('change', function() {
                if (this.checked) {
                    paymentMethodHidden.value = 'cod';
                }
            });
        }

        if (paymentBank && paymentMethodHidden) {
            paymentBank.addEventListener('change', function() {
                if (this.checked) {
                    paymentMethodHidden.value = 'bank_transfer';
                }
            });
        }

        if (noteInput && orderNoteHidden) {
            noteInput.addEventListener('input', function() {
                orderNoteHidden.value = this.value;
            });

            // Set initial value
            orderNoteHidden.value = noteInput.value;
        }
    });
</script>