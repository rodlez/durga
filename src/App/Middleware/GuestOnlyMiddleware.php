<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;

class GuestOnlyMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        // check the user SESSION, if the user IS authenticated should NOT see the login and register pages
        if (!empty($_SESSION['user'])) {
            redirectTo('/');
        }

        $next();
    }
}
