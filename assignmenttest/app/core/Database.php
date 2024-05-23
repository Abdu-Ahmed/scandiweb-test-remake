<?php
namespace App\Core;

class Database {

    protected $conn;
    private $config;

    public function __construct() {
        $this->config = include '../app/config/config.php';
        $this->connect();
    }

    private function connect() {
        $host = $this->config['database']['host'];
        $username = $this->config['database']['username'];
        $password = $this->config['database']['password'];
        $database = $this->config['database']['database'];

        try {
            $connection = new \PDO("mysql:host=$host;dbname=$database", $username, $password);
            $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->conn = $connection;
        } catch (\PDOException $e) {
            throw new \Exception("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}