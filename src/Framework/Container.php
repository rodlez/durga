<?php

declare(strict_types=1);

namespace Framework;

// to help inspect a Class
use ReflectionClass, ReflectionNamedType;

use Framework\Exceptions\ContainerException;

class Container
{
    // array with the definitions to create the instances of the classes
    private array $definitions = [];
    // to make track of the instances of a class, to apply the Singleton Pattern
    // A design Pattern for restricting a class to a single instance.
    private array $resolved = [];

    public function addDefinitions(array $newDefinitions)
    {
        // We need to merge the 2 arrays (definitions and newDefinitions), there is 2 possible solutions
        // First using array_merge
        // $this->definitions = array_merge($this->definitions, $newDefinitions);
        // using the spread operator ... it's faster than using array_merge function
        $this->definitions = [...$this->definitions, ...$newDefinitions];
        //showNice($newDefinitions);
    }

    // Our Container does NOT know what dependencies are require by our Controllers, needs to take a look in the class
    // to know what it was -> Thats possible using reflective programming (use ReflectionClass).

    public function resolve(string $className)
    {
        // ReflectionClass creates an instance of the class that we pass
        $reflectionClass = new ReflectionClass($className);
        //showNice($reflectionClass);

        // 1 - Validate the class to know if the class can be instantiated, for example abstract classes can NOT

        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException("Class {$className} is not instantiable.");
        }

        // 2 - The ReflectionClass has a method to retrieve the construct method of a class

        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            return new $className;
        }

        // 3 - The ReflectionClass has a method to retrieve the parameters

        $parameters = $constructor->getParameters();

        if (count($parameters) === 0) {
            return new $className;
        }

        // 4 - Validate the parameters, $parameters is an array of instances return by the getParameters() method
        // then the $param is also an instance of the ReflectionParameter class, we have available methods to view info from a parameter.
        // Validate to check if the parameters are NOT classes, only if it's a class we can generate an instance.

        $dependencies = [];

        foreach ($parameters as $param) {
            $name = $param->getName();
            $type = $param->getType();

            if (!$type) {
                throw new ContainerException("Failed to resolve class {$className} because param {$name} is missing a type hint.");
            }

            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                throw new ContainerException("Failed to resolve class {$className} because invalid param name.");
            }

            // We call the function to get the dependency, the parameters ara type hint with the classes, then we will get the class in the Container with the same class name
            $dependencies[] = $this->get($type->getName());
        }

        //showNice($dependencies);

        // create new instances based on the arguments (dependencies array)
        return $reflectionClass->newInstanceArgs($dependencies);
    }

    // Method to return an instance of every dependency
    // We grabbing the factory function for a specific dependency, after doing so we invoking the factory function to grab an instance of the dependency

    public function get(string $id)
    {

        // check if the key ($id) in the associative array ($definitions) exists.
        if (!array_key_exists($id, $this->definitions)) {
            throw new ContainerException("Class {$id} does NOT exists in Container.");
        }

        // SINGLETON PATTERN -> check if the instance exists there is no point in create a new one.
        // if the class ($id) exists return the instance and NOT create another.
        if (array_key_exists($id, $this->resolved)) {
            return $this->resolved[$id];
        }

        // value of the key id will be the factory function in the dependencies array
        $factory = $this->definitions[$id];

        // to get the dependency we must invoke the factory function to get the instance of our Container
        // using this keyword permits to pass the Container instance to the factory function
        // Now the factory function is allow to grab dependencies manually
        $dependency = $factory($this);

        // to have a track of the instances for the class in the array resolved 
        $this->resolved[$id] = $dependency;

        return $dependency;
    }
}
