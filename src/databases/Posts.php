<?php

namespace Databases;

use Database\DB;
use PDO;
use RecursiveArrayIterator;

class Posts extends DB {
    
    public $table_name;

    function __construct()
    {
        $this->servername = "mysql-db";
        $this->username = "php";
        $this->password = "php123";
        $this->db_name = "posts_db";
        $this->table_name = "Post";
    }

    function create_post($title, $headline, $body) 
    {
        $sql = "
            INSERT INTO $this->table_name (title, headline, body)
            VALUES('$title', '$headline', '$body')
        ";
        $this->execute($sql);
    }

    function fetch() 
    {
        $sql = "
            SELECT * FROM $this->table_name
        ";
        $stmt = $this->execute_prepared($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $raw_results = $stmt->fetchAll();
        $results_array = array();

        foreach(new RecursiveArrayIterator($raw_results) as $row) {
            array_push($results_array, $row);
        }
        return $results_array;
    }

    function get_post_by_id($id)
    {
        $sql = "
            SELECT title, headline, body
            FROM $this->table_name
            WHERE id='$id'
        ";
        $stmt = $this->execute_prepared($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
}