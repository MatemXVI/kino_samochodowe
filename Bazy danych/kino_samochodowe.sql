-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 25, 2023 at 11:47 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kino_samochodowe`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `administrator`
--

CREATE TABLE `administrator` (
  `IDAdministratora` int(11) NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `login` text NOT NULL,
  `haslo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`IDAdministratora`, `imie`, `nazwisko`, `login`, `haslo`) VALUES
(1, 'Mateusz', 'Milczarek', 'admin', '$2y$10$LkjVPVvaK3O5xRGRzvgwvuRJbZrmI.PAru7NspB7GjwNOy2IcFLLC'),
(2, 'Mateusz', 'Nowak', 'MatemXVI', '$2y$10$5PSEZRHDaxGokxHEh9G.hOUL5YlgNCEkVJq0EsTVClXYrfZgEjMGm');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bilet`
--

CREATE TABLE `bilet` (
  `NumerBiletu` int(11) NOT NULL,
  `data_wygenerowania` datetime DEFAULT NULL,
  `cena` float DEFAULT NULL,
  `NumerMiejscaParkingowego` int(11) DEFAULT NULL,
  `IDSeansu` int(11) NOT NULL,
  `IDUzytkownika` int(11) DEFAULT NULL,
  `nazwa_pliku` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `bilet`
--

INSERT INTO `bilet` (`NumerBiletu`, `data_wygenerowania`, `cena`, `NumerMiejscaParkingowego`, `IDSeansu`, `IDUzytkownika`, `nazwa_pliku`) VALUES
(1, '2023-04-18 23:20:22', 7, 1, 1, 1, 'qr_img/qr50d10458cf669a9537bc408cd3be3dba.png'),
(2, NULL, 7, 2, 1, NULL, NULL),
(3, '2023-04-25 00:01:50', 7, 3, 1, 1, 'qr_img/qr50d10458cf669a9537bc408cd3be3dba.png'),
(4, NULL, 7, 4, 1, NULL, NULL),
(5, NULL, 7, 5, 1, NULL, NULL),
(6, '2023-04-25 00:49:04', 7, 6, 1, 1, 'qr_img/qr50d10458cf669a9537bc408cd3be3dba.png'),
(7, NULL, 7, 7, 1, NULL, NULL),
(8, NULL, 7, 8, 1, NULL, NULL),
(9, '2023-05-24 13:58:42', 7, 9, 1, 5, 'qr_img/qr09f5db4a73bb0a9d70365f5dea59d685.png'),
(10, NULL, 7, 10, 1, NULL, NULL),
(11, NULL, 7, 11, 1, NULL, NULL),
(12, NULL, 7, 12, 1, NULL, NULL),
(13, NULL, 7, 13, 1, NULL, NULL),
(14, NULL, 7, 14, 1, NULL, NULL),
(15, NULL, 7, 15, 1, NULL, NULL),
(16, NULL, 7, 16, 1, NULL, NULL),
(17, NULL, 7, 17, 1, NULL, NULL),
(18, NULL, 7, 18, 1, NULL, NULL),
(19, NULL, 7, 19, 1, NULL, NULL),
(20, NULL, 7, 20, 1, NULL, NULL),
(21, NULL, 7, 21, 1, NULL, NULL),
(22, NULL, 7, 22, 1, NULL, NULL),
(23, NULL, 7, 23, 1, NULL, NULL),
(24, NULL, 7, 24, 1, NULL, NULL),
(25, NULL, 7, 25, 1, NULL, NULL),
(26, '2023-04-24 18:37:30', 7, 26, 1, 1, 'qr_img/qr50d10458cf669a9537bc408cd3be3dba.png'),
(27, NULL, 7, 27, 1, NULL, NULL),
(28, NULL, 7, 28, 1, NULL, NULL),
(29, NULL, 7, 29, 1, NULL, NULL),
(30, NULL, 7, 30, 1, NULL, NULL),
(31, NULL, 7, 31, 1, NULL, NULL),
(32, NULL, 7, 32, 1, NULL, NULL),
(33, NULL, 7, 33, 1, NULL, NULL),
(34, NULL, 7, 34, 1, NULL, NULL),
(35, NULL, 7, 35, 1, NULL, NULL),
(36, NULL, 7, 36, 1, NULL, NULL),
(37, NULL, 7, 37, 1, NULL, NULL),
(38, NULL, 7, 38, 1, NULL, NULL),
(39, NULL, 7, 39, 1, NULL, NULL),
(40, NULL, 7, 40, 1, NULL, NULL),
(41, NULL, 7, 41, 1, NULL, NULL),
(42, NULL, 7, 42, 1, NULL, NULL),
(43, NULL, 7, 43, 1, NULL, NULL),
(44, NULL, 7, 44, 1, NULL, NULL),
(45, NULL, 7, 45, 1, NULL, NULL),
(46, NULL, 7, 46, 1, NULL, NULL),
(47, NULL, 7, 47, 1, NULL, NULL),
(48, NULL, 7, 48, 1, NULL, NULL),
(49, NULL, 7, 49, 1, NULL, NULL),
(50, NULL, 7, 50, 1, NULL, NULL),
(51, NULL, 7, 51, 1, NULL, NULL),
(52, NULL, 7, 52, 1, NULL, NULL),
(53, NULL, 7, 53, 1, NULL, NULL),
(54, NULL, 7, 54, 1, NULL, NULL),
(55, NULL, 7, 55, 1, NULL, NULL),
(56, NULL, 7, 56, 1, NULL, NULL),
(57, NULL, 7, 57, 1, NULL, NULL),
(58, NULL, 7, 58, 1, NULL, NULL),
(59, NULL, 7, 59, 1, NULL, NULL),
(60, NULL, 7, 60, 1, NULL, NULL),
(61, NULL, 7, 61, 1, NULL, NULL),
(62, NULL, 7, 62, 1, NULL, NULL),
(63, NULL, 7, 63, 1, NULL, NULL),
(64, NULL, 7, 64, 1, NULL, NULL),
(65, NULL, 7, 65, 1, NULL, NULL),
(66, NULL, 7, 66, 1, NULL, NULL),
(67, NULL, 7, 67, 1, NULL, NULL),
(68, NULL, 7, 68, 1, NULL, NULL),
(69, NULL, 7, 69, 1, NULL, NULL),
(70, NULL, 7, 70, 1, NULL, NULL),
(71, NULL, 7, 71, 1, NULL, NULL),
(72, NULL, 7, 72, 1, NULL, NULL),
(73, NULL, 7, 73, 1, NULL, NULL),
(74, NULL, 7, 74, 1, NULL, NULL),
(75, NULL, 7, 75, 1, NULL, NULL),
(76, NULL, 7, 76, 1, NULL, NULL),
(77, NULL, 7, 77, 1, NULL, NULL),
(78, NULL, 7, 78, 1, NULL, NULL),
(79, NULL, 7, 79, 1, NULL, NULL),
(80, NULL, 7, 80, 1, NULL, NULL),
(81, '2023-04-25 00:56:09', 5, 1, 2, 1, 'qr_img/qr50d10458cf669a9537bc408cd3be3dba.png'),
(82, NULL, 5, 2, 2, NULL, NULL),
(83, NULL, 5, 3, 2, NULL, NULL),
(84, NULL, 5, 4, 2, NULL, NULL),
(85, '2023-05-07 13:10:55', 5, 5, 2, 1, 'qr_img/qr50d10458cf669a9537bc408cd3be3dba.png'),
(86, '2023-05-07 14:31:04', 5, 6, 2, 1, 'qr_img/qrfb681b3b5ae9301f57c7bef140b9a2d0.png'),
(87, NULL, 5, 7, 2, NULL, NULL),
(88, '2023-05-07 12:26:13', 5, 8, 2, 1, 'qr_img/qr50d10458cf669a9537bc408cd3be3dba.png'),
(89, NULL, 5, 9, 2, NULL, NULL),
(90, NULL, 5, 10, 2, NULL, NULL),
(91, NULL, 5, 11, 2, NULL, NULL),
(92, NULL, 5, 12, 2, NULL, NULL),
(93, NULL, 5, 13, 2, NULL, NULL),
(94, NULL, 5, 14, 2, NULL, NULL),
(95, NULL, 5, 15, 2, NULL, NULL),
(96, NULL, 5, 16, 2, NULL, NULL),
(97, NULL, 5, 17, 2, NULL, NULL),
(98, NULL, 5, 18, 2, NULL, NULL),
(99, NULL, 5, 19, 2, NULL, NULL),
(100, NULL, 5, 20, 2, NULL, NULL),
(101, NULL, 5, 21, 2, NULL, NULL),
(102, NULL, 5, 22, 2, NULL, NULL),
(103, NULL, 5, 23, 2, NULL, NULL),
(104, NULL, 5, 24, 2, NULL, NULL),
(105, NULL, 5, 25, 2, NULL, NULL),
(106, NULL, 5, 26, 2, NULL, NULL),
(107, NULL, 5, 27, 2, NULL, NULL),
(108, NULL, 5, 28, 2, NULL, NULL),
(109, NULL, 5, 29, 2, NULL, NULL),
(110, NULL, 5, 30, 2, NULL, NULL),
(111, NULL, 5, 31, 2, NULL, NULL),
(112, NULL, 5, 32, 2, NULL, NULL),
(113, NULL, 5, 33, 2, NULL, NULL),
(114, NULL, 5, 34, 2, NULL, NULL),
(115, NULL, 5, 35, 2, NULL, NULL),
(116, NULL, 5, 36, 2, NULL, NULL),
(117, NULL, 5, 37, 2, NULL, NULL),
(118, NULL, 5, 38, 2, NULL, NULL),
(119, NULL, 5, 39, 2, NULL, NULL),
(120, NULL, 5, 40, 2, NULL, NULL),
(121, NULL, 10, 1, 3, NULL, NULL),
(122, NULL, 10, 2, 3, NULL, NULL),
(123, NULL, 10, 3, 3, NULL, NULL),
(124, NULL, 10, 4, 3, NULL, NULL),
(125, '2023-05-07 14:26:09', 10, 5, 3, 1, 'qr_img/qrfb681b3b5ae9301f57c7bef140b9a2d0.png'),
(126, NULL, 10, 6, 3, NULL, NULL),
(127, NULL, 10, 7, 3, NULL, NULL),
(128, '2023-05-24 13:02:20', 10, 8, 3, 1, 'qr_img/qrfb681b3b5ae9301f57c7bef140b9a2d0.png'),
(129, NULL, 10, 9, 3, NULL, NULL),
(130, '2023-05-24 13:01:11', 10, 10, 3, 1, 'qr_img/qrfb681b3b5ae9301f57c7bef140b9a2d0.png'),
(131, NULL, 10, 11, 3, NULL, NULL),
(132, '2023-05-24 13:56:23', 10, 12, 3, 1, 'qr_img/qr1b4bd76512e1ba5557033e57c2522f19.png'),
(133, NULL, 10, 13, 3, NULL, NULL),
(134, NULL, 10, 14, 3, NULL, NULL),
(135, NULL, 10, 15, 3, NULL, NULL),
(136, NULL, 10, 16, 3, NULL, NULL),
(137, NULL, 10, 17, 3, NULL, NULL),
(138, NULL, 10, 18, 3, NULL, NULL),
(139, NULL, 10, 19, 3, NULL, NULL),
(140, NULL, 10, 20, 3, NULL, NULL),
(141, NULL, 10, 21, 3, NULL, NULL),
(142, NULL, 10, 22, 3, NULL, NULL),
(143, NULL, 10, 23, 3, NULL, NULL),
(144, NULL, 10, 24, 3, NULL, NULL),
(145, NULL, 10, 25, 3, NULL, NULL),
(146, NULL, 10, 26, 3, NULL, NULL),
(147, NULL, 10, 27, 3, NULL, NULL),
(148, NULL, 10, 28, 3, NULL, NULL),
(149, NULL, 10, 29, 3, NULL, NULL),
(150, NULL, 10, 30, 3, NULL, NULL),
(151, NULL, 10, 31, 3, NULL, NULL),
(152, NULL, 10, 32, 3, NULL, NULL),
(153, NULL, 10, 33, 3, NULL, NULL),
(154, NULL, 10, 34, 3, NULL, NULL),
(155, NULL, 10, 35, 3, NULL, NULL),
(156, '2023-05-07 13:10:22', 10, 36, 3, 1, 'qr_img/qr50d10458cf669a9537bc408cd3be3dba.png'),
(157, NULL, 10, 37, 3, NULL, NULL),
(158, NULL, 10, 38, 3, NULL, NULL),
(159, NULL, 10, 39, 3, NULL, NULL),
(160, '2023-05-24 13:04:55', 10, 40, 3, 1, 'qr_img/qrfb681b3b5ae9301f57c7bef140b9a2d0.png'),
(161, NULL, 10, 41, 3, NULL, NULL),
(162, NULL, 10, 42, 3, NULL, NULL),
(163, NULL, 10, 43, 3, NULL, NULL),
(164, NULL, 10, 44, 3, NULL, NULL),
(165, NULL, 10, 45, 3, NULL, NULL),
(166, NULL, 10, 46, 3, NULL, NULL),
(167, NULL, 10, 47, 3, NULL, NULL),
(168, NULL, 10, 48, 3, NULL, NULL),
(169, NULL, 10, 49, 3, NULL, NULL),
(170, NULL, 10, 50, 3, NULL, NULL),
(171, NULL, 10, 51, 3, NULL, NULL),
(172, NULL, 10, 52, 3, NULL, NULL),
(173, NULL, 10, 53, 3, NULL, NULL),
(174, NULL, 10, 54, 3, NULL, NULL),
(175, NULL, 10, 55, 3, NULL, NULL),
(176, NULL, 10, 56, 3, NULL, NULL),
(177, NULL, 10, 57, 3, NULL, NULL),
(178, NULL, 10, 58, 3, NULL, NULL),
(179, NULL, 10, 59, 3, NULL, NULL),
(180, NULL, 10, 60, 3, NULL, NULL),
(181, NULL, 10, 61, 3, NULL, NULL),
(182, NULL, 10, 62, 3, NULL, NULL),
(183, NULL, 10, 63, 3, NULL, NULL),
(184, NULL, 10, 64, 3, NULL, NULL),
(185, NULL, 10, 65, 3, NULL, NULL),
(186, NULL, 10, 66, 3, NULL, NULL),
(187, NULL, 10, 67, 3, NULL, NULL),
(188, NULL, 10, 68, 3, NULL, NULL),
(189, NULL, 10, 69, 3, NULL, NULL),
(190, NULL, 10, 70, 3, NULL, NULL),
(191, NULL, 10, 71, 3, NULL, NULL),
(192, NULL, 10, 72, 3, NULL, NULL),
(193, NULL, 10, 73, 3, NULL, NULL),
(194, NULL, 10, 74, 3, NULL, NULL),
(195, NULL, 10, 75, 3, NULL, NULL),
(196, NULL, 10, 76, 3, NULL, NULL),
(197, NULL, 10, 77, 3, NULL, NULL),
(198, NULL, 10, 78, 3, NULL, NULL),
(199, NULL, 10, 79, 3, NULL, NULL),
(200, NULL, 10, 80, 3, NULL, NULL),
(201, NULL, 8, 1, 4, NULL, NULL),
(202, '2023-05-24 21:29:49', 8, 2, 4, 1, 'qr_img/qrf2e3483bd95316828c983cc04343c3f1.png'),
(203, NULL, 8, 3, 4, NULL, NULL),
(204, NULL, 8, 4, 4, NULL, NULL),
(205, '2023-05-07 11:27:21', 8, 5, 4, 1, 'qr_img/qr50d10458cf669a9537bc408cd3be3dba.png'),
(206, NULL, 8, 6, 4, NULL, NULL),
(207, NULL, 8, 7, 4, NULL, NULL),
(208, NULL, 8, 8, 4, NULL, NULL),
(209, '2023-05-07 14:55:19', 8, 9, 4, 1, 'qr_img/qr7ccf13e59cfa1ab1aa07b5f14efa0e10.png'),
(210, NULL, 8, 10, 4, NULL, NULL),
(211, NULL, 8, 11, 4, NULL, NULL),
(212, NULL, 8, 12, 4, NULL, NULL),
(213, NULL, 8, 13, 4, NULL, NULL),
(214, NULL, 8, 14, 4, NULL, NULL),
(215, NULL, 8, 15, 4, NULL, NULL),
(216, NULL, 8, 16, 4, NULL, NULL),
(217, NULL, 8, 17, 4, NULL, NULL),
(218, NULL, 8, 18, 4, NULL, NULL),
(219, NULL, 8, 19, 4, NULL, NULL),
(220, NULL, 8, 20, 4, NULL, NULL),
(221, NULL, 8, 21, 4, NULL, NULL),
(222, NULL, 8, 22, 4, NULL, NULL),
(223, NULL, 8, 23, 4, NULL, NULL),
(224, NULL, 8, 24, 4, NULL, NULL),
(225, NULL, 8, 25, 4, NULL, NULL),
(226, NULL, 8, 26, 4, NULL, NULL),
(227, NULL, 8, 27, 4, NULL, NULL),
(228, NULL, 8, 28, 4, NULL, NULL),
(229, NULL, 8, 29, 4, NULL, NULL),
(230, NULL, 8, 30, 4, NULL, NULL),
(231, NULL, 8, 31, 4, NULL, NULL),
(232, NULL, 8, 32, 4, NULL, NULL),
(233, NULL, 8, 33, 4, NULL, NULL),
(234, NULL, 8, 34, 4, NULL, NULL),
(235, NULL, 8, 35, 4, NULL, NULL),
(236, NULL, 8, 36, 4, NULL, NULL),
(237, NULL, 8, 37, 4, NULL, NULL),
(238, NULL, 8, 38, 4, NULL, NULL),
(239, NULL, 8, 39, 4, NULL, NULL),
(240, NULL, 8, 40, 4, NULL, NULL),
(241, NULL, 8, 41, 4, NULL, NULL),
(242, NULL, 8, 42, 4, NULL, NULL),
(243, NULL, 8, 43, 4, NULL, NULL),
(244, NULL, 8, 44, 4, NULL, NULL),
(245, NULL, 8, 45, 4, NULL, NULL),
(246, NULL, 8, 46, 4, NULL, NULL),
(247, NULL, 8, 47, 4, NULL, NULL),
(248, NULL, 8, 48, 4, NULL, NULL),
(249, NULL, 8, 49, 4, NULL, NULL),
(250, NULL, 8, 50, 4, NULL, NULL),
(251, NULL, 8, 51, 4, NULL, NULL),
(252, NULL, 8, 52, 4, NULL, NULL),
(253, NULL, 8, 53, 4, NULL, NULL),
(254, NULL, 8, 54, 4, NULL, NULL),
(255, NULL, 8, 55, 4, NULL, NULL),
(256, NULL, 8, 56, 4, NULL, NULL),
(257, NULL, 8, 57, 4, NULL, NULL),
(258, NULL, 8, 58, 4, NULL, NULL),
(259, NULL, 8, 59, 4, NULL, NULL),
(260, NULL, 8, 60, 4, NULL, NULL),
(261, NULL, 8, 61, 4, NULL, NULL),
(262, NULL, 8, 62, 4, NULL, NULL),
(263, NULL, 8, 63, 4, NULL, NULL),
(264, NULL, 8, 64, 4, NULL, NULL),
(265, NULL, 8, 65, 4, NULL, NULL),
(266, NULL, 8, 66, 4, NULL, NULL),
(267, NULL, 8, 67, 4, NULL, NULL),
(268, NULL, 8, 68, 4, NULL, NULL),
(269, NULL, 8, 69, 4, NULL, NULL),
(270, NULL, 8, 70, 4, NULL, NULL),
(271, NULL, 8, 71, 4, NULL, NULL),
(272, NULL, 8, 72, 4, NULL, NULL),
(273, NULL, 8, 73, 4, NULL, NULL),
(274, NULL, 8, 74, 4, NULL, NULL),
(275, NULL, 8, 75, 4, NULL, NULL),
(276, NULL, 8, 76, 4, NULL, NULL),
(277, NULL, 8, 77, 4, NULL, NULL),
(278, NULL, 8, 78, 4, NULL, NULL),
(279, NULL, 8, 79, 4, NULL, NULL),
(280, NULL, 8, 80, 4, NULL, NULL),
(281, NULL, 15, 1, 5, NULL, NULL),
(282, NULL, 15, 2, 5, NULL, NULL),
(283, NULL, 15, 3, 5, NULL, NULL),
(284, NULL, 15, 4, 5, NULL, NULL),
(285, NULL, 15, 5, 5, NULL, NULL),
(286, '2023-05-07 14:02:00', 15, 6, 5, 1, 'qr_img/qrfb681b3b5ae9301f57c7bef140b9a2d0.png'),
(287, NULL, 15, 7, 5, NULL, NULL),
(288, NULL, 15, 8, 5, NULL, NULL),
(289, '2023-05-07 11:13:00', 15, 9, 5, 3, 'qr_img/qr50d10458cf669a9537bc408cd3be3dba.png'),
(290, NULL, 15, 10, 5, NULL, NULL),
(291, NULL, 15, 11, 5, NULL, NULL),
(292, NULL, 15, 12, 5, NULL, NULL),
(293, NULL, 15, 13, 5, NULL, NULL),
(294, NULL, 15, 14, 5, NULL, NULL),
(295, NULL, 15, 15, 5, NULL, NULL),
(296, NULL, 15, 16, 5, NULL, NULL),
(297, NULL, 15, 17, 5, NULL, NULL),
(298, NULL, 15, 18, 5, NULL, NULL),
(299, NULL, 15, 19, 5, NULL, NULL),
(300, NULL, 15, 20, 5, NULL, NULL),
(301, NULL, 15, 21, 5, NULL, NULL),
(302, NULL, 15, 22, 5, NULL, NULL),
(303, NULL, 15, 23, 5, NULL, NULL),
(304, NULL, 15, 24, 5, NULL, NULL),
(305, NULL, 15, 25, 5, NULL, NULL),
(306, NULL, 15, 26, 5, NULL, NULL),
(307, NULL, 15, 27, 5, NULL, NULL),
(308, NULL, 15, 28, 5, NULL, NULL),
(309, NULL, 15, 29, 5, NULL, NULL),
(310, NULL, 15, 30, 5, NULL, NULL),
(311, NULL, 15, 31, 5, NULL, NULL),
(312, NULL, 15, 32, 5, NULL, NULL),
(313, NULL, 15, 33, 5, NULL, NULL),
(314, NULL, 15, 34, 5, NULL, NULL),
(315, NULL, 15, 35, 5, NULL, NULL),
(316, NULL, 15, 36, 5, NULL, NULL),
(317, NULL, 15, 37, 5, NULL, NULL),
(318, NULL, 15, 38, 5, NULL, NULL),
(319, NULL, 15, 39, 5, NULL, NULL),
(320, NULL, 15, 40, 5, NULL, NULL),
(321, NULL, 15, 41, 5, NULL, NULL),
(322, NULL, 15, 42, 5, NULL, NULL),
(323, NULL, 15, 43, 5, NULL, NULL),
(324, NULL, 15, 44, 5, NULL, NULL),
(325, NULL, 15, 45, 5, NULL, NULL),
(326, NULL, 15, 46, 5, NULL, NULL),
(327, NULL, 15, 47, 5, NULL, NULL),
(328, NULL, 15, 48, 5, NULL, NULL),
(329, NULL, 15, 49, 5, NULL, NULL),
(330, NULL, 15, 50, 5, NULL, NULL),
(331, NULL, 15, 51, 5, NULL, NULL),
(332, NULL, 15, 52, 5, NULL, NULL),
(333, NULL, 15, 53, 5, NULL, NULL),
(334, NULL, 15, 54, 5, NULL, NULL),
(335, NULL, 15, 55, 5, NULL, NULL),
(336, NULL, 15, 56, 5, NULL, NULL),
(337, NULL, 15, 57, 5, NULL, NULL),
(338, NULL, 15, 58, 5, NULL, NULL),
(339, NULL, 15, 59, 5, NULL, NULL),
(340, NULL, 15, 60, 5, NULL, NULL),
(341, NULL, 15, 61, 5, NULL, NULL),
(342, NULL, 15, 62, 5, NULL, NULL),
(343, NULL, 15, 63, 5, NULL, NULL),
(344, NULL, 15, 64, 5, NULL, NULL),
(345, NULL, 15, 65, 5, NULL, NULL),
(346, NULL, 15, 66, 5, NULL, NULL),
(347, NULL, 15, 67, 5, NULL, NULL),
(348, NULL, 15, 68, 5, NULL, NULL),
(349, NULL, 15, 69, 5, NULL, NULL),
(350, NULL, 15, 70, 5, NULL, NULL),
(351, NULL, 15, 71, 5, NULL, NULL),
(352, NULL, 15, 72, 5, NULL, NULL),
(353, NULL, 15, 73, 5, NULL, NULL),
(354, NULL, 15, 74, 5, NULL, NULL),
(355, NULL, 15, 75, 5, NULL, NULL),
(356, NULL, 15, 76, 5, NULL, NULL),
(357, NULL, 15, 77, 5, NULL, NULL),
(358, NULL, 15, 78, 5, NULL, NULL),
(359, NULL, 15, 79, 5, NULL, NULL),
(360, NULL, 15, 80, 5, NULL, NULL),
(361, NULL, 12, 1, 6, NULL, NULL),
(362, NULL, 12, 2, 6, NULL, NULL),
(363, NULL, 12, 3, 6, NULL, NULL),
(364, NULL, 12, 4, 6, NULL, NULL),
(365, NULL, 12, 5, 6, NULL, NULL),
(366, NULL, 12, 6, 6, NULL, NULL),
(367, NULL, 12, 7, 6, NULL, NULL),
(368, NULL, 12, 8, 6, NULL, NULL),
(369, NULL, 12, 9, 6, NULL, NULL),
(370, NULL, 12, 10, 6, NULL, NULL),
(371, NULL, 12, 11, 6, NULL, NULL),
(372, NULL, 12, 12, 6, NULL, NULL),
(373, NULL, 12, 13, 6, NULL, NULL),
(374, NULL, 12, 14, 6, NULL, NULL),
(375, NULL, 12, 15, 6, NULL, NULL),
(376, NULL, 12, 16, 6, NULL, NULL),
(377, NULL, 12, 17, 6, NULL, NULL),
(378, NULL, 12, 18, 6, NULL, NULL),
(379, NULL, 12, 19, 6, NULL, NULL),
(380, NULL, 12, 20, 6, NULL, NULL),
(381, NULL, 12, 21, 6, NULL, NULL),
(382, NULL, 12, 22, 6, NULL, NULL),
(383, NULL, 12, 23, 6, NULL, NULL),
(384, NULL, 12, 24, 6, NULL, NULL),
(385, NULL, 12, 25, 6, NULL, NULL),
(386, NULL, 12, 26, 6, NULL, NULL),
(387, NULL, 12, 27, 6, NULL, NULL),
(388, NULL, 12, 28, 6, NULL, NULL),
(389, NULL, 12, 29, 6, NULL, NULL),
(390, NULL, 12, 30, 6, NULL, NULL),
(391, NULL, 12, 31, 6, NULL, NULL),
(392, NULL, 12, 32, 6, NULL, NULL),
(393, NULL, 12, 33, 6, NULL, NULL),
(394, NULL, 12, 34, 6, NULL, NULL),
(395, NULL, 12, 35, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `film`
--

CREATE TABLE `film` (
  `IDFilmu` int(11) NOT NULL,
  `tytul` text NOT NULL,
  `rezyseria` text DEFAULT NULL,
  `obsada` text DEFAULT NULL,
  `scenariusz` text DEFAULT NULL,
  `gatunek` text DEFAULT NULL,
  `czas_trwania` int(11) DEFAULT NULL,
  `kraj` text DEFAULT NULL,
  `rok_produkcji` int(11) DEFAULT NULL,
  `opis` text DEFAULT NULL,
  `nazwa_plakatu` text DEFAULT NULL,
  `IDAdministratora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`IDFilmu`, `tytul`, `rezyseria`, `obsada`, `scenariusz`, `gatunek`, `czas_trwania`, `kraj`, `rok_produkcji`, `opis`, `nazwa_plakatu`, `IDAdministratora`) VALUES
