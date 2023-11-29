-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 29, 2023 at 09:24 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(55) DEFAULT NULL,
  `description` text,
  `author` text,
  `authorId` int(11) NOT NULL,
  `img_src` text,
  `publish_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `description`, `author`, `authorId`, `img_src`, `publish_date`) VALUES
(1, 'Les dernières avancées technologiques en IA', 'Cet article explore les progrès récents dans le domaine de l intelligence artificielle, mettant en lumière les applications émergentes, les défis et les implications éthiques. Des sujets tels que l apprentissage profond, la vision par ordinateur et les chatbots sont abordés en détail.', 'FuturoByte Expert', 1, './Assets/Img/ia_750.png', '2023-01-15 08:00:00'),
(2, 'Voyager à travers le temps avec la physique quantique', ' Découvrez les théories fascinantes de la physique quantique qui suggèrent la possibilité de voyager dans le temps. Cet article explore les concepts de distorsion temporelle, les expériences de pensée et les implications philosophiques liées à cette idée intrigante.', 'TemporalVortex Voyager', 2, './Assets/Img/voyage-temps-science.avif', '2023-02-10 12:30:00'),
(3, 'Les bienfaits de la méditation pour la santé mentale', 'Plongez dans les avantages de la méditation sur la santé mentale. Cet article examine les effets positifs de la méditation sur le stress, l anxiété et la concentration. Des techniques de méditation populaires et des études scientifiques récentes sont également présentées.', 'SerenitySeeker', 3, './Assets/Img/mental-health-2019924_640.jpg', '2023-03-05 18:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `username` text,
  `Name` text,
  `Lastname` text,
  `Picture` text,
  `DateOfBirth` datetime DEFAULT NULL,
  `Description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `username`, `Name`, `Lastname`, `Picture`, `DateOfBirth`, `Description`) VALUES
(1, 'FuturoByte Expert', 'Jacque', 'Laloose', './Assets/Img/Author1.jpg', '1999-12-18 00:00:00', 'FuturoByte Expert incarne l avant-garde de la pensée futuriste et de l expertise technologique. Cet auteur visionnaire navigue dans les méandres des avancées technologiques, proposant des perspectives uniques sur l impact de la technologie sur notre avenir. Avec une plume audacieuse et un esprit analytique, FuturoByte Expert explore les frontières de l intelligence artificielle, de la robotique, des biotechnologies et bien plus encore.\r\n\r\nDoté d une capacité exceptionnelle à anticiper les tendances émergentes, FuturoByte Expert offre des insights pertinents et éclairants, invitant les lecteurs à repenser leur compréhension du monde qui évolue rapidement. Que ce soit à travers des ouvrages visionnaires, des articles provocateurs ou des interventions médiatiques, FuturoByte Expert se positionne comme un guide essentiel pour ceux qui cherchent à comprendre et à naviguer dans le paysage technologique en constante mutation.\r\n\r\nSa passion contagieuse pour l avenir, combinée à une expertise pointue, fait de FuturoByte Expert un acteur incontournable pour tous ceux qui s intéressent à l intersection passionnante entre la technologie et notre destin collectif.'),
(2, 'TemporalVortex', 'Nicolas', 'Delatour', './Assets/Img/Author2.jpg', '1967-01-15 08:00:00', 'TemporalVortex Voyager  incarne l aventurier du temps, explorant les mystères de la temporalité avec une plume captivante. Cet auteur visionnaire offre des perspectives uniques sur le voyage dans le temps, dévoilant des horizons inexplorés de la science-fiction. À travers des récits percutants et des idées novatrices, TemporalVortex Voyager transporte les lecteurs dans un voyage fascinant à travers les plis du temps, redéfinissant notre perception de la réalité et de l avenir. Un guide essentiel pour ceux qui cherchent une évasion temporelle à chaque page.'),
(3, 'SerenitySeeker', 'Joe', 'Laramasse', './Assets/Img/Author3.avif', '1987-03-25 18:45:00', 'SerenitySeeker guide les lecteurs vers la quiétude intérieure à travers ses mots apaisants. En tant qu auteur de bien-être, SerenitySeeker offre une échappatoire réconfortante dans un monde agité. À travers des écrits empreints de sagesse et de tranquillité, l auteur invite à explorer le calme intérieur, offrant des conseils pratiques pour trouver la sérénité au milieu du tumulte quotidien. Une plume réconfortante qui inspire à rechercher la paix intérieure, faisant de chaque page une invitation à la quiétude.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
