<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;

class AdminRequiredMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {

        if (empty($_SESSION['user'])) {
            redirectTo('/');
        }

        // check the user SESSION, if does NOT exists the user is not logged and we redirect him to the login page
        if (!empty($_SESSION['user'] && ($_SESSION['role']) !== 1)) {
            redirectTo('/');
        }

        $next();
    }
}
