-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2022 at 10:25 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perusnia`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id_about` int(2) NOT NULL,
  `foto_about` varchar(50) NOT NULL,
  `isi_about` varchar(900) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id_about`, `foto_about`, `isi_about`) VALUES
(1, 'galeri1.jpeg', 'Museum perusnia adalah sebuah tempat wisata uang kuno yang berlokasi di bangkalan, yang di dirikan 2 januari 2021 oleh seorang pemuda yang berumur 21 tahun. Tidak hanya memamerkan koleksi uang kunonya, dia juga menulis beberapa buku sejarah tentang uang kuno seluruh dunia. Tujuan Salman Alrosyid menulis sebuah buku mengenai sejarah uang koin Indonesia agar masyarakat dan pegiat kolektor uang mudah memahami sejarah penggunaan mata uang koin Indonesia, selain menunjang kegiatan numismatic, buku ini menjadi pengembagan pengetahuan mengenai sejarah penggunaan uang koin di Indonesia dahulu.');

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

CREATE TABLE `api` (
  `id_api` int(11) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`id_api`, `api_key`, `description`) VALUES
(1, '5f63eabd38c3d4032b45eebf7455d1b0', 'api for mobile app\r\n'),
(2, '3f2659b206a208dcc2bcc7ff12d8e54c', 'api for developer');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id_book` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `kode_buku` varchar(25) NOT NULL,
  `publication_date` date NOT NULL,
  `id_users` int(11) NOT NULL,
  `author` varchar(25) NOT NULL,
  `cover` varchar(25) NOT NULL,
  `file_buku` varchar(255) NOT NULL,
  `halaman` varchar(255) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id_book`, `judul`, `description`, `kode_buku`, `publication_date`, `id_users`, `author`, `cover`, `file_buku`, `halaman`, `harga`, `payment_id`, `created_at`, `updated_at`) VALUES
(5, 'JURNAL IMPLEMENTASI PROSES KOMUNIKASI WIRELESS BER', '<p><strong>jurnal </strong>tentang pengambangan <strong>perangkat luna</strong>k IMPLEMENTASI PROSES KOMUNIKASI WIRELESS BERBASIS <strong><em>DEKSTOP</em></strong><em> </em>UNTUK MENDUKUNG PROSES PEMBELAJARAN</p>', 'PKEY:E29D7C63', '2022-11-11', 2, 'ach fasihul lisan', '636e533a48ef7.png', '636e533a48f00.pdf', '0', 250000, 0, '2022-11-11 13:50:50', '2022-11-11 20:50:50'),
(6, 'Challenges and Opportunities in Intelligent System', '<p>Challenges and Opportunities in Intelligent System Development Using <em>Fuzzy </em>Inference System for <em>Underwater Communication</em></p>', 'PKEY:638BBED6', '2022-12-31', 2, 'ach fasihul lisan', '636e53e13b3eb.png', '636e53e13b3f1.pdf', '0', 250000, 0, '2022-11-11 13:53:37', '2022-11-11 20:53:37'),
(7, 'Analisis Kinerja VHF-A/G Tower/ADC dengan VHF-A/G ', '<p>Analisis Kinerja VHF-A/G Tower/ADC dengan VHF-A/G APP di Bandar Udara Husein Sastranegara Bandung</p>', 'PKEY:E067AD41', '2022-11-30', 2, 'ach fasihul lisan', '636e54b98adb0.png', '636e54b98adb5.pdf', '0', 50000, 0, '2022-11-11 13:57:13', '2022-12-03 15:27:29'),
(8, 'buku ilahi', '<p>buku ilahi</p>', 'PKEY:5C049CD8', '2022-11-11', 2, 'lisan', '636e5db7ed372.png', '636e5db7ed375.pdf', '0', 0, 0, '2022-11-11 14:35:35', '2022-11-11 21:35:35'),
(9, 'buku fasih', '<p>ini bukunya <strong>fasih</strong></p>', 'PKEY:BF08FA94', '2022-11-13', 2, 'ach fasihul lisan', '63707abe5de86.jpg', '63707abe5e093.pdf', '0', 50000, 0, '2022-11-13 05:03:58', '2022-11-13 12:03:58'),
(10, 'perkembangan uang dalam sejarah dunia', '<p>buku sejarah tentang perkembanga uang dalam sejarah dunia, yang di tulis oleh <strong>salman alrosyid</strong> selaku pemilik museum perusnia bangkalan.</p>', 'PKEY:F5D3FEC0', '2022-12-05', 2, 'Salman Alrosyid', '638e138592324.jpg', '638e138592329.pdf', '0', 60000, 0, '2022-12-05 15:51:33', '2022-12-05 22:51:33'),
(15, 'sadas', '<p>asdasdas</p>', 'PKEY:1DFC4F02', '2022-12-16', 2, 'asdasdas', '639c85fc5f7ba.png', '639c863a3ca23.pdf', '20', 45000, 0, '2022-12-16 14:51:40', '2022-12-16 21:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `id_cart_item` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(2) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `hari_buka` varchar(50) NOT NULL,
  `jam_buka` time NOT NULL,
  `jam_tutup` time NOT NULL,
  `kordinat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id_contact`, `alamat`, `telepon`, `hari_buka`, `jam_buka`, `jam_tutup`, `kordinat`) VALUES
(1, 'Jl. KH. Moh. Kholil Gg. IX No.36, RW.1, Demangan Timur, Kec. Bangkalan,Madura, Jawa Timur 69115', '+62 896-1232-0914', 'Buka Setiap Hari', '09:00:00', '15:00:00', 'https://www.google.com/maps/embed/v1/place?key=AIzaSyCt1265A4qvZy9HKUeA8J15AOC4SrCyZe4&q=Jl. KH. Moh. Kholil Gg. IX No.36, RW.1, Demangan Timur, Kec. Bangkalan, Madura, Jawa Timur 69115');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaction`
--

