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
        $sql = $this->db->prepare("INSERT INTO $this->tableName SET id_usuario = :id_usuario, id_partida = :id_partida, id_gol = :id_gol, dt_hora = :dt_hora");

        $sql->bindValue('id_usuario', $data['assistencia']);
        $sql->bindValue('id_partida', $data['id_partida']);
        $sql->bindValue('id_gol', $data['id_gol']);
        $sql->bindValue('dt_hora', $data['dt_hora']);

        $sql->execute();
    }

    public function getAssistencias()
    {
        $sql = $this->db->query("SELECT a.id_gol, a.id_usuario, b.apelido AS jogador, a.dt_hora
        FROM $this->tableName AS a
            INNER JOIN usuarios AS b ON a.id_usuario = b.id_usuario");

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAssistsByPartidaId($id)
    {
         $sql = $this->db->prepare("SELECT a.id_assistencia, a.id_partida, a.id_usuario, b.nome AS quem_fez, b.apelido, a.id_gol FROM $this->tableName AS a
             INNER JOIN usuarios AS b ON b.id_usuario = a.id_usuario
                 WHERE id_partida = :id_partida");
                 
        $sql->bindValue('id_partida', $id);
        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }
}