-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 25 Nov 2024 pada 02.09
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
(1, 'UJIKOM Praktek PPLG', 'Kegiatan Praktek Uji Kompetensi Keahlian Pengembangan Perangkat Lunak Dan Gim. Kegiatan ini dilaksanakan pada hari Senin, Selasa, dan Kamis, Tanggal 25-26 dan 28 November 2024', '2024-11-25', '2024-11-24', 'active', 2, 1, '2024-11-24 00:10:27', '2024-11-24 00:10:27');

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
('1ee4ec4fe7b7dfef123111215589821f', 'i:1;', 1732436747),
('1ee4ec4fe7b7dfef123111215589821f:timer', 'i:1732436747;', 1732436747),
('483e8180cf4678cf1292d8c46d0cbd6b', 'i:1;', 1732490157),
('483e8180cf4678cf1292d8c46d0cbd6b:timer', 'i:1732490157;', 1732490157),
('72658fac37a2747486e393fd50d51381', 'i:1;', 1732489571),
('72658fac37a2747486e393fd50d51381:timer', 'i:1732489571;', 1732489571),
('7b5aa08abdfaf4366b91a5eb83aa1e9f', 'i:1;', 1732431523),
('7b5aa08abdfaf4366b91a5eb83aa1e9f:timer', 'i:1732431523;', 1732431523),
('96154577e6ad92ca81451d577c9d5c97', 'i:2;', 1732435364),
('96154577e6ad92ca81451d577c9d5c97:timer', 'i:1732435364;', 1732435364);

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
(1, 6, 2, 'halo', '2024-11-24 00:59:34', '2024-11-24 00:59:34'),
(2, 4, 4, 'wah tertarik dengan jurusan ini', '2024-11-24 01:44:21', '2024-11-24 01:44:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 'hani', 'hanihun@gmail.com', 'semangat smkn 4', '2024-11-24 01:43:14', '2024-11-24 01:43:14');

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
(1, 'Ujikom', 'Disini adalah galery ujikom semua jurusan', 0, '2024-11-24', 'active', 3, 1, '2024-11-24 00:11:01', '2024-11-24 00:11:01'),
(2, 'Jurusan', 'Disini Galery semua jurusan', 0, '2024-11-24', 'active', 3, 1, '2024-11-24 00:11:23', '2024-11-24 00:11:23');

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
(1, 'Senam P5', 'Kegiatan Pelaksanaan Kamis Sehat/Senam dalam rangka membentuk Projek Penguatan Profil Pelajar Pancasila. Kegiatan ini Dilaksanakan dilapangan SMK Negeri 4 Bogor pada Kamis, 21 November 2024', 'informasi/1732432133_468052233_1108708934293651_6465126542562120754_n.jpg', '2024-11-21', 'active', 1, 1, '2024-11-24 00:08:53', '2024-11-24 00:09:15');

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
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'PPLG', 'Pengembangan Perangkat Lunak dan Gim merupakan kompetensi keahlian yang awal mulanya bernama Rekayasa Perangkat Lunak (RPL). Sesuai dengan namanya keahlian yang dipelajari pada kompetensi ini pun berkisar seputar pembuatan perangkat lunak (software) dan pembuatan gim.', '2024-11-24 00:16:58', '2024-11-24 00:16:58'),
(2, 'TJKT', 'Teknik Jaringan Komputer dan Telekomunikasi awalnya bernama Teknik Komputer dan Jaringan (TKJ). Awalnya kompetensi keahlian ini berada pada satu bidang keahlian yang sama dengan kompetensi keahlian RPL. Namun setelah adanya perubahan di kurikulum merdeka, kompetensi keahlian ini memiliki bidang yang berbeda dengan kompetensi keahlian RPL. Sesuai dengan namanya kompetensi keahlian TKJ berfokus pada pembuatan jaringan untuk layanan komunikasi dan perakitan komputer.', '2024-11-24 00:17:24', '2024-11-24 00:17:24'),
(3, 'TO', 'Teknik Otomotif merupakan kompetensi keahlian yang berfokus untuk melakukan perbaikan pada berbagai kendaraan roda empat. Semula jurusan ini bernama Teknik Kendaraan Ringan (TKR), namun kini berganti nama seiring dengan perubahan kurikulum merdeka.', '2024-11-24 00:18:44', '2024-11-24 00:18:44'),
(4, 'TPFL', 'Teknik Pengelasan dan Fabrikasi Logam, merupakan jurusan yang di dominasi oleh kaum laki-laki. Seperti namanya, kompetensi keahlian ini berfokus pada pembuatan perangkat dengan meggunakan bahan dasar logam, seperti halnya rak sepatu, tralis, lemari besi, dan lain sebagainya.', '2024-11-24 00:19:06', '2024-11-24 00:19:06');

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
(1, 'Informasi', 'informasi smkn 4 kota bogor', '2024-11-23 23:58:56', '2024-11-23 23:58:56'),
(2, 'Agenda', 'agenda smkn 4 kota bogor', '2024-11-23 23:59:16', '2024-11-23 23:59:16'),
(3, 'Galery', 'galery smkn 4 kota bogor', '2024-11-24 00:00:05', '2024-11-24 00:00:05');

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
(1, 7, 1, '2024-11-24 00:46:10', '2024-11-24 00:46:10'),
(2, 6, 1, '2024-11-24 00:46:13', '2024-11-24 00:46:13'),
(3, 5, 1, '2024-11-24 00:46:15', '2024-11-24 00:46:15'),
(4, 8, 1, '2024-11-24 00:46:17', '2024-11-24 00:46:17'),
(5, 5, 2, '2024-11-24 00:49:53', '2024-11-24 00:49:53'),
(6, 7, 2, '2024-11-24 00:51:03', '2024-11-24 00:51:03'),
(8, 6, 2, '2024-11-24 00:51:06', '2024-11-24 00:51:06'),
(9, 8, 2, '2024-11-24 00:57:30', '2024-11-24 00:57:30'),
(10, 1, 2, '2024-11-24 01:02:16', '2024-11-24 01:02:16'),
(11, 2, 2, '2024-11-24 01:02:16', '2024-11-24 01:02:16'),
(12, 3, 2, '2024-11-24 01:02:18', '2024-11-24 01:02:18'),
(13, 4, 2, '2024-11-24 01:02:20', '2024-11-24 01:02:20'),
(14, 1, 4, '2024-11-24 01:44:02', '2024-11-24 01:44:02'),
(15, 2, 4, '2024-11-24 01:44:04', '2024-11-24 01:44:04'),
(16, 3, 4, '2024-11-24 01:44:05', '2024-11-24 01:44:05'),
(17, 4, 4, '2024-11-24 01:44:07', '2024-11-24 01:44:07');

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
(4, '2024_03_21_000000_add_last_login_at_to_users_table', 1),
(5, '2024_09_28_074550_create_petugas_table', 1),
(6, '2024_09_28_074734_create_profiles_table', 1),
(7, '2024_09_29_075015_add_two_factor_columns_to_users_table', 1),
(8, '2024_09_29_085312_create_personal_access_tokens_table', 1),
(9, '2024_09_30_025852_create_kategoris_table', 1),
(10, '2024_09_30_025900_create_informasis_table', 1),
(11, '2024_09_30_025904_create_agendas_table', 1),
(12, '2024_09_30_025907_create_galeries_table', 1),
(13, '2024_09_30_153601_create_sliders_table', 1),
(14, '2024_10_03_131535_create_photos_table', 1),
(15, '2024_10_08_114612_create_likes_table', 1),
(16, '2024_10_08_114630_create_comments_table', 1),
(17, '2024_10_14_123759_add_role_to_users_table', 1),
(18, '2024_11_05_124439_create_views_table', 1),
(19, '2024_11_05_125423_create_replies_table', 1),
(20, '2024_11_16_091844_create_contacts_table', 1),
(21, '2024_11_17_021926_jurusan', 1),
(22, '2024_11_24_063347_create_profil_sekolah_table', 1);

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
(1, 2, 'images/photos/ErVCzOcXVGqZLHOTgXAuaJg31DqWlCn8UA61TCMB.png', 'PPLG', 1, '2024-11-24 00:11:53', '2024-11-24 00:11:53'),
(2, 2, 'images/photos/BrzWOypcXMs0DTBc5siSPtIQk7UsZTT34eVt0DHb.png', 'TO', 1, '2024-11-24 00:12:18', '2024-11-24 00:12:18'),
(3, 2, 'images/photos/JVTnlgPsNPrF7KvjD4nq5wy5StgeugvCSMnFu4Qd.png', 'TJKT', 1, '2024-11-24 00:12:38', '2024-11-24 00:12:38'),
(4, 2, 'images/photos/ABp3Nvsx5Mnhl3YD8ALwXasZyNj1AuIHpfQWnlVS.jpg', 'TPFL', 1, '2024-11-24 00:12:57', '2024-11-24 00:12:57'),
(5, 1, 'images/photos/ou1pO9AfhYK3sdCAMfXykgbpHGc6aQ0KHPfdZGYt.jpg', 'Ujikom PPLG', 1, '2024-11-24 00:13:35', '2024-11-24 00:13:35'),
(6, 1, 'images/photos/ONoSaWmLuR6BD8z5NtQCMRmUkbFGIgoigbhHlN61.jpg', 'Ujikom TJKT', 1, '2024-11-24 00:14:49', '2024-11-24 00:14:49'),
(7, 1, 'images/photos/NRXwVcGivVH7R1wwujwJajgCapDIQrBAGmBK1gFG.jpg', 'Ujikom TO', 1, '2024-11-24 00:15:12', '2024-11-24 00:15:12'),
(8, 1, 'images/photos/LhNBs7EPxruDARtox57N2MzamXq7KJRYH3iU6Mlr.jpg', 'Ujikom TPFL', 1, '2024-11-24 00:15:35', '2024-11-24 00:15:35');

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
-- Struktur dari tabel `profil_sekolah`
--

