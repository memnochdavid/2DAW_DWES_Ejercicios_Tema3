<?php
function creaUsuariosEjemplo($pdo)
{
    // Crear tabla de ejemplo si no existe
    $pdo->exec("
                CREATE TABLE IF NOT EXISTS usuarios (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nombre VARCHAR(100) NOT NULL,
                    email VARCHAR(100) NOT NULL,
                    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )
            ");

    // Insertar datos de ejemplo si la tabla está vacía
    $count = $pdo->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
    if ($count == 0) {
        $pdo->exec("
                    INSERT INTO usuarios (nombre, email) VALUES 
                    ('Juan Pérez', 'juan@ejemplo.com'),
                    ('María García', 'maria@ejemplo.com'),
                    ('Carlos López', 'carlos@ejemplo.com')
                ");
        echo "<p class='success'>✅ Datos de ejemplo insertados</p>";
    }
}

function muestraUsuariosEjemplo($pdo)
{
    echo "<h2>👥 Usuarios en la base de datos</h2>";
    $stmt = $pdo->query("SELECT * FROM usuarios ORDER BY id");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($usuarios) > 0) {
        echo "<table style='width: 100%; border-collapse: collapse;'>";
        echo "<tr style='background: #f4f4f4;'>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>ID</th>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>Nombre</th>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>Email</th>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>Fecha Registro</th>";
        echo "</tr>";

        foreach ($usuarios as $usuario) {
            echo "<tr>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$usuario['id']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$usuario['nombre']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$usuario['email']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$usuario['fecha_registro']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
}