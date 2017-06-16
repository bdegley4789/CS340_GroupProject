-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: classmysql.engr.oregonstate.edu:3306
-- Generation Time: Jun 16, 2017 at 04:38 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.0.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs340_alessanf`
--

-- --------------------------------------------------------

--
-- Table structure for table `Assignment`
--

CREATE TABLE `Assignment` (
  `assignmentID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `DueDate` date NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Assignment`
--

INSERT INTO `Assignment` (`assignmentID`, `CourseID`, `Name`, `DueDate`, `Description`) VALUES
(1, 332158, 'Assignment 1', '2017-05-11', ''),
(2, 332158, 'Assignment 2', '2017-05-03', ''),
(3, 332158, 'Assignment 3', '2017-05-03', ''),
(6, 3124235, 'Hardest HW', '2017-06-12', 'This hw will be very hard'),
(7, 57, 'Easy Assignment', '1994-03-20', 'This Assignment is very easy'),
(8, 57, 'Hard', '2017-04-04', 'This is hard'),
(9, 229, 'Business Plan', '2017-04-30', 'Write a business plan'),
(10, 3124235, 'Subject 3 HW 2', '1994-04-04', 'This is hw for subject 3'),
(11, 229, 'Make Business', '4902-04-30', 'This is hard'),
(12, 229, 'Final Project', '2017-04-10', 'Make Money'),
(13, 3124235, 'Final Project', '2018-05-02', 'This is your final project'),
(14, 32, 'Addition', '2017-03-04', 'Add 5 + 3'),
(15, 57, 'blah', '1994-04-22', 'blah blah blah');

-- --------------------------------------------------------

--
-- Table structure for table `Class`
--

CREATE TABLE `Class` (
  `CourseID` int(11) NOT NULL,
  `ONID` varchar(20) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `location` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Class`
--

INSERT INTO `Class` (`CourseID`, `ONID`, `subject`, `location`) VALUES
(32, '93825345', 'math', 'building'),
(57, '4444', 'Algorithms', 'Kelly'),
(229, '943184958', 'Business', 'Library'),
(48574, '4444', 'Subject 2', 'STAG'),
(321514, '947383453', 'Some subject', 'LINC'),
(332158, '4444', 'Data Structures', 'KEC'),
(3124235, '943184958', 'Subject 3', 'BEX'),
(3124236, '93825345', 'english', 'mealy'),
(3124237, '943184958', 'French', 'Kane Hall'),
(3124238, '4444', 'CS 572', 'Kelly'),
(3124239, '943184958', 'Basketball', 'Gym'),
(3124240, '2132131', 'Running', 'Track'),
(3124241, '2132131', 'Health', 'Milam'),
(3124242, '4444', 'Russian', 'Kane Hall');

-- --------------------------------------------------------

--
-- Table structure for table `Group`
--

