CREATE DATABASE IF NOT EXISTS sa_ferrorama ;
USE sa_ferrorama;

CREATE TABLE IF NOT EXISTS usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(20) NOT NULL,
    funcao VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS sensores (
    idSensor INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    localizacao VARCHAR(255) NOT NULL,
    tipo VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS dados(
    idDado INT AUTO_INCREMENT PRIMARY KEY,
    valor INT NOT NULL,
    tipo VARCHAR(20) NOT NULL,
    dataDado DATE NOT NULL,
    idSensor INT NOT NULL,
    FOREIGN KEY (idSensor) REFERENCES sensores(idSensor)
);

INSERT INTO usuarios (nome,email,senha,funcao) VALUES ("Admin","admin@gmail.com","123","Administrador");