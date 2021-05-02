-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- 생성 시간: 21-05-02 11:17
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
  `durasi` int(11) NOT NULL,
  `total` int(25) NOT NULL,
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

INSERT INTO `booking` (`id`, `user_id`, `role_id`, `name`, `email`, `identitas`, `no_identitas`, `alamat`, `jenis_kelamin`, `tgl_awal`, `tgl_akhir`, `durasi`, `total`, `bed_id`, `class_id`, `room_id`, `room_number_id`, `image`, `status`, `transaction_id`, `created_at`, `updated_at`) VALUES
(29, 4, 1, 'Gerlando Corputty', 'lele@blog.com', 'SIM', '1234567564389', 'Bogor', 'Laki-laki', '2021-01-19', '2021-01-21', 2, 4000000, 2, 2, 7, '18', NULL, 4, '-', '2021-01-18 04:35:12', '2021-01-18 04:43:39'),
(30, 5, 2, 'Budi', 'budi@mail.com', 'KTP', '23456543212332', 'Jalan Melati Nomor 7', 'Laki-laki', '2021-01-20', '2021-01-25', 5, 28500000, 3, 5, 16, '39', NULL, 4, '-', '2021-01-18 04:45:47', '2021-01-18 04:46:55'),
(32, 6, 3, 'Customer Hotel', 'customerhotel@gmail.com', 'Passport', '298219838387789', 'Tajur Halang, Bogor', 'Laki-laki', '2021-01-20', '2021-02-02', 13, 13000000, 1, 1, 1, '7', '2021-01-18-600578f1bc574.jpg', 4, '13272941874', '2021-01-18 04:58:35', '2021-01-18 05:04:26'),
(33, 6, 3, 'Customer Hotel', 'customerhotel@gmail.com', 'Passport', '298219838387789', 'Tajur Halang, Bogor', 'Laki-laki', '2021-04-13', '2021-04-15', 2, 4200000, 1, 3, 8, '20', '2021-04-11-6072cdc015f39.jpg', 4, '39673006129', '2021-04-11 10:04:49', '2021-04-11 10:24:52');

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
(1, 'Standard', 'standard', '<p><span style=\"color: #000000; font-family: tahoma, arial, helvetica, sans-serif; font-size: 12pt;\">Standard Class merupakan kelas yang berfasilitas standar dan dengan harga sewa yang murah, walau begitu kelas standar ini tidak kalah dengan kelas yang diatasnya. Standard Class memiliki dua pilihan kamar yaitu Single (1 Orang) dan Double (2 Orang). </span></p>', 'standard-2020-09-24-5f6ccd6423aac.jpg', 4, NULL, NULL, 1, '2020-09-05 09:27:54', '2021-04-11 09:38:27'),
(2, 'Superior', 'superior', '<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Superior Class merupakan kelas yang berfasilitas diatas standar dan dengan harga sewa yang murah, walau begitu kelas superior ini tidak kalah dengan kelas yang diatasnya. Superior Class memiliki dua pilihan kamar yaitu Single (1 Orang) dan Double (2 Orang). </span></p>', 'superior-2020-09-24-5f6ccd812f2a3.jpg', 4, NULL, NULL, 1, '2020-09-05 09:28:10', '2021-04-11 09:38:42'),
(3, 'Deluxe', 'deluxe', '<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Deluxe Class merupakan kelas yang berfasilitas hampir memasuki ekslusif&nbsp;dan dengan harga sewa yang terjangkau, walau begitu kelas Deluxe&nbsp;ini tidak kalah dengan kelas yang diatasnya. Deluxe Class memiliki dua pilihan kamar yaitu Single (1 Orang) dan Double (2 Orang). </span></p>', 'deluxe-2020-09-24-5f6ccd8d00bf4.jpg', 4, NULL, NULL, 1, '2020-09-05 09:28:21', '2021-04-11 09:38:54'),
(4, 'Suite', 'suite', '<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Suite Class merupakan kelas yang berfasilitas eksklusif dan dengan harga sewa yang tinggi, walau kelas suite&nbsp;ini begitu mahal anda&nbsp;akan dibayar dengan fasilitas ekslusif dari kami sehingga anda tidak perlu khawatir. Suite Class memiliki empat pilihan kamar yaitu Single (1 Orang),&nbsp; Double (2 Orang), Main Family (5 Orang) dan Extended Family (10 Orang). </span></p>', 'suite-2020-09-24-5f6ccd9ba93f0.jpg', 4, NULL, NULL, 1, '2020-09-05 09:28:30', '2021-04-11 09:39:05'),
(5, 'Presidential Suite', 'presidential-suite', '<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Presidential Suite Class merupakan kelas yang berfasilitas eksklusif dan tertinggi di hotel ini dengan harga sewa yang tinggi, walau kelas presidential suite ini begitu mahal anda&nbsp;akan dibayar dengan fasilitas ekslusif dan terbaik dari kami sehingga anda tidak perlu khawatir. Presidential Suite Class memiliki empat pilihan kamar yaitu Single (1 Orang),&nbsp; Double (2 Orang), Main Family (5 Orang) dan Extended Family (10 Orang). </span></p>', 'presidential-suite-2020-12-22-5fe210eaa4e84.jpg', 4, 4, NULL, 1, '2020-09-05 09:28:55', '2021-04-11 09:39:15'),
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
(26, '2020_12_22_140653_add_user_image_id_to_class_table', 19),
(27, '2021_01_04_090822_add_fill_in_room_number_table', 20),
(28, '2021_01_04_091049_add_fill_in_user_table', 21),
(29, '2021_01_18_105303_add_durasi_and_total_to_booking_table', 22);

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
(31, 1, 3, 14499000, 5, NULL, 'Create Req.', 9, '2020-12-28 00:39:58', '2020-12-28 00:40:30'),
(32, 2, 2, 14499000, 4, NULL, NULL, 1, '2021-01-23 09:02:41', '2021-01-23 09:02:41'),
(33, 1, 4, 12999000, 4, NULL, NULL, 1, '2021-04-11 11:29:04', '2021-04-11 11:29:04');

