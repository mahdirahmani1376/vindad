<?php

namespace Core;

use mysqli;

class DB
{
    public function __construct()
    {
        $database = require '../database.php';
        $this->conn = new mysqli(
            $database['hostname'],
            $database['username'],
            $database['password'],
            $database['database']
        );
    }

    public static function make()
    {
        return new self();
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function checkUserExists($userId)
    {
        $q = "SELECT * FROM users where id = {$userId}";
        $result = $this->conn->execute_query($q)->fetch_assoc();
        return (bool) $result;
    }

}