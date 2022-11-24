CREATE DATABASE db_escola;

USE db_escola;

CREATE TABLE tb_alunos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    matricula VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    status TINYINT NOT NULL,
    genero VARCHAR(100) NOT NULL,
    dataNascimento DATETIME NOT NULL,
    cpf CHAR(11) UNIQUE NOT NULL
);

INSERT INTO tb_alunos
(nome, matricula, email, status, genero, dataNascimento, cpf)
VALUES
('maria', '1223456', 'maria@email.com', true, 'feminino', '2001-09-04', '12345678900'),
('ze', '1223457', 'ze@email.com', true, 'feminino', '2001-08-24', '12345678901'),
('antoin', '1223458', 'antoin@email.com', true, 'feminino', '2001-05-15', '12345678902')
;

SELECT * FROM tb_alunos;

CREATE TABLE tb_professores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    cpf CHAR(11) UNIQUE NOT NULL,
    endereco VARCHAR(100) UNIQUE NOT NULL,
    formacao VARCHAR(100) UNIQUE NOT NULL,
    status TINYINT NOT NULL
);

INSERT INTO tb_professores
(nome, cpf, endereco, formacao, status)
VALUES
('lorao', '12345678900', 'ruas dos loiros', 'enrolador de codigo', true),
('allan cahorro e chuchu', '12345678901', 'rua vira latas', 'criados de cachorros e chuchus', false),
('adirano', '12345678902', 'rua crossfit', 'fazedor de rapadura', true)
;

SELECT * FROM tb_professores;