-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-02-2019 a las 12:53:05
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
  `pkfield` int(11) NOT NULL AUTO_INCREMENT,
  `LimiteEventosDashboard` int(11) NOT NULL,
  PRIMARY KEY (`pkfield`)
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
  PRIMARY KEY (`idAsistencia`),
  KEY `FKGrupo_idx` (`idGrupo`),
  KEY `FKMicro_idx` (`idMicro`),
  KEY `FKPersona_idx` (`idPersona`),
  KEY `FKEvento_idx` (`idEvento`)
) ENGINE=InnoDB AUTO_INCREMENT=4860 DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`idEvento`),
  KEY `FKGrupo_E_idx` (`idGrupo`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `idGrupo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `idLider1` int(11) DEFAULT NULL,
  `idLider2` int(11) DEFAULT NULL,
  `logo_filename` varchar(50) NOT NULL,
  `logo_filepath` varchar(250) NOT NULL,
  PRIMARY KEY (`idGrupo`),
  KEY `FKLider1_G_idx` (`idLider1`),
  KEY `FKLider2_G_idx` (`idLider2`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hijos`
--

CREATE TABLE IF NOT EXISTS `hijos` (
  `idHijo` int(11) NOT NULL AUTO_INCREMENT,
  `idPersPadre` int(11) NOT NULL,
  `idPersMadre` int(11) NOT NULL,
  `Nombre` int(11) NOT NULL,
  `Apellido` int(11) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Genero` enum('Masculino','Femenino') NOT NULL,
  PRIMARY KEY (`idHijo`),
  KEY `FKPadre_idx` (`idPersPadre`),
  KEY `FKMadre_idx` (`idPersMadre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logcambios`
--

CREATE TABLE IF NOT EXISTS `logcambios` (
  `idLog` int(11) NOT NULL,
  `FechaLog` datetime NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `TablaNombre` varchar(50) NOT NULL,
  `CampoNombre` varchar(50) NOT NULL,
  `TipoCambio` enum('Insercion','Modificacion','Eliminacion') NOT NULL,
  `ValorOriginal` varchar(200) NOT NULL,
  `ValorNuevo` varchar(200) NOT NULL,
  `LlavePrimaria` varchar(200) NOT NULL,
  PRIMARY KEY (`idLog`),
  KEY `FKUsuario_L_idx` (`idUsuario`)
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
  `TipoMicro` enum('Normal','Nuevos','Inactivos') NOT NULL,
  `idColider1` int(11) DEFAULT NULL,
  `idColider2` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMicrocelula`),
  KEY `FKGrupo_M` (`idGrupo`),
  KEY `FKColider1_idx` (`idColider1`),
  KEY `FK_Colider2_M_idx` (`idColider2`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`idNovedad`),
  KEY `FKPersona_idx` (`idPersona`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Tabla de Novedades de microlider y lideres';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `idPersona` int(11) NOT NULL AUTO_INCREMENT,
  `idGrupo` int(11) NOT NULL,
  `idMicrocelula` int(11) DEFAULT NULL,
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
  PRIMARY KEY (`idPersona`),
  KEY `FKGrupo_P_idx` (`idGrupo`),
  KEY `FKMicro_P_idx` (`idMicrocelula`),
  KEY `FKConyugue_P_idx` (`idPersona`)
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_procesoformacion`
--

CREATE TABLE IF NOT EXISTS `persona_procesoformacion` (
  `persona_idPersona` int(11) NOT NULL,
  `ProcesoFormacion_idProceso` int(11) NOT NULL,
  `FechaFinal` date DEFAULT NULL,
  PRIMARY KEY (`persona_idPersona`,`ProcesoFormacion_idProceso`),
  KEY `fk_persona_has_ProcesoFormacion_ProcesoFormacion1_idx` (`ProcesoFormacion_idProceso`),
  KEY `fk_persona_has_ProcesoFormacion_persona1_idx` (`persona_idPersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesoformacion`
--

CREATE TABLE IF NOT EXISTS `procesoformacion` (
  `idProceso` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Orden` int(11) NOT NULL,
  PRIMARY KEY (`idProceso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `idGrupo` int(11) DEFAULT NULL,
  `TipoUsuario` enum('Asistente','Apoyo','Microlider','Lider','Admin') NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Nombre` text NOT NULL,
  `Apellido` text NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `FKGrupo_U_idx` (`idGrupo`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `FKEvento_A` FOREIGN KEY (`idEvento`) REFERENCES `evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FKGrupo_A` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FKMicro_A` FOREIGN KEY (`idMicro`) REFERENCES `microcelula` (`idMicrocelula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FKPersona_A` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `FKGrupo_E` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `FKLider1_G` FOREIGN KEY (`idLider1`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FKLider2_G` FOREIGN KEY (`idLider2`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `hijos`
--
ALTER TABLE `hijos`
  ADD CONSTRAINT `FKMadre` FOREIGN KEY (`idPersMadre`) REFERENCES `persona` (`idPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FKPadre` FOREIGN KEY (`idPersPadre`) REFERENCES `persona` (`idPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `logcambios`
--
ALTER TABLE `logcambios`
  ADD CONSTRAINT `FKUsuario_L` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `microcelula`
--
ALTER TABLE `microcelula`
  ADD CONSTRAINT `FKColider1_M` FOREIGN KEY (`idColider1`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FKGrupo_M` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Colider2_M` FOREIGN KEY (`idColider2`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `novedad`
--
ALTER TABLE `novedad`
  ADD CONSTRAINT `FKPersona_N` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `FKGrupo_P` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FKMicro_P` FOREIGN KEY (`idMicrocelula`) REFERENCES `microcelula` (`idMicrocelula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona_procesoformacion`
--
ALTER TABLE `persona_procesoformacion`
  ADD CONSTRAINT `FKPersona_Proceso` FOREIGN KEY (`persona_idPersona`) REFERENCES `persona` (`idPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FKProceso_Persona` FOREIGN KEY (`ProcesoFormacion_idProceso`) REFERENCES `procesoformacion` (`idProceso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FKGrupo_U` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
