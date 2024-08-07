<?php

declare(strict_types=1);

namespace Framework\Exceptions;

// is a subcategory of the Exception class, have the same properties and methods, we use a subcategory to be more specific
// RuntimeException mean for errors that will only occur while the app is running.
// Code that does NOT have to be fixed, but handled.

use RuntimeException;

// We create a custom exception for the Container class to determine errors as a class can NOT be instantiated

class ValidationException extends RuntimeException
{
    // define by default the HTTP Status Code 422 - Unprocessable Content. The request was well-formed but was unable to be followed due to semantic errors.
    // making the errors array public will be accessible outside the Exception, can be access in the Middleware
    public function __construct(public array $errors, int $code = 422)
    {
        // invoke the parent construct method to use the information
        parent::__construct(code: $code);
    }
}
