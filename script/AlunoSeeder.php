<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;

$pdo = Database::getConnection();

$alunos = [
    ["Maria da Silva", "maria@email.com", "1999-05-10"],
    ["João Santos", "joao@email.com", "2000-08-15"],
    ["Ana Souza", "ana@email.com", "2001-02-25"]
];

foreach ($alunos as $aluno) {
    [$nome, $email, $data_nasc] = $aluno;

    // Evita duplicar
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM alunos WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() == 0) {
        $stmt = $pdo->prepare("INSERT INTO alunos (nome, email, data_nasc) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $email, $data_nasc]);
        echo "Aluno $nome criado.\n";
    } else {
        echo "Aluno $nome já existe.\n";
    }
}
