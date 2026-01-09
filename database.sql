-- Active: 1767893039539@@127.0.0.1@3306
-- Creación de la base de datos para el foro de relojes
CREATE DATABASE foro_php CHARACTER SET utf8mb4;
USE foro_php;

-- Tabla para gestionar los usuarios de la comunidad
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, -- Almacena el hash de la contraseña
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla para las publicaciones de relojes (incluye campo brand)
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    brand VARCHAR(50) NOT NULL, -- Marca del reloj
    title VARCHAR(150) NOT NULL, -- Modelo o título
    content TEXT NOT NULL, -- Detalles técnicos o descripción
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabla para los comentarios en cada publicación
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

ALTER TABLE users ADD COLUMN avatar INT DEFAULT 1 AFTER password;
