<?php

namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;
use \src\Config;
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

            $this->mailer->Username = Config::EMAIL_SENDER;
            $this->mailer->Password = Config::EMAIL_PASS;

            $this->mailer->SMTPSecure = Config::EMAIL_SMTP_SECURE;

            $this->mailer->Host = Config::EMAIL_SMTP_HOST;
            $this->mailer->Port = Config::EMAIL_SMTP_PORT;

            $this->mailer->setFrom(Config::EMAIL_SENDER, 'Diretoria - ' . Config::NOME_DO_TIME_COMPLETO);
            $this->mailer->addReplyTo(Config::EMAIL_SENDER, 'Diretoria ' . Config::NOME_DO_TIME_COMPLETO);
            $this->mailer->addAddress($para, $nome);

            $this->mailer->isHTML(true);

            $this->mailer->Subject = 'Recuperação de senha - ' . Config::NOME_DO_TIME;
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
            <title>Recuperação de senha - ' . Config::NOME_DO_TIME_COMPLETO . '</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        </head>
        
        <body style="margin:0; padding: 0;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
                <tr>
                    <td align="center" bgcolor="' . Config::EMAIL_BG_COLOR . '" style="padding: 40px 0 30px 0;">
                        <img src="' . $this->pegarUrl() . Config::LOGO_TIME . '" alt="' . Config::NOME_DO_TIME . '" width="300" height="230" style="display: block;" />
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
                    <td bgcolor="' . Config::EMAIL_BG_COLOR . '" style="padding: 30px 30px 30px 30px;">
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

            $this->mailer->Username = Config::EMAIL_SENDER;
            $this->mailer->Password = Config::EMAIL_PASS;

            $this->mailer->SMTPSecure = Config::EMAIL_SMTP_SECURE;

            $this->mailer->Host = Config::EMAIL_SMTP_HOST;
            $this->mailer->Port = Config::EMAIL_SMTP_PORT;

            $this->mailer->setFrom(Config::EMAIL_SENDER, 'Diretoria - ' . Config::NOME_DO_TIME_COMPLETO);
            $this->mailer->addReplyTo(Config::EMAIL_SENDER, 'Diretoria - ' . Config::NOME_DO_TIME_COMPLETO);
            $this->mailer->addAddress($dados['email'], $dados['nome']);

            $this->mailer->isHTML(true);

            $this->mailer->Subject = 'Aprovação de cadastro - ' . Config::NOME_DO_TIME;
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
            <title>Aprovação do cadastro - ' . Config::NOME_DO_TIME_COMPLETO . '</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        </head>
        
        <body style="margin:0; padding: 0;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
                <tr>
                    <td align="center" bgcolor="' . Config::EMAIL_BG_COLOR . '" style="padding: 40px 0 30px 0;">
                        <img src="' . $this->pegarUrl() . Config::LOGO_TIME . '" alt="' . Config::NOME_DO_TIME . '" width="300" height="230" style="display: block;" />
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
                                    Olá, ' . $dados['apelido'] . '! <br><br> Informamos que seu cadastro foi aprovado pela diretoria. <br><br> Seu acesso ao sistema está liberado. <br><br> Email: ' . $dados['email'] . '<br> Senha: ************ <br><br> Agradecemos por fechar com "Nois" nessa retomada, e pretendemos fazer com que nosso time se transforme em uma família, você é chave importante nessa ideia. <br><br> Atenciosamente, diretoria ' . Config::NOME_DO_TIME_COMPLETO . '
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="' . Config::EMAIL_BG_COLOR . '" style="padding: 30px 30px 30px 30px;">
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

            $this->mailer->Username = Config::EMAIL_SENDER;
            $this->mailer->Password = Config::EMAIL_PASS;

            $this->mailer->SMTPSecure = Config::EMAIL_SMTP_SECURE;

            $this->mailer->Host = Config::EMAIL_SMTP_HOST;
            $this->mailer->Port = Config::EMAIL_SMTP_PORT;

            $this->mailer->setFrom(Config::EMAIL_SENDER, 'Diretoria - ' . Config::NOME_DO_TIME_COMPLETO);
            $this->mailer->addReplyTo(Config::EMAIL_SENDER, 'Diretoria - ' . Config::NOME_DO_TIME_COMPLETO);
            $this->mailer->addAddress(Config::EMAIL_SENDER, 'Diretoria - ' . Config::NOME_DO_TIME_COMPLETO);
            $this->mailer->addCC('batist11@gmail.com', 'Rafael Batista');
            // $this->mailer->addCC('alvescassio20@gmail.com', 'Cassio Lima');

            $this->mailer->isHTML(true);

            $this->mailer->Subject = 'Usuário cadastrado - ' . Config::NOME_DO_TIME;
            $this->mailer->Body = $msg;
            $this->mailer->AltBody = $msg;

            if (!$this->mailer->send()) {
                return false;
            } else {
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
            <title>Usuário cadastrado - ' . Config::NOME_DO_TIME_COMPLETO . '</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        </head>
        
        <body style="margin:0; padding: 0;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
                <tr>
                    <td align="center" bgcolor="' . Config::EMAIL_BG_COLOR . '" style="padding: 40px 0 30px 0;">
                        <img src="' . $this->pegarUrl() . Config::LOGO_TIME . '" alt="' . Config::NOME_DO_TIME . '" width="300" height="230" style="display: block;" />
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
                                    Atenção, Diretoria! <br><br> Há um novo cadastro aguardando aprovação. <br><br> <b>Nome: </b>' . $dados['nome'] . '<br> <b>Email: </b>' . $dados['email'] . '<br> <b>CPF: </b>' . $dados['cpf'] . '<br> <b>Celular: </b>' . $dados['celular'] . ' <br><br> Clique <a href="' . $this->pegarUrl() . '/admin/elenco">aqui</a> para ver o cadastro ou copie e cole o link no navegador.<br>' . $this->pegarUrl() . '/admin/elenco
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="' . Config::EMAIL_BG_COLOR . '" style="padding: 30px 30px 30px 30px;">
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

    public function enviarConvite()
    {
        $code = [];

        if (!$_POST['convite'] && !$_POST['nomeConvite']) {
            $code = [
                'code' => 2,
                'msg' => 'Dados não enviados',
            ];

            echo json_encode($code);
            return false;
        }

        $email = $this->retirarAcentos(filter_input(INPUT_POST, 'convite', FILTER_VALIDATE_EMAIL));
        $nome = $this->retirarAcentos(filter_input(INPUT_POST, 'nomeConvite', FILTER_SANITIZE_STRING));

        $dados = $_SESSION['logado'];

        $para = $email;
        $id = $dados['id_usuario'];
        $getNome = $dados['nome'];

        $getNome = explode(' ', $getNome);
        $sender = $getNome[0];

        $msg = $this->emailBodyEnviarConvite($nome, $sender);

        try {
            $this->mailer->isSMTP();

            $this->mailer->SMTPAuth = true;

            $this->mailer->CharSet = 'UTF-8';

            $this->mailer->SMTPDebug = 0;
            // Ativar o Debug em 3 para verificar possíveis erros
            // $this->mailer->SMTPDebug = 3; 

            $this->mailer->Username = Config::EMAIL_SENDER;
            $this->mailer->Password = Config::EMAIL_PASS;

            $this->mailer->SMTPSecure = Config::EMAIL_SMTP_SECURE;

            $this->mailer->Host = Config::EMAIL_SMTP_HOST;
            $this->mailer->Port = Config::EMAIL_SMTP_PORT;

            $this->mailer->setFrom(Config::EMAIL_SENDER, 'Diretoria - ' . Config::NOME_DO_TIME_COMPLETO);
            $this->mailer->addReplyTo(Config::EMAIL_SENDER, 'Diretoria - ' . Config::NOME_DO_TIME_COMPLETO);
            $this->mailer->addAddress($para, $nome);

            $this->mailer->isHTML(true);

            $this->mailer->Subject = 'Convite de cadastro - ' . Config::NOME_DO_TIME;
            $this->mailer->Body = $msg;
            $this->mailer->AltBody = $msg;

            if (!$this->mailer->send()) {
                $return = [
                    'code' => 1,
                    'msg' => "Convite não enviado, tente novamente",
                    'error' => $this->mailer->ErrorInfo,
                ];
                echo json_encode($return);
                return false;
            } else {
                $return = [
                    'code' => 0,
                    'msg' => "Convite enviado com sucesso!"
                ];
                echo json_encode($return);
                return true;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function emailBodyEnviarConvite($nome, $sender)
    {
        $msg = '<!DOCTYPE html>
        <html lang="pt-br">
        
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Usuário cadastrado - ' . Config::NOME_DO_TIME_COMPLETO . '</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        </head>
        
        <body style="margin:0; padding: 0;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
                <tr>
                    <td align="center" bgcolor="' . Config::EMAIL_BG_COLOR . '" style="padding: 40px 0 30px 0;">
                        <img src="' . $this->pegarUrl() . Config::LOGO_TIME . '" alt="' . Config::NOME_DO_TIME_COMPLETO . '" width="300" height="230" style="display: block;" />
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px; padding: 20px 0 30px 0;">
                                    <b>Convite para cadastro</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                    Olá, ' . $nome . '! <br><br> Você recebeu um convite do diretor ' . $sender . ' para realizar o cadastro em nosso sistema. <br><br> Clique <a href="' . $this->pegarUrl() . '/cadastro">aqui</a> para realizar seu cadastro ou copie e cole o link no navegador.<br>' . $this->pegarUrl() . '/cadastro
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="' . Config::EMAIL_BG_COLOR . '" style="padding: 30px 30px 30px 30px;">
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
