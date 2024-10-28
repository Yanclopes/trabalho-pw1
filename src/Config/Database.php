<?php
namespace App\Config;
namespace App\Config;

use PDO;
use PDOException;

class Database {
    private string $host;
    private string $db_name;
    private string $username;
    private string $password;
    public PDO $conn;

    public function __construct() {
        $this->host = $_ENV['DATABASE_HOST'];
        $this->db_name = $_ENV['DATABASE_NAME'];
        $this->username = $_ENV['DATABASE_USER'];
        $this->password = $_ENV['DATABASE_PASSWORD'];

        try {
            $this->conn = new PDO("pgsql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }
}

