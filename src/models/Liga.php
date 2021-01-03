<?php

namespace src\models;

use \core\Model;

class Liga extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        $sql = $this->db->query("SELECT * FROM $this->tableName");

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }
}