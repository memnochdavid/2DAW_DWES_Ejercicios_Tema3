<?php
function muestraCategorias($pdo)
{
    echo "<h2>🏷️ Categorías en la base de datos</h2>";
    $stmt = $pdo->query("SELECT * FROM categorias ORDER BY id");
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($categorias) > 0) {
        echo "<table style='width: 80%; border-collapse: collapse; margin: auto'>";
        echo "<tr style='background: #f4f4f4;'>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>ID</th>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>Nombre</th>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>descripcion</th>";
        echo "</tr>";

        foreach ($categorias as $cat) {
            echo "<tr>";
            echo "<td style='padding: 10px; border: 1px solid #ddd; background: #f6f6f6;'>{$cat['id']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd; background: #f6f6f6;'>{$cat['nombre']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd; background: #f6f6f6;'>{$cat['descripcion']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
}