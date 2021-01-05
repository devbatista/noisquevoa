<?php

namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;
use \PHPMailer\PHPMailer\PHPMailer;

class EmailController extends Controller
{
    public $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer;
    }

    public function esqueciMinhaSenha()
    {
        $code = [];

        if (!$_POST['email']) {
            $code = [
                'code' => 2,
                'msg' => 'Dados não enviados',
            ];

            echo json_encode($code);
            return false;
        }

        $email = $this->retirarAcentos(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));

        $dados = new Usuario();
        $dados = $dados->getByEmail($email);

        if (!$dados) {
            $code = [
                'code' => 3,
                'msg' => 'Email não existente no banco de dados, efetue o cadastro',
            ];

            echo json_encode($code);
            return false;
        }

        $para = $email;
        $id = $dados['id_usuario'];
        $nome = $dados['apelido'];

        $msg = $this->emailBodyEsqueciMinhaSenha($dados);

        try {
            $this->mailer->isSMTP();

            $this->mailer->SMTPAuth = true;

            $this->mailer->CharSet = 'UTF-8';

            $this->mailer->SMTPDebug = 0;
            // Ativar o Debug em 3 para verificar possíveis erros
            // $this->mailer->SMTPDebug = 3; 

            $this->mailer->Username = 'diretoria@noisquevoa.com.br';
            $this->mailer->Password = '@No1sQueVo4#2021';

            $this->mailer->SMTPSecure = 'ssl';

            $this->mailer->Host = 'mail.noisquevoa.com.br';
            $this->mailer->Port = 465;

            $this->mailer->setFrom('diretoria@noisquevoa.com.br', 'Diretoria - Nois Que Voa Sport Clube');
            $this->mailer->addReplyTo('diretoria@noisquevoa.com.br', 'Diretoria - Nois Que Voa Sport Clube');
            $this->mailer->addAddress($para, $nome);

            $this->mailer->isHTML(true);

            // $this->mailer->AddStringEmbeddedImage('https://www.noisquevoa.com.br/assets/img/noisquevoa.png', 'logo_nqv', 'noisquevoa.png');

            $this->mailer->Subject = 'Recuperação de senha - Nois Que Voa SC';
            $this->mailer->Body = $msg;
            $this->mailer->AltBody = $msg;

            if (!$this->mailer->send()) {
                $return = [
                    'code' => 1,
                    'msg' => "Mensagem não enviada, tente novamente",
                    'error' => $this->mailer->ErrorInfo,
                ];
                echo json_encode($return);
                return false;
            } else {
                $return = [
                    'code' => 0,
                    'msg' => "Mensagem enviada com sucesso!"
                ];
                echo json_encode($return);
                return true;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function emailBodyEsqueciMinhaSenha($dados)
    {
        $msg = '<!DOCTYPE html>
        <html lang="pt-br">
        
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Recuperação de senha - Nois Que Voa Sport Clube</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        </head>
        
        <body style="margin:0; padding: 0;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
                <tr>
                    <td align="center" bgcolor="#ee4c50" style="padding: 40px 0 30px 0;">
                        <img src="' . $this->pegarUrl() . '/assets/img/noisquevoa.png" alt="Nois Que Voa SC" width="300" height="230" style="display: block;" />
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px; padding: 20px 0 30px 0;">
                                    <b>Recuperação de senha</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                    Olá, ' . $dados['apelido'] . '! <br><br> Você solicitou alteração de senha através do "Esqueci Minha Senha". <br><br> Para alterar sua senha basta clicar <a href="' . $this->pegarUrl() . '/alterar-minha-senha?email=' . $dados['email'] . '&token=' . $dados['token'] . '">aqui</a> ou copiar e colar o link no seu navegador: <br><br> ' . $this->pegarUrl() . '/alterar-minha-senha?email=' . $dados['email'] . '&token=' . $dados['token'] . '"
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                                    Copyright&reg; Todos os direitos reservados ' . date("Y") . '<br/> Criado e licenciado por <a href="https://www.devbatista.com" style="color:#fff">DevBatista</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        
        </body>
        
        </html>';

        return $msg;
    }

    public function enviarConfirmacaoAprovado($dados)
    {
        $msg = $this->emailBodyConfirmacaoAprovado($dados);

        try {
            $this->mailer->isSMTP();

            $this->mailer->SMTPAuth = true;

            $this->mailer->CharSet = 'UTF-8';

            $this->mailer->SMTPDebug = 0;
            // Ativar o Debug em 3 para verificar possíveis erros
            // $this->mailer->SMTPDebug = 3; 

            $this->mailer->Username = 'diretoria@noisquevoa.com.br';
            $this->mailer->Password = '@No1sQueVo4#2021';

            $this->mailer->SMTPSecure = 'ssl';

            $this->mailer->Host = 'mail.noisquevoa.com.br';
            $this->mailer->Port = 465;

            $this->mailer->setFrom('diretoria@noisquevoa.com.br', 'Diretoria - Nois Que Voa Sport Clube');
            $this->mailer->addReplyTo('diretoria@noisquevoa.com.br', 'Diretoria - Nois Que Voa Sport Clube');
            $this->mailer->addAddress($dados['email'], $dados['nome']);

            $this->mailer->isHTML(true);

            // $this->mailer->AddStringEmbeddedImage('https://www.noisquevoa.com.br/assets/img/noisquevoa.png', 'logo_nqv', 'noisquevoa.png');

            $this->mailer->Subject = 'Aprovação de cadastro - Nois Que Voa SC';
            $this->mailer->Body = $msg;
            $this->mailer->AltBody = $msg;

            if (!$this->mailer->send()) {
                $return = [
                    'code' => 1,
                    'msg' => "Mensagem não enviada, tente novamente",
                    'error' => $this->mailer->ErrorInfo,
                ];
                echo json_encode($return);
                return false;
            } else {
                $return = [
                    'code' => 0,
                    'msg' => "Mensagem enviada com sucesso!"
                ];
                echo json_encode($return);
                return true;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function emailBodyConfirmacaoAprovado($dados)
    {
        $msg = '<!DOCTYPE html>
        <html lang="pt-br">
        
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Aprovação do cadastro - Nois Que Voa Sport Clube</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        </head>
        
        <body style="margin:0; padding: 0;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
                <tr>
                    <td align="center" bgcolor="#ee4c50" style="padding: 40px 0 30px 0;">
                        <img src="' . $this->pegarUrl() . '/assets/img/noisquevoa.png" alt="Nois Que Voa SC" width="300" height="230" style="display: block;" />
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px; padding: 20px 0 30px 0;">
                                    <b>Aprovação do cadastro</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                    Olá, ' . $dados['apelido'] . '! <br><br> Informamos que seu cadastro foi aprovado pela diretoria. <br><br> Seu acesso ao sistema está liberado. <br><br> Email: '.$dados['email'].'<br> Senha: ************ <br><br> Agradecemos por fechar com "Nois" nessa retomada, e pretendemos fazer com que nosso time se transforme em uma família, você é chave importante nessa ideia. <br><br> Atenciosamente, diretoria Nois Que Voa SC
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                                    Copyright&reg; Todos os direitos reservados ' . date("Y") . '<br/> Criado e licenciado por <a href="https://www.devbatista.com" style="color:#fff">DevBatista</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        
        </body>
        
        </html>';

        return $msg;
    }

    public function enviarNovoCadastro($dados)
    {
        $msg = $this->emailBodyNovoCadastro($dados);

        try {
            $this->mailer->isSMTP();

            $this->mailer->SMTPAuth = true;

            $this->mailer->CharSet = 'UTF-8';

            $this->mailer->SMTPDebug = 0;
            // Ativar o Debug em 3 para verificar possíveis erros
            // $this->mailer->SMTPDebug = 3; 

            $this->mailer->Username = 'diretoria@noisquevoa.com.br';
            $this->mailer->Password = '@No1sQueVo4#2021';

            $this->mailer->SMTPSecure = 'ssl';

            $this->mailer->Host = 'mail.noisquevoa.com.br';
            $this->mailer->Port = 465;

            $this->mailer->setFrom('diretoria@noisquevoa.com.br', 'Diretoria - Nois Que Voa Sport Clube');
            $this->mailer->addReplyTo('diretoria@noisquevoa.com.br', 'Diretoria - Nois Que Voa Sport Clube');
            $this->mailer->addAddress($dados['email'], $dados['nome']);
            $this->mailer->addCC('batist11@gmail.com', 'Rafael Batista');
            $this->mailer->addCC('alvescassio20@gmail.com', 'Cassio Lima');

            $this->mailer->isHTML(true);

            // $this->mailer->AddStringEmbeddedImage('https://www.noisquevoa.com.br/assets/img/noisquevoa.png', 'logo_nqv', 'noisquevoa.png');

            $this->mailer->Subject = 'Usuário cadastrado - Nois Que Voa SC';
            $this->mailer->Body = $msg;
            $this->mailer->AltBody = $msg;

            if (!$this->mailer->send()) {
                $return = [
                    'code' => 1,
                    'msg' => "Mensagem não enviada, tente novamente",
                    'error' => $this->mailer->ErrorInfo,
                ];
                echo json_encode($return);
                return false;
            } else {
                $return = [
                    'code' => 0,
                    'msg' => "Mensagem enviada com sucesso!"
                ];
                echo json_encode($return);
                return true;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function emailBodyNovoCadastro($dados)
    {
        $msg = '<!DOCTYPE html>
        <html lang="pt-br">
        
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Usuário cdastrado - Nois Que Voa Sport Clube</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        </head>
        
        <body style="margin:0; padding: 0;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
                <tr>
                    <td align="center" bgcolor="#ee4c50" style="padding: 40px 0 30px 0;">
                        <img src="' . $this->pegarUrl() . '/assets/img/noisquevoa.png" alt="Nois Que Voa SC" width="300" height="230" style="display: block;" />
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px; padding: 20px 0 30px 0;">
                                    <b>Novo usuário cadastrado</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                    Atenção, Diretoria! <br><br> Há um novo cadastro aguardando aprovação. <br><br> <b>Nome: </b>'.$dados['nome'].'<br> <b>Email: </b>'.$dados['email'].'<br> <b>CPF: </b>'.$dados['cpf'].'<br> <b>Celular: </b>'.$dados['celular'].' <br><br> Clique <a href="' . $this->pegarUrl() . '/admin/elenco">aqui</a> para ver o cadastro ou copie e cole o link no navegador.<br>' . $this->pegarUrl() . '/admin/elenco
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                                    Copyright&reg; Todos os direitos reservados ' . date("Y") . '<br/> Criado e licenciado por <a href="https://www.devbatista.com" style="color:#fff">DevBatista</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        
        </body>
        
        </html>';

        return $msg;
    }
}
