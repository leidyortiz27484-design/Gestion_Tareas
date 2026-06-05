-- ==========================================================================
-- ESTRUCTURA DE LA BASE DE DATOS: GESTIÓN DE TAREAS
-- ==========================================================================

CREATE DATABASE IF NOT EXISTS gestion_tareas DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gestion_tareas;

-- --------------------------------------------------------------------------
-- 1. TABLA DE USUARIOS
-- --------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- --------------------------------------------------------------------------
-- 2. TABLA DE CATEGORÍAS
-- --------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- --------------------------------------------------------------------------
-- 3. TABLA DE TAREAS (PRINCIPAL)
-- --------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    categoria_id INT DEFAULT NULL,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT NULL,
    estado ENUM('pendiente', 'en_progreso', 'completada') DEFAULT 'pendiente',
    fecha_limite DATE NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Relaciones e Integridad Referencial
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- --------------------------------------------------------------------------
-- 4. INSERCIÓN DE DATOS DE PRUEBA (Obligatorio para que funcione index.php)
-- --------------------------------------------------------------------------
INSERT INTO usuarios (id, nombre, email, password) 
VALUES (1, 'Usuario Prueba', 'prueba@correo.com', '123456')
ON DUPLICATE KEY UPDATE id=id;
