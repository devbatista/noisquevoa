<?php

namespace src\models;

use \core\Model;

class Assistencia extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertAssists($data)
    {
        $sql = $this->db->prepare("INSERT INTO $this->tableName SET id_usuario = :id_usuario, id_partida = :id_partida, id_gol = :id_gol");

        $sql->bindValue('id_usuario', $data['assistencia']);
        $sql->bindValue('id_partida', $data['id_partida']);
        $sql->bindValue('id_gol', $data['id_gol']);

        $sql->execute();
    }
}