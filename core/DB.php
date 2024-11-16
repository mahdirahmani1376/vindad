<?php

namespace Core;

use mysqli;

class DB
{
    private mysqli $conn;

    public function __construct()
    {
        $this->setConnection();
    }

    public static function make(): self
    {
        return new self();
    }

    public function getConnection(): mysqli
    {
        return $this->conn;
    }

    public function setConnection(): mysqli
    {
        $database = require '../database.php';
        $this->conn = new mysqli(
            $database['hostname'],
            $database['username'],
            $database['password'],
            $database['database']
        );
        return $this->conn;
    }

    public function createPost(array $payLoad)
    {
        $query = $this->getConnection()->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");

        $query->bind_param('ss', $payLoad['title'], $payLoad['content']);

        $result = $query->execute();

        if ($result) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $query->error;
        }

        $query->close();
        $this->getConnection()->close();
    }



    public function checkUserExists($userId): bool
    {
        $q = "SELECT * FROM users where id = {$userId}";
        $result = $this->getConnection()->execute_query($q)->fetch_assoc();
        return (bool) $result;
    }

    public function deleteUser($userId)
    {
        $query = $this->getConnection()->prepare("DELETE FROM users WHERE id = (?)");

        $query->bind_param('i', $userId);

        if ($query->execute()) {
            echo "User Deleted successfully";
        } else {
            echo "Error: " . $query->error;
        }

        $query->close();
        $this->getConnection()->close();
    }

}