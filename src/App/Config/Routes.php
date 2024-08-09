<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;

use App\Controllers\{HomeController, NewsletterController, AboutController, ContactController, AuthController, AdminController};

use App\Middleware\{AuthRequiredMiddleware, GuestOnlyMiddleware, AdminRequiredMiddleware};

/**
 * Function to register routes and quit complexity from the bootstrap file, now, we can call it in bootstrap.php 
 */

function registerRoutes(App $app)
{
    // use the class Magic constant instead the whole path 'use App\Controllers\HomeController;' to avoid typos

    // ***************************************** PUBLIC *******************************************************

    // Home Page
    $app->get('/', [HomeController::class, 'home']);
    $app->post('/', [HomeController::class, 'newsletter']);

    // Newsletter Page
    $app->get('/newsletter', [NewsletterController::class, 'newsletterOk']);

    // About Page
    $app->get('/about', [AboutController::class, 'about']);

    // Contacto Page
    $app->get('/contacto', [ContactController::class, 'contactView']);
    $app->post('/contacto', [ContactController::class, 'contact']);
    $app->get('/contacto/ok', [ContactController::class, 'contactOk']);


    // ******* AuthController ********
    // Register Page
    $app->get('/register', [AuthController::class, 'registerView'])->add(GuestOnlyMiddleware::class);
    $app->post('/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
    // Login Page
    $app->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
    $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
    // Logout
    $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);

    // ****************************************** ADMIN ********************************************************

    $app->get('/admin', [AdminController::class, 'adminView'])->add(AdminRequiredMiddleware::class);

    // Newsletter
    $app->get('/admin/newsletter', [NewsletterController::class, 'newsletterView'])->add(AdminRequiredMiddleware::class);
    $app->get('/admin/newsletter/create', [NewsletterController::class, 'createNewsletterView'])->add(AdminRequiredMiddleware::class);
    $app->post('/admin/newsletter/create', [NewsletterController::class, 'createNewsletterEntry'])->add(AdminRequiredMiddleware::class);
    $app->get('/admin/newsletter/{newsletter}', [NewsletterController::class, 'editNewsletterEntryView'])->add(AdminRequiredMiddleware::class);
    $app->post('/admin/newsletter/{newsletter}', [NewsletterController::class, 'editNewsletterEntry'])->add(AdminRequiredMiddleware::class);
    $app->delete('/admin/newsletter/{newsletter}', [NewsletterController::class, 'deleteNewsletterEntry'])->add(AdminRequiredMiddleware::class);

    // Contact
    $app->get('/admin/contact', [ContactController::class, 'adminContactView'])->add(AdminRequiredMiddleware::class);
}
