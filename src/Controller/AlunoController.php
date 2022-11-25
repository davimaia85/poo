<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\AlunoRepository;
use Exception;

class AlunoController extends AbstractController
{
    public function listar(): void
    {
        $rep = new AlunoRepository();
        $alunos = $rep->buscarTodos();
        $this->render('aluno/listar', [
            'alunos' => $alunos,
        ]);
    }

    public function cadastrar(): void
    {
        if (true === empty($_POST)){
            $this->render('aluno/cadastrar');
            return;
        }

        $aluno = new Aluno();
        $aluno->nome = $_POST['nome'];
        $aluno->dataNascimento = $_POST['nascimento'];
        $aluno->cpf = $_POST['cpf'];
        $aluno->email = $_POST['email'];
        $aluno->genero = $_POST['genero'];

        $rep = new AlunoRepository();

        try { 
            $rep->inserir($aluno);
        }catch (Exception $exception){
            if(true === str_contains($exception->getMessage(), 'cpf')){
                die('CPF já existe');
            }
            if(true === str_contains($exception->getMessage(), 'email')){
                die('Este email já existe');
            }

            die('Vixe, deu erro!');
           
        }

        $rep->inserir($aluno); 

        $this->redirect('/aluno/listar');
    }

    public function excluir(): void
    {
        $this->render('aluno/excluir');
    }

    public function editar(): void
    {
        $this->render('aluno/editar');
    }
}