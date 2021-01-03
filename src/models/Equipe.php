<?php

namespace src\models;

use \core\Model;

class Equipe extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        $sql = $this->db->query("SELECT * FROM $this->tableName WHERE adversario = 1");

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function equipeExiste($equipe, $sigla)
    {
        $sql = $this->db->prepare("SELECT * FROM $this->tableName WHERE nome = :nome AND abreviacao = :sigla");
        $sql->bindValue(':nome', $equipe);
        $sql->bindValue(':sigla', $sigla);
        $sql->execute();

        return $sql->fetch(\PDO::FETCH_ASSOC);
    }

    public function createTeam($equipe, $sigla)
    {
        $sql = $this->db->prepare("INSERT INTO $this->tableName SET nome = :nome, abreviacao = :sigla, adversario = 1");
        $sql->bindValue(':nome', $equipe);
        $sql->bindValue(':sigla', $sigla);
        $sql->execute();

        return $this->db->lastInsertId();        
    }

    public function updatePhotoTeam($image, $id)
    {
        if ($image && $id) {
            $sql = $this->db->prepare("UPDATE $this->tableName SET logo_equipe = :logo_equipe WHERE id_equipe = :id");
            $sql->bindValue(':logo_equipe', $image);
            $sql->bindValue(':id', $id);
            $sql->execute();

            return true;
        }
    }
}