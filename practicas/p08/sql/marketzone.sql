CREATE DATABASE IF NOT EXISTS marketzone
    DEFAULT CHARACTER SET utf8
    COLLATE utf8_unicode_ci;

USE marketzone;

---
-- Creación de la tabla de productos
---
DROP TABLE IF EXISTS productos;

CREATE TABLE productos (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre      VARCHAR(100)  NOT NULL,
    marca       VARCHAR(60)   NOT NULL,
    modelo      VARCHAR(60)   NOT NULL,
    precio      DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    unidades    INT UNSIGNED  NOT NULL DEFAULT 0,
    detalles    TEXT,
    imagen      VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

---
-- Inserción de datos
---
INSERT INTO productos (nombre, marca, modelo, precio, unidades, detalles, imagen) VALUES
('Teclado mecánico', 'KeyPro', 'K100', 899.00, 8, 'Switches azules', 'assets/img/teclado.jpg'),
('Mouse gamer',      'GSpeed', 'M55',  499.00, 14, 'RGB 6 botones', 'assets/img/mouse.jpg'),
('Monitor 24"',     'ViewLite', 'VL24', 2899.00, 6, 'IPS 75Hz', 'assets/img/monitor.jpg'),
('SSD 480GB',        'FastDisk', 'FD480', 1099.00, 22, 'SATA 2.5"', 'assets/img/ssd.jpg'),
('Memoria 8GB',      'MemX', 'DDR4', 349.00, 10, '2666MHz', 'assets/img/ram.jpg');