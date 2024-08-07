<?php

declare(strict_types=1);

use Framework\{TemplateEngine, Database, Container};
use App\Config\Paths;

use App\Services\{ValidatorService, UserService};

// adding TemplateEngine class to the definitions

// return the associative array with the key (name of the class) and the value (the function to generate the class)
// fn() => new TemplateEngine(Paths::VIEW) -> Factory function to create an instance of the TemplateEngine class
// using an arrow function, the at the right of the arrow => (new TemplateEngine(Paths::VIEW) is the return value of the function, no need to type return
// the key acts as an ID for the different dependencies.


return [
    TemplateEngine::class => fn () => new TemplateEngine(Paths::VIEW),
    ValidatorService::class => fn () => new ValidatorService(),
    Database::class => fn () => new Database(
        $_ENV['DB_DRIVER'],
        [
            'host' =>  $_ENV['DB_HOST'],
            'port' =>  $_ENV['DB_PORT'],
            'dbname' =>  $_ENV['DB_NAME']
        ],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS']
    ),
    // Inject an instance of the Database class in the UserService
    UserService::class => function (Container $container) {
        // using the Container get method now we can grab the Database instance
        $db = $container->get(Database::class);

        return new UserService($db);
    }
];
