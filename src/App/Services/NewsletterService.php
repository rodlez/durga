<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

use Framework\Exceptions\ValidationException;

// Service for performing queries to the DataBase related to users, the AuthController will use this service to register and authenticate users

// Currently the Container can only inject instances in the Middleware and Controllers. 
// To inject instances in a Service, we need to resolve the dependency from the factory function in the Container class
class NewsletterService
{
    public function __construct(private Database $db) {}

    public function getNewsletter(array $pagination)
    {
        $query = "SELECT * FROM newsletter 
         WHERE {$pagination['searchCol']} LIKE :searchTerm
         ORDER BY {$pagination['sort']} {$pagination['direction']}  
         LIMIT {$pagination['perPage']} OFFSET {$pagination['offset']}";

        $params = ['searchTerm' => "%{$pagination['searchTerm']}%"];

        $newsletterList = $this->db->query($query, $params)->findAll();

        // Another query to know the total number of results without the limit ans offset, we need this to calculate the next page link
        $queryTotalResults = "SELECT COUNT(*) FROM newsletter 
         WHERE {$pagination['searchCol']} LIKE :searchTerm";

        $totalResults = $this->db->query($queryTotalResults, $params)->count();

        return [$newsletterList, $totalResults];
    }

    /**
     * Create a new entry in the DB Table newsletter
     * @param array $userData form variables, email
     * @return Database
     */

    public function insertNewEmail(array $userData): Database
    {
        $query = "INSERT INTO newsletter(email) VALUES('{$userData['email']}')";
        return $this->db->query($query);
    }

    /**
     * Given an id obtains all the info from the DB Table newsletter
     * @param mixed $entryId
     * @return mixed
     */

    public function getEmail(mixed $entryId)
    {
        $entryId = (int) $entryId;
        $query = "SELECT * FROM newsletter WHERE id = $entryId";
        return $this->db->query($query)->find();
    }

    /**
     * Edit a transaction based on the transaction id and the user_id, get the data from the form(description, amount and date) user_id from the $_SESSION['user'] 
     * @param array $formData - (description, amount and date) from the POST form in the edit.php file
     * @param int $id - come from the getUserTransaction method in the transactionService
     */

    public function updateEmail(array $formData, int $newsletterId): Database
    {
        $query = "UPDATE newsletter SET 
          email = :email, updated_at =:now
          WHERE id = :newsletterId";

        $params =
            [
                'email' => $formData['email'],
                'now' => date('Y-m-d H:i:s'),
                'newsletterId' => $newsletterId
            ];

        return $this->db->query($query, $params);
    }
}
