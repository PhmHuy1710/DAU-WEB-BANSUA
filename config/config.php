<?php

$base_url = 'http://localhost';
define('SITE_NAME', 'Milky World - Thế Giới Sữa');
define('SITE_VERSION', '1.0.8');

// Thiết lập timezone
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Đuôi extension file hình ảnh cho phép
define('IMAGE_EXTENSION', ['jpg', 'jpeg', 'png', 'gif', 'webp']);

// Kích thước tối đa cho upload (5MB)
define('MAX_FILE_SIZE', 5 * 1024 * 1024);

// Thiết lập hình ảnh mặc định dùng chung cho tất cả các thành phần
define('DEFAULT_IMAGE', 'assets/images/default-image.jpg');

// Đường dẫn thư mục hình ảnh
define('UPLOAD_DIR', 'assets/images/');
define('AVATAR_DIR', 'assets/images/avatars/');
define('PRODUCT_DIR', 'assets/images/products/');
define('BRAND_DIR', 'assets/images/brands/');
define('CATEGORY_DIR', 'assets/images/categories/');
?>