-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2024 at 02:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agrilendweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_akun_pemerintah`
--

CREATE TABLE `data_akun_pemerintah` (
  `id_pemerintah` int(11) NOT NULL,
  `username_pemerintah` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_pemerintah` varchar(255) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `no_tlp` varchar(12) NOT NULL,
  `foto_profil` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_akun_pemerintah`
--

INSERT INTO `data_akun_pemerintah` (`id_pemerintah`, `username_pemerintah`, `password`, `nama_pemerintah`, `id_kota`, `no_tlp`, `foto_profil`) VALUES
(1, 'LMJ123', '$2y$10$hyRqOp8qMBQODzV56yYd4Oe1FCSTic0gQjova7sDxMtDJqiOYa7n6', 'Dinas Lumajang', 1, '081222222222', 0x666f746f732f4f75693656414c7636434f51656647344158307552575542786a66456a6e6a343445716e3544314a2e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `data_akun_petani`
--

CREATE TABLE `data_akun_petani` (
  `id_petani` int(11) NOT NULL,
  `username_petani` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_petani` varchar(255) NOT NULL,
  `ttl_petani` date NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `alamat_petani` varchar(255) NOT NULL,
  `id_desa` int(11) NOT NULL,
  `no_tlp` varchar(12) NOT NULL,
  `id_poktan` int(11) NOT NULL,
  `foto_profil` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_akun_petani`
--

INSERT INTO `data_akun_petani` (`id_petani`, `username_petani`, `password`, `nik`, `nama_petani`, `ttl_petani`, `pekerjaan`, `alamat_petani`, `id_desa`, `no_tlp`, `id_poktan`, `foto_profil`) VALUES
(1, 'qwerty12', '$2y$10$ths9wPFIIP4cZKNzDy8aKejeKK0Q2Df7e.GRwCgtvW98VcTlBjt..', '3514092222222222', 'Syahdiladarama', '2024-05-06', 'mahasiswa', 'Jl. Melati no 23', 1, '081244444444', 1, 0x666f746f732f53624a7155685649496252656564696c38376d374f6a70646931556a77454933483570726868497a2e6a7067),
(2, 'saya123', '$2y$10$YbfG/aBLD2ZgbziINk7g/uyyixHIOwwApMOxvFLfiNG5TzyFoVUEW', '3514095555555555', 'saya', '1986-07-17', 'buruh', 'jl. jawa no3', 1, '081288888888', 1, 0x666f746f732f4e3633684630595a684a756c596a68433364554d456f51726c753756497950546a7876487531587a2e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `data_akun_poktan`
--

CREATE TABLE `data_akun_poktan` (
  `id_poktan` int(11) NOT NULL,
  `username_poktan` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_poktan` varchar(255) NOT NULL,
  `alamat_poktan` varchar(255) NOT NULL,
  `id_desa` int(11) NOT NULL,
  `id_pemerintah` int(11) NOT NULL,
  `no_tlp` varchar(255) NOT NULL,
  `foto_profil` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_akun_poktan`
--

INSERT INTO `data_akun_poktan` (`id_poktan`, `username_poktan`, `password`, `nama_poktan`, `alamat_poktan`, `id_desa`, `id_pemerintah`, `no_tlp`, `foto_profil`) VALUES
(1, 'MLT1234', '$2y$10$FvlerVT64qx2HwtaPqy34.C3sQIGt7ZGL/8eZTRnPMkEVTenEDJvS', 'Poktan Melati', 'JL. Melati Desa Nogosari', 1, 1, '081233333333', 0x666f746f5f706f6b74616e2f506969303449314c3352744563574b4e5248414d334d51436e616d7a6b564a4f7444316e483753322e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `data_desa`
--

CREATE TABLE `data_desa` (
  `id_desa` int(11) NOT NULL,
  `desa` varchar(225) NOT NULL,
  `id_kota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_desa`
--

INSERT INTO `data_desa` (`id_desa`, `desa`, `id_kota`) VALUES
(1, 'Nogosari', 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_kota`
--

