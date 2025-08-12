<?php
namespace App\Controllers;

use App\Models\Matricula;
use App\Models\Aluno;
use App\Models\Curso;

class MatriculaController
{
    private $matriculaModel;
    private $alunoModel;
    private $cursoModel;

    public function __construct()
    {
        $this->matriculaModel = new Matricula();
        $this->alunoModel = new Aluno();
        $this->cursoModel = new Curso();
    }

    public function index()
    {
        $matriculas = $this->matriculaModel->listar();
        require __DIR__ . '/../Views/Matricula/index.php';
    }

    public function criarForm()
    {
        $alunos = $this->alunoModel->listar();
        $cursos = $this->cursoModel->listar();
        require __DIR__ . '/../Views/Matricula/create.php';
    }

    public function criar($dados)
    {
        $aluno_id = $dados['aluno_id'] ?? null;
        $curso_id = $dados['curso_id'] ?? null;
        $numero_matricula = $dados['numero_matricula'] ?? null;

        if ($aluno_id && $curso_id && $numero_matricula) {
            return $this->matriculaModel->criar($aluno_id, $curso_id, $numero_matricula);
        }
        return false;
    }

    public function editarForm($id)
    {
        $matricula = $this->matriculaModel->buscarPorId($id);
        $alunos = $this->alunoModel->listar();
        $cursos = $this->cursoModel->listar();

        if ($matricula) {
            require __DIR__ . '/../Views/Matricula/edit.php';
        } else {
            header('Location: /matriculas');
            exit;
        }
    }

    public function atualizar($id, $dados)
    {
        $aluno_id = $dados['aluno_id'] ?? null;
        $curso_id = $dados['curso_id'] ?? null;
        $numero_matricula = $dados['numero_matricula'] ?? null;

        if ($id && $aluno_id && $curso_id && $numero_matricula) {
            return $this->matriculaModel->atualizar($id, $aluno_id, $curso_id, $numero_matricula);
        }
        return false;
    }

    public function excluir($id)
    {
        if ($id) {
            return $this->matriculaModel->excluir($id);
        }
        return false;
    }
}
