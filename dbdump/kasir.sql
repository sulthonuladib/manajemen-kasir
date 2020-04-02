-- MySQL dump 10.13  Distrib 8.0.18, for macos10.14 (x86_64)
--
-- Host: localhost    Database: kasir
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tabel_agent`
--

DROP TABLE IF EXISTS `tabel_agent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_agent` (
  `id_agent` int NOT NULL AUTO_INCREMENT,
  `user` varchar(64) NOT NULL,
  `tgl` varchar(64) NOT NULL,
  `browser` varchar(128) NOT NULL,
  `os` varchar(64) NOT NULL,
  `ip` varchar(64) NOT NULL,
  PRIMARY KEY (`id_agent`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_agent`
--

LOCK TABLES `tabel_agent` WRITE;
/*!40000 ALTER TABLE `tabel_agent` DISABLE KEYS */;
INSERT INTO `tabel_agent` VALUES (1,'admin','2020-03-29 04:33:20','Chrome 80.0.3987.149','Mac OS X','::1'),(2,'admin','2020-03-29 04:34:54','Chrome 80.0.3987.149','Mac OS X','::1'),(3,'admin','2020-03-29 04:43:23','Chrome 80.0.3987.149','Mac OS X','::1'),(4,'admin','2020-03-29 20:09:35','Chrome 80.0.3987.149','Mac OS X','::1'),(5,'admin','2020-03-29 20:51:26','Chrome 80.0.3987.149','Android','192.168.1.102'),(6,'admin','2020-03-29 20:55:28','Chrome 80.0.3987.149','Mac OS X','127.0.0.1'),(7,'admin','2020-03-29 21:01:16','Chrome 80.0.3987.149','Mac OS X','127.0.0.1'),(8,'admin','2020-03-29 21:02:24','Safari 604.1','iOS','192.168.1.110'),(9,'admin','2020-03-29 21:16:21','Safari 604.1','iOS','192.168.1.110'),(10,'admin','2020-03-29 21:57:57','Chrome 80.0.3987.149','Mac OS X','127.0.0.1'),(11,'admin','2020-03-29 22:00:06','Chrome 80.0.3987.149','Mac OS X','127.0.0.1'),(12,'admin','2020-03-29 22:27:09','Chrome 80.0.3987.149','Mac OS X','127.0.0.1'),(13,'admin','2020-03-29 22:27:34','Chrome 80.0.3987.149','Mac OS X','127.0.0.1'),(14,'admin','2020-03-29 22:28:37','Chrome 80.0.3987.149','Mac OS X','127.0.0.1'),(15,'admin','2020-03-29 22:34:37','Chrome 80.0.3987.149','Mac OS X','127.0.0.1'),(16,'admin','2020-03-29 22:34:45','Chrome 80.0.3987.149','Android','192.168.1.102');
/*!40000 ALTER TABLE `tabel_agent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_barang`
--

DROP TABLE IF EXISTS `tabel_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_barang` (
  `kd_barang` varchar(15) NOT NULL,
  `nm_barang` varchar(64) NOT NULL,
  `kd_satuan` varchar(10) NOT NULL,
  `kd_kategori` varchar(10) NOT NULL,
  `kd_supplier` varchar(16) NOT NULL,
  `hrg_jual` int NOT NULL,
  `hrg_beli` int NOT NULL,
  `kode_virtual` varchar(16) NOT NULL,
  `estimasi_stok` int NOT NULL,
  `modal_per_porsi` int NOT NULL,
  PRIMARY KEY (`kd_barang`),
  KEY `kd_barang` (`kd_barang`),
  KEY `kd_satuan` (`kd_satuan`,`kd_kategori`,`kd_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_barang`
--

LOCK TABLES `tabel_barang` WRITE;
/*!40000 ALTER TABLE `tabel_barang` DISABLE KEYS */;
INSERT INTO `tabel_barang` VALUES ('T001','Susu','S003','K002','',0,11000,'',10,1100),('T002','Keju Cheddar','S004','K002','',0,22000,'',12,1833),('U001','Jeruk','S001','K001','',0,18000,'',5,3600),('U002','Jambu Biji','S001','K001','',0,22000,'',6,3667),('U003','Sirsak','S001','K001','',0,16000,'',4,4000),('U004','Buah Naga','S001','K001','',0,35000,'',4,8750),('U005','Alpukat','S001','K001','',0,24000,'',6,4000),('U006','Buah Apel','S001','K001','',0,24000,'',6,4000);
/*!40000 ALTER TABLE `tabel_barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_biaya`
--

DROP TABLE IF EXISTS `tabel_biaya`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_biaya` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `id_user` varchar(10) NOT NULL,
  `biaya` int NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `ket` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_biaya`
--

LOCK TABLES `tabel_biaya` WRITE;
/*!40000 ALTER TABLE `tabel_biaya` DISABLE KEYS */;
/*!40000 ALTER TABLE `tabel_biaya` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_kartu_stok`
--

DROP TABLE IF EXISTS `tabel_kartu_stok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_kartu_stok` (
  `idkartu` int NOT NULL AUTO_INCREMENT,
  `kode_toko` varchar(15) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `waktu` varchar(32) NOT NULL,
  `jam` varchar(32) NOT NULL,
  `sebelumnya` int NOT NULL,
  `masuk` int NOT NULL,
  `keluar` int NOT NULL,
  `saldo` int NOT NULL,
  `keterangan` text NOT NULL,
  `user` varchar(10) NOT NULL,
  `publish` int NOT NULL,
  PRIMARY KEY (`idkartu`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_kartu_stok`
--

LOCK TABLES `tabel_kartu_stok` WRITE;
/*!40000 ALTER TABLE `tabel_kartu_stok` DISABLE KEYS */;
INSERT INTO `tabel_kartu_stok` VALUES (1,'SS001','U001','2019-07-13','16:12:05',0,10,0,10,'Pembelian SS00119071300001','manager',1),(2,'SS001','U002','2019-07-13','16:12:05',0,12,0,12,'Pembelian SS00119071300001','manager',1),(3,'SS001','U003','2019-07-13','16:12:05',0,12,0,12,'Pembelian SS00119071300001','manager',1),(4,'SS001','U004','2019-07-13','16:12:05',0,20,0,20,'Pembelian SS00119071300001','manager',1),(5,'SS001','U005','2019-07-13','16:12:05',0,24,0,24,'Pembelian SS00119071300001','manager',1),(6,'SS001','T001','2019-07-13','16:12:05',0,20,0,20,'Pembelian SS00119071300001','manager',1),(7,'SS001','T002','2019-07-13','16:12:05',0,24,0,24,'Pembelian SS00119071300001','manager',1),(8,'SS001','U004','2019-07-13','17:29:10',20,0,1,19,'Penjualan SS001190713001','manager',0),(9,'SS001','T001','2019-07-13','17:29:10',20,0,1,19,'Penjualan SS001190713001','manager',0),(10,'SS001','U005','2019-07-13','17:29:10',24,0,1,23,'Penjualan SS001190713001','manager',0),(11,'SS001','U005','2019-07-13','17:32:27',23,12,0,35,'Pembelian SS00119071300003','manager',1),(12,'SS001','T001','2019-07-13','18:22:48',19,0,2,17,'Penjualan SS001190713002','manager',0),(13,'SS001','U005','2019-07-13','18:22:48',35,0,2,33,'Penjualan SS001190713002','manager',0),(14,'SS001','u001','2019-07-13','21:12:11',8,0,2,8,'Busuk','manager',0),(15,'SS001','U004','2019-09-14','13:18:25',19,0,1,18,'Penjualan SS001190914001','admin',0),(16,'SS001','U005','2019-09-14','13:22:39',33,0,1,32,'Penjualan SS001190914002','admin',0);
/*!40000 ALTER TABLE `tabel_kartu_stok` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_kategori_barang`
--

DROP TABLE IF EXISTS `tabel_kategori_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_kategori_barang` (
  `kd_kategori` varchar(10) NOT NULL,
  `nm_kategori` varchar(255) NOT NULL,
  PRIMARY KEY (`kd_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_kategori_barang`
--

LOCK TABLES `tabel_kategori_barang` WRITE;
/*!40000 ALTER TABLE `tabel_kategori_barang` DISABLE KEYS */;
INSERT INTO `tabel_kategori_barang` VALUES ('K001','Bahan Utama'),('K002','Bahan Tambahan');
/*!40000 ALTER TABLE `tabel_kategori_barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_menu`
--

DROP TABLE IF EXISTS `tabel_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_menu` (
  `id_menu` int NOT NULL AUTO_INCREMENT,
  `kode_menu` varchar(16) NOT NULL,
  `nama_menu` varchar(32) NOT NULL,
  `harga_jual` int NOT NULL,
  `harga_modal` int NOT NULL,
  PRIMARY KEY (`id_menu`),
  KEY `kode_menu` (`kode_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_menu`
--

LOCK TABLES `tabel_menu` WRITE;
/*!40000 ALTER TABLE `tabel_menu` DISABLE KEYS */;
INSERT INTO `tabel_menu` VALUES (1,'M001','Jus Naga',12000,8750),(2,'M002','Jus Alpukat',10000,4000),(3,'M003','Jus Alpukat Susu',14000,5100),(4,'M004','Jus Jeruk',8000,3600),(5,'M005','Jus Pelangi',22000,18583);
/*!40000 ALTER TABLE `tabel_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_mutasi`
--

DROP TABLE IF EXISTS `tabel_mutasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_mutasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mutasi` varchar(6) NOT NULL,
  `kd_barang` varchar(15) NOT NULL,
  `jumlah` int NOT NULL,
  `ket` mediumtext NOT NULL,
  `tgl` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_mutasi`
--

LOCK TABLES `tabel_mutasi` WRITE;
/*!40000 ALTER TABLE `tabel_mutasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tabel_mutasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_pembelian`
--

DROP TABLE IF EXISTS `tabel_pembelian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_pembelian` (
  `no_faktur_pembelian` varchar(32) NOT NULL,
  `kd_supplier` varchar(15) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `id_user` varchar(10) NOT NULL,
  `total_pembelian` int NOT NULL,
  `selesai` int NOT NULL,
  PRIMARY KEY (`no_faktur_pembelian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_pembelian`
--

LOCK TABLES `tabel_pembelian` WRITE;
/*!40000 ALTER TABLE `tabel_pembelian` DISABLE KEYS */;
INSERT INTO `tabel_pembelian` VALUES ('SS00119071300001','SUPP','2019-07-13','manager',473000,1),('SS00119071300002','','2019-07-13','manager',0,0),('SS00119071300003','SUPP','2019-07-13','manager',52000,1),('SS00119091400001','','2019-09-14','admin',0,0),('SS00120032900001','','2020-03-29','admin',0,0),('SS00120032900002','','2020-03-29','admin',0,0),('SS00120032900003','','2020-03-29','admin',0,0);
/*!40000 ALTER TABLE `tabel_pembelian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_penjualan`
--

DROP TABLE IF EXISTS `tabel_penjualan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_penjualan` (
  `no_faktur_penjualan` varchar(16) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `waktu` time NOT NULL,
  `id_user` varchar(10) NOT NULL,
  `total_penjualan` int NOT NULL,
  `diskon` int NOT NULL,
  `total_penjualan_sdiskon` int NOT NULL,
  `ket_diskon` varchar(30) NOT NULL,
  `cash` int NOT NULL,
  `debet` int NOT NULL,
  `ket` mediumtext NOT NULL,
  `selesai` int NOT NULL,
  PRIMARY KEY (`no_faktur_penjualan`),
  KEY `no_faktur_penjualan` (`no_faktur_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_penjualan`
--

LOCK TABLES `tabel_penjualan` WRITE;
/*!40000 ALTER TABLE `tabel_penjualan` DISABLE KEYS */;
INSERT INTO `tabel_penjualan` VALUES ('SS001190713001','2019-07-13','16:15:23','manager',26000,0,26000,'',26000,0,'',1),('SS001190713002','2019-07-13','18:20:54','manager',28000,0,28000,'',28000,0,'',1),('SS001190914001','2019-09-14','13:18:25','admin',12000,0,12000,'',12000,0,'',1),('SS001190914002','2019-09-14','13:22:39','admin',10000,0,10000,'',10000,0,'',1),('SS001190917001','2019-09-17','12:36:49','admin',0,0,0,'',0,0,'',0),('SS001200329001','2020-03-29','04:49:45','admin',0,0,0,'',0,0,'',0);
/*!40000 ALTER TABLE `tabel_penjualan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_retur`
--

DROP TABLE IF EXISTS `tabel_retur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_retur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_faktur_penjualan` varchar(16) NOT NULL,
  `kd_barang` varchar(15) NOT NULL,
  `nm_barang` varchar(30) NOT NULL,
  `jumlah` varchar(11) NOT NULL,
  `total_retur` varchar(11) NOT NULL,
  `ket` varchar(128) NOT NULL,
  `tgl` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_retur`
--

LOCK TABLES `tabel_retur` WRITE;
/*!40000 ALTER TABLE `tabel_retur` DISABLE KEYS */;
/*!40000 ALTER TABLE `tabel_retur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_rinci_menu`
--

DROP TABLE IF EXISTS `tabel_rinci_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_rinci_menu` (
  `id_rinci_menu` int NOT NULL AUTO_INCREMENT,
  `kode_menu` varchar(16) NOT NULL,
  `kode_bahan` varchar(16) NOT NULL,
  PRIMARY KEY (`id_rinci_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_rinci_menu`
--

LOCK TABLES `tabel_rinci_menu` WRITE;
/*!40000 ALTER TABLE `tabel_rinci_menu` DISABLE KEYS */;
INSERT INTO `tabel_rinci_menu` VALUES (1,'M001','U004'),(2,'M002','U005'),(3,'M003','U005'),(4,'M003','T001'),(5,'M004','U001'),(6,'M005','U004'),(7,'M005','U005'),(8,'M005','U006'),(9,'M005','T002');
/*!40000 ALTER TABLE `tabel_rinci_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_rinci_pembelian`
--

DROP TABLE IF EXISTS `tabel_rinci_pembelian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_rinci_pembelian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_faktur_pembelian` varchar(16) NOT NULL,
  `kd_barang` varchar(15) NOT NULL,
  `nm_barang` varchar(30) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `jumlah` int NOT NULL,
  `harga` int NOT NULL,
  `sub_total_beli` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_rinci_pembelian`
--

LOCK TABLES `tabel_rinci_pembelian` WRITE;
/*!40000 ALTER TABLE `tabel_rinci_pembelian` DISABLE KEYS */;
INSERT INTO `tabel_rinci_pembelian` VALUES (1,'SS00119071300001','U001','Jeruk','KG',2,18000,36000),(2,'SS00119071300001','U002','Jambu Biji','KG',2,22000,44000),(3,'SS00119071300001','U003','Sirsak','KG',3,16000,48000),(4,'SS00119071300001','U004','Buah Naga','KG',5,35000,175000),(5,'SS00119071300001','U005','Alpukat','KG',4,26000,104000),(6,'SS00119071300001','T001','Susu','Kaleng',2,11000,22000),(7,'SS00119071300001','T002','Keju Cheddar','BOX',2,22000,44000),(8,'SS00119071300003','U005','Alpukat','KG',2,26000,52000);
/*!40000 ALTER TABLE `tabel_rinci_pembelian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_rinci_penjualan`
--

DROP TABLE IF EXISTS `tabel_rinci_penjualan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_rinci_penjualan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_faktur_penjualan` varchar(16) NOT NULL,
  `kd_barang` varchar(15) NOT NULL,
  `nm_barang` varchar(30) NOT NULL,
  `jumlah` int NOT NULL,
  `harga_modal` int NOT NULL,
  `harga` int NOT NULL,
  `diskonpersen` int NOT NULL,
  `diskonrp` int NOT NULL,
  `sub_total_jual` int NOT NULL,
  `retur` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `no_faktur_penjualan` (`no_faktur_penjualan`),
  KEY `kd_barang` (`kd_barang`),
  CONSTRAINT `fk_kd_barang` FOREIGN KEY (`kd_barang`) REFERENCES `tabel_menu` (`kode_menu`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_rinci_penjualan`
--

LOCK TABLES `tabel_rinci_penjualan` WRITE;
/*!40000 ALTER TABLE `tabel_rinci_penjualan` DISABLE KEYS */;
INSERT INTO `tabel_rinci_penjualan` VALUES (2,'SS001190713001','M001','Jus Naga',1,8750,12000,0,0,12000,0),(3,'SS001190713001','M003','Jus Alpukat Susu',1,5433,14000,0,0,14000,0),(4,'SS001190713002','M003','Jus Alpukat Susu',2,5433,14000,0,0,28000,0),(5,'SS001190914001','M001','Jus Naga',1,8750,12000,0,0,12000,0),(6,'SS001190914002','M002','Jus Alpukat',1,4000,10000,0,0,10000,0);
/*!40000 ALTER TABLE `tabel_rinci_penjualan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_satuan_barang`
--

DROP TABLE IF EXISTS `tabel_satuan_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_satuan_barang` (
  `kd_satuan` varchar(10) NOT NULL,
  `nm_satuan` varchar(25) NOT NULL,
  PRIMARY KEY (`kd_satuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_satuan_barang`
--

LOCK TABLES `tabel_satuan_barang` WRITE;
/*!40000 ALTER TABLE `tabel_satuan_barang` DISABLE KEYS */;
INSERT INTO `tabel_satuan_barang` VALUES ('S001','KG'),('S002','Kotak'),('S003','Kaleng'),('S004','BOX'),('S005','PCS');
/*!40000 ALTER TABLE `tabel_satuan_barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_stok_toko`
--

DROP TABLE IF EXISTS `tabel_stok_toko`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_stok_toko` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kd_toko` varchar(15) NOT NULL,
  `kd_barang` varchar(15) NOT NULL,
  `stok` int NOT NULL,
  `stok_min` int NOT NULL,
  `tgl_perubahan` varchar(64) NOT NULL,
  `publish` int NOT NULL,
  `ket` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kd_barang` (`kd_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_stok_toko`
--

LOCK TABLES `tabel_stok_toko` WRITE;
/*!40000 ALTER TABLE `tabel_stok_toko` DISABLE KEYS */;
INSERT INTO `tabel_stok_toko` VALUES (1,'SS001','U001',8,5,'13-07-2019 16:00:11',0,'Bahan Baru'),(2,'SS001','U002',12,5,'13-07-2019 16:00:56',0,'Bahan Baru'),(3,'SS001','U003',12,5,'13-07-2019 16:01:51',0,'Bahan Baru'),(4,'SS001','U004',18,5,'13-07-2019 16:02:14',0,'Bahan Baru'),(5,'SS001','T001',17,5,'13-07-2019 16:02:37',0,'Bahan Baru'),(6,'SS001','T002',24,5,'13-07-2019 16:03:31',0,'Bahan Baru'),(7,'SS001','U005',32,5,'13-07-2019 16:05:27',0,'Bahan Baru'),(8,'SS001','U006',0,5,'14-09-2019 13:20:56',0,'Bahan Baru');
/*!40000 ALTER TABLE `tabel_stok_toko` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_supplier`
--

DROP TABLE IF EXISTS `tabel_supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_supplier` (
  `kd_supplier` varchar(15) NOT NULL,
  `nm_supplier` varchar(25) NOT NULL,
  `almt_supplier` varchar(150) NOT NULL,
  `tlp_supplier` varchar(15) NOT NULL,
  `fax_supplier` varchar(15) NOT NULL,
  `atas_nama` varchar(25) NOT NULL,
  PRIMARY KEY (`kd_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_supplier`
--

LOCK TABLES `tabel_supplier` WRITE;
/*!40000 ALTER TABLE `tabel_supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `tabel_supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_toko`
--

DROP TABLE IF EXISTS `tabel_toko`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_toko` (
  `kd_toko` varchar(15) NOT NULL,
  `nm_toko` varchar(30) NOT NULL,
  `almt_toko` varchar(150) NOT NULL,
  `tlp_toko` varchar(15) NOT NULL,
  `fax_toko` varchar(15) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `password` varchar(35) NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`kd_toko`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_toko`
--

LOCK TABLES `tabel_toko` WRITE;
/*!40000 ALTER TABLE `tabel_toko` DISABLE KEYS */;
INSERT INTO `tabel_toko` VALUES ('SS001','bedokCode','Lamongan','082341951132','082341951132','mini.png','e10adc3949ba59abbe56e057f20f883e','pusat');
/*!40000 ALTER TABLE `tabel_toko` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabel_user`
--

DROP TABLE IF EXISTS `tabel_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_user` (
  `id_user` varchar(10) NOT NULL,
  `nm_user` varchar(25) NOT NULL,
  `password` varchar(35) NOT NULL,
  `akses` varchar(15) NOT NULL,
  `kd_toko` varchar(15) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_user`
--

LOCK TABLES `tabel_user` WRITE;
/*!40000 ALTER TABLE `tabel_user` DISABLE KEYS */;
INSERT INTO `tabel_user` VALUES ('admin','Admin Bedok','21232f297a57a5a743894a0e4a801fc3','manager','SS001');
/*!40000 ALTER TABLE `tabel_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-03  2:51:42
