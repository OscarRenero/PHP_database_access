<?php
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        $this->conn = new \PDO("mysql:host=127.0.0.1;dbname=testdb", "root", "root");
        $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $sqlPath = dirname(__DIR__) . '/sql/database.sql';
        
        if (!file_exists($sqlPath)) {
            throw new \Exception("No se encuentra el archivo SQL en: " . $sqlPath);
        }

        $sql = file_get_contents($sqlPath);
        
        $this->conn->exec($sql);
    }

    public function testDatabaseConnection()
    {
        $this->assertNotNull($this->conn);
    }

    public function testInsertUser()
    {
        $stmt = $this->conn->prepare("INSERT INTO users(username, password, email) VALUES (?,?,?)");
        $result = $stmt->execute(["testuser","1234", "test@example.com"]);

        $this->assertTrue($result);
    }
}
