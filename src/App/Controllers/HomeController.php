<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

use App\Services\{ValidatorService, UserService, BlogService, ImageService};

// Controllers are classes responsible to render a page content,
// by convention PagenameController for the class and the filename.
// Responsible to render the content from the Home Page

class HomeController
{
    // to create an instance of the TemplateEngine to render the content
    // moving the property TemplateEngine as a parameter of the construct method to look for dependencies    

    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private UserService $userService,
        private BlogService $blogService,
        private ImageService $imageService
    ) {
        // To check that HomeController and TemplateDataMiddleware have 2 different instances of the object(Framework\TemplateEngine)#11
        // After apply Singleton Pattern they both have the same instance
        // var_dump($this->view);
        // echo "<br />";
    }

    // HOME PAGE - index.php

    public function home()
    {
        // HOME PAGE TEXTS
        $header = homeHeader($_SESSION['lang']);
        $terapia = homeTerapia($_SESSION['lang']);
        $sintomas = homeSintomas($_SESSION['lang']);
        $exploracion = homeSesionExploracion($_SESSION['lang']);
        $metodo = homeMetodo($_SESSION['lang']);
        $motivos = homeMotivos($_SESSION['lang']);
        $beneficios = homeBeneficios($_SESSION['lang']);
        $precios = homePrecios($_SESSION['lang']);
        $newsletter = homeNewsletter($_SESSION['lang']);
        // BLOG ENTRIES
        $blog = $this->blogService->getBlogEntriesWeb($_SESSION['lang']);

        echo $this->view->render("index.php", [
            // SECTION TEXTS            
            'header' => $header,
            'terapia' => $terapia,
            'sintomas' => $sintomas,
            'exploracion' => $exploracion,
            'metodo' => $metodo,
            'motivos' => $motivos,
            'beneficios' => $beneficios,
            'precios' => $precios,
            'newsletter' => $newsletter,
            // BLOG
            'blogList' => $blog
        ]);
    }

    // PRIVACY PAGE - privacy.php

    public function privacy()
    {
        $content = privacyContent($_SESSION['lang']);

        echo $this->view->render("privacy.php", [
            'title' => 'Durgga - ' . $content['title'],
            // content
            'content' => $content
        ]);
    }

    /**
     * Receives the register form data using the HTTPD POST method 
     * 
     * * 1 - Validate the form. 
     * * 2 - Check if the Email already exists.
     * * 3 - Add the email in the newsletter DB Table.
     * * 4 - Redirect to the newsletter page message.
     */

    public function newsletter()
    {

        $this->validatorService->validateNewsletter($_POST, $_SESSION['lang']);

        $this->userService->isEmailTaken($_POST['email'], 'newsletter');

        $this->userService->addEmailNewsletterList($_POST);

        redirectTo('/newsletter');
    }

    /**
     * Change the language using a $_SESSION['lang']
     * @param $_GET['lang'] ISO code of the language to switch the language
     */

    public function langChange()
    {
        isset($_GET['lang']) ? $param = $_GET['lang'] : $param = null;
        $this->userService->changeLanguage($param);

        redirectTo($_SERVER['HTTP_REFERER']);
    }
}
