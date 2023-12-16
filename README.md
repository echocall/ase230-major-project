Eric Jackman
Pam Pepper
Jacob Nelson


***You made need to change the BASE_URL constant in settings.php if navbar links aren't working properly***

SQL Dump:
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 03:30 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `squadup`
--

-- --------------------------------------------------------

--
-- Table structure for table `attends`
--

CREATE TABLE `attends` (
  `eventID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attends`
--

INSERT INTO `attends` (`eventID`, `userID`) VALUES
(1, 501),
(1, 502),
(3, 503);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventID` int(10) UNSIGNED NOT NULL,
  `groupID` int(11) UNSIGNED NOT NULL,
  `name` mediumtext NOT NULL,
  `startdate` date NOT NULL,
  `location` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventID`, `groupID`, `name`, `startdate`, `location`, `description`) VALUES
(1, 101, 'Board Game Night', '2023-12-01', 'Downtown Community Center', 'A fun night of board games and socializing'),
(2, 102, 'Chess Tournament', '2023-12-15', 'Local Library', 'Competitive chess tournament open for all skill levels'),
(3, 103, 'Strategy Games Meetup', '2023-12-20', 'City Park Hall', 'Meetup for enthusiasts of strategy games like Risk and Catan');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `gameID` int(10) UNSIGNED NOT NULL,
  `name` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`gameID`, `name`, `description`) VALUES
(1, 'Chess', 'A classic strategy game played on a checkered board'),
(2, 'Monopoly', 'A popular board game about real estate and economics'),
(3, 'Catan', 'A multiplayer board game where players collect resources and build settlements'),
(4, 'Starship Troopers: Extermination', 'A 16 player co-op FPS that puts you on the far-off front lines of an all-out battle against the bugs! Squad up, grab your rifle, and do your part as an elite Deep Space Vanguard Trooper set to take back planets claimed by the Arachnid thread!'),
(5, 'Sun Haven', 'Single player or Co-op farming game.'),
(6, 'Rocket League', 'Rocket League is a vehicular soccer video game developed and published by Psyonix'),
(7, 'Microsoft Allegiance', 'Fly full throttle into an epic multiplayer experience. Allegiance combines intense space combat with unique squad-based gameplay.'),
(8, 'Catan', 'Catan, previously known as The Settlers of Catan or simply Settlers, is a multiplayer board game designed by Klaus Teuber');

-- --------------------------------------------------------

--
-- Table structure for table `groupgames`
--

