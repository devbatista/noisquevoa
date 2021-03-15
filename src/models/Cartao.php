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
}