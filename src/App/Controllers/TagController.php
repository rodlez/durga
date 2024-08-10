<?php

declare(strict_types=1);

namespace App\Controllers;

// Controllers are classes responsible to render a page content,
// by convention PagenameController for the class and the filename.
// Responsible to render the content from the Home Page

use Framework\TemplateEngine;
// to use the paths in the templates, now we can use the constant VIEW to define the path to render the template engine
use App\Services\{ValidatorService, TagService, PaginationService};


class TagController
{

    // to create an instance of the TemplateEngine to render the content
    // moving the property TemplateEngine as a parameter of the construct method to look for dependencies    
    // making an instance of the ValidatorService to be accessible by the AuthController class

    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private TagService $tagService,
        private PaginationService $paginationService
    ) {
        // we do NOT need to manually create an instance of the TemplateEngine class
        // $this->view = new TemplateEngine(Paths::VIEW);
        // Common practice to list dependencies from the construct method
    }

    /**
     * Render the admin panel to manage the tags (/admin/tags/index.php) using the render method in the TemplateEngine class
     */

    public function tagView()
    {
        $pagination = $this->paginationService->generatePagination($_GET, 'name', 'name');

        [$tags, $totalResults] = $this->tagService->getTags($pagination);

        [$pageLinks, $previousPageQuery, $nextPageQuery, $lastPage] = $this->paginationService->generatePaginationLinks($totalResults, $pagination);

        echo $this->view->render("/admin/tags/index.php", [
            // Template information
            'title' => 'Admin Panel',
            'sitemap' => '<a href="/admin">Admin</a> / <b>Tags</b>',
            'header' => 'Tags',
            // query
            'tags' => $tags,
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
     * Render the admin panel to create a new tag (/admin/tags/create.php) using the render method in the TemplateEngine class
     */

    public function createTagView()
    {
        echo $this->view->render("admin/tags/create.php", [
            // Template information
            'title' => 'Admin Panel',
            'sitemap' => '<a href="/admin">Admin</a> / <a href="/admin/tag">Tags</a> / <b>New tag</b>',
            'header' => 'Tags'
        ]);
    }

    /**
     * Insert a new entry in the DB Table tags
     */

    public function createTag()
    {
        $this->validatorService->validateTag($_POST, 'es');

        $result = $this->tagService->createNewTag($_POST);

        ($result->errors) ? $_SESSION['CRUDMessage'] = "Error(" . $result->errors['SQLCode'] . ") - Tag " . $_POST['tag'] . " can not be created." : $_SESSION['CRUDMessage'] = "Tag " . $_POST['tag'] . " created.";

        redirectTo('/admin/tag');
    }

    /**
     * Render the admin panel to edit a tag (/admin/tags/edit.php) using the render method in the TemplateEngine class
     */

    public function editTagView(array $params)
    {
        $tag = $this->tagService->getTag($params['tag']);
        if (!$tag) redirectTo('/admin/tag');

        echo $this->view->render("admin/tags/edit.php", [
            // Template information
            'title' => 'Admin Panel',
            'sitemap' => '<a href="/admin">Admin</a> / <a href="/admin/tag">Tags</a> / <b>Edit Tag</b>',
            'header' => 'Tag name',
            'tag' => $tag
        ]);
    }

    /**
     * Update the entry with the given tagId in the DB Table tags
     */

    public function editTag(array $params)
    {
        $tag = $this->tagService->getTag($params['tag']);
        if (!$tag) redirectTo('/admin/tag');

        $this->validatorService->validateTag($_POST, 'es');

        $result = $this->tagService->updateTag($_POST, (int) $params['tag']);

        ($result->errors) ? $_SESSION['CRUDMessage'] = "Error(" . $result->errors['SQLCode'] . ") - Tag " . $tag->name . " can not be edited." : $_SESSION['CRUDMessage'] = "Tag " . $tag->name . " edited.";

        redirectTo("/admin/tag");
    }

    /**
     * Delete the entry with the given tagId in the DB Table tags
     */

    public function deleteTag(array $params)
    {
        $tag = $this->tagService->getTag($params['tag']);
        if (!$tag) redirectTo('/admin/tag');

        $result = $this->tagService->deleteTag((int) $params['tag']);
        ($result->errors) ? $_SESSION['CRUDMessage'] = "Error(" . $result->errors['SQLCode'] . ") - Tag " . $tag->name . " can not be deleted." : $_SESSION['CRUDMessage'] = "Tag " . $tag->name . " deleted.";

        redirectTo("/admin/tag");
    }
}
