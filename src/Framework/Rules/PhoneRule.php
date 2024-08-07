<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class PhoneRule implements RuleInterface
{

    public function validate(array $data, string $field, array $params): bool
    {
        // Have exactly 9 numbers
        $pattern = '/^\d{9}$/';
        return (bool) preg_match($pattern, $data[$field]);
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "Invalid phone (must have 9 digits).";
    }
}
