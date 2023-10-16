-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2023 at 07:18 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `KDM`
--

-- --------------------------------------------------------

--
-- Table structure for table `BlogPosts`
--

CREATE TABLE `BlogPosts` (
  `Id` int(11) NOT NULL,
  `Title` varchar(500) NOT NULL,
  `DateTime` datetime NOT NULL,
  `ThumbnailFileName` text DEFAULT NULL,
  `ContentFileName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `BlogPosts`
--

INSERT INTO `BlogPosts` (`Id`, `Title`, `DateTime`, `ThumbnailFileName`, `ContentFileName`) VALUES
(1, 'This is test blog', '2023-07-09 00:00:00', '1688842478.txt.jpg', '1688842478.txt');

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `Id` int(11) NOT NULL,
  `Name` varchar(500) NOT NULL,
  `Description` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`Id`, `Name`, `Description`) VALUES
(1, 'Door Handle', 'This is the description of Door Handle Category'),
(2, 'Bathroom Accessories', 'This is the description of this category\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `CategoryImages`
--

CREATE TABLE `CategoryImages` (
  `Id` int(11) NOT NULL,
  `ImageName` varchar(500) NOT NULL,
  `CategoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `CategoryImages`
--

INSERT INTO `CategoryImages` (`Id`, `ImageName`, `CategoryId`) VALUES
(1, 'doorhandle.jpg', 1),
(2, '1688485419-bathroom accessories.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Contact`
--

CREATE TABLE `Contact` (
  `Id` int(11) NOT NULL,
  `Name` varchar(500) NOT NULL,
  `Email` varchar(500) NOT NULL,
  `Subject` varchar(500) NOT NULL,
  `Message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `EnquiryCart`
--

CREATE TABLE `EnquiryCart` (
  `Id` int(11) NOT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `SubProductId` int(11) DEFAULT NULL,
  `CompanyName` varchar(50) NOT NULL,
  `E-Mail` varchar(20) NOT NULL,
  `Mobile` varchar(20) NOT NULL,
  `Description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `EnquiryCart`
--

INSERT INTO `EnquiryCart` (`Id`, `CategoryId`, `ProductId`, `SubProductId`, `CompanyName`, `E-Mail`, `Mobile`, `Description`) VALUES
(1, 1, 4, 11, 'test company 2', 'test@gmail.com', '9712791515', 'This is the demo description of the product'),
(2, 1, 4, 11, 'test company 3', 'thsi@gmail.com', '9499815372', 'This is the description of the product'),
(3, 1, 4, 11, 'test company 4', 'test@gmail.com', '9499815372', 'This is the description of the product'),
(5, NULL, NULL, NULL, 'test', 'test@gmail.com', '9499815372', 'this is the description '),
(6, NULL, NULL, NULL, 'test 4', 'test@gmail.com', '9499815372', 'this is the description'),
(7, NULL, NULL, NULL, 'test 5', 'test@gmail,com', '9499815372', 'this is the description od the product'),
(8, NULL, NULL, NULL, 'twst 6', 'tedt@gmail.com', '97127 91515 ', 'This is the description '),
(9, NULL, NULL, NULL, 'test 7', 'test@gmail.com', '9499815372', 'This is the description of the product');

-- --------------------------------------------------------

--
-- Table structure for table `ProductImages`
--

CREATE TABLE `ProductImages` (
  `Id` int(11) NOT NULL,
  `ImageName` varchar(500) NOT NULL,
  `ProductId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ProductImages`
--

INSERT INTO `ProductImages` (`Id`, `ImageName`, `ProductId`) VALUES
(1, 'dhp1.png', 3),
(2, 'dhp2.png', 4),
(3, 'dhp3.png', 5),
(4, 'dhp4.png', 7);

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `Id` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Description` varchar(2000) NOT NULL,
  `CategoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`Id`, `Name`, `Description`, `CategoryId`) VALUES
(3, 'Finest Collection', 'This is the description for finest collection', 1),
(4, 'Premium Collection', 'This is the description of Premium Collection', 1),
(5, 'Popular Collection', 'This is the description of the Popular Collection', 1),
(7, 'Lock Body, Cylinders & Rose Key', 'This is the description of this product', 1);

-- --------------------------------------------------------

--
-- Table structure for table `SubProducts`
--

CREATE TABLE `SubProducts` (
  `Id` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Description` varchar(2000) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `Sku` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `SubProducts`
--

INSERT INTO `SubProducts` (`Id`, `Name`, `Description`, `CategoryId`, `ProductId`, `Sku`) VALUES
(1, 'Antone', 'This is the description of Antone.', 1, 3, '123456'),
(2, 'NYX', 'This is the description of NYX', 1, 3, '123456'),
(3, 'Terry', 'This is the description of Terry', 1, 3, '123456'),
(4, 'Rich', 'This is the description of Rich', 1, 3, '123456'),
(5, 'Leo', 'This is the description of LEO', 1, 3, '123456'),
(6, 'Black Marvel', 'This is the description of Black Marvel', 1, 3, '123456'),
(7, 'Eric', 'This is the description of Eric', 1, 3, '123456'),
(8, 'Florus', 'This is the description of Florus', 1, 3, '123456'),
(9, 'Lavish', 'This is the description of Lavish', 1, 3, '123456'),
(10, 'Varnish', 'This is the description of Lavish', 1, 3, '123456'),
(11, 'OXI', 'This is the description of OXI', 1, 4, '123456'),
(12, 'Loyce', 'This is the description of Loyce', 1, 4, '123456'),
(13, 'ELF', 'This is the description of ELF', 1, 4, '123456'),
(14, 'Alice', 'This is the description of Alice', 1, 4, '123456'),
(15, 'Vintage', 'This is the description of Vintage', 1, 4, '123456'),
(16, 'Frilly', 'This is the description of Frilly', 1, 4, '123456'),
(17, 'Cornish', 'This is the description of Cornish', 1, 4, '123456'),
(18, 'Corsa', 'This is the description of the corsa ', 1, 5, '123456'),
(19, 'Egon', 'This is the description of the Egon ', 1, 5, '123456'),
(20, 'Lugo', 'This is the description of Lugo', 1, 5, '123456'),
(21, 'Villa', 'This is the description of Villa', 1, 5, '123456'),
(22, 'York', 'This is the description of York', 1, 5, '123456'),
(23, 'Deer', 'This is the description of Deer', 1, 5, '123456'),
(24, 'Lock Body', 'This is the description of Lock Body', 1, 7, '123456'),
(25, 'Cylinders', 'This is the description of Cylinders', 1, 7, '123456'),
(26, 'Rose Key', 'This is the description of Rose Key', 1, 7, '123456');

-- --------------------------------------------------------

--
-- Table structure for table `SubProductsImages`
--

CREATE TABLE `SubProductsImages` (
  `Id` int(11) NOT NULL,
  `SubProductId` int(11) NOT NULL,
  `ImageName` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `SubProductsImages`
--

INSERT INTO `SubProductsImages` (`Id`, `SubProductId`, `ImageName`) VALUES
(1, 1, 'antone.png'),
(2, 2, 'nyx.png'),
(3, 3, 'terry.png'),
(4, 14, 'alice.png'),
(5, 6, 'marvel.png'),
(6, 17, 'cornish.png'),
(7, 13, 'elf.png'),
(8, 7, 'eric.png'),
(9, 8, 'feorus.png'),
(10, 16, 'frilly.png'),
(11, 9, 'lavish.png'),
(12, 5, 'leo.png'),
(13, 12, 'loyce.png'),
(14, 11, 'oxi.png'),
(15, 4, 'rich.png'),
(16, 10, 'varnish.png'),
(17, 15, 'vintage.png'),
(18, 18, 'corsa.png'),
(19, 19, 'egon.png'),
(20, 20, 'lugo.png'),
(21, 21, 'villa.png'),
(22, 22, 'york.png'),
(23, 23, 'deer.png'),
(24, 24, 'lockbody.png'),
(25, 25, 'cylinder.png'),
(26, 26, 'rosekey.png');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `Id` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`Id`, `Username`, `Password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `BlogPosts`
--
ALTER TABLE `BlogPosts`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `CategoryImages`
--
ALTER TABLE `CategoryImages`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FkCategoryIdInCategoryImages` (`CategoryId`);

--
-- Indexes for table `Contact`
--
ALTER TABLE `Contact`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `EnquiryCart`
--
ALTER TABLE `EnquiryCart`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FkCategoryIdInEnquiryCart` (`CategoryId`),
  ADD KEY `FkProductIdInEnquiryCart` (`ProductId`),
  ADD KEY `FkSubProductIdInEnquiryCart` (`SubProductId`);

--
-- Indexes for table `ProductImages`
--
ALTER TABLE `ProductImages`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FkProductIdInProductImages` (`ProductId`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FkCategoryIdInProducts` (`CategoryId`);

--
-- Indexes for table `SubProducts`
--
ALTER TABLE `SubProducts`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FkCategoryIdInSubProducts` (`CategoryId`),
  ADD KEY `FkProductIdInSubProducts` (`ProductId`);

--
-- Indexes for table `SubProductsImages`
--
ALTER TABLE `SubProductsImages`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FkSubProductIdInSubProductsImages` (`SubProductId`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `BlogPosts`
--
ALTER TABLE `BlogPosts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `CategoryImages`
--
ALTER TABLE `CategoryImages`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Contact`
--
ALTER TABLE `Contact`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EnquiryCart`
--
ALTER TABLE `EnquiryCart`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ProductImages`
--
ALTER TABLE `ProductImages`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `SubProducts`
--
ALTER TABLE `SubProducts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `SubProductsImages`
--
ALTER TABLE `SubProductsImages`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CategoryImages`
--
ALTER TABLE `CategoryImages`
  ADD CONSTRAINT `FkCategoryIdInCategoryImages` FOREIGN KEY (`CategoryId`) REFERENCES `Category` (`Id`);

--
-- Constraints for table `EnquiryCart`
--
ALTER TABLE `EnquiryCart`
  ADD CONSTRAINT `FkCategoryIdInEnquiryCart` FOREIGN KEY (`CategoryId`) REFERENCES `Category` (`Id`),
  ADD CONSTRAINT `FkProductIdInEnquiryCart` FOREIGN KEY (`ProductId`) REFERENCES `Products` (`Id`),
  ADD CONSTRAINT `FkSubProductIdInEnquiryCart` FOREIGN KEY (`SubProductId`) REFERENCES `SubProducts` (`Id`);

--
-- Constraints for table `ProductImages`
--
ALTER TABLE `ProductImages`
  ADD CONSTRAINT `FkProductIdInProductImages` FOREIGN KEY (`ProductId`) REFERENCES `Products` (`Id`);

--
-- Constraints for table `Products`
--
ALTER TABLE `Products`
  ADD CONSTRAINT `FkCategoryIdInProducts` FOREIGN KEY (`CategoryId`) REFERENCES `Category` (`Id`);

--
-- Constraints for table `SubProducts`
--
ALTER TABLE `SubProducts`
  ADD CONSTRAINT `FkCategoryIdInSubProducts` FOREIGN KEY (`CategoryId`) REFERENCES `Category` (`Id`),
  ADD CONSTRAINT `FkProductIdInSubProducts` FOREIGN KEY (`ProductId`) REFERENCES `Products` (`Id`);

--
-- Constraints for table `SubProductsImages`
--
ALTER TABLE `SubProductsImages`
  ADD CONSTRAINT `FkSubProductIdInSubProductsImages` FOREIGN KEY (`SubProductId`) REFERENCES `SubProducts` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
