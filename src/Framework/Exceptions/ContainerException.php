<?php

namespace Framework\Exceptions;

use Exception;

// We create a custom exception for the Container class to determine errors as a class can NOT be instantiated

class ContainerException extends Exception
{
}
