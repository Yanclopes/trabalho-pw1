<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTService
{
    private $secretKey;
    private $algorithm;

    public function __construct()
    {
        $this->secretKey = $_ENV['SECRET_KEY'];
        $this->algorithm = 'HS256';
    }

    public function createToken($userData, $expirationTime = 3600)
    {
        $payload = [
            'iat' => time(),
            'exp' => time() + $expirationTime,
            'user' => $userData,
        ];

        return JWT::encode($payload, $this->secretKey, $this->algorithm);
    }

    public function validateToken($token)
    {
        if (!$token) {
            header('location: /login');
        }
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, $this->algorithm));
            return (array) $decoded;
        } catch (\Exception $e) {
            return false;
        }
    }
}
