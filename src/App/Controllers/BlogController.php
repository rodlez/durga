<?php

declare(strict_types=1);

namespace App\Controllers;

// Controllers are classes responsible to render a page content,
// by convention PagenameController for the class and the filename.
// Responsible to render the content from the About Page

use Framework\TemplateEngine;

use App\Config\Paths;

use App\Services\{ValidatorService, BlogService, CategoryService, TagService, ContactService, ImageService, PaginationService, UserService};


class BlogController
{
    // We inject now the instance(private TemplateEngine $view) in the __construct method
    // instead of create using $this->view = new TemplateEngine(Paths::VIEW)

    public function __construct(
        private TemplateEngine $view,
        private BlogService $blogService,
        private CategoryService $categoryService,
        private TagService $tagService,
        private ContactService $contactService,
        private ImageService $imageService,
        private ValidatorService $validatorService,
        private PaginationService $paginationService,
        private UserService $userService
    ) {}

    /* ********************************************** PUBLIC *************************************************** */


    public function blogView()
    {
        $blogList = $this->blogService->getAllBlogEntries();
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

        $content = blogContent($_SESSION['lang']);


        // Because of the Singleton Pattern, Now if we do not specify a title, the App will take the title define
        // on the TemplateDataMiddleware
        echo $this->view->render("/blog/index.php", [
            // Template information
            'title' => 'Blog',
            'sitemap' => '<a href="/admin">Admin</a> / <b>Blog</b>',
            'header' => 'Aquí podrás encontrar una selección de artículos',
            // Info
            'blogList' => $blogList,
            'images' => $images,
            'blogTotal' => $blogTotal,
            // Content
            'content' => $content
        ]);
    }

    /**
     * Render the page fot Edit the Contact information given his Id
     * @param array $params Route Param Id
     */

    public function blogEntryView($params)
    {

        $blog = $this->blogService->getBlogEntrybyId($params['id']);
        if (!$blog) redirectTo("/blog");

        $category = $this->categoryService->getCategoryName($blog->blog_category_id);
        $tags = $this->blogService->getTagsInBlog($params['id']);
        $tagNames = $this->blogService->tagsOrderByName($tags);
        $images = $this->imageService->getAllBlogImages((int) $params['id']);
        //$user = $this->userService->getUserInfo($_SESSION['user']);

        echo $this->view->render("/blog/show.php", [
            // Template information
            'title' => 'Blog',
            'sitemap' => '<a href="/admin">Admin</a> / <a href="/admin/blog">Blog</a> / <b>Info</b>',
            'header' => $blog->title,
            // Blog Information from the DB
            'blog' => $blog,
            'category' => $category,
            'tags' => $tagNames,
            'images' => $images
            // User Info
            //'user' => $user
        ]);
    }

    /* ********************************************** ADMIN *************************************************** */

    /**
     * Render main Admin Page for Contact
     *
     * * Show / Edit / Delete contact entries from the contacts DB Table
     */

