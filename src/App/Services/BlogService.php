<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

use Framework\Exceptions\ValidationException;

// Service for performing queries to the DataBase related to users, the AuthController will use this service to register and authenticate users

// Currently the Container can only inject instances in the Middleware and Controllers. 
// To inject instances in a Service, we need to resolve the dependency from the factory function in the Container class
class BlogService
{
    public function __construct(private Database $db) {}

    /**
     * Get all the blog entries to show in the web 
     * 
     * @parma $lang - language by his ISO code
     */

    public function getBlogEntriesWeb(string $lang)
    {
        $query = "SELECT blog.id as blogId, blog.published as published, blog_translate.title as title, blog_translate.content as content, blog_images.storage_filename as image
        FROM blog
        JOIN blog_translate ON blog_translate.blog_id = blog.id
        JOIN blog_images ON blog_images.blog_id = blog.id
        WHERE blog_translate.lang = '$lang'";

        return $this->db->query($query)->findAll();
    }


    public function getBlogEntries(array $pagination)
    {
        $query = "SELECT * FROM blog 
         WHERE {$pagination['searchCol']} LIKE :searchTerm
         ORDER BY {$pagination['sort']} {$pagination['direction']}  
         LIMIT {$pagination['perPage']} OFFSET {$pagination['offset']}";

        $params = ['searchTerm' => "%{$pagination['searchTerm']}%"];

        $list = $this->db->query($query, $params)->findAll();

        // Another query to know the total number of results without the limit ans offset, we need this to calculate the next page link
        $queryTotalResults = "SELECT COUNT(*) FROM blog 
         WHERE {$pagination['searchCol']} LIKE :searchTerm";

        $totalResults = $this->db->query($queryTotalResults, $params)->count();

        return [$list, $totalResults];
    }

    /**
     *  Given a Transaction id and the user id return all the transactions. transactionId and userId will be cast to int to perform the query
     * @param mixed $transactionId mixed because if it comes from the params will be a string
     * @param mixed $userId mixed because if it comes from the params will be a string
     * @return mixed object or array depending on the PDO::ATTR_DEFAULT_FETCH_MODE => (PDO::FETCH_ASSOC, PDO::FETCH_OBJ)
     */

    public function getAllBlogEntries()
    {
        $query = "SELECT *, DATE_FORMAT(created_at, '%Y-%m-%d') as formatted_date FROM blog";

        return $this->db->query($query)->findAll();
    }

    /**
     *  Given a Transaction id and the user id return all the transactions. transactionId and userId will be cast to int to perform the query
     * @param mixed $transactionId mixed because if it comes from the params will be a string
     * @param mixed $userId mixed because if it comes from the params will be a string
     * @return mixed object or array depending on the PDO::ATTR_DEFAULT_FETCH_MODE => (PDO::FETCH_ASSOC, PDO::FETCH_OBJ)
     */

    public function getBlogEntrybyId(mixed $id)
    {
        $query = "SELECT *, DATE_FORMAT(created_at, '%Y-%m-%d') as formatted_date 
           FROM blog 
           WHERE id = :id";
        $params =
            [
                'id' => (int) $id,
            ];

        return $this->db->query($query, $params)->find();
    }


    /**
     *  Given a Transaction id and the user id return all the transactions. transactionId and userId will be cast to int to perform the query
     * @param mixed $transactionId mixed because if it comes from the params will be a string
     * @param mixed $userId mixed because if it comes from the params will be a string
     * @return mixed object or array depending on the PDO::ATTR_DEFAULT_FETCH_MODE => (PDO::FETCH_ASSOC, PDO::FETCH_OBJ)
     */

    public function getBlogEntry(mixed $id, mixed $userId)
    {
        $query = "SELECT *, DATE_FORMAT(created_at, '%Y-%m-%d') as formatted_date 
          FROM blog 
          WHERE id = :id AND user_id = :userId";
        $params =
            [
                'id' => (int) $id,
                'userId' => (int) $userId
            ];

        return $this->db->query($query, $params)->find();
    }

