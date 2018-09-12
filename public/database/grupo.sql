-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 12-09-2018 a las 03:51:55
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aplicacion`
--

CREATE TABLE `aplicacion` (
  `pkfield` int(11) NOT NULL,
  `LimiteEventosDashboard` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `idGrupo` int(11) NOT NULL,
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
-- Estructura de tabla para la tabla `hijos`
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
-- Estructura de tabla para la tabla `microcelula`
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
-- Estructura de tabla para la tabla `notificacion`
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
-- Estructura de tabla para la tabla `persona`
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
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL,
  `TipoUsuario` enum('Asistente','Apoyo','Microlider','Lider','Admin') NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Nombre` text NOT NULL,
  `Apellido` text NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`idAsistencia`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`idEvento`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idGrupo`);

--
-- Indices de la tabla `hijos`
--
ALTER TABLE `hijos`
  ADD PRIMARY KEY (`idHijo`);

--
-- Indices de la tabla `microcelula`
--
ALTER TABLE `microcelula`
  ADD PRIMARY KEY (`idMicrocelula`);

--
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`idNotificacion`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idPersona`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `idAsistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4019;
--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `hijos`
--
ALTER TABLE `hijos`
  MODIFY `idHijo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `microcelula`
--
ALTER TABLE `microcelula`
  MODIFY `idMicrocelula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `idNotificacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
