<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Curso;
use App\Repository\CategoriaRepository;
use App\Repository\CursoRepository;
use Exception;

class CursoController extends AbstractController
{
    private CursoRepository $repository;

    public function __construct()
    {
        $this->repository = new CursoRepository();
    }

    public function listar(): void
    {
        $this->checkLogin();
        $rep = new CursoRepository();
        $cursos = $rep->buscarTodos();

        $this->render("curso/listar", [
            'cursos' => $cursos,
        ]);
    }

    public function cadastrar(): void
    {
        
        $rep = new CategoriaRepository();
        if (true === empty($_POST)) {
            $categorias = $rep->buscarTodos();
            $this->render("/curso/cadastrar", ['categorias' => $categorias]);
            return;
        }

        $curso = new Curso();
        $curso->nome = $_POST['nome'];
        $curso->descricao = $_POST['descricao'];
        $curso->cargaHoraria = intval($_POST['cargaHoraria']);
        $curso->categoria_id = intval($_POST['categoria']);

        $this->repository->inserir($curso);
       
        $this->redirect('/cursos/listar');
    }

    public function excluir(): void
    {
        $id = $_GET['id'];
        $this->repository->excluir($id);
        
        $this->redirecionar('cursos/listar');
    }

    public function editar(): void
    {
        $id = $_GET['id'];
        $rep = new CategoriaRepository();
        $categorias = $rep->buscarTodos();
        $curso = $this->repository->buscarUm($id);
        $this->render("/curso/editar", [
            'categorias' => $categorias,
            'curso' => $curso
        ]);
        if (false === empty($_POST)) {
            $curso = new Curso();
            $curso->nome = $_POST['nome'];
            $curso->descricao = $_POST['descricao'];
            $curso->cargaHoraria = intval($_POST['cargaHoraria']);
            $curso->categoria_id = intval($_POST['categoria']);
            $this->repository->atualizar($curso, $id);
            $this->redirect('/cursos/listar');
        }
    }

    public function relatorio(): void
    {
        $hoje = date('d/m/Y');
        $cursos = $this->repository->buscarTodos();
        $this->categoriaRepository = new CategoriaRepository;
        $categorias = $this->categoriaRepository->buscarTodos();
        foreach($cursos as $cadaCurso){
            foreach($categorias as $cadaCategoria){
                if($cadaCurso[5] == $cadaCategoria->id){
                    $colunaCategoria = $cadaCategoria->nome;
                }
            }
            $dados .= "
            <tr>
                <td>{$cadaCurso[0]}</td>
                <td>{$cadaCurso[1]}</td>
                <td>{$cadaCurso[2]}</td>
                <td>{$cadaCurso[3]}</td>
                <td>{$cadaCurso[4]}</td>
                <td>{$colunaCategoria}</td>
            </tr> ";
        } 

        $design =  "
            <h1>Relatorio de Alunos</h1>
            <em>Gerado em {$hoje}</em>
            <hr>
            <br>
            <table border='1' width='100%' style='margin-top: 30px; text-align:center;'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Carga Horaria</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Categoria</th>
                    </tr>
                </thead>
                <tbody>" 
                . 
                    $dados 
                . 
                "</tbody>
            </table>
        ";
        $dompdf = new Dompdf();
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->loadHtml($design);
        $dompdf->render();
        $dompdf->stream('relatorio-de-cursos.pdf', ['Attachment' => 0]);
    }
}

   