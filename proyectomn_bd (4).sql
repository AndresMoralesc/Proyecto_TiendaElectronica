-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2024 a las 23:01:22
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectomn_bd`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarCarrito` (IN `pIdProducto` BIGINT, IN `pCantidadProducto` INT, IN `pIdUsuario` BIGINT)   BEGIN

	IF (SELECT count(*) FROM carrito WHERE IdProducto = pIdProducto and IdUsuario = pIdUsuario) > 0 THEN
		
        IF(pCantidadProducto = 0) THEN        
        	DELETE FROM carrito WHERE IdProducto = pIdProducto and IdUsuario = pIdUsuario;
        ELSE
            UPDATE carrito
            SET Cantidad = pCantidadProducto
            WHERE IdProducto = pIdProducto and IdUsuario = pIdUsuario;
 		END IF;
        
	ELSE
    
    	IF(pCantidadProducto > 0) THEN
 			INSERT INTO carrito(IdProducto,IdUsuario,Cantidad,Fecha)
        	VALUES(pIdProducto,pIdUsuario,pCantidadProducto, NOW());
		END IF;
    
    END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarUsuario` (IN `pcontrasenna` VARCHAR(10), IN `pIdentificacion` VARCHAR(20), IN `pNombre` VARCHAR(100), IN `pPerfil` TINYINT, IN `pConsecutivo` BIGINT)   BEGIN

IF pcontrasenna = '' THEN

	SELECT Contrasenna INTO pcontrasenna
    FROM usuarios
    WHERE ConsecutivoUsuario = pConsecutivo;

END IF;

UPDATE usuarios
SET Contrasenna = pcontrasenna,
	Identificacion = pIdentificacion,
    Nombre = pNombre,
	TipoUsuario = pPerfil
WHERE ConsecutivoUsuario = pConsecutivo;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `BuscarUsuario` (IN `pCorreoElectronico` VARCHAR(70))   BEGIN

	SELECT CorreoElectronico,
Contrasenna
    FROM   usuarios
    WHERE  CorreoElectronico = pCorreoElectronico;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConfirmarPago` (IN `pIdUsuario` BIGINT)   BEGIN

	INSERT  INTO `maestro`(`IdUsuario`,`Fecha`,`Subtotal`,`Impuesto`,`Total`)
	SELECT	C.IdUsuario,
			Now(),
			SUM(C.Cantidad * P.Precio) 'Subtotal',
            SUM((C.Cantidad * P.Precio) * 0.13) 'Impuesto',
            SUM((C.Cantidad * P.Precio) + (C.Cantidad * P.Precio) * 0.13) 'Total'
    FROM  Carrito C
    INNER JOIN PRODUCTOS P ON C.IdProducto = P.IdProducto
    WHERE C.IdUsuario = pIdUsuario;
    
    INSERT INTO `detalle`(`IdMaestro`,`IdProducto`,`Cantidad`,`Precio`)
	SELECT LAST_INSERT_ID(),
		   C.IdProducto,
           C.Cantidad,
           P.Precio
	FROM  Carrito C
    INNER JOIN PRODUCTOS P ON C.IdProducto = P.IdProducto
    WHERE C.IdUsuario = pIdUsuario;

	UPDATE Productos p
	INNER JOIN Carrito C ON C.IdProducto = P.IdProducto
	SET P.Stock = P.Stock - C.Cantidad 
    WHERE C.IdUsuario = pIdUsuario;

	DELETE FROM Carrito 
    WHERE IdUsuario = pIdUsuario;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarProductos` ()   BEGIN

	SELECT * FROM productos
    WHERE Stock > 0;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarTiposUsuarios` ()   BEGIN

	SELECT TipoUsuario,
		   NombreTipoUsuario
	FROM   tipos_usuarios;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarUsuario` (IN `pConsecutivo` BIGINT(11))   BEGIN

		SELECT 	ConsecutivoUsuario,
    	   		CorreoElectronico,
           		Estado,
           		Case when Estado = 1 
           			 then 'Activo' 
                     Else 'Inactivo' End 'DescEstado',
           		U.TipoUsuario,
           		T.NombreTipoUsuario,
                Identificacion,
                Nombre
        FROM usuarios U
        INNER JOIN tipos_usuarios T ON U.TipoUsuario = T.TipoUsuario
        WHERE ConsecutivoUsuario = pConsecutivo;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarUsuarios` (IN `pCorreoElectronico` VARCHAR(70), IN `pTipoUsuario` TINYINT(4))   BEGIN

	IF(pTipoUsuario = 1) THEN

		SELECT 	ConsecutivoUsuario,
    	   		CorreoElectronico,
           		Estado,
           		Case when Estado = 1 
           			 then 'Activo' 
                     Else 'Inactivo' End 'DescEstado',
           		U.TipoUsuario,
           		T.NombreTipoUsuario, 
                Identificacion,
                Nombre
        FROM usuarios U
        INNER JOIN tipos_usuarios T ON U.TipoUsuario = T.TipoUsuario;

	ELSE
    
    	SELECT 	ConsecutivoUsuario,
    	   		CorreoElectronico,
           		Estado,
           		Case when Estado = 1 
           			 then 'Activo' 
                     Else 'Inactivo' End 'DescEstado',
           		U.TipoUsuario,
           		T.NombreTipoUsuario,
                Identificacion,
                Nombre
        FROM usuarios U
        INNER JOIN tipos_usuarios T ON U.TipoUsuario = T.TipoUsuario
        WHERE CorreoElectronico = pCorreoElectronico;

	END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `IniciarSesion` (IN `pCorreoElectronico` VARCHAR(70), IN `pContrasenna` VARCHAR(10))   BEGIN
	SELECT  ConsecutivoUsuario,
    		CorreoElectronico,
            Estado,
            T.TipoUsuario,
            T.NombreTipoUsuario 'PerfilUsuario'
	FROM  usuarios U
    INNER JOIN tipos_usuarios T ON U.TipoUsuario = T.TipoUsuario 
    WHERE 	CorreoElectronico = pCorreoElectronico
    	AND	Contrasenna = pContrasenna
    	AND Estado = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MostrarCarritoTemporal` (IN `pIdUsuario` BIGINT)   BEGIN

	SELECT 	IFNULL(SUM(C.Cantidad),0) 'CantidadTemporal',
			IFNULL(SUM(C.Cantidad * P.Precio),0)   'MontoTemporal'
    FROM 	CARRITO	C
    INNER JOIN PRODUCTOS P ON C.IdProducto = P.IdProducto
    WHERE C.IdUsuario = pIdUsuario;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MostrarCarritoTotal` (IN `pIdUsuario` BIGINT)   BEGIN

	SELECT  P.Nombre,
			C.Cantidad,
            P.Precio,
            C.Cantidad * P.Precio 			'SubTotal',
           (C.Cantidad * P.Precio) * 0.13 	'Impuesto',
           (C.Cantidad * P.Precio) + (C.Cantidad * P.Precio) * 0.13 'Total'
    FROM 	CARRITO	C
    INNER JOIN PRODUCTOS P ON C.IdProducto = P.IdProducto
    WHERE C.IdUsuario = pIdUsuario;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RegistrarUsuario` (IN `pCorreoElectronico` VARCHAR(70), IN `pContrasenna` VARCHAR(10))   BEGIN

INSERT INTO usuarios(CorreoElectronico, Contrasenna, Estado, TipoUsuario)
VALUES(pCorreoElectronico, pContrasenna, 1, 2);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `VerFacturas` (IN `pIdUsuario` BIGINT)   BEGIN

	SELECT * FROM Maestro
    WHERE IdUsuario = pIdUsuario;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `IdCarrito` bigint(20) NOT NULL,
  `IdUsuario` bigint(20) NOT NULL,
  `IdProducto` bigint(20) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `IdDetalle` bigint(20) NOT NULL,
  `IdMaestro` bigint(20) NOT NULL,
  `IdProducto` bigint(20) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle`
