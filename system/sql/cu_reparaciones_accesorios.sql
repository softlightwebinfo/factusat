-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-08-2017 a las 20:28:04
-- Versión del servidor: 10.1.22-MariaDB
-- Versión de PHP: 7.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cibersat`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cu_reparaciones_accesorios`
--

CREATE TABLE `cu_reparaciones_accesorios` (
  `fk_reparacion` int(11) NOT NULL,
  `fk_accesorio` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cu_reparaciones_accesorios`
--

INSERT INTO `cu_reparaciones_accesorios` (`fk_reparacion`, `fk_accesorio`, `fecha_creacion`) VALUES
(35, 1, '2017-08-14 18:27:08'),
(35, 2, '2017-08-14 18:27:08');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cu_reparaciones_accesorios`
--
ALTER TABLE `cu_reparaciones_accesorios`
  ADD PRIMARY KEY (`fk_reparacion`,`fk_accesorio`),
  ADD KEY `fk_reparacion` (`fk_reparacion`,`fk_accesorio`),
  ADD KEY `fk_accesorio` (`fk_accesorio`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cu_reparaciones_accesorios`
--
ALTER TABLE `cu_reparaciones_accesorios`
  ADD CONSTRAINT `cu_reparaciones_accesorios_ibfk_1` FOREIGN KEY (`fk_reparacion`) REFERENCES `cu_reparaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cu_reparaciones_accesorios_ibfk_2` FOREIGN KEY (`fk_accesorio`) REFERENCES `cu_accesorios` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
