<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

// we implement the RuleInterface, therefore we need to implement the methods validate and getMessage in the Interface

class BoolRule implements RuleInterface
{
    // return true if NOT empty
    public function validate(array $data, string $field, array $params): bool
    {

        $result = false;

        if ($data[$field] === '0' || $data[$field] === '1') {
            $result = true;
        }

        return $result;
    }

    public function getMessage(array $data, string $field, array $params, string $lang): string
    {
        //showNice($idioma, 'idioma getmessage');
        //debugator();

        $lang === 'es' ? $message = "Campo obligatorio" : $message = "This field is required.";

        return $message;
    }
}
