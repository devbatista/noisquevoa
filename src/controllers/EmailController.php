<?php

namespace src\controllers;

use \core\Controller;
use \PHPMailer\PHPMailer\PHPMailer;

class EmailController extends Controller
{
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
