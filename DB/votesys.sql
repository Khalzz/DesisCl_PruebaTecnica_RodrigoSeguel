-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-02-2023 a las 20:52:32
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `votesys`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidato`
--

CREATE TABLE `candidato` (
  `rut` int(11) NOT NULL,
  `nombre_completo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `candidato`
--

INSERT INTO `candidato` (`rut`, `nombre_completo`) VALUES
(12345678, 'Diego'),
(23456789, 'Camila'),
(34567890, 'Felipe'),
(45678901, 'Isabella'),
(56789012, 'Matías'),
(67890123, 'Valentina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

CREATE TABLE `comuna` (
  `id_comuna` int(11) NOT NULL,
  `nombre_comuna` varchar(50) DEFAULT NULL,
  `id_region` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`id_comuna`, `nombre_comuna`, `id_region`) VALUES
(1101, 'Iquique', 1),
(1102, 'Alto Hospicio', 1),
(1103, 'Pozo Almonte', 1),
(2101, 'Antofagasta', 2),
(2102, 'Mejillones', 2),
(2103, 'Calama', 2),
(3101, 'Copiapo', 3),
(3102, 'Tierra Amarilla', 3),
(3103, 'Chanaral', 3),
(4101, 'La Serena', 4),
(4102, 'Coquimbo', 4),
(4103, 'Illapel', 4),
(5101, 'Valparaiso', 5),
(5102, 'Vina del Mar', 5),
(5103, 'Quilpue', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `id_region` int(11) NOT NULL,
  `nombre_region` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`id_region`, `nombre_region`) VALUES
(1, 'Tarapacá'),
(2, 'Antofagasta'),
(3, 'Atacama'),
(4, 'Coquimbo'),
(5, 'Valparaiso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votante`
--

CREATE TABLE `votante` (
  `rut` varchar(11) NOT NULL,
  `nombre_completo` varchar(100) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_comuna` int(11) DEFAULT NULL,
  `id_region` int(11) DEFAULT NULL,
  `rut_candidato` int(11) DEFAULT NULL,
  `conocido_por` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `votante`
--

INSERT INTO `votante` (`rut`, `nombre_completo`, `alias`, `email`, `id_comuna`, `id_region`, `rut_candidato`, `conocido_por`) VALUES
('21257282-9', 'Rodrigo Seguel', 'Rodrigo123', 'fearushb@gmail.com', 2102, 2, 23456789, 'Web,Tv');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `candidato`
--
ALTER TABLE `candidato`
  ADD PRIMARY KEY (`rut`);

--
-- Indices de la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD PRIMARY KEY (`id_comuna`),
  ADD KEY `id_region` (`id_region`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id_region`);

--
-- Indices de la tabla `votante`
--
ALTER TABLE `votante`
  ADD PRIMARY KEY (`rut`),
  ADD KEY `id_comuna` (`id_comuna`),
  ADD KEY `id_region` (`id_region`),
  ADD KEY `rut_candidato` (`rut_candidato`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD CONSTRAINT `comuna_ibfk_1` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`);

--
-- Filtros para la tabla `votante`
--
ALTER TABLE `votante`
  ADD CONSTRAINT `votante_ibfk_1` FOREIGN KEY (`id_comuna`) REFERENCES `comuna` (`id_comuna`),
  ADD CONSTRAINT `votante_ibfk_2` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`),
  ADD CONSTRAINT `votante_ibfk_3` FOREIGN KEY (`rut_candidato`) REFERENCES `candidato` (`rut`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
