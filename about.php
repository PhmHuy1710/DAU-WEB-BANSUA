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

    /* #i {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        float: left;
        color: blue;
    } */
    #i {
        font-size: 30px;
        color: blue;
        margin-right: 10px;
    }

    
    .row5 {
        width: 100%;
        margin: 40px 0;
        text-align: center;
    }

    .row5-grid {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .leader-card {
        width: 300px;
        height: 300px;
        margin: 0 50px;
        background-color: white;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .leader-card #i3 {
        font-size: 50px;
        color: blue;

    }

    .leader-card:hover {
        transform: translateY(-20px);
        transition: 0.5s;
    }

    .row6 {
        width: 100%;
        margin: 40px 0;
        text-align: center;
        background-color: blue;
    }

    .row6-grid {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .row6-item {
        width: 200px;
        height: 200px;
        margin: 50px;
        background-color: white;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .row6-item #i2 {
        font-size: 50px;
        color: yellow;
    }

    .row7 {
        width: 100%;
        margin: 40px 0;
        text-align: center;
    }

    .row7 .buttons {
        margin: 20px 0;
    }

    .row7 .buttons button {
        width: 200px;
        height: 50px;
        margin: 20px;
        border-radius: 50%;
        background-color: blue;
        border: none;
        transition: 0.7s;
    }

    .row7 .buttons button:hover {
        background-color: red;
        color: white;
        cursor: pointer;
    }

    .row7 .buttons button a {
        text-decoration: none;
        color: white;
    }
</style>
<section class="py-5">
    <div class="container">
        <div class="row1">
            <h1>Giới Thiệu Về Milky</h1>
            <h3>Hành trình của chúng tôi trong việc cung cấp sản phẩm sữa chất lượng cao</h3>
        </div>
        <div class="row2">
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
                        <i id="i" class="fa-regular fa-circle-check"></i>
                        <h4>Sản phẩm chính hãng</h4>
                        <p>100% sản phẩm từ các thương hiệu uy tín và được kiểm chứng chất lượng.</p>
                    </div>
                    <div class="bottom-right">
                        <i id="i" class="fa-solid fa-car-side"></i>
                        <H4>Giao hàng nhanh chóng</H4>
                        <P>Đảm bảo giao hàng nhanh chóng và an toàn trong vòng 24h.</P>
                    </div>
                </div>
            </div>
        </div>
        <section class="features-section">
            <div class="container">
                <div class="section-heading">
                    <h2>Những Giá Trị Cốt Lõi</h2>
                    <p>Chúng tôi luôn hướng đến những giá trị cốt lõi để mang đến trải nghiệm tốt nhất cho khách hàng</p>
                </div>
                <div class="features-container">
                    <div class="feature-item fade-in" style="animation-delay: 0.1s;">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i id="i" class="fa-solid fa-star"></i>
                            </div>                
                            <h3 class="feature-title">Chất lượng hàng đầu</h3>
                            <p class="feature-description">Cam kết cung cấp sản phẩm sữa với chất lượng cao nhất, đảm bảo dinh dưỡng và an toàn cho sức khỏe người tiêu dùng.</p>
                        </div>
                    </div>

                    <div class="feature-item fade-in" style="animation-delay: 0.3s;">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i id="i" class="fa-solid fa-users"></i>
                            </div>
                            <h3 class="feature-title">Khách Hàng</h3>
                            <p class="feature-description">Đặt khách hàng vào trung tâm của mọi quyết định, mang đến trải nghiệm mua sắm thuận tiện và dịch vụ chăm sóc tận tâm.</p>
                        </div>
                    </div>

                    <div class="feature-item fade-in" style="animation-delay: 0.5s;">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i id="i" class="fa-solid fa-leaf"></i>
                            </div>
                            <h3 class="feature-title">Bền Vững</h3>
                            <p class="feature-description">Cam kết phát triển bền vững, sử dụng bao bì thân thiện với môi trường và hỗ trợ các nhà sản xuất có trách nhiệm.</P>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="features-section">
            <div class="container">
                <div class="section-heading">
                    <h2>Điều Gì Khiến Milky Trở Nên Đặc Biệt?</h2>
                </div>
                <div class="features-container">
                    <div class="feature-item fade-in" style="animation-delay: 0.1s;">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-certificate"></i>
                            </div>                
                            <h3 class="feature-title">Sản Phẩm Chính Hãng 100%</h3>
                            <p class="feature-description">Chúng tôi cam kết chỉ cung cấp sản phẩm chính hãng từ các thương hiệu lớn, uy tín trên thế giới.</p>
                        </div>
                    </div>
                    <div class="feature-item fade-in" style="animation-delay: 0.3s;">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-money-bill"></i>
                            </div>
                            <h3 class="feature-title">Giá Cả Cạnh Tranh</h3>
                            <p class="feature-description">Với chính sách giá hợp lý cùng nhiều chương trình khuyến mãi hấp dẫn, chúng tôi mang đến lựa chọn tiết kiệm nhất cho khách hàng.</p>
                        </div>
                    </div>

                    <div class="feature-item fade-in" style="animation-delay: 0.5s;">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <h3 class="feature-title">Dịch Vụ Khách Hàng 24/7</h3>
                            <p class="feature-description">Đội ngũ tư vấn và chăm sóc khách hàng sẵn sàng hỗ trợ mọi lúc, mọi nơi để đảm bảo trải nghiệm mua sắm trọn vẹn.</P>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="row5">
            <h4>Đội Ngũ Lãnh Đạo</h4>
            <div class="row5-grid">
                <div class="leader-card">
                    <i id="i3" id class="fa-solid fa-user-secret"></i>
                    <h4>Phạm Trường Huy</h4>
                    <p>CEO & Founder</p>
                </div>
                <div class="leader-card">
                    <i id="i3" class="fa-solid fa-user-secret"></i>
                    <h4>Nguyễn Ngọc Tân</h4>
                    <p>Marketing Manager</p>
                </div>
                <div class="leader-card">
                    <i id="i3" class="fa-solid fa-user-secret"></i>
                    <h4>Lê Văn Trung</h4>
                    <p>Sales Director</p>
                </div>
            </div>
</section>
</div>
<div class="row6">
    <div class="row6-grid">
        <div class="row6-item">
            <i id="i2" class="fa-solid fa-users"></i>
            <h3>5000+</h3>
            <p>Khách hàng thân thiết</p>
        </div>
        <div class="row6-item">
            <i id="i2" class="fa-solid fa-gift"></i>
            <h3>500+</h3>
            <p>Sản phẩm độc đáo</p>
        </div>
        <div class="row6-item">
            <i id="i2" class="fa-solid fa-car-side"></i>
            <h3>20000+</h3>
            <p>Đơn hàng đã giao</p>
        </div>
        <div class="row6-item">
            <i id="i2" class="fa-solid fa-star"></i>
            <h3>10+</h3>
            <p>Năm kinh nghiệm</p>
        </div>
    </div>
</div>
<div class="row7">
    <h2>Sẵn Sàng Trải Nghiệm Sản Phẩm Chất Lượng?</h2>
    <div class="buttons">
        <button type="submit" class="buy-button"><a href="products.php">MUA NGAY</a></button>
        <button type="submit" class="learn-button"><a href="contact.php">TÌM HIỂU THÊM</a></button>
    </div>
</div>
</div>
</section>

<?php
require_once('layouts/client/footer.php');
?>