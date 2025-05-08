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
    MaKH varchar(5) NOT NULL,
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
    MaDM varchar(5) NOT NULL,
    TenDM varchar(255) NOT NULL,
    MoTa text,
    NgayTao datetime DEFAULT CURRENT_TIMESTAMP,
    NgayCapNhat datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (MaDM)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng Thương Hiệu Sản Phẩm
CREATE TABLE IF NOT EXISTS ThuongHieu (
    MaTH varchar(5) NOT NULL,
    TenTH varchar(255) NOT NULL,
    HinhAnh varchar(255),
    MoTa text,
    NgayTao datetime DEFAULT CURRENT_TIMESTAMP,
    NgayCapNhat datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (MaTH)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng Sản Phẩm
CREATE TABLE IF NOT EXISTS SanPham (
    MaSP varchar(5) NOT NULL,
    MaDM varchar(5) NOT NULL,
    MaTH varchar(5) NOT NULL,
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
    MaKH varchar(5) NOT NULL,
    TongTien decimal(10,2) NOT NULL,
    TongTienGoc decimal(10,2) NOT NULL,
    TrangThai enum('cho_duyet', 'dang_xu_ly', 'dang_giao', 'da_giao', 'da_huy') NOT NULL DEFAULT 'cho_duyet',
    TenNguoiNhan varchar(100) NOT NULL,
    DiaChi varchar(255) NOT NULL,
    SoDienThoai varchar(20) NOT NULL,
    NgayTao datetime DEFAULT CURRENT_TIMESTAMP,
    NgayCapNhat datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (MaHD),
    FOREIGN KEY (MaKH) REFERENCES KhachHang(MaKH) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng Chi Tiết Hóa Đơn
CREATE TABLE IF NOT EXISTS ChiTietHoaDon (
    MaHD varchar(10) NOT NULL,
    MaSP varchar(5) NOT NULL,
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
    MaKH varchar(5) NOT NULL,
    MaSP varchar(5) NOT NULL,
    SoLuong int(11) NOT NULL,
    NgayTao datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (MaKH, MaSP),
    FOREIGN KEY (MaKH) REFERENCES KhachHang(MaKH) ON DELETE CASCADE,
    FOREIGN KEY (MaSP) REFERENCES SanPham(MaSP) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- Chèn dữ liệu cho bảng KhachHang (Quản Trị: admin@gmail.com | Gunny123456@. Client: user@gmail.com | 123456)
INSERT IGNORE INTO KhachHang (MaKH, TenKH, Email, MatKhau, DiaChi, SoDienThoai, VaiTro, Avatar, TrangThai, NgayTao, NgayCapNhat)
VALUES
('KH001', 'Quản Trị Viên', 'admin@gmail.com', '$2y$10$XSMCmK.NSN/Cqv9kq/AuEuQRM594TodIdOuNbj1kuCQnZilkdZzUq', 'Hà Nội', '0123456789', 'admin', NULL, 1, NOW(), NOW());

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
('VNM072', 'SUATUOI', 'VNM', 'Sữa tươi Vinamilk', 'Sữa tươi Vinamilk 200ml', 10000, 200, 'ml', null, 100, 'con_hang', NOW(), NOW()),
('NST311', 'SUATUOI', 'NST', 'Sữa tươi Nestlé', 'Sữa tươi Nestlé 200ml', 12000, 200, 'ml', null, 50, 'con_hang', NOW(), NOW()),
('VNM871', 'SUACHUA', 'VNM', 'Sữa chua Vinamilk', 'Sữa chua Vinamilk 100ml', 15000, 100, 'ml', null, 20, 'con_hang', NOW(), NOW()),
('ABT523', 'SUABOT', 'ABT', 'Sữa bột Ensure Gold', 'Sữa bột dinh dưỡng cho người lớn tuổi', 799000, 400, 'g', null, 30, 'con_hang', NOW(), NOW()),
('VNM802', 'SUADAC', 'VNM', 'Sữa đặc Ông Thọ', 'Sữa đặc có đường thương hiệu Ông Thọ', 22000, 380, 'g', null, 200, 'con_hang', NOW(), NOW()),
('DL162', 'SUAHAT', 'DL', 'Sữa hạnh nhân Alpro', 'Sữa từ hạnh nhân tự nhiên, không lactose', 85000, 1000, 'ml', null, 50, 'con_hang', NOW(), NOW());

