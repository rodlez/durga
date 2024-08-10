<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use stdClass;

// Service for performing queries to the DataBase related to users, the AuthController will use this service to register and authenticate users

// Currently the Container can only inject instances in the Middleware and Controllers. 
// To inject instances in a Service, we need to resolve the dependency from the factory function in the Container class
class TagService
{
    public function __construct(private Database $db) {}

    /**
     *  Get TAgs
     * @param string $id - route parameter to edit the transaction
     * @return mixed - The results from the query for ALL the transactions of the user, limited by pagination
     */

    public function getTags(array $pagination)
    {
        $query = "SELECT * FROM blog_tags 
         WHERE {$pagination['searchCol']} LIKE :searchTerm
         ORDER BY {$pagination['sort']} {$pagination['direction']}  
         LIMIT {$pagination['perPage']} OFFSET {$pagination['offset']}";

        $params = ['searchTerm' => "%{$pagination['searchTerm']}%"];

        $tags = $this->db->query($query, $params)->findAll();

        // Another query to know the total number of results without the limit ans offset, we need this to calculate the next page link
        $queryTotalResults = "SELECT COUNT(*) FROM blog_tags 
         WHERE {$pagination['searchCol']} LIKE :searchTerm";

        $totalResults = $this->db->query($queryTotalResults, $params)->count();

        return [$tags, $totalResults];
    }

    /**
     * Create a new entry in the DB Table tags
     * @param array $userData form variables, tag name
     * @return 
     */

    public function createNewTag(array $userData): Database
    {
        $query = "INSERT INTO blog_tags(name) VALUES('{$userData['tag']}')";
        return $this->db->query($query);
    }

    /**
     * Given a tag id obtains all the info from the DB Table categories
     * @param mixed $tagId
     * @return mixed
     */

    public function getTag(mixed $tagId)
    {
        $tagId = (int) $tagId;
        $query = "SELECT * FROM blog_tags WHERE id = $tagId";
        return $this->db->query($query)->find();
    }

    /**
     * Edit a transaction based on the transaction id and the user_id, get the data from the form(description, amount and date) user_id from the $_SESSION['user'] 
     * @param array $formData - (description, amount and date) from the POST form in the edit.php file
     * @param int $id - come from the getUserTransaction method in the transactionService
     */

    public function updateTag(array $formData, int $tagId): Database
    {
        $query = "UPDATE blog_tags SET 
         name = :name, updated_at =:now
         WHERE id = :tagId";

        $params =
            [
                'name' => $formData['tag'],
                'now' => date('Y-m-d H:i:s'),
                'tagId' => $tagId
            ];

        return $this->db->query($query, $params);
    }

    /**
     *  Delete Tag
     * @param int $id - route parameter transaction id to delete the transaction
     * @return mixed - number of rows deleted
     */

    public function deleteTag(int $tagId): Database
    {
        // include the user_id to prevent users to delete transactions that NOT belong to them
        $query = "DELETE FROM blog_tags WHERE id = $tagId";
        return $this->db->query($query);
    }


    // Methods call in TransactionController

    /**
     *  @return array All the Tags from the Table tags order by name ASC
     */

    public function getAllTags()
    {
        $query = "SELECT id, name FROM blog_tags ORDER BY name ASC";
        return $this->db->query($query)->findAll();
    }

    /**
     *  Method in EntryService to get ID by his name
     * @return int - ID for the entry
     */

    public function getTagId(string $name)
    {
        $query = "SELECT id FROM blog_tags WHERE name = :name";
        $params = ['name' => $name];

        $result = $this->db->query($query, $params)->find();

        return $result->id;
    }

    /**
     * Get all the tag ids for a given transaction id
     * @param int $transactionId
     * @return mixed All the tag ids
     */
    /*
    public function getTagsInTransaction(mixed $transactionId)
    {
        $transactionId = (int) $transactionId;
        $query = "SELECT tag_id FROM transaction_tag WHERE transaction_id = $transactionId";
        return $this->db->query($query)->findAll();
    }
*/
    /**
     * Given an array with the tags ids return an array with the corresponding names and sorted alphabetically
     * @param mixed $tags list with the tags ids
     * @return array tag names sorted alphabetically
     */
    /*
    public function tagsOrderByName(mixed $tags)
    {
        $names = [];
        foreach ($tags as $tag) {
            $query = "SELECT name FROM tags WHERE id = $tag->tag_id";
            array_push($names, $this->db->query($query)->find()->name);
        }
        usort($names, 'strnatcasecmp');
        return $names;
    }
        */
}
