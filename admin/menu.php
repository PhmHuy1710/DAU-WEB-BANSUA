<?php
require_once("../includes/session.php");

if(!isAdmin() && !isLoggedIn())     {
    header("Location: ../login.php");
    exit;
};


?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .menu{
            width:15%;
            height:100vh;
            background-color:rgb(164, 188, 202);
            float:left;
            position: fixed;
        }
        .logo img{
            width: 100%;
            height:150px;
        }
        .menu .list ul li{
            border-bottom: 1px solid grey;
            list-style: none;
            padding:10px;
            display: block;
            height:40px;      
        }
        .menu .list ul li a{
            text-decoration: none;
            font-size: 20px;
            color:black;
            
        }
        .menu .list ul li:first-child{
            border-top: 1px solid grey;
        }
        .menu .list ul li:hover{
            background: rgb(93, 138, 164);
        }
    </style>
</head>
<body>
    <div class="menu">
        <div class="logo">
            <img src="../assets/images/logo.png" alt="Logo" class="logo">
        </div>
       <div class="list">
        <ul>
            <li><a href=index.php>Bảng điều khiển</a></li>
            <li><a href="customers.php">Quản lí khách hàng</a></li>
            <li><a href="products.php">Quản lí sản phẩm</a></li>
            <li><a href="brands.php">Quản lí thương hiệu</a></li>
            <li><a href="orders.php">Quản lí đơn hàng</a></li>
            <li><a href="../index.php">Trang chủ</a></li>
        </ul>
       </div>
    </div>
</body>
</html>