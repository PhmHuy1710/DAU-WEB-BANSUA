<?php
require_once('layouts/client/header.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .row1 {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
            height: 300px;
            background-color: gray;
            color: white;
            margin-top: 50px;
        }

        .row1 h1 {
            padding-top: 100px;
            font-size: 50px;
        }

        .inf {
            margin-bottom: 20px;
            clear: both;
        }

        .item {
            position: relative;
            width: 30%;
            height: 300px;
            text-align: center;
            border: 1px solid #ccc;
            margin: 10px;
            display: inline-block;
            padding: 20px;
            margin: 20px;
            border-radius: 5%;
            background: gainsboro;
            box-sizing: border-box;
            /* float:left; */
        }

        .fa-brands {
            font-size: 50px;
            margin: 15px;
            color: #333;

        }

        .fa-solid {
            font-size: 40px;
            margin: 15px;
            color: #007bff;
        }

        .fa-brands:hover {
            color: #007bff;
        }

        .fa-solid:hover {
            color: #007bff;
        }

        .item h3 {
            margin: 10px;
        }

        .end {
            background: #007bff;
            height: 250px;
            color: #fff;
            text-align: center;
            padding: 30px;
        }

        #dk {
            margin-left: 10px;
            ;
        }

        .lienhe {
            text-align: center;
            height: 300px;
            color: black;
            padding: 50px;
            font-size: 20px;
            ;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row1">
            <h1>Liên hệ với chúng tôi</h1>
            <p>Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn</p>
        </div>
        <div class="inf">
            <div class="item">
                <i class="fa-solid fa-location-dot"></i>
                <h3>Địa chỉ</h3>
                <p>Đà Nẵng Việt Nam</p>
            </div>
            <div class="item">
                <i class="fa-solid fa-phone"></i>
                <h3>Điện thoại</h3>
                <p>Hotline:123456789</p>
            </div>
            <div class="item">
                <i class="fa-solid fa-envelope"></i>
                <h3>Email</h3>
                <p>123@gmail.com</p>
            </div>
        </div>
        <div class="end">
            <h3>Đăng Ký Nhận Tin</h3>
            <p>Cập nhật thông tin sản phẩm và các chương trình khuyến mãi hấp dẫn</p>
            <input type="text" placeholder="Nhập địa chỉ email của bạn" style="width: 300px; padding: 10px; border-radius: 10px; border: 1px solid #ccc;">
            <input type="submit" value="Đăng ký" id="dk" style="padding: 10px 20px;  border: none; border-radius: 10px;border: 1px solid #ccc; ">
        </div>
        <div class="lienhe">
            <h4>Theo Dõi Chúng Tôi</h4>
            <p>Kết nối với chúng tôi trên các mạng xã hội để cập nhật những thông tin mới nhất</p>
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-brands fa-youtube"></i>
            <i class="fa-brands fa-tiktok"></i>
        </div>

    </div>
</body>

</html>
<?php
require_once('layouts/client/footer.php');
?>