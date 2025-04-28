-- CSDL Milky World - MySQL 8.2 PHPMyAdmin
CREATE DATABASE IF NOT EXISTS db_milky CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_milky;

-- Bảng Khách Hàng
CREATE TABLE IF NOT EXISTS KhachHang (
    MaKH int(11) NOT NULL AUTO_INCREMENT,
    TenKH varchar(255) NOT NULL,
    Email varchar(255) NOT NULL,
    MatKhau varchar(255) NOT NULL,
    DiaChi varchar(255) NOT NULL,
    SoDienThoai varchar(20) NOT NULL,
    VaiTro enum('admin', 'user') NOT NULL DEFAULT 'user',
    Avatar varchar(255),
    NgayTao datetime DEFAULT CURRENT_TIMESTAMP,
    NgayCapNhat datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (MaKH),
    UNIQUE KEY unique_email (Email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng Danh Mục
CREATE TABLE IF NOT EXISTS DanhMuc (
    MaDM int(11) NOT NULL AUTO_INCREMENT,
    TenDM varchar(255) NOT NULL,
    MoTa text,
    NgayTao datetime DEFAULT CURRENT_TIMESTAMP,
    NgayCapNhat datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (MaDM)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng Sản Phẩm
CREATE TABLE IF NOT EXISTS SanPham (
    MaSP int(11) NOT NULL AUTO_INCREMENT,
    MaDM int(11) NOT NULL,
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
    MaDH int(11) NOT NULL AUTO_INCREMENT,
    MaKH int(11) NOT NULL,
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
    MaCTDH int(11) NOT NULL AUTO_INCREMENT,
    MaDH int(11) NOT NULL,
    MaSP int(11) NOT NULL,
    SoLuong int(11) NOT NULL,
    Gia decimal(10,2) NOT NULL,
    NgayTao datetime DEFAULT CURRENT_TIMESTAMP,
    NgayCapNhat datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (MaCTDH),
    FOREIGN KEY (MaDH) REFERENCES HoaDon(MaDH) ON DELETE CASCADE,
    FOREIGN KEY (MaSP) REFERENCES SanPham(MaSP) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng Thương Hiệu Sản Phẩm
CREATE TABLE IF NOT EXISTS ThuongHieu (
    MaTH int(11) NOT NULL AUTO_INCREMENT,
    TenTH varchar(255) NOT NULL,
    HinhAnh varchar(255),
    MoTa text,
    NgayTao datetime DEFAULT CURRENT_TIMESTAMP,
    NgayCapNhat datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (MaTH)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Chèn dữ liệu mẫu cho bảng KhachHang
INSERT INTO KhachHang (TenKH, Email, MatKhau, DiaChi, SoDienThoai, VaiTro, Avatar, NgayTao, NgayCapNhat)
VALUES ('Admin', 'admin@gmail.com', '$2y$10$k9NrYcqgDh3ZaqjVHo5b8eXuKfkz8G9/0HPJH9xnkmAMDdZx1vS7O', 'Hà Nội', '0123456789', 'admin', 'admin.jpg', NOW(), NOW());

