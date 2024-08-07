<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\{RequiredRule, EmailRule, MinRule, InRule, UrlRule, MatchRule, PasswordRule, PhoneRule};

// SERVICES are Not tied to an specific Controller, should be available to any Controller who needs them

class ValidatorService
{
    // instance of the Validator class to perform the validations in the service
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();
        // add the RULES to the construct method to be available
        $this->validator->add("required", new RequiredRule());
        $this->validator->add("email", new EmailRule());
        $this->validator->add("min", new MinRule());
        $this->validator->add("in", new InRule());
        $this->validator->add("url", new UrlRule());
        $this->validator->add("match", new MatchRule());
        $this->validator->add("phone", new PhoneRule());
        // TODO: Real Password validation, use special characters etc..
        $this->validator->add("password", new PasswordRule());
    }

    /**
     * Method to Validate the Register Form
     * * Use validate method in the Validator class to Apply validation
     * @param array $formData
     */

    public function validateRegister(array $formData)
    {
        // we pass an associative array with the field as key and the rule as value(if we have different rules for the same filed we add it to the array)
        $this->validator->validate($formData, [
            'userName' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'phone'],
            'age' => ['required', 'min:18'],
            'country' => ['required', 'in:Spain,USA,Canada,Mexico'],
            'socialMediaURL' => ['required', 'url'],
            'password' => ['required'],
            'confirmPassword' => ['required', 'match:password'],
            'tos' => ['required']
        ]);
    }

    /**
     * Method to Validate the Login Form
     * * Use validate method in the Validator class to Apply validation
     * @param array $formData
     */

    public function validateLogin(array $formData)
    {
        showNice($formData);

        // we pass an associative array with the field as key and the rule as value(if we have different rules for the same filed we add it to the array)
        $this->validator->validate($formData, [
            'email' => ['required', 'email'],
            'password' => ['required', 'password']
        ]);
    }
}
