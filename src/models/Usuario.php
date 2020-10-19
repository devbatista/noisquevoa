<?php

namespace src\models;

use \core\Model;

class Usuario extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login($data)
    {
        $sql = "SELECT * FROM $this->tableName WHERE email = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':email', $data['email']);
        $sql->execute();
        return $sql->fetch(\PDO::FETCH_ASSOC);
    }

    public function getByToken($token)
    {
        $sql = "SELECT * FROM $this->tableName WHERE token = :token";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':token', $token);
        $sql->execute();
        return $sql->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateToken($token, $email)
    {
        $sql = "UPDATE $this->tableName SET token = :token WHERE email = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':token', $token);
        $sql->bindValue(':email', $email);
        $sql->execute();
    }

    public function insertUser($data)
    {
        
    }
}
