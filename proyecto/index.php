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
        <h1>Ejercicios Tema 3</h1>
        <?php
        //INCLUDES
        /** @var Enunciado[] $enunciados */ //necesario
        include './assets/php/enunciados.php';
        include './assets/php/muestraEnunciado.php';
        include './assets/php/muestraSQL.php';
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

        //ejercicio 01
        muestraEnunciado($enunciados[0]);

        //muestra el código SQL que se va a usar
        $archivo = "ej01.sql";
        muestraSQL("🧾 Mostrando archivo ".$archivo, "./sql/".$archivo);
        //crea las tablas
        creaTablas($pdo);

        //ejercicio 02
        muestraEnunciado($enunciados[1]);
        //muestra el código SQL que se va a usar
        $archivo = "ej02.sql";
        muestraSQL("🧾 Mostrando archivo ".$archivo, "./sql/".$archivo);
        //rellena las tablas con datos
        rellenaTablas($pdo);
        //muestra las categorías que existen
        muestraCategorias($pdo);


        //ejercicio 03
        muestraEnunciado($enunciados[2]);

        //03a) Obtener todos los productos ordenados por precio (menor a mayor)
        $sql_a = "SELECT p.*, c.nombre as cat_name 
          FROM productos p
          JOIN categorias c ON p.categoria_id = c.id
          ORDER BY p.precio ASC";

        $stmt_a = $pdo->prepare($sql_a);
        $stmt_a->execute();
        $productos = $stmt_a->fetchAll(PDO::FETCH_ASSOC);

        //muestra el resultado
        imprimirTablaProductos("a) Productos ordenados por precio (menor a mayor)", $productos);

        //03b) Obtener productos de una categoría específica
        $cat = "'Tropicales'";
        $sql_a = "SELECT productos.*, categorias.nombre as cat_name FROM productos, categorias
        WHERE categorias.id = productos.categoria_id AND categorias.nombre =".$cat;

        $stmt_a = $pdo->prepare($sql_a);
        $stmt_a->execute();
        $productos = $stmt_a->fetchAll(PDO::FETCH_ASSOC);

        //muestra el resultado
        imprimirTablaProductos("b) Productos que pertenecen a la Categoría ".$cat, $productos);

        //03c)Obtener productos con stock menor a 20
        $cant = 20;
        $sql_a = "SELECT productos.*, categorias.nombre as cat_name FROM productos, categorias
        WHERE categorias.id = productos.categoria_id AND productos.stock <".$cant;

        $stmt_a = $pdo->prepare($sql_a);
        $stmt_a->execute();
        $productos = $stmt_a->fetchAll(PDO::FETCH_ASSOC);

        //muestra el resultado
        imprimirTablaProductos("c) Productos con stock menor a ".$cant, $productos);

        //03d)Contar cuántos productos hay en total


        ?>

    </div>
</body>
</html>
