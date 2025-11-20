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
