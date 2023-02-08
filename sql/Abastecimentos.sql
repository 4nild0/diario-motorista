CREATE DATABASE DiarioMotorista;
USE DiarioMotorista;
CREATE TABLE abastecimentos (
        abastecimento_id INT AUTO_INCREMENT NOT NULL,
        abastecimento_usuarioID INT NOT NULL,
        abastecimento_movimentacaoID INT NOT NULL,
        abastecimento_valorTotal DECIMAL(10,2) NOT NULL,
        abastecimento_valorLitro DECIMAL(10,2) NOT NULL,
        abastecimento_dataCriacao DATETIME NOT NULL,
        abastecimento_dataAtualizacao DATETIME,
        PRIMARY KEY(abastecimento_id)
);