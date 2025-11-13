<!DOCTYPE html>
<html lang="es">
<header>
    <link rel="stylesheet" href="./assets/css/style.css">
</header>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2DAW Desarrollo web en entorno servidor (PHP + MariaDB)</title>
</head>
<body>
    <div class="card">
        <h1>🚀 Entorno PHP + MariaDB</h1>
        <?php
        //INCLUDES
        include './assets/php/conecta.php';
        include './assets/php/creaTablas.php';
        include './assets/php/rellenaTablas.php';
        include './assets/php/muestraCategorias.php';
        include './assets/php/muestraProductos.php';
        ?>

        <h2>🔌 Conexión a MariaDB</h2>
        <?php
        //conexión a la bd
        $host = 'db';
        $dbname = 'tienda_frutas';
        $username = 'root';
        $password = 'root';
        $pdo = conexion($host, $dbname, $username, $password);
        ?>
        <h2>🧾 Tablas</h2>
        <?php
        //ejericio 01
        // Crear tabla de ejemplo si no existe
        creaTablas($pdo);

        //ejercicio 02
        //rellena tablas si están vacías
        rellenaTablas($pdo);

        //muestra las categorías que existen
        muestraCategorias($pdo);

        //muestra los prods si existen
        muestraProductos($pdo);
        ?>

    </div>
</body>
</html>