(1, 'John Wick 4 / napisy', 'Chad Stahelski', 'Keanu Reeves, Donnie Yen, Bill Skarsgård, SkarsIan McShane', 'Shay Hatten, Michael Finch', 'Thriller, Akcja', 169, 'USA', 2022, 'John Wick odkrywa sposób na pokonanie Gildii Zabójców. Zanim jednak odzyska wolność, będzie musiał stawić czoła nowemu wrogowi i jego sojusznikom, z którymi stoczy walki na kilku kontynentach.', '8061066.3.jpg', 1),
(2, 'DUNGEONS & DRAGONS. Złodziejski honor / dubbing', 'John Francis Daley, Jonathan Goldstein', 'Rege-Jean Page, Michelle Rodriguez, Chris Pine', 'John Francis Daley, Jonathan Goldstein, Michael Gilio', 'Akcja,Fantasy,Przygodowy', 134, 'USA/Kanada', 2023, '„Dungeons & Dragons: Złodziejski Honor” przenosi bogaty świat i zabawnego ducha legendarnej gry na duży ekran w pełnej akcji przygodzie.\r\n\r\nUroczy złodziejaszek i banda niepoprawnych poszukiwaczy przygód podejmują się epickiej kradzieży, aby odzyskać zaginiony relikt. Jednak sprawy przybierają niebezpieczny obrót, gdy wpadają w oko niewłaściwym ludziom.', '8056026.3.jpg', 1),
(3, 'AVATAR: Istota wody', 'James Cameron', 'Zoe Saldana, Sam Worthington, Vin Diesel, Kate Winslet', 'James Cameron, Rick Jaffa', 'Sci-Fi', 192, 'USA', 2022, 'Pandorę znów napada wroga korporacja w poszukiwaniu cennych minerałów. Jack i Neytiri wraz z rodziną zmuszeni są opuścić wioskę i szukać pomocy u innych plemion zamieszkujących planetę.', '8047434.3.jpg', 1),
(4, 'NIEBEZPIECZNI DŻENTELMENI', 'Maciej Kawalski', 'Tomasz Kot, Marcin Dorociński, Andrzej Seweryn, Wojciech Mecwaldowski', 'Maciej Kawalski', 'Komedia kryminalna', 107, 'Polska', 2022, 'Zakopane, 1914. Czterech artystów budzi się po szalonej, narkotycznej imprezie nie dość, że zamieszani w rewolucyjną intrygę, to jeszcze z trupem na kanapie.', '8045254.3.jpg', 1),
(5, 'MASZ CI LOS!', 'Mateusz Głowacki', 'Izabela Kuna, Piotr Głowacki, Sonia Bohosiewicz', 'Mateusz Głowacki', 'Komedia', 86, 'Polska', 2022, 'Rodzina przyjeżdża na pogrzeb ukochanego dziadka. Podczas stypy okazuje się, że w loterii padły właśnie numery, którymi grał przez całe życie, a zwycięski kupon… został pochowany wraz z nim.', '8049306.3.jpg', 1),
(6, 'Biuro Detektywistyczne LASSEGO i MAI. Tajemnica Skorpiona', 'Tina Mackic', 'Christoffer Alehed, Hannah Alem-Davidson, Elliot Bosvik', 'Henrik Engstrom, Mattias Grosin', 'PrzygodowyFamilijnyKryminał', 88, 'Szwecja', 2022, 'Miasteczko Valleby za kilka dni obchodzi 500. urodziny! Świętowanie może jednak przerwać złodziej, którego znakiem rozpoznawczym jest... skorpion. Czy młodzi detektywi, Lasse i Maja, wpadną na jego trop i uratują imprezę?', 'biuro-detektywistyczne-tajemnica-skorpiona-plakat-online-cut_0b4a92788d.jpg', 1),
(7, 'PUKAJĄC DO DRZWI', 'M. Night Shyamalan', 'Jonathan Groff, Dave Bautista, Rupert Grint', 'M. Night Shyamalan', 'Horror', 100, 'USA', 2022, 'Siedmioletnia Wen spędza wakacje z dwoma ojcami w domku na odludziu. Podczas łapania koników podchodzi do niej nieznajomy, wyjaśniajac, że potrzebuje ich pomocy, by ocalić świat.', '8050969.3.jpg', 1),
(8, 'I znowu zgrzeszyliśmy, dobry Boże!', '', '', '', '', 0, '', 0, 'Błogosławieni cierpliwi, którzy czekali na powrót niecodziennej rodziny znad Sekwany. Christian Clavier i spółka znów rozbawią nas do łez w kontynuacji hitu „Za jakie grzechy, dobry Boże?”. Twórcy jednej z najbardziej kasowych francuskich komedii ostatnich lat nie wzięli sobie do serca mocnego postanowienia poprawy. Dla widowni to bardzo dobra nowina. Tym razem nie ma mowy o małżeństwach i rozwodach. Gorzej – pary młode z poprzedniej części będą chciały opuścić Francję. Jak daleko posuną się teściowie, by zatrzymać ich w kraju? Religia, tożsamość i narodowe stereotypy znów trafią na ołtarz krytyki, a państwo Verneuil i inni zostaną wyspowiadani na ekranie z małych i dużych grzechów. Więcej kłopotów, więcej kontrowersji, więcej… zabawy!', '', 2),
(9, 'Green book', 'Peter Farrelly', 'Viggo Mortensen, Mahershala Ali', 'Brian Hayes Currie, Peter Farrelly', 'Dramat, Komedia', 130, 'USA', 2018, 'OBSYPANA NAGRODAMI PRAWDZIWA HISTORIA NIEPRAWDOPODOBNEJ PRZYJAŹNI!\r\n\r\nNAJLEPSZY FILM ROKU ZDOBYWCA 3 OSCARÓW i 3 ZŁOTYCH GLOBÓW\r\n\r\nPRAWDZIWYCH PRZYJACIÓŁ POZNAJE SIĘ W DRODZE! MAHERSHALA ALI jako genialny muzyk i VIGGO MORTENSEN w roli jego włosko-amerykańskiego szofera! Cudowna, pełna humoru i wzruszeń historia, która wydarzyła się naprawdę. Drobny cwaniaczek z Bronxu zostaje szoferem ekstrawaganckiego muzyka z wyższych sfer i razem wyruszają na wielotygodniowe tournée. Ich wspólna podróż, pełna zaskakujących przygód, okaże się początkiem nieprawdopodobnej przyjaźni.', '', 2),
(10, 'Wypisz,... wymaluj miłość', '', '', '', '', 0, '', 0, 'Juliette Binoche — laureatka Oscara, Cezara i nagrody BAFTA — powraca na ekrany w niebanalnej komedii romantycznej. W filmowym pojedynku temperamentów i najlepszego aktorstwa, gwieździe „Angielskiego pacjenta” i „Czekolady” partneruje Clive Owen („Bliżej”, „Król Artur”), zdobywca Złotego Globu i tytułu najelegantszego mężczyzny świata. U ich boku komediowy talent zademonstrują także piękna Amy Brenneman („Dziewięć kobiet” i „Gorączka”), Keegan Connor Tracy – gwiazda „Bates Motel” i „Dawno, dawno temu” oraz Navid Negahban — znany wielbicielom serii „Homeland”. Jack i Dina pracują w jednej szkole. Z pozoru wszystko ich dzieli. On jest wyluzowanym nauczycielem angielskiego i lekkoduchem, ona zamkniętą w sobie malarką. On zachwyca się możliwościami słów, dla niej największe znaczenie ma pobudzająca siła obrazu. Obojgu brakuje jednak szczęścia i spełnienia zawodowego. Dina przestała malować, zaś Jack od lat nie może wydać książki. Pewnego dnia Jack rzuca Dinie wyzwanie. Muszą przekonać swoich uczniów, co w życiu jest ważniejsze – słowa, czy obrazy? Rywalizacja o serca i umysły podopiecznych zbliża do siebie na pozór zupełnie odmienne charaktery. Dina wkrótce przekona się, że z przystojnym nauczycielem łączy ją więcej niż mogła przypuszczać…', '', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `film_zdjecia`
--

CREATE TABLE `film_zdjecia` (
  `nazwa_zdjecia` text NOT NULL,
  `IDFilmu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `film_zdjecia`
--

INSERT INTO `film_zdjecia` (`nazwa_zdjecia`, `IDFilmu`) VALUES
('John-wick-4.jpg', 1),
('pap_20230320_22H.jpg', 1),
('000GXJQ2B3G1U6B1-C122.jpg', 1),
('a4c70f4b867c55e7.jpg', 3),
('avatar-istota-wody_2.jpg', 3),
('63396.4.jpg', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `miejsce_seansu`
--

CREATE TABLE `miejsce_seansu` (
  `IDMiejsca` int(11) NOT NULL,
  `miejscowosc` text NOT NULL,
  `ulica` text NOT NULL,
  `rodzaj_miejsca` text NOT NULL,
  `ilosc_miejsc_parkingowych` int(11) NOT NULL,
  `dodatkowe_informacje` text DEFAULT NULL,
  `IDAdministratora` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `miejsce_seansu`
--

INSERT INTO `miejsce_seansu` (`IDMiejsca`, `miejscowosc`, `ulica`, `rodzaj_miejsca`, `ilosc_miejsc_parkingowych`, `dodatkowe_informacje`, `IDAdministratora`) VALUES
(1, 'Poznań', 'Wiejska 5', 'Targowisko', 80, '', 1),
(2, 'Warszawa', 'Marszałkowska 37', 'Plac', 40, 'Prosimy o przybycie 10 minut przed seansem!', 1),
(3, 'Łódź', 'Piotrkowska 101', 'Ulica', 35, '', 1),
(4, 'Kraków', 'Kościuszki 1', 'Plac', 65, '', 1),
(6, 'Gdańsk', 'Długa 1', 'Plac', 15, 'Miejsce wśród Starego Miasta.', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `miejsce_seansu_zdjecia`
--

CREATE TABLE `miejsce_seansu_zdjecia` (
  `nazwa_zdjecia` text NOT NULL,
  `IDMiejsca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `miejsce_seansu_zdjecia`
--

INSERT INTO `miejsce_seansu_zdjecia` (`nazwa_zdjecia`, `IDMiejsca`) VALUES
('5c8f881636595_o_large.jpg', 6),
('kinasamochodowe.jpg', 2),
('pjimage-2020-06-08T152707.560.jpg', 2),
('kinosamochodowe.jpg', 1),
('nb9rdmvje3z6spdjkh8yc86awcm14i38.jpg', 4),
('kino-samochodowe-e1588262975645-1180x500-c-center.png', 3),
('nb9rdmvje3z6spdjkh8yc86awcm14i38.jpg', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `seans`
--

CREATE TABLE `seans` (
  `IDSeansu` int(11) NOT NULL,
  `nazwa` text NOT NULL,
  `data` date NOT NULL,
  `godzina` time NOT NULL,
  `IDFilmu` int(11) DEFAULT NULL,
  `IDMiejsca` int(11) DEFAULT NULL,
  `nazwa_plakatu` text DEFAULT NULL,
  `IDAdministratora` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `seans`
--

INSERT INTO `seans` (`IDSeansu`, `nazwa`, `data`, `godzina`, `IDFilmu`, `IDMiejsca`, `nazwa_plakatu`, `IDAdministratora`) VALUES
(1, 'Majówka z kinem', '2023-05-27', '17:00:00', 1, 1, 'kino-samochodowe-krynice-2021-plakat-jpg-1627904594.jpg', 1),
(2, 'Wiosna z kinem', '2023-05-22', '16:00:00', 2, 4, 'kino-samochodowe-1.jpg', 1),
(3, 'Kino Majówkowe', '2023-05-30', '18:00:00', 4, 2, 'kino-samochodowe-1.jpg', 1),
(4, 'Wiosna z kinem', '2023-06-05', '19:00:00', 1, 6, 'kino-samochodowe-1.jpg', 2),
(5, 'Wiosna z kinem', '2023-05-28', '21:00:00', 3, 2, 'kino_samochodowe_654e7224f91d84e3ed58c8f77077619c31f810bd.png', 1),
(6, 'Lato z kinem', '2023-06-24', '21:00:00', 5, 3, 'kino_samochodowe_654e7224f91d84e3ed58c8f77077619c31f810bd.png', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `seans_zdjecia`
--

CREATE TABLE `seans_zdjecia` (
  `nazwa_zdjecia` text NOT NULL,
  `IDSeansu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `IDUzytkownika` int(11) NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `wiek` int(11) NOT NULL,
  `e-mail` text NOT NULL,
  `login` text NOT NULL,
  `haslo` text NOT NULL,
  `telefon` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `uzytkownik`
--

INSERT INTO `uzytkownik` (`IDUzytkownika`, `imie`, `nazwisko`, `wiek`, `e-mail`, `login`, `haslo`, `telefon`) VALUES
(1, 'Mateusz', 'Milczarek', 24, 'matemxv@gmail.com', 'MatemXVI', '$2y$10$LmyG9EhoNKqErwRdlS8M5ut7ygnZA8/PdfQZUK1te6NHa.b4QdRGa', 111222333),
(2, 'Jan', 'Kowalski', 65, 'jankow1@gmail.com', 'janek123', '$2y$10$XS4VFl3Kb2gKc4q957M.NeNQshAsXeaGtIzu85jfsB2NSSGkobGdi', 987654312),
(3, 'Anna', 'Nowak', 35, 'anianowak@onet.pl', 'Ania1', '$2y$10$Ek92Ngjg1QhGMKcwZDfTeOl7l/LQq6JZmc78Sb.9lMU0cIikWDYy.', NULL),
(4, 'Ron', 'Waesley', 33, 'ronwaesley@wp.pl', 'RonWaesley', '$2y$10$h6GZ.ZVuRxr2kO0419SM9.6vAvqBIRqKwGB0EA/6pHPJEyPqnO.wq', NULL),
(5, 'Andrzej', 'Janus', 68, 'Janus@wp.pl', 'Janusik', '$2y$10$VER5V9GWTJ2bYXw6cd//tuIiLGl/5o0XpBkTyUQKV3u5KDot6dXEe', NULL),
(6, 'Root', 'Root', 15, 'root@wp.pl', 'root', '$2y$10$pB.rEs5aUzrYkNDekKaz1.b1v2GywwR3y7F/JwGzPMrsyYDD.qDGC', NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`IDAdministratora`);

--
-- Indeksy dla tabeli `bilet`
--
ALTER TABLE `bilet`
  ADD PRIMARY KEY (`NumerBiletu`),
  ADD KEY `IDSeansu` (`IDSeansu`),
  ADD KEY `IDUzytkownika` (`IDUzytkownika`),
  ADD KEY `NumerMiejscaParkingowego` (`NumerMiejscaParkingowego`);

--
-- Indeksy dla tabeli `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`IDFilmu`),
  ADD KEY `IDSprzedawcy` (`IDAdministratora`);

--
-- Indeksy dla tabeli `film_zdjecia`
--
ALTER TABLE `film_zdjecia`
  ADD KEY `IDFilmu` (`IDFilmu`);

--
-- Indeksy dla tabeli `miejsce_seansu`
--
ALTER TABLE `miejsce_seansu`
  ADD PRIMARY KEY (`IDMiejsca`),
  ADD KEY `IDSprzedawcy` (`IDAdministratora`);

--
-- Indeksy dla tabeli `miejsce_seansu_zdjecia`
--
ALTER TABLE `miejsce_seansu_zdjecia`
  ADD KEY `IDMiejsca` (`IDMiejsca`);

--
-- Indeksy dla tabeli `seans`
--
ALTER TABLE `seans`
  ADD PRIMARY KEY (`IDSeansu`),
  ADD KEY `IDFilmu` (`IDFilmu`),
  ADD KEY `IDMiejsca` (`IDMiejsca`),
  ADD KEY `IDSprzedawcy` (`IDAdministratora`);

--
-- Indeksy dla tabeli `seans_zdjecia`
--
ALTER TABLE `seans_zdjecia`
  ADD KEY `IDSeansu` (`IDSeansu`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`IDUzytkownika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `IDAdministratora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bilet`
--
ALTER TABLE `bilet`
  MODIFY `NumerBiletu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=396;

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `IDFilmu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `miejsce_seansu`
--
ALTER TABLE `miejsce_seansu`
  MODIFY `IDMiejsca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `seans`
--
ALTER TABLE `seans`
  MODIFY `IDSeansu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `IDUzytkownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bilet`
--
ALTER TABLE `bilet`
  ADD CONSTRAINT `bilet_ibfk_1` FOREIGN KEY (`IDSeansu`) REFERENCES `seans` (`IDSeansu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bilet_ibfk_2` FOREIGN KEY (`IDUzytkownika`) REFERENCES `uzytkownik` (`IDUzytkownika`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `film_zdjecia`
--
ALTER TABLE `film_zdjecia`
  ADD CONSTRAINT `film_zdjecia_ibfk_1` FOREIGN KEY (`IDFilmu`) REFERENCES `film` (`IDFilmu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `miejsce_seansu_zdjecia`
--
ALTER TABLE `miejsce_seansu_zdjecia`
  ADD CONSTRAINT `miejsce_seansu_zdjecia_ibfk_1` FOREIGN KEY (`IDMiejsca`) REFERENCES `miejsce_seansu` (`IDMiejsca`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seans`
--
ALTER TABLE `seans`
  ADD CONSTRAINT `seans_ibfk_1` FOREIGN KEY (`IDFilmu`) REFERENCES `film` (`IDFilmu`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `seans_ibfk_3` FOREIGN KEY (`IDAdministratora`) REFERENCES `administrator` (`IDAdministratora`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `seans_ibfk_4` FOREIGN KEY (`IDMiejsca`) REFERENCES `miejsce_seansu` (`IDMiejsca`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `seans_zdjecia`
--
ALTER TABLE `seans_zdjecia`
  ADD CONSTRAINT `seans_zdjecia_ibfk_1` FOREIGN KEY (`IDSeansu`) REFERENCES `seans` (`IDSeansu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
