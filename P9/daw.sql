-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2026 a las 20:34:56
-- Versión del servidor: 10.11.16-MariaDB
-- Versión de PHP: 8.3.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `daw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `IdAnuncio` int(11) NOT NULL,
  `TAnuncio` tinyint(4) NOT NULL,
  `TVivienda` tinyint(4) NOT NULL,
  `FPrincipal` text NOT NULL,
  `Alternativo` varchar(255) NOT NULL,
  `Titulo` text NOT NULL,
  `Precio` float NOT NULL,
  `Texto` text NOT NULL,
  `Ciudad` text NOT NULL,
  `Pais` int(11) NOT NULL,
  `Superficie` float NOT NULL,
  `NHabitaciones` int(11) NOT NULL,
  `NBanyos` int(11) NOT NULL,
  `Planta` int(11) NOT NULL,
  `Anyo` int(11) NOT NULL,
  `FRegistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Usuario` int(11) NOT NULL
) ;

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`IdAnuncio`, `TAnuncio`, `TVivienda`, `FPrincipal`, `Alternativo`, `Titulo`, `Precio`, `Texto`, `Ciudad`, `Pais`, `Superficie`, `NHabitaciones`, `NBanyos`, `Planta`, `Anyo`, `FRegistro`, `Usuario`) VALUES
(1, 1, 1, 'img/foto1.jpg', 'Piso en Alicante', 'Piso en Alicante', 225000, 'Amplio piso en Alicante con buena iluminación natural, terraza y todos los servicios cercanos.', 'Alicante', 1, 95, 3, 2, 3, 2008, '2026-11-25 18:53:06', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilos`
--

CREATE TABLE `estilos` (
  `IdEstilo` int(11) NOT NULL,
  `Nombre` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Fichero` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `estilos`
--

INSERT INTO `estilos` (`IdEstilo`, `Nombre`, `Descripcion`, `Fichero`) VALUES
(1, 'Modo oscuro', 'Colores oscuros y reducción de brillo', './css/noche.css'),
(2, 'Por defecto', 'Modo por defecto de la página', './css/global.css'),
(3, 'Texto grande', 'El texto de la página es más grande', './css/grande.css'),
(4, 'Alto contraste', 'Colores que contrastan entre ellos para facilitar la correcta visualización de la página', './css/contraste.css'),
(5, 'Contraste grande', 'Combinación de los Estilos \"Alto contraste\" y \"Grande\"', './css/contrasteGrande.css');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `IdFoto` int(11) NOT NULL,
  `Titulo` text NOT NULL,
  `Foto` text NOT NULL,
  `Alternativo` int(255) NOT NULL,
  `Anuncio` int(11) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `IdMensaje` int(11) NOT NULL,
  `TMensaje` tinyint(4) NOT NULL,
  `Texto` text NOT NULL,
  `Anuncio` int(11) NOT NULL,
  `UsuOrigen` int(11) NOT NULL,
  `UsuDestino` int(11) NOT NULL,
  `FRegistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `IdPais` int(11) NOT NULL,
  `NomPais` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`IdPais`, `NomPais`) VALUES
