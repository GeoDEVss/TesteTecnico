<?php
namespace App\Controllers;

use App\Core\Database;

class AuthController
{
    public function login(array $data)
    {
        session_start();

        $usuario = $data['usuario'] ?? '';
        $senha = $data['senha'] ?? '';

        if (empty($usuario) || empty($senha)) {
            header('Location: /login?error=Preencha todos os campos');
            exit;
        }

        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("SELECT * FROM user_admin WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $user = $stmt->fetch();

        if ($user && password_verify($senha, $user['senha'])) {
            $_SESSION['user_admin_id'] = $user['id'];
            $_SESSION['user_admin_usuario'] = $user['usuario'];
            header('Location: /dashboard');
            exit;
        } else {
            header('Location: /login?error=Usuário ou senha incorretos');
            exit;
        }
    }
}