CREATE TABLE `detail_transaction` (
  `id_detail_transaction` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `favorit`
--

CREATE TABLE `favorit` (
  `id_favorit` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `foto` varchar(30) NOT NULL,
  `deskripsi` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `foto`, `deskripsi`) VALUES
(0, '63aff809e3102.jpeg', 'logo gambar'),
(2, 'galeri3.JPG', 'Tampilan depan dari Museum Perusnia.'),
(3, 'galeri5.JPG', 'Tampilan depan dari Museum Perusnia.'),
(4, 'galeri6.JPG', 'Tampilan dalam dari Museum Perusnia.');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'full access', '2022-11-05 01:51:25', '2022-11-05 01:51:25'),
(2, 'users', 'shell/buy book and read a book', '2022-11-05 01:51:25', '2022-11-05 01:51:25');

-- --------------------------------------------------------

--
-- Table structure for table `log_user_read`
--

CREATE TABLE `log_user_read` (
  `id_log_user_read` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mybook`
--

CREATE TABLE `mybook` (
  `id_mybook` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id_notes` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `isi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_amount`
--

CREATE TABLE `payment_amount` (
  `id_payment_amount` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `paid_at` varchar(255) NOT NULL,
  `id_transaction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rate_book`
--

CREATE TABLE `rate_book` (
  `id_rate_book` int(11) NOT NULL,
  `rate_score` float NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `id_book` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id_transaction` int(11) NOT NULL,
  `transaction_time` varchar(255) DEFAULT NULL,
  `transaction_status` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `status_code` varchar(255) DEFAULT NULL,
  `signature_key` varchar(255) DEFAULT NULL,
  `settlement_time` varchar(255) NOT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `merchant_id` varchar(255) DEFAULT NULL,
  `gross_amount` varchar(255) DEFAULT NULL,
  `fraud_status` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `biller_code` varchar(255) NOT NULL,
  `bill_key` varchar(255) NOT NULL,
  `approval_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_depan` varchar(255) DEFAULT NULL,
  `nama_belakang` varchar(255) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `negara` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `id_level` int(15) NOT NULL DEFAULT 2,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_at` datetime(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `foto`, `username`, `email`, `password`, `nama_depan`, `nama_belakang`, `tgl_lahir`, `jenis_kelamin`, `no_telp`, `alamat`, `negara`, `kota`, `id_level`, `created_at`, `updated_at`) VALUES
(1, NULL, 'admin', 'admin@admin.com', '$2y$10$PefRUlSMS/kIp5YLeNtfM.LwlrrmS1Tt.Vf.QLbWAgpO4q/5bI.PC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0000-00-00 00:00:00.000000', '2022-11-19 09:24:53.848456'),
(2, '639d1f0e79792.png', 'fasih50', 'fasihullisan091966@gmail.com', '$2y$10$pR1SMH1QI9BU2DQdtLWqje93OWP3TMJ5UDztsd4AC44t7TE.jx23e', 'achmad fasihul', 'lisan', '2002-06-09', 'laki-laki', '085336076077', 'jl kh moch kholil gg 3e', 'indonesia', 'pasuruan', 2, '0000-00-00 00:00:00.000000', '2022-12-17 08:49:59.124610'),
(22, '63892938642d1.png', 'herlambang50', 'herlambang@gmail.com', '$2y$10$hKVy/12b5AsV5jWfEuDb7Oi0RS9L.YttcwIMbqvvepzhb9ekIVeNC', 'herlambang', 'satria', '0000-00-00', 'laki-laki', '', '', 'indonesia', 'pasuruan', 2, '2022-11-26 10:41:25.557683', '2022-12-02 05:22:48.411131'),
(32, '6389280213b3d.png', 'nicola50', 'nicola@gmail.com', '$2y$10$7dw6LFx/jjmz0bS6UWm5YOAmYZhdbECI4jC0AcqgC6wEdhrhI.rXy', 'nicola', 'joid stiawan', '2022-12-02', 'laki-laki', '085336076077', 'jl kh moch kholil', 'indonesia', 'mojokerto', 2, '2022-11-30 20:41:13.025102', '2022-12-02 05:17:38.085094'),
(33, NULL, 'Owen50', 'owenpratama@gmail.com', '$2y$10$xHXLGxnojf1GO1V6hiI06uRwaVMvbTG/1i2YzFHJHRc5DK6IHc3DO', 'owen', 'pratama', NULL, 'laki-laki', NULL, NULL, 'indonesia', 'trenggalek', 2, '2022-12-07 06:14:41.401991', '2022-12-07 06:14:41.401991');

-- --------------------------------------------------------

--
-- Table structure for table `va_numbers`
--

CREATE TABLE `va_numbers` (
  `id_va_numbers` int(11) NOT NULL,
  `id_transaction` int(11) NOT NULL,
  `va_number` varchar(255) DEFAULT NULL,
  `bank` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id_about`);

--
-- Indexes for table `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`id_api`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id_book`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`id_cart_item`),
  ADD UNIQUE KEY `tidka boleh mengerajangi buku yang sama` (`id_users`,`id_book`),
  ADD KEY `id_book` (`id_book`);

--
-- Indexes for table `detail_transaction`
--
ALTER TABLE `detail_transaction`
  ADD PRIMARY KEY (`id_detail_transaction`),
  ADD KEY `id_book` (`id_book`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `detail_transaction_ibfk_3` (`transaction_id`);

--
-- Indexes for table `favorit`
--
ALTER TABLE `favorit`
  ADD PRIMARY KEY (`id_favorit`),
  ADD KEY `id_book` (`id_book`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `log_user_read`
--
ALTER TABLE `log_user_read`
  ADD PRIMARY KEY (`id_log_user_read`),
  ADD KEY `id_book` (`id_book`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `mybook`
--
ALTER TABLE `mybook`
  ADD PRIMARY KEY (`id_mybook`),
  ADD KEY `id_book` (`id_book`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id_notes`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `payment_amount`
--
ALTER TABLE `payment_amount`
  ADD PRIMARY KEY (`id_payment_amount`),
  ADD KEY `id_transaction` (`id_transaction`);

--
-- Indexes for table `rate_book`
--
ALTER TABLE `rate_book`
  ADD PRIMARY KEY (`id_rate_book`),
  ADD UNIQUE KEY `id_users` (`id_users`,`id_book`) USING BTREE,
  ADD UNIQUE KEY `id_book` (`id_book`,`id_users`) USING BTREE;

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_transaction`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `username` (`username`,`email`),
  ADD KEY `level_relation` (`id_level`);

--
-- Indexes for table `va_numbers`
--
ALTER TABLE `va_numbers`
  ADD PRIMARY KEY (`id_va_numbers`),
  ADD KEY `va_numbers_ibfk_1` (`id_transaction`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id_about` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `id_api` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `id_cart_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_transaction`
--
ALTER TABLE `detail_transaction`
  MODIFY `id_detail_transaction` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorit`
--
ALTER TABLE `favorit`
  MODIFY `id_favorit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_user_read`
--
ALTER TABLE `log_user_read`
  MODIFY `id_log_user_read` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mybook`
--
ALTER TABLE `mybook`
  MODIFY `id_mybook` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id_notes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_amount`
--
ALTER TABLE `payment_amount`
  MODIFY `id_payment_amount` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rate_book`
--
ALTER TABLE `rate_book`
  MODIFY `id_rate_book` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `va_numbers`
--
ALTER TABLE `va_numbers`
  MODIFY `id_va_numbers` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`),
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);

--
-- Constraints for table `detail_transaction`
--
ALTER TABLE `detail_transaction`
  ADD CONSTRAINT `detail_transaction_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`),
  ADD CONSTRAINT `detail_transaction_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);

--
-- Constraints for table `favorit`
--
ALTER TABLE `favorit`
  ADD CONSTRAINT `favorit_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`),
  ADD CONSTRAINT `favorit_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);

--
-- Constraints for table `log_user_read`
--
ALTER TABLE `log_user_read`
  ADD CONSTRAINT `log_user_read_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`),
  ADD CONSTRAINT `log_user_read_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);

--
-- Constraints for table `mybook`
--
ALTER TABLE `mybook`
  ADD CONSTRAINT `mybook_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`),
  ADD CONSTRAINT `mybook_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);

--
-- Constraints for table `payment_amount`
--
ALTER TABLE `payment_amount`
  ADD CONSTRAINT `payment_amount_ibfk_1` FOREIGN KEY (`id_transaction`) REFERENCES `transaction` (`id_transaction`);

--
-- Constraints for table `rate_book`
--
ALTER TABLE `rate_book`
  ADD CONSTRAINT `rate_book_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`),
  ADD CONSTRAINT `rate_book_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `level_relation` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`);

--
-- Constraints for table `va_numbers`
--
ALTER TABLE `va_numbers`
  ADD CONSTRAINT `va_numbers_ibfk_1` FOREIGN KEY (`id_transaction`) REFERENCES `transaction` (`id_transaction`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