(1, 'España'),
(2, 'Mongolia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `IdSolicitud` int(11) NOT NULL,
  `Anuncio` int(11) NOT NULL,
  `Texto` text NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Email` varchar(254) NOT NULL,
  `Direccion` text NOT NULL,
  `Telefono` text NOT NULL,
  `Color` text NOT NULL,
  `Copias` int(11) NOT NULL,
  `Resolucion` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Icolor` tinyint(1) NOT NULL,
  `IPrecio` tinyint(1) NOT NULL,
  `FRegistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Coste` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposanuncios`
--

CREATE TABLE `tiposanuncios` (
  `IdTAnuncio` tinyint(4) NOT NULL,
  `NomTAnuncio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tiposanuncios`
--

INSERT INTO `tiposanuncios` (`IdTAnuncio`, `NomTAnuncio`) VALUES
(1, 'Venta'),
(2, 'Alquiler');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposmensajes`
--

CREATE TABLE `tiposmensajes` (
  `IdTMensaje` tinyint(4) NOT NULL,
  `NomTMensaje` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposviviendas`
--

CREATE TABLE `tiposviviendas` (
  `IdTVivienda` tinyint(4) NOT NULL,
  `NomTVivienda` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tiposviviendas`
--

INSERT INTO `tiposviviendas` (`IdTVivienda`, `NomTVivienda`) VALUES
(1, 'Piso'),
(2, 'Apartamento'),
(3, 'Bungalow');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `NomUsuario` varchar(15) NOT NULL,
  `Clave` varchar(15) NOT NULL,
  `Email` varchar(254) NOT NULL,
  `Sexo` tinyint(4) NOT NULL,
  `FNacimiento` date NOT NULL,
  `Ciudad` text NOT NULL,
  `Pais` int(11) NOT NULL,
  `Foto` text NOT NULL,
  `FRegistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Estilo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `NomUsuario`, `Clave`, `Email`, `Sexo`, `FNacimiento`, `Ciudad`, `Pais`, `Foto`, `FRegistro`, `Estilo`) VALUES
(3, 'aitor', 'aitor', 'aitor@gmail.com', 0, '2006-09-08', 'Alicante', 1, '', '2026-11-24 14:18:33', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`IdAnuncio`),
  ADD KEY `TAnuncio` (`TAnuncio`),
  ADD KEY `TVivienda` (`TVivienda`),
  ADD KEY `Pais` (`Pais`),
  ADD KEY `Usuario` (`Usuario`);

--
-- Indices de la tabla `estilos`
--
ALTER TABLE `estilos`
  ADD PRIMARY KEY (`IdEstilo`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`IdFoto`),
  ADD KEY `Anuncio` (`Anuncio`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`IdMensaje`),
  ADD KEY `TMensaje` (`TMensaje`),
  ADD KEY `Anuncio` (`Anuncio`),
  ADD KEY `UsuOrigen` (`UsuOrigen`),
  ADD KEY `UsuDestino` (`UsuDestino`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`IdPais`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`IdSolicitud`),
  ADD KEY `Anuncio` (`Anuncio`);

--
-- Indices de la tabla `tiposanuncios`
--
ALTER TABLE `tiposanuncios`
  ADD PRIMARY KEY (`IdTAnuncio`);

--
-- Indices de la tabla `tiposmensajes`
--
ALTER TABLE `tiposmensajes`
  ADD PRIMARY KEY (`IdTMensaje`);

--
-- Indices de la tabla `tiposviviendas`
--
ALTER TABLE `tiposviviendas`
  ADD PRIMARY KEY (`IdTVivienda`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD UNIQUE KEY `NomUsuario` (`NomUsuario`),
  ADD KEY `Pais` (`Pais`),
  ADD KEY `Estilo` (`Estilo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `IdAnuncio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estilos`
--
ALTER TABLE `estilos`
  MODIFY `IdEstilo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `IdFoto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `IdMensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `IdPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `IdSolicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiposanuncios`
--
ALTER TABLE `tiposanuncios`
  MODIFY `IdTAnuncio` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tiposmensajes`
--
ALTER TABLE `tiposmensajes`
  MODIFY `IdTMensaje` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiposviviendas`
--
ALTER TABLE `tiposviviendas`
  MODIFY `IdTVivienda` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `anuncios_ibfk_1` FOREIGN KEY (`TAnuncio`) REFERENCES `tiposanuncios` (`IdTAnuncio`),
  ADD CONSTRAINT `anuncios_ibfk_2` FOREIGN KEY (`TVivienda`) REFERENCES `tiposviviendas` (`IdTVivienda`),
  ADD CONSTRAINT `anuncios_ibfk_3` FOREIGN KEY (`Pais`) REFERENCES `paises` (`IdPais`),
  ADD CONSTRAINT `anuncios_ibfk_4` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`IdUsuario`);

--
-- Filtros para la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`Anuncio`) REFERENCES `anuncios` (`IdAnuncio`);

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`TMensaje`) REFERENCES `tiposmensajes` (`IdTMensaje`),
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`Anuncio`) REFERENCES `anuncios` (`IdAnuncio`),
  ADD CONSTRAINT `mensajes_ibfk_3` FOREIGN KEY (`UsuOrigen`) REFERENCES `usuarios` (`IdUsuario`),
  ADD CONSTRAINT `mensajes_ibfk_4` FOREIGN KEY (`UsuDestino`) REFERENCES `usuarios` (`IdUsuario`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`Anuncio`) REFERENCES `anuncios` (`IdAnuncio`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Pais`) REFERENCES `paises` (`IdPais`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`Estilo`) REFERENCES `estilos` (`IdEstilo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
