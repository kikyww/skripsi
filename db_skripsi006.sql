-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Bulan Mei 2023 pada 02.19
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_skripsi006`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_intervensi`
--

CREATE TABLE `tb_intervensi` (
  `id_intervensi` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `kelurahan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_intervensi` varchar(255) NOT NULL,
  `tgl_intervensi` date NOT NULL,
  `jenis_intervensi` varchar(255) NOT NULL,
  `pembuat_intervensi` varchar(255) NOT NULL,
  `kunjungan_intervensi` varchar(255) NOT NULL,
  `foto_intervensi` varchar(2255) NOT NULL,
  `intervensi_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kb`
--

CREATE TABLE `tb_kb` (
  `id_kb` int(11) NOT NULL,
  `kepkel_id` int(11) NOT NULL,
  `keluarga_id` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `kelurahan_id` int(11) NOT NULL,
  `tgl_kb` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `obat_id` int(11) NOT NULL,
  `stok_id` int(11) NOT NULL,
  `jumlah_obat` int(11) NOT NULL,
  `kb_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kb`
--

INSERT INTO `tb_kb` (`id_kb`, `kepkel_id`, `keluarga_id`, `kecamatan_id`, `kelurahan_id`, `tgl_kb`, `tgl_kembali`, `obat_id`, `stok_id`, `jumlah_obat`, `kb_stamp`) VALUES
(3, 2, 1, 1, 1, '2023-04-29', '2023-10-29', 2, 1, 1, '2023-04-29 05:56:04'),
(4, 6, 2, 1, 1, '2023-05-02', '2023-11-02', 2, 1, 1, '2023-05-02 03:40:38'),
(5, 2, 1, 1, 1, '2024-04-03', '2024-10-03', 2, 1, 1, '2023-05-03 06:52:10'),
(8, 4, 3, 2, 2, '2023-05-03', '2023-11-03', 5, 3, 1, '2023-05-03 10:13:53'),
(9, 4, 3, 2, 2, '2023-05-04', '2023-11-04', 5, 3, 1, '2023-05-03 10:20:46'),
(10, 4, 3, 2, 2, '2023-04-29', '2023-10-29', 5, 3, 1, '2023-05-03 10:21:37'),
(11, 2, 1, 1, 1, '2023-05-03', '2023-11-03', 2, 1, 1, '2023-05-03 10:22:11'),
(12, 6, 2, 1, 1, '2023-05-04', '2023-11-04', 2, 1, 1, '2023-05-04 01:50:45'),
(13, 4, 3, 2, 2, '2023-05-05', '2023-11-05', 5, 3, 1, '2023-05-04 01:58:28'),
(14, 6, 2, 1, 1, '2023-05-03', '2023-11-03', 5, 2, 1, '2023-05-09 10:28:39'),
(15, 6, 2, 1, 1, '2026-05-10', '2026-11-10', 4, 6, 1, '2026-05-10 03:22:16'),
(16, 1, 4, 1, 3, '2023-05-11', '2023-11-11', 2, 1, 1, '2023-05-11 03:54:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kecamatan`
--

CREATE TABLE `tb_kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `nama_kecamatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kecamatan`
--

INSERT INTO `tb_kecamatan` (`id_kecamatan`, `nama_kecamatan`) VALUES
(1, 'Banjarmasin Utara'),
(2, 'Banjarmasin Barat'),
(3, 'Banjarmasin Tengah'),
(4, 'Banjarmasin Selatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keluarga`
--

CREATE TABLE `tb_keluarga` (
  `id_keluarga` int(11) NOT NULL,
  `kepkel_id` int(11) NOT NULL,
  `nama_keluarga` varchar(100) NOT NULL,
  `tl_keluarga` varchar(100) NOT NULL,
  `lahir_keluarga` date NOT NULL,
  `jk_keluarga` enum('L','P') NOT NULL,
  `telp_keluarga` varchar(15) NOT NULL,
  `status_kb` enum('Tidak KB','KB') NOT NULL,
  `keterangan_kb` varchar(255) NOT NULL,
  `jumlah_anak` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `kelurahan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_keluarga`
--

INSERT INTO `tb_keluarga` (`id_keluarga`, `kepkel_id`, `nama_keluarga`, `tl_keluarga`, `lahir_keluarga`, `jk_keluarga`, `telp_keluarga`, `status_kb`, `keterangan_kb`, `jumlah_anak`, `kecamatan_id`, `kelurahan_id`) VALUES
(1, 2, 'Arfina', 'Banjarmasin', '2001-08-08', 'P', '086374673647', 'KB', 'a', 4, 1, 1),
(2, 6, 'Meyii', 'Banjarmasinn', '2003-03-04', 'P', '97876767565999', 'KB', 'a', 4, 1, 1),
(3, 4, 'Yaya', 'Banjarmasin', '2000-07-20', 'P', '087248248', 'KB', '8', 0, 2, 2),
(4, 1, 'nyai', 'Banjarmasin', '2000-03-03', 'P', '08967345534', 'KB', '', 3, 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelurahan`
--

CREATE TABLE `tb_kelurahan` (
  `id_kelurahan` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `nama_kelurahan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kelurahan`
--

INSERT INTO `tb_kelurahan` (`id_kelurahan`, `kecamatan_id`, `nama_kelurahan`) VALUES
(1, 1, 'Alalak Selatan'),
(2, 2, 'Sutoyo S.'),
(3, 1, 'Alalak Utara'),
(4, 1, 'Alalak Tengah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kepkel`
--

CREATE TABLE `tb_kepkel` (
  `id_kepkel` int(11) NOT NULL,
  `no_kk` int(11) NOT NULL,
  `nama_kepkel` varchar(100) NOT NULL,
  `tl_kepkel` varchar(100) NOT NULL,
  `lahir_kepkel` date NOT NULL,
  `alamat_kepkel` varchar(100) NOT NULL,
  `jk_kepkel` enum('L','P') NOT NULL,
  `telp_kepkel` varchar(15) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `kelurahan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kepkel`
--

INSERT INTO `tb_kepkel` (`id_kepkel`, `no_kk`, `nama_kepkel`, `tl_kepkel`, `lahir_kepkel`, `alamat_kepkel`, `jk_kepkel`, `telp_kepkel`, `kecamatan_id`, `kelurahan_id`) VALUES
(1, 213123213, 'Adits', 'Banjarmasins', '2000-06-22', 'jl. hksns', 'L', '35353434342', 1, 3),
(2, 44444444, 'Rizky Aditya', 'Banjarmasin', '2000-09-25', 'jl. hksn', 'L', '242323232323', 1, 1),
(3, 2147483647, 'Adit', 'Banjarmasin', '2000-09-25', 'jl. hksn', 'L', '24235235234', 2, 2),
(4, 124124123, 'Aditya Rizky', 'Banjarmasin', '2000-09-25', 'jl. hksn', 'L', '124324324', 2, 2),
(5, 12314234, 'Adit', 'Banjarmasin', '2003-02-23', 'jl. hksn', 'L', '45454545', 1, 4),
(6, 34343434, 'Rizky Aditya', 'Banjarmasin', '2001-08-24', 'jl. hksn', 'L', '24325243', 1, 1),
(7, 45356234, 'Adit', 'Banjarmasin', '2000-09-22', 'jl. hksn', 'L', '2412423525', 1, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_obat`
--

CREATE TABLE `tb_obat` (
  `id_obat` int(11) NOT NULL,
  `jenis_obat` enum('MKJP','Non-MKJP') NOT NULL,
  `nama_obat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_obat`
--

INSERT INTO `tb_obat` (`id_obat`, `jenis_obat`, `nama_obat`) VALUES
(2, 'Non-MKJP', 'Suntik'),
(4, 'Non-MKJP', 'Kondom'),
(5, 'Non-MKJP', 'Pil KB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_stok`
--

CREATE TABLE `tb_stok` (
  `id_stok` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `obat_id` int(11) NOT NULL,
  `stok_awal` int(11) NOT NULL,
  `stok_akhir` int(11) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `stok_stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_stok`
--

INSERT INTO `tb_stok` (`id_stok`, `kecamatan_id`, `obat_id`, `stok_awal`, `stok_akhir`, `tgl_awal`, `tgl_akhir`, `stok_stamp`) VALUES
(1, 1, 2, 9600, 8971, '2023-04-20', '2023-09-20', '2023-04-18 04:28:47'),
(2, 1, 5, 7800, 7799, '2023-04-20', '2023-09-20', '2023-04-20 06:27:41'),
(3, 2, 5, 9000, 8995, '2023-04-24', '2023-11-24', '2023-04-24 12:55:06'),
(4, 2, 4, 8000, 8000, '2023-04-24', '2023-11-24', '2023-04-24 12:55:44'),
(6, 1, 4, 400, 399, '2026-05-10', '2026-12-10', '2026-05-10 03:21:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `roles` enum('admin','pkb','pegawai','kabid') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nip`, `nama`, `username`, `password`, `roles`) VALUES
(1, 1, 'Admin', 'admin', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_intervensi`
--
ALTER TABLE `tb_intervensi`
  ADD PRIMARY KEY (`id_intervensi`),
  ADD KEY `kecamatan_id` (`kecamatan_id`),
  ADD KEY `kelurahan_id` (`kelurahan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tb_kb`
--
ALTER TABLE `tb_kb`
  ADD PRIMARY KEY (`id_kb`),
  ADD KEY `kepkel_id` (`kepkel_id`),
  ADD KEY `keluarga_id` (`keluarga_id`),
  ADD KEY `kecamatan_id` (`kecamatan_id`),
  ADD KEY `kelurahan_id` (`kelurahan_id`),
  ADD KEY `obat_id` (`stok_id`),
  ADD KEY `stok_id` (`stok_id`),
  ADD KEY `obat_id_2` (`obat_id`);

--
-- Indeks untuk tabel `tb_kecamatan`
--
ALTER TABLE `tb_kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indeks untuk tabel `tb_keluarga`
--
ALTER TABLE `tb_keluarga`
  ADD PRIMARY KEY (`id_keluarga`),
  ADD KEY `kepkel_id` (`kepkel_id`),
  ADD KEY `kecamatan_id` (`kecamatan_id`),
  ADD KEY `kelurahan_id` (`kelurahan_id`);

--
-- Indeks untuk tabel `tb_kelurahan`
--
ALTER TABLE `tb_kelurahan`
  ADD PRIMARY KEY (`id_kelurahan`),
  ADD KEY `kecamatan_id` (`kecamatan_id`);

--
-- Indeks untuk tabel `tb_kepkel`
--
ALTER TABLE `tb_kepkel`
  ADD PRIMARY KEY (`id_kepkel`),
  ADD UNIQUE KEY `no_kk` (`no_kk`),
  ADD KEY `kecamatan_id` (`kecamatan_id`),
  ADD KEY `kelurahan_id` (`kelurahan_id`);

--
-- Indeks untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indeks untuk tabel `tb_stok`
--
ALTER TABLE `tb_stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `kecamatan_id` (`kecamatan_id`),
  ADD KEY `obat_id` (`obat_id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_intervensi`
--
ALTER TABLE `tb_intervensi`
  MODIFY `id_intervensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_kb`
--
ALTER TABLE `tb_kb`
  MODIFY `id_kb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_kecamatan`
--
ALTER TABLE `tb_kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_keluarga`
--
ALTER TABLE `tb_keluarga`
  MODIFY `id_keluarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_kelurahan`
--
ALTER TABLE `tb_kelurahan`
  MODIFY `id_kelurahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_kepkel`
--
ALTER TABLE `tb_kepkel`
  MODIFY `id_kepkel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_stok`
--
ALTER TABLE `tb_stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_intervensi`
--
ALTER TABLE `tb_intervensi`
  ADD CONSTRAINT `tb_intervensi_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `tb_kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_intervensi_ibfk_2` FOREIGN KEY (`kelurahan_id`) REFERENCES `tb_kelurahan` (`id_kelurahan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_intervensi_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tb_kb`
--
ALTER TABLE `tb_kb`
  ADD CONSTRAINT `tb_kb_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `tb_kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_kb_ibfk_2` FOREIGN KEY (`keluarga_id`) REFERENCES `tb_keluarga` (`id_keluarga`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_kb_ibfk_3` FOREIGN KEY (`kelurahan_id`) REFERENCES `tb_kelurahan` (`id_kelurahan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_kb_ibfk_4` FOREIGN KEY (`kepkel_id`) REFERENCES `tb_kepkel` (`id_kepkel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_kb_ibfk_5` FOREIGN KEY (`stok_id`) REFERENCES `tb_stok` (`id_stok`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_kb_ibfk_6` FOREIGN KEY (`obat_id`) REFERENCES `tb_obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_keluarga`
--
ALTER TABLE `tb_keluarga`
  ADD CONSTRAINT `tb_keluarga_ibfk_3` FOREIGN KEY (`kepkel_id`) REFERENCES `tb_kepkel` (`id_kepkel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_keluarga_ibfk_4` FOREIGN KEY (`kecamatan_id`) REFERENCES `tb_kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_keluarga_ibfk_5` FOREIGN KEY (`kelurahan_id`) REFERENCES `tb_kelurahan` (`id_kelurahan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_kelurahan`
--
ALTER TABLE `tb_kelurahan`
  ADD CONSTRAINT `tb_kelurahan_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `tb_kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_kepkel`
--
ALTER TABLE `tb_kepkel`
  ADD CONSTRAINT `tb_kepkel_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `tb_kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_kepkel_ibfk_2` FOREIGN KEY (`kelurahan_id`) REFERENCES `tb_kelurahan` (`id_kelurahan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_stok`
--
ALTER TABLE `tb_stok`
  ADD CONSTRAINT `tb_stok_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `tb_kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
