<?php
function rellenaTablas($pdo)
{
    try {
        $count = $pdo->query("SELECT COUNT(*) FROM categorias")->fetchColumn();
        if ($count == 0) {
            $pdo->exec("
                INSERT INTO categorias (nombre, descripcion) VALUES
                ('Cítricos', 'Frutas ricas en vitamina C, de sabor ácido.'),
                ('Frutas Rojas', 'Frutas del bosque y bayas, ricas en antioxidantes.'),
                ('Tropicales', 'Frutas de climas cálidos y exóticos.');
            ");
            echo "<p class='success'>✅ Datos de ejemplo insertados en Categorías</p>";
        }else{
            echo "<p class='success'>✅ Los datos ya existían</p>";

        }


        $count = $pdo->query("SELECT COUNT(*) FROM productos")->fetchColumn();
        if ($count == 0) {
            $pdo->exec("
                INSERT INTO productos (nombre, categoria_id, precio, stock) VALUES
                -- Cítricos (categoria_id = 1)
                ('Naranja', 1, 1.50, 100),
                ('Limón', 1, 1.20, 80),
                ('Mandarina', 1, 1.80, 120),
                
                -- Frutas Rojas (categoria_id = 2)
                ('Fresa', 2, 4.50, 50),
                ('Arándano', 2, 5.00, 40),
                ('Frambuesa', 2, 6.00, 30),
                
                -- Tropicales (categoria_id = 3)
                ('Mango', 3, 2.50, 60),
                ('Piña', 3, 3.00, 45),
                ('Papaya', 3, 2.80, 35),
                ('Kiwi', 3, 2.20, 70);
            ");
            echo "<p class='success'>✅ Datos de ejemplo insertados en Productos</p>";
        }
        return $pdo;

    } catch(PDOException $e) {
        echo "<p class='error'>❌ Error creación: " . $e->getMessage() . "</p>";
        return $pdo;
    }





}