<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cursos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div class="container my-5" style="max-width: 700px;">
  <h1 class="mb-4 text-center">Cursos cadastrados</h1>

  <a href="/curso/criar" class="btn btn-success mb-4">Adicionar Novo Curso</a>

  <?php if (!empty($cursos)): ?>
    <div class="list-group">
      <?php foreach ($cursos as $curso): ?>
        <div class="list-group-item d-flex justify-content-between align-items-start">
          <div>
            <h5 class="mb-1"><?= htmlspecialchars($curso['nome']) ?></h5>
            <p class="mb-1"><?= htmlspecialchars($curso['descricao']) ?></p>
          </div>
          <div>
            <a href="/curso/editar?id=<?= $curso['id'] ?>" class="btn btn-sm btn-warning me-2">Editar</a>
            <a href="/curso/excluir?id=<?= $curso['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirma exclusão?')">Excluir</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p>Nenhum curso encontrado.</p>
  <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
