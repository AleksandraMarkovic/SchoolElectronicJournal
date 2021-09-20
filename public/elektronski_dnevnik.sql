-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2021 at 02:18 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elektronski_dnevnik`
--

-- --------------------------------------------------------

--
-- Table structure for table `cas`
--

CREATE TABLE `cas` (
  `id_cas` int(10) NOT NULL,
  `opis` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `datum` date NOT NULL,
  `po_redu` int(10) NOT NULL,
  `napomena` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_korisnik` int(10) NOT NULL,
  `id_predmet` int(10) NOT NULL,
  `id_odeljenje` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cas`
--

INSERT INTO `cas` (`id_cas`, `opis`, `datum`, `po_redu`, `napomena`, `id_korisnik`, `id_predmet`, `id_odeljenje`) VALUES
(1, 'Trigonometrijske funkcije', '2021-09-01', 1, NULL, 2, 8, 1),
(2, 'Bezbednost dece na internetu', '2021-09-01', 2, NULL, 17, 11, 1),
(3, 'V. Šekspir: Romeo i Julija', '2021-09-01', 3, NULL, 3, 1, 1),
(4, 'Sistem organa za varenje čoveka', '2021-09-01', 4, NULL, 8, 7, 1),
(5, 'Prirodni resursi Srbije', '2021-09-01', 5, NULL, 7, 6, 1),
(6, 'Oboljenja organa za varenje', '2021-09-02', 1, NULL, 8, 7, 1),
(7, 'Crkveno predanje i narodna predanja', '2021-09-02', 2, NULL, 21, 15, 1),
(8, 'Present Simple Tense', '2021-09-02', 3, NULL, 4, 2, 1),
(11, 'Odbojka ekipna taktika', '2021-09-02', 4, NULL, 15, 14, 1),
(12, 'Kulonov zakon', '2021-09-02', 5, NULL, 27, 9, 1),
(13, 'Evropski kulturni uticaji', '2021-09-03', 1, NULL, 18, 5, 1),
(14, 'Past continuous tense', '2021-09-06', 1, NULL, 4, 2, 1),
(15, 'Književnost baroka i klasicizma', '2021-09-07', 1, NULL, 3, 1, 1),
(16, 'Deljivost polinoma, Bezuova teorema', '2021-09-08', 1, NULL, 2, 8, 1),
(17, 'Filogenija nižih biljaka', '2021-09-09', 1, NULL, 8, 7, 1),
(18, 'Srpska država i državnost', '2021-09-10', 1, NULL, 18, 5, 1),
(19, 'New Year\'s Celebrations', '2021-09-13', 1, NULL, 4, 2, 1),
(20, 'Aksenatski sistem srpskog jezika', '2021-09-14', 1, NULL, 3, 1, 1),
(21, 'Linerane jednačine i nejednačine', '2021-09-03', 2, NULL, 2, 8, 1),
(22, 'Organizacija slajda, pozadina slajda', '2021-09-03', 3, NULL, 17, 11, 1),
(23, 'Karakteristike slikarskih materijala', '2021-09-03', 4, NULL, 9, 13, 1),
(24, 'Imenice (zajedničke i vlastite)', '2021-09-03', 5, NULL, 13, 17, 1),
(25, 'Pojam vremena i klime', '2021-09-06', 2, NULL, 7, 6, 1),
(26, 'Ugljeni hidrati - monosaharidi', '2021-09-06', 3, NULL, 6, 10, 1),
(27, 'F. Šopen: Minutni valcer', '2021-09-06', 4, NULL, 10, 12, 1),
(28, 'Druga deklinacija - imenice', '2021-09-06', 5, NULL, 12, 3, 1),
(29, 'Conditional Sentences', '2021-09-07', 2, NULL, 4, 2, 1),
(30, 'Linearna funkcija, grafik i osobine', '2021-09-07', 3, NULL, 2, 8, 1),
(31, 'Odbojka servis, uvežbavanje', '2021-09-07', 4, NULL, 15, 14, 1),
(32, 'Pridevi, predlozi, prilozi', '2021-09-07', 5, NULL, 13, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id_korisnik` int(10) NOT NULL,
  `ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kor_ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sifra` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slika` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `telefon` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_uloga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id_korisnik`, `ime`, `prezime`, `kor_ime`, `sifra`, `email`, `slika`, `telefon`, `id_uloga`) VALUES
