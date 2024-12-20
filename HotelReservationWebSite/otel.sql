-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 18 Ara 2024, 00:30:23
-- Sunucu sürümü: 5.7.17
-- PHP Sürümü: 8.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `otel`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `ad` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `soyad` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `eposta` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `sifre` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `yonetici_mi` tinyint(1) DEFAULT '0',
  `olusturulma_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `ad`, `soyad`, `eposta`, `sifre`, `yonetici_mi`, `olusturulma_tarihi`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '$2y$10$UXDjHo3ZkreezP/IgnIibOXWP4ZIeVxK4W2U/.JJpbRZUk0GJ4c4W', 1, '2024-12-10 22:52:35'),
(2, 'Arda', 'Demiray', 'ardademiray62@gmail.com', '$2y$10$RZBzNkRCfJFus31m5Zd/WOjuIYLUM4X.3SRu9ijwtzBuGrHMy7s4q', 0, '2024-12-11 22:05:57'),
(3, 'Utku', 'Ã–zkiÅŸi', 'utku@gmail.com', '$2y$10$PhdeCo/65E2D/HyXzApy9em/OasJkOmc7bdfJpnCIUySm8ked/hSW', 0, '2024-12-12 21:00:59'),
(4, 'Ali', 'Veli', 'aliveli@gmail.com', '$2y$10$plc1GbwyJX5PONoValKBn.xHZrFELquCXck7Ti9pNCyBgeRxUPymW', 0, '2024-12-15 22:45:03'),
(6, 'KaÄŸan', 'ArslangÃ¶rÃ¼r', 'kaan@gmail.com', '$2y$10$EFRLpsbuV.rs6AhToz.1COKqFDXfZLB1Fj4jI21jzqo5DeVEeXiDW', 0, '2024-12-17 22:47:21');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `odalar`
--

CREATE TABLE `odalar` (
  `id` int(11) NOT NULL,
  `oda_adi` varchar(255) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `oda_turu` varchar(255) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `fiyat` decimal(10,2) DEFAULT NULL,
  `kapasite` int(11) DEFAULT NULL,
  `aciklama` text COLLATE utf8mb4_turkish_ci,
  `olusturulma_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `musait` tinyint(1) DEFAULT NULL,
  `resim_yolu` varchar(255) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `odaSayisi` int(11) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `odalar`
--

INSERT INTO `odalar` (`id`, `oda_adi`, `oda_turu`, `fiyat`, `kapasite`, `aciklama`, `olusturulma_tarihi`, `musait`, `resim_yolu`, `odaSayisi`) VALUES
(1, 'Deluxe Oda', 'Deluxe', 1200.00, 2, 'Geniş yatak ve premium olanaklarla lüks bir deneyim sunan deluxe oda.', '2024-12-11 21:47:54', 1, 'Images/deluxe-room.jpg', 11),
(2, 'Suit Oda', 'Suit', 2000.00, 4, 'Modern dekorasyon ve konforlu yaşam alanı sunan geniş suit oda.', '2024-12-11 21:47:54', 1, 'Images/suite-room.jpg', 9),
(3, 'Kral Dairesi', 'Kral Dairesi', 5000.00, 2, 'Özel hizmetler ve geniş alan sunan, en lüks kral dairesi.', '2024-12-11 21:47:54', 1, 'Images/presidential-suite.jpg', 1),
(4, 'Deniz Manzaralı Oda', 'Deniz Manzaralı', 1500.00, 2, 'Eşsiz deniz manzarasına sahip lüks tasarımlı bir oda.', '2024-12-11 21:47:54', 1, 'Images/ocean-view.jpg', 8),
(5, 'Aile Odası', 'Aile', 2500.00, 5, 'Geniş ve konforlu alanıyla ailelere özel tasarlanmış oda.', '2024-12-11 21:47:54', 1, 'Images/family-room.jpg', 9),
(6, 'Ekonomik Oda', 'Ekonomik', 850.00, 2, 'Lüks otel kalitesinde bütçe dostu ekonomik oda.', '2024-12-11 21:47:54', 1, 'Images/economy-room.jpg', 18);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rezervasyonlar`
--

CREATE TABLE `rezervasyonlar` (
  `id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `oda_id` int(11) NOT NULL,
  `oda_turu` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `giris_tarihi` date NOT NULL,
  `cikis_tarihi` date NOT NULL,
  `olusturulma_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gece_sayisi` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `rezervasyonlar`
--

INSERT INTO `rezervasyonlar` (`id`, `kullanici_id`, `oda_id`, `oda_turu`, `giris_tarihi`, `cikis_tarihi`, `olusturulma_tarihi`, `gece_sayisi`) VALUES
(14, 3, 3, 'Kral Dairesi', '2024-12-18', '2024-12-31', '2024-12-17 23:29:13', 13),
(8, 5, 1, 'Deluxe', '2024-12-16', '2024-12-17', '2024-12-15 23:19:30', 1),
(12, 6, 1, 'Deluxe', '2024-12-20', '2024-12-22', '2024-12-17 23:19:25', 2),
(11, 3, 5, 'Aile', '2024-12-18', '2024-12-21', '2024-12-17 23:14:24', 3),
(13, 6, 3, 'Kral Dairesi', '2024-12-18', '2024-12-25', '2024-12-17 23:20:57', 7);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `eposta` (`eposta`);

--
-- Tablo için indeksler `odalar`
--
ALTER TABLE `odalar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `rezervasyonlar`
--
ALTER TABLE `rezervasyonlar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kullanici_id` (`kullanici_id`),
  ADD KEY `fk_oda` (`oda_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `odalar`
--
ALTER TABLE `odalar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `rezervasyonlar`
--
ALTER TABLE `rezervasyonlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
