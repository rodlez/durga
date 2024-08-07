<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;

use App\Controllers\{HomeController, AboutController, AuthController};

use App\Middleware\{AuthRequiredMiddleware, GuestOnlyMiddleware};

/**
 * Function to register routes and quit complexity from the bootstrap file, now, we can call it in bootstrap.php 
 */

function registerRoutes(App $app)
{
    // use the class Magic constant instead the whole path 'use App\Controllers\HomeController;' to avoid typos

    // ***************************************** Public *******************************************************

    // Home Page
    $app->get('/', [HomeController::class, 'home'])->add(AuthRequiredMiddleware::class);

    // About Page
    $app->get('/about', [AboutController::class, 'about'])->add(GuestOnlyMiddleware::class);

    // ******* AuthController ********
    // Register Page
    $app->get('/register', [AuthController::class, 'registerView'])->add(GuestOnlyMiddleware::class);
    $app->post('/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
    // Login Page
    $app->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
    $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
    // Logout
    $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
}
