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

    public function getMessage(array $data, string $field, array $params, string $lang): string
    {
        $message = "El teléfono debe tener 9 dígitos.";

        if ($lang === 'spa') $message = "El teléfono debe tener 9 dígitos.";
        if ($lang === 'cat') $message = "El telèfon ha de tenir 9 dígits.";
        if ($lang === 'eng') $message = "Invalid phone (must have 9 digits).";

        return $message;
    }
}
