<?php

namespace src\models;

use \core\Model;

class Gol extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertGoals($data)
    {
        $sql = $this->db->prepare("INSERT INTO $this->tableName SET id_usuario = :id_usuario, id_partida = :id_partida, tempo = :tempo, periodo = :periodo, assistencia = :assistencia");

        $sql->bindValue('id_usuario', $data['gol']);
        $sql->bindValue('id_partida', $data['id_partida']);
        $sql->bindValue('tempo', $data['tempo']);
        $sql->bindValue('periodo', $data['periodo']);
        $sql->bindValue('assistencia', $data['assistencia']);

        $sql->execute();

        return $this->db->lastInsertId();
    }

    public function getGoalsByPartidaId($id)
    {
        $sql = $this->db->prepare("SELECT a.id_gol, a.id_partida, a.id_usuario, b.nome as quem_fez, b.apelido, a.tempo, a.periodo, a.assistencia FROM $this->tableName AS a
            INNER JOIN usuarios AS b ON b.id_usuario = a.id_usuario
                WHERE id_partida = :id_partida");

        $sql->bindValue('id_partida', $id);
        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }
}