-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2019 at 02:42 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penggajian`
--

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `no_slip` varchar(6) NOT NULL,
  `tanggal` date NOT NULL,
  `pendapatan` int(20) NOT NULL,
  `potongan` int(20) NOT NULL,
  `gaji_bersih` int(20) NOT NULL,
  `nip` int(12) NOT NULL,
  `kode_petugas` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`no_slip`, `tanggal`, `pendapatan`, `potongan`, `gaji_bersih`, `nip`, `kode_petugas`) VALUES
('SLB001', '2019-01-03', 10500000, 1050000, 9450000, 18600001, 'PTG001'),
('SLB002', '2019-01-03', 11800000, 1180000, 10620000, 18600002, 'PTG001'),
('SLB003', '2019-01-03', 10500000, 1050000, 9450000, 18600001, 'PTG001'),
('SLB004', '2019-01-03', 8800000, 880000, 7920000, 18600003, 'PTG001'),
('SLB005', '2019-01-03', 11800000, 1180000, 10620000, 18600002, 'PTG001'),
('SLB006', '2019-01-03', 11800000, 1180000, 10620000, 18600002, 'PTG001'),
('SLB007', '2019-01-03', 11800000, 1180000, 10620000, 18600004, 'PTG001'),
('SLB008', '2019-01-04', 11800000, 1180000, 10620000, 18600005, 'PTG001'),
('SLB009', '2019-02-25', 11800000, 1180000, 10620000, 18600004, 'PTG001');

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `kode_golongan` varchar(6) NOT NULL,
  `golongan` varchar(15) NOT NULL,
  `tj_suami_istri` int(20) NOT NULL,
  `tj_anak` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`kode_golongan`, `golongan`, `tj_suami_istri`, `tj_anak`) VALUES
('G001', 'Golongan 1', 500000, 400000),
('G002', 'Golongan 2', 600000, 500000),
('G003', 'Golongan 3', 700000, 600000),
('G004', 'Golongan 4', 800000, 700000);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `kode_jabatan` varchar(6) NOT NULL,
  `nama_jabatan` varchar(30) NOT NULL,
  `gaji_pokok` int(20) NOT NULL,
  `tj_jabatan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`kode_jabatan`, `nama_jabatan`, `gaji_pokok`, `tj_jabatan`) VALUES
('JBT001', 'Project Manager', 8500000, 2000000),
('JBT002', 'Senior Programmer', 6500000, 1500000),
('JBT003', 'Junior Programmer', 3800000, 1500000),
('JBT004', 'HRD', 4500000, 2000000),
('JBT005', 'Staf IT', 3000000, 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` int(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `kode_jabatan` varchar(6) NOT NULL,
  `kode_golongan` varchar(6) NOT NULL,
  `status` varchar(15) NOT NULL,
  `jumlah_anak` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama`, `tempat_lahir`, `tanggal_lahir`, `kode_jabatan`, `kode_golongan`, `status`, `jumlah_anak`) VALUES
(18600001, 'Hiskia Anggi', 'Jepara', '2003-01-09', 'JBT001', 'G001', 'Belum Menikah', 0),
(18600002, 'Lailya Meily Umma', 'Blingoh', '2003-05-17', 'JBT001', 'G001', 'Sudah Menikah', 2),
(18600003, 'Irvan Aldi Pratama', 'Kelet', '2003-02-20', 'JBT002', 'G004', 'Sudah Menikah', 0),
(18600004, 'Aminuddin', 'Kelet', '2019-01-12', 'JBT001', 'G001', 'Sudah Menikah', 2),
(18600005, 'kharis nugroho', 'jepara', '1000-09-10', 'JBT001', 'G003', 'Sudah Menikah', 1);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `kode_petugas` varchar(6) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`kode_petugas`, `username`, `password`, `status`) VALUES
('PTG001', 'Hiskia', '3b69025e5c1d8b3486e6c03f7a3e2241', 'Admin'),
('PTG002', 'Alfian', '6543083a979c3625216da330374ca6d7', 'HRD'),
('PTG003', 'JOKO', 'a2b0dda881b255c91f2f0a3cb32d976f', 'CEO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`no_slip`),
  ADD UNIQUE KEY `no_slip` (`no_slip`),
  ADD KEY `nip` (`nip`),
  ADD KEY `kode_petugas` (`kode_petugas`),
  ADD KEY `gaji_bersih` (`gaji_bersih`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`kode_golongan`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`kode_jabatan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `kode_jabatan` (`kode_jabatan`),
  ADD KEY `kode_golongan` (`kode_golongan`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`kode_petugas`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gaji_ibfk_2` FOREIGN KEY (`kode_petugas`) REFERENCES `petugas` (`kode_petugas`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`kode_jabatan`) REFERENCES `jabatan` (`kode_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`kode_golongan`) REFERENCES `golongan` (`kode_golongan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
