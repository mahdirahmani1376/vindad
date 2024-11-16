<?php

use Core\DB;
use Core\Validator;

require 'index.php';

$data = [
    'user_id' => $_POST['user_id'],
];

$validator = Validator::make();
$validator->checkUserExistsInDataBase($data['user_id']);

DB::make()->deleteUser($data['user_id']);

