<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

// PHP exception throw if an argument is NOT of the expected type
use InvalidArgumentException;

class PasswordRule implements RuleInterface
{

    public function validate(array $data, string $field, array $params): bool
    {

        $ok = false;

        (strlen($data[$field]) >= 6) ? $ok = true : $ok = false;

        return $ok;
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "Must have at least 6 characters.";
    }
}
