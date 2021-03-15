<?php

namespace src\models;

use \core\Model;

class Partida extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getJogos()
    {
        $sql = $this->db->query("SELECT a.id_partida, b.nome AS liga, c.nome AS adversario, c.abreviacao , c.logo_equipe as logo_adversario, a.gols_pro, a.gols_contra, d.nome AS local, e.nome AS mandante_visitante, a.data_hora_partida, a.concluido, a.estatisticas FROM $this->tableName AS a 
            INNER JOIN ligas AS b ON a.id_liga = b.id_liga 
            INNER JOIN equipes AS c ON a.id_adversario = c.id_equipe 
            INNER JOIN locais AS d ON a.id_local = d.id_local 
            INNER JOIN tipo_mv AS e ON a.tipo_mv = e.id_mv
                ORDER BY data_hora_partida ASC");

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createPartida($data)
    {
        $sql = $this->db->prepare("INSERT INTO $this->tableName SET id_liga = :liga, nois_que_voa = :nois_que_voa, id_adversario = :id_adversario, id_local = :id_local, tipo_mv = :tipo_mv, data_hora_partida = :data_hora_partida");

        $sql->bindValue('liga', $data['liga']);
        $sql->bindValue('nois_que_voa', 1);
        $sql->bindValue('id_adversario', $data['id_adversario']);
        $sql->bindValue('id_local', $data['local']);
        $sql->bindValue('tipo_mv', $data['tipo_mv']);
        $sql->bindValue('data_hora_partida', $data['data_hora_partida']);

        $sql->execute();
    }

    public function getPartidasConcluidas()
    {
        $sql = $this->db->query("SELECT a.id_partida, b.nome AS liga, 'NQV', 'Nois Que Voa', c.nome AS adversario, c.abreviacao, d.nome AS quadra, a.data_hora_partida, a.tipo_mv FROM partidas AS a 
        INNER JOIN ligas AS b ON b.id_liga = a.id_liga
        INNER JOIN equipes AS c ON c.id_equipe = a.id_adversario
        INNER JOIN locais AS d ON d.id_local = a.id_local
            WHERE concluido = 1 AND estatisticas = 0
                ORDER BY data_hora_partida ASC");

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function enviarEstatisticasPartida($data)
    {
        $sql = $this->db->prepare("UPDATE $this->tableName SET gols_pro = :gols_pro, gols_contra = :gols_contra, quem_jogou = :quem_jogou, sumula = :sumula, estatisticas = :estatisticas WHERE id_partida = :id_partida");

        $sql->bindValue('gols_pro', $data['placar_nqv']);
        $sql->bindValue('gols_contra', $data['placar_vis']);
        $sql->bindValue('quem_jogou', $data['jogadores']);
        $sql->bindValue('sumula', $data['sumula']);
        $sql->bindValue('estatisticas', $data['estatisticas']);
        $sql->bindValue('id_partida', $data['id_partida']);

        $sql->execute();
    }
}
