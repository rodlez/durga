<?php

declare(strict_types=1);

namespace App\Controllers;

// Controllers are classes responsible to render a page content,
// by convention PagenameController for the class and the filename.
// Responsible to render the content from the About Page

use Framework\TemplateEngine;
// to use the paths in the templates
use App\Config\Paths;

use App\Services\{UserService, ValidatorService, TransactionService, CategoryService, PeriodService, TagService, ReceiptService, PaginationService};



class AdminController
{
    public function __construct(
        private TemplateEngine $view
    ) {
    }

    public function adminView()
    {
        echo $this->view->render("/admin/index.php", [
            'title' => 'Admin Panel',
            'sitemap' => '<b>Admin Panel</b>',
            'header' => 'Admin Panel'
        ]);
    }
}
