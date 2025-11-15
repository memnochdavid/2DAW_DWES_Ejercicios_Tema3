-- Asegurarse de que estamos usando la base de datos correcta
USE tienda_frutas;

-- 1. Insertar las 3 categorías
-- (Asumimos que 'Cítricos' será id=1, 'Frutas Rojas' id=2, 'Tropicales' id=3)
INSERT INTO categorias (nombre, descripcion) VALUES
('Cítricos', 'Frutas ricas en vitamina C, de sabor ácido.'),
('Frutas Rojas', 'Frutas del bosque y bayas, ricas en antioxidantes.'),
('Tropicales', 'Frutas de climas cálidos y exóticos.');

-- 2. Insertar 10 productos variados
-- Usamos los IDs de categoría (1, 2, 3) que acabamos de crear
INSERT INTO productos (nombre, categoria_id, precio, stock) VALUES
-- Cítricos (categoria_id = 1)
('Naranja', 1, 1.50, 100),
('Limón', 1, 1.20, 80),
('Mandarina', 1, 1.80, 120),

-- Frutas Rojas (categoria_id = 2)
('Fresa', 2, 4.50, 50),
('Arándano', 2, 5.00, 40),
('Frambuesa', 2, 6.00, 30),

-- Tropicales (categoria_id = 3)
('Mango', 3, 2.50, 60),
('Piña', 3, 3.00, 45),
('Papaya', 3, 2.80, 35),
('Kiwi', 3, 2.20, 70);

INSERT INTO usuarios (nombre, email, contraseña) VALUES
("Alberto", "alberto@correo.com", "1234"),
("Mónica", "monica@correo.com", "1234"),
("Sara", "sara@correo.com", "1234"),
("Juan", "juan@correo.com", "1234");
