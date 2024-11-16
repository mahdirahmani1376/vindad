<?php

namespace Core;

use http\Exception\InvalidArgumentException;

class Validator
{
    public array $errors = [];

    public static function make(): self
    {
        return new self();
    }

    public function RuleString($key,$value): bool
    {
        $rule = "$key is required and must be string";

        $check = !empty($value) && is_string($value);

        if (! $check){
            $this->errors[][$value] = $rule;
        }

        return $check;

    }

    public function validate()
    {
        if (!empty($this->errors)){
            print_r(json_encode($this->errors));
            http_response_code(422);
            die();
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