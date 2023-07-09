DROP DATABASE IF EXISTS salas_db;
CREATE DATABASE salas_db;

USE salas_db;

-- Tabla "salas"
CREATE TABLE salas (
    id_sala INT PRIMARY KEY,
    nombresala VARCHAR(50),
    capacidad INT,
    descripcionsala VARCHAR(50),
    ubicacion VARCHAR(100),
    INDEX idx_nombresala (nombresala)
);

-- Tabla "usuarios"
CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY,
    nombreusuario VARCHAR(50),
    correo VARCHAR(100),
    contraseña VARCHAR(100),
    INDEX idx_nombreusuario (nombreusuario) -- Agrega un índice en la columna 'nombreusuario'
);

-- Tabla "reservaciones"
CREATE TABLE reservaciones (
    id_reservacion INT PRIMARY KEY,
    id_sala INT,
    nombresala VARCHAR(50),
    id_usuario INT,
    nombreusuario VARCHAR(50),
    fecha_inicio DATETIME,
    fecha_fin DATETIME,
    motivo VARCHAR(200),
    FOREIGN KEY (id_sala) REFERENCES salas(id_sala),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (nombresala) REFERENCES salas(nombresala),
    FOREIGN KEY (nombreusuario) REFERENCES usuarios(nombreusuario)
);

SELECT * FROM salas;
