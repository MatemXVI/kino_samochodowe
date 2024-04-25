-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 25, 2023 at 08:57 PM
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
(1, '', '', 'admin', '$2y$10$D2t3rOXq4kLMsC5QUSh4JeexOZJ4P1RtlWjDpyGUZ9Zqhz6cGGRsi');

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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `film_zdjecia`
--

CREATE TABLE `film_zdjecia` (
  `nazwa_zdjecia` text NOT NULL,
  `IDFilmu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `miejsce_seansu_zdjecia`
--

CREATE TABLE `miejsce_seansu_zdjecia` (
  `nazwa_zdjecia` text NOT NULL,
  `IDMiejsca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

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
  MODIFY `IDAdministratora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bilet`
--
ALTER TABLE `bilet`
  MODIFY `NumerBiletu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `IDFilmu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `miejsce_seansu`
--
ALTER TABLE `miejsce_seansu`
  MODIFY `IDMiejsca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seans`
--
ALTER TABLE `seans`
  MODIFY `IDSeansu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `IDUzytkownika` int(11) NOT NULL AUTO_INCREMENT;

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
