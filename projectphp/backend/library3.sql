-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2017 at 08:11 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library3`
--

-- --------------------------------------------------------

--
-- Table structure for table `gerne`
--

CREATE TABLE `gerne` (
  `gerneID` int(11) NOT NULL,
  `gerneName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gerne`
--

INSERT INTO `gerne` (`gerneID`, `gerneName`) VALUES
(5, 'comedy'),
(6, 'adventure'),
(7, 'biography'),
(8, 'fantasy'),
(9, 'crime'),
(10, 'horror'),
(11, 'historical'),
(12, 'politica'),
(13, 'science fiction'),
(14, 'action'),
(15, 'thriller'),
(16, 'war'),
(17, 'animation'),
(18, 'musical'),
(19, 'mystery'),
(20, 'documentary'),
(21, 'drama'),
(22, 'drama'),
(23, '');

-- --------------------------------------------------------

--
-- Table structure for table `gerne_movie`
--

CREATE TABLE `gerne_movie` (
  `gerneID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gerne_movie`
--

INSERT INTO `gerne_movie` (`gerneID`, `movieID`) VALUES
(10, 24),
(19, 25),
(5, 28),
(21, 32),
(14, 33);

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `movieID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `make` varchar(255) NOT NULL,
  `nameOfDirector` varchar(255) NOT NULL,
  `yearOfPremier` int(4) NOT NULL,
  `onloan` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`movieID`, `title`, `make`, `nameOfDirector`, `yearOfPremier`, `onloan`) VALUES
(24, 'Killing Ground', 'film', 'Damien Power', 2016, 0),
(25, 'Sense8', 'series', 'J. Michael', 2015, 0),
(28, 'Girls Trip', 'film', 'Malcolm D. Lee', 2017, 0),
(32, 'The View', 'series', 'Whoopi Goldberg', 2017, 1),
(33, 'Fast &amp; furious', 'film', 'Justin lin', 2020, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `groupID` int(3) NOT NULL,
  `userName` varchar(40) NOT NULL,
  `userPass` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `groupID`, `userName`, `userPass`) VALUES
(1, 1, 'admin', 'f865b53623b121fd34ee5426c792e5c33af8c227'),
(2, 2, 'member', 'd5ba8948074cdbf36d17f61c8f3f077256e04fb3');

-- --------------------------------------------------------

--
-- Table structure for table `usergroup`
--

CREATE TABLE `usergroup` (
  `groupID` int(3) NOT NULL,
  `userGroup` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usergroup`
--

INSERT INTO `usergroup` (`groupID`, `userGroup`) VALUES
(1, 'Administrator'),
(2, 'Member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gerne`
--
ALTER TABLE `gerne`
  ADD PRIMARY KEY (`gerneID`);

--
-- Indexes for table `gerne_movie`
--
ALTER TABLE `gerne_movie`
  ADD KEY `authorID` (`gerneID`),
  ADD KEY `bookID` (`movieID`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movieID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD KEY `groupID` (`groupID`);

--
-- Indexes for table `usergroup`
--
ALTER TABLE `usergroup`
  ADD PRIMARY KEY (`groupID`),
  ADD UNIQUE KEY `userGroup` (`userGroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gerne`
--
ALTER TABLE `gerne`
  MODIFY `gerneID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `movieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usergroup`
--
ALTER TABLE `usergroup`
  MODIFY `groupID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `gerne_movie`
--
ALTER TABLE `gerne_movie`
  ADD CONSTRAINT `gerne_movie_ibfk_1` FOREIGN KEY (`gerneID`) REFERENCES `gerne` (`gerneID`) ON DELETE CASCADE,
  ADD CONSTRAINT `gerne_movie_ibfk_2` FOREIGN KEY (`movieID`) REFERENCES `movie` (`movieID`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`groupID`) REFERENCES `usergroup` (`groupID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
