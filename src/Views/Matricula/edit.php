<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Editar Matrícula</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="p-4">

    <h1>Editar Matrícula #<?= $matricula['id'] ?></h1>

    <form action="/matriculas/editar/<?= $matricula['id'] ?>" method="POST">

        <div class="mb-3">
            <label for="aluno_id" class="form-label">Aluno</label>
            <select name="aluno_id" id="aluno_id" class="form-select" required>
                <?php foreach ($alunos as $aluno): ?>
                    <option value="<?= $aluno['id'] ?>" <?= $aluno['id'] == $matricula['aluno_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($aluno['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="curso_id" class="form-label">Curso</label>
            <select name="curso_id" id="curso_id" class="form-select" required>
                <?php foreach ($cursos as $curso): ?>
                    <option value="<?= $curso['id'] ?>" <?= $curso['id'] == $matricula['curso_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($curso['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="numero_matricula" class="form-label">Número da Matrícula</label>
            <input type="text" name="numero_matricula" id="numero_matricula" class="form-control" required
                value="<?= htmlspecialchars($matricula['numero_matricula']) ?>" />
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="/matriculas" class="btn btn-secondary">Cancelar</a>
    </form>

</body>
</html>