(1, 'Aleksandra', 'Marković', 'aleksandra.markovic', '25d55ad283aa400af464c76d713c07ad', 'markovic749@gmail.com', 'autor.jpg', NULL, 1),
(2, 'Senka', 'Gavrilović', 'senka.gavrilovic', '25d55ad283aa400af464c76d713c07ad', 'senka@gmail.com', 'profesor.jpg', NULL, 2),
(3, 'Ana', 'Baralić', 'ana.baralic', '25d55ad283aa400af464c76d713c07ad', 'ana@gmail.com', 'user.png', NULL, 2),
(4, 'Olja', 'Laudanović', 'olja.laudanovic', '25d55ad283aa400af464c76d713c07ad', 'olja@gmail.com', 'user.png', NULL, 3),
(5, 'Dragan', 'Jovanović', 'dragan.jovanovic', '25d55ad283aa400af464c76d713c07ad', 'dragan@gmail.com', 'user.png', NULL, 2),
(6, 'Zoran', 'Roljević', 'zoran.roljevic', '25d55ad283aa400af464c76d713c07ad', 'zoran@gmail.com', 'user.png', NULL, 3),
(7, 'Biljana', 'Maleš', 'biljana.males', '25d55ad283aa400af464c76d713c07ad', 'biljana@gmail.com', 'user.png', NULL, 3),
(8, 'Dušica', 'Borovnjak', 'dusica.borovnjak', '25d55ad283aa400af464c76d713c07ad', 'dusica@gmail.com', 'user.png', NULL, 2),
(9, 'Filip', 'Trnavac', 'filip.trnavac', '25d55ad283aa400af464c76d713c07ad', 'filip@gmail.com', 'user.png', NULL, 3),
(10, 'Srđan', 'Novaković', 'srdjan.novakovic', '25d55ad283aa400af464c76d713c07ad', 'srdjan@gmail.com', 'user.png', NULL, 3),
(11, 'Ivana', 'Tolić', 'ivana.tolic', '25d55ad283aa400af464c76d713c07ad', 'ivana@gmail.com', 'user.png', NULL, 2),
(12, 'Marija', 'Filipović', 'marija.filipovic', '25d55ad283aa400af464c76d713c07ad', 'marija@gmail.com', 'user.png', NULL, 3),
(13, 'Dragana', 'Milosavljević', 'dragana.milosavljevic', '25d55ad283aa400af464c76d713c07ad', 'dragana@gmail.com', 'user.png', NULL, 3),
(14, 'Sanja', 'Ognjenović', 'sanja.ognjenovic', '25d55ad283aa400af464c76d713c07ad', 'sanja@gmail.com', 'user.png', NULL, 2),
(15, 'Dragan', 'Čavorović', 'dragan.cavorovic', '25d55ad283aa400af464c76d713c07ad', 'dragan@gmail.com', 'user.png', NULL, 3),
(16, 'Katarina', 'Nešović', 'katarina.nesovic', '25d55ad283aa400af464c76d713c07ad', 'katarina@gmail.com', 'user.png', NULL, 2),
(17, 'Ilija', 'Todorović', 'ilija.todorovic', '25d55ad283aa400af464c76d713c07ad', 'ilija@gmail.com', 'user.png', NULL, 3),
(18, 'Vesna', 'Vučićević', 'vesna.vucicevic', '25d55ad283aa400af464c76d713c07ad', 'vesna@gmail.com', 'user.png', NULL, 2),
(19, 'Marko', 'Jovanović', 'marko.jovanovic', '25d55ad283aa400af464c76d713c07ad', 'marko@gmail.com', 'user.png', NULL, 3),
(20, 'Janko', 'Janković', 'janko.jankovic', '25d55ad283aa400af464c76d713c07ad', 'janko@gmail.com', 'user.png', NULL, 3),
(21, 'Branko', 'Igrutinović', 'branko.igrutinovic', '25d55ad283aa400af464c76d713c07ad', 'branko@gmail.com', 'user.png', NULL, 3),
(22, 'Natalija', 'Krstić', 'natalija.krstic', '25d55ad283aa400af464c76d713c07ad', 'natalija@gmail.com', 'user.png', NULL, 3),
(23, 'Jana', 'Đukanović', 'jana.djukanovic', '25d55ad283aa400af464c76d713c07ad', 'jana@gmail.com', 'user.png', NULL, 2),
(24, 'Marija', 'Živković', 'marija.zivkovic', '25d55ad283aa400af464c76d713c07ad', 'marija@gmail.com', 'user.png', NULL, 2),
(25, 'Lazar', 'Stepanić', 'lazar.stepanic', '25d55ad283aa400af464c76d713c07ad', 'lazar@gmail.com', 'user.png', NULL, 2),
(26, 'Uroš', 'Jelić', 'uros.jelic', '25d55ad283aa400af464c76d713c07ad', 'uros@gmail.com', 'user.png', NULL, 2),
(27, 'Nikola', 'Kovačević', 'nikola.kovacevic', '25d55ad283aa400af464c76d713c07ad', 'nikola@gmail.com', 'user.png', NULL, 3),
(28, 'Tijana', 'Marković', 'tijana.markovic', '25d55ad283aa400af464c76d713c07ad', 'tijana@gmail.com', 'user.png', NULL, 3),
(29, 'Anđela', 'Pavlović', 'andjela.pavlovic', '25d55ad283aa400af464c76d713c07ad', 'andjela@gmail.com', 'user.png', NULL, 2),
(30, 'Jovana', 'Maksimović', 'jovana.maksimovic', '25d55ad283aa400af464c76d713c07ad', 'jovana@gmail.com', 'user.png', NULL, 2),
(31, 'Kristina', 'Ilić', 'kristina.ilic', '25d55ad283aa400af464c76d713c07ad', 'kristina@gmail.com', 'user.png', NULL, 2),
(32, 'Miodrag', 'Božović', 'miodrag.bozovic', '25d55ad283aa400af464c76d713c07ad', 'miodrag@gmail.com', 'user.png', '032710710', 4),
(33, 'Mirjana', 'Glišović', 'mirjana.glisovic', '25d55ad283aa400af464c76d713c07ad', 'mirjana@gmail.com', 'user.png', '032710710', 4),
(34, 'Dragan', 'Despotović', 'dragan.despotovic', '25d55ad283aa400af464c76d713c07ad', 'despot@gmail.com', 'user.png', '032710710', 4),
(35, 'Filip', 'Dmitrović', 'filip.dmitrovic', '25d55ad283aa400af464c76d713c07ad', 'dmitrovicf@gmail.com', 'user.png', '032710710', 4),
(36, 'Tomislav', 'Ćolović', 'tomislav.colovic', '25d55ad283aa400af464c76d713c07ad', 'tomislav@gmail.com', 'user.png', '032710710', 4),
(37, 'Danka', 'Đurđević', 'danka.djurdjevic', '25d55ad283aa400af464c76d713c07ad', 'danka@gmail.com', 'user.png', '032710710', 4),
(38, 'Luka', 'Živanović', 'luka.zivanovic', '25d55ad283aa400af464c76d713c07ad', 'luka@gmail.com', 'user.png', '032710710', 4),
(39, 'Milan', 'Jelić', 'milan.jelic', '25d55ad283aa400af464c76d713c07ad', 'milanj@gmail.com', 'user.png', '032710710', 4),
(40, 'Uroš', 'Jovanović', 'uros.jovanovic', '25d55ad283aa400af464c76d713c07ad', 'urosj@gmail.com', 'user.png', '032710710', 4),
(41, 'Igor', 'Kandić', 'igor.kandic', '25d55ad283aa400af464c76d713c07ad', 'igork@gmail.com', 'user.png', '032710710', 4),
(42, 'Milica', 'Krstović', 'milica.krstovic', '25d55ad283aa400af464c76d713c07ad', 'milicak@gmail.com', 'user.png', '032710710', 4),
(43, 'Miloš', 'Marić', 'milos.maric', '25d55ad283aa400af464c76d713c07ad', 'milosm@gmail.com', 'user.png', '032710710', 4),
(44, 'Srđan', 'Milosavljević', 'srdjan.milosavljevic', '25d55ad283aa400af464c76d713c07ad', 'srdjanm@gmail.com', 'user.png', '032710710', 4),
(45, 'Zoran', 'Mićović', 'zoran.micovic', '25d55ad283aa400af464c76d713c07ad', 'zoranm@gmail.com', 'user.png', '032710710', 4),
(46, 'Kristina', 'Mladenović', 'kristina.mladenovic', '25d55ad283aa400af464c76d713c07ad', 'kristinam@gmail.com', 'user.png', '032710710', 4),
(47, 'Slavica', 'Ovčarević', 'slavica.ovcarevic', '25d55ad283aa400af464c76d713c07ad', 'slavicao@gmail.com', 'user.png', '032710710', 4),
(48, 'Branko', 'Pavlović', 'branko.pavlovic', '25d55ad283aa400af464c76d713c07ad', 'brankop@gmail.com', 'user.png', '032710710', 4),
(49, 'Ivan', 'Petrović', 'ivan.petrovic', '25d55ad283aa400af464c76d713c07ad', 'ivanp@gmail.com', 'user.png', '032710710', 4),
(50, 'Boris', 'Popadić', 'boris.popadic', '25d55ad283aa400af464c76d713c07ad', 'borisp@gmail.com', 'user.png', '032710710', 4),
(51, 'Marija', 'Radević', 'marija.radevic', '25d55ad283aa400af464c76d713c07ad', 'marijar@gmail.com', 'user.png', '032710710', 4),
(52, 'Nataša', 'Savčić', 'natasa.savcic', '25d55ad283aa400af464c76d713c07ad', 'natasas@gmail.com', 'user.png', '032715454', 4),
(53, 'Svetlana', 'Solujić', 'svetlana.solujic', '25d55ad283aa400af464c76d713c07ad', 'svetlanas@gmail.com', 'user.png', '032715454', 4),
(54, 'Miodrag', 'Stojić', 'miodrag.stojic', '25d55ad283aa400af464c76d713c07ad', 'miodrags@gmail.com', 'user.png', '032715454', 4),
(55, 'Mirjana', 'Tanasijević', 'mirjana.tanasijevic', '25d55ad283aa400af464c76d713c07ad', 'mirjanat@gmail.com', 'user.png', '032715454', 4),
(56, 'Dragan', 'Todorović', 'dragan.todorovic', '25d55ad283aa400af464c76d713c07ad', 'dragant@gmail.com', 'user.png', '032715454', 4),
(57, 'Filip', 'Borovnjak', 'filip.borovnjak', '25d55ad283aa400af464c76d713c07ad', 'filipb@gmail.com', 'user.png', '032715454', 4),
(58, 'Tomislav', 'Dmitrić', 'tomislav.dmitric', '25d55ad283aa400af464c76d713c07ad', 'tomo@gmail.com', 'user.png', '032715454', 4),
(59, 'Danka', 'Erić', 'danka.eric', '25d55ad283aa400af464c76d713c07ad', 'dankae@gmail.com', 'user.png', '032715454', 4),
(60, 'Luka', 'Ilić', 'luka.ilic', '25d55ad283aa400af464c76d713c07ad', 'lukai@gmail.com', 'user.png', '032715454', 4),
(61, 'Milan', 'Jocović', 'milan.jocovic', '25d55ad283aa400af464c76d713c07ad', 'milanj@gmail.com', 'user.png', '032715454', 4),
(62, 'Uroš', 'Majstorović', 'uros.majstorovic', '25d55ad283aa400af464c76d713c07ad', 'urosm@gmail.com', 'user.png', '032715454', 4),
(63, 'Igor', 'Marković', 'igor.markovic', '25d55ad283aa400af464c76d713c07ad', 'igorm@gmail.com', 'user.png', '032715454', 4),
(64, 'Milica', 'Matić', 'milica.matic', '25d55ad283aa400af464c76d713c07ad', 'milicam@gmail.com', 'user.png', '032715454', 4),
(65, 'Miloš', 'Milojević', 'milos.milojevic', '25d55ad283aa400af464c76d713c07ad', 'milosm@gmail.com', 'user.png', '032715454', 4),
(66, 'Srđan', 'Milošević', 'srdjan.milosevic', '25d55ad283aa400af464c76d713c07ad', 'srdjanm@gmail.com', 'user.png', '032715454', 4),
(67, 'Zoran', 'Minić', 'zoran.minic', '25d55ad283aa400af464c76d713c07ad', 'zoranm@gmail.com', 'user.png', '032715454', 4),
(68, 'Krisitna', 'Momčilović', 'kristina.momcilovic', '25d55ad283aa400af464c76d713c07ad', 'kristinam@gmail.com', 'user.png', '032715454', 4),
(69, 'Slavica', 'Nedeljković', 'slavica.nedeljkovic', '25d55ad283aa400af464c76d713c07ad', 'slavican@gmail.com', 'user.png', '032715454', 4),
(70, 'Branko', 'Nikolić', 'branko.nikolic', '25d55ad283aa400af464c76d713c07ad', 'brankon@gmail.com', 'user.png', '032715454', 4),
(71, 'Ivan', 'Petković', 'ivan.petkovic', '25d55ad283aa400af464c76d713c07ad', 'ivanp@gmail.com', 'user.png', '032715454', 4),
(72, 'Ivana', 'Nedeljković', 'ivana.nedeljkovic', '25d55ad283aa400af464c76d713c07ad', 'ivana.nedeljkovic@gmail.com', 'direktor.jpg', NULL, 5),
(77, 'Slavica', 'Božović', 'sanja.bozovic', '25d55ad283aa400af464c76d713c07ad', 'sbozovic@gmail.com', 'user.png', '061258993', 4);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik_predmet`
--

CREATE TABLE `korisnik_predmet` (
  `id_korisnik_predmet` int(10) NOT NULL,
  `id_korisnik` int(10) NOT NULL,
  `id_predmet` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik_predmet`
