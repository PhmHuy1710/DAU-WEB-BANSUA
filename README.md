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
│   ├── css/              # Chứa các file CSS
│   ├── js/               # Chứa các file JavaScript
│   └── images/           # Chứa hình ảnh
│       ├── brands/       # Hình ảnh thương hiệu
│       └── products/     # Hình ảnh sản phẩm
├── config/               # Chứa các file cấu hình
│   ├── config.php        # File cấu hình chung
│   ├── database.php      # Cấu hình kết nối database
│   └── database.sql      # CSDL Website Milky
├── includes/             # Thư mục chứa các file PHP được include
│   ├── session.php       # Quản lý phiên đăng nhập
│   └── auth/             # Xử lý truy cập Auth
│   │    └── logout.php   # Đăng xuất
│   ├── cart/             # Xử lý giỏ hàng
│   │    ├── add.php      # Thêm sản phẩm vào giỏ
│   │    ├── edit.php     # Sửa số lượng sản phẩm
│   │    ├── delete.php   # Xóa sản phẩm khỏi giỏ
│   │    └── update.php   # Cập nhật giỏ hàng
│   └── orders/           # Xử lý đơn hàng
│        ├── add.php      # Thêm hóa đơn thanh toán
│        └── delete.php   # Hủy đơn hàng
├── admin/                # Phần quản trị website
│   ├── index.php         # Trang chủ admin
│   ├── brands/           # Quản lý thương hiệu
│   │    ├── index.php    # Danh sách thương hiệu
│   │    ├── add.php      # Thêm thương hiệu
│   │    ├── edit.php     # Sửa thương hiệu
│   │    └── delete.php   # Xóa thương hiệu
│   ├── products/         # Quản lý sản phẩm
│   │    ├── index.php    # Danh sách sản phẩm
│   │    ├── add.php      # Thêm sản phẩm
│   │    ├── edit.php     # Sửa sản phẩm
│   │    └── delete.php   # Xóa sản phẩm
│   ├── orders/           # Quản lý đơn hàng
│   │    ├── index.php    # Danh sách đơn hàng
│   │    ├── edit.php     # Sửa thông tin đơn hàng
│   │    └── delete.php   # Xóa đơn hàng
│   └── customers/        # Quản lý khách hàng
│        ├── index.php    # Danh sách khách hàng
│        ├── add.php      # Thêm khách hàng
│        ├── edit.php     # Sửa thông tin khách hàng
│        └── delete.php   # Xóa khách hàng
├── layouts/              # Giao diện chung
│   ├── client/           # Layout người dùng
│   │    ├── header.php   # Đầu trang
│   │    └── footer.php   # Cuối trang
│   └── admin/            # Layout admin
│        └── header.php   # Đầu trang admin
├── index.php             # Trang chủ
├── products.php          # Trang danh sách sản phẩm
├── product-detail.php    # Trang chi tiết sản phẩm
├── cart.php              # Trang giỏ hàng
├── about.php             # Trang thông tin
├── contact.php           # Trang liên hệ
├── orders.php            # Trang danh sách hóa đơn của KH
├── orders.php            # Trang chi tiết hóa đơn của KH
├── login.php             # Trang đăng nhập
├── register.php          # Trang đăng ký
└── README.md             # Hướng dẫn
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
