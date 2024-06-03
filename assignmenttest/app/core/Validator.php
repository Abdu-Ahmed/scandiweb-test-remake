<?php

namespace App\Core;

class Validator {
    public const VALIDATION_MESSAGE = "Please, provide the data of indicated type";
    public const EMPTY_FIELD_MESSAGE = "Please, submit required data.";
    
    public function validateString($value, $minLength = 1, $maxLength = INF) {
        $trimmedValue = trim($value);
        $length = strlen($trimmedValue);
        return $length >= $minLength && $length <= $maxLength;
    }

    public function validatePrice($value) {
        return preg_match('/^\d+(\.\d{1,2})?$/', $value);
    }

    public function validateNotEmpty($value) {
        return !empty(trim($value));
    }
    public function validateFloat($value) {
        return filter_var($value, FILTER_VALIDATE_FLOAT) !== false;
    }
}
