# Milky - Website Bán Sữa

Website bán sữa thương hiệu **Milky** được phát triển bằng PHP thuần và MySQL.

## Yêu cầu hệ thống

- PHP 7.4 trở lên
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
│   ├── header.php       # Header chung
│   ├── footer.php       # Footer chung
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
│   ├── main.php         # Layout chính
│   └── admin.php        # Layout admin
├── models/              # Xử lý dữ liệu
│   ├── Brand.php        # Model quản lý thương hiệu
│   ├── Product.php      # Model quản lý sản phẩm
│   ├── User.php         # Model quản lý người dùng
│   ├── Order.php        # Model quản lý đơn hàng
│   └── Category.php     # Model quản lý danh mục
├── uploads/             # Thư mục lưu file upload
│   ├── brands/          # Ảnh thương hiệu
│   ├── avatars/         # Ảnh đại diện người dùng       
│   └── products/        # Ảnh sản phẩm
├── vendor/              # Thư viện bên thứ ba (nếu cần)
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
- Username: admin
- Password: admin123

Khách hàng:
- Username: customer
- Password: customer123
```