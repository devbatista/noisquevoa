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
        $sql = $this->db->query("SELECT a.id_partida, b.nome AS liga, c.nome AS adversario, c.logo_equipe as logo_adversario, a.gols_pro, a.gols_contra, d.nome AS local, e.nome AS mandante_visitante, a.data_hora_partida, a.concluido FROM $this->tableName AS a 
            INNER JOIN liga AS b ON a.id_liga = b.id_liga 
            INNER JOIN equipes AS c ON a.id_adversario = c.id_equipe 
            INNER JOIN local AS d ON a.id_local = d.id_local 
            INNER JOIN tipo_mv AS e ON a.tipo_mv = e.id_mv");
        
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

}