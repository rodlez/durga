<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

// we implement the RuleInterface, therefore we need to implement the methods validate and getMessage in the Interface

class RequiredRule implements RuleInterface
{
    // return true if NOT empty
    public function validate(array $data, string $field, array $params): bool
    {
        return !empty($data[$field]);
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "This field is required.";
    }
}
