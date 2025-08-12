<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Matricula
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection(true);
    }

    public function listar()
    {
        $stmt = $this->pdo->query("
            SELECT m.id, m.aluno_id, m.curso_id, m.numero_matricula,
                   a.nome as aluno_nome, c.nome as curso_nome
            FROM matriculas m
            JOIN alunos a ON m.aluno_id = a.id
            JOIN cursos c ON m.curso_id = c.id
            ORDER BY m.id DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criar($aluno_id, $curso_id, $numero_matricula)
    {
        $sql = "INSERT INTO matriculas (aluno_id, curso_id, numero_matricula) VALUES (:aluno_id, :curso_id, :numero_matricula)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':aluno_id', $aluno_id, PDO::PARAM_INT);
        $stmt->bindParam(':curso_id', $curso_id, PDO::PARAM_INT);
        $stmt->bindParam(':numero_matricula', $numero_matricula);
        return $stmt->execute();
    }

    public function buscarPorId($id)
    {
        $stmt = $this->pdo->prepare("
            SELECT m.id, m.aluno_id, m.curso_id, m.numero_matricula,
                   a.nome as aluno_nome, c.nome as curso_nome
            FROM matriculas m
            JOIN alunos a ON m.aluno_id = a.id
            JOIN cursos c ON m.curso_id = c.id
            WHERE m.id = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $aluno_id, $curso_id, $numero_matricula)
    {
        $sql = "UPDATE matriculas SET aluno_id = :aluno_id, curso_id = :curso_id, numero_matricula = :numero_matricula WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':aluno_id' => $aluno_id,
            ':curso_id' => $curso_id,
            ':numero_matricula' => $numero_matricula,
            ':id' => $id
        ]);
    }

    public function excluir($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM matriculas WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
