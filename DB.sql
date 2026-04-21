CREATE DATABASE IF NOT EXISTS inscripciones_ugb;

USE inscripciones_ugb;


-- TABLA USUARIOS
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    clave VARCHAR(255) NOT NULL,
    rol VARCHAR(20) NOT NULL
);


-- TABLA ESTUDIANTES
CREATE TABLE estudiantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NULL,
    telefono VARCHAR(20) NOT NULL,
    carrera VARCHAR(100) NOT NULL,
    sexo ENUM('Masculino','Femenino') NOT NULL,
    beca TINYINT(1) NOT NULL DEFAULT 0,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- USUARIO LOGIN
-- usuario: admin
-- contraseña: admin

INSERT INTO usuarios(nombre,usuario,clave,rol)
VALUES(
'Administrador',
'admin',
'admin',
'admin'
);


-- 5 REGISTROS DE PRUEBA
INSERT INTO estudiantes
(nombres, apellidos, correo, telefono, carrera, sexo, beca)
VALUES
('Ana Maria','Lopez','ana@gmail.com','7000-1111','Ingenieria en Sistemas','Femenino',1),

('Carlos','Hernandez',NULL,'7111-2222','Administracion','Masculino',0),

('Sofia','Castillo','sofia@gmail.com','7222-3333','Arquitectura','Femenino',1),

('Luis','Ramirez','luis@gmail.com','7333-4444','Contaduria','Masculino',0),

('Maria','Vasquez','maria@gmail.com','7444-5555','Mercadeo','Femenino',1);