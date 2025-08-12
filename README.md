Projeto PHP MVC com PDO

Este projeto é um sistema simples de gerenciamento de alunos, cursos e matrículas, usando arquitetura MVC em PHP com conexão via PDO ao banco de dados MySQL.
Requisitos

    PHP 7.4 ou superior (recomendo PHP 8.x)

    Servidor web (Apache, Nginx, ou PHP Built-in server)

    MySQL (ou MariaDB)

    Composer (para autoload das classes)

Configuração do Banco de Dados

    Crie o banco:

    Execute a migration que está no projeto para criar o banco e as tabelas.
    Geralmente, essa migration está em um arquivo PHP, por exemplo migration.php.

    Você pode rodar pelo terminal:

php migration.php

Isso cria o banco ProjetoTeste e as tabelas alunos, cursos, matriculas, etc.

Configurar acesso PDO:

No arquivo src/Core/Database.php, configure os dados de acesso ao banco (host, nome do banco, usuário e senha):

private static $host = 'localhost';
private static $dbName = 'ProjetoTeste';
private static $user = 'seu_usuario';
private static $pass = 'sua_senha';

Testar conexão:

Para testar se o PDO conecta, você pode criar um arquivo simples:

    <?php
    require 'src/Core/Database.php';

    try {
        $pdo = App\Core\Database::getConnection(true);
        echo "Conexão ao banco de dados OK!";
    } catch (PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage();
    }

    Execute com php teste_conexao.php e veja se conecta.

Rodando o Projeto

    Instale as dependências via Composer:

composer install

Inicie o servidor PHP embutido (para testes rápidos):

    php -S localhost:8000

    Acesse no navegador:

    Vá para http://localhost:8000/dashboard (requer login)

    Login:

    Use os dados cadastrados no banco para logar.
    Caso não tenha um usuário, crie manualmente via SQL ou crie um script para adicionar.

Uso do PDO no Projeto

    O projeto usa PDO para todas as operações no banco, garantindo segurança contra SQL Injection via prepared statements.

    As conexões são feitas via a classe Database em src/Core/Database.php.

    Exemplos de uso estão nas Models (src/Models), onde cada Model representa uma tabela e contém métodos para listar, criar, editar e excluir registros.

    As queries usam parâmetros nomeados ou posicionais para passagem segura dos dados.

Estrutura do Projeto (simplificada)

/
|-- src/
|    |-- Controllers/
|    |-- Models/
|    |-- Views/
|    |-- Core/Database.php
|-- public/
|    |-- index.php (separado, se for o caso)
|-- migration.php (script para criar banco e tabelas)
|-- composer.json
|-- README.md

Recomendações

    Sempre use prepared statements ao usar PDO para evitar falhas de segurança.

    Configure corretamente o tratamento de erros no PDO para facilitar debug.

    Utilize namespaces e autoload via Composer para organização.

    Para produção, desative a exibição de erros e configure logs.

