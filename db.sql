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

CREATE TABLE tb_professores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    cpf CHAR(11) UNIQUE NOT NULL,
    endereco VARCHAR(100) UNIQUE NOT NULL,
    formacao VARCHAR(100) UNIQUE NOT NULL,
    status TINYINT NOT NULL
);

CREATE TABLE tb_user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) UNIQUE NOT NULL,
    profile VARCHAR(255) UNIQUE NOT NULL,
  
);

CREATE TABLE tb_categorias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL
);

CREATE TABLE tb_cursos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    cargaHoraria VARCHAR(50) NOT NULL,
    descricao VARCHAR(100) UNIQUE NOT NULL,
    status TINYINT NOT NULL,
    categoria_id INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES tb_categorias(id)
);

-- INSERT INTO tb_alunos
-- (nome, matricula, email, status, genero, dataNascimento, cpf)
-- VALUES
-- ('maria', '1223456', 'maria@email.com', true, 'feminino', '2001-09-04', '12345678900'),
-- ('ze', '1223457', 'ze@email.com', true, 'feminino', '2001-08-24', '12345678901'),
-- ('antoin', '1223458', 'antoin@email.com', true, 'feminino', '2001-05-15', '12345678902')
-- ;

-- SELECT * FROM tb_alunos;



-- INSERT INTO tb_professores
-- (nome, cpf, endereco, formacao, status)
-- VALUES
-- ('lorao', '12345678900', 'ruas dos loiros', 'enrolador de codigo', true),
-- ('allan cahorro e chuchu', '12345678901', 'rua vira latas', 'criados de cachorros e chuchus', false),
-- ('adirano', '12345678902', 'rua crossfit', 'fazedor de rapadura', true)
-- ;

-- SELECT * FROM tb_professores;

-- INSERT INTO tb_user
-- (name, email, password, profile)
-- VALUES
-- ('loraoDC', 'lorao@email.com', '12345', 'enrolador de codigo'),
-- ('allan345', 'allan@email.com', '12346', 'criados de cachorros e chuchus'),
-- ('adrianoDaRapasiada', 'adriano@email.com', '12347', 'fazedor de rapadura')
-- ;

-- INSERT INTO tb_user
-- (name, email, password, profile)
-- VALUES
-- ('maria', 'maria@email.com','12348', 'legal'),
-- ('ze', 'ze@email.com',  '12349', 'gente fina'),
-- ('antoin', 'antoin@email.com', '123410', 'invocado')
-- ;

-- SELECT * FROM tb_user;





-- INSERT INTO tb_categorias (nome) VALUES ('Profissionalizante'), ('Tecnico'), ('Graduação');

-- INSERT INTO tb_cursos
-- (nome, cargaHoraria, descricao, status, categoria_id)
-- VALUES
-- ('Domador de elefante PHP','200','Desenrolar os bem bolados',1,1),
-- ('Javasprict','160','Copiar e colar coisas',1,2),
-- ('HTML e CSS','100','Construir páginas como um pedreiro da web',1,3)
-- ;

-- SELECT * FROM tb_cursos INNER JOIN tb_categorias ON tb_cursos.categoria_id = tb_categorias.id;

