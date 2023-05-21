<?php

namespace Database;

use PDO;
use PDOException;

class DB  {
    public $servername;
    public $username;
    public $password;
    public $db_name;

    function __construct($servername, $username, $password, $db_name)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->db_name = $db_name;
    }

    private function connect_internal() 
    {
        $conn = new PDO(
            "mysql:host=$this->servername;dbname=$this->db_name", 
            $this->username, 
            $this->password
        );
        $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    function connect() 
    {
        try {
            $conn = new PDO(
                "mysql:host=$this->servername;dbname=$this->db_name", 
                $this->username, 
                $this->password
            );
            $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function create_table($sql)
    {
        try {
            $connection = $this->connect_internal();
            $connection->exec($sql);
            echo "Created Table";
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function execute($sql)
    {
        try {
            $connection = $this->connect_internal();
            $connection->exec($sql);
            echo "Success... <br>" . $sql;
            $connection = null;
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function execute_prepared($sql) 
    {
        try {
            $connection = $this->connect_internal();
            $statement = $connection->prepare($sql);
            $statement->execute();
            return $statement;
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}