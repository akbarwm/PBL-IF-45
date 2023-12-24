-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2023 at 09:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kelurahan`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_domisili`
--

CREATE TABLE `data_domisili` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nik` int(20) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` varchar(100) DEFAULT NULL,
  `keperluan` varchar(255) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `kelurahan` varchar(50) NOT NULL,
  `status_data` enum('Proses','Ditolak','Selesai','') NOT NULL DEFAULT 'Proses',
  `keterangan` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pengantar` varchar(255) NOT NULL,
  `file_ktp_kk` varchar(255) NOT NULL,
  `nip_pegawai` varchar(255) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `jabatan_pegawai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_kedatangan`
--

CREATE TABLE `data_kedatangan` (
  `id` int(11) NOT NULL,
  `status_data` enum('Diajukan','Proses','Selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Diajukan',
  `NIK` varchar(16) NOT NULL,
  `No_Surat` varchar(16) NOT NULL,
  `Tanggal_Kedatangan` date NOT NULL,
  `Alamat_Asal` varchar(30) NOT NULL,
  `Alamat_Sekarang` varchar(30) NOT NULL,
  `Foto_Surat_Pengantar` varchar(250) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `agama` varchar(150) DEFAULT NULL,
  `pekerjaan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_kependudukan`
--

CREATE TABLE `data_kependudukan` (
  `id` int(11) NOT NULL,
  `NIK` varchar(16) NOT NULL,
  `No_KK` varchar(20) NOT NULL,
  `Nama` varchar(25) NOT NULL,
  `J_Kelamin` varchar(10) NOT NULL,
  `Tempat_Lahir` varchar(20) NOT NULL,
  `Tanggal_Lahir` date NOT NULL,
  `Alamat` text DEFAULT NULL,
  `Agama` varchar(10) NOT NULL,
  `S_Kawin` varchar(100) NOT NULL,
  `Pekerjaan` varchar(15) NOT NULL,
  `Pen_Terakhir` varchar(10) NOT NULL,
  `Kewarganegaraan` varchar(15) NOT NULL,
  `Tgl_Pelaporan` date NOT NULL,
  `Keterangan` text DEFAULT NULL,
  `Foto_KTP` varchar(250) NOT NULL,
  `Foto_KK` varchar(250) NOT NULL,
  `ket_mampu` enum('tidak_mampu','mampu') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_kepindahan`
--

