<?php
function imprimirTablaGenerica(string $titulo, array $datos): void
{
    echo "<h2>🛒 $titulo</h2>";

    //comprobamos si hay datos
    if (count($datos) > 0) {
        //sacamos las columnas
        $columnasTodas = array_keys($datos[0]);
        //columnas que se no omiten
        $columnasVisibles = array_diff($columnasTodas, ['eliminado']);

        echo "<table>";

        //cabecera
        echo "<tr>";
        foreach ($columnasVisibles as $columna) {
            $nombreCabecera = ucwords(str_replace('_', ' ', $columna));
            echo "<th>$nombreCabecera</th>";
        }
        echo "</tr>";

        //filas
        $filasImpresas = 0;

        foreach ($datos as $fila) {
            if (isset($fila['eliminado']) && $fila['eliminado'] == 1) {
                continue;
            }

            echo "<tr>";
            foreach ($columnasVisibles as $nombreColumna) {
                $valor = $fila[$nombreColumna] ?? '';
                echo "<td>$valor</td>";
            }
            echo "</tr>";
            $filasImpresas++;
        }

        echo "</table>";

        //si sólo hay eliminados, lo indica
        if ($filasImpresas == 0) {
            echo "<p class='info'>ℹ️ Todos los registros están marcados como eliminados.</p>";
        }

    } else {
        echo "<p class='info'>⚠️ No se encontraron datos para: <strong>$titulo</strong>.</p>";
    }
}