CREATE TABLE `data_kota` (
  `id_kota` int(11) NOT NULL,
  `kota` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_kota`
--

INSERT INTO `data_kota` (`id_kota`, `kota`) VALUES
(1, 'Lumajang'),
(2, 'Jember');

-- --------------------------------------------------------

--
-- Table structure for table `data_laporan`
--

CREATE TABLE `data_laporan` (
  `id_laporan` int(11) NOT NULL,
  `id_poktan` int(11) NOT NULL,
  `laporan` blob NOT NULL,
  `id_status_laporan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_metode_bayar`
--

CREATE TABLE `data_metode_bayar` (
  `id_metode` int(11) NOT NULL,
  `metode_bayar` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_metode_bayar`
--

INSERT INTO `data_metode_bayar` (`id_metode`, `metode_bayar`) VALUES
(1, 'Transfer'),
(2, 'Tunai');

-- --------------------------------------------------------

--
-- Table structure for table `data_pembayaran`
--

CREATE TABLE `data_pembayaran` (
  `id_bayar` int(11) NOT NULL,
  `id_petani` int(11) NOT NULL,
  `jml_kembali` int(12) NOT NULL,
  `id_metode` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_pengajuan_modal`
--

CREATE TABLE `data_pengajuan_modal` (
  `id_pengajuan` int(11) NOT NULL,
  `id_petani` int(11) NOT NULL,
  `jml_pinjam` int(12) NOT NULL,
  `bunga` int(11) NOT NULL,
  `jml_diterima` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tenggat_kembali` date NOT NULL,
  `id_status_pengajuan` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_pengajuan_modal`
--

INSERT INTO `data_pengajuan_modal` (`id_pengajuan`, `id_petani`, `jml_pinjam`, `bunga`, `jml_diterima`, `tgl_pinjam`, `tenggat_kembali`, `id_status_pengajuan`, `updated_at`, `created_at`) VALUES
(6, 1, 500000, 5000, 500000, '2024-05-24', '2024-06-07', 4, '2024-05-23 11:23:49', '2024-05-23 11:05:51'),
(7, 1, 500000, 10000, 500000, '2024-05-21', '2024-05-30', 1, '2024-05-23 23:40:04', '2024-05-23 23:40:04'),
(8, 2, 500000, 5000, 500000, '2024-05-22', '2024-06-06', 1, '2024-05-23 23:42:16', '2024-05-23 23:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `data_status_laporan`
--

CREATE TABLE `data_status_laporan` (
  `id_status_laporan` int(11) NOT NULL,
  `status_laporan` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_status_laporan`
--

INSERT INTO `data_status_laporan` (`id_status_laporan`, `status_laporan`) VALUES
(1, 'Belum Diteri'),
(2, 'Terkonfirmas'),
(3, 'Sudah Diteri'),
(4, 'Ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `data_status_pengajuan_modal`
--

CREATE TABLE `data_status_pengajuan_modal` (
  `id_status_pengajuan` int(11) NOT NULL,
  `status_pengajuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_status_pengajuan_modal`
--

INSERT INTO `data_status_pengajuan_modal` (`id_status_pengajuan`, `status_pengajuan`) VALUES
(1, 'Belum Dikonfirmasi'),
(2, 'Terkonfirmasi'),
(3, 'Sudah Diterima'),
(4, 'Ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `data_status_tagihan`
--

CREATE TABLE `data_status_tagihan` (
  `id_status_tagihan` int(11) NOT NULL,
  `status_tagihan` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_status_tagihan`
--

INSERT INTO `data_status_tagihan` (`id_status_tagihan`, `status_tagihan`) VALUES
(1, 'Selesai'),
(2, 'Sudah Bayar'),
(3, 'Belum Bayar'),
(4, 'Tidak Bisa B'),
(5, 'Sudah Bayar '),
(6, 'Belum Bayar ');

-- --------------------------------------------------------

--
-- Table structure for table `data_tagihan`
--

CREATE TABLE `data_tagihan` (
  `id_tagihan` int(11) NOT NULL,
  `id_petani` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `jml_kembali` int(12) NOT NULL,
  `jml_pinjam` int(12) NOT NULL,
  `tenggat_kembali` date NOT NULL,
  `id_status_tagihan` int(11) NOT NULL,
  `id_bayar` int(11) DEFAULT NULL,
  `id_tudak_bayar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_tidak_bisa_bayar`
--

CREATE TABLE `data_tidak_bisa_bayar` (
  `id_tidak_bayar` int(11) NOT NULL,
  `id_petani` int(11) NOT NULL,
  `bunga` int(12) NOT NULL,
  `id_metode` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_akun_pemerintah`
--
ALTER TABLE `data_akun_pemerintah`
  ADD PRIMARY KEY (`id_pemerintah`),
  ADD KEY `di_kota` (`id_kota`);

--
-- Indexes for table `data_akun_petani`
--
ALTER TABLE `data_akun_petani`
  ADD PRIMARY KEY (`id_petani`),
  ADD KEY `tinggal_di` (`id_desa`),
  ADD KEY `anggota` (`id_poktan`);

--
-- Indexes for table `data_akun_poktan`
--
ALTER TABLE `data_akun_poktan`
  ADD PRIMARY KEY (`id_poktan`),
  ADD KEY `bekerja_di` (`id_desa`),
  ADD KEY `dibawah` (`id_pemerintah`);

--
-- Indexes for table `data_desa`
--
ALTER TABLE `data_desa`
  ADD PRIMARY KEY (`id_desa`),
  ADD KEY `terletak_di` (`id_kota`);

--
-- Indexes for table `data_kota`
--
ALTER TABLE `data_kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `data_laporan`
--
ALTER TABLE `data_laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `yang_membuat` (`id_poktan`),
  ADD KEY `status_laporan` (`id_status_laporan`);

--
-- Indexes for table `data_metode_bayar`
--
ALTER TABLE `data_metode_bayar`
  ADD PRIMARY KEY (`id_metode`);

--
-- Indexes for table `data_pembayaran`
--
ALTER TABLE `data_pembayaran`
  ADD PRIMARY KEY (`id_bayar`),
  ADD KEY `pakai_metode` (`id_metode`),
  ADD KEY `yang_membayar` (`id_petani`);

--
-- Indexes for table `data_pengajuan_modal`
--
ALTER TABLE `data_pengajuan_modal`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `yang_mengajukan` (`id_petani`),
  ADD KEY `status` (`id_status_pengajuan`);

--
-- Indexes for table `data_status_laporan`
--
ALTER TABLE `data_status_laporan`
  ADD PRIMARY KEY (`id_status_laporan`);

--
-- Indexes for table `data_status_pengajuan_modal`
--
ALTER TABLE `data_status_pengajuan_modal`
  ADD PRIMARY KEY (`id_status_pengajuan`);

--
-- Indexes for table `data_status_tagihan`
--
ALTER TABLE `data_status_tagihan`
  ADD PRIMARY KEY (`id_status_tagihan`);

--
-- Indexes for table `data_tagihan`
--
ALTER TABLE `data_tagihan`
  ADD PRIMARY KEY (`id_tagihan`),
  ADD KEY `penerima_tagihan` (`id_petani`),
  ADD KEY `status_tagihan` (`id_status_tagihan`),
  ADD KEY `bayar` (`id_bayar`),
  ADD KEY `tidak_bayar` (`id_tudak_bayar`),
  ADD KEY `melirik_pada` (`id_pengajuan`);

--
-- Indexes for table `data_tidak_bisa_bayar`
--
ALTER TABLE `data_tidak_bisa_bayar`
  ADD PRIMARY KEY (`id_tidak_bayar`),
  ADD KEY `nama` (`id_petani`),
  ADD KEY `metode` (`id_metode`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_akun_pemerintah`
--
ALTER TABLE `data_akun_pemerintah`
  MODIFY `id_pemerintah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_akun_petani`
--
ALTER TABLE `data_akun_petani`
  MODIFY `id_petani` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_akun_poktan`
--
ALTER TABLE `data_akun_poktan`
  MODIFY `id_poktan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_desa`
--
ALTER TABLE `data_desa`
  MODIFY `id_desa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_kota`
--
ALTER TABLE `data_kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_laporan`
--
ALTER TABLE `data_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_metode_bayar`
--
ALTER TABLE `data_metode_bayar`
  MODIFY `id_metode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_pembayaran`
--
ALTER TABLE `data_pembayaran`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_pengajuan_modal`
--
ALTER TABLE `data_pengajuan_modal`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_status_laporan`
--
ALTER TABLE `data_status_laporan`
  MODIFY `id_status_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_status_pengajuan_modal`
--
ALTER TABLE `data_status_pengajuan_modal`
  MODIFY `id_status_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_status_tagihan`
--
ALTER TABLE `data_status_tagihan`
  MODIFY `id_status_tagihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_tagihan`
--
ALTER TABLE `data_tagihan`
  MODIFY `id_tagihan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_tidak_bisa_bayar`
--
ALTER TABLE `data_tidak_bisa_bayar`
  MODIFY `id_tidak_bayar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_akun_pemerintah`
--
ALTER TABLE `data_akun_pemerintah`
  ADD CONSTRAINT `di_kota` FOREIGN KEY (`id_kota`) REFERENCES `data_kota` (`id_kota`);

--
-- Constraints for table `data_akun_petani`
--
ALTER TABLE `data_akun_petani`
  ADD CONSTRAINT `anggota` FOREIGN KEY (`id_poktan`) REFERENCES `data_akun_poktan` (`id_poktan`),
  ADD CONSTRAINT `tinggal_di` FOREIGN KEY (`id_desa`) REFERENCES `data_desa` (`id_desa`);

--
-- Constraints for table `data_akun_poktan`
--
ALTER TABLE `data_akun_poktan`
  ADD CONSTRAINT `bekerja_di` FOREIGN KEY (`id_desa`) REFERENCES `data_desa` (`id_desa`),
  ADD CONSTRAINT `dibawah` FOREIGN KEY (`id_pemerintah`) REFERENCES `data_akun_pemerintah` (`id_pemerintah`);

--
-- Constraints for table `data_desa`
--
ALTER TABLE `data_desa`
  ADD CONSTRAINT `terletak_di` FOREIGN KEY (`id_kota`) REFERENCES `data_kota` (`id_kota`);

--
-- Constraints for table `data_laporan`
--
ALTER TABLE `data_laporan`
  ADD CONSTRAINT `status_laporan` FOREIGN KEY (`id_status_laporan`) REFERENCES `data_status_laporan` (`id_status_laporan`),
  ADD CONSTRAINT `yang_membuat` FOREIGN KEY (`id_poktan`) REFERENCES `data_akun_poktan` (`id_poktan`);

--
-- Constraints for table `data_pembayaran`
--
ALTER TABLE `data_pembayaran`
  ADD CONSTRAINT `pakai_metode` FOREIGN KEY (`id_metode`) REFERENCES `data_metode_bayar` (`id_metode`),
  ADD CONSTRAINT `yang_membayar` FOREIGN KEY (`id_petani`) REFERENCES `data_akun_petani` (`id_petani`);

--
-- Constraints for table `data_pengajuan_modal`
--
ALTER TABLE `data_pengajuan_modal`
  ADD CONSTRAINT `status` FOREIGN KEY (`id_status_pengajuan`) REFERENCES `data_status_pengajuan_modal` (`id_status_pengajuan`),
  ADD CONSTRAINT `yang_mengajukan` FOREIGN KEY (`id_petani`) REFERENCES `data_akun_petani` (`id_petani`);

--
-- Constraints for table `data_tagihan`
--
ALTER TABLE `data_tagihan`
  ADD CONSTRAINT `bayar` FOREIGN KEY (`id_bayar`) REFERENCES `data_pembayaran` (`id_bayar`),
  ADD CONSTRAINT `melirik_pada` FOREIGN KEY (`id_pengajuan`) REFERENCES `data_pengajuan_modal` (`id_pengajuan`),
  ADD CONSTRAINT `penerima_tagihan` FOREIGN KEY (`id_petani`) REFERENCES `data_akun_petani` (`id_petani`),
  ADD CONSTRAINT `status_tagihan` FOREIGN KEY (`id_status_tagihan`) REFERENCES `data_status_tagihan` (`id_status_tagihan`),
  ADD CONSTRAINT `tidak_bayar` FOREIGN KEY (`id_tudak_bayar`) REFERENCES `data_tidak_bisa_bayar` (`id_tidak_bayar`);

--
-- Constraints for table `data_tidak_bisa_bayar`
--
ALTER TABLE `data_tidak_bisa_bayar`
  ADD CONSTRAINT `metode` FOREIGN KEY (`id_metode`) REFERENCES `data_metode_bayar` (`id_metode`),
  ADD CONSTRAINT `nama` FOREIGN KEY (`id_petani`) REFERENCES `data_akun_petani` (`id_petani`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
