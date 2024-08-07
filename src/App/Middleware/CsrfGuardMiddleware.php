<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;

class CsrfGuardMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        // Validate only for Requests that need a token (GET method not need validation)
        $requestMethod = strtoupper($_SERVER['REQUEST_METHOD']);
        $validMethods = ['POST', 'PATCH', 'DELETE'];

        if (!in_array($requestMethod, $validMethods)) {
            // if the method is not in the array of valid methods we do nothing
            $next();
            return;
        }

        // we generate one token and store one in the SESSION and another in the form. This will be the correct defense against a CSRF Attack
        // With this we know that the info send from the form have the token that we are created.

        // check if the token create in the session is the same as the token send in the form
        if ($_SESSION['token'] !== $_POST['token']) {
            // TODO: Custom Exception for CSRF Tokens when the tokens do NOT match
            redirectTo('/');
        }

        // if it's correct we will pass to the next function in the Middleware, and delete the token, because must be use once per each request
        unset($_SESSION['token']);

        $next();
    }
}
