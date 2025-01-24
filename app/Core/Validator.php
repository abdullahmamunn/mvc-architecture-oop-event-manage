<?php

namespace App\Core;

class Validator
{
    public function validateRequired(array $fields): bool
    {
        foreach ($fields as $field) {
            if (trim($field) === '') {
                return false;
            }
        }
        return true;
    }

    public function validatePattern(string $value, string $pattern): bool
    {
        return preg_match($pattern, $value) === 1;
    }

    public function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}
