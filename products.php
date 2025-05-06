<?php
   require_once('layouts/client/header.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>San Pham</title>
        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            .menu{
                width:20%;
                height:cover;
                left:0;
                background-color: whitesmoke;
                position: absolute;
                color:black;
                padding:20px;
            }
            .main{
                width:90%;
                height: 200vh;
                border:2px solid red;
                margin-left: 15%;
            }
            .menu ul li{
                border-bottom: 1px solid grey;
                list-style: none;
                padding:5px;
            }
            .menu ul li a{
                text-decoration:none;
                color:#0d6efd;
                display:block;
            }
            .menu ul li:hover{
                background: #0d6efd;
            }
            .menu ul li:hover a{
                color: white;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="menu">
                <h5>Thương hiệu</h5>
                <ul>
                    <li><a href=#>Dutch Lady</a></li>
                    <li><a href=#>TH True Milk</a></li>
                    <li><a href=#>Nutifood</a></li>
                    <li><a href=#>Nutricare</a></li>
                    <li><a href=#>Milo</a></li>
                    <li><a href=#>Nestlé</a></li>
                    <li><a href=#>IDP</a></li>
                </ul>
            </div>
            <div class="main">
                <div class="main_content">
                <div class="item1">item1</div>
                <div class="item1">item2</div>
                <div class="item1">item3</div>
                <div class="item1">item4</div>
                <div class="item1">item5</div>
                </div>
                
            </div>
        </div>
    </body>
</html>

<?php
require_once('layouts/client/footer.php');
?>