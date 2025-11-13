<?php
function imprimirTablaProductos($titulo, $productos)
{
    echo "<h2>🛒 $titulo</h2>";
    if (count($productos) > 0) {
        echo "<table style='width: 80%; border-collapse: collapse; margin: auto'>";
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
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$prod['precio']}€</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$prod['stock']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No se encontraron productos para esta consulta.</p>";
    }
}