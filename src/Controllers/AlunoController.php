<?php
namespace App\Controllers;

use App\Models\Aluno;

class AlunoController
{
    private $alunoModel;

    public function __construct()
    {
        $this->alunoModel = new Aluno();
    }

        public function index()
    {
        $filtro = $_GET['filtro'] ?? null;

        if ($filtro) {
            $alunos = $this->alunoModel->buscarPorNomeOuEmail($filtro);
        } else {
            $alunos = $this->alunoModel->listar();
        }

        require __DIR__ . '/../Views/Aluno/index.php';
    }


        public function criarForm()
    {
        require __DIR__ . '/../Views/Aluno/create.php';
    }

    public function criar($dados)
{
    $nome = $dados['nome'] ?? null;
    $email = $dados['email'] ?? null;
    $data_nasc = $dados['data_nasc'] ?? null;

    if ($nome && $email && $data_nasc) {
        $this->alunoModel->criar($nome, $email, $data_nasc);
        return true;
    }
    return false;
}

// Mostrar formulário para editar aluno
public function editarForm($id)
{
    $aluno = $this->alunoModel->buscarPorId($id);
    if ($aluno) {
        require __DIR__ . '/../Views/Aluno/edit.php';
    } else {
        header('Location: /alunos');
        exit;
    }
}

// Processar atualização do aluno
public function atualizar($id, $dados)
{
    $nome = $dados['nome'] ?? null;
    $email = $dados['email'] ?? null;
    $data_nasc = $dados['data_nasc'] ?? null;

    if ($id && $nome && $email && $data_nasc) {
        $this->alunoModel->atualizar($id, $nome, $email, $data_nasc);
        header('Location: /alunos');
        exit;
    } else {
        // Caso falte algum dado, redireciona para edição
        header("Location: /aluno/editar?id=$id");
        exit;
    }
}

public function excluir($id)
{
    if ($id) {
        $this->alunoModel->excluir($id);
    }
    header('Location: /alunos');
    exit;
}


    // Outros métodos...
}
