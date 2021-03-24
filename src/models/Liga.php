<?php

namespace src\models;

use \core\Model;

class Liga extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        $sql = $this->db->query("SELECT * FROM $this->tableName WHERE ativo = 1 ORDER BY nome ASC");

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function addLiga($data)
    {
        $sql = $this->db->prepare("INSERT INTO $this->tableName SET nome = :nome, url_site = :url_site, ativo = 1");

        $sql->bindValue(':nome', $data['nome']);
        $sql->bindValue(':url_site', $data['site']);
        $sql->execute();

        return $this->db->lastInsertId();
    }

    public function updateLiga($data)
    {
        $sql = $this->db->prepare("UPDATE $this->tableName SET nome = :nome, url_site = :url_site WHERE id_liga = :id_liga");
        
        $sql->bindValue('nome', $data['nome']);
        $sql->bindValue('url_site', $data['url_site']);
        $sql->bindValue('id_liga', $data['id_liga']);

        $sql->execute();
    }

    public function updateLogoLiga($logo, $id)
    {
        $sql = $this->db->prepare("UPDATE $this->tableName SET logo_liga = :logo WHERE id_liga = :id_liga");

        $sql->bindValue('logo', $logo);
        $sql->bindValue('id_liga', $id);

        $sql->execute();
    }

    public function disableLiga($id)
    {
        $sql = $this->db->prepare("UPDATE $this->tableName SET ativo = 0 WHERE id_liga = :id_liga");

        $sql->bindValue('id_liga', $id);

        $sql->execute();
    }
}
