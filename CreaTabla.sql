CREATE DATABASE IF NOT EXISTS gimnasio;

USE gimnasio;
CREATE TABLE IF NOT EXISTS  t_observaciones_ejercicios (
    id INT AUTO_INCREMENT PRIMARY KEY,    -- ID único para cada observación
    id_ejercicio INT NOT NULL,            -- ID del ejercicio asociado
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP, -- Fecha de la observación (automáticamente actualiza con la fecha y hora actual)
    observaciones TEXT          -- Texto de la observación
    
);

CREATE TABLE IF NOT EXISTS  t_entrenos_hechos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_ent INT NOT NULL,
    fecha DATE NOT NULL
    
);
CREATE TABLE IF NOT EXISTS  t_entrenos_plantilla (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- Clave primaria, autoincremental
	id_entreno INT,
    id_ejercicio INT NOT NULL,                 -- id_ejercicio que no puede ser NULL
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Fecha de creación con valor por defecto de la fecha actual
);

-- Creación de la tabla t_ejercicios
CREATE TABLE IF NOT EXISTS  t_ejercicios (
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


