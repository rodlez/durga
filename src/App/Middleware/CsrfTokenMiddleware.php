<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class CsrfTokenMiddleware implements MiddlewareInterface
{
    public function __construct(private TemplateEngine $view)
    {
    }

    public function process(callable $next)
    {
        // random_bytes(32) generates a random binary 32 bits number, bin2hex convert it in HEX to be more easy to read attached to a form submit
        // This way we do not generate a new token on every new request. if the token already exists, we use it, if not we will generate a new. 
        $_SESSION['token'] = $_SESSION['token'] ?? bin2hex(random_bytes(32));

        // inject the value into the template through the TemplateEngine instance
        $this->view->addGlobal('csrfToken', $_SESSION['token']);

        $next();
    }
}
