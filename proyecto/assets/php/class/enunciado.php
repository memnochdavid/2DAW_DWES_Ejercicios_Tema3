<?php
class Enunciado
{
    // Propiedades
    public int $num;
    public string $titulo;
    public string $enunciado;
    public array $apartados;
    public string $pista;

    /**
     * Constructor de la clase Enunciados.
     *
     * @param int $num El número del ejercicio.
     * @param string $titulo El título principal.
     * @param string $enunciado La descripción o pregunta principal.
     * @param array $apartados (Opcional) Una lista de puntos o sub-tareas.
     * @param string|null $pista (Opcional) Una pista.
     */
    public function __construct(int $num, string $titulo, string $enunciado, array $apartados = [], ?string $pista = null)
    {
        $this->num = $num;
        $this->titulo = $titulo;
        $this->enunciado = $enunciado;
        $this->apartados = $apartados;
        $this->pista = $pista;

    }
}

$enunciados = [
    new Enunciado(
        1, // $num
        "Crear la BD de Tienda de Frutas", // $titulo
        "Crea una base de datos llamada \"tienda_frutas\" con las siguientes tablas:", // $enunciado
        [ // $apartados
            "categorias (id, nombre, descripción)",
            "productos (id, nombre, categoria_id, precio, stock)",
            "usuarios (id, nombre, email, contraseña)",
            "pedidos (id, usuario_id, fecha, total)"
        ],
        "Usa PRIMARY KEY, FOREIGN KEY y NOT NULL donde sea necesario" // $pista
    ),
    new Enunciado(
        2,
        "Insertar datos iniciales",
        "Inserta al menos 3 categorías (Cítricos, Frutas Rojas, Tropicales) y 10 productos diferentes con sus precios y stock.",
        [],
        "Inserta al menos 3 categorías (Cítricos, Frutas Rojas, Tropicales) y 10 productos diferentes con sus precios y stock."
    ),
    new Enunciado(
        3,
        "Consultas SELECT básicas",
        "Escribe consultas PHP para:",
        [
            "Obtener todos los productos ordenados por precio (menor a mayor)",
            "Obtener productos de una categoría específica",
            "Obtener productos con stock menor a 20",
            "Contar cuántos productos hay en total",
        ],
        "Usa prepared statements con parámetros"
    ),
    new Enunciado(
        4,
        "JOIN - Productos con categoría",
        "Escribe una consulta que obtenga el nombre del producto, su precio y el nombre de su categoría. Usa INNER JOIN.Luego, ordena los resultados por categoría y dentro de cada categoría por precio.",
        [],
        "SELECT p.nombre, p.precio, c.nombre FROM productos p INNER JOIN categorias c..."
    ),
    new Enunciado(
        5,
        "UPDATE - Cambiar precios",
        "Crea un script PHP que:",
        [
            "Aumente el precio de todos los productos de una categoría en un 10%",
            "Reduzca el stock de un producto específico cuando se realiza una compra",
            "Valide que el stock no sea negativo antes de actualizar"
        ],
        "Usa transacciones para garantizar que ambas operaciones se completen"
    ),
    new Enunciado(
        6,
        "DELETE - Eliminar productos",
        "Crea un script que elimine productos sin stock (stock = 0). Pero antes, implementa un soft delete añadiendo una columna 'eliminado' en la tabla productos. Luego, modifica tus consultas SELECT para no mostrar productos eliminados.",
        [],
        "Usa UPDATE en lugar de DELETE para marcar como eliminado"
    ),
    new Enunciado(
        7,
        "Simulación de compra",
        "Crea un script que simule una compra:",
        [
            "Crear un nuevo pedido para un usuario",
            "Reducir el stock del producto",
            "Calcular el total del pedido",
            "Usar transacciones para garantizar consistencia",
            "Manejar errores (stock insuficiente, usuario no existe, etc.)",
        ],
        "Usa try-catch con PDOException y beginTransaction()"
    ),
    new Enunciado(
        8,
        "Reportes y análisis",
        "Crea consultas que generen reportes:",
        [
            "Productos más vendidos (requiere tabla de detalles de pedidos)",
            "Ingresos totales por categoría",
            "Productos con bajo stock (< 10 unidades)",
            "Usuarios con más compras",
        ],
        "Usa GROUP BY, SUM(), COUNT() y ORDER BY para análisis"
    ),
];