-- 1. Crear y seleccionar la base de datos
DROP DATABASE IF EXISTS tienda_frutas;
CREATE DATABASE tienda_frutas;
USE tienda_frutas;

-- 2. Tabla de Categorías
-- Almacena los tipos de productos (ej. "Cítricos", "Tropicales")
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    descripcion TEXT
);

-- 3. Tabla de Usuarios
-- Almacena la información de los clientes
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL -- 255 para almacenar contraseñas hasheadas
);

-- 4. Tabla de Productos
-- Almacena las frutas. Depende de 'categorias'
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    categoria_id INT NOT NULL,
    precio DECIMAL(10, 2) NOT NULL, -- Ej. 99999999.99
    stock INT NOT NULL DEFAULT 0,
    
    -- Clave foránea: Conecta productos con categorias
    -- ON DELETE RESTRICT: Impide borrar una categoría si tiene productos asociados
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE RESTRICT
);

-- 5. Tabla de Pedidos
-- Almacena el resumen de las compras. Depende de 'usuarios'
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT, -- Puede ser NULL si el usuario se elimina
    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2) NOT NULL,
    
    -- Clave foránea: Conecta el pedido con el usuario
    -- ON DELETE SET NULL: Si se borra un usuario, el pedido queda
    -- registrado como "anónimo" (usuario_id = NULL) en lugar de borrarse.
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
);