    /**
     *  Given a Transaction id and the user id return all the transactions. transactionId and userId will be cast to int to perform the query
     * @param mixed $transactionId mixed because if it comes from the params will be a string
     * @param mixed $userId mixed because if it comes from the params will be a string
     * @return mixed object or array depending on the PDO::ATTR_DEFAULT_FETCH_MODE => (PDO::FETCH_ASSOC, PDO::FETCH_OBJ)
     */

    public function getAllBlogEntryTranslations(mixed $blogId)
    {
        $query = "SELECT *, DATE_FORMAT(created_at, '%Y-%m-%d') as formatted_date 
           FROM blog_translate 
           WHERE blog_id = :blogId";
        $params =
            [
                'blogId' => (int) $blogId
            ];

        return $this->db->query($query, $params)->findAll();
    }

    public function getBlogEntryTranslationWeb(mixed $blogId, string $lang)
    {
        $query = "SELECT *, DATE_FORMAT(created_at, '%Y-%m-%d') as formatted_date 
           FROM blog_translate 
           WHERE blog_id = :blogId AND lang = :lang";
        $params =
            [
                'blogId' => (int) $blogId,
                'lang' => $lang
            ];

        return $this->db->query($query, $params)->find();
    }

    /**
     *  Given a Transaction id and the user id return all the transactions. transactionId and userId will be cast to int to perform the query
     * @param mixed $transactionId mixed because if it comes from the params will be a string
     * @param mixed $userId mixed because if it comes from the params will be a string
     * @return mixed object or array depending on the PDO::ATTR_DEFAULT_FETCH_MODE => (PDO::FETCH_ASSOC, PDO::FETCH_OBJ)
     */

    public function getBlogEntryTranslation(mixed $transId)
    {
        $query = "SELECT *, DATE_FORMAT(created_at, '%Y-%m-%d') as formatted_date 
            FROM blog_translate 
            WHERE id = :transId";
        $params =
            [
                'transId' => (int) $transId
            ];

        return $this->db->query($query, $params)->find();
    }

    /**
     * Get all the tag ids for a given blog id
     * @param int $transactionId
     * @return mixed All the tag ids
     */

    public function getTagsInBlog(mixed $id)
    {
        $id = (int) $id;
        $query = "SELECT tag_id FROM blog_tag_rel WHERE blog_id = $id";
        return $this->db->query($query)->findAll();
    }

    /**
     * Given an array with the tags ids return an array with the corresponding names and sorted alphabetically
     * @param mixed $tags list with the tags ids
     * @return array tag names sorted alphabetically
     */

    public function tagsOrderByName(mixed $tags)
    {
        $names = [];
        foreach ($tags as $tag) {
            $query = "SELECT name FROM blog_tags WHERE id = $tag->tag_id";
            array_push($names, $this->db->query($query)->find()->name);
        }
        usort($names, 'strnatcasecmp');
        return $names;
    }


    /**
     * Given an id get all the information
     * @param mixed $id mixed in case the parameter is a string, No need to cast in a query string
     * @return mixed info found in the DB
     */

    public function getContactInfo(mixed $id)
    {
        $query = "SELECT *, DATE_FORMAT(created_at, '%Y-%m-%d') as formatted_date
         FROM contact where id = $id";
        return $this->db->query($query)->find();
    }


    //****************************************************************************************************************************************** */


    public function newBlogEntry(int $userId, array $formData): Database
    {
        $query = "INSERT INTO blog (author, title, user_id) VALUES(:author, :title, :userId)";
        $params =
            [
                'author' => escapeChar($formData['author']),
                'title' => escapeChar($formData['title']),
                'userId' => $userId
            ];

        return $this->db->query($query, $params);
    }

    /**
     * Update an Email in the Newsletter Database Table based in the ID and the new Email entry in the edit form
     * @param array $formData - form in the contact Admin edit menu
     * @param int $id - Route parameter
     */

