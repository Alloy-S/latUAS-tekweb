-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221113.0eded7bb43
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Des 2022 pada 09.53
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uastekweb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pengiriman`
--

CREATE TABLE `detail_pengiriman` (
  `nomor_resi` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `kota` varchar(30) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_pengiriman`
--

INSERT INTO `detail_pengiriman` (`nomor_resi`, `tanggal`, `kota`, `keterangan`) VALUES
('RS-001', '2022-12-11', 'surabaya', 'picked up'),
('RS-001', '2022-12-15', 'asdads', 'asdadsasd'),
('RS-001', '2022-12-16', 'solo', 'on proses'),
('RS-002', '2022-12-14', 'salatiga', 'sampai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `nomor_resi` varchar(10) NOT NULL,
  `tanggal_resi` date NOT NULL,
  `jenis_pengiriman` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengiriman`
--

INSERT INTO `pengiriman` (`nomor_resi`, `tanggal_resi`, `jenis_pengiriman`) VALUES
('RS-001', '2022-12-11', 'standar'),
('RS-002', '2022-12-13', 'asdasda'),
('RS-003', '2022-12-14', 'cepat'),
('RS-004', '2022-12-14', 'asdasda');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `status_aktif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama_admin`, `status_aktif`) VALUES
(1, 'c14210265', '$2y$10$4K/m5Bbd9cGyNwDnTwBczOtit15xBuAmR8DbR33QH8jmYqp8Ur6HS', 'steven', 1),
(4, 'admin', '$2y$10$f2.w5IldpoIlQ/Dn4OVLPOFwwVnyBzCLj4fJRTRlkffmHsJyrfxv.', 'admin', 1),
(5, 'budi', '$2y$10$C/x3zVy1Evq.9aHDHMbxGOD9pQSwVQzLmlP14jbTnSRViwM/d68gi', 'budi', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_pengiriman`
--
ALTER TABLE `detail_pengiriman`
  ADD KEY `nomor_resi` (`nomor_resi`);

--
-- Indeks untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`nomor_resi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pengiriman`
--
ALTER TABLE `detail_pengiriman`
  ADD CONSTRAINT `detail_pengiriman_ibfk_1` FOREIGN KEY (`nomor_resi`) REFERENCES `pengiriman` (`nomor_resi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