CREATE TABLE `data_kepindahan` (
  `id` int(11) NOT NULL,
  `status_data` enum('Diajukan','Proses','Selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Diajukan',
  `NIK` varchar(16) NOT NULL,
  `No_Surat` varchar(20) NOT NULL,
  `Alamat_Pindah` text NOT NULL,
  `Tanggal_Pindah` date NOT NULL,
  `Foto_Surat_Pengantar` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `nip` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `Alamat` varchar(40) NOT NULL,
  `Tgl_Lahir` date NOT NULL,
  `tgl_masuk` date NOT NULL,
  `Foto_Pegawai` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `data_pegawai`
--

INSERT INTO `data_pegawai` (`nip`, `id`, `nama`, `jabatan`, `jenis_kelamin`, `Alamat`, `Tgl_Lahir`, `tgl_masuk`, `Foto_Pegawai`) VALUES
('19760808 200701 1 026', 4, 'HERYAWAN. S.IP', 'Lurah Mangsang', '', '', '0000-00-00', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `data_penghasilan`
--

CREATE TABLE `data_penghasilan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `nik` int(20) NOT NULL,
  `gaji` int(20) NOT NULL,
  `nama_anak` varchar(255) NOT NULL,
  `tempat_lahir_anak` varchar(255) NOT NULL,
  `tanggal_lahir_anak` date NOT NULL,
  `jurusan_anak` varchar(255) NOT NULL,
  `hubungan_keluarga` varchar(255) NOT NULL,
  `pekerjaan_anak` varchar(255) NOT NULL,
  `pendidikan` varchar(255) NOT NULL,
  `alamat_anak` varchar(255) NOT NULL,
  `tanggungan` varchar(255) NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `status_data` enum('Diajukan','Proses','Selesai','Ditolak') NOT NULL,
  `nip_pegawai` varchar(25) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jabatan_pegawai` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `file_ktp_kk` varchar(255) NOT NULL,
  `pengantar` varchar(255) NOT NULL,
  `slip_gaji` varchar(255) NOT NULL,
  `pernyataan_penghasilan` varchar(255) NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_sempadan`
--

CREATE TABLE `data_sempadan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama_usaha` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `nama_sempadans` varchar(255) NOT NULL,
  `alamat_sempadans` varchar(255) NOT NULL,
  `pekerjaan_sempadans` varchar(255) NOT NULL,
  `nama_sempadanu` varchar(255) NOT NULL,
  `alamat_sempadanu` varchar(255) NOT NULL,
  `pekerjaan_sempadanu` varchar(255) NOT NULL,
  `nama_sempadanb` varchar(255) NOT NULL,
  `alamat_sempadanb` varchar(255) NOT NULL,
  `pekerjaan_sempadanb` varchar(255) NOT NULL,
  `nama_sempadant` varchar(255) NOT NULL,
  `alamat_sempadant` varchar(255) NOT NULL,
  `pekerjaan_sempadant` varchar(255) NOT NULL,
  `status_data` enum('Diajukan','Proses','Selesai') NOT NULL DEFAULT 'Diajukan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_usaha`
--

CREATE TABLE `data_usaha` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nik` int(16) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `memiliki_usaha` varchar(255) NOT NULL,
  `usaha_sejak` varchar(255) NOT NULL,
  `alamat_usaha` varchar(255) NOT NULL,
  `status_data` enum('Diajukan','Proses','Selesai','Ditolak') NOT NULL,
  `nip_pegawai` varchar(30) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jabatan_pegawai` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `pengantar` varchar(255) NOT NULL,
  `file_ktp_kk` varchar(255) NOT NULL,
  `file_foto_usaha` varchar(255) NOT NULL,
  `file_surat_sempadan` varchar(255) NOT NULL,
  `file_surat_pernyataan_usaha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_size` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `hak_akses` enum('admin') DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `hak_akses`, `nama`, `username`, `password`, `pegawai_id`) VALUES
(1, 'admin', '', 'admin', 'admin', NULL),
(7, 'admin', 'Staff Lurah', 'stafflurah', '12345', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_penduduk`
--

CREATE TABLE `login_penduduk` (
  `id` int(11) NOT NULL,
  `nik` varchar(150) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `jenis_kelamin` varchar(25) DEFAULT NULL,
  `whatsapp` varchar(18) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `validasi` int(11) NOT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `kewarganegaraan` text DEFAULT NULL,
  `agama` text DEFAULT NULL,
  `status_perkawinan` varchar(25) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `alamat` varchar(555) NOT NULL,
  `rt` varchar(3) DEFAULT NULL,
  `rw` varchar(3) DEFAULT NULL,
  `kecamatan` varchar(50) NOT NULL DEFAULT 'Sei Beduk',
  `kelurahan` enum('Duriangkang','Mangsang','Piayu','Muka Kuning') NOT NULL,
  `penghasilan` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_penduduk`
--

INSERT INTO `login_penduduk` (`id`, `nik`, `nama`, `jenis_kelamin`, `whatsapp`, `username`, `password`, `validasi`, `tempat_lahir`, `tanggal_lahir`, `kewarganegaraan`, `agama`, `status_perkawinan`, `pekerjaan`, `alamat`, `rt`, `rw`, `kecamatan`, `kelurahan`, `penghasilan`) VALUES
(29, '3305101412020001', 'Akbar Wahyu Maulana', 'Laki-laki', '085802446005', 'akbar', 'akbarwahyu', 1, 'Kebumen', '2002-12-14', 'Indonesia', 'Islam', 'Belum Menikah', 'wirausahawan', 'Puri Agung 3 Blok A2 No.1 Tanjung Piayu, Sei beduk, Kota Batam', '1', '10', 'Lajang', 'Mangsang', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `surat_pengantar_rt`
--

CREATE TABLE `surat_pengantar_rt` (
  `nama` varchar(100) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_data` enum('selesai') NOT NULL,
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_domisili`
--
ALTER TABLE `data_domisili`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_kedatangan`
--
ALTER TABLE `data_kedatangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_kependudukan`
--
ALTER TABLE `data_kependudukan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_kepindahan`
--
ALTER TABLE `data_kepindahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_penghasilan`
--
ALTER TABLE `data_penghasilan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_sempadan`
--
ALTER TABLE `data_sempadan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_usaha`
--
ALTER TABLE `data_usaha`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawan_id` (`pegawai_id`);

--
-- Indexes for table `login_penduduk`
--
ALTER TABLE `login_penduduk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_pengantar_rt`
--
ALTER TABLE `surat_pengantar_rt`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_domisili`
--
ALTER TABLE `data_domisili`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `data_kedatangan`
--
ALTER TABLE `data_kedatangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_kependudukan`
--
ALTER TABLE `data_kependudukan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_kepindahan`
--
ALTER TABLE `data_kepindahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_penghasilan`
--
ALTER TABLE `data_penghasilan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `data_sempadan`
--
ALTER TABLE `data_sempadan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_usaha`
--
ALTER TABLE `data_usaha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login_penduduk`
--
ALTER TABLE `login_penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `surat_pengantar_rt`
--
ALTER TABLE `surat_pengantar_rt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `data_pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
