-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Sep 2020 pada 12.15
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservasi_hotel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bed`
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
-- Dumping data untuk tabel `bed`
--

INSERT INTO `bed` (`id`, `name`, `slug`, `person`, `created_at`, `updated_at`) VALUES
(1, 'Single', 'single', 1, '2020-09-03 09:55:00', '2020-09-10 02:30:27'),
(2, 'Double', 'double', 2, '2020-09-03 09:56:28', '2020-09-10 02:30:39'),
(3, 'Main Family', 'main-family', 5, '2020-09-03 09:58:49', '2020-09-10 02:30:43'),
(4, 'Extended Family', 'extended-family', 10, '2020-09-03 09:59:38', '2020-09-10 02:30:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `class`
--

CREATE TABLE `class` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `class`
--

INSERT INTO `class` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Standard', 'standard', '2020-09-05 09:27:54', '2020-09-10 02:30:57'),
(2, 'Superior', 'superior', '2020-09-05 09:28:10', '2020-09-10 02:31:01'),
(3, 'Deluxe', 'deluxe', '2020-09-05 09:28:21', '2020-09-10 02:31:05'),
(4, 'Suite', 'suite', '2020-09-05 09:28:30', '2020-09-10 02:31:10'),
(5, 'Presidential Suite', 'presidential-suite', '2020-09-05 09:28:55', '2020-09-10 02:31:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
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
(10, '2020_09_10_092209_add_slug_to_bed_table', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', NULL, NULL),
(2, 'Receptionist', 'receptionist', NULL, NULL),
(3, 'Customer', 'customer', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `room`
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
-- Dumping data untuk tabel `room`
--

INSERT INTO `room` (`id`, `class_id`, `bed_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1000000, '2020-09-07 09:37:48', '2020-09-09 09:52:17'),
(3, 1, 2, 1200000, '2020-09-09 09:51:31', '2020-09-09 09:52:41'),
(4, 1, 3, 2000000, '2020-09-09 10:19:49', '2020-09-09 10:19:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `no_identitas` int(11) DEFAULT NULL,
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `identitas`, `no_identitas`, `alamat`, `jenis_kelamin`, `username`, `email`, `password`, `role_id`, `image`, `about`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Admin Hotel', '-', NULL, '-', '-', 'adminhotel11', 'adminhotel@gmail.com', '$2y$10$z/ewgFvcwbxGxqRnOLNgtOkyZQaTQ4apOOav7khnde8ePRPjfAuty', 1, 'default.png', NULL, 'j2u2idItgF0JxbO8EOqS017LF7cyGZsnBjNypWWUyVtJFxxl8IwtShE5Cgzw', NULL, NULL),
(5, 'Receptionist Hotel', '-', NULL, '-', '-', 'receptionisthotel22', 'receptionisthotel@gmail.com', '$2y$10$oNN0uOcW1WGzvAliLYIjD.Jw5og7h7ABm8Ayz8qHS6MRXiABsQN6q', 2, 'default.png', NULL, 'sFGp4CfFDg1PSl1rgywHgIU0TT8Rz1992Uhj8RwcxGHd1ZBWCjRBpSK06Ko6', NULL, NULL),
(6, 'Customer Hotel', '-', NULL, '-', '-', 'customerhotel33', 'customerhotel@gmail.com', '$2y$10$x.R.0B4ch5KVhGRiBCE85uMjg9u9cJwxUbb535Mb4lBgV9j.Qwd2y', 3, 'default.png', NULL, 'YkZJKWJYgQhuX4J1YVXMfbpQOFcCb57C04yMoRzjTchBBKqdDcujCkWeZj5e', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bed`
--
ALTER TABLE `bed`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_no_identitas_unique` (`no_identitas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bed`
--
ALTER TABLE `bed`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `class`
--
ALTER TABLE `class`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `room`
--
ALTER TABLE `room`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
