<?php
function transaction(PDO $pdo, array $queries): bool
{
    $totalRowsAffected = 0;

    try {
        $pdo->beginTransaction();

        //recorre y ejecuta cada consulta del array
        foreach ($queries as $query) {

            //por si acaso no existen
            $sql = $query['sql'];
            $params = $query['params'] ?? [];

            //afectó alguna fila?
            $check_rows = $query['check_rows'] ?? false;

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);

            //filas afectadas
            $rowCount = $stmt->rowCount();

            //validación de si ha afectado algo
            if ($check_rows && $rowCount == 0) {
                //
                throw new PDOException("Error de validación: La consulta no afectó a ninguna fila (ej. stock insuficiente o ID de producto incorrecto).");
            }

            $totalRowsAffected += $rowCount;
        }

        $pdo->commit();

        echo "<p class='success'>✅ Transacción completada con éxito ($totalRowsAffected fila(s) afectada(s) en total).</p>";
        return true;

    } catch (PDOException $e) {
        //ahora se tiene en cuenta si ha afectado algo y si no, deshace
        echo "<p class='error'>❌ Error de transacción. Comenzando Rollback: " . $e->getMessage() . "</p>";
        try {
            $pdo->rollBack();
            echo "<p class='info'>ℹ️ Rollback completado. La base de datos no ha cambiado.</p>";
        } catch (PDOException $re) {
            echo "<p class='error'>❌ Error crítico de rollback: " . $re->getMessage() . "</p>";
        }
        return false;
    }
}
/*
function transactionalUpdate(PDO $pdo, string $nombreTabla, string $columna, $valor, int $id): bool
{
    // Construimos el SQL de forma segura (sin parámetros para tabla/columna)
    $sql = "UPDATE `$nombreTabla` SET `$columna` = :valor WHERE id = :id";

    try {
        // 1. Iniciar la transacción
        $pdo->beginTransaction();

        // 2. Preparar y ejecutar la consulta
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':valor' => $valor,
            ':id'    => $id
        ]);

        $rowCount = $stmt->rowCount();

        // 3. Si todo fue bien, confirmar los cambios
        $pdo->commit();

        // 4. Informar del resultado
        if ($rowCount > 0) {
            echo "<p class='success'>✅ Transacción de actualización completada ($rowCount fila(s) afectada(s)).</p>";
        } else {
            echo "<p class='info'>ℹ️ Transacción completada, pero 0 filas afectadas (ID no encontrado o el valor ya era el mismo).</p>";
        }

        return true; // Éxito

    } catch (PDOException $e) {
        // 5. Si algo falló, deshacer todo
        echo "<p class='error'>❌ Error en la transacción de actualización: " . $e->getMessage() . "</p>";

        try {
            $pdo->rollBack();
            echo "<p class='info'>ℹ️ Rollback completado. La base de datos no ha cambiado.</p>";
        } catch (PDOException $re) {
            echo "<p class='error'>❌ Error crítico de rollback: " . $re->getMessage() . "</p>";
        }

        return false; // Fracaso
    }
}
*/

