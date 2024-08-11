<?php

use Api\controllers\UserController;
use Api\helpers\HttpResponses;

$router = new \Bramus\Router\Router();

$router->get('/api/users', function() {
    $users = new UserController();
    $users->getUsers();
});

$router->get('/api/users/{id}', function($id) {
    $Id = (int)$id;
    $users = new UserController();
    $users->getUser($Id);
});

$router->post('/api/users', function() {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $users = new UserController();
    $users->addUser($data);
});

$router->put('/api/users/{id}', function($id) {
    $Id = (int)$id;
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $users = new UserController();
    $users->updateUser($Id, $data);
});

$router->delete('/api/users/{id}', function($id) {
    $Id = (int)$id;
    $users = new UserController();
    $users->deleteUser($Id);
});


$router->set404(function(){
    echo json_encode(HttpResponses::notFound("Resource not found"));
});

$router->run();
