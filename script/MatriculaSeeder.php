<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;

$pdo = Database::getConnection();

// Lista de matrículas no formato [aluno_id, curso_id]
$matriculas = [
    [1, 1], // Exemplo: Aluno 1 no Curso 1
    [1, 2], // Aluno 1 no Curso 2
    [2, 3], // Aluno 2 no Curso 3
];

// Função para gerar número de matrícula aleatório
function gerarNumeroMatricula() {
    $prefixo = "MAT";
    $ano = date('Y');
    $numeroAleatorio = str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT); // 4 dígitos com zeros à esquerda
    return $prefixo . $ano . $numeroAleatorio;
}

foreach ($matriculas as $mat) {
    [$aluno_id, $curso_id] = $mat;

    // Verifica se já existe matrícula para esse aluno e curso
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM matriculas WHERE aluno_id = ? AND curso_id = ?");
    $stmt->execute([$aluno_id, $curso_id]);

    if ($stmt->fetchColumn() == 0) {
        $numero_matricula = gerarNumeroMatricula();

        // Insere matrícula com número gerado
        $stmt = $pdo->prepare("INSERT INTO matriculas (aluno_id, curso_id, numero_matricula) VALUES (?, ?, ?)");
        $stmt->execute([$aluno_id, $curso_id, $numero_matricula]);

        echo "Matrícula criada: Aluno $aluno_id no Curso $curso_id com número $numero_matricula.\n";
    } else {
        echo "Matrícula já existente: Aluno $aluno_id no Curso $curso_id.\n";
    }
}
