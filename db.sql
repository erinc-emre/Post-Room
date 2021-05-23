-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 22 May 2021, 18:11:13
-- Sunucu sürümü: 10.4.17-MariaDB
-- PHP Sürümü: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `assignment`
--

CREATE TABLE `assignment` (
  `assignmentId` int(11) NOT NULL,
  `deadline` datetime NOT NULL,
  `responseText` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `responseLink` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `contentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `assignmentresults`
--

CREATE TABLE `assignmentresults` (
  `assignmentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comment`
--

CREATE TABLE `comment` (
  `commentId` int(11) NOT NULL,
  `commentOwnerId` int(11) NOT NULL,
  `commentText` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `commentDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `content`
--

CREATE TABLE `content` (
  `contentId` int(11) NOT NULL,
  `roomId` int(11) NOT NULL,
  `publishedDate` datetime NOT NULL,
  `contentTitle` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `contentText` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `additionalLink` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `postOwnerId` int(11) NOT NULL,
  `typeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `post`
--

CREATE TABLE `post` (
  `postId` int(11) NOT NULL,
  `contentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `registration`
--

CREATE TABLE `registration` (
  `registrationId` int(11) NOT NULL,
  `roomId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `role` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `registrationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `room`
--

CREATE TABLE `room` (
  `roomId` int(11) NOT NULL,
  `roomName` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `description` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `launchDate` datetime NOT NULL,
  `closeDate` datetime NOT NULL,
  `sharebleCode` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `roomPhoto` longblob NOT NULL,
  `isArchived` tinyint(1) NOT NULL,
  `sharebleQRcode` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `type`
--

CREATE TABLE `type` (
  `typeId` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `fName` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `lName` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `sex` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `registerDate` datetime NOT NULL,
  `status` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `profilePhoto` longblob NOT NULL,
  `institution` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `department` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `DOB` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`assignmentId`);

--
-- Tablo için indeksler `assignmentresults`
--
ALTER TABLE `assignmentresults`
  ADD PRIMARY KEY (`assignmentId`);

--
-- Tablo için indeksler `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentId`);

--
-- Tablo için indeksler `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`contentId`);

--
-- Tablo için indeksler `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postId`);

--
-- Tablo için indeksler `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`registrationId`);

--
-- Tablo için indeksler `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomId`);

--
-- Tablo için indeksler `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`typeId`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `assignment`
--
ALTER TABLE `assignment`
  MODIFY `assignmentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `assignmentresults`
--
ALTER TABLE `assignmentresults`
  MODIFY `assignmentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `comment`
--
ALTER TABLE `comment`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `content`
--
ALTER TABLE `content`
  MODIFY `contentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `post`
--
ALTER TABLE `post`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `registration`
--
ALTER TABLE `registration`
  MODIFY `registrationId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `room`
--
ALTER TABLE `room`
  MODIFY `roomId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `type`
--
ALTER TABLE `type`
  MODIFY `typeId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
