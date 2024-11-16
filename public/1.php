<?php

require 'index.php';

use Core\DB;
use Core\Validator;

$payLoad = [
    'title' => $_POST['title'],
    'content' => $_POST['content']
];

$validator = Validator::make();
$validator->RuleString($payLoad['title']);
$validator->RuleString($payLoad['content']);
$validator->validate();

DB::make()->createPost($payLoad);

