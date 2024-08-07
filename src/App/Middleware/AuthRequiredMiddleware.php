<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;

class AuthRequiredMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        // check the user SESSION, if does NOT exists the user is not logged and we redirect him to the login page
        if (empty($_SESSION['user'])) {
            redirectTo('/login');
        }
        $next();
    }
}
