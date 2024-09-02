-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: ian. 26, 2023 la 08:55 PM
-- Versiune server: 10.4.27-MariaDB
-- Versiune PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `login_db`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `playlist`
--

CREATE TABLE `playlist` (
  `id` int(100) NOT NULL,
  `playlistid` bigint(19) NOT NULL,
  `playlist_name` varchar(100) NOT NULL,
  `userid` bigint(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `playlist`
--

INSERT INTO `playlist` (`id`, `playlistid`, `playlist_name`, `userid`) VALUES
(80, 8796551, 'saasa', 3308045265927),
(81, 58233, 'saasa', 3308045265927),
(82, 641044232975, 'saasa', 3308045265927),
(83, 5019038890, 'yes', 94649290541940),
(88, 57717120, 'hello', 63264654288020663),
(89, 55225156349865131, 'Mathias', 63264654288020663),
(91, 71799652791712, 'Mathias', 14578),
(92, 281432915130859502, 'muzica', 5232),
(94, 9180, 'Muzică rock', 8699285978083900632),
(95, 8771, 'Muzică pop', 8699285978083900632),
(96, 2498, 'muzică rap', 8699285978083900632);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `songid` bigint(19) NOT NULL,
  `playlistid` bigint(19) NOT NULL,
  `song_name` varchar(100) NOT NULL,
  `song_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `songs`
--

INSERT INTO `songs` (`id`, `songid`, `playlistid`, `song_name`, `song_path`) VALUES
(51, 3304122766201, 354223244430442344, 'lolivia1.mp3', 'upload/lolivia1.mp3'),
(60, 85346, 3442722590899, 'lolivia1.mp3', 'upload/lolivia1.mp3'),
(61, 987964685062089, 3442722590899, 'lolivia1.mp3', 'upload/lolivia1.mp3'),
(62, 6595121290697298, 3442722590899, 'lolivia1.mp3', 'upload/lolivia1.mp3'),
(64, 851215971041109827, 641044232975, 'SnapSave.io - Doar Cristos, Speranța mea - BBSO (128 kbps).mp3', 'upload/SnapSave.io - Doar Cristos, Speranța mea - BBSO (128 kbps).mp3'),
(67, 615586972173035, 925770787894471, 'SnapSave.io - Doar Cristos, Speranța mea - BBSO (128 kbps).mp3', 'upload/SnapSave.io - Doar Cristos, Speranța mea - BBSO (128 kbps).mp3'),
(68, 78001, 925770787894471, 'Sacunoscrefren1.mp3', 'upload/Sacunoscrefren1.mp3'),
(70, 89611728559592, 71799652791712, 'RefrenVoce2Iesle.mp3', 'upload/RefrenVoce2Iesle.mp3'),
(71, 8231321, 71799652791712, 'Intr-oiesleDemo.mp3', 'upload/Intr-oiesleDemo.mp3'),
(77, 514234937901, 2498, 'Avicii - Broken Arrows.mp3', 'upload/Avicii - Broken Arrows.mp3'),
(78, 84297980, 2498, 'Stephen Sanchez - Until I Found You.mp3', 'upload/Stephen Sanchez - Until I Found You.mp3');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userid` bigint(19) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `userid`, `first_name`, `last_name`, `email`, `username`, `password`, `date`, `user_role`) VALUES
(60, 63264654288020663, 'boss', 'daboss', 'mathias.mihalcea@gmail.com', 'bossdaboss', 'boss12345', '2023-01-25 17:49:56', 'admin'),
(140, 14578, 'admin', 'main', 'admin@gmail.com', 'adminmain', 'admin1234', '2023-01-26 19:48:33', 'admin'),
(152, 880692382, 'Mathias', 'Mihalcea', 'george.marian@gmail.com', 'sdasdsadasd', 'mathyas1234', '2023-01-25 17:28:57', ''),
(155, 469610561872206928, 'Mathias', 'Mihalcea', 'asdasas@gmail.com', 'mathiasboss', 'mathyas1234', '2023-01-25 20:00:59', ''),
(160, 60199361, 'User', 'One', 'dasdhsldajhs@gmail.com', 'userone1', 'mathyas1234', '2023-01-26 18:49:44', ''),
(161, 8699285978083900632, 'Example', 'One', 'exampleone@gmail.com', 'exampleone', 'mathyas1234', '2023-01-26 18:50:27', '');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `playlistid` (`playlistid`),
  ADD KEY `playlist_name` (`playlist_name`),
  ADD KEY `userid` (`userid`);

--
-- Indexuri pentru tabele `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `songid` (`songid`),
  ADD KEY `playlistid` (`playlistid`),
  ADD KEY `song_name` (`song_name`),
  ADD KEY `song_path` (`song_path`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_uid` (`username`),
  ADD KEY `date` (`date`),
  ADD KEY `userid` (`userid`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `user_role` (`user_role`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT pentru tabele `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
