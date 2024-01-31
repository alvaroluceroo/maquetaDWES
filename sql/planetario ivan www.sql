-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2024 a las 13:23:01
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `planetario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetos`
--

CREATE TABLE `objetos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `distancia` decimal(6,2) NOT NULL,
  `tipo_id` int(2) NOT NULL,
  `user_id` int(6) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `objetos`
--

INSERT INTO `objetos` (`id`, `nombre`, `distancia`, `tipo_id`, `user_id`, `fecha`) VALUES
(11, 'Mercurio', 77.30, 2, 1, '2024-01-08 12:21:52'),
(12, 'Venus', 40.20, 2, 1, '2024-01-08 12:21:52'),
(13, 'Marte', 54.60, 2, 1, '2024-01-08 12:21:52'),
(14, 'Júpiter', 588.50, 1, 1, '2024-01-08 12:21:52'),
(15, 'Saturno', 1.00, 1, 1, '2024-01-08 12:21:52'),
(16, 'Urano', 2.00, 1, 1, '2024-01-08 12:21:52'),
(17, 'Neptuno', 4.00, 1, 1, '2024-01-08 12:21:52'),
(18, 'Luna (satélite de la Tierra)', 0.38, 2, 1, '2024-01-08 12:21:52'),
(19, 'Ganímedes (satélite de Júpiter)', 628.30, 2, 1, '2024-01-08 12:21:52'),
(20, 'Titán (satélite de Saturno)', 1.00, 2, 1, '2024-01-08 12:21:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obj_tax`
--

CREATE TABLE `obj_tax` (
  `id` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `id_child` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `nombre`) VALUES
(1, 'Gaseoso'),
(2, 'Rocoso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nick` varchar(15) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nick`, `pwd`, `nombre`, `apellido1`, `apellido2`, `email`, `telefono`, `fecha_alta`, `fecha`) VALUES
(1, 'Karl', 'kkk123', 'Karla', 'Gonzalez', 'Castro', 'kkk@gmail.com', '666666666', '2024-01-08 13:19:58', '2024-01-08 12:20:38');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `objetos`
--
ALTER TABLE `objetos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_id` (`tipo_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `obj_tax`
--
ALTER TABLE `obj_tax`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_parent` (`id_parent`),
  ADD KEY `id_child` (`id_child`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `objetos`
--
ALTER TABLE `objetos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `obj_tax`
--
ALTER TABLE `obj_tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `objetos`
--
ALTER TABLE `objetos`
  ADD CONSTRAINT `objetos_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tipos` (`id`),
  ADD CONSTRAINT `objetos_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `obj_tax`
--
ALTER TABLE `obj_tax`
  ADD CONSTRAINT `obj_tax_ibfk_1` FOREIGN KEY (`id_parent`) REFERENCES `objetos` (`id`),
  ADD CONSTRAINT `obj_tax_ibfk_2` FOREIGN KEY (`id_child`) REFERENCES `objetos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
