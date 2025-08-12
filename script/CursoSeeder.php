<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;

$pdo = Database::getConnection();

$cursos = [
    ["PHP Básico", "Introdução ao PHP e conceitos fundamentais."],
    ["MySQL Avançado", "Consultas complexas e otimização de banco de dados."],
    ["JavaScript", "Programação front-end com JS puro."]
];

foreach ($cursos as $curso) {
    [$nome, $descricao] = $curso;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM cursos WHERE nome = ?");
    $stmt->execute([$nome]);
    if ($stmt->fetchColumn() == 0) {
        $stmt = $pdo->prepare("INSERT INTO cursos (nome, descricao) VALUES (?, ?)");
        $stmt->execute([$nome, $descricao]);
        echo "Curso $nome criado.\n";
    } else {
        echo "Curso $nome já existe.\n";
    }
}
