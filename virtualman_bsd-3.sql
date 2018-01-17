-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 12, 2018 at 10:51 PM
-- Server version: 5.7.17
-- PHP Version: 5.5.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `virtualman_bsd`
--

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE `availability` (
  `id` int(11) NOT NULL,
  `car` varchar(10) NOT NULL,
  `date` varchar(10) NOT NULL,
  `start` varchar(5) NOT NULL,
  `end` varchar(5) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`id`, `car`, `date`, `start`, `end`, `active`) VALUES
(105, 'DW3E175', '2018-01-12', '16:50', '18:20', 1),
(106, 'DW3E175', '2018-01-13', '16:50', '18:20', 1),
(108, 'zxc', '2018-01-13', '14:30', '17:20', 1);

--
-- Triggers `availability`
--
DELIMITER $$
CREATE TRIGGER `checkRangeCorectnesU` BEFORE UPDATE ON `availability` FOR EACH ROW BEGIN

 DECLARE x INT;
  
  IF(NEW.start>NEW.end)THEN 
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Cannot insert such values 1';
  END IF;
  
   IF(TIMEDIFF(NEW.end,NEW.start)<=0)THEN 
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Cannot insert such values 2';
  END IF;
  
IF(NEW.active = '1') THEN

 SET x =(select count(*) from 
   (SELECT * FROM availability
      WHERE active = '1' AND date = NEW.date AND car = NEW.car AND
     (start <= NEW.end) AND (end >= NEW.start)                          
   ) AS k
 );

 IF(x >0 )THEN
   SIGNAL SQLSTATE '45000'
   SET MESSAGE_TEXT = 'This date is already in use';
  END IF;
END IF;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `checkRangeCorrectnesI` BEFORE INSERT ON `availability` FOR EACH ROW BEGIN

 DECLARE x INT;
  
  IF(NEW.start>NEW.end)THEN 
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Cannot insert such values 1';
  END IF;
  
   IF(TIMEDIFF(NEW.end,NEW.start)<=0)THEN 
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Cannot insert such values 2';
  END IF;
  
IF(NEW.active = '1') THEN

 SET x =(select count(*) from 
   (SELECT * FROM availability
      WHERE active = '1' AND date = NEW.date AND car = NEW.car AND
     (start <= NEW.end) AND (end >= NEW.start)                          
   ) AS k
 );

 IF(x >0 )THEN
   SIGNAL SQLSTATE '45000'
   SET MESSAGE_TEXT = 'This date is already in use';
  END IF;
END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET latin2 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Ford'),
(2, 'Fiat'),
(3, 'Audi');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `user` int(11) NOT NULL,
  `license_plate` varchar(10) NOT NULL,
  `model` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `latitude` float NOT NULL,
  `attitude` float NOT NULL,
  `price` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`user`, `license_plate`, `model`, `year`, `latitude`, `attitude`, `price`) VALUES
(10, 'Asd', 1, 2012, 0, 0, 123),
(10, 'DW3E175', 1, 2012, 0, 0, 12),
(10, 'zxc', 1, 2012, 0, 0, 123);

--
-- Triggers `cars`
--
DELIMITER $$
CREATE TRIGGER `beforeCarDelete` BEFORE DELETE ON `cars` FOR EACH ROW BEGIN
  IF OLD.license_plate IN (
    SELECT car FROM requests 
    JOIN request_states ON requests.status = request_states.id
    WHERE request_states.name ='in use'
  )THEN 
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Cannot delete a car in current state';
  END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `id` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET latin2 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `brand`, `name`) VALUES
(1, 1, 'Fiesta'),
(2, 1, 'Focus'),
(3, 2, 'Punto'),
(4, 3, 'A3');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `user` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `start` varchar(5) NOT NULL,
  `end` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`user`, `date`, `start`, `end`) VALUES
(10, '2018-01-13', '15:20', '16:40'),
(10, '2018-01-13', '16:50', '18:10'),
(11, '2018-01-13', '16:10', '16:50'),
(11, '2018-01-13', '17:00', '18:00');

