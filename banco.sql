SCRIPT DE INICIALIZAÇÃO DO BANCO DE DADOS - MINIMERCADO

-- Criação do banco de dados.
CREATE DATABASE IF NOT EXISTS bd_minimercado;
USE bd_minimercado;

-- Estrutura da tabela de clientes do programa de fidelidade
CREATE TABLE IF NOT EXISTS tb_clientes (
    codigo INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(90) NOT NULL,
    email VARCHAR(110) NOT NULL,
    idade INT NOT NULL
);

-- Estrutura da tabela de produtos para controle de estoque e validade
CREATE TABLE IF NOT EXISTS tb_produtos (
    codigo INT PRIMARY KEY AUTO_INCREMENT,
    nome_produto VARCHAR(90) NOT NULL,
    lote INT NOT NULL,
    validade DATE NOT NULL
);

-- Comandos utilitários de conferência
SHOW TABLES;
DESC tb_clientes;
DESC tb_produtos;
SELECT * FROM tb_produtos;
SELECT * FROM tb_clientes;
