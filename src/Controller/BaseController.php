<?php

namespace App\Controller;

use App\Services\JWTService;

class BaseController
{
    private JWTService $_JWTService;
    private function getJWTService(): JWTService
    {
        if(!isset($this->_JWTService )){
            $this->_JWTService  = new JWTService();
        }
        return $this->_JWTService ;
    }

    protected function validateToken(): false
    {
        $token = $_COOKIE['SESSID'];
        if(empty($token)){
            return false;
        }

        return $this->getJWTService()->validateToken($token) != false;
    }

    protected function createToken($user): string
    {
        return $this->getJWTService()->createToken($user);
    }

    protected function getPayload(): false|array
    {
        $token = $_COOKIE['SESSID'];

        return $this->getJWTService()->validateToken($token);
    }

    protected function isAdmin(): bool
    {
        $payload = $this->getPayload();

        if ($payload && isset($payload['user']->isAdmin)) {
            return (bool) $payload['user']->isAdmin;
        }

        return false;
    }

    protected function getParam(string $key, $default = null)
    {
        return $_REQUEST[$key] ?? $default;
    }

    protected function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function isGet(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    protected function getBody(): array
    {
        if ($this->isPost()) {
            return $_POST;
        }

        return [];
    }

    protected function getQueryParams(): array
    {
        return $_GET;
    }

    protected function forceChangePassword(): bool
    {
        $payload = $this->getPayload();
        return $payload['user']->forceChangePassword;
    }
}