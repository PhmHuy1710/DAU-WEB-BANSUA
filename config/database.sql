-- CSDL Milky World - MySQL 8.2 PHPMyAdmin
CREATE DATABASE IF NOT EXISTS db_milky CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_milky;

-- Bảng Khách Hàng
CREATE TABLE IF NOT EXISTS KhachHang (
    MaKH varchar(10) NOT NULL AUTO _INCREMENT,
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

-- Bảng Sản Phẩm
CREATE TABLE IF NOT EXISTS SanPham (
    MaSP varchar(10) NOT NULL,
    MaDM varchar(10) NOT NULL,
    TenSP varchar(255) NOT NULL,
    MoTa text,
    Gia decimal(10,2) NOT NULL,
    GiaKhuyenMai decimal(10,2),
    HinhAnh varchar(255),
    SoLuong int(11) NOT NULL DEFAULT 0,
    TrangThai enum('con_hang', 'het_hang') NOT NULL DEFAULT 'con_hang',
    NgayTao datetime DEFAULT CURRENT_TIMESTAMP,
    NgayCapNhat datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (MaSP),
    FOREIGN KEY (MaDM) REFERENCES DanhMuc(MaDM) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng Đơn Hàng
CREATE TABLE IF NOT EXISTS HoaDon (
    MaDH varchar(10) NOT NULL,
    MaKH varchar(10) NOT NULL,
    TongTien decimal(10,2) NOT NULL,
    TrangThai enum('cho_duyet', 'dang_xu_ly', 'dang_giao', 'da_giao', 'da_huy') NOT NULL DEFAULT 'cho_duyet',
    DiaChiGiao varchar(255) NOT NULL,
    SoDienThoai varchar(20) NOT NULL,
    NgayTao datetime DEFAULT CURRENT_TIMESTAMP,
    NgayCapNhat datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (MaDH),
    FOREIGN KEY (MaKH) REFERENCES KhachHang(MaKH) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng Chi Tiết Đơn Hàng
CREATE TABLE IF NOT EXISTS ChiTietHoaDon (
    MaCTHD varchar(10) NOT NULL,
    MaDH varchar(10) NOT NULL,
    MaSP varchar(10) NOT NULL,
    SoLuong int(11) NOT NULL,
    Gia decimal(10,2) NOT NULL,
    NgayTao datetime DEFAULT CURRENT_TIMESTAMP,
    NgayCapNhat datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (MaCTHD),
    FOREIGN KEY (MaDH) REFERENCES HoaDon(MaDH) ON DELETE CASCADE,
    FOREIGN KEY (MaSP) REFERENCES SanPham(MaSP) ON DELETE CASCADE
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

-- Chèn dữ liệu cho bảng KhachHang (Quản Trị: admin@gmail.com | Gunny123456@. Client: user@gmail.com | 123456)
INSERT INTO KhachHang (MaKH, TenKH, Email, MatKhau, DiaChi, SoDienThoai, VaiTro, Avatar, TrangThai, NgayTao, NgayCapNhat)
VALUES
('KH001', 'Quản Trị Viên', 'admin@gmail.com', '$2y$10$XSMCmK.NSN/Cqv9kq/AuEuQRM594TodIdOuNbj1kuCQnZilkdZzUq', 'Hà Nội', '0123456789', 'admin', NULL, 1, NOW(), NOW()),
('KH002', 'Khách Hàng', 'user@gmail.com', '$2y$10$YMm2YkHwsRJ5QxR5jYL9.uXgMqej3tUBSqrXTL2UpWz3yCQRLzjgG', 'TP. Hồ Chí Minh', '0987654321', 'user', NULL, 1, NOW(), NOW());

-- Chèn dữ liệu cho bảng DanhMuc
INSERT INTO DanhMuc (MaDM, TenDM, MoTa, NgayTao, NgayCapNhat)
VALUES
('DM001', 'Sữa tươi', 'Các loại sữa tươi nguyên chất, ít đường, không đường', NOW(), NOW()),
('DM002', 'Sữa chua', 'Các loại sữa chua uống, sữa chua ăn, sữa chua hoa quả', NOW(), NOW()),
('DM003', 'Sữa bột', 'Các loại sữa bột cho trẻ em và người lớn', NOW(), NOW()),
('DM004', 'Sữa đặc', 'Các loại sữa đặc có đường và không đường', NOW(), NOW()),
('DM005', 'Sữa hạt', 'Các loại sữa từ hạt như hạnh nhân, óc chó, đậu nành', NOW(), NOW());

-- Chèn dữ liệu cho bảng ThuongHieu
INSERT INTO ThuongHieu (MaTH, TenTH, MoTa, NgayTao, NgayCapNhat)
VALUES
('VNM', 'Vinamilk', 'Công ty Cổ phần Sữa Việt Nam', NOW(), NOW()),
('THTM', 'TH True Milk', 'Công ty Cổ phần Sữa TH', NOW(), NOW()),
('DL', 'Dutch Lady', 'Công ty TNHH FrieslandCampina Việt Nam', NOW(), NOW()),
('NEST', 'Nestle', 'Tập đoàn Nestle Thụy Sĩ', NOW(), NOW()),
('ABT', 'Abbott', 'Tập đoàn Abbott Hoa Kỳ', NOW(), NOW());

-- Chèn dữ liệu cho bảng SanPham
INSERT INTO SanPham (MaSP, MaDM, TenSP, MoTa, Gia, GiaKhuyenMai, HinhAnh, SoLuong, TrangThai, NgayTao, NgayCapNhat)
VALUES
('SP001', 'DM001', 'Sữa tươi Vinamilk', 'Sữa tươi Vinamilk 200ml', 10000, 9000, null, 100, 'con_hang', NOW(), NOW()),
('SP002', 'DM001', 'Sữa tươi Nestlé', 'Sữa tươi Nestlé 200ml', 12000, 11000, null, 50, 'con_hang', NOW(), NOW()),
('SP003', 'DM002', 'Sữa chua Vinamilk', 'Sữa chua Vinamilk 100ml', 15000, 14000, null, 20, 'con_hang', NOW(), NOW()),
('SP004', 'DM003', 'Sữa bột Ensure Gold', 'Sữa bột dinh dưỡng cho người lớn tuổi', 799000, 750000, null, 30, 'con_hang', NOW(), NOW()),
('SP005', 'DM004', 'Sữa đặc Ông Thọ', 'Sữa đặc có đường thương hiệu Ông Thọ', 22000, NULL, 'sua-dac-ong-tho.jpg', 200, 'con_hang', NOW(), NOW()),
('SP006', 'DM005', 'Sữa hạnh nhân Alpro', 'Sữa từ hạnh nhân tự nhiên, không lactose', 85000, 79000, 'alpro-hanh-nhan.jpg', 50, 'con_hang', NOW(), NOW());

