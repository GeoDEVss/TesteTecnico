<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Aluno
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection(true); // conecta ao banco ProjetoTesteUm, por exemplo
    }

    // Listar todos os alunos
    public function listar()
    {
        $stmt = $this->pdo->query("SELECT * FROM alunos ORDER BY nome");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar alunos por nome ou email (filtro)
  public function buscarPorNomeOuEmail($filtro)
{
    $stmt = $this->pdo->prepare("SELECT * FROM alunos WHERE nome LIKE :filtroNome OR email LIKE :filtroEmail ORDER BY nome");
    $filtroParam = "%$filtro%";
    $stmt->bindParam(':filtroNome', $filtroParam, PDO::PARAM_STR);
    $stmt->bindParam(':filtroEmail', $filtroParam, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



    // Criar um novo aluno
   public function criar($nome, $email, $data_nasc)
    {
        $sql = "INSERT INTO alunos (nome, email, data_nasc) VALUES (:nome, :email, :data_nasc)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':data_nasc', $data_nasc);
        return $stmt->execute();
    }

    // Buscar aluno por ID
    public function buscarPorId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM alunos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualizar aluno
    public function atualizar($id, $nome, $email, $data_nasc)
    {
        $stmt = $this->pdo->prepare("UPDATE alunos SET nome = :nome, email = :email, data_nasc = :data_nasc WHERE id = :id");
        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':data_nasc' => $data_nasc,
            ':id' => $id
        ]);
    }

    // Excluir aluno
    public function excluir($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM alunos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
