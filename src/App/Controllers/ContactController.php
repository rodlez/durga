<?php

declare(strict_types=1);

namespace App\Controllers;

// Controllers are classes responsible to render a page content,
// by convention PagenameController for the class and the filename.
// Responsible to render the content from the About Page

use Framework\TemplateEngine;

use App\Services\{ValidatorService, ContactService, PaginationService};


class ContactController
{
    // We inject now the instance(private TemplateEngine $view) in the __construct method
    // instead of create using $this->view = new TemplateEngine(Paths::VIEW)

    public function __construct(
        private TemplateEngine $view,
        private ContactService $contactService,
        private ValidatorService $validatorService,
        private PaginationService $paginationService
    ) {}

    /* ********************************************** PUBLIC *************************************************** */


    /**
     * Render Page for Contact
     *
     * * Use the $_GET['asunto] to now wich subject select in the contact form
     */

    public function contactView()
    {

        isset($_GET['asunto']) ? $param = $_GET['asunto'] : $param = null;

        echo $this->view->render("contacto.php", [
            'title' => 'Contacto',
            'sitemap' => '<a href="/">Home</a> / <b>Contacto</b>',
            'header' => "Contacto page",
            'asunto' => $param
        ]);
    }

    /**
     * Validates the Contact form and if it is OK, save the data in the contact DB Table 
     * 
     */

    public function contact()
    {
        $this->validatorService->validateContact($_POST, 'es');

        $this->contactService->newContact($_POST);

        redirectTo('/contacto/ok');
    }

    /**
     * Render Page for Contact after the form is send
     *
     * * Display a message to the user and a go back link
     */

    public function contactOk()
    {
        echo $this->view->render("contacto-ok.php", [
            'title' => 'Contacto',
            'sitemap' => '<a href="/">Home</a> / <b>Contacto</b>',
            'header' => "Contacto page",
        ]);
    }

    /* ********************************************** ADMIN *************************************************** */

    /**
     * Render main Admin Page for Contact
     *
     * * Show / Edit / Delete contact entries from the contacts DB Table
     */

    public function adminContactView()
    {
        $pagination = $this->paginationService->generatePagination($_GET, 'email', 'email');

        [$list, $totalResults] = $this->contactService->getContacts($pagination);

        [$pageLinks, $previousPageQuery, $nextPageQuery, $lastPage] = $this->paginationService->generatePaginationLinks($totalResults, $pagination);

        echo $this->view->render("/admin/contact/index.php", [
            // Template information
            'title' => 'Admin Panel',
            'sitemap' => '<a href="/admin">Admin</a> / <b>Contact</b>',
            'header' => 'Contact List',
            // query
            'contactList' => $list,
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
     * Render the page fot Edit the Contact information given his Id
     * @param array $params Route Param Id
     */

    public function adminCreateContactView()
    {

        echo $this->view->render("/admin/contact/create.php", [
            // Template information
            'title' => 'Admin Panel',
            'sitemap' => '<a href="/admin">Admin</a> / <a href="/admin/contact">Contact</a> / <b>Create</b>',
            'header' => 'Create a new Contact'
        ]);
    }

    /**
     * Validates the Admin Contact form and if it is OK, save the data in the contact DB Table 
     * 
     */

    public function adminCreateContact()
    {
        $this->validatorService->validateContactAdmin($_POST, 'es');

        $result = $this->contactService->newContactAdmin($_POST);

        ($result->errors) ? $_SESSION['CRUDMessage'] = "Error (" . $result->errors['SQLCode'] . ") Contact with " . $_POST['email'] . " can not be created." : $_SESSION['CRUDMessage'] = "Contact with Email " . $_POST['email'] . " created.";

        redirectTo('/admin/contact');
    }

    /**
     * Render the page fot Contact information given his Id
     * @param array $params Route Param Id
     */

    public function adminContactInfoView(array $params)
    {
        $contact = $this->contactService->getContactInfo($params['id']);
        if (!$contact) redirectTo("/admin/contact");

        echo $this->view->render("/admin/contact/show.php", [
            // Template information
            'title' => 'Admin Panel',
            'sitemap' => '<a href="/admin">Admin</a> / <a href="/admin/contact">Contact</a> / <b>Info</b>',
            'header' => 'Information about the contact',
            // Contact Information from the DB
            'contact' => $contact
        ]);
    }

    /**
     * Render the page fot Edit the Contact information given his Id
     * @param array $params Route Param Id
     */

    public function adminContactEditView(array $params)
    {
        $contact = $this->contactService->getContactInfo($params['id']);
        if (!$contact) redirectTo("/admin/contact/");

        echo $this->view->render("/admin/contact/edit.php", [
            // Template information
            'title' => 'Admin Panel',
            'sitemap' => '<a href="/admin">Admin</a> / <a href="/admin/contact">Contact</a> / <b>Edit</b>',
            'header' => 'Edit Contact Information',
            // Contact Information from the DB
            'contact' => $contact
        ]);
    }

    /**
     * Update the entry with the given Id in the DB Table contact
     * @param array $params Route Param Id
     */

    public function adminContactEdit(array $params)
    {
        $contact = $this->contactService->getContactInfo($params['id']);
        if (!$contact) redirectTo("/admin/contact/");

        $this->validatorService->validateContactEditAdmin($_POST, 'es');

        $result = $this->contactService->updateContact($_POST, (int) $params['id']);

        ($result->errors) ? $_SESSION['CRUDMessage'] = "Error (" . $result->errors['SQLCode'] . ") Contact with " . $_POST['email'] . " can not be edited." : $_SESSION['CRUDMessage'] = "Contact with Email " . $_POST['email'] . " edited.";

        redirectTo("/admin/contact/{$params['id']}");
    }

    /**
     * Delete the entry with the given Id in the DB Table contact
     * @param array $params Route Param Id
     */

    public function adminContactDelete(array $params)
    {
        $contact = $this->contactService->getContactInfo($params['id']);
        if (!$contact) redirectTo("/admin/contact/");

        $result = $this->contactService->deleteContact((int) $params['id']);
        ($result->errors) ? $_SESSION['CRUDMessage'] = "Error (" . $result->errors['SQLCode'] . ") Contact with Email " . $contact->email . " can not be deleted." : $_SESSION['CRUDMessage'] = "Contact with Email " . $contact->email . " deleted.";

        redirectTo("/admin/contact");
    }


    /** TEST PHPMAILER */

    /**
     * Render the page fot Edit the Contact information given his Id
     * @param array $params Route Param Id
     */

    public function adminContactAnswerView(array $params)
    {
        $contact = $this->contactService->getContactInfo($params['id']);
        if (!$contact) redirectTo("/admin/contact/");

        // send
        $resultado = $this->contactService->sendEmailContact($contact);

        echo $this->view->render("/admin/contact/answer.php", [
            // Template information
            'title' => 'Admin Panel',
            'sitemap' => '<a href="/admin">Admin</a> / <a href="/admin/contact">Contact</a> / <b>Answer</b>',
            'header' => 'Edit Contact Information',
            // Contact Information from the DB
            'contact' => $contact,
            'resultado' => $resultado
        ]);
    }
}
