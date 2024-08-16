<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class ErrorController
{
    public function __construct(private TemplateEngine $view) {}

    public function notFound()
    {
        $content = errorContent($_SESSION['lang']);

        echo $this->view->render("errors/not-found.php", [
            'title' => 'Durgga - ' . $content['title'],
            // content
            'content' => $content
        ]);
    }
}
