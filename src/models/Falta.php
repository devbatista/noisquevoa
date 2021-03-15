<?php

namespace src\models;

use \core\Model;

class Falta extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertFouls($data)
    {
        $sql = $this->db->prepare("INSERT INTO $this->tableName SET id_usuario = :id_usuario, id_partida = :id_partida, periodo = :periodo");

        $sql->bindValue('id_usuario', $data['falta']);
        $sql->bindValue('id_partida', $data['id_partida']);
        $sql->bindValue('periodo', $data['periodo']);

        $sql->execute();
    }
}