SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- Ajustar la codificación de caracteres
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Base de datos: `fosdb`
-- --------------------------------------------------------

-- Eliminar las tablas existentes si es necesario
DROP TABLE IF EXISTS `tbl_orderdetail`;
DROP TABLE IF EXISTS `tbl_order`;
DROP TABLE IF EXISTS `tbl_menuitem`;
DROP TABLE IF EXISTS `tbl_menu`;
DROP TABLE IF EXISTS `tbl_staff`;
DROP TABLE IF EXISTS `tbl_role`;
DROP TABLE IF EXISTS `tbl_admin`;
DROP TABLE IF EXISTS `tbl_reports`;  -- Eliminar si existe
DROP TABLE IF EXISTS `tbl_clients`;  -- Eliminar si existe
DROP TABLE IF EXISTS `tbl_anfitrion`;  -- Eliminar si existe

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `tbl_admin`
-- --------------------------------------------------------
CREATE TABLE `tbl_admin` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `tbl_admin`
INSERT INTO `tbl_admin` (`ID`, `username`, `password`) VALUES
(1, 'admin', '1234abcd..');

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `tbl_anfitrion`
-- --------------------------------------------------------
CREATE TABLE `tbl_anfitrion` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `tbl_anfitrion`
INSERT INTO `tbl_anfitrion` (`ID`, `username`, `password`) VALUES
(1, 'anfitrion', '1234abcd..');

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `tbl_menu`
-- --------------------------------------------------------
CREATE TABLE `tbl_menu` (
  `menuID` int(11) NOT NULL AUTO_INCREMENT,
  `menuName` varchar(25) NOT NULL,
  PRIMARY KEY (`menuID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `tbl_menu`
INSERT INTO `tbl_menu` (`menuID`, `menuName`) VALUES
(1, 'Desayunos'),
(2, 'Carnes'),
(3, 'Bebidas'),
(4, 'Sopas');

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `tbl_menuitem`
-- --------------------------------------------------------
CREATE TABLE `tbl_menuitem` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT,
  `menuID` int(11) NOT NULL,
  `menuItemName` text NOT NULL,
  `price` decimal(15,2) NOT NULL,
  PRIMARY KEY (`itemID`),
  KEY `menuID` (`menuID`),
  CONSTRAINT `fk_menuitem_menu` FOREIGN KEY (`menuID`) REFERENCES `tbl_menu` (`menuID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `tbl_menuitem`
INSERT INTO `tbl_menuitem` (`itemID`, `menuID`, `menuItemName`, `price`) VALUES
(1, 1, 'Huevos en Caserola', '5000.00'),
(2, 1, 'Huevos Revueltos', '5000.00'),
(3, 1, 'Carne en Bistec', '6000.00'),
(4, 1, 'Calentado', '6000.00'),
(5, 2, 'Filete de Pollo', '6000.00'),
(6, 2, 'Filete de Carne', '6000.00'),
(7, 2, 'Chuleta de Pollo', '6000.00'),
(8, 2, 'Chuleta de Res', '6000.00'),
(9, 2, 'Chuleta de Cerdo', '6000.00'),
(10, 2, 'Res Asada', '6000.00'),
(11, 2, 'Pollo Asado', '6000.00'),
(12, 2, 'Pollo Frito', '6000.00'),
(13, 3, 'Tinto', '1000.00'),
(14, 3, 'Café con Leche', '1200.00'),
(15, 3, 'Gaseosa 350 ML', '2000.00'),
(16, 3, 'Gaseosa 200 ML', '1500.00'),
(17, 3, 'Jugo Natural en Agua', '4000.00'),
(18, 3, 'Jugo Natural en Leche', '5000.00'),
(19, 3, 'Jugo de Naranja', '3500.00'),
(20, 4, 'Cremas', '3000.00'),
(21, 4, 'Sancocho', '3000.00'),
(22, 4, 'Caldo de Costilla', '3000.00');

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `tbl_order`
-- --------------------------------------------------------
CREATE TABLE `tbl_order` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `status` text NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `order_date` date NOT NULL,
  PRIMARY KEY (`orderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `tbl_order`
INSERT INTO `tbl_order` (`orderID`, `status`, `total`, `order_date`) VALUES
(1, 'finish', '1000.00', '2020-01-17'),
(2, 'finish', '10000.00', '2020-01-17'),
(3, 'ready', '11000.00', '2020-01-18'),
(4, 'cancelled', '6000.00', '2020-01-18'),
(5, 'preparing', '10000.00', '2020-01-25'),
(6, 'waiting', '15500.00', '2020-01-25');

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `tbl_orderdetail`
-- --------------------------------------------------------
CREATE TABLE `tbl_orderdetail` (
  `orderID` int(11) NOT NULL,
  `orderDetailID` int(11) NOT NULL AUTO_INCREMENT,
  `itemID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`orderDetailID`),
  KEY `itemID` (`itemID`),
  KEY `orderID` (`orderID`),
  CONSTRAINT `fk_orderdetail_order` FOREIGN KEY (`orderID`) REFERENCES `tbl_order` (`orderID`) ON DELETE CASCADE,
  CONSTRAINT `fk_orderdetail_item` FOREIGN KEY (`itemID`) REFERENCES `tbl_menuitem` (`itemID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `tbl_orderdetail`
INSERT INTO `tbl_orderdetail` (`orderID`, `orderDetailID`, `itemID`, `quantity`) VALUES
(1, 1, 5, 1),
(2, 2, 4, 1),
(2, 3, 5, 1),
(2, 4, 6, 1),
(2, 5, 7, 1),
(3, 6, 8, 1),
(3, 7, 21, 1),
(3, 8, 13, 1),
(4, 9, 1, 1),
(4, 10, 13, 1),
(5, 11, 1, 2),
(6, 12, 6, 1),
(6, 13, 9, 1),
(6, 14, 19, 1);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `tbl_role`
-- --------------------------------------------------------
CREATE TABLE `tbl_role` (
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `tbl_role`
INSERT INTO `tbl_role` (`role`) VALUES
('chef'),
('Mesero');

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `tbl_staff`
-- --------------------------------------------------------
CREATE TABLE `tbl_staff` (
  `staffID` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` text NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`staffID`),
  KEY `role` (`role`),
  CONSTRAINT `fk_staff_role` FOREIGN KEY (`role`) REFERENCES `tbl_role` (`role`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `tbl_staff`
INSERT INTO `tbl_staff` (`staffID`, `username`, `password`, `status`, `role`) VALUES
(1, 'Juan', '1234abcd..', 'Online', 'chef'),
(2, 'Pedro', '1234abcd..', 'Online', 'Mesero'),
(3, 'Emily', '1234abcd..', 'Online', 'chef'),
(4, 'Robert', '1234abcd..', 'Online', 'chef'),
(5, 'Sofia', 'abc123', 'Offline', 'Mesero'),
(6, 'Marin', '1234abcd..', 'Online', 'chef');

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `tbl_clients`
-- --------------------------------------------------------
CREATE TABLE `tbl_clients` (
  `clientID` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `numero_integrantes` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  PRIMARY KEY (`clientID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `tbl_clients`
-- No se han proporcionado datos de ejemplo para `tbl_clients`, así que puedes agregar algunos aquí si es necesario.

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `tbl_reports`
-- --------------------------------------------------------
CREATE TABLE `tbl_reports` (
  `reportID` int(11) NOT NULL AUTO_INCREMENT,
  `report_date` date NOT NULL,
  `report_data` text NOT NULL,
  PRIMARY KEY (`reportID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `tbl_reports`
-- No se han proporcionado datos de ejemplo para `tbl_reports`, así que puedes agregar algunos aquí si es necesario.

-- --------------------------------------------------------
-- AUTO_INCREMENT de las tablas volcadas
-- --------------------------------------------------------
ALTER TABLE `tbl_menu` AUTO_INCREMENT=5;
ALTER TABLE `tbl_menuitem` AUTO_INCREMENT=23;
ALTER TABLE `tbl_orderdetail` AUTO_INCREMENT=15;
ALTER TABLE `tbl_staff` AUTO_INCREMENT=7;
ALTER TABLE `tbl_reports` AUTO_INCREMENT=1;  -- Agregado para la nueva tabla

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
