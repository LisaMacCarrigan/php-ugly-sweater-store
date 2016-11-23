<?php
    require_once __DIR__."/../vendor/autoload.php";
    date_default_timezone_set('America/New_York');

    $app = new Silex\Application();

    $app->get("/", function() {
        return "Hi there!";
    });

    return $app;
?>