-- --------------------------------------------------------

--
-- 테이블 구조 `room_number`
--

CREATE TABLE `room_number` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `room_number_id` int(11) DEFAULT NULL,
  `req_status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `room_number`
--

INSERT INTO `room_number` (`id`, `name`, `room_id`, `status`, `user_id`, `room_number_id`, `req_status`, `created_at`, `updated_at`) VALUES
(4, '101', 1, '1', 4, NULL, 1, '2020-11-16 22:54:13', '2021-01-27 13:35:37'),
(7, '102', 1, '1', 4, NULL, 1, '2020-11-16 22:59:10', '2021-01-18 05:04:26'),
(8, '103', 1, '1', 4, NULL, 1, '2020-11-16 23:06:17', '2020-11-16 23:06:17'),
(9, '104', 1, '1', 4, NULL, 1, '2020-11-16 23:06:28', '2020-11-16 23:06:28'),
(10, '105', 3, '1', 4, NULL, 1, '2020-11-16 23:06:40', '2020-11-16 23:06:40'),
(11, '106', 3, '1', 4, NULL, 1, '2020-11-16 23:07:03', '2021-01-09 00:25:05'),
(12, '107', 3, '1', 4, NULL, 1, '2020-11-16 23:07:30', '2020-12-04 02:27:07'),
(13, '201', 6, '1', 4, NULL, 1, '2020-11-16 23:08:16', '2020-11-25 23:19:08'),
(14, '202', 6, '1', 4, NULL, 1, '2020-11-16 23:08:29', '2021-01-08 08:49:51'),
(15, '203', 6, '1', 4, NULL, 1, '2020-11-16 23:08:43', '2021-01-08 08:49:56'),
(16, '204', 6, '1', 4, NULL, 1, '2020-11-16 23:17:09', '2020-11-16 23:17:09'),
(17, '205', 7, '1', 4, NULL, 1, '2020-11-16 23:19:22', '2020-11-16 23:19:22'),
(18, '206', 7, '1', 4, NULL, 1, '2020-11-16 23:19:33', '2021-01-18 04:43:39'),
(19, '207', 7, '1', 4, NULL, 1, '2020-11-16 23:19:54', '2020-11-16 23:19:54'),
(20, '301', 8, '1', 4, NULL, 1, '2020-11-16 23:20:47', '2021-04-11 10:24:52'),
(21, '302', 8, '1', 4, NULL, 1, '2020-11-16 23:20:57', '2020-11-16 23:20:57'),
(22, '303', 8, '1', 4, NULL, 1, '2020-11-16 23:21:07', '2020-11-16 23:21:07'),
(23, '304', 8, '1', 4, NULL, 1, '2020-11-16 23:21:16', '2020-11-16 23:21:16'),
(24, '305', 9, '1', 4, NULL, 1, '2020-11-16 23:21:27', '2020-11-16 23:21:27'),
(25, '306', 9, '1', 4, NULL, 1, '2020-11-16 23:21:36', '2020-11-29 19:33:10'),
(26, '307', 9, '1', 4, NULL, 1, '2020-11-16 23:21:45', '2020-11-16 23:21:45'),
(27, '401', 10, '1', 4, NULL, 1, '2020-11-17 08:06:05', '2020-11-17 08:06:05'),
(28, '402', 10, '1', 4, NULL, 1, '2020-11-17 08:06:33', '2020-11-17 08:06:33'),
(29, '403', 11, '1', 4, NULL, 1, '2020-11-17 08:06:44', '2020-11-17 08:06:44'),
(30, '404', 11, '1', 4, NULL, 1, '2020-11-17 08:06:57', '2020-11-17 08:06:57'),
(31, '405', 12, '1', 4, NULL, 1, '2020-11-17 08:07:17', '2020-12-16 02:54:22'),
(32, '406', 12, '1', 4, NULL, 1, '2020-11-17 08:07:30', '2020-12-04 02:16:41'),
(33, '407', 13, '1', 4, NULL, 1, '2020-11-17 08:07:42', '2020-12-01 19:02:48'),
(34, '501', 14, '1', 4, NULL, 1, '2020-11-17 08:07:59', '2020-11-17 08:07:59'),
(35, '502', 14, '1', 4, NULL, 1, '2020-11-17 08:08:12', '2020-11-17 08:08:12'),
(36, '503', 15, '1', 4, NULL, 1, '2020-11-17 08:08:57', '2020-11-17 08:08:57'),
(37, '504', 15, '1', 4, NULL, 1, '2020-11-17 08:09:05', '2020-11-17 08:09:05'),
(38, '505', 16, '1', 4, NULL, 1, '2020-11-17 08:09:20', '2020-11-17 08:09:20'),
(39, '506', 16, '1', 4, NULL, 1, '2020-11-17 08:09:30', '2021-01-18 04:46:55'),
(40, '507', 17, '1', 4, NULL, 1, '2020-11-17 08:09:44', '2021-01-09 22:30:37'),
(76, '1011-r', 14, 'Create Req.', 5, NULL, 9, '2021-01-07 21:52:55', '2021-01-07 21:55:32'),
(78, '2022-r', 13, 'Create Req.', 5, 77, 2, '2021-01-07 21:55:38', '2021-01-07 21:55:38'),
(79, '2022-r', 13, 'Edit Req.', 5, 77, 2, '2021-01-07 22:31:23', '2021-01-07 22:32:55'),
(80, '20221-r', 15, 'Edit Req.', 5, 77, 2, '2021-01-07 22:31:48', '2021-01-07 22:33:39'),
(81, '20224-r', 13, 'Edit Req.', 5, 77, 2, '2021-01-07 22:32:28', '2021-01-07 22:33:46'),
(82, '2022-r', 16, 'Edit Req.', 5, 77, 2, '2021-01-07 22:32:35', '2021-01-07 22:33:13'),
(83, '20224-r', 17, 'Edit Req.', 5, 77, 9, '2021-01-07 22:34:01', '2021-01-07 22:34:23'),
(84, '333-r', 8, 'Edit Req.', 5, 77, 9, '2021-01-07 22:34:12', '2021-01-07 22:34:28'),
(85, '20224-r', 13, 'Delete Req.', 5, 77, 2, '2021-01-07 22:35:21', '2021-01-07 22:36:02'),
(86, '20224-r', 13, 'Delete Req.', 5, 77, 9, '2021-01-07 22:35:33', '2021-01-07 22:35:51'),
(88, '333-r', 15, 'Create Req.', 5, 87, 2, '2021-01-08 08:50:20', '2021-01-08 08:50:20'),
(90, '1011-r', 7, 'Create Req.', 5, 89, 2, '2021-01-09 22:00:50', '2021-01-09 22:00:50'),
(91, '1111-r', 15, 'Create Req.', 5, NULL, 9, '2021-01-09 22:01:14', '2021-01-09 22:01:20'),
(92, '333-r', 10, 'Edit Req.', 5, 87, 2, '2021-01-09 22:02:28', '2021-01-09 22:03:07'),
(93, '333-r', 13, 'Edit Req.', 5, 87, 2, '2021-01-09 22:02:54', '2021-01-09 22:03:12'),
(95, '1023-r', 13, 'Create Req.', 5, 94, 2, '2021-01-09 22:25:37', '2021-01-09 22:25:37'),
(97, '10113-r', 15, 'Create Req.', 5, 96, 2, '2021-01-09 22:26:10', '2021-01-09 22:26:10'),
(98, '507-r', 17, 'Delete Req.', 5, 40, 9, '2021-01-09 22:29:31', '2021-01-09 22:29:57'),
(99, '333-r', 13, 'Delete Req.', 5, 87, 2, '2021-01-09 22:29:45', '2021-01-09 22:30:06'),
(100, '10113', 7, '9', 5, NULL, 1, '2021-01-09 22:30:59', '2021-01-09 22:33:47'),
(101, '10113-r', 16, 'Create Req.', 5, 100, 2, '2021-01-09 22:31:08', '2021-01-09 22:31:08'),
(102, '10113-r', 7, 'Edit Req.', 5, 100, 2, '2021-01-09 22:32:03', '2021-01-09 22:33:47'),
(103, '10113-r', 3, 'Edit Req.', 5, 100, 2, '2021-01-09 22:32:31', '2021-01-09 22:33:43');

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
  `status` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `req_status` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `users`
--

INSERT INTO `users` (`id`, `name`, `identitas`, `no_identitas`, `alamat`, `jenis_kelamin`, `username`, `email`, `password`, `role_id`, `image`, `about`, `status`, `user_id`, `users_id`, `req_status`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Admin Hotel', 'KTP', '123456756438912', 'Gunung Putri, Bogor', 'Laki-laki', 'adminhotel11', 'adminhotel@gmail.com', '$2y$10$uGxQDhccrfJmLM7QjwFS9OVcvWjERYW73XDr8drNrwBTc6hPFIoAe', 1, 'adminhotel11-2021-01-13-5ffe937165a43.jpg', 'Aku adalah Admin ke 1', 1, 4, NULL, 1, 'zMdlHjKG3WmfVpLRVYECysuRzT4kZp7qYIBOHDCTGYs2HD6RRHL7jisCI83Q', NULL, '2021-01-12 23:30:09'),
(5, 'Receptionist Hotel', 'KTP', '13245665433442', 'Jogja', 'Perempuan', 'receptionisthotel22', 'receptionisthotel@gmail.com', '$2y$10$W0qC1ow2gvt6sG5q/Y51A.1vJPZ5EftEmqSySTp5yzZsIECjqhEjS', 2, 'receptionisthotel22-2021-01-13-5ffe978ae3524.jfif', 'Aku adalah Receptionist ke 1', 1, 4, NULL, 1, 'NfxwljM4lLDscREwyUBYnSgG6Jdtq3OebEporWfoC6cBebgfPlUaEGo2QY4r', '2021-01-11 07:44:12', '2021-01-12 23:47:41'),
(6, 'Customer Hotel', 'Passport', '298219838387789', 'Tajur Halang, Bogor', 'Laki-laki', 'customerhotel33', 'customerhotel@gmail.com', '$2y$10$kMgfpI6cvnEFDeW4VN/HL.UCMDCeG4zn6P9gEh2/HZ0o8.O31.Obm', 3, 'customerhotel33-2021-01-13-5ffe9891a34ec.jpg', 'Aku adalah Customer ke 1', 1, 5, NULL, 1, 'RPj2NldQ15022c735CDGED3hBIhAqKyBZ2T5pHZQjvGPP8QSqPeyuVJ9RV6O', NULL, '2021-01-12 23:52:03'),
(8, 'Budi', 'KTP', '32948329843298', 'Jogja', 'Laki-laki', 'password_user', 'budi@mail.com', '$2y$10$EbETlWz8WlyMaWfa3e8CHuK8ZDUCTh7XXPonj/eYy5yeZ4WgQyN0a', 3, 'password-user-2021-01-16-60031504e8b2d.jpg', 'Aku adalah Customer ke 2', 0, 5, NULL, 1, 'JnBs0RNRbUqBVR8EIlJD3PLK1uxm5kNoGIdTH9N2EQX9MZr5gbWPIaX0QYu7', '2020-11-13 16:45:46', '2021-01-16 09:32:05'),
(9, 'Abdi Hasan', 'SIM', '239832894732', 'Ciampea, Jawa Barat', 'Laki-laki', 'hasan.abdi', 'hasan.abdi@yahoo.com', '$2y$10$p3bp9LqZZFzL.E3CRZFZ8ef/NEYof3hlRU4bjchqU..ncLAXeCMoe', 2, 'hasanabdi-2021-01-16-600314b244c59.jpg', 'Aku adalah Receptionist ke 2', 0, 4, NULL, 1, 'YswBjhOZuTBgEV2Lpsh9WIfH7sAbGhXgEp6yfwe1AJdh6FstIW52oqQOfLcT', '2020-11-13 16:49:08', '2021-01-16 09:30:42'),
(13, 'Budi', 'KTP', '32948329843298', 'Jogja', 'Laki-laki', 'password_user', 'budi@mail.com', '0', 3, 'default.png', 'Aku adalah Customer ke 2', 0, 5, 8, 9, NULL, '2021-01-11 07:01:08', '2021-01-11 08:01:22'),
(14, 'Budi', 'KTP', '32948329843298', 'Jogja', 'Laki-laki', 'password_user', 'budi@mail.com', '0', 3, 'default.png', 'Aku adalah Customer ke 2', 0, 5, 8, 9, NULL, '2021-01-11 07:02:10', '2021-01-11 08:00:03'),
(17, 'test', 'SIM', '1234565432', 'Jalan Melati Nomor 7', 'Laki-laki', NULL, 'lele@blog.com', '0', 3, 'default.png', NULL, 0, 5, 16, 2, NULL, '2021-01-11 08:01:53', '2021-01-11 08:02:09'),
(19, 'admin', 'SIM', '1234567564389222', 'Jalan Melati Nomor 7', 'Laki-laki', NULL, 'adminn@gmail.com', '0', 3, 'default.png', NULL, 0, 5, 18, 2, NULL, '2021-01-11 08:10:06', '2021-01-11 08:10:48'),
(20, 'Budi', 'KTP', '32948329843298', 'Jogja', 'Laki-laki', 'password_user', 'budi@mail.com', '0', 3, 'password-user-2021-01-16-60031504e8b2d.jpg', 'Aku adalah Customer ke 2', 0, 5, 8, 9, NULL, '2021-01-17 21:35:33', '2021-01-17 21:37:12'),
(21, 'Customer Hotel', 'Passport', '298219838387789', 'Tajur Halang, Bogor', 'Laki-laki', 'customerhotel33', 'customerhotel@gmail.com', '0', 3, 'customerhotel33-2021-01-13-5ffe9891a34ec.jpg', 'Aku adalah Customer ke 1', 0, 5, 6, 0, NULL, '2021-01-17 21:38:03', '2021-01-17 21:38:03'),
(22, 'Laravel', 'KTP', '12345675643892', 'Bojong Gede, Bogor', 'Laki-laki', NULL, 'admin@admin.com', '$2y$10$t09ZsuJygjqANHxCFp9VjOIbeWhoN68TZ9tN5DQBRQFxpI3GDVbDi', 3, 'default.png', NULL, 1, 4, NULL, 1, NULL, '2021-01-24 06:58:29', '2021-01-24 06:58:29'),
(24, 'Budi', 'KTP', '1234567564311', 'Bogor', 'Laki-laki', NULL, 'budi@mail.co.id', '0', 3, 'default.png', NULL, 0, 5, 23, 2, NULL, '2021-04-11 11:11:34', '2021-04-11 11:13:14'),
(26, 'Dimas', 'KTP', '1234567562112', 'Bogor', 'Laki-laki', NULL, 'dimas@mail.co.id', '0', 3, 'default.png', NULL, 0, 5, 25, 2, NULL, '2021-04-11 11:18:14', '2021-04-11 11:20:01');

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
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `bed`
--
ALTER TABLE `bed`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- 테이블의 AUTO_INCREMENT `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- 테이블의 AUTO_INCREMENT `class`
--
ALTER TABLE `class`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- 테이블의 AUTO_INCREMENT `dynamic_data`
--
ALTER TABLE `dynamic_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 테이블의 AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- 테이블의 AUTO_INCREMENT `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 테이블의 AUTO_INCREMENT `room`
--
ALTER TABLE `room`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- 테이블의 AUTO_INCREMENT `room_number`
--
ALTER TABLE `room_number`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
