<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{BlogService, ImageService};

class ImageController
{
    public function __construct(
        private TemplateEngine $view,
        private BlogService $blogService,
        private ImageService $imageService
    ) {}

    /**
     * Render the upload form for the receipt (receipts/create.php) using the render method in the TemplateEngine class
     */

    public function uploadView(array $params)
    {
        $blog = $this->blogService->getBlogEntry($params['id'], $_SESSION['user']);
        if (!$blog) redirectTo("/admin/blog");

        echo $this->view->render("/admin/blog/images/upload.php", [
            'title' => 'Upload Image',
            'sitemap' => '<a href="/">Home</a> / <b>Upload Image to Blog Entry</b>',
            'header' => "Upload a new image for the blog entry<br /> Id: <b>$blog->id</b><br /> Title: <b>$blog->title</b>"
        ]);
    }

    /**
     * Upload the file to the storage directory and the related info is inserted in a new entry in the DB receipt Table
     * @param array $params transaction id from the parameter value in the router url
     */

    public function upload(array $params)
    {
        $blog = $this->blogService->getBlogEntry($params['id'], $_SESSION['user']);
        if (!$blog) redirectTo("/admin/blog");

        //showNice($_FILES, 'FILES');
        // store the file if uploaded, if not will be empty
        $imageFile = $_FILES['image'] ?? null;

        $this->imageService->validateFile($imageFile);

        $result = $this->imageService->upload($imageFile, $blog->id);

        if ($result) $_SESSION['CRUDMessage'] = "Image for blog <b>({$blog->title})</b> uploaded.";

        redirectTo("/admin/blog");
    }

    /**
     * Download the receipt file and show in the browser
     * @param array $params We get the transaction id and receipt id to download the receipt file
     * @return file Outputs a file returned by the PHP readfile() function
     */
    /*
    public function download(array $params)
    {
        $transaction = $this->blogService->getTransaction($params['transaction'], $_SESSION['user']);
        if (!$transaction) redirectTo("/");

        $receipt = $this->imageService->getReceipt($params['receipt']);
        if (!$receipt) redirectTo("/");

        // Prevent user to access a receipt from a different transaction the id from transactions and receipt MUST match
        if ($receipt->transaction_id !== $transaction->id) redirectTo("/");

        $this->imageService->read($receipt);
    }
*/
    /**
     * Delete the receipt file and the entry in the DB receipt Table
     * @param array $params We get the transaction id and receipt id to delete 
     */
    /*
    public function delete(array $params)
    {

        $transaction = $this->blogService->getTransaction($params['transaction'], $_SESSION['user']);
        if (!$transaction) redirectTo("/");

        $receipt = $this->imageService->getReceipt($params['receipt']);
        if (!$receipt) redirectTo("/");

        // Prevent user to access a receipt from a different transaction the id from transactions and receipt MUST match
        if ($receipt->transaction_id !== $transaction->id) redirectTo("/");

        $result = $this->imageService->delete($receipt);

        ($result !== 1) ? $_SESSION['CRUDMessage'] = "Error - Receipt Can NOT be deleted." : $_SESSION['CRUDMessage'] = "Receipt deleted.";

        redirectTo('/');
    }
        */
}
