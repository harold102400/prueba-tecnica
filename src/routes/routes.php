<?php

use Api\controllers\UserController;

$router = new \Bramus\Router\Router();

$router->get('/api/users', function() {
    $users = new UserController();
    $users->getUsers();
});

$router->get('/api/users/{id}', function($id) {
    $users = new UserController();
    $users->getUser($id);
});

$router->post('/api/users', function() {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $users = new UserController();
    $users->addUser($data);
});

$router->put('/api/users/{id}', function($id) {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $users = new UserController();
    $users->updateUser($id, $data);
});

$router->delete('/api/users/{id}', function($id) {
    $users = new UserController();
    $users->deleteUser($id);
});


$router->run();
