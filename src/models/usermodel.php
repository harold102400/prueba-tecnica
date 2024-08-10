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
        $sql = "SELECT * FROM data_user";
        $result = $this->db->query($sql);
        if ($result) {
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            return [
                'data' => $data
            ];
        }
    }

    public function getUser(int $id){
        $sql = "SELECT * FROM data_user WHERE id=:id";
        $result = $this->db->prepare($sql);
        if ($result) {
            $result->execute([
                ":id" => $id
            ]);
            $data = $result->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
    }

    public function addUser(array $data){
        $sql = "INSERT into data_user(name, last_name, email) VALUES (:name, :last_name, :email)";
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
        $sql = "UPDATE data_user SET name = :name, last_name =:last_name, email=:email WHERE id=:id";
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
        $sql = "DELETE FROM data_user WHERE id=:id";
        $result = $this->db->prepare($sql);
        if ($result) {
            $result->execute([
                "id" => $id
            ]);
        }
    }
    
}