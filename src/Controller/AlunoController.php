<?php

declare(strict_types=1);

namespace App\Controller;

use App\Security\UserSecurity;
use App\Model\Aluno;
use App\Repository\AlunoRepository;
use Dompdf\Dompdf;
use Exception;

class AlunoController extends AbstractController
{   

    private AlunoRepository $repository;

    public function __construct()
    {
        $this->repository = new AlunoRepository();
    }

    public function listar(): void
    {   
        $this->checkLogin();
        if (UserSecurity::isLogged() === false){
            die('Erro, precisa estar logado');
       }
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

        $this->redirect('/alunos/listar');
    }

    public function excluir(): void
    {
        //$this->checkLogin();
        $id = $_GET['id'];
    
        $this->repository->excluir($id);
       
        $this->redirect('/alunos/listar');
    }

    public function editar(): void
    {   
        $this->checkLogin();
        $id = $_GET['id'];
        $rep = new AlunoRepository();
        $aluno =$this->repository->buscarUm($id);
        $this->render('aluno/editar', [$aluno]);
    
        if (true === empty($_POST)){
            $aluno = new Aluno();
            $aluno->nome = $_POST['nome'];
            $aluno->dataNascimento = $_POST['nascimento'];
            $aluno->cpf = $_POST['cpf'];
            $aluno->email = $_POST['email'];
            $aluno->genero = $_POST['genero'];

            try { 
                $rep->atualizar($aluno, $id);
            }catch (Exception $exception){
                if(true === str_contains($exception->getMessage(), 'cpf')){
                    die('CPF já existe');
                }
                if(true === str_contains($exception->getMessage(), 'email')){
                    die('Este email já existe');
                }

                die('Vixe, deu erro!');
            
            }

            $this->redirect('/alunos/listar');
        }
       
    }

    public function relatorio(): void
    {   
        $this->checkLogin();
        $hoje = date ('d/m/Y');
        $alunos = $this->repository->buscarTodos();
        
        foreach($alunos as $cadaAluno){
           
            if($cadaAluno->status == 1){
                $alunoAtivo = 'Matriculado';
            }
            $dados .= "
                <tr>
                    <td>{$cadaAluno->id}</td>
                    <td>{$cadaAluno->nome}</td>
                    <td>{$cadaAluno->cpf}</td>
                    <td>{$cadaAluno->matricula}</td>
                    <td>{$cadaAluno->email}</td>
                    <td>{$alunoAtivo}</td>
                    <td>{$cadaAluno->genero}</td>
                    <td>{$dataNascimento}</td>
                </tr>
            ";
        }
        
        $design = "
                <h1>Relatorio de Alunos</h1>
                <hr>
                <em>Gerado em {$hoje}</em>

                <table border='1' width='100%' style='margin-top: 30px;'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Matricula</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Gênero</th>
                        <th>Data de Nascimento</th>
                    </tr>
                </thead>
                    <tbody>
                        .
                        $dados
                        .
                    </tbody>
                   
                </table>

        ";

        $dompdf = new Dompdf();
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->loadHtml($design);
        $dompdf->render();
        $dompdf->stream('relatorio-alunos.pdf', [
            'Attachment' => 0,
        ]);
    }
    
}