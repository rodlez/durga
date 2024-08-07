<?php

declare(strict_types=1);

namespace App\Controllers;

// Controllers are classes responsible to render a page content,
// by convention PagenameController for the class and the filename.
// Responsible to render the content from the Home Page

use Framework\TemplateEngine;
use App\Services\{ValidatorService, UserService};

class AuthController
{

    // to create an instance of the TemplateEngine to render the content
    // moving the property TemplateEngine as a parameter of the construct method to look for dependencies    
    // making an instance of the ValidatorService to be accessible by the AuthController class

    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private UserService $userService
    ) {
        // we do NOT need to manually create an instance of the TemplateEngine class
        // $this->view = new TemplateEngine(Paths::VIEW);
        // Common practice to list dependencies from the construct method
    }

    /**
     * Render the registration form (register.php) using the render method in the TemplateEngine class, 
     * this method has an Optional array to pass variables
     */

    public function registerView()
    {

        echo $this->view->render("register.php", [
            'title' => 'Register',
            'sitemap' => '<a href="/">Home</a> / <b>Register</b>',
            'subtitle' => "Fill the form to register",
        ]);
    }

    /**
     * Receives the register form data using the HTTPD POST method 
     * 
     * * 1 - Validate the form. 
     * * 2 - Check if the Email already exists.
     * * 3 - Create New user in the DB and generate a $_SESSION with the user values.
     * * 4 - Redirect to the main page.
     */

    public function register()
    {
        //showNice($_POST);

        $this->validatorService->validateRegister($_POST);

        $this->userService->isEmailTaken($_POST['email']);

        $this->userService->createNewUser($_POST);

        redirectTo('/');
    }

    /**
     * Render the registration form (login.php) using the render method in the TemplateEngine class
     * this method has an Optional array to pass variables
     */

    public function loginView()
    {

        echo $this->view->render("login.php", [
            'title' => 'Login',
            'sitemap' => '<a href="/">Home</a> / <b>Login</b>',
            'subtitle' => "Use your email and password to access to the App.",
        ]);
    }

    /**
     * Receives the register form data using the HTTPD POST method 
     * 
     * * 1 - Validate the form. 
     * * 2 - If the credentials match, get the user info from the DB and generate a $_SESSION with the user values.
     * * 3 - Redirect to the main page.
     */

    public function login()
    {
        $this->validatorService->validateLogin($_POST);

        $this->userService->login($_POST);

        redirectTo('/');
    }

    /**
     * Destroy the user SESSION and delete the cookie
     */

    public function logout()
    {
        $this->userService->logout();

        redirectTo('/login');
    }
}
