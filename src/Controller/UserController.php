<?php

namespace App\Controller;

use App\Model\User;
use App\Services\EmailService;
use Random\RandomException;

class UserController extends BaseController
{
    private readonly ?User $_User;

    private function getUserModel(): User
    {
        if (!isset($this->_User)) {
            $this->_User = new User();
        }
        return $this->_User;
    }

    public function list()
    {
        if ($this->forceChangePassword()) {
            header("Location:/change-password");
            exit();
        }
        $users = $this->getUserModel()->read();
        require __DIR__.'/../View/admin-user.php';
    }

    /**
     * @throws RandomException
     */
    public function create()
    {
        if (!$this->isAdmin()) {
            http_response_code(401);
            throw new \Exception('Você não tem permissão para isso');
        }

        $user_name = $this->getParam('name');
        $user_email = $this->getParam('email');

        if (empty($user_name) || empty($user_email)) {
            throw new \Exception("Por favor, preencha todos os campos obrigatórios.");
        }

        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Email inválido');
        }

        $user_password = bin2hex(random_bytes(4));
        $subject = "Bem-vindo ao nosso sistema";
        $message = "
                    <html>
                    <head>
                        <title>Bem-vindo ao nosso sistema</title>
                    </head>
                    <body>
                        <h1>Olá, $user_name!</h1>
                        <p>Bem-vindo ao nosso sistema! Sua senha é: <strong>$user_password</strong></p>
                        <p>Por favor, mantenha sua senha em segredo.</p>
                        <p>Atenciosamente,<br>Sua equipe</p>
                    </body>
                    </html>
                    ";

        if (EmailService::send($user_email, $subject, $message)) {
            if ($this->getUserModel()->create($user_name, $user_email, $user_password)) {
                header('Location: /admin/user');
                exit();
            } else {
                throw new \Exception("Falha ao criar o usuário. Por favor, contate o suporte.");
            }
        } else {
            throw new \Exception("Falha ao enviar e-mail. Tente novamente mais tarde.");
        }
    }

    public function changePassword(){
        if ($this->isGet()) {
            require_once __DIR__.'/../View/change-password.php';
            exit();
        }
        $payload = $this->getPayload();
        $user = $this->getUserModel()->getUserByEmail($payload['user']->email);
        if(!$user){
            throw new \Exception('Desculpe, seu usuario não foi encontrado!');
        }
        $password = $this->getParam('current_password');
        if(!password_verify($password, $user['user_password'])){
            throw new \Exception('Senha informada para o usuario atual invalida!');
        }
        $newPassword = $this->getParam('new_password');
        if(!isset($newPassword)){
            throw new \Exception('Nova senha não informada!');
        }
        if(!$this->getUserModel()->update($user['user_id'], $user['user_name'], $user['user_email'], $newPassword, false)){
            throw new \Exception('Erro atualizar a senha!');
        }
        header('Location: /admin/user');
    }
}