--

INSERT INTO `detalle` (`IdDetalle`, `IdMaestro`, `IdProducto`, `Cantidad`, `Precio`) VALUES
(15, 7, 1, 1, '7500.00'),
(16, 7, 2, 1, '8000.00'),
(17, 7, 3, 1, '59000.00'),
(18, 8, 1, 2, '7500.00'),
(19, 8, 2, 2, '8000.00'),
(20, 8, 3, 2, '59000.00'),
(21, 9, 1, 7, '7500.00'),
(22, 10, 2, 7, '8000.00'),
(23, 11, 2, 7, '8000.00'),
(24, 12, 3, 1, '59000.00'),
(25, 13, 3, 2, '59000.00'),
(26, 14, 3, 1, '59000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro`
--

CREATE TABLE `maestro` (
  `IdMaestro` bigint(20) NOT NULL,
  `IdUsuario` bigint(20) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL,
  `Impuesto` decimal(10,2) NOT NULL,
  `Total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maestro`
--

INSERT INTO `maestro` (`IdMaestro`, `IdUsuario`, `Fecha`, `Subtotal`, `Impuesto`, `Total`) VALUES
(7, 6, '2023-04-19 20:08:17', '74500.00', '9685.00', '84185.00'),
(8, 6, '2023-04-19 20:15:22', '149000.00', '19370.00', '168370.00'),
(9, 6, '2023-04-19 20:17:44', '52500.00', '6825.00', '59325.00'),
(10, 1, '2023-04-19 20:22:11', '56000.00', '7280.00', '63280.00'),
(11, 6, '2023-04-19 20:22:35', '56000.00', '7280.00', '63280.00'),
(12, 1, '2023-04-24 20:38:03', '59000.00', '7670.00', '66670.00'),
(13, 1, '2023-04-28 22:58:58', '118000.00', '15340.00', '133340.00'),
(14, 1, '2024-08-09 11:08:27', '59000.00', '7670.00', '66670.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `IdProducto` bigint(20) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Stock` int(11) NOT NULL,
  `Ruta` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`IdProducto`, `Nombre`, `Precio`, `Stock`, `Ruta`) VALUES
(1, 'Mouse', '7500.00', 0, 'Imagenes\\Mouse.jpg'),
(2, 'Teclado', '8000.00', -7, 'Imagenes\\Mouse.jpg'),
(3, 'Monitor', '59000.00', 3, 'Imagenes\\Mouse.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuarios`
--

CREATE TABLE `tipos_usuarios` (
  `TipoUsuario` tinyint(4) NOT NULL,
  `NombreTipoUsuario` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_usuarios`
--

INSERT INTO `tipos_usuarios` (`TipoUsuario`, `NombreTipoUsuario`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ConsecutivoUsuario` bigint(20) NOT NULL,
  `CorreoElectronico` varchar(70) NOT NULL,
  `Contrasenna` varchar(10) NOT NULL,
  `Estado` bit(1) NOT NULL,
  `TipoUsuario` tinyint(4) NOT NULL,
  `Identificacion` varchar(20) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ConsecutivoUsuario`, `CorreoElectronico`, `Contrasenna`, `Estado`, `TipoUsuario`, `Identificacion`, `Nombre`) VALUES
(1, 'ecalvo90415@ufide.ac.cr', 'secreta', b'1', 2, '304590415', 'EDUARDO JOSE CALVO CASTILLO'),
(6, 'bruiz20932@ufide.ac.cr', '0932', b'1', 1, '117020932', 'BRANDON JOSE RUIZ MIRANDA');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`IdCarrito`),
  ADD KEY `fk_usuarios` (`IdUsuario`),
  ADD KEY `fk_productos` (`IdProducto`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`IdDetalle`),
  ADD KEY `fk_maestros_detalle` (`IdMaestro`),
  ADD KEY `fk_productos_detalle` (`IdProducto`);

--
-- Indices de la tabla `maestro`
--
ALTER TABLE `maestro`
  ADD PRIMARY KEY (`IdMaestro`),
  ADD KEY `fk_usuarios_maestro` (`IdUsuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`IdProducto`);

--
-- Indices de la tabla `tipos_usuarios`
--
ALTER TABLE `tipos_usuarios`
  ADD PRIMARY KEY (`TipoUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ConsecutivoUsuario`),
  ADD UNIQUE KEY `CorreoElectronico` (`CorreoElectronico`),
  ADD KEY `fk_tipos_usuario` (`TipoUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `IdCarrito` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `IdDetalle` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `maestro`
--
ALTER TABLE `maestro`
  MODIFY `IdMaestro` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `IdProducto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipos_usuarios`
--
ALTER TABLE `tipos_usuarios`
  MODIFY `TipoUsuario` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ConsecutivoUsuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_productos` FOREIGN KEY (`IdProducto`) REFERENCES `productos` (`IdProducto`),
  ADD CONSTRAINT `fk_usuarios` FOREIGN KEY (`IdUsuario`) REFERENCES `usuarios` (`ConsecutivoUsuario`);

--
-- Filtros para la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `fk_maestros_detalle` FOREIGN KEY (`IdMaestro`) REFERENCES `maestro` (`IdMaestro`),
  ADD CONSTRAINT `fk_productos_detalle` FOREIGN KEY (`IdProducto`) REFERENCES `productos` (`IdProducto`);

--
-- Filtros para la tabla `maestro`
--
ALTER TABLE `maestro`
  ADD CONSTRAINT `fk_usuarios_maestro` FOREIGN KEY (`IdUsuario`) REFERENCES `usuarios` (`ConsecutivoUsuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_tipos_usuario` FOREIGN KEY (`TipoUsuario`) REFERENCES `tipos_usuarios` (`TipoUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
