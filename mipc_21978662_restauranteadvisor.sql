-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-05-2018 a las 16:59:47
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mipc_21978662_restauranteadvisor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
(1, 'Cenas'),
(2, 'Comidas'),
(3, 'Desayuno'),
(4, 'Mejores Precios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_restaurante`
--

CREATE TABLE `categoria_restaurante` (
  `restaurante` varchar(30) NOT NULL,
  `categoria` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria_restaurante`
--

INSERT INTO `categoria_restaurante` (`restaurante`, `categoria`) VALUES
('1', 1),
('12', 1),
('13', 1),
('14', 2),
('11', 3),
('32', 1),
('15', 2),
('16', 4),
('33', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_restaurante` int(30) NOT NULL,
  `contenido` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_restaurante`, `contenido`) VALUES
(11, 'Toda la comida es muy buena..¡¡'),
(11, 'Esta quedando muy bien..¡¡'),
(11, 'Buena atencion, la recomiendo.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

CREATE TABLE `restaurantes` (
  `id_restaurante` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apertura` time NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `precio` double NOT NULL,
  `editor` int(11) NOT NULL,
  `portada` int(1) NOT NULL DEFAULT '1',
  `orden_portada` int(2) NOT NULL,
  `descripcion` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`id_restaurante`, `nombre`, `apertura`, `direccion`, `imagen`, `tipo`, `precio`, `editor`, `portada`, `orden_portada`, `descripcion`) VALUES
(1, 'Solos ', '13:00:43', 'Calle de las perdidas', 'img/1.jpg', 'Tailandesa', 30, 1, 1, 0, 'solo pruebaaaa seee\r\n					\" \r\n					\" \r\n					\" \r\n					\" \r\n					\" \r\n					\" \r\n					\" \r\n					\" \r\n					\" \r\n					\" \r\n					'),
(33, 'jajaja', '12:00:00', 'jaj', 'img/jajaja.jpg', 'Mexicana', 25, 2, 0, 0, 'jajaja'),
(11, 'ahora', '11:00:00', 'ahora siiii', 'img/ahora.jpg', 'Española', 15.5, 3, 0, 0, 'xddddd'),
(12, 'sss', '04:05:00', 'sssss', 'img/sss.jpg', 'Italiana', 27.5, 1, 1, 2, 'sssss'),
(13, 'soy', '04:12:00', 'aaxaxaxa', 'img/soy.jpg', 'Inglesa', 35.5, 2, 0, 0, 'hhjkjhjmhjm'),
(14, 'poso', '12:44:00', 'podo', 'img/poso.jpg', 'Americana', 24, 3, 1, 3, 'lplploop'),
(15, 'lol', '12:44:00', 'podo', 'img/poso.jpg', 'Picante', 12, 1, 0, 0, 'lplploop'),
(16, 'casa', '12:44:00', 'podo', 'img/poso.jpg', 'Salada', 33, 2, 1, 0, 'lplploop'),
(32, 'jejejeje', '09:09:00', 'jejejejejfokmsldmflds', 'img/jejejeje.jpg', 'Francesa', 20.5, 3, 0, 0, 'lplplolp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `contrasena` varchar(80) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `perfil` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `login`, `contrasena`, `nombre`, `perfil`) VALUES
(0, 'admin', '$2y$10$MUCamLXglh8wRr27DsyU2OY3SCsGeWlGbUcZUsdYFd1ZYcnAw4Mn6', 'Administrador', 0),
(1, 'editor', '$2y$10$EN44IVOxkLgUszCtT01FMe63DnkNMnNmdfZaKn3crRlTO58dHcNLe', 'Editor', 1),
(2, 'edit2', '$2y$10$9G4D5K0ezoYjvvHXW.DC9urnbKqBpRXQgaiQmHrOpgGajR/AAlEau', 'Editor 2', 1),
(3, 'edit3', '$2y$10$PJxlibFbKmnwboqyMR5oiu3Cz0cRWjFJhPxIIBKCYvzCn1z6sZhHq', 'Editor3', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`id_restaurante`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `id_restaurante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
