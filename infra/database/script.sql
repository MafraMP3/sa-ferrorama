-- ⚠️ FALTA: tabelas "trens", "rotas" e "relatorios" nao existem ainda.
--    O enunciado pede sensor "vinculado a um trem especifico" (item 4)
--    e telas de Cadastro/Visualizacao de Relatorios (itens 8 e 9).

CREATE DATABASE IF NOT EXISTS sa_ferrorama ;
USE sa_ferrorama;

CREATE TABLE IF NOT EXISTS usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    -- ⚠️ ERRO: VARCHAR(20) nao cabe hash de senha (password_hash gera ~60 caracteres).
    --    Hoje a senha esta salva em texto puro (ver index.php). Trocar para VARCHAR(255).
    senha VARCHAR(20) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    funcao VARCHAR(20) NOT NULL
    -- ⚠️ FALTA: email deveria ser UNIQUE, hoje da pra cadastrar o mesmo email 2x.
);

CREATE TABLE IF NOT EXISTS sensores (
    idSensor INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    localizacao VARCHAR(255) NOT NULL,
    tipo VARCHAR(20) NOT NULL
     -- ⚠️ FALTA: idTrem INT NOT NULL + FOREIGN KEY para trens(idTrem).
    --    O enunciado pede sensor vinculado a um trem especifico (item 4).
    -- ⚠️ FALTA: dataInstalacao, ativo (usado na tela de exclusao/regra de negocio),
    --    latitude/longitude (item 7 pede "localizacao em mapa").
);

CREATE TABLE IF NOT EXISTS dados(
    idDado INT AUTO_INCREMENT PRIMARY KEY,
    -- ⚠️ ERRO: valor deveria ser DECIMAL(10,2), velocidade/temperatura tem casas decimais.
    valor INT NOT NULL,
    tipo VARCHAR(20) NOT NULL,
    -- ⚠️ ERRO: dataDado esta como DATE (so dia). Monitoramento em tempo real
    --    precisa de hora/minuto/segundo -> deveria ser DATETIME.
    dataDado DATE NOT NULL,
    idSensor INT NOT NULL,
    FOREIGN KEY (idSensor) REFERENCES sensores(idSensor)
);

-- ⚠️ FALTA: nao existem INSERTs de teste para "sensores" e "dados".
--    O checklist (item 1) pede pelo menos 3 registros em TODAS as tabelas.

INSERT INTO usuarios (nome,email,senha,funcao) VALUES ("Admin","admin@gmail.com","123","Administrador");

INSERT INTO usuarios (nome,email,senha,funcao) VALUES ("Caio","caio_a_mafra@estudante.sesisenai.org.br","123","Administrador");
INSERT INTO usuarios (nome,email,senha,funcao) VALUES ("Fix","kauan_fix@estudante.sesisenai.org.br","123","Administrador");
INSERT INTO usuarios (nome,email,senha,funcao) VALUES ("Davi","davi_sehnem@estudante.sesisenai.org.br","123","Administrador");
INSERT INTO usuarios (nome,email,senha,funcao) VALUES ("Lucas","lucas_schattenberg@estudante.sesisenai.org.br","123","Administrador");
INSERT INTO usuarios (nome,email,senha,funcao) VALUES ("Gustavo","gustavo_sena@estudante.sesisenai.org.br","123","Administrador");