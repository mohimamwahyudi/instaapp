-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Apr 2021 pada 11.41
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instaapp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `idkomen` int(11) NOT NULL,
  `idpost` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `deskripsi` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`idkomen`, `idpost`, `id_user`, `deskripsi`) VALUES
(1, 4, 3, 'bagus bang!!!'),
(2, 5, 3, 'ganteng sekali bang panten kail!!'),
(3, 4, 4, 'mak ganteng le'),
(4, 6, 3, 'oh bagus sekali mantap betul');

-- --------------------------------------------------------

--
-- Struktur dari tabel `postingan`
--

CREATE TABLE `postingan` (
  `idpost` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `text` varchar(200) DEFAULT NULL,
  `suka` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `postingan`
--

INSERT INTO `postingan` (`idpost`, `id_user`, `gambar`, `text`, `suka`) VALUES
(4, 2, 'gambar-karikatur-4.png', 'saya pusing tolong lah eror terus', 6),
(5, 2, 'imam1.jpg', 'zdgfjkhfnxbx', 1),
(6, 2, 'Pr2.png', 'saya sedang di basmalah', 1),
(7, 3, 'images (4).jpg', 'saya sedang galau', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `teman`
--

CREATE TABLE `teman` (
  `id` int(11) DEFAULT NULL,
  `id_teman` int(11) DEFAULT NULL,
  `status` enum('mengikuti','belum') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `teman`
--

INSERT INTO `teman` (`id`, `id_teman`, `status`) VALUES
(2, 3, 'mengikuti'),
(2, 4, 'mengikuti'),
(3, 2, 'mengikuti'),
(4, 2, 'mengikuti');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) DEFAULT NULL,
  `tgl` varchar(15) DEFAULT NULL,
  `foto` varchar(64) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `pwd` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `tgl`, `foto`, `username`, `pwd`) VALUES
(2, 'moh. imam wahyudi', '1999-12-03', 'gambar-karikatur-4.png', 'mohimamwahyudi', 'dde70fc51aa3b23750412dcd3abff36a2a483f63d20fa4b92ab44a45ac555b4b'),
(3, 'ananda rizky romadhon', '2021-04-03', 'Pr2.png', 'perrok', 'dde70fc51aa3b23750412dcd3abff36a2a483f63d20fa4b92ab44a45ac555b4b'),
(4, 'halimi firdaus', '2021-04-04', 'default.jpg', 'halimi', 'dde70fc51aa3b23750412dcd3abff36a2a483f63d20fa4b92ab44a45ac555b4b'),
(5, 'firman maulana', '2000-02-29', 'default.jpg', 'firman', 'dde70fc51aa3b23750412dcd3abff36a2a483f63d20fa4b92ab44a45ac555b4b');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`idkomen`),
  ADD KEY `idpost` (`idpost`);

--
-- Indeks untuk tabel `postingan`
--
ALTER TABLE `postingan`
  ADD PRIMARY KEY (`idpost`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `teman`
--
ALTER TABLE `teman`
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `idkomen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `postingan`
--
ALTER TABLE `postingan`
  MODIFY `idpost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`idpost`) REFERENCES `postingan` (`idpost`);

--
-- Ketidakleluasaan untuk tabel `postingan`
--
ALTER TABLE `postingan`
  ADD CONSTRAINT `postingan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `teman`
--
ALTER TABLE `teman`
  ADD CONSTRAINT `teman_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
