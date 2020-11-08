-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 20-11-08 05:48
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `bed`
--

INSERT INTO `bed` (`id`, `name`, `slug`, `person`, `created_at`, `updated_at`) VALUES
(1, 'Single', 'single', 1, '2020-09-03 09:55:00', '2020-09-24 09:29:58'),
(2, 'Double', 'double', 2, '2020-09-03 09:56:28', '2020-09-10 02:30:39'),
(3, 'Main Family', 'main-family', 5, '2020-09-03 09:58:49', '2020-09-10 02:30:43'),
(4, 'Extended Family', 'extended-family', 10, '2020-09-03 09:59:38', '2020-09-10 02:30:48');

-- --------------------------------------------------------

--
-- 테이블 구조 `booking`
--

CREATE TABLE `booking` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bed_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `name`, `bed_id`, `class_id`, `room_id`, `created_at`, `updated_at`) VALUES
(1, 4, 'iiiiiii', 2, 3, 9, '2020-10-30 22:56:09', '2020-10-30 22:56:09'),
(3, 4, 'asfewef', 3, 5, 16, '2020-10-31 00:41:42', '2020-10-31 00:41:42'),
(4, 4, 'Gerlando Corputty', 2, 3, 9, '2020-11-01 23:21:33', '2020-11-01 23:21:33'),
(5, 5, 'Lala', 1, 3, 8, '2020-11-06 11:10:57', '2020-11-06 11:10:57'),
(6, 6, 'customer', 4, 5, 17, '2020-11-06 12:20:22', '2020-11-06 12:20:22');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `class`
--

