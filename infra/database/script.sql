CREATE DATABASE IF NOT EXISTS sa_ferrorama_ds2;
USE sa_ferrorama_ds2;

CREATE TABLE IF NOT EXISTS rotas(
    idRota INT AUTO_INCREMENT PRIMARY KEY,
    nomeRota VARCHAR(20) NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    distancia INT NOT NULL,
    duracao INT NOT NULL,
    dataCriacao DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    funcao VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS trens(
    idTrem INT AUTO_INCREMENT PRIMARY KEY,
    nomeTrem VARCHAR(40) NOT NULL,
    tipoCarga VARCHAR(20) NOT NULL,
    modeloTrem VARCHAR(30) NOT NULL,
    idRota INT NOT NULL,
    FOREIGN KEY (idRota) REFERENCES rotas(idRota),
    idUsuario INT NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES usuarios (idUsuario)
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

INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Admin","111.111.111-11","admin@gmail.com","$2y$10$RmOq8VHQTMBO0c/sOuA89.HfhrgBZ8CwDEH9EctyVtfUX7/H9N.jS","Administrador");

INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Caio","211.111.111-11","caio_a_mafra@estudante.sesisenai.org.br","$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y","Administrador");
INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Fix","121.111.111-11","kauan_fix@estudante.sesisenai.org.br","$2y$10$wY8I89gEcYL9ngDOMsb1XeDgGoLIwuUZyehDGCIhDETXhDQlesU3q","Administrador");
INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Davi","112.111.111-11","davi_sehnem@estudante.sesisenai.org.br","$2y$10$Rw5p4mrHLA2da5w2guxG4e/8VsvNPrAeiuc3TGfzhXHe4D0GMz/AO","Administrador");
INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Lucas","111.211.111-11","lucas_schattenberg@estudante.sesisenai.org.br","$2y$10$6O2GPjoh8GMRuhhFmCbmR..K0jSGrlw0faMPAlLMvZRD6V.nK6cCe","Administrador");
INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Gustavo","111.121.111-11","gustavo_sena@estudante.sesisenai.org.br","$2y$10$4.t/tNGXpLx7Ely8qcsm4OTvX4aEef366Sv/.Tw8m2S2FKw.NhOAq","Administrador");
INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Xaea12", "248.731.965-42", "Xaea12@estudante.sesisenai.org.br", "$2y$10$ErCNm6c4uVz84N/bSwgsUOv6nVyD3/n8FCAQEM7QpuLK.76DqBRBa", "Funcionario");


INSERT INTO rotas (nomeRota, descricao, distancia, duracao, dataCriacao) VALUES ("Rota Quiriri", "Trajeto entre Rio da Prata e Estação Quiriri", 15, 30, "2026-01-10");
INSERT INTO rotas (nomeRota, descricao, distancia, duracao, dataCriacao) VALUES ("Rota Serra", "Trajeto entre Estação Central e Serra Quiriri", 20, 45, "2026-01-12");
INSERT INTO rotas (nomeRota, descricao, distancia, duracao, dataCriacao) VALUES ("Rota São Francisco", "Trajeto entre Estação de Joinville e São Francisco do Sul", 40, 60, "2026-01-15");
INSERT INTO rotas (nomeRota, descricao, distancia, duracao, dataCriacao) VALUES ("Rota Dona Francisca", "Trajeto entre Estação de Joinville e Serra Dona Francisca", 25, 50, "2026-01-20");

INSERT INTO trens (nomeTrem, tipoCarga, modeloTrem, idRota, idUsuario) VALUES ("Expresso Serra", "Carga", "Diesel", 2, 1);
INSERT INTO trens (nomeTrem, tipoCarga, modeloTrem, idRota, idUsuario) VALUES ("Litorina", "Passageiros", "Diesel", 1, 2);
INSERT INTO trens (nomeTrem, tipoCarga, modeloTrem, idRota, idUsuario) VALUES ("Expresso São Francisco", "Passageiros", "Diesel", 3, 3);
INSERT INTO trens (nomeTrem, tipoCarga, modeloTrem, idRota, idUsuario) VALUES ("Expresso Dona Francisca", "Passageiros", "Diesel", 4, 4);


INSERT INTO sensores (nome,localizacao,tipo,dataInstalacao,ativo,idTrem) VALUES ("Sensor de Temperatura","Estação Quiriri","Temperatura",NOW(),1,1);
INSERT INTO sensores (nome, localizacao, tipo, dataInstalacao, ativo, idTrem) VALUES ("Sensor de Velocidade", "Serra Quiriri", "Velocidade", NOW(), 1, 2);



