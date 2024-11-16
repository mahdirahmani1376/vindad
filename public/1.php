<?php

require 'index.php';

use Core\DB;
use Core\Validator;

$payLoad = [
    'title' => $_POST['title'],
    'content' => $_POST['content']
];

$validator = Validator::make();
$validator->RuleString('title',$payLoad['title']);
$validator->RuleString('content',$payLoad['content']);
$validator->validate();

DB::make()->createPost($payLoad);

