-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 12, 2023 at 11:55 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spd_2023`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '127.0.0.1', 'ari.sukendro@gmail.com', NULL, '2023-03-10 20:31:11', 0),
(2, '127.0.0.1', 'ari.sukendro', NULL, '2023-03-10 20:31:26', 0),
(3, '127.0.0.1', 'arisukendro@gmail.com', 1, '2023-03-10 20:33:16', 1),
(4, '127.0.0.1', 'arisukendro@gmail.com', 1, '2023-03-10 20:43:02', 1),
(5, '127.0.0.1', 'arisukendro@gmail.com', 1, '2023-03-11 05:19:56', 1),
(6, '127.0.0.1', 'arisukendro@gmail.com', 1, '2023-03-11 09:19:14', 1),
(7, '127.0.0.1', 'arisukendro@gmail.com', 1, '2023-03-11 21:19:43', 1),
(8, '127.0.0.1', 'arisukendro@gmail.com', 1, '2023-03-13 05:39:03', 1),
(9, '127.0.0.1', 'arisukendro@gmail.com', 1, '2023-03-13 05:49:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `klompeg_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `klompeg_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kasubbag', 3, '2022-12-27 22:24:17', '2022-12-28 19:13:02', '0000-00-00 00:00:00'),
(3, 'Fungsional Bendahara', 3, '2022-12-27 22:24:42', '2022-12-28 18:57:31', '0000-00-00 00:00:00'),
(4, 'Ketua', 1, '2022-12-27 22:24:52', '2022-12-27 22:24:52', '0000-00-00 00:00:00'),
(5, 'Anggota', 1, '2022-12-27 22:24:59', '2022-12-27 22:24:59', '0000-00-00 00:00:00'),
(6, 'Sekretaris', 3, '2022-12-28 00:44:26', '2022-12-28 18:57:19', '0000-00-00 00:00:00'),
(8, 'Staf', 3, '2022-12-28 18:23:27', '2022-12-28 19:12:53', '0000-00-00 00:00:00'),
(9, '-', 4, '2022-12-28 20:23:28', '2022-12-28 20:23:28', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `klompeg`
--

CREATE TABLE `klompeg` (
  `id_klompeg` int(11) NOT NULL,
  `nama_klompeg` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klompeg`
--

