<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\DatabaseConnection;
use App\Model\User;
use PDO;

class UserRepository 
{   

    public PDO $pdo;
    public const TABLE = 'tb_user';

    public function __construct()
    {
        $this->pdo = DatabaseConnection::abrirConexao();
    }
    public function findAll(): iterable
    {
        $sql = 'SELECT * FROM ' .self::TABLE;
        $query =  $this->pdo->query($sql, PDO::FETCH_CLASS,);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, User::class);
    }
    public function insert(User $user): User
    {
        $sql = 'INSERT INTO ' .self::TABLE."(name, email, password, profile)";
        $sql .= "VALUES ('{$user->name}', '{$user->email}', '{$user->password}', '{$user->profile}')";
        return $user;
    }
}