<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

use Framework\Exceptions\ValidationException;

use App\Config\Paths;

use Framework\ThumbnailImage;

class ImageService
{
    public function __construct(private Database $db) {}

    /**
     * Validate the uploaded file
     * @param array $file if there is a file will get the params from the $_FILES variable send in the upload form
     * @return mixed Validation Exception if there is some error
     */

    public function validateFile(?array $file)
    {
        // VALIDATE if the file is uploaded and id there is NO error
        // UPLOAD ERRORS -> https://www.php.net/manual/en/features.file-upload.errors.php
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            throw new ValidationException([
                'image' => ['Failed to upload file.']
            ]);
        }

        // VALIDATE the file size
        // file size will be stored in bytes, we need to convert to KB to do the comparison
        $maxFileSizeMB = 3;
        $maxFileSizeKB = $maxFileSizeMB * 1024;
        $uploadedFileSizeKB = ceil($file['size'] / 1024);

        if ($uploadedFileSizeKB > $maxFileSizeKB) {
            throw new ValidationException([
                'image' => ['Failed to upload the file is too large (' . $uploadedFileSizeKB . ' KB) MAX SIZE = ' . $maxFileSizeKB . ' KB)']
            ]);
        }

        // VALIDATE the name
        $originalFileName = $file['name'];

        // this regex permits characters, numbers, _ - and spaces
        if (!preg_match('/^[A-za-z0-9\s._-]+$/', $originalFileName)) {
            throw new ValidationException([
                'image' => ['Invalid file name. Only letters, numbers and the characters (_-)']
            ]);
        }

