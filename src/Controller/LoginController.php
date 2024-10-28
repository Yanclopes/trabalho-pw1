<?php

namespace App\Controller;

use App\Model\User;
use App\Services\JWTService;

class LoginController extends BaseController
{
    private User $_User;

    private function getUserModel(): User
    {
        if(!isset($this->_User )){
            $this->_User  = new User();
        }
        return $this->_User ;
    }

    /**
     * @throws \Exception
     */
    public function login(){
        if($this->isGet()){
           require __DIR__ . '/../View/login.php';
           return;
        }

        $email = $this->getParam('email');
        $password =  $this->getParam("password");

        if(!isset($email) || !isset($password)) {
           throw new \Exception("Email e senha são obrigatorios!");
        }

        if(!$this->getUserModel()->emailExists($email)) {
           throw new \Exception("Email não encontrado!");
        }

        $user = $this->getUserModel()->getUserByEmail($email);
        if(!password_verify($password, $user['user_password'])) {
           throw new \Exception("Senha invalida!");
        }
        $userData = [
            'id' => $user['user_id'],
            'email' => $user['user_email'],
            'name' => $user['user_name'],
            'isAdmin' => $user['user_is_admin'],
            'createdAt' => $user['user_created_at'],
            'forceChangePassword' => $user['user_force_change_password']
        ];
        
        $token = $this->createToken($userData);

        setcookie('SESSID', $token, time() + 3600, "/", "", true, true);

        if ($this->forceChangePassword()) {
            header("Location:/change-password");
            exit();
        }
        header("Location:/admin/user");
    }
}