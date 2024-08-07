<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\Exceptions\ValidationException;


class ValidationExceptionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        // redirection should NOT happen unless an error gets triggered
        try {
            $next();
        } catch (ValidationException $e) {

            // Filtering sensitive data, do NOT store the passwords in the oldFormData
            $oldFormData = $_POST;
            $excludeFields = ['password', 'confirmPassword'];
            // to remove them we use the array_diff_key, returns an array without the keys of the second array, we need to use array_flip to exchange the keys with the values
            $formattedFormData = array_diff_key($oldFormData, array_flip($excludeFields));

            // before the redirection, we store the errors in a session to be available after redirection and show them later.
            $_SESSION['errors'] = $e->errors;
            // To store the data of the form when there is errors but we want to recover the info in the fields that were correct, the user do not need to type again
            $_SESSION['oldFormData'] = $formattedFormData;

            // to grab the URL where the user was previously, no need to hardcode the page of the form(e.g /register), because we grab the URL using this referer SERVER variable.
            $referer = $_SERVER['HTTP_REFERER'];
            redirectTo($referer);
        }
    }
}
