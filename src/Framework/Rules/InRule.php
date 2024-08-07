<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

// check if the value is in an array of possible values.

class InRule implements RuleInterface
{

    public function validate(array $data, string $field, array $params): bool
    {
        // PHP function to check for a value within an array, true if there is in the array
        // $data[$field] -> the value to search $params -> the array of values as parameter
        return in_array($data[$field], $params);
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "Invalid selection.";
    }
}
