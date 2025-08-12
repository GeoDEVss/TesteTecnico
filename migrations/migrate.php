<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;

$dbName = "ProjetoTeste";

try {
    // 1️⃣ Conecta sem banco para criar o banco
    $pdo = Database::getConnection(false);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Banco '$dbName' criado ou já existe.<br>";

    // 2️⃣ Conecta já usando o banco
    $pdo = Database::getConnection(true);

    // 3️⃣ Criar tabelas
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS user_admin (
            id INT AUTO_INCREMENT PRIMARY KEY,
            usuario VARCHAR(50) NOT NULL,
            senha VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS alunos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            data_nasc DATE NOT NULL,
            criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS cursos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            descricao TEXT
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS matriculas (
            id INT AUTO_INCREMENT PRIMARY KEY,
            aluno_id INT,
            curso_id INT,
            FOREIGN KEY (aluno_id) REFERENCES alunos(id) ON DELETE CASCADE,
            FOREIGN KEY (curso_id) REFERENCES cursos(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    echo "Tabelas criadas com sucesso!";

} catch (PDOException $e) {
    die("Erro na migração: " . $e->getMessage());
}