--
-- Triggers `plans`
--
DELIMITER $$
CREATE TRIGGER `checkRangeI` BEFORE INSERT ON `plans` FOR EACH ROW BEGIN

 DECLARE x INT;
  
  IF(NEW.start>NEW.end)THEN 
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Cannot insert such values 1';
  END IF;
  
   IF(TIMEDIFF(NEW.end,NEW.start)<=0)THEN 
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Cannot insert such values 2';
  END IF;

 SET x =(select count(*) from 
   (SELECT * FROM plans
      WHERE date = NEW.date AND user = NEW.user AND 
     (start <= NEW.end) AND (end >= NEW.start)                          
   ) AS k
 );

 IF(x >0 )THEN
   SIGNAL SQLSTATE '45000'
   SET MESSAGE_TEXT = 'This date is already in use';
  END IF;


END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `checkRangeU` BEFORE UPDATE ON `plans` FOR EACH ROW BEGIN

 DECLARE x INT;
  
  IF(NEW.start>NEW.end)THEN 
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Cannot insert such values 1';
  END IF;
  
   IF(TIMEDIFF(NEW.end,NEW.start)<=0)THEN 
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Cannot insert such values 2';
  END IF;

 SET x =(select count(*) from 
   (SELECT * FROM plans
      WHERE date = NEW.date AND user=NEW.user AND
     (start <= NEW.end) AND (end >= NEW.start)                          
   ) AS k
 );

 IF(x >0 )THEN
   SIGNAL SQLSTATE '45000'
   SET MESSAGE_TEXT = 'This date is already in use';
  END IF;


END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `car` varchar(10) NOT NULL,
  `status` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `start` varchar(5) NOT NULL,
  `end` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `user`, `car`, `status`, `date`, `start`, `end`) VALUES
(8, 11, 'DW3E175', 2, '2018-01-13', '17:00', '18:00');

--
-- Triggers `requests`
--
DELIMITER $$
CREATE TRIGGER `checkRangeCorectnessI` BEFORE INSERT ON `requests` FOR EACH ROW BEGIN

  IF(NEW.start>NEW.end)THEN 
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Cannot insert such values 1';
  END IF;
  
   IF(TIMEDIFF(NEW.end,NEW.start)<=0)THEN 
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Cannot insert such values 2';
  END IF;
  


END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `checkRangeCorectnessU` BEFORE UPDATE ON `requests` FOR EACH ROW BEGIN

  
  IF(NEW.start>NEW.end)THEN 
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Cannot insert such values 1';
  END IF;
  
   IF(TIMEDIFF(NEW.end,NEW.start)<=0)THEN 
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Cannot insert such values 2';
  END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `request_states`
--

CREATE TABLE `request_states` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `request_states`
--

INSERT INTO `request_states` (`id`, `name`) VALUES
(1, 'pending'),
(2, 'accepted'),
(3, 'declined');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `joined` datetime NOT NULL,
  `last_visited` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `surname`, `password`, `joined`, `last_visited`) VALUES
(10, 'macikera@o2.pl', 'Maciej', 'Stosio', '$1$8/CpdQPn$Cf7TwWw4jqxcmigFVXawm1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'maciek@o2.pl', '', '', '$1$WmUgm8Hk$MuCmwpo0N.WN2Dy.l0n6e/', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `availability_ibfk_1` (`car`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`license_plate`),
  ADD KEY `model` (`model`),
  ADD KEY `cars_ibfk_2` (`user`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand` (`brand`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`user`,`date`,`start`,`end`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `my_key_2` (`car`),
  ADD KEY `requests_ibfk_2` (`user`);

--
-- Indexes for table `request_states`
--
ALTER TABLE `request_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `availability`
--
ALTER TABLE `availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `request_states`
--
ALTER TABLE `request_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `availability`
--
ALTER TABLE `availability`
  ADD CONSTRAINT `availability_ibfk_1` FOREIGN KEY (`car`) REFERENCES `cars` (`license_plate`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`model`) REFERENCES `models` (`id`),
  ADD CONSTRAINT `cars_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `models_ibfk_2` FOREIGN KEY (`brand`) REFERENCES `brands` (`id`);

--
-- Constraints for table `plans`
--
ALTER TABLE `plans`
  ADD CONSTRAINT `plans_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `my_key_2` FOREIGN KEY (`car`) REFERENCES `cars` (`license_plate`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `requests_ibfk_3` FOREIGN KEY (`status`) REFERENCES `request_states` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