    public function publishBlogEntry(int $id, mixed $published): Database
    {

        $query = "UPDATE blog SET 
             published = :published, updated_at =:now
             WHERE id = :id";

        $params =
            [
                'published' => $published,
                'now' => date('Y-m-d H:i:s'),
                'id' => $id
            ];

        return $this->db->query($query, $params);
    }

    public function updateBlogEntry(int $blogId, int $userId, array $formData)
    {
        // to avoid the time(HH:MM:SS) DATETIME type to be created by the DB, we stablish it to the midnight because in this case only care for the date(YYY-MM-DD)
        $formattedDate = "{$formData['date']} 00:00:00";

        $query = "UPDATE blog SET published = :published, author = :author, title = :title, created_at = :date, updated_at = :now
        WHERE id = :blogId AND user_id = :userId";
        $params =
            [
                'published' => $formData['published'],
                'author' => $formData['author'],
                'title' => $formData['title'],
                'userId' => $userId,
                'blogId' => $blogId,
                'date' => $formattedDate,
                'now' => date('Y-m-d H:i:s')
            ];
        return $this->db->query($query, $params);
    }

    /**
     * With the constraints ON DELETE CASCADE for the FK transaction_id and tag_id, if we delete them
     * the transaction_tag Table and the receipt Table will be automatically updated
     * include the user_id to prevent users to delete transactions that NOT belong to them
     * @param int $userId
     * @param int $transactionId
     * @return int - if the delete is successful would return 1 (number of rows affected) otherwise return 0.
     */

    public function deleteBlogEntry(int $userId, int $blogId): int
    {
        $query = "DELETE FROM blog WHERE id = $blogId AND user_id = $userId";
        return $this->db->query($query)->rowCount();
    }


    /**
     * Insert a new entry in the transactions Table and the corresponding pair (transaction_id, tag_id) in the relational Table transaction_tag
     * @param array $formData variables send in the form
     * @param int $categoryId id of the category selected in the form
     * @param array $tagsIds ids of the tags selected in the form
     * @return array result->status [0,1] and result->error in case of error
     */

    public function newBlogTransEntry(int $blogId, array $formData, int $categoryId, array $tagsId)
    {

        try {
            // Start the Transaction
            $result = $this->db->beginTransaction();

            // 1 - INSERT BLOG
            $query = "INSERT INTO blog_translate (title, subtitle, content, lang, blog_id, blog_category_id) VALUES(:title, :subtitle, :content, :lang, :blogId, :categoryId)";
            $params =
                [
                    'title' => $formData['title'],
                    'subtitle' => $formData['subtitle'],
                    'content' => $formData['content'],
                    'lang' => $formData['lang'],
                    'blogId' => $blogId,
                    'categoryId' => $categoryId
                ];

            $this->db->queryForTransactions($query, $params);

            // 2 - GEt the ID for the transaction
            $lastId = $this->db->lastId();

            // 3 - foreach tag_id insert in the TRANSACTIONS_TAG the transaction_id and the tags_id for each par
            foreach ($tagsId as $tag) {
                $query = "INSERT INTO blog_tag_rel (blog_id, tag_id) VALUES(:blog_id, :tag_id)";
                $params =
                    [
                        'blog_id' => (int) $lastId,
                        'tag_id' => (int) $tag
                    ];
                $this->db->queryForTransactions($query, $params);
            }

            // End the Transaction
            $this->db->commit();

            $result = ['status' => 1];

            return $result;
        } catch (PDOException $e) {
            // If the Transaction fails, we need to revert the changes manually. rollback will revert the changes made by the queries in the transaction.
            // But if a Transaction is NOT active, this method produces an error. Best use in a condition to check if the transaction is active.
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            $result = [
                'status' => 0,
                'error' => $e->getCode()
            ];

            return $result;
        }
    }