CREATE TABLE `groupgames` (
  `groupID` int(10) UNSIGNED NOT NULL,
  `gameID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groupgames`
--

INSERT INTO `groupgames` (`groupID`, `gameID`) VALUES
(101, 2),
(101, 3),
(102, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `groupID` int(255) UNSIGNED NOT NULL,
  `creatorID` int(255) UNSIGNED NOT NULL,
  `ownerID` int(255) UNSIGNED NOT NULL,
  `name` mediumtext NOT NULL,
  `type` mediumtext DEFAULT NULL,
  `timezone` mediumtext DEFAULT NULL,
  `website` mediumtext DEFAULT NULL,
  `webtext` mediumtext DEFAULT NULL,
  `bio` mediumtext DEFAULT NULL,
  `freetojoin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupID`, `creatorID`, `ownerID`, `name`, `type`, `timezone`, `website`, `webtext`, `bio`, `freetojoin`) VALUES
(101, 501, 501, 'Board Game Enthusiasts', 'Gaming', 'EST', 'www.boardgamers.com', 'Join us for fun!', 'We love all board games.', 1),
(102, 502, 503, 'Chess Masters', 'Sports', 'PST', 'www.chessmasters.com', 'All about chess.', 'Dedicated to the art of chess.', 0),
(103, 503, 503, 'Strategy Lovers', 'Hobby', 'CST', 'www.strategygames.org', 'Strategize with us!', 'For lovers of all strategy games.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `listingID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `gameID` int(11) UNSIGNED NOT NULL,
  `title` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`listingID`, `userID`, `gameID`, `title`, `description`) VALUES
(1, 503, 1, 'Looking for opponents', 'I am a beginner player looking for others to play with.'),
(2, 501, 2, 'Looking for 2 more players this evening.', 'Anyone welcome!'),
(3, 502, 1, 'Looking for coaching', 'Need an advanced player able to help me improve. Willing to compensate.');

-- --------------------------------------------------------

--
-- Table structure for table `memberof`
--

CREATE TABLE `memberof` (
  `userID` int(10) UNSIGNED NOT NULL,
  `groupID` int(10) UNSIGNED NOT NULL,
  `role` mediumtext DEFAULT NULL,
  `isModerator` tinyint(1) NOT NULL DEFAULT 0,
  `dateJoined` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memberof`
--

INSERT INTO `memberof` (`userID`, `groupID`, `role`, `isModerator`, `dateJoined`) VALUES
(501, 101, 'owner', 1, '2023-11-21 01:07:08'),
(501, 102, 'member', 0, '2023-11-21 01:07:36'),
(503, 103, 'moderator', 1, '2023-11-21 01:08:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(255) UNSIGNED NOT NULL,
  `username` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `description` varchar(500) NOT NULL,
  `timeZone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `playTime` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `siteAdmin` tinyint(1) DEFAULT NULL,
  `openToInvite` tinyint(1) DEFAULT NULL,
  `messagesOpen` tinyint(1) DEFAULT NULL,
  `profilePicture` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='holds user info';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `email`, `password`, `name`, `description`, `timeZone`, `playTime`, `siteAdmin`, `openToInvite`, `messagesOpen`, `profilePicture`) VALUES
(501, 'john_doe', 'john.doe@example.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'John Doe', '', 'EST', 'Evenings', 0, 1, 1, NULL),
(502, 'jane_smith', 'jane.smith@example.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Jane Smith', '', 'PST', 'Weekends', 0, 0, 1, NULL),
(503, 'alex_brown', 'alex.brown@example.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Alex Brown', '', 'CST', 'Afternoons', 1, 1, 0, NULL),
(504, 'admintest', 'test@hotmail.com', 'AT3st@ccount', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL),
(505, 'tester3', 'no1@1.one', '$2y$10$pVh9B3qKg8zSKeiD10s/uuzfkTBQY3XiC1A4WbOe7MK7dMCLU/V72', '', '', '', '', 1, 0, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attends`
--
ALTER TABLE `attends`
  ADD PRIMARY KEY (`eventID`,`userID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventID`),
  ADD KEY `groupID` (`groupID`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`gameID`);

--
-- Indexes for table `groupgames`
--
ALTER TABLE `groupgames`
  ADD PRIMARY KEY (`groupID`,`gameID`),
  ADD KEY `gameID` (`gameID`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupID`),
  ADD KEY `creatorID` (`creatorID`),
  ADD KEY `ownerID` (`ownerID`);

--
-- Indexes for table `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`listingID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `gameID` (`gameID`);

--
-- Indexes for table `memberof`
--
ALTER TABLE `memberof`
  ADD PRIMARY KEY (`userID`,`groupID`),
  ADD KEY `groupID` (`groupID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `gameID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groupID` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=506;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attends`
--
ALTER TABLE `attends`
  ADD CONSTRAINT `attends_ibfk_1` FOREIGN KEY (`eventID`) REFERENCES `events` (`eventID`),
  ADD CONSTRAINT `attends_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `to_groups` FOREIGN KEY (`groupID`) REFERENCES `groups` (`groupID`);

--
-- Constraints for table `groupgames`
--
ALTER TABLE `groupgames`
  ADD CONSTRAINT `groupgames_ibfk_1` FOREIGN KEY (`gameID`) REFERENCES `games` (`gameID`),
  ADD CONSTRAINT `groupgames_ibfk_2` FOREIGN KEY (`groupID`) REFERENCES `groups` (`groupID`);

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`creatorID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `groups_ibfk_2` FOREIGN KEY (`ownerID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `listings`
--
ALTER TABLE `listings`
  ADD CONSTRAINT `listings_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `listings_ibfk_2` FOREIGN KEY (`gameID`) REFERENCES `games` (`gameID`);

--
-- Constraints for table `memberof`
--
ALTER TABLE `memberof`
  ADD CONSTRAINT `memberof_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `memberof_ibfk_2` FOREIGN KEY (`groupID`) REFERENCES `groups` (`groupID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
