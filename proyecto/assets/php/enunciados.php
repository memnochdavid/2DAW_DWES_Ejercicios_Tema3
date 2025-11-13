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
    //ej01
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
    )
];