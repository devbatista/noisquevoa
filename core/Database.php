<?php
namespace core;

use \src\Config;

class Database {
    private $pdo;
    public function getInstance() {
        if(!isset($this->pdo)) {
            $this->pdo = new \PDO(Config::DB_DRIVER.":dbname=".Config::DB_DATABASE.";host=".Config::DB_HOST, Config::DB_USER, Config::DB_PASS);
        }
        return $this->pdo;
    }
}