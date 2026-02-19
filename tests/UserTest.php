<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private \PDO $conn;

    protected function setUp(): void
    {
        $this->conn = new \PDO(
            "mysql:host=127.0.0.1;dbname=testdb",
            "root",
            "root"
        );

        $this->conn->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION
        );

        // Limpiar tablas antes de cada test
        $this->conn->exec("SET FOREIGN_KEY_CHECKS = 0");
        $this->conn->exec("DROP TABLE IF EXISTS comments");
        $this->conn->exec("DROP TABLE IF EXISTS posts");
        $this->conn->exec("DROP TABLE IF EXISTS users");
        $this->conn->exec("SET FOREIGN_KEY_CHECKS = 1");

        // Ejecutar el SQL del proyecto
        $sqlPath = dirname(__DIR__) . '/sql/database.sql';

        if (!file_exists($sqlPath)) {
            $this->fail("No se encuentra el archivo SQL en: $sqlPath");
        }

        $sql = file_get_contents($sqlPath);
        $this->conn->exec($sql);
    }

    public function testUsersTableExists(): void
    {
        $stmt = $this->conn->query("SHOW TABLES LIKE 'users'");
        $this->assertNotFalse($stmt->fetch());
    }

    public function testUsersTableStructure(): void
    {
        $stmt = $this->conn->query("DESCRIBE users");
        $columns = $stmt->fetchAll(\PDO::FETCH_COLUMN);

        $expectedColumns = [
            'id',
            'username',
            'email',
            'password',
            'avatar',
            'created_at'
        ];

        $this->assertEquals($expectedColumns, $columns);
    }

    public function testPostsUserForeignKeyExists(): void
    {
        $stmt = $this->conn->query("
            SELECT CONSTRAINT_NAME
            FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_NAME = 'posts'
              AND COLUMN_NAME = 'user_id'
              AND REFERENCED_TABLE_NAME = 'users'
        ");

        $this->assertNotFalse($stmt->fetch());
    }
}
