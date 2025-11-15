<?php

/**
 * Muestra el contenido de un archivo SQL en un bloque <pre> formateado.
 *
 * @param string $titulo El título H2 que se mostrará sobre el código.
 * @param string $ruta La ruta al archivo .sql que se va a leer.
 * @return void
 */

function imprimirBloqueSQL(string $sqlContenido): void
{
    // 2. Definir los estilos CSS
    $estilos = "
        width: 80%;
        max-height: 300px;
        overflow-y: auto;
        background: #f4f4f4;
        border: 1px solid #ddd;
        padding: 15px;
        margin: auto;
        border-radius: 5px;
        white-space: pre-wrap; /* Mantiene saltos de línea y espacios */
        word-wrap: break-word;  /* Ajusta líneas largas si es necesario */
        box-sizing: border-box; /* Asegura que el padding no desborde el 100% */
    ";

    // 3. Imprimir el bloque <pre> con los estilos
    // Usamos htmlspecialchars() para mostrar el código de forma segura
    echo "<pre style='" . $estilos . "'>";
    echo htmlspecialchars($sqlContenido);
    echo "</pre>";
}

function muestraArchivoSQL(string $titulo, string $ruta): void
{
    echo '<h2>' . htmlspecialchars("💾 ".$titulo) . '</h2>';

    // Comprobar si el archivo existe antes de intentar leerlo
    if (file_exists($ruta)) {

        // 1. Leer el contenido del archivo
        $contenidoSQL = file_get_contents($ruta);

        // 2. Delegar la impresión a la función auxiliar
        imprimirBloqueSQL($contenidoSQL);

    } else {
        // Mensaje de error si no se encuentra el archivo
        echo "<p class='error'>❌ No se pudo encontrar el archivo SQL en la ruta: " . htmlspecialchars($ruta) . "</p>";
    }
}
