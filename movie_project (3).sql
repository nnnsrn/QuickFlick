-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 28, 2025 at 01:46 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int NOT NULL,
  `genre_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre_name`) VALUES
(1, 'Action'),
(2, 'Comedy'),
(3, 'Drama'),
(4, 'Adventure'),
(5, 'Sci-Fi'),
(6, 'Horror');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `movie_id` int NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `budget` bigint DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `revenue` bigint DEFAULT NULL,
  `runtime` int DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `votes_avg` decimal(3,1) DEFAULT NULL,
  `votes_count` int DEFAULT NULL,
  `poster` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `studio_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`movie_id`, `title`, `budget`, `release_date`, `revenue`, `runtime`, `status`, `votes_avg`, `votes_count`, `poster`, `studio_id`) VALUES
(1, 'Avengers: Endgame', 356000000, '2019-04-26', 2797800564, 181, 'Released', '8.4', 700000, 'https://m.media-amazon.com/images/I/81ExhpBEbHL._AC_SY679_.jpg', NULL),
(2, 'La La Land', 30000000, '2016-12-09', 446100000, 128, 'Released', '8.0', 500001, 'https://m.media-amazon.com/images/I/41-DDcNrazL._AC_UF894,1000_QL80_.jpg', NULL),
(3, 'Iron Man', 140000000, '2008-05-02', 585000000, 126, 'Released', '7.9', 600000, 'https://mir-s3-cdn-cf.behance.net/project_modules/source/e9cef893450699.5e65542bcfc77.jpg', NULL),
(4, 'Jungle Cruise', 200000000, '2021-07-30', 220000000, 127, 'Released', '6.7', 200000, 'https://m.media-amazon.com/images/I/711jcRM+QZL._AC_UF894,1000_QL80_.jpg', NULL),
(5, 'Spider-Man: Homecoming', 175000000, '2017-07-07', 880000000, 133, 'Released', '7.5', 550000, 'https://m.media-amazon.com/images/I/71HQ7lBgbGL._AC_UF894,1000_QL80_.jpg', NULL),
(11, 'Harry Potter and the Sorcerer\'s Stone', 125000000, '2001-11-16', 1026428854, 152, 'Released', '7.7', 902000, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQeQbkD_MyxjNNCInv_A148UO94wS09VRvU7g&s', NULL),
(12, 'The Lord of the Rings: The Fellowship of the Ring', 93000000, '2001-12-19', 888483037, 178, 'Released', '8.9', 2100000, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSozxOlu5feBVSPyRnHNO203Rtx9XhpZuXhtQ&s', NULL),
(13, 'The Lord of the Rings: The Two Towers', 94000000, '2002-12-18', 938532865, 179, 'Released', '8.8', 1900000, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXf53cAHVWrrMRe9stGwbysSTMk8pXjpLnYw&s', NULL),
(14, 'The Lord of the Rings: The Return of the King', 94000000, '2003-12-17', 1138585992, 211, 'Released', '9.0', 2100000, 'https://m.media-amazon.com/images/M/MV5BMTZkMjBjNWMtZGI5OC00MGU0LTk4ZTItODg2NWM3NTVmNWQ4XkEyXkFqcGc@._V1_.jpg', NULL),
(15, 'The Hobbit: An Unexpected Journey', 180000000, '2012-12-14', 1017107150, 169, 'Released', '7.8', 902000, 'https://m.media-amazon.com/images/I/61n3qIANJ5L.jpg', NULL),
(16, 'The Hobbit: The Desolation of Smaug', 225000000, '2013-12-13', 959079095, 161, 'Released', '7.8', 731000, 'https://m.media-amazon.com/images/I/71iOSKkZvcL._AC_UF894,1000_QL80_.jpg', NULL),
(17, 'The Hobbit: The Battle of the Five Armies', 250000000, '2014-12-17', 962253946, 144, 'Released', '7.4', 596000, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKeUa3PTduLx2Q4H9-mGw8J9n9oFjPCOobyw&s', NULL),
(18, 'Spirited Away', 19000000, '2001-07-20', 358900157, 124, 'Released', '8.6', 907000, 'https://s3.amazonaws.com/nightjarprod/content/uploads/sites/249/2024/05/13153104/39wmItIWsg5sZMyRUHLkWBcuVCM-1-scaled.jpg', NULL),
(19, 'Coco', 175000000, '2017-11-22', 814641172, 105, 'Released', '8.4', 648000, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQm5Xg3MeEBBBizVNRGPOqRXepysq-OERp6pQ&s', NULL),
(20, 'Enchanted', 80000000, '2007-11-21', 340500000, 107, '0', '7.1', 223690, 'uploads/poster_680f427ebe86b5.52957669.jpg', NULL),
(21, 'Up', 175000000, '2009-05-29', 735100000, 96, '0', '8.3', 1186000, 'uploads/poster_680f433f8f4511.39756408.jpg', NULL),
(22, 'Soul', 150000000, '2020-12-25', 121000000, 100, '0', '8.0', 396000, 'uploads/poster_680f4439620f35.34108691.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `movie_cast`
--

CREATE TABLE `movie_cast` (
  `movie_id` int NOT NULL,
  `person_id` int NOT NULL,
  `character_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie_cast`
--

INSERT INTO `movie_cast` (`movie_id`, `person_id`, `character_name`) VALUES
(1, 1, 'Captain America'),
(1, 2, 'Black Widow'),
(1, 3, 'Iron Man'),
(2, 4, 'Mia'),
(5, 5, 'Spider-Man');

-- --------------------------------------------------------

--
-- Table structure for table `movie_genre`
--

CREATE TABLE `movie_genre` (
  `movie_id` int NOT NULL,
  `genre_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie_genre`
--

INSERT INTO `movie_genre` (`movie_id`, `genre_id`) VALUES
(1, 1),
(3, 1),
(5, 1),
(2, 2),
(4, 2),
(2, 3),
(4, 4),
(5, 4),
(1, 5),
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `person_id` int NOT NULL,
  `person_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `person_name`) VALUES
(1, 'Chris Evans'),
(2, 'Scarlett Johansson'),
(3, 'Robert Downey Jr.'),
(4, 'Emma Stone'),
(5, 'Tom Holland');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int NOT NULL,
  `movie_id` int NOT NULL,
  `rating` int NOT NULL,
  `comment` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studio`
--

CREATE TABLE `studio` (
  `studio_id` int NOT NULL,
  `studio_name` varchar(255) NOT NULL,
  `studio_location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `studio`
--

INSERT INTO `studio` (`studio_id`, `studio_name`, `studio_location`) VALUES
(1, 'Marvel Studios', 'United States'),
(2, 'Pixar', 'United States'),
(3, 'Warner Bros', 'United States'),
(4, 'Universal Pictures', 'United States'),
(5, 'Disney', 'United States');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `movie_cast`
--
ALTER TABLE `movie_cast`
  ADD PRIMARY KEY (`movie_id`,`person_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD PRIMARY KEY (`movie_id`,`genre_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `studio`
--
ALTER TABLE `studio`
  ADD PRIMARY KEY (`studio_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `movie_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studio`
--
ALTER TABLE `studio`
  MODIFY `studio_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movie_cast`
--
ALTER TABLE `movie_cast`
  ADD CONSTRAINT `movie_cast_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`),
  ADD CONSTRAINT `movie_cast_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD CONSTRAINT `movie_genre_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`),
  ADD CONSTRAINT `movie_genre_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
