-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2024 a las 14:31:30
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
-- Base de datos: `proyectos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `socio` bigint(20) UNSIGNED NOT NULL,
  `proyecto` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `texto` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`socio`, `proyecto`, `fecha`, `texto`) VALUES
(1, 2, '2022-03-21', 'Esta proyecto está muy bn.'),
(1, 5, '2022-03-21', 'Esta proyecto está muy bn.'),
(2, 5, '2023-03-21', 'Esta proyecto está muy bn.'),
(5, 1, '2022-02-20', 'Que la fuerza te acompañe!'),
(5, 3, '2022-02-20', 'Increible Película !!'),
(5, 5, '2022-02-20', 'Esta proyecto siempre sorprende...'),
(6, 1, '2022-02-20', 'Mi saga fav'),
(6, 5, '2022-02-20', 'Demasiado amarillos...'),
(6, 7, '2014-11-10', 'No está ni mal :))'),
(7, 7, '2024-02-04', 'Me encanta esta película!!!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muestras`
--

CREATE TABLE `muestras` (
  `proyecto` bigint(20) UNSIGNED NOT NULL,
  `campo` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `muestras`
--

INSERT INTO `muestras` (`proyecto`, `campo`, `fecha`) VALUES
(1, 1, '2021-12-23'),
(1, 2, '2022-01-25'),
(1, 3, '2022-02-16'),
(1, 5, '2024-06-03'),
(2, 1, '2022-01-28'),
(2, 3, '2022-01-22'),
(3, 1, '2022-02-09'),
(3, 2, '2022-01-19'),
(4, 1, '2022-02-01'),
(5, 1, '2022-02-16'),
(5, 2, '2022-03-15'),
(5, 3, '2021-12-17'),
(6, 1, '2023-07-10'),
(6, 2, '2021-12-21'),
(6, 3, '2022-02-10'),
(6, 5, '2023-07-10'),
(7, 2, '2022-07-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campos`
--

CREATE TABLE `campos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(55) NOT NULL,
  `activo` set('0','1') NOT NULL,
  `logotipo` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `campos`
--

INSERT INTO `campos` (`id`, `nombre`, `activo`, `logotipo`) VALUES
(1, 'Netflix', '1', '1.jpg'),
(2, 'HBO', '1', '2.png'),
(3, 'Disney +', '1', '3.png'),
(4, 'Prime Video', '1', '4.png'),
(5, 'Movistar+', '1', '5.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `foto` varchar(55) NOT NULL,
  `activo` set('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `nombre`, `descripcion`, `foto`, `activo`) VALUES
(1, 'Star Wars', 'Ambientada treinta años antes que \"La guerra de las galaxias\" (1977), muestra la infancia de Darth Vader, el pasado de Obi-Wan Kenobi y el resurgimiento de los Sith, los caballeros Jedi dominados por el Lado Oscuro. La Federación de Comercio ha bloqueado el pequeño planeta de Naboo, gobernado por la joven Reina Amidala; se trata de un plan ideado por Sith Darth Sidious, que, manteniéndose en el anonimato, dirige a los neimoidianos, que están al mando de la Federación. El Jedi Qui-Gon Jinn y su aprendiz Obi-Wan Kenobi convencen a Amidala para que vaya a Coruscant, la capital de la República y sede del Consejo Jedi, y trate de neutralizar esta amenaza. Pero, al intentar esquivar el bloqueo, la nave real resulta averiada, viéndose así obligada la tripulación a aterrizar en el desértico y remoto planeta de Tatooine... ', '1.jpg', '0'),
(2, 'Canta 2', 'Buster Moon y sus amigos deben persuadir a la estrella del rock Clay Calloway para que se una a ellos en el estreno de un nuevo espectáculo.', '2.jpg', '1'),
(3, 'Al filo del mañana', 'En un futuro no muy lejano, invade la Tierra una raza de extraterrestres invencibles. Al Comandante William Cage (Tom Cruise), un oficial que nunca ha entrado en combate, le encargan una misión casi suicida y resulta muerto. Entra entonces en un bucle temporal, en el que se ve obligado a luchar y morir una y otra vez. Pero las múltiples batallas que libra lo hacen cada vez más hábil y eficaz en su lucha contra los alienígenas. Su compañera de combate es Rita Vrataski (Emily Blunt), una guerrera de las Fuerzas Especiales. Adaptación del manga de Hiroshi Sakurazaka.', '3.jpg', '1'),
(4, 'Juego de Tronos', 'Primera temporada: 10 episodios. Historia ambientada 172 años \\\"antes de Daenerys Targaryen\\\", y en el noveno año del reinado de Viserys Targaryen (Paddy Considine), un rey cuya línea de sucesión está en peligro. Su esposa Aemma (Sian Brooke) está embarazada, aunque no hay garantía de que dé a luz a un heredero varón. Si no lo hace, entonces el Trono de Hierro recaerá, bien sobre el hermano de Viserys, Daemon, un gobernante impulsivo y potencialmente tiránico (Matt Smith); o bien, rompiendo con la tradición de preferencia del varón, en la hija adolescente de Viserys, Rhaenyra (Milly Alcock), cuyo reclamo del trono está destinado a tener una fuerte oposición.', '4.jpg', '1'),
(5, 'Los Simpsons', 'Una proyecto estadounidense de comedia en formato de animación, creada por Matt Groening para Fox Broadcasting Company y emitida en varios países del mundo. ', '5.jpg', '1'),
(6, 'Vikingos', ' 6 temporadas. 89 episodios. Narra las aventuras del héroe Ragnar Lothbrok, de sus hermanos vikingos y su familia, cuando él se subleva para convertirse en el rey de las tribus vikingas. Además de ser un guerrero valiente, Ragnar encarna las tradiciones nórdicas de la devoción a los dioses. Según la leyenda era descendiente directo del dios Odín.', '6.jpg', '1'),
(7, 'Cómo entrenar a tu dragón', 'Ambientada en el mítico mundo de los rudos vikingos y los dragones salvajes, y basada en el libro infantil de Cressida Cowell, esta comedia de acción narra la historia de Hipo, un vikingo adolescente que no encaja exactamente en la antiquísima reputación de su tribu como cazadores de dragones. El mundo de Hipo se trastoca al encontrar a un dragón que le desafía a él y a sus compañeros vikingos, a ver el mundo desde un punto de vista totalmente diferente.', '7.jpg', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(55) NOT NULL,
  `nick` varchar(55) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `activo` set('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`id`, `nombre`, `nick`, `pass`, `activo`) VALUES
(0, 'Admin', 'admin', '67f43efc5701784db1504e4993d7e393', '1'),
(1, 'Carlos', 'carlos', '371c26ae06024553d45bd1414d384cf2', '0'),
(2, 'Juan', 'juan', 'e843277e68f588cfa4068a5c86f841e6', '0'),
(3, 'Pedro', 'pedro', '04cc34776bddefcb0615a60947463d91', '1'),
(4, 'Matilda', 'matilda', '83e7e2f6beb9e375a42a9aaf0ec01fb1', '1'),
(5, 'Esteban', 'esteban', '763392762c011e27ddfbb5ee9ee3e5aa', '0'),
(6, 'David', 'david', 'cd814a6d704446565a6bd346ff6b9d47', '1'),
(7, 'Estrella', 'estre', '30f49e70e523217fec36da56730b57cc', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`socio`,`proyecto`),
  ADD KEY `ce_coment_proyecto` (`proyecto`);

--
-- Indices de la tabla `muestras`
--
ALTER TABLE `muestras`
  ADD PRIMARY KEY (`proyecto`,`campo`),
  ADD KEY `ce_campoV_plataf` (`campo`);

--
-- Indices de la tabla `campos`
--
ALTER TABLE `campos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `campos`
--
ALTER TABLE `campos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `socios`
--
ALTER TABLE `socios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `ce_coment_proyecto` FOREIGN KEY (`proyecto`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ce_coment_socios` FOREIGN KEY (`socio`) REFERENCES `socios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muestras`
--
ALTER TABLE `muestras`
  ADD CONSTRAINT `ce_campoV_plataf` FOREIGN KEY (`campo`) REFERENCES `campos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ce_campoV_proyectos` FOREIGN KEY (`proyecto`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
