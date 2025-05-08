    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-main">
            <div class="footer-container">
                <div class="footer-content">
                    <!-- About -->
                    <div class="footer-about">
                        <div class="footer-logo">
                            <h3><span class="logo-primary">Milky</span><span class="logo-secondary">World</span></h3>
                        </div>
                        <p class="footer-description">Milky World là thương hiệu hàng đầu cung cấp các sản phẩm sữa và thực phẩm dinh dưỡng chất lượng cao, đảm bảo sức khỏe cho mọi gia đình Việt.</p>
                        <div class="social-links">
                            <a href="#" class="social-link" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Youtube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                        <div class="payment-methods">
                            <h6>Phương thức thanh toán</h6>
                            <div class="payment-icons">
                                <img src="assets/images/payments/mbbank.jpg" alt="Mastercard" width="40" height="25">
                                <img src="assets/images/payments/momo.webp" alt="Momo" width="40" height="25">
                                <img src="assets/images/payments/zalopay.png" alt="ZaloPay" width="40" height="25">
                            </div>
                        </div>
                    </div>

                    <div class="footer-links-container">
                        <div class="footer-links-column">
                            <h5 class="footer-heading">Liên Kết Nhanh</h5>
                            <ul class="footer-links">
                                <li><a href="index.php" class="footer-link"><i class="fas fa-angle-right"></i>Trang Chủ</a></li>
                                <li><a href="products.php" class="footer-link"><i class="fas fa-angle-right"></i>Sản Phẩm</a></li>
                                <li><a href="about.php" class="footer-link"><i class="fas fa-angle-right"></i>Giới Thiệu</a></li>
                                <li><a href="contact.php" class="footer-link"><i class="fas fa-angle-right"></i>Liên Hệ</a></li>
                                <li><a href="blog.php" class="footer-link"><i class="fas fa-angle-right"></i>Tin Tức</a></li>
                            </ul>
                        </div>

                        <div class="footer-links-column">
                            <h5 class="footer-heading">Danh Mục Sản Phẩm</h5>
                            <ul class="footer-links">
                                <?php
                                $sql = "SELECT * FROM DanhMuc LIMIT 5";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<li><a href="products.php?category=' . $row['MaDM'] . '" class="footer-link"><i class="fas fa-angle-right"></i>' . $row['TenDM'] . '</a></li>';
                                    }
                                } else {
                                    echo '<li><a href="products.php" class="footer-link"><i class="fas fa-angle-right"></i>Tất cả sản phẩm</a></li>';
                                }
                                ?>
                            </ul>
                        </div>

                        <div class="footer-links-column">
                            <h5 class="footer-heading">Thông Tin Liên Hệ</h5>
                            <ul class="contact-info">
                                <li>
                                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                                    <div class="contact-text">123 Đường ABC, Quận XYZ, TP. Đà Nẵng</div>
                                </li>
                                <li>
                                    <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                                    <div class="contact-text"><a href="tel:02812345678">(028) 1234 5678</a></div>
                                </li>
                                <li>
                                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                                    <div class="contact-text"><a href="mailto:info@milkyworld.com">info@milkyworld.com</a></div>
                                </li>
                                <li>
                                    <div class="contact-icon"><i class="fas fa-clock"></i></div>
                                    <div class="contact-text">Thứ 2 - Thứ 6: 8:00 - 17:00</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-container">
                <div class="copyright">
                    <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. Tất cả quyền được bảo lưu.</p>
                </div>
                <div class="version">
                    <p>Phiên bản <?php echo SITE_VERSION; ?></p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Toast notification function
        function showToast(message) {
            const toast = document.createElement('div');
            toast.classList.add('toast-notification');
            toast.innerHTML = '<i class="fas fa-check-circle"></i> ' + message;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('show');
            }, 100);

            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }

        // Add to cart functionality
        document.addEventListener('DOMContentLoaded', function() {
            const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
            if (addToCartButtons) {
                addToCartButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        showToast('Sản phẩm đã được thêm vào giỏ hàng');
                    });
                });
            }
        });
    </script>
    </body>

    </html>