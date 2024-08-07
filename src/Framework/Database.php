<?php

declare(strict_types=1);

namespace Framework;

use PDO, PDOException, PDOStatement;

class Database
{

    private PDO $connection;
    private PDOStatement $stmt;

    public function __construct(string $driver, array $config, string $username, string $password)
    {
        // use an array instead strings to reduce typos, use the function http_build_query to establish the data and define the correct argument separator
        $config = http_build_query(data: $config, arg_separator: ';');

        // Data Source Name - Standard format to connect to a DB. driver:key=value;key=value...
        $dsn = "{$driver}:{$config}";

        // Instance of the PDO class to connect, wrap in a try catch block to show a custom error using the PDOException and not leaking sensitive information.
        // [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ] -> define the result of the query as default an object
        // [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC] -> define the result of the query as default an associative array

        try {
            $this->connection = new PDO($dsn, $username, $password, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);
        } catch (PDOException $e) {
            //if the attempt to connect to the requested database fails.
            die('ERROR: Unable to connect to database.');
        }
    }

    /**  
     * Method that performs queries that supports prepared statements and parameters using the PDOStatement class
     * @param string $query
     * @param array $params (optional)
     * return an instance of the Database class
     */
    public function query(string $query, array $params = []): Database
    {
        // To USE transactions we can NOT catch here the PDOexception

        try {
            $this->stmt = $this->connection->prepare(($query));

            $this->stmt->execute($params);

            return $this;
        } catch (PDOException $e) {
            //if the attempt to query fails. Create a errors entry in the DB object
            $errorPDOQuery = [
                'title' => 'ERROR query method Database class',
                'method' => __FUNCTION__,
                'SQLCode' => $e->getCode(),
                'Message' => $e->getMessage(),
                'File' => $e->getFile(),
                'Line' => $e->getLine()
            ];
            // SHOW THE ERROR IN THE DATABASE QUERY AND STOP THE PROGRAM
            //debugator($errorPDOQuery, true, 4);

            $this->errors = $errorPDOQuery;
            return $this;
        }
    }

    /**
     * Alias for fetchColumn to use in combination with SQL COUNT() to know the total number of results for a query
     */

    public function count()
    {
        return $this->stmt->fetchColumn();
    }

    /**
     * Find one single result
     */

    public function find()
    {
        return $this->stmt->fetch();
    }

    /**
     * Method to get the last inserted id
     */
    public function lastId()
    {
        return $this->connection->lastInsertId();
    }
}
