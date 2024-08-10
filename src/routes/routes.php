<?php

$router = new \Bramus\Router\Router();

$router->get('/', function() {
    echo 'test';
});

$router->run();
