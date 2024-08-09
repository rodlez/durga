<?php

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException;


class DateFormatRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        //  Get info about given date formatted according to the specified format, in $params[0] we specified the format. e.g (Y-m-d)
        $parseDate = date_parse_from_format($params[0], $data[$field]);

        // the date_parse_from_format has 2 key values (error_count, warning_count) that if there are NOT 0, the date contains errors
        return $parseDate['error_count'] === 0 && $parseDate['warning_count'] === 0;
    }

    public function getMessage(array $data, string $field, array $params, string $lang): string
    {
        $lang === 'es' ? $message = "Formato de la Fecha no válida." : $message = "Invalid Date.";

        return $message;
    }
}
