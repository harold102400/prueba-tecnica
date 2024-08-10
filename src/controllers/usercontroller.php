<?php

namespace Api\controllers;

use Api\models\UserModel;

class UserController {
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();        
    }

    public function getUsers(){
        try {
            $data = $this->userModel->getUsers();
            echo json_encode($data);
        } catch (\Throwable $error) {
            echo "<pre>";
            var_dump($error);
            echo "</pre>";
        }
    }

    public function addUser(array $data)
    {
        try {
            $allData = [
                "name" => $data["name"],
                "last_name" => $data["last_name"],
                "email" => $data["email"]
            ];
            $existingUser =  $this->userModel->getUserEmail($data["email"]);
            if ($existingUser) {
                echo json_encode("The user with this email already exists try a different email");
                return;
            }
            $this->userModel->addUser($allData);
            echo json_encode(204);
        } catch (\Throwable $e) {
           var_dump($e);
        }
    }

    public function getUser(int $id)
    {
        try {
            $user = $this->userModel->getUser($id);
            if (!$user) {
                echo json_encode("There is not an user under this id");
            } else {
                echo json_encode($user);
            }
        } catch (\Throwable $e) {
            var_dump($e);
        }
    }

    public function updateUser(int $id, array $data)
    {
        try {
            $allData = [
                "id" => $id,
                "name" => $data["name"],
                "last_name" => $data["last_name"],
                "email" => $data["email"]
            ];

            $this->userModel->updateUser($allData);
            echo json_encode("User with ".$id. " has been updated");

        } catch (\Throwable $e) {
            var_dump($e);
        }
    }

    public function deleteUser(int $id)
    {
        try {
            $this->userModel->deleteUser($id);
            echo json_encode(204);
        } catch (\Throwable $e) {
            var_dump($e);
        }
    }
}