CREATE TABLE `profil_sekolah` (
  `id` bigint UNSIGNED NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `visi` text COLLATE utf8mb4_unicode_ci,
  `misi` text COLLATE utf8mb4_unicode_ci,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `welcome_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Selamat Datang Di Edu Galery',
  `welcome_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Membangun Generasi Digital yang Unggul dan Berkarakter',
  `welcome_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `profil_sekolah`
--

INSERT INTO `profil_sekolah` (`id`, `deskripsi`, `visi`, `misi`, `video_url`, `welcome_title`, `welcome_subtitle`, `welcome_description`, `created_at`, `updated_at`) VALUES
(1, 'Merupakan sekolah kejuruan berbasis Teknologi Informasi dan Komunikasi. Sekolah ini didirikan dan dirintis pada tahun 2008 kemudian dibuka pada tahun 2009 yang saat ini terakreditasi A. Terletak di Jalan Raya Tajur Kp. Buntar, Muarasari, Bogor, sekolah ini berdiri di atas lahan seluas 12.724 m2 dengan berbagai fasilitas pendukung di dalamnya. Terdapat 54 staff pengajar dan 22 orang staff tata usaha, dikepalai oleh Drs. Mulya Mulprihartono, M. Si, sekolah ini merupakan investasi pendidikan yang tepat untuk putra/putri anda.', 'Terwujudnya SMK Pusat Keunggulan melalui terciptanya pelajar pancasila yang berbasis teknologi, berwawasan lingkungan dan berkewirausahaan.Terwujudnya SMK Pusat Keunggulan melalui terciptanya pelajar pancasila yang berbasis teknologi, berwawasan lingkungan dan berkewirausahaan.', '<ul>\r\n<li> 1. Mewujudkan karakter pelajar pancasila beriman dan bertaqwa kepada Tuhan Yang Maha Esa dan berakhlak mulia, berkebhinekaan global, gotong royong, mandiri, kreatif dan bernalar kritis.</li>\r\n<li> 2. Mengembangkan pembelajaran dan pengelolaan sekolah berbasis Teknologi Informasi dan Komunikasi.</li>\r\n<li>3.  Mengembangkan sekolah yang berwawasan Adiwiyata Mandiri.</li>\r\n<li> 4. Mengembangkan usaha dalam berbagai bidang secara optimal sehingga memiliki kemandirian dan daya saing tinggi.</li>\r\n</ul>', 'https://www.youtube.com/embed/UmFTAcr6lAc?si=PcTBkRkZ9Fk71WFv', 'Selamat Datang Di Edu Galery', 'Membangun Generasi Digital dan Unggul', NULL, '2024-11-23 23:51:47', '2024-11-24 17:38:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `replies`
--

CREATE TABLE `replies` (
  `id` bigint UNSIGNED NOT NULL,
  `comment_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `reply` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `replies`
--

INSERT INTO `replies` (`id`, `comment_id`, `user_id`, `reply`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'halo', '2024-11-24 01:00:47', '2024-11-24 01:00:47');

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
('fYftBNTJZhapemcwRUejTf4kJPehFemduaTZrWs9', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ3NLb2ZEOERCZGQ0YUxDcGJPR2JKTGVDSHlqa0E2eGtjdnUxRVhpYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1732495480);

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
(1, 'slider/AReiwSWiVKZHiHglGRqN5MP51kSwf3DrFIyrvYGm.jpg', '#', '2024-11-24 00:15:56', '2024-11-24 00:15:56'),
(2, 'slider/0D1H7qAKCnMFOxPshUGNxfpXplIwYjo7t7htQs6O.jpg', '#', '2024-11-24 00:16:11', '2024-11-24 00:16:11');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `avatar`, `role`, `remember_token`, `created_at`, `updated_at`, `last_login_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', NULL, '$2y$12$KiC0BIgB6EnYQi6MzDZmr.AuLS4NnONSrEqzupnFNV6mvEnksv8se', NULL, NULL, NULL, NULL, 'admin', 'OjUjjXgantzsx23QwOuStN68sBEbWMjv94lpQGY4Zq4wm6WSGOvcyIAQeQin', '2024-11-23 23:47:32', '2024-11-23 23:50:21', NULL),
(2, 'Kamila', 'kp.herlambang@gmail.com', NULL, '$2y$12$TkIfCsNkS80l1Wy.fIF.jOfFnDc1emgmyCbAnpnH4IJv.reAM/9G2', NULL, NULL, NULL, 'avatars/3KfEwNkdjYvfUcmUEObYsv88ErY8sKGdZZFQ8Jmq.jpg', 'user', 'mFUJxa8OKRfZOifDW5doDrkOPGlWGqRLmjLZqDi6i5JkfZsWfN4ONgZmEbrX', '2024-11-23 23:47:32', '2024-11-24 16:08:59', NULL),
(4, 'Siti Nur Hanifah', 'hanihun@gmail.com', NULL, '$2y$12$zRqh5mK5NTDLVXVXWtuS6uF2K8huF73cRlZ1REG4SnQ0da1N21EMq', NULL, NULL, NULL, NULL, 'user', NULL, '2024-11-24 01:41:41', '2024-11-24 01:41:41', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `views`
--

CREATE TABLE `views` (
  `id` bigint UNSIGNED NOT NULL,
  `photo_id` bigint UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `views`
--

INSERT INTO `views` (`id`, `photo_id`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 8, NULL, NULL, '2024-11-24 00:37:47', '2024-11-24 00:37:47'),
(2, 8, NULL, NULL, '2024-11-24 00:39:17', '2024-11-24 00:39:17'),
(3, 7, NULL, NULL, '2024-11-24 00:39:42', '2024-11-24 00:39:42'),
(4, 7, NULL, NULL, '2024-11-24 00:39:54', '2024-11-24 00:39:54'),
(5, 7, NULL, NULL, '2024-11-24 00:40:10', '2024-11-24 00:40:10'),
(6, 7, NULL, NULL, '2024-11-24 00:40:56', '2024-11-24 00:40:56'),
(7, 7, NULL, NULL, '2024-11-24 00:41:25', '2024-11-24 00:41:25'),
(8, 7, NULL, NULL, '2024-11-24 00:42:13', '2024-11-24 00:42:13'),
(9, 7, NULL, NULL, '2024-11-24 00:45:03', '2024-11-24 00:45:03'),
(10, 7, NULL, NULL, '2024-11-24 00:45:31', '2024-11-24 00:45:31'),
(11, 7, NULL, NULL, '2024-11-24 00:45:41', '2024-11-24 00:45:41'),
(12, 7, NULL, NULL, '2024-11-24 00:46:58', '2024-11-24 00:46:58'),
(13, 7, NULL, NULL, '2024-11-24 00:47:20', '2024-11-24 00:47:20'),
(14, 7, NULL, NULL, '2024-11-24 00:48:32', '2024-11-24 00:48:32'),
(15, 7, NULL, NULL, '2024-11-24 00:49:49', '2024-11-24 00:49:49'),
(16, 7, NULL, NULL, '2024-11-24 00:51:59', '2024-11-24 00:51:59'),
(17, 5, NULL, NULL, '2024-11-24 00:52:05', '2024-11-24 00:52:05'),
(18, 5, NULL, NULL, '2024-11-24 00:52:07', '2024-11-24 00:52:07'),
(19, 5, NULL, NULL, '2024-11-24 00:52:09', '2024-11-24 00:52:09'),
(20, 5, NULL, NULL, '2024-11-24 00:52:11', '2024-11-24 00:52:11'),
(21, 5, NULL, NULL, '2024-11-24 00:52:18', '2024-11-24 00:52:18'),
(22, 7, NULL, NULL, '2024-11-24 00:54:20', '2024-11-24 00:54:20'),
(23, 6, NULL, NULL, '2024-11-24 00:54:30', '2024-11-24 00:54:30'),
(24, 6, NULL, NULL, '2024-11-24 00:54:41', '2024-11-24 00:54:41'),
(25, 6, NULL, NULL, '2024-11-24 00:56:41', '2024-11-24 00:56:41'),
(26, 6, NULL, NULL, '2024-11-24 00:59:25', '2024-11-24 00:59:25'),
(27, 6, NULL, NULL, '2024-11-24 00:59:35', '2024-11-24 00:59:35'),
(28, 7, NULL, NULL, '2024-11-24 01:00:39', '2024-11-24 01:00:39'),
(29, 7, NULL, NULL, '2024-11-24 01:00:47', '2024-11-24 01:00:47'),
(30, 7, NULL, NULL, '2024-11-24 01:01:14', '2024-11-24 01:01:14'),
(31, 7, NULL, NULL, '2024-11-24 01:01:55', '2024-11-24 01:01:55'),
(32, 1, NULL, NULL, '2024-11-24 01:02:12', '2024-11-24 01:02:12'),
(33, 3, NULL, NULL, '2024-11-24 01:10:49', '2024-11-24 01:10:49'),
(34, 1, NULL, NULL, '2024-11-24 01:43:59', '2024-11-24 01:43:59'),
(35, 1, NULL, NULL, '2024-11-24 01:44:21', '2024-11-24 01:44:21'),
(36, 8, NULL, NULL, '2024-11-24 16:28:23', '2024-11-24 16:28:23');

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
-- Indeks untuk tabel `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
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
-- Indeks untuk tabel `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replies_comment_id_foreign` (`comment_id`),
  ADD KEY `replies_user_id_foreign` (`user_id`);

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
-- Indeks untuk tabel `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `views_photo_id_foreign` (`photo_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `profile`
--
ALTER TABLE `profile`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `views`
--
ALTER TABLE `views`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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

--
-- Ketidakleluasaan untuk tabel `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `views_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
