<?php

declare(strict_types=1);

namespace App\Repository;

class ProfessorRepository implements RepositoryInterface
{
    public function buscarTodos(): iterable
    {
        return[];
    }
    public function buscarUm(string $id): ?object
    {
        return new \stdClass;
    }
    public function inserir(object $dados): object
    {
        return $dados;
    }
    public function atualizar(object $novosdados, string $id ): object
    {
        return $novosdados;
    }
    public function excluir(string $id): void
    {
        
    }
}