-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 11, 2013 at 10:31 AM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `path` varchar(30) NOT NULL,
  `id` smallint(6) NOT NULL,
  `pictext` varchar(40) NOT NULL,
  `idpic` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idpic`),
  KEY `id` (`id`),
  KEY `imagetext` (`pictext`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`path`, `id`, `pictext`, `idpic`) VALUES
('pictures/streckgubbe.png', 72, 'Första bilden..', 49),
('pictures/Aboutme.jpg', 73, 'Detta är en bild på Simon', 50),
('pictures/icon1.png', 73, 'Detta är en Icon.', 51),
('pictures/contactme.jpg', 74, 'Kontakta mig vid problem...', 52),
('pictures/bg_top_img.jpg', 75, 'Tjabba grabbarna!', 53),
('pictures/atril_thumb.png', 75, 'Atril är vår fina grafikmotor', 54),
('pictures/icon1.png', 76, 'Detta är linkedin typ', 55),
('pictures/icon4.png', 76, 'Detta är inte facebook', 56),
('pictures/icon5.png', 76, 'Och detta är inte linkedin', 57),
('pictures/icon1.png', 77, 'Detta är linkedin typ', 58),
('pictures/icon4.png', 77, 'Detta är inte facebook', 59),
('pictures/icon5.png', 77, 'Och detta är inte linkedin', 60),
('pictures/index.html', 78, 'ssbvsbf', 61),
('pictures/Aboutme.jpg', 80, 'NU KÖTTAR VI ..', 62),
('pictures/bg_top_img.jpg', 81, 'Fyll i.....', 63);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `title` varchar(30) NOT NULL,
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `signature` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`date`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`title`, `id`, `text`, `signature`, `date`) VALUES
('Första inlägget!', 72, 'Lorem ipsum darach iv valhe. Jag har en liten hund i trappen vid mitt gröna hus på kusten.', 'S.B', '2013-12-10 09:20:05'),
('Inlägg 2', 73, 'Tjenare bloggen! Hur ere läget? \r\nIgår hängde vi på woken och de var helt galet! En och annan fackla blev de innan man klämde en börjare.', 'S.B', '2013-12-10 09:26:09'),
('Inlägg 3 ', 74, 'Hej.. tänkte prova lite hur de fungerar just nu om jag skulle skapa en ny prefix eller inte.', 'M.H', '2013-12-10 10:57:40'),
('Inlägg 4', 75, 'GAAALET vilket party.. blir ner till munken..', 'O.I', '2013-12-10 10:58:39'),
('Inlägg 5', 76, 'Tjenare bloggen! NU kommer ett jävla inlägg om mitt liv.. Jag har inte gjort något vettigt nånsin så du behöver inte bli helt galen!!!!!', 'EMH', '2013-12-10 15:26:09'),
('Inlägg 5', 77, 'Tjenare bloggen! NU kommer ett jävla inlägg om mitt liv.. Jag har inte gjort något vettigt nånsin så du behöver inte bli helt galen!!!!!', 'EMH', '2013-12-10 15:29:58'),
('bfssbfbf', 78, 'bfbfs', 'bdfbdf', '2013-12-10 15:43:06'),
('svoudsvv', 79, 'svdovdhso', 'svosvdhsvo', '2013-12-10 15:49:49'),
('ÄR MAN SKAPT FÖR O NJUTA::', 80, 'DÅ SKA MAN FÖRFAAN NJUTA OCKSÅ', 'Strindberg', '2013-12-10 15:50:33'),
('c vvc ', 81, 'bfdfd', 'fdfbfb', '2013-12-10 15:51:05');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `temppath` varchar(50) NOT NULL,
  `temptext` varchar(50) NOT NULL,
  PRIMARY KEY (`temppath`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('admin', 'admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
