<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

use App\Services\{ValidatorService, UserService};

// Controllers are classes responsible to render a page content,
// by convention PagenameController for the class and the filename.
// Responsible to render the content from the Home Page

class NewsletterController
{
    // to create an instance of the TemplateEngine to render the content
    // moving the property TemplateEngine as a parameter of the construct method to look for dependencies    

    public function __construct(
        private TemplateEngine $view
    ) {
    }

    public function newsletterOk()
    {
        echo $this->view->render("newsletter.php", [
            'title' => 'Newsletter',
            'sitemap' => '<a href="/">Home</a> / <b>Newsletter</b>',
            'header' => "Newsletter page",
            'dangerousData' => '<script>alert(123)</script>'
        ]);
    }
}
