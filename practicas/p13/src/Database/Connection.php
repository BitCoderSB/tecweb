<?php
namespace P13\ProductApp\Database;

class Connection
{
    /**
     * Return a PDO instance connected to the `tienda` database.
     * Defaults are XAMPP: host=127.0.0.1, user=root, no password.
     */
    public static function getPDO(array $config = []) : \PDO
    {
        $host = $config['host'] ?? '127.0.0.1';
        $db   = $config['db'] ?? 'tienda';
        $user = $config['user'] ?? 'root';
        $pass = $config['pass'] ?? '';
        $charset = $config['charset'] ?? 'utf8mb4';

        $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";

        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];

        return new \PDO($dsn, $user, $pass, $options);
    }
}
