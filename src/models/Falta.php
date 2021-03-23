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

    public function getFoulsByPartidaId($id)
    {
        $sql = $this->db->prepare("SELECT a.id_falta, a.id_partida, a.id_usuario, b.nome AS quem_fez, b.apelido, a.periodo FROM faltas AS a
            INNER JOIN usuarios AS b ON b.id_usuario = a.id_usuario
                WHERE id_partida = 15");

        $sql->bindValue('id_partida', $id);
        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }
}