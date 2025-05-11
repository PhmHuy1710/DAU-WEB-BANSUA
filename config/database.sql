-- CSDL Milky World - MySQL 8.2 PHPMyAdmin
CREATE DATABASE IF NOT EXISTS db_milky CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_milky;

DROP TABLE IF EXISTS ChiTietHoaDon;
DROP TABLE IF EXISTS GioHang;
DROP TABLE IF EXISTS HoaDon;
DROP TABLE IF EXISTS SanPham;
DROP TABLE IF EXISTS DanhMuc;
DROP TABLE IF EXISTS ThuongHieu;
DROP TABLE IF EXISTS KhachHang;

-- Bảng Khách Hàng
CREATE TABLE IF NOT EXISTS KhachHang (
    MaKH varchar(10) NOT NULL,
    TenKH varchar(255) NOT NULL,
    Email varchar(255) NOT NULL,
    MatKhau varchar(255) NOT NULL,
    DiaChi varchar(255) DEFAULT '',
    SoDienThoai varchar(20) DEFAULT '',
    VaiTro enum('admin', 'user') NOT NULL DEFAULT 'user',
    Avatar varchar(255) DEFAULT NULL,
    TrangThai tinyint(1) NOT NULL DEFAULT 1 COMMENT '1: Hoạt động, 0: Bị khóa',
    TokenReset varchar(255) DEFAULT NULL,
    TokenExpire datetime DEFAULT NULL,
    NgayTao datetime DEFAULT CURRENT_TIMESTAMP,
    NgayCapNhat datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (MaKH),
    UNIQUE KEY unique_email (Email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng Danh Mục
CREATE TABLE IF NOT EXISTS DanhMuc (
    MaDM varchar(10) NOT NULL,
    TenDM varchar(255) NOT NULL,
    MoTa text,
    NgayTao datetime DEFAULT CURRENT_TIMESTAMP,
    NgayCapNhat datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (MaDM)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng Thương Hiệu Sản Phẩm
CREATE TABLE IF NOT EXISTS ThuongHieu (
    MaTH varchar(10) NOT NULL,
    TenTH varchar(255) NOT NULL,
    HinhAnh varchar(255),
    MoTa text,
    NgayTao datetime DEFAULT CURRENT_TIMESTAMP,
    NgayCapNhat datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (MaTH)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng Sản Phẩm
CREATE TABLE IF NOT EXISTS SanPham (
    MaSP varchar(10) NOT NULL,
    MaDM varchar(10) NOT NULL,
    MaTH varchar(10) NOT NULL,
    TenSP varchar(255) NOT NULL,
    MoTa text,
    Gia decimal(10,2) NOT NULL,
    TrongLuong int,
    DonVi enum('g', 'ml') DEFAULT 'g',
    HinhAnh varchar(255),
    SoLuong int(11) NOT NULL DEFAULT 0,
    TrangThai enum('con_hang', 'het_hang') NOT NULL DEFAULT 'con_hang',
    NgayTao datetime DEFAULT CURRENT_TIMESTAMP,
    NgayCapNhat datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (MaSP),
    FOREIGN KEY (MaDM) REFERENCES DanhMuc(MaDM) ON DELETE CASCADE,
    FOREIGN KEY (MaTH) REFERENCES ThuongHieu(MaTH) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng Hóa Đơn
CREATE TABLE IF NOT EXISTS HoaDon (
    MaHD varchar(10) NOT NULL,
    MaKH varchar(10) NOT NULL,
    TongTien decimal(10,2) NOT NULL,
    TongTienGoc decimal(10,2) NOT NULL,
    TrangThai enum('cho_duyet', 'dang_xu_ly', 'dang_giao', 'da_giao', 'da_huy') NOT NULL DEFAULT 'cho_duyet',
    TenNguoiNhan varchar(100) NOT NULL,
    DiaChi varchar(255) NOT NULL,
    SoDienThoai varchar(20) NOT NULL,
    GhiChu text,
    NgayTao datetime DEFAULT CURRENT_TIMESTAMP,
    NgayCapNhat datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (MaHD),
    FOREIGN KEY (MaKH) REFERENCES KhachHang(MaKH) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng Chi Tiết Hóa Đơn
CREATE TABLE IF NOT EXISTS ChiTietHoaDon (
    MaHD varchar(10) NOT NULL,
    MaSP varchar(10) NOT NULL,
    SoLuong int(11) NOT NULL,
    Gia decimal(10,2) NOT NULL,
    NgayTao datetime DEFAULT CURRENT_TIMESTAMP,
    NgayCapNhat datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (MaHD, MaSP),
    FOREIGN KEY (MaHD) REFERENCES HoaDon(MaHD) ON DELETE CASCADE,
    FOREIGN KEY (MaSP) REFERENCES SanPham(MaSP) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng Giỏ Hàng
CREATE TABLE IF NOT EXISTS GioHang (
    MaKH varchar(10) NOT NULL,
    MaSP varchar(10) NOT NULL,
    SoLuong int(11) NOT NULL,
    NgayTao datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (MaKH, MaSP),
    FOREIGN KEY (MaKH) REFERENCES KhachHang(MaKH) ON DELETE CASCADE,
    FOREIGN KEY (MaSP) REFERENCES SanPham(MaSP) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Chèn dữ liệu cho bảng KhachHang (Quản Trị: admin@gmail.com | Gunny123456@. Client: user@gmail.com | 123456)
INSERT IGNORE INTO KhachHang (MaKH, TenKH, Email, MatKhau, DiaChi, SoDienThoai, VaiTro, Avatar, TrangThai, NgayTao, NgayCapNhat)
VALUES
('KH001', 'Quản Trị Viên', 'admin@gmail.com', '$2y$10$XSMCmK.NSN/Cqv9kq/AuEuQRM594TodIdOuNbj1kuCQnZilkdZzUq', 'Hà Nội', '0123456789', 'admin', NULL, 1, NOW(), NOW()),
('KH002', 'Người Dùng', 'user@gmail.com', '$2y$10$jtfIrLJs73z6KmDAM0vX1OBcL63qy36sb9cMTGa5Pjisws1QYXq1G', 'TP.HCM', '0987654321', 'user', NULL, 1, NOW(), NOW());

-- Chèn dữ liệu cho bảng DanhMuc
INSERT IGNORE INTO DanhMuc (MaDM, TenDM, MoTa, NgayTao, NgayCapNhat)
VALUES
('SUATUOI', 'Sữa tươi', 'Các loại sữa tươi nguyên chất, ít đường, không đường', NOW(), NOW()),
('SUACHUA', 'Sữa chua', 'Các loại sữa chua uống, sữa chua ăn, sữa chua hoa quả', NOW(), NOW()),
('SUABOT', 'Sữa bột', 'Các loại sữa bột cho trẻ em và người lớn', NOW(), NOW()),
('SUADAC', 'Sữa đặc', 'Các loại sữa đặc có đường và không đường', NOW(), NOW()),
('SUAHAT', 'Sữa hạt', 'Các loại sữa từ hạt như hạnh nhân, óc chó, đậu nành', NOW(), NOW());

-- Chèn dữ liệu cho bảng ThuongHieu
INSERT IGNORE INTO ThuongHieu (MaTH, TenTH, HinhAnh, MoTa, NgayTao, NgayCapNhat)
VALUES
('VNM', 'Vinamilk', 'VNM.png','Công ty Cổ phần Sữa Việt Nam', NOW(), NOW()),
('THTM', 'TH True Milk', 'THTM.jpg', 'Công ty Cổ phần Sữa TH', NOW(), NOW()),
('DL', 'Dutch Lady', 'DL.png' ,'Công ty TNHH FrieslandCampina Việt Nam', NOW(), NOW()),
('NST', 'Nestle', 'NST.png' ,'Tập đoàn Nestle Thụy Sĩ', NOW(), NOW()),
('ABT', 'Abbott', 'ABT.png','Tập đoàn Abbott Hoa Kỳ', NOW(), NOW());

-- Chèn dữ liệu cho bảng SanPham
INSERT IGNORE INTO SanPham (MaSP, MaDM, MaTH, TenSP, MoTa, Gia, TrongLuong, DonVi, HinhAnh, SoLuong, TrangThai, NgayTao, NgayCapNhat)
VALUES
('VNM072', 'SUATUOI', 'VNM', 'Thùng 48 hộp sữa tươi tiệt trùng có đường Vinamilk 100% Sữa tươi 180ml', 'Sữa bò tươi nguyên chất 100% được vắt và đóng hộp ngay trong ngày với gấp 2 lần hiệu quả hấp thu Canxi và đạt 400 tiêu chuẩn sạch tinh khiết của Hoa Kỳ.', 348000, 180, 'ml', 'VNM072.jpg', 100, 'con_hang', NOW(), NOW()),
('NST311', 'SUATUOI', 'NST', 'Thùng 48 hộp sữa tiệt trùng có đường Nestlé NutriStrong 180ml', 'Được bổ sung thêm 25% canxi, vitamin A & D, sữa tươi Nestle gấu giúp xương bạn khoẻ hơn mỗi ngày. Sữa tươi Nestle được nhiều người ưa chuộng bởi nguồn dinh dưỡng dồi dào mà nó luôn cung cấp cho cơ thể. Thùng 48 hộp sữa tiệt trùng có đường Nestlé NutriStrong 180ml thêm đường kích thích vị ngon, dễ uống', 384000, 180, 'ml', 'NST311.jpg', 100, 'con_hang', NOW(), NOW()),
('VNM871', 'SUACHUA', 'VNM', 'Lốc 4 hộp sữa chua có đường Vinamilk 100g', 'Sữa chua Vinamilk chứa nhiều canxi, vitamin, khoáng chất ở dạng dễ hấp thu, kích thích vị giác, tăng cường sức khỏe hệ tiêu hóa, miễn dịch. Lốc 4 hộp sữa chua Vinamilk có đường 100g là loại sữa chua có hương vị thơm ngon tinh khiết và giàu dưỡng chất, thích hợp cho mọi người. ', 25000, 100, 'ml', 'VNM871.jpg', 100, 'con_hang', NOW(), NOW()),
('ABT523', 'SUABOT', 'ABT', 'Sữa bột Ensure Gold', 'Sữa bột dinh dưỡng cho người lớn tuổi', 799000, 400, 'g', 'ABT523.jpg', 30, 'con_hang', NOW(), NOW()),
('VNM802', 'SUADAC', 'VNM', 'Sữa đặc có đường Ông Thọ Đỏ lon 380g', 'Sữa đặc Ông Thọ với vị thơm ngon, sánh đặc, là bí quyết giúp mẹ có những món ăn ngon, chăm sóc cho cả gia đình. Sữa đặc có đường Ông Thọ đỏ lon 380g có độ béo và ngậy, pha sữa sẽ làm sữa dậy mùi. Ngoài ra, sữa đặc còn là nguồn nguyên liệu hoàn hảo để làm món ăn, thức uống khác.', 25000, 380, 'g', 'VNM802.jpg', 200, 'con_hang', NOW(), NOW()),
('DL162', 'SUAHAT', 'DL', 'Sữa hạnh nhân Alpro', 'Sữa từ hạnh nhân tự nhiên, không lactose', 85000, 1000, 'ml', 'DL162.webp', 50, 'con_hang', NOW(), NOW());

-- Chèn dữ liệu bảng GioHang
INSERT IGNORE INTO GioHang (MaKH, MaSP, SoLuong, NgayTao)
VALUES
('KH001', 'VNM072', 1, NOW()),
('KH002', 'NST311', 2, NOW()),
('KH001', 'VNM871', 3, NOW()),
('KH002', 'ABT523', 4, NOW());

-- Chèn dữ liệu bảng HoaDon
INSERT IGNORE INTO HoaDon (MaHD, MaKH, TongTien, TongTienGoc, TrangThai, TenNguoiNhan, DiaChi, SoDienThoai, GhiChu, NgayTao, NgayCapNhat)
VALUES
('HD001', 'KH001', 100000, 100000, 'dang_xu_ly', 'Nguyễn Văn A', '123 Đường ABC, Hà Nội', '0987654321', 'Cho nhiều sữa 1 tíiii', NOW(), NOW()),
('HD032', 'KH001', 100000, 100000, 'cho_duyet', 'Nguyễn Văn A', '123 Đường ABC, Hà Nội', '0987654321', null, NOW(), NOW()),
('HD002', 'KH002', 240000, 240000, 'cho_duyet', 'Trần Thị B', '456 Đường XYZ, TP.HCM', '0912345678', 'Ship tới thì nhớ gọi điện nhaa', NOW(), NOW()),
('HD003', 'KH001', 120000, 120000, 'da_giao', 'Lê Văn C', '789 Đường DEF, Đà Nẵng', '0934567890', 'Hàng dễ vỡ nên gói kín nhẹ nhàng nha', NOW(), NOW()),
('HD004', 'KH002', 100000, 100000, 'cho_duyet', 'Trần Thị D', '101 Đường GHI, Hà Nội', '0945678901', 'Không thấy chủ nhà thì đưa hàng xóm cất hộ!', NOW(), NOW()),
('HD005', 'KH001', 150000, 150000, 'dang_giao', 'Nguyễn Thị E', '102 Đường JKL, TP.HCM', '0956789012', 'Sữa này uống vào có vị gì dị sốp', NOW(), NOW());
-- Chèn dữ liệu bảng chi tiết hóa đơn
INSERT IGNORE INTO ChiTietHoaDon (MaHD, MaSP, SoLuong, Gia, NgayTao, NgayCapNhat)
VALUES
('HD001', 'VNM072', 1, 10000, NOW(), NOW()),
('HD001', 'VNM871', 3, 15000, NOW(), NOW()),
('HD002', 'NST311', 2, 12000, NOW(), NOW()),
('HD002', 'ABT523', 4, 799000, NOW(), NOW()),
('HD003', 'VNM802', 1, 22000, NOW(), NOW()),
('HD003', 'DL162', 2, 85000, NOW(), NOW()),
('HD004', 'VNM072', 1, 10000, NOW(), NOW()),
('HD004', 'VNM871', 2, 15000, NOW(), NOW()),
('HD005', 'NST311', 1, 12000, NOW(), NOW()),
('HD005', 'ABT523', 3, 799000, NOW(), NOW());

