<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

use App\Services\{NewsletterService, PaginationService};

// Controllers are classes responsible to render a page content,
// by convention PagenameController for the class and the filename.
// Responsible to render the content from the Home Page

class NewsletterController
{
    // to create an instance of the TemplateEngine to render the content
    // moving the property TemplateEngine as a parameter of the construct method to look for dependencies    

    public function __construct(
        private TemplateEngine $view,
        private NewsletterService $newsletterService,
        private PaginationService $paginationService
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

    /**
     * Render the admin panel to manage the newsletter (/admin/newsletter/index.php) using the render method in the TemplateEngine class
     */

    public function newsletterView()
    {
        //debugator($_GET);
        $pagination = $this->paginationService->generatePagination($_GET, 'email', 'email');

        [$newsletterList, $totalResults] = $this->newsletterService->getNewsletter($pagination);

        [$pageLinks, $previousPageQuery, $nextPageQuery, $lastPage] = $this->paginationService->generatePaginationLinks($totalResults, $pagination);

        echo $this->view->render("/admin/newsletter/index.php", [
            // Template information
            'title' => 'Admin Panel',
            'sitemap' => '<a href="/admin">Admin</a> / <b>Newsletter</b>',
            'header' => 'Newsletter List',
            // query
            'newsletterList' => $newsletterList,
            'totalResults' => $totalResults,
            // pagination
            'perPage' => $pagination['perPage'],
            'currentPage' => $pagination['page'],
            'pageLinks' => $pageLinks,
            'previousPageQuery' => $previousPageQuery[0],
            'nextPageQuery' =>  $nextPageQuery[0],
            'lastPage' => $lastPage,
            // search
            'searchTerm' => $pagination['searchTerm'],
            'searchCol' => $pagination['searchCol'],
            // sorting
            'sort' => $pagination['sort'],
            'direction' => $pagination['direction']
        ]);
    }
}
