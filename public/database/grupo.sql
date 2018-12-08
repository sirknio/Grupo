-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 08-12-2018 a las 14:50:03
-- Versión del servidor: 5.7.17-log
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `grupo`
--
CREATE DATABASE IF NOT EXISTS `grupo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `grupo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aplicacion`
--

CREATE TABLE IF NOT EXISTS `aplicacion` (
  `pkfield` int(11) NOT NULL,
  `LimiteEventosDashboard` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE IF NOT EXISTS `asistencia` (
  `idAsistencia` int(11) NOT NULL AUTO_INCREMENT,
  `idEvento` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `idMicro` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL,
  `FechaEvento` date NOT NULL,
  `Asiste` tinyint(1) NOT NULL,
  `Observaciones` varchar(150) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `DocumentoNo` varchar(50) NOT NULL,
  PRIMARY KEY (`idAsistencia`)
) ENGINE=InnoDB AUTO_INCREMENT=4677 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `idEvento` int(11) NOT NULL AUTO_INCREMENT,
  `idGrupo` int(11) NOT NULL,
  `FechaEvento` date NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `TomarAsistencia` tinyint(1) NOT NULL,
  `Estado` enum('Creado','Abierto','Cerrado') NOT NULL,
  `Filtro` enum('Todos','Hombres','Mujeres') NOT NULL,
  PRIMARY KEY (`idEvento`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `idGrupo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Categoría` int(11) NOT NULL,
  `idLider1` int(11) NOT NULL,
  `idLider2` int(11) NOT NULL,
  `logo_filename` varchar(50) NOT NULL,
  `logo_filepath` varchar(250) NOT NULL,
  PRIMARY KEY (`idGrupo`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hijos`
--

CREATE TABLE IF NOT EXISTS `hijos` (
  `idHijo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` int(11) NOT NULL,
  `Apellido` int(11) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Genero` enum('Masculino','Femenino') NOT NULL,
  PRIMARY KEY (`idHijo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `microcelula`
--

CREATE TABLE IF NOT EXISTS `microcelula` (
  `idGrupo` int(11) NOT NULL,
  `idMicrocelula` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `MicroInactivos` int(11) NOT NULL,
  `MicroNuevos` int(11) NOT NULL,
  PRIMARY KEY (`idMicrocelula`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE IF NOT EXISTS `notificacion` (
  `idNotificacion` int(11) NOT NULL AUTO_INCREMENT,
  `idEvento` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `FechaEvento` date NOT NULL,
  `Mensaje` varchar(250) NOT NULL,
  PRIMARY KEY (`idNotificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedad`
--

CREATE TABLE IF NOT EXISTS `novedad` (
  `idNovedad` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` int(11) NOT NULL,
  `Novedad` text NOT NULL,
  `ImportanteUrgente` tinyint(4) NOT NULL,
  `ReportaUsuario` varchar(100) NOT NULL,
  `ReportaFecha` datetime NOT NULL,
  PRIMARY KEY (`idNovedad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla de Novedades de microlider y lideres';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `idPersona` int(11) NOT NULL AUTO_INCREMENT,
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
  `foto_filepath` varchar(250) NOT NULL,
  PRIMARY KEY (`idPersona`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `TipoUsuario` enum('Asistente','Apoyo','Microlider','Lider','Admin') NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Nombre` text NOT NULL,
  `Apellido` text NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
