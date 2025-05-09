<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
session_start();
//kiểm tra người dùng đã đăng nhập thành công chưa -> mời cho vào trang này
// B1: Mở kết nối CSDL
require_once("ketnoi.php");
$sql = "select sanpham.TenSP,sanpham.gia,giohang.SoLuong,sum(sanpham.gia*giohang.SoLuong) as ThanhTien
        from giohang
        join sanpham on giohang.MaSP = sanpham.MaSP
        GROUP BY
            sanpham.TenSP, sanpham.gia";
//B2: viết câu lệnh truy vấn lấy dữ liệu trong bảng the loai
$kq = mysqli_query($conn, $sql);
?>
<body>
    <div class="row1">
        <div class="col-12 text-center">
            <h1>Danh sách sản phẩm</h1>
        </div>
        <div class="col-12 text-center">
            <table class="sanpham-table">
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành Tiền</th>
                    <th>Thao Tác</th>
                </tr>
                <tr>
                <!-- các hàng nội dung, thay thế bằng lấy trong bảng theloai ra -->
                <tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($kq)) 
                    ?>
                <tr>
                    <td>
                        <?php
                            /*echo $row["id"] hiện cả id nơi tên */
                            echo $row["sanpham.TenSP"];
                        ?>
                    </td>
                    <td>
                        <?php
                            echo $row["sanpham.gia"];
                        ?>       
                    </td>
                    <td>
                        <?php
                            echo $row["giohang.SoLuong"] 
                        ?>
                    </td>
                    <td>
                        <?php
                            echo $row["ThanhTien"] 
                        ?>
                    </td>

                    <td><a href="capnhat.php?key=<?php echo $row['id']; ?>">Cập nhật</a></td>
                    <td><a onclick="return confirm ('bạn có muốn xoa ko')"  href="xoa.php?key=<?php echo $row['id']; ?>">Xóa</a></td>
                        
                </tr>

            </table>
        </div>
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
    <div class="">
        
    </div>
</body>
</html>