        // VALIDATE the MIME type, is more secure that validate the file extension, more easy to spoof to hide a malicious file
        $clientMimeType = $file['type'];
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'application/pdf'];

        if (!in_array($clientMimeType, $allowedMimeTypes)) {
            throw new ValidationException([
                'image' => ['Invalid file type. Only jpeg, png and pdf allowed.']
            ]);
        }
    }

    /**
     * 
     */

    public function upload(array $file, int $blogId)
    {
        $blogId = (int) $blogId;
        // 1 - get the extension and generate a new random filename to store the file
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $randomFilename = bin2hex(random_bytes(16));
        $newFilename = $randomFilename . "." . $fileExtension;

        // 2 - get the file type (PDF or IMG) Because the previous validation can only be pdf/jpg/png
        $uploadPath = Paths::STORAGE_BLOG_IMAGES . "/" . $newFilename;

        // 3 - Upload the file
        // move_uploaded_file -> move from the temporary directory to the recent uploadPath that we have created
        if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
            throw new ValidationException([
                'image' => ['Fail to upload file.']
            ]);
        }

        // 5 - STORE the Receipt in the database
        $query = "INSERT INTO blog_images (blog_id, original_filename, storage_filename, media_type, size) 
        VALUES(:blog_id, :original_filename, :storage_filename, :media_type, :size)";
        $params =
            [
                'blog_id' => $blogId,
                'original_filename' => $file['name'],
                'storage_filename' => $newFilename,
                'media_type' => $file['type'],
                'size' => $file['size']
            ];

        $result = $this->db->query($query, $params);

        if ($result->errors) {
            // Delete the file that we tried to upload and then Throw an exception
            unlink($uploadPath);

            throw new ValidationException([
                'image' => ['Error (' . $result->errors['SQLCode'] . ' ) uploading the file.']
            ]);
        }

        return $result;
    }



    /**
     * Given a transaction id return all his receipts
     * @param int $transactionId
     * @return mixed all the receipts
     */

    public function getAllImages(int $id)
    {
        $query = "SELECT * FROM blog_images WHERE blog_id = $id";
        return $this->db->query($query)->findAll();
    }









    public function uploadImages(array $file, int $transaction) {}


    /**
     * Given a receipt id return the receipt
     * @param string $receiptId Will be cast as int to make the DB query
     * @return mixed receipt
     */

    public function getReceipt(string $receiptId)
    {
        $receiptId = (int) $receiptId;
        $query = "SELECT * FROM receipts WHERE id = $receiptId";
        return $this->db->query($query)->find();
    }


    /**
     *  Get the array of receipts
     * @param array $listTransactionIds
     * @return array all the receipts for each transactionId on the array listTransactionIds
     */
    public function getAllTransactionsReceipts(array $listTransactionIds)
    {
        $receipts = [];
        foreach ($listTransactionIds as $transactionId) {
            $receipts[] = $this->getAllReceipts($transactionId);
        }
        // delete the empty values
        return array_filter($receipts);
    }

    /**
     * Show the file
     * @param mixed $receipt to be show or downloaded
     * @param string $contentDisposition inline (default) to show the file in the browser, attachment to generate a download file
     */

    //TODO: if the file has been deleted on the server, SHOW error to upload again.

    public function read(mixed $receipt, string $contentDisposition = 'inline')
    {
        // We find the file concatenating the path and the storage filename (was randomly generated). Check filePath to pdf or img file
        ($receipt->media_type === 'application/pdf') ? $filePath = Paths::STORAGE_UPLOADS . '/' . $receipt->storage_filename : $filePath = Paths::STORAGE_IMG . '/' . $receipt->storage_filename;

        if (!file_exists($filePath)) {
            $_SESSION['CRUDMessage'] = "Error downloading the file.";
            redirectTo('/');
        }

        // To download we will change the name of the storage filename to his original
        // by default the browser send HTML files, we need to change the header to tell the browser that we will send a file
        header("Content-Disposition: {$contentDisposition};filename={$receipt->original_filename}");
        header("Content-Type: {$receipt->media_type}");

        readfile($filePath);
    }

    /**
     * Delete the Receipt file (PDF or Image) store in the server given a receipt AND delete also from the DB. 
     * @return - true if OK false if error.
     */

    public function delete(mixed $receipt)
    {
        // 1 - We find the file concatenating the path and the storage filename (was randomly generated). Check filePath to pdf or img file
        if ($receipt->media_type === 'application/pdf') {
            $filePath = Paths::STORAGE_UPLOADS . '/' . $receipt->storage_filename;
            $thumbnailPath = null;
        } else {
            $filePath = Paths::STORAGE_IMG . '/' . $receipt->storage_filename;
            $thumbnailPath = Paths::STORAGE_IMG . '/' . $receipt->thumbnail_filename;
        }

        // 2 - Delete the files 
        unlink($filePath);
        // if is an IMG also delete the Thumbnail
        if (isset($thumbnailPath)) unlink($thumbnailPath);

        // 3 - Delete from the DB
        $query = "DELETE FROM receipts WHERE id = :id";
        $params = ['id' => $receipt->id];
        // if the delete is successful would return 1(number of rows affected) otherwise return 0.
        $result = $this->db->query($query, $params)->rowCount();

        return $result;
    }

    /**
     * Delete the Receipt file (PDF or Image) store in the server given a receipt object. 
     * @return - true if OK false if error.
     */

    public function deleteReceiptFile(mixed $receipt): bool
    {
        // 1 - We find the file concatenating the path and the storage filename (was randomly generated). Check filePath to pdf or img file
        if ($receipt->media_type === 'application/pdf') {
            $filePath = Paths::STORAGE_UPLOADS . '/' . $receipt->storage_filename;
            $thumbnailPath = null;
        } else {
            $filePath = Paths::STORAGE_IMG . '/' . $receipt->storage_filename;
            $thumbnailPath = Paths::STORAGE_IMG . '/' . $receipt->thumbnail_filename;
        }

        // 2 - Delete the files 
        $result = unlink($filePath);
        // if is an IMG also delete the Thumbnail
        if (isset($thumbnailPath)) $result = unlink($thumbnailPath);

        // If one or both unlink() are successful return true if some failed return false
        return $result;
    }

    // ****************** Statistics *************************

    /**
     * Given a user id return the number of receipts
     * @param int $userId
     * @return int total number of receipts
     */

    public function getUserTotalReceipts(int $userId): int
    {
        $query = "SELECT DISTINCT(receipts.id) FROM receipts 
         JOIN transactions ON transactions.user_id = $userId";

        return $this->db->query($query)->rowCount();
    }

    /**
     * Given a user id return the number of receipts
     * @param int $userId
     * @return mixed total number of receipts
     */

    public function getUserTotalReceiptsSize(int $userId)
    {
        $query = "SELECT SUM(DISTINCT(receipts.size)) as size FROM receipts 
        JOIN transactions ON transactions.user_id = $userId";

        return $this->db->query($query)->find();
    }
}