--

INSERT INTO `korisnik_predmet` (`id_korisnik_predmet`, `id_korisnik`, `id_predmet`) VALUES
(1, 2, 8),
(2, 3, 1),
(3, 4, 2),
(4, 5, 9),
(5, 6, 10),
(6, 7, 6),
(7, 8, 7),
(8, 9, 13),
(9, 10, 12),
(10, 11, 4),
(11, 12, 3),
(12, 13, 17),
(13, 14, 18),
(14, 15, 14),
(15, 16, 20),
(16, 17, 11),
(17, 18, 5),
(18, 19, 19),
(19, 20, 14),
(20, 21, 15),
(21, 22, 16),
(22, 23, 1),
(23, 24, 2),
(24, 25, 8),
(25, 26, 6),
(26, 27, 9),
(27, 28, 16),
(28, 29, 5),
(29, 30, 7),
(30, 31, 10);

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `id_meni` int(10) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ruta` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`id_meni`, `naziv`, `ruta`) VALUES
(1, 'Početna', 'home');

-- --------------------------------------------------------

--
-- Table structure for table `ocene`
--

CREATE TABLE `ocene` (
  `id_ocene` int(10) NOT NULL,
  `ocena` int(10) NOT NULL,
  `datum` datetime NOT NULL DEFAULT current_timestamp(),
  `id_ucenik` int(10) NOT NULL,
  `id_predmet` int(10) NOT NULL,
  `id_polugodiste` int(10) NOT NULL,
  `id_vrsta_ocene` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocene`
--

