<?php

declare(strict_types=1);

namespace App\Controllers;

// Controllers are classes responsible to render a page content,
// by convention PagenameController for the class and the filename.
// Responsible to render the content from the About Page

use Framework\TemplateEngine;
// to use the paths in the templates
use App\Config\Paths;


class AboutController
{
    // We inject now the instance(private TemplateEngine $view) in the __construct method
    // instead of create using $this->view = new TemplateEngine(Paths::VIEW)

    public function __construct(private TemplateEngine $view) {}

    public function about()
    {
        $content = aboutContent($_SESSION['lang']);
        //debugator($content);
        echo $this->view->render("about.php", [
            'title' => 'Durgga - ' . $content['title'],
            'sitemap' => '<a href="/">Home</a> / <b>About</b>',
            'header' => "Sobre mi page",
            'dangerousData' => '<script>alert(123)</script>',
            // CONTENT
            'content' => $content
        ]);
    }
}
