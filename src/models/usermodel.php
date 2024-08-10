<?php

namespace Api\models;

use Api\database\DbConnection;
use \PDO;
class UserModel {
    private $db;
    public function __construct()
    {
        $this->db = DbConnection::getInstance()->getConnection();
    }

    public function getUsers(){
        $sql = "SELECT * FROM users";
        $result = $this->db->query($sql);
        if ($result) {
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            return [
                'data' => $data
            ];
        }
    }

    public function getUser(int $id){
        $sql = "SELECT * FROM users WHERE id=:id";
        $result = $this->db->prepare($sql);
        if ($result) {
            $result->execute([
                ":id" => $id
            ]);
            $data = $result->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
    }

    public function getUserEmail(string $email){
        $sql = "SELECT * FROM users WHERE email=:email";
        $result = $this->db->prepare($sql);
        if ($result) {
            $result->execute([
                ":email" => $email
            ]);
            $data = $result->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
    }

    public function addUser(array $data){
        $sql = "INSERT into users(name, last_name, email) VALUES (:name, :last_name, :email)";
        $result = $this->db->prepare($sql);
        if ($result) {
            $result->execute([
                ":name" => $data["name"],
                ":last_name" => $data["last_name"],
                "email" => $data["email"]
            ]);
        }
    }

    public function updateUser(array $data){
        $sql = "UPDATE users SET name = :name, last_name =:last_name, email=:email WHERE id=:id";
        $result = $this->db->prepare($sql);
        if ($result) {
            $result->execute([
                ":id" => $data["id"],
                ":name" => $data["name"],
                ":last_name" => $data["last_name"],
                "email" => $data["email"]
            ]);
        }
    }

    public function deleteUser(int $id){
        $sql = "DELETE FROM users WHERE id=:id";
        $result = $this->db->prepare($sql);
        if ($result) {
            $result->execute([
                "id" => $id
            ]);
        }
    }

}