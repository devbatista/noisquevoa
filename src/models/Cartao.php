<?php

namespace src\models;

use \core\Model;

class Cartao extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insertCartoesAmarelos($data, $cartao = 'cartoes_amarelos')
    {
        $sql = $this->db->prepare("INSERT INTO $cartao SET id_usuario = :id_usuario, id_partida = :id_partida, dt_hora = :dt_hora");

        $sql->bindValue('id_usuario', $data['id_usuario']);
        $sql->bindValue('id_partida', $data['id_partida']);
        $sql->bindValue('dt_hora', $data['dt_hora']);

        $sql->execute();
    }

    public function insertCartoesVermelhos($data, $cartao = 'cartoes_vermelhos')
    {
        $sql = $this->db->prepare("INSERT INTO $cartao SET id_usuario = :id_usuario, id_partida = :id_partida, dt_hora = :dt_hora");

        $sql->bindValue('id_usuario', $data['id_usuario']);
        $sql->bindValue('id_partida', $data['id_partida']);
        $sql->bindValue('dt_hora', $data['dt_hora']);

        $sql->execute();
    }

    public function getCartoes($cor)
    {
        $cartao = 'cartoes_'.$cor;

        $sql = $this->db->query("SELECT a.id_usuario, b.apelido AS jogador, a.dt_hora
        FROM $cartao AS a
            INNER JOIN usuarios AS b ON a.id_usuario = b.id_usuario");

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCartoesByPartidaId($id, $table, $cartao)
    {
        $sql = $this->db->prepare("SELECT a.$cartao, a.id_partida, a.id_usuario, b.nome AS quem_tomou, b.apelido FROM $table AS a
            INNER JOIN usuarios AS b ON b.id_usuario = a.id_usuario
                WHERE id_partida = :id_partida");

        $sql->bindValue('id_partida', $id);
        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }
}
