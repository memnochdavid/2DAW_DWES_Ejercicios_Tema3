<?php
function muestraProductos($pdo, $order_param='id', $order_dir='')
{
    echo "<h2>🛒 Productos en la base de datos</h2>";
    $stmt = $pdo->query("SELECT productos.*, categorias.nombre as cat_name FROM productos, categorias WHERE productos.categoria_id =categorias.id ORDER BY ".$order_param." ".$order_dir);
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($productos) > 0) {
        echo "<table style='width: 100%; border-collapse: collapse;'>";
        echo "<tr style='background: #f4f4f4;'>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>ID</th>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>Nombre</th>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>Categoría</th>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>Precio</th>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>Stock</th>";
        echo "</tr>";

        foreach ($productos as $prod) {
            echo "<tr>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$prod['id']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$prod['nombre']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$prod['cat_name']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$prod['precio']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$prod['stock']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
}