<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden; /* Remove scroll geral da página */
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        nav.navbar {
            height: 80px;
            flex-shrink: 0;
        }
        main.container {
            flex: 1 1 auto;
            overflow-y: auto; /* Scroll interno se precisar */
            padding-top: 1rem;
            padding-bottom: 1rem;
            max-width: 600px;
            margin: 0 auto;
        }
        footer {
            flex-shrink: 0;
            background-color: #f8f9fa;
            padding: 0.75rem 0;
            text-align: center;
            border-top: 1px solid #ddd;
            font-size: 0.9rem;
            color: #666;
        }
        h1.h5 {
            margin: 0;
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container h-100 d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="#">Painel Admin</a>

            <!-- Texto centralizado -->
            <div class="text-white flex-grow-1 d-flex justify-content-center">
                <h1 class="h5">Bem-vinda, <?= htmlspecialchars($_SESSION['user_admin_usuario']); ?>!</h1>
            </div>

            <a href="/logout" class="btn btn-outline-light btn-sm">Sair</a>
        </div>
    </nav>

    <main class="container">

        <div class="mb-4">
            <h2>Gerenciamento de Alunos</h2>
            <p>Para gerenciar os alunos, acesse a lista completa clicando no botão abaixo:</p>
            <a href="/alunos" class="btn btn-primary">Ir para lista de alunos</a>
        </div>

        <div class="mb-4">
            <h2>Gerenciamento de Cursos</h2>
            <p>Para gerenciar os cursos, acesse a lista completa clicando no botão abaixo:</p>
            <a href="/cursos" class="btn btn-primary">Ir para lista de cursos</a>
        </div>

        <div class="mb-4">
            <h2>Gerenciamento de Matrículas</h2>
            <p>Para gerenciar as matrículas, acesse a lista completa clicando no botão abaixo:</p>
            <a href="/matriculas" class="btn btn-primary">Ir para lista de matrículas</a>
        </div>
    </main>

    <footer>
        &copy; <?= date('Y') ?> Seu Sistema - Todos os direitos reservados
    </footer>

    <!-- Bootstrap Bundle com Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
