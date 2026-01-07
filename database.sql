-- Creación de la base de datos con soporte para emojis y tildes
CREATE DATABASE foro_php CHARACTER SET utf8mb4;
USE foro_php;

-- Tabla de usuarios registrados en la comunidad
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY, -- ID único para cada usuario
    username VARCHAR(50) UNIQUE NOT NULL, -- Nombre de usuario único
    email VARCHAR(100) UNIQUE NOT NULL, -- Correo de contacto único
    password VARCHAR(255) NOT NULL, -- Hash de la contraseña de seguridad
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Fecha de registro
);

-- Tabla de publicaciones de relojes
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY, -- ID del post
    user_id INT NOT NULL, -- Relación con el usuario autor
    brand VARCHAR(50) NOT NULL, -- Marca del reloj (específico de WatchYourPost)
    title VARCHAR(150) NOT NULL, -- Modelo o título de la pieza
    content TEXT NOT NULL, -- Descripción detallada del reloj
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de publicación
    -- Si se borra el usuario, se borran sus relojes automáticamente
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabla de comentarios en los hilos de relojes
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL, -- Relación con el post comentado
    user_id INT NOT NULL, -- Relación con el autor del comentario
    content TEXT NOT NULL, -- Contenido del comentario técnico
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- Limpieza automática de datos relacionados
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
