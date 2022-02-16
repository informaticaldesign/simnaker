/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80023
 Source Host           : localhost:3306
 Source Schema         : db_datasets

 Target Server Type    : MySQL
 Target Server Version : 80023
 File Encoding         : 65001

 Date: 26/01/2022 09:48:23
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bbns
-- ----------------------------
DROP TABLE IF EXISTS `bbns`;
CREATE TABLE `bbns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `no_registrasi` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `jenis_id` bigint unsigned DEFAULT NULL,
  `brand_id` bigint unsigned DEFAULT NULL,
  `tahun` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_name` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of bbns
-- ----------------------------
BEGIN;
INSERT INTO `bbns` VALUES (1, '2021-04-12 05:30:40', '2021-04-12 05:46:14', 'AE3852LZ', 1, 1, '2015', 'PROCESS', 'test.pdf', 1);
COMMIT;

-- ----------------------------
-- Table structure for bidangs
-- ----------------------------
DROP TABLE IF EXISTS `bidangs`;
CREATE TABLE `bidangs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `provinsi_id` bigint unsigned DEFAULT NULL,
  `sektor_id` bigint unsigned DEFAULT NULL,
  `label` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_opd_prov` (`provinsi_id`),
  KEY `fk_opd_sektor` (`sektor_id`),
  CONSTRAINT `fk_opd_prov` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_opd_sektor` FOREIGN KEY (`sektor_id`) REFERENCES `sektors` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of bidangs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for biodata
-- ----------------------------
DROP TABLE IF EXISTS `biodata`;
CREATE TABLE `biodata` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(18) CHARACTER SET utf8 DEFAULT NULL,
  `nik` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `ektp` varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of biodata
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for brands
-- ----------------------------
DROP TABLE IF EXISTS `brands`;
CREATE TABLE `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `jenis_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_merk_jenis` (`jenis_id`) USING BTREE,
  CONSTRAINT `fk_brand_jenis` FOREIGN KEY (`jenis_id`) REFERENCES `jeniss` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of brands
-- ----------------------------
BEGIN;
INSERT INTO `brands` VALUES (1, '2021-03-29 05:36:53', '2021-04-11 06:10:40', 'HONDA', 'Honda', 1);
INSERT INTO `brands` VALUES (4, '2021-03-29 05:42:34', '2021-04-11 06:10:50', 'YAMAHA', 'Yamaha', 1);
INSERT INTO `brands` VALUES (5, '2021-03-29 05:43:56', '2021-04-11 06:10:57', 'SUZUKI', 'Suzuki', 2);
INSERT INTO `brands` VALUES (6, '2021-04-01 16:59:46', '2021-04-11 06:22:06', 'BENELLI', 'Benelli', 2);
INSERT INTO `brands` VALUES (7, '2021-04-01 17:00:35', '2021-04-11 06:21:57', 'BMW Motorrad', 'BMW Motorrad', 2);
INSERT INTO `brands` VALUES (8, '2021-04-01 17:00:35', '2021-04-11 06:22:13', 'VIAR', 'Viar', 4);
INSERT INTO `brands` VALUES (9, '2021-04-01 17:00:52', '2021-04-11 06:22:28', 'KTM', 'KTM', 1);
INSERT INTO `brands` VALUES (10, '2021-04-01 17:02:27', '2021-04-11 06:22:45', 'PIAGGIO', 'Piaggio', 1);
INSERT INTO `brands` VALUES (11, '2021-04-01 17:02:53', '2021-04-11 06:22:51', 'Harley Davidson', 'Harley Davidson', 1);
INSERT INTO `brands` VALUES (12, '2021-04-01 17:03:19', '2021-04-11 06:23:19', 'NOZOMI', 'Nozomi', 4);
INSERT INTO `brands` VALUES (13, '2021-04-01 17:06:04', '2021-04-11 06:23:30', 'TVS', 'TVS', 4);
INSERT INTO `brands` VALUES (14, '2021-04-01 17:06:33', '2021-04-11 06:26:01', 'ROYAL ENFIELD', 'ROYAL ENFIELD', 2);
INSERT INTO `brands` VALUES (15, '2021-04-01 17:06:45', '2021-04-11 06:23:51', 'DUCATI', 'DUCATI', 1);
INSERT INTO `brands` VALUES (16, '2021-04-01 17:07:11', '2021-04-11 06:30:19', 'TRIUMPH', 'TRIUMPH', 1);
INSERT INTO `brands` VALUES (17, '2021-04-01 17:07:19', '2021-04-11 06:30:13', 'BAJAJ', 'BAJAJ', 4);
INSERT INTO `brands` VALUES (18, '2021-04-01 17:07:28', '2021-04-11 06:30:07', 'SYM', 'SYM', 1);
INSERT INTO `brands` VALUES (19, '2021-04-01 17:07:48', '2021-04-11 06:30:01', 'MV AGUSTA', 'MV AGUSTA', 1);
INSERT INTO `brands` VALUES (20, '2021-04-01 17:08:10', '2021-04-11 06:29:54', 'NORTON', 'NORTON', 1);
INSERT INTO `brands` VALUES (21, '2021-04-01 17:08:29', '2021-04-11 06:29:45', 'LAMBRETTA', 'LAMBRETTA', 1);
INSERT INTO `brands` VALUES (22, '2021-04-01 17:08:59', '2021-04-11 06:28:02', 'ECGO', 'ECGO', 2);
INSERT INTO `brands` VALUES (23, '2021-04-01 17:09:12', '2021-04-11 06:30:30', 'APRILIA', 'APRILIA', 1);
INSERT INTO `brands` VALUES (24, '2021-04-01 17:09:36', '2021-04-11 06:30:38', 'KYMCO', 'KYMCO', 1);
INSERT INTO `brands` VALUES (25, '2021-04-01 17:09:52', '2021-04-11 06:30:43', 'MOTO GUZZI', 'MOTO GUZZI', 1);
INSERT INTO `brands` VALUES (26, '2021-04-01 17:10:12', '2021-04-11 06:30:50', 'GESIT', 'GESIT', 1);
INSERT INTO `brands` VALUES (27, '2021-04-01 17:10:31', '2021-04-11 06:30:57', 'DIABLO', 'DIABLO', 1);
INSERT INTO `brands` VALUES (28, '2021-04-01 17:10:59', '2021-04-11 06:31:02', 'PEUGEOT', 'PEUGEOT', 2);
INSERT INTO `brands` VALUES (29, '2021-04-01 17:11:27', '2021-04-11 06:31:09', 'SM SPORT', 'SM SPORT', 1);
INSERT INTO `brands` VALUES (30, '2021-04-01 17:11:39', '2021-04-11 06:31:15', 'SELIS', 'SELIS', 4);
COMMIT;

-- ----------------------------
-- Table structure for configs
-- ----------------------------
DROP TABLE IF EXISTS `configs`;
CREATE TABLE `configs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `section` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of configs
-- ----------------------------
BEGIN;
INSERT INTO `configs` VALUES (1, 'sitename', '', 'SIMNAKER', '2021-02-10 14:53:48', '2021-12-21 13:49:08');
INSERT INTO `configs` VALUES (2, 'sitename_part1', '', 'SIMNAKER', '2021-02-10 14:53:48', '2021-12-21 13:49:08');
INSERT INTO `configs` VALUES (3, 'sitename_part2', '', 'SIMNAKER', '2021-02-10 14:53:48', '2021-12-21 13:49:08');
INSERT INTO `configs` VALUES (4, 'sitename_short', '', 'OD', '2021-02-10 14:53:48', '2021-12-21 13:49:08');
INSERT INTO `configs` VALUES (5, 'site_description', '', 'SIMNAKER', '2021-02-10 14:53:48', '2021-12-21 13:49:08');
INSERT INTO `configs` VALUES (6, 'sidebar_search', '', '1', '2021-02-10 14:53:48', '2021-12-21 13:49:08');
INSERT INTO `configs` VALUES (7, 'show_messages', '', '1', '2021-02-10 14:53:48', '2021-12-21 13:49:08');
INSERT INTO `configs` VALUES (8, 'show_notifications', '', '1', '2021-02-10 14:53:48', '2021-12-21 13:49:08');
INSERT INTO `configs` VALUES (9, 'show_tasks', '', '1', '2021-02-10 14:53:48', '2021-12-21 13:49:08');
INSERT INTO `configs` VALUES (10, 'show_rightsidebar', '', '1', '2021-02-10 14:53:48', '2021-12-21 13:49:08');
INSERT INTO `configs` VALUES (11, 'skin', '', 'skin-white', '2021-02-10 14:53:48', '2021-12-21 13:49:08');
INSERT INTO `configs` VALUES (12, 'layout', '', 'fixed', '2021-02-10 14:53:48', '2021-12-21 13:49:08');
INSERT INTO `configs` VALUES (13, 'default_email', '', 'hery.handoko@gmail.com', '2021-02-10 14:53:48', '2021-12-21 13:49:08');
INSERT INTO `configs` VALUES (14, 'body_small_text', '', 'on', NULL, '2021-12-21 13:49:08');
INSERT INTO `configs` VALUES (15, 'navbar_variants', '', 'main-header navbar navbar-expand navbar-dark navbar-secondary', NULL, '2021-12-21 13:49:08');
INSERT INTO `configs` VALUES (16, 'dark_mode', '', 'on', NULL, '2021-12-21 13:49:08');
COMMIT;

-- ----------------------------
-- Table structure for datasets
-- ----------------------------
DROP TABLE IF EXISTS `datasets`;
CREATE TABLE `datasets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_topic` bigint unsigned DEFAULT NULL,
  `id_organization` bigint unsigned DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `counter` int DEFAULT NULL,
  `thumbnail` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '1',
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `status` smallint NOT NULL,
  `home_view` int NOT NULL DEFAULT '0',
  `chart_type` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `fk_ds_topic` (`id_topic`),
  KEY `fk_ds_orgeh` (`id_organization`),
  CONSTRAINT `fk_ds_orgeh` FOREIGN KEY (`id_organization`) REFERENCES `organizations` (`id`),
  CONSTRAINT `fk_ds_topic` FOREIGN KEY (`id_topic`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=700 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of datasets
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for forminputs
-- ----------------------------
DROP TABLE IF EXISTS `forminputs`;
CREATE TABLE `forminputs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uraian` text,
  `parent` bigint DEFAULT NULL,
  `hierarchy` bigint DEFAULT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `suburusan_id` bigint unsigned DEFAULT NULL,
  `urusan_id` bigint unsigned DEFAULT NULL,
  `bidang_id` bigint unsigned DEFAULT NULL,
  `sektor_id` bigint unsigned DEFAULT NULL,
  `provinsi_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_form_urusan` (`urusan_id`),
  KEY `fk_form_suburusan` (`suburusan_id`),
  KEY `fk_form_opd` (`bidang_id`),
  KEY `fk_form_prov` (`provinsi_id`),
  KEY `fk_form_sektor` (`sektor_id`),
  CONSTRAINT `fk_form_opd` FOREIGN KEY (`bidang_id`) REFERENCES `bidangs` (`id`),
  CONSTRAINT `fk_form_prov` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsis` (`id`),
  CONSTRAINT `fk_form_sektor` FOREIGN KEY (`sektor_id`) REFERENCES `sektors` (`id`),
  CONSTRAINT `fk_form_suburusan` FOREIGN KEY (`suburusan_id`) REFERENCES `suburusans` (`id`),
  CONSTRAINT `fk_form_urusan` FOREIGN KEY (`urusan_id`) REFERENCES `urusans` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3459 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of forminputs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `hierarchy` int DEFAULT NULL,
  PRIMARY KEY (`id`,`slug`) USING BTREE,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of groups
-- ----------------------------
BEGIN;
INSERT INTO `groups` VALUES (1, '2021-05-30 14:26:09', '2021-06-13 18:02:48', 'Ekonomi', 'ekonomi', 'economy.svg', 1);
INSERT INTO `groups` VALUES (2, '2021-05-30 14:26:13', '2021-05-30 23:37:14', 'Pendidikan', 'pendidikan', 'education.svg', 2);
INSERT INTO `groups` VALUES (3, '2021-05-30 14:26:17', NULL, 'Keuangan', 'keuangan', 'finance.svg', 4);
INSERT INTO `groups` VALUES (4, '2021-05-30 14:26:22', NULL, 'Kesehatan', 'kesehatan', 'health.svg', 5);
INSERT INTO `groups` VALUES (5, '2021-05-30 14:26:28', NULL, 'Infrastruktur', 'infrastruktur', 'infrastructure.svg', 6);
INSERT INTO `groups` VALUES (6, '2021-05-30 14:26:32', NULL, 'Sosial', 'sosial', 'society.svg', 7);
INSERT INTO `groups` VALUES (7, '2021-05-30 14:26:35', NULL, 'Teknologi', 'teknologi', 'technology.svg', 8);
INSERT INTO `groups` VALUES (8, '2021-05-30 14:26:38', NULL, 'Transportasi', 'transportasi', 'transport.svg', 9);
INSERT INTO `groups` VALUES (9, '2021-05-30 14:26:41', NULL, 'Lingkungan Hidup', 'linkungan-hidup', 'environment.svg', 3);
COMMIT;

