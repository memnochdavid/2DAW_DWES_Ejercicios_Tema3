<?php
function creaTablas($pdo)
{
    try {
        // Crear tabla del ejercicio 01 del tema 3
        $pdo->exec("
                CREATE TABLE IF NOT EXISTS categorias (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nombre VARCHAR(100) NOT NULL UNIQUE,
                    descripcion TEXT
                );

                CREATE TABLE IF NOT EXISTS usuarios (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nombre VARCHAR(100) NOT NULL,
                    email VARCHAR(100) NOT NULL UNIQUE,
                    contraseña VARCHAR(255) NOT NULL -- 255 para almacenar contraseñas hasheadas
                );
                
                CREATE TABLE IF NOT EXISTS productos (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nombre VARCHAR(100) NOT NULL,
                    categoria_id INT NOT NULL,
                    precio DECIMAL(10, 2) NOT NULL, -- Ej. 99999999.99
                    stock INT NOT NULL DEFAULT 0,
                    
                    -- Clave foránea: Conecta productos con categorias
                    -- ON DELETE RESTRICT: Impide borrar una categoría si tiene productos asociados
                    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE RESTRICT
                );
                CREATE TABLE IF NOT EXISTS pedidos (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    usuario_id INT, -- Puede ser NULL si el usuario se elimina
                    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    total DECIMAL(10, 2) NOT NULL,
                    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
                );

            ");

        echo "<p class='success'>✅ Tablas creadas con éxito</p>";

        return $pdo;

    } catch(PDOException $e) {
        echo "<p class='error'>❌ Error creación: " . $e->getMessage() . "</p>";
    }




}