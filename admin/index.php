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
                margin-left: 15%;
            }
            .banner{
                width:100%;
                height:70px;
                background: rgb(164, 188, 202);
            }
            .banner h2{
                padding: 10px;
                font-size: 30px;
                color:rgb(25, 28, 31);
                text-align: center;
                font-size: 40px;
                
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
                font-size: 20px;
                padding-top:10px;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="main-content">
            <div class="banner">
                <h2>ADMIN</h2>
            </div>
            <div class="main">
                <a class="item" href="index.php" style="color:blue;">SẢN PHẨM</a>
                <a class="item" href="orders.php" style="color:darkorange;">ĐƠN HÀNG </a>
                <a class="item" href="customers.php" style="color:yellowgreen;">KHÁCH HÀNG</a>
                <a class="item" href="brands.php" style="color:blueviolet;">THƯƠNG HIỆU</a>
                <a class="item" href="qldt.php" style="color:chartreuse;">DOANH THU</a>
            </div>
            
       </div>
    </body>
</html>