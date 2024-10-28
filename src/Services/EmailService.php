<?php

namespace App\Services;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class EmailService
{
    public static function send($to, $subject, $message): bool
    {
        $mail = new PHPMailer(true);
        try {
            echo 'teste';
            $mail->isSMTP();
            $mail->Host = 'mailhog';
            $mail->SMTPAuth = false;
            $mail->Port = 1025;
            $mail->isHTML(true);
            $mail->setFrom('seuemail@seudominio.local', 'Nome da Empresa');
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->addAddress($to);
            if (!$mail->send()) {
                return false;
            }
            return true;
        } catch (Exception $e) {
            echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
            return false;
        }
    }
}
