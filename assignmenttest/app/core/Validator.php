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
        // Check if the value is a valid decimal number
        return preg_match('/^\d+(\.\d{1,2})?$/', $value);
    }

    public function validateInteger($value) {
        return filter_var($value, FILTER_VALIDATE_INT) !== false;
    }

    public function validateNotEmpty($value) {
        return !empty(trim($value));
    }
}