-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-04-2025 a las 06:07:59
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cuponera`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

DROP TABLE IF EXISTS `compras`;
CREATE TABLE IF NOT EXISTS `compras` (
  `id_Compra` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `oferta_id` int NOT NULL,
  `cantidad` int NOT NULL,
  `fecha_compra` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_Compra`),
  KEY `usuario_id` (`usuario_id`),
  KEY `oferta_id` (`oferta_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE IF NOT EXISTS `empresas` (
  `id_Empresa` int NOT NULL AUTO_INCREMENT,
  `codigo_empresa` varchar(6) NOT NULL,
  `nombre_empresa` varchar(255) NOT NULL,
  `direccion_empresa` varchar(200) NOT NULL,
  `nombre_contacto` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo_empresa` varchar(100) NOT NULL,
  `rubro` varchar(100) NOT NULL,
  `porcentaje_comision` decimal(5,2) NOT NULL,
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`id_Empresa`),
  UNIQUE KEY `codigo_empresa` (`codigo_empresa`),
  UNIQUE KEY `correo_empresa` (`correo_empresa`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id_Empresa`, `codigo_empresa`, `nombre_empresa`, `direccion_empresa`, `nombre_contacto`, `telefono`, `correo_empresa`, `rubro`, `porcentaje_comision`, `usuario_id`) VALUES
(1, 'EMP001', 'Super Selectos', 'San Salvador, El Salvador', 'Julia Amaya', '2291-8542', 'superSel@gmail.com', 'Supermercado', 3.20, 1),
(2, 'EMP003', 'TacoBell', 'San Salvador, El Salvador', 'Luis Flores', '2225-9652', 'tacobell@gmail.com', 'Restaurante', 4.20, 10),
(3, 'EMP006', 'Walmart', 'San Salvador, El Salvador', 'Geissel Hernandez', '2278-5590', 'walmartsv@gmail.com', 'Supermercado', 5.23, 1),
(4, 'EMP007', 'Vidals', 'San Salvador, El Salvador', 'Valeria Leon', '2513-4501', 'vidals@gmail.com', 'Salon de Belleza', 2.60, 2),
(5, 'EMP008', 'Siman', 'La Libertad, El Salvador', 'Erick Chinchilla', '2233-8174', 'siman@gmail.com', 'Tienda de ropa', 3.80, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

DROP TABLE IF EXISTS `ofertas`;
CREATE TABLE IF NOT EXISTS `ofertas` (
  `id_Ofertas` int NOT NULL AUTO_INCREMENT,
  `empresa_id` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `precio_regular` decimal(10,2) NOT NULL,
  `precio_oferta` decimal(10,2) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `fecha_limite_uso` date NOT NULL,
  `cantidad_limite` int DEFAULT NULL,
  `descripcion` text NOT NULL,
  `detalles` text,
  `estado` enum('En espera de aprobación','Oferta aprobada','Oferta rechazada','Oferta descartada') NOT NULL DEFAULT 'En espera de aprobación',
  `justificacion_rechazo` text,
  PRIMARY KEY (`id_Ofertas`),
  KEY `empresa_id` (`empresa_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id_Ofertas`, `empresa_id`, `titulo`, `precio_regular`, `precio_oferta`, `fecha_inicio`, `fecha_fin`, `fecha_limite_uso`, `cantidad_limite`, `descripcion`, `detalles`, `estado`, `justificacion_rechazo`) VALUES
(1, 1, 'Vacaciones con tus mejores vinos', 15.50, 10.20, '2025-05-01', '2025-05-10', '2025-05-09', 100, 'Disfruta de tus vacaciones con nuestros mejores vinos en descuento, encontraras de todas las marcas y sabores.', 'Vinos selecionados, aplican restricciones', 'En espera de aprobación', NULL),
(2, 1, 'Vacaciones con tus mejores vinos', 15.50, 10.20, '2025-05-01', '2025-05-10', '2025-05-09', 100, 'Disfruta de tus vacaciones con nuestros mejores vinos en descuento, encontraras de todas las marcas y sabores.', 'Vinos selecionados, aplican restricciones', 'En espera de aprobación', NULL),
(3, 2, '2x1 en Burros', 9.99, 5.99, '2025-05-27', '2025-05-30', '2025-05-29', 200, 'Aprovecha esta oferta de 2x1 en burros de res, mixto, al pastor y de pollo.', 'Burros de tamaño regular, aplican restricciones', 'En espera de aprobación', NULL),
(4, 2, 'Tacomania', 5.99, 2.99, '2025-05-12', '2025-06-11', '2025-06-12', 200, 'Llego la Tacomania, aprovecha todos los tacos a 2.99.', 'Aplican en tacos de especialidad normal, aplican restricciones', 'En espera de aprobación', NULL),
(5, 3, 'Refrescante oferta', 3.50, 2.00, '2025-05-02', '2025-05-11', '2025-05-10', 200, 'Refrescate con nuestras bebidas PEPSI de 3L a un descuento.', 'PEPSI de 3L normal, aplican restricciones', 'En espera de aprobación', NULL),
(6, 3, 'Aceite Masola 3x2', 9.50, 4.00, '2025-05-10', '2025-05-20', '2025-05-19', 100, 'Aceite Masola de 500ml paga 2 y lleva 1 gratis.', 'Aplica al llevar 2 Aceites Masola de 500ml, aplican restricciones', 'En espera de aprobación', NULL),
(7, 4, 'Combo Completo', 24.99, 17.99, '2025-05-25', '2025-05-30', '2025-05-29', 400, 'Combo de Alisado + Uñas Gel + Pedicure + Depiladcion de Cejas.', 'Disponible por la compra de un tinte, aplican restricciones', 'En espera de aprobación', NULL),
(8, 5, 'Descuento en ropa de verano', 50.00, 25.00, '2025-05-01', '2025-05-31', '2025-05-30', 1000, 'Aprovecha el descuento del 50% en ropa de verano.', 'Aplican restricciones', 'En espera de aprobación', NULL),
(9, 5, 'Descuento en Accesorios de verano', 40.00, 20.00, '2025-05-01', '2025-05-31', '2025-05-30', 1000, 'Aprovecha el descuento del 50% en flotadores, lentes de sol y mas.', 'Aplican restricciones', 'En espera de aprobación', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE IF NOT EXISTS `pagos` (
  `id_pagos_empresas` int NOT NULL AUTO_INCREMENT,
  `empresa_id` int NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha_pago` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pagos_empresas`),
  KEY `empresa_id` (`empresa_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuarios`
--

DROP TABLE IF EXISTS `tipo_usuarios`;
CREATE TABLE IF NOT EXISTS `tipo_usuarios` (
  `id_tipo_usuario` int NOT NULL,
  `tipo_usuario` varchar(30) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipo_usuarios`
--

INSERT INTO `tipo_usuarios` (`id_tipo_usuario`, `tipo_usuario`) VALUES
(1, 'ADMIN'),
(2, 'CLIENTE'),
(3, 'ADMIN_EMPRESA'),
(4, 'EMPLEADO_EMPRESA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_Usuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `DUI` varchar(15) NOT NULL,
  `contra` varchar(128) NOT NULL,
  `id_tipo_usuario` int NOT NULL,
  `codigo_verificacion` varchar(255) DEFAULT NULL,
  `verificado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_Usuario`),
  UNIQUE KEY `correo` (`correo`),
  KEY `id_tipo_usuario` (`id_tipo_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_Usuario`, `nombre`, `apellido`, `telefono`, `correo`, `direccion`, `DUI`, `contra`, `id_tipo_usuario`, `codigo_verificacion`, `verificado`) VALUES
(1, 'Juan', 'Pérez', '2291-5210', 'juan.perez@gmail.com', 'Santa Ana, El Salvador', '06648832-0', '349e4272dc8abd9757f8f4d688dea9f28f31ca086cc1c6eedb36da59a30ae16dac45de96026594ca882d087494719cb95bc9f013bf067e1ccf900f408ca84e35', 1, NULL, 0),
(2, 'Anna', 'Lopez', '7854-9632', 'annaL@gmail.com', 'San Jacinto, El Salvador', '78546632-5', '69fb3718a55199d6785d09304c0f8442552230f4e9d52b04e46cc62b6d6e877cdcff2f03a869e643b173839070511bc8b8ccabaec51631f27bebd8ba648dbd4f', 1, NULL, 0),
(3, 'Alfredo', 'Pacheco', '7047-9632', 'alfredPacheco@gmail.com', 'Soyapango, San Salvador', '52014496-0', '31bdf287baf1a0785194906f18877de3ef4c64c07ab6f08c592a6e4555e19ce7fc1457e514b50ed1ba4fc2e832d30c9985e54db2191fdcab5b9f4b69a2a7784d', 2, NULL, 0),
(4, 'Valentina', 'Gonzalez', '7558-4596', 'ValenG@email.com', 'Soyapango, San Salvador', '16649966-9', 'ValenSV', 3, NULL, 0),
(5, 'Karen', 'Menjivar', '7412-3584', 'karenMen@email.com', 'Ilopango, San Salvador', '78852149-3', 'karen000', 1, NULL, 0),
(16, 'Monica', 'Merino', '4596-3256', 'mmerino@email.com', 'Col.Escalon, San Salvador', '06689475-2', '3f4e3ad8ce3fb4ec02f37effc921e5f9a29c4cfce2f044d416ac36527340ff2262da76cb22f8492fd80264ebaecd5c3baf13827f10929f2a74348ec3e0c0860b', 4, NULL, 0),
(19, 'Camila', 'Bargas', '2291-5210', 'camiBargas@gmail.com', 'San Salvador, El Salvador', '0245879-3', 'f71bb2343b7c493d9c2bdb591db6134095647ad2c41f80c2987ec321237034272d932a0d7400bc9476a5088228a4a08e15b51b419f0004e27ba32c7d30b549ae', 1, NULL, 0),
(20, 'Brenda', 'Sarai', '4896-3260', 'brenGdz@gmail.com', 'San Salvador, El Salvador', '25410236-0', '167cc526eb86e4864bbbf5b6b6a11b52918d605c22118b33bdd3471e4c8f5f4a5b92f2835e2b04d3fa31b92a25242a1dd4782977fa7790ecfa95d97f247ee3c2', 1, NULL, 0),
(21, 'Antony', 'Lopez', '7896-5412', 'anntony.lopez1c@gmail.com', 'Santa Ana, El Salvador', '02589663-9', '85403db528ad3a6d2e265280d34200c614274268d667dc91e3feb5dd8025f54a86e0ded0cdca5f5d26389fc2bb65ccfb2c3fdb055b619615e68b8a44c1a55300', 1, NULL, 0),
(22, 'Alejandra', 'Rivas', '4875-6521', 'alejandraR@gmail.com', 'San Salvador, El Salvador', '58749963-5', 'efc6fa6cf620d5a88c384d45237bda5f569f564976cf6f728ebe92d532782eb2ad823c268b02fb55e0959e7fdc8cc86057cb6d853a9e48e88610edd090db9faa', 1, NULL, 0),
(23, 'Brandon', 'Menjivar', '5241-9685', 'brandon_menjivar@gmail.com', 'San Salvador, El Salvador', '85209630-9', 'f76da689f089113de3f88c91a75be343a1cfdb7e192a3d974b478e87412dd117c7edd3d5f356c6ed9110b5e3e3010755b75aaa8a8234a1a2a77ef3cd052a0871', 1, NULL, 0),
(24, 'Evangeline', 'Lara', '2291-5210', 'evangenlinelara@gmail.com', 'Santa Ana, El Salvador', '0245871149-3', '2c37b3f6c7075d435a4299f793c8a8c1c51183e4c5e759597fc621776bb319cb35e0ec67f54384273be6a633f64b374c17214304f770d57d265144b19f5ae016', 1, '743e3d77aabe7211e3785cb52a2e8072a970517dbac7e872805224f3c17770bb', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
