# Instruções Crud Escola

### Descrição

Aplicação Web do tipo monolítica criada com:
- PHP para o backend, ^7.4
- HTML, CSS, Javascript para o frontend
- MySQL/ MariaDB para o banco de dados
Esta aplicação faz a gestão dos elementos que compõe o controle escolar, onde é possível cadastrar, atualizar, excluir e listar os alunos, os professores e os cursos que a escola dispõe. 

### Funcionalidades

- CRUD de Alunos
- CRUD de Professores
- CRUD de Cursos
- CRUD de Categorias
- CRUD de Usuários

### Iniciar

1- Certifique-se que seu computador tem os softwares:

    PHP, MySQL ou MariaDB, Editor de texto (ex: VSCode), navegador web (ex: Chrome), Composer

2- Baixe ou faça o clone do projeto: `git clone ...`;

3- Entre no diretório: `poo`;

4- Habilitar as extensões do PHP:

        - abra o diretório de instalação do PHP, encontre o arquivo *php.ini-production*, renomei-o
        para *php.ini* e abra-o com um editor de texto.

        - encontre as linhas que contém (pdo_mysql, curl, mb-string, openssl) e desconecte-se, removendo ';' que precede a linha

5- Dentro do diretório da aplicação execute no terminal: `composer install`;

        - Certifique-se que um diretório **vendor** foi criado 

6- O banco de dados é do tipo relacional e contém as tabelas com até 2 níveis de normatização;

7- Gerar o banco de dados: entre no cliente do banco de dados e execute
    ```sql
        CREATE DATABASE db_escola
    ```

8- Dentro do cliente do banco de dados, copie e cole o conteúdo dop arquivo **db.sql** e execute;
    
    - certifique-se que as tabelas forma criadas executando o comando:
    ```sql
        SHOW TABLES
    ```
    - exibe a lista de tabelas

9-Cofigurar as credenciais de acesso: 
    
    - no arquivo **/config/database.php** e edite as credenciais do seu usuário do banco de dados

### Criar o primeiro usuário de acesso

1- Dentro do diretório da aplicação, execute o comando `php config/create-admin.php`, para gerar o usuário com as credeniciais:
| NOME | EMAIL | SENHA |
| - | - | - |
| Administrador | admin@admin.com | 123456 |

### Executar a aplicação

1- Para executar e testar a aplicação, execute no terminal: `php -S localhost:8000 -t public`;

2- Acesse o endereço http://localhost:8000 no navegador web;





