-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Apr 2023 pada 13.42
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
  `obat_id` int(11) NOT NULL,
  `jumlah_obat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(3, 'Banjarmasin Tengah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keluarga`
--

CREATE TABLE `tb_keluarga` (
  `id_keluarga` int(11) NOT NULL,
  `kepkel_id` int(11) NOT NULL,
  `nama_keluarga` varchar(100) NOT NULL,
  `lahir_keluarga` date NOT NULL,
  `jk_keluarga` enum('L','P') NOT NULL,
  `telp_keluarga` varchar(15) NOT NULL,
  `status_kb` enum('KB','Tidak') NOT NULL,
  `kb_id` int(11) NOT NULL,
  `keterangan_kb` varchar(255) NOT NULL,
  `jumlah_anak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Struktur dari tabel `tb_minstok`
--

CREATE TABLE `tb_minstok` (
  `id_minstok` int(11) NOT NULL,
  `obat_id` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `stok_id` int(11) NOT NULL,
  `minstok` int(11) NOT NULL,
  `minstok_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `jumlah_stok` int(11) NOT NULL,
  `stok_stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_stok`
--

INSERT INTO `tb_stok` (`id_stok`, `kecamatan_id`, `obat_id`, `jumlah_stok`, `stok_stamp`) VALUES
(1, 2, 4, 5000, '2023-03-30 13:11:38'),
(2, 3, 4, 800, '2023-03-30 13:11:38'),
(3, 3, 2, 800, '2023-03-30 13:11:38'),
(4, 3, 5, 900, '2023-03-30 13:13:26');

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
  ADD KEY `obat_id` (`obat_id`);

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
  ADD KEY `obat_id` (`kb_id`),
  ADD KEY `kepkel_id` (`kepkel_id`);

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
-- Indeks untuk tabel `tb_minstok`
--
ALTER TABLE `tb_minstok`
  ADD PRIMARY KEY (`id_minstok`),
  ADD KEY `obat_id` (`obat_id`),
  ADD KEY `kecamatan_id` (`kecamatan_id`),
  ADD KEY `stok_id` (`stok_id`);

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
  MODIFY `id_kb` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_kecamatan`
--
ALTER TABLE `tb_kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_keluarga`
--
ALTER TABLE `tb_keluarga`
  MODIFY `id_keluarga` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT untuk tabel `tb_minstok`
--
ALTER TABLE `tb_minstok`
  MODIFY `id_minstok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_stok`
--
ALTER TABLE `tb_stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  ADD CONSTRAINT `tb_kb_ibfk_5` FOREIGN KEY (`obat_id`) REFERENCES `tb_obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_keluarga`
--
ALTER TABLE `tb_keluarga`
  ADD CONSTRAINT `tb_keluarga_ibfk_3` FOREIGN KEY (`kepkel_id`) REFERENCES `tb_kepkel` (`id_kepkel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_keluarga_ibfk_4` FOREIGN KEY (`kb_id`) REFERENCES `tb_kb` (`id_kb`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Ketidakleluasaan untuk tabel `tb_minstok`
--
ALTER TABLE `tb_minstok`
  ADD CONSTRAINT `tb_minstok_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `tb_kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_minstok_ibfk_2` FOREIGN KEY (`obat_id`) REFERENCES `tb_obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_minstok_ibfk_3` FOREIGN KEY (`stok_id`) REFERENCES `tb_stok` (`id_stok`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_stok`
--
ALTER TABLE `tb_stok`
  ADD CONSTRAINT `tb_stok_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `tb_kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
