-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-03-2022 a las 15:39:31
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_appvisitbarcelona`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_direccion`
--

CREATE TABLE `tbl_direccion` (
  `id_di` int(11) NOT NULL,
  `direccion_di` varchar(150) CHARACTER SET utf8mb4 DEFAULT NULL,
  `latitud_di` decimal(16,14) DEFAULT NULL,
  `longitud_di` decimal(16,14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_direccion`
--

INSERT INTO `tbl_direccion` (`id_di`, `direccion_di`, `latitud_di`, `longitud_di`) VALUES
(1, 'Avinguda de la Granvia de l’Hospitalet, 75, 08908 L\'Hospitalet de Llobregat, Barcelona', '41.35900000000000', '2.13000000000000'),
(3, 'Carrer de Calafell, 21, 08850 Gavà, Barcelona', '41.26600000000000', '2.00900000000000'),
(4, 'Carrer del Dr. Aiguader, 1X, 08003 Barcelona', '41.38240463970294', '2.18579911515072'),
(5, 'Parc de la Ciutadella, s/n, 08003 Barcelona', '41.38702802640444', '2.18460802648461'),
(6, 'Ronda de San Pere', '41.38887421024607', '2.17281937271737');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_etiqueta`
--

CREATE TABLE `tbl_etiqueta` (
  `id_et` int(11) NOT NULL,
  `etiqueta_et` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_etiqueta`
--

INSERT INTO `tbl_etiqueta` (`id_et`, `etiqueta_et`) VALUES
(1, 'Hotel'),
(2, 'Restaurante'),
(3, 'Bar'),
(4, 'Museo'),
(5, 'Discoteca'),
(6, 'Centro comercial'),
(8, 'Transporte-Metro'),
(9, 'Transporte-Bus'),
(11, 'Iglesia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_foto`
--

CREATE TABLE `tbl_foto` (
  `id_fo` int(11) NOT NULL,
  `foto_fo` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_foto`
--

INSERT INTO `tbl_foto` (`id_fo`, `foto_fo`) VALUES
(1, 'museu_martorell_de_geologia.jpg'),
(2, 'barceloneta.png'),
(3, 'urquinaona.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_icono`
--

CREATE TABLE `tbl_icono` (
  `id_ic` int(11) NOT NULL,
  `tipo_icono_ic` varchar(60) DEFAULT NULL,
  `path_ic` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_icono`
--

INSERT INTO `tbl_icono` (`id_ic`, `tipo_icono_ic`, `path_ic`) VALUES
(1, 'Metro', 'train-subway-solid.svg'),
(2, 'Museo', 'museum.svg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_lugar`
--

CREATE TABLE `tbl_lugar` (
  `id_lu` int(11) NOT NULL,
  `nombre_lu` varchar(100) DEFAULT NULL,
  `descripcion_lu` text DEFAULT NULL,
  `id_foto_fk` int(11) DEFAULT NULL,
  `id_direccion_fk` int(11) DEFAULT NULL,
  `id_etiqueta_fk` int(11) DEFAULT NULL,
  `id_icono_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_lugar`
--

INSERT INTO `tbl_lugar` (`id_lu`, `nombre_lu`, `descripcion_lu`, `id_foto_fk`, `id_direccion_fk`, `id_etiqueta_fk`, `id_icono_fk`) VALUES
(3, 'Metro Barceloneta', NULL, 2, 4, 8, 1),
(4, 'Museo Martorell', NULL, 1, 5, 4, 2),
(5, 'Metro Urquinaona', NULL, 3, 6, 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_lugar_tags_favs`
--

CREATE TABLE `tbl_lugar_tags_favs` (
  `id_lt` int(11) NOT NULL,
  `id_usuario_fk` int(11) DEFAULT NULL,
  `id_lugar_fk` int(11) DEFAULT NULL,
  `id_tag_fk` int(11) DEFAULT NULL,
  `fav_lt` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_lugar_tags_favs`
--

INSERT INTO `tbl_lugar_tags_favs` (`id_lt`, `id_usuario_fk`, `id_lugar_fk`, `id_tag_fk`, `fav_lt`) VALUES
(1, 1, 4, 2, 1),
(3, 2, 4, 2, 0),
(4, 1, 5, 1, 1),
(5, 1, 3, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rol_us`
--

CREATE TABLE `tbl_rol_us` (
  `id_ro` int(11) NOT NULL,
  `rol_ro` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_rol_us`
--

INSERT INTO `tbl_rol_us` (`id_ro`, `rol_ro`) VALUES
(1, 'admin'),
(2, 'customer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tag`
--

CREATE TABLE `tbl_tag` (
  `id_ta` int(11) NOT NULL,
  `tag_ta` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_tag`
--

INSERT INTO `tbl_tag` (`id_ta`, `tag_ta`) VALUES
(1, 'Tiempo libre'),
(2, 'Capricho');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_us` int(11) NOT NULL,
  `nombre_us` varchar(60) DEFAULT NULL,
  `apellido1_us` varchar(60) DEFAULT NULL,
  `apellido2_us` varchar(60) DEFAULT NULL,
  `email_us` varchar(50) DEFAULT NULL,
  `pass_us` varchar(30) DEFAULT NULL,
  `id_rol_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_us`, `nombre_us`, `apellido1_us`, `apellido2_us`, `email_us`, `pass_us`, `id_rol_fk`) VALUES
(1, 'Alfredo', 'Blum', 'Torres', 'blum@app.net', 'qwe123', 2),
(2, 'Jean Pierre', 'Blum', 'Torres', 'jblum@app.net', 'asd1233', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_direccion`
--
ALTER TABLE `tbl_direccion`
  ADD PRIMARY KEY (`id_di`);

--
-- Indices de la tabla `tbl_etiqueta`
--
ALTER TABLE `tbl_etiqueta`
  ADD PRIMARY KEY (`id_et`);

--
-- Indices de la tabla `tbl_foto`
--
ALTER TABLE `tbl_foto`
  ADD PRIMARY KEY (`id_fo`);

--
-- Indices de la tabla `tbl_icono`
--
ALTER TABLE `tbl_icono`
  ADD PRIMARY KEY (`id_ic`);

--
-- Indices de la tabla `tbl_lugar`
--
ALTER TABLE `tbl_lugar`
  ADD PRIMARY KEY (`id_lu`),
  ADD KEY `fk_lugar_foto_idx` (`id_foto_fk`),
  ADD KEY `fk_lugar_direccion_idx` (`id_direccion_fk`),
  ADD KEY `fk_lugar_etiqueta_idx` (`id_etiqueta_fk`),
  ADD KEY `fk_lugar_icono_idx` (`id_icono_fk`);

--
-- Indices de la tabla `tbl_lugar_tags_favs`
--
ALTER TABLE `tbl_lugar_tags_favs`
  ADD PRIMARY KEY (`id_lt`),
  ADD KEY `fk_lugar_fav_usuario_idx` (`id_usuario_fk`),
  ADD KEY `fk_lugar_fav_lugar_idx` (`id_lugar_fk`),
  ADD KEY `fk_lugar_tags_tag_idx` (`id_tag_fk`);

--
-- Indices de la tabla `tbl_rol_us`
--
ALTER TABLE `tbl_rol_us`
  ADD PRIMARY KEY (`id_ro`);

--
-- Indices de la tabla `tbl_tag`
--
ALTER TABLE `tbl_tag`
  ADD PRIMARY KEY (`id_ta`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_us`),
  ADD KEY `fk_usuario_rol_idx` (`id_rol_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_direccion`
--
ALTER TABLE `tbl_direccion`
  MODIFY `id_di` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_etiqueta`
--
ALTER TABLE `tbl_etiqueta`
  MODIFY `id_et` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tbl_foto`
--
ALTER TABLE `tbl_foto`
  MODIFY `id_fo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_icono`
--
ALTER TABLE `tbl_icono`
  MODIFY `id_ic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_lugar`
--
ALTER TABLE `tbl_lugar`
  MODIFY `id_lu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_lugar_tags_favs`
--
ALTER TABLE `tbl_lugar_tags_favs`
  MODIFY `id_lt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_rol_us`
--
ALTER TABLE `tbl_rol_us`
  MODIFY `id_ro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_tag`
--
ALTER TABLE `tbl_tag`
  MODIFY `id_ta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_us` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_lugar`
--
ALTER TABLE `tbl_lugar`
  ADD CONSTRAINT `fk_lugar_direccion` FOREIGN KEY (`id_direccion_fk`) REFERENCES `tbl_direccion` (`id_di`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lugar_etiqueta` FOREIGN KEY (`id_etiqueta_fk`) REFERENCES `tbl_etiqueta` (`id_et`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lugar_foto` FOREIGN KEY (`id_foto_fk`) REFERENCES `tbl_foto` (`id_fo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lugar_icono` FOREIGN KEY (`id_icono_fk`) REFERENCES `tbl_icono` (`id_ic`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_lugar_tags_favs`
--
ALTER TABLE `tbl_lugar_tags_favs`
  ADD CONSTRAINT `fk_lugar_tags_lugar` FOREIGN KEY (`id_lugar_fk`) REFERENCES `tbl_lugar` (`id_lu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lugar_tags_tag` FOREIGN KEY (`id_tag_fk`) REFERENCES `tbl_tag` (`id_ta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lugar_tags_usuario` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_us`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`id_rol_fk`) REFERENCES `tbl_rol_us` (`id_ro`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
