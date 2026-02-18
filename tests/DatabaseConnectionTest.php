<?php

use PHPUnit\Framework\TestCase;

class DatabaseConnectionTest extends TestCase
{
    public function testDatabaseConnection()
    {
        $host = getenv('DB_HOST') ?: '127.0.0.1';
        $db   = getenv('DB_NAME') ?: 'WatchYourPost';
        $user = getenv('DB_USER') ?: 'admin';
        $pass = getenv('DB_PASS') ?: 'admin123';
        $port = getenv('DB_PORT') ?: '3306';

        $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

        try {
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->query("SELECT 1");
            $result = $stmt->fetch();

            $this->assertEquals(1, $result[0]);
        } catch (PDOException $e) {
            $this->fail("No se pudo conectar a la base de datos: " . $e->getMessage());
        }
    }
}
