<?php

declare(strict_types=1);

/*
    Namespaces - An optional feature for organize classes. As a way to organize the code into virtual folders
    Folders keep our files organized, plus we can use the same namefile in different folders.
    If we have all the files in the same folder, we could NOT use the same namefile.
    ALL these concepts can be applied to classes using namespaces.
*/

// Pascal case for namespaces.
// Create the virtual folder Framework
namespace Framework;

class App
{
    // private -> we do NOT want the router be updated for external sources
    // Name convention -> property with the same name as the class
    private Router $router;
    // add a Container to use Dependency Injection
    private Container $container;


    /* when the App is instantiated, we have now access to the classes Router and Container
    We set the definitions on the construct method of the App class and not in the Container class, because if we want to add new definitions
    later, the construct method in the Container class in only invoke once, adding the $containerDefinitionsPath
    */

    public function __construct(string $containerDefinitionsPath = null)
    {
        $this->router = new Router();
        $this->container = new Container();

        if ($containerDefinitionsPath) {
            $containerDefinitions = include $containerDefinitionsPath;
            $this->container->addDefinitions($containerDefinitions);
        }
    }

    public function run()
    {
        // Extract the path and method using the $_SERVER array that contains info about the server.
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $this->router->dispatch($path, $method, $this->container);
    }

    /**
     * Public Method to register a route using the add method in the Router class
     * @param string $path route path
     * @param array $controller array with the Controller class and the method
     * @return App to chain a method to add Middleware
     */

    public function get(string $path, array $controller): App
    {
        $this->router->add('GET', $path, $controller);

        return $this;
    }

    /**
     * Public Method to register a route using the add method in the Router class
     * @param string $path route path
     * @param array $controller array with the Controller class and the method
     * @return App to chain a method to add Middleware
     */

    public function post(string $path, array $controller): App
    {
        $this->router->add('POST', $path, $controller);

        return $this;
    }

    // Developers do NOT have access to the Router via the Application class, we create it here.

    /**
     * Public Method to add Middleware to our Router through the Application class
     * @param string $middleware class to add
     */

    public function addMiddleware(string $middleware)
    {
        $this->router->addMiddleware($middleware);
    }

    /**
     * Public Method to add RouteMiddleware to our Router through the Application class
     * @param string $middleware class to add
     */

    public function add(string $middleware)
    {
        $this->router->addRouteMiddleware($middleware);
    }
}
