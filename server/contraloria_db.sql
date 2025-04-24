-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-04-2025 a las 00:47:27
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
-- Base de datos: `contraloria_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bienes`
--

CREATE TABLE `bienes` (
  `id` varchar(36) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `withdrawalDate` date NOT NULL,
  `approvalDate` date NOT NULL DEFAULT current_timestamp(),
  `requestDate` date NOT NULL,
  `responsible` int(11) NOT NULL,
  `comments` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bienes`
--

INSERT INTO `bienes` (`id`, `name`, `type`, `description`, `withdrawalDate`, `approvalDate`, `requestDate`, `responsible`, `comments`) VALUES
('bNXfSOOwBs', 'Impresora', 'Electronico', 'Epson', '2025-04-20', '2025-04-20', '2025-04-20', 26, 'Urgente'),
('xovgQhhZJV', 'Mouse', 'Electronico', 'Inalambrico', '0000-00-00', '2025-04-21', '2025-04-21', 26, 'pls');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `message` varchar(100) NOT NULL,
  `id_solicitud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `sender`, `receiver`, `type`, `message`, `id_solicitud`) VALUES
(26, 25, 26, 2, 'Aprobo tu solicitud de Impresora', 0),
(28, 25, 26, 2, 'Aprobo tu solicitud de Mouse', 0),
(29, 26, 25, 1, 'Solicito un nuevo bien', 104),
(32, 25, 26, 2, 'Rechazo tu solicitud de Computadora Laptop', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta_seguridad`
--

CREATE TABLE `pregunta_seguridad` (
  `id` int(11) NOT NULL,
  `pregunta1` varchar(100) NOT NULL,
  `pregunta2` varchar(100) NOT NULL,
  `pregunta3` varchar(100) NOT NULL,
  `respuesta1` varchar(100) NOT NULL,
  `respuesta2` varchar(100) NOT NULL,
  `respuesta3` varchar(100) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta_seguridad`
--

INSERT INTO `pregunta_seguridad` (`id`, `pregunta1`, `pregunta2`, `pregunta3`, `respuesta1`, `respuesta2`, `respuesta3`, `id_usuario`) VALUES
(12, '¿Cual es el apellido de tu abuelo?', '¿Cuál es su deporte favorito?', '¿Cómo se llamaba tu mamá?', 'Mata', 'Futbol', 'Roxalin', 25),
(13, '¿Qué color le gusta más?', '¿Cuál es tu comida favorita?', '¿Cómo se llamaba tu mamá?', 'verde', 'pizza', 'roxalin', 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `n_solicitud` int(11) NOT NULL,
  `bien` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `comentario` varchar(100) NOT NULL,
  `comentario_admin` varchar(100) NOT NULL,
  `tipo_bien` varchar(100) NOT NULL,
  `fecha_solicitud` date NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL,
  `aprobado` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`n_solicitud`, `bien`, `descripcion`, `comentario`, `comentario_admin`, `tipo_bien`, `fecha_solicitud`, `id_usuario`, `aprobado`) VALUES
(102, 'Impresora', 'Epson', 'Urgente', '', 'Electronico', '2025-04-20', 26, 1),
(103, 'Mouse', 'Inalambrico', 'pls', '', 'Electronico', '2025-04-21', 26, 1),
(104, 'Silla', 'De oficina', 'Lo mas pronto posible', '', 'Mueble', '2025-04-21', 26, 0),
(106, 'Computadora Laptop', 'Min 8GB ram, 500GB Disco duro', 'necesario', 'No disponible actualmente', 'Electronico', '2025-04-21', 26, -1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `n_dependencia` int(11) NOT NULL,
  `nombre_dependencia` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `cedula` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`n_dependencia`, `nombre_dependencia`, `contrasena`, `username`, `nombre`, `apellido`, `correo`, `cedula`, `admin`) VALUES
(25, 'Informatica', '$2y$10$OsDzTQkmSA9Wfh/JfApoM.9YyXN1wgMkcZypFouS4e1IQRojygWVm', 'Alexander', 'Javier', 'Garcia', 'atam2005gm@gmail.com', 31533126, 1),
(26, 'Contaduria', '$2y$10$vrYzkSUgtuwJWI7W..NkHuttLj460FgUJyI7CppnYO/w9IxY5Ige2', 'Javier2005', 'Javier', 'Garcia', 'javieragm27@outlook.es', 31533126, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bienes`
--
ALTER TABLE `bienes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pregunta_seguridad`
--
ALTER TABLE `pregunta_seguridad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`n_solicitud`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`n_dependencia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `pregunta_seguridad`
--
ALTER TABLE `pregunta_seguridad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `n_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `n_dependencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
