<?php

namespace src\models;

use \core\Model;

class Posicao extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'posicoes';
    }

    public function getPosicoes()
    {
        $sql = $this->db->query("SELECT * FROM $this->tableName");
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }
}