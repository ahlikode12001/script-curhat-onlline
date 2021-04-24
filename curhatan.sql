-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2021 at 04:41 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `curhatan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `id_account` int(12) NOT NULL,
  `unique_id` varchar(225) NOT NULL,
  `FullName` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `status_akun` varchar(12) NOT NULL,
  `gender` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`id_account`, `unique_id`, `FullName`, `email`, `password`, `status_akun`, `gender`) VALUES
(25, '1496794244', 'Andre Tri Ramadana', 'andre@gmail.com', '$2y$10$t7wJ7Jj5UDo7B6S5z4gE5uy5O5Y/zpb7DFQfPswcHgNzbcQBfrVr2', 'active', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_curhat`
--

CREATE TABLE `tbl_curhat` (
  `id_curhat` int(15) NOT NULL,
  `unique_id` int(225) NOT NULL,
  `urlSlug` text NOT NULL,
  `subject` text NOT NULL,
  `message` longtext NOT NULL,
  `gambar` varchar(225) NOT NULL,
  `kate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_curhat`
--

INSERT INTO `tbl_curhat` (`id_curhat`, `unique_id`, `urlSlug`, `subject`, `message`, `gambar`, `kate`) VALUES
(18, 1496794244, 'pacarku-masih-akrab-dengan-mantannya', 'Pacarku Masih Akrab Dengan MantanNya', 'assalamualikum gw mau curhat sama kalian jika ada yang mau memberikan saran atau masukan gw harus gimana gw sangat senang. gw dapet pacar dari salah satu sosmed sebelum gw pacaran sama dia dia pernah bilang sama gw bahwa dia sering main sama mantannya dan gw jawab gak apa apa gaklama setelah itu gw pacaran sama dia tapi setelah lama gw pacaran ko gw ngerasa dia sanga dekat dengan mantannya sampe kepantai bareng. gw bingung gw mau marah tapi disatu sisi gw udh nerima kalo dia sering main sama mantan nya gw kira mainnya ya kayak biasa main lah tap kalo sampe jalan jalan berdua ke pantai ya gimana ya gw mau minta saran sama kawan kawan apa yang harus gw lakukan?', '60842dd6322ac.jpg', 'Cinta');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kat` int(12) NOT NULL,
  `nama_kategori` varchar(225) NOT NULL,
  `UrlKat` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kat`, `nama_kategori`, `UrlKat`) VALUES
(1, 'None', 'none'),
(2, 'Cinta\r\n', 'cinta'),
(3, 'Hubungan', 'hubungan'),
(4, 'Putus Cinta', 'putus-cinta'),
(5, 'Family', 'family');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`id_account`);

--
-- Indexes for table `tbl_curhat`
--
ALTER TABLE `tbl_curhat`
  ADD PRIMARY KEY (`id_curhat`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `id_account` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_curhat`
--
ALTER TABLE `tbl_curhat`
  MODIFY `id_curhat` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kat` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
