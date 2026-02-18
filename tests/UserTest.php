<?php
use PHPUnit\Framework\TestCase;
use PDO;

class UserTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        $this->conn = new PDO("mysql:host=127.0.0.1;dbname=testdb", "root", "root");
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->conn->exec("
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50),
                password VARCHAR(255)
            );
        ");
    }

    public function testDatabaseConnection()
    {
        $this->assertNotNull($this->conn);
    }

    public function testInsertUser()
    {
        $stmt = $this->conn->prepare("INSERT INTO users(username,password) VALUES (?,?)");
        $result = $stmt->execute(["testuser","1234"]);

        $this->assertTrue($result);
    }
}


