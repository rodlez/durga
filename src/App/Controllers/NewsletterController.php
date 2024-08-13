<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

use App\Services\{NewsletterService, ValidatorService, PaginationService};

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
        private ValidatorService $validatorService,
        private PaginationService $paginationService
    ) {}

    public function newsletterOk()
    {
        echo $this->view->render("newsletter.php", [
            'title' => 'Newsletter',
            'sitemap' => '<a href="/">Home</a> / <b>Newsletter</b>',
            'header' => "Newsletter page",
            'dangerousData' => '<script>alert(123)</script>'
        ]);
    }

    /**************************** ADMIN *******************************************/

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

    /**
     * Render the admin panel to create a new newsletter entry (/admin/newsletter/create.php) using the render method in the TemplateEngine class
     */

    public function createNewsletterView()
    {
        echo $this->view->render("admin/newsletter/create.php", [
            // Template information
            'title' => 'Admin Panel',
            'sitemap' => '<a href="/admin">Admin</a> / <a href="/admin/newsletter">Newsletter</a> / <b>New</b>',
            'header' => 'Enter New Email in the Newsletter list'
        ]);
    }

    /**
     * Insert a new entry in the DB Table categories
     */

    public function createNewsletterEntry()
    {
        $this->validatorService->validateNewsletter($_POST, 'es');

        $result = $this->newsletterService->insertNewEmail($_POST);

        ($result->errors) ? $_SESSION['CRUDMessage'] = "Error (" . $result->errors['SQLCode'] . ") " . $_POST['email'] . " can not be inserted." : $_SESSION['CRUDMessage'] = "Email " . $_POST['email'] . " inserted.";

        redirectTo('/admin/newsletter');
    }

    /**
     * Render the admin panel to edit a email (/admin/newsletter/edit.php) using the render method in the TemplateEngine class
     * @param array $params Newsletter Id entry
     */

    public function editNewsletterEntryView(array $params)
    {
        $email = $this->newsletterService->getEmail($params['newsletter']);
        if (!$email) redirectTo('/admin/newsletter');

        echo $this->view->render("admin/newsletter/edit.php", [
            // Template information
            'title' => 'Admin Panel',
            'sitemap' => '<a href="/admin">Admin</a> / <a href="/admin/newsletter">Newsletter</a> / <b>Edit</b>',
            'header' => 'Edit Email in the Newsletter list',
            'email' => $email
        ]);
    }

    /**
     * Update the entry with the given Id in the DB Table newsletter
     * @param array $params Newsletter Id entry
     */

    public function editNewsletterEntry(array $params)
    {
        showNice($params);
        $email = $this->newsletterService->getEmail($params['newsletter']);
        if (!$email) redirectTo('/admin/newsletter');

        $this->validatorService->validateNewsletter($_POST, 'es');

        $result = $this->newsletterService->updateEmail($_POST, (int) $params['newsletter']);

        ($result->errors) ? $_SESSION['CRUDMessage'] = "Error (" . $result->errors['SQLCode'] . ") " . $_POST['email'] . " can not be edited." : $_SESSION['CRUDMessage'] = "Email " . $_POST['email'] . " edited.";

        redirectTo("/admin/newsletter/{$params['newsletter']}");
    }

    /**
     * Delete the entry with the given Id in the DB Table newsletter
     * @param array $params Newsletter Id entry
     */

    public function deleteNewsletterEntry(array $params)
    {
        $email = $this->newsletterService->getEmail($params['newsletter']);
        if (!$email) redirectTo('/admin/newsletter');

        $result = $this->newsletterService->deleteEmail((int) $params['newsletter']);
        ($result->errors) ? $_SESSION['CRUDMessage'] = "Error (" . $result->errors['SQLCode'] . ") " . $email->email . " can not be deleted." : $_SESSION['CRUDMessage'] = "Email " . $email->email . " deleted.";

        redirectTo("/admin/newsletter");
    }


    /**
     * Render the page fot Edit the Contact information given his Id
     * @param array $params Route Param Id
     */

    public function sendNewsletterView()
    {
        $newsletterList = $this->newsletterService->getAllEmails();
        if (!$newsletterList) redirectTo('/admin/newsletter');

        echo $this->view->render("/admin/newsletter/send.php", [
            // Template information
            'title' => 'Admin Panel - Newsletter',
            'sitemap' => '<a href="/admin">Admin</a> / <a href="/admin/newsletter">Newsletter</a> / <b>Send Newsletter</b>',
            'header' => 'Newsletter',
            // Contact Information from the DB
            'newsletterList' => $newsletterList
        ]);
    }

    /**
     * Render the page fot Edit the Contact information given his Id
     * @param array $params Route Param Id
     */

    public function sendNewsletter(array $params)
    {
        $newsletterList = $this->newsletterService->getAllEmails();
        if (!$newsletterList) redirectTo('/admin/newsletter');

        $this->validatorService->validateContactAnswerAdmin($_POST, 'es');
        //debugator($newsletterList);
        // send mail using phpMailer
        $result = $this->newsletterService->sendNewsletter($newsletterList, $_POST);
        // If send is OK, then update the DB Table contacts with 

        ($result !== 1) ? $_SESSION['CRUDMessage'] = "Error - Newsletter can not be sent." : $_SESSION['CRUDMessage'] = "Newsletter sent.";

        redirectTo("/admin/newsletter/send");
    }
}
