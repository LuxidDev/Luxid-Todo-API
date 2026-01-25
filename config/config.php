<?php
// Configuration File

function getDatabaseDSN(): string
{
    // If DB_DSN is explicitly set, use it
    if (isset($_ENV['DB_DSN'])) {
        // Remove quotes if present
        $dsn = $_ENV['DB_DSN'];
        $dsn = trim($dsn, '"\'');
        return $dsn;
    }

    $dbname = $_ENV['DB_NAME'] ?? 'luxid';
    $host = $_ENV['DB_HOST'] ?? '127.0.0.1';
    $port = $_ENV['DB_PORT'] ?? '3306';

    // Check for common socket paths
    $sockets = [
        '/run/mysqld/mysqld.sock',      // Arch Linux
        '/var/run/mysqld/mysqld.sock',   // Ubuntu/Debian
        '/tmp/mysql.sock',               // macOS & others
    ];

    foreach ($sockets as $socket) {
        if (file_exists($socket)) {
            return "mysql:unix_socket={$socket};dbname={$dbname}";
        }
    }

    // Fallback to TCP
    return "mysql:host={$host};port={$port};dbname={$dbname}";
}

return [
    'db' => [
        'dsn' => getDatabaseDSN(), // ← Remove "self::"
        'user' => $_ENV['DB_USER'] ?? 'root',
        'password' => $_ENV['DB_PASSWORD'] ?? '',
    ],
    'userClass' => \App\Entities\User::class,
];
