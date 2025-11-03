-- Corrigir o banco de dados
DROP DATABASE IF EXISTS cipat_db;
CREATE DATABASE cipat_db;
USE cipat_db;

-- Tabela principal de participantes
CREATE TABLE participantes (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

-- Tabela primeiro_dia corrigida
CREATE TABLE primeiro_dia (
    nome VARCHAR(100) PRIMARY KEY,
    codigo_participante INT NOT NULL,
    FOREIGN KEY (codigo_participante) REFERENCES participantes(codigo)
);

-- Palestra Inclusão corrigida
CREATE TABLE palestra_inclusao (
    nome VARCHAR(100) PRIMARY KEY,
    codigo_participante INT NOT NULL,
    FOREIGN KEY (codigo_participante) REFERENCES participantes(codigo)
);

-- Palestra EPI corrigida
CREATE TABLE epi (
    nome VARCHAR(100) PRIMARY KEY,
    codigo_participante INT NOT NULL,
    FOREIGN KEY (codigo_participante) REFERENCES participantes(codigo)
);

-- Palestra Meio Ambiente corrigida
CREATE TABLE meio_ambiente (
    nome VARCHAR(100) PRIMARY KEY,
    codigo_participante INT NOT NULL,
    FOREIGN KEY (codigo_participante) REFERENCES participantes(codigo)
);

-- Palestra Saúde da Voz corrigida
CREATE TABLE saude_da_voz (
    nome VARCHAR(100) PRIMARY KEY,
    codigo_participante INT NOT NULL,
    FOREIGN KEY (codigo_participante) REFERENCES participantes(codigo)
);