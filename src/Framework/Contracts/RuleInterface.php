<?php

declare(strict_types=1);

namespace Framework\Contracts;

// define the rules that need to be implemented for validation, this are the default rules.
// default methods validate and getMessage will be always requires id there is a new rule.
// in the Validator class will be give the opportunity to define new rules.

interface RuleInterface
{
    public function validate(array $data, string $field, array $params): bool;

    public function getMessage(array $data, string $field, array $params): string;
}
