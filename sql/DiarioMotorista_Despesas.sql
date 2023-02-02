-- Active: 1675304380784@@127.0.0.1@3306@diariomotorista
CREATE DATABASE DiarioMotorista;
USE DiarioMotorista;
CREATE TABLE despesas (
        despesa_id INT AUTO_INCREMENT NOT NULL,
        despesa_quantidade DECIMAL (10,2) NOT NULL,
        despesa_origem VARCHAR (15) NOT NULL,
        despesa_data DATE NOT NULL,
        PRIMARY KEY(despesa_id)
);