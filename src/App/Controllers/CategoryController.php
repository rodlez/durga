<?php

declare(strict_types=1);

namespace App\Controllers;

// Controllers are classes responsible to render a page content,
// by convention PagenameController for the class and the filename.
// Responsible to render the content from the Home Page

use Framework\TemplateEngine;
// to use the paths in the templates, now we can use the constant VIEW to define the path to render the template engine
use App\Services\{ValidatorService, CategoryService, PaginationService};


class CategoryController
{

    // to create an instance of the TemplateEngine to render the content
    // moving the property TemplateEngine as a parameter of the construct method to look for dependencies    
    // making an instance of the ValidatorService to be accessible by the AuthController class

    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private CategoryService $categoryService,
        private PaginationService $paginationService
    ) {
        // we do NOT need to manually create an instance of the TemplateEngine class
        // $this->view = new TemplateEngine(Paths::VIEW);
        // Common practice to list dependencies from the construct method
    }

    /**
     * Render the admin panel to manage the categories (/admin/categories/index.php) using the render method in the TemplateEngine class
     */

    public function categoryView()
    {
        $pagination = $this->paginationService->generatePagination($_GET, 'name', 'name');

        [$categories, $totalResults] = $this->categoryService->getCategories($pagination);

        [$pageLinks, $previousPageQuery, $nextPageQuery, $lastPage] = $this->paginationService->generatePaginationLinks($totalResults, $pagination);

        echo $this->view->render("/admin/categories/index.php", [
            // Template information
            'title' => 'Admin Panel',
            'sitemap' => '<a href="/admin">Admin</a> / <b>Categories</b>',
            'header' => 'Categories',
            // query
            'categories' => $categories,
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
     * Render the admin panel to create a new category (/admin/categories/create.php) using the render method in the TemplateEngine class
     */

    public function createCategoryView()
    {
        echo $this->view->render("admin/categories/create.php", [
            // Template information
            'title' => 'Admin Panel',
            'sitemap' => '<a href="/admin">Admin</a> / <a href="/admin/category">Categories</a> / <b>New Category</b>',
            'header' => 'Categories'
        ]);
    }

    /**
     * Insert a new entry in the DB Table categories
     */

    public function createCategory()
    {
        $this->validatorService->validateCategory($_POST, 'es');

        $result = $this->categoryService->createNewCategory($_POST);

        ($result->errors) ? $_SESSION['CRUDMessage'] = "Error(" . $result->errors['SQLCode'] . ") - Category " . $_POST['name'] . " can not be created." : $_SESSION['CRUDMessage'] = "Category " . $_POST['name'] . " created.";

        redirectTo('/admin/category');
    }

    /**
     * Render the admin panel to edit a category (/admin/categories/edit.php) using the render method in the TemplateEngine class
     */

    public function editCategoryView(array $params)
    {

        $category = $this->categoryService->getCategory($params['category']);
        if (!$category) redirectTo('/admin/category');

        echo $this->view->render("admin/categories/edit.php", [
            // Template information
            'title' => 'Admin Panel',
            'sitemap' => '<a href="/admin">Admin</a> / <a href="/admin/category">Categories</a> / <b>Edit Category</b>',
            'header' => 'Category name',
            'category' => $category
        ]);
    }

    /**
     * Update the entry with the given categoryId in the DB Table categories
     */

    public function editCategory(array $params)
    {
        $category = $this->categoryService->getCategory($params['category']);
        if (!$category) redirectTo('/admin/category');

        $this->validatorService->validateCategory($_POST, 'es');

        $result = $this->categoryService->updateCategory($_POST, (int) $params['category']);

        ($result->errors) ? $_SESSION['CRUDMessage'] = "Error(" . $result->errors['SQLCode'] . ") - Category " . $_POST['name'] . " can not be edited." : $_SESSION['CRUDMessage'] = "Category " . $_POST['name'] . " edited.";

        redirectTo("/admin/category");
    }

    /**
     * Delete the entry with the given categoryId in the DB Table categories
     */

    public function deleteCategory(array $params)
    {
        $category = $this->categoryService->getCategory($params['category']);
        if (!$category) redirectTo('/admin/category');

        $result = $this->categoryService->deleteCategory((int) $params['category']);
        ($result->errors) ? $_SESSION['CRUDMessage'] = "Error(" . $result->errors['SQLCode'] . ") - Category " . $_POST['category'] . " can not be deleted." : $_SESSION['CRUDMessage'] = "Category " . $_POST['category'] . " deleted.";

        redirectTo("/admin/category");
    }
}
