<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\CursoController;
use App\Controllers\AlunoController;
use App\Controllers\MatriculaController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

function checkAuth()
{
    if (!isset($_SESSION['user_admin_id'])) {
        header('Location: /login');
        exit;
    }
}

// Rotas públicas
if ($uri === '/') {
    header('Location: /login');
    exit;
} elseif ($uri === '/login') {
    require __DIR__ . '/src/Views/auth/login.php';
    exit;
} elseif ($uri === '/login/submit' && $method === 'POST') {
    $auth = new AuthController();
    $auth->login($_POST);
    exit;
} elseif ($uri === '/logout') {
    session_destroy();
    header('Location: /login');
    exit;
}

// Rotas protegidas
checkAuth();

$alunoController = new AlunoController();
$cursoController = new CursoController();
$matriculaController = new MatriculaController();

switch ($uri) {
    case '/dashboard':
        require __DIR__ . '/src/Views/dashboard.php';
        break;

    // Rotas Aluno
    case '/alunos':
        if ($method === 'GET') {
            $alunoController->index();
        }
        break;

    case '/aluno/criar':
        if ($method === 'GET') {
            $alunoController->criarForm();
        } elseif ($method === 'POST') {
            $alunoController->criar($_POST);
            header('Location: /alunos');
            exit;
        }
        break;

    case '/aluno/editar':
        if ($method === 'GET' && isset($_GET['id'])) {
            $alunoController->editarForm($_GET['id']);
        } else {
            header('Location: /alunos');
            exit;
        }
        break;

    case '/aluno/atualizar':
        if ($method === 'POST' && isset($_POST['id'])) {
            $alunoController->atualizar($_POST['id'], $_POST);
            header('Location: /alunos');
            exit;
        }
        break;

    case '/aluno/excluir':
        if ($method === 'GET' && isset($_GET['id'])) {
            $alunoController->excluir($_GET['id']);
            header('Location: /alunos');
            exit;
        } else {
            header('Location: /alunos');
            exit;
        }
        break;

    // Rotas Curso
    case '/cursos':
        if ($method === 'GET') {
            $cursoController->index();
        }
        break;

    case '/curso/criar':
        if ($method === 'GET') {
            $cursoController->criarForm();
        } elseif ($method === 'POST') {
            $cursoController->criar($_POST);
            header('Location: /cursos');
            exit;
        }
        break;

    case '/curso/editar':
        if ($method === 'GET' && isset($_GET['id'])) {
            $cursoController->editarForm($_GET['id']);
        } else {
            header('Location: /cursos');
            exit;
        }
        break;

    case '/curso/atualizar':
        if ($method === 'POST' && isset($_POST['id'])) {
            $cursoController->atualizar($_POST['id'], $_POST);
            header('Location: /cursos');
            exit;
        }
        break;

    case '/curso/excluir':
        if ($method === 'GET' && isset($_GET['id'])) {
            $cursoController->excluir($_GET['id']);
            header('Location: /cursos');
            exit;
        } else {
            header('Location: /cursos');
            exit;
        }
        break;

    if ($uri === '/matriculas' && $method === 'GET') {
    $matriculaController->index();

} elseif ($uri === '/matriculas/criar' && $method === 'GET') {
    $matriculaController->criarForm();

} elseif ($uri === '/matriculas/criar' && $method === 'POST') {
    $matriculaController->criar($_POST);
    header('Location: /matriculas');
    exit;

} elseif (preg_match('#^/matriculas/editar/(\d+)$#', $uri, $matches) && $method === 'GET') {
    $id = $matches[1];
    $matriculaController->editarForm($id);

} elseif (preg_match('#^/matriculas/editar/(\d+)$#', $uri, $matches) && $method === 'POST') {
    $id = $matches[1];
    $matriculaController->atualizar($id, $_POST);
    header('Location: /matriculas');
    exit;

} elseif (preg_match('#^/matriculas/excluir/(\d+)$#', $uri, $matches) && $method === 'POST') {
    $id = $matches[1];
    $matriculaController->excluir($id);
    header('Location: /matriculas');
    exit;

} else {
    // rota não encontrada
    http_response_code(404);
    echo "Página não encontrada";
}

    default:
        http_response_code(404);
        echo "Página não encontrada";
        break;
}
