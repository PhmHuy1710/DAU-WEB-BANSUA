-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 14, 2025 at 03:36 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_ban_sua`
--

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `ma_don_hang` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_sua` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_luong` int DEFAULT '1',
  `don_gia` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chi_tiet_don_hang`
--

INSERT INTO `chi_tiet_don_hang` (`ma_don_hang`, `ma_sua`, `so_luong`, `don_gia`) VALUES
('DH1192', 'THTM5157', 5, '395000.00'),
('DH1411', 'THTM2673', 4, '510000.00'),
('DH1453', 'VNM2274', 2, '368000.00'),
('DH1620', 'NEST4450', 4, '706000.00'),
('DH1828', 'VNM8821', 2, '378000.00'),
('DH1880', 'NEST1489', 1, '1080000.00'),
('DH1880', 'NEST3559', 1, '368000.00'),
('DH1880', 'NEST4450', 1, '706000.00'),
('DH1880', 'NTF5752', 1, '850000.00'),
('DH1880', 'NTF7334', 1, '1560000.00'),
('DH1880', 'NTF7948', 1, '438000.00'),
('DH1880', 'NUTI8132', 1, '528000.00'),
('DH1880', 'THTM3793', 1, '490000.00'),
('DH1880', 'THTM4457', 3, '358000.00'),
('DH1880', 'VNM8237', 1, '706000.00'),
('DH1907', 'NEST1489', 1, '1080000.00'),
('DH1907', 'NTF5752', 3, '850000.00'),
('DH1907', 'NTF7334', 1, '1560000.00'),
('DH1907', 'NTF7948', 2, '438000.00'),
('DH1907', 'VNM8821', 10, '378000.00'),
('DH2529', 'NTF5752', 1, '850000.00'),
('DH3326', 'NEST4450', 2, '706000.00'),
('DH3345', 'THTM2673', 2, '510000.00'),
('DH3553', 'NEST4450', 2, '706000.00'),
('DH3727', 'NEST4450', 1, '706000.00'),
('DH3996', 'NEST4450', 1, '706000.00'),
('DH4189', 'THTM2673', 1, '510000.00'),
('DH4598', 'NEST4450', 3, '706000.00'),
('DH4700', 'NEST4450', 3, '706000.00'),
('DH4725', 'NTF5752', 3, '850000.00'),
('DH5568', 'NEST4450', 3, '706000.00'),
('DH5929', 'THTM2673', 8, '510000.00'),
('DH5938', 'VNM8821', 1, '378000.00'),
('DH5979', 'NEST4450', 5, '706000.00'),
('DH6291', 'THTM2673', 30, '510000.00'),
('DH6713', 'NEST4450', 1, '706000.00'),
('DH6925', 'NTF5752', 11, '850000.00'),
('DH7460', 'NTF5752', 45, '850000.00'),
('DH7623', 'NEST4450', 1, '706000.00'),
('DH7962', 'NEST4450', 3, '706000.00'),
('DH8030', 'THTM4457', 1, '358000.00'),
('DH8223', 'NEST4450', 1, '706000.00'),
('DH8223', 'NTF5752', 1, '850000.00'),
('DH8446', 'NEST4450', 1, '706000.00'),
('DH8700', 'THTM2673', 5, '510000.00'),
('DH8944', 'NTF7948', 7, '438000.00'),
('DH9020', 'NEST4450', 1, '706000.00'),
('DH9034', 'NEST4450', 1, '706000.00'),
('DH9418', 'THTM5157', 45, '395000.00'),
('DH9600', 'THTM3793', 3, '490000.00'),
('DH9812', 'NUTI8132', 1, '528000.00');

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_khuyen_mai`
--

CREATE TABLE `chi_tiet_khuyen_mai` (
  `ma_khuyen_mai` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_sua` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chi_tiet_khuyen_mai`
--

INSERT INTO `chi_tiet_khuyen_mai` (`ma_khuyen_mai`, `ma_sua`) VALUES
('GTHV', 'NEST1489'),
('Test', 'NEST1489'),
('THONGNHATDATNUOC', 'NEST1489'),
('GTHV', 'NEST3559'),
('Test', 'NEST3559'),
('THONGNHATDATNUOC', 'NEST3559'),
('GTHV', 'NEST4450'),
('Test', 'NEST4450'),
('THONGNHATDATNUOC', 'NEST4450'),
('GTHV', 'NEST7862'),
('Test', 'NEST7862'),
('THONGNHATDATNUOC', 'NEST7862'),
('GTHV', 'NEST9952'),
('Test', 'NEST9952'),
('THONGNHATDATNUOC', 'NEST9952'),
('GTHV', 'NTF5752'),
('Test', 'NTF5752'),
('THONGNHATDATNUOC', 'NTF5752'),
('GTHV', 'NTF7334'),
('Test', 'NTF7334'),
('THONGNHATDATNUOC', 'NTF7334'),
('GTHV', 'NTF7948'),
('Test', 'NTF7948'),
('THONGNHATDATNUOC', 'NTF7948'),
('GTHV', 'NUTI8132'),
('Test', 'NUTI8132'),
('THONGNHATDATNUOC', 'NUTI8132'),
('BLACKFRIDAY2025', 'THTM2673'),
('GTHV', 'THTM2673'),
('MONDAY', 'THTM2673'),
('Test', 'THTM2673'),
('THONGNHATDATNUOC', 'THTM2673'),
('BLACKFRIDAY2025', 'THTM3793'),
('GTHV', 'THTM3793'),
('MONDAY', 'THTM3793'),
('Test', 'THTM3793'),
('THONGNHATDATNUOC', 'THTM3793'),
('GTHV', 'THTM4457'),
('Test', 'THTM4457'),
('THONGNHATDATNUOC', 'THTM4457'),
('BLACKFRIDAY2025', 'THTM4789'),
('GTHV', 'THTM4789'),
('MONDAY', 'THTM4789'),
('Test', 'THTM4789'),
('THONGNHATDATNUOC', 'THTM4789'),
('BLACKFRIDAY2025', 'THTM5157'),
('GTHV', 'THTM5157'),
('MONDAY', 'THTM5157'),
('Test', 'THTM5157'),
('THONGNHATDATNUOC', 'THTM5157'),
('GTHV', 'THTM5241'),
('Test', 'THTM5241'),
('THONGNHATDATNUOC', 'THTM5241'),
('GTHV', 'THTM6903'),
('Test', 'THTM6903'),
('THONGNHATDATNUOC', 'THTM6903'),
('GTHV', 'THTM7395'),
('Test', 'THTM7395'),
('THONGNHATDATNUOC', 'THTM7395'),
('GTHV', 'THTM8457'),
('Test', 'THTM8457'),
('THONGNHATDATNUOC', 'THTM8457'),
('GTHV', 'VNM1683'),
('Test', 'VNM1683'),
('THONGNHATDATNUOC', 'VNM1683'),
('GTHV', 'VNM2274'),
('Test', 'VNM2274'),
('THONGNHATDATNUOC', 'VNM2274'),
('GTHV', 'VNM3260'),
('Test', 'VNM3260'),
('THONGNHATDATNUOC', 'VNM3260'),
('GTHV', 'VNM5788'),
('Test', 'VNM5788'),
('THONGNHATDATNUOC', 'VNM5788'),
('GTHV', 'VNM8237'),
('Test', 'VNM8237'),
('THONGNHATDATNUOC', 'VNM8237'),
('GTHV', 'VNM8821'),
('Test', 'VNM8821'),
('THONGNHATDATNUOC', 'VNM8821'),
('GTHV', 'VNM9748'),
('Test', 'VNM9748'),
('THONGNHATDATNUOC', 'VNM9748');

-- --------------------------------------------------------

--
-- Table structure for table `danh_gia`
--

CREATE TABLE `danh_gia` (
  `ma_danh_gia` int NOT NULL,
  `ma_sua` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ma_khach_hang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diem_danh_gia` int DEFAULT NULL,
  `noi_dung` text COLLATE utf8mb4_unicode_ci,
  `thoi_gian` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `danh_gia`
--

