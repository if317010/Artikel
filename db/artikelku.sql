-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jun 2021 pada 14.12
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artikelku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `_artikel`
--

CREATE TABLE `_artikel` (
  `id` int(11) NOT NULL,
  `judul_artikel` varchar(255) DEFAULT NULL,
  `isi_artikel` varchar(255) DEFAULT NULL,
  `thumbnail_artikel` varchar(255) DEFAULT NULL,
  `tag_artikel` varchar(255) DEFAULT NULL,
  `kategori_artikel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `_artikel`
--

INSERT INTO `_artikel` (`id`, `judul_artikel`, `isi_artikel`, `thumbnail_artikel`, `tag_artikel`, `kategori_artikel`) VALUES
(5, 'Cara Menanam Cabe Bulat', 'Ubi adalah sejenis umbi umbian', 'foto', 'cabe', 'cabe-cabean'),
(9, 'Cara Menanam Ubi', 'ubi itu enak', 'gambar ubi', 'umbi umbian', 'umbian'),
(43, 'Cara Menanam Cabe Bulat', 'dasdasd', 'asdasd', 'asdasd', 'asdasd11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `_users`
--

CREATE TABLE `_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `_users`
--

INSERT INTO `_users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `_artikel`
--
ALTER TABLE `_artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `_users`
--
ALTER TABLE `_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `_artikel`
--
ALTER TABLE `_artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `_users`
--
ALTER TABLE `_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
