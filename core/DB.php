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

    public function createPost(array $payLoad)
    {
        $query = $this->conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");

        $query->bind_param('ss', $payLoad['title'], $payLoad['content']);

        $result = $query->execute();

        if ($result) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $query->error;
        }

        $query->close();
        $this->conn->close();
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

    public function deleteUser($userId)
    {
        $query = $this->conn->prepare("DELETE FROM users WHERE id = (?)");

        $query->bind_param('i', $userId);

        if ($query->execute()) {
            echo "User Deleted successfully";
        } else {
            echo "Error: " . $query->error;
        }

        $query->close();
        $this->conn->close();
    }

}