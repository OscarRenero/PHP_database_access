-- Creación de la base de datos con soporte para caracteres especiales (emojis, tildes, etc.)
CREATE DATABASE foro_php CHARACTER SET utf8mb4;
USE foro_php;

-- Tabla de usuarios: almacena credenciales y datos de registro
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único autoincremental
    username VARCHAR(50) UNIQUE NOT NULL, -- Nombre de usuario único
    email VARCHAR(100) UNIQUE NOT NULL, -- Correo electrónico único
    password VARCHAR(255) NOT NULL, -- Contraseña (almacena el hash)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Fecha de registro automática
);

-- Tabla de publicaciones: almacena el contenido creado por los usuarios
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL, -- Relación con el autor (tabla users)
    title VARCHAR(150) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- Clave foránea: elimina los posts si el usuario es borrado
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabla de comentarios: almacena las respuestas en cada publicación
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL, -- Relación con el post origen
    user_id INT NOT NULL, -- Relación con el autor del comentario
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- Claves foráneas: limpieza automática al borrar posts o usuarios
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
