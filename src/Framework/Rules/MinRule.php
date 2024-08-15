<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

// PHP exception throw if an argument is NOT of the expected type
use InvalidArgumentException;

class MinRule implements RuleInterface
{

    public function validate(array $data, string $field, array $params): bool
    {
        // In case the user forgets to pass the parameter
        if (empty($params[0])) {
            throw new InvalidArgumentException("Minimum length not specified.");
        }

        // extract the first parameter and if the value on the field is greater than the parameter the validation is OK
        $length = (int) $params[0];
        return $data[$field] >= $length;
    }

    public function getMessage(array $data, string $field, array $params, string $lang): string
    {
        $message = "Debe tener al menos {$params[0]}.";

        if ($lang === 'spa') $message = "Debe tener al menos {$params[0]}.";
        if ($lang === 'cat') $message = "Ha de tenir al menys {$params[0]}.";
        if ($lang === 'eng') $message = "Must be at least {$params[0]}.";

        return $message;
    }
}
