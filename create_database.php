<?php
$host = 'localhost';
$user = 'root';
$pass = 'Geov@nna4067';
$dbname = 'BancoTeste';  // Troque para o nome do seu banco

try {
    // Conecta no MySQL sem selecionar banco
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cria o banco, se não existir
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Banco '$dbname' criado ou já existe." . PHP_EOL;

} catch (PDOException $e) {
    die("Erro ao criar banco: " . $e->getMessage());
}
