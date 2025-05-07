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
            .content{
                width: 100%;
                height: 300px;
                background: grey;
                justify-content: center;
                text-align: center;
                paddding:20px;
                /* margin-top:20px; */
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center; 
            }
            .content h2, .content p{
                display:block;
            }
            
        </style>

    </head>
    <body>
        <div class="container">
            <div class="content">
                <h2>Liên hệ với chúng tôi</h2><br>
                <p>Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn</p>
            </div>
            <div class="infor">
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
            </div>
            <div class="lienhe">
                <h4>Theo Dõi Chúng Tôi</h4>
                <p>Kết nối với chúng tôi trên các mạng xã hội để cập nhật những thông tin mới nhất</p>
            </div>
        </div>
    </body>
</html>
<?php
    require_once('layouts/client/footer.php');
?>