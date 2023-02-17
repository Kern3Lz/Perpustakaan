-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Feb 2023 pada 03.43
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prausk_sukenmfauzan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_admin`
--

CREATE TABLE `t_admin` (
  `f_id` int(11) NOT NULL,
  `f_nama` varchar(200) NOT NULL DEFAULT '0',
  `f_username` varchar(200) NOT NULL DEFAULT '0',
  `f_password` varchar(200) NOT NULL DEFAULT '0',
  `f_level` enum('Admin','Pustakawan') NOT NULL,
  `f_status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_admin`
--

INSERT INTO `t_admin` (`f_id`, `f_nama`, `f_username`, `f_password`, `f_level`, `f_status`) VALUES
(1, 'Kaisel', 'Kaisel', '123', 'Pustakawan', 'Aktif'),
(2, 'Igris', 'Igris', '123', 'Admin', 'Aktif'),
(3, 'Tusk', 'Tusk', '123', 'Pustakawan', 'Tidak Aktif'),
(4, 'Budi Andi', 'Budi', '123', 'Admin', 'Aktif'),
(5, 'Fadli', 'Fadli', 'rahasia', 'Admin', 'Aktif'),
(6, 'asd', 'asd', '$2y$10$P7O7J2fgn.h1rsxtZJdio.0A/aBJo9gM/PN0fj0yzXBhNv8cU3JDS', 'Pustakawan', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_anggota`
--

