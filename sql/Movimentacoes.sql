-- Active: 1675304380784@@127.0.0.1@3306@diariomotorista
CREATE DATABASE DiarioMotorista;
USE DiarioMotorista;
CREATE TABLE movimentacoes (
        movimentacao_id INT AUTO_INCREMENT NOT NULL,
        movimentacao_usuarioID INT NOT NULL,
        movimentacao_tipo VARCHAR(15) NOT NULL,
        movimentacao_origem VARCHAR(15) NOT NULL,
        movimentacao_valor DECIMAL(10,2) NOT NULL,
        movimentacao_dataCriacao DATETIME NOT NULL,
        movimentacao_dataAtualizacao DATETIME,
        PRIMARY KEY(movimentacao_id)
);