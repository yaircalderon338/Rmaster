-- Crear tabla de administradores
CREATE TABLE IF NOT EXISTS tbl_admin (
  ID int(2) NOT NULL AUTO_INCREMENT,
  username varchar(25) NOT NULL,
  password varchar(100) NOT NULL,
  PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Insertar datos de ejemplo en tbl_admin
INSERT IGNORE INTO tbl_admin (ID, username, password) VALUES
(1, 'admin', '1234abcd..');

-- Crear tabla de roles
CREATE TABLE IF NOT EXISTS tbl_role (
  role VARCHAR(50) NOT NULL PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar datos de ejemplo en tbl_role
INSERT IGNORE INTO tbl_role (role) VALUES
('chef'), ('Mesero'), ('hostess'), ('admin');

-- Crear tabla de clientes
CREATE TABLE IF NOT EXISTS cliente (
  id_cliente INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  dni VARCHAR(20) UNIQUE NOT NULL,
  correo VARCHAR(255),
  numerotel VARCHAR(20),
  estado BOOLEAN DEFAULT FALSE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Crear tabla de asistencia
CREATE TABLE IF NOT EXISTS asistencia (
  id_asistencia INT AUTO_INCREMENT PRIMARY KEY,
  id_cliente INT NOT NULL,
  entrada DATETIME NOT NULL,
  FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Crear tabla de staff
CREATE TABLE IF NOT EXISTS tbl_staff (
  staffID INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  status VARCHAR(20) NOT NULL DEFAULT 'Offline',
  role VARCHAR(50) NOT NULL,
  FOREIGN KEY (role) REFERENCES tbl_role(role) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar datos de ejemplo en tbl_staff
INSERT IGNORE INTO tbl_staff (username, password, status, role) VALUES
('hostess1', 'hashed_password_example', 'Offline', 'hostess'), 
('admin', '1234abcd..', 'Offline', 'admin');

-- Crear tabla de menú
CREATE TABLE IF NOT EXISTS tbl_menu (
  menuID INT AUTO_INCREMENT PRIMARY KEY,
  menuName VARCHAR(25) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar datos de ejemplo en tbl_menu
INSERT IGNORE INTO tbl_menu (menuName) VALUES
('Desayunos'), ('Carnes'), ('Bebidas'), ('Sopas');

-- Crear tabla de items del menú
CREATE TABLE IF NOT EXISTS tbl_menuitem (
  itemID INT AUTO_INCREMENT PRIMARY KEY,
  menuID INT NOT NULL,
  menuItemName TEXT NOT NULL,
  price DECIMAL(15,2) NOT NULL,
  FOREIGN KEY (menuID) REFERENCES tbl_menu(menuID) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar datos de ejemplo en tbl_menuitem
INSERT IGNORE INTO tbl_menuitem (menuID, menuItemName, price) VALUES
(1, 'Huevos en Caserola', '5000.00'),
(1, 'Huevos Revueltos', '5000.00'),
(2, 'Carne en Bistec', '6000.00'),
(2, 'Calentado', '6000.00'),
(2, 'Filete de Pollo', '6000.00'),
(2, 'Filete de Carne', '6000.00'),
(2, 'Chuleta de Pollo', '6000.00'),
(2, 'Chuleta de Res', '6000.00'),
(2, 'Chuleta de Cerdo', '6000.00'),
(2, 'Res Asada', '6000.00'),
(2, 'Pollo Asado', '6000.00'),
(2, 'Pollo Frito', '6000.00'),
(3, 'Tinto', '1000.00'),
(3, 'Café con Leche', '1200.00'),
(3, 'Gaseosa 350 ML', '2000.00'),
(3, 'Gaseosa 200 ML', '1500.00'),
(3, 'Jugo Natural en Agua', '4000.00'),
(3, 'Jugo Natural en Leche', '5000.00'),
(3, 'Jugo de Naranja', '3500.00'),
(4, 'Cremas', '3000.00'),
(4, 'Sancocho', '3000.00'),
(4, 'Caldo de Costilla', '3000.00');

-- Crear tabla de órdenes
CREATE TABLE IF NOT EXISTS tbl_order (
  orderID INT AUTO_INCREMENT PRIMARY KEY,
  status VARCHAR(20) NOT NULL,
  total DECIMAL(15,2) NOT NULL,
  order_date DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar datos de ejemplo en tbl_order
INSERT IGNORE INTO tbl_order (status, total, order_date) VALUES
('finish', '1000.00', '2020-01-17'),
('finish', '10000.00', '2020-01-17'),
('ready', '11000.00', '2020-01-18'),
('cancelled', '6000.00', '2020-01-18'),
('preparing', '10000.00', '2020-01-25'),
('waiting', '15500.00', '2020-01-25');

-- Crear tabla de detalles de órdenes
CREATE TABLE IF NOT EXISTS tbl_orderdetail (
  orderDetailID INT AUTO_INCREMENT PRIMARY KEY,
  orderID INT NOT NULL,
  itemID INT NOT NULL,
  quantity INT NOT NULL,
  FOREIGN KEY (orderID) REFERENCES tbl_order(orderID) ON DELETE CASCADE,
  FOREIGN KEY (itemID) REFERENCES tbl_menuitem(itemID) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar datos de ejemplo en tbl_orderdetail
INSERT IGNORE INTO tbl_orderdetail (orderID, itemID, quantity) VALUES
(1, 17, 1),
(2, 22, 1),
(2, 23, 1),
(2, 24, 1),
(2, 25, 1),
(3, 27, 1),
(3, 37, 1),
(3, 30, 1),
(4, 17, 1),
(4, 32, 1),
(5, 17, 2),
(6, 23, 1),
(6, 26, 1),
(6, 36, 1);

-- Crear tabla de reportes
CREATE TABLE IF NOT EXISTS tbl_reports (
  report_id INT AUTO_INCREMENT PRIMARY KEY,
  date DATE NOT NULL,
  description TEXT NOT NULL,
  amount DECIMAL(10, 2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar datos de ejemplo en tbl_reports
INSERT IGNORE INTO tbl_reports (date, description, amount) VALUES
('2024-01-01', 'Reporte de ventas de enero', '5000.00'),
('2024-02-01', 'Reporte de ventas de febrero', '6000.00');

-- Ajustar AUTO_INCREMENT de las tablas
ALTER TABLE tbl_menu AUTO_INCREMENT = 12;
ALTER TABLE tbl_menuitem AUTO_INCREMENT = 40;
ALTER TABLE tbl_orderdetail AUTO_INCREMENT = 15;
ALTER TABLE tbl_staff AUTO_INCREMENT = 10;

