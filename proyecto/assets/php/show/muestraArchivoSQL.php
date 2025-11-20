<?php

//muestra el contenido de un archivo SQL


function imprimirBloqueSQL(string $sqlContenido): void
{
    echo "<pre>";
    echo htmlspecialchars($sqlContenido);
    echo "</pre>";
}

function muestraArchivoSQL(string $titulo, string $ruta): void
{
    echo '<h2>' . htmlspecialchars("💾 ".$titulo) . '</h2>';
    if (file_exists($ruta)) {
        $contenidoSQL = file_get_contents($ruta);
        imprimirBloqueSQL($contenidoSQL);
    } else {
        echo "<p class='error'>❌ No se pudo encontrar el archivo SQL en la ruta: " . htmlspecialchars($ruta) . "</p>";
    }
}
