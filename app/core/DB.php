<?php
class DB
{
    public $conn;
    protected $host = 'localhost';
    protected $username = 'root';
    protected $password = '';
    protected $database = 'ecommerce_php';

    function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    function __destruct()
    {
        $this->conn = null;
    }
}
