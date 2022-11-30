<?php 

declare(strict_types=1);

namespace App\Controller\API;

use App\Repository\ProfessorRepository;

class ProfessorApiController
{
    public function getAll(): void
    {
        $rep = new ProfessorRepository();
        $profesores = $rep->buscarTodos();
        echo json_encode($professores);
    }
}