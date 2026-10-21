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
    usuarioFoto VARCHAR(255) DEFAULT NULL,
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

-- Inserção de Usuários
INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Admin","111.111.111-11","admin@gmail.com","$2y$10$RmOq8VHQTMBO0c/sOuA89.HfhrgBZ8CwDEH9EctyVtfUX7/H9N.jS","Administrador");

INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Caio Mafra","211.111.111-11","caio_a_mafra@estudante.sesisenai.org.br","$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y","Administrador");
INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Kauan Fix","121.111.111-11","kauan_fix@estudante.sesisenai.org.br","$2y$10$wY8I89gEcYL9ngDOMsb1XeDgGoLIwuUZyehDGCIhDETXhDQlesU3q","Administrador");
INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Davi Sehnem","112.111.111-11","davi_sehnem@estudante.sesisenai.org.br","$2y$10$Rw5p4mrHLA2da5w2guxG4e/8VsvNPrAeiuc3TGfzhXHe4D0GMz/AO","Administrador");
INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Lucas Schattenberg","111.211.111-11","lucas_schattenberg@estudante.sesisenai.org.br","$2y$10$6O2GPjoh8GMRuhhFmCbmR..K0jSGrlw0faMPAlLMvZRD6V.nK6cCe","Administrador");
INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Gustavo de Sena","111.121.111-11","gustavo_sena@estudante.sesisenai.org.br","$2y$10$4.t/tNGXpLx7Ely8qcsm4OTvX4aEef366Sv/.Tw8m2S2FKw.NhOAq","Administrador");
INSERT INTO usuarios (nome,cpf,email,senha,funcao) VALUES ("Xaea12 da Silva", "248.731.965-42", "Xaea12@estudante.sesisenai.org.br", "$2y$10$ErCNm6c4uVz84N/bSwgsUOv6nVyD3/n8FCAQEM7QpuLK.76DqBRBa", "Funcionario");

INSERT INTO usuarios (nome, cpf, email, senha, funcao) VALUES
("Davi Batista Caetano", "000.000.000-01", "davi_caetano@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Administrador"),
("Amanda Luise Gonçalves da Maia", "000.000.000-02", "amanda_l_maia@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Ana Luiza Jung", "000.000.000-03", "ana_l_jung@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Andre Foss Alflen", "000.000.000-04", "andre_f_alflen@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Antonio Ribeiro Neto", "000.000.000-05", "antonio_ribeiro-n@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Arthur Lopes Garcia", "000.000.000-06", "arthur_l_garcia@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Arthur Menestrina Heimann", "000.000.000-07", "arthur_heimann@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Beatriz Fröhlich", "000.000.000-08", "beatriz_frohlich@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Bruno Leorci Moraes", "000.000.000-09", "bruno_l_moraes@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Caio Henrique Leite", "000.000.000-11", "caio_leite@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Carine dos Santos", "000.000.000-12", "carine_dos-santos@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Carlos Eduardo Buttke", "000.000.000-13", "carlos_buttke@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Eduarda Bosse de Miranda", "000.000.000-15", "eduarda_b_miranda@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Enzo Nicoletti de Mattos", "000.000.000-16", "enzo_mattos@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Felipe Favero de Oliveira", "000.000.000-17", "felipe_oliveira30@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Fernando Luigi Gadotti", "000.000.000-18", "fernando_gadotti@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Gabriel Maciel Ribeiro", "000.000.000-19", "gabriel_ribeiro16@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Gabriela Baartz Ferreira", "000.000.000-20", "gabriela_b_ferreira@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Guilherme Goll Figueiró", "000.000.000-21", "guilherme_figueiro@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Henrique Marques Tonioti", "000.000.000-23", "henrique_tonioti@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Igor Gabriel Paradella", "000.000.000-24", "igor_paradella@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Julia Barbosa Ferreira", "000.000.000-25", "julia_ferreira3@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Kauã Gabriel Borges", "000.000.000-26", "kaua_borges@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Ketlyn de Melo", "000.000.000-28", "ketlyn_de-melo@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Lucas Onofre Senczuck", "000.000.000-30", "lucas_senczuck@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Lucas Silva Amaral", "000.000.000-31", "lucas_silva-amaral@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Matheus Bernardo de Oliveira Ruekl", "000.000.000-32", "matheus_ruekl@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Matheus Henrique da Silveira", "000.000.000-33", "matheus_silveira9@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Nicolas Zuque de Araujo", "000.000.000-34", "nicolas_z_araujo@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Nordeley Medeiros Corradini", "000.000.000-35", "nordeley_corradini@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Otto Jose Sestrem da Silva", "000.000.000-36", "otto_silva@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Rafael Calegari Descher", "000.000.000-37", "rafael_descher@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Rafael Carlos Melchioretto", "000.000.000-38", "rafael_melchioretto@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario"),
("Thiago Henrique Novaes Berti", "000.000.000-39", "thiago_h_berti@estudante.sesisenai.org.br", "$2y$10$7qRXKuT7iCoe/iQF/jABFOKjB4FnArCOYPQUGdOkbvblKWO/7wR7y", "Funcionario");


