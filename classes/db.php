<?php

class Dbh
{
    private $dbUserName = "root";
    private $dbPassword = "root";
    private $connection = "mysql:host=localhost; dbname=elearning; charset=utf8mb4";
    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // TRY-CATCH
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //JSON
        PDO::ATTR_EMULATE_PREPARES => TRUE,
    ];

    protected function connectDB()
    {
        try {
            $pdo = new PDO($this->connection, $this->dbUserName, $this->dbPassword, $this->options);
            return $pdo;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }
}
