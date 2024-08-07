<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;

use Framework\TemplateEngine;

// Flashing -> data is deleted after a single request, errors should only appears once.
// This class will pass the errors from the Middleware to the Template.

class FlashMiddleware implements MiddlewareInterface
{

    // to access the TemplateEngine instance we can add data to the Template that gets rendered.
    public function __construct(private TemplateEngine $view)
    {
    }

    public function process(callable $next)
    {
        // errors is the name key in the array, the global variable $_SESSION['errors'] is the value in the array. ?? if not errors the value is an empty array []
        $this->view->addGlobal('errors', $_SESSION['errors'] ?? []);

        // To destroy the errors variable session to not show the errors if we change the page or refresh
        unset($_SESSION['errors']);

        // oldFormData is the name key in the array, the global variable $_SESSION['oldFormData'] is the value in the array. ?? if not oldFormData the value is an empty array []
        $this->view->addGlobal('oldFormData', $_SESSION['oldFormData'] ?? []);

        // To destroy the oldFormData variable session to not show the oldFormData if we change the page or refresh
        unset($_SESSION['oldFormData']);

        $next();
    }
}
