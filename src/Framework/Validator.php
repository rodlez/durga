<?php

declare(strict_types=1);

namespace Framework;

use Framework\Contracts\RuleInterface;
use Framework\Exceptions\ValidationException;

// not need to be global, because will be use only in the Services ValidatorService

class Validator
{
    private array $rules = [];

    // method to create custom rules, but must respect the RuleInterface in the Contracts folder. 
    public function add(string $alias, RuleInterface $rule)
    {
        $this->rules[$alias] = $rule;
    }

    // validation will perform a field at a time
    public function validate(array $formData, array $fields)
    {
        // to store the errors of each field
        $errors = [];

        // every field in the array contains an array of rules(for example the required rule. SEE the ValidatorService validateRegister) and fieldName as the field to the key from the associative array
        foreach ($fields as $fieldName => $rules) {
            // multiple rules can exists for a field, we need to loop also for each rule assign to a field
            foreach ($rules as $rule) {

                // to permit custom parameters in a rule
                $ruleParams = [];

                // str_contains to search if : is in the $rule field
                if (str_contains($rule, ':')) {
                    // explode to split the string using the character (:), and store in 2 arrays $rule and $ruleParams
                    [$rule, $ruleParams] = explode(':', $rule);
                    // separate the possible ruleParams, that will be separated with the character (,)
                    $ruleParams = explode(',', $ruleParams);
                }

                // grab the rule instance by the alias
                $ruleValidator = $this->rules[$rule];

                if ($ruleValidator->validate($formData, $fieldName, $ruleParams)) {
                    continue;
                }

                $errors[$fieldName][] = $ruleValidator->getMessage($formData, $fieldName, $ruleParams);
            }
        }

        // if there is errors, the errors array is not empty
        if (count($errors)) {
            throw new ValidationException($errors);
        }
    }
}
