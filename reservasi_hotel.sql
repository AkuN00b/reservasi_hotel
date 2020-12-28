-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 20-12-28 19:03
-- 서버 버전: 10.4.11-MariaDB
-- PHP 버전: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `reservasi_hotel`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `bed`
--

CREATE TABLE `bed` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bed_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `bed`
--

INSERT INTO `bed` (`id`, `name`, `slug`, `person`, `user_id`, `bed_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Single', 'single', 1, 4, NULL, 1, '2020-09-03 09:55:00', '2020-09-24 09:29:58'),
(2, 'Double', 'double', 2, 4, NULL, 1, '2020-09-03 09:56:28', '2020-09-10 02:30:39'),
(3, 'Main Family', 'main-family', 5, 4, NULL, 1, '2020-09-03 09:58:49', '2020-09-10 02:30:43'),
(4, 'Extended Family', 'extended-family', 10, 5, NULL, 1, '2020-09-03 09:59:38', '2020-12-09 06:08:46'),
(34, 'bed 1', 'Create Req.', 1, 5, 33, 2, '2020-12-10 20:06:14', '2020-12-10 20:06:14'),
(35, 'bed 2', 'Create Req.', 2, 5, NULL, 9, '2020-12-10 20:07:43', '2020-12-10 20:07:55'),
(36, 'bed 12', 'Edit Req.', 1, 5, 33, 2, '2020-12-10 20:09:37', '2020-12-10 20:09:50'),
(37, 'bed 123', 'Edit Req.', 1, 5, 33, 9, '2020-12-10 20:10:31', '2020-12-10 20:10:44'),
(38, 'Extended Family', 'Delete Req.', 10, 5, 4, 9, '2020-12-10 20:11:04', '2020-12-10 20:11:20'),
(39, 'bed 12', 'Delete Req.', 1, 5, 33, 2, '2020-12-10 20:11:30', '2020-12-10 20:11:39'),
(41, 'Extended Family 99', 'extended-family-99', 10, 5, 4, 0, '2020-12-10 20:17:24', '2020-12-10 20:17:24'),
(42, 'Extended Family', 'Delete Req.', 10, 5, 4, 9, '2020-12-10 20:17:31', '2020-12-11 06:39:59'),
(43, 'bed 99', 'Create Req.', 99, 5, 40, 2, '2020-12-10 20:59:41', '2020-12-10 20:59:41'),
(44, 'www', 'www', 123, 5, NULL, 0, '2020-12-15 20:56:09', '2020-12-15 20:56:09'),
(45, 'bed 99', '0', 99, 5, 40, 0, '2020-12-15 20:56:26', '2020-12-15 20:56:26');

-- --------------------------------------------------------

--
-- 테이블 구조 `booking`
--

CREATE TABLE `booking` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_identitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_awal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_akhir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bed_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_number_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `role_id`, `name`, `email`, `identitas`, `no_identitas`, `alamat`, `jenis_kelamin`, `tgl_awal`, `tgl_akhir`, `bed_id`, `class_id`, `room_id`, `room_number_id`, `image`, `status`, `transaction_id`, `created_at`, `updated_at`) VALUES
(21, 6, 3, 'Customer Hotel', 'customerhotel@gmail.com', 'Passport', '298219838387789', 'Tajur Halang, Bogor', 'Laki-laki', '2020-12-02', '2020-12-22', 1, 2, 6, '14', '2020-11-30-5fc46bef29879.jpg', 4, '80481864734', '2020-11-29 20:46:45', '2020-11-29 21:02:15'),
(22, 4, 1, 'qwertyui', 'qwertyu@mail.co', 'KTP', '23456756453', 'Bogor', 'Perempuan', '2020-12-03', '2020-12-15', 4, 4, 13, '33', NULL, 4, '-', '2020-11-30 17:52:40', '2020-11-30 18:09:55'),
(23, 6, 3, 'Customer Hotel', 'customerhotel@gmail.com', 'Passport', '298219838387789', 'Tajur Halang, Bogor', 'Laki-laki', '2020-12-02', '2020-12-09', 4, 4, 13, '33', '2020-12-02-5fc6f511bf489.jpg', 4, '31396237682', '2020-11-30 18:27:54', '2020-12-01 19:02:48'),
(24, 6, 3, 'Customer Hotel', 'customerhotel@gmail.com', 'Passport', '298219838387789', 'Tajur Halang, Bogor', 'Laki-laki', '2020-12-05', '2020-12-13', 2, 1, 3, '12', '2020-12-04-5fc9ffec2e897.jpg', 4, '24071612356', '2020-12-02 20:12:22', '2020-12-04 02:27:07'),
(25, 5, 2, 'cacang', 'cacang@mail.id', 'Passport', '23904239083240', 'Bunga Mawar No. 99', 'Perempuan', '2020-12-06', '2020-12-22', 3, 4, 12, '32', NULL, 4, '-', '2020-12-04 02:14:50', '2020-12-04 02:16:41'),
(26, 5, 2, 'dudung', 'dudung@jkt.id', 'KTP', '23984932093', 'Gajah Mungkur No. 291', 'Laki-laki', '2020-12-05', '2020-12-23', 3, 4, 12, '31', NULL, 4, '-', '2020-12-04 02:17:59', '2020-12-04 02:18:15'),
(27, 6, 3, 'Customer Hotel', 'customerhotel@gmail.com', 'Passport', '298219838387789', 'Tajur Halang, Bogor', 'Laki-laki', '2020-12-17', '2021-01-06', 2, 1, 3, '11', '2020-12-16-5fd9d6ffb9120.jpg', 4, '92043779989', '2020-12-16 02:31:17', '2020-12-16 02:51:26'),
(28, 4, 1, 'aslwke', 'df@mfa.co', 'SIM', '4567890987654', 'Jalan Melati Nomor 7', 'Laki-laki', '2020-12-18', '2020-12-20', 3, 4, 12, '31', NULL, 4, '-', '2020-12-16 02:52:52', '2020-12-16 02:54:22');

-- --------------------------------------------------------

--
-- 테이블 구조 `class`
--

CREATE TABLE `class` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_image_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `class`
--

INSERT INTO `class` (`id`, `name`, `slug`, `desc`, `image`, `user_id`, `user_image_id`, `class_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Standard', 'standard', '<p><span style=\"color: #000000; font-family: tahoma, arial, helvetica, sans-serif; font-size: 12pt;\">Standard Class merupakan kelas yang berfasilitas standar dan dengan harga sewa yang murah, walau begitu kelas standar ini tidak kalah dengan kelas yang diatasnya. Standard Class memiliki dua pilihan kamar yaitu Single (1 Orang) dan Double (2 Orang). </span></p>\r\n<p><span style=\"color: #000000; font-family: tahoma, arial, helvetica, sans-serif; font-size: 12pt;\">Ini dia fasilitas dari kamar ini:</span></p>', 'standard-2020-09-24-5f6ccd6423aac.jpg', 4, NULL, NULL, 1, '2020-09-05 09:27:54', '2020-11-09 02:31:53'),
(2, 'Superior', 'superior', '<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Superior Class merupakan kelas yang berfasilitas diatas standar dan dengan harga sewa yang murah, walau begitu kelas superior ini tidak kalah dengan kelas yang diatasnya. Superior Class memiliki dua pilihan kamar yaitu Single (1 Orang) dan Double (2 Orang). </span></p>\r\n<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Ini dia fasilitas dari kamar ini:</span></p>', 'superior-2020-09-24-5f6ccd812f2a3.jpg', 4, NULL, NULL, 1, '2020-09-05 09:28:10', '2020-10-02 11:49:08'),
(3, 'Deluxe', 'deluxe', '<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Deluxe Class merupakan kelas yang berfasilitas hampir memasuki ekslusif&nbsp;dan dengan harga sewa yang terjangkau, walau begitu kelas Deluxe&nbsp;ini tidak kalah dengan kelas yang diatasnya. Deluxe Class memiliki dua pilihan kamar yaitu Single (1 Orang) dan Double (2 Orang). </span></p>\r\n<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Ini dia fasilitas dari kamar ini:</span></p>', 'deluxe-2020-09-24-5f6ccd8d00bf4.jpg', 4, NULL, NULL, 1, '2020-09-05 09:28:21', '2020-10-02 11:49:57'),
(4, 'Suite', 'suite', '<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Suite Class merupakan kelas yang berfasilitas eksklusif dan dengan harga sewa yang tinggi, walau kelas suite&nbsp;ini begitu mahal anda&nbsp;akan dibayar dengan fasilitas ekslusif dari kami sehingga anda tidak perlu khawatir. Suite Class memiliki empat pilihan kamar yaitu Single (1 Orang),&nbsp; Double (2 Orang), Main Family (5 Orang) dan Extended Family (10 Orang). </span></p>\r\n<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Ini dia fasilitas dari kamar ini:</span></p>', 'suite-2020-09-24-5f6ccd9ba93f0.jpg', 4, NULL, NULL, 1, '2020-09-05 09:28:30', '2020-10-02 11:51:28'),
(5, 'Presidential Suite', 'presidential-suite', '<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Presidential Suite Class merupakan kelas yang berfasilitas eksklusif dan tertinggi di hotel ini dengan harga sewa yang tinggi, walau kelas presidential suite ini begitu mahal anda&nbsp;akan dibayar dengan fasilitas ekslusif dan terbaik dari kami sehingga anda tidak perlu khawatir. Presidential Suite Class memiliki empat pilihan kamar yaitu Single (1 Orang),&nbsp; Double (2 Orang), Main Family (5 Orang) dan Extended Family (10 Orang). </span></p>\r\n<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Ini dia fasilitas dari kamar ini:</span></p>', 'presidential-suite-2020-12-22-5fe210eaa4e84.jpg', 4, 4, NULL, 1, '2020-09-05 09:28:55', '2020-12-22 08:29:46'),
(56, 'dfvvdf', 'Create Req.', '<p>dfvdfdf</p>', 'dfvvdf-2020-12-23-5fe33b50f18ae.jpg', 5, NULL, NULL, 9, '2020-12-23 05:42:57', '2020-12-23 05:46:31'),
(58, 'cesdcdscd', 'Create Req.', '<p>sdsdsscdsc</p>', 'cesdcdscd-2020-12-23-5fe33c5909e49.jpg', 5, NULL, 57, 2, '2020-12-23 05:47:40', '2020-12-23 05:47:40'),
(59, 'class tess editttt', 'class-tess-editttt', '<p>class tess editttttttt</p>', 'class-tess-2020-12-23-5fe33ee217aff.jpg', 5, 5, NULL, 1, '2020-12-23 05:48:26', '2020-12-23 06:00:42'),
(60, 'class tess', 'Create Req.', '<p>class tess</p>', 'class-tess-2020-12-23-5fe33c99ac8d9.jpg', 5, NULL, 59, 2, '2020-12-23 05:48:41', '2020-12-23 05:48:41'),
(61, 'class tess', '99', '<p>class tess</p>', 'class-tess-2020-12-23-5fe33d525cbd0.jpg', NULL, 5, 59, 9, '2020-12-23 05:51:30', '2020-12-23 05:53:08'),
(62, 'class tess', '99', '<p>class tess</p>', 'class-tess-2020-12-23-5fe33dcb5569e.jpg', NULL, 5, 59, 2, '2020-12-23 05:53:31', '2020-12-23 05:54:25'),
(63, 'class tess', '99', '<p>class tess</p>', 'class-tess-2020-12-23-5fe33e9f62940.jpg', NULL, 5, 59, 9, '2020-12-23 05:57:06', '2020-12-23 05:57:42'),
(64, 'class tess', '99', '<p>class tess</p>', 'class-tess-2020-12-23-5fe33ee217aff.jpg', NULL, 5, 59, 2, '2020-12-23 05:58:13', '2020-12-23 05:58:29'),
(65, 'class tess editttt', 'Edit Req.', '<p>class tess editttttttt</p>', NULL, 5, NULL, 59, 2, '2020-12-23 06:00:09', '2020-12-23 06:00:42'),
(66, 'class tess', 'Delete Req.', '<p>class tess</p>', NULL, 5, NULL, 59, 9, '2020-12-23 06:00:15', '2020-12-23 06:00:36');

-- --------------------------------------------------------

--
-- 테이블 구조 `dynamic_data`
--

CREATE TABLE `dynamic_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `dynamic_data`
--

INSERT INTO `dynamic_data` (`id`, `value`, `section`, `created_at`, `updated_at`) VALUES
(1, '(+62) 8000 - 123', 'Reservation', '2020-11-03 08:03:25', '2020-11-06 12:21:32'),
(2, 'reservasi.hotel@gmail.com', 'Reservation', '2020-11-03 08:04:21', '2020-11-06 12:21:43'),
(5, '406, Mawar Street, Bogor,', 'Address', '2020-11-07 10:01:08', '2020-11-07 10:07:06'),
(6, 'West Java, ID', 'Address', '2020-11-07 10:01:36', '2020-11-07 10:01:42');

-- --------------------------------------------------------

--
-- 테이블 구조 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_08_24_060227_create_roles_table', 1),
(4, '2020_09_03_072541_create_bed_table', 2),
(6, '2020_09_05_155715_create_classes_table', 3),
(7, '2020_09_07_160233_create_rooms_table', 4),
(8, '2020_09_10_092009_add_slug_to_roles_table', 5),
(9, '2020_09_10_092128_add_slug_to_class_table', 5),
(10, '2020_09_10_092209_add_slug_to_bed_table', 5),
(11, '2020_09_24_152304_add_image_and_desc_to_class_table', 6),
(12, '2020_10_31_044640_create_booking_table', 7),
(13, '2020_11_03_143506_create_dynamic_data_table', 8),
(14, '2020_11_13_215902_add_image_to_booking_table', 9),
(15, '2020_11_13_220233_add_status_to_booking_table', 10),
(16, '2020_11_15_185506_create_room_number_table', 11),
(17, '2020_11_17_055148_add_name_to_room_number_table', 12),
(18, '2020_11_20_073227_add_role_id_to_booking_table', 13),
(19, '2020_11_24_110505_add_fill_in_booking_table', 14),
(20, '2020_11_24_123450_add_fill_date_in_booking_table', 15),
(21, '2020_11_25_102858_add_transaction_id_in_booking_table', 16),
(22, '2020_11_26_045729_add_room_number_id_to_booking_table', 17),
(23, '2020_12_04_093311_add_fill_to_bed_table', 18),
(24, '2020_12_04_093443_add_fill_to_class_table', 18),
(25, '2020_12_04_093606_add_fill_to_room_table', 18),
(26, '2020_12_22_140653_add_user_image_id_to_class_table', 19);

-- --------------------------------------------------------

--
-- 테이블 구조 `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', NULL, NULL),
(2, 'Receptionist', 'receptionist', NULL, NULL),
(3, 'Customer', 'customer', NULL, NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `room`
--

CREATE TABLE `room` (
  `id` int(10) UNSIGNED NOT NULL,
  `class_id` int(11) NOT NULL,
  `bed_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `room`
--

INSERT INTO `room` (`id`, `class_id`, `bed_id`, `price`, `user_id`, `room_id`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1000000, 4, NULL, NULL, 1, '2020-09-07 09:37:48', '2020-09-09 09:52:17'),
(3, 1, 2, 1200000, 4, NULL, NULL, 1, '2020-09-09 09:51:31', '2020-09-09 09:52:41'),
(6, 2, 1, 1600000, 4, NULL, NULL, 1, '2020-09-24 22:33:16', '2020-09-24 22:33:27'),
(7, 2, 2, 2000000, 4, NULL, NULL, 1, '2020-09-24 22:33:41', '2020-09-24 22:33:41'),
(8, 3, 1, 2100000, 4, NULL, NULL, 1, '2020-09-24 22:33:53', '2020-09-24 22:33:53'),
(9, 3, 2, 2500000, 4, NULL, NULL, 1, '2020-09-24 22:34:03', '2020-09-24 22:34:03'),
(10, 4, 1, 3400000, 4, NULL, NULL, 1, '2020-09-24 22:34:19', '2020-09-24 22:34:19'),
(11, 4, 2, 3800000, 4, NULL, NULL, 1, '2020-09-24 22:34:40', '2020-09-24 22:34:40'),
(12, 4, 3, 4400000, 4, NULL, NULL, 1, '2020-09-24 22:34:54', '2020-09-24 22:34:54'),
(13, 4, 4, 5000000, 4, NULL, NULL, 1, '2020-09-24 22:35:08', '2020-09-24 22:35:08'),
(14, 5, 1, 4300000, 4, NULL, NULL, 1, '2020-09-24 22:35:22', '2020-09-24 22:35:22'),
(15, 5, 2, 4900000, 4, NULL, NULL, 1, '2020-09-24 22:35:33', '2020-09-24 22:35:33'),
(16, 5, 3, 5700000, 4, NULL, NULL, 1, '2020-09-24 22:35:49', '2020-09-24 22:35:49'),
(17, 5, 4, 6600000, 5, NULL, NULL, 1, '2020-09-24 22:36:08', '2020-12-28 00:36:01'),
(22, 1, 1, 1000000, 5, 1, 'Delete Req.', 9, '2020-12-28 00:11:01', '2020-12-28 00:19:38'),
(23, 1, 1, 1000000, 5, 1, 'Delete Req.', 9, '2020-12-28 00:12:24', '2020-12-28 00:19:46'),
(27, 5, 4, 6600000, 5, 17, 'Edit Req.', 2, '2020-12-28 00:35:22', '2020-12-28 00:36:01'),
(28, 59, 2, 100000, 5, 24, 'Create Req.', 2, '2020-12-28 00:35:47', '2020-12-28 00:35:47'),
(29, 59, 2, 100000, 5, 24, 'Delete Req.', 2, '2020-12-28 00:37:55', '2020-12-28 00:38:48'),
(30, 2, 4, 6600000, 5, 17, 'Edit Req.', 9, '2020-12-28 00:39:42', '2020-12-28 00:40:24'),
(31, 1, 3, 14499000, 5, NULL, 'Create Req.', 9, '2020-12-28 00:39:58', '2020-12-28 00:40:30');

-- --------------------------------------------------------

--
-- 테이블 구조 `room_number`
--

CREATE TABLE `room_number` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `room_number`
--

INSERT INTO `room_number` (`id`, `name`, `room_id`, `status`, `created_at`, `updated_at`) VALUES
(4, '101', 1, 1, '2020-11-16 22:54:13', '2020-11-16 22:54:13'),
(7, '102', 1, 1, '2020-11-16 22:59:10', '2020-11-16 22:59:10'),
(8, '103', 1, 1, '2020-11-16 23:06:17', '2020-11-16 23:06:17'),
(9, '104', 1, 1, '2020-11-16 23:06:28', '2020-11-16 23:06:28'),
(10, '105', 3, 1, '2020-11-16 23:06:40', '2020-11-16 23:06:40'),
(11, '106', 3, 1, '2020-11-16 23:07:03', '2020-12-16 02:51:26'),
(12, '107', 3, 1, '2020-11-16 23:07:30', '2020-12-04 02:27:07'),
(13, '201', 6, 1, '2020-11-16 23:08:16', '2020-11-25 23:19:08'),
(14, '202', 6, 1, '2020-11-16 23:08:29', '2020-11-29 21:02:15'),
(15, '203', 6, 1, '2020-11-16 23:08:43', '2020-11-16 23:08:43'),
(16, '204', 6, 1, '2020-11-16 23:17:09', '2020-11-16 23:17:09'),
(17, '205', 7, 1, '2020-11-16 23:19:22', '2020-11-16 23:19:22'),
(18, '206', 7, 1, '2020-11-16 23:19:33', '2020-11-16 23:19:33'),
(19, '207', 7, 1, '2020-11-16 23:19:54', '2020-11-16 23:19:54'),
(20, '301', 8, 1, '2020-11-16 23:20:47', '2020-11-16 23:20:47'),
(21, '302', 8, 1, '2020-11-16 23:20:57', '2020-11-16 23:20:57'),
(22, '303', 8, 1, '2020-11-16 23:21:07', '2020-11-16 23:21:07'),
(23, '304', 8, 1, '2020-11-16 23:21:16', '2020-11-16 23:21:16'),
(24, '305', 9, 1, '2020-11-16 23:21:27', '2020-11-16 23:21:27'),
(25, '306', 9, 1, '2020-11-16 23:21:36', '2020-11-29 19:33:10'),
(26, '307', 9, 1, '2020-11-16 23:21:45', '2020-11-16 23:21:45'),
(27, '401', 10, 1, '2020-11-17 08:06:05', '2020-11-17 08:06:05'),
(28, '402', 10, 1, '2020-11-17 08:06:33', '2020-11-17 08:06:33'),
(29, '403', 11, 1, '2020-11-17 08:06:44', '2020-11-17 08:06:44'),
(30, '404', 11, 1, '2020-11-17 08:06:57', '2020-11-17 08:06:57'),
(31, '405', 12, 1, '2020-11-17 08:07:17', '2020-12-16 02:54:22'),
(32, '406', 12, 1, '2020-11-17 08:07:30', '2020-12-04 02:16:41'),
(33, '407', 13, 1, '2020-11-17 08:07:42', '2020-12-01 19:02:48'),
(34, '501', 14, 1, '2020-11-17 08:07:59', '2020-11-17 08:07:59'),
(35, '502', 14, 1, '2020-11-17 08:08:12', '2020-11-17 08:08:12'),
(36, '503', 15, 1, '2020-11-17 08:08:57', '2020-11-17 08:08:57'),
(37, '504', 15, 1, '2020-11-17 08:09:05', '2020-11-17 08:09:05'),
(38, '505', 16, 1, '2020-11-17 08:09:20', '2020-11-17 08:09:20'),
(39, '506', 16, 1, '2020-11-17 08:09:30', '2020-11-17 08:09:30'),
(40, '507', 17, 1, '2020-11-17 08:09:44', '2020-11-17 08:09:44');

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `no_identitas` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 3,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `about` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `users`
--

INSERT INTO `users` (`id`, `name`, `identitas`, `no_identitas`, `alamat`, `jenis_kelamin`, `username`, `email`, `password`, `role_id`, `image`, `about`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Admin Hotel', 'KTP', '123456756438912', 'Gunung Putri, Bogor', 'Laki-laki', 'adminhotel11', 'adminhotel@gmail.com', '$2y$10$uGxQDhccrfJmLM7QjwFS9OVcvWjERYW73XDr8drNrwBTc6hPFIoAe', 1, 'default.png', 'Aku adalah Admin ke 1', 'zArMitnC7WZsNNH84DvcIekW7QTS1dLzUaE7U48DukVMxEe2AiIAxt4UxnBt', NULL, '2020-11-06 10:30:48'),
(5, 'Receptionist Hotel', 'SIM', '92897423909237', 'Bojong Gede, Bogor', 'Perempuan', 'receptionisthotel22', 'receptionisthotel@gmail.com', '$2y$10$jcp09ZY2uzVlTeV09nEeheQuhndhQ1DVLWnkuPF7D33w6vFzTHoY6', 2, 'default.png', 'Aku adalah Receptionist ke 1', 'iEPvbD0ZBwsU7NGp0JCcVDYYNUUiFybuGumIEC1MLPNrG142G7uaKaT4olgt', NULL, '2020-11-06 10:47:26'),
(6, 'Customer Hotel', 'Passport', '298219838387789', 'Tajur Halang, Bogor', 'Laki-laki', 'customerhotel33', 'customerhotel@gmail.com', '$2y$10$kMgfpI6cvnEFDeW4VN/HL.UCMDCeG4zn6P9gEh2/HZ0o8.O31.Obm', 3, 'default.png', 'Aku adalah Customer ke 1', 'RWWeEgCHRHr4XECAU50QqBtzjlal0QRX57tlt1xSpfAoHItVXBbUxHfpVsYU', NULL, '2020-11-06 10:55:35'),
(8, 'Budi', 'KTP', '32948329843298', 'Jogja', 'Laki-laki', 'password_user', 'budi@mail.com', '$2y$10$EbETlWz8WlyMaWfa3e8CHuK8ZDUCTh7XXPonj/eYy5yeZ4WgQyN0a', 3, 'default.png', 'Aku adalah Customer ke 2', NULL, '2020-11-13 16:45:46', '2020-11-13 18:24:04'),
(9, 'Abdi Hasan', 'SIM', '239832894732', 'Ciampea, Jawa Barat', 'Laki-laki', 'hasan.abdi', 'hasan.abdi@yahoo.com', '$2y$10$p3bp9LqZZFzL.E3CRZFZ8ef/NEYof3hlRU4bjchqU..ncLAXeCMoe', 2, 'default.png', 'Aku adalah Receptionist ke 2', 'zrfISi3vuS6fJqvBudzMnf1Krfgl5FBrjSZTaoiaXc5OuWea4rlx3Jv1Figd', '2020-11-13 16:49:08', '2020-11-13 18:30:19');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `bed`
--
ALTER TABLE `bed`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `dynamic_data`
--
ALTER TABLE `dynamic_data`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- 테이블의 인덱스 `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `room_number`
--
ALTER TABLE `room_number`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_number_name_unique` (`name`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_no_identitas_unique` (`no_identitas`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `bed`
--
ALTER TABLE `bed`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- 테이블의 AUTO_INCREMENT `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- 테이블의 AUTO_INCREMENT `class`
--
ALTER TABLE `class`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- 테이블의 AUTO_INCREMENT `dynamic_data`
--
ALTER TABLE `dynamic_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 테이블의 AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- 테이블의 AUTO_INCREMENT `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 테이블의 AUTO_INCREMENT `room`
--
ALTER TABLE `room`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- 테이블의 AUTO_INCREMENT `room_number`
--
ALTER TABLE `room_number`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
