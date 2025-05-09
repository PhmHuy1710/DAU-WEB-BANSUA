<?php
require_once("menu.php")
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <title>Trang chủ quản lí</title>
        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            .main-content{
                width:85%;
                height: 200vh;
                border:2px solid red;
                margin-left: 15%;
            }
            .banner{
                width:100%;
                height:70px;
                border: 1px solid black;
            }
            .banner h2{
                padding: 10px;
                font-size: 30px;
                color:rgb(5, 6, 7);
                text-align: center;
                font-size: 40px
            }
            .main{
                margin: 20px;
            }
            .item{
                width: 250px;
                height: 150px;
                text-align: center;
                border: 1px solid #ccc;
                margin: 10px;
                display: inline-block;
                border-radius: 10px;

            }
        </style>
    </head>
    <body>
        <div class="main-content">
            <div class="banner">
                <h2>ADMIN</h2>
            </div>
            <div class="main">
                <div class="item">Sản phẩm</div>
                <div class="item">Đơn hàng</div>
                <div class="item">Khách hàng</div>
                <div class="item">Thương hiệu</div>
                <div class="item">Doanh thu</div>
            </div>
            
       </div>
    </body>
</html>