INSERT INTO `danh_gia` (`ma_danh_gia`, `ma_sua`, `ma_khach_hang`, `diem_danh_gia`, `noi_dung`, `thoi_gian`) VALUES
(3, 'NEST4450', 'KH0007', 1, 'Tệ', '2025-04-08 16:03:00'),
(4, 'THTM3793', 'ADMIN01', 5, 'Tuyệt vời! ', '2025-04-09 01:47:15'),
(5, 'VNM5788', 'ADMIN01', 5, 'Tôi yêu sản phẩm này!', '2025-04-09 05:50:34'),
(6, 'VNM8821', 'ADMIN01', 5, 'Tuyệt vời! ', '2025-04-10 04:47:34'),
(12, 'THTM4457', 'KH0006', 3, 'Khá hài lòng. ', '2025-04-09 15:49:44'),
(13, 'THTM2673', 'KH0006', 1, 'Không hài lòng. hết hàng quá nhanh', '2025-04-09 15:49:59'),
(15, 'VNM2274', 'ADMIN01', 2, 'Không hài lòng lắm. ', '2025-04-09 16:15:13'),
(16, 'VNM1683', 'ADMIN01', 5, 'Tuyệt vời! ', '2025-04-09 16:15:20'),
(17, 'VNM8237', 'ADMIN01', 5, 'Tuyệt vời! ', '2025-04-12 05:13:14'),
(18, 'VNM9748', 'ADMIN01', 5, 'Tuyệt vời! ', '2025-04-09 16:15:40'),
(19, 'VNM3260', 'ADMIN01', 5, 'Tuyệt vời! ', '2025-04-09 16:15:57'),
(20, 'THTM4457', 'KH0007', 5, 'Tuyệt vời! ', '2025-04-09 16:44:49'),
(21, 'NTF5752', 'KH0007', 5, 'Tuyệt vời! ', '2025-04-10 04:19:57'),
(22, 'NUTI8132', 'KH0007', 5, 'Tuyệt vời! ', '2025-04-10 04:20:05'),
(23, 'NTF7948', 'KH0007', 4, 'Rất hài lòng. ', '2025-04-10 04:20:14'),
(25, 'lOF9311', 'ADMIN01', 5, 'Tuyệt vời! ', '2025-04-10 05:22:51'),
(27, 'DL9148', 'ADMIN01', 5, 'Tuyệt vời! ', '2025-04-10 08:56:17'),
(29, 'NUTI8132', 'ADMIN01', 3, 'Khá hài lòng. ', '2025-04-11 10:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `don_hang`
--

CREATE TABLE `don_hang` (
  `ma_don_hang` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_khach_hang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngay_dat` datetime DEFAULT CURRENT_TIMESTAMP,
  `tong_tien` decimal(8,0) DEFAULT '0',
  `tong_tien_goc` decimal(8,0) DEFAULT '0',
  `ma_khuyen_mai` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phan_tram_giam` int DEFAULT '0',
  `trang_thai` enum('pending','confirmed','shipping','completed','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `ghi_chu` text COLLATE utf8mb4_unicode_ci,
  `phuong_thuc_thanh_toan` enum('cod','banking') COLLATE utf8mb4_unicode_ci DEFAULT 'cod',
  `ten_nguoi_nhan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dien_thoai_nguoi_nhan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_nguoi_nhan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dia_chi_nguoi_nhan` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `don_hang`
--

INSERT INTO `don_hang` (`ma_don_hang`, `ma_khach_hang`, `ngay_dat`, `tong_tien`, `tong_tien_goc`, `ma_khuyen_mai`, `phan_tram_giam`, `trang_thai`, `ghi_chu`, `phuong_thuc_thanh_toan`, `ten_nguoi_nhan`, `dien_thoai_nguoi_nhan`, `email_nguoi_nhan`, `dia_chi_nguoi_nhan`) VALUES
('DH1192', 'KH0002', '2025-04-07 15:55:43', '1975000', '1975000', NULL, 0, 'pending', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH1411', 'ADMIN01', '2025-04-07 15:48:17', '2040000', '2040000', NULL, 0, 'completed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH1453', 'ADMIN01', '2025-04-08 19:37:44', '736000', '736000', NULL, 0, 'pending', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH1620', 'ADMIN01', '2025-04-10 15:57:14', '0', '2824000', 'Test', 100, 'pending', '', 'cod', 'Administrator', '387368890', 'admin@load99', '123'),
('DH1828', 'ADMIN01', '2025-04-09 07:07:34', '756000', '756000', NULL, 0, 'completed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH1880', 'ADMIN01', '2025-04-08 17:12:17', '0', '7800000', 'Test', 100, 'pending', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH1907', 'ADMIN01', '2025-04-09 13:50:08', '4923000', '9846000', 'GTHV', 50, 'completed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH2276', 'ADMIN01', '2025-04-10 12:33:07', '1708100', '1708100', NULL, 0, 'completed', '', 'cod', 'Administrator', '387368890', 'admin@load99', '123'),
('DH2529', 'ADMIN01', '2025-04-09 14:30:15', '850000', '850000', NULL, 0, 'pending', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH3326', 'ADMIN01', '2025-04-10 11:44:45', '0', '1412000', 'Test', 100, 'completed', '', 'cod', 'Administrator', '387368890', 'admin@load99', '123'),
('DH3345', 'ADMIN01', '2025-04-07 13:38:24', '510000', '1020000', 'GTHV', 50, 'completed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH3553', 'ADMIN01', '2025-04-08 19:47:36', '0', '1412000', 'Test', 100, 'completed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH3727', 'ADMIN01', '2025-04-09 11:58:26', '706000', '706000', NULL, 0, 'completed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH3996', 'ADMIN01', '2025-04-08 19:47:10', '706000', '706000', NULL, 0, 'completed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH4189', 'ADMIN01', '2025-04-07 15:55:17', '510000', '510000', NULL, 0, 'pending', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH4598', 'ADMIN01', '2025-04-09 06:45:06', '0', '2118000', 'Test', 100, 'pending', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH4700', 'ADMIN01', '2025-04-09 12:48:00', '0', '2118000', 'Test', 100, 'completed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH4725', 'ADMIN01', '2025-04-12 05:15:07', '2550000', '2550000', NULL, 0, 'shipping', '', 'cod', 'Administrator', '387368890', 'admin@load99', '123'),
('DH5568', 'ADMIN01', '2025-04-09 20:57:10', '0', '2118000', 'Test', 100, 'confirmed', '', 'cod', 'Administrator', '387368890', 'admin@load99', '123'),
('DH5929', 'ADMIN01', '2025-04-07 13:31:39', '4080000', '4080000', NULL, 0, 'completed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH5938', 'ADMIN01', '2025-04-09 09:09:04', '378000', '378000', NULL, 0, 'completed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH5979', 'ADMIN01', '2025-04-11 21:58:44', '0', '3530000', 'Test', 100, 'completed', '', 'cod', 'Administrator', '387368890', 'admin@load99', '123'),
('DH6291', 'ADMIN01', '2025-04-08 10:42:12', '15300000', '15300000', NULL, 0, 'pending', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH6713', 'ADMIN01', '2025-04-08 19:04:02', '0', '706000', 'Test', 100, 'completed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH6925', 'ADMIN01', '2025-04-08 23:39:47', '9350000', '9350000', NULL, 0, 'completed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH7460', 'ADMIN01', '2025-04-08 23:33:12', '38250000', '38250000', NULL, 0, 'completed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH7623', 'ADMIN01', '2025-04-10 16:06:04', '706000', '706000', NULL, 0, 'cancelled', '', 'cod', 'Administrator', '387368890', 'admin@load99', '123'),
('DH7962', 'ADMIN01', '2025-04-14 21:28:12', '1419060', '2118000', 'HM5XZ6KZ', 33, 'pending', '', 'cod', 'Administrator', '387368890', 'admin@load99', '12345'),
('DH8030', 'ADMIN01', '2025-04-09 10:48:51', '358000', '358000', NULL, 0, 'completed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH8223', 'ADMIN01', '2025-04-09 21:19:37', '778000', '1556000', 'GTHV', 50, 'pending', 'test ghi chúuu', 'cod', 'Administrator', '387368890', 'admin@load99', '123 lê văn hiến'),
('DH8446', 'ADMIN01', '2025-04-09 13:28:27', '706000', '706000', NULL, 0, 'completed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH8700', 'ADMIN01', '2025-04-07 15:58:05', '2550000', '2550000', NULL, 0, 'pending', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH8919', 'ADMIN01', '2025-04-07 13:27:57', '4940000', '4940000', NULL, 0, 'completed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH8944', 'ADMIN01', '2025-04-09 14:33:01', '3066000', '3066000', NULL, 0, 'completed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH9020', 'ADMIN01', '2025-04-14 21:30:54', '706000', '706000', NULL, 0, 'completed', 'Hàng dễ vỡ', 'cod', 'Phan Thi Van', '387368890', 'admin@load99', 'k596 xyz'),
('DH9034', 'KH0006', '2025-04-09 06:16:53', '706000', '706000', NULL, 0, 'confirmed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH9418', 'KH0002', '2025-04-08 12:02:54', '17775000', '17775000', NULL, 0, 'completed', NULL, 'cod', NULL, NULL, NULL, NULL),
('DH9600', 'ADMIN01', '2025-04-11 21:54:33', '1470000', '1470000', NULL, 0, 'completed', '', 'cod', 'Administrator', '387368890', 'admin@load99', '123'),
('DH9812', 'ADMIN01', '2025-04-09 14:28:04', '528000', '528000', NULL, 0, 'pending', NULL, 'cod', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gio_hang`
--

CREATE TABLE `gio_hang` (
  `ma_khach_hang` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_sua` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_luong` int DEFAULT '1',
  `ngay_them` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hang_sua`
--

CREATE TABLE `hang_sua` (
  `ma_hang_sua` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten_hang_sua` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dia_chi` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dien_thoai` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hinh_anh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hang_sua`
--

INSERT INTO `hang_sua` (`ma_hang_sua`, `ten_hang_sua`, `dia_chi`, `dien_thoai`, `email`, `hinh_anh`) VALUES
('DL', 'Dutch Lady', 'Hà Nội', '024.555.7777', 'info@dutchlady.com.vn', 'assets/images/brands/DL.png'),
('DS', 'DiaSure', '', '', '', 'assets/images/brands/DS.jpg'),
('HAKO', 'HakoLait', '', '', '', 'assets/images/brands/HAKO.png'),
('lOF', 'Love in Farm', '', '', '', 'assets/images/brands/lOF.png'),
('NEST', 'Nestlé', '', '', '', 'assets/images/brands/NEST.png'),
('NTF', 'NutiFood', '', '', '', 'assets/images/brands/NTF.webp'),
('THTM', 'TH True Milk', 'Nghệ An', '024.987.6543', 'contact@thmilk.vn', 'assets/images/brands/THTM.jpg'),
('VNM', 'Vinamilk', 'Hồ Chí Minh', '028.123.4567', 'contact@vinamilk.com.vn', 'assets/images/brands/VNM.png');

-- --------------------------------------------------------

--
-- Table structure for table `khach_hang`
--

CREATE TABLE `khach_hang` (
  `ma_khach_hang` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten_khach_hang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gioi_tinh` enum('Nam','Nữ') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dia_chi` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dien_thoai` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `anh_dai_dien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `diem_tich_luy` int DEFAULT '0',
  `ngay_dang_ky` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `khach_hang`
--

INSERT INTO `khach_hang` (`ma_khach_hang`, `ten_khach_hang`, `gioi_tinh`, `dia_chi`, `dien_thoai`, `email`, `password`, `role`, `anh_dai_dien`, `ngay_sinh`, `diem_tich_luy`, `ngay_dang_ky`) VALUES
('ADMIN01', 'Administrator', 'Nam', '12345', '0387368890', 'admin@load99', '$2y$10$FNwG2W0TCYoxX7g/zr323uYt.H86xVLFh.XBZP32cpc8dDFgSm1Ra', 'admin', 'ADMIN01.jpg', NULL, 0, '2025-04-07 05:47:11'),
('KH0002', 'Nguyễn Ngọc Tân ', 'Nam', '43', '0946255027', 'tanngao333@gmail.com', '$2y$10$GMzhBbTVpVia57IHVo1eeOTx8oo.Ya18BHC2TKEYCwrbA9eG3CXoO', 'admin', NULL, NULL, 0, '2025-04-06 01:16:25'),
('KH0003', 'lê văn trung', 'Nam', '559 núi thành', '0862177135', 'trung01694011@gmail.com', '$2y$10$oaKiUTjkzZ1Q9zfgLZZcvuT1fq26RbQ345HZEWSae7XUvWI7/YSlO', 'user', NULL, NULL, 0, '2025-04-06 01:49:23'),
('KH0005', 'Nguyễn Quốc Khánh', 'Nam', 'Abc', '0945736481', 'dangkhanhxsmile123@gmail.com', '$2y$10$g.1GKD5QlAw9STbXuIcTJ.G5bGsD1W/lquRRrB9aiX5GKsNfl.jnW', 'user', NULL, NULL, 0, '2025-04-06 04:51:48'),
('KH0006', 'pham huy', 'Nam', 'adssa', '0123456', 'huytqd@gmail.com', '$2y$10$xF5H0IDUOunnekxMkkC3E.MvLnBFHvux5HaHqwKhHWXBsIRR4UHW6', 'user', NULL, NULL, 0, '2025-04-07 08:20:10'),
('KH0007', 'nva', 'Nam', 'Đăng nhập', '0387368890', 'nva@gmail.com', '$2y$10$87CaMo8SUGoCB/qhYXD1YuH.ntDR8irrdDCykRAOpo8lg6P6SFUte', 'user', NULL, NULL, 0, '2025-04-08 16:02:39'),
('KH0008', 'Nguyễn Văn A', 'Nam', 'K596/28A Lê Văn Hiến, Đà Nẵng', '0387368890', 'nva1@gmail.com', '$argon2id$v=19$m=1024,t=2,p=2$VzM2ZmdiWFB1YVBMdmpPZA$n7TNC4mHV3IzW4Sve+KXtd/krKZoA7I1dEuaq8pUqco', 'user', NULL, NULL, 0, '2025-04-09 04:30:19'),
('KH0009', 'tesdasdsadsadsada', 'Nam', 'testsdasdasdasd asdasodjaksodas adasdasda', '0387368890', 'testtt@gmail.com', '$argon2id$v=19$m=1024,t=2,p=2$eENMQ2RLTnFKMkpNQUR4Yg$tAnmvDAERCKD5UJBcKk/H7s1UCVTRDtQASCjCU4Q6lM', 'user', NULL, NULL, 0, '2025-04-10 04:40:17'),
('KH0010', '1313123313111', 'Nam', '1313123@gmail.com1313123@gmail.com', '1234567891', '1313123@gmail.com', '$argon2id$v=19$m=1024,t=2,p=2$ZEdUSjJnWHpFc3RNYjEuVA$KARE3xpUKVbjorXiSTnziyt6p9SVj/bbs2Mb2sPy8EM', 'user', NULL, NULL, 0, '2025-04-12 05:33:20');

-- --------------------------------------------------------

--
-- Table structure for table `khuyen_mai`
--

CREATE TABLE `khuyen_mai` (
  `ma_khuyen_mai` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten_khuyen_mai` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8mb4_unicode_ci,
  `phan_tram_giam` int DEFAULT NULL,
  `gioi_han_su_dung` int DEFAULT '50',
  `gioi_han_moi_nguoi` int DEFAULT '1',
  `ngay_bat_dau` date DEFAULT NULL,
  `ngay_ket_thuc` date DEFAULT NULL,
  `trang_thai` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `dieu_kien_ap_dung` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ;

--
-- Dumping data for table `khuyen_mai`
--

INSERT INTO `khuyen_mai` (`ma_khuyen_mai`, `ten_khuyen_mai`, `mo_ta`, `phan_tram_giam`, `gioi_han_su_dung`, `gioi_han_moi_nguoi`, `ngay_bat_dau`, `ngay_ket_thuc`, `trang_thai`, `dieu_kien_ap_dung`) VALUES
('BLACKFRIDAY2025', '🎉 Black Friday 2025: 7 ngày rực rỡ, giảm giá hết cỡ!', '', 60, 100, 1, '2025-04-11', '2025-04-18', 'active', NULL),
('GTHV', 'Kỉ niệm ngày Giổ Tổ Hùng Vương 2025 📣', '', 50, 50, 50, '2025-04-07', '2025-04-10', 'active', NULL),
('HM5XZ6KZ', 'Téttttttt', '', 33, 100, 10, '2025-04-12', '2025-05-12', 'active', '0'),
('MONDAY', 'Đầu Tuần Thật Là Tuyệt Vờiii', '', 30, 10, 1, '2025-03-31', '2025-04-01', 'active', NULL),
('Test', 'Testt', '', 100, 50, 50, '2025-04-06', '2025-04-30', 'active', NULL),
('THONGNHATDATNUOC', 'Mừng đại lễ – Quà nhiều vô kể', 'Hòa mình vào không khí của ngày Đại lễ kỷ niệm 45 năm ngày Thống nhất đất nước 30/04/1975 – 30/04/2020, AZDIGI xin trân trọng thông báo đến quý khách chương trình ưu đãi siêu khủng ngập tràn quà tặng mang tên Mừng đại lễ – Quà nhiều vô kể.', 65, 50, 1, '2025-04-20', '2025-05-03', 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lich_su_gia`
--

CREATE TABLE `lich_su_gia` (
  `ma_sua` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` decimal(10,2) DEFAULT NULL,
  `ngay_cap_nhat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lich_su_gia`
--

INSERT INTO `lich_su_gia` (`ma_sua`, `gia`, `ngay_cap_nhat`) VALUES
('lOF8506', '5700.00', '2025-04-10 07:21:07'),
('NTF7948', '438000.00', '2025-04-08 09:59:11'),
('THTM6903', '450000.00', '2025-04-07 09:12:19');

-- --------------------------------------------------------

--
-- Table structure for table `loai_sua`
--

CREATE TABLE `loai_sua` (
  `ma_loai_sua` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten_loai` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loai_sua`
--

INSERT INTO `loai_sua` (`ma_loai_sua`, `ten_loai`, `mo_ta`) VALUES
('SUABOT', 'Sữa Bột', ''),
('SUACHUA', 'Sữa Chua', ''),
('SUATUOI', 'Sữa Tươi', '');

-- --------------------------------------------------------

--
-- Table structure for table `sua`
--

CREATE TABLE `sua` (
  `ma_sua` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten_sua` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_hang_sua` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loai_sua` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trong_luong` int DEFAULT NULL,
  `don_vi` enum('g','ml') COLLATE utf8mb4_unicode_ci DEFAULT 'g',
  `don_gia` decimal(10,2) DEFAULT NULL,
  `hinh_anh` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hinh_anh_optimized` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mo_ta` text COLLATE utf8mb4_unicode_ci,
  `mo_ta_chi_tiet` text COLLATE utf8mb4_unicode_ci,
  `so_luong_ton` int DEFAULT '0',
  `luot_xem` int DEFAULT '0',
  `luot_mua` int DEFAULT '0',
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ma_loai_sua` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sua`
--

INSERT INTO `sua` (`ma_sua`, `ten_sua`, `ma_hang_sua`, `loai_sua`, `trong_luong`, `don_vi`, `don_gia`, `hinh_anh`, `hinh_anh_optimized`, `mo_ta`, `mo_ta_chi_tiet`, `so_luong_ton`, `luot_xem`, `luot_mua`, `ngay_tao`, `ma_loai_sua`) VALUES
('DL1370', 'Sữa tiệt trùng hương dâu Dutch Lady bịch 180ml', 'DL', 'Sữa tươi', 180, 'ml', '7400.00', 'assets/images/products/DL1370.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\DL1370_medium.webp', '**Sữa tiệt trùng hương dâu Dutch Lady bịch 180ml** bổ dung đầy đủ dinh đưỡng cho bữa sáng. Sữa tươi ***Dutch Lady*** là nhãn hiệu sữa tươi chất lượng, không chứa chất bảo quản, với nhiều hương vị thơm ngon, hấp dẫn.\r\n\r\n| **Thông tin**      | **Chi tiết**                                                                                               |\r\n|--------------------|------------------------------------------------------------------------------|\r\n| Loại sữa               | Sữa tiệt trùng hương dâu                                                                    |\r\n| Dung tích            | 180ml/bịch                                                                                           |\r\n| Phù hợp với        | Trẻ từ 1 tuổi trở lên                                                                                  |\r\n| Thành phần        | Sữa (nước, sữa tươi, bột sữa gầy chất béo sữa), đường, dầu thực vật,.. |\r\n| Bảo quản           | Bảo quản nơi khô ráo, thoáng mát. Ngon hơn khi uống lạnh, nên lắc đều trước khi uống.           |\r\n| Lưu ý                  | Không dùng cho trẻ dưới 1 tuổi. Sản phẩm cho 1 lần sử dụng                  |\r\n| Thương hiệu       | **Dutch Lady (Hà Lan)**                                                                                    |\r\n| Sản xuất tại         | **Việt Nam**                                                                                                     |\r\n', NULL, 200, 0, 0, '2025-04-10 07:46:34', NULL),
('DL6601', 'Thùng 48 bịch sữa tiệt trùng hương dâu Dutch Lady 180ml', 'DL', 'Sữa tươi', 180, 'ml', '335000.00', 'assets/images/products/DL6601.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\DL6601_medium.webp', '***Thùng 48 bịch sữa tiệt trùng Dutch Lady hương dâu 180ml*** dạng bịch tiện lợi, bổ sung chất đạm, canxi, Vitamin B2, kali. Sữa tươi ***Dutch Lady*** là nhãn hiệu sữa tươi được rất nhiều trẻ em lẫn người lớn ưa chuộng, bổ dung đầy đủ dinh đưỡng cho hoạt động ngày dài.\r\n\r\n| **Thông tin**      | **Chi tiết**                                                                                               |\r\n|--------------------|------------------------------------------------------------------------------|\r\n| Loại sữa               | Sữa tươi tiệt trùng ít đường                                                                     |\r\n| Dung tích            | 180ml/hộp                                                                                               |\r\n| Phù hợp với        | Trẻ từ 1 tuổi trở lên                                                                                  |\r\n| Thành phần        | Sữa tươi, nước, bột sữa, đường,...                                                               |\r\n| Bảo quản           | Bảo quản nơi khô ráo, thoáng mát, tránh ánh nắng chiếu trực tiếp.           |\r\n| Lưu ý                  | Không dùng cho trẻ dưới 1 tuổi. Sản phẩm cho 1 lần sử dụng                  |\r\n| Thương hiệu       | Dutch Lady (Hà Lan)                                                                                    |\r\n| Sản xuất tại         | Việt Nam                                                                                                      |\r\n', NULL, 200, 0, 0, '2025-04-10 07:50:15', 'SUATUOI'),
('DL9148', 'Lốc 4 hộp sữa tươi tiệt trùng ít đường Dutch Lady 180ml', 'DL', 'Sữa tươi', 180, 'ml', '34500.00', 'assets/images/products/DL9148.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\DL9148_medium.webp', '**Lốc 4 hộp sữa tươi tiệt trùng ít đường Dutch Lady 180ml** được giảm 45% lượng đường, với hương vị thơm ngon, dễ uống. Sữa tươi ***Dutch Lady*** hay còn gọi là sữa tươi cô gái Hà Lan được làm từ nguồn nguyên liệu chọn lọc nghiêm ngặt, trải qua quy trình sản xuất và kiểm soát chất lượng theo tiêu chuẩn được quốc tế công nhận, với hơn 145 kinh nghiệm.\r\n\r\n| **Thông tin**      | **Chi tiết**                                                                                               |\r\n|--------------------|------------------------------------------------------------------------------|\r\n| Loại sữa               | Sữa tươi tiệt trùng ít đường                                                                     |\r\n| Dung tích            | 180ml/hộp                                                                                               |\r\n| Phù hợp với        | Trẻ từ 1 tuổi trở lên                                                                                  |\r\n| Thành phần        | Sữa tươi, nước, bột sữa, đường,...                                                               |\r\n| Bảo quản           | Bảo quản nơi khô ráo, thoáng mát, tránh ánh nắng chiếu trực tiếp.           |\r\n| Lưu ý                  | Không dùng cho trẻ dưới 1 tuổi. Sản phẩm cho 1 lần sử dụng                  |\r\n| Thương hiệu       | Dutch Lady (Hà Lan)                                                                                    |\r\n| Sản xuất tại         | Việt Nam                                                                                                      |\r\n', NULL, 200, 0, 0, '2025-04-10 07:33:35', 'SUATUOI'),
('DL9739', 'Thùng 48 hộp sữa tươi tiệt trùng ít đường Dutch Lady 180ml', 'DL', 'Sữa tươi', 180, 'ml', '321000.00', 'assets/images/products/DL9739.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\DL9739_medium.webp', '**Thùng 48 hộp sữa tươi tiệt trùng ít đường Dutch Lady 180ml** được giảm 45% lượng đường, với hương vị thơm ngon, dễ uống. Sữa tươi ***Dutch Lady*** hay còn gọi là sữa tươi cô gái Hà Lan được làm từ nguồn nguyên liệu chọn lọc nghiêm ngặt, trải qua quy trình sản xuất và kiểm soát chất lượng theo tiêu chuẩn được quốc tế công nhận, với hơn 145 kinh nghiệm.\r\n\r\n| **Thông tin**      | **Chi tiết**                                                                                               |\r\n|--------------------|------------------------------------------------------------------------------|\r\n| Loại sữa               | Sữa tươi tiệt trùng ít đường                                                                     |\r\n| Dung tích            | 180ml/hộp                                                                                               |\r\n| Phù hợp với        | Trẻ từ 1 tuổi trở lên                                                                                  |\r\n| Thành phần        | Sữa tươi, nước, bột sữa, đường,...                                                               |\r\n| Bảo quản           | Bảo quản nơi khô ráo, thoáng mát, tránh ánh nắng chiếu trực tiếp.           |\r\n| Lưu ý                  | Không dùng cho trẻ dưới 1 tuổi. Sản phẩm cho 1 lần sử dụng                  |\r\n| Thương hiệu       | Dutch Lady (Hà Lan)                                                                                    |\r\n| Sản xuất tại         | Việt Nam                                                                                                      |\r\n', NULL, 200, 0, 0, '2025-04-10 07:37:20', NULL),
('lOF3583', 'Thùng 24 túi sữa chua uống tiệt trùng hương cam Lof Kun 110ml', 'lOF', 'Sữa chua', 110, 'ml', '126000.00', 'assets/images/products/lOF3583.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\lOF3583_medium.webp', '**Thùng 24 túi sữa chua uống tiệt trùng hương cam Lof Kun 110ml** được sản xuất bởi Công ty Cổ phần sữa Quốc tế (IDP) thuộc tập đoàn Pactum Dairy từ Úc. Lof Kun là một trong những thương hiệu nổi tiếng với các dòng sản phẩm được làm từ sữa dành cho trẻ em và thanh thiếu niên, với chất lượng cao cùng hương vị thơm ngon, dễ uống.\r\n\r\n**Thành phần dinh dưỡng:**\r\n* Sữa chua uống Lof Kun hương cam có chứa những thành phần dinh dưỡng gồm: Năng lượng, đạm, chất béo, vitamin B1, B2, B6, kẽm, lysin.\r\n* Ngoài ra, sản phẩm cung cấp khoảng 77 kcal trong 100ml sữa.\r\n\r\n**Tác dụng:**\r\n* Không những có hương vị thơm ngon, sữa chua uống tiệt trùng Lof Kun còn giúp bổ sung một lượng lớn các nhóm vitamin như vitamin A hỗ trợ sáng mắt, vitamin D3 giàu canxi.\r\n* Ngoài ra, Lof Kun còn bổ sung thêm vitamin B1, B3 và vitamin B6 giúp hỗ trợ tiêu hoá và bổ sung năng lượng cần thiết cho sinh hoạt hằng ngày.\r\n![](https://cdn.tgdd.vn/Products/Images/2944/216784/bhx/thung-24-tui-sua-chua-uong-huong-cam-lif-kun-110ml-202306291718397152.jpg)\r\n\r\n**Hướng dẫn sử dụng:**\r\n* Nên lắc đều bịch sữa trước khi uống. Sữa chua uống Lof Kun ngon hơn khi uống lạnh.\r\n* Khuyên dùng từ 2 - 3 bịch mỗi ngày.\r\n\r\n**Cách bảo quản và lưu ý:**\r\n* Bảo quản sữa nơi khô thoáng, tránh ánh nắng mặt trời chiếu trực tiếp.\r\n* Không sử dụng sữa chua uống Lif Kun cho trẻ dưới 2 tuổi.\r\n* Hiện tượng đổi màu và lắng đọng tự nhiên không hề làm ảnh hưởng đến chất lượng của sản phẩm.\r\n![](https://cdn.tgdd.vn/Products/Images/2944/216784/bhx/thung-24-tui-sua-chua-uong-huong-cam-lif-kun-110ml-202306291719089970.jpg)\r\n\r\n**Ưu điểm khi mua sản phẩm tại *Milky World***\r\nCác sản phẩm tại ***Milky World*** đang được bán với giá thành cực tốt, cùng nhiều ưu đãi mỗi ngày. Đảm bảo đúng nguồn gốc xuất xứ, an toàn về chất lượng, mua ngay để được hỗ trợ dịch vụ giao hàng nhanh tận nơi nhanh chóng.', NULL, 200, 0, 0, '2025-04-10 07:22:25', NULL),
('lOF6573', 'Thùng 48 chai sữa chua uống tiệt trùng hương cam Lof Kun 85ml', 'lOF', 'Sữa chua', 85, 'ml', '155000.00', 'assets/images/products/lOF6573.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\lOF6573_medium.webp', '**Thùng 48 chai sữa chua uống hương cam Lof Kun 85ml** giúp tiêu hóa, hấp thụ tốt, cho trẻ cảm giác ngon miệng, không ngán ăn. Sữa chua uống Lof Kun là sản phẩm sữa chua uống lên men tự nhiên, sử dụng công thức độc quyền kết hợp với **Viện Y học Ứng Dụng VIAM**.\r\n\r\n**Đôi nét về thương hiệu Lof Kun**\r\n**Lof Kun** là thương hiệu sữa tươi tiệt trùng 100% tự nhiên, thuộc sở hữu của Công ty cổ phần Sữa Quốc Tế (IDP), được thành lập vào năm 2004.\r\nCác sản phẩm sữa tươi Lof Kun giàu dinh dưỡng, được sản xuất từ nguồn sữa bò tươi chất lượng tại Úc, được rất nhiều trẻ em và người lớn ưa chuộng.\r\n![](https://cdn.tgdd.vn/Products/Images/2944/308115/bhx/loc-6-chai-sua-chua-uong-huong-cam-lif-kun-85ml-202307251436265228.jpg)\r\n**Thành phần dinh dưỡng**\r\nLốc 6 chai sữa chua uống tiệt trùng hương cam Lof Kun 85ml có chứa những thành phần dinh dưỡng như: Năng lượng, chất đạm, carbohydrate, chất béo, vitamin B1, B6, B2, kẽm, lysine,... Trung bình trong 100ml sữa chua uống tiệt trùng hương cam Lof Kun có khoảng 76.6 kcal.\r\n\r\n**Tác dụng với sức khỏe**\r\nLof Kun sử dụng nguồn sữa tươi tiệt trùng 100% tự nhiên, giàu dinh dưỡng, được sản xuất từ những cô bò tự do trên đồng cỏ thung lũng Goulburn và đóng gói nguyên hộp trong vòng 24 giờ tại Úc 1. Sữa chua uống tiệt trùng Lof Kun hương cam có mang lại nhiều công dụng tốt với sức khỏe:\r\n* Chứa kẽm giúp hỗ trợ tiêu hóa.\r\n* Lysine tăng cảm giác ngon miệng.\r\n* Ngoài ra , sữa chua uống Lof Kun còn chứa vitamin B1, B2, B6 giúp tăng cường chuyển hóa.\r\n\r\n**Hướng dẫn sử dụng**\r\nLắc đều trước khi sử dụng, sử dụng từ 2 - 3 chai mỗi ngày, sữa chua uống Lof Kun ngon hơn khi uống lạnh.\r\n\r\n**Cách bảo quản và lưu ý khi sử dụng**\r\n* Bảo quản nơi khô thoáng, tránh ánh nắng mặt trời chiếu trực tiếp.\r\n* Lưu ý, phù hợp cho trẻ em trên 3 tuổi.\r\n* Hiện tượng thay đổi màu sắc và lắng đọng tự nhiên không làm ảnh hưởng đến chất lượng sản phẩm.\r\n', NULL, 100, 0, 0, '2025-04-10 05:24:55', NULL),
('lOF8506', 'Sữa chua uống tiệt trùng hương cam Lof Kun túi 110ml', 'lOF', 'Sữa chua', 110, 'ml', '5700.00', 'assets/images/products/lOF8506.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\lOF8506_medium.webp', '**Sữa chua uống tiệt trùng Lof Kun hương cam 110ml** được sản xuất bởi Công ty Cổ phần sữa Quốc tế (IDP) thuộc tập đoàn Pactum Dairy từ Úc. Lof Kun là một trong những thương hiệu nổi tiếng với các dòng sản phẩm được làm từ sữa dành cho trẻ em và thanh thiếu niên, với chất lượng cao cùng hương vị thơm ngon, dễ uống.\r\n\r\n**Thành phần dinh dưỡng:**\r\n* Sữa chua uống Lof Kun hương cam có chứa những thành phần dinh dưỡng gồm: Năng lượng, đạm, chất béo, vitamin B1, B2, B6, kẽm, lysin.\r\n* Ngoài ra, sản phẩm cung cấp khoảng 77 kcal trong 100ml sữa.\r\n\r\n**Tác dụng:**\r\n* Không những có hương vị thơm ngon, sữa chua uống tiệt trùng Lof Kun còn giúp bổ sung một lượng lớn các nhóm vitamin như vitamin A hỗ trợ sáng mắt, vitamin D3 giàu canxi.\r\n* Ngoài ra, Lof Kun còn bổ sung thêm vitamin B1, B3 và vitamin B6 giúp hỗ trợ tiêu hoá và bổ sung năng lượng cần thiết cho sinh hoạt hằng ngày.\r\n![](https://cdn.tgdd.vn/Products/Images/2944/216762/bhx/sua-chua-uong-cam-lif-kun-tui-110ml-202306291716426809.jpg)\r\n\r\n**Hướng dẫn sử dụng:**\r\n* Nên lắc đều bịch sữa trước khi uống. Sữa chua uống Lof Kun ngon hơn khi uống lạnh.\r\n* Khuyên dùng từ 2 - 3 bịch mỗi ngày.\r\n\r\n**Cách bảo quản và lưu ý:**\r\n* Bảo quản sữa nơi khô thoáng, tránh ánh nắng mặt trời chiếu trực tiếp.\r\n* Không sử dụng sữa chua uống Lif Kun cho trẻ dưới 2 tuổi.\r\n* Hiện tượng đổi màu và lắng đọng tự nhiên không hề làm ảnh hưởng đến chất lượng của sản phẩm.\r\n![](https://cdn.tgdd.vn/Products/Images/2944/216784/bhx/thung-24-tui-sua-chua-uong-huong-cam-lif-kun-110ml-202306291719089970.jpg)\r\n\r\n**Ưu điểm khi mua sản phẩm tại *Milky World***\r\nCác sản phẩm tại ***Milky World*** đang được bán với giá thành cực tốt, cùng nhiều ưu đãi mỗi ngày. Đảm bảo đúng nguồn gốc xuất xứ, an toàn về chất lượng, mua ngay để được hỗ trợ dịch vụ giao hàng nhanh tận nơi nhanh chóng.', NULL, 200, 0, 0, '2025-04-10 07:18:37', NULL),
('lOF9311', 'Lốc 6 chai sữa chua uống tiệt trùng hương cam Lof Kun 85ml', 'lOF', 'Sữa chua', 85, 'ml', '27000.00', 'assets/images/products/lOF9311.webp', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\lOF9311_medium.webp', '**Lốc 6 chai sữa chua uống hương cam Lof Kun 85m**l giúp tiêu hóa, hấp thụ tốt, cho trẻ cảm giác ngon miệng, không ngán ăn. Sữa chua uống Lof Kun là sản phẩm sữa chua uống lên men tự nhiên, sử dụng công thức độc quyền kết hợp với **Viện Y học Ứng Dụng VIAM**.\r\n\r\n**Đôi nét về thương hiệu Lof Kun**\r\n**Lof Kun** là thương hiệu sữa tươi tiệt trùng 100% tự nhiên, thuộc sở hữu của Công ty cổ phần Sữa Quốc Tế (IDP), được thành lập vào năm 2004.\r\nCác sản phẩm sữa tươi Lof Kun giàu dinh dưỡng, được sản xuất từ nguồn sữa bò tươi chất lượng tại Úc, được rất nhiều trẻ em và người lớn ưa chuộng.\r\n![](https://cdn.tgdd.vn/Products/Images/2944/308115/bhx/loc-6-chai-sua-chua-uong-huong-cam-lif-kun-85ml-202307251436265228.jpg)\r\n**Thành phần dinh dưỡng **\r\nLốc 6 chai sữa chua uống tiệt trùng hương cam Lof Kun 85ml có chứa những thành phần dinh dưỡng như: Năng lượng, chất đạm, carbohydrate, chất béo, vitamin B1, B6, B2, kẽm, lysine,... Trung bình trong 100ml sữa chua uống tiệt trùng hương cam Lof Kun có khoảng 76.6 kcal.\r\n\r\n**Tác dụng với sức khỏe**\r\nLof Kun sử dụng nguồn sữa tươi tiệt trùng 100% tự nhiên, giàu dinh dưỡng, được sản xuất từ những cô bò tự do trên đồng cỏ thung lũng Goulburn và đóng gói nguyên hộp trong vòng 24 giờ tại Úc 1. Sữa chua uống tiệt trùng Lof Kun hương cam có mang lại nhiều công dụng tốt với sức khỏe:\r\n* Chứa kẽm giúp hỗ trợ tiêu hóa.\r\n* Lysine tăng cảm giác ngon miệng.\r\n* Ngoài ra , sữa chua uống Lof Kun còn chứa vitamin B1, B2, B6 giúp tăng cường chuyển hóa.\r\n\r\n**Hướng dẫn sử dụng**\r\nLắc đều trước khi sử dụng, sử dụng từ 2 - 3 chai mỗi ngày, sữa chua uống Lof Kun ngon hơn khi uống lạnh.\r\n\r\n**Cách bảo quản và lưu ý khi sử dụng**\r\n* Bảo quản nơi khô thoáng, tránh ánh nắng mặt trời chiếu trực tiếp.\r\n* Lưu ý, phù hợp cho trẻ em trên 3 tuổi.\r\n* Hiện tượng thay đổi màu sắc và lắng đọng tự nhiên không làm ảnh hưởng đến chất lượng sản phẩm.\r\n', NULL, 100, 0, 0, '2025-04-10 05:22:01', NULL),
('NEST1489', 'Combo 3 lon Sữa bột dinh dưỡng Nestle Milo Úc hộp 1kg', 'NEST', 'Sữa bột', 1000, 'g', '1080000.00', 'assets/images/products/NEST1489.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\NEST1489_medium.webp', 'Theo nghiên cứu, hiện nay việc trẻ em bỏ lỡ sữa vào bữa trưa và sau giờ học đã trở nên phổ biến. Trẻ trở nên lười uống sữa hơn vì vậy tìm ra loại thức uống không chỉ giàu dinh dưỡng mà còn đánh thức được niềm vui của trẻ mỗi khi uống sữa thật không hề dễ dàng. Sữa bột Milo với thành phần từ sữa và lúa mạch giàu năng lượng là thức uống không thể thiếu trông mỗi ly sữa hàng ngày của trẻ em. Chỉ với 3 muỗng café Milo vào ly sữa tươi nóng hoặc lạnh là bạn đã có một thức uống bổ dưỡng ngon miệng không chỉ trẻ em mà người lớn cũng rất yêu thích.\r\n![](https://suachobeyeu.vn/upload/images/sua-nestle-milo-uc-hop-1kg-a2.jpg)\r\nSữa bột Milo hộp 1kg được xem như một trong những thương hiệu mang tính biểu tượng của Úc trông suốt hơn 80 năm qua. Sữa bột Milo là sự kết hợp dinh dưỡng từ sữa bột Úc cùng năng lượng dồi dào từ lúa mạch kết hợp hương thơm quyến rũ từ hạt cacao đã tạo nên một loại thức uống thơm ngon, giàu năng lượng đực mọi thành viên gia đình yêu thích đặc biệt trẻ em.\r\n![](https://suachobeyeu.vn/upload/images/sua-nestle-milo-uc-hop-1kg-2.jpg)\r\nSữa bột Milo có thành phần chính từ sữa tươi lấy từ những trang trại bò sữa trên khắp nước Úc. Sữa tươi sau khi được loại bỏ nước sẽ tạo nên bột sữa giàu dinh dưỡng, năng lượng từ protein, vitamin và các khoáng chất thiết yếu. Sữa bột cũng góp phần tạo nên hương vị thơm ngon nguyên kem khi bạn thưởng thức ly sữa Milo.', NULL, 98, 0, 2, '2025-04-08 10:02:22', 'SUABOT'),
('NEST1516', 'Thùng 28 gói sữa chua uống tổ yến hương cam Nestlé Gấu 75ml', 'NEST', 'Sữa chua', 75, 'ml', '190000.00', 'assets/images/products/NEST1516.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\NEST1516_medium.webp', '***Nestlé*** - Một cửa hàng sữa được thành lập bởi người dược sĩ nước Đức tại Thụy Sĩ nay đã trở thành tập đoàn sữa với nhiều trụ sở trên khắp thế giới. ***Sữa Nestlé*** được yêu thích không chỉ đa dạng về hương vị, loại sản phẩm mà ở đó chất lượng cũng được người tiêu dùng đánh giá cao. Với nguồn nguyên liệu chất lượng, dây chuyền sản xuất hiện đại giúp Nestlé ngày càng phát triển và chiếm thị phần không nhỏ trên thị trường hiện nay.\r\n![](https://cdn.tgdd.vn/Products/Images/2944/292708/bhx/thung-28-goi-sua-chua-uong-to-yen-huong-cam-nestle-yogu-85ml-202407051607015105.jpg)\r\n\r\n**Thành phần dinh dưỡng của sản phẩm**\r\n**Sữa chua uống Nestlé** có hương cam và được bổ sung thành phần tổ yến bổ dưỡng. Sản phẩm sẽ cung cấp cho cơ thể nguồn dinh dưỡng dồi dào, cụ thể trong sữa cung cấp cho cơ thể các chất béo, chất đạm, canxi, kẽm, chất xơ, vitamin C, vitamin D... nên rất tốt cho sức khỏe người sử dụng, đặc biệt là trẻ em đang ở độ tuổi phát triển. Theo thông tin trên bao bì sản phẩm, trong 85ml sữa chua uống tổ yến hương cam Nestlé cung cấp khoảng 57 kcal.\r\n![](https://cdn.tgdd.vn/Products/Images/2944/292697/bhx/sua-chua-uong-to-yen-huong-cam-nestle-yogu-goi-85ml-202210151634353230.jpg)\r\n\r\n**Tác dụng của sản phẩm với sức khỏe**\r\n* Tăng cường hệ miễn dịch\r\n* Hỗ trợ phát triển não bộ\r\n* Tăng cường sức đề kháng\r\n* Hỗ trợ ăn ngon miệng\r\n* Tăng hấp thu canxi giúp xương chắc khỏe\r\n* Hỗ trợ hệ tiêu hóa khỏe mạnh\r\n\r\n**Hướng dẫn sử dụng sản phẩm**\r\n* Sử dụng cho bé trên 1 tuổi. Mỗi ngày nên sử dụng từ 2 - 3 gói.\r\n* Lắc đều trước khi uống, sản phẩm ngon hơn khi uống lạnh\r\n* Sử dụng ngay sau khi mở bao bì\r\n\r\n**Lưu ý khi sử dụng và cách bảo quản sản phẩm**\r\n* Sữa chua uống Nestlé cần được bảo quản ở nơi khô ráo, thoáng mát, tránh nhiệt độ cao và ánh nắng trực tiếp chiếu vào sản phẩm.\r\n* Khi đã mở bao bì nên sử dụng sớm, có thể bảo quản trong ngăn mát, tránh để sản phẩm bên ngoài làm thu hút các loại kiến gây ảnh hưởng đến chất lượng sản phẩm.\r\n* Không dùng cho bé dưới 1 tuổi và nên sử dụng hết 1 lần khi đã mở bao bì.\r\n\r\n**Ưu điểm khi mua sản phẩm tại *Milky World***\r\nCác sản phẩm tại ***Milky World*** đang được bán với giá thành cực tốt, cùng nhiều ưu đãi mỗi ngày. Đảm bảo đúng nguồn gốc xuất xứ, an toàn về chất lượng, mua ngay để được hỗ trợ dịch vụ giao hàng nhanh tận nơi nhanh chóng.', NULL, 200, 0, 0, '2025-04-10 07:28:01', NULL),
('NEST3559', 'Sữa bột dinh dưỡng Milo Nestle Úc hộp 1kg', 'NEST', 'Sữa bột', 1000, 'g', '368000.00', 'assets/images/products/NEST3559.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\NEST3559_medium.webp', 'Theo nghiên cứu, hiện nay việc trẻ em bỏ lỡ sữa vào bữa trưa và sau giờ học đã trở nên phổ biến. Trẻ trở nên lười uống sữa hơn vì vậy tìm ra loại thức uống không chỉ giàu dinh dưỡng mà còn đánh thức được niềm vui của trẻ mỗi khi uống sữa thật không hề dễ dàng. Sữa bột Milo với thành phần từ sữa và lúa mạch giàu năng lượng là thức uống không thể thiếu trông mỗi ly sữa hàng ngày của trẻ em. Chỉ với 3 muỗng café Milo vào ly sữa tươi nóng hoặc lạnh là bạn đã có một thức uống bổ dưỡng ngon miệng không chỉ trẻ em mà người lớn cũng rất yêu thích.\r\n![](https://suachobeyeu.vn/upload/images/sua-nestle-milo-uc-hop-1kg-a2.jpg)\r\nSữa bột Milo hộp 1kg được xem như một trong những thương hiệu mang tính biểu tượng của Úc trông suốt hơn 80 năm qua. Sữa bột Milo là sự kết hợp dinh dưỡng từ sữa bột Úc cùng năng lượng dồi dào từ lúa mạch kết hợp hương thơm quyến rũ từ hạt cacao đã tạo nên một loại thức uống thơm ngon, giàu năng lượng đực mọi thành viên gia đình yêu thích đặc biệt trẻ em.\r\n![](https://suachobeyeu.vn/upload/images/sua-nestle-milo-uc-hop-1kg-2.jpg)\r\nSữa bột Milo có thành phần chính từ sữa tươi lấy từ những trang trại bò sữa trên khắp nước Úc. Sữa tươi sau khi được loại bỏ nước sẽ tạo nên bột sữa giàu dinh dưỡng, năng lượng từ protein, vitamin và các khoáng chất thiết yếu. Sữa bột cũng góp phần tạo nên hương vị thơm ngon nguyên kem khi bạn thưởng thức ly sữa Milo.', NULL, 99, 0, 1, '2025-04-08 10:01:33', NULL),
('NEST4450', 'Combo 2 thùng sữa lúa mạch Milo ít đường hộp 180ml', 'NEST', 'Sữa tươi', 180, 'ml', '706000.00', 'assets/images/products/NEST4450.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\NEST4450_medium.webp', '**Thức uống lúa mạch Nestle Milo Ít Đường, hộp 180ml.** Ở lứa tuổi bắt đầu đi học, cha mẹ cần chú trọng cả chế độ dinh dưỡng lẫn vận động đầy đủ và đúng cách cho trẻ, đặc biệt là bữa ăn sáng. Đối với trẻ bữa ăn sáng với đầy đủ dưỡng chất sẽ giúp tạo ra nguồn năng lượng dài hạn cho não bộ tư duy và giúp duy trì các hoạt động thể chất cho trẻ suốt ngày dài năng động. Hãy đảm bảo cung cấp cho trẻ nguồn năng lượng đầy đủ nhất để trẻ có thể phát triển một cách toàn diện với Nestlé MILO - Thức uống dinh dưỡng giúp bổ sung năng lượng hiệu quả cho các hoạt động học tập và vui chơi hằng ngày của trẻ.\r\n![](https://suachobeyeu.vn/upload/images/thuc-uong-lua-mach-nestle-milo-it-duong-hop-180-ml-6-1.jpg)\r\nMang đầy đủ những lợi ích từ Sữa, Nestlé MILO với hợp chất ACTIV-GO Vươn xa là sự kết hợp độc đáo của ProtoMalt chiết xuất đặc biệt từ mầm lúa mạch nguyên cám, sữa, bột cacao và tổ hợp các vitamin và khoáng chất thiết yếu như: Canxi, Vitamin B2, B3, B6, B12, C, D, Sắt, Phốt pho... cung cấp dưỡng chất cân bằng và đóng góp vai trò quan trọng trong việc giải phóng năng lượng, tăng cường chức năng cơ và hệ xương, hỗ trợ tích cực cho các hoạt động thể chất và trí tuệ của trẻ. Nay đã có **MILO Ít Đường** mới giúp mẹ có thêm nhiều lựa chọn cho khẩu vị đa dạng cho trẻ, giảm nguy cơ béo phì, cho nhà vô địch luôn tự tin và khỏe mạnh. \r\n![](https://suachobeyeu.vn/upload/images/sua-ca-cao-lua-mach-milo-it-duong-hop-180ml-a2.jpg)\r\n**Thành phần:** Nước, đường, sữa bột tách kem, ProtoMalt được chiết xuất từ những hạt mầm lúa mạch, sirô glucose, dầu bơ và thực vật, bột cacao, đạm whey. Các khoáng chất Magiê, dicanxi phosphate, sắt pyrophosphat, chiết xuất từ đậu nành, các vitamin như biotin, canxi pantothenat, vitamin B1, B2, B3, B6, B12, chất tạo ngọt tổng hợp và hương vani tổng hợp.\r\n![](https://suachobeyeu.vn/upload/images/bang-thanh-phan-dinh-duong-trong-180-ml-milo-it-duong.jpg)\r\n**ProtoMalt**: một thành phần đặc biệt trong Nestlé MILO, thừa hưởng những dưỡng chất tinh túy nhất có trong lúa mạch như các loại Vitamin B, Vitamin C và Canxi, kết hợp với các vitamin và dưỡng chất thiết yếu trong sữa và cacao. Nestlé Milo Ít Đường cung cấp nguồn năng lượng bền bỉ cho trẻ với hương vị ca cao mà trẻ yêu thích.\r\nMẹ hãy chú ý cân bằng năng lượng cho trẻ thỏa thích vận động và vui chơi mà không bị đuối sức hay mệt mỏi bằng cách bổ sung cho bé một ly sữa MILO Ít đường sau khi tập thể dục thể thao nhé! MILO Ít đường giúp cung cấp năng lượng dài hạn, vừa dồi dào canxi, magiê và phốt-pho để cơ thể bé phát triển toàn diện.', NULL, 86, 0, 33, '2025-04-08 10:04:38', 'SUATUOI'),
('NEST7157', 'Sữa chua uống tổ yến hương cam Nestlé Gấu gói 75ml', 'NEST', 'Sữa chua', 75, 'ml', '7200.00', 'assets/images/products/NEST7157.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\NEST7157_medium.webp', '***Nestlé*** - Một cửa hàng sữa được thành lập bởi người dược sĩ nước Đức tại Thụy Sĩ nay đã trở thành tập đoàn sữa với nhiều trụ sở trên khắp thế giới. ***Sữa Nestlé*** được yêu thích không chỉ đa dạng về hương vị, loại sản phẩm mà ở đó chất lượng cũng được người tiêu dùng đánh giá cao. Với nguồn nguyên liệu chất lượng, dây chuyền sản xuất hiện đại giúp Nestlé ngày càng phát triển và chiếm thị phần không nhỏ trên thị trường hiện nay.\r\n![](https://cdn.tgdd.vn/Products/Images/2944/292697/bhx/sua-chua-uong-to-yen-huong-cam-nestle-yogu-goi-85ml-202407181539355717.jpg)\r\n\r\n**Thành phần dinh dưỡng của sản phẩm**\r\nSữa chua uống Nestlé có hương cam và được bổ sung thành phần tổ yến bổ dưỡng. Sản phẩm sẽ cung cấp cho cơ thể nguồn dinh dưỡng dồi dào, cụ thể trong sữa cung cấp cho cơ thể các chất béo, chất đạm, canxi, kẽm, chất xơ, vitamin C, vitamin D... nên rất tốt cho sức khỏe người sử dụng, đặc biệt là trẻ em đang ở độ tuổi phát triển. Theo thông tin trên bao bì sản phẩm, trong 85ml sữa chua uống tổ yến hương cam Nestlé cung cấp khoảng 57 kcal.\r\n![](https://cdn.tgdd.vn/Products/Images/2944/292697/bhx/sua-chua-uong-to-yen-huong-cam-nestle-yogu-goi-85ml-202210151634353230.jpg)\r\n\r\n**Tác dụng của sản phẩm với sức khỏe**\r\n* Tăng cường hệ miễn dịch\r\n* Hỗ trợ phát triển não bộ\r\n* Tăng cường sức đề kháng\r\n* Hỗ trợ ăn ngon miệng\r\n* Tăng hấp thu canxi giúp xương chắc khỏe\r\n* Hỗ trợ hệ tiêu hóa khỏe mạnh\r\n\r\n**Hướng dẫn sử dụng sản phẩm**\r\n* Sử dụng cho bé trên 1 tuổi. Mỗi ngày nên sử dụng từ 2 - 3 gói.\r\n* Lắc đều trước khi uống, sản phẩm ngon hơn khi uống lạnh\r\n* Sử dụng ngay sau khi mở bao bì\r\n\r\n**Lưu ý khi sử dụng và cách bảo quản sản phẩm**\r\n* Sữa chua uống Nestlé cần được bảo quản ở nơi khô ráo, thoáng mát, tránh nhiệt độ cao và ánh nắng trực tiếp chiếu vào sản phẩm.\r\n* Khi đã mở bao bì nên sử dụng sớm, có thể bảo quản trong ngăn mát, tránh để sản phẩm bên ngoài làm thu hút các loại kiến gây ảnh hưởng đến chất lượng sản phẩm.\r\n* Không dùng cho bé dưới 1 tuổi và nên sử dụng hết 1 lần khi đã mở bao bì.\r\n\r\n**Ưu điểm khi mua sản phẩm tại *Milky World***\r\nCác sản phẩm tại ***Milky World*** đang được bán với giá thành cực tốt, cùng nhiều ưu đãi mỗi ngày. Đảm bảo đúng nguồn gốc xuất xứ, an toàn về chất lượng, mua ngay để được hỗ trợ dịch vụ giao hàng nhanh tận nơi nhanh chóng.', NULL, 200, 0, 0, '2025-04-10 07:26:14', NULL),
('NEST7862', 'Thức uống lúa mạch Nestle Milo Ít Đường hộp 180ml', 'NEST', 'Sữa tươi', 180, 'ml', '358000.00', 'assets/images/products/NEST7862.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\NEST7862_medium.webp', '**Thức uống lúa mạch Nestle Milo Ít Đường, hộp 180ml.** Ở lứa tuổi bắt đầu đi học, cha mẹ cần chú trọng cả chế độ dinh dưỡng lẫn vận động đầy đủ và đúng cách cho trẻ, đặc biệt là bữa ăn sáng. Đối với trẻ bữa ăn sáng với đầy đủ dưỡng chất sẽ giúp tạo ra nguồn năng lượng dài hạn cho não bộ tư duy và giúp duy trì các hoạt động thể chất cho trẻ suốt ngày dài năng động. Hãy đảm bảo cung cấp cho trẻ nguồn năng lượng đầy đủ nhất để trẻ có thể phát triển một cách toàn diện với Nestlé MILO - Thức uống dinh dưỡng giúp bổ sung năng lượng hiệu quả cho các hoạt động học tập và vui chơi hằng ngày của trẻ.\r\n![](https://suachobeyeu.vn/upload/images/thuc-uong-lua-mach-nestle-milo-it-duong-hop-180-ml-6-1.jpg)\r\nMang đầy đủ những lợi ích từ Sữa, Nestlé MILO với hợp chất ACTIV-GO Vươn xa là sự kết hợp độc đáo của ProtoMalt chiết xuất đặc biệt từ mầm lúa mạch nguyên cám, sữa, bột cacao và tổ hợp các vitamin và khoáng chất thiết yếu như: Canxi, Vitamin B2, B3, B6, B12, C, D, Sắt, Phốt pho... cung cấp dưỡng chất cân bằng và đóng góp vai trò quan trọng trong việc giải phóng năng lượng, tăng cường chức năng cơ và hệ xương, hỗ trợ tích cực cho các hoạt động thể chất và trí tuệ của trẻ. Nay đã có **MILO Ít Đường** mới giúp mẹ có thêm nhiều lựa chọn cho khẩu vị đa dạng cho trẻ, giảm nguy cơ béo phì, cho nhà vô địch luôn tự tin và khỏe mạnh. \r\n![](https://suachobeyeu.vn/upload/images/sua-ca-cao-lua-mach-milo-it-duong-hop-180ml-a2.jpg)\r\n**Thành phần:** Nước, đường, sữa bột tách kem, ProtoMalt được chiết xuất từ những hạt mầm lúa mạch, sirô glucose, dầu bơ và thực vật, bột cacao, đạm whey. Các khoáng chất Magiê, dicanxi phosphate, sắt pyrophosphat, chiết xuất từ đậu nành, các vitamin như biotin, canxi pantothenat, vitamin B1, B2, B3, B6, B12, chất tạo ngọt tổng hợp và hương vani tổng hợp.\r\n![](https://suachobeyeu.vn/upload/images/bang-thanh-phan-dinh-duong-trong-180-ml-milo-it-duong.jpg)\r\n**ProtoMalt**: một thành phần đặc biệt trong Nestlé MILO, thừa hưởng những dưỡng chất tinh túy nhất có trong lúa mạch như các loại Vitamin B, Vitamin C và Canxi, kết hợp với các vitamin và dưỡng chất thiết yếu trong sữa và cacao. Nestlé Milo Ít Đường cung cấp nguồn năng lượng bền bỉ cho trẻ với hương vị ca cao mà trẻ yêu thích.\r\nMẹ hãy chú ý cân bằng năng lượng cho trẻ thỏa thích vận động và vui chơi mà không bị đuối sức hay mệt mỏi bằng cách bổ sung cho bé một ly sữa MILO Ít đường sau khi tập thể dục thể thao nhé! MILO Ít đường giúp cung cấp năng lượng dài hạn, vừa dồi dào canxi, magiê và phốt-pho để cơ thể bé phát triển toàn diện.', NULL, 100, 0, 0, '2025-04-08 10:04:14', NULL),
('NEST9952', 'Thức uống lúa mạch Ca Cao Nestle Milo hộp 180ml', 'NEST', 'Sữa tươi', 180, 'ml', '358000.00', 'assets/images/products/NEST9952.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\NEST9952_medium.webp', '**Sữa Milo hộp 180ml** thuộc thương hiệu ***Nestle Thụy Sỹ***. Milo được người tiêu dùng bình chọn hàng đầu về là nhãn hiệu uy tín, chất lượng đạt 100% trong vòng 17 năm qua, trong ngành hàng thực phẩm thức uống cacao dinh dưỡng cho trẻ từ 6 tuổi - 12 tuổi. Milo là thức uống lúa mạch được kết hợp độc đáo cacao và nguồn dưỡng chất thiên nhiên, giàu đạm và các dưỡng chất từ sữa, mầm lúa mạch nguyên cám và các vitamin, khoáng chất.\r\n![](https://suachobeyeu.vn/upload/images/nestle-milo-nuoc-uong-lien-hop-180ml-a2.jpg)\r\nNgoài có đầy đủ dinh dưỡng từ sữa, Nestle Milo với hợp chất Active-Go Vươn Xa là sự kết hợp độc đáo của Protomalt chiết xuất đặc biệt từ mầm lúa mạch và tổ hợp các Vtamin và khoáng chất thiết yếu, đóng góp vai trò quan trọng trong việc giải phóng năng lượng, tăng cường chức năng cơ và hệ xương, hỗ trợ tích cực cho các hoạt động thể chất và trí tuệ của trẻ.\r\n![](https://suachobeyeu.vn/upload/images/nestle-milo-nuoc-uong-lien-hop-180ml-1.jpg)\r\nSữa Milo bổ sung gấp đôi Activ-Go nhờ có chất Protomalt được chắc lọc tinh khiết từ các nhóm chất đạm, chất béo và chất bột đường, chất sắt và vitamin B1, B2, B3, B6, B12 và vitamin C và từ những hạt mầm lúa mạch nhờ đó giúp phát triển chiều cao tối đa cung cấp gấp đôi năng lượng để bé phát triển thể chất và trí tuệ của trẻ.\r\n\r\n**Thành phần dinh dưỡng trong mỗi hộp sữa Milo 180ml**\r\n* Bao gồm: Nước, đường, sữa bột tách kem, Protomalt được chiết xuất từ những hạt mầm lúa mạch, sirô glucose, dầu bơ và thực vật, bột cacao, whey. Các khoáng chất Mg, dicanxi phosphate, sắt pyrophosphat, chiết xuất từ đậu nành, các vitamin như biotin, canxi pantothenat, vitamin B1, B2, B3, B6, B12, , chất tạo ngọt tổng hợp và hương vani tổng hợp.\r\n* Nhu cầu khuyến nghị: sử dụng sản phẩm cho trẻ từ 6 tuổi trở lên với 2 khẩu phần (180ml) Milo mỗi ngày.\r\n* Sữa Nestle Milo nên được sử dụng hằng ngày, đặc biệt là vào buổi sáng khi con bạn bước vào tuổi đi học vì có chứa hợp chất Activ-GO Vươn Xa, được nghiên cứu và phát triển bởi Nestlé Thuỵ Sĩ, cung cấp nguồn năng lượng bền bỉ cho các hoạt động học tập và vận động của trẻ.', NULL, 100, 0, 0, '2025-04-08 09:42:12', NULL),
('NTF5752', 'Combo 2 thùng Sữa Nuti Grow Plus + Vàng hộp 110ml cho trẻ từ 1 tuổi', 'NTF', 'Sữa tươi', 110, 'ml', '850000.00', 'assets/images/products/NTF5752.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\NTF5752_medium.webp', 'Hệ miễn dịch được gọi là tấm áo giáp chắc chắn bảo vệ cơ thể khỏi các tác nhân xâm hại. Khi mới sinh, hệ miễn dịch của trẻ rất tốt nhờ hệ thống kháng thể nhận được từ mẹ khi còn trong bào thai, đây chính là miễn dịch thụ động. Từ khi sinh ra lượng kháng thể này bắt đầu giảm, vì thế trẻ cần được bú mẹ ngay và bú mẹ hoàn toàn đến 6 tháng, vì lúc này sữa của mẹ tiếp tục là nguồn cung cấp các kháng thể thụ động, giúp cơ thể bé duy trì được hệ miễn dịch tốt. Tuy nhiên, bước vào giai đoạn “khoảng trống miễn dịch”, lượng kháng thể từ mẹ giảm dần trong khi hệ thống miễn dịch của trẻ chưa hoàn chỉnh để tự sản xuất ra kháng thể nên hệ miễn dịch của trẻ rất yếu và dễ mắc bệnh. Giai đoạn này trùng với thời điểm trẻ tiếp xúc và làm quen với môi trường mới qua ăn dặm, tập bò, tập đi, đi nhà trẻ,… dẫn đến tỷ lệ trẻ mắc bệnh trong nhóm tuổi này rất cao. Do đó, để lấp đầy “khoảng trống miễn dịch” cho trẻ cần đảm bảo cho trẻ có một hệ miễn dịch khỏe mạnh thông qua dinh dưỡng và chăm sóc hợp lý.\r\n![](https://suachobeyeu.vn/upload/images/sua-pha-san-nuti-grow-plus-vang-tre-tu-1-tuoi-hop-110ml-1.jpg)\r\n***Nutifood*** cùng ***Viện Nghiên cứu Dinh dưỡng Nutifood Thụy Điển (NNRIS)*** dành tâm huyết nghiên cứu cho ra đời Nutifood Growplus vàng pha sẵn hộp 110ml giúp trẻ nhân đôi đề kháng, bảo vệ đến 2 lần từ bên trong và bên ngoài, giúp bé tự tin phát triển toàn diện với 100% sữa non 24h nhập khẩu từ Mỹ với kháng thể IgG 1000+ giúp tối ưu nền tảng miễn dịch, tránh các bệnh nhiễm khuẩ cùng công thức FDI là sự kết hợp HMO và FOS được phát triển bởi Viện Nghiên cứu Dinh dưỡng Nutifood Thụy Điển (NNRIS) dành riêng cho thể trạng đặc thù của trẻ em Việt và được chứng nhận lâm sàng giúp xây dựng nền tảng đề kháng khỏe – tiêu hóa tốt.\r\n![](https://suachobeyeu.vn/upload/images/sua-pha-san-nuti-grow-plus-vang-tre-tu-1-tuoi-hop-110ml-2.jpg)\r\n\r\n**Thành phần chính là sữa non 24h cao cấp - “Chìa khóa vàng” giúp trẻ tăng đề kháng vượt bậc**\r\nMột sức khỏe vững vàng được xây dựng từ nền tảng đề kháng tốt chính là chìa khoá để con phát triển toàn diện cả về thể chất lẫn tinh thần, sẵn sàng khám phá thế giới xung quanh. Ngay từ khi mới lọt lòng trẻ đã được mẹ bảo vệ nhờ những giọt sữa non quý giá, nguồn sữa non cho trẻ trong 1 - 2 ngày đầu sau sinh cùng với miễn dịch từ mẹ truyền sang thường đủ bảo vệ trẻ trong 6 tháng đầu sau sinh. Tuy nhiên, từ tháng thứ 7 trở đi, lượng kháng thể bảo vệ sụt giảm, trẻ tiếp xúc nhiều hơn với môi trường bên ngoài nên nguy cơ mắc các bệnh nhiễm khuẩn cũng cao hơn. Do đó, giai đoạn từ 6 tháng - 3 tuổi được xem là “khoảng trống miễn dịch”, trẻ cần được tăng cường hệ miễn dịch giúp con phát triển khỏe mạnh.\r\nKháng thể IgG tự nhiên từ sữa non có tác dụng kháng khuẩn trực tiếp, trung hòa nội độc tố vi khuẩn tại toàn bộ đường tiêu hóa. Kháng thể này cũng có các hoạt tính sinh học khác giúp ức chế tình trạng viêm tại ruột, thúc đẩy tái tạo lớp màng nhầy, phục hồi tổn thương mô. Trước thực trạng khan hiếm của loại sữa được mệnh danh là “giọt vàng”, các thương hiệu dinh dưỡng hàng đầu thế giới đã nghiên cứu và và cho ra đời các dạng thực phẩm giàu kháng thể IgG từ sữa non, trong đó có sản phẩm sữa GrowPlus+ sữa non Vàng. Với thành phần chính 100% sữa non 24h nhập khẩu từ Mỹ  giúp tăng cường hệ miễn dich tự nhiên cho trẻ, phòng chống các bệnh nhiễm khuẩn, hỗ trợ hệ tiêu hóa.', NULL, 12, 0, 65, '2025-04-08 09:59:52', 'SUATUOI'),
('NTF7334', 'Combo 3 lon Sữa bột Nutifood Grow Plus Vàng 0+ lon 800g cho trẻ từ 0-12 tháng', 'NTF', 'Sữa bột', 800, 'g', '1560000.00', 'assets/images/products/NTF7334.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\NTF7334_medium.webp', ' Trẻ sơ sinh có hệ thống miễn dịch non nớt, không thể nào chống lại được những mầm bệnh nguy hiểm. Các nhà khoa học cũng chứng rằng rằng, bổ sung sữa non giàu kháng thể là cách cải thiện chức năng miễn dịch của trẻ nhỏ trong những năm tháng đầu đời. Đây là thời điểm sức khỏe của bé dễ tổn thương nhất, cũng là lúc hệ tiêu hóa và miễn dịch nhanh chóng phát triển và hoàn thiện.\r\n ![](https://suachobeyeu.vn/upload/images/sua-bot-nutifood-grow-plus-vang-so-0-lon-800g-cho-tre-0-12-thang-3.jpg)\r\n **Nutifood GrowPlus vàng số 0+ cho trẻ 0-12 tháng** là sự kết hợp giữa công thức FDI độc quyền từ HMO-FOS cùng 100% sữa non 24h từ Mỹ giúp xây dựng cho bé nền tảng đề kháng khỏe - tiêu hóa tốt, từ đó nhân đôi đề kháng, bé phát triển hệ miễn dịch tự nhiên hạn chế ốm vặt.\r\n ![](https://suachobeyeu.vn/upload/images/sua-bot-nutifood-grow-plus-vang-so-0-lon-800g-cho-tre-0-12-thang-2.jpg)\r\n \r\n **Bổ sung nguồn kháng thể quý giá từ sữa non 24h nhập khẩu Mỹ - “ giọt vàng” giúp trẻ tăng đề kháng tự nhiên**\r\n* Vàng một nguyên liệu cực kỳ quý hiếm, nó đã được mọi người tôn vinh làm biểu tượng của những gì cao quý nhất, tinh túy nhất và trong những thực phẩm để nuôi sống con người thì sữa non được ví như một thực phẩm vàng cho trẻ mới sinh.. Sữa non có chứa kháng thể, yếu tố miễn dịch, yếu tố tăng trưởng và đặc biệt là có hàm lượng protein cao. Đây cũng là loại sữa duy nhất chứa các kháng thể, bạch cầu, vitamin A giúp trẻ giảm các nguy cơ nhiễm khuẩn, nhiễm trùng từ môi trường bên ngoài. \r\n* So với thời gian 72h, sữa non 24h có trong GrowPlus vàng được lấy từ 24h đầu chứa globulin miễn dịch cao hơn 100 lần so với sữa trưởng thành. Kháng thể sữa IgG có được trong nhóm sữa này chiếm đến 85% tổng hàm lượng Immunoglobulin G. Chính vì vậy, kháng thể IgG tự nhiên trong sữa non đóng vai trò quyết định trong giúp trẻ có miễn dịch khỏe, giảm bệnh vặt.\r\n* Một thành phần quan trọng khác có trong sữa non GrowPlus vàng là ganglioside. Đây là một nhóm chất béo rất quan trọng giúp bé phát triển trí não. Ganglioside không chỉ giúp cho não bộ của bé sớm phát triển mà nó còn bảo vệ hệ thống đường ruột, chống viêm nhiễm đường ruột cho trẻ khi thu hút các vi khuẩn có hại và trung hòa chúng.', NULL, 98, 0, 2, '2025-04-08 09:57:21', 'SUABOT'),
('NTF7948', 'Sữa Nuti Grow Plus + Vàng hộp 110ml cho trẻ từ 1 tuổi', 'NTF', 'Sữa tươi', 110, 'ml', '438000.00', 'assets/images/products/NTF7948.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\NTF7948_medium.webp', 'Hệ miễn dịch được gọi là tấm áo giáp chắc chắn bảo vệ cơ thể khỏi các tác nhân xâm hại. Khi mới sinh, hệ miễn dịch của trẻ rất tốt nhờ hệ thống kháng thể nhận được từ mẹ khi còn trong bào thai, đây chính là miễn dịch thụ động. Từ khi sinh ra lượng kháng thể này bắt đầu giảm, vì thế trẻ cần được bú mẹ ngay và bú mẹ hoàn toàn đến 6 tháng, vì lúc này sữa của mẹ tiếp tục là nguồn cung cấp các kháng thể thụ động, giúp cơ thể bé duy trì được hệ miễn dịch tốt. Tuy nhiên, bước vào giai đoạn “khoảng trống miễn dịch”, lượng kháng thể từ mẹ giảm dần trong khi hệ thống miễn dịch của trẻ chưa hoàn chỉnh để tự sản xuất ra kháng thể nên hệ miễn dịch của trẻ rất yếu và dễ mắc bệnh. Giai đoạn này trùng với thời điểm trẻ tiếp xúc và làm quen với môi trường mới qua ăn dặm, tập bò, tập đi, đi nhà trẻ,… dẫn đến tỷ lệ trẻ mắc bệnh trong nhóm tuổi này rất cao. Do đó, để lấp đầy “khoảng trống miễn dịch” cho trẻ cần đảm bảo cho trẻ có một hệ miễn dịch khỏe mạnh thông qua dinh dưỡng và chăm sóc hợp lý.\r\n![](https://suachobeyeu.vn/upload/images/sua-pha-san-nuti-grow-plus-vang-tre-tu-1-tuoi-hop-110ml-1.jpg)\r\n***Nutifood*** cùng ***Viện Nghiên cứu Dinh dưỡng Nutifood Thụy Điển (NNRIS)*** dành tâm huyết nghiên cứu cho ra đời Nutifood Growplus vàng pha sẵn hộp 110ml giúp trẻ nhân đôi đề kháng, bảo vệ đến 2 lần từ bên trong và bên ngoài, giúp bé tự tin phát triển toàn diện với 100% sữa non 24h nhập khẩu từ Mỹ với kháng thể IgG 1000+ giúp tối ưu nền tảng miễn dịch, tránh các bệnh nhiễm khuẩ cùng công thức FDI là sự kết hợp HMO và FOS được phát triển bởi Viện Nghiên cứu Dinh dưỡng Nutifood Thụy Điển (NNRIS) dành riêng cho thể trạng đặc thù của trẻ em Việt và được chứng nhận lâm sàng giúp xây dựng nền tảng đề kháng khỏe – tiêu hóa tốt.\r\n![](https://suachobeyeu.vn/upload/images/sua-pha-san-nuti-grow-plus-vang-tre-tu-1-tuoi-hop-110ml-2.jpg)\r\n\r\n**Thành phần chính là sữa non 24h cao cấp - “Chìa khóa vàng” giúp trẻ tăng đề kháng vượt bậc**\r\nMột sức khỏe vững vàng được xây dựng từ nền tảng đề kháng tốt chính là chìa khoá để con phát triển toàn diện cả về thể chất lẫn tinh thần, sẵn sàng khám phá thế giới xung quanh. Ngay từ khi mới lọt lòng trẻ đã được mẹ bảo vệ nhờ những giọt sữa non quý giá, nguồn sữa non cho trẻ trong 1 - 2 ngày đầu sau sinh cùng với miễn dịch từ mẹ truyền sang thường đủ bảo vệ trẻ trong 6 tháng đầu sau sinh. Tuy nhiên, từ tháng thứ 7 trở đi, lượng kháng thể bảo vệ sụt giảm, trẻ tiếp xúc nhiều hơn với môi trường bên ngoài nên nguy cơ mắc các bệnh nhiễm khuẩn cũng cao hơn. Do đó, giai đoạn từ 6 tháng - 3 tuổi được xem là “khoảng trống miễn dịch”, trẻ cần được tăng cường hệ miễn dịch giúp con phát triển khỏe mạnh.\r\nKháng thể IgG tự nhiên từ sữa non có tác dụng kháng khuẩn trực tiếp, trung hòa nội độc tố vi khuẩn tại toàn bộ đường tiêu hóa. Kháng thể này cũng có các hoạt tính sinh học khác giúp ức chế tình trạng viêm tại ruột, thúc đẩy tái tạo lớp màng nhầy, phục hồi tổn thương mô. Trước thực trạng khan hiếm của loại sữa được mệnh danh là “giọt vàng”, các thương hiệu dinh dưỡng hàng đầu thế giới đã nghiên cứu và và cho ra đời các dạng thực phẩm giàu kháng thể IgG từ sữa non, trong đó có sản phẩm sữa GrowPlus+ sữa non Vàng. Với thành phần chính 100% sữa non 24h nhập khẩu từ Mỹ  giúp tăng cường hệ miễn dich tự nhiên cho trẻ, phòng chống các bệnh nhiễm khuẩn, hỗ trợ hệ tiêu hóa.', NULL, 90, 0, 10, '2025-04-08 09:58:51', NULL),
('NUTI8132', 'Sữa bột Nutifood Grow Plus Vàng 0+ cho trẻ từ 0-12 tháng lon 800g', 'NTF', 'Sữa bột', 800, 'g', '528000.00', 'assets/images/products/NUTI8132.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\NUTI8132_medium.webp', ' Trẻ sơ sinh có hệ thống miễn dịch non nớt, không thể nào chống lại được những mầm bệnh nguy hiểm. Các nhà khoa học cũng chứng rằng rằng, bổ sung sữa non giàu kháng thể là cách cải thiện chức năng miễn dịch của trẻ nhỏ trong những năm tháng đầu đời. Đây là thời điểm sức khỏe của bé dễ tổn thương nhất, cũng là lúc hệ tiêu hóa và miễn dịch nhanh chóng phát triển và hoàn thiện.\r\n ![](https://suachobeyeu.vn/upload/images/sua-bot-nutifood-grow-plus-vang-so-0-lon-800g-cho-tre-0-12-thang-3.jpg)\r\n **Nutifood GrowPlus vàng số 0+ cho trẻ 0-12 tháng** là sự kết hợp giữa công thức FDI độc quyền từ HMO-FOS cùng 100% sữa non 24h từ Mỹ giúp xây dựng cho bé nền tảng đề kháng khỏe - tiêu hóa tốt, từ đó nhân đôi đề kháng, bé phát triển hệ miễn dịch tự nhiên hạn chế ốm vặt.\r\n ![](https://suachobeyeu.vn/upload/images/sua-bot-nutifood-grow-plus-vang-so-0-lon-800g-cho-tre-0-12-thang-2.jpg)\r\n \r\n **Bổ sung nguồn kháng thể quý giá từ sữa non 24h nhập khẩu Mỹ - “ giọt vàng” giúp trẻ tăng đề kháng tự nhiên**\r\n* Vàng một nguyên liệu cực kỳ quý hiếm, nó đã được mọi người tôn vinh làm biểu tượng của những gì cao quý nhất, tinh túy nhất và trong những thực phẩm để nuôi sống con người thì sữa non được ví như một thực phẩm vàng cho trẻ mới sinh.. Sữa non có chứa kháng thể, yếu tố miễn dịch, yếu tố tăng trưởng và đặc biệt là có hàm lượng protein cao. Đây cũng là loại sữa duy nhất chứa các kháng thể, bạch cầu, vitamin A giúp trẻ giảm các nguy cơ nhiễm khuẩn, nhiễm trùng từ môi trường bên ngoài. \r\n* So với thời gian 72h, sữa non 24h có trong GrowPlus vàng được lấy từ 24h đầu chứa globulin miễn dịch cao hơn 100 lần so với sữa trưởng thành. Kháng thể sữa IgG có được trong nhóm sữa này chiếm đến 85% tổng hàm lượng Immunoglobulin G. Chính vì vậy, kháng thể IgG tự nhiên trong sữa non đóng vai trò quyết định trong giúp trẻ có miễn dịch khỏe, giảm bệnh vặt.\r\n* Một thành phần quan trọng khác có trong sữa non GrowPlus vàng là ganglioside. Đây là một nhóm chất béo rất quan trọng giúp bé phát triển trí não. Ganglioside không chỉ giúp cho não bộ của bé sớm phát triển mà nó còn bảo vệ hệ thống đường ruột, chống viêm nhiễm đường ruột cho trẻ khi thu hút các vi khuẩn có hại và trung hòa chúng.', NULL, 98, 0, 2, '2025-04-08 09:56:14', NULL);
INSERT INTO `sua` (`ma_sua`, `ten_sua`, `ma_hang_sua`, `loai_sua`, `trong_luong`, `don_vi`, `don_gia`, `hinh_anh`, `hinh_anh_optimized`, `mo_ta`, `mo_ta_chi_tiet`, `so_luong_ton`, `luot_xem`, `luot_mua`, `ngay_tao`, `ma_loai_sua`) VALUES
('THTM2673', 'TH true FORMULA 1 cho trẻ từ 0 - 6 tháng tuổi', 'THTM', 'Sữa bột', 800, 'g', '510000.00', 'assets/images/products/THTM2673.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\THTM2673_medium.webp', 'Sản phẩm dinh dưỡng TH true FORMULA được sản xuất tại Úc theo công thức Care Advance độc quyền phát triển bởi Viện Dinh Dưỡng TH cung cấp DINH DƯỠNG TOÀN DIỆN cho trẻ phát triển qua từng giai đoạn.\r\n\r\n**Tính năng sản phẩm:**\r\n\r\n***1. Phát triển trí não và thể chất:***\r\n\r\nSự kết hợp giữa MFGM có trong sữa mẹ cùng dưỡng chất DHA, ARA giúp phát triển trí não và thể chất của bé.\r\n\r\n***2. Hỗ trợ tăng cường đề kháng:***\r\n\r\nDưỡng chất HMO (2′-FL), Nucleotide, Vitamin và khoáng chất có trong sản phẩm sẽ kích thích hệ thống miễn dịch bằng cách thúc đẩy vi khuẩn có lợi cho đường ruột, tăng cường chức năng hàng rào đường ruột và ngăn chặn tác nhân gây bệnh.\r\n\r\n***3. Hấp thu tốt và tiêu hóa khỏe mạnh:***\r\n\r\nProbiotic (GOS) & Prebiotic (FOS) là những loại chất xơ tự nhiên có tác dụng kích thích tăng trưởng của những vi khuẩn có lợi (Lactobacillus và Bifidobacteria) giúp hạn chế táo bón và tăng cường hấp thu chất dinh dưỡng.\r\n\r\nSản phẩm đáp ứng các yêu cầu về chất lượng và an toàn thực phẩm theo Quy chuẩn kỹ thuật Quốc gia đối với sản phẩm dinh dưỡng công thức cho trẻ QCVN 11-1:2012/BYT (đối với sản phẩm cho trẻ 0-6 tháng tuổi), QCVN 11-3:2012/BYT (đối với sản phẩm cho trẻ 6-12 tháng tuổi, 12-24 tháng tuổi, 2-6 tuổi) và tiêu chuẩn quốc tế Codex (WHO, FAO).\r\n\r\nHướng dẫn bảo quản:\r\n\r\nBảo quản nơi khô ráo và thoáng mát\r\nĐóng nắp kín sau mỗi lần sử dụng. Không bảo quản trong tủ lạnh.\r\nHộp đã mở nên sử dụng trong vòng 4 tuần.\r\n\r\nHướng dẫn sử dụng:\r\n\r\n1 – Rửa sạch tay và dụng cụ pha chế.\r\n2- Đun sôi dung cụ pha chế trong 5 phút hoặc sử dụng thiết bị tiệt trùng phù hợp.\r\n3- Đun nước sôi trong 5 phút sau đó để nguội bằng nhiệt độ cơ thể.\r\n4- Rót lượng nước cần dùng vào dụng cụ pha chế.\r\n5- Cho đủ số lượng sản phẩm tương ứng với lượng nước.\r\n6- Lắc hoặc khuấy tan hoàn toàn sản phẩm. Kiểm tra nhiệt độ trước khi cho trẻ dùng.\r\n\r\nLưu ý:\r\n\r\nChỉ sử dụng muỗng có trong hộp. Cho trẻ uống ngay sau khi pha. Đổ bỏ phần còn thừa nếu trẻ dùng kéo dài hơn 1 giờ. Đây chỉ là lượng khuyến nghị tham khảo. Mỗi trẻ có thể cần lượng dùng khác nhau, nên hỏi cán bộ y tế về lượng dùng phù hợp.\r\n\r\nThành phần:\r\n\r\nLactose, sữa bột tách kem, dầu thực vật (dầu hạt cải, dầu dừa, dầu hướng dương, dầu đậu nành, chất chống oxy hóa ascorbyl palmitat), sữa bột nguyên kem, đạm whey cô đặc, màng cầu chất béo sữa (MFGM) (1,5%), galacto-oligosaccharides (GOS), fructo-oligosaccharides (FOS), khoáng chất (calci carbonat, kali clorid, magnesi clorid, natri clorid, kali citrat, kẽm sulfat, sắt sulfat, kali iodid, mangan sulfat, đồng sulfat, kali hydroxyd), vitamin (natri ascorbat (vitamin C), DL-alpha tocopheryl acetat (vitamin E), niacin (vitamin B3), calci D-pantothenat (vitamin B5), cyanocobalamin (vitamin B12), D-biotin, acid folic, retinyl palmitat (vitamin A), thiamin hydroclorid (vitamin B1), pyridoxin hydroclorid (vitamin B6), riboflavin (vitamin B2), phylloquinon (vitamin K1), cholecalciferol (vitamin D3), ß-caroten), DHA (nguồn từ dầu cá), ARA, HMO (2’-fucosyllactose (2’-FL)), cholin clorid, taurin, hỗn hợp nucleotid (cytidin 5’-monophosphat, uridin 5’-monophosphat, adenosin 5’-monophosphat, inosin 5’-monophosphat, guanosin 5’-monophosphat), Bifidobacterium longum BB536, chất nhũ hóa lecithin đậu nành. ', NULL, 5, 0, 36, '2025-04-07 07:57:50', NULL),
('THTM3793', 'TH true FORMULA 2 cho trẻ từ 6 - 12 tháng tuổi', 'THTM', 'Sữa bột', 800, 'g', '490000.00', 'assets/images/products/THTM3793.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\THTM3793_medium.webp', 'Sản phẩm dinh dưỡng TH true FORMULA được sản xuất tại Úc theo công thức Care Advance độc quyền phát triển bởi Viện Dinh Dưỡng TH cung cấp DINH DƯỠNG TOÀN DIỆN cho trẻ phát triển qua từng giai đoạn.\r\n\r\nTính năng sản phẩm:\r\n\r\n1. Phát triển trí não và thể chất:\r\n\r\nSự kết hợp giữa MFGM có trong sữa mẹ cùng dưỡng chất DHA, ARA giúp phát triển trí não và thể chất của bé.\r\n\r\n2. Hỗ trợ tăng cường đề kháng:\r\n\r\nDưỡng chất HMO (2′-FL), Nucleotide, Vitamin và khoáng chất có trong sản phẩm sẽ kích thích hệ thống miễn dịch bằng cách thúc đẩy vi khuẩn có lợi cho đường ruột, tăng cường chức năng hàng rào đường ruột và ngăn chặn tác nhân gây bệnh.\r\n\r\n3. Hấp thu tốt và tiêu hóa khỏe mạnh:\r\n\r\nProbiotic (GOS) & Prebiotic (FOS) là những loại chất xơ tự nhiên có tác dụng kích thích tăng trưởng của những vi khuẩn có lợi (Lactobacillus và Bifidobacteria) giúp hạn chế táo bón và tăng cường hấp thu chất dinh dưỡng.\r\n\r\nSản phẩm đáp ứng các yêu cầu về chất lượng và an toàn thực phẩm theo Quy chuẩn kỹ thuật Quốc gia đối với sản phẩm dinh dưỡng công thức cho trẻ QCVN 11-1:2012/BYT (đối với sản phẩm cho trẻ 0-6 tháng tuổi), QCVN 11-3:2012/BYT (đối với sản phẩm cho trẻ 6-12 tháng tuổi, 12-24 tháng tuổi, 2-6 tuổi) và tiêu chuẩn quốc tế Codex (WHO, FAO).\r\n\r\nHướng dẫn bảo quản:\r\n\r\nBảo quản nơi khô ráo và thoáng mát\r\nĐóng nắp kín sau mỗi lần sử dụng. Không bảo quản trong tủ lạnh.\r\nHộp đã mở nên sử dụng trong vòng 4 tuần.\r\n\r\nHướng dẫn sử dụng:\r\n\r\n1 – Rửa sạch tay và dụng cụ pha chế.\r\n2- Đun sôi dung cụ pha chế trong 5 phút hoặc sử dụng thiết bị tiệt trùng phù hợp.\r\n3- Đun nước sôi trong 5 phút sau đó để nguội bằng nhiệt độ cơ thể.\r\n4- Rót lượng nước cần dùng vào dụng cụ pha chế.\r\n5- Cho đủ số lượng sản phẩm tương ứng với lượng nước.\r\n6- Lắc hoặc khuấy tan hoàn toàn sản phẩm. Kiểm tra nhiệt độ trước khi cho trẻ dùng.\r\n\r\nLưu ý:\r\n\r\nChỉ sử dụng muỗng có trong hộp. Cho trẻ uống ngay sau khi pha. Đổ bỏ phần còn thừa nếu trẻ dùng kéo dài hơn 1 giờ. Đây chỉ là lượng khuyến nghị tham khảo. Mỗi trẻ có thể cần lượng dùng khác nhau, nên hỏi cán bộ y tế về lượng dùng phù hợp.\r\n\r\nThành phần:\r\n\r\nLactose, sữa bột tách kem, dầu thực vật (dầu hạt cải, dầu dừa, dầu hướng dương, dầu đậu nành, chất chống oxy hóa ascorbyl palmitat), sữa bột nguyên kem, đạm whey cô đặc, màng cầu chất béo sữa (MFGM) (1,5%), galacto-oligosaccharides (GOS), fructo-oligosaccharides (FOS), khoáng chất (calci carbonat, kali clorid, magnesi clorid, natri clorid, kali citrat, kẽm sulfat, sắt sulfat, kali iodid, mangan sulfat, đồng sulfat, kali hydroxyd), vitamin (natri ascorbat (vitamin C), DL-alpha tocopheryl acetat (vitamin E), niacin (vitamin B3), calci D-pantothenat (vitamin B5), cyanocobalamin (vitamin B12), D-biotin, acid folic, retinyl palmitat (vitamin A), thiamin hydroclorid (vitamin B1), pyridoxin hydroclorid (vitamin B6), riboflavin (vitamin B2), phylloquinon (vitamin K1), cholecalciferol (vitamin D3), ß-caroten), DHA (nguồn từ dầu cá), ARA, HMO (2’-fucosyllactose (2’-FL)), cholin clorid, taurin, hỗn hợp nucleotid (cytidin 5’-monophosphat, uridin 5’-monophosphat, adenosin 5’-monophosphat, inosin 5’-monophosphat, guanosin 5’-monophosphat), Bifidobacterium longum BB536, chất nhũ hóa lecithin đậu nành. ', NULL, 46, 0, 4, '2025-04-07 07:57:50', NULL),
('THTM4457', 'Sữa lúa mạch TH True Chocomalt Mistori hộp 180ml', 'THTM', 'Sữa tươi', 180, 'ml', '358000.00', 'assets/images/products/THTM4457.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\THTM4457_medium.webp', '**Sữa lúa mạch TH True Chocomalt Mistori hộp 180ml**\r\n![](https://suachobeyeu.vn/upload/sua-tuoi/sua-th-true-milk/sua-th-true-mistori/sua-lua-mach-th-true-chocomalt-mistori-hop-180ml/sua-lua-mach-th-true-chocomalt-mistori-hop-180ml-6.jpg)\r\n\r\n***Hướng dẫn sử dụng Sữa lúa mạch TH True Chocomalt Mistori hộp 180ml***\r\n* Ngon hơn khi uống lạnh.\r\n* Nên dùng từ 1-2 hộp mỗi ngày.\r\n\r\n***Hướng dẫn bảo quản Sữa lúa mạch TH True Chocomalt Mistori hộp 180ml***\r\n* Bảo quản nơi khô ráo và thoáng mát.\r\n![](https://suachobeyeu.vn/upload/sua-tuoi/sua-th-true-milk/sua-th-true-mistori/sua-lua-mach-th-true-chocomalt-mistori-hop-180ml/sua-lua-mach-th-true-chocomalt-mistori-hop-180ml-10.jpg)', NULL, 96, 0, 4, '2025-04-08 10:09:36', NULL),
('THTM4789', 'TH true FORMULA 3 cho trẻ từ 1 - 2 tuổi', 'THTM', 'Sữa bột', 800, 'g', '430000.00', 'assets/images/products/THTM4789.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\THTM4789_medium.webp', 'Sản phẩm dinh dưỡng TH true FORMULA được sản xuất tại Úc theo công thức Care Advance độc quyền phát triển bởi Viện Dinh Dưỡng TH cung cấp DINH DƯỠNG TOÀN DIỆN cho trẻ phát triển qua từng giai đoạn.\r\n\r\nTính năng sản phẩm:\r\n\r\n1. Phát triển trí não và thể chất:\r\n\r\nSự kết hợp giữa MFGM có trong sữa mẹ cùng dưỡng chất DHA, ARA giúp phát triển trí não và thể chất của bé.\r\n\r\n2. Hỗ trợ tăng cường đề kháng:\r\n\r\nDưỡng chất HMO (2′-FL), Nucleotide, Vitamin và khoáng chất có trong sản phẩm sẽ kích thích hệ thống miễn dịch bằng cách thúc đẩy vi khuẩn có lợi cho đường ruột, tăng cường chức năng hàng rào đường ruột và ngăn chặn tác nhân gây bệnh.\r\n\r\n3. Hấp thu tốt và tiêu hóa khỏe mạnh:\r\n\r\nProbiotic (GOS) & Prebiotic (FOS) là những loại chất xơ tự nhiên có tác dụng kích thích tăng trưởng của những vi khuẩn có lợi (Lactobacillus và Bifidobacteria) giúp hạn chế táo bón và tăng cường hấp thu chất dinh dưỡng.\r\n\r\nSản phẩm đáp ứng các yêu cầu về chất lượng và an toàn thực phẩm theo Quy chuẩn kỹ thuật Quốc gia đối với sản phẩm dinh dưỡng công thức cho trẻ QCVN 11-1:2012/BYT (đối với sản phẩm cho trẻ 0-6 tháng tuổi), QCVN 11-3:2012/BYT (đối với sản phẩm cho trẻ 6-12 tháng tuổi, 12-24 tháng tuổi, 2-6 tuổi) và tiêu chuẩn quốc tế Codex (WHO, FAO).\r\n\r\nHướng dẫn bảo quản:\r\n\r\nBảo quản nơi khô ráo và thoáng mát\r\nĐóng nắp kín sau mỗi lần sử dụng. Không bảo quản trong tủ lạnh.\r\nHộp đã mở nên sử dụng trong vòng 4 tuần.\r\n\r\nHướng dẫn sử dụng:\r\n\r\n1 – Rửa sạch tay và dụng cụ pha chế.\r\n2- Đun sôi dung cụ pha chế trong 5 phút hoặc sử dụng thiết bị tiệt trùng phù hợp.\r\n3- Đun nước sôi trong 5 phút sau đó để nguội bằng nhiệt độ cơ thể.\r\n4- Rót lượng nước cần dùng vào dụng cụ pha chế.\r\n5- Cho đủ số lượng sản phẩm tương ứng với lượng nước.\r\n6- Lắc hoặc khuấy tan hoàn toàn sản phẩm. Kiểm tra nhiệt độ trước khi cho trẻ dùng.\r\n\r\nLưu ý:\r\n\r\nChỉ sử dụng muỗng có trong hộp. Cho trẻ uống ngay sau khi pha. Đổ bỏ phần còn thừa nếu trẻ dùng kéo dài hơn 1 giờ. Đây chỉ là lượng khuyến nghị tham khảo. Mỗi trẻ có thể cần lượng dùng khác nhau, nên hỏi cán bộ y tế về lượng dùng phù hợp.\r\n\r\nThành phần:\r\n\r\nLactose, sữa bột tách kem, dầu thực vật (dầu hạt cải, dầu dừa, dầu hướng dương, dầu đậu nành, chất chống oxy hóa ascorbyl palmitat), sữa bột nguyên kem, đạm whey cô đặc, màng cầu chất béo sữa (MFGM) (1,5%), galacto-oligosaccharides (GOS), fructo-oligosaccharides (FOS), khoáng chất (calci carbonat, kali clorid, magnesi clorid, natri clorid, kali citrat, kẽm sulfat, sắt sulfat, kali iodid, mangan sulfat, đồng sulfat, kali hydroxyd), vitamin (natri ascorbat (vitamin C), DL-alpha tocopheryl acetat (vitamin E), niacin (vitamin B3), calci D-pantothenat (vitamin B5), cyanocobalamin (vitamin B12), D-biotin, acid folic, retinyl palmitat (vitamin A), thiamin hydroclorid (vitamin B1), pyridoxin hydroclorid (vitamin B6), riboflavin (vitamin B2), phylloquinon (vitamin K1), cholecalciferol (vitamin D3), ß-caroten), DHA (nguồn từ dầu cá), ARA, HMO (2’-fucosyllactose (2’-FL)), cholin clorid, taurin, hỗn hợp nucleotid (cytidin 5’-monophosphat, uridin 5’-monophosphat, adenosin 5’-monophosphat, inosin 5’-monophosphat, guanosin 5’-monophosphat), Bifidobacterium longum BB536, chất nhũ hóa lecithin đậu nành. ', NULL, 50, 0, 0, '2025-04-07 07:57:50', NULL),
('THTM5157', 'TH true FORMULA 4 cho trẻ từ 2 - 6 tuổi', 'THTM', 'Sữa bột', 800, 'g', '395000.00', 'assets/images/products/THTM5157.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\THTM5157_medium.webp', 'Sản phẩm dinh dưỡng TH true FORMULA được sản xuất tại Úc theo công thức Care Advance độc quyền phát triển bởi Viện Dinh Dưỡng TH cung cấp DINH DƯỠNG TOÀN DIỆN cho trẻ phát triển qua từng giai đoạn.\r\n\r\nTính năng sản phẩm:\r\n\r\n1. Phát triển trí não và thể chất:\r\n\r\nSự kết hợp giữa MFGM có trong sữa mẹ cùng dưỡng chất DHA, ARA giúp phát triển trí não và thể chất của bé.\r\n\r\n2. Hỗ trợ tăng cường đề kháng:\r\n\r\nDưỡng chất HMO (2′-FL), Nucleotide, Vitamin và khoáng chất có trong sản phẩm sẽ kích thích hệ thống miễn dịch bằng cách thúc đẩy vi khuẩn có lợi cho đường ruột, tăng cường chức năng hàng rào đường ruột và ngăn chặn tác nhân gây bệnh.\r\n\r\n3. Hấp thu tốt và tiêu hóa khỏe mạnh:\r\n\r\nProbiotic (GOS) & Prebiotic (FOS) là những loại chất xơ tự nhiên có tác dụng kích thích tăng trưởng của những vi khuẩn có lợi (Lactobacillus và Bifidobacteria) giúp hạn chế táo bón và tăng cường hấp thu chất dinh dưỡng.\r\n\r\nSản phẩm đáp ứng các yêu cầu về chất lượng và an toàn thực phẩm theo Quy chuẩn kỹ thuật Quốc gia đối với sản phẩm dinh dưỡng công thức cho trẻ QCVN 11-1:2012/BYT (đối với sản phẩm cho trẻ 0-6 tháng tuổi), QCVN 11-3:2012/BYT (đối với sản phẩm cho trẻ 6-12 tháng tuổi, 12-24 tháng tuổi, 2-6 tuổi) và tiêu chuẩn quốc tế Codex (WHO, FAO).\r\n\r\nHướng dẫn bảo quản:\r\n\r\nBảo quản nơi khô ráo và thoáng mát\r\nĐóng nắp kín sau mỗi lần sử dụng. Không bảo quản trong tủ lạnh.\r\nHộp đã mở nên sử dụng trong vòng 4 tuần.\r\n\r\nHướng dẫn sử dụng:\r\n\r\n1 – Rửa sạch tay và dụng cụ pha chế.\r\n2- Đun sôi dung cụ pha chế trong 5 phút hoặc sử dụng thiết bị tiệt trùng phù hợp.\r\n3- Đun nước sôi trong 5 phút sau đó để nguội bằng nhiệt độ cơ thể.\r\n4- Rót lượng nước cần dùng vào dụng cụ pha chế.\r\n5- Cho đủ số lượng sản phẩm tương ứng với lượng nước.\r\n6- Lắc hoặc khuấy tan hoàn toàn sản phẩm. Kiểm tra nhiệt độ trước khi cho trẻ dùng.\r\n\r\nLưu ý:\r\n\r\nChỉ sử dụng muỗng có trong hộp. Cho trẻ uống ngay sau khi pha. Đổ bỏ phần còn thừa nếu trẻ dùng kéo dài hơn 1 giờ. Đây chỉ là lượng khuyến nghị tham khảo. Mỗi trẻ có thể cần lượng dùng khác nhau, nên hỏi cán bộ y tế về lượng dùng phù hợp.\r\n\r\nThành phần:\r\n\r\nLactose, sữa bột tách kem, dầu thực vật (dầu hạt cải, dầu dừa, dầu hướng dương, dầu đậu nành, chất chống oxy hóa ascorbyl palmitat), sữa bột nguyên kem, đạm whey cô đặc, màng cầu chất béo sữa (MFGM) (1,5%), galacto-oligosaccharides (GOS), fructo-oligosaccharides (FOS), khoáng chất (calci carbonat, kali clorid, magnesi clorid, natri clorid, kali citrat, kẽm sulfat, sắt sulfat, kali iodid, mangan sulfat, đồng sulfat, kali hydroxyd), vitamin (natri ascorbat (vitamin C), DL-alpha tocopheryl acetat (vitamin E), niacin (vitamin B3), calci D-pantothenat (vitamin B5), cyanocobalamin (vitamin B12), D-biotin, acid folic, retinyl palmitat (vitamin A), thiamin hydroclorid (vitamin B1), pyridoxin hydroclorid (vitamin B6), riboflavin (vitamin B2), phylloquinon (vitamin K1), cholecalciferol (vitamin D3), ß-caroten), DHA (nguồn từ dầu cá), ARA, HMO (2’-fucosyllactose (2’-FL)), cholin clorid, taurin, hỗn hợp nucleotid (cytidin 5’-monophosphat, uridin 5’-monophosphat, adenosin 5’-monophosphat, inosin 5’-monophosphat, guanosin 5’-monophosphat), Bifidobacterium longum BB536, chất nhũ hóa lecithin đậu nành. ', NULL, 0, 0, 50, '2025-04-07 07:57:50', NULL),
('THTM5241', 'Thùng 48 hộp sữa tươi tiệt trùng nguyên chất TH true MILK 110ml', 'THTM', 'Sữa tươi', 110, 'ml', '260000.00', 'assets/images/products/THTM5241.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\THTM5241_medium.webp', 'Sữa tươi của thương hiệu sữa tươi ***TH true Milk*** hỗ trợ xương luôn chắc khỏe. ***Thùng 48 hộp sữa tươi tiệt trùng vị tự nhiên TH true MILK Hilo 180ml*** tiết kiệm tối ưu, giúp cung cấp các dưỡng chất cần thiết cho cơ thể. Hương vị tự nhiên thơm ngon kích thích vị giác người dùng. \r\n\r\n* Loại sữa:	Sữa tươi tiệt trùng vị tự nhiên\r\n* Dung tích:	110ml\r\n* Phù hợp với:	Trẻ từ 1 tuổi trở lên\r\n* Thành phần:	Sữa hoàn toàn từ sữa bò tươi (100%)\r\n* Bảo quản: Bảo quản nơi khô ráo và thoáng mát\r\n* Hạn sử dụng: 6 tháng kể từ ngày sản xuất\r\n* Lưu ý: Không dùng cho trẻ dưới 1 tuổi. Sản phẩm cho 1 lần sử dụng\r\n* Thương hiệu:	TH true MILK (Việt Nam)\r\n* Sản xuất tại:	Việt Nam', NULL, 100, 0, 0, '2025-04-07 09:07:31', NULL),
('THTM6903', 'Thùng 48 hộp sữa tươi tiệt trùng vị tự nhiên TH true MILK Hilo 180ml', 'THTM', 'Sữa tươi', 180, 'ml', '450000.00', 'assets/images/products/THTM6903.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\THTM6903_medium.webp', 'Sữa tươi của thương hiệu sữa tươi ***TH true Milk*** hỗ trợ xương luôn chắc khỏe. ***Thùng 48 hộp sữa tươi tiệt trùng vị tự nhiên TH true MILK Hilo 180ml*** tiết kiệm tối ưu, giúp cung cấp các dưỡng chất cần thiết cho cơ thể. Hương vị tự nhiên thơm ngon kích thích vị giác người dùng. \r\n\r\n* Loại sữa:	Sữa tươi tiệt trùng vị tự nhiên\r\n* Dung tích:	180ml\r\n* Phù hợp với:	Người lớn và trẻ từ 1 tuổi trở lên\r\n* Thành phần:	Sữa hoàn toàn từ sữa bò tươi tách béo (99,2%), canxi và khoáng chất tự nhiên từ sữa, chất ổn định (418, 471,410), enzym lactase.\r\n* Bảo quản: Bảo quản nơi khô ráo và thoáng mát.\r\n* Lưu ý:	Hiện tượng lẳng ở đáy hộp, biến đổi màu theo thời hạn sử dụng của sản phẩm là những hiện tượng tự nhiên và là đặc trưng của sản phẩm. Không gây ảnh hưởng đến chất lượng sản phẩm và sức khỏe của người tiêu dùng.\r\n* Thương hiệu:	TH true MILK (Việt Nam)\r\n* Sản xuất tại:	Việt Nam', NULL, 100, 0, 0, '2025-04-07 09:04:53', NULL),
('THTM7395', 'Thùng 12 hộp sữa tươi tiệt trùng nguyên chất không đường TH true MILK hộp 1 lít', 'THTM', 'Sữa tươi', 1000, 'ml', '450000.00', 'assets/images/products/THTM7395.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\THTM7395_medium.webp', 'Đảm bảo sản phẩm có vị ngon 100% đến từ sữa tươi từ trang trại của sữa tươi ***TH True Milk*** chứa nhiều vitamin và khoáng chất như Vitamin A, D, B1, B2, canxi, kẽm. ***Thùng 12 hộp sữa tươi tiệt trùng nguyên chất không đường TH true MILK hộp 1 lít*** đóng thùng tiện lợi, tiết kiệm \r\n\r\n* Loại sữa:	Sữa tươi tiệt trùng vị tự nhiên\r\n* Dung tích:	1000ml\r\n* Phù hợp với:	Trẻ từ 1 tuổi trở lên\r\n* Thành phần:	Sữa hoàn toàn từ sữa bò tươi (100%)\r\n* Bảo quản: Bảo quản nơi khô ráo và thoáng mát\r\n* Hạn sử dụng: 6 tháng kể từ ngày sản xuất\r\n* Cách mở nắp: Mở nắp nhựa rồi giật khoen để xé lớp giấy bạc bên trong\r\n* Thương hiệu:	TH true MILK (Việt Nam)\r\n* Sản xuất tại:	Việt Nam\r\n\r\n# Bài viết sản phẩm\r\n\r\nThành phần và công dụng:\r\n* Sản phẩm có hương vị thơm ngon, hấp dẫn với thành phần: Sữa hoàn toàn từ sữa bò tươi (96%), đường tinh luyện (3,8%), chất ổn định dùng cho thực phẩm..\r\n* Sử dụng hoàn toàn sữa tươi sạch nguyên chất của trang trại TH với dây chuyền sản xuất hiện đại và đảm bảo an toàn vệ sinh thực phẩm.\r\n* Cung cấp các dưỡng chất thiết yếu cho sự phát triển trí lực và thể chất của cả gia đình.\r\n* Sữa tươi tiệt trùng TH True Milk bổ sung Colagen, Canxi, Phytosterol và các dưỡng chất thiết yếu giúp tăng khả năng hấp thu chất dinh dưỡng, bảo vệ xương và răng, cải thiện hệ tim mạch.\r\n* Với thiết kế hộp nhỏ gọn tiện lợi cho bạn và gia đình bảo quản lâu dài và thưởng thức hàng ngày.\r\nHướng dẫn sử dụng:\r\n* Dùng uống trực tiếp.\r\n* Sản phẩm sử dụng cho một lần uống.\r\n* Ngon hơn khi uống lạnh.\r\nBảo quản:\r\n* Bảo quản nơi khô ráo, thoáng mát, tránh ánh nắng trực tiếp.\r\n* Sử dụng ngay sau khi mở. Hộp đã mở bảo quản nhiệt độ 2 - 4 độ C.', NULL, 100, 0, 0, '2025-04-07 09:12:08', NULL),
('THTM8457', 'Thùng 48 hộp sữa tươi tiệt trùng socola TH true MILK 110ml', 'THTM', 'Sữa tươi', 110, 'ml', '260000.00', 'assets/images/products/THTM8457.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\THTM8457_medium.webp', 'Sữa tươi của thương hiệu sữa tươi ***TH true Milk*** hỗ trợ xương luôn chắc khỏe. ***Thùng 48 hộp sữa tươi tiệt trùng socola TH true MILK 110ml*** tiết kiệm tối ưu, giúp cung cấp các dưỡng chất cần thiết cho cơ thể. Hương vị tự nhiên thơm ngon kích thích vị giác người dùng. \r\n\r\n* Loại sữa:	Sữa tươi tiệt trùng vị tự nhiên\r\n* Dung tích:	110ml\r\n* Phù hợp với:	Trẻ từ 1 tuổi trở lên\r\n* Thành phần:	Sữa hoàn toàn từ sữa bò 100%, sô cô la đen nguyên chất, đường,...\r\n* Bảo quản: Bảo quản nơi khô ráo và thoáng mát\r\n* Hạn sử dụng: 6 tháng kể từ ngày sản xuất\r\n* Lưu ý: Không dùng cho trẻ dưới 1 tuổi. Sản phẩm cho 1 lần sử dụng\r\n* Thương hiệu:	TH true MILK (Việt Nam)\r\n* Sản xuất tại:	Việt Nam', NULL, 100, 0, 0, '2025-04-07 09:17:43', NULL),
('VNM1683', 'Sữa tiệt trùng Vinamilk không đường hộp 180ml', 'VNM', 'Sữa tươi', 180, 'ml', '358000.00', 'assets/images/products/VNM1683.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\VNM1683_medium.webp', 'Với nguồn dưỡng chất thiên nhiên quý giá và hương vị tươi ngon khó cưỡng, sữa bò tươi giúp cả gia đình luôn tràn đầy sức khỏe và niềm vui mỗi ngày. Sữa tươi rất giàu protein, chất béo và các loại vitamin, đồng thời sữa cũng chứa hàm lượng cao canxi rất tốt cho sức khỏe. Có thể nói, sữa tươi chính là món quà tuyệt vời cho sức khỏe của cả gia đình.\r\n![](https://suachobeyeu.vn/upload/images/sua-tuoi-tiet-trung-vinamilk-180-ml-khong-duong.jpg)\r\nVới hàm lượng dinh dưỡng dồi dào nói trên, mỗi ly sữa có ý nghĩa rất lớn đối với sức khỏe của mỗi người. Uống sữa tươi mỗi ngày giúp bạn bổ sung các vitamin thiết yếu như vitamin A, vitamin D, vitamin B, khoáng chất cùng các nguyên tố vi lượng, cơ thể sẽ được tăng sức đề kháng, phát triển hệ thần kinh và duy trì quá trình trao đổi chất.\r\n![](https://suachobeyeu.vn/upload/images/sua-tuoi-tiet-trung-vinamilk-180ml-khong-duong-2.jpg)\r\nHơn 40 năm qua, Vinamilk đã và đang đồng hành cùng hàng triệu gia đình Việt, gắn kết qua bao thế hệ. Mỗi ly sữa cầm trên tay như một thói quen không thể thiếu trong văn hóa ẩm thực đa dạng của mỗi gia đình. Đáp ứng lại sự tin tưởng đó, Vinamilk luôn chú trọng đầu tư công nghệ sản xuất hiện đại và không ngừng sáng tạo, đem đến cho người tiêu dùng những giải pháp dinh dưỡng mới, có chất lượng quốc tế.', NULL, 100, 0, 0, '2025-04-08 09:53:21', NULL),
('VNM2274', 'Sữa tiệt trùng Vinamilk Flex không Lactose hộp 180ml', 'VNM', 'Sữa tươi', 180, 'ml', '368000.00', 'assets/images/products/VNM2274.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\VNM2274_medium.webp', 'Sữa là một loại đồ uống phổ biến ở hầu hết mọi quốc gia, từ thời cổ xưa đây là thức uống được gọi là **\"bạch huyết\"** vì rất giàu chất khoáng, có tỷ lệ với canxi phốt pho phù hợp, rất tốt cho sự hấp thụ canxi. Mặc dù sữa có rất nhiều lợi ích như vậy nhưng nhiều người trong chúng ta, hễ uống một chút sữa là ngay lập tức cảm thấy không thoải mái, bụng khó chịu, thậm chí có các triệu chứng đầy bụng và tiêu chảy. Trên thực tế, những người hễ uống sữa là có cảm giác khó chịu rối loạn tiêu hóa rất có thể là bị căn bệnh dị ứng hoặc không dung nạp với lactose.\r\n![](https://suachobeyeu.vn/upload/images/sua-tuoi-vinamilk-flex-khong-lactose-hop-180ml-1.jpg)\r\nThật may là bạn không phải từ bỏ sở thích uống ly sữa tươi ngon mỗi ngày dù cơ địa không dung nạp lactose. Là sản phẩm sữa không Lactose đầu tiên tại Việt Nam, **sữa tiệt trùng Vinamilk Flex** không Lactose là lựa chọn hàng đầu để bạn có hệ xương chắc khỏe, xóa an mọi nỗi lo về việc đầy bụng khó tiêu khi uống sữa, đồng thời được bổ sung 50% canxi giúp hệ xương thêm chắc khỏe dẻo dai.\r\n![](https://suachobeyeu.vn/upload/images/sua-tiet-trung-vinamilk-flex-khong-lactose-hop-180ml-3.jpg)\r\n\r\n**Thành phần không Lactose đồng thời bổ sung thêm men lactase giúp dễ tiêu hóa, không gây sôi bụng **\r\nLactose là một hợp chất được sinh ra ở ruột non giúp phân hóa đường lactose thành hai loại đường khác nhau là đường glucose và đường galactose có ích cho cơ thể. Tùy vào lượng men lactase có trong cơ thể mà mỗi người có khả năng tiêu hóa lactose khác nhau\r\n![](https://suachobeyeu.vn/upload/images/sua-tuoi-vinamilk-flex-khong-lactose-hop-180ml-2.jpg)\r\nCụ thể, enzyme lactase được tiết ra ở ruột non để hỗ trợ tiêu hóa và hấp thu đường lactose. Tuy nhiên với người gặp tình trạng bất dung nạp lactose thì cơ thể không thể tiết ra đủ lượng lactase để phân giải đường lactose. Vì thế, đường lactose có trong thức ăn sẽ đi vào đại tràng và bị vi khuẩn phân hủy thành chất lỏng và khí, từ đó gây ra các vấn đề về tiêu hóa như đầy hơi, tiêu chảy...Nguyên nhân chính gây ra tình trạng không thể dung nạp lactose vẫn là do thiếu enzyme lactase. Vì men lactase nằm ở lớp vi nhung mao ruột non, nên bất cứ nguyên nhân nào làm tổn thương đường ruột của bé hoặc gây ảnh hưởng đến việc sản sinh men lactase. Đều dẫn đến hiện tượng bất dung nạp đường lactose.', NULL, 98, 0, 2, '2025-04-08 09:49:14', NULL),
('VNM3260', 'Sữa tươi hữu cơ Vinamilk Green Farm Organic hộp 180ml', 'VNM', 'Sữa tươi', 180, 'ml', '498000.00', 'assets/images/products/VNM3260.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\VNM3260_medium.webp', '**Sữa tươi hữu cơ Vinamilk Green Farm Organic hộp 180ml**\r\nKhi nhịp sống hiện đại ngày càng trở nên bận rộn, người dân ở các nước phát triển càng tìm kiếm những phương cách để sống cân bằng, nhẹ nhàng gần gũi với thiên nhiên. Lối sống organic: sử dụng thực phẩm hữu cơ thuần tự nhiên, sống cân bằng, tập luyện thể dục, yoga, thiền định… vì thế đang là xu hướng nổi bật được ưa chuộng tại châu Âu, Mỹ. Organic hướng con người đến những điều bình dị, thuận theo tự nhiên bằng những thói quen tích cực như 30 phút tập yoga hoặc thiền định cho một cơ thể dẻo dai và trí tuệ minh mẫn, hay đơn giản là thưởng thức ly sữa tươi 100% organic mỗi sáng để cung cấp năng lượng cho cơ thể, đến chăm sóc gia đình bằng những sản phẩm hữu cơ, hoàn toàn không có tác động của hóa chất.\r\n![](https://suachobeyeu.vn/upload/images/thung-sua-tuoi-vinamilk-organic-khong-duong-hop-180-ml.jpg)\r\nSữa tươi là một nguồn dinh dưỡng giàu dưỡng chất cho cả gia đình. Không chỉ cung cấp: protein, canxi, phốt pho, vitamin A và vitamin D mà sữa tươi đặc biệt ít béo, vì thiếu hàm lượng chất béo của các sản phẩm sữa khác như sữa nguyên chất nên nó mang lại lợi ích cho sức khỏe, ít rủi ro liên quan đến việc tiêu thụ chất béo bão hòa và cholesterol. Mỗi ngày bạn và các thành viên trong gia đình bổ sung thêm sữa tươi vào chế độ ăn có thể giúp bạn duy trì khối lượng cơ bắp, tăng cường mật độ xương, hỗ trợ một  cơ thể khỏe mạnh và cải thiện sức khỏe tuần hoàn của bạn.\r\n![](https://suachobeyeu.vn/upload/images/thung-sua-tuoi-vinamilk-organic-khong-duong-hop-180-ml-1.jpg)\r\n**Sữa Tươi Tiệt Trùng Vinamilk Green Farm 100% Organic Không Đường hộp 180ml** với thành phần tự nhiên đem đến hương vị thơm ngon cũng như cung cấp các dưỡng chất thiết yếu cho sự phát triển trí lực và thể chất của cả gia đình. Với quy trình sản xuất sữa nghiêm ngặt theo tiêu chuẩn organic Châu Âu, sản phẩm ***Sữa tươi Vinamilk Green Farm Organic*** mới hoàn toàn thuần khiết và giàu các dưỡng chất tự nhiên tốt cho sức khỏe.\r\n', NULL, 100, 0, 0, '2025-04-08 09:45:46', NULL),
('VNM5788', 'Thùng sữa Vinamilk Không Đường Flex Hộp 1 Lít', 'VNM', 'Sữa tươi', 1000, 'ml', '388000.00', 'assets/images/products/VNM5788.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\VNM5788_medium.webp', '**Sữa tiệt trùng Vinamilk không đường Flex, hộp 1 lít**. Canxi là một khoáng chất quan trọng giúp xương khỏe mạnh, là nguyên tố quan trọng trong cơ thể, trong đó 99% tồn tại trong xương, răng, móng tay, chân. Ở mỗi giai đoạn phát triển đều cần canxi, người lớn trưởng thành, người cao tuổi, đặc biệt là phụ nữ sau khi sinh. Mỗi ngày chúng ta cần 1000mg Canxi để đáp ứng cho nhu cầu xương chắc khỏe, nhưng bữa ăn hằng ngày chỉ đáp ứng đủ 50% nhu cầu này. \r\n![](https://suachobeyeu.vn/upload/images/sua-tiet-trung-vinamilk-flex-khong-duong-hop-1-lit-2.jpg)\r\n**Sữa tiệt trùng Vinamilk Flex không đường** với thành phần dinh dưỡng chuyên biệt tăng 50% hàm lượng canxi và giảm 50% chất béo so với sữa tươi thông thường, giúp duy trì hệ xương vững chắc, cơ thể khỏe khoắn năng động và tràn đầy sức sống mỗi ngày. Sản phẩm được kiểm định nghiêm ngặt và tuân thủ các quy định về dinh dưỡng, nguồn dinh dưỡng an toàn cho sức khỏe của cả gia đình.  \r\n**Sữa tiệt trùng Vinamilk Flex không đường** được xử lý bằng công nghệ tiệt trùng UHT hiện đại xử lý ở 14 độ C trong thời gian ngắn (4 – 6 giây), sau đó làm lạnh nhanh giúp tiêu diệt hết vi khuẩn có hại, các loại nấm men, nấm mốc, đồng thời giữ lại tối đa các chất dinh dưỡng và mùi vị tự nhiên của sản phẩm.\r\n![](https://suachobeyeu.vn/upload/images/sua-tiet-trung-vinamilk-flex-khong-duong-hop-1-lit-5.jpg)\r\nHàm lượng Canxi và Vitamin D được cung cấp vượt trội giúp tăng cường mật độ xương, cơ thể dẻo dai khỏe khoắn năng động và tràn đầy sức sống.\r\nSữa tươi không đường, ít béo giúp hạn chế hiện tượng sôi bụng, dễ tiêu hóa.', NULL, 100, 0, 0, '2025-04-08 09:51:38', NULL),
('VNM8237', 'Combo 2 thùng Sữa tươi Vinamilk không đường hộp 180ml', 'VNM', 'Sữa tươi', 180, 'ml', '706000.00', 'assets/images/products/VNM8237.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\VNM8237_medium.webp', 'Với nguồn dưỡng chất thiên nhiên quý giá và hương vị tươi ngon khó cưỡng, sữa bò tươi giúp cả gia đình luôn tràn đầy sức khỏe và niềm vui mỗi ngày. Sữa tươi rất giàu protein, chất béo và các loại vitamin, đồng thời sữa cũng chứa hàm lượng cao canxi rất tốt cho sức khỏe. Có thể nói, sữa tươi chính là món quà tuyệt vời cho sức khỏe của cả gia đình.\r\n![](https://suachobeyeu.vn/upload/images/sua-tuoi-tiet-trung-vinamilk-180-ml-khong-duong.jpg)\r\nVới hàm lượng dinh dưỡng dồi dào nói trên, mỗi ly sữa có ý nghĩa rất lớn đối với sức khỏe của mỗi người. Uống sữa tươi mỗi ngày giúp bạn bổ sung các vitamin thiết yếu như vitamin A, vitamin D, vitamin B, khoáng chất cùng các nguyên tố vi lượng, cơ thể sẽ được tăng sức đề kháng, phát triển hệ thần kinh và duy trì quá trình trao đổi chất.\r\n![](https://suachobeyeu.vn/upload/images/sua-tuoi-tiet-trung-vinamilk-180ml-khong-duong-2.jpg)\r\nHơn 40 năm qua, Vinamilk đã và đang đồng hành cùng hàng triệu gia đình Việt, gắn kết qua bao thế hệ. Mỗi ly sữa cầm trên tay như một thói quen không thể thiếu trong văn hóa ẩm thực đa dạng của mỗi gia đình. Đáp ứng lại sự tin tưởng đó, Vinamilk luôn chú trọng đầu tư công nghệ sản xuất hiện đại và không ngừng sáng tạo, đem đến cho người tiêu dùng những giải pháp dinh dưỡng mới, có chất lượng quốc tế.', NULL, 99, 0, 1, '2025-04-08 09:54:03', 'SUATUOI'),
('VNM8821', 'Thùng sữa tươi TH Milk ít đường bịch 220ml', 'VNM', 'Sữa tươi', 220, 'ml', '378000.00', 'assets/images/products/VNM8821.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\VNM8821_medium.webp', 'Từ ngàn xưa với sự thông minh trong quá trình lao động sáng tạo nhằm tồn tại và phát triển, con người đã hiểu giá trị của sữa và biết sử dụng sữa từ các loài động vật có vú trong khi thuẩn hóa chúng. Ngày nay, sữa được sử dụng rộng rải trên toàn cầu với vai trò cực kỳ quan trọng trong việc bổ sung dưỡng chất, năng lượng cho khẩu phần dinh dưỡng hợp lý hàng ngày cũng như tăng cường sức khỏe toàn diện.\r\n![](https://suachobeyeu.vn/upload/images/thung-sua-tuoi-tiet-trung-th-true-milk-it-duong-bich-220ml-1.jpg)\r\n**Sữa tươi Th True Milk ít đường bịch 220ml** với thành phần dòng sữa tươi sạch 100% cùng công nghệ sản xuất hiện đại khép kín giúp giữ vẹn nguyên những tinh túy từ thiên nhiên góp phần phát triển thể chất chiều cao vượt trội, phòng ngừa loãng xương.\r\n![](https://suachobeyeu.vn/upload/images/sua-tuoi-th-true-milk-it-duong-bich-220ml-4-1.jpg)\r\n\r\n***Cung cấp nguồn dưỡng chất tự nhiên dễ hấp thu giàu protein, canxi và các axit amin thiết yếu***\r\nSữa tươi thành phần giàu vitamin và khoáng chất, sữa được biết đến như một phức hợp đầy đủ nhất các thành phần vi lượng cần thiết cho quá trình tiêu hóa, hấp thu, chuyển hóa thức ăn giúp cơ thể hình thành mô – tế bào, tăng trưởng và phát triển toàn diện cũng như phòng chống bệnh tật. Với hàm lượng dinh dưỡng dồi dào nói trên, mỗi ly sữa có ý nghĩa rất lớn đối với sức khỏe của mỗi người. Uống sữa tươi TH True Milk mỗi ngày giúp bạn bổ sung các vitamin thiết yếu như vitamin A, vitamin D, vitamin B, khoáng chất cùng các nguyên tố vi lượng, cơ thể sẽ được tăng sức đề kháng, phát triển hệ thần kinh và duy trì quá trình trao đổi chất.\r\n![](https://suachobeyeu.vn/upload/images/thung-sua-tuoi-tiet-trung-th-true-milk-it-duong-bich-220ml-2.jpg)\r\nXương của chúng ta là những tế bào sống liên tục thay đổi. Khi con người phát triển đến tuổi trưởng thành, xương đạt kích thước tối đa rồi ngưng lại. Điều này không có nghĩa các tế bào xương ngừng hoạt động. Trong suốt chu kỳ 10 năm liên tục, xương tự “tu sửa”, tái tạo bản thân bằng cách loại bỏ mô xương cũ và thay bằng mô xương mới. Cơ chế này giúp xương luôn chắc khỏe, dẻo dai và cung cấp đủ canxi cho cơ thể. 99% lượng canxi của cơ thể nằm trong xương và răng. Thiếu canxi là nguyên nhất chính gây ra loãng xương, xốp xương. Khi bữa ăn hàng ngày không cung cấp đủ nhu cầu canxi, cơ thể sẽ tự động rút canxi khỏi hệ xương, khiến xương ngày càng yếu đi\r\nVì vậy mỗi ly sữa tươi TH True Milk sẽ có ý nghĩa tăng cường sự phát triển chiều cao tối đa cho trẻ. Theo đó, mỗi ly sữa có chứa hàm lượng cao Canxi cùng với vitamin D có tác dụng tăng khả năng hấp thu Canxi, đây chính là nền tảng tuyệt vời giúp trẻ có hệ xương chắc khỏe, chiều cao vượt trội, phòng ngừa loãng xương ở người lớn.', NULL, 87, 0, 13, '2025-04-08 10:08:02', NULL),
('VNM9748', 'Sữa tươi hữu cơ Vinamilk Green Farm Organic hộp 1 Lít', 'VNM', 'Sữa tươi', 1000, 'ml', '588000.00', 'assets/images/products/VNM9748.jpg', 'C:\\Users\\HUY\\Desktop\\Dai Hoc\\Lap Trinh Web\\Web-Ban-Sua-Milky\\Web-Ban-Sua-Milky\\src\\Core\\Performance/../../../public/assets/cache\\VNM9748_medium.webp', '**Sữa tươi hữu cơ Vinamilk Green Farm Organic hộp 1000ml**\r\nKhi nhịp sống hiện đại ngày càng trở nên bận rộn, người dân ở các nước phát triển càng tìm kiếm những phương cách để sống cân bằng, nhẹ nhàng gần gũi với thiên nhiên. Lối sống organic: sử dụng thực phẩm hữu cơ thuần tự nhiên, sống cân bằng, tập luyện thể dục, yoga, thiền định… vì thế đang là xu hướng nổi bật được ưa chuộng tại châu Âu, Mỹ. Organic hướng con người đến những điều bình dị, thuận theo tự nhiên bằng những thói quen tích cực như 30 phút tập yoga hoặc thiền định cho một cơ thể dẻo dai và trí tuệ minh mẫn, hay đơn giản là thưởng thức ly sữa tươi 100% organic mỗi sáng để cung cấp năng lượng cho cơ thể, đến chăm sóc gia đình bằng những sản phẩm hữu cơ, hoàn toàn không có tác động của hóa chất.\r\n![](https://suachobeyeu.vn/upload/images/thung-sua-tuoi-vinamilk-organic-khong-duong-hop-180-ml.jpg)\r\nSữa tươi là một nguồn dinh dưỡng giàu dưỡng chất cho cả gia đình. Không chỉ cung cấp: protein, canxi, phốt pho, vitamin A và vitamin D mà sữa tươi đặc biệt ít béo, vì thiếu hàm lượng chất béo của các sản phẩm sữa khác như sữa nguyên chất nên nó mang lại lợi ích cho sức khỏe, ít rủi ro liên quan đến việc tiêu thụ chất béo bão hòa và cholesterol. Mỗi ngày bạn và các thành viên trong gia đình bổ sung thêm sữa tươi vào chế độ ăn có thể giúp bạn duy trì khối lượng cơ bắp, tăng cường mật độ xương, hỗ trợ một  cơ thể khỏe mạnh và cải thiện sức khỏe tuần hoàn của bạn.\r\n![](https://suachobeyeu.vn/upload/images/thung-sua-tuoi-vinamilk-organic-khong-duong-hop-180-ml-1.jpg)\r\n**Sữa Tươi Tiệt Trùng Vinamilk Green Farm 100% Organic Không Đường hộp 1000ml** với thành phần tự nhiên đem đến hương vị thơm ngon cũng như cung cấp các dưỡng chất thiết yếu cho sự phát triển trí lực và thể chất của cả gia đình. Với quy trình sản xuất sữa nghiêm ngặt theo tiêu chuẩn organic Châu Âu, sản phẩm ***Sữa tươi Vinamilk Green Farm Organic*** mới hoàn toàn thuần khiết và giàu các dưỡng chất tự nhiên tốt cho sức khỏe.\r\n', NULL, 100, 0, 0, '2025-04-08 09:46:58', NULL);

--
-- Triggers `sua`
--
DELIMITER $$
CREATE TRIGGER `update_gia_sua` AFTER UPDATE ON `sua` FOR EACH ROW BEGIN
    IF NEW.don_gia != OLD.don_gia THEN
        INSERT INTO lich_su_gia (ma_sua, gia) VALUES (NEW.ma_sua, NEW.don_gia);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `su_dung_khuyen_mai`
--

CREATE TABLE `su_dung_khuyen_mai` (
  `id` int NOT NULL,
  `ma_khuyen_mai` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ma_khach_hang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ma_don_hang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngay_su_dung` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `su_dung_khuyen_mai`
--

INSERT INTO `su_dung_khuyen_mai` (`id`, `ma_khuyen_mai`, `ma_khach_hang`, `ma_don_hang`, `ngay_su_dung`) VALUES
(1, 'GTHV', 'ADMIN01', 'DH3345', '2025-04-07 13:38:24'),
(2, 'Test', 'ADMIN01', 'DH1880', '2025-04-08 17:12:17'),
(3, 'Test', 'ADMIN01', 'DH6713', '2025-04-08 19:04:02'),
(4, 'Test', 'ADMIN01', 'DH3553', '2025-04-08 19:47:36'),
(5, 'Test', 'ADMIN01', 'DH4598', '2025-04-09 06:45:06'),
(6, 'Test', 'ADMIN01', 'DH4700', '2025-04-09 12:48:00'),
(7, 'GTHV', 'ADMIN01', 'DH1907', '2025-04-09 13:50:08'),
(8, 'Test', 'ADMIN01', 'DH5568', '2025-04-09 20:57:10'),
(9, 'GTHV', 'ADMIN01', 'DH8223', '2025-04-09 21:19:37'),
(10, 'Test', 'ADMIN01', 'DH3326', '2025-04-10 11:44:45'),
(11, 'Test', 'ADMIN01', 'DH1620', '2025-04-10 15:57:14'),
(12, 'Test', 'ADMIN01', 'DH5979', '2025-04-11 21:58:44'),
(13, 'HM5XZ6KZ', 'ADMIN01', 'DH7962', '2025-04-14 21:28:12');

-- --------------------------------------------------------

--
-- Table structure for table `thong_bao`
--

CREATE TABLE `thong_bao` (
  `ma_thong_bao` int NOT NULL,
  `ma_khach_hang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tieu_de` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8mb4_unicode_ci,
  `da_doc` tinyint(1) DEFAULT '0',
  `thoi_gian` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `yeu_thich`
--

CREATE TABLE `yeu_thich` (
  `ma_sua` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_khach_hang` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngay_them` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yeu_thich`
--

INSERT INTO `yeu_thich` (`ma_sua`, `ma_khach_hang`, `ngay_them`) VALUES
('DL6601', 'ADMIN01', '2025-04-12 07:00:02'),
('NEST4450', 'ADMIN01', '2025-04-12 06:55:01'),
('NEST4450', 'KH0007', '2025-04-10 04:28:59'),
('NTF5752', 'ADMIN01', '2025-04-12 05:07:09'),
('NTF7334', 'ADMIN01', '2025-04-11 15:05:16'),
('NUTI8132', 'ADMIN01', '2025-04-11 15:05:17'),
('THTM2673', 'KH0006', '2025-04-07 08:34:14'),
('THTM4457', 'ADMIN01', '2025-04-10 04:43:30'),
('VNM8237', 'ADMIN01', '2025-04-09 01:27:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD PRIMARY KEY (`ma_don_hang`,`ma_sua`),
  ADD KEY `ma_sua` (`ma_sua`);

--
-- Indexes for table `chi_tiet_khuyen_mai`
--
ALTER TABLE `chi_tiet_khuyen_mai`
  ADD PRIMARY KEY (`ma_khuyen_mai`,`ma_sua`),
  ADD KEY `ma_sua` (`ma_sua`);

--
-- Indexes for table `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD PRIMARY KEY (`ma_danh_gia`),
  ADD KEY `ma_sua` (`ma_sua`),
  ADD KEY `ma_khach_hang` (`ma_khach_hang`);

--
-- Indexes for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`ma_don_hang`),
  ADD KEY `ma_khach_hang` (`ma_khach_hang`),
  ADD KEY `ma_khuyen_mai` (`ma_khuyen_mai`);

--
-- Indexes for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`ma_khach_hang`,`ma_sua`),
  ADD KEY `ma_sua` (`ma_sua`);

--
-- Indexes for table `hang_sua`
--
ALTER TABLE `hang_sua`
  ADD PRIMARY KEY (`ma_hang_sua`);

--
-- Indexes for table `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`ma_khach_hang`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  ADD PRIMARY KEY (`ma_khuyen_mai`);

--
-- Indexes for table `lich_su_gia`
--
ALTER TABLE `lich_su_gia`
  ADD PRIMARY KEY (`ma_sua`,`ngay_cap_nhat`);

--
-- Indexes for table `loai_sua`
--
ALTER TABLE `loai_sua`
  ADD PRIMARY KEY (`ma_loai_sua`);

--
-- Indexes for table `sua`
--
ALTER TABLE `sua`
  ADD PRIMARY KEY (`ma_sua`),
  ADD KEY `ma_hang_sua` (`ma_hang_sua`),
  ADD KEY `fk_ma_loai_sua` (`ma_loai_sua`);

--
-- Indexes for table `su_dung_khuyen_mai`
--
ALTER TABLE `su_dung_khuyen_mai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_usage` (`ma_khuyen_mai`,`ma_khach_hang`,`ma_don_hang`),
  ADD KEY `ma_khach_hang` (`ma_khach_hang`),
  ADD KEY `ma_don_hang` (`ma_don_hang`);

--
-- Indexes for table `thong_bao`
--
ALTER TABLE `thong_bao`
  ADD PRIMARY KEY (`ma_thong_bao`),
  ADD KEY `ma_khach_hang` (`ma_khach_hang`);

--
-- Indexes for table `yeu_thich`
--
ALTER TABLE `yeu_thich`
  ADD PRIMARY KEY (`ma_sua`,`ma_khach_hang`),
  ADD KEY `ma_khach_hang` (`ma_khach_hang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `danh_gia`
--
ALTER TABLE `danh_gia`
  MODIFY `ma_danh_gia` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `su_dung_khuyen_mai`
--
ALTER TABLE `su_dung_khuyen_mai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `thong_bao`
--
ALTER TABLE `thong_bao`
  MODIFY `ma_thong_bao` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_1` FOREIGN KEY (`ma_don_hang`) REFERENCES `don_hang` (`ma_don_hang`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_2` FOREIGN KEY (`ma_sua`) REFERENCES `sua` (`ma_sua`) ON DELETE CASCADE;

--
-- Constraints for table `chi_tiet_khuyen_mai`
--
ALTER TABLE `chi_tiet_khuyen_mai`
  ADD CONSTRAINT `chi_tiet_khuyen_mai_ibfk_1` FOREIGN KEY (`ma_khuyen_mai`) REFERENCES `khuyen_mai` (`ma_khuyen_mai`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_khuyen_mai_ibfk_2` FOREIGN KEY (`ma_sua`) REFERENCES `sua` (`ma_sua`) ON DELETE CASCADE;

--
-- Constraints for table `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD CONSTRAINT `danh_gia_ibfk_1` FOREIGN KEY (`ma_sua`) REFERENCES `sua` (`ma_sua`) ON DELETE CASCADE,
  ADD CONSTRAINT `danh_gia_ibfk_2` FOREIGN KEY (`ma_khach_hang`) REFERENCES `khach_hang` (`ma_khach_hang`) ON DELETE CASCADE;

--
-- Constraints for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_ibfk_1` FOREIGN KEY (`ma_khach_hang`) REFERENCES `khach_hang` (`ma_khach_hang`) ON DELETE CASCADE,
  ADD CONSTRAINT `don_hang_ibfk_2` FOREIGN KEY (`ma_khuyen_mai`) REFERENCES `khuyen_mai` (`ma_khuyen_mai`) ON DELETE SET NULL;

--
-- Constraints for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `gio_hang_ibfk_1` FOREIGN KEY (`ma_khach_hang`) REFERENCES `khach_hang` (`ma_khach_hang`) ON DELETE CASCADE,
  ADD CONSTRAINT `gio_hang_ibfk_2` FOREIGN KEY (`ma_sua`) REFERENCES `sua` (`ma_sua`) ON DELETE CASCADE;

--
-- Constraints for table `lich_su_gia`
--
ALTER TABLE `lich_su_gia`
  ADD CONSTRAINT `lich_su_gia_ibfk_1` FOREIGN KEY (`ma_sua`) REFERENCES `sua` (`ma_sua`) ON DELETE CASCADE;

--
-- Constraints for table `sua`
--
ALTER TABLE `sua`
  ADD CONSTRAINT `fk_ma_loai_sua` FOREIGN KEY (`ma_loai_sua`) REFERENCES `loai_sua` (`ma_loai_sua`) ON DELETE CASCADE,
  ADD CONSTRAINT `sua_ibfk_1` FOREIGN KEY (`ma_hang_sua`) REFERENCES `hang_sua` (`ma_hang_sua`) ON DELETE CASCADE;

--
-- Constraints for table `su_dung_khuyen_mai`
--
ALTER TABLE `su_dung_khuyen_mai`
  ADD CONSTRAINT `su_dung_khuyen_mai_ibfk_1` FOREIGN KEY (`ma_khuyen_mai`) REFERENCES `khuyen_mai` (`ma_khuyen_mai`) ON DELETE CASCADE,
  ADD CONSTRAINT `su_dung_khuyen_mai_ibfk_2` FOREIGN KEY (`ma_khach_hang`) REFERENCES `khach_hang` (`ma_khach_hang`) ON DELETE CASCADE,
  ADD CONSTRAINT `su_dung_khuyen_mai_ibfk_3` FOREIGN KEY (`ma_don_hang`) REFERENCES `don_hang` (`ma_don_hang`) ON DELETE CASCADE;

--
-- Constraints for table `thong_bao`
--
ALTER TABLE `thong_bao`
  ADD CONSTRAINT `thong_bao_ibfk_1` FOREIGN KEY (`ma_khach_hang`) REFERENCES `khach_hang` (`ma_khach_hang`) ON DELETE CASCADE;

--
-- Constraints for table `yeu_thich`
--
ALTER TABLE `yeu_thich`
  ADD CONSTRAINT `yeu_thich_ibfk_1` FOREIGN KEY (`ma_sua`) REFERENCES `sua` (`ma_sua`) ON DELETE CASCADE,
  ADD CONSTRAINT `yeu_thich_ibfk_2` FOREIGN KEY (`ma_khach_hang`) REFERENCES `khach_hang` (`ma_khach_hang`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
