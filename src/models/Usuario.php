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

    public function getAll()
    {
        $sql = $this->db->query("SELECT * FROM $this->tableName");
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getUserByID($id)
    {
        $sql = $this->db->query("SELECT * FROM $this->tableName WHERE id = $id");
        return $sql->fetch(\PDO::FETCH_ASSOC);
    }

    public function insertUser($data)
    {
        if (!empty($data['nome']) && !empty($data['email'])) {
            $sql = "INSERT INTO $this->tableName SET nome = :nome, email = :email";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':nome', $data['nome']);
            $sql->bindValue(':email', $data['email']);

            if ($sql->execute()) {
                $code = [
                    'code' => 0,
                    'msg' => 'Usuário inserido com sucesso!!!'
                ];
            } else {
                $code = [
                    'code' => 1,
                    'msg' => 'Falha na inserção de usuário (veja no console qual foi o erro) !!!',
                    'error' => $sql->errorInfo()
                ];
            }
        } else {
            $code = [
                'code' => 2,
                'msg' => 'É necessário preencher todos os campos!!!'
            ];
        }

        return $code;
    }

    public function alterUser($data)
    {
        if (!empty($data['nome']) && !empty($data['email'])) {
            $sql = "UPDATE $this->tableName SET nome = :nome, email = :email WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':nome', $data['nome']);
            $sql->bindValue(':email', $data['email']);
            $sql->bindValue(':id', $data['id']);

            if ($sql->execute()) {
                $code = [
                    'code' => 0,
                    'msg' => 'Usuário alterado com sucesso!!!'
                ];
            } else {
                $code = [
                    'code' => 1,
                    'msg' => 'Falha na alteração do usuário (veja no console qual foi o erro) !!!',
                    'error' => $sql->errorInfo()
                ];
            }
        } else {
            $code = [
                'code' => 2,
                'msg' => 'É necessário preencher todos os campos!!!'
            ];
        }

        return $code;
    }

    public function deleteUser($id)
    {
        $sql = $this->db->query("DELETE FROM $this->tableName WHERE id = $id");
        return true;
    }
}
