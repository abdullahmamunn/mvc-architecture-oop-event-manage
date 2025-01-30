<?php

namespace App\Core;

class Validator
{
    protected $errors = [];

    public function validate(array $data, array $rules)
    {
        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                if (is_string($rule)) {
                    // Handle simple rules like 'required'
                    $method = "validate" . ucfirst($rule);
                    if (method_exists($this, $method)) {
                        $this->$method($field, $data[$field] ?? null);
                    }
                } elseif (is_array($rule)) {
                    // Handle complex rules like ['max', 150]
                    $ruleName = $rule[0];
                    $method = "validate" . ucfirst($ruleName);
                    if (method_exists($this, $method)) {
                        $this->$method($field, $data[$field] ?? null, $rule[1] ?? null);
                    }
                }
            }
        }
        return empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    protected function validateRequired($field, $value)
    {
        if (empty($value)) {
            $this->errors[$field][] = "The $field field is required.";
        }
    }

    protected function validateMax($field, $value, $max)
    {
        if (!empty($value) && strlen($value) > $max) {
            $this->errors[$field][] = "The $field field must not exceed $max characters.";
        }
    }

    protected function validateDate($field, $value)
    {
        if (!empty($value) && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
            $this->errors[$field][] = "The $field field must be a valid date in YYYY-MM-DD format.";
        }
    }

    protected function validateTime($field, $value)
    {
        if (!empty($value) && !preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $value)) {
            $this->errors[$field][] = "The $field field must be a valid time in HH:MM format.";
        }
    }

    protected function validateInteger($field, $value)
    {
        if (!empty($value) && !filter_var($value, FILTER_VALIDATE_INT)) {
            $this->errors[$field][] = "The $field field must be an integer.";
        }
    }

    protected function validateMin($field, $value, $min)
    {
        if (!empty($value) && $value < $min) {
            $this->errors[$field][] = "The $field field must be at least $min.";
        }
    }

    protected function validateEmail($field, $value)
    {
        if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = "The $field field must be a valid email address.";
        }
    }

    protected function validatePattern($field, $value, $pattern)
    {
        if (!empty($value) && !preg_match($pattern, $value)) {
            $this->errors[$field][] = "The $field field does not match the required pattern.";
        }
    }

    protected function validatePassword($field, $value)
    {
        $pattern = '/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
        
        if (!empty($value) && !preg_match($pattern, $value)) {
            $this->errors[$field][] = "The $field must be at least 8 characters long, include at least one uppercase letter, one number, and one special character.";
        }
    }

    protected function validateUnique($field, $value, $tableColumn)
    {
        if (!empty($value)) {
            // Split the table and column name
            [$table, $column] = explode('.', $tableColumn);

            // Assuming you have a Database class for querying
            $db = new \App\Core\Database(); // Replace with your DB connection logic
            $query = "SELECT COUNT(*) FROM $table WHERE $column = :value";
            $result = $db->fetchOne($query, ['value' => $value]);

            if ($result > 0) {
                $this->errors[$field][] = "The $field has already taken";
            }
        }
    }

}
