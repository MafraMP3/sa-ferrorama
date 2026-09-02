CREATE DATABASE IF NOT EXISTS sa_ferrorama ;
USE sa_ferrorama;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(40) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(20) NOT NULL,
    funcao VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS sensores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(40) NOT NULL,
    localizacao VARCHAR(255) NOT NULL,
    tipo VARCHAR(20) NOT NULL
);

INSERT INTO usuarios (nome,email,senha,funcao) VALUES ("Admin","admin@gmail.com","123","Administrador");