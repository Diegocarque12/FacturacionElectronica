-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2021 a las 03:26:47
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `facturacr21`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id_documento` int(11) NOT NULL,
  `consecutivo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_documento` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_seguridad` int(8) NOT NULL,
  `fecha` datetime NOT NULL,
  `emisor_cedula` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `emisor_nombre` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `emisor_tipo` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `emisor_comercial` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `emisor_id_provincia` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `emisor_id_canton` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `emisor_id_distrito` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `emisor_id_barrio` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `emisor_otras_senas` varchar(160) COLLATE utf8_spanish_ci NOT NULL,
  `emisor_cod` int(3) NOT NULL,
  `emisor_telefono` int(20) NOT NULL,
  `emisor_correo` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `receptor_nombre` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `receptor_cedula` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `receptor_tipo` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `receptor_comercial` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `receptor_id_provincia` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `receptor_id_canton` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `receptor_id_distrito` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `receptor_id_barrio` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `receptor_otras_senas` varchar(160) COLLATE utf8_spanish_ci NOT NULL,
  `receptor_cod` int(3) NOT NULL,
  `receptor_telefono` int(20) NOT NULL,
  `receptor_correo` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `condicion_venta` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `plazo_credito` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `medio_pago` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `moneda` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_cambio` decimal(18,5) NOT NULL,
  `servicios_gravados` decimal(18,5) NOT NULL,
  `servicios_exentos` decimal(18,5) NOT NULL,
  `servicios_exonerados` decimal(18,5) NOT NULL,
  `mercancias_gravadas` decimal(18,5) NOT NULL,
  `mercancias_exentas` decimal(18,5) NOT NULL,
  `mercancias_exoneradas` decimal(18,5) NOT NULL,
  `total_gravado` decimal(18,5) NOT NULL,
  `total_exento` decimal(18,5) NOT NULL,
  `total_exonerado` decimal(18,5) NOT NULL,
  `total_venta` decimal(18,5) NOT NULL,
  `total_descuentos` decimal(18,5) NOT NULL,
  `total_venta_neta` decimal(18,5) NOT NULL,
  `total_impuestos` decimal(18,5) NOT NULL,
  `total_comprobante` decimal(18,5) NOT NULL,
  `notas` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `envio_atv` int(1) NOT NULL,
  `valido_atv` int(1) NOT NULL,
  `fecha_envio` datetime DEFAULT NULL,
  `fecha_valido` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id_documento`, `consecutivo`, `tipo_documento`, `clave`, `codigo_seguridad`, `fecha`, `emisor_cedula`, `emisor_nombre`, `emisor_tipo`, `emisor_comercial`, `emisor_id_provincia`, `emisor_id_canton`, `emisor_id_distrito`, `emisor_id_barrio`, `emisor_otras_senas`, `emisor_cod`, `emisor_telefono`, `emisor_correo`, `receptor_nombre`, `receptor_cedula`, `receptor_tipo`, `receptor_comercial`, `receptor_id_provincia`, `receptor_id_canton`, `receptor_id_distrito`, `receptor_id_barrio`, `receptor_otras_senas`, `receptor_cod`, `receptor_telefono`, `receptor_correo`, `condicion_venta`, `plazo_credito`, `medio_pago`, `moneda`, `tipo_cambio`, `servicios_gravados`, `servicios_exentos`, `servicios_exonerados`, `mercancias_gravadas`, `mercancias_exentas`, `mercancias_exoneradas`, `total_gravado`, `total_exento`, `total_exonerado`, `total_venta`, `total_descuentos`, `total_venta_neta`, `total_impuestos`, `total_comprobante`, `notas`, `id_usuario`, `envio_atv`, `valido_atv`, `fecha_envio`, `fecha_valido`) VALUES
