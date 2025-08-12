<?php
namespace App\Core;

class AuthMiddleware
{
    public static function handle()
    {
        session_start(); // Necessário para acessar $_SESSION

        if (!isset($_SESSION['user_admin_id'])) {
            // Redireciona para login
            header('Location: /login');
            exit;
        }
    }
}
