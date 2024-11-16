<?php

require 'index.php';

use Core\DB;
use Core\Validator;

$conn = DB::make()->getConnection();

$payLoad = [
    'title' => $_POST['title'],
    'content' => $_POST['content']
];

$validator = new Validator();
$validator->RuleString($payLoad['title']);
$validator->RuleString($payLoad['content']);
$validator->validate();

$query = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");

$query->bind_param('ss', $payLoad['title'], $payLoad['content']);

if ($query->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query->error;
}

$query->close();
$conn->close();