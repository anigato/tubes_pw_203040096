-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2021 at 04:49 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pw_tubes_203040096`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `additional` text NOT NULL,
  `rt` int(11) NOT NULL,
  `rw` int(11) NOT NULL,
  `dusun` varchar(50) NOT NULL,
  `desa` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kabupaten` varchar(50) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kode_pos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `id_user`, `additional`, `rt`, `rw`, `dusun`, `desa`, `kecamatan`, `kabupaten`, `provinsi`, `kode_pos`) VALUES
(6, 34, '', 0, 0, '', '', '', '', '', 0),
(7, 35, 'UA Academy', 3, 2, 'Ichitayama', 'Sentai', 'Miyagi', 'Kansai', 'Tokyo', 46384),
(8, 36, '', 0, 0, '', '', '', '', '', 0),
(9, 37, '', 0, 0, '', '', '', '', '', 0),
(10, 38, 'jln irigasi', 33, 8, 'sukajadi', 'sukanagara', 'Padaherang', 'Pangandaran', 'jawa barat', 46384);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `img`) VALUES
(2, 'samsung', 'sam934072.png'),
(4, 'apacer', 'apa322567.png'),
(5, 'xpg', 'xpg749197.png'),
(6, 'sandisk', 'san499231.png'),
(7, 'western digital', 'wes861156.png'),
(8, 'kingmax', 'kin751124.png'),
(9, 'pioneer', 'pio762139.png'),
(10, 'v-gen', 'v-g486161.png'),
(11, 'adata', 'ada752461.png'),
(12, 'hitachi', 'hit395274.png'),
(13, 'seagate', 'sea516054.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `kode_pemesanan` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `order_time` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `payment` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `kode_pemesanan`, `id_user`, `order_time`, `status`, `total_qty`, `total_price`, `payment`) VALUES
(44, 'INVN6D51B24052021', 35, '2021-05-23 06:18:31', 4, 2, 920812, 'bri'),
(45, 'INV90KXUG24052021', 35, '2021-05-22 06:19:10', 1, 1, 1300892, 'dana'),
(46, 'INV23N74X24052021', 35, '2021-05-24 06:21:30', 4, 4, 2620495, 'ovo'),
(47, 'INVDZVA2J24052021', 35, '2021-05-24 16:46:38', 4, 2, 2350397, 'ovo'),
(48, 'INVM38UGR25052021', 35, '2021-05-25 05:27:25', 5, 1, 350309, 'linkaja'),
(49, 'INV7C8UYN25052021', 35, '2021-05-25 14:10:01', 6, 11, 7130215, ''),
(50, 'INVAM0GKY26052021', 35, '2021-05-26 07:06:19', 3, 0, 983, ''),
(51, 'INV7MJSCG26052021', 35, '2021-05-26 07:07:45', 6, 5, 1750913, ''),
(52, 'INV3ON81I26052021', 35, '2021-05-26 07:09:09', 3, 4, 1480847, ''),
(53, 'INVTN0EKD26052021', 35, '2021-05-26 18:14:57', 0, 1, 2100386, 'linkaja'),
(54, 'INVP9JHIB26052021', 35, '2021-05-26 18:15:49', 0, 15, 31500573, 'bri'),
(55, 'INVKODS8W27052021', 37, '2021-05-27 03:19:22', 6, 20, 5000109, ''),
(56, 'INVQ46J5M27052021', 35, '2021-05-27 03:20:14', 0, 20, 5000693, 'ovo'),
(57, 'INV73BAMZ27052021', 38, '2021-05-27 13:38:44', 6, 1, 1400706, ''),
(58, 'INVEMIJDH27052021', 38, '2021-05-27 13:39:46', 3, 1, 1400517, ''),
(61, 'INVGNPXBI27052021', 38, '2021-05-27 13:50:53', 3, 4, 4550169, ''),
(62, 'INVT8EYFK27052021', 38, '2021-05-27 14:06:02', 3, 1, 1400647, '');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `id_product`, `id_order`, `qty`, `subtotal_price`) VALUES
(57, 54, 44, 2, 920000),
(58, 55, 45, 1, 1300000),
(59, 53, 46, 1, 450000),
(60, 56, 46, 2, 1800000),
(61, 52, 46, 1, 370000),
(62, 51, 47, 1, 2100000),
(63, 50, 47, 1, 250000),
(64, 57, 48, 1, 350000),
(65, 56, 49, 2, 1800000),
(66, 52, 49, 1, 370000),
(67, 50, 49, 2, 500000),
(68, 46, 49, 1, 350000),
(69, 54, 49, 1, 460000),
(70, 53, 49, 1, 450000),
(71, 57, 49, 1, 350000),
(72, 49, 49, 1, 2300000),
(73, 47, 49, 1, 550000),
(74, 46, 51, 5, 1750000),
(75, 52, 52, 4, 1480000),
(76, 51, 53, 1, 2100000),
(77, 51, 54, 15, 31500000),
(78, 50, 55, 20, 5000000),
(79, 50, 56, 20, 5000000),
(80, 58, 57, 1, 1400000),
(81, 58, 58, 1, 1400000),
(82, 58, 61, 3, 4200000),
(83, 46, 61, 1, 350000),
(84, 58, 62, 1, 1400000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `sku` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `stok` int(3) NOT NULL,
  `capacity` int(4) NOT NULL,
  `price` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  `date_add` date DEFAULT NULL,
  `date_modified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `category`, `id_brand`, `stok`, `capacity`, `price`, `weight`, `img`, `description`, `date_add`, `date_modified`) VALUES
(46, '6-120-SSD-350000', 'Sandisk SSD Plus 240GB Sata 3 - Sandisk SSD 120 GB', 'SSD', 6, 19, 120, 350000, 200, 'San238611.png', '&lt;div&gt;Garansi Resmi 3 Tahun&lt;br&gt;&lt;br&gt;Fitur:&lt;br&gt;- perpanjang daya laptop atau PC desktop anda&lt;br&gt;- melakukan boot-up, shutdown,dan respon aplikasi dengan lebih cepat&lt;br&gt;- desain padat yang tahan lama&lt;br&gt;- cocok untuk beban kerja PC biasanya&lt;br&gt;- kemudahan pemasangan&lt;br&gt;- drive yang lebih efisien (jadi baterai laptop Anda bisa bertahan lama hanya dengan sekali pengisian.)&lt;br&gt;&lt;br&gt;Spesifikasi:&lt;br&gt;Kecepatan Baca: hingga 530 MB/s**&lt;br&gt;Kecepatan Tulis: hingga 310 MB/s**&lt;br&gt;Antarmuka: SATA Revision 3.0 (6 Gb/s)&lt;/div&gt;', '2021-05-16', '2021-05-16'),
(47, '6-240-SSD-550000', 'Sandisk SSD Plus 240GB Sata 3 - Sandisk SSD 240 GB', 'SSD', 6, 33, 240, 550000, 200, 'San286837.png', '&lt;div&gt;Garansi Resmi 3 Tahun&lt;br&gt;&lt;br&gt;Fitur:&lt;br&gt;- perpanjang daya laptop atau PC desktop anda&lt;br&gt;- melakukan boot-up, shutdown,dan respon aplikasi dengan lebih cepat&lt;br&gt;- desain padat yang tahan lama&lt;br&gt;- cocok untuk beban kerja PC biasanya&lt;br&gt;- kemudahan pemasangan&lt;br&gt;- drive yang lebih efisien (jadi baterai laptop Anda bisa bertahan lama hanya dengan sekali pengisian.)&lt;br&gt;&lt;br&gt;Spesifikasi:&lt;br&gt;Kecepatan Baca: hingga 530 MB/s**&lt;br&gt;Kecepatan Tulis: hingga 310 MB/s**&lt;br&gt;Antarmuka: SATA Revision 3.0 (6 Gb/s)&lt;/div&gt;', '2021-05-16', '0000-00-00'),
(48, '6-480-SSD-900000', 'Sandisk SSD Plus 240GB Sata 3 - Sandisk SSD 480 GB', 'SSD', 6, 20, 480, 900000, 300, 'San122699.png', '&lt;div&gt;Garansi Resmi 3 Tahun&lt;br&gt;&lt;br&gt;Fitur:&lt;br&gt;- perpanjang daya laptop atau PC desktop anda&lt;br&gt;- melakukan boot-up, shutdown,dan respon aplikasi dengan lebih cepat&lt;br&gt;- desain padat yang tahan lama&lt;br&gt;- cocok untuk beban kerja PC biasanya&lt;br&gt;- kemudahan pemasangan&lt;br&gt;- drive yang lebih efisien (jadi baterai laptop Anda bisa bertahan lama hanya dengan sekali pengisian.)&lt;br&gt;&lt;br&gt;Spesifikasi:&lt;br&gt;Kecepatan Baca: hingga 530 MB/s**&lt;br&gt;Kecepatan Tulis: hingga 310 MB/s**&lt;br&gt;Antarmuka: SATA Revision 3.0 (6 Gb/s)&lt;/div&gt;', '2021-05-16', '0000-00-00'),
(49, '6-1-SSD-2300000', 'Sandisk SSD Plus 240GB Sata 3 - Sandisk SSD 1 TB 2', 'SSD', 6, 23, 1, 2300000, 300, 'San382820.png', '&lt;div&gt;Garansi Resmi 3 Tahun&lt;br&gt;&lt;br&gt;Fitur:&lt;br&gt;- perpanjang daya laptop atau PC desktop anda&lt;br&gt;- melakukan boot-up, shutdown,dan respon aplikasi dengan lebih cepat&lt;br&gt;- desain padat yang tahan lama&lt;br&gt;- cocok untuk beban kerja PC biasanya&lt;br&gt;- kemudahan pemasangan&lt;br&gt;- drive yang lebih efisien (jadi baterai laptop Anda bisa bertahan lama hanya dengan sekali pengisian.)&lt;br&gt;&lt;br&gt;Spesifikasi:&lt;br&gt;Kecepatan Baca: hingga 530 MB/s**&lt;br&gt;Kecepatan Tulis: hingga 310 MB/s**&lt;br&gt;Antarmuka: SATA Revision 3.0 (6 Gb/s)&lt;/div&gt;', '2021-05-16', '0000-00-00'),
(50, '11-120-SSD-250000', 'Adata SSD SU650 Ultimate 120GB Sata 3', 'SSD', 11, 1, 120, 250000, 250, 'Ada654263.png', '&lt;div&gt;Garansi Resmi 3 Tahun&lt;br&gt;&lt;br&gt;Features:&lt;br&gt;-Shockproof, Anti-vibration, Low Noise&lt;br&gt;-Advanced error correction code&lt;br&gt;-3D NAND flash technology&lt;br&gt;-Proprietary software - SSD Toolbox and Migration Utility&lt;br&gt;&lt;br&gt;Technical Specifications:&lt;br&gt;-Form Factor 2.5&quot;&lt;br&gt;-NAND Flash 3D NAND&lt;br&gt;-Dimensions (L x W x H) 100.45 x 69.85 x 7mm&lt;br&gt;-Interface SATA 6Gb/s&lt;br&gt;-Sequential R/W performance (max) Up to 520 / 450MB/s&lt;br&gt;*Actual performance may vary due to available SSD capacity, system hardware and software components, and other factors&lt;br&gt;-Operating temperature 0°C - 70°C&lt;br&gt;-Storage temperature -40°C - 85°C&lt;br&gt;-Shock resistance 1500G / 0.5ms&lt;br&gt;-MTBF 2,000,000 hours&lt;/div&gt;', '2021-05-16', '0000-00-00'),
(51, '5-1-SSD NVME-2100000', 'ADATA SSD XPG SX8200 PRO M.2 Pcie Gen3 Nvme 1TB', 'SSD NVME', 5, 4, 1, 2100000, 200, 'ADA504595.png', '&lt;div&gt;Garansi Resmi 5 Tahun&lt;br&gt;&lt;br&gt;Form factor: M.2 2280&lt;br&gt;&lt;br&gt;SX8200 M.2 2280 merupakan tipe SSD internal dari ADATA yang menggunakan interface PCIe Gen3x4 yang sangat cepat, dan memiliki kecepatan Read / Write yang sangat tinggi hingga 3500 / 3000 MB per detik. Serta dengan teknologi 3D NAND Flash yang memberikan kinerja lebih tinggi, ketahanan dan efisiensi daya yang tinggi.&lt;br&gt;SSD Pci express ini sangat cocok buat Gamers, PC overclok, atau membuat Video dan kebutuhan aplikasi tinggi.&lt;br&gt;&lt;br&gt;SX8200 Pro memenuhi persyaratan NVMe 1.2 dan NVMe 1.3 Support dan menghadirkan kemampuan baca / tulis superior random dan kemampuan multi-tasking. Sangat rekomendasi buat Intel dan AMD yang terbaru.&lt;br&gt;&lt;br&gt;Spesifikasi :&lt;br&gt;Tipe : SX8200 SSD M.2 Pcie Gen3x4 1 TB&lt;br&gt;Kapasitas : 1 TB&lt;br&gt;Form Factor : M.2 2280&lt;br&gt;NAND Flash : 3D TLC&lt;br&gt;Controller : SMI&lt;br&gt;Interface : PCIe Gen3x4&lt;br&gt;Performace : Baca 3500MB/s ; Tulis 3000MB/s&lt;br&gt;MTBF : 2.000.000 Jam&lt;/div&gt;', '2021-05-16', '0000-00-00'),
(52, '4-128-SSD-370000', 'SSD Apacer Panther AS350 128GB Sata 3', 'SSD', 4, 7, 128, 370000, 300, 'SSD145469.png', '&lt;div&gt;Garansi Resmi 3 Tahun&lt;br&gt;&lt;br&gt;Capacity : 128GB&lt;br&gt;Interface : SATA III 6Gb/s&lt;br&gt;NAND Flash : 3D TLC&lt;br&gt;Sustained Read Performance&lt;br&gt;128GB: Up to 560MB/s&lt;br&gt;&lt;br&gt;Sustained Write Performance&lt;br&gt;128GB: Up to 540MB/s&lt;br&gt;&lt;br&gt;IOPs (4K Random Write) : Up to 30,176IOPs&lt;br&gt;ECC Support : Up to 72bit/1KB&lt;br&gt;Shock : 1,500G/0.5msec&lt;br&gt;Vibration : 5~2000Hz/20G&lt;br&gt;Low Power Consumption (Active/Idle)&lt;br&gt;275/80mA&lt;br&gt;&lt;br&gt;MTBF : 1,500,000 hours&lt;br&gt;Humidity : 5% ~95%&lt;br&gt;Standard Operating Temperature : 0C ~ +70C&lt;br&gt;Storage Temperature : -40C ~ +85C&lt;br&gt;Dimensions : (L)100 x (W)69.9 x (H)7 mm&lt;br&gt;Weight : 60g&lt;br&gt;Certificate : KCC, CE, FCC, VCCI, RCM, BSMI&lt;/div&gt;', '2021-05-16', '0000-00-00'),
(53, '8-240-SSD-450000', 'Kingmax SSD SMV32 240GB Sata 3', 'SSD', 8, 45, 240, 450000, 200, 'Kin791275.png', '&lt;div&gt;Garansi Resmi WPG 3 Tahun&lt;br&gt;&lt;br&gt;*High speed 3D NAND synchronous flash&lt;br&gt;*High speed transmission and Fast boots up&lt;br&gt;*Great performance and reliability&lt;br&gt;*Support SLC Caching to enhance read/write performance&lt;br&gt;*ECC technology to prevent data error and guarantee reliability&lt;br&gt;*Powerful wear leveling algorithm to enhance lifetime&lt;br&gt;*Support TRIM command and Garbage *Collection technology&lt;br&gt;*NCQ and RAID ready&lt;br&gt;*S.M.A.R.T.monitoring system&lt;br&gt;&lt;br&gt;Model Name SMV 32&lt;br&gt;Interface SATA III 6Gb/s&lt;br&gt;Capacity 120GB240GB480GB960GB&lt;br&gt;Dimension 100.5mm x 69.9mm x 7.0mm&lt;br&gt;&lt;br&gt;Sequential Read (Up to)&lt;br&gt;240GB 500 MB/s&lt;br&gt;&lt;br&gt;Sequential Write (Up to)&lt;br&gt;240GB 410 MB/s&lt;br&gt;&lt;br&gt;Operation Temperature 0~70 C&lt;br&gt;Voltage DC 5V +/- 5%&lt;br&gt;Shock 1500G /0.5ms&lt;br&gt;MTBF 1.5 million hours&lt;br&gt;Power Consumption (Active) 2.5W (Max.)&lt;br&gt;Power Consumption (Idle) 0.5W (Max.)&lt;/div&gt;', '2021-05-16', '0000-00-00'),
(54, '9-240-SSD-460000', 'Pioneer SSD 240GB Sata 3', 'SSD', 9, 12, 240, 460000, 200, 'Pio882156.png', '&lt;div&gt;Garansi Resmi 3 Tahun&lt;br&gt;&lt;br&gt;SSD(Solid State Disk) adalah alat penyimpanan yang populer. Dibnadingkan dengan harddisk, SSD memiliki beberapa keuntungan:&lt;br&gt;1.Performa tinggi&lt;br&gt;2.Anti-shock, anti-getar, awet di lingkungan keras&lt;br&gt;3.Tanpa komponen yang dapat bergerak, SSD tahan lama&lt;br&gt;4.Hemat energi dan tidak bising&lt;br&gt;&lt;br&gt;Pioneer APS-SL2 memberikan pengalaman berkomputer yang hebat:&lt;br&gt;Sequential Read up to 500 MB/s&lt;br&gt;Sequential Write up to 410 MB/s&lt;br&gt;Random 4KB Read up to 25600 IOPS&lt;br&gt;Random 4KB Write up to 32000 IOPS&lt;/div&gt;', '2021-05-16', '0000-00-00'),
(55, '2-256-SSD-1300000', 'Samsung SSD 860 PRO 256GB Sata 3', 'SSD', 2, 20, 256, 1300000, 300, 'Sam519784.png', '&lt;div&gt;Garansi Resmi 5 Tahun&lt;br&gt;&lt;br&gt;The SSD to Trust&lt;br&gt;Perpaduan chip V-NAND generasi terbaru dengan controller IC yang lebih effisien membuat Samsung 860 Pro dapat bekerja dengan lebih effisien tanpa mengorbankan peformanya. Anda bisa menggunakan SSD ini untuk berbagai keperluan mulai dari NAS hingga gaming sekalipun.&lt;br&gt;&lt;br&gt;Enhance Peformance&lt;br&gt;Tidak hanya tingkat efisiensi yang tinggi, Samsung 860 Pro menawarkan kecepatan read dan write yang tinggi bahkan untuk workload yang tinggi sekalipun. Dengan kecepatan read 560MB/s dan write 530MB/s, Samsung 860 Pro memberikan peforma yang dibutuhkan oleh kalangan profesional.&lt;br&gt;&lt;br&gt;Fierce Endurance&lt;br&gt;Selain peforma yang tinggi, Samsung 860 Pro dilengkapi dengan daya tahan tinggi sehingga bisa digunakan untuk waktu lama. Dengan jumlah Terrabyte Written(TBW) hingga 4800TB.&lt;br&gt;&lt;br&gt;Smart Compatibility&lt;br&gt;Penggunaan controller MJX yang dipadukan dengan algoritma Error Correction Code(ECC) membuat SSD ini memiliki tingkat kompatibilitas yang sangat tinggi.&lt;/div&gt;', '2021-05-16', '0000-00-00'),
(56, '10-512-SSD-900000', 'SSD V-Gen 512GB', 'SSD', 10, 12, 512, 900000, 300, 'SSD197608.png', '&lt;div&gt;Garansi Resmi 3 Tahun&lt;br&gt;&lt;br&gt;Tidak perlu mahal untuk memiliki ssd, vgen menawarkan ssd dengan kapasitas 120-480 gb, pastinya dengan harga yang sangat terjangkau tapi dengan kualitas prima dan dengan garansi vgen yang terjamin.&lt;br&gt;&lt;br&gt;Type : Storage&lt;br&gt;Size : 100 x 70 x 6 mm:&lt;br&gt;Status : Regular&lt;br&gt;Kapasitas : 512 GB&lt;br&gt;Volume : +/- 20 gr&lt;br&gt;Transfer Rate : 6 GB/s&lt;br&gt;Read 530mb/s&lt;br&gt;write 450mb/s&lt;br&gt;Shack Resistant&lt;br&gt;Low Power Consumption&lt;/div&gt;', '2021-05-16', '0000-00-00'),
(57, '10-128-SSD NVME-350000', 'SSD V-Gen Turbo V-Nand M.2 2280 128GB', 'SSD NVME', 10, 12, 128, 350000, 200, 'SSD395105.png', '&lt;div&gt;Garansi Resmi 3 Tahun&lt;br&gt;&lt;br&gt;SSD M.2 V-Gen TURBO merupakan sebuah perangkat solid state drive (SSD) yang dirancang secara khusus untuk dapat meningkatkan performa dari laptop dan PC kesayangan Anda.&lt;br&gt;&lt;br&gt;Berkat adanya teknologi V-NAND terbaru, SSD ini dapat menyajikan performa transfer file yang cepat dan konsisten bahkan ketika Anda berikan beban kerja yang berat dan multitasking sekalipun. Hal tersebut menjadikan SSD ini dapat bekerja dengan kecepatan baca sekuensial yang mencapai 550 MB/s dan didukung pula dengan teknologi Intelligent TurboWrite, serta kecepatan tulis sekuensial yang mencapai 520 MB/s.&lt;br&gt;&lt;br&gt;Teknologi TurboWrite SSD M.2 V-Gen TURBO memaksimalkan kecepatan. Kecepatan Sequential mencapai 550 MBps untuk Read dan 520 MBps untuk Write.&lt;br&gt;&lt;br&gt;Kapasitas 128GB&lt;br&gt;Antarmuka / Interface M2 SATA&lt;br&gt;Kecepatan Baca 550 MB/s&lt;br&gt;Kecepatan Tulis 520 MB/s&lt;/div&gt;', '2021-05-16', '0000-00-00'),
(58, '5-512-SSD NVME-1400000', 'ADATA SSD XPG SX8200 PRO M.2 PCIE GEN3 NVME 512GB', 'SSD NVME', 5, 15, 512, 1400000, 300, 'ADA663282.png', '&lt;div&gt;Garansi Resmi 5 Tahun&lt;br&gt;&lt;br&gt;Form factor: M.2 2280&lt;br&gt;&lt;br&gt;SX8200 M.2 2280 merupakan tipe SSD internal dari ADATA yang menggunakan interface PCIe Gen3x4 yang sangat cepat, dan memiliki kecepatan Read / Write yang sangat tinggi hingga 3500 / 3000 MB per detik. Serta dengan teknologi 3D NAND Flash yang memberikan kinerja lebih tinggi, ketahanan dan efisiensi daya yang tinggi.&lt;br&gt;SSD Pci express ini sangat cocok buat Gamers, PC overclok, atau membuat Video dan kebutuhan aplikasi tinggi.&lt;br&gt;&lt;br&gt;SX8200 Pro memenuhi persyaratan NVMe 1.2 dan NVMe 1.3 Support dan menghadirkan kemampuan baca / tulis superior random dan kemampuan multi-tasking. Sangat rekomendasi buat Intel dan AMD yang terbaru.&lt;br&gt;&lt;br&gt;Spesifikasi :&lt;br&gt;Tipe : SX8200 SSD M.2 Pcie Gen3x4 512GB&lt;br&gt;Kapasitas : 1 TB&lt;br&gt;Form Factor : M.2 2280&lt;br&gt;NAND Flash : 3D TLC&lt;br&gt;Controller : SMI&lt;br&gt;Interface : PCIe Gen3x4&lt;br&gt;Performace : Baca 3500MB/s ; Tulis 3000MB/s&lt;br&gt;MTBF : 2.000.000 Jam&lt;/div&gt;', '2021-05-17', '2021-05-17'),
(59, '13-1-HDD-875000', 'Seagate PC Barracuda 1TB 3.5&quot; HDD/ HD/ Hardisk/ Harddisk Internal', 'HDD', 13, 20, 1, 875000, 600, 'Sea468481.jpg', '&lt;div&gt;Form Factor: 3.5Inch&lt;br&gt;Interface: SATA 6Gb/s&lt;br&gt;Transfer Data Rate: Up to 156MB/s&lt;br&gt;Speed: 7200RPM&lt;br&gt;Cache: 64MB&lt;br&gt;Garansi Resmi 2 Tahun&lt;br&gt;&lt;br&gt;Seagate BarraCuda sangat sesuai untuk Penyimpanan desktop, Penyimpanan all-in-one, Server Rumah, Perangkat DAS.&lt;br&gt;&lt;br&gt;Semua harddisk dalam famili BarraCuda dilengkapi dengan Multi-Tier Caching (MTC) Technology. MTC memaksimalkan tingkat kinerja PC Anda, sehingga Anda dapat memuat aplikasi dan file dengan lebih cepat dari sebelumnya. Dengan menerapkan lapisan cerdas teknologi Flash NAND, DRAM, dan cache media, BarraCuda menghadirkan kinerja baca dan tulis yang lebih baik dengan mengoptimalkan aliran data.&lt;/div&gt;', '2021-05-27', '2021-05-27');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `description` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `slidders`
--

CREATE TABLE `slidders` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slidders`
--

INSERT INTO `slidders` (`id`, `id_product`, `status`, `title`, `description`) VALUES
(1, 46, '1', 'Produk Terbaru dan Terlaris', '&lt;div&gt;Aya buruan pesan sekarang juga sebelum kehabisan&lt;/div&gt;'),
(2, 51, '1', 'SSD Termurah dan Tercepat', '&lt;div&gt;Kecepatan Up to 3500MBps, dengan harga sangat terjangkau&lt;/div&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `nick_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `full_name`, `nick_name`, `phone`, `img`) VALUES
(32, 'nina', NULL, '$2y$10$2jRe.cv5O7JRGRqHR5cS0u77Ea249b7mIIrm5eQowv78l1WhP/sQS', NULL, NULL, NULL, NULL),
(34, 'anigato', NULL, '$2y$10$W58EIpBcAj6HAKRGxxYnauevtJS.KAHJwm.KIJ0DQVu6KktWoN0cy', NULL, NULL, NULL, NULL),
(35, 'midoriya', 'deku@tahoo.com', '$2y$10$XUhVqdsQIIoTfmVv.gLNpu7nnYHlxd2v9wKV7jHBiIQFGGnSLvleO', 'Izuku Midoriya', 'deku', '085210665025', 'mid729682.png'),
(36, 'wasd', NULL, '$2y$10$VnQ8LY9qJkAestkRX29iVu.RtnTE9HTwPsMLCPFmG9qZEnOt1KA2O', NULL, NULL, NULL, NULL),
(37, 'shinta', NULL, '$2y$10$SsIJDNDlhwPNI.ht3T9kiO/JhYd9EsfOmJuA/Ss6eMOoT103pz8cO', NULL, NULL, NULL, NULL),
(38, 'anam', 'fastemepso@enayu.com', '$2y$10$9UhVeQL4ZFRIt81rh1s9vOnW1QvkVlksYYJNX1XpFK.v2ynAu2w7y', 'Khoerul Anam', 'khoerul', '085210665025', 'ana389832.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE `user_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL,
  `img` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_admin`
--

INSERT INTO `user_admin` (`id`, `username`, `password`, `img`) VALUES
(9, 'admin', '$2y$10$WAaDFnP7tWb.KpAdk528Qets4FsnM9ctGK3tjobh0ca3TurQcz9cm', 'adm534161.png'),
(44, 'renan', '$2y$10$vZhsOXSwr6IER8rNWEtK2.dvom3sw3Tkf0jLsEADCccfWhFLwewu2', 'ren901932.png'),
(50, 'anam', '$2y$10$MPmlyPzq9p8OzV0MPCQqw.A74HtjVsZau4cMgr8sYSQAxEplIiydy', NULL),
(51, 'juli', '$2y$10$J9GXfxei0cC4B91/e4Y/rOILRRET4r5Mqib/UoiZQCD168P8xpbcq', '');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `id_product`, `id_user`) VALUES
(11, 50, 35),
(17, 53, 35),
(20, 52, 35),
(21, 55, 35),
(24, 46, 38),
(25, 58, 38);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_order` (`id_order`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_brand` (`id_brand`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slidders`
--
ALTER TABLE `slidders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slidders`
--
ALTER TABLE `slidders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_brand`) REFERENCES `brands` (`id`);

--
-- Constraints for table `slidders`
--
ALTER TABLE `slidders`
  ADD CONSTRAINT `slidders_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlists_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
