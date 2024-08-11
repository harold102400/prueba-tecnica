<?php
namespace Api\database;

use Api\helpers\ErrorLog;
use \PDO;
use PDOException;
class DbConnection {

    private static $instace = null;
    private $conn;

    private $host;
    private $user;
    private $pass;
    private $dbname;
    private $port;

    private function __construct() 
    {
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "root123";
        $this->dbname = "user_data";
        $this->port = "4306";

       try {
        $this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname", $this->user, $this->pass);
       } catch (PDOException $e) {
        ErrorLog::showErrors();
        error_log("Error message\n" . $e);
       }
    } 

    public static function getInstance()
    {
        if (!self::$instace) {
            self::$instace = new DbConnection();
        }
        return self::$instace;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}