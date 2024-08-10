<?php

$router = new \Bramus\Router\Router();

$router->get('/api/users', function() {
    echo 'test';
});

$router->run();
