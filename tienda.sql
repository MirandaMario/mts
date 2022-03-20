-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 16-06-2020 a las 04:55:03
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `idarticulo` int(11) NOT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `idModelo` int(11) DEFAULT NULL,
  `codigo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(2000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen1` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `porcentaje` tinyint(4) DEFAULT NULL,
  `costoProducto` decimal(10,2) DEFAULT NULL,
  `impuesto` tinyint(1) DEFAULT NULL,
  `impuestodos` tinyint(1) DEFAULT NULL,
  `imagen2` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen3` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen4` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `publicado` tinyint(1) DEFAULT NULL,
  `ver_precio` tinyint(1) DEFAULT NULL,
  `detalles` varchar(2000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descuento_art` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `nombreCategoria` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `condicion` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descuento_cat` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id_miscelanea` int(11) NOT NULL,
  `iva` decimal(4,2) NOT NULL,
  `cesc` decimal(4,2) NOT NULL,
  `impuesto_x` decimal(4,2) NOT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `alias` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nit` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ncr` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `giro` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id_miscelanea`, `iva`, `cesc`, `impuesto_x`, `direccion`, `nombre`, `alias`, `nit`, `ncr`, `giro`) VALUES
(1, '0.13', '0.05', '0.00', 'Col. Prados de venecia 4, Pje 15 #22 Soyapango S.S.', 'Mario Ernesto Miranda Nolasco', 'MMSOFT', '0522-270380-101-4', '265390-3', 'Reparación de computadoras y equipo periférico ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corte`
--

CREATE TABLE `corte` (
  `id_corte` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL,
  `correlativo` int(11) NOT NULL,
  `tipo_corte` tinyint(4) NOT NULL,
  `fecha_ejec` datetime NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `ticket_desde` int(11) NOT NULL,
  `ticket_hasta` int(11) NOT NULL,
  `exentas` decimal(10,2) NOT NULL,
  `no_sujetas` decimal(10,2) NOT NULL,
  `gravadas` decimal(10,2) NOT NULL,
  `devolucion` decimal(10,2) NOT NULL,
  `cantidad_devoluciones` int(11) NOT NULL,
  `total_venta` decimal(10,2) NOT NULL,
  `cantidad_transacciones` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE `cotizacion` (
  `idCotizacion` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idtienda` tinyint(4) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `tipo_comprobante` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `numeroComprobante` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `total_cotizacion` decimal(10,2) NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(1000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descuento` tinyint(4) DEFAULT NULL,
  `validez` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `entrega` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_cliente` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dirigido` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nota` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pago` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `garantia` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Disparadores `cotizacion`
--
DELIMITER $$
CREATE TRIGGER `aumento_correlativo` BEFORE INSERT ON `cotizacion` FOR EACH ROW BEGIN 	
	UPDATE tienda SET  cotizacion = cotizacion + 1
	WHERE tienda.id= NEW.idtienda;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depsv`
--

CREATE TABLE `depsv` (
  `ID` int(11) NOT NULL,
  `DepName` varchar(30) NOT NULL COMMENT 'Nombre del departamento',
  `ISOCode` char(5) NOT NULL COMMENT 'Código ISO Departamentos',
  `ZONESV_ID` int(11) NOT NULL COMMENT 'Zona geográfica del departamento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Departamentos de El Salvador';

--
-- Volcado de datos para la tabla `depsv`
--

INSERT INTO `depsv` (`ID`, `DepName`, `ISOCode`, `ZONESV_ID`) VALUES
(1, 'Ahuachapán', 'SV-AH', 1),
(2, 'Santa Ana', 'SV-SA', 1),
(3, 'Sonsonate', 'SV-SO', 1),
(4, 'La Libertad', 'SV-LI', 2),
(5, 'Chalatenango', 'SV-CH', 2),
(6, 'San Salvador', 'SV-SS', 2),
(7, 'Cuscatlán', 'SV-CU', 3),
(8, 'La Paz', 'SV-PA', 3),
(9, 'Cabañas', 'SV-CA', 3),
(10, 'San Vicente', 'SV-SV', 3),
(11, 'Usulután', 'SV-US', 4),
(12, 'Morazán', 'SV-MO', 4),
(13, 'San Miguel', 'SV-SM', 4),
(14, 'La Unión', 'SV-UN', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cotizacion`
--

CREATE TABLE `detalle_cotizacion` (
  `idDetalleCotizacion` int(11) NOT NULL,
  `idCotizacion` int(11) NOT NULL,
  `idArticulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioVenta` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) DEFAULT NULL,
  `precio_lista` decimal(12,2) NOT NULL,
  `beneficio` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ingreso`
--

CREATE TABLE `detalle_ingreso` (
  `iddetalle_ingreso` int(11) NOT NULL,
  `idingreso` int(11) DEFAULT NULL,
  `idarticulo` int(11) DEFAULT NULL,
  `cantidad` smallint(11) DEFAULT NULL,
  `precio_compra` decimal(7,2) DEFAULT NULL,
  `precio_venta` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Disparadores `detalle_ingreso`
--
DELIMITER $$
CREATE TRIGGER `ioi` BEFORE DELETE ON `detalle_ingreso` FOR EACH ROW BEGIN 	
	UPDATE stocktienda SET stock = stock - OLD.cantidad
	WHERE stocktienda.idarticulo = OLD.idarticulo
    AND stocktienda.idTienda = 1;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_updStockIngreso` AFTER INSERT ON `detalle_ingreso` FOR EACH ROW BEGIN 	
	UPDATE stocktienda SET stock = stock + NEW.cantidad
	WHERE stocktienda.idarticulo = NEW.idarticulo
    AND stocktienda.idTienda = 1;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle_pedido` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `cantidad_items` smallint(6) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `descuento` tinyint(4) DEFAULT NULL,
  `color` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_transferencia`
--

CREATE TABLE `detalle_transferencia` (
  `iddetalle_transferecia` int(11) NOT NULL,
  `id_transferencia` int(11) NOT NULL,
  `idarticulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `origen` int(11) NOT NULL,
  `destino` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Disparadores `detalle_transferencia`
--
DELIMITER $$
CREATE TRIGGER `actualizar_st` BEFORE INSERT ON `detalle_transferencia` FOR EACH ROW BEGIN 	
	UPDATE stocktienda SET stock = stock + NEW.cantidad
	WHERE  stocktienda.idarticulo = NEW.idarticulo
    AND    stocktienda.idTienda = NEW.destino;
    
    UPDATE stocktienda SET stock = stock - NEW.cantidad
	WHERE  stocktienda.idarticulo = NEW.idarticulo
    AND    stocktienda.idTienda = NEW.origen;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `volver_ST` AFTER DELETE ON `detalle_transferencia` FOR EACH ROW BEGIN 	
	UPDATE stocktienda SET stock = stock + OLD.cantidad
	WHERE  stocktienda.idarticulo = OLD.idarticulo
    AND    stocktienda.idTienda = OLD.origen;   
    
    UPDATE stocktienda SET stock = stock - OLD.cantidad
	WHERE  stocktienda.idarticulo = OLD.idarticulo
    AND    stocktienda.idTienda = OLD.destino; 
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `iddetalle_venta` int(11) NOT NULL,
  `idventa` int(11) DEFAULT NULL,
  `idarticulo` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_lista` decimal(12,2) NOT NULL,
  `precio_venta` decimal(10,2) DEFAULT NULL,
  `descuento` tinyint(4) DEFAULT NULL,
  `impuesto` tinyint(1) DEFAULT NULL,
  `impuestodos` tinyint(1) DEFAULT NULL,
  `beneficio` tinyint(4) NOT NULL,
  `origen` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Disparadores `detalle_venta`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockVenta` AFTER INSERT ON `detalle_venta` FOR EACH ROW BEGIN 	
	UPDATE stocktienda SET stock = stock - NEW.cantidad
	WHERE stocktienda.idarticulo = NEW.idarticulo
	AND  stocktienda.idTienda = NEW.origen;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `volver_stock_en_tienda` BEFORE DELETE ON `detalle_venta` FOR EACH ROW BEGIN 	
	UPDATE stocktienda SET stock = stock + OLD.cantidad
	WHERE stocktienda.idarticulo = OLD.idarticulo
    AND  stocktienda.idTienda = OLD.origen;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `Id` tinyint(4) NOT NULL,
  `estado_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`Id`, `estado_nombre`) VALUES
(1, 'Pendiente'),
(2, 'Cancelado'),
(3, 'Despachado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `idingreso` int(11) NOT NULL,
  `idproveedor` int(11) DEFAULT NULL,
  `tipo_comprobante` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `serie_comprobante` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `num_comprobante` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_hora` date DEFAULT NULL,
  `impuesto` decimal(10,0) DEFAULT NULL,
  `total_ingreso` decimal(10,2) DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `idMarca` int(11) NOT NULL,
  `nombreMarca` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `idModelo` int(11) NOT NULL,
  `idMarca` int(11) NOT NULL,
  `nombreModelo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `munsv`
--

CREATE TABLE `munsv` (
  `ID` int(11) NOT NULL,
  `MunName` varchar(100) NOT NULL COMMENT 'Nombre del Municipio',
  `DEPSV_ID` int(11) NOT NULL COMMENT 'Departamento al cual pertenece el municipio'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Municipios de El Salvador';

--
-- Volcado de datos para la tabla `munsv`
--

INSERT INTO `munsv` (`ID`, `MunName`, `DEPSV_ID`) VALUES
(1, 'Ahuachapán', 1),
(2, 'Jujutla', 1),
(3, 'Atiquizaya', 1),
(4, 'Concepción de Ataco', 1),
(5, 'El Refugio', 1),
(6, 'Guaymango', 1),
(7, 'Apaneca', 1),
(8, 'San Francisco Menéndez', 1),
(9, 'San Lorenzo', 1),
(10, 'San Pedro Puxtla', 1),
(11, 'Tacuba', 1),
(12, 'Turín', 1),
(13, 'Candelaria de la Frontera', 2),
(14, 'Chalchuapa', 2),
(15, 'Coatepeque', 2),
(16, 'El Congo', 2),
(17, 'El Porvenir', 2),
(18, 'Masahuat', 2),
(19, 'Metapán', 2),
(20, 'San Antonio Pajonal', 2),
(21, 'San Sebastián Salitrillo', 2),
(22, 'Santa Ana', 2),
(23, 'Santa Rosa Guachipilín', 2),
(24, 'Santiago de la Frontera', 2),
(25, 'Texistepeque', 2),
(26, 'Acajutla', 3),
(27, 'Armenia', 3),
(28, 'Caluco', 3),
(29, 'Cuisnahuat', 3),
(30, 'Izalco', 3),
(31, 'Juayúa', 3),
(32, 'Nahuizalco', 3),
(33, 'Nahulingo', 3),
(34, 'Salcoatitán', 3),
(35, 'San Antonio del Monte', 3),
(36, 'San Julián', 3),
(37, 'Santa Catarina Masahuat', 3),
(38, 'Santa Isabel Ishuatán', 3),
(39, 'Santo Domingo de Guzmán', 3),
(40, 'Sonsonate', 3),
(41, 'Sonzacate', 3),
(42, 'Alegría', 11),
(43, 'Berlín', 11),
(44, 'California', 11),
(45, 'Concepción Batres', 11),
(46, 'El Triunfo', 11),
(47, 'Ereguayquín', 11),
(48, 'Estanzuelas', 11),
(49, 'Jiquilisco', 11),
(50, 'Jucuapa', 11),
(51, 'Jucuarán', 11),
(52, 'Mercedes Umaña', 11),
(53, 'Nueva Granada', 11),
(54, 'Ozatlán', 11),
(55, 'Puerto El Triunfo', 11),
(56, 'San Agustín', 11),
(57, 'San Buenaventura', 11),
(58, 'San Dionisio', 11),
(59, 'San Francisco Javier', 11),
(60, 'Santa Elena', 11),
(61, 'Santa María', 11),
(62, 'Santiago de María', 11),
(63, 'Tecapán', 11),
(64, 'Usulután', 11),
(65, 'Carolina', 13),
(66, 'Chapeltique', 13),
(67, 'Chinameca', 13),
(68, 'Chirilagua', 13),
(69, 'Ciudad Barrios', 13),
(70, 'Comacarán', 13),
(71, 'El Tránsito', 13),
(72, 'Lolotique', 13),
(73, 'Moncagua', 13),
(74, 'Nueva Guadalupe', 13),
(75, 'Nuevo Edén de San Juan', 13),
(76, 'Quelepa', 13),
(77, 'San Antonio del Mosco', 13),
(78, 'San Gerardo', 13),
(79, 'San Jorge', 13),
(80, 'San Luis de la Reina', 13),
(81, 'San Miguel', 13),
(82, 'San Rafael Oriente', 13),
(83, 'Sesori', 13),
(84, 'Uluazapa', 13),
(85, 'Arambala', 12),
(86, 'Cacaopera', 12),
(87, 'Chilanga', 12),
(88, 'Corinto', 12),
(89, 'Delicias de Concepción', 12),
(90, 'El Divisadero', 12),
(91, 'El Rosario (Morazán)', 12),
(92, 'Gualococti', 12),
(93, 'Guatajiagua', 12),
(94, 'Joateca', 12),
(95, 'Jocoaitique', 12),
(96, 'Jocoro', 12),
(97, 'Lolotiquillo', 12),
(98, 'Meanguera', 12),
(99, 'Osicala', 12),
(100, 'Perquín', 12),
(101, 'San Carlos', 12),
(102, 'San Fernando (Morazán)', 12),
(103, 'San Francisco Gotera', 12),
(104, 'San Isidro (Morazán)', 12),
(105, 'San Simón', 12),
(106, 'Sensembra', 12),
(107, 'Sociedad', 12),
(108, 'Torola', 12),
(109, 'Yamabal', 12),
(110, 'Yoloaiquín', 12),
(111, 'La Unión', 14),
(112, 'San Alejo', 14),
(113, 'Yucuaiquín', 14),
(114, 'Conchagua', 14),
(115, 'Intipucá', 14),
(116, 'San José', 14),
(117, 'El Carmen (La Unión)', 14),
(118, 'Yayantique', 14),
(119, 'Bolívar', 14),
(120, 'Meanguera del Golfo', 14),
(121, 'Santa Rosa de Lima', 14),
(122, 'Pasaquina', 14),
(123, 'Anamoros', 14),
(124, 'Nueva Esparta', 14),
(125, 'El Sauce', 14),
(126, 'Concepción de Oriente', 14),
(127, 'Polorós', 14),
(128, 'Lislique', 14),
(129, 'Antiguo Cuscatlán', 4),
(130, 'Chiltiupán', 4),
(131, 'Ciudad Arce', 4),
(132, 'Colón', 4),
(133, 'Comasagua', 4),
(134, 'Huizúcar', 4),
(135, 'Jayaque', 4),
(136, 'Jicalapa', 4),
(137, 'La Libertad', 4),
(138, 'Santa Tecla', 4),
(139, 'Nuevo Cuscatlán', 4),
(140, 'San Juan Opico', 4),
(141, 'Quezaltepeque', 4),
(142, 'Sacacoyo', 4),
(143, 'San José Villanueva', 4),
(144, 'San Matías', 4),
(145, 'San Pablo Tacachico', 4),
(146, 'Talnique', 4),
(147, 'Tamanique', 4),
(148, 'Teotepeque', 4),
(149, 'Tepecoyo', 4),
(150, 'Zaragoza', 4),
(151, 'Agua Caliente', 5),
(152, 'Arcatao', 5),
(153, 'Azacualpa', 5),
(154, 'Cancasque', 5),
(155, 'Chalatenango', 5),
(156, 'Citalá', 5),
(157, 'Comapala', 5),
(158, 'Concepción Quezaltepeque', 5),
(159, 'Dulce Nombre de María', 5),
(160, 'El Carrizal', 5),
(161, 'El Paraíso', 5),
(162, 'La Laguna', 5),
(163, 'La Palma', 5),
(164, 'La Reina', 5),
(165, 'Las Vueltas', 5),
(166, 'Nueva Concepción', 5),
(167, 'Nueva Trinidad', 5),
(168, 'Nombre de Jesús', 5),
(169, 'Ojos de Agua', 5),
(170, 'Potonico', 5),
(171, 'San Antonio de la Cruz', 5),
(172, 'San Antonio Los Ranchos', 5),
(173, 'San Fernando (Chalatenango)', 5),
(174, 'San Francisco Lempa', 5),
(175, 'San Francisco Morazán', 5),
(176, 'San Ignacio', 5),
(177, 'San Isidro Labrador', 5),
(178, 'Las Flores', 5),
(179, 'San Luis del Carmen', 5),
(180, 'San Miguel de Mercedes', 5),
(181, 'San Rafael', 5),
(182, 'Santa Rita', 5),
(183, 'Tejutla', 5),
(184, 'Cojutepeque', 7),
(185, 'Candelaria', 7),
(186, 'El Carmen (Cuscatlán)', 7),
(187, 'El Rosario (Cuscatlán)', 7),
(188, 'Monte San Juan', 7),
(189, 'Oratorio de Concepción', 7),
(190, 'San Bartolomé Perulapía', 7),
(191, 'San Cristóbal', 7),
(192, 'San José Guayabal', 7),
(193, 'San Pedro Perulapán', 7),
(194, 'San Rafael Cedros', 7),
(195, 'San Ramón', 7),
(196, 'Santa Cruz Analquito', 7),
(197, 'Santa Cruz Michapa', 7),
(198, 'Suchitoto', 7),
(199, 'Tenancingo', 7),
(200, 'Aguilares', 6),
(201, 'Apopa', 6),
(202, 'Ayutuxtepeque', 6),
(203, 'Cuscatancingo', 6),
(204, 'Ciudad Delgado', 6),
(205, 'El Paisnal', 6),
(206, 'Guazapa', 6),
(207, 'Ilopango', 6),
(208, 'Mejicanos', 6),
(209, 'Nejapa', 6),
(210, 'Panchimalco', 6),
(211, 'Rosario de Mora', 6),
(212, 'San Marcos', 6),
(213, 'San Martín', 6),
(214, 'San Salvador', 6),
(215, 'Santiago Texacuangos', 6),
(216, 'Santo Tomás', 6),
(217, 'Soyapango', 6),
(218, 'Tonacatepeque', 6),
(219, 'Zacatecoluca', 8),
(220, 'Cuyultitán', 8),
(221, 'El Rosario (La Paz)', 8),
(222, 'Jerusalén', 8),
(223, 'Mercedes La Ceiba', 8),
(224, 'Olocuilta', 8),
(225, 'Paraíso de Osorio', 8),
(226, 'San Antonio Masahuat', 8),
(227, 'San Emigdio', 8),
(228, 'San Francisco Chinameca', 8),
(229, 'San Pedro Masahuat', 8),
(230, 'San Juan Nonualco', 8),
(231, 'San Juan Talpa', 8),
(232, 'San Juan Tepezontes', 8),
(233, 'San Luis La Herradura', 8),
(234, 'San Luis Talpa', 8),
(235, 'San Miguel Tepezontes', 8),
(236, 'San Pedro Nonualco', 8),
(237, 'San Rafael Obrajuelo', 8),
(238, 'Santa María Ostuma', 8),
(239, 'Santiago Nonualco', 8),
(240, 'Tapalhuaca', 8),
(241, 'Cinquera', 9),
(242, 'Dolores', 9),
(243, 'Guacotecti', 9),
(244, 'Ilobasco', 9),
(245, 'Jutiapa', 9),
(246, 'San Isidro (Cabañas)', 9),
(247, 'Sensuntepeque', 9),
(248, 'Tejutepeque', 9),
(249, 'Victoria', 9),
(250, 'Apastepeque', 10),
(251, 'Guadalupe', 10),
(252, 'San Cayetano Istepeque', 10),
(253, 'San Esteban Catarina', 10),
(254, 'San Ildefonso', 10),
(255, 'San Lorenzo', 10),
(256, 'San Sebastián', 10),
(257, 'San Vicente', 10),
(258, 'Santa Clara', 10),
(259, 'Santo Domingo', 10),
(260, 'Tecoluca', 10),
(261, 'Tepetitán', 10),
(262, 'Verapaz', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(400) COLLATE utf8_spanish_ci NOT NULL,
  `departamento` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_pago` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nume_transaccion` int(11) DEFAULT NULL,
  `fecha_transaccion` datetime DEFAULT NULL,
  `valor_transaccion` decimal(10,2) DEFAULT NULL,
  `id_banco` tinyint(1) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `notas` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `notasint` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `monto_compra` decimal(12,2) NOT NULL,
  `id_municipio` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL,
  `tipo_persona` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `alias` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contacto` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contacto2` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contacto3` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tel` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tel2` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tel3` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email2` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email3` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nit` varchar(17) COLLATE utf8_spanish_ci DEFAULT NULL,
  `iva` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipoContribuyente` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `giro` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dui` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `municipio` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `forma_pago` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `grado` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `seccion` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nie` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaNacimiento` datetime DEFAULT NULL,
  `tipo_contribuyente` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `porcentaje`
--

CREATE TABLE `porcentaje` (
  `idPorcentaje` tinyint(4) NOT NULL,
  `porcentaje` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stocktienda`
--

CREATE TABLE `stocktienda` (
  `id_stocktienda` int(11) NOT NULL,
  `idTienda` tinyint(4) NOT NULL,
  `idarticulo` int(11) NOT NULL,
  `stock` mediumint(9) NOT NULL,
  `min` smallint(6) DEFAULT NULL,
  `max` smallint(6) DEFAULT NULL,
  `estadost` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE `tienda` (
  `id` tinyint(4) NOT NULL,
  `nombreTienda` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `cotizacion` int(11) NOT NULL,
  `ticket` int(11) NOT NULL,
  `factura` int(11) NOT NULL,
  `ccf` int(11) NOT NULL,
  `resolucion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `rango` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecharesolucion` date NOT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `online` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`id`, `nombreTienda`, `cotizacion`, `ticket`, `factura`, `ccf`, `resolucion`, `rango`, `fecharesolucion`, `direccion`, `estado`, `online`) VALUES
(1, 'PATUCELL PLAZA MUNDO', 28, 125, 22, 19, '16103-NEXT-0156-2019', '00001-10000', '2019-01-01', 'Prados de Venecia 4, pasaje 15 casa # 15, Soyapango, San Salvador.', 1, 1),
(2, 'PATUCELL MERLIOT', 54, 184, 47, 53, '16103-NEXT-0156-2019', '00001-10000', '2018-01-02', 'PRADOS DE VENECIA', 1, 0),
(3, 'PATUCELL CASCADAS', 0, 0, 0, 0, '16103-NEXT-0156-2019', '0', '0000-00-00', '0', 1, 0),
(4, 'x4', 0, 0, 0, 0, '0', '0', '0000-00-00', '0', 0, 0),
(5, 'x5', 0, 0, 0, 0, '0', '0', '0000-00-00', '0', 0, 0),
(6, 'x6', 0, 0, 0, 0, '0', '0', '0000-00-00', '0', 0, 0),
(7, 'x7', 0, 0, 0, 0, '0', '0', '0000-00-00', '0', 0, 0),
(8, 'x8', 0, 0, 0, 0, '0', '0', '0000-00-00', '0', 0, 0),
(9, 'x9', 0, 0, 0, 0, '0', '0', '0000-00-00', '0', 0, 0),
(10, 'x10', 0, 0, 0, 0, '0', '0', '0000-00-00', '0', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transferencia`
--

CREATE TABLE `transferencia` (
  `id_transferencia` int(11) NOT NULL,
  `id_origen` tinyint(4) NOT NULL,
  `id_destino` tinyint(4) NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rol` tinyint(4) DEFAULT NULL,
  `id_tienda` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `rol`, `id_tienda`) VALUES
(1, 'Mario Miranda', 'ernesto3d@gmail.com', '$2y$10$MKLRynlN7KVrBPPFPwwMNOc/AnnejYyLVIBCJYi66..7ZCe0hKGyG', '7zL82o3hJHM14UcNv3PalW7S17DSCTAVD6FPfPpXb7TfYgDe0YgwGNGSE0CV', '2018-08-08 23:19:44', '2018-11-11 02:00:36', NULL, 1),
(3, 'Ernesto Nolasco', 'miranda2j@outlook.com', '$2y$10$fw/i0zB4aG0qSXJx277cV.MvnytBHyjU4Nm6GFFQ02Hz.fGFYey9i', 'Di9vJwbRN0oaYIAVdSizkxHITVi8SE29Qg0ADxaA8HKAS2XDy9jZKINsdPLR', '2019-01-31 16:33:39', '2019-01-31 16:33:39', NULL, 2),
(4, 'liss45', 'mirandas@outlook.com', '$2y$10$UwHgO0JJkAmjBuY/OJj5W.HyhQE0phMql3yCv95H5.ljF47t4DvAy', NULL, '2019-05-01 01:10:21', '2019-05-01 01:12:46', NULL, 0),
(5, 'Dario Miranda', 'mirandad@gmail.com', '$2y$10$zmHobDvMsTWn9REg65.RjOafm8JYK90uwskNJB7i7M5RLiPaB9wze', NULL, '2019-05-01 16:21:49', '2019-05-01 16:22:04', NULL, 0),
(6, 'admin', 'admin@gmail.com', '$2y$10$8YdUmVnRnM7PlcWRoLtAOuvHhzDUpdb7lQLcddnzYgdUGHztTBMye', 'p7XhRFLrYzrNJVwW4npBSukKtT4DYQd3H6xtSU3Xjw9BZ0Asq65DxRM67x30', '2020-03-13 15:56:40', '2020-03-13 15:56:40', 1, 1),
(7, 'Admin 2', 'admin2@gmail.com', '$2y$10$p52gtNJ1CD7c41elYavpfuVqaN0HXaqkBmH51.KSCzWhmcji1Fwua', '6MAwI1JkdylaUr4YHLaIwyTyGq4LmmzqaOAk5WKDrOPzbz9O40EBwOANjY6Y', '2020-03-14 17:10:40', '2020-03-14 17:10:40', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL,
  `idtienda` int(11) NOT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `tipo_comprobante` tinyint(4) DEFAULT NULL,
  `serie_comprobante` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `num_comprobante` int(11) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `impuesto` decimal(4,2) DEFAULT NULL,
  `impuestodos` decimal(4,2) DEFAULT NULL,
  `descuento` tinyint(11) DEFAULT NULL,
  `total_venta` decimal(10,2) DEFAULT NULL,
  `estado` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `forma_pago` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonesv`
--

CREATE TABLE `zonesv` (
  `ID` int(11) NOT NULL,
  `ZoneName` varchar(15) NOT NULL COMMENT 'Nombre de las zonas geógraficas de El Salvador'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Zonas geográficas de El Salvador';

--
-- Volcado de datos para la tabla `zonesv`
--

INSERT INTO `zonesv` (`ID`, `ZoneName`) VALUES
(1, 'Occidental'),
(2, 'Central'),
(3, 'Paracentral'),
(4, 'Oriental');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`idarticulo`),
  ADD KEY `fk_articulos_categorias_idx` (`idcategoria`),
  ADD KEY `fk_articulo_marcas_idx` (`idModelo`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id_miscelanea`);

--
-- Indices de la tabla `corte`
--
ALTER TABLE `corte`
  ADD PRIMARY KEY (`id_corte`);

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`idCotizacion`);

--
-- Indices de la tabla `depsv`
--
ALTER TABLE `depsv`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_DEPSV_ZONESV` (`ZONESV_ID`);

--
-- Indices de la tabla `detalle_cotizacion`
--
ALTER TABLE `detalle_cotizacion`
  ADD PRIMARY KEY (`idDetalleCotizacion`);

--
-- Indices de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD PRIMARY KEY (`iddetalle_ingreso`),
  ADD KEY `fk_destalle_ingreso_articulo_idx` (`idarticulo`),
  ADD KEY `fk_detalle_ingreso_ingreso_idx` (`idingreso`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle_pedido`);

--
-- Indices de la tabla `detalle_transferencia`
--
ALTER TABLE `detalle_transferencia`
  ADD PRIMARY KEY (`iddetalle_transferecia`),
  ADD KEY `id_transferencia` (`id_transferencia`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`iddetalle_venta`),
  ADD KEY `fk_detalle_venta_articulo_idx` (`idarticulo`),
  ADD KEY `fk_detalle_venta_venta_idx` (`idventa`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`idingreso`),
  ADD KEY `ingreso_idx` (`idproveedor`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idMarca`);

--
-- Indices de la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`idModelo`),
  ADD KEY `FK_IDMARCA` (`idMarca`);

--
-- Indices de la tabla `munsv`
--
ALTER TABLE `munsv`
  ADD PRIMARY KEY (`ID`,`DEPSV_ID`),
  ADD KEY `fk_MUNSV_DEPSV1` (`DEPSV_ID`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`);

--
-- Indices de la tabla `porcentaje`
--
ALTER TABLE `porcentaje`
  ADD PRIMARY KEY (`idPorcentaje`);

--
-- Indices de la tabla `stocktienda`
--
ALTER TABLE `stocktienda`
  ADD PRIMARY KEY (`id_stocktienda`),
  ADD KEY `idTienda` (`idTienda`),
  ADD KEY `idArticulo` (`idarticulo`);

--
-- Indices de la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transferencia`
--
ALTER TABLE `transferencia`
  ADD PRIMARY KEY (`id_transferencia`),
  ADD KEY `id_origen` (`id_origen`,`id_destino`),
  ADD KEY `id_destino` (`id_destino`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idventa`),
  ADD KEY `fk_venta_persona_idx` (`idcliente`);

--
-- Indices de la tabla `zonesv`
--
ALTER TABLE `zonesv`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `idarticulo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id_miscelanea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `corte`
--
ALTER TABLE `corte`
  MODIFY `id_corte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  MODIFY `idCotizacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `depsv`
--
ALTER TABLE `depsv`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `detalle_cotizacion`
--
ALTER TABLE `detalle_cotizacion`
  MODIFY `idDetalleCotizacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  MODIFY `iddetalle_ingreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_transferencia`
--
ALTER TABLE `detalle_transferencia`
  MODIFY `iddetalle_transferecia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `iddetalle_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `Id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `idingreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `idModelo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `munsv`
--
ALTER TABLE `munsv`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `porcentaje`
--
ALTER TABLE `porcentaje`
  MODIFY `idPorcentaje` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `stocktienda`
--
ALTER TABLE `stocktienda`
  MODIFY `id_stocktienda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tienda`
--
ALTER TABLE `tienda`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `transferencia`
--
ALTER TABLE `transferencia`
  MODIFY `id_transferencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `zonesv`
--
ALTER TABLE `zonesv`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `articulo_ibfk_1` FOREIGN KEY (`idModelo`) REFERENCES `modelo` (`idModelo`),
  ADD CONSTRAINT `fk_articulos_categorias` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `depsv`
--
ALTER TABLE `depsv`
  ADD CONSTRAINT `fk_DEPSV_ZONESV` FOREIGN KEY (`ZONESV_ID`) REFERENCES `zonesv` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD CONSTRAINT `fk_detalle_ingreso_articulo` FOREIGN KEY (`idarticulo`) REFERENCES `articulo` (`idarticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_ingreso_ingreso` FOREIGN KEY (`idingreso`) REFERENCES `ingreso` (`idingreso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_transferencia`
--
ALTER TABLE `detalle_transferencia`
  ADD CONSTRAINT `detalle_transferencia_ibfk_1` FOREIGN KEY (`id_transferencia`) REFERENCES `transferencia` (`id_transferencia`);

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_detalle_venta_articulo` FOREIGN KEY (`idarticulo`) REFERENCES `articulo` (`idarticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_venta_venta` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `fk_ingreso_persona` FOREIGN KEY (`idproveedor`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `modelo_ibfk_1` FOREIGN KEY (`idMarca`) REFERENCES `marca` (`idMarca`);

--
-- Filtros para la tabla `munsv`
--
ALTER TABLE `munsv`
  ADD CONSTRAINT `fk_MUNSV_DEPSV1` FOREIGN KEY (`DEPSV_ID`) REFERENCES `depsv` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `stocktienda`
--
ALTER TABLE `stocktienda`
  ADD CONSTRAINT `stocktienda_ibfk_2` FOREIGN KEY (`idarticulo`) REFERENCES `articulo` (`idarticulo`),
  ADD CONSTRAINT `stocktienda_ibfk_3` FOREIGN KEY (`idTienda`) REFERENCES `tienda` (`id`);

--
-- Filtros para la tabla `transferencia`
--
ALTER TABLE `transferencia`
  ADD CONSTRAINT `transferencia_ibfk_1` FOREIGN KEY (`id_origen`) REFERENCES `tienda` (`id`),
  ADD CONSTRAINT `transferencia_ibfk_2` FOREIGN KEY (`id_destino`) REFERENCES `tienda` (`id`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_persona` FOREIGN KEY (`idcliente`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
