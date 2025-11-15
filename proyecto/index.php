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
    include './assets/php/class/enunciado.php';
    include './assets/php/show/botones.php';
    include './assets/php/show/muestraEnunciado.php';
    include './assets/php/show/muestraArchivoSQL.php';
    include './assets/php/database/conecta.php';
    include './assets/php/database/init/creaTablas.php';
    include './assets/php/database/init/rellenaTablas.php';
    include './assets/php/show/muestraCategorias.php';
    include './assets/php/show/muestraProductos.php';
    include './assets/php/database/transaction.php';
    include './assets/php/show/muestraPedidos.php';
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
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
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
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
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
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
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
    echo "<h4>Consulta SQL usada:</h4>";
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
    echo "<h4>Consulta SQL usada:</h4>";
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
    echo "<h4>Consulta SQL usada:</h4>";
    imprimirBloqueSQL($sql_a);

    //muestra el resultado
    imprimirTablaProductos("c) Productos con stock menor a " . $cant, $productos);

    //03d)Contar cuántos productos hay en total
    $sql_d = "SELECT COUNT(*) FROM productos";

    $stmt_d = $pdo->prepare($sql_d);
    $stmt_d->execute();

    $total_productos = $stmt_d->fetchColumn();

    //imprime el sql usado
    echo "<h4>Consulta SQL usada:</h4>";
    imprimirBloqueSQL($sql_a);

    echo "<h2>🛒 d) Contar cuántos productos hay en total</h2>";
    echo "<p style='text-align: center'>En la base de datos hay un total de " . $total_productos . " productos.</p>";

    echo "</div>";
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
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
    echo "<h4>Consulta SQL usada:</h4>";
    imprimirBloqueSQL($sql_a);

    //muestra el resultado
    imprimirTablaProductos("Productos con categoría usando INNER JOIN", $productos);
    echo "</div>";

    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
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

    echo "<h4>Consulta SQL (Plantilla Segura) usada:</h4>";
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

    echo "<h4>Consulta SQL (Plantila Segura con Validación) usada:</h4>";
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
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //ejercicio 06
    echo "<div class='card-sub'>";
    muestraEnunciado($enunciados[5]);

    //implementación del soft delete
    echo"<h2>Añade columna 'Eliminado' a tabla productos</h2>";
    $sql_alter = "ALTER TABLE productos ADD COLUMN eliminado BOOLEAN NOT NULL DEFAULT 0";

    echo "<h4>Consulta SQL usada:</h4>";
    imprimirBloqueSQL($sql_alter);

    try {
        // exec() es útil para sentencias que no devuelven resultados, como ALTER
        $pdo->exec($sql_alter);
        echo "<p class='success'>✅ Columna 'eliminado' añadida a 'productos'.</p>";
    } catch (PDOException $e) {
        // Manejamos el error si la columna ya existe (Código 42S21)
        if ($e->getCode() == '42S21') {
            echo "<p class='info'>ℹ️ La columna 'eliminado' ya existía.</p>";
        } else {
            echo "<p class='error'>❌ Error al alterar la tabla: " . $e->getMessage() . "</p>";
        }
    }

    //hace soft delete de los prods con stock == 0
    echo"<h2>Actualiza la columna 'eliminado' a true si el stock es 0</h2>";

    $sql_soft_delete = "UPDATE productos SET eliminado = 1 WHERE stock = :stock";

    echo "<h4>Consulta SQL usada:</h4>";
    imprimirBloqueSQL($sql_soft_delete);

    $parametros = [
            ':stock' => 0
    ];

    $consulta = [
            'sql'    => $sql_soft_delete,
            'params' => $parametros
    ];

    // Ejecutamos la actualización dentro de una transacción
    transaction($pdo, [ $consulta ]);

    //mostramos los resultados
    $sql_a = "SELECT p.*, c.nombre AS cat_name 
            FROM productos p
            INNER JOIN categorias c ON p.categoria_id = c.id
            WHERE eliminado = 0";

    $stmt_a = $pdo->prepare($sql_a);
    $stmt_a->execute();
    $productos = $stmt_a->fetchAll(PDO::FETCH_ASSOC);

    //imprime el sql usado
    echo "<h2>Muestra el resultado</h2>";
    echo "<h4>Consulta SQL usada:</h4>";
    imprimirBloqueSQL($sql_a);

    //muestra el resultado
    imprimirTablaProductos("Productos no eliminados", $productos);
    echo "</div>";
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //ejercicio 07

    echo "<div class='card-sub'>";
    muestraEnunciado($enunciados[6]);

    //creamos un pedido
    $usuario_id = 1;//alberto
    $producto_id = 1;//naranjas
    $cantidad_comprada = 10; //cantidad

    echo "<p>Simulando compra: Usuario $usuario_id compra $cantidad_comprada uds. del producto $producto_id...</p>";

    try {
        //precio
        $sql_precio = "SELECT precio, nombre FROM productos 
                   WHERE id = :id AND eliminado = 0";

        $stmt_precio = $pdo->prepare($sql_precio);
        $stmt_precio->execute([':id' => $producto_id]);
        $producto = $stmt_precio->fetch(PDO::FETCH_ASSOC);

        //existe?
        if (!$producto) {
            throw new Exception("El producto con ID $producto_id no existe o ha sido eliminado.");
        }

        //pasta total
        $total_pedido = $producto['precio'] * $cantidad_comprada;
        echo "<p>Producto encontrado: {$producto['nombre']}. Total del pedido: $total_pedido €</p>";


        //atacamos la bd

        //update stock
        $update_stock = "UPDATE productos 
                  SET stock = stock - :cantidad 
                  WHERE id = :id AND stock >= :cantidad";
        $query_update_stock = [
                'sql' => $update_stock,
                'params' => [
                        ':cantidad' => $cantidad_comprada,
                        ':id' => $producto_id
                ],
                'check_rows' => true //controla que existan
        ];

        //crea pedido
        $pedido = "INSERT INTO pedidos (usuario_id, total) 
                  VALUES (:user_id, :total_pedido)";
        $query_insert_pedido = [
                'sql' => $pedido,
                'params' => [
                        ':user_id' => $usuario_id,
                        ':total_pedido' => $total_pedido
                ],
        ];

        echo "<h2>Muestra el resultado</h2>";
        echo "<h4>Update del Stock:</h4>";
        imprimirBloqueSQL($update_stock);
        echo "<h4>Insert del pedido:</h4>";
        imprimirBloqueSQL($pedido);

        echo "<h4>Iniciando transacción...</h4>";
        transaction($pdo, [ $query_update_stock, $query_insert_pedido ]);

    } catch (Exception $e) {
        echo "<p class='error'>❌ Error en la preparación de la compra: " . $e->getMessage() . "</p>";
    }

    //resultado
    $sql = "SELECT * FROM pedidos";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    imprimirTablaPedidos("Contenido de tabla Pedidos", $pedidos);

    echo "</div>";
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------
    //ejercicio 08

    echo "<div class='card-sub'>";
    muestraEnunciado($enunciados[7]);








    echo "</div>";
    ?>

</div>
</body>
</html>
