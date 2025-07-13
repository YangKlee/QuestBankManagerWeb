-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 13, 2025 lúc 11:08 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `questbankmanager`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `question`
--

CREATE TABLE `question` (
  `QuestionID` int(11) NOT NULL,
  `STT` int(11) DEFAULT NULL,
  `IDBank` int(11) NOT NULL,
  `Title` varchar(1000) DEFAULT NULL,
  `Ans1` varchar(1000) DEFAULT NULL,
  `Ans2` varchar(1000) DEFAULT NULL,
  `Ans3` varchar(1000) DEFAULT NULL,
  `Ans4` varchar(1000) DEFAULT NULL,
  `CorrectAns` int(11) DEFAULT NULL,
  `Comment` varchar(1000) DEFAULT NULL,
  `TimeCreated` datetime DEFAULT current_timestamp(),
  `UserCreated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `questionbank`
--

CREATE TABLE `questionbank` (
  `IDBank` int(11) NOT NULL,
  `NameBank` varchar(255) NOT NULL,
  `TimeCreated` datetime DEFAULT current_timestamp(),
  `UserCreated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `userdata`
--

CREATE TABLE `userdata` (
  `UID` int(11) NOT NULL,
  `UserName` varchar(255) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `role` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `userdata`
--

INSERT INTO `userdata` (`UID`, `UserName`, `Password`, `role`) VALUES
(1, 'test', 'test', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`QuestionID`,`IDBank`),
  ADD UNIQUE KEY `STT` (`STT`),
  ADD KEY `IDBank` (`IDBank`),
  ADD KEY `UserCreated` (`UserCreated`);

--
-- Chỉ mục cho bảng `questionbank`
--
ALTER TABLE `questionbank`
  ADD PRIMARY KEY (`IDBank`),
  ADD KEY `UserCreated` (`UserCreated`);

--
-- Chỉ mục cho bảng `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`UID`),
  ADD UNIQUE KEY `UserName` (`UserName`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `question`
--
ALTER TABLE `question`
  MODIFY `QuestionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `questionbank`
--
ALTER TABLE `questionbank`
  MODIFY `IDBank` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `userdata`
--
ALTER TABLE `userdata`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`IDBank`) REFERENCES `questionbank` (`IDBank`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `question_ibfk_2` FOREIGN KEY (`UserCreated`) REFERENCES `userdata` (`UID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `questionbank`
--
ALTER TABLE `questionbank`
  ADD CONSTRAINT `questionbank_ibfk_1` FOREIGN KEY (`UserCreated`) REFERENCES `userdata` (`UID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
