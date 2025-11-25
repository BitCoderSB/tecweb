<?php
namespace P13\ProductApp\Database;

/**
 * Wrapper to return a mysqli connection using defaults compatible with XAMPP
 * (host=localhost, user=root, pass='', db=tienda).
 * This mirrors the simple style used in earlier practices (procedural mysqli).
 */
class MySQLiConnection
{
    /**
     * Return a mysqli object connected to the database.
     * On failure it will throw an exception.
     *
     * @param array $config Optional keys: host, user, pass, db
     * @return \mysqli
     */
    public static function getConnection(array $config = []): \mysqli
    {
        $host = $config['host'] ?? 'localhost';
        $user = $config['user'] ?? 'root';
        $pass = $config['pass'] ?? '';
        $db   = $config['db'] ?? 'tienda';

        $mysqli = @new \mysqli($host, $user, $pass, $db);
        if ($mysqli->connect_errno) {
            throw new \RuntimeException('MySQLi connection error: ' . $mysqli->connect_error);
        }

        // ensure utf8mb4
        if (! $mysqli->set_charset('utf8mb4')) {
            // non-fatal, but report
            trigger_error('Warning: Could not set charset to utf8mb4: ' . $mysqli->error, E_USER_WARNING);
        }

        return $mysqli;
    }
}
