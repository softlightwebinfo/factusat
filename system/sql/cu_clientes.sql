-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-08-2017 a las 18:02:51
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
-- Estructura de tabla para la tabla `cu_clientes`
--

CREATE TABLE `cu_clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `email` varchar(150) NOT NULL,
  `whatsapp` tinyint(4) NOT NULL DEFAULT '0',
  `telefono` text NOT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cu_clientes`
--

INSERT INTO `cu_clientes` (`id`, `nombre`, `dni`, `email`, `whatsapp`, `telefono`, `id_usuario`) VALUES
(1, 'r', '', '', 0, '679273888', 1),
(2, 'RAQUEL SABATER', '', '', 1, '651561397', 2),
(3, 'r', '', '', 0, '670693280', 1),
(4, 'TOMEU ADROVER', '', '', 0, '679273888', 1),
(5, 'a', '', '', 0, '670693280', 1),
(6, 'HOLLIE TAYLOR', '', '', 0, '447538534465', 1),
(7, 'MARIA MONAR', '', '', 0, '636769967', 1),
(9, 'Carlos Tigre', '', '', 0, '670338474', 1),
(10, 'JOSE FLORES', '', '', 0, '649683035', 1),
(11, 'VIRGINIA MARIÑO', '', '', 0, '629691881 649836548', 1),
(12, 'DAVID NUÑEZ', '', '', 0, '687927789', 1),
(13, 'Jaume Ordines', '', '', 0, '620962778', 1),
(14, 'ANTONIA SERRA', '', '', 0, '687967484', 1),
(15, 'FCO JAVIER DE LA CRUZ', '', '', 0, '686117466', 1),
(16, 'Edgar Quinalla', '', '', 0, '687626771', 1),
(17, 'JULIAN VICENS', '', '', 0, '666121579', 1),
(18, 'MIQUEL ROSSELLO', '', '', 0, '600551118', 1),
(19, 'PEDRO LOPEZ', '', '', 0, '696906896', 1),
(20, 'ALBERTO IÑIGO', '', '', 0, '637396223', 1),
(21, 'LETICIA MUÑOZ', '', '', 0, '626533723', 1),
(22, 'CATALINA DAVIU', '', '', 0, '655531365', 1),
(23, 'YAKI ', '', '', 0, '678808846', 1),
(24, 'ANGELA SERVERA', '', '', 0, '609223769', 1),
(25, 'VICTOR RODRIGUEZ', '', '', 0, '633347246', 1),
(26, 'LUIS MARIMON', '', '', 0, '647009131', 1),
(27, 'JOSE ANTONIO', '', '', 0, '601467414', 1),
(28, 'JOSE ANGEL ALVAREZ', '', '', 0, '620274367', 1),
(29, 'ALVARO ', '', '', 0, '971903803', 1),
(30, 'GRANT', '', '', 0, '674219500', 1),
(31, 'MAURICIO DURAN', '', '', 0, '626488530', 2),
(32, 'ALEXANDRE SEGUI', '', '', 0, '669757195', 2),
(33, 'JOSE ACOSTA', '', '', 0, '646322241', 2),
(34, 'Toni Pujol', '', 'tpujolsureda@gmail.com', 0, '699935540', 2),
(35, 'ANDRES ANDRINO', '', '', 0, '649285521', 2),
(36, 'KIKE MARIN', '', '', 0, '675348387', 2),
(37, 'juan', '', '', 0, '971466674', 2),
(38, 'cliente de prueba', '', '', 0, '987456123', 2),
(39, 'MIGUEL BISQUERRA CERON', '', 'inmobiliariabph@gmail.com', 0, '616330536 / 688902956', 2),
(40, 'ALEJANDRO BALBAS PONS', '', 'kuramarz@gmail.com', 1, '606714353 / 661119007', 2),
(41, 'GABRIEL RIERA LOPEZ', '', 'hidan0306@gmail.com', 1, '606796875', 2),
(42, 'GUILLERMO GARAU', '', 'guimariser@hotmail.com', 0, '647255093', 2),
(43, 'ANDRES CARSOMAT', '', '', 0, '629135051', 2),
(44, 'MARIA LUISA ROMANO', '', '', 0, '606829168', 2),
(45, 'LUPE DESPUIG', '', '', 0, '661244290', 2),
(46, 'JULIO FRANCISCO MERCE', '', '', 0, '639358013', 2),
(47, 'CRISTOBAL CAPELLA', '', '.', 0, 'S/N', 2),
(48, 'LUIS JAVIER GOMEZ', '', '', 0, '687688273', 2),
(49, 'ALBERTO MARTIN', '', '', 0, '635037231', 2),
(50, 'AINA TRAVERSO', '', '', 0, '647511050', 2),
(51, 'LUISA VIDAL FERRER', '', '', 0, '670505749', 2),
(52, 'HOUSES AND BOATS', '', '', 0, '679225041', 2),
(53, 'ANTONIO PICORNELL', '', 'a.picornell@movistar.es', 0, '617948405', 2),
(54, 'SANTIAGO HERNANDEZ', '', 'solocam@libero.it', 0, '610091417', 2),
(55, 'Rafa Gonzalez Muñoz', '78222335W', 'codeunic.system@gmail.com', 1, '662223768', 2),
(56, 'r', '', '', 1, '651561397', 2),
(57, 'rafa', '78222335W', 'codeunic.system@gmail.com', 1, '662223768', 2),
(58, 'rafa', '78222335W', 'codeunic.system@gmail.com', 1, '662223768', 2),
(59, 'rafa', '78222335W', 'codeunic.system@gmail.com', 1, '662223768', 2),
(60, 'r', '', '', 1, '651561397', 2),
(61, 'rafa', '78222335W', 'codeunic.system@gmail.com', 1, '662223768', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cu_clientes`
--
ALTER TABLE `cu_clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cu_clientes`
--
ALTER TABLE `cu_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cu_clientes`
--
ALTER TABLE `cu_clientes`
  ADD CONSTRAINT `cu_clientes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `cu_usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
