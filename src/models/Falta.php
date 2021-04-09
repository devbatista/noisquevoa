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
        $sql = $this->db->prepare("INSERT INTO $this->tableName SET id_usuario = :id_usuario, id_partida = :id_partida, periodo = :periodo, dt_hora = :dt_hora");

        $sql->bindValue('id_usuario', $data['falta']);
        $sql->bindValue('id_partida', $data['id_partida']);
        $sql->bindValue('periodo', $data['periodo']);
        $sql->bindValue('dt_hora', $data['dt_hora']);

        $sql->execute();
    }

    public function getFaltas()
    {
        $sql = $this->db->query("SELECT a.id_falta, a.id_usuario, b.apelido AS jogador, a.dt_hora
        FROM $this->tableName AS a
            INNER JOIN usuarios AS b ON a.id_usuario = b.id_usuario");

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
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