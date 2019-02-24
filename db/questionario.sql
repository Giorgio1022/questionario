-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 14, 2019 alle 09:56
-- Versione del server: 10.1.30-MariaDB
-- Versione PHP: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `questionario`
--

CREATE TABLE `domande` (
  `ID_domanda` int(4) NOT NULL,
  `Testo_domanda` char(200) CHARACTER SET utf8 NOT NULL,
  `FK_Materia` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `domande_questionari` (
  `ID` int(11) NOT NULL,
  `FK_domanda` int(4) DEFAULT NULL,
  `FK_questionario` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `materie` (
  `Nome` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `questionari` (
  `ID` int(4) NOT NULL,
  `Nome` char(30) NOT NULL,
  `FK_Materia` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `risposte` (
  `ID_risposta` int(5) NOT NULL,
  `Testo_risposta` char(255) NOT NULL,
  `Punteggio` decimal(2,1) NOT NULL,
  `FK_domanda` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `risposte_svolgimenti` (
  `ID` int(11) NOT NULL,
  `FK_Risposta` int(5) NOT NULL,
  `FK_Svolgimento` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `svolgimenti` (
  `ID` int(7) NOT NULL,
  `Data` date NOT NULL,
  `FK_Utente` char(30) NOT NULL,
  `FK_questionario` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `utenti` (
  `Username` char(30) NOT NULL,
  `Password` char(40) NOT NULL,
  `Livello` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `domande`
  ADD PRIMARY KEY (`ID_domanda`),
  ADD KEY `FK_Materia` (`FK_Materia`) USING BTREE;

ALTER TABLE `domande_questionario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_domanda` (`FK_domanda`),
  ADD KEY `FK_questionario` (`FK_questionario`);

ALTER TABLE `materia`
  ADD PRIMARY KEY (`Nome`);

ALTER TABLE `questionario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Materia` (`FK_Materia`);

ALTER TABLE `risposte`
  ADD PRIMARY KEY (`ID_risposta`),
  ADD KEY `FK_domanda` (`FK_domanda`);

ALTER TABLE `risposte_svolgimenti`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Risposta` (`FK_Risposta`),
  ADD KEY `FK_Svolgimento` (`FK_Svolgimento`);

ALTER TABLE `svolgimenti`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Utente` (`FK_Utente`),
  ADD KEY `FK_questionario` (`FK_questionario`);

ALTER TABLE `utenti`
  ADD PRIMARY KEY (`Username`);


ALTER TABLE `domande`
  MODIFY `ID_domanda` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

ALTER TABLE `domande_questionario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

ALTER TABLE `questionario`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE `risposte`
  MODIFY `ID_risposta` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

ALTER TABLE `risposte_svolgimenti`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

ALTER TABLE `svolgimenti`
  MODIFY `ID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;


ALTER TABLE `domande`
  ADD CONSTRAINT `domande_ibfk_1` FOREIGN KEY (`FK_materia`) REFERENCES `materia` (`Nome`),
  ADD CONSTRAINT `domande_ibfk_2` FOREIGN KEY (`FK_Materia`) REFERENCES `materia` (`Nome`);

ALTER TABLE `domande_questionario`
  ADD CONSTRAINT `domande_questionario_ibfk_1` FOREIGN KEY (`FK_domanda`) REFERENCES `domande` (`ID_domanda`),
  ADD CONSTRAINT `domande_questionario_ibfk_2` FOREIGN KEY (`FK_questionario`) REFERENCES `questionario` (`ID`);

ALTER TABLE `questionario`
  ADD CONSTRAINT `questionario_ibfk_1` FOREIGN KEY (`FK_Materia`) REFERENCES `materia` (`Nome`);

ALTER TABLE `risposte`
  ADD CONSTRAINT `risposte_ibfk_1` FOREIGN KEY (`FK_domanda`) REFERENCES `domande` (`ID_domanda`);

ALTER TABLE `risposte_svolgimenti`
  ADD CONSTRAINT `risposte_svolgimenti_ibfk_1` FOREIGN KEY (`FK_Risposta`) REFERENCES `risposte` (`ID_risposta`),
  ADD CONSTRAINT `risposte_svolgimenti_ibfk_2` FOREIGN KEY (`FK_Svolgimento`) REFERENCES `svolgimenti` (`ID`);

ALTER TABLE `svolgimenti`
  ADD CONSTRAINT `svolgimenti_ibfk_1` FOREIGN KEY (`FK_Utente`) REFERENCES `utenti` (`Username`),
  ADD CONSTRAINT `svolgimenti_ibfk_2` FOREIGN KEY (`FK_questionario`) REFERENCES `questionario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
