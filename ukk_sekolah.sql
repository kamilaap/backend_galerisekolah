-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 30 Okt 2024 pada 00.42
-- Versi server: 8.0.30
-- Versi PHP: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk_sekolah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda`
--

CREATE TABLE `agenda` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `tanggal` date NOT NULL,
  `tanggal_post_agenda` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `users_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `agenda`
--

INSERT INTO `agenda` (`id`, `judul`, `deskripsi`, `tanggal`, `tanggal_post_agenda`, `status`, `kategori_id`, `users_id`, `created_at`, `updated_at`) VALUES
(1, 'Rapat Kerja Update', 'Update agenda rapat kerja.', '2024-11-01', '2024-10-18', 'aktif', 1, 1, '2024-10-14 08:54:36', '2024-10-18 05:03:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('483e8180cf4678cf1292d8c46d0cbd6b', 'i:1;', 1730192430),
('483e8180cf4678cf1292d8c46d0cbd6b:timer', 'i:1730192430;', 1730192430),
('96154577e6ad92ca81451d577c9d5c97', 'i:1;', 1730101347),
('96154577e6ad92ca81451d577c9d5c97:timer', 'i:1730101347;', 1730101347);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `photo_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `comments`
--

INSERT INTO `comments` (`id`, `photo_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'halo', '2024-10-19 13:13:21', '2024-10-20 13:13:21'),
(2, 2, 1, 'hai', '2024-10-19 06:25:58', '2024-10-19 06:25:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `galery`
--

CREATE TABLE `galery` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `is_map` tinyint(1) NOT NULL DEFAULT '0',
  `tanggal` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `users_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `galery`
--

INSERT INTO `galery` (`id`, `judul`, `deskripsi`, `is_map`, `tanggal`, `status`, `kategori_id`, `users_id`, `created_at`, `updated_at`) VALUES
(1, 'PMR', 'PMR', 0, '2024-10-16', 'active', 3, 1, '2024-10-16 06:09:24', '2024-10-16 06:09:24'),
(2, 'pramuka', 'ada ayang aku', 0, '2024-10-19', 'active', 3, 1, '2024-10-19 06:19:28', '2024-10-19 06:19:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi`
--

CREATE TABLE `informasi` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `users_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `informasi`
--

INSERT INTO `informasi` (`id`, `judul`, `deskripsi`, `image`, `tanggal`, `status`, `kategori_id`, `users_id`, `created_at`, `updated_at`) VALUES
(1, 'Informasi', 'Infokan', 'informasi/7B0r1FtiGaGgcW9bmXBtb7GDETJbsDOyNZFEKPQ0.jpg', '2024-10-14', 'active', 2, 1, '2024-10-14 08:34:48', '2024-10-14 08:34:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `judul`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Agenda', 'agenda sekolah', '2024-10-14 08:33:19', '2024-10-14 08:33:19'),
(2, 'Informasi', 'info maseh', '2024-10-14 08:34:10', '2024-10-14 08:34:10'),
(3, 'Galery', 'galery smkn 4 bogor', '2024-10-16 06:08:56', '2024-10-16 06:08:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `likes`
--

CREATE TABLE `likes` (
  `id` bigint UNSIGNED NOT NULL,
  `photo_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `likes`
--

INSERT INTO `likes` (`id`, `photo_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2024-10-22 13:38:08', '2024-10-23 13:38:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_09_28_074550_create_petugas_table', 1),
(5, '2024_09_28_074734_create_profiles_table', 1),
(6, '2024_09_29_075015_add_two_factor_columns_to_users_table', 1),
(7, '2024_09_29_085312_create_personal_access_tokens_table', 1),
(8, '2024_09_30_025852_create_kategoris_table', 1),
(9, '2024_09_30_025900_create_informasis_table', 1),
(10, '2024_09_30_025904_create_agendas_table', 1),
(11, '2024_09_30_025907_create_galeries_table', 1),
(12, '2024_09_30_153601_create_sliders_table', 1),
(13, '2024_10_03_131535_create_photos_table', 1),
(14, '2024_10_08_114612_create_likes_table', 1),
(15, '2024_10_08_114630_create_comments_table', 1),
(16, '2024_10_13_035328_create_personal_access_tokens_table', 2),
(17, '2024_10_14_123759_add_role_to_users_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'API TOKEN', '65825191790a7a1baf3c6c229e87381e74f2853147c51f141f8fc9dabacb5815', '[\"*\"]', NULL, NULL, '2024-10-14 06:12:54', '2024-10-14 06:12:54'),
(2, 'App\\Models\\User', 2, 'API TOKEN', 'b366f061cc8d8414d97cfcdb5b0a291ddfe19371e097bf483b476b7d325544a6', '[\"*\"]', NULL, NULL, '2024-10-14 06:13:10', '2024-10-14 06:13:10'),
(11, 'App\\Models\\User', 1, 'API TOKEN', '2852015d2c337d6fcbe4e059af397ed4b856556af38b8996da54df20d718bd76', '[\"*\"]', '2024-10-18 06:02:51', NULL, '2024-10-18 05:55:30', '2024-10-18 06:02:51'),
(12, 'App\\Models\\User', 1, 'API TOKEN', 'f3d353d735193d693232cffefe0a21a3dc3d519006c741de25fa902e00430b0f', '[\"*\"]', '2024-10-22 05:39:23', NULL, '2024-10-18 08:51:12', '2024-10-22 05:39:23'),
(13, 'App\\Models\\User', 1, 'API TOKEN', '0d4d03006e8e69e677f1f1ed21208601c5e557db76ac5b57abc07fe65be99c02', '[\"*\"]', '2024-10-22 05:32:59', NULL, '2024-10-22 05:32:34', '2024-10-22 05:32:59'),
(14, 'App\\Models\\User', 5, 'API TOKEN', '7e0128717c26f394c8ea60da200d0bcfd3d3ece211c030c0307e96ab4da82324', '[\"*\"]', NULL, NULL, '2024-10-24 05:02:39', '2024-10-24 05:02:39'),
(15, 'App\\Models\\User', 5, 'API TOKEN', '13c575f33ca11a14adec554e916377f1446bdcf0399b0dfb9efc630afa288a51', '[\"*\"]', '2024-10-24 05:12:10', NULL, '2024-10-24 05:02:52', '2024-10-24 05:12:10'),
(16, 'App\\Models\\User', 5, 'API TOKEN', '2d97b85db32e7a48b546f679a0b399375b8c509cd5f0731d071ffb8b9da19d04', '[\"*\"]', NULL, NULL, '2024-10-24 05:25:43', '2024-10-24 05:25:43'),
(17, 'App\\Models\\User', 6, 'API TOKEN', 'c6bf9ed9f8e622cb1c504419613062febfe02fce8cb2678f5463631aece7d302', '[\"*\"]', NULL, NULL, '2024-10-24 05:27:38', '2024-10-24 05:27:38'),
(18, 'App\\Models\\User', 5, 'API TOKEN', 'e402fca5d20db6a86ce01ee1b56d53388e8cf572c8e9b75b97ff84ce0d4c7659', '[\"*\"]', NULL, NULL, '2024-10-24 05:29:26', '2024-10-24 05:29:26'),
(19, 'App\\Models\\User', 5, 'API TOKEN', 'd2354e3041ec7ff863a4ce736a9c0eeae08f2feca268bef4b4c71d538d2a7159', '[\"*\"]', NULL, NULL, '2024-10-27 01:24:52', '2024-10-27 01:24:52'),
(20, 'App\\Models\\User', 5, 'API TOKEN', '727b33be312752e25247105367f818000071a5c4b2bd52aeddf18ea48c596c00', '[\"*\"]', NULL, NULL, '2024-10-27 19:46:04', '2024-10-27 19:46:04'),
(21, 'App\\Models\\User', 5, 'API TOKEN', '2e43fa6afe0abbc7c9a8ab31421648562133009521df778362b744780a37cffd', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:03', '2024-10-27 20:13:03'),
(22, 'App\\Models\\User', 5, 'API TOKEN', 'ebfdbeba69f06b3664b1f438c3b7944286ebeb98d835ef616b9fb26e2619c323', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:06', '2024-10-27 20:13:06'),
(23, 'App\\Models\\User', 5, 'API TOKEN', 'ef1aaaa863d238e542670ff212e49a8b4b88dda58b891db1b475746ac6811eda', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:07', '2024-10-27 20:13:07'),
(24, 'App\\Models\\User', 5, 'API TOKEN', 'f5d409c7ad0461ad9eccde275cde28d4be0b3ea91ff674918c159e191be51de1', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:09', '2024-10-27 20:13:09'),
(25, 'App\\Models\\User', 5, 'API TOKEN', '412b2183decba200787ea75a76fd397b0c876aebb40890f0ca2a85735a3e84b4', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:10', '2024-10-27 20:13:10'),
(26, 'App\\Models\\User', 5, 'API TOKEN', '1037c53f342d36c45c2fdd2411a41bd6b3c4cff28ccd907959a1ddf1b44f6116', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:12', '2024-10-27 20:13:12'),
(27, 'App\\Models\\User', 5, 'API TOKEN', '7ed70c779c8c12fa0c0e9a585df4606de64f1725b54bee1ec8d15c522633053a', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:14', '2024-10-27 20:13:14'),
(28, 'App\\Models\\User', 5, 'API TOKEN', '4dd5a40ba64e37e704f91440d4da89a802c54b4675f4c673fc3c1135a5be2c3b', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:16', '2024-10-27 20:13:16'),
(29, 'App\\Models\\User', 5, 'API TOKEN', '43291ff7397f032d568a9c95642a848a1170fab39d0d0e6e5ed106c0740ce963', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:18', '2024-10-27 20:13:18'),
(30, 'App\\Models\\User', 5, 'API TOKEN', '4aea10eae872e2c74961b87d2629982fe0b1b1c3c8f5caab7e74653961836310', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:19', '2024-10-27 20:13:19'),
(31, 'App\\Models\\User', 5, 'API TOKEN', 'c4d32bf77f14b75b51166aeb13dc44f4c2d325abc06f534cd63c8c494a02f828', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:21', '2024-10-27 20:13:21'),
(32, 'App\\Models\\User', 5, 'API TOKEN', '4054ab39cfb066cf4e900c8f535e1546b399151b2d483d892a090038700a3be6', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:23', '2024-10-27 20:13:23'),
(33, 'App\\Models\\User', 5, 'API TOKEN', 'd7a747dad28a65caf95076f8eb5ee0295bac352fd6a1625cee4705c0573e6110', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:24', '2024-10-27 20:13:24'),
(34, 'App\\Models\\User', 5, 'API TOKEN', 'c4e19de321916a9d03bac27b7dcf47345f39ee238488d8bf1f16f5f71c104f87', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:27', '2024-10-27 20:13:27'),
(35, 'App\\Models\\User', 5, 'API TOKEN', '3afa613e9ea6e3b13ab14198402986de563f8d00c8a58f8a0038fc386848acc7', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:28', '2024-10-27 20:13:28'),
(36, 'App\\Models\\User', 5, 'API TOKEN', '4aafd062d31979cbed841623f6c84f2af6b72bbdb5ef4ce2b0f5551d7a366395', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:30', '2024-10-27 20:13:30'),
(37, 'App\\Models\\User', 5, 'API TOKEN', '055fb8bb95ee7d4529a80db9c9805dae825d1227c21f927d57d8e5f4e68fd8a0', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:32', '2024-10-27 20:13:32'),
(38, 'App\\Models\\User', 5, 'API TOKEN', '0ad2bb85697787d28755bc873ea7ac5672f51465684f39f682bc7c1385519de7', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:34', '2024-10-27 20:13:34'),
(39, 'App\\Models\\User', 5, 'API TOKEN', 'c59d65613e3780cdbb89eb01d279b0b535d9d19651c994192ea0094bbf0ce074', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:35', '2024-10-27 20:13:35'),
(40, 'App\\Models\\User', 5, 'API TOKEN', '54adc10e6ff485f1e6622fdf227d1b1061e493cf0f30f541956f1dad9434aebe', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:37', '2024-10-27 20:13:37'),
(41, 'App\\Models\\User', 5, 'API TOKEN', 'e73120e28449747fb779410c2339d1ece6a4cdd08d6b3e8abc1189c00874a26b', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:38', '2024-10-27 20:13:38'),
(42, 'App\\Models\\User', 5, 'API TOKEN', 'a7389c0e58a4ce95e4647766fa73ac3fc0f77f9219fd6a43d370c7e1620feaf9', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:40', '2024-10-27 20:13:40'),
(43, 'App\\Models\\User', 5, 'API TOKEN', '877b9ea60dddd70041ed942c8007da432f81d4ee8777d2dfcea2ee20bcc2ef4c', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:42', '2024-10-27 20:13:42'),
(44, 'App\\Models\\User', 5, 'API TOKEN', '9b0e4bc32ed226c41446a1ca74f05ff7a326e309b4f326e99cfacf40ff81cdd3', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:44', '2024-10-27 20:13:44'),
(45, 'App\\Models\\User', 5, 'API TOKEN', 'cbed8204e46805575df8a3c09256b0a207ce06e7f641bcead3ce8a2b3f6ae95d', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:46', '2024-10-27 20:13:46'),
(46, 'App\\Models\\User', 5, 'API TOKEN', '1dfe52091825cfbd08f30b2135d88dc19a4f3d73e6cce76f5b4cb27a35918f3d', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:47', '2024-10-27 20:13:47'),
(47, 'App\\Models\\User', 5, 'API TOKEN', '516fa38a8f015cf5426f98e71aaf5bf213300e0e4a3304d8363c969499f30504', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:49', '2024-10-27 20:13:49'),
(48, 'App\\Models\\User', 5, 'API TOKEN', '257b14facde8339714ad337379b03f3fcd09a45040b11410085e14a2e1512dbb', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:50', '2024-10-27 20:13:50'),
(49, 'App\\Models\\User', 5, 'API TOKEN', '6ee1a19e09cce1374af9b100378b48756faaa9f1b171953a8981698709a52c82', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:52', '2024-10-27 20:13:52'),
(50, 'App\\Models\\User', 5, 'API TOKEN', 'ae7657108371195f1fb995ac263e206417ab30f4951b86f891e73aacd9b0783f', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:53', '2024-10-27 20:13:53'),
(51, 'App\\Models\\User', 5, 'API TOKEN', 'aa9d9e01837e1284ac68ebe5975bf1ca765e0715ea6b1c1728164c65534739ba', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:55', '2024-10-27 20:13:55'),
(52, 'App\\Models\\User', 5, 'API TOKEN', '6f9deea33d93c1e7058f33339e75d335ac04db08903d4437aa2555adb76d1717', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:56', '2024-10-27 20:13:56'),
(53, 'App\\Models\\User', 5, 'API TOKEN', 'f5cc0142f43f15d55eaf166eaadfaebccc18de95785da7e80fa9e838e909badb', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:58', '2024-10-27 20:13:58'),
(54, 'App\\Models\\User', 5, 'API TOKEN', 'e781acf3c1bb27ba3bc2d2a3834dc09d8dc4d5242afc7709e8ee492d2fd372c5', '[\"*\"]', NULL, NULL, '2024-10-27 20:13:59', '2024-10-27 20:13:59'),
(55, 'App\\Models\\User', 5, 'API TOKEN', 'ec606d9fae7e61e7ebf6aa953ea9f830d287b1e86d8e1a5892a9c2ccdc2feb80', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:01', '2024-10-27 20:14:01'),
(56, 'App\\Models\\User', 5, 'API TOKEN', '29cf4759e0a7acce031392c8f1afb5b6b1fdb6e67ad349c40898efe4a10261da', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:03', '2024-10-27 20:14:03'),
(57, 'App\\Models\\User', 5, 'API TOKEN', '9504c38f3d4b87807862e5db75f6c6577b70fd967977228d788a3dd164dcffe7', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:05', '2024-10-27 20:14:05'),
(58, 'App\\Models\\User', 5, 'API TOKEN', 'b6083a9ce8e4ac783ff2c03e660448bacd6c08e9a4b1ef03bd0d5f65a0957375', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:07', '2024-10-27 20:14:07'),
(59, 'App\\Models\\User', 5, 'API TOKEN', 'd88ea0fe57999a46ca7a8a69f61efba849cc6566aac245bd1b0c6a51613c3afa', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:09', '2024-10-27 20:14:09'),
(60, 'App\\Models\\User', 5, 'API TOKEN', '698ad9890b8c9f077275866ee5843d6a0d99eb9b7cc4174e6c4af857ece3d697', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:11', '2024-10-27 20:14:11'),
(61, 'App\\Models\\User', 5, 'API TOKEN', 'b8df61715754f4223dcbe59faa0d863dd28faadc46c33009e817f866bc76a079', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:13', '2024-10-27 20:14:13'),
(62, 'App\\Models\\User', 5, 'API TOKEN', 'cd18bd28b9924078a6304fb8b4b6a8aac3a3846af2e013f632783a62fdcb8e31', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:15', '2024-10-27 20:14:15'),
(63, 'App\\Models\\User', 5, 'API TOKEN', '970e0ddcb58dd6e13dfef1a2c39905399fe2d0a8a13d64b73acbad55ab82edb2', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:16', '2024-10-27 20:14:16'),
(64, 'App\\Models\\User', 5, 'API TOKEN', '0de52d4a4f3ea913fc5959d8c62de3b7778da59c43429acbb3e5946eb2eae215', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:17', '2024-10-27 20:14:17'),
(65, 'App\\Models\\User', 5, 'API TOKEN', 'b3e1dd47befb681c19e728a4afabf61e879cb9920de4785bf8e35ec383ce43ff', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:18', '2024-10-27 20:14:18'),
(66, 'App\\Models\\User', 5, 'API TOKEN', 'b980639a2e240972176d7397942e97a8598e71d2e524d8335898bb3a8bb8e51f', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:19', '2024-10-27 20:14:19'),
(67, 'App\\Models\\User', 5, 'API TOKEN', 'e28ac73b99bdc199c58a3f5ee42721c6c2c3012c3a191fb9d88180aa23a17d18', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:20', '2024-10-27 20:14:20'),
(68, 'App\\Models\\User', 5, 'API TOKEN', 'e36ad62e8145bef2457a8e7fcd4c1801ee2b8b72015c14a301412a747729acae', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:21', '2024-10-27 20:14:21'),
(69, 'App\\Models\\User', 5, 'API TOKEN', '934f07a7f9ad9bfa5bc2b5405de70196af85999c20767f33496e83f7df9099fc', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:22', '2024-10-27 20:14:22'),
(70, 'App\\Models\\User', 5, 'API TOKEN', 'b891b038d18f9d3bda9c5adaa15025562247b6ebc1a8048a8ff25103c157902e', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:23', '2024-10-27 20:14:23'),
(71, 'App\\Models\\User', 5, 'API TOKEN', '7323357a3f74dd8ff0e10be38a9903ae71f49cea98c58d65562db555565b86f1', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:25', '2024-10-27 20:14:25'),
(72, 'App\\Models\\User', 5, 'API TOKEN', 'f220b7ef811d3b7abdd21f8d066a87d1041ef99d053284b3f7d46828c7997961', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:26', '2024-10-27 20:14:26'),
(73, 'App\\Models\\User', 5, 'API TOKEN', '63e4be699b2199304e7796849b448074de97b7fa289af6924a505a3e39753e4f', '[\"*\"]', NULL, NULL, '2024-10-27 20:14:55', '2024-10-27 20:14:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `photos`
--

CREATE TABLE `photos` (
  `id` bigint UNSIGNED NOT NULL,
  `galery_id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `photos`
--

INSERT INTO `photos` (`id`, `galery_id`, `image`, `judul`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'images/photos/OwrVtat4ojhZvif4Qd22ozHnAaYULNzHKjy1upAz.jpg', 'pelantikan', 1, '2024-10-16 06:09:53', '2024-10-16 06:09:53'),
(2, 2, 'images/photos/3qdMo1LKYh5m9Lfj1sN9u5wyb1KyN1wl9WSuZxGX.png', 'about you', 1, '2024-10-19 06:20:53', '2024-10-19 06:20:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile`
--

CREATE TABLE `profile` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5GYwAKAgR6vPv1TsdHlFbawKCVMIkUv1pygeWba4', NULL, '127.0.0.1', 'Dart/3.5 (dart:io)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXJxWDdvWlhWd0YyeHFtalZrMmVSZjhONjdMUm1BRlVVVGZGSXJaeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMC4wLjIuMjo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1729772860),
('A2Woqf4A4lYtrmgTQEiTaKJGsqmE8mkG0H5XGuaL', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieXRiUUNjREtxcDFjZkNlYkNvNzd4cVdJbjd0MzZKbHVWNnZwUkRTMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1730181417),
('BrNWzQBbmdh46xAazMLeTFYeXqSnSA8DROWVGs3k', NULL, '127.0.0.1', 'Dart/3.5 (dart:io)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHRRV0FZRDh6ZE1uaU5tRUxiNDZ3bENFWnZRa1J6YTgzNHpJcHN2NyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMC4wLjIuMjo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1729772748),
('EKXXwf3S7MXQA5V1cPneB4yEV9dtH1oDu1YCxPXa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN3dvenRjWFBFZ1hsSGhzTVdUSnNlRDcyU3drUUNtZFRDbDFKSFJhZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO319', 1730192482),
('FE6SCOPqV6ZPhkKuvtjGOPogiKwjIUWxjvNIvdct', NULL, '127.0.0.1', 'Dart/3.5 (dart:io)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidmc4bFN3cm5ycVZ6U0ptS3o0TjY1d2QwMTZTc3MxT0JDMW1HR3FqQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMC4wLjIuMjo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1729772967),
('OpMLtG5dE6NS7XCbggAZJ9YkMAxCJkeZwP2ifj03', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic2hBNWgxNmF5OUpFY2RCRWZpY2VJeUNFUXJaNWd2UHNxSU1WOEltZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1730191482),
('RXMlUexst1sZ2QsA7fBBURXCxk6Ehq2ikQw7ePuD', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTGFLb2tlY0VmWDVmeHN3THZwTk13YlIzWUZPTFhYVWV5UTN2OUNvUiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O30=', 1730101289),
('z60qzjIikQAqHE6qoWAXXMI8leUUI8NBPuZQX2r2', NULL, '127.0.0.1', 'Dart/3.5 (dart:io)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid1Zrb1VveVNBbmlyU0JkTmx4RjRGU2VPM1NVNTRNSVE4WnRVRnU3ViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMC4wLjIuMjo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1730085300);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `link`, `created_at`, `updated_at`) VALUES
(5, 'slider/lVLfau5VJ7molOnNsdv7rak6MrKO842Ib18xNuoX.png', '#', '2024-10-18 05:36:28', '2024-10-18 05:36:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `avatar`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$PviYTuu4og2Wq3wSMsTGMuvBO/LI4v/xCMtuHRrSsmFs2MM27CKKK', NULL, NULL, NULL, NULL, 'admin', 'rZmsk8CmhAwnpRkpbNIgZfvZuk3XNUdg14HlPgrMAeaLOVIgdJNmXmBr02yr', NULL, '2024-10-14 05:57:35'),
(2, 'petugas', 'petugas@gmail.com', NULL, '$2y$12$VGnaMe1mk3voDcfYGLx8Xe1ufJSMibIoHIK74WTw3iNs5ooT7LFJy', NULL, NULL, NULL, NULL, 'petugas', NULL, '2024-10-16 05:40:15', '2024-10-16 05:40:15'),
(5, 'user', 'user@gmail.com', NULL, '$2y$12$QWGWdBwTJ5N383qQqxyzEuCFv8Monb6a0CbMJNo9hJcRLEn.J4PmO', NULL, NULL, NULL, NULL, 'user', NULL, '2024-10-24 05:02:38', '2024-10-24 05:02:38'),
(6, 'kamila', 'kp.herlambang@gmail.com', NULL, '$2y$12$dNrFug94Vqkm/vV8OAQs7euu9OY9A0hkdaBPwW9fM1pxB27pHgGR2', NULL, NULL, NULL, NULL, 'user', NULL, '2024-10-24 05:27:38', '2024-10-24 05:27:38');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agenda_kategori_id_foreign` (`kategori_id`),
  ADD KEY `agenda_users_id_foreign` (`users_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_photo_id_foreign` (`photo_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `galery`
--
ALTER TABLE `galery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galery_kategori_id_foreign` (`kategori_id`),
  ADD KEY `galery_users_id_foreign` (`users_id`);

--
-- Indeks untuk tabel `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `informasi_kategori_id_foreign` (`kategori_id`),
  ADD KEY `informasi_users_id_foreign` (`users_id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_photo_id_foreign` (`photo_id`),
  ADD KEY `likes_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_galery_id_foreign` (`galery_id`),
  ADD KEY `photos_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `galery`
--
ALTER TABLE `galery`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `profile`
--
ALTER TABLE `profile`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agenda_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `galery`
--
ALTER TABLE `galery`
  ADD CONSTRAINT `galery_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `galery_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `informasi`
--
ALTER TABLE `informasi`
  ADD CONSTRAINT `informasi_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `informasi_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_galery_id_foreign` FOREIGN KEY (`galery_id`) REFERENCES `galery` (`id`),
  ADD CONSTRAINT `photos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
