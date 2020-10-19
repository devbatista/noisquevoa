<?php

namespace core;

use \core\Database;

class Model
{
    public $db;
    public $tableName;
    
    public function __construct()
    {   
        $this->db = new Database();
        $this->db = $this->db->getInstance();
        $this->tableName = $this->getTableName();
    }

    public function getTableName()
    {
        $className = explode('\\', get_called_class());
        $className = end($className);
        return strtolower($className) . 's';
    }
}
