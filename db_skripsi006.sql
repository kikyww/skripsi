-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jul 2023 pada 14.50
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
  `judul_intervensi` varchar(255) NOT NULL,
  `tgl_intervensi` date NOT NULL,
  `tempat_intervensi` varchar(255) NOT NULL,
  `deskripsi_intervensi` varchar(255) NOT NULL,
  `jenis_id` int(11) NOT NULL,
  `seksi_intervensi` varchar(255) NOT NULL,
  `pesertai_intervensi` varchar(255) NOT NULL,
  `pesertaii_intervensi` varchar(255) NOT NULL,
  `pesertaiii_intervensi` varchar(255) NOT NULL,
  `opd_id` int(11) NOT NULL,
  `kunjungan_id` int(11) NOT NULL,
  `foto_intervensi` varchar(255) NOT NULL,
  `status_intervensi` enum('Selesai','Belum') NOT NULL,
  `agenda_intervensi` varchar(10) NOT NULL,
  `intervensi_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_intervensi`
--

INSERT INTO `tb_intervensi` (`id_intervensi`, `kecamatan_id`, `kelurahan_id`, `user_id`, `judul_intervensi`, `tgl_intervensi`, `tempat_intervensi`, `deskripsi_intervensi`, `jenis_id`, `seksi_intervensi`, `pesertai_intervensi`, `pesertaii_intervensi`, `pesertaiii_intervensi`, `opd_id`, `kunjungan_id`, `foto_intervensi`, `status_intervensi`, `agenda_intervensi`, `intervensi_stamp`) VALUES
(1, 1, 1, 1, 'tes', '2023-02-22', 'tes', 'tes', 2, 'Kasih Sayang', 'orang', '', '', 1, 2, 'Screenshot (7).png', 'Selesai', '', '2023-06-22 09:54:20'),
(2, 1, 1, 1, 's', '2023-12-12', 's', 's', 1, 'Sosisal Budaya', 's', '', '', 2, 2, 'Screenshot (14).png', 'Selesai', '', '2023-06-22 09:58:31'),
(3, 1, 1, 1, 'tes agenda', '2023-02-25', 'tes agenda', 'p', 2, 'Pendidikan', 'p', '', '', 2, 1, 'Screenshot (10).png', 'Selesai', 'Agenda', '2023-06-23 03:00:27'),
(4, 1, 3, 1, 'tes agenda 2', '2023-05-25', 'jl. tes agenda 2', '', 2, '', '', '', '', 2, 1, '', 'Selesai', 'Agenda', '2023-06-22 10:49:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenisinv`
--

CREATE TABLE `tb_jenisinv` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(255) NOT NULL,
  `deskripsi_jenisinv` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jenisinv`
--

INSERT INTO `tb_jenisinv` (`id_jenis`, `nama_jenis`, `deskripsi_jenisinv`) VALUES
(1, 'Lainnya', 'Kategori belum terdaftar'),
(2, 'p', 'ini p'),
(3, 'L', 'ini l');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kb`
--

CREATE TABLE `tb_kb` (
  `id_kb` int(11) NOT NULL,
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

INSERT INTO `tb_kb` (`id_kb`, `keluarga_id`, `kecamatan_id`, `kelurahan_id`, `tgl_kb`, `tgl_kembali`, `obat_id`, `stok_id`, `jumlah_obat`, `kb_stamp`) VALUES
(1, 1, 1, 1, '2023-05-03', '2023-12-03', 2, 1, 1, '2023-06-15 05:35:27'),
(2, 2, 1, 1, '2023-05-03', '2023-11-03', 5, 2, 1, '2023-06-15 05:03:54'),
(3, 4, 1, 3, '2023-05-03', '2023-11-03', 2, 1, 1, '2023-06-15 05:42:27'),
(4, 3, 2, 2, '2023-05-09', '2023-11-09', 4, 4, 1, '2023-06-15 05:06:30'),
(5, 3, 2, 2, '2023-08-25', '2024-02-25', 4, 4, 1, '2023-06-15 05:13:33'),
(6, 1, 1, 1, '2023-08-27', '2024-02-27', 5, 2, 1, '2023-06-15 05:36:30'),
(7, 5, 1, 1, '2023-08-27', '2024-02-27', 5, 2, 1, '2023-06-15 05:15:42'),
(8, 4, 1, 3, '2023-08-27', '2024-02-27', 2, 1, 1, '2023-06-15 05:16:44'),
(9, 1, 1, 1, '2023-05-03', '2023-12-03', 5, 2, 1, '2023-06-19 02:37:47');

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
(4, 'Banjarmasin Selatan'),
(5, 'Banjarmasin Timur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keluarga`
--

CREATE TABLE `tb_keluarga` (
  `id_keluarga` int(11) NOT NULL,
  `no_kk` varchar(16) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_keluarga` varchar(100) NOT NULL,
  `kepala_keluarga` varchar(255) NOT NULL,
  `tl_keluarga` varchar(100) NOT NULL,
  `lahir_keluarga` date NOT NULL,
  `alamat_keluarga` varchar(255) NOT NULL,
  `telp_keluarga` varchar(15) NOT NULL,
  `status_kb` enum('Tidak KB','KB') NOT NULL,
  `keterangan_kb` enum('KB','Program Hamil','Hamil','Belum Konfirmasi','Lainnya') NOT NULL,
  `alasan_kb` varchar(255) NOT NULL,
  `jumlah_anak` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `kelurahan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_keluarga`
--

INSERT INTO `tb_keluarga` (`id_keluarga`, `no_kk`, `nik`, `nama_keluarga`, `kepala_keluarga`, `tl_keluarga`, `lahir_keluarga`, `alamat_keluarga`, `telp_keluarga`, `status_kb`, `keterangan_kb`, `alasan_kb`, `jumlah_anak`, `kecamatan_id`, `kelurahan_id`) VALUES
(1, '7865466789006121', '6865466789067435', 'Arfina', 'Adit', 'Banjarmasin', '2001-08-08', 'Jl. Hksn', '086374673647', 'KB', 'KB', '', 4, 1, 1),
(2, '1237865411789556', '6826378456729000', 'Meyii', 'Rizky', 'Banjarmasinn', '2003-03-04', 'Komp. Amd', '97876767565999', 'KB', 'KB', '', 4, 1, 1),
(3, '6876514298000023', '6287655437865001', 'Yaya', 'Kikyw', 'Banjarmasin', '2000-07-20', 'Kayutangi 2', '087248248', 'KB', 'KB', '', 0, 2, 2),
(4, '6799987600200323', '6872998765228950', 'nyai', 'Adit', 'Banjarmasin', '2000-03-03', 'Komp. Herlina', '08967345534', 'KB', 'KB', '', 3, 1, 3),
(5, '2733988900002374', '6863889065389001', 'Nisa', 'Udin', 'Banjarmasins', '1973-03-20', 'Jl. HKSN', '0897656565', 'KB', 'KB', '', 3, 1, 1),
(6, '680064512765002', '671237896689017', 'Sumarni', 'Suratno', 'Banjarmasin', '1972-04-27', 'Kuin Selatan', '089623425363', 'Tidak KB', 'Lainnya', 'Non-PUS', 2, 1, 3),
(7, '8927654399001003', '8927654399001774', 'Tini', 'Toro', 'Banjarmasin', '1973-01-19', 'Jl. HKSN', '08864377354', 'Tidak KB', 'Belum Konfirmasi', '', 4, 2, 2),
(8, '1928765438910987', '6897887452987456', 'Siti', 'Ujang', 'Banjarmasin', '2001-02-06', 'Komp. Surya Gemilang', '087663887261', 'Tidak KB', 'Lainnya', 'PUS', 3, 1, 1);

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
-- Struktur dari tabel `tb_opd`
--

CREATE TABLE `tb_opd` (
  `id_opd` int(11) NOT NULL,
  `nama_opd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_opd`
--

INSERT INTO `tb_opd` (`id_opd`, `nama_opd`) VALUES
(1, 'opde'),
(2, 'opdr'),
(3, 'Masyarakat Setempat');

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
(1, 1, 2, 9600, 8967, '2023-04-20', '2023-09-20', '2023-04-18 04:28:47'),
(2, 1, 5, 7800, 7795, '2023-04-20', '2023-09-20', '2023-04-20 06:27:41'),
(3, 2, 5, 9000, 8995, '2023-04-24', '2023-11-24', '2023-04-24 12:55:06'),
(4, 2, 4, 8000, 7998, '2023-04-24', '2023-11-24', '2023-04-24 12:55:44'),
(6, 1, 4, 400, 399, '2026-05-10', '2026-12-10', '2026-05-10 03:21:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `wilayah` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `roles` enum('ADMIN','PKB','KABID','PEGAWAI') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nip`, `nama`, `telepon`, `wilayah`, `username`, `password`, `roles`) VALUES
(1, 1, 'Admin', '', '', 'admin', 'admin', 'ADMIN');

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
  ADD KEY `user_id` (`user_id`),
  ADD KEY `jenis_id` (`jenis_id`),
  ADD KEY `opd_id` (`opd_id`),
  ADD KEY `kunjungan_id` (`kunjungan_id`);

--
-- Indeks untuk tabel `tb_jenisinv`
--
ALTER TABLE `tb_jenisinv`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `tb_kb`
--
ALTER TABLE `tb_kb`
  ADD PRIMARY KEY (`id_kb`),
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
  ADD KEY `kecamatan_id` (`kecamatan_id`),
  ADD KEY `kelurahan_id` (`kelurahan_id`);

--
-- Indeks untuk tabel `tb_kelurahan`
--
ALTER TABLE `tb_kelurahan`
  ADD PRIMARY KEY (`id_kelurahan`),
  ADD KEY `kecamatan_id` (`kecamatan_id`);

--
-- Indeks untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indeks untuk tabel `tb_opd`
--
ALTER TABLE `tb_opd`
  ADD PRIMARY KEY (`id_opd`);

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
  MODIFY `id_intervensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_jenisinv`
--
ALTER TABLE `tb_jenisinv`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_kb`
--
ALTER TABLE `tb_kb`
  MODIFY `id_kb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tb_kecamatan`
--
ALTER TABLE `tb_kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_keluarga`
--
ALTER TABLE `tb_keluarga`
  MODIFY `id_keluarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_kelurahan`
--
ALTER TABLE `tb_kelurahan`
  MODIFY `id_kelurahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_opd`
--
ALTER TABLE `tb_opd`
  MODIFY `id_opd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_stok`
--
ALTER TABLE `tb_stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_intervensi`
--
ALTER TABLE `tb_intervensi`
  ADD CONSTRAINT `tb_intervensi_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `tb_kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_intervensi_ibfk_2` FOREIGN KEY (`kelurahan_id`) REFERENCES `tb_kelurahan` (`id_kelurahan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_intervensi_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_intervensi_ibfk_4` FOREIGN KEY (`jenis_id`) REFERENCES `tb_jenisinv` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_intervensi_ibfk_5` FOREIGN KEY (`opd_id`) REFERENCES `tb_opd` (`id_opd`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_intervensi_ibfk_6` FOREIGN KEY (`kunjungan_id`) REFERENCES `tb_opd` (`id_opd`);

--
-- Ketidakleluasaan untuk tabel `tb_kb`
--
ALTER TABLE `tb_kb`
  ADD CONSTRAINT `tb_kb_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `tb_kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_kb_ibfk_2` FOREIGN KEY (`keluarga_id`) REFERENCES `tb_keluarga` (`id_keluarga`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_kb_ibfk_3` FOREIGN KEY (`kelurahan_id`) REFERENCES `tb_kelurahan` (`id_kelurahan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_kb_ibfk_5` FOREIGN KEY (`stok_id`) REFERENCES `tb_stok` (`id_stok`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_kb_ibfk_6` FOREIGN KEY (`obat_id`) REFERENCES `tb_obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_keluarga`
--
ALTER TABLE `tb_keluarga`
  ADD CONSTRAINT `tb_keluarga_ibfk_4` FOREIGN KEY (`kecamatan_id`) REFERENCES `tb_kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_keluarga_ibfk_5` FOREIGN KEY (`kelurahan_id`) REFERENCES `tb_kelurahan` (`id_kelurahan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_kelurahan`
--
ALTER TABLE `tb_kelurahan`
  ADD CONSTRAINT `tb_kelurahan_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `tb_kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_stok`
--
ALTER TABLE `tb_stok`
  ADD CONSTRAINT `tb_stok_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `tb_kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
