-- Active: 1675304380784@@127.0.0.1@3306
CREATE DATABASE DiarioMotorista;
USE DiarioMotorista;
CREATE TABLE receitas (
        receita_id INT AUTO_INCREMENT NOT NULL,
        receita_quantidade DECIMAL (10,2) NOT NULL,
        receita_origem VARCHAR (10) NOT NULL,
        receita_data DATE NOT NULL,
        PRIMARY KEY(receita_id)
);