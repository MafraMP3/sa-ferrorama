CREATE DATABASE IF NOT EXISTS sa_ferrorama_ds2;
USE sa_ferrorama_ds2;

CREATE TABLE IF NOT EXISTS rotas(
    idRota INT AUTO_INCREMENT PRIMARY KEY,
    nomeRota VARCHAR(20) NOT NULL,
    origem VARCHAR(20) NOT NULL,
    destino VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS trens(
    idTrem INT AUTO_INCREMENT PRIMARY KEY,
    nomeTrem VARCHAR(40) NOT NULL,
    tipoCarga VARCHAR(20) NOT NULL,
    modeloTrem VARCHAR(30) NOT NULL,
    idRota INT,
    FOREIGN KEY (idRota) REFERENCES rotas(idRota)
);

CREATE TABLE IF NOT EXISTS usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(20) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    funcao VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS sensores (
    idSensor INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    localizacao VARCHAR(255) NOT NULL,
    tipo VARCHAR(20) NOT NULL,
    dataInstalacao DATE NOT NULL,
    ativo BOOLEAN NOT NULL,
    idTrem INT NOT NULL,
    FOREIGN KEY (idTrem) REFERENCES trens(idTrem)
);

CREATE TABLE IF NOT EXISTS dados(
    idDado INT AUTO_INCREMENT PRIMARY KEY,
    valor DECIMAL(10,2) NOT NULL,
    tipo VARCHAR(20) NOT NULL,
    dataDado DATETIME NOT NULL,
    idSensor INT NOT NULL,
    FOREIGN KEY (idSensor) REFERENCES sensores(idSensor)
);

INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Admin","111.111.111-11","admin@gmail.com","123","Administrador");

INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Caio","211.111.111-11","caio_a_mafra@estudante.sesisenai.org.br","123","Administrador");
INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Fix","121.111.111-11","kauan_fix@estudante.sesisenai.org.br","123","Administrador");
INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Davi","112.111.111-11","davi_sehnem@estudante.sesisenai.org.br","123","Administrador");
INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Lucas","111.211.111-11","lucas_schattenberg@estudante.sesisenai.org.br","123","Administrador");
INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Gustavo","111.121.111-11","gustavo_sena@estudante.sesisenai.org.br","123","Administrador");
INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Xaea12", "248.731.965-42", "Xaea12@estudante.sesisenai.org.br", "123", "Funcionario");


INSERT INTO rotas (nomeRota,origem,destino) VALUES ("Rota Quiriri","Rio da Prata","Estação Quiriri");
INSERT INTO rotas (nomeRota, origem, destino) VALUES ("Rota Serra", "Estação Central", "Serra Quiriri");
INSERT INTO rotas (nomeRota, origem, destino) VALUES ("Rota São Francisco", "Estação de Joinville", "São Francisco do Sul");
INSERT INTO rotas (nomeRota, origem, destino) VALUES ("Rota Dona Francisca", "Estação de Joinville", "Serra Dona Francisca");

INSERT INTO trens (nomeTrem, tipoCarga, modeloTrem, idRota) VALUES ("Expresso Serra", "Carga", "Diesel", 2);
INSERT INTO trens (nomeTrem,tipoCarga,modeloTrem,idRota) VALUES ("Litorina","Passageiros","Diesel",1);
INSERT INTO trens (nomeTrem, tipoCarga, modeloTrem, idRota) VALUES ("Expresso São Francisco", "Passageiros", "Diesel", 3);
INSERT INTO trens (nomeTrem, tipoCarga, modeloTrem, idRota) VALUES ("Expresso Dona Francisca", "Passageiros", "Diesel", 4);

INSERT INTO sensores (nome,localizacao,tipo,dataInstalacao,ativo,idTrem) VALUES ("Sensor de Temperatura","Estação Quiriri","Temperatura",NOW(),1,1);
INSERT INTO sensores (nome, localizacao, tipo, dataInstalacao, ativo, idTrem) VALUES ("Sensor de Velocidade", "Serra Quiriri", "Velocidade", NOW(), 1, 2);



