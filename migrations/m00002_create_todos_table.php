<?php
use Luxid\Database\Database;

class m00002_create_todos_table
{
    /**
     * Run the migration
     */
    public function apply(): void
    {
        $db = \Luxid\Foundation\Application::$app->db;

        $sql = "CREATE TABLE IF NOT EXISTS `todos` (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX idx_status (status),
            INDEX idx_created_at (created_at)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        try {
            $db->pdo->exec($sql);
            echo "Table 'todos' created successfully\n";
        } catch (\Exception $e) {
            throw new \Exception("Migration failed: " . $e->getMessage());
        }
    }

    /**
     * Reverse the migration
     */
    public function down(): void
    {
        $db = \Luxid\Foundation\Application::$app->db;

        $sql = "DROP TABLE IF EXISTS `todos`";

        try {
            $db->pdo->exec($sql);
            echo "Table 'todos' dropped successfully\n";
        } catch (\Exception $e) {
            throw new \Exception("Rollback failed: " . $e->getMessage());
        }
    }
}
