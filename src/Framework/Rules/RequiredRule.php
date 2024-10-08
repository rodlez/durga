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

    public function getMessage(array $data, string $field, array $params, string $lang): string
    {
        $message = "Campo obligatorio";

        if ($lang === 'spa') $message = "Campo obligatorio";
        if ($lang === 'cat') $message = "Camp obligatori";
        if ($lang === 'eng') $message = "This field is required.";

        return $message;
    }
}
