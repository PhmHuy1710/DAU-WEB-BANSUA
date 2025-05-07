<?php
require_once('layouts/client/header.php');

$sql = "SELECT * FROM SanPham LIMIT 8";
$result = mysqli_query($conn, $sql);

// Hãng sữa
$brand_sql = "SELECT * FROM ThuongHieu ORDER BY TenTH";  
$brand_result = mysqli_query($conn, $brand_sql);
?>
<style>
    .row1 {
        text-align: center;
        margin-bottom: 20px;
        height: 300px;
        background-color: gray;
        color: white;
    }
    .row1 h1 {
       padding-top: 100px;
    }
    .row2 {
        display: flex;
        width: 100%;
    } 
    .row2 .left img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }
    .row2 .between {
        width: 200px;
        text-align: center;
        padding-top: 150px;
    }
    .row2 .between h5 {
        background-color: blue;
        color: white;
        padding: 10px;
        border-radius: 50%;

    }
    .row2 .right {
        padding-left: 20px;
        display: block;
        width: 75%;
    }
    .row2 .right .top h3 {
        margin-top: 5%;
        margin-left: 10%;
    }
    .row2 .right .bottom {
        display: flex;
        padding: 20px;
    }
    .row2 .right .bottom .bottom-left {
        width: 50%;
    }
    .row2 .right .bottom .bottom-right {

        width: 50%;
    }
    i{
        width: 30px;
        height: 30px;
        border-radius: 50%;
        float: left;
        color: blue;
    }
    .row3 {
        width: 100%;
        margin-top: 20px;
        text-align: center;
        
    }
    .row3-top {
        padding: 20px;
    }
    .row3-bottom1 {
        width: 30%;
        padding: 20px;
        border: 1px solid black;
        display: inline-block;
        margin: 0 20px;
        float: left;
    }

</style>
<section class="py-5">
    <div class="container">
        <div class="row1">
            <h1>Giới Thiệu Về Milky</h1>
            <h3>Hành trình của chúng tôi trong việc cung cấp sản phẩm sữa chất lượng cao</h3>
        </div>
        <div class="row2" >
            <div class="left">
                <img src="assets\images\logo.png" alt="">
            </div>
            <div class="between">
                <h5>+10<br>Năm kinh nghiệm</h5>
            </div>
            <div class="right">
                <div class="top">
                    <h3>Khởi Nguồn Từ Đam Mê</h3>
                    <hr>
                    <p>Milky được thành lập vào năm 2012 bởi 
                    một nhóm các chuyên gia dinh dưỡng đam mê
                    với sứ mệnh mang đến những sản phẩm sữa 
                    chất lượng cao nhất cho mọi gia đình Việt Nam.</p>
                    <p>Từ một cửa hàng nhỏ tại trung tâm thành phố,
                    chúng tôi đã phát triển thành một trong những 
                    nhà cung cấp sản phẩm sữa hàng đầu trên thị 
                    trường online, luôn đặt chất lượng và sự hài 
                    lòng của khách hàng lên hàng đầu.</p>  
                </div>
                <div class="bottom">
                    <div class="bottom-left">
                        <i class="fa-regular fa-circle-check"></i>
                        <h4>Sản phẩm chính hãng</h4>
                        <p>100% sản phẩm từ các thương hiệu uy tín và được kiểm chứng chất lượng.</p>
                    </div>
                    <div class="bottom-right">
                        <i class="fa-solid fa-car-side"></i>
                        <H4>Giao hàng nhanh chóng</H4>
                        <P>Đảm bảo giao hàng nhanh chóng và an toàn trong vòng 24h.</P>
                    </div>
                </div>
            </div>
        </div>
        <div class="row3" >
            <div class="row3-top">
                <h4>Những Giá Trị Cốt Lõi</h4>
                <p>Chúng tôi luôn hướng đến những giá trị cốt lõi để mang đến trải nghiệm tốt nhất cho khách hàng</p>
            </div>
            <div class="row3-bottom">
                <div class="row3-bottom1">
                    
                    <h4><i class="fa-solid fa-star"></i>Chất lượng hàng đầu</h4>
                    <p>Cam kết cung cấp sản phẩm sữa với chất lượng cao nhất, đảm bảo dinh dưỡng và an toàn cho sức khỏe người tiêu dùng.</p>
                </div>
                <div class="row3-bottom1">
                    <h4><i class="fa-solid fa-users"></i>Khách Hàng</h4>
                    <p>Đặt khách hàng vào trung tâm của mọi quyết định, mang đến trải nghiệm mua sắm thuận tiện và dịch vụ chăm sóc tận tâm.</p>
                </div>
                <div class="row3-bottom1">
                    <H4><i class="fa-solid fa-leaf"></i>Bền Vững</H4>
                    <P>Cam kết phát triển bền vững, sử dụng bao bì thân thiện với môi trường và hỗ trợ các nhà sản xuất có trách nhiệm.</P>
                </div>
            </div>
        </div>
        <div class="row4" >
            *****
        </div>
        <div class="row5" >
            *****
        </div>
        <div class="row6" >
            *****
        </div>
        <div class="row7" >
            *****
        </div>
    </div>
</section>

<?php
require_once('layouts/client/footer.php');
?>