<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Aluno;
use App\Repository\AlunoRepository;
use Dompdf\Dompdf;
use Exception;

class AlunoController extends AbstractController
{   

    private function AlunoRepository $repository;
    {
        $this->repository new AlunoRepository();
    }

    public function listar(): void
    {
        //$rep = new AlunoRepository();
        $alunos = $this->repository->buscarTodos();
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

        try { 
            $this->repository->inserir($aluno);
        }catch (Exception $exception){
            if(true === str_contains($exception->getMessage(), 'cpf')){
                die('CPF já existe');
            }
            if(true === str_contains($exception->getMessage(), 'email')){
                die('Este email já existe');
            }

            die('Vixe, deu erro!');
           
        }

        $this->repository->inserir($aluno); 

        $this->redirect('/aluno/listar');
    }

    public function excluir(): void
    {
        //$this->render('aluno/excluir');
        $id = $_GET['id'];

        $this->repository->excluir($id);
       
        $this->redirect('/alunos/listar');
    }

    public function editar(): void
    {
        if (true === empty($_POST)){

            $id = $_GET['id'];
            //$rep = new AlunoRepository();
            $aluno =$this->repository->buscarUm($id);
            $this->render('aluno/editar', [$aluno]);
        }

        $aluno = new Aluno();
        $aluno->nome = $_POST['nome'];
        $aluno->dataNascimento = $_POST['nascimento'];
        $aluno->cpf = $_POST['cpf'];
        $aluno->email = $_POST['email'];
        $aluno->genero = $_POST['genero'];

        //$rep = new AlunoRepository();

        try { 
            $this->repository->inserir($aluno);
        }catch (Exception $exception){
            if(true === str_contains($exception->getMessage(), 'cpf')){
                die('CPF já existe');
            }
            if(true === str_contains($exception->getMessage(), 'email')){
                die('Este email já existe');
            }

            die('Vixe, deu erro!');
           
        }

        $this->repository->inserir($aluno); 

        $this->redirect('/aluno/listar');
       
    }

    public function relatorio(): void
    {
        $hoje = date ('d/m/Y');
        $alunos = $this->repository->buscarTodos();
        $design = "
                <h1>Relatorio de Alunos</h1>
                <hr>
                <em>Gerado em {$hoje}</em>

                <table border='1' width='100%' style='margin-top: 30px;'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{$alunos[0]->id}</td>
                        <td>{$alunos[0]->nome}</td>
                    </tr>
                    <tr>
                        <td>{$alunos[1]->id}</td>
                        <td>{$alunos[1]->nome}</td>
                    </tr>
                    <tr>
                        <td>{$alunos[2]->id}</td>
                        <td>{$alunos[2]->nome}</td>
                    </tr>
                    
                </tbody>
                   
                </table>

        ";

        $dompdf = new Dompdf();
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->loadHtml($design);
        $dompdf->render();
        $dompdf->stream('relatorio-alunos.pdf', ['Attachment' => 0,
        ]);
    }
    
}