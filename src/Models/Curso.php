<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Curso
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection(true);
    }

    // Listar todos os cursos
    public function listar()
    {
        $stmt = $this->pdo->query("SELECT * FROM cursos ORDER BY nome");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar curso por ID
    public function buscarPorId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM cursos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Criar um novo curso
    public function criar($nome, $descricao)
    {
        $sql = "INSERT INTO cursos (nome, descricao) VALUES (:nome, :descricao)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        return $stmt->execute();
    }

    // Atualizar curso
    public function atualizar($id, $nome, $descricao)
    {
        $sql = "UPDATE cursos SET nome = :nome, descricao = :descricao WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':id' => $id
        ]);
    }

    // Excluir curso
    public function excluir($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM cursos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
