-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2021 at 02:54 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buildings1`
--

-- --------------------------------------------------------

--
-- Table structure for table `builder`
--

CREATE TABLE `builder` (
  `builderId` int(11) NOT NULL,
  `builderName` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `builderEmail` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `builderCity` varchar(29) COLLATE utf8_unicode_ci NOT NULL,
  `builderCountry` varchar(29) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `builder`
--

INSERT INTO `builder` (`builderId`, `builderName`, `builderEmail`, `builderCity`, `builderCountry`) VALUES
(1, 'The Ivory Homes', 'ivoryhomes@gmail.com', 'Dublin', 'Ireland'),
(2, 'Proof Contractors', 'proofcontractors@gmail.com', 'Syndey', 'Australia'),
(3, 'Agrikol', 'agrikolkg@gmail.com', 'Kragujevac', 'Serbia'),
(4, 'Sunshine Build Group', 'sunshinebgroup@gmail.com', 'Stockholm', 'Sweden'),
(5, 'Evergreen', 'everg@gmail.com', 'Sofia', 'Bulgaria'),
(6, 'Legion Homes', 'lghomes@gmial.com', 'Munich', 'Germany');

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `buildingId` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `builderid` int(11) NOT NULL,
  `name` varchar(29) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `location` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `underconstruction` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`buildingId`, `categoryid`, `builderid`, `name`, `info`, `price`, `location`, `underconstruction`) VALUES
(2, 1, 2, 'Dunwood Park', 'This exclusive development of stunning new properties is set within a gated development just off the Victoria Road. Located within the mature Dunnwood Park, these quality family homes have a prime position with the City of Derry Golf Course to the rear and amazing views over the River Foyle and surrounding countryside to the front. Finished to the highest specification for relaxed everyday living for the modern professional.', '260000.00', 'Dublin, Ireland', b'0'),
(3, 2, 5, '519 Broadway', 'This rare and unique residential opportunity is perfectly situated on the Somerville and Medford line offering the best of both cities at the gateway to Cambridge and Boston. \"One of the top 3 places to live in Massachusetts\" according to Money Inc. This extraordinary offering consists of 55 residential units, 5 commercial units and over 100 parking spaces.', '4500000.00', 'Somerville, Michigan', b'1'),
(4, 2, 4, 'Facundo Campazzo', 'Great New four plex project. It is a four-plex subdivision with 46 lots/buildings or 184 units. We would like to sell entire project to one investor, as the project under construction today. We hope to have rental units available by the end of this year, and entire project completed in 2020. The buildings have been constructed in our area many times in many different locations. The townhouse design is very popular with the tenants. The tenants have no other tenants living over them and each apartment has its own private entryway. The units come completely rent ready, with full appliance including a washer and dryer. The project will be fully landscaped, and will also include a very nice pool, clubhouse, and playground area.', '1199000.00', 'Buenos Aires, Argentina', b'1'),
(5, 3, 3, 'Bg Bussiness Center', 'This fourplex has one unit with 3 bed 2 bath,3 units with 2/2, about 950 Sq Ft of living space per unit with an open space floor plan. The property has a new plumbing system, new floors, new double pane windows and new paint.The kitchen is remodeled from top to bottom with new cabinets, new quartz counter tops, new appliances, washer and dryer hook up in each unit, and new bathrooms. It comes with its own one-car garage and one driveway in front of each garage, total of 8 parking spaces.', '929000.00', 'Belgrade, Serbia', b'0'),
(6, 3, 6, 'Chambers Rd', 'Property consist of four buildings: One triplex, two duplexes and one detached single-family house on one lot. All units have been updated and there is a spacious parking lot.Unused land provides the potential to possibly build additional apartment units or storage units. Private well water saves the owner expense for water. This property has also undergone several renovations and updates to all units, offering some value-add opportunity to remodel or build to improve the property and increase income. Contact the listing broker for financial information.', '4999999.00', 'Aurora, Colorado', b'0'),
(7, 2, 2, 'Buena Vista Ave', 'Four-plex offered by itself or along with 1572 Buena Vista, an identical four-plex next door. Both are available, together or separately. All units have hardwood floors throughout. All ceramic tile kitchen counter tops and floors. Seller will carry back 10% for 3 years at a low interest rate, depending on Buyers credit. All units are One Bedroom  One Bath. Most units are substantially below market.', '2299999.00', 'Alameda, California', b'1'),
(8, 1, 5, 'Mews Montrose Place', 'A truly exceptional low built house, newly developed and architect designed to provide flexible, spacious and well balanced accommodation over four floors only, located in this quiet residential street in the heart of Belgravia. The attention to detail and bespoke features maximise light and volume with interiors meticulously designed by One Residence. At just under 33ft wide, this magnificent property is one of the widest houses in Belgravia offering fantastic lateral living with a large private roof terrace and integral garage.', '11000000.00', 'London, England', b'0'),
(9, 2, 2, 'Costa Del Sol', 'Exceptional contemporary building of recent construction located in one of the best and safest complex of all Europe and a few kilometers from Marbella. The complex offers two 18-hole private golf courses, an equestrian club, tennis and luxury facilities. It is surrounded by almost 900 hectares of its own natural reserve and stunning views of the Mediterranean. The entrance hall welcomes us with double-height ceilings, a central staircase that gives access to a spacious living room with fireplace and direct access to the covered terrace overlooking the pool, the sea and mountains.', '14999999.00', 'Singapore, Singapore', b'1'),
(15, 1, 1, 'Dodavanje zgrade', 'Informacije o datoj gradjevini', '1234567.00', 'Kraljevo, Serbia', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(29) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`) VALUES
(1, 'House'),
(2, 'Building'),
(3, 'Office space');

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE `navigation` (
  `navId` int(11) NOT NULL,
  `navName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `href` varchar(99) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`navId`, `navName`, `href`) VALUES
(1, 'Home', 'index.php'),
(2, 'Register', 'index.php?page=register'),
(3, 'Log In', 'index.php?page=login'),
(4, 'Author', 'index.php?page=author'),
(5, 'Log out', 'models/korisnik/logout.php'),
(7, 'Profesorka', 'ovde.probajte.prvo.update.pa.potom.delete');

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `buildingId` int(11) NOT NULL,
  `src` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(22) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`buildingId`, `src`, `alt`) VALUES
(2, 'slika2.jpg', 'gradjevina2'),
(3, 'slika3.jpg', 'gradjevina3'),
(4, 'slika4.jpg', 'gradjevina4'),
(5, 'slika5.jpg', 'gradjevina5'),
(6, 'slika6.jpg', 'gradjevina6'),
(7, 'slika7.jpg', 'gradjevina7'),
(8, 'slika8.jpg', 'gradjevina8'),
(9, 'slika9.jpg', 'gradjevina9'),
(15, 'new_1594572359_gradjevina.jpg', 'property');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `reviewId` int(11) NOT NULL,
  `buildingId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `comment` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`reviewId`, `buildingId`, `userId`, `comment`) VALUES
