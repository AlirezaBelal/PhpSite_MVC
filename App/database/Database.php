<?php

namespace App\database;

use App\core\Message;
use App\controller\BaseController;


class Database
{

    const DB_HOST = "127.0.0.1";
    const DB_PORT = "";
    const DB_NAME = "AlirezaBelal";
    const DB_USERNAME = "root";
    const DB_PASSWORD = "";

    private static $instance;
    private $pdo;

    // Singleton pattern
    private function __construct() 
    {
        $dsn = sprintf("mysql:host=%s;port=%s;dbname=%s", self::DB_HOST, self::DB_PORT, self::DB_NAME);

        try {
            $this->pdo = new \PDO($dsn, self::DB_USERNAME, self::DB_PASSWORD);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            Message::addMessage($e->getMessage(), Message::Error);
            (new BaseController())->redirect("login");
            exit();
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
          self::$instance = new Database();
        }
     
        return self::$instance;
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}