-- ----------------------------
-- Table structure for infografiks
-- ----------------------------
DROP TABLE IF EXISTS `infografiks`;
CREATE TABLE `infografiks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(4000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `counter` int DEFAULT NULL,
  `id_topic` bigint unsigned DEFAULT NULL,
  `id_organization` bigint unsigned DEFAULT NULL,
  `created_by` bigint NOT NULL,
  `updated_by` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_graf_topic` (`id_topic`),
  KEY `fk_graf_orgeh` (`id_organization`),
  CONSTRAINT `fk_graf_orgeh` FOREIGN KEY (`id_organization`) REFERENCES `organizations` (`id`),
  CONSTRAINT `fk_graf_topic` FOREIGN KEY (`id_topic`) REFERENCES `groups` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of infografiks
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for infografiks_detail
-- ----------------------------
DROP TABLE IF EXISTS `infografiks_detail`;
CREATE TABLE `infografiks_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_infografis` bigint unsigned DEFAULT NULL,
  `fullpath` varchar(1000) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_detail_graf` (`id_infografis`),
  CONSTRAINT `fk_detail_graf` FOREIGN KEY (`id_infografis`) REFERENCES `infografiks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of infografiks_detail
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for jenis_pemeriksaan
-- ----------------------------
DROP TABLE IF EXISTS `jenis_pemeriksaan`;
CREATE TABLE `jenis_pemeriksaan` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of jenis_pemeriksaan
-- ----------------------------
BEGIN;
INSERT INTO `jenis_pemeriksaan` VALUES (1, 'Pengupahan', NULL, NULL);
INSERT INTO `jenis_pemeriksaan` VALUES (2, 'Alat Pelindung Diri', NULL, NULL);
INSERT INTO `jenis_pemeriksaan` VALUES (3, 'Keuangan', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for jeniss
-- ----------------------------
DROP TABLE IF EXISTS `jeniss`;
CREATE TABLE `jeniss` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of jeniss
-- ----------------------------
BEGIN;
INSERT INTO `jeniss` VALUES (1, NULL, NULL, 'R2', 'Sepeda Motor');
INSERT INTO `jeniss` VALUES (2, NULL, '2021-03-31 18:06:00', 'R4', 'Mobil');
INSERT INTO `jeniss` VALUES (4, '2021-04-01 14:33:44', '2021-04-01 14:33:44', 'R3', 'Sepeda Motor Roda Tiga');
COMMIT;

-- ----------------------------
-- Table structure for m_bidang_usaha
-- ----------------------------
DROP TABLE IF EXISTS `m_bidang_usaha`;
CREATE TABLE `m_bidang_usaha` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_bidang_usaha
-- ----------------------------
BEGIN;
INSERT INTO `m_bidang_usaha` VALUES (1, 'Tambang', '2021-12-26 15:53:29', 1, '2021-12-26 15:53:29', NULL);
COMMIT;

-- ----------------------------
-- Table structure for m_company
-- ----------------------------
DROP TABLE IF EXISTS `m_company`;
CREATE TABLE `m_company` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_kota` bigint DEFAULT NULL,
  `id_provinsi` bigint DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_wlkp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jenis_usaha` bigint DEFAULT NULL,
  `bidang_usaha` bigint DEFAULT NULL,
  `npp_bpjs` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_npwp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pemeriksa` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nik_ktp_p` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `penanggung_jwb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nik_ktp_t` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo_path` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint DEFAULT '0',
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`,`nib`) USING BTREE,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_company
-- ----------------------------
BEGIN;
INSERT INTO `m_company` VALUES (8, 'PT Adhi Karya Persada', 'Serang City, Banten, Indonesia', 2, 4, 'admin@adhikarya.com', '12345678', '106.1816196', '-6.135401', '2022-01-11 11:25:55', NULL, '2022-01-11 11:25:55', NULL, 'logo_adhi_karya.png', '12345678', '12345678', 1, 1, '12345678', '12345678', 'Heri Handoko', '12345678', 'Joko Satrio', '12345678', 'uploads/logo/2022/01/logo_adhi_karya.png', 0, NULL);
INSERT INTO `m_company` VALUES (9, 'PT Propan Raya Tbk', 'Jl. Asia Afrika No.6, RT.1/RW.3, Gelora, Kecamatan Tanah Abang, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10270, Indonesia', 1, 4, 'admin@propan.com', '87654321', '106.7972699', '-6.227968600000001', '2022-01-13 10:29:09', NULL, '2022-01-17 12:33:23', 38, 'logo_propan.jpeg', '87654321', '87654321', 1, 1, '87654321', '87654321', 'Indra Sakti', '87654321', 'Tomas', '87654321', 'uploads/logo/2022/01/logo_propan.jpeg', 1, 'pt-propan-raya-tbk');
INSERT INTO `m_company` VALUES (10, 'PT Propan Raya Tbk', 'Jl. Gatot Subroto No.KM.8, Kadu Jaya, Kec. Curug, Kabupaten Tangerang, Banten 15810, Indonesia', 1, 4, 'admin@propan.com', '87654321', '106.562986', '-6.2072947', '2022-01-11 11:33:14', NULL, '2022-01-11 11:33:14', NULL, 'logo_propan.jpeg', '87654321', '87654321', 1, 1, '87654321', '87654321', 'Indra Sakti', '87654321', 'Tomas', '87654321', 'uploads/logo/2022/01/logo_propan.jpeg', 0, NULL);
COMMIT;

-- ----------------------------
-- Table structure for m_golongan
-- ----------------------------
DROP TABLE IF EXISTS `m_golongan`;
CREATE TABLE `m_golongan` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_golongan
-- ----------------------------
BEGIN;
INSERT INTO `m_golongan` VALUES (3, '2A', '2021-12-26 09:33:03', 1, '2021-12-26 09:33:20', 1);
COMMIT;

