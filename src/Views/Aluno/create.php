<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Criar Novo Aluno</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div class="container my-5" style="max-width: 600px;">
  <h1 class="mb-4 text-center">Criar Novo Aluno</h1>

  <form method="POST" action="/aluno/criar" class="needs-validation" novalidate>
    <div class="mb-3">
      <label for="nome" class="form-label">Nome:</label>
      <input type="text" class="form-control" id="nome" name="nome" required>
      <div class="invalid-feedback">Por favor, insira o nome.</div>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email:</label>
      <input type="email" class="form-control" id="email" name="email" required>
      <div class="invalid-feedback">Por favor, insira um email válido.</div>
    </div>

    <div class="mb-3">
      <label for="data_nasc" class="form-label">Data de Nascimento:</label>
      <input type="date" class="form-control" id="data_nasc" name="data_nasc" required>
      <div class="invalid-feedback">Por favor, informe a data de nascimento.</div>
    </div>

    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-primary">Salvar</button>
      <a href="/alunos" class="btn btn-secondary ms-2">Voltar para lista</a>
    </div>
  </form>
</div>

<script>
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
