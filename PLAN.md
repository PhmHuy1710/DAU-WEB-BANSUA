# Kế hoạch xây dựng website bán sữa thương hiệu Milky

## Thông tin chung

- Tên website: Milky
- Ngôn ngữ: PHP, HTML, CSS, JavaScript
- Cơ sở dữ liệu: MySQL

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

## Cơ sở dữ liệu

### Bảng users

- id (PK)
- username
- password
- email
- fullname
- address
- phone
- role (admin/customer)
- created_at
- updated_at

### Bảng categories

- id (PK)
- name
- description
- created_at
- updated_at

### Bảng products

- id (PK)
- category_id (FK)
- name
- description
- price
- discount_price
- image
- quantity
- status (available/out of stock)
- created_at
- updated_at

### Bảng orders

- id (PK)
- user_id (FK)
- total_amount
- status (pending/processing/shipped/delivered/cancelled)
- shipping_address
- phone
- created_at
- updated_at

### Bảng order_items

- id (PK)
- order_id (FK)
- product_id (FK)
- quantity
- price
- created_at
- updated_at

## Chức năng chính

### Người dùng

1. Đăng ký tài khoản
2. Đăng nhập/Đăng xuất
3. Xem và cập nhật thông tin cá nhân
4. Xem lịch sử đơn hàng
5. Thêm sản phẩm vào giỏ hàng
6. Đặt hàng
7. Tìm kiếm sản phẩm
8. Lọc sản phẩm theo danh mục
9. Đánh giá sản phẩm
10. Yêu thích sản phẩm
11. Quên mật khẩu và khôi phục

### Admin

1. Quản lý sản phẩm (thêm, sửa, xóa)
2. Quản lý danh mục (thêm, sửa, xóa)
3. Quản lý đơn hàng (xem, cập nhật trạng thái)
4. Quản lý người dùng
5. Xem thống kê
6. Quản lý banner quảng cáo
7. Quản lý khuyến mãi và mã giảm giá
8. Quản lý đánh giá của khách hàng
9. Xuất báo cáo (PDF, Excel)
10. Cấu hình website

## Giao diện

- Responsive, thân thiện người dùng
  - Tương thích hoàn toàn với các thiết bị di động
  - Menu thu gọn trên thiết bị nhỏ
  - Hình ảnh tự điều chỉnh theo kích thước màn hình
  - Layout linh hoạt thay đổi theo từng thiết bị
- Tông màu chủ đạo: Trắng, xanh dương nhạt (phù hợp với sản phẩm sữa)
- Logo: Tên thương hiệu "Milky" với hình ảnh ly sữa
- Hiệu ứng chuyển động mượt mà
- Dark mode (Chế độ tối)
- Lazy loading cho hình ảnh
- Skeleton loading khi tải dữ liệu
- Breadcrumb hiển thị đường dẫn
- Thông báo toast khi thực hiện hành động
- Carousel và slider hiển thị sản phẩm nổi bật
- Giao diện đăng nhập/đăng ký hiện đại
- Filter sản phẩm được thiết kế trực quan

## Tính năng nâng cao

1. Tích hợp thanh toán trực tuyến (VNPay, Momo)
2. Chat trực tuyến hỗ trợ khách hàng
3. Đăng nhập bằng mạng xã hội (Google, Facebook)
4. Thông báo realtime cho admin
5. Tính năng đề xuất sản phẩm liên quan
6. Hệ thống tích điểm và khách hàng thân thiết
7. Tối ưu SEO
8. Tích hợp Google Analytics
9. Xuất hóa đơn PDF
10. Thông báo email tự động

## Thời gian triển khai

1. **Tuần 1**: Thiết kế cơ sở dữ liệu, cấu trúc thư mục, tạo giao diện cơ bản
2. **Tuần 2**: Phát triển chức năng người dùng
3. **Tuần 3**: Phát triển chức năng admin
4. **Tuần 4**: Kiểm thử, tối ưu và hoàn thiện

## Yêu cầu kỹ thuật

- PHP 7.4 trở lên
- MySQL 5.7 trở lên
- Hỗ trợ các trình duyệt hiện đại (Chrome, Firefox, Edge, Safari)
- Tối ưu tải trang (PageSpeed > 85)
- Bảo mật CSRF, XSS
- Responsive trên mọi thiết bị
- Thiết kế PWA (Progressive Web App)
- Sử dụng AJAX cho trải nghiệm người dùng mượt mà

## Các công nghệ bổ sung

- Bootstrap 5
- Font Awesome 6
- jQuery
- DataTables (cho trang admin)
- Chart.js (cho biểu đồ thống kê)
- SweetAlert2 (thông báo đẹp mắt)
- Lightbox (xem ảnh sản phẩm)
- FormValidation.js
- Select2 (dropdown nâng cao)
- Animate.css (hiệu ứng chuyển động)
