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

    public function getPermissionById($id)
    {
        $sql = $this->db->query("SELECT id_usuario, nome, apelido, diretoria, presidencia, comissao_tecnica, jogador FROM $this->tableName WHERE id_usuario = $id");

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
        if ($data) {
            try {
                $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO $this->tableName SET nome = :nome, apelido = :apelido, email = :email, senha = :senha, cpf = :cpf, celular = :celular, jogador = :jogador, diretoria = :diretoria, comissao_tecnica = :comissao_tecnica, dt_nascimento = :dt_nascimento, posicao = :posicao";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(':nome', $data['nome']);
                $sql->bindValue(':apelido', $data['apelido']);
                $sql->bindValue(':email', $data['email']);
                $sql->bindValue(':senha', $data['senha']);
                $sql->bindValue(':cpf', $data['cpf']);
                $sql->bindValue(':celular', $data['celular']);
                $sql->bindValue(':jogador', $data['jogador']);
                $sql->bindValue(':diretoria', $data['diretoria']);
                $sql->bindValue(':comissao_tecnica', $data['comissao_tecnica']);
                $sql->bindValue(':dt_nascimento', $data['dt_nascimento']);
                $sql->bindValue(':posicao', $data['posicao']);

                $sql->execute();
                $code = [
                    'code' => 0,
                    'msg' => 'Cadastro efetuado com sucesso'
                ];
            } catch (\PDOException $th) {
                $code = [
                    'code' => 1062,
                    'msg' => $th->getMessage()
                ];
            }
        } else {
            $code = [
                'code' => 1,
                'msg' => 'Erro, atualize a página e envie os dados novamente'
            ];
        }

        return $code;
    }

    public function inserUserByDiretoria($data)
    {
        $code = [];
        if ($data) {
            try {
                $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO $this->tableName SET nome = :nome, apelido = :apelido, email = :email, senha = :senha, cpf = :cpf, jogador = :jogador, diretoria = :diretoria, comissao_tecnica = :comissao_tecnica, posicao = :posicao, aprovado = 1";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(':nome', $data['nome']);
                $sql->bindValue(':apelido', $data['apelido']);
                $sql->bindValue(':email', $data['email']);
                $sql->bindValue(':senha', $data['senha']);
                $sql->bindValue(':cpf', $data['cpf']);
                $sql->bindValue(':jogador', $data['jogador']);
                $sql->bindValue(':diretoria', $data['diretoria']);
                $sql->bindValue(':comissao_tecnica', $data['comissao_tecnica']);
                $sql->bindValue(':posicao', $data['posicao']);

                $sql->execute();
                $code = [
                    'code' => 0,
                    'msg' => 'Cadastro efetuado com sucesso'
                ];
            } catch (\PDOException $th) {
                $code = [
                    'code' => 1062,
                    'msg' => $th->getMessage()
                ];
            }
        } else {
            $code = [
                'code' => 1,
                'msg' => 'Erro, atualize a página e envie os dados novamente'
            ];
        }

        return $code;
    }

    public function alterUser($data)
    {
        $code = [];
        if ($data) {
            try {
                $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE $this->tableName SET nome = :nome, apelido = :apelido, jogador = :jogador, celular = :celular, diretoria = :diretoria, comissao_tecnica = :comissao_tecnica, posicao = :posicao WHERE id_usuario = :id;";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(':nome', $data['nome']);
                $sql->bindValue(':apelido', $data['apelido']);
                $sql->bindValue(':celular', $data['celular']);
                $sql->bindValue(':jogador', $data['jogador']);
                $sql->bindValue(':diretoria', $data['diretoria']);
                $sql->bindValue(':comissao_tecnica', $data['comissao_tecnica']);
                $sql->bindValue(':posicao', $data['posicao']);
                $sql->bindValue(':id', $data['id']);

                $sql->execute();
                $code = [
                    'code' => 0,
                    'msg' => 'Usuário alterado com sucesso'
                ];
            } catch (\PDOException $th) {
                $code = [
                    'code' => 1062,
                    'msg' => $th->getMessage(),
                ];
            }
        } else {
            $code = [
                'code' => 1,
                'msg' => 'Erro, atualize a página e envie os dados novamente'
            ];
        }

        return $code;
    }

    public function getJogadores()
    {
        $sql = $this->db->query("SELECT * FROM $this->tableName WHERE jogador = 1 AND aprovado = 1");
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getArtilheiros()
    {
        $sql = $this->db->query("SELECT id_usuario, apelido, gols, jogos FROM $this->tableName WHERE jogador = 1 AND aprovado = 1 ORDER BY gols DESC, jogos ASC LIMIT 7");
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAssistencias()
    {
        $sql = $this->db->query("SELECT id_usuario, apelido, assistencias, jogos FROM $this->tableName WHERE jogador = 1 AND aprovado = 1 ORDER BY assistencias DESC, jogos ASC LIMIT 5");
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getLoginAprovar($id = false)
    {
        if ($id) {
            $sql = $this->db->query("SELECT id_usuario, aprovado, ativo FROM $this->tableName WHERE id_usuario = $id");
            return $sql->fetch(\PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function getUsuariosAprovar($id = false)
    {
        if (!$id) {
            $sql = $this->db->query("SELECT a.id_usuario, a.foto, a.apelido, a.email, a.dt_nascimento, a.celular, b.nome AS posicao FROM $this->tableName as a INNER JOIN posicoes AS b ON a.posicao = b.id_posicao WHERE aprovado = 0 AND jogador = 1");
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function approveRegistration($id)
    {
        if ($id) {
            $this->db->query("UPDATE $this->tableName SET aprovado = 1 WHERE id_usuario = $id");
        }
    }

    public function getAllElenco()
    {
        $sql = $this->db->query("SELECT a.id_usuario, a.nome, a.apelido, b.nome AS posicao, a.dt_nascimento, a.foto FROM $this->tableName AS a LEFT JOIN posicoes AS b ON a.posicao = b.id_posicao WHERE a.aprovado = 1 AND (a.jogador = 1  OR a.comissao_tecnica = 1) AND ativo = 1 ORDER BY a.jogador DESC, a.posicao ASC;");

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getElencoById($id)
    {
        if ($id) {
            $sql = $this->db->query("SELECT * FROM $this->tableName WHERE id_usuario = $id AND aprovado = 1 AND (jogador = 1 OR comissao_tecnica = 1) AND ativo = 1");

            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

    public function disableUser($id)
    {
        if ($id) {
            $sql = $this->db->query("UPDATE $this->tableName SET ativo = 0 WHERE id_usuario = $id");
        }
    }
}
