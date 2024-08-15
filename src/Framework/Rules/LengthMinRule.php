<?php

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException;


class LengthMinRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        if (empty($params[0])) {
            throw new InvalidArgumentException('Minimum length not specified.');
        }

        $length = (int) $params[0];

        // check if the length of the field is greater than the limit specified in the rule
        return strlen($data[$field]) >= $length;
    }

    public function getMessage(array $data, string $field, array $params, string $lang): string
    {

        $message = "Debe tener al menos {$params[0]} carácteres.";

        if ($lang === 'spa') $message = "Debe tener al menos {$params[0]} carácteres.";
        if ($lang === 'cat') $message = "Ha de tenir almenys {$params[0]} caràcters.";
        if ($lang === 'eng') $message = "Must have a Minimum of {$params[0]} characters.";

        return $message;
    }
}
