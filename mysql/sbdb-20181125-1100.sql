-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- 생성 시간: 18-11-25 12:56
-- 서버 버전: 5.7.24-0ubuntu0.16.04.1
-- PHP 버전: 7.0.32-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `sbdb`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `audio_table`
--

CREATE TABLE `audio_table` (
  `file_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name_orig` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `name_save` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `store_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `audio_msg` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `ip_address` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `bell_number` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 테이블 구조 `event_table`
--

CREATE TABLE `event_table` (
  `file_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `event_date` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `store_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `event_msg` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `ip_address` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `bell_number` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 테이블 구조 `store_info`
--

CREATE TABLE `store_info` (
  `id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `audio_table`
--
ALTER TABLE `audio_table`
  ADD PRIMARY KEY (`file_id`);

--
-- 테이블의 인덱스 `event_table`
--
ALTER TABLE `event_table`
  ADD PRIMARY KEY (`file_id`);

--
-- 테이블의 인덱스 `store_info`
--
ALTER TABLE `store_info`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
