<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Lista de Matrículas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="p-4">

    <h1>Matrículas</h1>

    <a href="/matriculas/criar" class="btn btn-success mb-3">Nova Matrícula</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Aluno</th>
                <th>Curso</th>
                <th>Número Matrícula</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($matriculas as $matricula): ?>
            <tr>
                <td><?= htmlspecialchars($matricula['id']) ?></td>
                <td><?= htmlspecialchars($matricula['aluno_nome']) ?></td>
                <td><?= htmlspecialchars($matricula['curso_nome']) ?></td>
                <td><?= htmlspecialchars($matricula['numero_matricula']) ?></td>
                <td>
                    <a href="/matriculas/editar/<?= $matricula['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                    <form action="/matriculas/excluir/<?= $matricula['id'] ?>" method="POST" style="display:inline" onsubmit="return confirm('Confirmar exclusão?');">
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
