<?php
function imprimirTablaPedidos($titulo, $pedidos) {
    echo "<h2>🛒 $titulo</h2>";
    if (count($pedidos) > 0) {
        echo "<table style='width: 80%; border-collapse: collapse; margin: auto'>";
        echo "<tr style='background: #dcdcdc;'>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>ID</th>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>Usuario</th>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>Fecha</th>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>Total</th>";
        echo "</tr>";

        foreach ($pedidos as $pedido) {
            echo "<tr>";
            echo "<td style='padding: 10px; border: 1px solid #ddd; background: #f6f6f6;'>{$pedido['id']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;background: #f6f6f6;'>{$pedido['usuario_id']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;background: #f6f6f6;'>{$pedido['fecha']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;background: #f6f6f6;'>{$pedido['total']}</td>";
        }
        echo "</table>";


    } else {
        echo "<p>No se encontraron pedidos para esta consulta.</p>";
    }
}