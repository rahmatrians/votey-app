-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2021 at 05:22 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `votey`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(2) NOT NULL,
  `nama_lengkap` varchar(30) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_lengkap`, `username`, `password`, `last_login`) VALUES
(1, 'Rahmat Riansyah', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `data_suara`
--

CREATE TABLE `data_suara` (
  `id_suara` int(11) NOT NULL,
  `id_kandidat` int(2) NOT NULL,
  `id_poll` int(11) NOT NULL,
  `total_suara` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_suara`
--

INSERT INTO `data_suara` (`id_suara`, `id_kandidat`, `id_poll`, `total_suara`) VALUES
(40, 12, 2, 7),
(41, 13, 2, 1),
(42, 30, 2, 1),
(46, 39, 55, 15),
(52, 47, 58, 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_voting`
--

CREATE TABLE `data_voting` (
  `id_voting` int(11) NOT NULL,
  `id_poll` int(11) NOT NULL,
  `nim` int(11) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_voting`
--

INSERT INTO `data_voting` (`id_voting`, `id_poll`, `nim`, `date`) VALUES
(68, 2, 1002140004, '2021-11-08'),
(69, 2, 1002140001, '2021-11-08'),
(70, 2, 1002140002, '2021-11-08'),
(71, 2, 1002140005, '2021-11-08'),
(72, 2, 1002140006, '2021-11-08'),
(73, 2, 1002140009, '2021-11-08'),
(80, 55, 1002140016, '2021-11-28'),
(82, 2, 1002140016, '2021-11-28'),
(83, 2, 1002140017, '2021-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `event_poll`
--

CREATE TABLE `event_poll` (
  `id_poll` int(11) NOT NULL,
  `nama_poll` varchar(35) NOT NULL,
  `waktu` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_poll`
--

INSERT INTO `event_poll` (`id_poll`, `nama_poll`, `waktu`, `status`) VALUES
(2, 'Pemilihan Ketua BEM 2020/2021', '2020-11-08', 1),
(4, 'Pemilihan Ketua BEM 2021/2022', '2021-09-20', 0),
(55, 'Pemilihan Ketua BEM 2024/2025', '2021-10-08', 0),
(58, 'Pemilihan Ketua BEM 2026/2027', '2021-11-28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kandidat`
--

CREATE TABLE `kandidat` (
  `id_kandidat` int(2) NOT NULL,
  `id_poll` int(11) NOT NULL,
  `nama_ketua` varchar(30) DEFAULT NULL,
  `nama_wakil` varchar(30) DEFAULT NULL,
  `foto_ketua` text DEFAULT NULL,
  `foto_wakil` text NOT NULL,
  `visi` text DEFAULT NULL,
  `misi` text DEFAULT NULL,
  `program_kerja` text DEFAULT NULL,
  `slogan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kandidat`
--

INSERT INTO `kandidat` (`id_kandidat`, `id_poll`, `nama_ketua`, `nama_wakil`, `foto_ketua`, `foto_wakil`, `visi`, `misi`, `program_kerja`, `slogan`) VALUES
(12, 2, 'Hilmi', 'Naura', 'hilmi.jpg', 'naura.jpg', 'Menjadikan BEM sebagai sarana penampungan Kreatifitas, Inspirasi dan Aspirasi Mahasiswa, juga meningkatkan BEM sebagai Badan Eksekutif Mahasiswa  yang bermutu, beraklak mulia, tampil beda, jujur, adil, disipin dalam lingkup Kampus dan Masyarakat.\r\n', 'Mengaktifkan dan memajukan organisasi-organisasi/UKM dan kepengurusannya.\r\n', 'Mengadakan perlombaan komputer\r\n', 'solid dan berkualitas'),
(13, 2, 'Subedi', 'Yuli', 'subedi.jpg', 'yuli.jpg', 'siap bergerak untuk pelayanan prima yang bersinergi, terdepan dan berprestasi', 'mengoptimalkan potensi mahasiswa dengan pelayanan yang maksimal, membangun internal organisasi yang terbuka dan profesional', 'mewadahi mahasiswa untuk dapat berkreasi dalam mengembangkan kemampuannya dibiadang Teknologi', 'Bersih Berdaulat'),
(30, 2, 'Farhan', 'Ani', 'farhan.jpg', 'ani.jpg', 'mewujudkan BEM yang inteletual intrepreneurship dengan berlandaskan nilai kesilaman', 'menjalin komunikasi dan kerjasama dalam lingkungan internal', 'mengadakan pelatihan website dan mobile', 'Cerdas, Berkarakter, dan Bertanggung Jawab'),
(39, 55, 'Dan', 'Ari', '1638105430_d47b5c8f2d98539a347b.jpg', '1638105430_dc931a1650c753b59162.jpg', 'asal aja', 'gtau apaan', 'gtau', 'sukses transparan'),
(47, 58, 'Farhan', 'Aliyudin', '1638108072_5529cf06b9b69ee40382.jpg', '1638108072_ff29a241df6a94c29df1.jpg', 'Membangun Organisasi yang bersinergis', 'Membangun Fakultas yang bersinergis', 'Mewadahi Mahasiswa berkreasi sebebasnya', 'Solid dan Sinergis');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `nim` int(11) NOT NULL,
  `nama_lengkap` varchar(30) DEFAULT NULL,
  `id_prodi` int(2) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `password` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`nim`, `nama_lengkap`, `id_prodi`, `tgl_lahir`, `password`) VALUES
(1002140001, 'Nunito Farhan', 2, '2000-10-01', '20001001'),
(1002140002, 'Samsudin Kurniawan', 2, '2001-12-03', '20011203'),
(1002140003, 'Arga Santang', 1, '2001-05-11', '20010511'),
(1002140004, 'Andrie Pratama', 1, '2000-01-08', '20000108'),
(1002140005, 'Hani Handayani', 1, '2002-12-01', '20021201'),
(1002140006, 'Firmansyah', 2, '1999-12-12', '19991212'),
(1002140009, 'Joko Triono', 2, '2021-10-22', '20211022'),
(1002140013, 'Fahmi Ardi', 1, '2021-11-22', '20211122'),
(1002140014, 'Sutrio Arnando', 2, '2021-10-27', '20211027'),
(1002140015, 'Yuno Aliandri', 1, '2021-10-14', '20211014'),
(1002140016, 'Farabi Rifaah', 1, '2001-11-08', '20011108'),
(1002140017, 'Anasta Nuraini', 1, '2021-06-12', '20210612'),
(1147483647, 'Abu Bakar', 2, '2021-10-31', '20211031');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(2) NOT NULL,
  `nama_prodi` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `nama_prodi`) VALUES
(1, 'Teknik Informatika'),
(2, 'Sistem Informasi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `data_suara`
--
ALTER TABLE `data_suara`
  ADD PRIMARY KEY (`id_suara`),
  ADD KEY `id_kandidat` (`id_kandidat`),
  ADD KEY `id_poll` (`id_poll`);

--
-- Indexes for table `data_voting`
--
ALTER TABLE `data_voting`
  ADD PRIMARY KEY (`id_voting`),
  ADD KEY `nim` (`nim`),
  ADD KEY `nim_2` (`nim`),
  ADD KEY `id_poll` (`id_poll`);

--
-- Indexes for table `event_poll`
--
ALTER TABLE `event_poll`
  ADD PRIMARY KEY (`id_poll`);

--
-- Indexes for table `kandidat`
--
ALTER TABLE `kandidat`
  ADD PRIMARY KEY (`id_kandidat`),
  ADD KEY `id_poll` (`id_poll`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_suara`
--
ALTER TABLE `data_suara`
  MODIFY `id_suara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `data_voting`
--
ALTER TABLE `data_voting`
  MODIFY `id_voting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `event_poll`
--
ALTER TABLE `event_poll`
  MODIFY `id_poll` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `kandidat`
--
ALTER TABLE `kandidat`
  MODIFY `id_kandidat` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_suara`
--
ALTER TABLE `data_suara`
  ADD CONSTRAINT `data_suara_ibfk_1` FOREIGN KEY (`id_kandidat`) REFERENCES `kandidat` (`id_kandidat`),
  ADD CONSTRAINT `data_suara_ibfk_2` FOREIGN KEY (`id_poll`) REFERENCES `event_poll` (`id_poll`);

--
-- Constraints for table `data_voting`
--
ALTER TABLE `data_voting`
  ADD CONSTRAINT `data_voting_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `peserta` (`nim`),
  ADD CONSTRAINT `data_voting_ibfk_2` FOREIGN KEY (`id_poll`) REFERENCES `event_poll` (`id_poll`);

--
-- Constraints for table `kandidat`
--
ALTER TABLE `kandidat`
  ADD CONSTRAINT `kandidat_ibfk_1` FOREIGN KEY (`id_poll`) REFERENCES `event_poll` (`id_poll`);

--
-- Constraints for table `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `peserta_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
