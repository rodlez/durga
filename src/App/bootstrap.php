<?php
// BOOTSTRAP -> A term to describe a piece of code responsible for loading another files and configuring the project
// to boot or to load a program into a computer using a much smaller initial program to load in the desired program.
// Here we create the instance of the App to NOT duplicate the instance in every file in the public folder(index, about...), here we do all the loading files
declare(strict_types=1);

// Load the Application file from the Framework directory manually
//include __DIR__ . "/../Framework/App.php";

/* using autoload, to autoload classes using composer, we do not need to include them manually
    composer.json -> include the namespaces to autoload
    "autoload": {
        "psr-4": {
            "Framework\\": "src/Framework",
            "App\\": "src/App"
        }
    }
    Then, generate the autoload using composer -> composer dump-autoload
    Creates the vendor/autoload files
*/
require __DIR__ . "../../../vendor/autoload.php";

// import the Framework App Class
use Framework\App;
use App\Config\Paths;

// ENVIRONMENT variables should be loaded as soon possible, before the Container is instantiated
use Dotenv\Dotenv;

// To import functions
use function App\Config\{registerRoutes, registerMiddleware};

// instance of the Environment variables, we need to provide the path, (path where is the .env)
$dotenv = Dotenv::createImmutable(PATHS::ROOT);
// now the environment variables are accessible to the entire app
$dotenv->load();

// instance of the App Class and return
// include the $containerDefinitionsPath
$app = new App(Paths::SOURCE . "App/container-definitions.php");

// REGISTER A CONTROLLER
// pass the class name including the namespace. 
// The controller will create the instance, not in bootstrap, because in the case we have multiple routes, we will need multiple
// instances created, consuming resources. It's better to call the class and the controller will create the instance if match the path.
// To run the method of the instance, we pass in an array with the class(App\Controllers\HomeController) and the method(home).


registerRoutes($app);
registerMiddleware($app);

/* Test normalize register methods
$app->get('about/team');
$app->get('/about/team');
$app->get('/about/team/');
*/

//showNice($app);

return $app;
