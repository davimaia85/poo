<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\DatabaseConnection;
use App\Model\Aluno;

use PDO;

class AlunoRepository implements RepositoryInterface
{   
    public const TABLE = 'tb_alunos';
    public PDO $pdo;

    public function __construct()
    {
        $this->pdo = DatabaseConnection::abrirConexao();
    }

    public function buscarTodos(): iterable
    {
       
        $sql = 'SELECT * FROM ' . self::TABLE;

        $query = $this->pdo->query($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, Aluno::class);
        
    }
    public function buscarUm(string $id): ?object
    {
        return new \stdClass;
    }
    public function inserir(object $dados): object
    {
        $matricula = date('Ymd') . substr($dados->cpf, -2);
        $sql = "INSERT INTO " . self::TABLE . "(nome, email, cpf, matricula, status, dataNascimento, genero) " . "VALUES ('{$dados->nome}', '{$dados->email}', '{$dados->cpf}', '{$matricula}', '1', '{$dados->dataNascimento}', '{$dados->genero}');";
        $this->pdo->query($sql);
        return $dados;
    }
    public function atualizar(object $novosdados, string $id ): object
    {
        return $novosdados;
    }
    public function excluir(string $id): void
    {
        $sql= "DELETE FROM " . self::TABLE." WHERE id = '{$id}'";
        $query = $this->pdo->query($sql);
        $query->execute();
    }
}