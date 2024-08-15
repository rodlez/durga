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


    public function home()
    {

        /*
        $blogList = $this->blogService->getAllBlogEntries();
        //$blogListTranslations = $this->blogService->getAllBlogEntryTranslations();

        $images = $this->imageService->getAllImages();

        $blogTotal = [];
        $count = 0;

        foreach ($images as $image) {
            //showNice($blogList[$image->blog_id], "BLOG_ID $image->blog_id");
            foreach ($blogList as $blog) {
                if ($image->blog_id === $blog->id) {
                    $blogTotal[$count]['data'] = $blog;
                    $blogTotal[$count]['images'] = $image;
                }
            }
            $count++;
        }
        */

        // GET TEXTS
        $header = homeHeader($_SESSION['lang']);
        $terapia = homeTerapia($_SESSION['lang']);
        $sintomas = homeSintomas($_SESSION['lang']);
        $exploracion = homeSesionExploracion($_SESSION['lang']);
        $metodo = homeMetodo($_SESSION['lang']);
        $motivos = homeMotivos($_SESSION['lang']);
        $beneficios = homeBeneficios($_SESSION['lang']);
        $precios = homePrecios($_SESSION['lang']);
        $newsletter = homeNewsletter($_SESSION['lang']);

        $blog = $this->blogService->getBlogEntriesWeb($_SESSION['lang']);

        // Because of the Singleton Pattern, Now if we do not specify a title, the App will take the title define
        // on the TemplateDataMiddleware
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
            //'blogList' => $blogList,            
            //'images' => $images,
            //'blogTotal' => $blogTotal
            'blogList' => $blog
        ]);
    }

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
     * Destroy the user SESSION and delete the cookie
     */

    public function langChange()
    {
        //debugator($_GET);
        isset($_GET['lang']) ? $param = $_GET['lang'] : $param = null;
        $this->userService->changeLanguage($param);

        redirectTo($_SERVER['HTTP_REFERER']);
    }
}
