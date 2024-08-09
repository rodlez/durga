<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

use Framework\Exceptions\ValidationException;

// Service for performing queries to the DataBase related to users, the AuthController will use this service to register and authenticate users

// Currently the Container can only inject instances in the Middleware and Controllers. 
// To inject instances in a Service, we need to resolve the dependency from the factory function in the Container class
class ContactService
{
    public function __construct(private Database $db) {}


    /**
     * Insert a new entry in the DB contact Table 
     * @param array $formData variables send in the contact form
     */

    public function newContact(array $formData)
    {

        $query = "INSERT INTO contact(name, email, phone, subject, message) VALUES(:name, :email, :phone, :subject, :message)";
        $params =
            [
                'name' => $formData['name'],
                'email' => $formData['email'],
                'phone' => $formData['phone'],
                'subject' => $formData['subject'],
                'message' => $formData['message']
            ];

        $this->db->query($query, $params);
    }


    /* *************************************************** ADMIN ************************************************************* */








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
     * Update an Email in the Newsletter Database Table based in the ID and the new Email entry in the edit form
     * @param array $formData - (email) from the POST form in the edit.php file
     * @param int $id - Route parameter
     */

    public function updateEmail(array $formData, int $id): Database
    {
        $query = "UPDATE newsletter SET 
          email = :email, updated_at =:now
          WHERE id = :id";

        $params =
            [
                'email' => $formData['email'],
                'now' => date('Y-m-d H:i:s'),
                'id' => $id
            ];

        return $this->db->query($query, $params);
    }

    /**
     *  Delete an entry in the newsletter Database Table given an ID     
     * @param int $id - Route parameter
     * @return mixed - number of rows deleted
     */

    public function deleteEmail(int $id)
    {
        $query = "DELETE FROM newsletter WHERE id = $id";
        return $this->db->query($query);
    }
}
