<?php

declare(strict_types=1);

// this file contain ALL the paths to not HARDCODE them

namespace App\Config;

// instead of using only CONSTANTS we declare a class because Composer will autoload the classes

class Paths
{
    // path to the views directory on our project
    public const VIEW = __DIR__ . "/../views";
    // path to the source directory on our project
    public const SOURCE = __DIR__ . "/../../";
    // path to the root directory on our project
    public const ROOT = __DIR__ . "/../../../";
}
