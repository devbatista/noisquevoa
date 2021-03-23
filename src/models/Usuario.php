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

    public function verifyByEmailAndToken($email, $token)
    {
        $sql = $this->db->query("SELECT * FROM $this->tableName WHERE email = '$email' AND token = '$token'");

        return $sql->fetch(\PDO::FETCH_ASSOC);
    }

    public function updatePassword($data)
    {
        if ($data) {
            $sql = $this->db->prepare("UPDATE $this->tableName SET senha = :senha, token = '' WHERE email = :email");
            $sql->bindValue(':senha', $data['senha']);
            $sql->bindValue(':email', $data['email']);
            $sql->execute();
        }
    }

    public function getByToken($token)
    {
        $sql = "SELECT * FROM $this->tableName WHERE token = :token";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':token', $token);
        $sql->execute();
        return $sql->fetch(\PDO::FETCH_ASSOC);
    }

    public function getByEmail($email)
    {
        if ($email) {
            $sql = $this->db->query("SELECT * FROM $this->tableName WHERE email = '$email'");

            return $sql->fetch(\PDO::FETCH_ASSOC);
        }
    }

    public function getPermissionById($id)
    {
        $sql = $this->db->query("SELECT id_usuario, nome, apelido, diretoria, presidencia, comissao_tecnica, jogador FROM $this->tableName WHERE id_usuario = $id");

        return $sql->fetch(\PDO::FETCH_ASSOC);
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
            $sql = $this->db->query("SELECT a.id_usuario, a.foto, a.apelido, a.email, a.dt_nascimento, a.celular, b.nome AS posicao FROM $this->tableName as a LEFT JOIN posicoes AS b ON a.posicao = b.id_posicao WHERE aprovado = 0 AND (jogador = 1 OR comissao_tecnica = 1) AND ativo = 1");
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function updateToken($token, $email)
    {
        $sql = "UPDATE $this->tableName SET token = :token WHERE email = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':token', $token);
        $sql->bindValue(':email', $email);
        $sql->execute();
    }

    public function getUserById($id)
    {
        $sql = $this->db->query("SELECT * FROM $this->tableName WHERE id_usuario = $id");

        return $sql->fetch(\PDO::FETCH_ASSOC);
    }

    public function getJogadores()
    {
        $sql = $this->db->query("SELECT * FROM $this->tableName WHERE jogador = 1 AND aprovado = 1 AND ativo = 1");
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAllDiretoria()
    {
        $sql = $this->db->query("SELECT id_usuario, nome, apelido, email, celular, foto, dt_nascimento FROM $this->tableName WHERE diretoria = 1 AND aprovado = 1 AND ativo = 1");

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getDiretoriaById($id = false)
    {
        if ($id) {
            $sql = $this->db->query("SELECT id_usuario, nome, apelido, email, cpf, celular, dt_nascimento FROM $this->tableName WHERE id_usuario = $id AND aprovado = 1 AND diretoria = 1 AND ativo = 1");

            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

    public function getDiretoriaAprovar($id = false)
    {
        if (!$id) {
            $sql = $this->db->query("SELECT a.id_usuario, a.nome, a.foto, a.apelido, a.email, a.dt_nascimento, a.celular FROM $this->tableName as a WHERE aprovado = 0 AND diretoria = 1 AND ativo = 1");
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function updatePasswordProfile($senha, $id)
    {
        if ($senha && $id) {
            $sql = $this->db->prepare("UPDATE $this->tableName SET senha = :senha WHERE id_usuario = :id");
            $sql->bindValue(':senha', $senha);
            $sql->bindValue(':id', $id);
            $sql->execute();
        }
    }

    public function updateNomeUser($nome, $id)
    {
        $sql = $this->db->query("UPDATE $this->tableName SET nome = '$nome' WHERE id_usuario = $id");
    }

    public function updateApelidoUser($apelido, $id)
    {
        $sql = $this->db->query("UPDATE $this->tableName SET apelido = '$apelido' WHERE id_usuario = $id");
    }

    public function updateEmailUser($email, $id)
    {
        $sql = $this->db->prepare("UPDATE $this->tableName SET email = :email WHERE id_usuario = :id");
        $sql->bindValue(':email', $email);
        $sql->bindValue(':id', $id);
        $sql->execute();

        return $sql->errorInfo();
    }

    public function updateCPFUser($cpf, $id)
    {
        $sql = $this->db->prepare("UPDATE $this->tableName SET cpf = :cpf WHERE id_usuario = :id");
        $sql->bindValue(':cpf', $cpf);
        $sql->bindValue(':id', $id);
        $sql->execute();

        return $sql->errorInfo();
    }

    public function updateCelularUser($celular, $id)
    {
        $sql = $this->db->query("UPDATE $this->tableName SET celular = '$celular' WHERE id_usuario = $id");
    }

    public function updateNascimentoUser($nascimento, $id)
    {
        $sql = $this->db->query("UPDATE $this->tableName SET dt_nascimento = $nascimento WHERE id_usuario = $id");
    }

    public function updatePhotoUser($foto, $id)
    {
        if ($foto && $id) {
            $sql = $this->db->query("UPDATE $this->tableName SET foto = '$foto' WHERE id_usuario = $id");

            return true;
        }

        return false;
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

    public function disableUser($id)
    {
        if ($id) {
            $sql = $this->db->query("UPDATE $this->tableName SET ativo = 0 WHERE id_usuario = $id");
        }
    }

    public function alterDiretoria($data)
    {
        $code = [];
        if ($data) {
            try {
                $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE $this->tableName SET nome = :nome, apelido = :apelido, celular = :celular WHERE id_usuario = :id;";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(':nome', $data['nome']);
                $sql->bindValue(':apelido', $data['apelido']);
                $sql->bindValue(':celular', $data['celular']);
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

    public function insertDiretoriaByPresidente($data)
    {
        $code = [];
        if ($data) {
            try {
                $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO $this->tableName SET nome = :nome, apelido = :apelido, email = :email, senha = :senha, cpf = :cpf, diretoria = 1, aprovado = 1";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(':nome', $data['nome']);
                $sql->bindValue(':apelido', $data['apelido']);
                $sql->bindValue(':email', $data['email']);
                $sql->bindValue(':senha', $data['senha']);
                $sql->bindValue(':cpf', $data['cpf']);
                $sql->execute();
                $code = [
                    'code' => 0,
                    'msg' => 'Cadastro efetuado com sucesso'
                ];
            } catch (\PDOException $th) {
                $code = [
                    'code' => 1062,
                    'msg' => 'Email ou CPF cadastrado',
                    'error' => $th->getMessage()
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

    public function insertUserByDiretoria($data)
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
                    'msg' => 'Email ou CPF já cadastrado',
                    'error' => $th->getMessage()
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
                    'id' => $this->db->lastInsertId(),
                    'msg' => 'Cadastro efetuado com sucesso'
                ];
            } catch (\PDOException $th) {
                $code = [
                    'code' => 1062,
                    'msg' => 'Email e/ou CPF já cadastrado',
                    'error' => $th->getMessage()
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

    public function updateGoalsUser($id)
    {
        $sql = $this->db->query("UPDATE $this->tableName AS a SET a.gols = (a.gols + 1) WHERE id_usuario = $id");
    }

    public function updateAssistsUser($id)
    {
        $sql = $this->db->query("UPDATE $this->tableName AS a SET a.assistencias = (a.assistencias + 1) WHERE id_usuario = $id");
    }

    public function updateFoulsUser($id)
    {
        $sql = $this->db->query("UPDATE $this->tableName AS a SET a.faltas = (a.faltas + 1) WHERE id_usuario = $id");
    }

    public function updateYellowCard($id)
    {
        $sql = $this->db->query("UPDATE $this->tableName AS a SET a.cartoes_amarelos = (a.cartoes_amarelos + 1) WHERE id_usuario = $id");
    }

    public function updateRedCard($id)
    {
        $sql = $this->db->query("UPDATE $this->tableName AS a SET a.cartoes_vermelhos = (a.cartoes_vermelhos + 1) WHERE id_usuario = $id");
    }

    public function updateJogosUser($users)
    {
        foreach ($users as $user) {
            $sql = $this->db->query("UPDATE $this->tableName AS a SET a.jogos = (a.jogos + 1) WHERE id_usuario = $user");
        }
    }
}
