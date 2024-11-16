<?php

use Core\DB;
use Core\Validator;

require 'index.php';

$conn = DB::make()->getConnection();

$data = [
    'user_id' => $_POST['user_id'],
];

$validator = Validator::make();
$validator->checkUserExistsInDataBase($data['user_id']);

DB::make()->deleteUser($data['user_id']);

