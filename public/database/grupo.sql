-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 19, 2018 at 12:38 AM
-- Server version: 5.7.17-log
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grupo`
--

-- --------------------------------------------------------

--
-- Table structure for table `aplicacion`
--

CREATE TABLE `aplicacion` (
  `pkfield` int(11) NOT NULL,
  `LimiteEventosDashboard` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `asistencia`
--

CREATE TABLE `asistencia` (
  `idEvento` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `idMicro` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL,
  `FechaEvento` date NOT NULL,
  `Asiste` tinyint(1) NOT NULL,
  `Observaciones` varchar(150) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `DocumentoNo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `asistpersona`
--

CREATE TABLE `asistpersona` (
  `idGrupo` int(11) DEFAULT NULL,
  `idMicro` int(11) DEFAULT NULL,
  `FechaEvento` date DEFAULT NULL,
  `idPersona` int(11) DEFAULT NULL,
  `Nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Apellido` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Eventos` bigint(21) DEFAULT NULL,
  `Asiste` decimal(25,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `NombreCategoria` varchar(200) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `EdadRangoMin` int(11) NOT NULL COMMENT 'Edad Minima para Categoria',
  `EdadRangoMax` int(11) NOT NULL COMMENT 'Edad Maxima para Categoria',
  `EstadoCivil` enum('Soltero','Casado','Union Libre','Viudo') NOT NULL,
  `Hijos` tinyint(1) NOT NULL COMMENT 'Requiere hijos para Categoria',
  `EdadHijoRangoMin` int(11) NOT NULL COMMENT 'Edad Minima Referencia Hijo Mayor',
  `EdadHijoRangoMax` int(11) NOT NULL COMMENT 'Edad Maxima Referencia Hijo Mayor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `evento`
--

CREATE TABLE `evento` (
  `idEvento` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `FechaEvento` date NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `TomarAsistencia` tinyint(1) NOT NULL,
  `Estado` enum('Creado','Abierto','Cerrado') NOT NULL,
  `Filtro` enum('Todos','Hombres','Mujeres') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grupo`
--

CREATE TABLE `grupo` (
  `idGrupo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Categoría` int(11) NOT NULL,
  `idLider1` int(11) NOT NULL,
  `idLider2` int(11) NOT NULL,
  `logo_filename` varchar(50) NOT NULL,
  `logo_filepath` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hijos`
--

CREATE TABLE `hijos` (
  `idHijo` int(11) NOT NULL,
  `Nombre` int(11) NOT NULL,
  `Apellido` int(11) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Genero` enum('Masculino','Femenino') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `microcelula`
--

CREATE TABLE `microcelula` (
  `idGrupo` int(11) NOT NULL,
  `idMicrocelula` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `idColider1` int(11) NOT NULL,
  `idColider2` int(11) NOT NULL,
  `idApoyo01` int(11) NOT NULL,
  `idApoyo02` int(11) NOT NULL,
  `idApoyo03` int(11) NOT NULL,
  `idApoyo04` int(11) NOT NULL,
  `idApoyo05` int(11) NOT NULL,
  `idApoyo06` int(11) NOT NULL,
  `idApoyo07` int(11) NOT NULL,
  `idApoyo08` int(11) NOT NULL,
  `idApoyo09` int(11) NOT NULL,
  `idApoyo10` int(11) NOT NULL,
  `idApoyo11` int(11) NOT NULL,
  `idApoyo12` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notificacion`
--

CREATE TABLE `notificacion` (
  `idNotificacion` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `FechaEvento` date NOT NULL,
  `Mensaje` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `idPersona` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `idMicrocelula` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `DocumentoTipo` enum('Cedula','Pasaporte','Tarjeta Identidad') NOT NULL,
  `DocumentoNo` varchar(50) NOT NULL,
  `Genero` enum('Masculino','Femenino') NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Direccion` varchar(50) NOT NULL,
  `TelefonoMovil` varchar(20) NOT NULL,
  `TelefonoResidencia` varchar(20) NOT NULL,
  `TelefonoOficina` varchar(20) NOT NULL,
  `EstadoCivil` enum('Soltero','Union Libre','Casado','Viudo') CHARACTER SET utf8 COLLATE utf8_esperanto_ci NOT NULL,
  `idConyugue` int(11) NOT NULL,
  `FechaMatrimonio` date NOT NULL,
  `Profesion` varchar(50) NOT NULL,
  `FechaIngreso` date NOT NULL,
  `Habilidades` set('Musica','Manualidades','ApoyoSocial','Niños','DinamicasGrupo','Decoracion','RedesSociales') NOT NULL,
  `foto_filename` varchar(50) NOT NULL,
  `foto_filepath` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `idMicrocelula` int(11) NOT NULL,
  `TipoUsuario` enum('Asistente','Apoyo','Microlider','Lider','Admin') NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`idEvento`);

--
-- Indexes for table `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idGrupo`);

--
-- Indexes for table `hijos`
--
ALTER TABLE `hijos`
  ADD PRIMARY KEY (`idHijo`);

--
-- Indexes for table `microcelula`
--
ALTER TABLE `microcelula`
  ADD PRIMARY KEY (`idMicrocelula`);

--
-- Indexes for table `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`idNotificacion`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idPersona`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evento`
--
ALTER TABLE `evento`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `grupo`
--
ALTER TABLE `grupo`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `hijos`
--
ALTER TABLE `hijos`
  MODIFY `idHijo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `microcelula`
--
ALTER TABLE `microcelula`
  MODIFY `idMicrocelula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `idNotificacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `persona`
--
ALTER TABLE `persona`
  MODIFY `idPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
