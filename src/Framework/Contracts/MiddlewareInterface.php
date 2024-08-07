<?php

declare(strict_types=1);

namespace Framework\Contracts;

// Creating this interface, ALL Middleware will have the same method, then when calling Middleware we wont need to guess which method to call

interface MiddlewareInterface
{

    // method to process the request, we will call this method before the Controller handles the request
    // next to call multiple Middlewares chained. callable type -> means next parameter it's a function that we can call to initiate the next middleware
    // example of next Middleware, to check if an user is authenticated and redirect to one place or another.
    public function process(callable $next);
}