CREATE TABLE `t_anggota` (
  `f_id` int(11) NOT NULL,
  `f_nama` varchar(200) DEFAULT NULL,
  `f_username` varchar(200) NOT NULL,
  `f_password` varchar(200) NOT NULL,
  `f_tempatlahir` varchar(100) DEFAULT NULL,
  `f_tanggallahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_anggota`
--

INSERT INTO `t_anggota` (`f_id`, `f_nama`, `f_username`, `f_password`, `f_tempatlahir`, `f_tanggallahir`) VALUES
(1, 'Andi Budi', 'andib', '$2y$10$wBkGmsCsMmbmRs6J.STqCOa7ajIDulKnyKmM/6.zOhBoDy98Vmb.S', 'Saranjana', '1994-01-13'),
(2, 'Eko Santoso', 'ekos', '$2y$10$Bd7M2IafWkg7UVlXgO37F.NSvo5eWD2qpxVm44dinffSHxyggjZYK', 'Amerika', '1994-01-29'),
(3, 'Herry Hermansyah', 'herry', '$2y$10$a/vLqvUP.5c7J/bplJsKiu7Emi2LK7BJLkVqaN7SwdnUQ8tcKfXGi', 'Subang', '1983-06-14'),
(4, 'Dafif Al Aziz Imansyah', 'dafif', '$2y$10$4dTl.2fCg5ry7YGS1zBkJ.M6YrgVERnVfCMo2ISX8uGz9u/JCHHF2', 'Subang', '2004-08-12'),
(5, 'Bakri', 'roti', '$2y$10$4NuzgVFSQQXtf5Xcuoxju.wpA0K9z8XY5Y/c4Za.APJauGvenuSaS', 'Jakarta', '1967-02-01'),
(6, 'Tusk', 'tusk', '$2y$10$vuoALgLvvcUdRazkijfh3eNE2WO128zlgxRj2wSoOw0.BRXU03Wie', 'Saranjana', '1969-12-09'),
(7, 'Roronoa Zoro', 'zoro', '$2y$10$x81nWGmU.yLSWSyp7Fma7.tCg4h1iryPIm0o3p08VvRJEXCTBOGsy', 'Wanokuni', '1994-01-05'),
(8, 'Luffy', 'luffy', '$2y$10$H8q81XX6ooG3beFySgC5BOGxIy6BBlmWTP5xxtgyndT9ntBEGB2Na', 'East Blue', '1994-01-28'),
(9, 'Vinsmoke Sanji', 'sanji', '$2y$10$09qvyCvl1/meWN7RuUegSuWRX3YT7al1iKFWIuvlv6AqGENDnDWS6', 'East Blue', '1994-01-22'),
(10, 'Nami', 'nami', '$2y$10$DZvPXvcDDvMbN2khunJo9.f2XW5u1Lc.LJbc22AMLf73xC81sWhbW', 'East Blue', '1994-04-08'),
(11, 'Nico Robin', 'robin', '$2y$10$Hmg2qgILJOE0MgDH2ROmS.7uMaNwQT1Rz0vL.PYPV4cLqsauovES6', 'Ohara', '1994-05-26'),
(12, 'Franky', 'franky', '$2y$10$ZdhXPUcwrgN81wqtAo.qzO8BQUqb8LVeS76v4361FxnvRO.w/0V6m', 'Water 7', '1994-06-29'),
(13, 'Tony Tony Chopper', 'chopper', '$2y$10$RCjzdRv6G5jcUuqlVsWf9em1KBFoSVqdP2CUTJDAazf37KoMdkP1e', 'Drum', '1994-06-14'),
(14, 'Usopp', 'usopp', '$2y$10$VWYppCAFYKHezhdC31yeaukKw5oCwsogkIax2blcKo7ymBWGKKT06', 'Syrup', '1994-06-10'),
(15, 'Brook', 'brook', '$2y$10$yXmuHlhxj9YShy103xYli.Hd8GoxPxx1WCP5bUQE4j47lcYWV1DJa', 'Florian Triangle', '1994-04-08'),
(16, 'Jinbe', 'jinbe', '$2y$10$L5tz3Id2EaA0o2o1OZzJoelK88/SrQpALdVkkkLxRS3jhgVN0Jpte', 'Fishman Island', '1994-04-08'),
(17, 'Greed', 'greed', '$2y$10$tnvWfrk09YHniVlJVfefzeXm9CikVty89NYbT2xgH.rvPfd94.MLi', 'Shadow', '1994-04-08'),
(18, 'Bellion', 'bellion', '$2y$10$gA5fVKK4FKgLgu4NF4dsa.rP1fC7PAR1mCdNaSsffrDTs15ZAU9x6', 'Shadow', '1994-03-17'),
(19, 'Giants', 'giants', '$2y$10$EhNw2gSKjvCfKzOWrnrNOeBOCF3fkW4r4YQSfC0rwNlGduVUjD4ee', 'Shadow', '1994-03-18'),
(20, 'Anton', 'anton', '$2y$10$5.PyXEgNLzaOMYGXVOAzYOoTuL6O1GIF5YbaUfmly2DMGX7gyETB6', 'Jakarta', '2004-12-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_buku`
--

CREATE TABLE `t_buku` (
  `f_id` int(11) NOT NULL,
  `f_idkategori` int(11) DEFAULT NULL,
  `f_judul` varchar(200) DEFAULT NULL,
  `f_pengarang` varchar(200) DEFAULT NULL,
  `f_penerbit` varchar(200) DEFAULT NULL,
  `f_deskripsi` varchar(700) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_buku`
--

INSERT INTO `t_buku` (`f_id`, `f_idkategori`, `f_judul`, `f_pengarang`, `f_penerbit`, `f_deskripsi`) VALUES
(1, 26, 'Astronomical Perspectives', 'Aldian Onair', 'AEsir', 'Buku berisi bergala rumus-perumusan astronomis'),
(2, 27, 'Bahasa Indonesia', 'Arief Budiman', 'Kemendikbud', 'Buku berisi rangkaian informasi terstruktur mengenai suatu materi Bahasa Indonesia'),
(4, 1, 'The Alchemist One', 'Paulo Coelho', 'HarperCollins', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(5, 1, 'The Power of Now', 'Eckhart Tolle', 'New World Library', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(6, 2, 'The Lean Startup', 'Eric Ries', 'Crown Business', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(7, 3, 'To Kill a Mockingbird', 'Harper Lee', 'HarperCollins', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(8, 3, 'Pride and Prejudice', 'Jane Austen', 'Penguin Classics', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(9, 4, '1984', 'George Orwell', 'Signet Classics', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(10, 4, 'Brave New World', 'Aldous Huxley', 'HarperCollins', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(11, 5, 'Harry Potter and the Philosopher\'s Stone', 'J.K. Rowling', 'Bloomsbury', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(12, 5, 'The Lord of the Rings', 'J.R.R. Tolkien', 'HarperCollins', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(13, 6, 'The 5 Love Languages', 'Gary Chapman', 'Northfield Publishing', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(14, 6, 'The 7 Habits of Highly Effective People', 'Stephen Covey', 'Free Press', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(15, 7, 'The Art of War', 'Sun Tzu', 'Oxford University Press', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(16, 7, 'Meditations', 'Marcus Aurelius', 'Penguin Classics', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(17, 8, 'The Hitchhiker\'s Guide to the Galaxy', 'Douglas Adams', 'Pan Books', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(18, 8, 'Good Omens', 'Neil Gaiman, Terry Pratchett', 'HarperCollins', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(19, 9, 'The Da Vinci Code', 'Dan Brown', 'Doubleday', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(20, 4, 'Harry Potter dan Batu Bertuah', 'J.K. Rowling', 'Penerbit Gramedia', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(21, 2, 'The Origin of Species', 'Charles Darwin', 'John Murray', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(22, 1, 'Einstein’s Dreams', 'Alan Lightman', 'Vintage', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(23, 5, 'Percy Jackson dan Ksatria petir', 'Rick Riordan', 'Gramedia Pustaka Utama', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor dolores unde delectus facere est deleniti quas velit. Nesciunt, nobis incidunt?'),
(24, 2, 'Matematika Kelas XII', 'Anonim', 'Erlangga', 'Buku Matematika untuk anak kelas XII ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_detailbuku`
--

CREATE TABLE `t_detailbuku` (
  `f_id` int(11) NOT NULL,
  `f_idbuku` int(11) DEFAULT NULL,
  `f_status` enum('tersedia','tidak') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_detailbuku`
--

INSERT INTO `t_detailbuku` (`f_id`, `f_idbuku`, `f_status`) VALUES
(1, 1, 'tersedia'),
(2, 1, 'tersedia'),
(3, 1, 'tersedia'),
(4, 1, 'tersedia'),
(5, 1, 'tersedia'),
(6, 2, 'tersedia'),
(7, 2, 'tersedia'),
(8, 2, 'tersedia'),
(9, 2, 'tersedia'),
(10, 2, 'tersedia'),
(11, 4, 'tersedia'),
(12, 4, 'tersedia'),
(13, 4, 'tersedia'),
(14, 4, 'tersedia'),
(15, 4, 'tersedia'),
(16, 5, 'tersedia'),
(17, 5, 'tersedia'),
(18, 5, 'tersedia'),
(19, 5, 'tersedia'),
(20, 5, 'tersedia'),
(21, 6, 'tersedia'),
(22, 6, 'tersedia'),
(23, 6, 'tersedia'),
(24, 6, 'tersedia'),
(26, 7, 'tersedia'),
(27, 7, 'tersedia'),
(28, 7, 'tersedia'),
(29, 7, 'tersedia'),
(30, 7, 'tersedia'),
(31, 8, 'tersedia'),
(32, 8, 'tersedia'),
(33, 8, 'tersedia'),
(34, 8, 'tersedia'),
(35, 8, 'tersedia'),
(36, 9, 'tersedia'),
(37, 9, 'tersedia'),
(38, 9, 'tersedia'),
(39, 9, 'tersedia'),
(40, 9, 'tersedia'),
(41, 10, 'tersedia'),
(42, 10, 'tersedia'),
(43, 10, 'tersedia'),
(44, 10, 'tersedia'),
(45, 10, 'tersedia'),
(46, 11, 'tersedia'),
(47, 11, 'tersedia'),
(48, 11, 'tersedia'),
(49, 11, 'tersedia'),
(50, 11, 'tersedia'),
(51, 12, 'tersedia'),
(52, 12, 'tersedia'),
(53, 12, 'tersedia'),
(54, 12, 'tersedia'),
(55, 12, 'tersedia'),
(56, 12, 'tersedia'),
(57, 13, 'tersedia'),
(58, 13, 'tersedia'),
(59, 13, 'tersedia'),
(60, 13, 'tersedia'),
(61, 13, 'tersedia'),
(62, 14, 'tersedia'),
(63, 14, 'tersedia'),
(64, 14, 'tersedia'),
(65, 14, 'tersedia'),
(66, 14, 'tersedia'),
(67, 15, 'tersedia'),
(68, 15, 'tersedia'),
(69, 15, 'tersedia'),
(70, 15, 'tersedia'),
(71, 15, 'tersedia'),
(72, 16, 'tersedia'),
(73, 16, 'tersedia'),
(74, 16, 'tersedia'),
(75, 16, 'tersedia'),
(76, 16, 'tersedia'),
(77, 17, 'tersedia'),
(78, 17, 'tersedia'),
(79, 17, 'tersedia'),
(80, 17, 'tersedia'),
(81, 17, 'tersedia'),
(82, 18, 'tersedia'),
(83, 18, 'tersedia'),
(84, 18, 'tersedia'),
(85, 18, 'tersedia'),
(86, 18, 'tersedia'),
(87, 19, 'tersedia'),
(88, 19, 'tersedia'),
(89, 19, 'tersedia'),
(90, 19, 'tersedia'),
(91, 19, 'tersedia'),
(92, 20, 'tersedia'),
(93, 20, 'tersedia'),
(94, 20, 'tersedia'),
(95, 20, 'tersedia'),
(96, 20, 'tersedia'),
(97, 21, 'tersedia'),
(98, 21, 'tersedia'),
(99, 21, 'tersedia'),
(100, 21, 'tersedia'),
(101, 21, 'tersedia'),
(102, 22, 'tersedia'),
(103, 22, 'tersedia'),
(104, 22, 'tersedia'),
(105, 22, 'tersedia'),
(106, 22, 'tersedia'),
(107, 23, 'tersedia'),
(108, 23, 'tersedia'),
(109, 23, 'tersedia'),
(110, 23, 'tersedia'),
(111, 23, 'tersedia'),
(112, 24, 'tidak'),
(113, 24, 'tersedia'),
(114, 24, 'tersedia'),
(115, 24, 'tersedia'),
(116, 24, 'tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_detailpeminjaman`
--

CREATE TABLE `t_detailpeminjaman` (
  `f_id` int(11) NOT NULL,
  `f_idpeminjaman` int(11) DEFAULT NULL,
  `f_iddetailbuku` int(11) DEFAULT NULL,
  `f_tanggalkembali` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_detailpeminjaman`
--

INSERT INTO `t_detailpeminjaman` (`f_id`, `f_idpeminjaman`, `f_iddetailbuku`, `f_tanggalkembali`) VALUES
(2, 2, 112, '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kategori`
--

CREATE TABLE `t_kategori` (
  `f_id` int(11) NOT NULL,
  `f_kategori` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_kategori`
--

INSERT INTO `t_kategori` (`f_id`, `f_kategori`) VALUES
(1, 'Sains'),
(2, 'Matematika'),
(3, 'Sejarah'),
(4, 'Geografi'),
(5, 'Bahasa'),
(6, 'Seni'),
(7, 'Ekonomi'),
(8, 'Sosiologi'),
(9, 'Fisika'),
(10, 'Kimia'),
(11, 'Biologi'),
(12, 'Komik Anak'),
(13, 'Komik Dewasa'),
(14, 'Novel'),
(15, 'Buku Pelajaran'),
(16, 'Ensiklopedia'),
(17, 'Buku Ilmiah'),
(18, 'Buku Keuangan'),
(19, 'Buku Hiburan'),
(20, 'Buku Motivasi'),
(26, 'Fisika'),
(27, 'Sastra'),
(28, 'Buku Panduan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_peminjaman`
--

CREATE TABLE `t_peminjaman` (
  `f_id` int(11) NOT NULL,
  `f_idadmin` int(11) DEFAULT NULL,
  `f_idanggota` int(11) DEFAULT NULL,
  `f_tanggalpeminjaman` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_peminjaman`
--

INSERT INTO `t_peminjaman` (`f_id`, `f_idadmin`, `f_idanggota`, `f_tanggalpeminjaman`) VALUES
(1, 4, 1, '2023-02-17'),
(2, 4, 1, '2023-02-17');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_admin`
--
ALTER TABLE `t_admin`
  ADD PRIMARY KEY (`f_id`);

--
-- Indeks untuk tabel `t_anggota`
--
ALTER TABLE `t_anggota`
  ADD PRIMARY KEY (`f_id`);

--
-- Indeks untuk tabel `t_buku`
--
ALTER TABLE `t_buku`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `idkategori` (`f_idkategori`);

--
-- Indeks untuk tabel `t_detailbuku`
--
ALTER TABLE `t_detailbuku`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `idbuku` (`f_idbuku`);

--
-- Indeks untuk tabel `t_detailpeminjaman`
--
ALTER TABLE `t_detailpeminjaman`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `idpeminjaman` (`f_idpeminjaman`),
  ADD KEY `iddetailbuku` (`f_iddetailbuku`);

--
-- Indeks untuk tabel `t_kategori`
--
ALTER TABLE `t_kategori`
  ADD PRIMARY KEY (`f_id`);

--
-- Indeks untuk tabel `t_peminjaman`
--
ALTER TABLE `t_peminjaman`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `t_peminjaman_ibfk_1` (`f_idadmin`),
  ADD KEY `t_peminjaman_ibfk_2` (`f_idanggota`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_admin`
--
ALTER TABLE `t_admin`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `t_anggota`
--
ALTER TABLE `t_anggota`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `t_buku`
--
ALTER TABLE `t_buku`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `t_detailbuku`
--
ALTER TABLE `t_detailbuku`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT untuk tabel `t_detailpeminjaman`
--
ALTER TABLE `t_detailpeminjaman`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `t_kategori`
--
ALTER TABLE `t_kategori`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `t_peminjaman`
--
ALTER TABLE `t_peminjaman`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `t_buku`
--
ALTER TABLE `t_buku`
  ADD CONSTRAINT `t_buku_ibfk_1` FOREIGN KEY (`f_idkategori`) REFERENCES `t_kategori` (`f_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `t_detailbuku`
--
ALTER TABLE `t_detailbuku`
  ADD CONSTRAINT `t_detailbuku_ibfk_1` FOREIGN KEY (`f_idbuku`) REFERENCES `t_buku` (`f_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `t_detailpeminjaman`
--
ALTER TABLE `t_detailpeminjaman`
  ADD CONSTRAINT `t_detailpeminjaman_ibfk_1` FOREIGN KEY (`f_iddetailbuku`) REFERENCES `t_detailbuku` (`f_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_detailpeminjaman_ibfk_2` FOREIGN KEY (`f_idpeminjaman`) REFERENCES `t_peminjaman` (`f_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_peminjaman`
--
ALTER TABLE `t_peminjaman`
  ADD CONSTRAINT `t_peminjaman_ibfk_1` FOREIGN KEY (`f_idadmin`) REFERENCES `t_admin` (`f_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_peminjaman_ibfk_2` FOREIGN KEY (`f_idanggota`) REFERENCES `t_anggota` (`f_id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