(5, 7, 6, 'Proba komentara !');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleid` int(11) NOT NULL,
  `roleName` varchar(19) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleid`, `roleName`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserId` int(11) NOT NULL,
  `name` varchar(39) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(39) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(39) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `roleId` int(11) NOT NULL,
  `username` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `name`, `surname`, `email`, `password`, `roleId`, `username`, `date`) VALUES
(6, 'Sasa', 'Pajovic', 'spajovicjw@gmail.com', '7f3fcc8311ba4a5fcb501ef487471efd', 2, 'spajovic', 1594409620),
(7, 'Veljko', 'Pajovic', 'veljkopajovic@gmail.com', 'fa29aee3943a68c7a95625bba67745bd', 1, 'veks', 1594413597),
(9, 'Milena', 'Vesic', 'milena.vesic@ict.edu.rs', '0dbf3e8d771b15f6ec26c0a0ad05d6d1', 2, 'mvesic', 1594546201),
(12, 'Stefan', 'Vaskesic', 'stefanvaskovic@ict.edu.rs', '7da816581a2c54d43939e79e34899083', 1, 'vasketa', 1594576640);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `voteid` int(11) NOT NULL,
  `result` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`voteid`, `result`, `userid`) VALUES
(1, 3, 6),
(2, 4, 7),
(5, 5, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `builder`
--
ALTER TABLE `builder`
  ADD PRIMARY KEY (`builderId`);

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`buildingId`),
  ADD KEY `categoryid` (`categoryid`),
  ADD KEY `builderid` (`builderid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`navId`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`buildingId`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `buildingId` (`buildingId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `roleId` (`roleId`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`voteid`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `builder`
--
ALTER TABLE `builder`
  MODIFY `builderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `buildingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `navigation`
--
ALTER TABLE `navigation`
  MODIFY `navId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `buildingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `reviewId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `voteid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buildings`
--
ALTER TABLE `buildings`
  ADD CONSTRAINT `buildings_ibfk_1` FOREIGN KEY (`builderid`) REFERENCES `builder` (`builderId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buildings_ibfk_2` FOREIGN KEY (`categoryid`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `picture_ibfk_1` FOREIGN KEY (`buildingId`) REFERENCES `buildings` (`buildingId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`buildingId`) REFERENCES `buildings` (`buildingId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `role` (`roleid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