CREATE TABLE `Group` (
  `size` int(20) NOT NULL,
  `GroupID` int(20) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `ONID` varchar(20) NOT NULL,
  `Name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Group`
--

INSERT INTO `Group` (`size`, `GroupID`, `CourseID`, `ONID`, `Name`) VALUES
(4, 1, 332158, '932', 'Group1'),
(5, 5, 332158, '932354368', 'Group3'),
(21, 12, 3124235, 'shinga', 'Awq'),
(9, 89, 332158, 'alessanf', 'Ale'),
(3, 9987, 48574, '932445885', 'Dub'),
(3, 43150, 32, 'loven', 'Blue '),
(3, 98735546, 3124235, '14567123', 'Sam'),
(15, 98735551, 48574, 'egleyb', 'Blue'),
(5, 98735552, 3124237, 'egleyb', 'HW help'),
(4, 98735554, 3124235, 'egleyb', 'Red'),
(7, 98735555, 57, 'egleyb', 'Study Group');

--
-- Triggers `Group`
--
DELIMITER $$
CREATE TRIGGER `AddNewGroup` AFTER INSERT ON `Group` FOR EACH ROW BEGIN
	INSERT INTO GroupMember(`GroupID`,`ONID`) VALUES(NEW.GroupID, NEW.ONID);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `GroupMember`
--

CREATE TABLE `GroupMember` (
  `GroupID` int(11) NOT NULL,
  `ONID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `GroupMember`
--

INSERT INTO `GroupMember` (`GroupID`, `ONID`) VALUES
(1, '14567123'),
(1, '932'),
(1, 'egleyb'),
(1, 'yanghaox'),
(5, '932354368'),
(5, 'egleyb'),
(89, 'egleyb'),
(9987, '932445885'),
(9987, 'egleyb'),
(43150, 'egleyb'),
(98735546, '14567123'),
(98735546, 'alessanf'),
(98735551, 'alessanf'),
(98735551, 'egleyb'),
(98735552, 'egleyb'),
(98735554, 'egleyb'),
(98735555, 'egleyb');

--
-- Triggers `GroupMember`
--
DELIMITER $$
CREATE TRIGGER `AutomaticDeletion` AFTER DELETE ON `GroupMember` FOR EACH ROW BEGIN
IF (SELECT COUNT(GroupMember.ONID) FROM GroupMember WHERE GroupMember.GroupID = old.GroupID) = 0 THEN
    DELETE FROM `Group` WHERE `Group`.`GroupID` = old.GroupID;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `JoinGroup` BEFORE INSERT ON `GroupMember` FOR EACH ROW BEGIN
	IF (SELECT COUNT(GroupMember.ONID) FROM GroupMember WHERE GroupMember.GroupID = new.GroupID) >= (SELECT `Group`.`size` FROM `Group` WHERE `Group`.`GroupID`= new.GroupID) THEN
	SIGNAL sqlstate '45001' set message_text = "Error: Group is full.";

       END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Instructors`
--

CREATE TABLE `Instructors` (
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `ONID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Instructors`
--

INSERT INTO `Instructors` (`firstName`, `lastName`, `ONID`) VALUES
('Pitter', 'Butter', '2132131'),
('Easy', 'Squezzy', '32432424'),
('Kevin', 'S', '4444'),
('Paul', 'Nino', '93825345'),
('Jane', 'Hill', '943184958'),
('June', 'May', '947383453');

-- --------------------------------------------------------

--
-- Table structure for table `Messages`
--

CREATE TABLE `Messages` (
  `MessageID` int(11) NOT NULL,
  `TopicID` int(11) NOT NULL,
  `ONID` varchar(20) NOT NULL,
  `Message` text NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Messages`
--

INSERT INTO `Messages` (`MessageID`, `TopicID`, `ONID`, `Message`, `Time`) VALUES
(3, 3, '932', 'Does anyone know the due date for the first assignment?', '2017-05-24 01:51:20'),
(4, 3, '14567123', 'It\'s due on the first of june.', '2017-05-24 01:51:39'),
(123, 3, '935658940', 'due', '2017-06-03 03:12:24'),
(324, 3, '935658940', 'hard hw', '2017-06-03 03:14:51'),
(684, 3, '935658940', 'due time', '2017-06-03 03:14:51'),
(90098, 3, 'shinga', 'Due', '2017-06-03 03:12:24'),
(90099, 3, 'alessanf', 'some text haha', '2017-06-15 00:42:58'),
(90100, 3, 'alessanf', 'It\'s not due yet', '2017-06-15 00:43:12'),
(90101, 3, 'alessanf', 'ne wtext', '2017-06-15 00:43:19'),
(90105, 3, 'alessanf', 'some text\r\n', '2017-06-15 01:29:44'),
(90106, 3, 'egleyb', 'Test', '2017-06-15 01:31:40'),
(90107, 3, 'egleyb', 'Blah blah ', '2017-06-15 21:16:51'),
(90109, 76871, 'alessanf', 'hello world', '2017-06-16 01:50:20'),
(90110, 76872, 'alessanf', 'you should see this message\r\n', '2017-06-16 01:56:00'),
(90111, 76873, 'alessanf', 'you should see this message\r\n', '2017-06-16 01:56:57'),
(90112, 76874, 'alessanf', 'some message\r\n', '2017-06-16 01:59:03'),
(90118, 76876, 'egleyb', 'Please Help!', '2017-06-16 02:13:02'),
(90119, 76877, 'alessanf', 'SOme some some text\r\n', '2017-06-16 02:18:51'),
(90120, 76874, 'alessanf', 'Some other messages', '2017-06-16 04:33:47'),
(90121, 76876, 'egleyb', 'Im confused :(', '2017-06-16 05:13:41'),
(90122, 76878, 'egleyb', 'please help', '2017-06-16 05:30:26'),
(90123, 76879, 'egleyb', 'When can you guys meet up to study?', '2017-06-16 07:41:00'),
(90125, 76878, 'egleyb', 'thanks', '2017-06-16 07:54:18'),
(90126, 76879, 'egleyb', 'How about 5 oclock', '2017-06-16 07:54:54');

-- --------------------------------------------------------

--
-- Table structure for table `Students`
--

CREATE TABLE `Students` (
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `ONID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Students`
--

INSERT INTO `Students` (`firstName`, `lastName`, `ONID`) VALUES
('Some', 'Dude', '14567123'),
('Hao', 'Yang', '932'),
('John', 'Smith', '932354367'),
('James', 'Smith', '932354368'),
('Jane', 'Smith', '932354387'),
('Dude', 'Last', '932445885'),
('Adam', 'Hill', '935658940'),
('Alessandro', 'Lim', 'alessanf'),
('Bryce', 'Egley', 'egleyb'),
('Nathan', 'Love', 'loven'),
('Evan', 'Milton', 'miltone'),
('Nicholas', 'Orrell', 'orrelln'),
('Monica', 'Sek', 'sekmo'),
('Arthur', 'Shing', 'shinga'),
('Haoxiang', 'Yang', 'yanghaox');

-- --------------------------------------------------------

--
-- Table structure for table `TakingClass`
--

CREATE TABLE `TakingClass` (
  `ONID` varchar(20) NOT NULL,
  `CourseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TakingClass`
--

INSERT INTO `TakingClass` (`ONID`, `CourseID`) VALUES
('14567123', 332158),
('932', 48574),
('932', 332158),
('932', 3124235),
('932354367', 321514),
('932354367', 332158),
('932354368', 332158),
('932354387', 321514),
('932445885', 332158),
('935658940', 332158),
('alessanf', 57),
('alessanf', 48574),
('alessanf', 321514),
('alessanf', 332158),
('alessanf', 3124235),
('alessanf', 3124241),
('egleyb', 32),
('egleyb', 57),
('egleyb', 229),
('egleyb', 332158),
('egleyb', 3124235),
('yanghaox', 32),
('yanghaox', 57);

--
-- Triggers `TakingClass`
--
DELIMITER $$
CREATE TRIGGER `LeaveGroup` AFTER DELETE ON `TakingClass` FOR EACH ROW BEGIN
DELETE FROM GroupMember WHERE GroupMember.ONID = old.ONID AND GroupMember.GroupID in (SELECT `Group`.`GroupID`FROM `Group` WHERE `Group`.`CourseID` = old.CourseID);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Threads`
--

CREATE TABLE `Threads` (
  `title` varchar(20) NOT NULL,
  `TopicID` int(11) NOT NULL,
  `GroupID` int(20) NOT NULL,
  `ONID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Threads`
--

INSERT INTO `Threads` (`title`, `TopicID`, `GroupID`, `ONID`) VALUES
('Due date?', 3, 1, '932'),
('hello!', 76871, 1, 'alessanf'),
('Thread 3', 76872, 1, 'alessanf'),
('Thread 4', 76873, 1, 'alessanf'),
('Some message', 76874, 98735551, 'alessanf'),
('Hw 1 help', 76876, 98735551, 'egleyb'),
('Some name 2', 76877, 98735551, 'alessanf'),
('hw help', 76878, 98735552, 'egleyb'),
('Study Group for Quiz', 76879, 9987, 'egleyb');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Assignment`
--
ALTER TABLE `Assignment`
  ADD PRIMARY KEY (`assignmentID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `Class`
--
ALTER TABLE `Class`
  ADD PRIMARY KEY (`CourseID`),
  ADD KEY `ONID` (`ONID`);

--
-- Indexes for table `Group`
--
ALTER TABLE `Group`
  ADD PRIMARY KEY (`GroupID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `ONID` (`ONID`);

--
-- Indexes for table `GroupMember`
--
ALTER TABLE `GroupMember`
  ADD PRIMARY KEY (`GroupID`,`ONID`),
  ADD KEY `ONID` (`ONID`);

--
-- Indexes for table `Instructors`
--
ALTER TABLE `Instructors`
  ADD PRIMARY KEY (`ONID`);

--
-- Indexes for table `Messages`
--
ALTER TABLE `Messages`
  ADD PRIMARY KEY (`MessageID`),
  ADD KEY `TopicID` (`TopicID`),
  ADD KEY `ONID` (`ONID`);

--
-- Indexes for table `Students`
--
ALTER TABLE `Students`
  ADD PRIMARY KEY (`ONID`);

--
-- Indexes for table `TakingClass`
--
ALTER TABLE `TakingClass`
  ADD PRIMARY KEY (`ONID`,`CourseID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `Threads`
--
ALTER TABLE `Threads`
  ADD PRIMARY KEY (`TopicID`),
  ADD KEY `thread_ibfk_1` (`GroupID`),
  ADD KEY `ONID` (`ONID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Assignment`
--
ALTER TABLE `Assignment`
  MODIFY `assignmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `Class`
--
ALTER TABLE `Class`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3124243;
--
-- AUTO_INCREMENT for table `Group`
--
ALTER TABLE `Group`
  MODIFY `GroupID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98735561;
--
-- AUTO_INCREMENT for table `Messages`
--
ALTER TABLE `Messages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90132;
--
-- AUTO_INCREMENT for table `Threads`
--
ALTER TABLE `Threads`
  MODIFY `TopicID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76884;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Assignment`
--
ALTER TABLE `Assignment`
  ADD CONSTRAINT `Assignment_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `Class` (`CourseID`);

--
-- Constraints for table `Class`
--
ALTER TABLE `Class`
  ADD CONSTRAINT `Class_ibfk_1` FOREIGN KEY (`ONID`) REFERENCES `Instructors` (`ONID`);

--
-- Constraints for table `Group`
--
ALTER TABLE `Group`
  ADD CONSTRAINT `Group_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `Class` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Group_ibfk_2` FOREIGN KEY (`ONID`) REFERENCES `Students` (`ONID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `GroupMember`
--
ALTER TABLE `GroupMember`
  ADD CONSTRAINT `GroupMember_ibfk_2` FOREIGN KEY (`ONID`) REFERENCES `Students` (`ONID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `GroupMember_ibfk_3` FOREIGN KEY (`GroupID`) REFERENCES `Group` (`GroupID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Messages`
--
ALTER TABLE `Messages`
  ADD CONSTRAINT `Messages_ibfk_1` FOREIGN KEY (`TopicID`) REFERENCES `Threads` (`TopicID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Messages_ibfk_2` FOREIGN KEY (`ONID`) REFERENCES `Students` (`ONID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `TakingClass`
--
ALTER TABLE `TakingClass`
  ADD CONSTRAINT `TakingClass_ibfk_1` FOREIGN KEY (`ONID`) REFERENCES `Students` (`ONID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `TakingClass_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `Class` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Threads`
--
ALTER TABLE `Threads`
  ADD CONSTRAINT `Threads_ibfk_1` FOREIGN KEY (`GroupID`) REFERENCES `Group` (`GroupID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Threads_ibfk_2` FOREIGN KEY (`ONID`) REFERENCES `Students` (`ONID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
