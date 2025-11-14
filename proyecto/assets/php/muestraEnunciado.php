<?php
function muestraEnunciado(Enunciado $enunciado): void
{
    $id = "ej0".$enunciado->num;
    $class = "enunciado";
    // Usamos estilos en línea para simplicidad, idealmente serían clases CSS
    echo "<div id='".$id."' style='border: 1px solid #ddd; border-radius: 8px; padding: 20px; background: #fafafa; font-family: sans-serif;' class='".$class."'>";

    // 1. Título (Número y Título)
    echo "<h2 style='margin-top: 0;'>";
    echo "Ejercicio " . htmlspecialchars($enunciado->num) . ": " . htmlspecialchars($enunciado->titulo);
    echo "</h2>";

    // 2. Enunciado principal
    echo "<p style='font-size: 1.1em; color: #555;'>";
    echo htmlspecialchars($enunciado->enunciado);
    echo "</p>";

    // 3. Apartados (si los hay)
    if (!empty($enunciado->apartados)) {
        echo "<ul style='background: #fff; padding: 15px 15px 15px 40px; border-radius: 5px;'>";
        foreach ($enunciado->apartados as $apartado) {
            echo "<li style='margin-bottom: 8px;'>" . htmlspecialchars($apartado) . "</li>";
        }
        echo "</ul>";
    }

    // 4. Pista (si la hay)
    if (!empty($enunciado->pista)) {
        echo "<blockquote style='margin: 15px 0 0 0; padding: 10px 15px; background: #fdfdea; border-left: 5px solid #f0ad4e;'>";
        echo "💡 <strong>Pista:</strong> " . htmlspecialchars($enunciado->pista);
        echo "</blockquote>";
    }

    echo "</div>";
}