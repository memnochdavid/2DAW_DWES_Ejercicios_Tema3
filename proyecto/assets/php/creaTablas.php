<?php
function creaTablas($pdo)
{
    try {

        $stmt = $pdo->query("SHOW TABLES LIKE 'categorias'");

        $tablaExiste = $stmt->rowCount() > 0;

        if ($tablaExiste) {
            echo "<p class='success'>✅ Las tablas ya existían</p>";
        } else {
            $pdo->exec("
                CREATE TABLE categorias (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nombre VARCHAR(100) NOT NULL UNIQUE,
                    descripcion TEXT
                );
            ");

            $pdo->exec("
                CREATE TABLE usuarios (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nombre VARCHAR(100) NOT NULL,
                    email VARCHAR(100) NOT NULL UNIQUE,
                    contraseña VARCHAR(255) NOT NULL
                );
            ");

            $pdo->exec("
                CREATE TABLE productos (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nombre VARCHAR(100) NOT NULL,
                    categoria_id INT NOT NULL,
                    precio DECIMAL(10, 2) NOT NULL,
                    stock INT NOT NULL DEFAULT 0,
                    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE RESTRICT
                );
            ");

            $pdo->exec("
                CREATE TABLE pedidos (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    usuario_id INT,
                    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    total DECIMAL(10, 2) NOT NULL,
                    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
                );
            ");

            echo "<p class='success'>✅ Tablas creadas con éxito</p>";
        }

        return $pdo;

    } catch(PDOException $e) {
        echo "<p class='error'>❌ Error en la gestión de tablas: " . $e->getMessage() . "</p>";
    }
}