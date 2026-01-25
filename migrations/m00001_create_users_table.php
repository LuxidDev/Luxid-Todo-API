<?php
use Luxid\Database\Database;

class m00001_create_users_table
{
    /**
     * Run the migration
     */
    public function apply()
    {
        $db = \Luxid\Foundation\Application::$app->db;

        $sql = "CREATE TABLE IF NOT EXISTS `users` (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            firstname VARCHAR(100) NOT NULL,
            lastname VARCHAR(100) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX idx_email (email)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        try {
            $db->pdo->exec($sql);
            echo "Table 'users' created successfully\n";
        } catch (\Exception $e) {
            throw new \Exception("Migration failed: " . $e->getMessage());
        }
    }

    /**
     * Reverse the migration
     */
    public function down()
    {
        $db = \Luxid\Foundation\Application::$app->db;

        $sql = "DROP TABLE IF EXISTS `users`";

        try {
            $db->pdo->exec($sql);
            echo "Table 'users' dropped successfully\n";
        } catch (\Exception $e) {
            throw new \Exception("Rollback failed: " . $e->getMessage());
        }
    }
}
