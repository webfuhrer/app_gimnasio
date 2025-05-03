CREATE TABLE t_entrenos_plantilla (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- Clave primaria, autoincremental
	id_entreno INT,
    id_ejercicio INT NOT NULL,                 -- id_ejercicio que no puede ser NULL
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Fecha de creación con valor por defecto de la fecha actual
);