    /**
     *  Update a Transaction 
     * @param array $formData    
     * @param int $transactionId 
     * @param int $categoryId 
     * @param int $periodId 
     * @param array $tags_id    
     * @param int $userId $_SESSION['user'] for public, and the userId in admmin panel
     * @return mixed object or array depending on the PDO::ATTR_DEFAULT_FETCH_MODE => (PDO::FETCH_ASSOC, PDO::FETCH_OBJ)
     */

    public function updateBlogTranslation(int $blogId, int $blogTransId, array $formData, int $categoryId, array $tagsId)
    {
        // to avoid the time(HH:MM:SS) DATETIME type to be created by the DB, we stablish it to the midnight because in this case only care for the date(YYY-MM-DD)
        //$formattedDate = "{$formData['date']} 00:00:00";

        try {
            // Start the Transaction
            $result = $this->db->beginTransaction();

            // 1 - UPDATE TRANSLATION
            $query = "UPDATE blog_translate SET 
               title = :title, subtitle = :subtitle, content = :content, lang = :lang, updated_at = :now, blog_category_id = :categoryId, blog_id = :blogId
               WHERE id = :blogTransId";
            $params =
                [
                    'title' => escapeChar($formData['title']),
                    'subtitle' =>  escapeChar($formData['subtitle']),
                    'content' =>  escapeChar($formData['content']),
                    'lang' =>  escapeChar($formData['lang']),
                    'blogId' => $blogId,
                    'blogTransId' => $blogTransId,
                    'categoryId' => $categoryId,
                    'now' => date('Y-m-d H:i:s')
                ];
            $this->db->queryForTransactions($query, $params);

            // 2 - DELETE the previous values in the blog_tag_rel table for the current blog entry
            $query = "DELETE FROM blog_tag_rel WHERE blog_id = :blogTransId";
            $params = ['blogTransId' => $blogTransId];

            $this->db->queryForTransactions($query, $params);

            // 3 - foreach tag_id insert in the TRANSACTIONS_TAG the transaction_id and the tags_id for each par
            foreach ($tagsId as $tag) {
                $query = "INSERT INTO blog_tag_rel (blog_id, tag_id) VALUES(:blogTransId, :tagId)";
                $params =
                    [
                        'blogTransId' => $blogTransId,
                        'tagId' => (int) $tag
                    ];
                $this->db->queryForTransactions($query, $params);
            }

            // End the Transaction
            $this->db->commit();

            $result = [
                'status' => 1
            ];

            return $result;
        } catch (PDOException $e) {
            // If the Transaction fails, we need to revert the changes manually. rollback will revert the changes made by the queries in the transaction.
            // But if a Transaction is NOT active, this method produces an error. Best use in a condition to check if the transaction is active.
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            $result = [
                'status' => 0,
                'error' => $e->getCode()
            ];

            return $result;
        }
    }

    /**
     * With the constraints ON DELETE CASCADE for the FK transaction_id and tag_id, if we delete them
     * the transaction_tag Table and the receipt Table will be automatically updated
     * include the user_id to prevent users to delete transactions that NOT belong to them
     * @param int $userId
     * @param int $transactionId
     * @return int - if the delete is successful would return 1 (number of rows affected) otherwise return 0.
     */

    public function deleteBlogTranslation(int $blogTransId): int
    {
        $query = "DELETE FROM blog_translate WHERE id = $blogTransId";
        return $this->db->query($query)->rowCount();
    }





    /********************* TRANSLATIONS ***************************************/

    public function newBlogEntryTranslation(int $blogId, array $formData): Database
    {
        // 1 - INSERT BLOG
        $query = "INSERT INTO blog_trans (title, subtitle, content, lang, blog_id) VALUES(:title, :subtitle, :content, :lang, :blogId)";
        $params =
            [
                'title' => escapeChar($formData['title']),
                'subtitle' => $formData['subtitle'],
                'content' => $formData['content'],
                'lang' => $formData['lang'],
                'blogId' => $blogId
            ];

        return $this->db->query($query, $params);
    }
}
