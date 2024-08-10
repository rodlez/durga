<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

use Framework\Exceptions\ValidationException;

// Service for performing queries to the DataBase related to users, the AuthController will use this service to register and authenticate users

// Currently the Container can only inject instances in the Middleware and Controllers. 
// To inject instances in a Service, we need to resolve the dependency from the factory function in the Container class
class CategoryService
{
    public function __construct(private Database $db) {}

    public function getCategories(array $pagination)
    {
        $query = "SELECT * FROM blog_categories 
         WHERE {$pagination['searchCol']} LIKE :searchTerm
         ORDER BY {$pagination['sort']} {$pagination['direction']}  
         LIMIT {$pagination['perPage']} OFFSET {$pagination['offset']}";

        $params = ['searchTerm' => "%{$pagination['searchTerm']}%"];

        $categories = $this->db->query($query, $params)->findAll();

        // Another query to know the total number of results without the limit ans offset, we need this to calculate the next page link
        $queryTotalResults = "SELECT COUNT(*) FROM blog_categories 
         WHERE {$pagination['searchCol']} LIKE :searchTerm";

        $totalResults = $this->db->query($queryTotalResults, $params)->count();

        return [$categories, $totalResults];
    }

    /**
     * Create a new entry in the DB Table categories
     * @param array $userData form variables, category name
     * @return 
     */

    public function createNewCategory(array $userData): Database
    {
        $query = "INSERT INTO blog_categories(name) VALUES('{$userData['category']}')";
        return $this->db->query($query);
    }

    /**
     *  @return array All the Categories from the Table categories order by name ASC
     */

    public function getAllCategories()
    {
        $query = "SELECT id, name FROM blog_categories ORDER BY name ASC";
        return $this->db->query($query)->findAll();
    }

    /**
     * Given a category name return his id
     * @param string $name 
     * @return int id
     */

    public function getCategoryId(string $name): int
    {
        $query = "SELECT id FROM blog_categories WHERE name = '$name'";
        $result = $this->db->query($query)->find();
        return $result->id;
    }

    /**
     * Given a category id return his name
     * @param int $id 
     * @return string name
     */

    public function getCategoryName(int $id): string
    {
        $query = "SELECT name FROM blog_categories WHERE id = $id";
        $result = $this->db->query($query)->find();
        return $result->name;
    }

    /**
     * Given a category id obtains all the info from the DB Table categories
     * @param mixed $categoryId
     * @return mixed
     */

    public function getCategory(mixed $categoryId)
    {
        $categoryId = (int) $categoryId;
        $query = "SELECT * FROM blog_categories WHERE id = $categoryId";
        return $this->db->query($query)->find();
    }

    /**
     * Edit a transaction based on the transaction id and the user_id, get the data from the form(description, amount and date) user_id from the $_SESSION['user'] 
     * @param array $formData - (description, amount and date) from the POST form in the edit.php file
     * @param int $id - come from the getUserTransaction method in the transactionService
     */

    public function updateCategory(array $formData, int $categoryId): Database
    {
        $query = "UPDATE blog_categories SET 
         name = :name, updated_at =:now
         WHERE id = :categoryId";

        $params =
            [
                'name' => $formData['category'],
                'now' => date('Y-m-d H:i:s'),
                'categoryId' => $categoryId
            ];

        return $this->db->query($query, $params);
    }

    /**
     *  Method in TransactionService to delete one transactions based on his Route Parameter id.     
     * @param int $id - route parameter transaction id to delete the transaction
     * @return mixed - number of rows deleted
     */

    public function deleteCategory(int $categoryId)
    {
        $query = "DELETE FROM blog_categories WHERE id = $categoryId";
        return $this->db->query($query);
    }
}
