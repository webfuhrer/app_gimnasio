-- Creación de la tabla t_ejercicios
CREATE TABLE t_ejercicios (
    id INT AUTO_INCREMENT PRIMARY KEY,     -- ID autoincremental
    id_parte INT,                          -- ID de la parte trabajada (numeración secuencial dentro de cada tipo)
    parte VARCHAR(2),                      -- Parte trabajada (como C, E, H, P, etc.)
    nombre VARCHAR(255),                   -- Nombre del ejercicio
    descripcion TEXT                       -- Descripción del ejercicio
);

-- Insertamos los ejercicios con el correspondiente id_parte
-- Parte C (Core)
INSERT INTO t_ejercicios (id_parte, parte, nombre, descripcion) VALUES
(1, 'C', 'Core calvo', ''),
(2, 'C', 'CORE', ''),
(3, 'C', 'Core en barra', '');

-- Parte E (Espalda)
INSERT INTO t_ejercicios (id_parte, parte, nombre, descripcion) VALUES
(1, 'E', 'Dominadas', ''),
(2, 'E', 'Dominadas tuck gomas', ''),
(3, 'E', 'Dominadas escapulares', ''),
(4, 'E', 'Remo bajo barra', ''),
(5, 'E', 'Maquinaremo', ''),
(6, 'E', 'Remo barra', ''),
(7, 'E', 'Dom. goma', ''),
(8, 'E', 'Dom piramide', ''),
(9, 'E', 'Remo mancuernas', ''),
(10, 'E', 'Jalones al pecho', ''),
(11, 'E', 'Dominadas negativas', ''),
(12, 'E', 'Dominadas negativas', ''),
(13, 'E', 'Dominadas neutras', ''),
(14, 'E', 'TRX', ''),
(15, 'E', 'Dominadas estáticas', '');

-- Parte H (Hombros)
INSERT INTO t_ejercicios (id_parte, parte, nombre, descripcion) VALUES
(1, 'H', 'Frontales Hs', ''),
(2, 'H', 'Pájaros', ''),
(3, 'H', 'Press militar barra', ''),
(4, 'H', 'Elevaciones laterales', ''),
(5, 'H', 'Maquina press Hs', '');

-- Parte PT (Pecho)
INSERT INTO t_ejercicios (id_parte, parte, nombre, descripcion) VALUES
(1, 'PT', 'Flexiones lastradas', ''),
(2, 'PT', 'Paralelas', ''),
(3, 'PT', 'Flexiones', ''),
(4, 'PT', 'Flexiones agarres', ''),
(5, 'PT', 'Flexiones escápulas', ''),
(6, 'PT', 'Press mancuernas', ''),
(7, 'PT', 'Press banca', ''),
(8, 'PT', 'Flexiones montaña+manos abiertas', ''),
(9, 'PT', 'Flexiones arquero', ''),
(10, 'PT', 'Fondos con remo', ''),
(11, 'PT', 'Pirámide paralelas', '');

-- Parte P (Pierna)
INSERT INTO t_ejercicios (id_parte, parte, nombre, descripcion) VALUES
(1, 'P', 'Búlgara', ''),
(2, 'P', 'Bíceps femoral', ''),
(3, 'P', 'Comba', ''),
(4, 'P', 'Elevar gemelos desde escalón', ''),
(5, 'P', 'Salto cajón', ''),
(6, 'P', 'Adbuctores-aductores', ''),
(7, 'P', 'Zancadas', ''),
(8, 'P', 'Propiocepción', ''),
(9, 'P', 'Máquina empuje horizontal', ''),
(10, 'P', 'Hip thrust', ''),
(11, 'P', 'Bajada un pie pistol', ''),
(12, 'P', 'Prensa.Subo con 2 bajo con 1', ''),
(13, 'P', 'Subida puntillas', ''),
(14, 'P', 'Excentrico cuadriceps desde rodillas', '');

-- Parte TR (Tracción)
INSERT INTO t_ejercicios (id_parte, parte, nombre, descripcion) VALUES
(1, 'TR', 'Remo alto', '');

-- Parte X (Estiramiento)
INSERT INTO t_ejercicios (id_parte, parte, nombre, descripcion) VALUES
(1, 'X', 'Estirar', '');


