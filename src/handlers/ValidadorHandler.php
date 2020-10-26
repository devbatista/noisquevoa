<?php

namespace src\handlers;

class ValidadorHandler
{
    public static function validarNome($nome)
    {
        if ($nome) {
            return true;
        } else {
            return false;
        }
    }

    public static function validarApelido($apelido)
    {
        if ($apelido) {
            return true;
        } else {
            return false;
        }
    }

    public static function validarEmail($email)
    {
        if ($email) {
            return true;
        } else {
            return false;
        }
    }

    public static function validarSenha($senha, $confirma)
    {
        if ($senha && $confirma) {
            if (strlen($senha)) {
                if (password_verify($confirma, $senha)) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function validarCPF($cpf)
    {
        if (empty($cpf)) {
            return false;
        }

        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        if (strlen($cpf) != 11) {
            return false;
        } else if (
            $cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999'
        ) {
            return false;
        } else {

            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    return false;
                }
            }

            return true;
        }
    }

    public static function validarCelular($cel)
    {
        if (strlen($cel) == 15) {
            return true;
        } else {
            return false;
        }
    }

    public static function validarTipo($jogador, $diretoria, $posicao)
    {
        if ((!$jogador && !$diretoria && !$posicao) || ($jogador && !$posicao)) {
            return false;
        } else {
            return true;
        }
    }

    public static function validarNascimento($dtNascimento)
    {
        $dtNascimento = explode('-', $dtNascimento);
        $retorno = checkdate($dtNascimento[1], $dtNascimento[2], $dtNascimento[0]);
        return $retorno;
    }
}
