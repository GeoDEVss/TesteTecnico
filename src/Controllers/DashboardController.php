<?php
namespace App\Controllers;

class DashboardController
{
    public function index()
    {
        // Carrega a view dashboard.php (simples exemplo)
        require __DIR__ . '/../Views/dashboard.php';
        }
}
