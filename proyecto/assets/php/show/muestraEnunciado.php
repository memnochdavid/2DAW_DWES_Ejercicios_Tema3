<?php
function muestraEnunciado(Enunciado $enunciado): void
{
    $id = "ej0".$enunciado->num;
    $class = "enunciado";
    echo "<div id='$id' class='$class'>";

    echo "<h2 style='margin-top: 0;'>";
    echo "Ejercicio " . htmlspecialchars($enunciado->num) . ": " . htmlspecialchars($enunciado->titulo);
    echo "</h2>";

    echo "<p style='font-size: 1.1em; color: #555;'>";
    echo htmlspecialchars($enunciado->enunciado);
    echo "</p>";

    if (!empty($enunciado->apartados)) {
        echo "<ul>";
        foreach ($enunciado->apartados as $apartado) {
            echo "<li>" . htmlspecialchars($apartado) . "</li>";
        }
        echo "</ul>";
    }

    if (!empty($enunciado->pista)) {
        echo "<blockquote>";
        echo "💡 <strong>Pista:</strong> " . htmlspecialchars($enunciado->pista);
        echo "</blockquote>";
    }

    echo "</div>";
}