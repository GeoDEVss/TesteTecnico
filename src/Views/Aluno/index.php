<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Alunos Cadastrados</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div class="container my-5 text-center">

  <h1 class="mb-4">Alunos cadastrados</h1>

  <form method="GET" action="/alunos" class="row justify-content-center g-3 mb-4">
    <div class="col-auto">
      <input type="text" class="form-control" name="filtro" placeholder="Pesquisar por nome ou email" value="<?= htmlspecialchars($_GET['filtro'] ?? '') ?>">
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-3">Buscar</button>
    </div>
  </form>

  <?php if (!empty($alunos)): ?>
    <div class="list-group text-start mx-auto" style="max-width: 600px;">
      <?php foreach ($alunos as $aluno): ?>
        <div class="list-group-item d-flex justify-content-between align-items-start">
          <div>
            <h5 class="mb-1"><?= htmlspecialchars($aluno['nome']) ?></h5>
            <p class="mb-1">Email: <?= htmlspecialchars($aluno['email']) ?></p>
            <small>Data de Nascimento: <?= htmlspecialchars($aluno['data_nasc']) ?></small>
          </div>
          <div>
            <a href="/aluno/editar?id=<?= $aluno['id'] ?>" class="btn btn-sm btn-warning me-2">Editar</a>
            <a href="/aluno/excluir?id=<?= $aluno['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirma exclusão?')">Excluir</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p>Nenhum aluno encontrado.</p>
  <?php endif; ?>

  <a href="/aluno/criar" class="btn btn-success mt-4">Adicionar Novo Aluno</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
