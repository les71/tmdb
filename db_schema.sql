-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Gép: localhost:3306
-- Kiszolgáló verziója: 10.3.27-MariaDB-log-cll-lve
-- PHP verzió: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Adatbázis: `tmdb`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `directors`
--

CREATE TABLE `directors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `date of birth` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `isdownload` enum('yes') CHARACTER SET latin1 DEFAULT NULL,
  `valid` enum('yes') CHARACTER SET latin1 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `valid` enum('yes') CHARACTER SET latin1 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `movies`
--

CREATE TABLE `movies` (
  `tmdb_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `length` int(5) DEFAULT NULL,
  `release date` datetime DEFAULT NULL,
  `overview` text DEFAULT NULL,
  `poster url` varchar(255) DEFAULT NULL,
  `vote average` float DEFAULT NULL,
  `vote count` int(11) DEFAULT NULL,
  `tmdb url` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `isdownload` enum('yes') CHARACTER SET latin1 DEFAULT NULL,
  `valid` enum('yes') CHARACTER SET latin1 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `movie_to_director`
--

CREATE TABLE `movie_to_director` (
  `movie_id` int(11) NOT NULL,
  `director_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `valid` enum('yes') CHARACTER SET latin1 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `movie_to_genre`
--

CREATE TABLE `movie_to_genre` (
  `movie_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `valid` enum('yes') CHARACTER SET latin1 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `top_rated`
--

CREATE TABLE `top_rated` (
  `movie_id` int(11) NOT NULL,
  `actual_place` int(2) NOT NULL,
  `new_place` int(2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`tmdb_id`);

--
-- A tábla indexei `movie_to_director`
--
ALTER TABLE `movie_to_director`
  ADD UNIQUE KEY `movie_id` (`movie_id`,`director_id`);

--
-- A tábla indexei `movie_to_genre`
--
ALTER TABLE `movie_to_genre`
  ADD UNIQUE KEY `movie_id` (`movie_id`,`genre_id`);

--
-- A tábla indexei `top_rated`
--
ALTER TABLE `top_rated`
  ADD PRIMARY KEY (`movie_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `movies`
--
ALTER TABLE `movies`
  MODIFY `tmdb_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
