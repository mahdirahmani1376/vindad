<?php

use Core\DB;
use Core\Validator;

require 'index.php';

$conn = DB::make()->getConnection();

$data = [
    'user_id' => $_POST['user_id'],
];

$validator = new Validator();
$validator->checkUserExistsInDataBase($data['user_id']);

$query = $conn->prepare("DELETE FROM users WHERE id = (?)");

$query->bind_param('i', $data['user_id']);

if ($query->execute()) {
    echo "User Deleted successfully";
} else {
    echo "Error: " . $query->error;
}

$query->close();
$conn->close();