<?php
// Script to connect to the Database using the Database class and create the tables

require __DIR__ . "/vendor/autoload.php";
//include __DIR__ . '/src/Framework/Database.php';

use Framework\Database;
use App\Config\Paths;

// ENVIRONMENT variables should be loaded as soon possible, before the Container is instantiated
use Dotenv\Dotenv;

// instance of the Environment variables, we need to provide the path, (the root path in this case, that we defined in the Paths class in the Config folder)
$dotenv = Dotenv::createImmutable(PATHS::ROOT);
// now the environment variables are accessible to the entire app
$dotenv->load();


$db = new Database(
    $_ENV['DB_DRIVER'],
    [
        'host' =>  $_ENV['DB_HOST'],
        'port' =>  $_ENV['DB_PORT'],
        'dbname' =>  $_ENV['DB_NAME']
    ],
    $_ENV['DB_USER'],
    $_ENV['DB_PASS']
);

echo "Connected to the Database --> " .  $_ENV['DB_NAME'];

// create table, convert in string the SQL file
$sqlFile = file_get_contents("./database.sql");

$result = $db->query($sqlFile);

//echo "Result of the query --> ";
//var_dump($result);
