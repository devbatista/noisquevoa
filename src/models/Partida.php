<?php

namespace src\models;

use \core\Model;

class Partida extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getJogos($data = false)
    {
        if (!$data) {
            $sql = $this->db->query("SELECT a.id_partida, b.nome AS liga, a.id_liga, c.nome AS adversario, c.abreviacao , c.logo_equipe as logo_adversario, a.gols_pro, a.gols_contra, d.nome AS local, a.id_local, e.nome AS mandante_visitante, a.data_hora_partida, a.concluido, a.estatisticas, a.cancelado, a.motivo_cancelamento FROM $this->tableName AS a 
            INNER JOIN ligas AS b ON a.id_liga = b.id_liga 
            INNER JOIN equipes AS c ON a.id_adversario = c.id_equipe 
            INNER JOIN locais AS d ON a.id_local = d.id_local 
            INNER JOIN tipo_mv AS e ON a.tipo_mv = e.id_mv
                ORDER BY data_hora_partida ASC");

            return $sql->fetchAll(\PDO::FETCH_ASSOC);
            exit;
        }

        if ($data == 'concluidos') {
            $sql = $this->db->query("SELECT a.id_partida, b.nome AS liga, c.nome AS adversario, c.abreviacao , c.logo_equipe as logo_adversario, a.gols_pro, a.gols_contra, d.nome AS local, e.nome AS mandante_visitante, a.data_hora_partida as dt_hora, a.concluido, a.estatisticas, a.quem_jogou FROM $this->tableName AS a 
            INNER JOIN ligas AS b ON a.id_liga = b.id_liga 
            INNER JOIN equipes AS c ON a.id_adversario = c.id_equipe 
            INNER JOIN locais AS d ON a.id_local = d.id_local 
            INNER JOIN tipo_mv AS e ON a.tipo_mv = e.id_mv
                WHERE concluido = 1 AND estatisticas = 1
                    ORDER BY data_hora_partida ASC");

            return $sql->fetchAll(\PDO::FETCH_ASSOC);
            exit;
        } else {
            $sql = $this->db->prepare("SELECT a.id_partida, b.nome AS liga, c.nome AS adversario, c.abreviacao , c.logo_equipe as logo_adversario, a.gols_pro, a.gols_contra, d.nome AS local, e.nome AS mandante_visitante, a.data_hora_partida, a.concluido, a.estatisticas FROM $this->tableName AS a 
            INNER JOIN ligas AS b ON a.id_liga = b.id_liga 
            INNER JOIN equipes AS c ON a.id_adversario = c.id_equipe 
            INNER JOIN locais AS d ON a.id_local = d.id_local 
            INNER JOIN tipo_mv AS e ON a.tipo_mv = e.id_mv
                WHERE data_hora_partida BETWEEN :startDate AND :endDate
                    ORDER BY data_hora_partida ASC");

            $sql->bindValue(':startDate', $data['startDate']);
            $sql->bindValue(':endDate', $data['endDate']);

            $sql->execute();

            return $sql->fetchAll(\PDO::FETCH_ASSOC);
            exit;
        }
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

    public function getPartidaById($id)
    {
        $sql = $this->db->prepare("SELECT a.id_partida, 'Nois Que Voa' AS nqv, a.gols_pro, a.gols_contra, b.nome AS adversario, b.abreviacao, b.logo_equipe, c.nome AS liga, d.nome AS tipo_mv, e.nome AS local_partida, a.data_hora_partida, a.concluido, a.estatisticas, a.sumula, a.quem_jogou FROM $this->tableName AS a
            INNER JOIN equipes AS b ON b.id_equipe = a.id_adversario
            INNER JOIN ligas AS c ON c.id_liga = a.id_liga
            INNER JOIN tipo_mv AS d ON d.id_mv = a.tipo_mv
            INNER JOIN locais AS e ON e.id_local = a.id_local
                WHERE id_partida = :id_partida");

        $sql->bindValue('id_partida', $id);
        $sql->execute();

        return $sql->fetch(\PDO::FETCH_ASSOC);
    }

    public function updatePartidasConcluidas()
    {
        $sql = $this->db->query("UPDATE $this->tableName SET concluido = 1 WHERE data_hora_partida < CURRENT_TIMESTAMP() + INTERVAL 1 HOUR");
    }

    public function cancelPartida($data)
    {
        $sql = $this->db->prepare("UPDATE $this->tableName SET cancelado = 1, motivo_cancelamento = :motivo WHERE id_partida = :id_partida");
        $sql->bindValue('id_partida', $data['id']);
        $sql->bindValue('motivo', $data['motivo']);
        $sql->execute();
    }

    public function marcarWO($data)
    {
        $sql = $this->db->prepare("UPDATE $this->tableName SET concluido = 1, estatisticas = 1, gols_pro = :gols_pro, gols_contra = :gols_contra WHERE id_partida = :id_partida");

        if ($data['wo'] == 1) {
            $sql->bindValue(':gols_pro', 'W');
            $sql->bindValue(':gols_contra', 'O');
        } else {
            $sql->bindValue(':gols_pro', 'O');
            $sql->bindValue(':gols_contra', 'W');
        }

        $sql->bindValue('id_partida', $data['id_partida']);
        $sql->execute();
    }

    public function getPartidaCancelada($id)
    {
        $sql = $this->db->query("SELECT * FROM $this->tableName WHERE id_partida = $id AND cancelado = 1");

        return $sql->fetch(\PDO::FETCH_ASSOC);
    }

    public function getPartidaWO($id)
    {
        $sql = $this->db->query("SELECT * FROM $this->tableName WHERE id_partida = $id AND (gols_pro = 'W' OR gols_contra = 'W')");

        return $sql->fetch(\PDO::FETCH_ASSOC);
    }

    public function updatePartidas($value, $key, $id)
    {
        $this->db->query("UPDATE $this->tableName SET $key = $value WHERE id_partida = $id");
    }
}
