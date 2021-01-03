<?php

namespace src\models;

use \core\Model;

class Local extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'locais';
    }

    public function getData()
    {
        $sql = $this->db->query("SELECT id_local, nome FROM $this->tableName;");

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insertLocal($data)
    {
        if($data) {
            $sql = $this->db->prepare("INSERT INTO $this->tableName SET nome = :nome, cep = :cep, endereco = :endereco, cidade = :cidade, estado = :estado");
            $sql->bindValue('nome', $data['nome']);
            $sql->bindValue('cep', $data['cep']);
            $sql->bindValue('endereco', $data['endereco']);
            $sql->bindValue('cidade', $data['cidade']);
            $sql->bindValue('estado', $data['estado']);
            
            $sql->execute();

            return $sql->errorInfo();
        }
    }
}