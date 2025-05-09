<?php
require_once('layouts/client/header.php');
?>
<style>
    .contact-cards {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 20px;
        margin: 40px 0;
    }

    .contact-card {
        background-color: white;
        border-radius: var(--border-radius-md);
        box-shadow: var(--shadow-md);
        padding: 30px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .contact-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-lg);
    }

    .contact-icon {
        width: 80px;
        height: 80px;
        background-color: rgba(96, 181, 255, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .contact-icon i {
        font-size: 40px;
        color: var(--primary-color);
    }

    .contact-title {
        font-size: 1.3rem;
        color: var(--dark-color);
        margin-bottom: 15px;
    }

    .contact-text {
        color: var(--primary-color);
        line-height: 1.5;
    }

    .newsletter-section {
        background-color: var(--primary-color);
        color: white;
        padding: 40px;
        border-radius: var(--border-radius-md);
        text-align: center;
        margin: 40px 0;
        box-shadow: var(--shadow-md);
    }

    .newsletter-title {
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    .newsletter-description {
        margin-bottom: 25px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .newsletter-form {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        max-width: 500px;
        margin: 0 auto;
    }

    .newsletter-input {
        width: 100%;
        padding: 12px 15px;
        border: none;
        border-radius: var(--border-radius-sm);
        font-size: 1rem;
    }

    .social-section {
        text-align: center;
        padding: 40px 0;
        margin-bottom: 30px;
    }

    .social-title {
        font-size: 1.5rem;
        color: var(--dark-color);
        margin-bottom: 15px;
    }

    .social-description {
        color: var(--secondary-color);
        margin-bottom: 25px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .social-icons {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .social-icon {
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: #f8f9fa;
        color: #333;
        font-size: 30px;
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        transform: translateY(-5px);
        color: white;
    }

    .social-icon.facebook:hover {
        background-color: #3b5998;
    }

    .social-icon.instagram:hover {
        background-color: #e4405f;
    }

    .social-icon.twitter:hover {
        background-color: #1da1f2;
    }

    .social-icon.youtube:hover {
        background-color: #ff0000;
    }

    .social-icon.tiktok:hover {
        background-color: #000000;
    }

    @media (min-width: 768px) {
        .contact-cards {
            grid-template-columns: repeat(3, 1fr);
        }

        .newsletter-form {
            flex-direction: row;
        }

        .newsletter-input {
            width: 70%;
        }
    }
</style>
<main>
    <div class="container">
        <div class="breadcrumb-container fade-in" style="animation-delay: 0.1s;">
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fas fa-home"></i> Trang chủ</a></li>
                <li class="active">
                    <span><i class="fas fa-envelope"></i> Liên hệ</span>
                </li>
            </ul>
        </div>

        <div class="section section-light text-center fade-in" style="animation-delay: 0.2s; height: 300px; padding-top: 50px; border-radius: var(--border-radius-md); margin-bottom: 30px; color: var(--dark-color);">
            <div class="section-heading">
                <h2>Liên hệ với chúng tôi</h2>
            </div>
        </div>

        <div class="contact-cards">
            <div class="contact-card fade-in" style="animation-delay: 0.3s;">
                <div class="contact-icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <h3 class="contact-title">Địa chỉ</h3>
                <p class="contact-text">Đà Nẵng Việt Nam</p>
            </div>

            <div class="contact-card fade-in" style="animation-delay: 0.4s;">
                <div class="contact-icon">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <h3 class="contact-title">Điện thoại</h3>
                <p class="contact-text">Hotline: 123456789</p>
            </div>

            <div class="contact-card fade-in" style="animation-delay: 0.5s;">
                <div class="contact-icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <h3 class="contact-title">Email</h3>
                <p class="contact-text">123@gmail.com</p>
            </div>
        </div>

        <div class="newsletter-section fade-in" style="animation-delay: 0.6s;">
            <h3 class="newsletter-title">Đăng Ký Nhận Tin</h3>
            <p class="newsletter-description">Cập nhật thông tin sản phẩm và các chương trình khuyến mãi hấp dẫn</p>
            <div class="newsletter-form">
                <input type="text" placeholder="Nhập địa chỉ email của bạn" class="newsletter-input">
                <button class="btn btn-primary">Đăng ký</button>
            </div>
        </div>

        <div class="social-section fade-in" style="animation-delay: 0.7s;">
            <h4 class="social-title">Theo Dõi Chúng Tôi</h4>
            <p class="social-description">Kết nối với chúng tôi trên các mạng xã hội để cập nhật những thông tin mới nhất</p>
            <div class="social-icons">
                <a href="#" class="social-icon facebook"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="social-icon instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="social-icon twitter"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" class="social-icon youtube"><i class="fa-brands fa-youtube"></i></a>
                <a href="#" class="social-icon tiktok"><i class="fa-brands fa-tiktok"></i></a>
            </div>
        </div>
    </div>
</main>

<?php
require_once('layouts/client/footer.php');
?>