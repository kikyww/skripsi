-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Agu 2023 pada 02.27
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
-- Struktur dari tabel `tb_catatan`
--

CREATE TABLE `tb_catatan` (
  `id_catatan` int(11) NOT NULL,
  `intervensi_id` int(11) NOT NULL,
  `judul_catatan` varchar(255) NOT NULL,
  `isi_catatan` varchar(255) NOT NULL,
  `saran_catatan` varchar(255) NOT NULL,
  `catatan_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_catatan`
--

INSERT INTO `tb_catatan` (`id_catatan`, `intervensi_id`, `judul_catatan`, `isi_catatan`, `saran_catatan`, `catatan_stamp`) VALUES
(2, 4, 'Ditunda', 'Diatur ulang untuk pertemuannya', 'Secepatnya', '2023-07-20 12:08:29'),
(3, 3, 'Aman', 'Aman dan tertib', 'Ditingkatkan lagi ', '2023-07-20 12:09:20'),
(4, 3, 'Telat', 'Telat 30 menit namun sosialisasi berjalan lancard', 'ditingkatkan lagi dalam hal ketepatan waktunya', '2023-07-20 12:11:10');

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
  `status_intervensi` enum('Selesai','Belum','Ditunda') NOT NULL,
  `agenda_intervensi` varchar(10) NOT NULL,
  `intervensi_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_intervensi`
--

INSERT INTO `tb_intervensi` (`id_intervensi`, `kecamatan_id`, `kelurahan_id`, `user_id`, `judul_intervensi`, `tgl_intervensi`, `tempat_intervensi`, `deskripsi_intervensi`, `jenis_id`, `seksi_intervensi`, `pesertai_intervensi`, `pesertaii_intervensi`, `pesertaiii_intervensi`, `opd_id`, `kunjungan_id`, `foto_intervensi`, `status_intervensi`, `agenda_intervensi`, `intervensi_stamp`) VALUES
(1, 1, 1, 1, 'tes', '2023-02-22', 'tes', 'tes', 2, 'Kasih Sayang', 'orang', '', '', 1, 2, 'Screenshot (7).png', 'Selesai', '', '2023-06-22 09:54:20'),
(2, 1, 1, 1, 'Gotong Royong', '2023-12-12', 'Jl. HKSN ', 'Kegiatan bulanan gotong royong', 1, 'Sosisal Budaya', 'Masyarakat Setempat', '', '', 3, 7, 'Screenshot (19).png', 'Selesai', '', '2023-07-20 12:51:36'),
(3, 1, 1, 1, 'Sosialisasi Kampung KB', '2023-02-25', 'Amd Permai', 'Deskripsi', 2, 'Pendidikan', 'p', '', '', 14, 3, 'Screenshot (10).png', 'Selesai', 'Agenda', '2023-07-20 10:21:20'),
(4, 1, 3, 1, 'Sosialisasi Hasil Laut', '2023-05-25', 'jl. HKSN', 'p', 1, '', '', '', '', 2, 14, '', 'Ditunda', 'Agenda', '2023-07-20 10:18:36'),
(5, 2, 2, 1, 'tes p', '2023-07-16', 'disini', '', 1, '', '', '', '', 3, 3, '', 'Selesai', 'Agenda', '2023-07-17 08:43:32'),
(6, 2, 2, 1, 'sadfhjah', '2023-07-17', 'aisodjasfais', '', 2, '', '', '', '', 1, 1, '', 'Selesai', 'Agenda', '2023-07-17 09:34:29'),
(7, 1, 4, 1, 'Penyuluhan KB', '2023-07-22', 'Alalak tengah', 'Penyuluhan kb diadakan ke kampung kb pada alalak selatan', 5, 'Reproduksi', 'Ibu yang memiliki anak', 'Ibu Hamil', '', 14, 14, 'PerkembanganKB.png', 'Selesai', 'Agenda', '2023-07-27 05:04:17'),
(8, 1, 1, 1, 'Sosialisasi Pencegahan Stunting', '2023-07-19', 'Alalak Selatan Rt. 3', 'Sosialisasi pencegahan sutunting dari dinas KB ', 6, 'Perlindungan', 'Ibu hamil', 'ibu yang memiliki balita', '', 14, 14, 'Screenshot (14).png', 'Selesai', 'Agenda', '2023-07-20 13:13:11'),
(9, 1, 1, 1, 'Maulid Nabi Muhammad SAW', '2023-07-18', 'Komp. Herlina', 'Melakukan Maulid Nabi rutin tahunan', 1, 'Keagamaan', 'Masyarakat Setempat', 'asfjhasf', '', 3, 3, 'Screenshot (17).png', 'Selesai', 'Agenda', '2023-07-20 13:14:42'),
(10, 1, 1, 1, 'Sosialisasi', '2023-07-19', 'Komp. Surya Gemilang', 'Sosialisasi tentang gerkaan hidup sehat', 4, 'Lainnya', 'Ibu yang memiliki anak', '', '', 3, 2, 'Screenshot (13).png', 'Selesai', '', '2023-07-20 13:10:56'),
(11, 1, 1, 1, 'Pencanangan SMPN 3 HKSN', '2023-07-16', 'Jl. HKSN', '', 1, '', '', '', '', 14, 14, '', 'Ditunda', 'Agenda', '2023-07-27 05:04:56'),
(12, 1, 1, 1, 'Sosialisasi Pencegahan Stunting', '2023-07-13', 'Jl. AMD Permai', '', 6, '', '', '', '', 14, 3, '', 'Belum', 'Agenda', '2023-07-20 10:29:15');

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
(2, 'Pelayanan Administrasi Kependudukan', ''),
(3, 'Rumah Data Kependudukan dan Informasi Keluarga (Rumah DataKu)', ''),
(4, 'Program Gerakan Masyarakat Hidup Sehat (GERMAS)', ''),
(5, 'Program Indonesia Sehat dengan Pendekatan Keluarga (PISPK)', ''),
(6, 'Bina Keluarga Balita (BKB)', ''),
(7, 'Bina Keluarga Remaja (BKR)', ''),
(8, 'PIK Remaja', ''),
(9, 'Komunikasi, Informasi dan Edukasi (KIE) Kesehatan Reproduksi dan Keluarga Berencana bagi Keluarga', ''),
(10, 'Bimbingan Calon Pengantin', ''),
(11, 'Bimbingan, penyuluhan dan konsultasi keagamaan', ''),
(12, 'KIE Pencegahan, Perlindungan Perempuan dan Anak dari kekerasan', ''),
(13, 'Advokasi dan KIE pemberian makan bayi dan anak ASI eksklusif', ''),
(14, 'Kawasan Tanpa Rokok (KTR) dan implementasi Rumah Tanpa Asap Rokok', ''),
(15, 'Penggerakan Pelayanan Keluarga Berencana dan Kesehatan Reproduksi', '');

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
(9, 1, 1, 1, '2023-05-03', '2023-12-03', 5, 2, 1, '2023-06-19 02:37:47'),
(10, 12, 3, 7, '2023-07-27', '2024-01-27', 2, 8, 1, '2023-07-27 14:48:33'),
(11, 13, 3, 7, '2023-07-27', '2024-01-27', 5, 9, 1, '2023-07-27 14:48:55'),
(12, 14, 4, 9, '2023-07-28', '2024-01-28', 2, 10, 1, '2023-07-28 03:33:10'),
(13, 15, 5, 8, '2023-07-15', '2024-01-15', 4, 12, 1, '2023-07-28 03:52:21'),
(14, 2, 1, 1, '2023-07-15', '2024-01-15', 2, 1, 1, '2023-07-28 05:50:18'),
(15, 1, 1, 1, '2023-07-20', '2024-01-20', 2, 1, 1, '2023-07-28 05:50:55'),
(16, 5, 1, 1, '2023-07-20', '2024-01-20', 2, 1, 1, '2023-07-28 05:51:38'),
(17, 3, 2, 2, '2023-07-20', '2024-01-20', 5, 3, 1, '2023-07-28 05:53:40'),
(18, 3, 2, 2, '2023-07-20', '2024-01-20', 4, 4, 1, '2023-07-28 05:54:08'),
(19, 3, 2, 2, '2023-07-20', '2024-01-20', 4, 4, 1, '2023-07-28 05:54:27'),
(20, 16, 1, 1, '2023-08-05', '2023-11-05', 2, 1, 1, '2023-08-05 03:42:10'),
(21, 1, 1, 1, '2023-08-15', '2023-11-15', 2, 1, 1, '2023-08-15 05:13:20');

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
(1, '7865466789006121', '6865466789067435', 'Arfina', 'Adit', 'Banjarmasin', '2001-08-08', 'Jl. Hksn', '086374673647', 'Tidak KB', 'Hamil', 'Sedang Hamil', 4, 1, 1),
(2, '1237865411789556', '6826378456729000', 'Meyii', 'Rizky', 'Banjarmasinn', '2003-03-04', 'Komp. Amd', '97876767565999', 'KB', 'KB', '', 4, 1, 1),
(3, '6876514298000023', '6287655437865001', 'Yaya', 'Kikyw', 'Banjarmasin', '2000-07-20', 'Kayutangi 2', '087248248', 'KB', 'KB', '', 0, 2, 2),
(4, '6799987600200323', '6872998765228950', 'nyai', 'Adit', 'Banjarmasin', '2000-03-03', 'Komp. Herlina', '08967345534', 'KB', 'KB', '', 3, 1, 3),
(5, '2733988900002374', '6863889065389001', 'Nisa', 'Udin', 'Banjarmasins', '1973-03-20', 'Jl. HKSN', '0897656565', 'KB', 'KB', '', 3, 1, 1),
(6, '680064512765002', '671237896689017', 'Sumarni', 'Suratno', 'Banjarmasin', '1972-04-27', 'Kuin Selatan', '089623425363', 'Tidak KB', 'Lainnya', 'Non-PUS', 2, 1, 3),
(7, '8927654399001003', '8927654399001774', 'Tini', 'Toro', 'Banjarmasin', '1973-01-19', 'Jl. HKSN', '08864377354', 'Tidak KB', 'Belum Konfirmasi', '', 4, 2, 2),
(8, '1928765438910987', '6897887452987456', 'Siti', 'Ujang', 'Banjarmasin', '2001-02-06', 'Komp. Surya Gemilang', '087663887261', 'Tidak KB', 'Lainnya', 'PUS', 3, 1, 1),
(9, '6721467124624827', '6724271467214672', 'Puji', 'Puja', 'Banjarmasin', '1996-03-20', 'JL. Alalak Selatan', '08972475214', 'Tidak KB', 'Program Hamil', '', 2, 1, 1),
(10, '6841827417242674', '6151248248346715', 'Lusi', 'Lusa', 'Banjarmasin', '1996-09-01', 'JL. HKSN', '0887343746743', 'Tidak KB', 'Program Hamil', 'Ingin menambah anak', 3, 1, 1),
(11, '6812748162462716', '6312381236812673', 'Yuna', 'Yudi', 'Pelaihari', '1998-12-16', 'Komp. HKSN', '0892842748176', 'Tidak KB', 'Belum Konfirmasi', '', 2, 1, 1),
(12, '6818876909872234', '6309900210610000', 'Rini', 'Rino', 'Banjarmasin', '1998-03-19', 'Jl. Antasan Besar', '089783656372', 'KB', 'KB', '', 2, 3, 7),
(13, '6828467257468006', '6398754893211003', 'Asma', 'Asmi', 'Banjarmasin', '1999-10-02', 'Jl. Antasan Besar', '89653453153', 'KB', 'KB', '', 1, 3, 7),
(14, '6856786539003874', '6347858475847854', 'Fira', 'Firo', 'Banjarmasin', '1994-05-09', 'Mantuil', '086524323548', 'KB', 'KB', '', 2, 4, 9),
(15, '6874658938563001', '6378143763246005', 'Uji', 'Ujang', 'Banjarmasin', '1992-11-19', 'Benua Anyar', '098237482345', 'KB', 'KB', '', 3, 5, 8),
(16, '6767673757454675', '5748758475847857', 'Nisa', 'Niso', 'Banjarmasin', '2000-08-04', 'Jl. Hksn', '08976565656', 'KB', 'KB', '', 3, 1, 1);

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
(2, 2, 'Basirih'),
(3, 1, 'Alalak Utara'),
(4, 1, 'Alalak Tengah'),
(5, 2, 'Teluk Tiram'),
(6, 2, 'Belitung Selatan'),
(7, 3, 'Antasan Besar'),
(8, 5, 'Benua Anyar'),
(9, 4, 'Mantuil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_obat`
--

CREATE TABLE `tb_obat` (
  `id_obat` int(11) NOT NULL,
  `jenis_obat` varchar(50) NOT NULL,
  `nama_obat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_obat`
--

INSERT INTO `tb_obat` (`id_obat`, `jenis_obat`, `nama_obat`) VALUES
(2, 'Pil-KB', 'Marvelon'),
(4, 'Kondom', 'Durex'),
(5, 'Pil-KB', 'Yasmin'),
(6, 'Suntik', 'Depo-Provera (medroxyprogesterone)'),
(7, 'Pil-KB', 'Diane-35'),
(8, 'Pil-KB', 'Microgynon'),
(9, 'Pil-KB', 'Logynon');

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
(1, 'Dinas Perhubungan'),
(2, 'Dinas Kelautan dan Perikanan'),
(3, 'Masyarakat Setempat'),
(4, 'Dinas Pariwisata'),
(5, 'Dinas Energi dan Sumber Daya Mineral'),
(6, 'Dinas Dukcapil'),
(7, 'TNI - POLRI'),
(8, 'Kanwil Kementrian Hukum dan HAM'),
(9, 'Dinas Kominfo'),
(10, 'Dinas Koperasi'),
(11, 'Dinas Perindustrian'),
(12, 'Dinas Perdagangan'),
(13, 'Dinas Pertanian'),
(14, 'OPD Pengendalian Penduduk dan KB'),
(15, 'Dinas Ketenagakerjaan'),
(16, 'Dinas Pekerjaan Umum dan Perumahan Rakyat'),
(17, 'Dinas Kehutanan dan Lingkungan Hidup'),
(18, 'Dinas Bina Marga dan Penataan Ruang'),
(19, 'Kanwil Kementrian Agama');

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
(1, 1, 2, 9600, 8962, '2023-04-20', '2024-04-20', '2023-04-18 04:28:47'),
(2, 1, 5, 7800, 7795, '2023-04-20', '2024-04-20', '2023-04-20 06:27:41'),
(3, 2, 5, 9000, 8994, '2023-04-24', '2024-04-24', '2023-04-24 12:55:06'),
(4, 2, 4, 8000, 7996, '2023-04-24', '2024-04-24', '2023-04-24 12:55:44'),
(6, 1, 4, 400, 399, '2026-05-10', '2027-05-10', '2026-05-10 03:21:20'),
(7, 1, 7, 3000, 3000, '2023-06-15', '2024-06-15', '2023-07-20 07:02:41'),
(8, 3, 2, 8000, 7999, '2023-07-27', '2024-07-27', '2023-07-27 14:41:17'),
(9, 3, 5, 6000, 5999, '2023-07-27', '2024-07-27', '2023-07-27 14:41:54'),
(10, 4, 2, 8000, 7999, '2023-07-01', '2024-07-01', '2023-07-28 03:32:15'),
(11, 5, 5, 7000, 7000, '2023-07-01', '2024-07-01', '2023-07-28 03:33:59'),
(12, 5, 4, 5000, 4999, '2023-07-01', '2024-07-01', '2023-07-28 03:39:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nip` bigint(20) NOT NULL,
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
(1, 1, 'Admin', '', '', 'admin', 'admin', 'ADMIN'),
(2, 76868786867686867, 'KaBid', '76767676765', '', 'kabid', 'kabid', 'KABID'),
(3, 787348786547, 'PKB Banjarmasin Utara', '08897676775', 'Banjarmasin Utara', 'pkbutara', 'pkbutara', 'PKB');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_catatan`
--
ALTER TABLE `tb_catatan`
  ADD PRIMARY KEY (`id_catatan`),
  ADD KEY `intervensi_id` (`intervensi_id`);

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
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_catatan`
--
ALTER TABLE `tb_catatan`
  MODIFY `id_catatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_intervensi`
--
ALTER TABLE `tb_intervensi`
  MODIFY `id_intervensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_jenisinv`
--
ALTER TABLE `tb_jenisinv`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_kb`
--
ALTER TABLE `tb_kb`
  MODIFY `id_kb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_kecamatan`
--
ALTER TABLE `tb_kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_keluarga`
--
ALTER TABLE `tb_keluarga`
  MODIFY `id_keluarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_kelurahan`
--
ALTER TABLE `tb_kelurahan`
  MODIFY `id_kelurahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_opd`
--
ALTER TABLE `tb_opd`
  MODIFY `id_opd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tb_stok`
--
ALTER TABLE `tb_stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_catatan`
--
ALTER TABLE `tb_catatan`
  ADD CONSTRAINT `tb_catatan_ibfk_1` FOREIGN KEY (`intervensi_id`) REFERENCES `tb_intervensi` (`id_intervensi`) ON DELETE CASCADE ON UPDATE CASCADE;

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
