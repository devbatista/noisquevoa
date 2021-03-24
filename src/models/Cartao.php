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
        $sql = $this->db->prepare("INSERT INTO $cartao SET id_usuario = :id_usuario, id_partida = :id_partida");

        $sql->bindValue('id_usuario', $data['id_usuario']);
        $sql->bindValue('id_partida', $data['id_partida']);

        $sql->execute();
    }

    public function insertCartoesVermelhos($data, $cartao = 'cartoes_vermelhos')
    {
        $sql = $this->db->prepare("INSERT INTO $cartao SET id_usuario = :id_usuario, id_partida = :id_partida");

        $sql->bindValue('id_usuario', $data['id_usuario']);
        $sql->bindValue('id_partida', $data['id_partida']);

        $sql->execute();
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