INSERT INTO `ocene` (`id_ocene`, `ocena`, `datum`, `id_ucenik`, `id_predmet`, `id_polugodiste`, `id_vrsta_ocene`) VALUES
(1, 4, '2021-08-29 00:00:00', 1, 8, 1, 1),
(2, 5, '2021-08-29 00:00:00', 1, 8, 1, 2),
(3, 2, '2021-08-29 00:00:00', 2, 8, 1, 1),
(4, 3, '2021-08-29 00:00:00', 2, 8, 1, 3),
(5, 3, '2021-08-29 00:00:00', 3, 8, 1, 1),
(6, 4, '2021-08-29 00:00:00', 4, 8, 1, 2),
(7, 4, '2021-08-29 00:00:00', 5, 8, 1, 1),
(8, 2, '2021-08-29 00:00:00', 5, 8, 1, 2),
(9, 5, '2021-08-29 00:00:00', 61, 12, 1, 3),
(10, 4, '2021-08-29 00:00:00', 61, 8, 1, 2),
(11, 3, '2021-08-29 00:00:00', 62, 8, 1, 1),
(12, 4, '2021-08-29 00:00:00', 62, 8, 1, 2),
(13, 2, '2021-08-29 00:00:00', 63, 8, 1, 1),
(14, 3, '2021-08-29 00:00:00', 63, 8, 1, 2),
(15, 1, '2021-08-29 00:00:00', 64, 6, 1, 1),
(16, 2, '2021-08-29 00:00:00', 64, 8, 1, 2),
(17, 3, '2021-08-29 00:00:00', 65, 8, 1, 1),
(18, 4, '2021-08-29 00:00:00', 65, 8, 1, 3),
(20, 4, '2021-09-09 00:00:00', 1, 8, 1, 1),
(21, 3, '2021-09-10 00:00:00', 1, 1, 1, 1),
(22, 4, '2021-09-10 00:00:00', 1, 1, 1, 2),
(23, 4, '2021-09-10 00:00:00', 86, 1, 1, 1),
(24, 5, '2021-09-10 00:00:00', 86, 1, 1, 3),
(25, 2, '2021-09-10 00:00:00', 26, 8, 1, 1),
(26, 1, '2021-09-10 00:00:00', 26, 8, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `odeljenje`
--

CREATE TABLE `odeljenje` (
  `id_odeljenje` int(10) NOT NULL,
  `broj_odeljenja` int(10) NOT NULL,
  `godina` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `id_korisnik` int(10) NOT NULL,
  `id_smer` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `odeljenje`
--

INSERT INTO `odeljenje` (`id_odeljenje`, `broj_odeljenja`, `godina`, `id_korisnik`, `id_smer`) VALUES
(1, 1, '1', 2, 1),
(2, 1, '2', 3, 1),
(3, 1, '3', 5, 1),
(4, 1, '4', 8, 1),
(5, 2, '1', 23, 2),
(6, 2, '2', 18, 2),
(7, 2, '3', 14, 2),
(8, 2, '4', 16, 2),
(9, 3, '1', 11, 3),
(10, 3, '2', 24, 3),
(11, 3, '3', 25, 3),
(12, 3, '4', 26, 3);

-- --------------------------------------------------------

--
-- Table structure for table `odeljenje_predmet`
--

CREATE TABLE `odeljenje_predmet` (
  `id_odeljenje_predmet` int(10) NOT NULL,
  `id_odeljenje` int(10) NOT NULL,
  `id_predmet` int(10) NOT NULL,
  `id_korisnik` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `odeljenje_predmet`
--

INSERT INTO `odeljenje_predmet` (`id_odeljenje_predmet`, `id_odeljenje`, `id_predmet`, `id_korisnik`) VALUES
(1, 1, 1, 3),
(2, 1, 2, 4),
(3, 1, 3, 12),
(4, 1, 5, 18),
(5, 1, 6, 7),
(6, 1, 7, 8),
(7, 1, 8, 2),
(8, 1, 9, 27),
(9, 1, 10, 6),
(10, 1, 11, 17),
(11, 1, 12, 10),
(12, 1, 13, 9),
(13, 1, 14, 15),
(14, 1, 15, 21),
(15, 1, 17, 13),
(16, 2, 1, 3),
(17, 2, 2, 24),
(18, 2, 3, 12),
(19, 2, 5, 29),
(20, 2, 6, 26),
(21, 2, 7, 30),
(22, 2, 8, 25),
(23, 2, 9, 27),
(24, 2, 10, 31),
(25, 2, 11, 17),
(26, 2, 12, 10),
(27, 2, 13, 9),
(28, 2, 14, 15),
(29, 2, 15, 21),
(30, 2, 17, 13),
(31, 3, 1, 23),
(32, 3, 2, 4),
(33, 3, 4, 11),
(34, 3, 5, 18),
(35, 3, 6, 7),
(36, 3, 7, 8),
(37, 3, 8, 2),
(38, 3, 9, 5),
(39, 3, 10, 6),
(40, 3, 14, 20),
(41, 3, 15, 21),
(42, 3, 18, 14),
(43, 3, 17, 13),
(44, 3, 19, 19),
(45, 3, 20, 16),
(46, 4, 1, 23),
(47, 4, 2, 24),
(48, 4, 4, 11),
(49, 4, 5, 18),
(50, 4, 6, 7),
(51, 4, 7, 8),
(52, 4, 8, 2),
(53, 4, 9, 5),
(54, 4, 10, 6),
(55, 4, 14, 20),
(56, 4, 15, 21),
(57, 4, 17, 13),
(58, 4, 18, 14),
(59, 4, 19, 19),
(60, 4, 20, 16),
(61, 5, 1, 23),
(62, 5, 2, 24),
(63, 5, 3, 12),
(64, 5, 5, 29),
(65, 5, 6, 26),
(66, 5, 7, 30),
(67, 5, 8, 25),
(68, 5, 9, 27),
(69, 5, 10, 31),
(70, 5, 11, 17),
(71, 5, 12, 10),
(72, 5, 13, 9),
(73, 5, 14, 20),
(74, 5, 15, 21),
(75, 5, 17, 13),
(76, 6, 1, 3),
(77, 6, 2, 4),
(78, 6, 3, 12),
(79, 6, 4, 11),
(80, 6, 5, 18),
(81, 6, 6, 7),
(82, 6, 7, 8),
(83, 6, 8, 2),
(84, 6, 9, 5),
(85, 6, 10, 6),
(86, 6, 11, 17),
(87, 6, 12, 10),
(88, 6, 13, 9),
(89, 6, 15, 21),
(90, 6, 14, 15),
(91, 7, 1, 23),
(92, 7, 2, 24),
(93, 7, 4, 11),
(94, 7, 5, 29),
(95, 7, 6, 26),
(96, 7, 7, 30),
(97, 7, 8, 25),
(98, 7, 9, 27),
(99, 7, 10, 31),
(100, 7, 14, 20),
(101, 7, 15, 21),
(102, 7, 17, 13),
(103, 7, 18, 14),
(104, 7, 19, 19),
(105, 7, 20, 16),
(106, 8, 1, 3),
(107, 8, 2, 4),
(108, 8, 4, 11),
(109, 8, 5, 18),
(110, 8, 6, 7),
(111, 8, 7, 8),
(112, 8, 8, 2),
(113, 8, 9, 5),
(114, 8, 10, 6),
(115, 8, 14, 15),
(116, 8, 15, 21),
(117, 8, 17, 13),
(118, 8, 19, 19),
(120, 8, 20, 16),
(121, 9, 1, 23),
(122, 9, 2, 24),
(123, 9, 3, 12),
(124, 9, 4, 11),
(125, 9, 5, 29),
(126, 9, 6, 26),
(127, 9, 7, 30),
(128, 9, 8, 25),
(129, 9, 9, 27),
(130, 9, 10, 31),
(131, 9, 11, 17),
(132, 9, 12, 10),
(133, 9, 13, 9),
(134, 9, 14, 20),
(135, 9, 16, 28),
(136, 10, 1, 3),
(137, 10, 2, 24),
(138, 10, 3, 12),
(139, 10, 5, 18),
(140, 10, 6, 7),
(141, 10, 7, 8),
(142, 10, 8, 2),
(143, 10, 9, 5),
(144, 10, 10, 6),
(145, 10, 11, 17),
(146, 10, 12, 10),
(147, 10, 13, 9),
(148, 10, 14, 15),
(149, 10, 15, 21),
(150, 10, 16, 28),
(151, 11, 1, 3),
(152, 11, 2, 24),
(153, 11, 4, 11),
(154, 11, 5, 18),
(155, 11, 6, 26),
(156, 11, 7, 8),
(157, 11, 8, 25),
(158, 11, 9, 5),
(159, 11, 10, 31),
(160, 11, 14, 15),
(161, 11, 15, 21),
(162, 11, 16, 23),
(163, 11, 18, 14),
(164, 11, 19, 19),
(165, 11, 20, 20),
(166, 12, 1, 23),
(167, 12, 2, 24),
(168, 12, 4, 11),
(169, 12, 5, 29),
(170, 12, 6, 26),
(171, 12, 7, 30),
(172, 12, 8, 25),
(173, 12, 9, 27),
(174, 12, 10, 31),
(175, 12, 14, 20),
(176, 12, 15, 21),
(177, 12, 16, 22),
(178, 12, 18, 14),
(179, 12, 19, 19),
(180, 12, 20, 16);

-- --------------------------------------------------------

--
-- Table structure for table `odsutni`
--

CREATE TABLE `odsutni` (
  `id_odsutni` int(10) NOT NULL,
  `id_ucenik` int(10) NOT NULL,
  `id_cas` int(10) NOT NULL,
  `opravdano` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `odsutni`
--

INSERT INTO `odsutni` (`id_odsutni`, `id_ucenik`, `id_cas`, `opravdano`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 0),
(3, 1, 3, 0),
(4, 2, 1, 1),
(5, 2, 2, 0),
(6, 1, 12, 1),
(7, 2, 12, NULL),
(8, 86, 2, 1),
(9, 86, 1, 1),
(10, 26, 1, 1),
(11, 26, 2, 1),
(12, 26, 3, 1),
(13, 26, 4, 1),
(14, 26, 5, 1),
(15, 26, 12, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `polugodiste`
--

CREATE TABLE `polugodiste` (
  `id_polugodiste` int(10) NOT NULL,
  `polugodiste` int(10) NOT NULL,
  `datum_od` date NOT NULL,
  `datum_do` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `polugodiste`
--

INSERT INTO `polugodiste` (`id_polugodiste`, `polugodiste`, `datum_od`, `datum_do`) VALUES
(1, 1, '2021-09-01', '2022-01-15'),
(2, 2, '2022-01-24', '2022-06-17');

-- --------------------------------------------------------

--
-- Table structure for table `predmet`
--

CREATE TABLE `predmet` (
  `id_predmet` int(10) NOT NULL,
  `naziv` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `predmet`
--

INSERT INTO `predmet` (`id_predmet`, `naziv`) VALUES
(1, 'Srpski jezik i književnost'),
(2, 'Engleski jezik'),
(3, 'Latinski jezik'),
(4, 'Psihologija'),
(5, 'Istorija'),
(6, 'Geografija'),
(7, 'Biologija'),
(8, 'Matematika'),
(9, 'Fizika'),
(10, 'Hemija'),
(11, 'Računarstvo i informatika'),
(12, 'Muzička kultura'),
(13, 'Likovna kultura'),
(14, 'Fizičko vaspitanje'),
(15, 'Verska nastava'),
(16, 'Francuski jezik'),
(17, 'Nemački jezik'),
(18, 'Filozofija'),
(19, 'Ustav i prava građana'),
(20, 'Sociologija');

-- --------------------------------------------------------

--
-- Table structure for table `prosek`
--

CREATE TABLE `prosek` (
  `id_prosek` int(10) NOT NULL,
  `id_ucenik` int(10) NOT NULL,
  `prosek` double(10,2) NOT NULL,
  `polugodiste` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roditelj_ucenik`
--

CREATE TABLE `roditelj_ucenik` (
  `id_roditelj_ucenik` int(10) NOT NULL,
  `id_korisnik` int(10) NOT NULL,
  `id_ucenik` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roditelj_ucenik`
--

INSERT INTO `roditelj_ucenik` (`id_roditelj_ucenik`, `id_korisnik`, `id_ucenik`) VALUES
(1, 32, 1),
(2, 33, 2),
(3, 33, 30),
(4, 34, 3),
(5, 35, 4),
(6, 36, 5),
(7, 37, 6),
(8, 38, 7),
(9, 39, 8),
(10, 40, 9),
(11, 41, 10),
(12, 42, 11),
(13, 43, 12),
(14, 44, 13),
(15, 45, 14),
(16, 46, 15),
(17, 47, 16),
(18, 47, 17),
(19, 48, 18),
(20, 49, 19),
(21, 49, 20),
(22, 50, 21),
(23, 51, 22),
(24, 51, 23),
(25, 52, 24),
(26, 53, 25),
(27, 54, 26),
(28, 55, 27),
(29, 56, 28),
(30, 57, 29),
(31, 58, 31),
(32, 59, 32),
(33, 60, 33),
(34, 60, 34),
(35, 61, 25),
(36, 62, 36),
(37, 63, 37),
(38, 64, 38),
(39, 65, 39),
(40, 66, 40),
(41, 67, 41),
(42, 68, 42),
(43, 69, 43),
(44, 70, 44),
(45, 70, 45),
(46, 71, 46),
(49, 77, 1),
(50, 32, 86),
(51, 77, 86);

-- --------------------------------------------------------

--
-- Table structure for table `smer`
--

CREATE TABLE `smer` (
  `id_smer` int(10) NOT NULL,
  `naziv` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `smer`
--

INSERT INTO `smer` (`id_smer`, `naziv`) VALUES
(1, 'Opšti tip '),
(2, 'Društveno jezički smer'),
(3, 'Opšti tip - Engleski jezik');

-- --------------------------------------------------------

--
-- Table structure for table `smer_predmet`
--

CREATE TABLE `smer_predmet` (
  `id_smer_predmet` int(10) NOT NULL,
  `id_smer` int(10) NOT NULL,
  `id_predmet` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `smer_predmet`
--

INSERT INTO `smer_predmet` (`id_smer_predmet`, `id_smer`, `id_predmet`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
(21, 2, 1),
(22, 2, 2),
(23, 2, 3),
(24, 2, 4),
(25, 2, 5),
(26, 2, 6),
(27, 2, 7),
(28, 2, 8),
(29, 2, 9),
(30, 2, 10),
(31, 2, 11),
(32, 2, 12),
(33, 2, 13),
(34, 2, 14),
(35, 2, 15),
(36, 2, 16),
(37, 2, 17),
(38, 2, 18),
(39, 2, 19),
(40, 2, 20),
(41, 3, 1),
(42, 3, 2),
(43, 3, 3),
(44, 3, 4),
(45, 3, 5),
(46, 3, 6),
(47, 3, 7),
(48, 3, 8),
(49, 3, 9),
(50, 3, 10),
(51, 3, 11),
(52, 3, 12),
(53, 3, 13),
(54, 3, 14),
(55, 3, 15),
(56, 3, 16),
(57, 3, 17),
(58, 3, 18),
(59, 3, 19),
(60, 3, 20);

-- --------------------------------------------------------

--
-- Table structure for table `ucenik`
--

CREATE TABLE `ucenik` (
  `id_ucenik` int(10) NOT NULL,
  `ime` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slika` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `vladanje` int(10) NOT NULL,
  `jmbg` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `adresa` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `mesto_rodjenja` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `datum_rodjena` date NOT NULL,
  `id_odeljenje` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ucenik`
--

INSERT INTO `ucenik` (`id_ucenik`, `ime`, `prezime`, `slika`, `vladanje`, `jmbg`, `adresa`, `mesto_rodjenja`, `datum_rodjena`, `id_odeljenje`) VALUES
(1, 'Miloš', 'Božović', 'musko1.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 1),
(2, 'Vasilije', 'Glišović', 'musko2.jpg', 5, '1505999788457', 'Kneza Aleksandra 15', 'Gornji Milanovac', '1999-03-13', 1),
(3, 'Đorđe', 'Despotović', 'musko3.jpg', 5, '1606999788418', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-06-19', 1),
(4, 'Sergej', 'Dmitrović', 'musko4.jpg', 5, '0202999788845', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-02-02', 1),
(5, 'Sreten', 'Ćolović', 'musko5.jpg', 5, '0305999788456', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-02-15', 1),
(6, 'Đorđe', 'Đurđević', 'musko1.jpg', 5, '1502999788451', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-02-15', 2),
(7, 'Darko', 'Živanović', 'musko2.jpg', 5, '1412999788415', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-12-14', 2),
(8, 'Đorđe', 'Jelić', 'musko3.jpg', 5, '1708999788478', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-08-17', 2),
(9, 'Mihailo', 'Jovanović', 'musko4.jpg', 5, '1905999788478', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-05-19', 2),
(10, 'Lazar', 'Kandić', 'musko5.jpg', 5, '2505999788478', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-05-25', 2),
(11, 'Aleksa', 'Krstović', 'musko1.jpg', 5, '1606999788454', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-06-16', 3),
(12, 'Mateja', 'Marić', 'musko2.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 3),
(13, 'Luka', 'Milosavljević', 'musko3.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 3),
(14, 'Vuk', 'Mićović', 'musko4.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 3),
(15, 'Marko', 'Mladenović', 'musko5.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 3),
(16, 'Mateja', 'Ovčarević', 'musko1.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 4),
(17, 'Filip', 'Ovčarević', 'musko2.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 4),
(18, 'Luka', 'Pavlović', 'musko3.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 4),
(19, 'Veljko', 'Petrović', 'musko4.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 4),
(20, 'Darko', 'Petrović', 'musko5.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 4),
(21, 'Petar', 'Popadić', 'musko1.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 5),
(22, 'Bojan', 'Radević', 'musko2.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 5),
(23, 'Nikola', 'Radević', 'musko3.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 5),
(24, 'Mihailo', 'Savčić', 'musko4.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 5),
(25, 'Mladen', 'Solujić', 'musko5.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 5),
(26, 'Savo', 'Stojić', 'musko3.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 6),
(27, 'Igor', 'Tanasijević', 'musko4.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 6),
(28, 'Veljko', 'Todorović', 'musko1.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 6),
(29, 'Đorđe', 'Borovnjak', 'musko5.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 6),
(30, 'Jovan', 'Glišović', 'musko2.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 6),
(31, 'Marko', 'Dmitrić', 'musko1.jpg', 5, '1303999788414', 'Kneza Aleksandra 12', 'Gornji Milanovac', '1999-03-13', 7),
(32, 'Nikola', 'Erić', 'musko2.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 7),
(33, 'Đorđe', 'Ilić', 'musko3.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 7),
(34, 'Strahinja', 'Ilić', 'musko4.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 7),
(35, 'Ognjen', 'Jocović', 'musko5.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 7),
(36, 'Darko', 'Majstorović', 'musko1.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 8),
(37, 'Luka', 'Marković', 'musko2.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 8),
(38, 'Nikola', 'Matić', 'musko3.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 8),
(39, 'Đorđe', 'Milojević', 'musko4.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 8),
(40, 'Strahinja', 'Milošević', 'musko5.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 8),
(41, 'Stefan', 'Minić', 'musko1.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 9),
(42, 'Milan', 'Momčilović', 'musko2.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 9),
(43, 'Vukašin', 'Nedeljković', 'musko3.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 9),
(44, 'Aleksa', 'Nikolić', 'musko4.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 9),
(45, 'Vladimir', 'Nikolić', 'musko5.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 9),
(46, 'Đorđe', 'Petković', 'musko1.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 10),
(47, 'Stefan', 'Petrović', 'musko2.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 10),
(48, 'Predrag', 'Stošić', 'musko3.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 10),
(49, 'Miloš', 'Marković', 'musko4.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 10),
(50, 'Nikola', 'Plavšić', 'musko5.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 10),
(51, 'Luka', 'Dimitrijević', 'musko1.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 11),
(52, 'Mihailo', 'Drobnjak', 'musko2.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 11),
(53, 'Uroš', 'Jeremić', 'musko3.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 11),
(54, 'Branko', 'Lazarević', 'musko4.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 11),
(55, 'Nikola', 'Milanović', 'musko5.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 11),
(56, 'Boris', 'Pantić', 'musko1.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 12),
(57, 'Strahinja', 'Petrović', 'musko2.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 12),
(58, 'Đorđe', 'Savić', 'musko3.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 12),
(59, 'Filip', 'Sretenović', 'musko4.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 12),
(60, 'Nikola', 'Stevanović', 'musko5.jpg', 5, '1404999788474', 'Kneza Aleksandra 14', 'Gornji Milanovac', '1999-04-14', 12),
(61, 'Sofija', 'Tošić', 'zensko1.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 1),
(62, 'Nađa', 'Todorović', 'zensko2.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 1),
(63, 'Matea', 'Šoškić', 'zensko3.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 1),
(64, 'Violeta', 'Radojević', 'zensko4.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 1),
(65, 'Jelena', 'Perišić', 'zensko5.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 1),
(66, 'Jelena', 'Radić', 'zensko1.jpg', 5, '1608999788412', 'Takovska 15', 'Gornji Milanovac', '1999-08-16', 2),
(67, 'Lora', 'Dostanić', 'zensko2.jpg', 5, '1608999788412', 'Takovska 15', 'Gornji Milanovac', '1999-08-16', 2),
(68, 'Ema', 'Maksimović', 'zensko3.jpg', 5, '1608999788412', 'Takovska 15', 'Gornji Milanovac', '1999-08-16', 2),
(69, 'Marta', 'Milojević', 'zensko4.jpg', 5, '1608999788412', 'Takovska 15', 'Gornji Milanovac', '1999-08-16', 2),
(70, 'Nevena', 'Nedić', 'zensko5.jpg', 5, '1608999788412', 'Takovska 15', 'Gornji Milanovac', '1999-08-16', 2),
(71, 'Kristina', 'Petković', 'zensko1.jpg', 5, '1505999788475', 'Takovska 23', 'Gornji Milanovac', '1999-05-15', 3),
(72, 'Anđela', 'Ponjavić', 'zensko2.jpg', 5, '1505999788475', 'Takovska 23', 'Gornji Milanovac', '1999-05-15', 3),
(73, 'Ana', 'Stevanović', 'zensko3.jpg', 5, '1505999788475', 'Takovska 23', 'Gornji Milanovac', '1999-05-15', 3),
(74, 'Kristina', 'Urošević', 'zensko4.jpg', 5, '1505999788475', 'Takovska 23', 'Gornji Milanovac', '1999-05-15', 3),
(75, 'Nevena', 'Marjanović', 'zensko5.jpg', 5, '1505999788475', 'Takovska 23', 'Gornji Milanovac', '1999-05-15', 3),
(76, 'Jelena', 'Marković', 'zensko1.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 4),
(77, 'Dragana', 'Miličić', 'zensko2.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 4),
(78, 'Ivana', 'Nedeljković', 'zensko3.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 4),
(79, 'Katarina', 'Radić', 'zensko4.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 4),
(80, 'Dragana', 'Petaković', 'zensko5.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 4),
(81, 'Sanja', 'Božović', 'zensko1.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 5),
(82, 'Tamara', 'Božović', 'zensko2.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 5),
(83, 'Tijana', 'Aleksandrić', 'zensko3.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 5),
(84, 'Ana', 'Jeremić', 'zensko4.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 5),
(85, 'Mina', 'Vuković', 'zensko5.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 5),
(86, 'Anđela', 'Božović', 'zensko1.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 6),
(87, 'Anja', 'Minić', 'zensko4.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 6),
(88, 'Manja', 'Ilić', 'zensko5.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 6),
(89, 'Sofija', 'Nedeljković', 'zensko2.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 6),
(90, 'Marija', 'Erić', 'zensko3.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 6),
(91, 'Marija', 'Pantić', 'zensko1.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 7),
(92, 'Marina', 'Obradović', 'zensko2.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 7),
(93, 'Andrea', 'Tulović', 'zensko3.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 7),
(94, 'Kristina', 'Kuč', 'zensko4.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 7),
(95, 'Tijana', 'Krstić', 'zensko5.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 7),
(96, 'Emilija', 'Nikolić', 'zensko1.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 8),
(97, 'Katarina', 'Adžić', 'zensko2.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 8),
(98, 'Irena', 'Dmitrović', 'zensko3.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 8),
(99, 'Nevena', 'Vučković', 'zensko4.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 8),
(100, 'Olivera', 'Grujić', 'zensko5.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 8),
(101, 'Jelena', 'Vulić', 'zensko1.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 9),
(102, 'Ana', 'Kovačević', 'zensko2.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 9),
(103, 'Marija', 'Janković', 'zensko3.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 9),
(104, 'Ivana', 'Pašić', 'zensko4.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 9),
(105, 'Tereza', 'Panić', 'zensko5.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 9),
(106, 'Iva', 'Jelić', 'zensko1.jpg', 5, '1505999788475', 'Takovska 12', 'Gornji Milanovac', '1999-05-15', 10),
(107, 'Sandra', 'Bulatović', 'zensko2.jpg', 5, '1505999788475', 'Takovska 11', 'Gornji Milanovac', '1999-05-15', 10),
(108, 'Nikolina', 'Tadić', 'zensko3.jpg', 5, '1505999788475', 'Takovska 11', 'Gornji Milanovac', '1999-05-15', 10),
(109, 'Milena', 'Vujić', 'zensko4.jpg', 5, '1505999788475', 'Takovska 11', 'Gornji Milanovac', '1999-05-15', 10),
(110, 'Anja', 'Petrović', 'zensko5.jpg', 5, '1505999788475', 'Takovska 11', 'Gornji Milanovac', '1999-05-15', 10),
(111, 'Suzana', 'Vujošević', 'zensko1.jpg', 5, '1505999788475', 'Takovska 11', 'Gornji Milanovac', '1999-05-15', 11),
(112, 'Teodora', 'Mitrović', 'zensko2.jpg', 5, '1505999788475', 'Takovska 11', 'Gornji Milanovac', '1999-05-15', 11),
(113, 'Nevena', 'Stanojević', 'zensko3.jpg', 5, '1505999788475', 'Takovska 11', 'Gornji Milanovac', '1999-05-15', 11),
(114, 'Sara', 'Božović', 'zensko4.jpg', 5, '1505999788475', 'Takovska 11', 'Gornji Milanovac', '1999-05-15', 11),
(115, 'Ana', 'Zimonjić', 'zensko5.jpg', 5, '1505999788475', 'Takovska 11', 'Gornji Milanovac', '1999-05-15', 11),
(116, 'Danka', 'Kostić', 'zensko1.jpg', 5, '1505999788475', 'Takovska 11', 'Gornji Milanovac', '1999-05-15', 12),
(117, 'Maja', 'Jovanović', 'zensko2.jpg', 5, '1505999788475', 'Takovska 11', 'Gornji Milanovac', '1999-05-15', 12),
(118, 'Nataša', 'Gutović', 'zensko3.jpg', 5, '1505999788475', 'Takovska 11', 'Gornji Milanovac', '1999-05-15', 12),
(119, 'Iva', 'Stojanović', 'zensko4.jpg', 5, '1505999788475', 'Takovska 11', 'Gornji Milanovac', '1999-05-15', 12),
(120, 'Ružica', 'Spasić', 'zensko5.jpg', 5, '1505999788475', 'Takovska 11', 'Gornji Milanovac', '1999-05-15', 12);

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id_uloga` int(10) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`id_uloga`, `naziv`) VALUES
(1, 'admin'),
(2, 'staresina'),
(3, 'nastavnik'),
(4, 'roditelj'),
(5, 'direktor');

-- --------------------------------------------------------

--
-- Table structure for table `vrsta_ocene`
--

CREATE TABLE `vrsta_ocene` (
  `id_vrsta_ocene` int(10) NOT NULL,
  `vrsta` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vrsta_ocene`
--

INSERT INTO `vrsta_ocene` (`id_vrsta_ocene`, `vrsta`) VALUES
(1, 'Pismeni zadatak'),
(2, 'Kontrolni zadatak'),
(3, 'Usmeno odgovaranje');

-- --------------------------------------------------------

--
-- Table structure for table `zahtev`
--

CREATE TABLE `zahtev` (
  `id_zahtev` int(10) NOT NULL,
  `pogresna_ocena` int(10) NOT NULL,
  `nova_ocena` int(10) NOT NULL,
  `datum_ocene` date NOT NULL,
  `id_ucenik` int(10) NOT NULL,
  `id_korisnik` int(10) NOT NULL,
  `id_vrsta_ocene` int(10) NOT NULL,
  `odobreno` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zahtev`
--

INSERT INTO `zahtev` (`id_zahtev`, `pogresna_ocena`, `nova_ocena`, `datum_ocene`, `id_ucenik`, `id_korisnik`, `id_vrsta_ocene`, `odobreno`) VALUES
(1, 5, 4, '2021-08-29', 61, 10, 3, NULL),
(2, 2, 3, '2021-08-29', 2, 2, 1, NULL),
(3, 4, 5, '2021-09-10', 86, 3, 1, NULL),
(4, 1, 2, '2021-09-09', 64, 7, 1, NULL),
(87, 5, 4, '2021-09-10', 1, 2, 1, 1),
(88, 4, 5, '2021-09-10', 1, 2, 1, 1),
(89, 2, 1, '2021-09-10', 2, 12, 1, 1),
(90, 2, 3, '2021-09-10', 1, 2, 1, 0),
(91, 2, 3, '2021-09-10', 1, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `zakljucna_ocena`
--

CREATE TABLE `zakljucna_ocena` (
  `id_zakljucna_ocena` int(10) NOT NULL,
  `zakljucna_ocena` int(10) NOT NULL,
  `tip_ocene` int(10) NOT NULL,
  `id_ucenik` int(10) NOT NULL,
  `id_predmet` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zakljucna_ocena`
--

INSERT INTO `zakljucna_ocena` (`id_zakljucna_ocena`, `zakljucna_ocena`, `tip_ocene`, `id_ucenik`, `id_predmet`) VALUES
(5, 4, 1, 1, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cas`
--
ALTER TABLE `cas`
  ADD PRIMARY KEY (`id_cas`),
  ADD KEY `id_korisnik` (`id_korisnik`),
  ADD KEY `id_predmet` (`id_predmet`),
  ADD KEY `id_odeljenje` (`id_odeljenje`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id_korisnik`),
  ADD KEY `id_uloga` (`id_uloga`);

--
-- Indexes for table `korisnik_predmet`
--
ALTER TABLE `korisnik_predmet`
  ADD PRIMARY KEY (`id_korisnik_predmet`),
  ADD KEY `id_korisnik` (`id_korisnik`),
  ADD KEY `id_predmet` (`id_predmet`);

--
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`id_meni`);

--
-- Indexes for table `ocene`
--
ALTER TABLE `ocene`
  ADD PRIMARY KEY (`id_ocene`),
  ADD KEY `id_ucenik` (`id_ucenik`),
  ADD KEY `id_predmet` (`id_predmet`),
  ADD KEY `id_polugodiste` (`id_polugodiste`),
  ADD KEY `id_vrsta_ocene` (`id_vrsta_ocene`);

--
-- Indexes for table `odeljenje`
--
ALTER TABLE `odeljenje`
  ADD PRIMARY KEY (`id_odeljenje`),
  ADD KEY `id_korisnik` (`id_korisnik`),
  ADD KEY `id_smer` (`id_smer`);

--
-- Indexes for table `odeljenje_predmet`
--
ALTER TABLE `odeljenje_predmet`
  ADD PRIMARY KEY (`id_odeljenje_predmet`),
  ADD KEY `id_odeljenje` (`id_odeljenje`),
  ADD KEY `id_predmet` (`id_predmet`),
  ADD KEY `id_korisnik` (`id_korisnik`);

--
-- Indexes for table `odsutni`
--
ALTER TABLE `odsutni`
  ADD PRIMARY KEY (`id_odsutni`),
  ADD KEY `id_ucenik` (`id_ucenik`),
  ADD KEY `id_cas` (`id_cas`);

--
-- Indexes for table `polugodiste`
--
ALTER TABLE `polugodiste`
  ADD PRIMARY KEY (`id_polugodiste`);

--
-- Indexes for table `predmet`
--
ALTER TABLE `predmet`
  ADD PRIMARY KEY (`id_predmet`);

--
-- Indexes for table `prosek`
--
ALTER TABLE `prosek`
  ADD PRIMARY KEY (`id_prosek`),
  ADD KEY `id_ucenik` (`id_ucenik`);

--
-- Indexes for table `roditelj_ucenik`
--
ALTER TABLE `roditelj_ucenik`
  ADD PRIMARY KEY (`id_roditelj_ucenik`),
  ADD KEY `id_korisnik` (`id_korisnik`),
  ADD KEY `id_ucenik` (`id_ucenik`);

--
-- Indexes for table `smer`
--
ALTER TABLE `smer`
  ADD PRIMARY KEY (`id_smer`);

--
-- Indexes for table `smer_predmet`
--
ALTER TABLE `smer_predmet`
  ADD PRIMARY KEY (`id_smer_predmet`),
  ADD KEY `id_smer` (`id_smer`),
  ADD KEY `id_predmet` (`id_predmet`);

--
-- Indexes for table `ucenik`
--
ALTER TABLE `ucenik`
  ADD PRIMARY KEY (`id_ucenik`),
  ADD KEY `id_odeljenje` (`id_odeljenje`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id_uloga`);

--
-- Indexes for table `vrsta_ocene`
--
ALTER TABLE `vrsta_ocene`
  ADD PRIMARY KEY (`id_vrsta_ocene`);

--
-- Indexes for table `zahtev`
--
ALTER TABLE `zahtev`
  ADD PRIMARY KEY (`id_zahtev`),
  ADD KEY `id_ucenik` (`id_ucenik`),
  ADD KEY `id_korisnik` (`id_korisnik`),
  ADD KEY `id_vrsta_ocene` (`id_vrsta_ocene`);

--
-- Indexes for table `zakljucna_ocena`
--
ALTER TABLE `zakljucna_ocena`
  ADD PRIMARY KEY (`id_zakljucna_ocena`),
  ADD KEY `id_ucenik` (`id_ucenik`),
  ADD KEY `id_predmet` (`id_predmet`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cas`
--
ALTER TABLE `cas`
  MODIFY `id_cas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id_korisnik` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `korisnik_predmet`
--
ALTER TABLE `korisnik_predmet`
  MODIFY `id_korisnik_predmet` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `id_meni` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ocene`
--
ALTER TABLE `ocene`
  MODIFY `id_ocene` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `odeljenje`
--
ALTER TABLE `odeljenje`
  MODIFY `id_odeljenje` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `odeljenje_predmet`
--
ALTER TABLE `odeljenje_predmet`
  MODIFY `id_odeljenje_predmet` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `odsutni`
--
ALTER TABLE `odsutni`
  MODIFY `id_odsutni` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `polugodiste`
--
ALTER TABLE `polugodiste`
  MODIFY `id_polugodiste` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `predmet`
--
ALTER TABLE `predmet`
  MODIFY `id_predmet` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `prosek`
--
ALTER TABLE `prosek`
  MODIFY `id_prosek` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roditelj_ucenik`
--
ALTER TABLE `roditelj_ucenik`
  MODIFY `id_roditelj_ucenik` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `smer`
--
ALTER TABLE `smer`
  MODIFY `id_smer` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `smer_predmet`
--
ALTER TABLE `smer_predmet`
  MODIFY `id_smer_predmet` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `ucenik`
--
ALTER TABLE `ucenik`
  MODIFY `id_ucenik` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id_uloga` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vrsta_ocene`
--
ALTER TABLE `vrsta_ocene`
  MODIFY `id_vrsta_ocene` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `zahtev`
--
ALTER TABLE `zahtev`
  MODIFY `id_zahtev` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `zakljucna_ocena`
--
ALTER TABLE `zakljucna_ocena`
  MODIFY `id_zakljucna_ocena` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cas`
--
ALTER TABLE `cas`
  ADD CONSTRAINT `cas_ibfk_1` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnici` (`id_korisnik`) ON DELETE CASCADE,
  ADD CONSTRAINT `cas_ibfk_2` FOREIGN KEY (`id_predmet`) REFERENCES `predmet` (`id_predmet`) ON DELETE CASCADE,
  ADD CONSTRAINT `cas_ibfk_3` FOREIGN KEY (`id_odeljenje`) REFERENCES `odeljenje` (`id_odeljenje`) ON DELETE CASCADE;

--
-- Constraints for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD CONSTRAINT `korisnici_ibfk_1` FOREIGN KEY (`id_uloga`) REFERENCES `uloga` (`id_uloga`) ON DELETE CASCADE;

--
-- Constraints for table `korisnik_predmet`
--
ALTER TABLE `korisnik_predmet`
  ADD CONSTRAINT `korisnik_predmet_ibfk_1` FOREIGN KEY (`id_predmet`) REFERENCES `predmet` (`id_predmet`) ON DELETE CASCADE,
  ADD CONSTRAINT `korisnik_predmet_ibfk_2` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnici` (`id_korisnik`) ON DELETE CASCADE;

--
-- Constraints for table `ocene`
--
ALTER TABLE `ocene`
  ADD CONSTRAINT `ocene_ibfk_1` FOREIGN KEY (`id_polugodiste`) REFERENCES `polugodiste` (`id_polugodiste`) ON DELETE CASCADE,
  ADD CONSTRAINT `ocene_ibfk_2` FOREIGN KEY (`id_vrsta_ocene`) REFERENCES `vrsta_ocene` (`id_vrsta_ocene`) ON DELETE CASCADE,
  ADD CONSTRAINT `ocene_ibfk_3` FOREIGN KEY (`id_ucenik`) REFERENCES `ucenik` (`id_ucenik`) ON DELETE CASCADE,
  ADD CONSTRAINT `ocene_ibfk_4` FOREIGN KEY (`id_predmet`) REFERENCES `predmet` (`id_predmet`) ON DELETE CASCADE;

--
-- Constraints for table `odeljenje`
--
ALTER TABLE `odeljenje`
  ADD CONSTRAINT `odeljenje_ibfk_1` FOREIGN KEY (`id_smer`) REFERENCES `smer` (`id_smer`) ON DELETE CASCADE,
  ADD CONSTRAINT `odeljenje_ibfk_2` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnici` (`id_korisnik`) ON DELETE CASCADE;

--
-- Constraints for table `odeljenje_predmet`
--
ALTER TABLE `odeljenje_predmet`
  ADD CONSTRAINT `odeljenje_predmet_ibfk_1` FOREIGN KEY (`id_predmet`) REFERENCES `predmet` (`id_predmet`) ON DELETE CASCADE,
  ADD CONSTRAINT `odeljenje_predmet_ibfk_2` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnici` (`id_korisnik`) ON DELETE CASCADE,
  ADD CONSTRAINT `odeljenje_predmet_ibfk_3` FOREIGN KEY (`id_odeljenje`) REFERENCES `odeljenje` (`id_odeljenje`) ON DELETE CASCADE;

--
-- Constraints for table `odsutni`
--
ALTER TABLE `odsutni`
  ADD CONSTRAINT `odsutni_ibfk_1` FOREIGN KEY (`id_ucenik`) REFERENCES `ucenik` (`id_ucenik`) ON DELETE CASCADE,
  ADD CONSTRAINT `odsutni_ibfk_2` FOREIGN KEY (`id_cas`) REFERENCES `cas` (`id_cas`) ON DELETE CASCADE;

--
-- Constraints for table `prosek`
--
ALTER TABLE `prosek`
  ADD CONSTRAINT `prosek_ibfk_1` FOREIGN KEY (`id_ucenik`) REFERENCES `ucenik` (`id_ucenik`) ON DELETE CASCADE;

--
-- Constraints for table `roditelj_ucenik`
--
ALTER TABLE `roditelj_ucenik`
  ADD CONSTRAINT `roditelj_ucenik_ibfk_1` FOREIGN KEY (`id_ucenik`) REFERENCES `ucenik` (`id_ucenik`) ON DELETE CASCADE,
  ADD CONSTRAINT `roditelj_ucenik_ibfk_2` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnici` (`id_korisnik`) ON DELETE CASCADE;

--
-- Constraints for table `smer_predmet`
--
ALTER TABLE `smer_predmet`
  ADD CONSTRAINT `smer_predmet_ibfk_1` FOREIGN KEY (`id_predmet`) REFERENCES `predmet` (`id_predmet`) ON DELETE CASCADE,
  ADD CONSTRAINT `smer_predmet_ibfk_2` FOREIGN KEY (`id_smer`) REFERENCES `smer` (`id_smer`) ON DELETE CASCADE;

--
-- Constraints for table `ucenik`
--
ALTER TABLE `ucenik`
  ADD CONSTRAINT `ucenik_ibfk_1` FOREIGN KEY (`id_odeljenje`) REFERENCES `odeljenje` (`id_odeljenje`) ON DELETE CASCADE;

--
-- Constraints for table `zahtev`
--
ALTER TABLE `zahtev`
  ADD CONSTRAINT `zahtev_ibfk_1` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnici` (`id_korisnik`) ON DELETE CASCADE,
  ADD CONSTRAINT `zahtev_ibfk_2` FOREIGN KEY (`id_ucenik`) REFERENCES `ucenik` (`id_ucenik`) ON DELETE CASCADE,
  ADD CONSTRAINT `zahtev_ibfk_3` FOREIGN KEY (`id_vrsta_ocene`) REFERENCES `vrsta_ocene` (`id_vrsta_ocene`) ON DELETE CASCADE;

--
-- Constraints for table `zakljucna_ocena`
--
ALTER TABLE `zakljucna_ocena`
  ADD CONSTRAINT `zakljucna_ocena_ibfk_1` FOREIGN KEY (`id_ucenik`) REFERENCES `ucenik` (`id_ucenik`) ON DELETE CASCADE,
  ADD CONSTRAINT `zakljucna_ocena_ibfk_2` FOREIGN KEY (`id_predmet`) REFERENCES `predmet` (`id_predmet`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