    public function adminBlogView()
    {
        $pagination = $this->paginationService->generatePagination($_GET, 'created_at', 'id');

        [$list, $totalResults] = $this->blogService->getBlogEntries($pagination);

        [$pageLinks, $previousPageQuery, $nextPageQuery, $lastPage] = $this->paginationService->generatePaginationLinks($totalResults, $pagination);

        echo $this->view->render("/admin/blog/index.php", [
            // Template information
            'title' => 'Admin Panel',
            'sitemap' => '<a href="/admin">Admin</a> / <b>Blog</b>',
            'header' => 'Contact List',
            // query
            'blogList' => $list,
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

    public function createBlogView()
    {
        $categories = $this->categoryService->getAllCategories();
        $tags = $this->tagService->getAllTags();

        echo $this->view->render("/admin/blog/create.php", [
            // Template information
            'title' => 'Admin Panel',
            'sitemap' => '<a href="/admin">Admin</a> / <a href="/admin/blog">Blog</a> / <b>Create</b>',
            'header' => 'Create a new Blog Entry',
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Validates the Admin Contact form and if it is OK, save the data in the contact DB Table 
     * 
     */

    public function createBlog()
    {
        $this->validatorService->validateBlog($_POST, 'es');

        $result = $this->blogService->newBlogEntry((int) $_SESSION['user'], $_POST, (int) $_POST['category'], $_POST['tag']);

        //TODO: use an exception instead?
        ($result['error']) ? $_SESSION['CRUDMessage'] = "Error(" . $result['error'] . ") - Blog <b>(" . excerpt($_POST['title'], 30) . ")</b> can not be created." : $_SESSION['CRUDMessage'] = "Transaction <b>(" . excerpt($_POST['title'], 30) . ")</b> created.";
        //debugator();       
        redirectTo('/admin/blog');
    }

    /**
     * Render the page fot Contact information given his Id
     * @param array $params Route Param Id
     */

    public function infoBlogView(array $params)
    {
        $blog = $this->blogService->getBlogEntry($params['id'], $_SESSION['user']);
        if (!$blog) redirectTo("/admin/blog");

        $category = $this->categoryService->getCategoryName($blog->blog_category_id);
        $tags = $this->blogService->getTagsInBlog($params['id']);
        $tagNames = $this->blogService->tagsOrderByName($tags);
        $images = $this->imageService->getAllBlogImages((int) $params['id']);
        $user = $this->userService->getUserInfo($_SESSION['user']);

        echo $this->view->render("/admin/blog/show.php", [
            // Template information
            'title' => 'Admin Panel',
            'sitemap' => '<a href="/admin">Admin</a> / <a href="/admin/blog">Blog</a> / <b>Info</b>',
            'header' => 'Information about the blog entry',
            // Blog Information from the DB
            'blog' => $blog,
            'category' => $category,
            'tags' => $tagNames,
            'images' => $images,
            // User Info
            'user' => $user
        ]);
    }

    /**
     * Render the edit form (/transactions/edit.php) using the render method in the TemplateEngine class
     * @param array $params pass in the 
     */

    public function editBlogView(array $params)
    {
        $blog = $this->blogService->getBlogEntry($params['id'], $_SESSION['user']);
        if (!$blog) redirectTo("/admin/blog");

        $categories = $this->categoryService->getAllCategories();
        $tags = $this->tagService->getAllTags();
        $selectedTags = $this->tagService->getTagsInBlogEntry($blog->id);

        echo $this->view->render("/admin/blog/edit.php", [
            // Template information
            'title' => 'Admin Panel',
            'sitemap' => '<a href="/admin">Admin</a> / <a href="/admin/blog">Blog</a> / <b>Edit</b>',
            'header' => 'Information about the blog entry to Edit',
            // Blog Information from the DB
            'blog' => $blog,
            'tags' => $tags,
            'selectedTags' => $selectedTags,
            'categories' => $categories
        ]);
    }


    /**
     * Receives the form data from the transactions/edit.php using the HTTPD POST method 
     * 
     * * 1 - Get the transaction information checking the parameter id in the router
     * * 2 - Validate the edit form. 
     * * 3 - cast the categoryId as (int) because as a POST parameter is a string
     * * 4 - Update the Tables transactions, categories and transaction_tag using a transaction to be sure that all are successful
     * * 5 - Redirect to the same page to show if the edition was successful or not.
     */

    public function editBlog(array $params)
    {
        $blog = $this->blogService->getBlogEntry($params['id'], $_SESSION['user']);
        if (!$blog) redirectTo("/admin/blog");

        $this->validatorService->validateBlogEdit($_POST, 'es');

        $result = $this->blogService->updateBlogEntry($blog->id, (int) $_SESSION['user'], $_POST, (int) $_POST['category'], $_POST['tag']);

        //TODO: use an exception instead?
        ($result['error']) ? $_SESSION['CRUDMessage'] = "Error(" . $result['error'] . ") - Blog Entry can not be updated." : $_SESSION['CRUDMessage'] = "Blog Entry updated.";

        // after create the transaction go to the main page
        redirectTo("/admin/blog/{$params['id']}");
    }

    /**
     * Receives the form data from the transactions/edit.php using the HTTPD POST method 
     * 
     * * 1 - Get the transaction information checking the parameter id in the router
     * * 2 - Validate the edit form. 
     * * 3 - cast the categoryId as (int) because as a POST parameter is a string
     * * 4 - Update the Tables transactions, categories and transaction_tag using a transaction to be sure that all are successful
     * * 5 - Redirect to the same page to show if the edition was successful or not.
     */

    public function adminBlogPublish(array $params)
    {
        $blog = $this->blogService->getBlogEntry($params['id'], $_SESSION['user']);
        if (!$blog) redirectTo("/admin/blog");

        $result = $this->blogService->publishBlogEntry($blog->id, $params['pub']);

        //($result->errors) ? $_SESSION['CRUDMessage'] = "Error (" . $result->errors['SQLCode'] . ") Blog " . $blog->title . " published status can not be changed." : $_SESSION['CRUDMessage'] = "Blog " . $blog->title . " published status changed.";

        if ($result->errors) {
            $_SESSION['CRUDMessage'] = "Error (" . $result->errors['SQLCode'] . ") Entry Blog " . $blog->title . " published status can not be changed.";
        } else {
            ($params['pub'] == 0) ? $_SESSION['CRUDMessage'] = "Entry Blog " . $blog->title . " is now NOT published." : $_SESSION['CRUDMessage'] = "Entry Blog " . $blog->title . " is now published.";
        }


        // after create the transaction go to the main page
        redirectTo("/admin/blog/{$params['id']}");
    }

    /**
     * Activated when the button delete is pressed and send to transactions/{transactions} with method="DELETE" in an input type hidden in the form
     * 
     * @params hidden id variables user and transaction send in the delete form, and transactionName to show the name of the deleted transaction
     * 
     * * Delete the transaction with the same id in the Table transactions, 
     * * ON CASCADE will delete all the entries in the relational Table transaction_tag
     * * If the Transaction is deleted from the DB, then delete also all the receipts files associated
     * * Redirect to the main page.
     */

    public function deleteBlog(array $params)
    {
        $images = $this->imageService->getAllBlogImages((int) $params['id']);

        $result = $this->blogService->deleteBlogEntry((int) $_SESSION['user'], (int) $params['id']);

        //TODO: use an exception instead?
        if ($result !== 1) {
            $_SESSION['CRUDMessage'] = "Blog Entry Can NOT be deleted.";
        } else {
            // if OK delete from the DB, delete all the receipts files related
            $_SESSION['CRUDMessage'] = "Blog Entry whit ID <b>({$params['id']})</b> has been deleted.";
            foreach ($images as $image) {
                $this->imageService->deleteImageFile($image);
            }
        }

        redirectTo('/admin/blog');
    }
}
