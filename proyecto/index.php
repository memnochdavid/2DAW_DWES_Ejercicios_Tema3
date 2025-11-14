<!DOCTYPE html>
<html lang="es">
<header>
    <link rel="stylesheet" href="./assets/css/style.css">
</header>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    //INCLUDES
    /** @var Enunciado[] $enunciados */ //necesario
    include './assets/php/enunciados.php';
    include './assets/php/botones.php';
    include './assets/php/muestraEnunciado.php';
    include './assets/php/muestraArchivoSQL.php';
    include './assets/php/conecta.php';
    include './assets/php/creaTablas.php';
    include './assets/php/rellenaTablas.php';
    include './assets/php/muestraCategorias.php';
    include './assets/php/muestraProductos.php';
    include './assets/php/update.php';
    ?>
    <title>2DAW Desarrollo web en entorno servidor (PHP + MariaDB)</title>
</head>
<body>
<header style="
            position: sticky;
            top: 0;
            z-index: 100; width: 100%;">
    <nav style="
            display: flex;
            justify-content: space-around;
            align-items: center;
        " class="card-nav">
        <?php
        foreach ($enunciados as $ejercicio) {
            muestraBoton($ejercicio->num);
        }
        ?>
    </nav>
</header>
<div class="card">
    <h1>PHP - Ejercicios Tema 3 - David Duque Díaz</h1>

    <h2>🔌 Conexión a MariaDB</h2>
    <?php
    //conexión a la bd
    $host = 'db';
    $dbname = 'tienda_frutas';
    $username = 'root';
    $password = 'root';
    $pdo = conexion($host, $dbname, $username, $password);


    //--------------------------------------------------------------------------------------------------------------
    echo "<div class='card-sub'>";
    //ejercicio 01
    muestraEnunciado($enunciados[0]);

    //muestra el código SQL que se va a usar
    $archivo = "ej01.sql";
    muestraArchivoSQL("Mostrando archivo " . $archivo, "./sql/" . $archivo);
    //crea las tablas
    creaTablas($pdo);

    echo "</div>";
    //--------------------------------------------------------------------------------------------------------------
    //ejercicio 02
    echo "<div class='card-sub'>";
    muestraEnunciado($enunciados[1]);
    //muestra el código SQL que se va a usar
    $archivo = "ej02.sql";
    muestraArchivoSQL("Mostrando archivo " . $archivo, "./sql/" . $archivo);
    //rellena las tablas con datos
    rellenaTablas($pdo);
    //muestra las categorías que existen
    muestraCategorias($pdo);
    echo "</div>";

    //--------------------------------------------------------------------------------------------------------------
    //ejercicio 03
    echo "<div class='card-sub'>";
    muestraEnunciado($enunciados[2]);

    //03a) Obtener todos los productos ordenados por precio (menor a mayor)
    $sql_a = "SELECT p.*, c.nombre as cat_name 
          FROM productos p
          JOIN categorias c ON p.categoria_id = c.id
          ORDER BY p.precio ASC";

    $stmt_a = $pdo->prepare($sql_a);
    $stmt_a->execute();
    $productos = $stmt_a->fetchAll(PDO::FETCH_ASSOC);

    //imprime el sql usado
    echo "<h2>Consulta SQL usada:</h2>";
    imprimirBloqueSQL($sql_a);

    //muestra el resultado
    imprimirTablaProductos("a) Productos ordenados por precio (menor a mayor)", $productos);

    //03b) Obtener productos de una categoría específica
    $cat = "'Tropicales'";
    $sql_a = "SELECT productos.*, categorias.nombre as cat_name FROM productos, categorias
        WHERE categorias.id = productos.categoria_id AND categorias.nombre =" . $cat;

    $stmt_a = $pdo->prepare($sql_a);
    $stmt_a->execute();
    $productos = $stmt_a->fetchAll(PDO::FETCH_ASSOC);

    //imprime el sql usado
    echo "<h2>Consulta SQL usada:</h2>";
    imprimirBloqueSQL($sql_a);

    //muestra el resultado
    imprimirTablaProductos("b) Productos que pertenecen a la Categoría " . $cat, $productos);

    //03c)Obtener productos con stock menor a 20
    $cant = 20;
    $sql_a = "SELECT productos.*, categorias.nombre as cat_name FROM productos, categorias
        WHERE categorias.id = productos.categoria_id AND productos.stock <" . $cant;

    $stmt_a = $pdo->prepare($sql_a);
    $stmt_a->execute();
    $productos = $stmt_a->fetchAll(PDO::FETCH_ASSOC);

    //imprime el sql usado
    echo "<h2>Consulta SQL usada:</h2>";
    imprimirBloqueSQL($sql_a);

    //muestra el resultado
    imprimirTablaProductos("c) Productos con stock menor a " . $cant, $productos);

    //03d)Contar cuántos productos hay en total
    $sql_d = "SELECT COUNT(*) FROM productos";

    $stmt_d = $pdo->prepare($sql_d);
    $stmt_d->execute();

    $total_productos = $stmt_d->fetchColumn();

    //imprime el sql usado
    echo "<h2>Consulta SQL usada:</h2>";
    imprimirBloqueSQL($sql_a);

    echo "<h2>🛒 d) Contar cuántos productos hay en total</h2>";
    echo "<p style='text-align: center'>En la base de datos hay un total de " . $total_productos . " productos.</p>";

    echo "</div>";
    //--------------------------------------------------------------------------------------------------------------
    //ejercicio 04
    echo "<div class='card-sub'>";
    muestraEnunciado($enunciados[3]);

    $sql_a = "SELECT p.*, c.nombre AS cat_name 
            FROM productos p
            INNER JOIN categorias c ON p.categoria_id = c.id
            ORDER BY c.nombre ASC, p.precio ASC";

    $stmt_a = $pdo->prepare($sql_a);
    $stmt_a->execute();
    $productos = $stmt_a->fetchAll(PDO::FETCH_ASSOC);

    //imprime el sql usado
    echo "<h2>Consulta SQL usada:</h2>";
    imprimirBloqueSQL($sql_a);

    //muestra el resultado
    imprimirTablaProductos("Productos con categoría usando INNER JOIN", $productos);
    echo "</div>";

    //--------------------------------------------------------------------------------------------------------------
    //ejercicio 05
    echo "<div class='card-sub'>";
    muestraEnunciado($enunciados[4]);


    // a) Aumente el precio de todos los productos de una categoría en un 10%

    $cat = "Tropicales";
    $porcent = 10;

    $sql_a = "
        UPDATE productos SET precio = precio * (1 + (:porcent / 100))
        WHERE categoria_id = (
            SELECT id FROM categorias WHERE nombre = :cat
        )
    ";

    echo "<h2>Consulta SQL (Plantilla Segura) usada:</h2>";
    imprimirBloqueSQL($sql_a);

    $parametros = [
            ':porcent' => $porcent,
            ':cat' => $cat
    ];

    $consulta_unica = [
            'sql'    => $sql_a,
            'params' => $parametros
    ];

    transaction($pdo, [ $consulta_unica ]);

    // b) y c) Reduzca el stock validando que no sea negativo

    //se va a simular una compra de 50 mandarinas
    $prodNombre = "Mandarina";
    $cantidad_a_restar = 50;

    $sql_b = "UPDATE productos 
          SET stock = stock - :cantidad 
          WHERE nombre = :prodNombre 
          AND stock >= :cantidad";

    echo "<h2>Consulta SQL (Plantila Segura con Validación) usada:</h2>";
    imprimirBloqueSQL($sql_b);

    $parametros = [
            ':prodNombre' => $prodNombre,
            ':cantidad'   => $cantidad_a_restar
    ];

    $consulta_unica = [
            'sql'    => $sql_b,
            'params' => $parametros
    ];

    transaction($pdo, [ $consulta_unica ]);

    echo "</div>";
    //--------------------------------------------------------------------------------------------------------------
    //ejercicio 06
    echo "<div class='card-sub'>";
    muestraEnunciado($enunciados[5]);





    echo "</div>";
    //--------------------------------------------------------------------------------------------------------------
    //ejercicio 07

    echo "<div class='card-sub'>";
    muestraEnunciado($enunciados[6]);





    echo "</div>";
    //--------------------------------------------------------------------------------------------------------------
    //ejercicio 08

    echo "<div class='card-sub'>";
    muestraEnunciado($enunciados[7]);





    echo "</div>";
    //--------------------------------------------------------------------------------------------------------------















    ?>

</div>
</body>
</html>
