-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-09-2026 a las 01:01:45
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gruas_24_7`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gruas`
--

CREATE TABLE `gruas` (
  `id` int(11) NOT NULL,
  `placa` varchar(20) NOT NULL,
  `conductor` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `ubicacion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gruas`
--

INSERT INTO `gruas` (`id`, `placa`, `conductor`, `telefono`, `estado`, `ubicacion`) VALUES
(4, 'AB5678', 'Antonio', '6678-2020', 'Disponible', 'La Chorrera'),
(6, 'AD2345', 'Ricardo', '6410-8090', 'En Transito', 'Arraijan'),
(8, 'AA9999', 'Toño', '6000-1234', 'En Transito', 'panama');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(30) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `password`, `rol`, `fecha_creacion`) VALUES
(1, 'fernando', 'fernandoantonio2552@gmail.com', '$2y$10$uTXtSGd/JF5r.oex7hVmsenE8/Qss1Eq.s9Dmqxw.Bp3oz2TEhrdi', 'usuario', '2026-09-11 21:54:54');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `gruas`
--
ALTER TABLE `gruas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `placa` (`placa`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `gruas`
--
ALTER TABLE `gruas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
