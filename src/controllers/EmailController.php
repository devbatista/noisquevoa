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

        if(!$_POST['email']) {
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

        if(!$dados) {
            $code = [
                'code' => 1,
                'msg' => 'Email não existente no banco de dados, efetue o cadastro',
            ];

            echo json_encode($code);
            return false;
        }

        $para = $email;
        $id = $dados['id_usuario'];
        $nome = $dados['apelido'];

        $msg = $this->emailBody();

        try {
            $this->mailer->SMTPAuth = true;

            $this->mailer->SMTPDebug = 0;
            // Ativar o Debug em 3 para verificar possíveis erros
            // $this->mailer->SMTPDebug = 3; 

            $this->mailer->Username = 'diretoria@noisquevoa.com.br';
            $this->mailer->Password = 'showdebola#10';

            $this->mailer->SMTPSecure = 'ssl';

            $this->mailer->Host = 'mail.noisquevoa.com.br';
            $this->mailer->Port = 465;

            $this->mailer->setFrom('diretoria@noisquevoa.com.br', 'Diretoria - Nois Que Voa Sport Clube');
            $this->mailer->addReplyTo('diretoria@noisquevoa.com.br', 'Diretoria - Nois Que Voa Sport Clube');
            $this->mailer->addAddress($para, $nome);

            $this->mailer->isHTML(true);

            $this->mailer->Subject = 'Envio de email com PHPMailer';
            $this->mailer->Body = $msg;
            $this->mailer->AltBody = $msg;

            if (!$this->mailer->send()) {
                $return = [
                    'code' => 1,
                    'msg' => "Mensagem não enviada, tente novamente"
                ];
                echo json_encode($return);
            } else {
                $return = [
                    'code' => 0,
                    'msg' => "Mensagem enviada com sucesso!"
                ];
                echo json_encode($return);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function emailBody()
    {
        $msg = '';

        return $msg;
    }

    public function enviarPHPMailer()
    {
        $mailer = new PHPMailer;

        $para = $_POST['para'];
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        $msg = "Dados do usuário<br>";
        $msg .= "id: " . $id . "<br>";
        $msg .= "nome: " . $nome . "<br>";
        $msg .= "email: " . $email;

        try {
            $mailer->isSMTP();
            $mailer->SMTPAuth = true;

            $mailer->SMTPDebug = 0;
            // Ativar o Debug em 3 para verificar possíveis erros
            // $mailer->SMTPDebug = 3; 

            $mailer->Username = 'rafael@devbatista.com.br';
            $mailer->Password = 'showdebola#10';

            $mailer->SMTPSecure = 'ssl';

            $mailer->Host = 'mail.devbatista.com.br';
            $mailer->Port = 465;

            $mailer->setFrom('rafael@devbatista.com.br', 'Rafael Batista');
            $mailer->addReplyTo('rafael@devbatista.com.br', 'Rafael Batista');
            $mailer->addAddress($para, $nome);

            $mailer->isHTML(true);

            $mailer->Subject = 'Envio de email com PHPMailer';
            $mailer->Body = $msg;
            $mailer->AltBody = $msg;

            if (!$mailer->send()) {
                $return = [
                    'code' => 1,
                    'msg' => "Mensagem não enviada, tente novamente"
                ];
                echo json_encode($return);
            } else {
                $return = [
                    'code' => 0,
                    'msg' => "Mensagem enviada com sucesso!"
                ];
                echo json_encode($return);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function enviarMail()
    {
        $para = $_POST['para'];
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        $subject = "Envio de email com MAIL()";

        $msg = "Dados do usuário<br>";
        $msg .= "id: " . $id . "<br>";
        $msg .= "nome: " . $nome . "<br>";
        $msg .= "email: " . $email;

        $headers = 'From: batist11@gmail.com' . "\r\n";
        $headers .= 'Reply-To: batist11@gmail.com' . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();

        if (mail($para, $subject, $msg, $headers)) {
            $code = [
                'code' => 0,
                'msg' => 'Email enviado com sucesso'
            ];
        } else {
            $code = [
                'code' => 1,
                'msg' => 'Falha no envio do email, tente novamente'
            ];
        }

        echo json_encode($code);
    }
}