-- ----------------------------
-- Table structure for m_jabatan
-- ----------------------------
DROP TABLE IF EXISTS `m_jabatan`;
CREATE TABLE `m_jabatan` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_jabatan
-- ----------------------------
BEGIN;
INSERT INTO `m_jabatan` VALUES (3, 'Pengawas Ketenagakerjaan', NULL, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for m_kota
-- ----------------------------
DROP TABLE IF EXISTS `m_kota`;
CREATE TABLE `m_kota` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `id_provinsi` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_kota
-- ----------------------------
BEGIN;
INSERT INTO `m_kota` VALUES (1, 'Tangerang', '2021-12-26 16:52:03', 1, '2021-12-26 16:52:03', NULL, NULL);
INSERT INTO `m_kota` VALUES (2, 'Serang', NULL, 1, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for m_pangkat
-- ----------------------------
DROP TABLE IF EXISTS `m_pangkat`;
CREATE TABLE `m_pangkat` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_pangkat
-- ----------------------------
BEGIN;
INSERT INTO `m_pangkat` VALUES (1, 'Penata', NULL, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for m_pemeriksaan
-- ----------------------------
DROP TABLE IF EXISTS `m_pemeriksaan`;
CREATE TABLE `m_pemeriksaan` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_pemeriksaan
-- ----------------------------
BEGIN;
INSERT INTO `m_pemeriksaan` VALUES (1, 'Norma waktu kerja dan waktu istirahat', '2021-12-26 15:04:31', 1, '2021-12-26 15:04:36', 1);
INSERT INTO `m_pemeriksaan` VALUES (2, 'Norma Pengupahan', NULL, NULL, NULL, NULL);
INSERT INTO `m_pemeriksaan` VALUES (3, 'Norma Hubungan Kerja', NULL, NULL, NULL, NULL);
INSERT INTO `m_pemeriksaan` VALUES (4, 'Norma Jamsostek', NULL, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for m_provinsi
-- ----------------------------
DROP TABLE IF EXISTS `m_provinsi`;
CREATE TABLE `m_provinsi` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_provinsi
-- ----------------------------
BEGIN;
INSERT INTO `m_provinsi` VALUES (4, 'Banten', '2021-12-26 12:29:09', 1, '2021-12-26 12:34:14', 1);
COMMIT;

-- ----------------------------
-- Table structure for m_sifat_doc
-- ----------------------------
DROP TABLE IF EXISTS `m_sifat_doc`;
CREATE TABLE `m_sifat_doc` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_sifat_doc
-- ----------------------------
BEGIN;
INSERT INTO `m_sifat_doc` VALUES (1, 'Sangat Rahasia', '2021-12-26 15:48:09', 1, '2021-12-26 15:48:17', 1);
COMMIT;

-- ----------------------------
-- Table structure for m_type_periksa
-- ----------------------------
DROP TABLE IF EXISTS `m_type_periksa`;
CREATE TABLE `m_type_periksa` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_type_periksa
-- ----------------------------
BEGIN;
INSERT INTO `m_type_periksa` VALUES (1, 'Pertama', NULL, NULL);
INSERT INTO `m_type_periksa` VALUES (2, 'Berkala', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for m_unit_kerja
-- ----------------------------
DROP TABLE IF EXISTS `m_unit_kerja`;
CREATE TABLE `m_unit_kerja` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_unit_kerja
-- ----------------------------
BEGIN;
INSERT INTO `m_unit_kerja` VALUES (1, 'Unit Pelaksana Teknis Daerah Pengawas Tenagakerja', NULL, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for m_usaha
-- ----------------------------
DROP TABLE IF EXISTS `m_usaha`;
CREATE TABLE `m_usaha` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_usaha
-- ----------------------------
BEGIN;
INSERT INTO `m_usaha` VALUES (1, 'Tambang X', '2021-12-26 15:08:33', 1, '2021-12-26 15:08:37', 1);
COMMIT;

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `module_id` bigint unsigned DEFAULT NULL,
  `parent` int unsigned NOT NULL DEFAULT '0',
  `hierarchy` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_menus_module` (`module_id`),
  CONSTRAINT `fk_menus_module` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menus
-- ----------------------------
BEGIN;
INSERT INTO `menus` VALUES (1, 8, 0, 12, '2021-02-21 21:09:08', '2022-01-20 07:43:01');
INSERT INTO `menus` VALUES (5, 1, 1, 1, '2021-02-21 22:35:06', '2021-05-31 00:46:41');
INSERT INTO `menus` VALUES (6, 5, 1, 3, '2021-02-21 22:35:07', '2021-05-31 00:46:41');
INSERT INTO `menus` VALUES (7, 7, 1, 4, '2021-02-21 22:35:11', '2021-05-31 00:46:41');
INSERT INTO `menus` VALUES (9, 6, 1, 2, '2021-02-22 00:49:23', '2021-05-31 00:46:41');
INSERT INTO `menus` VALUES (11, 10, 1, 5, '2021-02-22 01:50:07', '2021-05-31 00:46:41');
INSERT INTO `menus` VALUES (30, 19, 0, 1, '2021-04-01 17:15:56', '2022-01-12 02:44:21');
INSERT INTO `menus` VALUES (32, 29, 0, 6, '2021-05-30 15:45:03', '2022-01-20 07:43:01');
INSERT INTO `menus` VALUES (33, 30, 0, 7, '2021-05-30 23:41:35', '2022-01-20 07:43:01');
INSERT INTO `menus` VALUES (35, 31, 0, 8, '2021-05-31 00:46:46', '2022-01-20 07:43:01');
INSERT INTO `menus` VALUES (36, 32, 0, 10, '2021-05-31 14:07:38', '2022-01-20 07:43:01');
INSERT INTO `menus` VALUES (39, 35, 32, 1, '2021-12-21 16:51:13', '2021-12-21 16:51:18');
INSERT INTO `menus` VALUES (40, 9, 0, 11, '2021-12-21 19:46:24', '2022-01-20 07:43:01');
INSERT INTO `menus` VALUES (41, 36, 40, 2, '2021-12-21 19:48:46', '2021-12-26 12:30:59');
INSERT INTO `menus` VALUES (42, 37, 40, 8, '2021-12-21 19:48:48', '2021-12-26 12:30:55');
INSERT INTO `menus` VALUES (43, 38, 40, 3, '2021-12-21 19:55:11', '2021-12-26 12:30:59');
INSERT INTO `menus` VALUES (44, 39, 40, 4, '2021-12-21 19:55:15', '2021-12-26 12:30:59');
INSERT INTO `menus` VALUES (45, 40, 40, 7, '2021-12-21 19:55:16', '2021-12-26 12:30:55');
INSERT INTO `menus` VALUES (46, 41, 40, 12, '2021-12-21 19:55:17', '2021-12-26 12:30:55');
INSERT INTO `menus` VALUES (47, 42, 40, 10, '2021-12-21 19:55:18', '2021-12-26 12:30:55');
INSERT INTO `menus` VALUES (48, 43, 40, 11, '2021-12-21 19:55:20', '2021-12-26 12:30:55');
INSERT INTO `menus` VALUES (49, 44, 40, 9, '2021-12-21 19:55:21', '2021-12-26 12:30:55');
INSERT INTO `menus` VALUES (50, 45, 40, 5, '2021-12-21 19:55:22', '2021-12-26 12:30:59');
INSERT INTO `menus` VALUES (51, 47, 32, 2, '2021-12-23 02:11:55', '2021-12-23 02:56:52');
INSERT INTO `menus` VALUES (52, 48, 33, 1, '2021-12-23 02:58:34', '2021-12-23 02:59:04');
INSERT INTO `menus` VALUES (53, 49, 33, 2, '2021-12-23 03:02:00', '2021-12-23 03:02:04');
INSERT INTO `menus` VALUES (54, 46, 40, 1, '2021-12-23 09:25:17', '2021-12-23 09:25:21');
INSERT INTO `menus` VALUES (55, 50, 40, 6, '2021-12-26 12:30:49', '2021-12-26 12:30:59');
INSERT INTO `menus` VALUES (56, 51, 0, 9, '2022-01-07 09:09:29', '2022-01-20 07:43:01');
INSERT INTO `menus` VALUES (57, 52, 0, 3, '2022-01-12 02:44:02', '2022-01-20 07:43:01');
INSERT INTO `menus` VALUES (58, 53, 57, 1, '2022-01-12 02:44:03', '2022-01-12 02:44:13');
INSERT INTO `menus` VALUES (59, 54, 57, 2, '2022-01-12 02:44:04', '2022-01-12 02:44:14');
INSERT INTO `menus` VALUES (60, 55, 57, 3, '2022-01-12 02:44:05', '2022-01-12 02:44:15');
INSERT INTO `menus` VALUES (61, 56, 0, 4, '2022-01-12 02:44:06', '2022-01-20 07:43:01');
INSERT INTO `menus` VALUES (62, 57, 0, 5, '2022-01-12 02:44:07', '2022-01-20 07:43:01');
INSERT INTO `menus` VALUES (63, 58, 62, 1, '2022-01-12 02:44:07', '2022-01-12 02:44:18');
INSERT INTO `menus` VALUES (64, 59, 62, 2, '2022-01-12 02:44:08', '2022-01-12 02:44:19');
INSERT INTO `menus` VALUES (65, 60, 66, 1, '2022-01-17 13:39:27', '2022-01-20 07:43:01');
INSERT INTO `menus` VALUES (66, 61, 0, 2, '2022-01-20 07:42:54', '2022-01-20 07:42:59');
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (7, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (8, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (9, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (10, '2021_02_21_134347_create_modules_table', 1);
INSERT INTO `migrations` VALUES (12, '2021_02_21_185935_create_menus_table', 2);
INSERT INTO `migrations` VALUES (13, '2021_02_21_223909_create_roles_table', 3);
INSERT INTO `migrations` VALUES (14, '2021_02_22_015037_create_configs_table', 4);
INSERT INTO `migrations` VALUES (15, '2021_02_22_040000_create_provinsis_table', 5);
INSERT INTO `migrations` VALUES (16, '2021_02_22_082036_create_bidangs_table', 6);
INSERT INTO `migrations` VALUES (17, '2021_02_22_083131_create_urusans_table', 7);
INSERT INTO `migrations` VALUES (18, '2021_02_22_084115_create_satuans_table', 8);
INSERT INTO `migrations` VALUES (19, '2021_02_22_141232_create_forminputs_table', 9);
INSERT INTO `migrations` VALUES (20, '2021_02_22_160330_create_komponens_table', 10);
INSERT INTO `migrations` VALUES (21, '2021_02_24_000951_create_sektorals_table', 11);
INSERT INTO `migrations` VALUES (22, '2021_02_24_004544_create_suburusans_table', 12);
INSERT INTO `migrations` VALUES (23, '2021_03_10_041347_create_sektors_table', 13);
INSERT INTO `migrations` VALUES (24, '2016_06_01_000001_create_oauth_auth_codes_table', 14);
INSERT INTO `migrations` VALUES (25, '2016_06_01_000002_create_oauth_access_tokens_table', 14);
INSERT INTO `migrations` VALUES (26, '2016_06_01_000003_create_oauth_refresh_tokens_table', 14);
INSERT INTO `migrations` VALUES (27, '2016_06_01_000004_create_oauth_clients_table', 14);
INSERT INTO `migrations` VALUES (28, '2016_06_01_000005_create_oauth_personal_access_clients_table', 14);
INSERT INTO `migrations` VALUES (29, '2021_03_29_052035_create_brands_table', 15);
INSERT INTO `migrations` VALUES (30, '2021_03_29_054644_create_statuses_table', 16);
INSERT INTO `migrations` VALUES (31, '2021_03_29_055904_create_transaksis_table', 17);
INSERT INTO `migrations` VALUES (32, '2021_03_29_061525_create_manuals_table', 18);
INSERT INTO `migrations` VALUES (33, '2021_03_29_073420_create_jenis_table', 19);
INSERT INTO `migrations` VALUES (34, '2021_03_31_120523_create_stnks_table', 20);
INSERT INTO `migrations` VALUES (35, '2021_04_11_142709_create_blokirs_table', 21);
INSERT INTO `migrations` VALUES (36, '2021_04_11_160009_create_bbns_table', 21);
INSERT INTO `migrations` VALUES (37, '2021_04_29_102134_create_antrians_table', 22);
INSERT INTO `migrations` VALUES (38, '2021_05_17_152340_create_groups_table', 23);
INSERT INTO `migrations` VALUES (39, '2021_05_18_014505_create_organizations_table', 24);
INSERT INTO `migrations` VALUES (40, '2021_05_23_022520_create_visualisasis_table', 25);
INSERT INTO `migrations` VALUES (41, '2021_05_23_194828_create_infografiks_table', 26);
INSERT INTO `migrations` VALUES (42, '2021_05_26_002359_create_datasets_table', 27);
INSERT INTO `migrations` VALUES (43, '2021_12_21_171133_create_pemeriksaans_table', 28);
INSERT INTO `migrations` VALUES (44, '2021_12_21_171356_sim_pemeriksaan', 28);
INSERT INTO `migrations` VALUES (45, '2021_12_23_021423_create_pengawasans_table', 29);
COMMIT;

-- ----------------------------
-- Table structure for modules
-- ----------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fa_icon` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of modules
-- ----------------------------
BEGIN;
INSERT INTO `modules` VALUES (1, '2021-02-21 17:01:28', '2021-02-22 01:44:56', 'Users', 'Users', 'users', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (5, '2021-02-21 18:12:45', '2021-02-21 18:16:53', 'Modules', 'Modules', 'modules', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (6, '2021-02-21 18:13:46', '2021-02-21 18:17:00', 'Roles', 'Roles', 'roles', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (7, '2021-02-21 18:14:26', '2021-02-21 18:17:07', 'Menus', 'Menus', 'menus', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (8, '2021-02-21 18:15:12', '2021-02-21 22:36:06', 'Settings', 'Settings', '#', 'fa-cogs', NULL);
INSERT INTO `modules` VALUES (9, '2021-02-22 01:39:57', '2021-12-21 19:46:07', 'Master Data', 'Master Data', '#', 'fa-database', NULL);
INSERT INTO `modules` VALUES (10, '2021-02-22 01:50:03', '2021-12-26 13:12:27', 'Configs', 'Configs', 'configs', 'far fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (19, '2021-02-22 03:23:36', '2021-06-11 10:47:14', 'Dashboard', 'Dashboard', '/admin', 'fa-tachometer-alt', NULL);
INSERT INTO `modules` VALUES (29, '2021-05-30 15:44:05', '2021-12-21 16:39:11', 'Input Data', 'Input Data', '#', 'fa-layer-group', NULL);
INSERT INTO `modules` VALUES (30, '2021-05-30 23:41:20', '2021-12-23 03:00:40', 'Rekapitulasi Data', 'Rekapitulasi Data', '#', 'fa-list', NULL);
INSERT INTO `modules` VALUES (31, '2021-05-31 00:46:35', '2022-01-06 06:36:53', 'Regulasi Data', 'Regulasi Data', '/admin/regulasi', 'fa-database', NULL);
INSERT INTO `modules` VALUES (32, '2021-05-31 14:06:48', '2021-12-21 13:58:42', 'Rekapitulasi Renja', 'Rekapitulasi Renja', 'admin/visualisasi', 'fa-chart-area', NULL);
INSERT INTO `modules` VALUES (33, '2021-05-31 14:07:17', '2021-05-31 14:07:17', 'Infografis', 'Infografis', 'admin/infografis', 'fa-image', NULL);
INSERT INTO `modules` VALUES (35, '2021-12-21 16:50:48', '2021-12-21 16:50:48', 'Nota Pemeriksaan', 'Nota Pemeriksaan', '/pemeriksaan', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (36, '2021-12-21 19:48:06', '2021-12-26 16:14:51', 'Perusahaan', 'Perusahaan', '/company', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (37, '2021-12-21 19:48:41', '2021-12-26 09:27:52', 'Jenis Pemeriksaan', 'Jenis Pemeriksaan', '/jenispem', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (38, '2021-12-21 19:50:28', '2021-12-26 09:18:04', 'Jabatan', 'Jabatan', '/jabatan', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (39, '2021-12-21 19:50:43', '2021-12-26 09:27:39', 'Golongan', 'Golongan', '/golongan', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (40, '2021-12-21 19:51:09', '2021-12-26 09:28:00', 'Pangkat', 'Pangkat', '/pangkat', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (41, '2021-12-21 19:51:31', '2021-12-26 09:28:05', 'Unit Kerja', 'Unit Kerja', '/unitkerja', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (42, '2021-12-21 19:52:12', '2021-12-26 09:28:10', 'Sifat Dokumen', 'Sifat Dokumen', '/sifatdok', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (43, '2021-12-21 19:53:39', '2021-12-26 09:28:17', 'Bidang Usaha', 'Bidang Usaha', '/bidangusaha', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (44, '2021-12-21 19:53:51', '2021-12-26 09:28:22', 'Jenis Usaha', 'Jenis Usaha', '/jenisusaha', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (45, '2021-12-21 19:54:59', '2021-12-26 09:28:27', 'Kabupaten/Kota', 'Kabupaten/Kota', '/kota', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (46, '2021-12-21 19:56:45', '2021-12-24 22:19:50', 'Biodata', 'Biodata', '/pengguna', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (47, '2021-12-23 02:11:48', '2021-12-23 02:11:48', 'LHP Pengawasan', 'LHP Pengawasan', '/pengawasan', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (48, '2021-12-23 02:58:25', '2021-12-23 02:59:55', 'Nota Pemeriksaan', 'Nota Pemeriksaan', '/pemeriksaan/rekap', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (49, '2021-12-23 03:01:23', '2021-12-23 03:01:42', 'LHP Pengawasan', 'LHP Pengawasan', '/pengawasan/rekap', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (50, '2021-12-26 12:30:12', '2021-12-26 12:30:12', 'Provinsi', 'Provinsi', '/provinsi', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (51, '2022-01-07 09:09:19', '2022-01-07 09:09:19', 'Talkshow', 'Talkshow', '/admin/talkshow', 'fa-video', NULL);
INSERT INTO `modules` VALUES (52, '2022-01-12 02:38:37', '2022-01-12 02:38:37', 'Suket Online', 'Suket Online', '#', 'fa-file-alt', NULL);
INSERT INTO `modules` VALUES (53, '2022-01-12 02:39:59', '2022-01-12 02:39:59', 'Pengajuan', 'Pengajuan', '/admin/pengajuan', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (54, '2022-01-12 02:40:34', '2022-01-12 02:40:34', 'Proses', 'Proses', '/admin/proses', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (55, '2022-01-12 02:40:59', '2022-01-12 02:40:59', 'Terverifikasi', 'Terverifikasi', '/admin/terverifikasi', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (56, '2022-01-12 02:41:43', '2022-01-12 02:41:43', 'Kotak Masuk', 'Kotak Masuk', '/admin/inbox', 'fa-envelope', NULL);
INSERT INTO `modules` VALUES (57, '2022-01-12 02:42:48', '2022-01-12 02:42:48', 'Unduh Data', 'Unduh Data', '#', 'fa-download', NULL);
INSERT INTO `modules` VALUES (58, '2022-01-12 02:43:21', '2022-01-12 02:43:21', 'Buku Panduan', 'Buku Panduan', '/admin/manual', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (59, '2022-01-12 02:43:50', '2022-01-12 02:43:50', 'Regulasi Ketenagakerjaan', 'Regulasi Ketenagakerjaan', '/admin/regulasi', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (60, '2022-01-17 13:38:05', '2022-01-20 07:42:04', 'Input Rencana Kerja', 'Input Rencana Kerja', '/admin/renja', 'fa-chevron-right', NULL);
INSERT INTO `modules` VALUES (61, '2022-01-20 07:42:31', '2022-01-20 07:42:31', 'Rencana Kerja', 'Rencana Kerja', '#', 'fa-calendar', NULL);
INSERT INTO `modules` VALUES (62, '2022-01-20 07:51:51', '2022-01-20 07:51:51', 'Report Rencana Kerja', 'Report Rencana Kerja', '/admin/renja/report', 'fa-chevron-right', NULL);
COMMIT;

-- ----------------------------
-- Table structure for oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of oauth_access_tokens
-- ----------------------------
BEGIN;
INSERT INTO `oauth_access_tokens` VALUES ('0c4518754d8f63e75781c72eaa6c53f06ae53027654f75f5015dfb920d660ef3a291fa59bf2cbe36', 1, 1, 'nApp', '[]', 1, '2021-03-28 16:14:31', '2021-03-28 16:14:31', '2022-03-28 16:14:31');
INSERT INTO `oauth_access_tokens` VALUES ('0c858e1d2e4e252e550f245ddd4c6fabb177c9cc4e4b65a16396ff87dbafca8cd1f4a443e7825eb4', 1, 1, 'nApp', '[]', 0, '2021-03-28 12:44:43', '2021-03-28 12:44:43', '2022-03-28 12:44:43');
INSERT INTO `oauth_access_tokens` VALUES ('0d15cfd19a7dfa265ce9bffb90c62921574728467367b99d3742f63efd2d2704d7ba3793314a456b', 21, 1, 'nApp', '[]', 1, '2021-04-01 14:53:47', '2021-04-01 14:53:47', '2022-04-01 14:53:47');
INSERT INTO `oauth_access_tokens` VALUES ('110874dea693cc607d46f5ceba8bdcc5cc51aaa6627e7d9d507539f458121df51ef00f5466f2beab', 1, 1, 'nApp', '[]', 0, '2021-03-28 11:16:06', '2021-03-28 11:16:06', '2022-03-28 11:16:06');
INSERT INTO `oauth_access_tokens` VALUES ('17fa683c5819e5836931b091e3680728987fd34b4c818f385b2f7404f8004b60d5070ab18c9e9b0c', 20, 1, 'nApp', '[]', 0, '2021-03-31 10:11:06', '2021-03-31 10:11:06', '2022-03-31 10:11:06');
INSERT INTO `oauth_access_tokens` VALUES ('19501070554c4f31bb025fea1e61983594be4bb31b96204404cfa570db28976287e2f0728b86aeb7', 23, 1, 'nApp', '[]', 0, '2021-03-31 21:48:40', '2021-03-31 21:48:40', '2022-03-31 21:48:40');
INSERT INTO `oauth_access_tokens` VALUES ('1bdad0c5e218a0f2eef0146c7c5c072f4f319d2bc22c630ea4715cf0be8cdd7b1bfeadbe613aba53', 19, 1, 'nApp', '[]', 0, '2021-03-31 09:55:00', '2021-03-31 09:55:00', '2022-03-31 09:55:00');
INSERT INTO `oauth_access_tokens` VALUES ('2552a1df6d971d50bb7a3699ef1f10c002b07707114d44133dab9be26b5d7a0fd15eceb17922e832', 25, 1, 'nApp', '[]', 0, '2021-04-03 13:28:53', '2021-04-03 13:28:53', '2022-04-03 13:28:53');
INSERT INTO `oauth_access_tokens` VALUES ('26a9f5d931755712b76d2a32b58c3873b6ab4a4c896f381879edeffa8b099f0ab56d22774afe2316', 1, 1, 'nApp', '[]', 1, '2021-03-28 16:13:53', '2021-03-28 16:13:53', '2022-03-28 16:13:53');
INSERT INTO `oauth_access_tokens` VALUES ('286eb673248e3821b8406e93ccee3cc22bedcd06773d1d814fdf320090b9798492f72ab518cf852f', 21, 1, 'nApp', '[]', 1, '2021-04-01 14:27:14', '2021-04-01 14:27:14', '2022-04-01 14:27:14');
INSERT INTO `oauth_access_tokens` VALUES ('293165580d788ab4cc0ff679f13f1c2ae7a05d6e07f29277222eeb9bdb2d5a94a28d7c77fddcb361', 1, 1, 'nApp', '[]', 0, '2021-03-28 12:51:16', '2021-03-28 12:51:16', '2022-03-28 12:51:16');
INSERT INTO `oauth_access_tokens` VALUES ('2c8c596c14ec9d60b05db3058f067bc85c33755f4ff55d73720635457346a8d0d873e2d835e063f1', 1, 1, 'nApp', '[]', 1, '2021-03-29 02:26:13', '2021-03-29 02:26:13', '2022-03-29 02:26:13');
INSERT INTO `oauth_access_tokens` VALUES ('2ce9d40522a035b619ecfdc973995dce14d5f06e8c896fed1e0efcf6f5b83ea52a8ce2ecb5d333fe', 21, 1, 'nApp', '[]', 1, '2021-04-01 21:08:04', '2021-04-01 21:08:04', '2022-04-01 21:08:04');
INSERT INTO `oauth_access_tokens` VALUES ('2e0cba737e77635e6d60343052244ddd62c37ad7899f0284d028abc761aa6e39ce494c685ada1530', 1, 1, 'nApp', '[]', 1, '2021-03-29 09:41:43', '2021-03-29 09:41:43', '2022-03-29 09:41:43');
INSERT INTO `oauth_access_tokens` VALUES ('2e4eab3380f31d1e51f294b65ed8d49fcb4775eaf1be2477b5300beef19aa972e4925eef2a0b7404', 1, 1, 'nApp', '[]', 0, '2021-03-28 06:42:55', '2021-03-28 06:42:55', '2022-03-28 06:42:55');
INSERT INTO `oauth_access_tokens` VALUES ('32d4ed1842fdc44022ba82134bab36fd3783be9d26145630caa6acfd4d912e027447fbf06a617344', 5, 1, 'nApp', '[]', 0, '2021-03-29 01:57:24', '2021-03-29 01:57:24', '2022-03-29 01:57:24');
INSERT INTO `oauth_access_tokens` VALUES ('358d41eba084057451dd0cdf173a225e3004931d338e37b71cd75dc3f624945d39b91977fa4bcf26', 1, 1, 'nApp', '[]', 0, '2021-03-28 12:46:53', '2021-03-28 12:46:53', '2022-03-28 12:46:53');
INSERT INTO `oauth_access_tokens` VALUES ('35f59c8792888531bb6f98e65dcd9775e3f45abe1a833260ea2916b54ac774f5a65f1756ca57a8d5', 1, 1, 'nApp', '[]', 0, '2021-03-28 12:49:40', '2021-03-28 12:49:40', '2022-03-28 12:49:40');
INSERT INTO `oauth_access_tokens` VALUES ('39bbc48fa4de94b5911c693676e70d11aeed7809b54358882b864e80d371ccf5247f268672dc29bc', 8, 1, 'nApp', '[]', 0, '2021-03-29 02:09:33', '2021-03-29 02:09:33', '2022-03-29 02:09:33');
INSERT INTO `oauth_access_tokens` VALUES ('3bc037cd901ac5408ea31d8cefa8c19bba2b884cda49618f9639a56b6c94d34abdd091c296dd1708', 11, 1, 'nApp', '[]', 0, '2021-03-31 08:56:58', '2021-03-31 08:56:58', '2022-03-31 08:56:58');
INSERT INTO `oauth_access_tokens` VALUES ('508fc2448b508f4e7afd33d96fc366f649e98fb3a3f335bfe1ad0e23dc95dfccac7fbcb3738374ab', 20, 1, 'nApp', '[]', 1, '2021-03-31 10:25:30', '2021-03-31 10:25:30', '2022-03-31 10:25:30');
INSERT INTO `oauth_access_tokens` VALUES ('55e04dc0298ae32311dc4d8a6b9232f5baea4f00865c83ee4125fac9ba819bbc4cc5978cfd0d6c8e', 25, 1, 'nApp', '[]', 1, '2021-04-03 13:29:08', '2021-04-03 13:29:08', '2022-04-03 13:29:08');
INSERT INTO `oauth_access_tokens` VALUES ('5c2df6473e8fd4d19f0409c4e77a10f7244d8f93d915753c539f614fd7ac7edc20e7fbca4d1258bb', 1, 1, 'nApp', '[]', 0, '2021-03-28 12:43:07', '2021-03-28 12:43:07', '2022-03-28 12:43:07');
INSERT INTO `oauth_access_tokens` VALUES ('61be428301050fdc48e29d737f260f4a6ec4d18b653bbff8d2d3896c5c55a9447934b151caee7ea5', 1, 1, 'nApp', '[]', 0, '2021-03-28 11:24:22', '2021-03-28 11:24:22', '2022-03-28 11:24:22');
INSERT INTO `oauth_access_tokens` VALUES ('6724310709d0668a785a2bd9e73a5aeb8e54d6ac306bdd109ec3da84d27545d9de8be276cbf756c2', 22, 1, 'nApp', '[]', 1, '2021-03-31 21:25:08', '2021-03-31 21:25:08', '2022-03-31 21:25:08');
INSERT INTO `oauth_access_tokens` VALUES ('68900cf61b455365433954990a62d0270876947db5699038974b4c5ea69d97be8faf6315995948a7', 21, 1, 'nApp', '[]', 1, '2021-04-01 15:32:29', '2021-04-01 15:32:29', '2022-04-01 15:32:29');
INSERT INTO `oauth_access_tokens` VALUES ('6d21326c4f4f3c4b0f16845b451eb363873dcd3d6e098fc86568f69e31f960b663a4fdee65a297d7', 2, 1, 'nApp', '[]', 0, '2021-03-28 06:56:25', '2021-03-28 06:56:25', '2022-03-28 06:56:25');
INSERT INTO `oauth_access_tokens` VALUES ('7023fa8f0b6393ded844579889f1763fbce42117d7d677849b8741e11bfaacd442ec8c3a79595782', 6, 1, 'nApp', '[]', 0, '2021-03-29 02:05:55', '2021-03-29 02:05:55', '2022-03-29 02:05:55');
INSERT INTO `oauth_access_tokens` VALUES ('714bac5743af23ff0e7e0834face56ca0a419eb220d37d68966ac27391573a0f4890ac2a73f80c97', 1, 1, 'nApp', '[]', 0, '2021-03-29 06:35:33', '2021-03-29 06:35:33', '2022-03-29 06:35:33');
INSERT INTO `oauth_access_tokens` VALUES ('723517312c473bef81efbc792fd1630d2170b0d7bc4d9ea56cd215c18526e9f86b46bf070e81053d', 17, 1, 'nApp', '[]', 0, '2021-03-31 09:38:29', '2021-03-31 09:38:29', '2022-03-31 09:38:29');
INSERT INTO `oauth_access_tokens` VALUES ('87e2fc5d054b857704b00ee1439b2c682af7c564b8f2531a89771c7770bfa0c9d717e1603a2bdba9', 10, 1, 'nApp', '[]', 0, '2021-03-29 17:04:44', '2021-03-29 17:04:44', '2022-03-29 17:04:44');
INSERT INTO `oauth_access_tokens` VALUES ('894abc0bbd223f24f3ec6ffb48391cfabb6c1f4e76da2bceb1ed5209c0cd7a80ddf9fccc14716c27', 1, 1, 'nApp', '[]', 0, '2021-03-28 12:48:28', '2021-03-28 12:48:28', '2022-03-28 12:48:28');
INSERT INTO `oauth_access_tokens` VALUES ('8c0dac7fc259f472490e902a5170afb850358faf53b189464752e33bbb35f7025c95f5bbba91b1bc', 1, 1, 'nApp', '[]', 0, '2021-03-28 12:49:06', '2021-03-28 12:49:06', '2022-03-28 12:49:06');
INSERT INTO `oauth_access_tokens` VALUES ('95af76c5e2b2cf67ab8253e0af91a2f7dca5a1892cb424be339a547cd86fcd5ffb48adc07d10023b', 1, 1, 'nApp', '[]', 1, '2021-03-29 11:22:41', '2021-03-29 11:22:41', '2022-03-29 11:22:41');
INSERT INTO `oauth_access_tokens` VALUES ('982319c5b434cad2c06f02333e6b00b508c0f29f6ec16169d865bb230d05bfc213b6a1bd418998be', 9, 1, 'nApp', '[]', 0, '2021-03-29 02:16:39', '2021-03-29 02:16:39', '2022-03-29 02:16:39');
INSERT INTO `oauth_access_tokens` VALUES ('9c858f81a844a9d84cd50f3789eb8ba85d44285791301be269d3dc7abb3384a07595b330c3be888c', 20, 1, 'nApp', '[]', 1, '2021-03-31 10:24:30', '2021-03-31 10:24:30', '2022-03-31 10:24:30');
INSERT INTO `oauth_access_tokens` VALUES ('9d2be502679bc6abd47515a1871b7ae20e4f0a504dec6a0d4e097f20d3bfc5b1fa89c6a292a0c765', 7, 1, 'nApp', '[]', 0, '2021-03-29 02:08:51', '2021-03-29 02:08:51', '2022-03-29 02:08:51');
INSERT INTO `oauth_access_tokens` VALUES ('9ed7c939eb8cafb81aa52dd2050d4d119f5ccba8429c914ff260088706213aa7f8fffcf8e68db5b1', 21, 1, 'nApp', '[]', 1, '2021-04-06 10:01:40', '2021-04-06 10:01:40', '2022-04-06 10:01:40');
INSERT INTO `oauth_access_tokens` VALUES ('a5bc7d8e02b1eabb58c906de5269ac3563b48e79861711215ced805f079d9d12842e3b08d3bd2135', 1, 1, 'nApp', '[]', 0, '2021-03-31 09:59:16', '2021-03-31 09:59:16', '2022-03-31 09:59:16');
INSERT INTO `oauth_access_tokens` VALUES ('a73b9e32df286d6f6a33b1b3a916350cd59e05450ab669a03ff4435211f37b21229a0f5f2ea6d158', 1, 1, 'nApp', '[]', 0, '2021-03-28 12:03:17', '2021-03-28 12:03:17', '2022-03-28 12:03:17');
INSERT INTO `oauth_access_tokens` VALUES ('a9eedabe0a040dacfa784c3ad928eda29b375fbe4be6c5bd537859c8528d43eec53528bc69ad78c0', 4, 1, 'nApp', '[]', 0, '2021-03-28 21:42:07', '2021-03-28 21:42:07', '2022-03-28 21:42:07');
INSERT INTO `oauth_access_tokens` VALUES ('adc639ed47b559beae024333193b6c1f4799cd5b4f0b25208ad3a8927d28d91d5ff3e2aa3a18e887', 1, 1, 'nApp', '[]', 0, '2021-03-29 06:42:00', '2021-03-29 06:42:00', '2022-03-29 06:42:00');
INSERT INTO `oauth_access_tokens` VALUES ('b8ba08d718d132cc2c6343edc484c619c6ca897c66a00a663298e1c175205df7dd64677320e431da', 21, 1, 'nApp', '[]', 1, '2021-04-01 08:58:14', '2021-04-01 08:58:14', '2022-04-01 08:58:14');
INSERT INTO `oauth_access_tokens` VALUES ('bb4d5dcae736e7645ceac71b388a6be036b24ee6e7b802aa41d14d356ae684d3685689061efcd602', 21, 1, 'nApp', '[]', 0, '2021-03-31 14:43:14', '2021-03-31 14:43:14', '2022-03-31 14:43:14');
INSERT INTO `oauth_access_tokens` VALUES ('c56256616e177de4e512e8471a9fad5b71a182b35e98a4335ba580f707f5add960763549d7e5f4de', 1, 1, 'nApp', '[]', 0, '2021-03-28 12:45:25', '2021-03-28 12:45:25', '2022-03-28 12:45:25');
INSERT INTO `oauth_access_tokens` VALUES ('c8d06310110588a8510e0896017f9b58e8625fb846b5283ce8c299e1201650c963a40d1dae5fa991', 24, 1, 'nApp', '[]', 0, '2021-04-03 13:26:08', '2021-04-03 13:26:08', '2022-04-03 13:26:08');
INSERT INTO `oauth_access_tokens` VALUES ('ce12f8d382b37367edc6e4ad0bc37ae0573c4c5a3c655a0f46842e87b73e48a3666a20609a2952ba', 20, 1, 'nApp', '[]', 0, '2021-03-31 10:26:19', '2021-03-31 10:26:19', '2022-03-31 10:26:19');
INSERT INTO `oauth_access_tokens` VALUES ('d0106f60cc9c244407c30a52212043fae592268eba5beb9cb94fd425aa26c0970ba1eaf94791164d', 22, 1, 'nApp', '[]', 0, '2021-03-31 21:22:46', '2021-03-31 21:22:46', '2022-03-31 21:22:46');
INSERT INTO `oauth_access_tokens` VALUES ('d0ebe034ece25ef40688ada1073f280614d126c390973f9e870fc8b108020767c4b5bf8c56159f0f', 1, 1, 'nApp', '[]', 0, '2021-03-28 12:45:49', '2021-03-28 12:45:49', '2022-03-28 12:45:49');
INSERT INTO `oauth_access_tokens` VALUES ('d6c46f5373fbab944f6a5d9ceb7ef68041d79c44bfdb668eaea949f19d1de02afd922a7cac404169', 20, 1, 'nApp', '[]', 1, '2021-03-31 10:30:34', '2021-03-31 10:30:34', '2022-03-31 10:30:34');
INSERT INTO `oauth_access_tokens` VALUES ('de9988075cf372cde536086b85eaad474160fa51abc0fc97d0c60f34d10819f09a24f8ee32b76142', 20, 1, 'nApp', '[]', 1, '2021-03-31 13:25:57', '2021-03-31 13:25:57', '2022-03-31 13:25:57');
INSERT INTO `oauth_access_tokens` VALUES ('e009d8fbe02b9114e0865c369932e0eee4872ea34b9599e6b7543b0325c0f4cab3eb2291ea5d5952', 21, 1, 'nApp', '[]', 1, '2021-04-01 14:40:10', '2021-04-01 14:40:10', '2022-04-01 14:40:10');
INSERT INTO `oauth_access_tokens` VALUES ('e0862d86b7ee5e9a379cc380c0612e41d8b46847e2b874d08ad8b3d45e26bec7335fbb33ff0df436', 1, 1, 'nApp', '[]', 1, '2021-03-28 12:52:27', '2021-03-28 12:52:27', '2022-03-28 12:52:27');
INSERT INTO `oauth_access_tokens` VALUES ('e693dd9ef4e8794b3ca1c7292537d6b905cd812be09a3df20c9332f49f85973cc1011be8fb09e6ba', 20, 1, 'nApp', '[]', 0, '2021-03-31 10:37:20', '2021-03-31 10:37:20', '2022-03-31 10:37:20');
INSERT INTO `oauth_access_tokens` VALUES ('e787b73e9acfe76db080eb948bcf050e2bc5c3bc0c034af7732c7f1a4eaca92b6c5b8641b5407596', 21, 1, 'nApp', '[]', 1, '2021-04-06 19:55:23', '2021-04-06 19:55:23', '2022-04-06 19:55:23');
INSERT INTO `oauth_access_tokens` VALUES ('eaedb2a1302a6e194331e742355cb430d131dc3f0184c89334e5729c150db593d013483f6411a829', 1, 1, 'nApp', '[]', 1, '2021-03-28 21:10:22', '2021-03-28 21:10:22', '2022-03-28 21:10:22');
INSERT INTO `oauth_access_tokens` VALUES ('f2cf7dd34092d618be353c6d66701566831eb32c22b6da7bb0386a29e205b81a49d0392f3811f71f', 18, 1, 'nApp', '[]', 0, '2021-03-31 09:42:08', '2021-03-31 09:42:08', '2022-03-31 09:42:08');
INSERT INTO `oauth_access_tokens` VALUES ('f87835bb36d1152915f3952424396cf1f6fd82e6c2e3ba0108f01308439fb3f90f2c3943c78fac51', 23, 1, 'nApp', '[]', 1, '2021-03-31 21:50:21', '2021-03-31 21:50:21', '2022-03-31 21:50:21');
INSERT INTO `oauth_access_tokens` VALUES ('fad04959059ca2e9fa11824cab2e7eaa9a834804e8e59d9081fded067ea29cea8d018c1707fe6aeb', 10, 1, 'nApp', '[]', 0, '2021-03-29 17:05:12', '2021-03-29 17:05:12', '2022-03-29 17:05:12');
INSERT INTO `oauth_access_tokens` VALUES ('fbee55155f2df98ff65f93d6f383268f6df0d15033ff6f81b22c95eab691be7b6011870f8497e093', 21, 1, 'nApp', '[]', 1, '2021-03-31 14:44:03', '2021-03-31 14:44:03', '2022-03-31 14:44:03');
INSERT INTO `oauth_access_tokens` VALUES ('ff045fe3841b9af123bda1d0cb3dddf209f3f1d3513f31efccc83bca68a18eba0c7769ef839c384e', 16, 1, 'nApp', '[]', 0, '2021-03-31 09:29:10', '2021-03-31 09:29:10', '2022-03-31 09:29:10');
INSERT INTO `oauth_access_tokens` VALUES ('ff05a46d2a4caef34509d13d14d4cc4f53089acbdd9103124134d2037a64f9342719ef8f54ba80d4', 1, 1, 'nApp', '[]', 1, '2021-03-29 06:46:02', '2021-03-29 06:46:02', '2022-03-29 06:46:02');
COMMIT;

-- ----------------------------
-- Table structure for oauth_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `scopes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of oauth_auth_codes
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for oauth_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `redirect` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of oauth_clients
-- ----------------------------
BEGIN;
INSERT INTO `oauth_clients` VALUES (1, NULL, 'sipd Personal Access Client', '81UdW6PgUXbk8xi4ZCqMbmNLq2nq38gO6aUgFFxW', NULL, 'http://localhost', 1, 0, 0, '2021-03-27 20:47:07', '2021-03-27 20:47:07');
INSERT INTO `oauth_clients` VALUES (2, NULL, 'sipd Password Grant Client', '59w8iptku0idl0YJmyuocUiZ5Gxcz88Or9sPJdtR', 'users', 'http://localhost', 0, 1, 0, '2021-03-27 20:47:07', '2021-03-27 20:47:07');
COMMIT;

-- ----------------------------
-- Table structure for oauth_personal_access_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of oauth_personal_access_clients
-- ----------------------------
BEGIN;
INSERT INTO `oauth_personal_access_clients` VALUES (1, 1, '2021-03-27 20:47:07', '2021-03-27 20:47:07');
COMMIT;

-- ----------------------------
-- Table structure for oauth_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of oauth_refresh_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for organizations
-- ----------------------------
DROP TABLE IF EXISTS `organizations`;
CREATE TABLE `organizations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hierarchy` int DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`,`slug`) USING BTREE,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of organizations
-- ----------------------------
BEGIN;
INSERT INTO `organizations` VALUES (1, NULL, '2021-05-31 08:32:03', 'Badan Kepegawaian Daerah', 'badan-kepegawaian-daerah', 1, 'logo-banten.png', 'Badan Kepegawaian Daerah merupakan perangkat daerah di Provinsi Jawa Barat yang mengurusi bidang kepegawaian, pendidikan dan pelatihan untuk Banten.');
INSERT INTO `organizations` VALUES (2, NULL, NULL, 'Badan Kesatuan Bangsa Dan Politik', 'badan-kesatuan-bangsa-dan-politik', 2, 'logo-banten.png', 'Badan Kesatuan Bangsa Dan Politik merupakan perangkat daerah di Provinsi Jawa Barat yang mempunyai tugas pokok melaksanakan urusan pemerintahan bidang ideologi dan wawasan kebangsaan, dan bidang politik dalam negeri untuk Jawa Barat.');
INSERT INTO `organizations` VALUES (3, NULL, NULL, 'Badan Penanggulangan Bencana Daerah', 'badan-penanggulangan-bencana-daerah', 3, 'logo-banten.png', 'Badan Penanggulangan Bencana Daerah merupakan perangkat daerah di Provinsi Jawa Barat yang mempunyai tugas pokok melaksanakan urusan penanggulangan bencana, dan pengkoordinasian pelaksanaan kegiatan penanggulangan bencana untuk Jawa Barat.');
INSERT INTO `organizations` VALUES (4, NULL, NULL, 'Badan Pendapatan Daerah', 'badan-pendapatan-daerah', 4, 'logo-banten.png', 'Badan Pendapatan Daerah merupakan salah satu organisasi perangkat daerah provinsi Jawa Barat yang bertugas melaksanakan urusan pemerintahan daerah di Bidang Pendapatan Daerah berdasarkan atas azas otonomi dan tugas pembantuan.');
INSERT INTO `organizations` VALUES (6, NULL, NULL, 'Badan Pengelolaan Keuangan Dan Aset Daerah', 'badan-pengelolaan-keuangan-dan-aset-daerah', 6, 'logo-banten.png', 'Badan Pengelolaan Keuangan Dan Aset Daerah merupakan perangkat daerah di Provinsi Jawa Barat yang mempunyai tugas pokok melaksanakan urusan pemerintahan bidang keuangan, meliputi aspek pengelolaan keuangan dan pengelolaan aset daerah untuk Jawa Barat.');
INSERT INTO `organizations` VALUES (7, NULL, NULL, 'Badan Pengembangan Sumber Daya Manusia', 'badan-pengembangan-sumber-daya-manusia', 7, 'logo-banten.png', 'Badan Pengembangan Sumber Daya Manusia merupakan perangkat daerah di Provinsi Jawa Barat yang mempunyai tugas pokok melaksanakan urusan pemerintahan bidang pengembangan sumber daya manusia, sertifikasi dan pengembangan kompetensi untuk Jawa Barat.');
INSERT INTO `organizations` VALUES (9, NULL, '2021-05-31 01:03:38', 'Badan Perencanaan Pembangunan Daerah', 'badan-perencanaan-pembangunan-daerah', 9, 'logo-banten.png', '<p>asndbasldaslkj</p>');
INSERT INTO `organizations` VALUES (11, NULL, NULL, 'Dinas Energi Dan Sumber Daya Mineral', 'dinas-energi-dan-sumber-daya-mineral', 10, 'logo-banten.png', 'Dinas Energi dan Sumber Daya Mineral merupakan perangkat daerah di Provinsi Banten yang mempunyai tugas pokok melaksanakan urusan pemerintahan bidang energi dan sumber daya mineral, meliputi air tanah, energi, ketenagalistrikan, dan pertambangan.');
INSERT INTO `organizations` VALUES (12, NULL, '2021-06-14 11:38:35', 'Dinas Kelautan Dan Perikanan', 'dinas-kelautan-dan-perikanan', 11, 'logo-banten.png', 'Dinas Kelautan dan Perikanan memiliki tugas pokok melaksanakan urusan pemerintahan di bidang kelautan dan perikanan, perikanan tangkap, perikanan budidaya, serta pengolahan dan pemasaran hasil perikanan yang menjadi kewenangan provinsi.');
INSERT INTO `organizations` VALUES (13, NULL, NULL, 'Dinas Kesehatan', 'dinas-kesehatan', 13, 'logo-banten.png', 'Dinas Kesehatan merupakan perangkat daerah di Provinsi Banten yang mempunyai tugas pokok melaksanakan urusan pemerintahan bidang kesehatan meliputi kebijakan, pelayanan kesehatan, penyehatan lingkungan, pencegahan penyakit, dan sumber daya kesehatan.');
INSERT INTO `organizations` VALUES (14, NULL, NULL, 'Dinas Ketahanan Pangan', 'dinas-ketahanan-pangan', 14, 'logo-banten.png', 'Dinas Ketahanan Pangan merupakan perangkat daerah di Provinsi Banten yang mempunyai tugas pokok melaksanakan urusan pemerintahan bidang pangan dan peternakan meliputi ketersediaan, distribusi, konsumsi, dan produksi peternakan.');
INSERT INTO `organizations` VALUES (15, NULL, NULL, 'Dinas Komunikasi Dan Informatika', 'dinas-komunikasi-dan-informatika', 15, 'logo-banten.png', 'Dinas Komunikasi dan Informatika merupakan perangkat daerah di Provinsi Banten yang mempunyai tugas pokok melaksanakan urusan pemerintahan bidang komunikasi, informatika dan hubungan masyarakat berdasarkan azas otonomi dan pembantuan.');
INSERT INTO `organizations` VALUES (16, NULL, NULL, 'Dinas Koperasi Dan Usaha Kecil', 'dinas-koperasi-dan-usaha-kecil', 16, 'logo-banten.png', 'Dinas Koperasi dan UMKM merupakan perangkat daerah di Provinsi Banten yang mempunyai tugas pokok melaksanakan urusan pemerintahan bidang koperasi dan usaha kecil meliputi izin usaha simpan pinjam, pemberdayaan dan pengembangan usaha kecil.');
INSERT INTO `organizations` VALUES (17, NULL, '2021-06-10 13:21:07', 'Dinas Lingkungan Hidup Dan Kehutanan', 'dinas-lingkungan-hidup-dan-kehutanan', 17, 'logo-banten.png', 'Dinas Lingkungan Hidup dan Kehutanan merupakan perangkat daerah di Provinsi Banten yang mempunyai tugas pokok melaksanankan tata lingkungan, pengendalian pencemaran lingkungan, konservasi dan pengendalian perubahan iklim serta penataaan hukum lingkungan.');
INSERT INTO `organizations` VALUES (18, NULL, NULL, 'Dinas Pariwisata Dan Kebudayaan', 'dinas-pariwisata-dan-kebudayaan', 18, 'logo-banten.png', 'Dinas Pariwisata dan Kebudayaan merupakan perangkat daerah di Provinsi Banten yang mengurusi urusan pemerintah bidang pariwisata dan bidang kebudayaan.');
INSERT INTO `organizations` VALUES (19, NULL, NULL, 'Dinas Pekerjaan Umum', 'dinas-pekerjaan-umum', 19, 'logo-banten.png', 'Dinas Pekerjaan Umum merupakan perangkat daerah di Provinsi Banten yang mempunyai tugas pokok melaksanakan urusan bidang pekerjaan umum.');
INSERT INTO `organizations` VALUES (20, NULL, NULL, 'Dinas Pemberdayaan Masyarakat Dan Desa', 'dinas-pemberdayaan-masyarakat-dan-desa', 20, 'logo-banten.png', 'Dinas Pemberdayaan Masyarakat dan Desa merupakan perangkat daerah di Provinsi Banten yang mengurusi urusan pemerintah bidang pemberdayaan masyarakat dan desa.');
INSERT INTO `organizations` VALUES (21, NULL, NULL, 'Dinas Pemberdayaan Perempuan Perlindungan Anak dan Keluarga Berencana ', 'dinas-pemberdayaan-perempuan-perlindungan-anak-dan-keluarga-berencana-', 21, 'logo-banten.png', 'Dinas Pemberdayaan Perempuan, Perlindungan Anak Dan Keluarga Berencana merupakan perangkat daerah di Provinsi Banten yang mengurusi urusan pemerintah bidang pemberdayaan perempuan, perlindungan anak, pengendalian penduduk dan keluarga berencana.');
INSERT INTO `organizations` VALUES (22, NULL, NULL, 'Dinas Pemuda Dan Olahraga', 'dinas-pemuda-dan-olahraga', 22, 'logo-banten.png', 'Dinas Pemuda dan Olahraga merupakan perangkat daerah di Provinsi Banten yang mengurusi urusan pemerintah bidang olahraga dan pemuda.');
INSERT INTO `organizations` VALUES (23, NULL, NULL, 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu', 'dinas-penanaman-modal-dan-pelayanan-terpadu-satu-pintu', 23, 'logo-banten.png', 'Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu merupakan perangkat daerah di Provinsi Banten yang mengurusi urusan pemerintah bidang penanaman modal dan pelayanan terpadu satu pintu.');
INSERT INTO `organizations` VALUES (24, NULL, NULL, 'Dinas Pendidikan', 'dinas-pendidikan', 24, 'logo-banten.png', 'Dinas Pendidikan merupakan perangkat daerah di Provinsi Banten yang mengurusi urusan pemerintah bidang pendidikan.');
INSERT INTO `organizations` VALUES (25, NULL, NULL, 'Dinas Perhubungan', 'dinas-perhubungan', 25, 'logo-banten.png', 'Dinas Perhubungan merupakan perangkat daerah di Provinsi Banten yang mengurusi urusan pemerintah bidang perhubungan.');
INSERT INTO `organizations` VALUES (26, NULL, NULL, 'Dinas Perindustrian Dan Perdagangan', 'dinas-perindustrian-dan-perdagangan', 26, 'logo-banten.png', 'Dinas Perindustrian Dan Perdagangan merupakan perangkat daerah di Provinsi Banten yang mengurusi urusan pemerintah bidang perindustrian dan perdagangan.');
INSERT INTO `organizations` VALUES (27, NULL, NULL, 'Dinas Perpustakaan Dan Kearsipan', 'dinas-perpustakaan-dan-kearsipan', 27, 'logo-banten.png', 'Dinas Perpustakaan Dan Kearsipan Daerah merupakan perangkat daerah di Provinsi Banten yang mengurusi urusan pemerintah bidang perpustakaan dan bidang kearsipan.');
INSERT INTO `organizations` VALUES (28, NULL, NULL, 'Dinas Pertanian', 'dinas-pertanian', 28, 'logo-banten.png', 'Dinas Pertanian merupakan perangkat daerah di Provinsi Banten yang mengurusi urusan pemerintah bidang pertanian.');
INSERT INTO `organizations` VALUES (29, NULL, NULL, 'Dinas Perumahan Rakyat dan Kawasan Permukiman', 'dinas-perumahan-rakyat-dan-kawasan-permukiman', 29, 'logo-banten.png', 'Dinas Perumahan Dan Permukiman merupakan perangkat daerah di Provinsi Banten yang mempunyai tugas pokok melaksanakan urusan bidang pertanahan, meliputi perumahan, infrastruktur permukiman dan kawasan permukiman.');
INSERT INTO `organizations` VALUES (30, NULL, NULL, 'Dinas Sosial', 'dinas-sosial', 30, 'logo-banten.png', 'Dinas Sosial merupakan perangkat daerah di Provinsi Banten yang mempunyai tugas pokok merumuskan dan mengurusi kebijakan operasional di bidang Kesejahteraan Sosial.');
INSERT INTO `organizations` VALUES (31, NULL, NULL, 'Dinas Tenaga Kerja Dan Transmigrasi', 'dinas-tenaga-kerja-dan-transmigrasi', 31, 'logo-banten.png', 'Dinas Tenaga Kerja Dan Transmigrasi merupakan perangkat daerah di Provinsi Banten yang mempunyai tugas pokok melakukan pengaturan dan koordinasi perencanaan tenaga kerja, perlindungan ketenagakerjaan dan ketransmigrasian.');
INSERT INTO `organizations` VALUES (32, NULL, NULL, 'inspektorat', 'inspektorat', 32, 'logo-banten.png', 'Inpektorat merupakan perangkat daerah di Provinsi Banten yang mempunyai tugas pokok melakukan pengawas terhadap pelaksanaan urusan pemerintahan di daerah, pelaksanaan pembinaan atas penyelengggaraan pemerintah desa dan pelaksanaan urusan pemerintah desa');
INSERT INTO `organizations` VALUES (33, NULL, NULL, 'Satuan Polisi Pamong Praja', 'satuan-polisi-pamong-praja', 33, 'logo-banten.png', 'Satuan Polisi Pamong Praja merupakan perangkat daerah di Provinsi Banten yang mempunyai tugas pokok menegakkan peraturan perundang-undangan Daerah, ketertiban umum, ketenteraman masyarakat, sumberdaya aparatur dan perlindungan masyarakat.');
INSERT INTO `organizations` VALUES (34, NULL, NULL, 'Sekretariat Daerah', 'sekretariat-daerah', 34, 'logo-banten.png', 'Sekretariat Daerah merupakan perangkat daerah di Provinsi Banten yang mempunyai tugas pokok merumuskan kebijakan umum Pemerintah Daerah Provinsi dan pelayanan administratif');
INSERT INTO `organizations` VALUES (35, NULL, NULL, 'Sekretariat Dprd', 'sekretariat-dprd', 35, 'logo-banten.png', 'DPRD merupakan perangkat daerah di Provinsi Banten yang mempunyai tugas pokok menyediakan serta mengkoordinasikan tenaga ahli apabila diperlukan oleh DPRD sesuai dengan kemampuan keuangan daerah');
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  CONSTRAINT `fk_pasres_user` FOREIGN KEY (`email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for pemeriksaans
-- ----------------------------
DROP TABLE IF EXISTS `pemeriksaans`;
CREATE TABLE `pemeriksaans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `no_surat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jml_lampiran` int DEFAULT NULL,
  `perihal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_spt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_spt` date DEFAULT NULL,
  `sifat` bigint DEFAULT NULL,
  `perusahaan` bigint DEFAULT NULL,
  `jns_pemeriksaan` bigint DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of pemeriksaans
-- ----------------------------
BEGIN;
INSERT INTO `pemeriksaans` VALUES (7, '2021-12-23 01:36:02', '2021-12-23 06:37:55', '001/008/DTKT/WASNAKER/12/2021', 2, '12', '1232', '2021-12-08', 1, 3, 1, 1, 1);
COMMIT;

-- ----------------------------
-- Table structure for pengawasans
-- ----------------------------
DROP TABLE IF EXISTS `pengawasans`;
CREATE TABLE `pengawasans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pemeriksa` bigint DEFAULT NULL,
  `tgl_pemeriksaan` date DEFAULT NULL,
  `perusahaan` bigint DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of pengawasans
-- ----------------------------
BEGIN;
INSERT INTO `pengawasans` VALUES (1, '2021-12-23 02:49:27', '2021-12-23 02:49:37', 1, '2021-12-10', 1, 1, 1);
COMMIT;

-- ----------------------------
-- Table structure for perusahaans
-- ----------------------------
DROP TABLE IF EXISTS `perusahaans`;
CREATE TABLE `perusahaans` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of perusahaans
-- ----------------------------
BEGIN;
INSERT INTO `perusahaans` VALUES (1, 'PT Maju Mundur Tbk', NULL, NULL);
INSERT INTO `perusahaans` VALUES (2, 'PT Maju Kena Mundur Kena', NULL, NULL);
INSERT INTO `perusahaans` VALUES (3, 'PT Timbul Jaya Tbk', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for provinsis
-- ----------------------------
DROP TABLE IF EXISTS `provinsis`;
CREATE TABLE `provinsis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of provinsis
-- ----------------------------
BEGIN;
INSERT INTO `provinsis` VALUES (1, NULL, '2021-04-10 23:49:49', '1', 'SERANG');
INSERT INTO `provinsis` VALUES (4, '2021-03-13 17:22:05', '2021-04-10 23:50:09', '2', 'CIPOCOK JAYA');
INSERT INTO `provinsis` VALUES (5, '2021-04-10 23:50:20', '2021-04-10 23:50:20', '3', 'KASEMEN');
INSERT INTO `provinsis` VALUES (6, '2021-04-10 23:50:37', '2021-04-10 23:50:37', '4', 'CURUG');
INSERT INTO `provinsis` VALUES (7, '2021-04-10 23:50:51', '2021-04-10 23:50:51', '5', 'TAKTAKAN');
INSERT INTO `provinsis` VALUES (8, '2021-04-10 23:51:20', '2021-04-10 23:51:20', '6', 'WALANTAKA');
COMMIT;

-- ----------------------------
-- Table structure for role_module
-- ----------------------------
DROP TABLE IF EXISTS `role_module`;
CREATE TABLE `role_module` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `module_id` bigint unsigned NOT NULL,
  `acc_view` tinyint(1) NOT NULL,
  `acc_create` tinyint(1) NOT NULL,
  `acc_edit` tinyint(1) NOT NULL,
  `acc_delete` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rel_role_module` (`module_id`),
  KEY `fk_rel_role_role` (`role_id`),
  CONSTRAINT `fk_rel_role_module` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`),
  CONSTRAINT `fk_rel_role_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=243 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_module
-- ----------------------------
BEGIN;
INSERT INTO `role_module` VALUES (19, 1, 1, 1, 1, 1, 1, '2021-02-27 19:37:09', '2021-02-27 19:37:09');
INSERT INTO `role_module` VALUES (20, 1, 5, 1, 1, 1, 1, '2021-02-27 19:37:09', '2021-02-27 19:37:09');
INSERT INTO `role_module` VALUES (21, 1, 6, 1, 1, 1, 1, '2021-02-27 19:37:09', '2021-02-27 19:37:09');
INSERT INTO `role_module` VALUES (22, 1, 7, 1, 1, 1, 1, '2021-02-27 19:37:09', '2021-02-27 19:37:09');
INSERT INTO `role_module` VALUES (23, 1, 8, 1, 1, 1, 1, '2021-02-27 19:37:09', '2021-02-27 19:37:09');
INSERT INTO `role_module` VALUES (24, 1, 9, 1, 1, 1, 1, '2021-02-27 19:37:09', '2021-02-27 19:37:09');
INSERT INTO `role_module` VALUES (25, 1, 10, 1, 1, 1, 1, '2021-02-27 19:37:09', '2021-02-27 19:37:09');
INSERT INTO `role_module` VALUES (34, 1, 19, 1, 1, 1, 1, '2021-02-27 19:37:09', '2021-02-27 19:37:09');
INSERT INTO `role_module` VALUES (59, 1, 29, 1, 1, 1, 1, '2021-05-30 15:44:59', '2021-05-30 15:44:59');
INSERT INTO `role_module` VALUES (60, 1, 30, 1, 1, 1, 1, '2021-05-30 23:41:28', '2021-05-30 23:41:28');
INSERT INTO `role_module` VALUES (61, 1, 31, 1, 1, 1, 1, '2021-05-31 00:47:01', '2021-05-31 00:47:01');
INSERT INTO `role_module` VALUES (62, 1, 32, 1, 1, 1, 1, '2021-05-31 14:07:52', '2021-05-31 14:07:52');
INSERT INTO `role_module` VALUES (63, 1, 33, 0, 0, 0, 0, '2021-05-31 14:07:52', '2021-05-31 14:07:52');
INSERT INTO `role_module` VALUES (78, 34, 1, 0, 0, 0, 0, '2021-12-21 13:47:27', '2021-12-21 13:47:27');
INSERT INTO `role_module` VALUES (79, 34, 5, 0, 0, 0, 0, '2021-12-21 13:47:27', '2021-12-21 13:47:27');
INSERT INTO `role_module` VALUES (80, 34, 6, 0, 0, 0, 0, '2021-12-21 13:47:27', '2021-12-21 13:47:27');
INSERT INTO `role_module` VALUES (81, 34, 7, 0, 0, 0, 0, '2021-12-21 13:47:27', '2021-12-21 13:47:27');
INSERT INTO `role_module` VALUES (82, 34, 8, 0, 0, 0, 0, '2021-12-21 13:47:27', '2021-12-21 13:47:27');
INSERT INTO `role_module` VALUES (83, 34, 9, 0, 0, 0, 0, '2021-12-21 13:47:27', '2021-12-21 13:47:27');
INSERT INTO `role_module` VALUES (84, 34, 10, 0, 0, 0, 0, '2021-12-21 13:47:27', '2021-12-21 13:47:27');
INSERT INTO `role_module` VALUES (85, 34, 19, 1, 1, 1, 1, '2021-12-21 13:47:27', '2021-12-21 13:47:27');
INSERT INTO `role_module` VALUES (86, 34, 29, 0, 0, 0, 0, '2021-12-21 13:47:27', '2021-12-21 13:47:27');
INSERT INTO `role_module` VALUES (87, 34, 30, 0, 0, 0, 0, '2021-12-21 13:47:27', '2021-12-21 13:47:27');
INSERT INTO `role_module` VALUES (88, 34, 31, 0, 0, 0, 0, '2021-12-21 13:47:27', '2021-12-21 13:47:27');
INSERT INTO `role_module` VALUES (89, 34, 32, 0, 0, 0, 0, '2021-12-21 13:47:27', '2021-12-21 13:47:27');
INSERT INTO `role_module` VALUES (90, 34, 33, 0, 0, 0, 0, '2021-12-21 13:47:27', '2021-12-21 13:47:27');
INSERT INTO `role_module` VALUES (92, 1, 35, 1, 1, 1, 1, '2021-12-21 16:51:08', '2021-12-21 16:51:08');
INSERT INTO `role_module` VALUES (93, 1, 36, 1, 1, 1, 1, '2021-12-21 19:56:11', '2021-12-21 19:56:11');
INSERT INTO `role_module` VALUES (94, 1, 37, 1, 1, 1, 1, '2021-12-21 19:56:11', '2021-12-21 19:56:11');
INSERT INTO `role_module` VALUES (95, 1, 38, 1, 1, 1, 1, '2021-12-21 19:56:11', '2021-12-21 19:56:11');
INSERT INTO `role_module` VALUES (96, 1, 39, 1, 1, 1, 1, '2021-12-21 19:56:11', '2021-12-21 19:56:11');
INSERT INTO `role_module` VALUES (97, 1, 40, 1, 1, 1, 1, '2021-12-21 19:56:11', '2021-12-21 19:56:11');
INSERT INTO `role_module` VALUES (98, 1, 41, 1, 1, 1, 1, '2021-12-21 19:56:11', '2021-12-21 19:56:11');
INSERT INTO `role_module` VALUES (99, 1, 42, 1, 1, 1, 1, '2021-12-21 19:56:11', '2021-12-21 19:56:11');
INSERT INTO `role_module` VALUES (100, 1, 43, 1, 1, 1, 1, '2021-12-21 19:56:11', '2021-12-21 19:56:11');
INSERT INTO `role_module` VALUES (101, 1, 44, 1, 1, 1, 1, '2021-12-21 19:56:11', '2021-12-21 19:56:11');
INSERT INTO `role_module` VALUES (102, 1, 45, 1, 1, 1, 1, '2021-12-21 19:56:11', '2021-12-21 19:56:11');
INSERT INTO `role_module` VALUES (103, 1, 46, 1, 1, 1, 1, '2021-12-23 02:12:24', '2021-12-23 02:12:24');
INSERT INTO `role_module` VALUES (104, 1, 47, 1, 1, 1, 1, '2021-12-23 02:12:24', '2021-12-23 02:12:24');
INSERT INTO `role_module` VALUES (105, 1, 48, 1, 1, 1, 1, '2021-12-23 02:58:50', '2021-12-23 02:58:50');
INSERT INTO `role_module` VALUES (106, 1, 49, 1, 1, 1, 1, '2021-12-23 03:01:51', '2021-12-23 03:01:51');
INSERT INTO `role_module` VALUES (107, 1, 50, 1, 1, 1, 1, '2021-12-26 12:30:20', '2021-12-26 12:30:20');
INSERT INTO `role_module` VALUES (108, 1, 51, 1, 1, 1, 1, '2022-01-07 09:09:57', '2022-01-07 09:09:57');
INSERT INTO `role_module` VALUES (127, 35, 1, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (128, 35, 5, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (129, 35, 6, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (130, 35, 7, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (131, 35, 8, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (132, 35, 9, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (133, 35, 10, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (134, 35, 19, 1, 1, 1, 1, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (135, 35, 29, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (136, 35, 30, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (137, 35, 31, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (138, 35, 32, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (139, 35, 33, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (141, 35, 35, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (142, 35, 36, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (143, 35, 37, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (144, 35, 38, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (145, 35, 39, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (146, 35, 40, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (147, 35, 41, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (148, 35, 42, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (149, 35, 43, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (150, 35, 44, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (151, 35, 45, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (152, 35, 46, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (153, 35, 47, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (154, 35, 48, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (155, 35, 49, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (156, 35, 50, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (157, 35, 51, 0, 0, 0, 0, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (158, 35, 52, 1, 1, 1, 1, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (159, 35, 53, 1, 1, 1, 1, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (160, 35, 54, 1, 1, 1, 1, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (161, 35, 55, 1, 1, 1, 1, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (162, 35, 56, 1, 1, 1, 1, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (163, 35, 57, 1, 1, 1, 1, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (164, 35, 58, 1, 1, 1, 1, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (165, 35, 59, 1, 1, 1, 1, '2022-01-12 02:44:45', '2022-01-12 02:44:45');
INSERT INTO `role_module` VALUES (166, 1, 52, 1, 1, 1, 1, '2022-01-16 20:38:49', '2022-01-16 20:38:49');
INSERT INTO `role_module` VALUES (167, 1, 53, 1, 1, 1, 1, '2022-01-16 20:38:49', '2022-01-16 20:38:49');
INSERT INTO `role_module` VALUES (168, 1, 54, 1, 1, 1, 1, '2022-01-16 20:38:49', '2022-01-16 20:38:49');
INSERT INTO `role_module` VALUES (169, 1, 55, 1, 1, 1, 1, '2022-01-16 20:38:49', '2022-01-16 20:38:49');
INSERT INTO `role_module` VALUES (170, 1, 56, 1, 1, 1, 1, '2022-01-16 20:38:49', '2022-01-16 20:38:49');
INSERT INTO `role_module` VALUES (171, 1, 57, 1, 1, 1, 1, '2022-01-16 20:38:49', '2022-01-16 20:38:49');
INSERT INTO `role_module` VALUES (172, 1, 58, 1, 1, 1, 1, '2022-01-16 20:38:49', '2022-01-16 20:38:49');
INSERT INTO `role_module` VALUES (173, 1, 59, 1, 1, 1, 1, '2022-01-16 20:38:49', '2022-01-16 20:38:49');
INSERT INTO `role_module` VALUES (174, 34, 35, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (175, 34, 36, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (176, 34, 37, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (177, 34, 38, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (178, 34, 39, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (179, 34, 40, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (180, 34, 41, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (181, 34, 42, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (182, 34, 43, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (183, 34, 44, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (184, 34, 45, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (185, 34, 46, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (186, 34, 47, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (187, 34, 48, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (188, 34, 49, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (189, 34, 50, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (190, 34, 51, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (191, 34, 52, 1, 1, 1, 1, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (192, 34, 53, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (193, 34, 54, 1, 1, 1, 1, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (194, 34, 55, 1, 1, 1, 1, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (195, 34, 56, 0, 0, 0, 0, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (196, 34, 57, 1, 1, 1, 1, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (197, 34, 58, 1, 1, 1, 1, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (198, 34, 59, 1, 1, 1, 1, '2022-01-16 22:59:30', '2022-01-16 22:59:30');
INSERT INTO `role_module` VALUES (199, 34, 60, 1, 1, 1, 1, '2022-01-17 13:39:08', '2022-01-17 13:39:08');
INSERT INTO `role_module` VALUES (200, 34, 61, 1, 1, 1, 1, '2022-01-20 07:42:47', '2022-01-20 07:42:47');
INSERT INTO `role_module` VALUES (201, 34, 62, 1, 1, 1, 1, '2022-01-20 07:52:29', '2022-01-20 07:52:29');
INSERT INTO `role_module` VALUES (202, 37, 1, 1, 1, 1, 1, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (203, 37, 5, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (204, 37, 6, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (205, 37, 7, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (206, 37, 8, 1, 1, 1, 1, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (207, 37, 9, 1, 1, 1, 1, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (208, 37, 10, 1, 1, 1, 1, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (209, 37, 19, 1, 1, 1, 1, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (210, 37, 29, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (211, 37, 30, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (212, 37, 31, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (213, 37, 32, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (214, 37, 33, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (215, 37, 35, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (216, 37, 36, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (217, 37, 37, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (218, 37, 38, 1, 1, 1, 1, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (219, 37, 39, 1, 1, 1, 1, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (220, 37, 40, 1, 1, 1, 1, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (221, 37, 41, 1, 1, 1, 1, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (222, 37, 42, 1, 1, 1, 1, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (223, 37, 43, 1, 1, 1, 1, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (224, 37, 44, 1, 1, 1, 1, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (225, 37, 45, 1, 1, 1, 1, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (226, 37, 46, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (227, 37, 47, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (228, 37, 48, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (229, 37, 49, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (230, 37, 50, 1, 1, 1, 1, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (231, 37, 51, 1, 1, 1, 1, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (232, 37, 52, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (233, 37, 53, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (234, 37, 54, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (235, 37, 55, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (236, 37, 56, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (237, 37, 57, 1, 1, 1, 1, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (238, 37, 58, 1, 1, 1, 1, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (239, 37, 59, 1, 1, 1, 1, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (240, 37, 60, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (241, 37, 61, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
INSERT INTO `role_module` VALUES (242, 37, 62, 0, 0, 0, 0, '2022-01-23 15:04:10', '2022-01-23 15:04:10');
COMMIT;

-- ----------------------------
-- Table structure for role_opd
-- ----------------------------
DROP TABLE IF EXISTS `role_opd`;
CREATE TABLE `role_opd` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned NOT NULL,
  `opd_id` int unsigned NOT NULL,
  `acc_view` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_module_role_id_foreign` (`role_id`),
  KEY `role_module_module_id_foreign` (`opd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_opd
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for role_provinsi
-- ----------------------------
DROP TABLE IF EXISTS `role_provinsi`;
CREATE TABLE `role_provinsi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `provinsi_id` bigint unsigned NOT NULL,
  `acc_view` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_module_role_id_foreign` (`role_id`),
  KEY `role_module_module_id_foreign` (`provinsi_id`),
  CONSTRAINT `fk_rel_ole_prov` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_rel_role_role_x` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_provinsi
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for role_sektor
-- ----------------------------
DROP TABLE IF EXISTS `role_sektor`;
CREATE TABLE `role_sektor` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned NOT NULL,
  `sektor_id` int unsigned NOT NULL,
  `acc_view` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_module_role_id_foreign` (`role_id`),
  KEY `role_module_module_id_foreign` (`sektor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_sektor
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for role_suburusan
-- ----------------------------
DROP TABLE IF EXISTS `role_suburusan`;
CREATE TABLE `role_suburusan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned NOT NULL,
  `suburusan_id` int unsigned NOT NULL,
  `acc_view` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_module_role_id_foreign` (`role_id`),
  KEY `role_module_module_id_foreign` (`suburusan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_suburusan
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for role_urusan
-- ----------------------------
DROP TABLE IF EXISTS `role_urusan`;
CREATE TABLE `role_urusan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `urusan_id` bigint unsigned NOT NULL,
  `acc_view` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_module_role_id_foreign` (`role_id`),
  KEY `role_module_module_id_foreign` (`urusan_id`),
  CONSTRAINT `fk_rel_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_rel_role_urusan` FOREIGN KEY (`urusan_id`) REFERENCES `urusans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_urusan
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES (1, 'SUPERADMIN', 'SUPERADMIN', '2021-02-22 01:34:51', '2021-02-27 18:46:00', 'SUPERADMIN');
INSERT INTO `roles` VALUES (34, 'PENGAWAS', 'PENGAWAS', '2021-12-21 13:47:09', '2021-12-21 13:47:09', 'PENGAWAS');
INSERT INTO `roles` VALUES (35, 'PERUSAHAAN', 'PERUSAHAAN', '2022-01-12 02:31:22', '2022-01-23 15:00:35', 'PERUSAHAAN');
INSERT INTO `roles` VALUES (37, 'ADMIN', 'ADMIN', '2022-01-23 15:03:06', '2022-01-23 15:03:06', 'ADMIN');
COMMIT;

-- ----------------------------
-- Table structure for satuans
-- ----------------------------
DROP TABLE IF EXISTS `satuans`;
CREATE TABLE `satuans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of satuans
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for sektorals
-- ----------------------------
DROP TABLE IF EXISTS `sektorals`;
CREATE TABLE `sektorals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provinsi_id` bigint unsigned DEFAULT NULL,
  `bidang_id` bigint unsigned DEFAULT NULL,
  `urusan_id` bigint unsigned DEFAULT NULL,
  `suburusan_id` bigint unsigned DEFAULT NULL,
  `tahun` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sektor_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sek_prov` (`provinsi_id`),
  KEY `fk_sek_sektor` (`sektor_id`),
  KEY `fk_sek_opd` (`bidang_id`),
  KEY `fk_sek_urusan` (`urusan_id`),
  KEY `fk_sek_subur` (`suburusan_id`),
  CONSTRAINT `fk_sek_opd` FOREIGN KEY (`bidang_id`) REFERENCES `bidangs` (`id`),
  CONSTRAINT `fk_sek_prov` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsis` (`id`),
  CONSTRAINT `fk_sek_sektor` FOREIGN KEY (`sektor_id`) REFERENCES `sektors` (`id`),
  CONSTRAINT `fk_sek_subur` FOREIGN KEY (`suburusan_id`) REFERENCES `suburusans` (`id`),
  CONSTRAINT `fk_sek_urusan` FOREIGN KEY (`urusan_id`) REFERENCES `urusans` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sektorals
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for sektorals_detail
-- ----------------------------
DROP TABLE IF EXISTS `sektorals_detail`;
CREATE TABLE `sektorals_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `komponen_id` bigint unsigned DEFAULT NULL,
  `sektoral_id` bigint unsigned DEFAULT NULL,
  `qty` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_head_sektorals` (`sektoral_id`),
  KEY `fk_sek_komponenen` (`komponen_id`),
  CONSTRAINT `fk_head_sektorals` FOREIGN KEY (`sektoral_id`) REFERENCES `sektorals` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_sek_komponenen` FOREIGN KEY (`komponen_id`) REFERENCES `forminputs` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sektorals_detail
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for sektors
-- ----------------------------
DROP TABLE IF EXISTS `sektors`;
CREATE TABLE `sektors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `provinsi_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sektor_prov` (`provinsi_id`),
  CONSTRAINT `fk_sektor_prov` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsis` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sektors
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for sim_biodata
-- ----------------------------
DROP TABLE IF EXISTS `sim_biodata`;
CREATE TABLE `sim_biodata` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `phone` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `nip` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` bigint DEFAULT NULL,
  `birth_place` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `id_jabatan` bigint DEFAULT NULL,
  `id_golongan` bigint DEFAULT NULL,
  `id_uptd` bigint DEFAULT NULL,
  `id_kota` bigint DEFAULT NULL,
  `id_provinsi` bigint DEFAULT NULL,
  `avatar` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_pangkat` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sim_biodata
-- ----------------------------
BEGIN;
INSERT INTO `sim_biodata` VALUES (8, 'Pengawas 2', 'pengawas@bantenprov.go.id', '1, Jl. Asia Afrika No.19, RW.3, Gelora, Kecamatan Tanah Abang, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10270, Indonesia', '12736192873', '12345678', '2022-01-22 13:17:43', 40, '2022-01-17 13:31:05', 40, 'Ngawi', '2022-01-17', 3, 3, 1, 1, 4, 'user1-128x128.jpeg', 'uploads/profile/2022/01/user1-128x128.jpeg', 'completed', '-6.2267248', '106.7977927', 1);
INSERT INTO `sim_biodata` VALUES (9, 'Admin', 'admin@bantenprov.go.id', 'Curug, West Bogor, Bogor City, West Java, Indonesia', '081380001904', '8912389712345', '2022-01-23 15:21:04', 41, '2022-01-23 15:21:04', NULL, 'Ngawi', '2022-01-17', 3, 3, 1, 1, 4, 'user1-128x128.jpeg', 'uploads/profile/2022/01/user1-128x128.jpeg', 'completed', '-6.5496346', '106.7676967', 1);
COMMIT;

-- ----------------------------
-- Table structure for sim_manual
-- ----------------------------
DROP TABLE IF EXISTS `sim_manual`;
CREATE TABLE `sim_manual` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(18) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `attachment` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `attachment_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sim_manual
-- ----------------------------
BEGIN;
INSERT INTO `sim_manual` VALUES (10, 'Pengajuan Surat Keterangan', 'on', 'uploads/manual/2022/01/201221_akses ke server atau hosting cpanel untuk Aplikasi simnaker.bantenprov.go.id Disnakertrans.pdf', '2022-01-12 19:21:38', 38, '2022-01-12 19:21:38', NULL, 'pengajuan-surat-keterangan', '201221_akses ke server atau hosting cpanel untuk Aplikasi simnaker.bantenprov.go.id Disnakertrans.pdf');
COMMIT;

-- ----------------------------
-- Table structure for sim_regulasi
-- ----------------------------
DROP TABLE IF EXISTS `sim_regulasi`;
CREATE TABLE `sim_regulasi` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tajuk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nomor` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tahun` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jenis` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `singkatan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tmp_netap` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_netap` date DEFAULT NULL,
  `tgl_undang` date DEFAULT NULL,
  `sumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lokasi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bid_hukum` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bahasa` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(18) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `attachment` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `view` int DEFAULT '0',
  `attachment_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sim_regulasi
-- ----------------------------
BEGIN;
INSERT INTO `sim_regulasi` VALUES (3, 'Peraturan Perundang-Undangan', 'Undang-undang Nomor 1 Tahun 1970 tentang Keselamatan Kerja', 'Indonesia', '1', '1970', 'Undang-undang', 'UU', 'Jakarta', '2022-01-05', '2022-01-05', 'LNRI Tahun 1970 Nomor 1 TLNRI Nomor.2918', 'Biro Hukum', 'Hukum Ketenagakerjaan', 'Indonesia', 'on', 'uploads/regulasi/2022/01/peraturan_file_32.pdf', '2022-01-06 22:38:13', 1, '2022-01-09 05:02:36', 1, 'undang-undang-nomor-1-tahun-1970-tentang-keselamatan-kerja', 7, 'peraturan_file_32.pdf');
INSERT INTO `sim_regulasi` VALUES (4, 'Peraturan Perundang-Undangan', 'Undang-undang Nomor Stb. No.225 Tahun 1930', 'Indonesia', '225', '1930', 'Undang-undang', 'UU', 'Jakarta', '2022-01-06', '2022-01-06', 'Sekretariat Negara', 'Biro Hukum', 'Hukum Ketenagakerjaan', 'Indonesia', 'on', 'uploads/regulasi/2022/01/UU_Uap_1930.pdf', '2022-01-06 22:43:16', 1, '2022-01-07 08:35:34', NULL, 'undang-undang-nomor-stb-no225-tahun-1930', 2, 'UU_Uap_1930.pdf');
INSERT INTO `sim_regulasi` VALUES (5, 'Peraturan Perundang-Undangan', 'Undang-undang Nomor Stb. No.225 Tahun 1930', 'Indonesia', '225', '1930', 'Undang-undang', 'UU', 'Jakarta', '2022-01-06', '2022-01-06', 'Sekretariat Negara', 'Biro Hukum', 'Hukum Ketenagakerjaan', 'Indonesia', 'on', 'uploads/regulasi/2022/01/UU_Uap_1930.pdf', '2022-01-06 22:43:16', 1, '2022-01-07 08:35:34', NULL, 'undang-undang-nomor-stb-no225-tahun-1930', 2, 'UU_Uap_1930.pdf');
INSERT INTO `sim_regulasi` VALUES (6, 'Peraturan Perundang-Undangan', 'Undang-undang Nomor Stb. No.225 Tahun 1930', 'Indonesia', '225', '1930', 'Undang-undang', 'UU', 'Jakarta', '2022-01-06', '2022-01-06', 'Sekretariat Negara', 'Biro Hukum', 'Hukum Ketenagakerjaan', 'Indonesia', 'on', 'uploads/regulasi/2022/01/UU_Uap_1930.pdf', '2022-01-06 22:43:16', 1, '2022-01-07 08:35:34', NULL, 'undang-undang-nomor-stb-no225-tahun-1930', 2, 'UU_Uap_1930.pdf');
COMMIT;

-- ----------------------------
-- Table structure for sim_renja
-- ----------------------------
DROP TABLE IF EXISTS `sim_renja`;
CREATE TABLE `sim_renja` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `jenis_kegiatan` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_pelaksanaan` date DEFAULT NULL,
  `company_id` bigint DEFAULT NULL,
  `keterangan` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `approval_id` bigint DEFAULT NULL,
  `approval_date` datetime DEFAULT NULL,
  `color` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_renja_company` (`company_id`),
  CONSTRAINT `fk_renja_company` FOREIGN KEY (`company_id`) REFERENCES `m_company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sim_renja
-- ----------------------------
BEGIN;
INSERT INTO `sim_renja` VALUES (1, 'test', '2022-01-19', 8, 'test', '2022-01-19 23:23:30', 40, '2022-01-19 23:23:30', NULL, 'proses', NULL, NULL, '#ffc107');
INSERT INTO `sim_renja` VALUES (2, 'kompas', '2022-01-17', 8, 'test', '2022-01-19 23:32:17', 40, '2022-01-19 23:32:17', NULL, 'disetujui', NULL, NULL, '#23923d');
INSERT INTO `sim_renja` VALUES (3, 'tttt', '2022-02-15', 8, 'ghfgfhg', '2022-01-19 23:41:58', 40, '2022-01-19 23:41:58', NULL, 'disetujui', NULL, NULL, '#23923d');
INSERT INTO `sim_renja` VALUES (4, 'hhhhh', '2022-01-19', 8, 'hbhgjhj', '2022-01-19 23:42:46', 40, '2022-01-19 23:42:46', NULL, 'disetujui', NULL, NULL, '#23923d');
INSERT INTO `sim_renja` VALUES (5, 'bnvnbvnb', '2022-01-27', 8, NULL, '2022-01-20 00:03:03', 40, '2022-01-20 00:03:03', NULL, 'proses', NULL, NULL, '#ffc107');
INSERT INTO `sim_renja` VALUES (6, 'nnnn', '2022-01-31', 8, NULL, '2022-01-20 00:03:26', 40, '2022-01-20 00:03:26', NULL, 'ditolak', NULL, NULL, '#d32535');
INSERT INTO `sim_renja` VALUES (7, 'gggg', '2022-01-10', 8, NULL, '2022-01-20 00:05:56', 40, '2022-01-20 00:05:56', NULL, 'proses', NULL, NULL, '#ffc107');
INSERT INTO `sim_renja` VALUES (8, 'sahdgahsjdgasj', '2022-02-10', 8, 'asdbasdjk', '2022-01-20 00:24:44', 40, '2022-01-20 00:24:44', NULL, 'proses', NULL, NULL, '#ffc107');
INSERT INTO `sim_renja` VALUES (9, 'hgkjhgh', '2021-12-23', 8, NULL, '2022-01-20 00:39:43', 40, '2022-01-20 00:39:43', NULL, 'proses', NULL, NULL, '#ffc107');
INSERT INTO `sim_renja` VALUES (10, 'hdhdhdhd', '2022-01-12', 8, 'sdfdf', '2022-01-20 03:04:51', 40, '2022-01-20 03:04:51', NULL, 'proses', NULL, NULL, '#ffc107');
INSERT INTO `sim_renja` VALUES (11, 'kompas', '2022-01-21', 8, NULL, '2022-01-20 03:24:38', 40, '2022-01-20 03:24:38', NULL, 'proses', NULL, NULL, '#ffc107');
INSERT INTO `sim_renja` VALUES (12, 'Pemeriksaan', '2022-03-09', 8, 'Pemeriksaan Limbah', '2022-01-22 16:18:44', 40, '2022-01-22 16:18:44', NULL, 'proses', NULL, NULL, '#ffc107');
COMMIT;

-- ----------------------------
-- Table structure for sim_suket
-- ----------------------------
DROP TABLE IF EXISTS `sim_suket`;
CREATE TABLE `sim_suket` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `no_surat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` bigint DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `lampiran` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lampiran_path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `step` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_pemeriksaan` bigint DEFAULT NULL,
  `jml_obyek` int DEFAULT NULL,
  `attach_object` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attach_object_path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_type_pem` bigint DEFAULT NULL,
  PRIMARY KEY (`id`,`no_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sim_suket
-- ----------------------------
BEGIN;
INSERT INTO `sim_suket` VALUES (4, 'wqhgefqwhefw', 9, '2022-01-18', 'Ijazah.pdf', 'uploads/lampiran/2022/01/Ijazah.pdf', '2022-01-16 01:28:42', 38, '2022-01-16 03:24:45', NULL, 'terverifikasi', '5', 1, 2, NULL, NULL, 1);
INSERT INTO `sim_suket` VALUES (7, 'PAA/005/SYNERGY/2021', 9, '2022-01-19', 'PENAMBAHAN.pdf', 'uploads/lampiran/2022/01/PENAMBAHAN.pdf', '2022-01-16 10:23:23', 38, '2022-01-16 10:58:02', NULL, 'proses', '5', 1, 5, 'manual-dikompresi.pdf', 'uploads/onyekkkk/2022/01/manual-dikompresi.pdf', 1);
COMMIT;

-- ----------------------------
-- Table structure for sim_talkshow
-- ----------------------------
DROP TABLE IF EXISTS `sim_talkshow`;
CREATE TABLE `sim_talkshow` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `view` int DEFAULT NULL,
  `thumbnail` smallint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sim_talkshow
-- ----------------------------
BEGIN;
INSERT INTO `sim_talkshow` VALUES (1, 'UTAMAKAN KESELAMTAN DAN KESEHATAN KERJA (K3 DALAM BEKERJA)', 'https://www.youtube.com/embed/Y66S1fpJOG8', '2022-01-07 10:21:08', 1, '2022-01-09 04:07:57', NULL, 'utamakan-keselamtan-dan-kesehatan-kerja-k3-dalam-bekerja', 6, 1);
COMMIT;

-- ----------------------------
-- Table structure for sim_user_company
-- ----------------------------
DROP TABLE IF EXISTS `sim_user_company`;
CREATE TABLE `sim_user_company` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `company_id` bigint DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sim_user_company
-- ----------------------------
BEGIN;
INSERT INTO `sim_user_company` VALUES (1, 40, 8, NULL, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for sim_visitors
-- ----------------------------
DROP TABLE IF EXISTS `sim_visitors`;
CREATE TABLE `sim_visitors` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `platform` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `browser` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `parent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sim_visitors
-- ----------------------------
BEGIN;
INSERT INTO `sim_visitors` VALUES (1, NULL, NULL, NULL, '2022-01-24 06:18:47', '2022-01-24 06:18:47', NULL);
INSERT INTO `sim_visitors` VALUES (2, NULL, NULL, NULL, '2022-01-24 06:18:49', '2022-01-24 06:18:49', NULL);
INSERT INTO `sim_visitors` VALUES (3, NULL, NULL, NULL, '2022-01-24 06:25:41', '2022-01-24 06:25:41', NULL);
INSERT INTO `sim_visitors` VALUES (4, NULL, NULL, NULL, '2022-01-24 17:55:00', '2022-01-24 17:55:00', NULL);
INSERT INTO `sim_visitors` VALUES (5, NULL, NULL, NULL, '2022-01-25 05:17:11', '2022-01-25 05:17:11', NULL);
INSERT INTO `sim_visitors` VALUES (6, NULL, NULL, NULL, '2022-01-25 05:19:44', '2022-01-25 05:19:44', NULL);
COMMIT;

-- ----------------------------
-- Table structure for statuss
-- ----------------------------
DROP TABLE IF EXISTS `statuss`;
CREATE TABLE `statuss` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `jenis_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_sts_jenis` (`jenis_id`),
  CONSTRAINT `fk_status_jenis` FOREIGN KEY (`jenis_id`) REFERENCES `jeniss` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of statuss
-- ----------------------------
BEGIN;
INSERT INTO `statuss` VALUES (1, '2021-03-29 05:56:10', '2021-04-11 07:25:00', 'HILANG', 'Hilang', 1);
INSERT INTO `statuss` VALUES (2, '2021-03-29 05:56:18', '2021-04-11 07:25:27', 'MUTASI', 'MUTASI', 1);
COMMIT;

-- ----------------------------
-- Table structure for stnks
-- ----------------------------
DROP TABLE IF EXISTS `stnks`;
CREATE TABLE `stnks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transaksi_id` bigint unsigned DEFAULT NULL,
  `shortpath` varchar(2000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `filename` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_stnk_trans` (`transaksi_id`),
  CONSTRAINT `fk_stnk_trans` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of stnks
-- ----------------------------
BEGIN;
INSERT INTO `stnks` VALUES (19, '2021-04-01 09:01:03', '2021-04-01 09:01:03', NULL, '2021/04/21_scaled_image_picker-866054536.jpg', '21_scaled_image_picker-866054536.jpg', 21);
INSERT INTO `stnks` VALUES (20, '2021-04-01 09:04:33', '2021-04-01 09:04:33', NULL, '2021/04/21_scaled_image_picker1441267712.jpg', '21_scaled_image_picker1441267712.jpg', 21);
COMMIT;

-- ----------------------------
-- Table structure for suburusans
-- ----------------------------
DROP TABLE IF EXISTS `suburusans`;
CREATE TABLE `suburusans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `urusan_id` bigint unsigned DEFAULT NULL,
  `bidang_id` bigint unsigned DEFAULT NULL,
  `sektor_id` bigint unsigned DEFAULT NULL,
  `provinsi_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sub_urusan` (`urusan_id`),
  KEY `fk_sub_prov` (`provinsi_id`),
  KEY `fk_sub_sektor` (`sektor_id`),
  KEY `fk_sub_opd` (`bidang_id`),
  CONSTRAINT `fk_sub_opd` FOREIGN KEY (`bidang_id`) REFERENCES `bidangs` (`id`),
  CONSTRAINT `fk_sub_prov` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsis` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_sub_sektor` FOREIGN KEY (`sektor_id`) REFERENCES `sektors` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_sub_urusan` FOREIGN KEY (`urusan_id`) REFERENCES `urusans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of suburusans
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for sys_month
-- ----------------------------
DROP TABLE IF EXISTS `sys_month`;
CREATE TABLE `sys_month` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_month
-- ----------------------------
BEGIN;
INSERT INTO `sys_month` VALUES (1, 'JAN', 'JANUARI');
INSERT INTO `sys_month` VALUES (2, 'FEB', 'FEBRUARI');
INSERT INTO `sys_month` VALUES (3, 'MAR', 'MARET');
INSERT INTO `sys_month` VALUES (4, 'APR', 'APRIL');
INSERT INTO `sys_month` VALUES (5, 'MEI', 'MEI');
INSERT INTO `sys_month` VALUES (6, 'JUN', 'JUNI');
INSERT INTO `sys_month` VALUES (7, 'JULI', 'JULI');
INSERT INTO `sys_month` VALUES (8, 'AGU', 'AGUSTUS');
INSERT INTO `sys_month` VALUES (9, 'SEP', 'SEPTEMBER');
INSERT INTO `sys_month` VALUES (10, 'OKT', 'OKTOBER');
INSERT INTO `sys_month` VALUES (11, 'NOV', 'NOVEMBER');
INSERT INTO `sys_month` VALUES (12, 'DES', 'DESEMBER');
COMMIT;

-- ----------------------------
-- Table structure for transaksis
-- ----------------------------
DROP TABLE IF EXISTS `transaksis`;
CREATE TABLE `transaksis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `no_registrasi` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `brand_id` bigint unsigned DEFAULT NULL,
  `tahun` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_id` bigint unsigned DEFAULT NULL,
  `status` varchar(18) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `jenis_id` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tr_brand` (`brand_id`),
  KEY `fk_tr_status` (`status_id`),
  CONSTRAINT `fk_tr_brand` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tr_status` FOREIGN KEY (`status_id`) REFERENCES `statuss` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of transaksis
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for urusans
-- ----------------------------
DROP TABLE IF EXISTS `urusans`;
CREATE TABLE `urusans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `bidang_id` bigint unsigned DEFAULT NULL,
  `sektor_id` bigint unsigned DEFAULT NULL,
  `provinsi_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_urusan_prov` (`provinsi_id`),
  KEY `fk_urusan_sektor` (`sektor_id`),
  KEY `fk_urusan_opd` (`bidang_id`),
  CONSTRAINT `fk_urusan_opd` FOREIGN KEY (`bidang_id`) REFERENCES `bidangs` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_urusan_prov` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsis` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_urusan_sektor` FOREIGN KEY (`sektor_id`) REFERENCES `sektors` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of urusans
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint unsigned DEFAULT NULL,
  `company_id` bigint DEFAULT NULL,
  `biodata_id` bigint DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `fk_user_role` (`role_id`),
  CONSTRAINT `fk_user_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'Superadmin', 'superadmin@bantenprov.go.id', NULL, '$2y$10$uGtBxV5DftcP.au9gygbKOJ10nc.RYRvXV9FJ4L/D2SH4bl2KRanG', 'CbGvLHBhChikSF5YEaQRaoSAAZ88OHh4iDoNhkhcuS1FGmIe2bBaBotS8Mob', '2021-02-21 15:12:22', '2022-01-16 20:38:17', NULL, 1, NULL, NULL);
INSERT INTO `users` VALUES (37, 'PT Adhi Karya Persada', 'admin@adhikarya.com', NULL, '$2y$10$KrunI//HYfEy.w0P5kJMfu9YsS67tQ.Wqx24kgKFdk/W0LEhP4.MK', NULL, '2022-01-11 11:25:55', '2022-01-11 11:25:55', NULL, 35, 8, NULL);
INSERT INTO `users` VALUES (38, 'PT Propan Raya Tbk', 'admin@propan.com', NULL, '$2y$10$zibW6PE9vEn42ltGYC.E3OIqgV9dkz.cHKtp9VWC4ngQDm1zidPga', NULL, '2022-01-11 11:33:14', '2022-01-13 10:58:06', NULL, 35, 9, NULL);
INSERT INTO `users` VALUES (40, 'Pengawas 2', 'pengawas@bantenprov.go.id', NULL, '$2y$10$sYVfvpvgfIvgBjj.nCFyQeCZsktjVgqflnmK5ijQ02Ff1CLMH7nP.', 'ByTCn7b145bMS2L1yfgGxlUaNHRRI3tWExGkzQT3tKjSDOxVdvF4TofiZaZR', '2022-01-16 22:57:22', '2022-01-17 11:52:28', NULL, 34, NULL, 8);
INSERT INTO `users` VALUES (41, 'Admin', 'admin@bantenprov.go.id', NULL, '$2y$10$8E3Gnb8hqf/gF0pejFhswOTC9BcnfQhwE6YPHubSMNdH4z6FW.iI2', NULL, '2022-01-23 15:04:53', '2022-01-23 15:21:04', NULL, 37, NULL, 9);
COMMIT;

-- ----------------------------
-- Table structure for visualisasis
-- ----------------------------
DROP TABLE IF EXISTS `visualisasis`;
CREATE TABLE `visualisasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(2000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_topic` bigint unsigned DEFAULT NULL,
  `id_organization` bigint unsigned DEFAULT NULL,
  `counter` int DEFAULT NULL,
  `created_by` bigint NOT NULL,
  `updated_by` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vis_topic` (`id_topic`),
  KEY `fk_vis_org` (`id_organization`),
  CONSTRAINT `fk_vis_org` FOREIGN KEY (`id_organization`) REFERENCES `organizations` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of visualisasis
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Function structure for f_total_dataset
-- ----------------------------
DROP FUNCTION IF EXISTS `f_total_dataset`;
delimiter ;;
CREATE FUNCTION `f_total_dataset`(`id_orgeh` BIGINT)
 RETURNS int
  DETERMINISTIC
BEGIN
  DECLARE total INT;
	SET total = 0;
	SELECT
		COUNT( id ) INTO total 
	FROM
		datasets 
	WHERE
		id_organization = id_orgeh;
  RETURN total;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
