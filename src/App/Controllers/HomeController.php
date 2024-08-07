<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

// to use the paths in the templates
use App\Config\Paths;

// Controllers are classes responsible to render a page content,
// by convention PagenameController for the class and the filename.
// Responsible to render the content from the Home Page

class HomeController
{
    // to create an instance of the TemplateEngine to render the content
    // moving the property TemplateEngine as a parameter of the construct method to look for dependencies    

    public function __construct(private TemplateEngine $view)
    {
        // To check that HomeController and TemplateDataMiddleware have 2 different instances of the object(Framework\TemplateEngine)#11
        // After apply Singleton Pattern they both have the same instance
        // var_dump($this->view);
        // echo "<br />";
    }


    public function home()
    {
        // Because of the Singleton Pattern, Now if we do not specify a title, the App will take the title define
        // on the TemplateDataMiddleware
        echo $this->view->render("index.php");
    }
}
