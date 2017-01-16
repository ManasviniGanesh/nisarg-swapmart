-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2017 at 12:25 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swapmart`
--
CREATE DATABASE IF NOT EXISTS `swapmart` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `swapmart`;

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `add_id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `title_of_add` varchar(30) NOT NULL,
  `add_status` varchar(20) NOT NULL,
  `rent` varchar(20) NOT NULL DEFAULT 'AVAILABLE',
  `category` varchar(15) NOT NULL DEFAULT 'others' COMMENT 'notes,books,qpaper,stationary,electronics,movies,others,quantum,decode',
  `price_status` tinyint(1) NOT NULL COMMENT '0-free,1-rent,2-sale',
  `cost` smallint(6) NOT NULL,
  `pic_upload_dir` varchar(5000) NOT NULL,
  `description` varchar(140) DEFAULT NULL,
  `posted_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='advertisement description';

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`add_id`, `username`, `title_of_add`, `add_status`, `rent`, `category`, `price_status`, `cost`, `pic_upload_dir`, `description`, `posted_time`) VALUES
(3, 'manu', 'Drafter', 'posted', '', 'stationary', 2, 75, 'add_uploads/drafter.jpg', 'good condition. Red colored. No pencil marks on set.', '2017-01-03 19:37:18'),
(4, 'manu', 'Movie CDs', 'posted', '1', 'movies', 1, 50, 'add_uploads/13.jpg', 'Super hit movie - Bahubali', '2017-01-03 19:40:09'),
(5, 'manu', 'Photo frames', 'posted', '', 'others', 2, 700, 'add_uploads/14.jpg', 'Nice glass photo frames created by me.', '2017-01-03 19:41:10'),
(6, 'steve', 'fancy shoes', 'posted', '', 'others', 2, 50, 'add_uploads/8.jpg', 'These are really cool shoes for boys. Can be worn on many occasions.', '2017-01-03 19:08:51'),
(7, 'steve', 'Formal Shirt', 'posted', '0', 'others', 1, 180, 'add_uploads/20.jpg', '3rd and 4th year students may need formal shirts for many occasions. I have a good formal shirt. Do try.', '2017-01-04 21:21:09'),
(8, 'manu', 'chocolates', 'posted', '', 'others', 0, 0, 'add_uploads/15.jpg', 'I love Belgian Chocolates so much !!', '2017-01-03 20:32:06'),
(9, 'yachu', 'tie', 'posted', '', 'others', 2, 35, 'add_uploads/18.jpg', 'good fabric', '2017-01-03 20:37:03'),
(10, 'yachu', 'clock', 'posted', '1', 'electronics', 1, 98, 'add_uploads/sample-image.jpg', 'nice fancy stuff', '2017-01-03 21:32:12'),
(11, 'yachu', 'books', 'posted', '', 'books', 2, 807, 'add_uploads/books.jpg', 'great books', '2017-01-03 20:52:00'),
(12, 'yachu', 'quantum theory notes', 'posted', '', 'notes', 0, 0, 'add_uploads/notes.gif', 'by Quantum Mechanics Professor', '2017-01-03 20:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `add_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `title_of_add` varchar(20) NOT NULL,
  `cost` int(11) NOT NULL,
  `rent` varchar(1) DEFAULT NULL,
  `pic_upload_dir` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Bookmark feeds';

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`add_id`, `username`, `title_of_add`, `cost`, `rent`, `pic_upload_dir`) VALUES
(3, 'yachu', 'Drafter', 75, '', 'add_uploads/drafter.jpg'),
(4, 'morstan', 'Movie CDs', 50, '1', 'add_uploads/13.jpg'),
(4, 'steve', 'Movie CDs', 50, '1', 'add_uploads/13.jpg'),
(5, 'yachu', 'Photo frames', 700, '', 'add_uploads/14.jpg'),
(6, 'yachu', 'fancy shoes', 50, '', 'add_uploads/8.jpg'),
(7, 'manu', 'Formal Shirt', 180, '1', 'add_uploads/20.jpg'),
(10, 'manu', 'clock', 98, '1', 'add_uploads/sample-image.jpg'),
(10, 'morstan', 'clock', 98, '1', 'add_uploads/sample-image.jpg'),
(11, '', 'books', 807, '', 'add_uploads/books.jpg'),
(11, 'steve', 'books', 807, '', 'add_uploads/books.jpg'),
(12, '', 'quantum theory notes', 0, '', 'add_uploads/notes.gif'),
(12, 'steve', 'quantum theory notes', 0, '', 'add_uploads/notes.gif'),
(14, 'ganu', 'somte', 50, '', '../../add_uploads/ganu_.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `chatbox`
--

CREATE TABLE `chatbox` (
  `add_id` int(11) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `advertUname` varchar(20) NOT NULL,
  `chat` longtext NOT NULL,
  `status` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Chat records';

--
-- Dumping data for table `chatbox`
--

INSERT INTO `chatbox` (`add_id`, `uname`, `advertUname`, `chat`, `status`) VALUES
(3, 'yachu', 'manu', '[11 Jan 2017 02:00:34] yachu:can u give me this for more discount??<br/>[11 Jan 2017 02:20:11] yachu:price?<br/>[11 Jan 2017 02:21:12] manu:ok<br/>[11 Jan 2017 02:22:09] manu:maybe -10% off<br/>[11 Jan 2017 02:49:15] yachu:awee thankeww muah !!<br/>[11 Jan 2017 02:50:01] manu:ur wlcm<br/><br/><-----##--READ--BY--ADVERTISER--##-----><br/><br/>', 'read'),
(4, 'steve', 'manu', '[11 Jan 2017 17:12:49] steve:i want to buy these<br/><br/><-----##--READ--BY--ADVERTISER--##-----><br/><br/>', 'read'),
(7, 'manu', 'steve', '[10 Jan 2017 23:27:18] manu:where can we meet to get this?<br/>[10 Jan 2017 23:27:35] manu:?<br/><-----##--READ--BY--ADVERTISER--##-----><br/>[11 Jan 2017 03:21:25] steve:from lifestyle<br/><br/><-----##--READ--BY--USER--##-----><br/><br/>', 'read'),
(10, 'manu', 'yachu', '[11 Jan 2017 00:55:43] manu:beautiful!<br/><br/><-----##--READ--BY--ADVERTISER--##-----><br/><br/>', 'read'),
(10, 'musket', 'yachu', '<br/><br/><-----##--musket--DELETED--SWAPMART--ACCOUNT--##-----><br/><br/><br/><br/><-----##--READ--BY--ADVERTISER--##-----><br/><br/>', 'read'),
(11, 'musket', 'yachu', '<br/><br/><-----##--musket--DELETED--SWAPMART--ACCOUNT--##-----><br/><br/><br/>[11 Jan 2017 19:53:21] yachu:^_^', 'reply');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL COMMENT 'username of user',
  `password` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=deleted;(-1)=blocked;1=active and normal;2=un verified;',
  `feedback` varchar(140) DEFAULT NULL,
  `num_of_add` int(3) NOT NULL DEFAULT '0',
  `admin` varchar(6) NOT NULL DEFAULT 'user',
  `demo` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='user data';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `password`, `email`, `mobile`, `status`, `feedback`, `num_of_add`, `admin`, `demo`) VALUES
(10, 'Ganesh', 'Iyer', 'ganu', 'O5tr@c0n', 'ganeshkiyer@gmail.com', 9768302499, 1, NULL, 1, 'user', 0),
(6, 'jan', 'uary', 'janu', 'O5tr@c0n', 'jan@uary.com', 9999999984, 1, 'try', 0, 'user', 0),
(7, 'Kittu', 'Sundari', 'kittu', 'O5tr@c0n', 'kittu@sunadri.com', 7650614148, 2, NULL, 0, 'user', 0),
(1, 'Manasvini', 'Ganesh', 'manu', 'M@nas1995', 'manasviniganesh@gmail.com', 8414160569, 1, 'trial', 4, 'master', 0),
(5, 'Morgan', 'Stanley', 'morstan', 'O5tr@c0n', 'morgan@stanley.com', 9968302444, 1, NULL, 0, 'user', 0),
(4, 'Elon', 'Musk', 'musket', 'O5tr@c0n', 'elon@musk.com', 9968302477, 0, 'musket trial', 0, 'user', 0),
(9, 'Nelson', 'Mandela', 'nelman', 'O5tr@c0n', 'nelson@mandela.com', 4650614148, 1, NULL, 1, 'user', 0),
(3, 'Steeve', 'Jobs', 'steve', 'O5tr@c0n', 'steve@jobs.com', 9968302498, 1, NULL, 4, 'admin', 0),
(8, 'William', 'Wordsworth', 'william', 'O5tr@c0n', 'willi@am.com', 8650614148, 2, NULL, 0, 'user', 0),
(2, 'Yashasvini', 'Ganesh', 'yachu', 'Y@shas2005', 'yashasviniganesh@gmail.com', 9968302499, 1, NULL, 4, 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_do_not_login`
--

CREATE TABLE `user_do_not_login` (
  `username` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '-1=blocked;and 0 = deleted;',
  `reason_for_no_access` varchar(25) NOT NULL,
  `when_no_access` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_do_not_login`
--

INSERT INTO `user_do_not_login` (`username`, `status`, `reason_for_no_access`, `when_no_access`) VALUES
('musket', 0, 'deleted', '2017-01-11 14:22:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`add_id`),
  ADD UNIQUE KEY `add_id` (`add_id`);

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`add_id`,`username`);

--
-- Indexes for table `chatbox`
--
ALTER TABLE `chatbox`
  ADD PRIMARY KEY (`add_id`,`uname`,`advertUname`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user_do_not_login`
--
ALTER TABLE `user_do_not_login`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `add_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
