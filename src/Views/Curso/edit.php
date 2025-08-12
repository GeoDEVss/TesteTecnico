<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Editar Curso</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div class="container my-5" style="max-width: 600px;">
  <h1 class="mb-4 text-center">Editar Curso</h1>

  <form method="POST" action="/curso/atualizar" class="needs-validation" novalidate>
    <input type="hidden" name="id" value="<?= htmlspecialchars($curso['id']) ?>">

    <div class="mb-3">
      <label for="nome" class="form-label">Nome:</label>
      <input type="text" class="form-control" id="nome" name="nome" required value="<?= htmlspecialchars($curso['nome']) ?>">
      <div class="invalid-feedback">Por favor, insira o nome do curso.</div>
    </div>

    <div class="mb-3">
      <label for="descricao" class="form-label">Descrição:</label>
      <textarea class="form-control" id="descricao" name="descricao" rows="4" required><?= htmlspecialchars($curso['descricao']) ?></textarea>
      <div class="invalid-feedback">Por favor, insira a descrição do curso.</div>
    </div>

    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="/cursos" class="btn btn-secondary ms-2">Voltar para lista</a>
  </form>
</div>

<script>
// Validação Bootstrap (opcional)
(() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>