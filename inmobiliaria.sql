-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-06-2024 a las 04:28:42
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `motivo` varchar(50) NOT NULL,
  `lugar` varchar(50) NOT NULL,
  `id_cliente` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `fecha`, `hora`, `motivo`, `lugar`, `id_cliente`) VALUES
(1, '2020-07-07', '09:30:00', 'Visita del piso de Alicante', 'Alicante 2.0', 1),
(2, '2023-04-24', '12:45:00', 'Visita inmueble', 'Campo', 5),
(3, '2027-06-25', '19:10:00', 'Firma de documentos', 'Oficina', 2),
(4, '2024-04-01', '17:30:00', 'Visita inmueble', 'Granada centro', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `nombre_usuario` varchar(15) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `telefono1` varchar(12) NOT NULL,
  `telefono2` varchar(12) DEFAULT NULL,
  `pass` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `nombre_usuario`, `apellidos`, `direccion`, `telefono1`, `telefono2`, `pass`) VALUES
(0, 'admin', 'admin', 'principal', 'calle 0', 'telefono0', 'telefono0.0', 'c3284d0f94606de1fd2af172aba15bf3'),
(1, 'cliente1', 'cliente1', 'apellidos1', 'calle1', 'telefono1', 'telefono1.1', 'fedcdfaf1e48b725f13db1298ce5635a'),
(2, 'cliente2', 'cliente2', 'apellidos2', 'calle2', 'telefono2', 'telefono2.2', 'd2a5e7e8f45a5f9c98d077e514b67917'),
(3, 'cliente3', 'cliente3', 'apellidos3', 'calle3', 'telefono3', 'telefono3.3', 'a3fa958ee4d258191ee78931ccbae171'),
(4, 'cliente4', 'cliente4', 'apellidos4', 'calle4', 'telefono4', 'telefono4.4', '45f86c4528271e476eed08650d0504ba'),
(5, 'cliente5', 'cliente5', 'apellidos4', 'calle5', 'telefono5', 'telefono5.5', '614a02db887f23eb1805fae1b4778a64'),
(6, 'cliente6', 'cliente6', 'apellidos6', 'calle6', 'telefono6', '', 'add603f0faef55121e5cd8c38176a574');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles`
--

CREATE TABLE `inmuebles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio` float(9,2) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `id_cliente` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inmuebles`
--

INSERT INTO `inmuebles` (`id`, `direccion`, `descripcion`, `precio`, `imagen`, `id_cliente`) VALUES
(1, 'campo, 123', 'Apartado de la ciudad, disfrutarás de la naturaleza.', 150000.00, 'campo.jpg', 2),
(2, 'valencia', 'Con garaje accesible', 7300000.00, 'valencia.jpg', NULL),
(3, 'Calle principal', 'Grande, luminosa y espaciosa', 300000.00, 'cristaleras.jpg', 2),
(4, 'Centro', 'Un estudio perfecto para ti!', 450000.00, 'estudio.jpg', NULL),
(5, 'calle 5', 'En el centro de Madrid disfrutarás al completo de la ciudad', 1250000.00, 'madrid.jpg', NULL),
(6, 'costa', 'Con grandes vistas al mar', 8450000.00, 'mar.jpg', 5),
(7, 'calle 7', 'Inmueble con los últimos acabados. lista para vivir!', 6584000.00, 'moderna.jpg', 1),
(8, 'Calle Alicante', 'Inmueble en Alicante.', 65000.00, 'alicante.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titular` varchar(20) NOT NULL,
  `contenido` text NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titular`, `contenido`, `imagen`, `fecha`) VALUES
(1, 'Nuestra inmobiliaria', 'Gracias a todo nuestro equipo hemos podido disponer de los mejores inmuebles de cada zona!', 'confianza.jpg', '2023-07-10'),
(2, 'Sold Out!', 'Hemos logrado un record en nuestra empresa!!\r\nPero no te preocupes, que no pensamos parar ahoar!', 'estudios.jpg', '2024-05-28'),
(3, 'Nuevos eventos!', 'Cada semana elegimos uno de nuestros inmuebles para dedicar un día de puertas abiertas.', 'eventos.jpg', '2024-02-28'),
(4, 'Nueva app', 'Con nuestras nuevas aplicaciones podrás estar al día de todos nuestras actualizaciones!', 'palmano.jpg', '2024-12-31'),
(5, 'Guau! Vendida!', 'Cuenta con los espacios abiertos y zonas clave para que tus mascotas también disfruten su nueva vida.', 'paratodalafamilia.jpg', '2024-04-17'),
(6, 'Veraneo', 'Gran variedad de inmuebles para tu pisito de verano', 'piscina.jpg', '2024-08-07'),
(7, '¿Dónde estoy?', 'Algunos de nuestros inmuebles se encuentran en las zonas más ruidosas de la ciudad, pero cada uno de ellos dispone de su aislamiento y zonas comunes dedicadas al descanso y ocio', 'ruido.jpg', '2019-11-07'),
(8, 'Casetas!', 'También disponemos de una gran variedad de casetas para mascotas y una colaboración con PetShow, donde podrás adquirir cualquier detalle que tu mascota necesite!', 'traecaseta.jpg', '2022-02-28'),
(9, 'Peculiarrrr', 'Hasta los más desfavorecidos inmuebles consiguen destacar sus mayores encanos.', 'encantada.jpg', '2024-02-16');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_cit_cli` (`id_cliente`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_inm_cli` (`id_cliente`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_cit_cli` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD CONSTRAINT `fk_inm_cli` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
