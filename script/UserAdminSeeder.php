<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;

$pdo = Database::getConnection();

// Criar um usuário admin padrão
$usuario = "admin";
$senha = password_hash("123456", PASSWORD_DEFAULT);

// Evita duplicar
$stmt = $pdo->prepare("SELECT COUNT(*) FROM user_admin WHERE usuario = ?");
$stmt->execute([$usuario]);
$existe = $stmt->fetchColumn();

if (!$existe) {
    $stmt = $pdo->prepare("INSERT INTO user_admin (usuario, senha) VALUES (?, ?)");
    $stmt->execute([$usuario, $senha]);
    echo "UserAdmin criado com sucesso!\n";
} else {
    echo "UserAdmin já existe.\n";
}
