<?php

namespace Api\controllers;

use Api\helpers\ErrorLog;
use Api\helpers\HttpResponses;
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
        } catch (\Throwable $e) {
            echo json_encode(HttpResponses::serverError());
            ErrorLog::showErrors();
            error_log("Error message :" . $e);
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
                echo json_encode(HttpResponses::notFound("The user with this email already exists try a different email"));
                return;
            }
            $user = $this->userModel->addUser($allData);
            echo json_encode(HttpResponses::created($user));
        } catch (\Throwable $e) {
            echo json_encode(HttpResponses::serverError());
            ErrorLog::showErrors();
            error_log("Error message :" . $e);
        }
    }

    public function getUser(int $id)
    {
        try {
            $user = $this->userModel->getUser($id);
            if (!$user) {
                echo json_encode(HttpResponses::notFound("There is not an user under this id"));
            } else {
                echo json_encode($user);
            }
        } catch (\Throwable $e) {
            echo json_encode(HttpResponses::serverError());
            ErrorLog::showErrors();
            error_log("Error message :" . $e);
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
            echo json_encode(HttpResponses::ok("User with ".$id. " has been updated"));

        } catch (\Throwable $e) {
            echo json_encode(HttpResponses::serverError());
            ErrorLog::showErrors();
            error_log("Error message :" . $e);
        }
    }

    public function deleteUser(int $id)
    {
        try {
            $this->userModel->deleteUser($id);
            echo json_encode(HttpResponses::noContent());
        } catch (\Throwable $e) {
            echo json_encode(HttpResponses::serverError());
            ErrorLog::showErrors();
            error_log("Error message :" . $e);
        }
    }
}