INSERT INTO `class` (`id`, `name`, `slug`, `desc`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Standard', 'standard', '<p><span style=\"color: #000000; font-family: tahoma, arial, helvetica, sans-serif; font-size: 12pt;\">Standard Class merupakan kelas yang berfasilitas standar dan dengan harga sewa yang murah, walau begitu kelas standar ini tidak kalah dengan kelas yang diatasnya. Standard Class memiliki dua pilihan kamar yaitu Single (1 Orang) dan Double (2 Orang). </span></p>\r\n<p><span style=\"color: #000000; font-family: tahoma, arial, helvetica, sans-serif; font-size: 12pt;\">Ini dia fasilitas dari kamar ini:</span></p>', 'standard-2020-09-24-5f6ccd6423aac.jpg', '2020-09-05 09:27:54', '2020-10-02 11:47:08'),
(2, 'Superior', 'superior', '<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Superior Class merupakan kelas yang berfasilitas diatas standar dan dengan harga sewa yang murah, walau begitu kelas superior ini tidak kalah dengan kelas yang diatasnya. Superior Class memiliki dua pilihan kamar yaitu Single (1 Orang) dan Double (2 Orang). </span></p>\r\n<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Ini dia fasilitas dari kamar ini:</span></p>', 'superior-2020-09-24-5f6ccd812f2a3.jpg', '2020-09-05 09:28:10', '2020-10-02 11:49:08'),
(3, 'Deluxe', 'deluxe', '<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Deluxe Class merupakan kelas yang berfasilitas hampir memasuki ekslusif&nbsp;dan dengan harga sewa yang terjangkau, walau begitu kelas Deluxe&nbsp;ini tidak kalah dengan kelas yang diatasnya. Deluxe Class memiliki dua pilihan kamar yaitu Single (1 Orang) dan Double (2 Orang). </span></p>\r\n<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Ini dia fasilitas dari kamar ini:</span></p>', 'deluxe-2020-09-24-5f6ccd8d00bf4.jpg', '2020-09-05 09:28:21', '2020-10-02 11:49:57'),
(4, 'Suite', 'suite', '<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Suite Class merupakan kelas yang berfasilitas eksklusif dan dengan harga sewa yang tinggi, walau kelas suite&nbsp;ini begitu mahal anda&nbsp;akan dibayar dengan fasilitas ekslusif dari kami sehingga anda tidak perlu khawatir. Suite Class memiliki empat pilihan kamar yaitu Single (1 Orang),&nbsp; Double (2 Orang), Main Family (5 Orang) dan Extended Family (10 Orang). </span></p>\r\n<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Ini dia fasilitas dari kamar ini:</span></p>', 'suite-2020-09-24-5f6ccd9ba93f0.jpg', '2020-09-05 09:28:30', '2020-10-02 11:51:28'),
(5, 'Presidential Suite', 'presidential-suite', '<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Presidential Suite Class merupakan kelas yang berfasilitas eksklusif dan tertinggi di hotel ini dengan harga sewa yang tinggi, walau kelas presidential suite ini begitu mahal anda&nbsp;akan dibayar dengan fasilitas ekslusif dan terbaik dari kami sehingga anda tidak perlu khawatir. Presidential Suite Class memiliki empat pilihan kamar yaitu Single (1 Orang),&nbsp; Double (2 Orang), Main Family (5 Orang) dan Extended Family (10 Orang). </span></p>\r\n<p><span style=\"color: #000000; font-size: 12pt; font-family: tahoma, arial, helvetica, sans-serif;\">Ini dia fasilitas dari kamar ini:</span></p>', 'presidential-suite-2020-09-24-5f6ccda711910.jpg', '2020-09-05 09:28:55', '2020-10-02 11:52:41');

-- --------------------------------------------------------

--
-- 테이블 구조 `dynamic_data`
--

CREATE TABLE `dynamic_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(13, '2020_11_03_143506_create_dynamic_data_table', 8);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `room`
--

INSERT INTO `room` (`id`, `class_id`, `bed_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1000000, '2020-09-07 09:37:48', '2020-09-09 09:52:17'),
(3, 1, 2, 1200000, '2020-09-09 09:51:31', '2020-09-09 09:52:41'),
(6, 2, 1, 1600000, '2020-09-24 22:33:16', '2020-09-24 22:33:27'),
(7, 2, 2, 2000000, '2020-09-24 22:33:41', '2020-09-24 22:33:41'),
(8, 3, 1, 2100000, '2020-09-24 22:33:53', '2020-09-24 22:33:53'),
(9, 3, 2, 2500000, '2020-09-24 22:34:03', '2020-09-24 22:34:03'),
(10, 4, 1, 3400000, '2020-09-24 22:34:19', '2020-09-24 22:34:19'),
(11, 4, 2, 3800000, '2020-09-24 22:34:40', '2020-09-24 22:34:40'),
(12, 4, 3, 4400000, '2020-09-24 22:34:54', '2020-09-24 22:34:54'),
(13, 4, 4, 5000000, '2020-09-24 22:35:08', '2020-09-24 22:35:08'),
(14, 5, 1, 4300000, '2020-09-24 22:35:22', '2020-09-24 22:35:22'),
(15, 5, 2, 4900000, '2020-09-24 22:35:33', '2020-09-24 22:35:33'),
(16, 5, 3, 5700000, '2020-09-24 22:35:49', '2020-09-24 22:35:49'),
(17, 5, 4, 6500000, '2020-09-24 22:36:08', '2020-09-24 22:36:08');

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
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(4, 'Admin Hotel', 'KTP', '123456756438912', 'Gunung Putri, Bogor', 'Laki-laki', 'adminhotel11', 'adminhotel@gmail.com', '$2y$10$uGxQDhccrfJmLM7QjwFS9OVcvWjERYW73XDr8drNrwBTc6hPFIoAe', 1, 'default.png', 'Aku adalah Admin ke 1', 'DOA9TnD728aG1r75jRRzvBKZgYOghNHg2oHezTneoUesCL9qGWFEoy5VxTgw', NULL, '2020-11-06 10:30:48'),
(5, 'Receptionist Hotel', 'SIM', '92897423909237', 'Bojong Gede, Bogor', 'Perempuan', 'receptionisthotel22', 'receptionisthotel@gmail.com', '$2y$10$jcp09ZY2uzVlTeV09nEeheQuhndhQ1DVLWnkuPF7D33w6vFzTHoY6', 2, 'default.png', 'Aku adalah Receptionist ke 1', 'fB5WyWt7Tu3iMXdqkHAsrS7wzwCkyEqveuz9BwBtprqP1bE3yVitLkMbiGYz', NULL, '2020-11-06 10:47:26'),
(6, 'Customer Hotel', 'Passport', '298219838387789', 'Tajur Halang, Bogor', 'Laki-laki', 'customerhotel33', 'customerhotel@gmail.com', '$2y$10$kMgfpI6cvnEFDeW4VN/HL.UCMDCeG4zn6P9gEh2/HZ0o8.O31.Obm', 3, 'default.png', 'Aku adalah Customer ke 1', 'StVHZpNKYprFR94bAp8Jsxr2HbxISk3CYfSlaot8dUSTk5LGDwMPH4H2yDRu', NULL, '2020-11-06 10:55:35');

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
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_no_identitas_unique` (`no_identitas`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `bed`
--
ALTER TABLE `bed`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 테이블의 AUTO_INCREMENT `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 테이블의 AUTO_INCREMENT `class`
--
ALTER TABLE `class`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 테이블의 AUTO_INCREMENT `dynamic_data`
--
ALTER TABLE `dynamic_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 테이블의 AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 테이블의 AUTO_INCREMENT `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 테이블의 AUTO_INCREMENT `room`
--
ALTER TABLE `room`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
