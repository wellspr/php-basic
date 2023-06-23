<?php

namespace Model;

use PDO;
use PDOException;
use RecursiveArrayIterator;

class Model
{
    private $servername;
    private $username;
    private $password;
    public $db_name;
    public $table_name;
    public $model_name;

    function __construct()
    {
        $this->servername = getenv('MYSQL_SERVERNAME');
        $this->username = getenv('MYSQL_USER');
        $this->password = getenv('MYSQL_PASSWORD');
        $this->db_name = getenv('MYSQL_DATABASE');
        $this->table_name = "";
        $this->model_name = "";
    }

    function connect()
    {
        try {
            $connection = new PDO(
                "mysql:host=$this->servername;dbname=appDB",
                $this->username,
                $this->password
            );
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
            return null;
        }
    }

    function init(string $table_name, array $model_name)
    {
        if (!$this->table_exists($table_name)) {
            $this->create_table($table_name, $model_name);
        }
        $this->table_name = $table_name;
        $this->model_name = $model_name;
    }

    function get_model()
    {
        return array(
            "table" => $this->table_name,
            "model" => $this->model_name,
        );
    }

    private function table_exists($table)
    {
        $connection = $this->connect();
        try {
            if ($connection->query("DESCRIBE $table")) {
                $connection = null;
                echo "Table $table exists! <br>";
                return true;
            }
        } catch (PDOException $e) {
            if ($e->getCode() === "42S02") {
                /** if SQLSTATE[42S02] Base table or view not found  */
                return false;
            }
        }
    }

    private function create_table(string $table_name, array $table)
    {
        $sql = "CREATE TABLE $table_name (";
        $sql .= "{$table_name}_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ";

        foreach ($table as $key => $value) {
            $sql .= "$key $value";
            $sql .= ", ";
        }

        $sql .= "created TIMESTAMP DEFAULT CURRENT_TIMESTAMP, ";
        $sql .= "updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
        $sql .= ")";

        $connection = $this->connect();

        try {
            $connection->exec($sql);
            $connection = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insert_data(array $data)
    {
        $keys = implode(", ", array_keys($data));

        $data_with_quotes = array();
        foreach ($data as $value) {
            array_push($data_with_quotes, "'{$value}'");
        }

        $values = implode(", ", array_values($data_with_quotes));

        $sql = "INSERT INTO $this->table_name ({$keys}) VALUES ({$values})";

        echo $sql . "<br>";

        $connection = $this->connect();
        try {
            $connection->exec($sql);
            $connection = null;
            echo "Inserted";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /** 
     *  Prepared statements
     */
    private function fetch_prepared($sql)
    {
        $connection = $this->connect();
        $statement = $connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $results = [];

        foreach (new RecursiveArrayIterator($statement->fetchAll()) as $value) {
            array_push($results, $value);
        }

        return $results;
    }

    private function simple_prepared($sql)
    {
        $connection = $this->connect();
        $statement = $connection->prepare($sql);
        $statement->execute();
        return $statement->rowCount();
    }

    public function get_table_data()
    {
        return $this->fetch_prepared("SELECT * FROM $this->table_name");
    }

    public function get_row($data, ...$condition)
    {
        if ($condition) {
            return $this->fetch_prepared("SELECT {$data} FROM $this->table_name WHERE {$condition[0]}");
        }
        return $this->fetch_prepared("SELECT $data FROM $this->table_name");
    }

    public function get_row_by_id(int $id)
    {
        $condition = "{$this->table_name}_id={$id}";
        return $this->fetch_prepared("SELECT * FROM $this->table_name WHERE $condition");
    }

    public function get_row_by_condition($condition)
    {
        return $this->fetch_prepared("SELECT * FROM $this->table_name WHERE {$condition}");
    }

    public function update_row($update, $id)
    {
        $condition = "{$this->table_name}_id={$id}";
        return $this->simple_prepared("UPDATE $this->table_name SET {$update} WHERE $condition");
    }

    public function delete_row(int $id)
    {
        $condition = "{$this->table_name}_id={$id}";
        return $this->simple_prepared("DELETE FROM $this->table_name WHERE $condition");
    }

    public function value_exists($column, $value)
    {
        $sql = "SELECT $column FROM $this->table_name WHERE {$column}='{$value}'";
        $results = $this->fetch_prepared($sql);

        if (empty($results)) {
            return false;
        }
        return true;
    }
}
