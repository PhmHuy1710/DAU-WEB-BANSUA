# Milky - Website Bán Sữa

Website bán sữa thương hiệu **Milky** được phát triển bằng PHP thuần và MySQL.

## Yêu cầu hệ thống

- PHP 8.2.15
- MySQL 5.7 trở lên
- Web server (Apache/Nginx)

## Cài đặt

1. Clone dự án về máy local.
2. Tạo database MySQL mới.
3. Import file `database.sql` vào database vừa tạo.
4. Cấu hình kết nối database trong file `config/database.php`.
5. Truy cập website qua domain đã cấu hình.

## Thông tin chung

- **Tên website:** Milky World
- **Ngôn ngữ:** PHP, HTML, CSS, JavaScript
- **Cơ sở dữ liệu:** MySQL

## Cấu trúc thư mục

<pre>
milky/
├── assets/               # Thư mục chứa tài nguyên tĩnh
│   ├── css/             # Chứa các file CSS
│   ├── js/              # Chứa các file JavaScript
│   └── images/          # Chứa hình ảnh
├── config/              # Chứa các file cấu hình
│   ├── config.php       # File cấu hình chung
│   └── database.php     # Cấu hình kết nối database
├── includes/            # Thư mục chứa các file PHP được include
│   ├── functions.php    # Các hàm tiện ích
│   └── session.php      # Quản lý phiên đăng nhập
├── admin/               # Phần quản trị website
│   ├── index.php        # Trang chủ admin
|   ├── brands.php       # Quản lý thương hiệu
│   ├── products.php     # Quản lý sản phẩm
│   ├── orders.php       # Quản lý đơn hàng
│   ├── users.php        # Quản lý người dùng
│   └── categories.php   # Quản lý danh mục
├── layouts/             # Giao diện chung
│   ├── client           #Layout user
│   │    ├── header.php 
│   │    └── footer.php  
│   └── admin            # Layout admin
│        └── header.php  
├── index.php            # File chính
├── products.php         # Trang danh sách sản phẩm
├── product-detail.php   # Trang chi tiết sản phẩm
├── cart.php             # Trang giỏ hàng
├── checkout.php         # Trang thanh toán
├── login.php            # Trang đăng nhập
├── register.php         # Trang đăng ký
├── database_milky       # Cơ sở dữ liệu Milky
└── README.md            # Hướng dẫn
</pre>

## Tài khoản mặc định

```plaintext
Admin:
- Username: admin@gmail.com
- Password: Gunny123456@

Khách hàng:
- Username: user@gmail.com
- Password: 123456
```