INSERT INTO `klompeg` (`id_klompeg`, `nama_klompeg`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'KPU Kab.  Cilacap', '2022-12-28 07:10:47', '2022-12-28 19:13:51', '0000-00-00 00:00:00'),
(3, 'Sekretariat KPU Kab. Cilacap', '2022-12-28 18:10:14', '2022-12-28 19:13:55', '0000-00-00 00:00:00'),
(4, 'Non-KPU', '2022-12-28 20:22:20', '2022-12-28 20:23:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `nama_lokasi` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `kota_lokasi` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id_lokasi`, `nama_lokasi`, `alamat`, `kota_lokasi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 'Kantor KPU Provinsi Jawa Tengah ', 'Jln Veteran ', 'Semarang', '0000-00-00 00:00:00', '2023-01-22 19:07:15', '2022-12-19 22:43:02'),
(14, 'Kantor Kec. Jeruklegi', '', 'Jeruklegi', '0000-00-00 00:00:00', '2022-12-28 20:29:27', '2022-12-19 22:34:14'),
(15, 'Kantor KPU RI', 'Jln Imam Bonjol', 'Jakarta', '0000-00-00 00:00:00', '2022-12-28 20:29:04', '2022-12-19 22:35:15'),
(29, 'Hotel Laras Asri Salatiga', '', 'Salatiga', '2023-01-22 22:55:59', '2023-01-22 22:55:59', '0000-00-00 00:00:00'),
(30, 'Hotel Sindoro Cilacap', '', 'Cilacap', '2023-01-22 22:58:39', '2023-01-22 22:59:19', '0000-00-00 00:00:00'),
(31, 'nusawungu', '', 'nsqunu', '2023-01-22 23:10:42', '2023-03-04 13:45:09', '0000-00-00 00:00:00'),
(39, 'kantor kelurahan', '', 'lokasinya mana', '2023-01-25 18:00:07', '2023-01-25 18:00:07', '0000-00-00 00:00:00'),
(41, 'bukan laras asri', '', 'bukan saatiga', '2023-02-25 06:13:40', '2023-02-25 06:13:40', '0000-00-00 00:00:00'),
(42, 'cilacap utara', '', 'cilacap', '2023-02-25 10:58:44', '2023-02-25 10:58:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1678285696, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `setkom` varchar(20) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `golongan` varchar(10) DEFAULT NULL,
  `pangkat` varchar(200) DEFAULT NULL,
  `klompeg_id` int(11) NOT NULL,
  `jabatan_id` int(11) DEFAULT NULL,
  `subbag_id` int(11) DEFAULT NULL,
  `aktif` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `setkom`, `nama`, `nip`, `golongan`, `pangkat`, `klompeg_id`, `jabatan_id`, `subbag_id`, `aktif`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 'sekretaris', 'Ari Sukendro, S.Kom', '3i4923i4092i40932i4', 'IIIb', 'Penata Muda Tingkat I', 3, 8, 11, 1, '2022-12-29 04:27:38', '2023-02-26 07:22:43', '0000-00-00 00:00:00'),
(10, 'ketua', 'Karsito, S.Sos', '', NULL, NULL, 3, 6, 15, 1, '2022-12-29 04:30:27', '2023-02-26 07:22:56', '0000-00-00 00:00:00'),
(11, 'ketua', 'Handi Tri Ujiono, S.Sos', '', NULL, NULL, 1, 4, 2, 1, '2022-12-30 21:14:23', '2023-02-26 11:27:10', '0000-00-00 00:00:00'),
(12, 'sekretaris', 'Anggit Purnomo, A.Md', '', 'IId', 'Pengatur Tingkat I', 3, 3, 15, 1, '2022-12-31 04:06:56', '2023-02-26 07:23:14', '0000-00-00 00:00:00'),
(13, 'sekretaris', 'Hari Sugiharto, SH, MH', '72281737897937293729', NULL, NULL, 3, 1, 6, 1, '2022-12-31 04:07:49', '2023-02-26 07:23:20', '0000-00-00 00:00:00'),
(14, 'ketua', 'Weweng Maretno, S.Sos', '', NULL, NULL, 1, 5, 9, 1, '2022-12-31 04:08:27', '2023-02-26 07:22:28', '0000-00-00 00:00:00'),
(15, 'ketua', 'M. Muhni, S.Pd.I', '', NULL, NULL, 1, 5, 10, 1, '2022-12-31 04:08:46', '2023-02-26 07:22:32', '0000-00-00 00:00:00'),
(16, 'ketua', 'Ami Purwandari, SE', '', NULL, NULL, 1, 5, 8, 1, '2022-12-31 04:54:33', '2023-02-26 07:22:36', '0000-00-00 00:00:00'),
(17, 'sekretaris', 'Yuni Artiti, S.I.P', '', NULL, NULL, 3, 8, 13, 1, '2023-02-25 11:23:54', '2023-02-26 07:23:26', '0000-00-00 00:00:00'),
(18, 'sekretaris', 'Dading Ardiyanto, S.I.P', '888', 'IIIc', 'Penata', 3, 1, 6, 1, '2023-02-25 11:24:24', '2023-02-26 07:23:32', '0000-00-00 00:00:00'),
(19, 'sekretaris', 'Riyanto', '', NULL, NULL, 3, 8, 13, 1, '2023-02-25 11:24:46', '2023-02-26 07:23:44', '0000-00-00 00:00:00'),
(20, 'sekretaris', 'Suprapto', '', NULL, NULL, 3, 8, 13, 1, '2023-02-25 11:25:01', '2023-02-26 07:24:02', '0000-00-00 00:00:00'),
(21, 'sekretaris', 'Rahmat Yulianto', '', NULL, NULL, 3, 8, 13, 1, '2023-02-25 11:25:20', '2023-02-26 07:24:17', '0000-00-00 00:00:00'),
(22, 'sekretaris', 'Joko Amboro', '', NULL, NULL, 3, 8, 13, 1, '2023-02-25 11:25:36', '2023-02-26 07:24:28', '0000-00-00 00:00:00'),
(23, 'sekretaris', 'Yasin', '', NULL, NULL, 3, 8, 13, 1, '2023-02-25 11:25:47', '2023-02-26 07:24:39', '0000-00-00 00:00:00'),
(24, 'sekretaris', 'Oktaf Giar Purnomo', '', NULL, NULL, 3, 8, 13, 1, '2023-02-25 11:26:03', '2023-02-26 07:24:47', '0000-00-00 00:00:00'),
(25, 'sekretaris', 'Dwipa Tri Budi, A.Md', '', NULL, NULL, 3, 8, 11, 1, '2023-02-25 11:26:26', '2023-02-26 07:24:54', '0000-00-00 00:00:00'),
(26, 'sekretaris', 'Sri Andriyani, S.Sos', '', NULL, NULL, 3, 8, 12, 1, '2023-02-25 11:26:48', '2023-02-26 07:25:05', '0000-00-00 00:00:00'),
(27, 'sekretaris', 'Laila Isnaini, S.Sos', '', NULL, NULL, 3, 1, 12, 1, '2023-02-25 11:27:09', '2023-02-26 07:25:13', '0000-00-00 00:00:00'),
(33, 'ketua', 'Anggota DPR', '', NULL, NULL, 4, 9, 14, 0, '2023-02-26 08:03:59', '2023-02-26 08:05:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `penandatangan`
--

CREATE TABLE `penandatangan` (
  `id_penandatangan` int(11) NOT NULL,
  `ketua` varchar(100) NOT NULL,
  `plt_ketua` varchar(100) NOT NULL,
  `plh_ketua` varchar(100) NOT NULL,
  `sekretaris` varchar(100) NOT NULL,
  `nip_sekretaris` varchar(20) DEFAULT NULL,
  `plt_sekretaris` varchar(100) NOT NULL,
  `nip_plt_sekretaris` varchar(20) DEFAULT NULL,
  `plh_sekretaris` varchar(100) NOT NULL,
  `nip_plh_sekretaris` varchar(20) NOT NULL,
  `ppkom` varchar(100) NOT NULL,
  `nip_ppkom` varchar(20) DEFAULT NULL,
  `bendahara` varchar(100) NOT NULL,
  `nip_bendahara` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penandatangan`
--

INSERT INTO `penandatangan` (`id_penandatangan`, `ketua`, `plt_ketua`, `plh_ketua`, `sekretaris`, `nip_sekretaris`, `plt_sekretaris`, `nip_plt_sekretaris`, `plh_sekretaris`, `nip_plh_sekretaris`, `ppkom`, `nip_ppkom`, `bendahara`, `nip_bendahara`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Handi Tri Ujiono', 'M. Muhni', 'Weweng Maretno', 'Karsito', '99', 'Hari Sugiharto', '88', 'Dedy Chriswanto', '77', 'Hari Sugiharto', '66', 'Anggit', '55', '2022-12-30 00:20:07', '2023-03-04 11:34:16', '2022-12-30 00:20:07');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `nama_instansi` int(11) NOT NULL,
  `alamat` int(11) NOT NULL,
  `telpon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spd`
--

CREATE TABLE `spd` (
  `id_spd` int(11) NOT NULL,
  `nomor_spd` varchar(100) NOT NULL,
  `st_personil_id` int(11) NOT NULL,
  `kendaraan` varchar(50) DEFAULT NULL,
  `tingkat_spd` varchar(20) NOT NULL,
  `sumber_dana` varchar(100) DEFAULT NULL,
  `jenis_formulir` varchar(20) NOT NULL,
  `akun_anggaran` varchar(20) DEFAULT NULL,
  `kota_ttd_spd` varchar(200) NOT NULL,
  `tanggal_ttd_spd` date NOT NULL,
  `jabatan_ttd_spd` varchar(200) DEFAULT NULL,
  `nama_ttd_spd` varchar(200) NOT NULL,
  `nip_ttd_spd` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spd`
--

INSERT INTO `spd` (`id_spd`, `nomor_spd`, `st_personil_id`, `kendaraan`, `tingkat_spd`, `sumber_dana`, `jenis_formulir`, `akun_anggaran`, `kota_ttd_spd`, `tanggal_ttd_spd`, `jabatan_ttd_spd`, `nama_ttd_spd`, `nip_ttd_spd`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(24, '7/RT.02.01-SPD/3301/PPK-Kab/3301/2023', 62, 'Kendaraan', 'Tingkat C', 'APBN', 'Lembar Konfirmasi', '', 'Cilacap', '2023-03-07', 'Pejabat Pembuat Komitmen', 'Hari Sugiharto', 66, '2023-03-07 21:21:08', 1, '2023-03-11 05:21:58', 2, '0000-00-00 00:00:00', 0),
(25, '8/RT.02.01-SPD/3301/PPK-Kab/3301/2023', 63, 'Kendaraan', 'Tingkat C', 'APBN', 'Lembar Konfirmasi', '', 'Cilacap', '2023-03-07', 'Pejabat Pembuat Komitmen', 'Hari Sugiharto', 66, '2023-03-07 21:21:14', 1, '2023-03-11 05:22:03', 2, '0000-00-00 00:00:00', 0),
(27, '9/RT.02.01-SPD.LK/3301/2023', 81, 'Kendaraan', 'Tingkat C', 'APBN', 'Lembar Konfirmasi', '', 'Cilacap', '2023-03-11', 'Pejabat Pembuat Komitmen', 'Hari Sugiharto', 66, '2023-03-11 05:20:46', 1, '2023-03-11 05:20:46', 0, '0000-00-00 00:00:00', 0),
(28, '10/RT.02.01-SPD.LK/3301/2023', 82, 'Kendaraan', 'Tingkat C', 'APBN', 'Lembar Konfirmasi', '', 'Cilacap', '2023-03-11', 'Pejabat Pembuat Komitmen', 'Hari Sugiharto', 66, '2023-03-11 05:20:54', 1, '2023-03-11 05:20:54', 0, '0000-00-00 00:00:00', 0),
(29, '11/RT.02.01-SPD.LK/3301/2023', 83, 'Kendaraan', 'Tingkat C', 'APBN', 'Lembar Konfirmasi', '', 'Cilacap', '2023-03-11', 'Pejabat Pembuat Komitmen', 'Hari Sugiharto', 66, '2023-03-11 05:21:01', 1, '2023-03-11 05:21:01', 0, '0000-00-00 00:00:00', 0),
(30, '12/RT.02.01-SPD.LK/3301/2023', 84, 'Kendaraan', 'Tingkat C', 'APBN', 'Lembar Konfirmasi', '', 'Cilacap', '2023-03-11', 'Pejabat Pembuat Komitmen', 'Hari Sugiharto', 66, '2023-03-11 05:21:07', 1, '2023-03-11 05:21:07', 0, '0000-00-00 00:00:00', 0),
(31, '13/RT.02.01-SPD.LK/3301/2023', 85, 'Kendaraan', 'Tingkat C', 'APBN', 'Lembar Konfirmasi', '', 'Cilacap', '2023-03-11', 'Pejabat Pembuat Komitmen', 'Hari Sugiharto', 66, '2023-03-11 05:21:13', 1, '2023-03-11 05:21:13', 0, '0000-00-00 00:00:00', 0),
(33, '15/RT.02.01-SPD.LK/3301/2023', 79, 'Kendaraan', 'Tingkat C', 'APBN', 'SPD', '', 'Cilacap', '2023-03-10', 'Pejabat Pembuat Komitmen', 'Hari Sugiharto', 66, '2023-03-11 05:21:35', 1, '2023-03-11 05:21:35', 0, '0000-00-00 00:00:00', 0),
(34, '16/RT.02.01-SPD.LK/3301/2023', 80, 'Kendaraan', 'Tingkat C', 'APBN', 'SPD', '', 'Cilacap', '2023-03-10', 'Pejabat Pembuat Komitmen', 'Hari Sugiharto', 66, '2023-03-11 05:21:38', 1, '2023-03-11 05:21:38', 0, '0000-00-00 00:00:00', 0),
(35, '17/RT.02.01-SPD.LK/3301/2023', 59, 'Kendaraan', 'Tingkat C', 'APBN', 'Lembar Konfirmasi', '', 'Cilacap', '2023-03-07', 'Pejabat Pembuat Komitmen', 'Hari Sugiharto', 66, '2023-03-11 05:21:51', 1, '2023-03-11 05:21:51', 0, '0000-00-00 00:00:00', 0),
(36, '18/RT.02.01-SPD.LK/3301/2023', 78, 'Kendaraan', 'Tingkat C', 'APBN', 'SPD', '', 'Cilacap', '2023-03-10', 'Pejabat Pembuat Komitmen', 'Hari Sugiharto', 66, '2023-03-11 09:21:30', 1, '2023-03-11 09:21:30', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subbag`
--

CREATE TABLE `subbag` (
  `id_subbag` int(11) NOT NULL,
  `nama_subbag` varchar(200) DEFAULT NULL,
  `klompeg_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subbag`
--

INSERT INTO `subbag` (`id_subbag`, `nama_subbag`, `klompeg_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Divisi Hukum', 1, '2022-12-28 17:09:10', '2022-12-28 19:35:05', '0000-00-00 00:00:00'),
(2, 'Divisi Keuangan & Logistik', 1, '2022-12-28 17:18:19', '2022-12-28 19:35:41', '0000-00-00 00:00:00'),
(6, 'Subbag Hukum & SDM', 3, '2022-12-28 18:10:25', '2022-12-28 18:10:25', '0000-00-00 00:00:00'),
(8, 'Divisi Datin dan Mutralih', 1, '2022-12-28 19:35:26', '2022-12-28 19:35:26', '0000-00-00 00:00:00'),
(9, 'Divisi Teknis Penyelengaraan', 1, '2022-12-28 19:35:58', '2022-12-28 19:35:58', '0000-00-00 00:00:00'),
(10, 'Divisi Sosialisasi & SDM', 1, '2022-12-28 19:36:14', '2022-12-28 19:36:14', '0000-00-00 00:00:00'),
(11, 'Subbag Teknis  Pemilu & Hupmas', 3, '2022-12-28 19:36:36', '2022-12-28 19:36:36', '0000-00-00 00:00:00'),
(12, 'Subbag Datin', 3, '2022-12-28 19:36:55', '2022-12-28 19:36:55', '0000-00-00 00:00:00'),
(13, 'Subbag KUL', 3, '2022-12-28 19:37:09', '2022-12-29 03:50:48', '0000-00-00 00:00:00'),
(14, '-', 4, '2022-12-28 20:23:18', '2022-12-28 20:23:18', '0000-00-00 00:00:00'),
(15, '-', 3, '2022-12-29 04:29:50', '2022-12-29 04:29:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `surat_tugas`
--

CREATE TABLE `surat_tugas` (
  `id_st` int(11) NOT NULL,
  `perihal_st` text NOT NULL,
  `jenis_st` varchar(100) NOT NULL,
  `nomor_st` varchar(250) NOT NULL,
  `tanggal_st` date NOT NULL,
  `dasar_st` text NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `kota_ttd` varchar(100) NOT NULL,
  `jabatan_ttd` varchar(100) NOT NULL,
  `nama_ttd` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_tugas`
--

INSERT INTO `surat_tugas` (`id_st`, `perihal_st`, `jenis_st`, `nomor_st`, `tanggal_st`, `dasar_st`, `tanggal_berangkat`, `tanggal_kembali`, `kota_ttd`, `jabatan_ttd`, `nama_ttd`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(14, 'perihal', 'sekretaris', '1/RT.02.01-ST/3301/Ses-Kab/2023', '2023-03-07', 'dasar ST', '2023-01-11', '2023-03-07', 'Cilacap', 'Sekretaris', 'Karsito', '2023-03-07 15:10:20', 1, '2023-03-07 17:55:37', 0, '0000-00-00 00:00:00', 0),
(16, 'perihal 2', 'sekretaris', '2/RT.02.01-ST/3301/Ses-Kab/2023', '2023-03-10', 'dasar 2', '2023-03-10', '2023-03-10', 'Cilacap', 'Sekretaris', 'Karsito', '2023-03-10 23:56:15', 1, '2023-03-10 23:56:15', 0, '0000-00-00 00:00:00', 0),
(17, 'perihal sekre akdlsakj lasdjlskajd lkajdlsajd lkasjdlsajkd klsajdlksajdl', 'ketua', '3/RT.02.01-ST/3301/KPU-Kab/2023', '2023-03-11', 'Dasar Ketua', '2023-03-11', '2023-03-11', 'Cilacap', 'Ketua', 'Handi Tri Ujiono', '2023-03-11 05:20:33', 1, '2023-03-11 05:20:33', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `surat_tugas_lokasi`
--

CREATE TABLE `surat_tugas_lokasi` (
  `id_st_lokasi` int(11) NOT NULL,
  `surat_tugas_id` int(11) NOT NULL,
  `nama_lokasi` varchar(50) NOT NULL,
  `alamat_lokasi` varchar(100) DEFAULT NULL,
  `kota_lokasi` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_tugas_lokasi`
--

INSERT INTO `surat_tugas_lokasi` (`id_st_lokasi`, `surat_tugas_id`, `nama_lokasi`, `alamat_lokasi`, `kota_lokasi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(75, 14, 'Hotel Sindoro Cilacap', '', 'Cilacap', '2023-03-07 17:55:37', '2023-03-07 17:55:37', '0000-00-00 00:00:00'),
(78, 16, 'cilacap utara', '', 'cilacap', '2023-03-10 23:56:15', '2023-03-10 23:56:15', '0000-00-00 00:00:00'),
(79, 16, 'cojadsa', 'asdna', 'sadaskjd', '2023-03-10 23:56:15', '2023-03-10 23:56:15', '0000-00-00 00:00:00'),
(80, 17, 'cojadsa', 'asdna', 'sadaskjd', '2023-03-11 05:20:33', '2023-03-11 05:20:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `surat_tugas_personil`
--

CREATE TABLE `surat_tugas_personil` (
  `id_st_personil` int(11) NOT NULL,
  `surat_tugas_id` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `pangkat` varchar(50) DEFAULT NULL,
  `golongan` varchar(20) DEFAULT NULL,
  `klompeg` varchar(200) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_tugas_personil`
--

INSERT INTO `surat_tugas_personil` (`id_st_personil`, `surat_tugas_id`, `pegawai_id`, `nama`, `nip`, `pangkat`, `golongan`, `klompeg`, `jabatan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(59, 14, 9, 'Ari Sukendro, S.Kom', '3i4923i4092i40932i4', NULL, 'IIIb', 'Sekretariat KPU Kab. Cilacap', 'Staf (Subbag Teknis  Pemilu & Hupmas)', '2023-03-07 15:10:20', '2023-03-07 15:10:20', '0000-00-00 00:00:00'),
(62, 14, 22, 'Joko Amboro', '', NULL, NULL, 'Sekretariat KPU Kab. Cilacap', 'Staf (Subbag KUL)', '2023-03-07 17:55:37', '2023-03-07 17:55:37', '0000-00-00 00:00:00'),
(63, 14, 17, 'Yuni Artiti, S.I.P', '', NULL, NULL, 'Sekretariat KPU Kab. Cilacap', 'Staf (Subbag KUL)', '2023-03-07 17:55:37', '2023-03-07 17:55:37', '0000-00-00 00:00:00'),
(78, 16, 9, 'Ari Sukendro, S.Kom', '3i4923i4092i40932i4', NULL, 'IIIb', 'Sekretariat KPU Kab. Cilacap', 'Staf (Subbag Teknis  Pemilu & Hupmas)', '2023-03-10 23:56:15', '2023-03-10 23:56:15', '0000-00-00 00:00:00'),
(79, 16, 18, 'Dading Ardiyanto, S.I.P', '888', NULL, 'IIIc', 'Sekretariat KPU Kab. Cilacap', 'Kasubbag (Subbag Hukum & SDM)', '2023-03-10 23:56:15', '2023-03-10 23:56:15', '0000-00-00 00:00:00'),
(80, 16, 25, 'Dwipa Tri Budi, A.Md', '', NULL, NULL, 'Sekretariat KPU Kab. Cilacap', 'Staf (Subbag Teknis  Pemilu & Hupmas)', '2023-03-10 23:56:15', '2023-03-10 23:56:15', '0000-00-00 00:00:00'),
(81, 17, 16, 'Ami Purwandari, SE', '', NULL, NULL, 'KPU Kab.  Cilacap', 'Anggota (Divisi Datin dan Mutralih)', '2023-03-11 05:20:33', '2023-03-11 05:20:33', '0000-00-00 00:00:00'),
(82, 17, 11, 'Handi Tri Ujiono, S.Sos', '', NULL, NULL, 'KPU Kab.  Cilacap', 'Ketua (Divisi Keuangan & Logistik)', '2023-03-11 05:20:33', '2023-03-11 05:20:33', '0000-00-00 00:00:00'),
(83, 17, 10, 'Karsito, S.Sos', '', NULL, NULL, 'Sekretariat KPU Kab. Cilacap', 'Sekretaris (-)', '2023-03-11 05:20:33', '2023-03-11 05:20:33', '0000-00-00 00:00:00'),
(84, 17, 15, 'M. Muhni, S.Pd.I', '', NULL, NULL, 'KPU Kab.  Cilacap', 'Anggota (Divisi Sosialisasi & SDM)', '2023-03-11 05:20:33', '2023-03-11 05:20:33', '0000-00-00 00:00:00'),
(85, 17, 14, 'Weweng Maretno, S.Sos', '', NULL, NULL, 'KPU Kab.  Cilacap', 'Anggota (Divisi Teknis Penyelengaraan)', '2023-03-11 05:20:33', '2023-03-11 05:20:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `template_surat_tugas`
--

CREATE TABLE `template_surat_tugas` (
  `id_template_st` int(11) NOT NULL,
  `nomor_urut` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `template_surat_tugas`
--

INSERT INTO `template_surat_tugas` (`id_template_st`, `nomor_urut`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 'Peraturan Menteri Keuangan Republik Indonesia Nomor 113/Pmk.05/2012 Tentang Perjalanan Dinas Dalam Negeri Bagi Pejabat Negara, Pegawai Negeri dan Pegawai Tidak Tetap;', '2022-12-29 16:33:25', '2022-12-29 16:33:25', '0000-00-00 00:00:00'),
(3, 2, 'Peraturan Direktur Jenderal Perbendaharaan Nomor Per-22/PB/2013 Tentang Ketentuan Lebih Lanjut Pelaksanaan Perjalanan Dinas Dalam Negeri Bagi Pejabat Negara, Pegawai Negeri dan Pegawai Tidak Tetap;', '2022-12-29 16:33:39', '2022-12-29 16:34:03', '0000-00-00 00:00:00'),
(4, 3, 'Peraturan Menteri Keuangan Nomor 60/PMK.02/2021 Tahun 2021 tentang Standar Biaya Masukan Tahun Anggaran 2022.', '2022-12-29 16:33:54', '2022-12-29 16:33:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'arisukendro@gmail.com', 'arisukendro', '$2y$10$lMAuv7xN/6FtM6Jfd6l/behajHpcGo.1hSpsB7U0s9a9jHb/9dP9W', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-03-10 20:33:04', '2023-03-10 20:33:04', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`),
  ADD KEY `instansi_id` (`klompeg_id`);

--
-- Indexes for table `klompeg`
--
ALTER TABLE `klompeg`
  ADD PRIMARY KEY (`id_klompeg`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `penandatangan`
--
ALTER TABLE `penandatangan`
  ADD PRIMARY KEY (`id_penandatangan`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indexes for table `spd`
--
ALTER TABLE `spd`
  ADD PRIMARY KEY (`id_spd`);

--
-- Indexes for table `subbag`
--
ALTER TABLE `subbag`
  ADD PRIMARY KEY (`id_subbag`),
  ADD KEY `instansi_id` (`klompeg_id`);

--
-- Indexes for table `surat_tugas`
--
ALTER TABLE `surat_tugas`
  ADD PRIMARY KEY (`id_st`);

--
-- Indexes for table `surat_tugas_lokasi`
--
ALTER TABLE `surat_tugas_lokasi`
  ADD PRIMARY KEY (`id_st_lokasi`),
  ADD KEY `surat_tugas_id` (`surat_tugas_id`);

--
-- Indexes for table `surat_tugas_personil`
--
ALTER TABLE `surat_tugas_personil`
  ADD PRIMARY KEY (`id_st_personil`),
  ADD KEY `surat_tugas_id` (`surat_tugas_id`);

--
-- Indexes for table `template_surat_tugas`
--
ALTER TABLE `template_surat_tugas`
  ADD PRIMARY KEY (`id_template_st`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `klompeg`
--
ALTER TABLE `klompeg`
  MODIFY `id_klompeg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `penandatangan`
--
ALTER TABLE `penandatangan`
  MODIFY `id_penandatangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spd`
--
ALTER TABLE `spd`
  MODIFY `id_spd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `subbag`
--
ALTER TABLE `subbag`
  MODIFY `id_subbag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `surat_tugas`
--
ALTER TABLE `surat_tugas`
  MODIFY `id_st` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `surat_tugas_lokasi`
--
ALTER TABLE `surat_tugas_lokasi`
  MODIFY `id_st_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `surat_tugas_personil`
--
ALTER TABLE `surat_tugas_personil`
  MODIFY `id_st_personil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `template_surat_tugas`
--
ALTER TABLE `template_surat_tugas`
  MODIFY `id_template_st` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `jabatan_ibfk_1` FOREIGN KEY (`klompeg_id`) REFERENCES `klompeg` (`id_klompeg`);

--
-- Constraints for table `subbag`
--
ALTER TABLE `subbag`
  ADD CONSTRAINT `subbag_ibfk_1` FOREIGN KEY (`klompeg_id`) REFERENCES `klompeg` (`id_klompeg`);

--
-- Constraints for table `surat_tugas_lokasi`
--
ALTER TABLE `surat_tugas_lokasi`
  ADD CONSTRAINT `surat_tugas_lokasi_ibfk_1` FOREIGN KEY (`surat_tugas_id`) REFERENCES `surat_tugas` (`id_st`);

--
-- Constraints for table `surat_tugas_personil`
--
ALTER TABLE `surat_tugas_personil`
  ADD CONSTRAINT `surat_tugas_personil_ibfk_1` FOREIGN KEY (`surat_tugas_id`) REFERENCES `surat_tugas` (`id_st`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
