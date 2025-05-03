CREATE TABLE t_observaciones_ejercicios (
    id INT AUTO_INCREMENT PRIMARY KEY,    -- ID único para cada observación
    id_ejercicio INT NOT NULL,            -- ID del ejercicio asociado
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP, -- Fecha de la observación (automáticamente actualiza con la fecha y hora actual)
    observaciones TEXT          -- Texto de la observación
    
);
