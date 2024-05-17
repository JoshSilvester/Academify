-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 04:39 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapter`
--

CREATE TABLE `chapter` (
  `id_course` int(11) NOT NULL,
  `id_chapter` int(11) NOT NULL,
  `chapter_name` varchar(255) NOT NULL,
  `chap_desc` mediumtext NOT NULL,
  `chapter_content` longtext NOT NULL,
  `chapter_ppt` varchar(200) DEFAULT NULL,
  `chapter_gdrive` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chapter`
--

INSERT INTO `chapter` (`id_course`, `id_chapter`, `chapter_name`, `chap_desc`, `chapter_content`, `chapter_ppt`, `chapter_gdrive`) VALUES
(1, 1, 'wow', 'agama banyak', 'banyak bat', NULL, NULL),
(1, 2, 'agama 20', 'ini agama', 'agama vs agama', NULL, NULL),
(2, 3, 'Aljabar', 'Ini Aljabar', 'Aku suka Aljabar', '', ''),
(14, 4, 'Indonesia', 'Aku Indonesia', 'Saya Cinta Indonesia', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id_course` int(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `course_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id_course`, `course_name`, `description`, `course_img`) VALUES
(1, 'agama', 'agama 5', 'agama.jpg'),
(2, 'Matematika', 'Matimatika', 'matematika.jpeg'),
(14, 'law', 'lorem ipsum', 'pkn.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `learning_path`
--

CREATE TABLE `learning_path` (
  `no` int(255) NOT NULL,
  `path_id` int(255) NOT NULL,
  `path_name` varchar(255) NOT NULL,
  `id_chapter` int(255) NOT NULL,
  `path_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `learning_path`
--

INSERT INTO `learning_path` (`no`, `path_id`, `path_name`, `id_chapter`, `path_img`) VALUES
(3, 2, 'sdwsds', 1, 'ipa.jpg'),
(16, 1, 'war history', 1, 'Sejarah.jpg'),
(17, 1, 'war history', 2, 'Sejarah.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id_course` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  `id_chapter` int(11) NOT NULL,
  `quiz_question` varchar(255) NOT NULL,
  `ans_a` varchar(255) NOT NULL,
  `ans_b` varchar(255) NOT NULL,
  `ans_c` varchar(255) NOT NULL,
  `ans_d` varchar(255) NOT NULL,
  `correct_ans` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id_course`, `no`, `id_chapter`, `quiz_question`, `ans_a`, `ans_b`, `ans_c`, `ans_d`, `correct_ans`) VALUES
(1, 1, 1, 'siapa tuhan mu', 'diasiapa', 'iyaaja', 'mungkinbisa', 'gktau', 'iyaaja'),
(1, 2, 2, 'agama apa mereka', 'tidak tau', 'mungkin sama', 'berbeda tapi satu', 'gk punya', 'tidak tau'),
(1, 3, 1, 'AMBATUNAT', 'be', 'SALAH', 'AOP', 'IYA', 'IYA'),
(1, 4, 1, 'Aku atomic', 'mantap', 'banget', 'bange', 'chuini', 'bange'),
(1, 5, 2, 'Aku tobrut', 'Jahat', 'baik', 'suci', 'setia', 'Jahat'),
(2, 6, 3, '1+1', '12', '2', '3', '4', '2'),
(14, 7, 4, 'Apa dasar negara Indonesia', 'Pancasila', 'PKI', 'GAM', 'OPM', 'Pancasila');

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `no` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_course` int(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `score` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`no`, `id_user`, `id_course`, `course_name`, `score`) VALUES
(9, 123213123, 1, 'agama', '80'),
(16, 123, 1, 'agama', '60'),
(19, 123, 14, 'law', '100'),
(22, 123, 2, 'Matematika', '0');

-- --------------------------------------------------------

--
-- Table structure for table `student_answer`
--

CREATE TABLE `student_answer` (
  `no` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_quiz` int(11) NOT NULL,
  `id_question` int(255) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_answer`
--

INSERT INTO `student_answer` (`no`, `id_user`, `id_quiz`, `id_question`, `answer`) VALUES
(186, 123213123, 1, 1, 'iyaaja'),
(187, 123213123, 1, 2, 'gk punya'),
(188, 123213123, 1, 3, 'IYA'),
(189, 123213123, 1, 4, 'bange'),
(190, 123213123, 1, 5, 'Jahat'),
(239, 123, 2, 1, '12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `id_user`, `username`, `password`, `email_user`, `class`, `profile_picture`, `usertype`) VALUES
('sir josh', 101, 'josh', 'pass', 'rila@gmail', 'ipa1', 'compdude.png', 'teacher'),
('Yohanes ytta', 123, 'hanes', 'pass', 'yohanes@gmail.com', 'ipa2', 'irene.png', 'student'),
('testname', 123213123, 'username', 'pass', 'email@test', 'ipa1', '6dzy2e.jpg', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `wrong_answer`
--

CREATE TABLE `wrong_answer` (
  `id_user` int(11) NOT NULL,
  `id_course` int(255) NOT NULL,
  `id_chapter` int(11) NOT NULL,
  `no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wrong_answer`
--

INSERT INTO `wrong_answer` (`id_user`, `id_course`, `id_chapter`, `no`) VALUES
(123, 1, 1, 276),
(123, 1, 2, 277),
(123, 2, 3, 279);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`id_chapter`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id_course`);

--
-- Indexes for table `learning_path`
--
ALTER TABLE `learning_path`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `student_answer`
--
ALTER TABLE `student_answer`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `wrong_answer`
--
ALTER TABLE `wrong_answer`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `id_chapter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id_course` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `learning_path`
--
ALTER TABLE `learning_path`
  MODIFY `no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `student_answer`
--
ALTER TABLE `student_answer`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `wrong_answer`
--
ALTER TABLE `wrong_answer`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
