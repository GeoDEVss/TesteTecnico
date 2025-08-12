<?php
namespace App\Controllers;

use App\Models\Curso;

class CursoController
{
    private $cursoModel;

    public function __construct()
    {
        $this->cursoModel = new Curso();
    }

    // Listar todos os cursos e carregar a view
    public function index()
    {
        $cursos = $this->cursoModel->listar();
        require __DIR__ . '/../Views/Curso/index.php';
    }

    // Mostrar formulário para criar novo curso
    public function criarForm()
    {
        require __DIR__ . '/../Views/Curso/create.php';
    }

    // Criar novo curso no banco
    public function criar($dados)
    {
        $nome = $dados['nome'] ?? null;
        $descricao = $dados['descricao'] ?? null;

        if ($nome && $descricao) {
            $this->cursoModel->criar($nome, $descricao);
            return true;
        }
        return false;
    }

    // Mostrar formulário para editar um curso existente
    public function editarForm($id)
    {
        $curso = $this->cursoModel->buscarPorId($id);
        if ($curso) {
            require __DIR__ . '/../Views/Curso/edit.php';
        } else {
            header('Location: /cursos');
            exit;
        }
    }

    // Atualizar dados do curso no banco
    public function atualizar($id, $dados)
    {
        $nome = $dados['nome'] ?? null;
        $descricao = $dados['descricao'] ?? null;

        if ($id && $nome && $descricao) {
            $this->cursoModel->atualizar($id, $nome, $descricao);
            return true;
        }
        return false;
    }

    // Excluir curso pelo id
    public function excluir($id)
    {
        if ($id) {
            $this->cursoModel->excluir($id);
            return true;
        }
        return false;
    }
}
