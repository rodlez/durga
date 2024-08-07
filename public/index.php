<?php

include __DIR__ . "/../src/App/functions.php";

// we get the instance of the App class with all the methods that we need to run the application
$app = include __DIR__ . '/../src/App/bootstrap.php';

// Call the run method to start the App
$app->run();

// Sugar functions to debug
//showNice($app);
//debugator($app, 1, 3);
