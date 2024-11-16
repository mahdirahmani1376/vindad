<?php

namespace Core;

use http\Exception\InvalidArgumentException;

class Validator
{
    public array $errors = [];

    public function RuleString($key): bool
    {
        $rule = "$key is required and must be string";

        $check = !empty($key) && is_string($key);

        if (! $check){
            $this->errors[][$key] = $rule;
        }

        return $check;

    }

    public function validate()
    {
        if (!empty($this->errors)){
            print_r(json_encode($this->errors));
            die(402);
        }
    }

    public function checkUserExistsInDataBase(mixed $userId)
    {
        $result = DB::make()->checkUserExists($userId);
        if (! $result){
            $this->errors[][$userId] = 'user must be existed in database';
        }

        return $this->validate();

    }


}