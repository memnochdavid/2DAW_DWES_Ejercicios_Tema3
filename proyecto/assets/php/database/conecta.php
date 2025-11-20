<?php
function conexion(
    $host = 'db',
    $dbname = 'tienda_frutas',
    $username = 'root',
    $password = 'root'
)
{
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "<p class='success'>✅ Conexión exitosa a la base de datos</p>";

        return $pdo;

    } catch(PDOException $e) {
        echo "<p class='error'>❌ Error de conexión: " . $e->getMessage() . "</p>";
        echo "<div class='info'>";
        echo "<strong>Verifica que:</strong><br>";
        echo "- Los contenedores estén corriendo: <code>docker compose -f docker-compose-alumnos.yml ps</code><br>";
        echo "- El servicio de base de datos esté disponible<br>";
        echo "- Las credenciales sean correctas";
        echo "</div>";
    }
}