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
    #img1{
        width: 40px;
        height: 40px;
        border-radius: 50%;
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
                        <img id="img1" src="https://img.pikbest.com/png-images/qiantu/yellow-tick-pattern_2626970.png!sw800" alt="">
                        <h4>Sản phẩm chính hãng</h4>
                        <p>100% sản phẩm từ các thương hiệu uy tín và được kiểm chứng chất lượng.</p>
                    </div>
                    <div class="bottom-right">
                        <img id="img1" src="https://media.istockphoto.com/id/1068362158/vi/vec-to/bi%E1%BB%83u-t%C6%B0%E1%BB%A3ng-giao-h%C3%A0ng.jpg?s=612x612&w=0&k=20&c=anJxVTe25N3oE5lOAa8ktngpgrwhi5KtFDsVJuSx8EA=" alt="">
                        <H4>Giao hàng nhanh chóng</H4>
                        <P>Đảm bảo giao hàng nhanh chóng và an toàn trong vòng 24h.</P>
                    </div>
                </div>
            </div>
        </div>
        <div class="row3" >
            
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