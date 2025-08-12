<?php
namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $pdo = null;

    private static $host;
    private static $dbname;
    private static $user;
    private static $pass;
    private static $charset;

    // Inicializa as configurações (você pode passar via parâmetro ou usar getenv)
    private static function initConfig()
    {
        self::$host = getenv('DB_HOST') ?: 'localhost';
        self::$dbname = getenv('DB_NAME') ?: 'ProjetoTesteUm';
        self::$user = getenv('DB_USER') ?: 'root';
        self::$pass = getenv('DB_PASS') ?: 'Geov@nna4067';
        self::$charset = getenv('DB_CHARSET') ?: 'utf8mb4';
    }

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            self::initConfig();

            try {
                // Conectar ao MySQL SEM banco para garantir que o banco exista
                $dsnNoDb = "mysql:host=" . self::$host . ";charset=" . self::$charset;
                $pdoNoDb = new PDO($dsnNoDb, self::$user, self::$pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]);

                // Criar banco se não existir
                $pdoNoDb->exec("CREATE DATABASE IF NOT EXISTS `" . self::$dbname . "` CHARACTER SET " . self::$charset);
                // Opcional: logar sucesso da criação aqui

                // Agora conecta COM o banco de dados criado
                $dsnWithDb = "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=" . self::$charset;
                self::$pdo = new PDO($dsnWithDb, self::$user, self::$pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);

            } catch (PDOException $e) {
                error_log("Erro de conexão: " . $e->getMessage());
                die("Erro ao conectar ou criar banco de dados.");
            }
        }

        return self::$pdo;
    }
}
