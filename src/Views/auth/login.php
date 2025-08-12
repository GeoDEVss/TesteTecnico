<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Login UserAdmin</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Seu CSS customizado -->
    <link rel="stylesheet" href="/css/login.css" />
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-sm p-4" style="width: 360px;">
        <h2 class="mb-4 text-center">Login</h2>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>

        <form id="loginForm" method="POST" action="/login/submit" novalidate>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuário:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required />
                <div class="invalid-feedback">Por favor, preencha o usuário.</div>
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha" required />
                <div class="invalid-feedback">Por favor, preencha a senha.</div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>

    <!-- Bootstrap Bundle com Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Seu JS customizado -->
    <script src="/js/login.js"></script>
</body>
</html>
