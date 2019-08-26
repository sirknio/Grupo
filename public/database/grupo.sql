-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-08-2019 a las 01:57:46
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

CREATE TABLE `aplicacion` (
  `pkfield` int(11) NOT NULL,
  `LimiteEventosDashboard` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `aplicacion`
--

INSERT INTO `aplicacion` (`pkfield`, `LimiteEventosDashboard`) VALUES
(0, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `idAsistencia` int(11) NOT NULL,
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
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `idEvento` int(11) NOT NULL,
  `idGrupo` int(11) DEFAULT NULL,
  `FechaEvento` date NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `TomarAsistencia` tinyint(1) NOT NULL,
  `Estado` enum('Creado','Abierto','Cerrado') NOT NULL,
  `Filtro` enum('Todos','Hombres','Mujeres') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `idGrupo` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `idLider1` int(11) DEFAULT NULL,
  `idLider2` int(11) DEFAULT NULL,
  `logo_filename` varchar(50) NOT NULL,
  `logo_filepath` varchar(250) NOT NULL,
  `TipoGrupo` enum('Parejas','Solteros') NOT NULL,
  `EdadMinima` int(11) DEFAULT NULL,
  `EdadMaxima` int(11) DEFAULT NULL,
  `EstadoCivil` set('Soltero','Union Libre','Casado','Viudo','Divorciado') DEFAULT NULL,
  `Genero` enum('Todos','Hombres','Mujeres') DEFAULT NULL,
  `CantidadHijos` int(11) DEFAULT NULL,
  `EdadMinHijoMayor` int(11) DEFAULT NULL,
  `EdadMaxHijoMayor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hijos`
--

CREATE TABLE `hijos` (
  `idHijo` int(11) NOT NULL,
  `idPersPadre` int(11) NOT NULL,
  `idPersMadre` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Genero` enum('Masculino','Femenino') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logcambios`
--

CREATE TABLE `logcambios` (
  `idLog` int(11) NOT NULL,
  `FechaLog` datetime NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `idGrupo` int(11) DEFAULT NULL,
  `GrupoNombre` varchar(200) DEFAULT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `TipoUsuario` enum('Asistente','Apoyo','Microlider','Lider','Admin') NOT NULL,
  `TablaNombre` varchar(50) NOT NULL,
  `TipoCambio` enum('Insercion','Modificacion','Eliminacion','Acceso') NOT NULL,
  `ValorOriginal` varchar(1000) NOT NULL,
  `ValorNuevo` varchar(1000) NOT NULL,
  `LlavePrimaria` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `microcelula`
--

CREATE TABLE `microcelula` (
  `idGrupo` int(11) NOT NULL,
  `idMicrocelula` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `TipoMicro` enum('Normal','Nuevos','Inactivos') NOT NULL,
  `idColider1` int(11) DEFAULT NULL,
  `idColider2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedad`
--

CREATE TABLE `novedad` (
  `idNovedad` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `Novedad` text NOT NULL,
  `ImportanteUrgente` tinyint(4) NOT NULL,
  `ReportaUsuario` varchar(100) NOT NULL,
  `ReportaFecha` datetime NOT NULL,
  `LeidoLider` tinyint(1) DEFAULT NULL,
  `LeidoMicro` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla de Novedades de microlider y lideres';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idPersona` int(11) NOT NULL,
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
  `EstadoCivil` enum('Soltero','Union Libre','Casado','Viudo','Divorciado') CHARACTER SET utf8 COLLATE utf8_esperanto_ci NOT NULL,
  `idConyugue` int(11) NOT NULL,
  `FechaMatrimonio` date NOT NULL,
  `Profesion` varchar(50) NOT NULL,
  `FechaIngreso` date NOT NULL,
  `Habilidades` set('Musica','Manualidades','Apoyo Social','Niños','Dinamicas Grupo','Decoracion','Redes Sociales') NOT NULL,
  `ProcesoFormacion` set('Encuentro','Pasos','Nivel 1','Nivel 2','Nivel 3','Conquistadores','Santificacion','Servicio','Berea','Ananías','Semillero') NOT NULL,
  `foto_filename` varchar(50) NOT NULL,
  `foto_filepath` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `idGrupo` int(11) DEFAULT NULL,
  `TipoUsuario` enum('Asistente','Apoyo','Microlider','Lider','Admin') NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `idGrupo`, `TipoUsuario`, `Usuario`, `Nombre`, `Apellido`, `Password`, `Email`) VALUES
(1, NULL, 'Admin', 'admin', 'Carlos', 'Arboleda', '0c7540eb7e65b553ec1ba6b20de79608', 'admin@admin.com'),

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aplicacion`
--
ALTER TABLE `aplicacion`
  ADD PRIMARY KEY (`pkfield`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`idAsistencia`),
  ADD KEY `FKGrupo_idx` (`idGrupo`),
  ADD KEY `FKMicro_idx` (`idMicro`),
  ADD KEY `FKPersona_idx` (`idPersona`),
  ADD KEY `FKEvento_idx` (`idEvento`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`idEvento`),
  ADD KEY `FKGrupo_E_idx` (`idGrupo`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idGrupo`),
  ADD KEY `FKLider1_G_idx` (`idLider1`),
  ADD KEY `FKLider2_G_idx` (`idLider2`);

--
-- Indices de la tabla `hijos`
--
ALTER TABLE `hijos`
  ADD PRIMARY KEY (`idHijo`),
  ADD KEY `FKPadre_idx` (`idPersPadre`),
  ADD KEY `FKMadre_idx` (`idPersMadre`);

--
-- Indices de la tabla `logcambios`
--
ALTER TABLE `logcambios`
  ADD PRIMARY KEY (`idLog`),
  ADD KEY `FKUsuario_L_idx` (`idUsuario`),
  ADD KEY `FKGrupo_L_idx` (`idGrupo`);

--
-- Indices de la tabla `microcelula`
--
ALTER TABLE `microcelula`
  ADD PRIMARY KEY (`idMicrocelula`),
  ADD KEY `FKGrupo_M` (`idGrupo`),
  ADD KEY `FKColider1_idx` (`idColider1`),
  ADD KEY `FK_Colider2_M_idx` (`idColider2`);

--
-- Indices de la tabla `novedad`
--
ALTER TABLE `novedad`
  ADD PRIMARY KEY (`idNovedad`),
  ADD KEY `FKPersona_idx` (`idPersona`),
  ADD KEY `FKGrupo_N_idx` (`idGrupo`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idPersona`),
  ADD KEY `FKGrupo_P_idx` (`idGrupo`),
  ADD KEY `FKMicro_P_idx` (`idMicrocelula`),
  ADD KEY `FKConyugue_P_idx` (`idPersona`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `FKGrupo_U_idx` (`idGrupo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aplicacion`
--
ALTER TABLE `aplicacion`
  MODIFY `pkfield` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `idAsistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5031;
--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT de la tabla `hijos`
--
ALTER TABLE `hijos`
  MODIFY `idHijo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `logcambios`
--
ALTER TABLE `logcambios`
  MODIFY `idLog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=899;
--
-- AUTO_INCREMENT de la tabla `microcelula`
--
ALTER TABLE `microcelula`
  MODIFY `idMicrocelula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `novedad`
--
ALTER TABLE `novedad`
  MODIFY `idNovedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
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
  ADD CONSTRAINT `FKGrupo_L` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
  ADD CONSTRAINT `FKGrupo_N` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FKPersona_N` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `FKGrupo_P` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FKMicro_P` FOREIGN KEY (`idMicrocelula`) REFERENCES `microcelula` (`idMicrocelula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FKGrupo_U` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
