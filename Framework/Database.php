<?php
namespace Framework;
use PDO;

class Database
{
    static $db;
    protected $conn;

    /**
    * Constructor for Database class
    * 
    * @param array $config
    */
    public function __construct()
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
          ];
        // Connect to the database
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=warrantytrack;charset=utf8mb4", "root", "", $options);
            self::$db = $this;

        } catch (\PDOException $e) {
            throw new \Exception("Database connection failed: " . $e->getMessage());
        }
    }
        
    /**
    * Query the database
    * 
    * @param string $query
    * 
    * @return PDOStatement
    * @throws PDOException
    */
    public function query($query,  $params = [])
    {
        try {
            $sth = $this->conn->prepare($query);
            foreach ($params as $param => $value) {
              $sth->bindValue(':' . $param, $value);
            }
            $sth->execute();
            return $sth;
        } 
        catch (\PDOException $e) {
            throw new \Exception("Query failed to execute: {$e->getMessage()}");
        }
    }
        /**
    * Query the database
    * 
    * @param string $query
    * 
    * @return PDOStatement
    * @throws PDOException
    */
    public function lastInsertId()
    {
        try {
            $sth = $this->conn->lastInsertId();
            return $sth;
        } 
        catch (\PDOException $e) {
            throw new \Exception("Query failed to execute: {$e->getMessage()}");
        }
    }
}   
?>