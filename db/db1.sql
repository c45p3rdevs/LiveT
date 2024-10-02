CREATE DATABASE streaming_platform;

USE streaming_platform;

-- Tabla para almacenar videos
CREATE TABLE videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    video_url VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla para usuarios (administradores)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,  -- La contraseña debe ser almacenada hasheada
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
