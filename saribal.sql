-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 21, 2026 at 09:27 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saribal`
--

-- --------------------------------------------------------

--
-- Table structure for table `alt_sayfa`
--

CREATE TABLE `alt_sayfa` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sira` mediumint DEFAULT NULL,
  `kid` smallint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `ustu` smallint DEFAULT '0',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `banner` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `marka` int DEFAULT '0',
  `alt_baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `alt_sayfa_lang`
--

CREATE TABLE `alt_sayfa_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `resim` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `ustu` smallint DEFAULT '0',
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `kid` int DEFAULT NULL,
  `marka` int DEFAULT '0',
  `alt_baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `anket`
--

CREATE TABLE `anket` (
  `id` smallint NOT NULL,
  `question_tr` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `question_en` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `question_ar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `anket_cevap`
--

CREATE TABLE `anket_cevap` (
  `id` smallint NOT NULL,
  `question_1` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `question_2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `question_3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `question_4` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `question_5` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `question_6` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `tarih` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `lang` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'tr'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `anket_secenek`
--

CREATE TABLE `anket_secenek` (
  `id` smallint NOT NULL,
  `question_id` smallint DEFAULT NULL,
  `option_a_tr` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `option_b_tr` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `option_c_tr` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `option_d_tr` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `option_a_en` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `option_b_en` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `option_c_en` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `option_d_en` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `option_a_ar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `option_b_ar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `option_c_ar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `option_d_ar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `value` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `name`, `value`) VALUES
(1, 'mailType', 'smtp'),
(2, 'SmtpHost', 'mail.vemedya.com'),
(3, 'SmtpMail', 'form@vemedya.com'),
(4, 'SmtpPass', 'ri&amp;8C#9.Gq'),
(5, 'SmtpPort', '465'),
(6, 'SmtpSecret', 'ssl'),
(7, 'title_tr', 'Webratik'),
(8, 'description_tr', 'Webratik'),
(9, 'keywords_tr', ''),
(10, 'firma_tr', 'Webratik'),
(11, 'kisaca_tr', '&lt;p class=&quot;mb-1-9 display-28&quot;&gt;Webratik&lt;/p&gt;'),
(12, 'title_en', ''),
(13, 'description_en', ''),
(14, 'keywords_en', ''),
(15, 'firma_en', ''),
(16, 'kisaca_en', ''),
(17, 'sayac', ''),
(18, 'telefon_merkez', '+90 (555) 555 55 55'),
(19, 'telefon_2merkez', '+90 (555) 555 55 55'),
(20, 'faks_merkez', ''),
(21, 'adres_merkez', 'Gaziantep'),
(22, 'email_merkez', 'info@webratik.com'),
(23, 'telefon_Ankara', ''),
(24, 'telefon_2Ankara', ''),
(25, 'faks_Ankara', ''),
(26, 'adres_Ankara', ''),
(27, 'email_Ankara', ''),
(28, 'map_api', ''),
(29, 'email', 'isafares1@gmail.com'),
(31, 'tw', 'https://www.facebook.com/webratik'),
(32, 'ins', 'https://www.facebook.com/webratik'),
(33, 'link', 'https://www.facebook.com/webratik'),
(30, 'fb', 'https://www.facebook.com/webratik'),
(34, 'title_ar', ''),
(35, 'description_ar', ''),
(36, 'keywords_ar', ''),
(37, 'firma_ar', ''),
(38, 'kisaca_ar', '');

-- --------------------------------------------------------

--
-- Table structure for table `baglanti`
--

CREATE TABLE `baglanti` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `baglanti_lang`
--

CREATE TABLE `baglanti_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `basin`
--

CREATE TABLE `basin` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `basin_lang`
--

CREATE TABLE `basin_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `belge`
--

CREATE TABLE `belge` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `kid` smallint DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `belge_kategori`
--

CREATE TABLE `belge_kategori` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `kid` smallint DEFAULT NULL,
  `ustu` smallint DEFAULT '0',
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `belge_kategori_lang`
--

CREATE TABLE `belge_kategori_lang` (
  `lang_id` int NOT NULL,
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `kid` smallint DEFAULT NULL,
  `ustu` smallint DEFAULT '0',
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `belge_lang`
--

CREATE TABLE `belge_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `kid` smallint DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `bilgi`
--

CREATE TABLE `bilgi` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `bilgiedinme`
--

CREATE TABLE `bilgiedinme` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `goruldu` smallint DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `bilgiedinme_lang`
--

CREATE TABLE `bilgiedinme_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `bilgi_lang`
--

CREATE TABLE `bilgi_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `tarih` date DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `baslik`, `detay`, `sira`, `dil`, `url`, `resim`, `link`, `ozet`, `aktif`, `sil`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `tarih`, `ekleyen`, `duzenleyen`, `silen`) VALUES
(1, 'blog1', '&lt;p&gt;blog1&lt;/p&gt;', 1, 'tr', 'blog1-1', 'blog1-resim-778458.png', NULL, 'blog1', 1, 0, '2026-01-08 11:46:20', NULL, NULL, '2026-01-08', 'Ve İnteraktif Medya', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_lang`
--

CREATE TABLE `blog_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `blog_lang`
--

INSERT INTO `blog_lang` (`master_id`, `baslik`, `detay`, `dil`, `url`, `lang_id`, `link`, `ozet`, `aktif`, `sil`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `tarih`, `ekleyen`, `duzenleyen`, `silen`) VALUES
(1, 'blog-en-1', '&lt;p&gt;blog-en-1&lt;/p&gt;', 'en', 'blog-en-1-1', 1, NULL, 'blog-en-1', 1, 0, '2026-01-08 11:46:20', NULL, NULL, '2026-01-08', 'Ve İnteraktif Medya', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `boyutlar`
--

CREATE TABLE `boyutlar` (
  `id` int NOT NULL,
  `modul_id` int DEFAULT NULL,
  `big` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `thumb` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ek` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `boyutlar`
--

INSERT INTO `boyutlar` (`id`, `modul_id`, `big`, `thumb`, `ek`) VALUES
(1, 1, '900x400', '', '900x600'),
(2, 2, '800x400', '400x200', '800x600'),
(3, 3, '800x400', '400x200', '800x600'),
(9, 8, '300x300', '300x300', '300x300'),
(10, 9, '1920x550', '', ''),
(11, 10, '800x500', '622x414', '900x600'),
(12, 11, '700x400', '900x600', '900x600'),
(13, 12, '800x500', '450x300', '800x500'),
(14, 13, NULL, NULL, NULL),
(15, 14, '720x990', '400x550', ''),
(16, 15, '900x300', '450x150', '900x300'),
(17, 16, '900x600', '450x300', '900x600'),
(18, 17, '900x300', '450x150', '900x300'),
(19, 18, '64x64', '64x64', ''),
(20, 19, '', '', ''),
(21, 20, '800x920', '', '400x460'),
(22, 21, '600x850', '', ''),
(23, 22, '85x55', '', ''),
(24, 23, '900x500', '', '900x600'),
(25, 24, '900x500', '', '900x500'),
(26, 25, '', '', ''),
(27, 26, '900x400', '', '800x600'),
(61, 60, '900x400', '', '800x600'),
(62, 61, '300x200', '', ''),
(63, 62, '800x600', '', ''),
(64, 63, '360x160', '360x160', ''),
(65, 64, '', '', ''),
(66, 65, '300x200', '', ''),
(67, 66, '800x500', '450x251', '900x600'),
(68, 67, '800x533', '', ''),
(69, 68, '', '', ''),
(70, 69, '100x100', '', ''),
(72, 71, '100x100', '', ''),
(74, 73, '600x400', '', ''),
(75, 74, '', '', ''),
(76, 75, '400x300', '', ''),
(77, 76, '300x300', '300x300', '900x600'),
(78, 77, '800x600', '400x300', '400x300'),
(79, 78, '800x300', '250x250', '800x300'),
(80, 79, '800x400', '400x280', '800x400'),
(81, 80, '1000x1000', '500x500', ''),
(82, 81, '900x600', '', ''),
(83, 82, '400x300', '', ''),
(84, 83, '800x500', '400x250', '900x600'),
(85, 84, '800x500', '400x250', '900x600'),
(86, 85, '800x600', '800x600', ''),
(87, 86, '800x500', '300x300', '900x600'),
(88, 87, '800x400', '', ''),
(89, 88, '300x300', '', ''),
(90, 89, '400x400', '', ''),
(91, 90, '400x400', '', ''),
(92, 91, '400x400', '', ''),
(93, 92, '400x300', '400x300', '400x300'),
(94, 93, '', '', ''),
(95, 94, '300x170', '', ''),
(96, 95, '', '', ''),
(97, 96, '', '', ''),
(98, 97, '', '', ''),
(99, 98, '', '', ''),
(100, 99, '600x400', '300x200', '600x400'),
(101, 100, '1005x800', '', ''),
(102, 101, '800x600', '', ''),
(103, 102, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `bulten`
--

CREATE TABLE `bulten` (
  `id` int NOT NULL,
  `sira` smallint DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `tarih` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `aktif` smallint DEFAULT '1',
  `ip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ceviri`
--

CREATE TABLE `ceviri` (
  `id` smallint NOT NULL,
  `key` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `tr` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `en` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `fr` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `ru` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `ar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `kid` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `de` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ceviri_kategori`
--

CREATE TABLE `ceviri_kategori` (
  `id` smallint NOT NULL,
  `baslik` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ceviri_kategori`
--

INSERT INTO `ceviri_kategori` (`id`, `baslik`) VALUES
(1, 'header'),
(3, 'footer'),
(4, 'iletisim'),
(5, 'form'),
(6, 'genel'),
(7, 'katalog'),
(8, 'login'),
(9, 'urun');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `CityID` int NOT NULL,
  `CountryID` int NOT NULL,
  `CityName` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `PlateNo` smallint NOT NULL,
  `PhoneCode` varchar(7) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `destek`
--

CREATE TABLE `destek` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `kurumlar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `sektorler` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `konular` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `sehirler` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `etiketler` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `durum` smallint DEFAULT '1',
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `kid` int DEFAULT NULL,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `destek_lang`
--

CREATE TABLE `destek_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `kurumlar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `sektorler` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `konular` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `sehirler` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `etiketler` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `durum` smallint DEFAULT '1',
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `dosyalar`
--

CREATE TABLE `dosyalar` (
  `id` mediumint NOT NULL,
  `dosya` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `tur` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `type` varchar(90) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `data_id` int DEFAULT NULL,
  `sira` int NOT NULL DEFAULT '0',
  `baslik` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `arka` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci,
  `vitrin` int DEFAULT '0',
  `lang` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT 'tr',
  `resim_tur` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `baslik_en` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `baslik_ar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `baslik_jp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `baslik_fr` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `baslik_ru` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `file_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `youtube_tr` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `youtube_en` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `resim` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `detay_tr` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci,
  `detay_en` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci,
  `detay_ar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `dosyalar`
--

INSERT INTO `dosyalar` (`id`, `dosya`, `tur`, `type`, `data_id`, `sira`, `baslik`, `arka`, `vitrin`, `lang`, `resim_tur`, `aktif`, `sil`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `ekleyen`, `duzenleyen`, `silen`, `baslik_en`, `baslik_ar`, `baslik_jp`, `baslik_fr`, `baslik_ru`, `file_type`, `youtube_tr`, `youtube_en`, `resim`, `detay_tr`, `detay_en`, `detay_ar`) VALUES
(16, 'Back-view-man-working-eco-friendly-wind-power-project-with-wind-turbines-1-4192.jpg', 'resim', 'galeri', 1, 1, NULL, NULL, 0, 'en', '', 1, 0, '2026-01-08 11:40:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Back-view-man-working-eco-friendly-wind-power-project-with-wind-turbines-1-5460.jpg', 'resim', 'galeri', 1, 1, NULL, NULL, 0, 'tr', '', 1, 0, '2026-01-08 11:40:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(17, '83103-400x800-8628.jpg', 'resim', 'sayfa', 1, 1, NULL, NULL, 0, 'tr', '', 1, 1, '2026-01-20 15:52:45', NULL, '2026-01-20 15:52:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `duyuru`
--

CREATE TABLE `duyuru` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `duyuru_lang`
--

CREATE TABLE `duyuru_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `d_kategori`
--

CREATE TABLE `d_kategori` (
  `id` int NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `aktif` int DEFAULT '1',
  `sira` int DEFAULT NULL,
  `ozet` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `telefon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `fax` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `adres` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `koordinat` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sehir` int DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `dil` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `tur` smallint DEFAULT '1',
  `resim` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `d_kategori_lang`
--

CREATE TABLE `d_kategori_lang` (
  `lang_id` int NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `aktif` int DEFAULT '1',
  `sira` int DEFAULT NULL,
  `ozet` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `telefon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `fax` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `adres` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `koordinat` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `master_id` smallint DEFAULT NULL,
  `dil` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sil` smallint DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `egitim`
--

CREATE TABLE `egitim` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `adres` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `sehir` int DEFAULT NULL,
  `sira` mediumint DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `telefon` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `fax` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `site` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` int DEFAULT '1',
  `dil` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `baskan` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sekreter` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `vekil` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `yonetim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `denetim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `harita` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `egitim_lang`
--

CREATE TABLE `egitim_lang` (
  `lang_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `yetkili` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `adres` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `sehir` int DEFAULT NULL,
  `sira` mediumint DEFAULT NULL,
  `telefon` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `fax` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `site` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` int DEFAULT '1',
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `dil` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `reyonlar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `kartlar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `koordinat` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `calisma` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `master_id` int DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `tur` smallint DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `emaillist`
--

CREATE TABLE `emaillist` (
  `id` int NOT NULL,
  `sira` smallint DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `dil` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'tr',
  `sil` smallint DEFAULT '0',
  `tarih` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `aktif` smallint DEFAULT '1',
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `eklenme_tarihi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `duzenleme_tarihi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `silme_tarihi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `etkinlik`
--

CREATE TABLE `etkinlik` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `baslangic` datetime DEFAULT NULL,
  `bitis` datetime DEFAULT NULL,
  `yer` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `etkinlik_lang`
--

CREATE TABLE `etkinlik_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `yer` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `baslangic` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `bitis` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `firmalar`
--

CREATE TABLE `firmalar` (
  `id` smallint NOT NULL,
  `firma_adi` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sayfa` smallint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `firsat`
--

CREATE TABLE `firsat` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `firma` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `pozisyon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `telefon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `adres` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `firsat_lang`
--

CREATE TABLE `firsat_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `fuar`
--

CREATE TABLE `fuar` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `baslangic` date DEFAULT NULL,
  `bitis` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `fuar_lang`
--

CREATE TABLE `fuar_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `baslik`, `detay`, `sira`, `dil`, `url`, `resim`, `ozet`, `aktif`, `sil`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `tarih`, `icon`, `ekleyen`, `duzenleyen`, `silen`) VALUES
(1, 'anaSayfaGaleri', '', 1, 'tr', 'anasayfagaleri-1', NULL, NULL, 1, 0, '2025-12-26 12:58:26', NULL, NULL, NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `galeri_lang`
--

CREATE TABLE `galeri_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `haber`
--

CREATE TABLE `haber` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `kid` int DEFAULT NULL,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `haber_kategori`
--

CREATE TABLE `haber_kategori` (
  `id` smallint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `haber_lang`
--

CREATE TABLE `haber_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `header_log`
--

CREATE TABLE `header_log` (
  `id` bigint NOT NULL,
  `header` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `date` datetime DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `hikaye`
--

CREATE TABLE `hikaye` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `hikaye_lang`
--

CREATE TABLE `hikaye_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `tarih` date DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `hizmet`
--

CREATE TABLE `hizmet` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `hizmet`
--

INSERT INTO `hizmet` (`id`, `baslik`, `detay`, `sira`, `dil`, `url`, `resim`, `link`, `ozet`, `aktif`, `sil`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `tarih`, `ekleyen`, `duzenleyen`, `silen`) VALUES
(1, 'Hizmet-1', '&lt;p&gt;Hizmet-1&lt;/p&gt;', 1, 'tr', 'hizmet-1-1', 'hizmet-1-resim-895960.jpg', NULL, 'Hizmet-1', 1, 0, '2026-01-08 11:47:41', NULL, NULL, '1970-01-01', 'Ve İnteraktif Medya', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hizmet_lang`
--

CREATE TABLE `hizmet_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `hizmet_lang`
--

INSERT INTO `hizmet_lang` (`master_id`, `baslik`, `detay`, `dil`, `url`, `lang_id`, `link`, `ozet`, `aktif`, `sil`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `tarih`, `ekleyen`, `duzenleyen`, `silen`) VALUES
(1, 'Hizmet-en-1', '&lt;p&gt;Hizmet-en-1&lt;/p&gt;', 'en', 'hizmet-en-1-1', 1, NULL, 'Hizmet-en-1', 1, 0, '2026-01-08 11:47:41', NULL, NULL, '1970-01-01', 'Ve İnteraktif Medya', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `icerikler`
--

CREATE TABLE `icerikler` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `turler` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `fiyat` decimal(10,2) DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `standart` smallint DEFAULT '0',
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `icerikler_lang`
--

CREATE TABLE `icerikler_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `isaret`
--

CREATE TABLE `isaret` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sira` mediumint DEFAULT NULL,
  `kid` smallint DEFAULT NULL,
  `fiyat` decimal(10,2) DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `topp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `leftp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `rightp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `bottomp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `isaret_lang`
--

CREATE TABLE `isaret_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `kid` int DEFAULT NULL,
  `marka` int DEFAULT '0',
  `alt_baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `kampanya`
--

CREATE TABLE `kampanya` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `kampanya_lang`
--

CREATE TABLE `kampanya_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `kariyer`
--

CREATE TABLE `kariyer` (
  `id` int NOT NULL,
  `tc_kimlik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `adi_soyadi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cinsiyet` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `dogum_yeri_ve_tarihi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `adresi` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `cep_telefonu` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `meslek` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cv` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ehliyet` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `askerlik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `tecil_tarih` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `rahatsizlik` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `medeni_hal` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cocuk_sayisi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `aile_calisan` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `engellilik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sabika` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `icra_takibi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `istenen_bolum` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `kurslar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `referans` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `basvuru_tarihi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `firma_adi_1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `isveren_adi_1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `firma_telefon_1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `firma_gorev_1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `net_ucret_1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `calisma_suresi_1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ayrilik_nedeni_1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `firma_adi_2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `isveren_adi_2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `firma_telefon_2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `firma_gorev_2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `net_ucret_2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `calisma_suresi_2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ayrilik_nedeni_2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `firma_adi_3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `isveren_adi_3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `firma_telefon_3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `firma_gorev_3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `net_ucret_3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `calisma_suresi_3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ayrilik_nedeni_3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `durum` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT '0',
  `tahsil` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `calismak_istenen_yer` smallint DEFAULT NULL,
  `resim` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `archive` smallint DEFAULT '0',
  `boy` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `kilo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ik_il` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ik_ilce` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `goruldu` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `eklenme_tarihi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `duzenleme_tarihi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `silme_tarihi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `kariyer_lang`
--

CREATE TABLE `kariyer_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `katalog`
--

CREATE TABLE `katalog` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `boyut` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `katalog`
--

INSERT INTO `katalog` (`id`, `baslik`, `detay`, `sira`, `dil`, `boyut`, `url`, `resim`, `ozet`, `aktif`, `sil`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `tarih`, `icon`, `ekleyen`, `duzenleyen`, `silen`) VALUES
(1, 'Katalog 2019', '', 1, 'tr', '', 'katalog-2019-1', 'katalog-2019-resim-903952.png', NULL, 1, 0, '2020-01-15 13:38:02', NULL, NULL, NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `katalog_lang`
--

CREATE TABLE `katalog_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `boyut` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `banner` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` smallint DEFAULT '0',
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `kid` smallint DEFAULT NULL,
  `ustu` smallint DEFAULT '0',
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `baslik`, `detay`, `sira`, `dil`, `url`, `resim`, `ozet`, `banner`, `aktif`, `link`, `sil`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `tarih`, `kid`, `ustu`, `ekleyen`, `duzenleyen`, `silen`) VALUES
(1, 'Baskılı Sac', NULL, 1, 'tr', 'baskili-sac-1', NULL, NULL, NULL, 1, NULL, 0, '2026-01-20 14:52:14', '2026-01-21 11:27:44', NULL, NULL, NULL, 0, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(2, 'Kapı', NULL, 2, 'tr', 'kapi-2', NULL, NULL, NULL, 1, NULL, 0, '2026-01-20 14:52:25', '2026-01-21 11:28:44', NULL, NULL, NULL, 0, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(3, 'Döküm Ferforje', NULL, 3, 'tr', 'dokum-ferforje-3', NULL, NULL, NULL, 1, NULL, 0, '2026-01-20 14:52:42', '2026-01-21 11:31:31', NULL, NULL, NULL, 0, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(4, '1000x2000 mm', NULL, 4, 'tr', '1000x2000-mm-4', NULL, NULL, NULL, 1, NULL, 0, '2026-01-20 15:05:04', '2026-01-21 11:30:56', NULL, NULL, NULL, 1, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(5, '300x2000 mm', NULL, 5, 'tr', '300x2000-mm-5', NULL, NULL, NULL, 1, NULL, 0, '2026-01-20 15:05:20', '2026-01-20 17:48:57', NULL, NULL, NULL, 1, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(6, '1000x1000 mm', NULL, 6, 'tr', '1000x1000-mm-6', NULL, NULL, NULL, 1, NULL, 0, '2026-01-20 15:06:59', '2026-01-21 11:30:37', NULL, NULL, NULL, 1, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(7, '1000x2000 mm', NULL, 7, 'tr', '1000x2000-mm-7', NULL, NULL, NULL, 1, NULL, 0, '2026-01-20 15:07:53', '2026-01-21 11:30:46', NULL, NULL, NULL, 1, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(8, 'Kapı Köşe', NULL, 8, 'tr', 'kapi-kose-8', NULL, NULL, NULL, 1, NULL, 0, '2026-01-20 15:08:25', '2026-01-21 11:30:07', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(9, 'Paneller', NULL, 9, 'tr', 'paneller-9', NULL, NULL, NULL, 1, NULL, 0, '2026-01-20 15:08:36', '2026-01-21 11:29:27', NULL, NULL, NULL, 3, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(10, 'Kapı Göbek', NULL, 10, 'tr', 'kapi-gobek-10', NULL, NULL, NULL, 1, NULL, 0, '2026-01-21 11:47:48', '2026-01-21 12:03:42', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(11, 'Yapraklar', NULL, 11, 'tr', 'yapraklar-11', NULL, NULL, NULL, 1, NULL, 0, '2026-01-21 11:47:54', '2026-01-21 12:04:04', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(12, 'Rozetler', NULL, 12, 'tr', 'rozetler-12', NULL, NULL, NULL, 1, NULL, 0, '2026-01-21 11:47:58', '2026-01-21 12:15:13', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(13, 'Desenli Parçalar', NULL, 13, 'tr', 'desenli-parcalar-13', NULL, NULL, NULL, 1, NULL, 0, '2026-01-21 11:48:02', '2026-01-21 12:15:40', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(14, 'Flanşlar', NULL, 14, 'tr', 'flanslar-14', NULL, NULL, NULL, 1, NULL, 0, '2026-01-21 11:48:06', '2026-01-21 12:16:09', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(15, 'Kapaklar', NULL, 15, 'tr', 'kapaklar-15', NULL, NULL, NULL, 1, NULL, 0, '2026-01-21 11:48:11', '2026-01-21 12:16:26', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(16, 'Topuzlar', NULL, 16, 'tr', 'topuzlar-16', NULL, NULL, NULL, 1, NULL, 0, '2026-01-21 11:48:16', '2026-01-21 12:16:47', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(17, 'Küreler', NULL, 17, 'tr', 'kureler-17', NULL, NULL, NULL, 1, NULL, 0, '2026-01-21 11:48:19', '2026-01-21 12:17:13', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(18, 'Mızrak', NULL, 18, 'tr', 'mizrak-18', NULL, NULL, NULL, 1, NULL, 0, '2026-01-21 11:48:23', '2026-01-21 12:17:48', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(19, 'Döküm Parçalar', NULL, 19, 'tr', 'dokum-parcalar-19', NULL, NULL, NULL, 1, NULL, 0, '2026-01-21 11:48:27', '2026-01-21 12:18:12', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(20, 'Desenli Küpeşte, Profil, Lama ve Kare Demir', NULL, 20, 'tr', 'desenli-kupeste-profil-lama-ve-kare-demir-20', NULL, NULL, NULL, 1, NULL, 0, '2026-01-21 11:48:45', '2026-01-21 12:18:33', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(21, 'Kapı Akesuar', NULL, 21, 'tr', 'kapi-akesuar-21', NULL, NULL, NULL, 1, NULL, 0, '2026-01-21 11:48:56', '2026-01-21 12:19:28', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(22, '1000x2000 mm ', NULL, 22, 'tr', '1000x2000-mm-22', NULL, NULL, NULL, 1, NULL, 0, '2026-01-21 11:49:03', '2026-01-21 12:18:39', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(23, 'Merdiven', NULL, 23, 'tr', 'merdiven-23', NULL, NULL, NULL, 1, NULL, 0, '2026-01-21 11:50:16', '2026-01-21 12:21:05', NULL, NULL, NULL, 3, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(24, 'Demir Döküm ', NULL, 24, 'tr', 'demir-dokum-24', NULL, NULL, NULL, 1, NULL, 0, '2026-01-21 11:50:20', '2026-01-21 12:22:47', NULL, NULL, NULL, 3, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(25, 'Kapı Aksesuarları', NULL, 25, 'tr', 'kapi-aksesuarlari-25', NULL, NULL, NULL, 1, NULL, 0, '2026-01-21 11:50:42', '2026-01-21 12:20:37', NULL, NULL, NULL, 3, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(26, 'Şehir Elemanları', NULL, 26, 'tr', 'sehir-elemanlari-26', NULL, NULL, NULL, 1, NULL, 0, '2026-01-21 11:50:47', '2026-01-21 11:55:06', NULL, NULL, NULL, 3, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(27, 'Kapı Bordürleri', NULL, 27, 'tr', 'kapi-bordurleri-27', NULL, NULL, NULL, 1, NULL, 0, '2026-01-21 12:24:50', NULL, NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_lang`
--

CREATE TABLE `kategori_lang` (
  `lang_id` int NOT NULL,
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `kid` smallint DEFAULT NULL,
  `ustu` smallint DEFAULT '0',
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `kategori_lang`
--

INSERT INTO `kategori_lang` (`lang_id`, `master_id`, `baslik`, `detay`, `dil`, `url`, `ozet`, `aktif`, `link`, `sil`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `tarih`, `kid`, `ustu`, `ekleyen`, `duzenleyen`, `silen`) VALUES
(1, 1, 'Embossed Metal', NULL, 'en', 'embossed-metal-1', NULL, 1, NULL, 0, '2026-01-20 14:52:14', '2026-01-21 11:27:44', NULL, NULL, NULL, 0, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(2, 1, 'صفائح منقوشة', NULL, 'ar', 'embossed-metal-1', NULL, 1, NULL, 0, '2026-01-20 14:52:14', '2026-01-21 11:27:44', NULL, NULL, NULL, 0, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(3, 2, 'Door', NULL, 'en', 'door-2', NULL, 1, NULL, 0, '2026-01-20 14:52:25', '2026-01-21 11:28:44', NULL, NULL, NULL, 0, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(4, 2, 'أبواب', NULL, 'ar', 'door-2', NULL, 1, NULL, 0, '2026-01-20 14:52:25', '2026-01-21 11:28:44', NULL, NULL, NULL, 0, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(5, 3, 'Cast Iron', NULL, 'en', 'cast-iron-3', NULL, 1, NULL, 0, '2026-01-20 14:52:42', '2026-01-21 11:31:31', NULL, NULL, NULL, 0, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(6, 3, 'حديد مصبوب', NULL, 'ar', 'cast-iron-3', NULL, 1, NULL, 0, '2026-01-20 14:52:42', '2026-01-21 11:31:31', NULL, NULL, NULL, 0, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(7, 4, '1000x2000 mm', NULL, 'en', '1000x2000-mm-4', NULL, 1, NULL, 0, '2026-01-20 15:05:04', '2026-01-21 11:30:56', NULL, NULL, NULL, 1, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(8, 4, '1000x2000 mm', NULL, 'ar', '1000x2000-mm-4', NULL, 1, NULL, 0, '2026-01-20 15:05:04', '2026-01-21 11:30:56', NULL, NULL, NULL, 1, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(9, 5, '300x2000 mm', NULL, 'en', '300x2000-mm-5', NULL, 1, NULL, 0, '2026-01-20 15:05:20', '2026-01-20 17:48:57', NULL, NULL, NULL, 1, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(10, 5, '300x2000 mm', NULL, 'ar', '300x2000-mm-5', NULL, 1, NULL, 0, '2026-01-20 15:05:20', '2026-01-20 17:48:57', NULL, NULL, NULL, 1, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(11, 6, '1000x1000 mm', NULL, 'en', '1000x1000-mm-6', NULL, 1, NULL, 0, '2026-01-20 15:06:59', '2026-01-21 11:30:37', NULL, NULL, NULL, 1, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(12, 6, '1000x1000 mm', NULL, 'ar', '1000x1000-mm-6', NULL, 1, NULL, 0, '2026-01-20 15:06:59', '2026-01-21 11:30:37', NULL, NULL, NULL, 1, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(13, 7, '1000x2000 mm', NULL, 'en', '1000x2000-mm-7', NULL, 1, NULL, 0, '2026-01-20 15:07:53', '2026-01-21 11:30:46', NULL, NULL, NULL, 1, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(14, 7, '1000x2000 mm', NULL, 'ar', '1000x2000-mm-7', NULL, 1, NULL, 0, '2026-01-20 15:07:53', '2026-01-21 11:30:46', NULL, NULL, NULL, 1, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(15, 8, 'Door Corner', NULL, 'en', 'door-corner-8', NULL, 1, NULL, 0, '2026-01-20 15:08:25', '2026-01-21 11:30:07', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(16, 8, 'زاوية الباب', NULL, 'ar', 'door-corner-8', NULL, 1, NULL, 0, '2026-01-20 15:08:25', '2026-01-21 11:30:07', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(17, 9, 'Panels', NULL, 'en', 'panels-9', NULL, 1, NULL, 0, '2026-01-20 15:08:36', '2026-01-21 11:29:27', NULL, NULL, NULL, 3, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(18, 9, 'ألواح', NULL, 'ar', 'panels-9', NULL, 1, NULL, 0, '2026-01-20 15:08:36', '2026-01-21 11:29:27', NULL, NULL, NULL, 3, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(19, 10, 'Door Cylinder', NULL, 'en', 'door-cylinder-10', NULL, 1, NULL, 0, '2026-01-21 11:47:48', '2026-01-21 12:03:42', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(20, 10, 'قلب القفل', NULL, 'ar', 'door-cylinder-10', NULL, 1, NULL, 0, '2026-01-21 11:47:48', '2026-01-21 12:03:42', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(21, 11, 'Leaves', NULL, 'en', 'leaves-11', NULL, 1, NULL, 0, '2026-01-21 11:47:54', '2026-01-21 12:04:04', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(22, 11, 'أوراق', NULL, 'ar', 'leaves-11', NULL, 1, NULL, 0, '2026-01-21 11:47:54', '2026-01-21 12:04:04', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(23, 12, 'Rosettes', NULL, 'en', 'rosettes-12', NULL, 1, NULL, 0, '2026-01-21 11:47:58', '2026-01-21 12:15:13', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(24, 12, 'زخارف', NULL, 'ar', 'rosettes-12', NULL, 1, NULL, 0, '2026-01-21 11:47:58', '2026-01-21 12:15:13', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(25, 13, 'Patterned Parts', NULL, 'en', 'patterned-parts-13', NULL, 1, NULL, 0, '2026-01-21 11:48:02', '2026-01-21 12:15:40', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(26, 13, 'قطع مزخرفة', NULL, 'ar', 'patterned-parts-13', NULL, 1, NULL, 0, '2026-01-21 11:48:02', '2026-01-21 12:15:40', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(27, 14, 'Flanges', NULL, 'en', 'flanges-14', NULL, 1, NULL, 0, '2026-01-21 11:48:06', '2026-01-21 12:16:09', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(28, 14, 'فلنجات', NULL, 'ar', 'flanges-14', NULL, 1, NULL, 0, '2026-01-21 11:48:06', '2026-01-21 12:16:09', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(29, 15, 'Covers', NULL, 'en', 'covers-15', NULL, 1, NULL, 0, '2026-01-21 11:48:11', '2026-01-21 12:16:26', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(30, 15, 'أغطية', NULL, 'ar', 'covers-15', NULL, 1, NULL, 0, '2026-01-21 11:48:11', '2026-01-21 12:16:26', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(31, 16, 'Knobs', NULL, 'en', 'knobs-16', NULL, 1, NULL, 0, '2026-01-21 11:48:16', '2026-01-21 12:16:47', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(32, 16, 'مقابض', NULL, 'ar', 'knobs-16', NULL, 1, NULL, 0, '2026-01-21 11:48:16', '2026-01-21 12:16:47', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(33, 17, 'Spheres', NULL, 'en', 'spheres-17', NULL, 1, NULL, 0, '2026-01-21 11:48:19', '2026-01-21 12:17:13', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(34, 17, 'كُرات', NULL, 'ar', 'spheres-17', NULL, 1, NULL, 0, '2026-01-21 11:48:19', '2026-01-21 12:17:13', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(35, 18, 'Spear', NULL, 'en', 'spear-18', NULL, 1, NULL, 0, '2026-01-21 11:48:23', '2026-01-21 12:17:48', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(36, 18, 'رماح', NULL, 'ar', 'spear-18', NULL, 1, NULL, 0, '2026-01-21 11:48:23', '2026-01-21 12:17:48', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(37, 19, 'Cast Parts', NULL, 'en', 'cast-parts-19', NULL, 1, NULL, 0, '2026-01-21 11:48:27', '2026-01-21 12:18:12', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(38, 19, 'قطع مصبوبة', NULL, 'ar', 'cast-parts-19', NULL, 1, NULL, 0, '2026-01-21 11:48:27', '2026-01-21 12:18:12', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(39, 20, 'Patterned Handrails, Profiles, Flat Bars, and Square Iron', NULL, 'en', 'patterned-handrails-profiles-flat-bars-and-square-iron-20', NULL, 1, NULL, 0, '2026-01-21 11:48:45', '2026-01-21 12:18:33', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(40, 20, 'درابزين مزخرف، بروفيلات، حديد مسطح، وحديد مربع', NULL, 'ar', 'patterned-handrails-profiles-flat-bars-and-square-iron-20', NULL, 1, NULL, 0, '2026-01-21 11:48:45', '2026-01-21 12:18:33', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(41, 21, 'Door Accessories', NULL, 'en', 'door-accessories-21', NULL, 1, NULL, 0, '2026-01-21 11:48:56', '2026-01-21 12:19:28', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(42, 21, 'إكسسوارات الأبواب', NULL, 'ar', 'door-accessories-21', NULL, 1, NULL, 0, '2026-01-21 11:48:56', '2026-01-21 12:19:28', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(43, 22, '1000x2000 mm ', NULL, 'en', '1000x2000-mm-22', NULL, 1, NULL, 0, '2026-01-21 11:49:03', '2026-01-21 12:18:39', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(44, 22, '1000x2000 mm ', NULL, 'ar', '1000x2000-mm-22', NULL, 1, NULL, 0, '2026-01-21 11:49:03', '2026-01-21 12:18:39', NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(45, 23, 'Staircase', NULL, 'en', 'staircase-23', NULL, 1, NULL, 0, '2026-01-21 11:50:16', '2026-01-21 12:21:05', NULL, NULL, NULL, 3, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(46, 23, 'درج', NULL, 'ar', 'staircase-23', NULL, 1, NULL, 0, '2026-01-21 11:50:16', '2026-01-21 12:21:05', NULL, NULL, NULL, 3, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(47, 24, 'Demir Döküm ', NULL, 'en', 'demir-dokum-24', NULL, 1, NULL, 0, '2026-01-21 11:50:20', '2026-01-21 12:22:47', NULL, NULL, NULL, 3, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(48, 24, 'حديد مصبوب', NULL, 'ar', 'demir-dokum-24', NULL, 1, NULL, 0, '2026-01-21 11:50:20', '2026-01-21 12:22:47', NULL, NULL, NULL, 3, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(49, 25, 'Door Accessories', NULL, 'en', 'door-accessories-25', NULL, 1, NULL, 0, '2026-01-21 11:50:42', '2026-01-21 12:20:37', NULL, NULL, NULL, 3, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(50, 25, 'إكسسوارات الأبواب', NULL, 'ar', 'door-accessories-25', NULL, 1, NULL, 0, '2026-01-21 11:50:42', '2026-01-21 12:20:37', NULL, NULL, NULL, 3, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(51, 26, 'City Furniture', NULL, 'en', 'city-furniture-26', NULL, 1, NULL, 0, '2026-01-21 11:50:47', '2026-01-21 11:55:06', NULL, NULL, NULL, 3, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(52, 26, 'أثاث حضري', NULL, 'ar', 'city-furniture-26', NULL, 1, NULL, 0, '2026-01-21 11:50:47', '2026-01-21 11:55:06', NULL, NULL, NULL, 3, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(53, 27, 'Door Borders', NULL, 'en', 'door-borders-27', NULL, 1, NULL, 0, '2026-01-21 12:24:50', NULL, NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', NULL, NULL),
(54, 27, 'إطارات الأبواب', NULL, 'ar', 'door-borders-27', NULL, 1, NULL, 0, '2026-01-21 12:24:50', NULL, NULL, NULL, NULL, 2, 'Ve İnteraktif Medya', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `koleksiyon`
--

CREATE TABLE `koleksiyon` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `kid` smallint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `ustu` smallint DEFAULT '0',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `banner` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `marka` int DEFAULT '0',
  `alt_baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `koleksiyon`
--

INSERT INTO `koleksiyon` (`id`, `baslik`, `detay`, `sira`, `kid`, `dil`, `ustu`, `url`, `resim`, `ozet`, `banner`, `marka`, `alt_baslik`, `aktif`, `sil`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `ekleyen`, `duzenleyen`, `silen`) VALUES
(1, 'test', '&lt;p&gt;test&lt;/p&gt;', 1, 10, 'tr', 0, 'test-1', NULL, '', NULL, 0, NULL, 1, 0, '2025-12-26 13:05:52', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL),
(2, 'Hakkımızda', '&lt;p&gt;Hakkımızda&lt;/p&gt;', 2, 1, 'tr', 0, 'hakkimizda-2', NULL, '', NULL, 0, NULL, 1, 0, '2025-12-26 13:59:16', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `koleksiyon_lang`
--

CREATE TABLE `koleksiyon_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `ustu` smallint DEFAULT '0',
  `resim` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `kid` int DEFAULT NULL,
  `marka` int DEFAULT '0',
  `alt_baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `konu`
--

CREATE TABLE `konu` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `konu_lang`
--

CREATE TABLE `konu_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `kullanici`
--

CREATE TABLE `kullanici` (
  `id` mediumint NOT NULL,
  `kullanici` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `tur` smallint DEFAULT NULL,
  `adi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sira` mediumint DEFAULT NULL,
  `sifre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `resim` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `yetkiler` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `parent` smallint DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `theme` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `kullanici`
--

INSERT INTO `kullanici` (`id`, `kullanici`, `tur`, `adi`, `sira`, `sifre`, `resim`, `sil`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `yetkiler`, `parent`, `ekleyen`, `duzenleyen`, `theme`) VALUES
(1, 'vemedya', 1, 'Ve İnteraktif Medya', 1, '0aa7d56ad19f99c374c5e71823d28eb2c5961aba', '-resim-247271.png', 0, NULL, '2019-05-03 16:43:09', NULL, NULL, 0, NULL, 'Ve İnteraktif Medya', 'skin-blue');

-- --------------------------------------------------------

--
-- Table structure for table `kurs`
--

CREATE TABLE `kurs` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `durum` smallint DEFAULT '1',
  `baslangic` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `bitis` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `kurskayit`
--

CREATE TABLE `kurskayit` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `kurs` smallint DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `goruldu` smallint DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `kurskayit_lang`
--

CREATE TABLE `kurskayit_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `kurs_lang`
--

CREATE TABLE `kurs_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `durum` smallint DEFAULT '1',
  `baslangic` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `bitis` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `kurum`
--

CREATE TABLE `kurum` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `link` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `kid` smallint DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `kurum_lang`
--

CREATE TABLE `kurum_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `link` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `kid` smallint DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `marka`
--

CREATE TABLE `marka` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `sabit` smallint DEFAULT '0',
  `fiyat` decimal(10,2) DEFAULT NULL,
  `kod` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `marka_lang`
--

CREATE TABLE `marka_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `moduller`
--

CREATE TABLE `moduller` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `modul` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `anasayfa` smallint DEFAULT '1',
  `pill` smallint DEFAULT '0',
  `pill_table` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `pill_column` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `moduller`
--

INSERT INTO `moduller` (`id`, `baslik`, `sira`, `dil`, `url`, `modul`, `aktif`, `sil`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `icon`, `anasayfa`, `pill`, `pill_table`, `pill_column`) VALUES
(1, 'Sayfalar', 2, 'tr', '', 'sayfa', 0, 0, '2019-04-30 12:37:21', '2021-01-02 13:49:47', NULL, 'fa fa-file-text', 1, 0, NULL, NULL),
(2, 'Yemek Tarifleri', 31, 'tr', '', 'yemek', 0, 0, '2019-04-30 12:47:22', '2019-11-18 14:09:48', NULL, 'mdi mdi-food-fork-drink', 0, 0, NULL, NULL),
(3, 'Pratik Bilgiler', 30, 'tr', '', 'bilgi', 0, 0, '2019-04-30 12:48:22', '2019-11-18 14:10:18', NULL, 'mdi mdi-information', 1, 0, NULL, NULL),
(8, 'Sık Sorulan Sorular', 41, 'tr', NULL, 'sorular', 0, 0, '2019-04-30 13:30:20', '2019-04-30 13:43:34', NULL, 'fa fa-question', 1, 0, NULL, NULL),
(9, 'Slayt', 3, 'tr', '', 'slayt', 0, 0, '2019-04-30 13:33:54', '2022-01-08 10:15:19', NULL, 'fa fa-picture-o', 1, 0, NULL, NULL),
(10, 'Haberler', 7, 'tr', '', 'haber', 0, 0, '2019-04-30 13:34:20', '2021-10-15 13:46:36', NULL, 'fa fa-newspaper-o', 1, 0, NULL, NULL),
(11, 'Foto Galeri', 8, 'tr', '', 'galeri', 0, 0, '2019-04-30 13:35:26', '2020-12-31 11:28:53', NULL, 'glyphicon glyphicon-camera', 1, 0, NULL, NULL),
(12, 'Video Galeri', 9, 'tr', '', 'video', 0, 0, '2019-04-30 13:35:53', '2021-10-11 10:22:45', NULL, 'mdi mdi-video', 1, 0, NULL, NULL),
(13, 'E-Bülten', 35, 'tr', NULL, 'bulten', 0, 0, '2019-04-30 13:38:20', NULL, NULL, 'mdi mdi-email-variant', 1, 0, NULL, NULL),
(14, 'Belgelerimiz', 4, 'tr', '', 'belge', 0, 0, '2019-04-30 13:39:31', '2020-09-23 12:56:08', NULL, 'mdi mdi-file-document', 1, 0, NULL, NULL),
(21, 'İndirim Bülteni', 36, 'tr', '', 'katalog', 0, 0, '2019-10-08 13:13:18', '2020-10-31 14:21:19', NULL, 'fa fa-book', 1, 0, NULL, NULL),
(18, 'Kullanıcı Yönetimi', 47, 'tr', '', 'kullanici', 0, 0, '2019-05-02 15:50:49', '2020-11-02 17:00:50', NULL, 'mdi mdi-account-check', 1, 0, NULL, NULL),
(19, 'Ayarlar', 48, 'tr', NULL, 'ayar', 1, 0, '2019-05-02 17:17:48', '2019-05-02 17:31:18', NULL, 'fa  fa-cogs', 1, 0, NULL, NULL),
(20, 'Ürünler', 5, 'tr', '', 'urun', 1, 0, '2019-09-11 16:02:51', '2020-09-22 14:37:06', NULL, 'fa fa-spoon', 1, 0, NULL, NULL),
(22, 'Dil Seçenekleri', 22, 'tr', '', 'marka', 0, 0, '2019-10-22 15:10:58', '2020-08-20 14:05:43', NULL, 'mdi mdi-language-html5', 1, 0, NULL, NULL),
(23, 'Etkinlikler', 33, 'tr', '', 'etkinlik', 0, 0, '2019-10-22 15:11:34', '2019-10-31 13:28:06', NULL, 'mdi mdi-calendar', 1, 0, NULL, NULL),
(24, 'Fuarlar', 34, 'tr', '', 'fuar', 0, 0, '2019-10-22 15:14:10', '2019-10-28 12:08:48', NULL, 'mdi mdi-svg', 1, 0, NULL, NULL),
(25, 'Rakamlar', 12, 'tr', '', 'rakam', 0, 0, '2019-10-28 16:39:38', '2023-01-24 12:13:29', NULL, 'fa fa-sort-numeric-asc', 1, 0, NULL, NULL),
(60, 'Makarnanın Hikayesi', 32, 'tr', '', 'hikaye', 0, 0, '2019-10-29 11:04:51', NULL, NULL, 'fa fa-question', 1, 0, NULL, NULL),
(63, 'Referanslar', 10, 'tr', '', 'referans', 0, 0, '2020-01-13 16:43:43', NULL, NULL, 'fa fa-cog', 1, 0, NULL, NULL),
(64, 'Domain Seçenekleri', 27, 'tr', '', 'isaret', 0, 0, '2020-01-14 17:27:16', '2020-08-21 12:51:31', NULL, 'mdi mdi-web', 1, 0, NULL, NULL),
(66, 'Projeler', 6, 'tr', '', 'proje', 0, 0, '2020-02-06 14:51:01', '2021-10-12 16:53:04', NULL, 'fa fa-life-bouy', 1, 0, NULL, NULL),
(67, 'Satis', 37, 'tr', '', 'satis', 0, 0, '2020-02-06 14:53:36', '2021-01-08 12:28:19', NULL, 'fa fa-commenting', 1, 0, NULL, NULL),
(68, 'İş Fırsatları', 44, 'tr', '', 'firsat', 0, 0, '2020-06-13 12:27:58', '2020-12-30 12:29:29', NULL, 'fa fa-users', 1, 0, NULL, NULL),
(69, 'Özellikler', 39, 'tr', '', 'ozellik', 0, 0, '2020-07-20 10:53:06', NULL, NULL, 'fa fa-diamond', 1, 0, NULL, NULL),
(71, 'Webratik İçerikleri', 40, 'tr', '', 'icerikler', 0, 0, '2020-07-20 11:14:09', '2020-07-20 11:14:54', NULL, 'fa fa-sliders', 1, 0, NULL, NULL),
(73, 'Temalar', 38, 'tr', '', 'temalar', 0, 0, '2020-07-21 17:04:51', NULL, NULL, 'glyphicon glyphicon-picture', 1, 0, NULL, NULL),
(74, 'Üyelik Ön Başvuruları', 45, 'tr', '', 'talep', 0, 0, '2020-08-29 15:05:20', '2020-12-29 17:39:07', NULL, 'mdi mdi-account-key', 1, 1, 'talep', 'goruldu'),
(75, 'Siparişler', 49, 'tr', '', 'siparis', 0, 0, '2020-09-03 17:26:45', '2020-09-03 17:28:08', NULL, 'mdi mdi-basket', 1, 1, 'siparis', 'goruldu'),
(76, 'Hizmetlerimiz', 11, 'tr', '', 'hizmet', 0, 0, '2020-09-10 17:24:42', NULL, NULL, 'fa fa-cogs', 1, 0, NULL, NULL),
(77, 'Blog', 26, 'tr', '', 'blog', 0, 0, '2020-09-22 14:27:28', NULL, NULL, 'fa fa-edit', 1, 0, NULL, NULL),
(78, 'Reyonlar', 23, 'tr', '', 'reyon', 0, 0, '2020-10-30 16:19:52', '2020-11-02 17:09:05', NULL, 'fa fa-th', 1, 0, NULL, NULL),
(79, 'Şubeler', 24, 'tr', '', 'sube', 0, 0, '2020-10-31 11:06:38', '2020-11-03 11:07:50', NULL, 'mdi mdi-store', 1, 0, NULL, NULL),
(80, 'Kampanyalar', 25, 'tr', '', 'kampanya', 0, 0, '2020-10-31 14:00:15', NULL, NULL, 'fa fa-gift', 1, 0, NULL, NULL),
(81, 'Popup', 13, 'tr', '', 'popup', 0, 0, '2020-11-07 15:07:52', NULL, NULL, 'fa fa-window-maximize', 1, 0, NULL, NULL),
(82, 'İş Arayanlar', 46, 'tr', '', 'kariyer', 0, 0, '2020-11-20 15:41:27', '2020-12-29 17:40:10', NULL, 'fa fa-users', 1, 1, 'kariyer', 'goruldu'),
(85, 'Basında Biz', 28, 'tr', '', 'basin', 0, 0, '2020-12-31 10:16:37', '2021-01-02 16:10:04', NULL, 'fa fa-object-group', 1, 0, NULL, NULL),
(86, 'Kampanyalar', 29, 'tr', '', 'duyuru', 0, 0, '2020-12-31 10:56:13', '2022-01-15 13:00:12', NULL, 'fa fa-bullhorn', 1, 0, NULL, NULL),
(87, 'Devlet Destekleri', 14, 'tr', '', 'destek', 0, 0, '2021-01-08 12:32:14', NULL, NULL, 'fa fa-plus-square', 1, 0, NULL, NULL),
(88, 'Kurumlar', 16, 'tr', '', 'kurum', 0, 0, '2021-01-08 12:50:54', '2021-01-08 13:08:07', NULL, 'fa fa-institution ', 1, 0, NULL, NULL),
(89, 'Sektörler', 17, 'tr', '', 'sektor', 0, 0, '2021-01-08 12:51:56', NULL, NULL, 'fa fa-globe', 1, 0, NULL, NULL),
(90, 'Mevzuat Konuları', 18, 'tr', '', 'konu', 0, 0, '2021-01-08 12:52:36', NULL, NULL, 'fa fa-clone', 1, 0, NULL, NULL),
(91, 'Yatırım Sözlüğü', 19, 'tr', '', 'sozluk', 0, 0, '2021-01-19 13:40:46', NULL, NULL, 'fa fa-info-circle', 1, 0, NULL, NULL),
(92, 'Odalar', 15, 'tr', '', 'oda', 0, 0, '2021-10-08 12:29:33', '2021-10-08 13:05:40', NULL, 'mdi mdi-store', 1, 0, NULL, NULL),
(93, 'Çeviri Merkezi', 50, 'tr', '', 'ceviri', 0, 0, '2021-10-08 16:00:45', NULL, NULL, ' glyphicon glyphicon-transfer', 1, 0, NULL, NULL),
(94, 'Bağlantılar', 43, 'tr', '', 'baglanti', 0, 0, '2021-10-11 10:30:35', '2021-10-11 12:10:02', NULL, 'fa fa-link', 1, 0, NULL, NULL),
(95, 'Kurslar', 42, 'tr', '', 'kurs', 0, 0, '2021-10-12 12:48:16', NULL, NULL, ' glyphicon glyphicon-education', 1, 0, NULL, NULL),
(96, 'Kurs Kayıt Formları', 51, 'tr', '', 'kurskayit', 0, 0, '2021-10-15 14:18:24', NULL, NULL, 'fa fa-edit', 1, 0, 'kurskayit', 'goruldu'),
(97, 'İş Başvuru Formları', 52, 'tr', '', 'uzmankayit', 0, 0, '2021-10-15 14:53:25', '2021-11-15 12:50:26', NULL, 'fa fa-edit', 1, 0, NULL, NULL),
(98, 'Bilgi Edinme Formları', 53, 'tr', '', 'bilgiedinme', 0, 0, '2021-10-15 14:54:57', NULL, NULL, 'fa fa-info', 1, 0, NULL, NULL),
(99, 'Eğitim Merkezleri', 54, 'tr', '', 'egitim', 0, 0, '2021-10-15 16:23:10', NULL, NULL, 'mdi mdi-seal', 1, 0, NULL, NULL),
(100, 'Servis Ekipmanları', 20, 'tr', '', 'servis_ekipmani', 0, 0, '2021-12-28 16:53:37', '2021-12-30 10:46:28', NULL, 'fa fa-support (alias)', 1, 0, NULL, NULL),
(101, 'Yedek Parça', 21, 'tr', '', 'yedek_parca', 0, 0, '2022-01-03 13:41:43', NULL, NULL, 'fa fa-cog', 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oda`
--

CREATE TABLE `oda` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `adres` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `sehir` int DEFAULT NULL,
  `sira` mediumint DEFAULT NULL,
  `telefon` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `fax` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` int DEFAULT '1',
  `dil` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `baskan` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sekreter` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `vekil` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `yonetim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `denetim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `harita` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `oda_lang`
--

CREATE TABLE `oda_lang` (
  `lang_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `yetkili` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `adres` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `sehir` int DEFAULT NULL,
  `sira` mediumint DEFAULT NULL,
  `telefon` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `fax` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` int DEFAULT '1',
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `dil` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `reyonlar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `kartlar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `koordinat` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `calisma` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `master_id` int DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `tur` smallint DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ozellik`
--

CREATE TABLE `ozellik` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `renk` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `standart` smallint DEFAULT '0',
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ozellik_lang`
--

CREATE TABLE `ozellik_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `popup`
--

CREATE TABLE `popup` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `popup_lang`
--

CREATE TABLE `popup_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `proje`
--

CREATE TABLE `proje` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `kid` smallint DEFAULT NULL,
  `durum` smallint DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `baslangic` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `bitis` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `tarih` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `proje_kategori`
--

CREATE TABLE `proje_kategori` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `banner` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` smallint DEFAULT '0',
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `kid` smallint DEFAULT NULL,
  `ustu` smallint DEFAULT '0',
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `proje_kategori_lang`
--

CREATE TABLE `proje_kategori_lang` (
  `lang_id` int NOT NULL,
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `kid` smallint DEFAULT NULL,
  `ustu` smallint DEFAULT '0',
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `proje_lang`
--

CREATE TABLE `proje_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `kid` smallint DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `tarih` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `rakam`
--

CREATE TABLE `rakam` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `rakam` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `birim` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `rakam`
--

INSERT INTO `rakam` (`id`, `baslik`, `detay`, `rakam`, `sira`, `dil`, `birim`, `url`, `resim`, `link`, `ozet`, `aktif`, `sil`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `tarih`, `ekleyen`, `duzenleyen`, `silen`) VALUES
(1, 'Yıllık Deneyim', NULL, '10', 1, 'tr', '', 'yillik-deneyim-1', NULL, '', NULL, 1, 0, '2025-11-07 10:08:04', '2026-01-08 11:45:05', NULL, NULL, NULL, NULL, NULL),
(2, 'Tamamlanan Proje', NULL, '250', 2, 'tr', '', 'tamamlanan-proje-2', NULL, '', NULL, 1, 0, '2025-11-07 10:10:00', '2026-01-08 11:45:18', NULL, NULL, NULL, NULL, NULL),
(3, 'Mutlu Müşteri', NULL, '180', 3, 'tr', '', 'mutlu-musteri-3', NULL, '', NULL, 1, 0, '2025-11-07 10:12:00', '2026-01-08 11:45:22', NULL, NULL, NULL, NULL, NULL),
(4, 'Ekip Üyesi', NULL, '25', 4, 'tr', '', 'ekip-uyesi-4', NULL, '', NULL, 1, 0, '2025-11-07 10:15:00', '2026-01-08 11:45:27', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rakam_lang`
--

CREATE TABLE `rakam_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `rakam` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `birim` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `rakam_lang`
--

INSERT INTO `rakam_lang` (`master_id`, `baslik`, `rakam`, `detay`, `dil`, `url`, `lang_id`, `birim`, `link`, `ozet`, `aktif`, `sil`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `tarih`, `ekleyen`, `duzenleyen`, `silen`) VALUES
(1, 'Happy Customers', '10', NULL, 'en', 'happy-customers-1', 1, '', '', '', 1, 0, NULL, '2026-01-08 11:45:05', NULL, NULL, NULL, NULL, NULL),
(2, 'Happy Customers', '10', NULL, 'en', 'happy-customers-2', 2, '', '', '', 1, 0, NULL, '2026-01-08 11:45:18', NULL, NULL, NULL, NULL, NULL),
(3, 'Happy Customers', '10', NULL, 'en', 'happy-customers-3', 3, '', '', '', 1, 0, NULL, '2026-01-08 11:45:22', NULL, NULL, NULL, NULL, NULL),
(4, 'Happy Customers', '10', NULL, 'en', 'happy-customers-4', 4, '', '', '', 1, 0, NULL, '2026-01-08 11:45:27', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `referans`
--

CREATE TABLE `referans` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `referans_lang`
--

CREATE TABLE `referans_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `reyon`
--

CREATE TABLE `reyon` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `reyon_lang`
--

CREATE TABLE `reyon_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sayac`
--

CREATE TABLE `sayac` (
  `id` smallint NOT NULL,
  `sayac` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sayfa`
--

CREATE TABLE `sayfa` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `kid` smallint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `ustu` smallint DEFAULT '0',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `banner` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `marka` int DEFAULT '0',
  `alt_baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sayfa`
--

INSERT INTO `sayfa` (`id`, `baslik`, `detay`, `sira`, `kid`, `dil`, `ustu`, `url`, `resim`, `ozet`, `banner`, `marka`, `alt_baslik`, `aktif`, `sil`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `ekleyen`, `duzenleyen`, `silen`) VALUES
(1, 'Hakkımızda', '&lt;p&gt;Hakkımızda&lt;/p&gt;', 1, 1, 'tr', 0, 'hakkimizda-1', 'hakkimizda-resim-452845.png', '', NULL, 0, NULL, 1, 0, '2025-12-16 17:56:55', '2026-01-08 11:37:36', NULL, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL),
(2, 'Vizyon &amp; Misyon', '&lt;p&gt;Vizyon &amp; Misyon&lt;/p&gt;', 2, 1, 'tr', 0, 'vizyon-amp-misyon-2', 'vizyon-misyon-resim-488796.png', '', NULL, 0, NULL, 1, 0, '2025-12-26 13:59:33', '2026-01-08 11:37:53', NULL, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sayfakategori`
--

CREATE TABLE `sayfakategori` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci,
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `aktif` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `ustu` smallint DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sayfakategori`
--

INSERT INTO `sayfakategori` (`id`, `baslik`, `sira`, `dil`, `resim`, `url`, `sil`, `aktif`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `ekleyen`, `duzenleyen`, `silen`, `ustu`) VALUES
(1, 'Kurumsal', 1, 'tr', NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sayfakategori_lang`
--

CREATE TABLE `sayfakategori_lang` (
  `lang_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `master_id` mediumint DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `aktif` smallint DEFAULT '1',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `ustu` smallint DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sayfa_lang`
--

CREATE TABLE `sayfa_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `ustu` smallint DEFAULT '0',
  `resim` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `kid` int DEFAULT NULL,
  `marka` int DEFAULT '0',
  `alt_baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sayfa_lang`
--

INSERT INTO `sayfa_lang` (`master_id`, `baslik`, `detay`, `dil`, `url`, `lang_id`, `ustu`, `resim`, `ozet`, `kid`, `marka`, `alt_baslik`, `aktif`, `sil`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `ekleyen`, `duzenleyen`, `silen`) VALUES
(1, 'About Us', '&lt;p&gt;About Us&lt;/p&gt;', 'en', 'about-us-1', 1, 0, 'hakkimizda-resim-694164.png', '', 1, 0, NULL, 1, 0, NULL, '2026-01-08 11:37:36', NULL, NULL, 'Ve İnteraktif Medya', NULL),
(2, 'Vision &amp; Mission', '&lt;p&gt;Vision &amp; Mission&lt;/p&gt;', 'en', 'vision-amp-mission-2', 2, 0, 'vizyon-misyon-resim-515948.png', '', 1, 0, NULL, 1, 0, NULL, '2026-01-08 11:37:53', NULL, NULL, 'Ve İnteraktif Medya', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sehirler`
--

CREATE TABLE `sehirler` (
  `id` int NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sehirler`
--

INSERT INTO `sehirler` (`id`, `baslik`) VALUES
(1, 'Adana'),
(2, 'Adıyaman'),
(3, 'Afyonkarahisar'),
(4, 'Ağrı'),
(5, 'Amasya'),
(6, 'Ankara'),
(7, 'Antalya'),
(8, 'Artvin'),
(9, 'Aydın'),
(10, 'Balıkesir'),
(11, 'Bilecik'),
(12, 'Bingöl'),
(13, 'Bitlis'),
(14, 'Bolu'),
(15, 'Burdur'),
(16, 'Bursa'),
(17, 'Çanakkale'),
(18, 'Çankırı'),
(19, 'Çorum'),
(20, 'Denizli'),
(21, 'Diyarbakır'),
(22, 'Edirne'),
(23, 'Elazığ'),
(24, 'Erzincan'),
(25, 'Erzurum'),
(26, 'Eskişehir'),
(27, 'Gaziantep'),
(28, 'Giresun'),
(29, 'Gümüşhane'),
(30, 'Hakkâri'),
(31, 'Hatay'),
(32, 'Isparta'),
(33, 'Mersin'),
(34, 'İstanbul'),
(35, 'İzmir'),
(36, 'Kars'),
(37, 'Kastamonu'),
(38, 'Kayseri'),
(39, 'Kırklareli'),
(40, 'Kırşehir'),
(41, 'Kocaeli'),
(42, 'Konya'),
(43, 'Kütahya'),
(44, 'Malatya'),
(45, 'Manisa'),
(46, 'Kahramanmaraş'),
(47, 'Mardin'),
(48, 'Muğla'),
(49, 'Muş'),
(50, 'Nevşehir'),
(51, 'Niğde'),
(52, 'Ordu'),
(53, 'Rize'),
(54, 'Sakarya'),
(55, 'Samsun'),
(56, 'Siirt'),
(57, 'Sinop'),
(58, 'Sivas'),
(59, 'Tekirdağ'),
(60, 'Tokat'),
(61, 'Trabzon'),
(62, 'Tunceli'),
(63, 'Şanlıurfa'),
(64, 'Uşak'),
(65, 'Van'),
(66, 'Yozgat'),
(67, 'Zonguldak'),
(68, 'Aksaray'),
(69, 'Bayburt'),
(70, 'Karaman'),
(71, 'Kırıkkale'),
(72, 'Batman'),
(73, 'Şırnak'),
(74, 'Bartın'),
(75, 'Ardahan'),
(76, 'Iğdır'),
(77, 'Yalova'),
(78, 'Karabük'),
(79, 'Kilis'),
(80, 'Osmaniye'),
(81, 'Düzce');

-- --------------------------------------------------------

--
-- Table structure for table `sektor`
--

CREATE TABLE `sektor` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sektor_lang`
--

CREATE TABLE `sektor_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `servis_ekipmani`
--

CREATE TABLE `servis_ekipmani` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `kid` smallint DEFAULT NULL,
  `durum` smallint DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `baslangic` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `bitis` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `tarih` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozellik` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `teknik_bilgi` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `teslimat` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozel_aksesuar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `servis_ekipmani_kategori`
--

CREATE TABLE `servis_ekipmani_kategori` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `alt_resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `banner` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` smallint DEFAULT '0',
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `kid` smallint DEFAULT NULL,
  `ustu` smallint DEFAULT '0',
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `servis_ekipmani_kategori_lang`
--

CREATE TABLE `servis_ekipmani_kategori_lang` (
  `lang_id` int NOT NULL,
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `alt_resim` varchar(0) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `kid` smallint DEFAULT NULL,
  `ustu` smallint DEFAULT '0',
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `servis_ekipmani_lang`
--

CREATE TABLE `servis_ekipmani_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `kid` smallint DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `tarih` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozellik` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `teknik_bilgi` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `teslimat` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozel_aksesuar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `siparis`
--

CREATE TABLE `siparis` (
  `id` smallint NOT NULL,
  `tarih` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `islem` smallint DEFAULT '1',
  `tur` smallint DEFAULT NULL,
  `detaylar` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `goruldu` smallint DEFAULT '0',
  `toplam` decimal(10,2) DEFAULT NULL,
  `kdv` decimal(10,2) DEFAULT NULL,
  `genel_toplam` decimal(10,2) DEFAULT NULL,
  `iptal` smallint DEFAULT '0',
  `tarihce` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `iptal_aciklama` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `3d_sonuc` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `pos_sonuc` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `donen_baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `donen_mesaj` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `tema` smallint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `siparis_log`
--

CREATE TABLE `siparis_log` (
  `id` bigint NOT NULL,
  `user` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `tarih` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `siparis_id` int DEFAULT NULL,
  `siparis_no` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `islem` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `slayt`
--

CREATE TABLE `slayt` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `color1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `color2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `color3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `baslik2` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `button` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `slayt`
--

INSERT INTO `slayt` (`id`, `baslik`, `detay`, `sira`, `dil`, `url`, `resim`, `ozet`, `link`, `aktif`, `sil`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `tarih`, `icon`, `ekleyen`, `duzenleyen`, `silen`, `color1`, `color2`, `color3`, `baslik2`, `button`) VALUES
(2, 'Slider1', '', 2, 'tr', 'slider1-2', 'slider1-resim-388062.jpg', 'Slider3', '', 1, 0, '2025-12-26 14:11:43', '2026-01-08 11:39:39', NULL, NULL, NULL, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL, '', '', '', 'Slider12', '');

-- --------------------------------------------------------

--
-- Table structure for table `slayt_lang`
--

CREATE TABLE `slayt_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `color1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `color2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `color3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` smallint DEFAULT '0',
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `baslik2` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `slayt_lang`
--

INSERT INTO `slayt_lang` (`master_id`, `baslik`, `detay`, `dil`, `url`, `lang_id`, `ozet`, `color1`, `color2`, `color3`, `aktif`, `link`, `sil`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `tarih`, `icon`, `ekleyen`, `duzenleyen`, `silen`, `baslik2`) VALUES
(2, 'Slideren1', '', 'en', 'slideren1-2', 1, 'Slideren1', '', '', '', 1, '', 0, NULL, '2026-01-08 11:39:39', NULL, NULL, NULL, NULL, 'Ve İnteraktif Medya', NULL, 'Slideren1');

-- --------------------------------------------------------

--
-- Table structure for table `sorular`
--

CREATE TABLE `sorular` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sorular_lang`
--

CREATE TABLE `sorular_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sozluk`
--

CREATE TABLE `sozluk` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sozluk_lang`
--

CREATE TABLE `sozluk_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sube`
--

CREATE TABLE `sube` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `yetkili` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `adres` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `sehir` int DEFAULT NULL,
  `sira` mediumint DEFAULT NULL,
  `telefon` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `fax` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` int DEFAULT '1',
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `dil` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `koordinat` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `calisma` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `reyon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `kasa` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `alan` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `mudurluk` int DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `tur` smallint DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sube_lang`
--

CREATE TABLE `sube_lang` (
  `lang_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `yetkili` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `adres` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `sehir` int DEFAULT NULL,
  `sira` mediumint DEFAULT NULL,
  `telefon` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `fax` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` int DEFAULT '1',
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `dil` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `reyonlar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `kartlar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `koordinat` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `calisma` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `master_id` int DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `tur` smallint DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `talep`
--

CREATE TABLE `talep` (
  `id` smallint NOT NULL,
  `adi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `tc` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `engellilik_orani` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `mesaj` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `telefon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `tarih` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `goruldu` smallint DEFAULT '0',
  `ip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sil` smallint DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `temalar`
--

CREATE TABLE `temalar` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `turler` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `temalar_lang`
--

CREATE TABLE `temalar_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `town`
--

CREATE TABLE `town` (
  `TownID` int NOT NULL,
  `CityID` int NOT NULL,
  `TownName` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `urun`
--

CREATE TABLE `urun` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `kisi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `icindekiler` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `video` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `yeni` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `kid` smallint DEFAULT NULL,
  `marka` smallint DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay_resim` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `faydalar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `koordinat` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozellikler` text COLLATE utf8mb3_bin
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `urun`
--

INSERT INTO `urun` (`id`, `baslik`, `kisi`, `detay`, `link`, `sira`, `dil`, `url`, `resim`, `icindekiler`, `ozet`, `video`, `aktif`, `yeni`, `sil`, `kid`, `marka`, `tarih`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `ekleyen`, `duzenleyen`, `silen`, `detay_resim`, `faydalar`, `koordinat`, `logo`, `ozellikler`) VALUES
(1, '83200', NULL, '', '', 1, 'tr', '83200-1', '83203-resim-879501.jpg', '', '', '', 1, 1, 0, 4, NULL, NULL, '2026-01-20 15:19:42', '2026-01-21 10:56:10', NULL, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83203&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83203-b&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(2, '83201', NULL, '', '', 2, 'tr', '83201-2', '83204-resim-810132.jpg', '', '', '', 1, 1, 0, 8, NULL, NULL, '2026-01-20 15:21:18', '2026-01-21 10:58:01', NULL, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Çap&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83204&quot;,&quot;Çap&quot;:&quot;80cm&quot;},{&quot;Kod&quot;:&quot;83204-b&quot;,&quot;Çap&quot;:&quot;90cm&quot;}]}'),
(3, '83202', NULL, '', '', 3, 'tr', '83202-3', '83204-resim-117850.jpg', '', '', '', 1, 1, 0, 9, NULL, NULL, '2026-01-20 15:21:21', '2026-01-21 10:59:14', NULL, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Çap&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83204&quot;,&quot;Çap&quot;:&quot;80cm&quot;},{&quot;Kod&quot;:&quot;83204-b&quot;,&quot;Çap&quot;:&quot;90cm&quot;}]}'),
(7, '83205', NULL, '', '', 4, 'tr', '83205-7', 'resim-383211.jpg', '', '', '', 1, 0, 0, 8, NULL, NULL, '2026-01-21 11:04:18', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83205&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83205-a&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(8, '83205', NULL, '', '', 5, 'tr', '83205-8', 'resim-383211.jpg', '', '', '', 1, 0, 0, 8, NULL, NULL, '2026-01-21 11:04:21', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83205&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83205-a&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(9, '83205', NULL, '', '', 6, 'tr', '83205-9', 'resim-383211.jpg', '', '', '', 1, 1, 0, 8, NULL, NULL, '2026-01-21 11:04:28', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83205&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83205-a&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(10, '83205', NULL, '', '', 7, 'tr', '83205-10', 'resim-383211.jpg', '', '', '', 1, 1, 0, 6, NULL, NULL, '2026-01-21 11:04:32', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83205&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83205-a&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(11, '83205', NULL, '', '', 8, 'tr', '83205-11', 'resim-383211.jpg', '', '', '', 1, 1, 0, 5, NULL, NULL, '2026-01-21 11:04:35', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83205&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83205-a&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(12, '83206', NULL, '', '', 9, 'tr', '83206-12', 'resim-520915.jpg', '', '', '', 1, 1, 0, 9, NULL, NULL, '2026-01-21 11:05:07', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83206&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83206-a&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(13, '83207', NULL, '', '', 10, 'tr', '83207-13', 'resim-520915.jpg', '', '', '', 1, 0, 0, 9, NULL, NULL, '2026-01-21 11:05:38', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83207&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83207-a&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(14, '83208', NULL, '', '', 11, 'tr', '83208-14', 'resim-520915.jpg', '', '', '', 1, 0, 0, 6, NULL, NULL, '2026-01-21 11:06:06', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83208&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83208-b&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(15, '83208', NULL, '', '', 12, 'tr', '83208-15', 'resim-520915.jpg', '', '', '', 1, 1, 0, 7, NULL, NULL, '2026-01-21 11:06:12', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83208&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83208-b&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(16, '83208', NULL, '', '', 13, 'tr', '83208-16', 'resim-520915.jpg', '', '', '', 0, 1, 0, 4, NULL, NULL, '2026-01-21 11:06:14', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83208&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83208-b&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(17, '83208', NULL, '', '', 14, 'tr', '83208-17', 'resim-520915.jpg', '', '', '', 1, 1, 0, 8, NULL, NULL, '2026-01-21 11:06:21', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83208&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83208-b&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(18, '83208', NULL, '', '', 15, 'tr', '83208-18', 'resim-594505.jpg', '', '', '', 1, 0, 0, 4, NULL, NULL, '2026-01-21 11:06:28', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83208&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83208-b&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(19, '83208', NULL, '', '', 16, 'tr', '83208-19', 'resim-594505.jpg', '', '', '', 1, 0, 0, 4, NULL, NULL, '2026-01-21 11:06:31', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83208&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83208-b&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(20, '83208', NULL, '', '', 17, 'tr', '83208-20', 'resim-594505.jpg', '', '', '', 1, 1, 0, 5, NULL, NULL, '2026-01-21 11:06:33', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83208&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83208-b&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(21, '83208', NULL, '', '', 18, 'tr', '83208-21', 'resim-594505.jpg', '', '', '', 1, 1, 0, 5, NULL, NULL, '2026-01-21 11:06:37', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83208&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83208-b&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(22, '83208', NULL, '', '', 19, 'tr', '83208-22', 'resim-594505.jpg', '', '', '', 1, 1, 0, 6, NULL, NULL, '2026-01-21 11:06:40', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83208&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83208-b&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(23, '83208', NULL, '', '', 20, 'tr', '83208-23', 'resim-594505.jpg', '', '', '', 1, 1, 0, 6, NULL, NULL, '2026-01-21 11:06:41', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83208&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83208-b&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(24, '83208', NULL, '', '', 21, 'tr', '83208-24', 'resim-594505.jpg', '', '', '', 1, 0, 0, 7, NULL, NULL, '2026-01-21 11:06:47', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83208&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83208-b&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(25, '83208', NULL, '', '', 22, 'tr', '83208-25', 'resim-594505.jpg', '', '', '', 1, 0, 0, 7, NULL, NULL, '2026-01-21 11:06:51', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83208&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83208-b&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(26, '83208', NULL, '', '', 23, 'tr', '83208-26', 'resim-594505.jpg', '', '', '', 1, 0, 0, 8, NULL, NULL, '2026-01-21 11:06:59', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83208&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83208-b&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(27, '83208', NULL, '', '', 24, 'tr', '83208-27', 'resim-594505.jpg', '', '', '', 1, 0, 0, 8, NULL, NULL, '2026-01-21 11:07:01', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83208&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83208-b&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(28, '83208', NULL, '', '', 25, 'tr', '83208-28', 'resim-594505.jpg', '', '', '', 1, 0, 0, 9, NULL, NULL, '2026-01-21 11:07:05', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83208&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83208-b&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}'),
(29, '83208', NULL, '', '', 26, 'tr', '83208-29', 'resim-594505.jpg', '', '', '', 1, 0, 0, 9, NULL, NULL, '2026-01-21 11:07:08', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '', NULL, '{&quot;kolonlar&quot;:[&quot;Kod&quot;,&quot;Genişlik&quot;,&quot;Boy&quot;],&quot;satirlar&quot;:[{&quot;Kod&quot;:&quot;83208&quot;,&quot;Genişlik&quot;:&quot;1000mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;},{&quot;Kod&quot;:&quot;83208-b&quot;,&quot;Genişlik&quot;:&quot;1200mm&quot;,&quot;Boy&quot;:&quot;2000mm&quot;}]}');

-- --------------------------------------------------------

--
-- Table structure for table `urunler`
--

CREATE TABLE `urunler` (
  `baslik` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `fiyat` varchar(40) CHARACTER SET latin5 COLLATE latin5_turkish_ci DEFAULT NULL,
  `resim1` varchar(255) CHARACTER SET latin5 COLLATE latin5_turkish_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `urunkod` text CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `urun_lang`
--

CREATE TABLE `urun_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `slogan` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `video` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `marka` smallint DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `kid` smallint DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `faydalar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `teknik` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozellikler` text COLLATE utf8mb3_bin,
  `yeni` smallint DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `urun_lang`
--

INSERT INTO `urun_lang` (`master_id`, `baslik`, `slogan`, `detay`, `dil`, `url`, `lang_id`, `link`, `ozet`, `aktif`, `video`, `marka`, `sil`, `kid`, `tarih`, `eklenme_tarihi`, `duzenleme_tarihi`, `silme_tarihi`, `ekleyen`, `duzenleyen`, `silen`, `faydalar`, `teknik`, `ozellikler`, `yeni`) VALUES
(1, '83203 ', '', '', 'en', '83203-1', 1, '', '', 1, '', NULL, 0, 4, NULL, '2026-01-20 15:19:42', '2026-01-21 10:56:10', NULL, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83203&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83203-b&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(1, '83203 ', '', '', 'ar', '83203-1', 2, '', '', 1, '', NULL, 0, 4, NULL, '2026-01-20 15:19:42', '2026-01-21 10:56:10', NULL, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;رقم&quot;,&quot;عرض&quot;,&quot;ارنفاع&quot;],&quot;satirlar&quot;:[{&quot;رقم&quot;:&quot;83203&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارنفاع&quot;:&quot;2000mm&quot;},{&quot;رقم&quot;:&quot;83203-b&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارنفاع&quot;:&quot;2000mm&quot;}]}', 0),
(2, '83204', '', '', 'en', '83204-2', 3, '', '', 1, '', NULL, 0, 8, NULL, '2026-01-20 15:21:18', '2026-01-21 10:58:01', NULL, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Diameter&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83204&quot;,&quot;Diameter&quot;:&quot;80cm&quot;},{&quot;Code&quot;:&quot;83204-b&quot;,&quot;Diameter&quot;:&quot;90cm&quot;}]}', 0),
(2, '83204', '', '', 'ar', '83204-2', 4, '', '', 1, '', NULL, 0, 8, NULL, '2026-01-20 15:21:18', '2026-01-21 10:58:01', NULL, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;القطر&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83204&quot;,&quot;القطر&quot;:&quot;80cm&quot;},{&quot;الرقم&quot;:&quot;90cm&quot;,&quot;القطر&quot;:&quot;90cm&quot;}]}', 0),
(3, '83204', '', '', 'en', '83204-3', 5, '', '', 1, '', NULL, 0, 9, NULL, '2026-01-20 15:21:21', '2026-01-21 10:59:14', NULL, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Diameter&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83204&quot;,&quot;Diameter&quot;:&quot;80cm&quot;},{&quot;Code&quot;:&quot;83204-b&quot;,&quot;Diameter&quot;:&quot;90cm&quot;}]}', 0),
(3, '83204', '', '', 'ar', '83204-3', 6, '', '', 1, '', NULL, 0, 9, NULL, '2026-01-20 15:21:21', '2026-01-21 10:59:14', NULL, 'Ve İnteraktif Medya', 'Ve İnteraktif Medya', NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;القطر&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83204&quot;,&quot;القطر&quot;:&quot;80cm&quot;},{&quot;الرقم&quot;:&quot;83204-b&quot;,&quot;القطر&quot;:&quot;90cm&quot;}]}', 0),
(4, 'w22', '', '', 'en', 'w22-4', 7, '', '', 1, '', NULL, 1, 0, NULL, '2026-01-20 17:23:27', NULL, '2026-01-20 17:23:38', 'Ve İnteraktif Medya', NULL, 'Ve İnteraktif Medya', NULL, NULL, '', 0),
(4, '', '', '', 'ar', 'w22-4', 8, '', '', 1, '', NULL, 1, 0, NULL, '2026-01-20 17:23:27', NULL, '2026-01-20 17:23:38', 'Ve İnteraktif Medya', NULL, 'Ve İnteraktif Medya', NULL, NULL, '', 0),
(5, 'w22', '', '', 'en', 'w22-5', 9, '', '', 1, '', NULL, 1, 7, NULL, '2026-01-20 17:24:04', NULL, '2026-01-21 10:53:00', 'Ve İnteraktif Medya', NULL, 'Ve İnteraktif Medya', NULL, NULL, '', 0),
(5, '222', '', '', 'ar', 'w22-5', 10, '', '', 1, '', NULL, 1, 7, NULL, '2026-01-20 17:24:04', NULL, '2026-01-21 10:53:00', 'Ve İnteraktif Medya', NULL, 'Ve İnteraktif Medya', NULL, NULL, '', 0),
(6, 'test', '', '', 'en', 'test-6', 11, '', '', 1, '', NULL, 1, 4, NULL, '2026-01-20 17:42:18', NULL, '2026-01-21 10:52:56', 'Ve İnteraktif Medya', NULL, 'Ve İnteraktif Medya', NULL, NULL, '', 0),
(6, 'test', '', '', 'ar', 'test-6', 12, '', '', 1, '', NULL, 1, 4, NULL, '2026-01-20 17:42:18', NULL, '2026-01-21 10:52:56', 'Ve İnteraktif Medya', NULL, 'Ve İnteraktif Medya', NULL, NULL, '', 0),
(7, '83205', '', '', 'en', '83205-7', 13, '', '', 1, '', NULL, 0, 8, NULL, '2026-01-21 11:04:18', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83205&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83205-a&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(7, '83205', '', '', 'ar', '83205-7', 14, '', '', 1, '', NULL, 0, 8, NULL, '2026-01-21 11:04:18', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83205&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83205-a&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(8, '83205', '', '', 'en', '83205-8', 15, '', '', 1, '', NULL, 0, 8, NULL, '2026-01-21 11:04:21', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83205&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83205-a&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(8, '83205', '', '', 'ar', '83205-8', 16, '', '', 1, '', NULL, 0, 8, NULL, '2026-01-21 11:04:21', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83205&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83205-a&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(9, '83205', '', '', 'en', '83205-9', 17, '', '', 1, '', NULL, 0, 8, NULL, '2026-01-21 11:04:28', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83205&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83205-a&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(9, '83205', '', '', 'ar', '83205-9', 18, '', '', 1, '', NULL, 0, 8, NULL, '2026-01-21 11:04:28', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83205&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83205-a&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(10, '83205', '', '', 'en', '83205-10', 19, '', '', 1, '', NULL, 0, 6, NULL, '2026-01-21 11:04:32', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83205&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83205-a&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(10, '83205', '', '', 'ar', '83205-10', 20, '', '', 1, '', NULL, 0, 6, NULL, '2026-01-21 11:04:32', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83205&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83205-a&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(11, '83205', '', '', 'en', '83205-11', 21, '', '', 1, '', NULL, 0, 5, NULL, '2026-01-21 11:04:35', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83205&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83205-a&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(11, '83205', '', '', 'ar', '83205-11', 22, '', '', 1, '', NULL, 0, 5, NULL, '2026-01-21 11:04:35', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83205&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83205-a&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(12, '83206', '', '', 'en', '83206-12', 23, '', '', 1, '', NULL, 0, 9, NULL, '2026-01-21 11:05:07', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83206&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83206-a&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(12, '83206', '', '', 'ar', '83206-12', 24, '', '', 1, '', NULL, 0, 9, NULL, '2026-01-21 11:05:07', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83206&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83206-a&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(13, '83207', '', '', 'en', '83207-13', 25, '', '', 1, '', NULL, 0, 9, NULL, '2026-01-21 11:05:38', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83207&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83207-a&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(13, '83207', '', '', 'ar', '83207-13', 26, '', '', 1, '', NULL, 0, 9, NULL, '2026-01-21 11:05:38', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83207&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83207-a&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(14, '83208', '', '', 'en', '83208-14', 27, '', '', 1, '', NULL, 0, 6, NULL, '2026-01-21 11:06:06', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83208&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83208-b&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(14, '83208', '', '', 'ar', '83208-14', 28, '', '', 1, '', NULL, 0, 6, NULL, '2026-01-21 11:06:06', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83208&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83208-b&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(15, '83208', '', '', 'en', '83208-15', 29, '', '', 1, '', NULL, 0, 7, NULL, '2026-01-21 11:06:12', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83208&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83208-b&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(15, '83208', '', '', 'ar', '83208-15', 30, '', '', 1, '', NULL, 0, 7, NULL, '2026-01-21 11:06:12', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83208&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83208-b&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(16, '83208', '', '', 'en', '83208-16', 31, '', '', 0, '', NULL, 0, 4, NULL, '2026-01-21 11:06:14', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83208&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83208-b&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(16, '83208', '', '', 'ar', '83208-16', 32, '', '', 0, '', NULL, 0, 4, NULL, '2026-01-21 11:06:14', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83208&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83208-b&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(17, '83208', '', '', 'en', '83208-17', 33, '', '', 1, '', NULL, 0, 8, NULL, '2026-01-21 11:06:21', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83208&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83208-b&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(17, '83208', '', '', 'ar', '83208-17', 34, '', '', 1, '', NULL, 0, 8, NULL, '2026-01-21 11:06:21', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83208&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83208-b&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(18, '83208', '', '', 'en', '83208-18', 35, '', '', 1, '', NULL, 0, 4, NULL, '2026-01-21 11:06:28', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83208&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83208-b&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(18, '83208', '', '', 'ar', '83208-18', 36, '', '', 1, '', NULL, 0, 4, NULL, '2026-01-21 11:06:28', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83208&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83208-b&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(19, '83208', '', '', 'en', '83208-19', 37, '', '', 1, '', NULL, 0, 4, NULL, '2026-01-21 11:06:31', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83208&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83208-b&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(19, '83208', '', '', 'ar', '83208-19', 38, '', '', 1, '', NULL, 0, 4, NULL, '2026-01-21 11:06:31', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83208&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83208-b&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(20, '83208', '', '', 'en', '83208-20', 39, '', '', 1, '', NULL, 0, 5, NULL, '2026-01-21 11:06:33', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83208&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83208-b&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(20, '83208', '', '', 'ar', '83208-20', 40, '', '', 1, '', NULL, 0, 5, NULL, '2026-01-21 11:06:33', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83208&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83208-b&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(21, '83208', '', '', 'en', '83208-21', 41, '', '', 1, '', NULL, 0, 5, NULL, '2026-01-21 11:06:37', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83208&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83208-b&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(21, '83208', '', '', 'ar', '83208-21', 42, '', '', 1, '', NULL, 0, 5, NULL, '2026-01-21 11:06:37', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83208&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83208-b&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(22, '83208', '', '', 'en', '83208-22', 43, '', '', 1, '', NULL, 0, 6, NULL, '2026-01-21 11:06:40', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83208&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83208-b&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(22, '83208', '', '', 'ar', '83208-22', 44, '', '', 1, '', NULL, 0, 6, NULL, '2026-01-21 11:06:40', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83208&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83208-b&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(23, '83208', '', '', 'en', '83208-23', 45, '', '', 1, '', NULL, 0, 6, NULL, '2026-01-21 11:06:41', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83208&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83208-b&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(23, '83208', '', '', 'ar', '83208-23', 46, '', '', 1, '', NULL, 0, 6, NULL, '2026-01-21 11:06:41', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83208&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83208-b&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(24, '83208', '', '', 'en', '83208-24', 47, '', '', 1, '', NULL, 0, 7, NULL, '2026-01-21 11:06:47', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83208&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83208-b&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(24, '83208', '', '', 'ar', '83208-24', 48, '', '', 1, '', NULL, 0, 7, NULL, '2026-01-21 11:06:47', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83208&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83208-b&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(25, '83208', '', '', 'en', '83208-25', 49, '', '', 1, '', NULL, 0, 7, NULL, '2026-01-21 11:06:51', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83208&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83208-b&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(25, '83208', '', '', 'ar', '83208-25', 50, '', '', 1, '', NULL, 0, 7, NULL, '2026-01-21 11:06:51', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83208&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83208-b&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(26, '83208', '', '', 'en', '83208-26', 51, '', '', 1, '', NULL, 0, 8, NULL, '2026-01-21 11:06:59', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83208&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83208-b&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(26, '83208', '', '', 'ar', '83208-26', 52, '', '', 1, '', NULL, 0, 8, NULL, '2026-01-21 11:06:59', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83208&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83208-b&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(27, '83208', '', '', 'en', '83208-27', 53, '', '', 1, '', NULL, 0, 8, NULL, '2026-01-21 11:07:01', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83208&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83208-b&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(27, '83208', '', '', 'ar', '83208-27', 54, '', '', 1, '', NULL, 0, 8, NULL, '2026-01-21 11:07:01', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83208&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83208-b&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(28, '83208', '', '', 'en', '83208-28', 55, '', '', 1, '', NULL, 0, 9, NULL, '2026-01-21 11:07:05', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83208&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83208-b&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(28, '83208', '', '', 'ar', '83208-28', 56, '', '', 1, '', NULL, 0, 9, NULL, '2026-01-21 11:07:05', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83208&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83208-b&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0),
(29, '83208', '', '', 'en', '83208-29', 57, '', '', 1, '', NULL, 0, 9, NULL, '2026-01-21 11:07:08', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;Code&quot;,&quot;Width&quot;,&quot;Height&quot;],&quot;satirlar&quot;:[{&quot;Code&quot;:&quot;83208&quot;,&quot;Width&quot;:&quot;1000mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;},{&quot;Code&quot;:&quot;83208-b&quot;,&quot;Width&quot;:&quot;1200mm&quot;,&quot;Height&quot;:&quot;2000mm&quot;}]}', 0),
(29, '83208', '', '', 'ar', '83208-29', 58, '', '', 1, '', NULL, 0, 9, NULL, '2026-01-21 11:07:08', NULL, NULL, 'Ve İnteraktif Medya', NULL, NULL, NULL, NULL, '{&quot;kolonlar&quot;:[&quot;الرقم&quot;,&quot;عرض&quot;,&quot;ارتفاع&quot;],&quot;satirlar&quot;:[{&quot;الرقم&quot;:&quot;83208&quot;,&quot;عرض&quot;:&quot;1000mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;},{&quot;الرقم&quot;:&quot;83208-b&quot;,&quot;عرض&quot;:&quot;1200mm&quot;,&quot;ارتفاع&quot;:&quot;2000mm&quot;}]}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `uyeler`
--

CREATE TABLE `uyeler` (
  `id` smallint NOT NULL,
  `firma_adi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `adi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `telefon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sifre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `kayit_tarihi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `aktif` smallint DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `uzmankayit`
--

CREATE TABLE `uzmankayit` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `goruldu` smallint DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `uzmankayit_lang`
--

CREATE TABLE `uzmankayit_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `uzman_kayit`
--

CREATE TABLE `uzman_kayit` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `goruldu` smallint DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `adres` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `embed` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `videoresim` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `seri` smallint DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `video_lang`
--

CREATE TABLE `video_lang` (
  `lang_id` mediumint NOT NULL,
  `master_id` mediumint DEFAULT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `embed` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `adres` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `videoresim` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `seri` smallint DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `yedek_parca`
--

CREATE TABLE `yedek_parca` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `kid` int DEFAULT NULL,
  `aktif` smallint DEFAULT '0',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `yedek_parca_lang`
--

CREATE TABLE `yedek_parca_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '1',
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `yemek`
--

CREATE TABLE `yemek` (
  `id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sira` mediumint DEFAULT NULL,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'tr',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `resim` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `malzemeler` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `aktif` smallint DEFAULT '0',
  `pisirme` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `kisi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `hazirlanma` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `yemek_lang`
--

CREATE TABLE `yemek_lang` (
  `master_id` mediumint NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `detay` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `dil` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'en',
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `lang_id` int NOT NULL,
  `ozet` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `kisi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `malzemeler` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `pisirme` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `hazirlanma` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `aktif` smallint DEFAULT '1',
  `eklenme_tarihi` datetime DEFAULT NULL,
  `duzenleme_tarihi` datetime DEFAULT NULL,
  `silme_tarihi` datetime DEFAULT NULL,
  `sil` smallint DEFAULT '0',
  `tarih` date DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `ekleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `duzenleyen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `silen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin ROW_FORMAT=DYNAMIC;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alt_sayfa`
--
ALTER TABLE `alt_sayfa`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `alt_sayfa_lang`
--
ALTER TABLE `alt_sayfa_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `anket`
--
ALTER TABLE `anket`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `anket_cevap`
--
ALTER TABLE `anket_cevap`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `anket_secenek`
--
ALTER TABLE `anket_secenek`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `baglanti`
--
ALTER TABLE `baglanti`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `baglanti_lang`
--
ALTER TABLE `baglanti_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `basin`
--
ALTER TABLE `basin`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `basin_lang`
--
ALTER TABLE `basin_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `belge`
--
ALTER TABLE `belge`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `belge_kategori`
--
ALTER TABLE `belge_kategori`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `belge_kategori_lang`
--
ALTER TABLE `belge_kategori_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `belge_lang`
--
ALTER TABLE `belge_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE,
  ADD KEY `master_id` (`master_id`) USING BTREE;

--
-- Indexes for table `bilgi`
--
ALTER TABLE `bilgi`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `bilgiedinme`
--
ALTER TABLE `bilgiedinme`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `bilgiedinme_lang`
--
ALTER TABLE `bilgiedinme_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `bilgi_lang`
--
ALTER TABLE `bilgi_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `blog_lang`
--
ALTER TABLE `blog_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `boyutlar`
--
ALTER TABLE `boyutlar`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `bulten`
--
ALTER TABLE `bulten`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `ceviri`
--
ALTER TABLE `ceviri`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `ceviri_kategori`
--
ALTER TABLE `ceviri_kategori`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`CityID`) USING BTREE,
  ADD KEY `FK_City_CountryID` (`CountryID`) USING BTREE;

--
-- Indexes for table `destek`
--
ALTER TABLE `destek`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `destek_lang`
--
ALTER TABLE `destek_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `dosyalar`
--
ALTER TABLE `dosyalar`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `duyuru`
--
ALTER TABLE `duyuru`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `duyuru_lang`
--
ALTER TABLE `duyuru_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `d_kategori`
--
ALTER TABLE `d_kategori`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `d_kategori_lang`
--
ALTER TABLE `d_kategori_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `egitim`
--
ALTER TABLE `egitim`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `egitim_lang`
--
ALTER TABLE `egitim_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `emaillist`
--
ALTER TABLE `emaillist`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `etkinlik`
--
ALTER TABLE `etkinlik`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `etkinlik_lang`
--
ALTER TABLE `etkinlik_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `firmalar`
--
ALTER TABLE `firmalar`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `firsat`
--
ALTER TABLE `firsat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `firsat_lang`
--
ALTER TABLE `firsat_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `fuar`
--
ALTER TABLE `fuar`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fuar_lang`
--
ALTER TABLE `fuar_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `galeri_lang`
--
ALTER TABLE `galeri_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `haber`
--
ALTER TABLE `haber`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `haber_kategori`
--
ALTER TABLE `haber_kategori`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `haber_lang`
--
ALTER TABLE `haber_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `header_log`
--
ALTER TABLE `header_log`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `hikaye`
--
ALTER TABLE `hikaye`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `hikaye_lang`
--
ALTER TABLE `hikaye_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `hizmet`
--
ALTER TABLE `hizmet`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `hizmet_lang`
--
ALTER TABLE `hizmet_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `icerikler`
--
ALTER TABLE `icerikler`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `icerikler_lang`
--
ALTER TABLE `icerikler_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `isaret`
--
ALTER TABLE `isaret`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `isaret_lang`
--
ALTER TABLE `isaret_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `kampanya`
--
ALTER TABLE `kampanya`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kampanya_lang`
--
ALTER TABLE `kampanya_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `kariyer`
--
ALTER TABLE `kariyer`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kariyer_lang`
--
ALTER TABLE `kariyer_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `katalog`
--
ALTER TABLE `katalog`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `katalog_lang`
--
ALTER TABLE `katalog_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kategori_lang`
--
ALTER TABLE `kategori_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `koleksiyon`
--
ALTER TABLE `koleksiyon`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `koleksiyon_lang`
--
ALTER TABLE `koleksiyon_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `konu`
--
ALTER TABLE `konu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `konu_lang`
--
ALTER TABLE `konu_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kurs`
--
ALTER TABLE `kurs`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kurskayit`
--
ALTER TABLE `kurskayit`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kurskayit_lang`
--
ALTER TABLE `kurskayit_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `kurs_lang`
--
ALTER TABLE `kurs_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `kurum`
--
ALTER TABLE `kurum`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kurum_lang`
--
ALTER TABLE `kurum_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE,
  ADD KEY `master_id` (`master_id`) USING BTREE;

--
-- Indexes for table `marka`
--
ALTER TABLE `marka`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `marka_lang`
--
ALTER TABLE `marka_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `moduller`
--
ALTER TABLE `moduller`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `oda`
--
ALTER TABLE `oda`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `oda_lang`
--
ALTER TABLE `oda_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `ozellik`
--
ALTER TABLE `ozellik`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `ozellik_lang`
--
ALTER TABLE `ozellik_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `popup`
--
ALTER TABLE `popup`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `popup_lang`
--
ALTER TABLE `popup_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `proje`
--
ALTER TABLE `proje`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `proje_kategori`
--
ALTER TABLE `proje_kategori`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `proje_kategori_lang`
--
ALTER TABLE `proje_kategori_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `proje_lang`
--
ALTER TABLE `proje_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `rakam`
--
ALTER TABLE `rakam`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `rakam_lang`
--
ALTER TABLE `rakam_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `referans`
--
ALTER TABLE `referans`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `referans_lang`
--
ALTER TABLE `referans_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `reyon`
--
ALTER TABLE `reyon`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `reyon_lang`
--
ALTER TABLE `reyon_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `sayac`
--
ALTER TABLE `sayac`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sayfa`
--
ALTER TABLE `sayfa`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sayfakategori`
--
ALTER TABLE `sayfakategori`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sayfakategori_lang`
--
ALTER TABLE `sayfakategori_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `sayfa_lang`
--
ALTER TABLE `sayfa_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `sehirler`
--
ALTER TABLE `sehirler`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sektor`
--
ALTER TABLE `sektor`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sektor_lang`
--
ALTER TABLE `sektor_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `servis_ekipmani`
--
ALTER TABLE `servis_ekipmani`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `servis_ekipmani_kategori`
--
ALTER TABLE `servis_ekipmani_kategori`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `servis_ekipmani_kategori_lang`
--
ALTER TABLE `servis_ekipmani_kategori_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `servis_ekipmani_lang`
--
ALTER TABLE `servis_ekipmani_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `siparis`
--
ALTER TABLE `siparis`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `siparis_log`
--
ALTER TABLE `siparis_log`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `slayt`
--
ALTER TABLE `slayt`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `slayt_lang`
--
ALTER TABLE `slayt_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `sorular`
--
ALTER TABLE `sorular`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sorular_lang`
--
ALTER TABLE `sorular_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `sozluk`
--
ALTER TABLE `sozluk`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sozluk_lang`
--
ALTER TABLE `sozluk_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `sube`
--
ALTER TABLE `sube`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sube_lang`
--
ALTER TABLE `sube_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `talep`
--
ALTER TABLE `talep`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `temalar`
--
ALTER TABLE `temalar`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `temalar_lang`
--
ALTER TABLE `temalar_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `town`
--
ALTER TABLE `town`
  ADD PRIMARY KEY (`TownID`) USING BTREE,
  ADD KEY `FK_Town_CityID` (`CityID`) USING BTREE;

--
-- Indexes for table `urun`
--
ALTER TABLE `urun`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `urun_lang`
--
ALTER TABLE `urun_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE,
  ADD KEY `master_id` (`master_id`) USING BTREE;

--
-- Indexes for table `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `uzmankayit`
--
ALTER TABLE `uzmankayit`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `uzmankayit_lang`
--
ALTER TABLE `uzmankayit_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `uzman_kayit`
--
ALTER TABLE `uzman_kayit`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `video_lang`
--
ALTER TABLE `video_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `yedek_parca`
--
ALTER TABLE `yedek_parca`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `yedek_parca_lang`
--
ALTER TABLE `yedek_parca_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Indexes for table `yemek`
--
ALTER TABLE `yemek`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `yemek_lang`
--
ALTER TABLE `yemek_lang`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alt_sayfa`
--
ALTER TABLE `alt_sayfa`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alt_sayfa_lang`
--
ALTER TABLE `alt_sayfa_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anket`
--
ALTER TABLE `anket`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anket_cevap`
--
ALTER TABLE `anket_cevap`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anket_secenek`
--
ALTER TABLE `anket_secenek`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `baglanti`
--
ALTER TABLE `baglanti`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `baglanti_lang`
--
ALTER TABLE `baglanti_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `basin`
--
ALTER TABLE `basin`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `basin_lang`
--
ALTER TABLE `basin_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `belge`
--
ALTER TABLE `belge`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `belge_kategori`
--
ALTER TABLE `belge_kategori`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `belge_kategori_lang`
--
ALTER TABLE `belge_kategori_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `belge_lang`
--
ALTER TABLE `belge_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bilgi`
--
ALTER TABLE `bilgi`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bilgiedinme`
--
ALTER TABLE `bilgiedinme`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bilgiedinme_lang`
--
ALTER TABLE `bilgiedinme_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bilgi_lang`
--
ALTER TABLE `bilgi_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_lang`
--
ALTER TABLE `blog_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `boyutlar`
--
ALTER TABLE `boyutlar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `bulten`
--
ALTER TABLE `bulten`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ceviri`
--
ALTER TABLE `ceviri`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ceviri_kategori`
--
ALTER TABLE `ceviri_kategori`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `CityID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `destek`
--
ALTER TABLE `destek`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `destek_lang`
--
ALTER TABLE `destek_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosyalar`
--
ALTER TABLE `dosyalar`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `duyuru`
--
ALTER TABLE `duyuru`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `duyuru_lang`
--
ALTER TABLE `duyuru_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `d_kategori`
--
ALTER TABLE `d_kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `d_kategori_lang`
--
ALTER TABLE `d_kategori_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `egitim`
--
ALTER TABLE `egitim`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `egitim_lang`
--
ALTER TABLE `egitim_lang`
  MODIFY `lang_id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emaillist`
--
ALTER TABLE `emaillist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `etkinlik`
--
ALTER TABLE `etkinlik`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `etkinlik_lang`
--
ALTER TABLE `etkinlik_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `firmalar`
--
ALTER TABLE `firmalar`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `firsat`
--
ALTER TABLE `firsat`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `firsat_lang`
--
ALTER TABLE `firsat_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuar`
--
ALTER TABLE `fuar`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuar_lang`
--
ALTER TABLE `fuar_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `galeri_lang`
--
ALTER TABLE `galeri_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `haber`
--
ALTER TABLE `haber`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `haber_kategori`
--
ALTER TABLE `haber_kategori`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `haber_lang`
--
ALTER TABLE `haber_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `header_log`
--
ALTER TABLE `header_log`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hikaye`
--
ALTER TABLE `hikaye`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hikaye_lang`
--
ALTER TABLE `hikaye_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hizmet`
--
ALTER TABLE `hizmet`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hizmet_lang`
--
ALTER TABLE `hizmet_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `icerikler`
--
ALTER TABLE `icerikler`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `icerikler_lang`
--
ALTER TABLE `icerikler_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `isaret`
--
ALTER TABLE `isaret`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `isaret_lang`
--
ALTER TABLE `isaret_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kampanya`
--
ALTER TABLE `kampanya`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kampanya_lang`
--
ALTER TABLE `kampanya_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kariyer`
--
ALTER TABLE `kariyer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kariyer_lang`
--
ALTER TABLE `kariyer_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `katalog`
--
ALTER TABLE `katalog`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `katalog_lang`
--
ALTER TABLE `katalog_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `kategori_lang`
--
ALTER TABLE `kategori_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `koleksiyon`
--
ALTER TABLE `koleksiyon`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `koleksiyon_lang`
--
ALTER TABLE `koleksiyon_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konu`
--
ALTER TABLE `konu`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konu_lang`
--
ALTER TABLE `konu_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kurs`
--
ALTER TABLE `kurs`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kurskayit`
--
ALTER TABLE `kurskayit`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kurskayit_lang`
--
ALTER TABLE `kurskayit_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kurs_lang`
--
ALTER TABLE `kurs_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kurum`
--
ALTER TABLE `kurum`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kurum_lang`
--
ALTER TABLE `kurum_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marka`
--
ALTER TABLE `marka`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marka_lang`
--
ALTER TABLE `marka_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `moduller`
--
ALTER TABLE `moduller`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `oda`
--
ALTER TABLE `oda`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oda_lang`
--
ALTER TABLE `oda_lang`
  MODIFY `lang_id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ozellik`
--
ALTER TABLE `ozellik`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ozellik_lang`
--
ALTER TABLE `ozellik_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `popup`
--
ALTER TABLE `popup`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `popup_lang`
--
ALTER TABLE `popup_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proje`
--
ALTER TABLE `proje`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proje_kategori`
--
ALTER TABLE `proje_kategori`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proje_kategori_lang`
--
ALTER TABLE `proje_kategori_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proje_lang`
--
ALTER TABLE `proje_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rakam`
--
ALTER TABLE `rakam`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rakam_lang`
--
ALTER TABLE `rakam_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `referans`
--
ALTER TABLE `referans`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referans_lang`
--
ALTER TABLE `referans_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reyon`
--
ALTER TABLE `reyon`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reyon_lang`
--
ALTER TABLE `reyon_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sayac`
--
ALTER TABLE `sayac`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sayfa`
--
ALTER TABLE `sayfa`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sayfakategori`
--
ALTER TABLE `sayfakategori`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sayfakategori_lang`
--
ALTER TABLE `sayfakategori_lang`
  MODIFY `lang_id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sayfa_lang`
--
ALTER TABLE `sayfa_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sehirler`
--
ALTER TABLE `sehirler`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `sektor`
--
ALTER TABLE `sektor`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sektor_lang`
--
ALTER TABLE `sektor_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servis_ekipmani`
--
ALTER TABLE `servis_ekipmani`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servis_ekipmani_kategori`
--
ALTER TABLE `servis_ekipmani_kategori`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servis_ekipmani_kategori_lang`
--
ALTER TABLE `servis_ekipmani_kategori_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servis_ekipmani_lang`
--
ALTER TABLE `servis_ekipmani_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siparis`
--
ALTER TABLE `siparis`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siparis_log`
--
ALTER TABLE `siparis_log`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slayt`
--
ALTER TABLE `slayt`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slayt_lang`
--
ALTER TABLE `slayt_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sorular`
--
ALTER TABLE `sorular`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sorular_lang`
--
ALTER TABLE `sorular_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sozluk`
--
ALTER TABLE `sozluk`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sozluk_lang`
--
ALTER TABLE `sozluk_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sube`
--
ALTER TABLE `sube`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sube_lang`
--
ALTER TABLE `sube_lang`
  MODIFY `lang_id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `talep`
--
ALTER TABLE `talep`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temalar`
--
ALTER TABLE `temalar`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temalar_lang`
--
ALTER TABLE `temalar_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `town`
--
ALTER TABLE `town`
  MODIFY `TownID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `urun`
--
ALTER TABLE `urun`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `urun_lang`
--
ALTER TABLE `urun_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uzmankayit`
--
ALTER TABLE `uzmankayit`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uzmankayit_lang`
--
ALTER TABLE `uzmankayit_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uzman_kayit`
--
ALTER TABLE `uzman_kayit`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_lang`
--
ALTER TABLE `video_lang`
  MODIFY `lang_id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `yedek_parca`
--
ALTER TABLE `yedek_parca`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `yedek_parca_lang`
--
ALTER TABLE `yedek_parca_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `yemek`
--
ALTER TABLE `yemek`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `yemek_lang`
--
ALTER TABLE `yemek_lang`
  MODIFY `lang_id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
