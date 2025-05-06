    <!-- Footer -->
    <footer class="bg-dark text-white">
        <div class="container py-5">
            <div class="row g-4">
                <!-- About -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-logo mb-3">
                        <h3 class="text-white mb-0"><span class="text-primary">Milky</span><span class="text-info">World</span></h3>
                    </div>
                    <p class="text-light mb-4">Milky World là thương hiệu hàng đầu cung cấp các sản phẩm sữa và thực phẩm dinh dưỡng chất lượng cao, đảm bảo sức khỏe cho mọi gia đình Việt.</p>
                    <div class="social-links d-flex gap-3 mb-4">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f fa-fw"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Twitter">
                            <i class="fab fa-twitter fa-fw"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram fa-fw"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Youtube">
                            <i class="fab fa-youtube fa-fw"></i>
                        </a>
                    </div>
                    <div class="payment-methods">
                        <h6 class="text-white mb-3">Phương thức thanh toán</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <img src="assets/images/payments/mbbank.jpg" alt="Mastercard" width="40" height="25" class="rounded">
                            <img src="assets/images/payments/momo.webp" alt="Momo" width="40" height="25" class="rounded">
                            <img src="assets/images/payments/zalopay.png" alt="ZaloPay" width="40" height="25" class="rounded">
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-6">
                    <div class="row g-4">
                        <div class="col-lg-4 col-6">
                            <h5 class="footer-heading">Liên Kết Nhanh</h5>
                            <ul class="list-unstyled footer-links">
                                <li><a href="index.php" class="footer-link"><i class="fas fa-angle-right me-2"></i>Trang Chủ</a></li>
                                <li><a href="products.php" class="footer-link"><i class="fas fa-angle-right me-2"></i>Sản Phẩm</a></li>
                                <li><a href="about.php" class="footer-link"><i class="fas fa-angle-right me-2"></i>Giới Thiệu</a></li>
                                <li><a href="contact.php" class="footer-link"><i class="fas fa-angle-right me-2"></i>Liên Hệ</a></li>
                                <li><a href="blog.php" class="footer-link"><i class="fas fa-angle-right me-2"></i>Tin Tức</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-4 col-6">
                            <h5 class="footer-heading">Danh Mục Sản Phẩm</h5>
                            <ul class="list-unstyled footer-links">
                                <?php
                                $sql = "SELECT * FROM DanhMuc LIMIT 5";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<li><a href="products.php?category=' . $row['MaDM'] . '" class="footer-link"><i class="fas fa-angle-right me-2"></i>' . $row['TenDM'] . '</a></li>';
                                    }
                                } else {
                                    echo '<li><a href="products.php" class="footer-link"><i class="fas fa-angle-right me-2"></i>Tất cả sản phẩm</a></li>';
                                }
                                ?>
                            </ul>
                        </div>

                        <div class="col-lg-4 col-12 mt-lg-0 mt-4">
                            <h5 class="footer-heading">Thông Tin Liên Hệ</h5>
                            <ul class="list-unstyled contact-info">
                                <li class="d-flex mb-3">
                                    <div class="icon-box me-3">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>123 Đường ABC, Quận XYZ, TP. Hồ Chí Minh</div>
                                </li>
                                <li class="d-flex mb-3">
                                    <div class="icon-box me-3">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div><a href="tel:02812345678" class="footer-link">(028) 1234 5678</a></div>
                                </li>
                                <li class="d-flex mb-3">
                                    <div class="icon-box me-3">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div><a href="mailto:info@milkyworld.com" class="footer-link">info@milkyworld.com</a></div>
                                </li>
                                <li class="d-flex">
                                    <div class="icon-box me-3">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>Thứ 2 - Thứ 6: 8:00 - 17:00</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-3" style="background-color: #1a1e21; border-top: 1px solid rgba(255,255,255,0.1);">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-md-0 mb-3">&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. Tất cả quyền được bảo lưu.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="mb-0 text-muted small">Phiên bản <?php echo SITE_VERSION; ?> | <a href="privacy.php" class="text-muted">Chính sách bảo mật</a> | <a href="terms.php" class="text-muted">Điều khoản sử dụng</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

               
                const toast = document.createElement('div');
                toast.classList.add('toast-notification');
                toast.innerHTML = '<i class="fas fa-check-circle"></i> Sản phẩm đã được thêm vào giỏ hàng';
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
            });
        });
    </script>
</body>
</html>