-- Inserção de Rotas
INSERT INTO rotas (nomeRota, descricao, distancia, duracao, dataCriacao) VALUES ("Rota Quiriri", "Trajeto entre Rio da Prata e Estação Quiriri", 15, 30, "2026-01-10");
INSERT INTO rotas (nomeRota, descricao, distancia, duracao, dataCriacao) VALUES ("Rota Serra", "Trajeto entre Estação Central e Serra Quiriri", 20, 45, "2026-01-12");
INSERT INTO rotas (nomeRota, descricao, distancia, duracao, dataCriacao) VALUES ("Rota São Francisco", "Trajeto entre Estação de Joinville e São Francisco do Sul", 40, 60, "2026-01-15");
INSERT INTO rotas (nomeRota, descricao, distancia, duracao, dataCriacao) VALUES ("Rota Dona Francisca", "Trajeto entre Estação de Joinville e Serra Dona Francisca", 25, 50, "2026-01-20");
INSERT INTO rotas (nomeRota, descricao, distancia, duracao, dataCriacao) VALUES ("Rota Babitonga", "Trajeto entre Estação de Joinville e Baía da Babitonga", 35, 55, "2026-01-22");
INSERT INTO rotas (nomeRota, descricao, distancia, duracao, dataCriacao) VALUES ("Rota Araquari", "Trajeto entre Estação de Joinville e Estação de Araquari", 25, 40, "2026-01-25");
INSERT INTO rotas (nomeRota, descricao, distancia, duracao, dataCriacao) VALUES ("Rota Guaramirim", "Trajeto entre Estação de Joinville e Estação de Guaramirim", 45, 65, "2026-01-28");
INSERT INTO rotas (nomeRota, descricao, distancia, duracao, dataCriacao) VALUES ("Rota Jaraguá", "Trajeto entre Estação de Guaramirim e Jaraguá do Sul", 20, 35, "2026-02-02");
INSERT INTO rotas (nomeRota, descricao, distancia, duracao, dataCriacao) VALUES ("Rota Campo Alegre", "Trajeto entre Estação de São Bento do Sul e Campo Alegre", 30, 50, "2026-02-05");
INSERT INTO rotas (nomeRota, descricao, distancia, duracao, dataCriacao) VALUES ("Rota Planalto Norte", "Trajeto entre Estação de Joinville e Estação de Mafra", 100, 120, "2026-02-10");

-- Inserção de Trens
INSERT INTO trens (nomeTrem, tipoCarga, modeloTrem, idRota, idUsuario) VALUES ("Expresso Serra", "Carga", "Diesel", 2, 1);
INSERT INTO trens (nomeTrem, tipoCarga, modeloTrem, idRota, idUsuario) VALUES ("Litorina", "Passageiros", "Diesel", 1, 2);
INSERT INTO trens (nomeTrem, tipoCarga, modeloTrem, idRota, idUsuario) VALUES ("Expresso São Francisco", "Passageiros", "Diesel", 3, 3);
INSERT INTO trens (nomeTrem, tipoCarga, modeloTrem, idRota, idUsuario) VALUES ("Expresso Dona Francisca", "Passageiros", "Diesel", 4, 4);
INSERT INTO trens (nomeTrem, tipoCarga, modeloTrem, idRota, idUsuario) VALUES ("Expresso Babitonga", "Carga", "Diesel", 5, 5);
INSERT INTO trens (nomeTrem, tipoCarga, modeloTrem, idRota, idUsuario) VALUES ("Litorina Araquari", "Passageiros", "Diesel", 6, 6);
INSERT INTO trens (nomeTrem, tipoCarga, modeloTrem, idRota, idUsuario) VALUES ("Expresso Guaramirim", "Carga", "Diesel", 7, 7);
INSERT INTO trens (nomeTrem, tipoCarga, modeloTrem, idRota, idUsuario) VALUES ("Expresso Jaraguá", "Passageiros", "Diesel", 8, 8);
INSERT INTO trens (nomeTrem, tipoCarga, modeloTrem, idRota, idUsuario) VALUES ("Expresso Campo Alegre", "Carga", "Diesel", 9, 9);
INSERT INTO trens (nomeTrem, tipoCarga, modeloTrem, idRota, idUsuario) VALUES ("Expresso Planalto Norte", "Carga", "Diesel", 10, 10);

-- Inserção de Sensores
INSERT INTO sensores (nome, localizacao, tipo, dataInstalacao, ativo, idTrem) VALUES
("Sensor de Temperatura","Estação Quiriri","Temperatura",NOW(),1,1),
("Sensor de Velocidade", "Serra Quiriri", "Velocidade", NOW(), 1, 2),
("Sensor de Temperatura 2", "Estação Central", "Temperatura", NOW(), 1, 3),
("Sensor de Velocidade 2", "Baía da Babitonga", "Velocidade", NOW(), 1, 4),
("Sensor de Energia", "Estação de Araquari", "Energia", NOW(), 1, 5),
("Sensor de Temperatura 3", "Estação de Guaramirim", "Temperatura", NOW(), 1, 6),
("Sensor de Velocidade 3", "Estação de Jaraguá do Sul", "Velocidade", NOW(), 1, 7),
("Sensor de Energia 2", "Estação de Campo Alegre", "Energia", NOW(), 1, 8),
("Sensor de Temperatura 4", "Planalto Norte", "Temperatura", NOW(), 1, 9),
("Sensor de Velocidade 4", "Estação São Francisco", "Velocidade", NOW(), 1, 10);