(1, '00100002010000000157', '01', '50604052100040216065300100002010000000157185037692', 85037692, '2021-05-04 17:02:31', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '7602.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '7602.00000', '0.00000', '0.00000', '7602.00000', '228.06000', '7373.94000', '958.61220', '8332.55220', '', 1, 0, 0, NULL, NULL),
(2, '00100002010000000158', '01', '50604052100040216065300100002010000000158115723890', 15723890, '2021-05-04 17:03:42', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '7602.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '7602.00000', '0.00000', '0.00000', '7602.00000', '228.06000', '7373.94000', '958.61220', '8332.55220', '', 1, 0, 0, NULL, NULL),
(3, '00100002010000000159', '01', '50604052100040216065300100002010000000159161874092', 61874092, '2021-05-04 17:03:54', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '7602.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '7602.00000', '0.00000', '0.00000', '7602.00000', '228.06000', '7373.94000', '958.61220', '8332.55220', '', 1, 0, 0, NULL, NULL),
(4, '00100002010000000164', '01', '50604052100040216065300100002010000000164178943561', 78943561, '2021-05-04 17:36:34', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '500.00000', '0.00000', '0.00000', '500.00000', '0.00000', '0.00000', '500.00000', '0.00000', '500.00000', '65.00000', '565.00000', '', 1, 0, 0, NULL, NULL),
(5, '00100002010000000165', '01', '50604052100040216065300100002010000000165191604273', 91604273, '2021-05-04 17:40:30', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '500.00000', '0.00000', '0.00000', '500.00000', '0.00000', '0.00000', '500.00000', '0.00000', '500.00000', '65.00000', '565.00000', '', 1, 0, 0, NULL, NULL),
(6, '00100002010000000166', '01', '50604052100040216065300100002010000000166190562473', 90562473, '2021-05-04 17:45:07', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '500.00000', '0.00000', '0.00000', '500.00000', '0.00000', '0.00000', '500.00000', '0.00000', '500.00000', '65.00000', '565.00000', '', 1, 0, 0, NULL, NULL),
(7, '00100002010000000167', '01', '50604052100040216065300100002010000000167160927514', 60927514, '2021-05-04 17:51:24', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(8, '00100002010000000168', '01', '50604052100040216065300100002010000000168137618049', 37618049, '2021-05-04 17:52:34', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(9, '00100002010000000169', '01', '50604052100040216065300100002010000000169169087435', 69087435, '2021-05-04 17:53:02', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(10, '00100002010000000170', '01', '50604052100040216065300100002010000000170135281794', 35281794, '2021-05-04 17:53:32', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(11, '00100002010000000171', '01', '50604052100040216065300100002010000000171147208156', 47208156, '2021-05-04 17:53:56', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(12, '00100002010000000172', '01', '50604052100040216065300100002010000000172150841369', 50841369, '2021-05-04 17:55:18', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(13, '00100002010000000173', '01', '50604052100040216065300100002010000000173169057214', 69057214, '2021-05-04 17:57:06', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(14, '00100002010000000174', '01', '50604052100040216065300100002010000000174172806154', 72806154, '2021-05-04 17:58:57', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(15, '00100002010000000175', '01', '50604052100040216065300100002010000000175180263751', 80263751, '2021-05-04 17:59:19', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(16, '00100002010000000176', '01', '50604052100040216065300100002010000000176160732894', 60732894, '2021-05-04 17:59:59', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(17, '00100002010000000177', '01', '50604052100040216065300100002010000000177183765241', 83765241, '2021-05-04 18:01:19', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(18, '00100002010000000178', '01', '50604052100040216065300100002010000000178126947381', 26947381, '2021-05-04 18:02:01', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(19, '00100002010000000179', '01', '50604052100040216065300100002010000000179145372019', 45372019, '2021-05-04 18:03:37', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(20, '00100002010000000180', '01', '50604052100040216065300100002010000000180150387214', 50387214, '2021-05-04 18:04:46', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(21, '00100002010000000181', '01', '50604052100040216065300100002010000000181134962017', 34962017, '2021-05-04 18:05:48', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(22, '00100002010000000182', '01', '50604052100040216065300100002010000000182113256908', 13256908, '2021-05-04 18:08:27', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(23, '00100002010000000183', '01', '50604052100040216065300100002010000000183128139764', 28139764, '2021-05-04 18:10:13', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'jrodriguez081192@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(24, '00100002010000000184', '01', '50604052100040216065300100002010000000184192458710', 92458710, '2021-05-04 18:11:55', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'diegocarque1213@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(25, '00100002010000000185', '01', '50604052100040216065300100002010000000185139706485', 39706485, '2021-05-04 18:16:49', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'diegocarque1213@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(26, '00100002010000000186', '01', '50604052100040216065300100002010000000186150416793', 50416793, '2021-05-04 18:18:06', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'diegocarque1213@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(27, '00100002010000000187', '01', '50604052100040216065300100002010000000187193267184', 93267184, '2021-05-04 18:18:51', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'diegocarque1213@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(28, '00100002010000000188', '01', '50604052100040216065300100002010000000188170562143', 70562143, '2021-05-04 18:20:49', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'diegocarque1213@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(29, '00100003010000000189', '01', '50604052100040216065300100003010000000189127183954', 27183954, '2021-05-04 18:21:44', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'diegocarque1213@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(30, '00100003010000000190', '01', '50604052100040216065300100003010000000190194516307', 94516307, '2021-05-04 18:23:40', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'diegocarque1213@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(31, '00100003010000000191', '01', '50604052100040216065300100003010000000191156879041', 56879041, '2021-05-04 18:24:04', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'diegocarque1213@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(32, '00100003010000000192', '01', '50604052100040216065300100003010000000192159184276', 59184276, '2021-05-04 18:25:10', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'diegocarque1213@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'jrodriguez081192@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(33, '00100003010000000193', '01', '50604052100040216065300100003010000000193112830976', 12830976, '2021-05-04 18:27:27', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'diegocarque1213@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'diegocarque1213@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL),
(34, '00100003010000000194', '01', '50604052100040216065300100003010000000194170542381', 70542381, '2021-05-04 18:27:44', '402160653', 'Joseph Rodriguez Roman', '01', 'Joseph Rodriguez Roman', '4', '2', '2', '5', 'La maquina', 506, 88888888, 'diegocarque1213@gmail.com', 'Taller Gonzáles S.A', '3101143237', '02', 'Taller Gonzáles S.A', '2', '1', '13', '5', '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 506, 24874310, 'diegocarque1213@gmail.com', '01', '0', '01', 'CRC', '611.08000', '0.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '0.00000', '100.00000', '0.00000', '100.00000', '13.00000', '113.00000', '', 1, 0, 0, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_documento`),
  ADD UNIQUE KEY `clave` (`clave`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
