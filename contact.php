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
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            .row1 {
                text-align: center;
                margin-bottom: 20px;
                height: 300px;
                background-color: gray;
                color: white;
            }
            .row1 h1 {
            padding-top: 100px;
            font-size: 50px;
            }
            .lienhe{
                text-align: center;
                margin-bottom: 20px;
                height: 300px;
                color: black;
                border: 1px solid #ccc;
            }
            
            .inf{
                margin-bottom: 20px;
                clear: both;
           }
           .item{
                width:30%;
                height: 250px;
                text-align: center;
                border: 1px solid #ccc;
                margin: 10px;
                display: inline-block;
                padding:20px;
                /* float:left; */
           }
            
        </style>

    </head>
    <body>
        <div class="container">
            <div class="row1">
                <h1>Liên hệ với chúng tôi</h1>
                <h5>Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn</h5>
            </div>
            <div class="inf">
                <div class="item">
                    <i class="fa-solid fa-location-dot"></i>
                    <h3>Địa chỉ</h3>
                </div>
                <div class="item">
                    <i class="fa-solid fa-phone"></i>
                    <h3>Điện thoại</h3>
                </div>
                <div class="item">  
                    <i class="fa-solid fa-envelope"></i>
                    <h3>Email</h3>
                </div>
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