<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;

use App\Middleware\{TemplateDataMiddleware, ValidationExceptionMiddleware, SessionMiddleware, FlashMiddleware, CsrfTokenMiddleware, CsrfGuardMiddleware};

// We create a function and NOT a class because Middleware can only be registered through the App instance, we are going to accept the App instance as a parameter

function registerMiddleware(App $app)
{
    // the order of the Middleware registration does matter, our Exception class does not access to sessions until the session has been enabled
    // therefore the SessionMiddleware must be registered last. Middleware registered last is executed first.
    // Important register the token before the SessionMiddleware, if not we could not store the token

    $app->addMiddleware(CsrfGuardMiddleware::class);

    $app->addMiddleware(CsrfTokenMiddleware::class);

    $app->addMiddleware(TemplateDataMiddleware::class);
    $app->addMiddleware(ValidationExceptionMiddleware::class);
    $app->addMiddleware(FlashMiddleware::class);

    // Session is the last, then is executed first and the other Middleware will have access to the session.
    $app->addMiddleware(SessionMiddleware::class);
}
