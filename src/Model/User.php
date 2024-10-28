<?php

namespace App\Model;

use App\Config\Database;

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function emailExists($user_email) {
        $query = "SELECT COUNT(*) AS count FROM users WHERE user_email = :user_email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_email', $user_email);
        $stmt->execute();
        $result = $stmt->fetch($this->conn::FETCH_ASSOC);
        return $result['count'] > 0;
    }


    public function create($user_name, $user_email, $user_password) {
        $query = "INSERT INTO users (user_name, user_email, user_password) 
                  VALUES (:user_name, :user_email, :user_password)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_name', $user_name);
        $stmt->bindParam(':user_email', $user_email);
        $password_hash = password_hash($user_password, PASSWORD_DEFAULT);
        $stmt->bindParam(':user_password', $password_hash);

        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT user_id, user_name, user_email, user_created_at, user_is_admin FROM users"; // Não retorna a senha
        return $this->executeQuery($query);
    }

    public function getUserById($id) {
        $query = "SELECT user_id, user_name, user_email, user_created_at, user_is_admin FROM users WHERE user_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch($this->conn::FETCH_ASSOC);
    }

    public function getUserByEmail($email) {
        $query = "SELECT user_id, user_name, user_email, user_created_at, user_is_admin, user_password, user_force_change_password FROM users WHERE user_email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch($this->conn::FETCH_ASSOC);
    }

    public function update($user_id, $user_name, $user_email, $user_password = null, $user_force_change_password = null) {
        $query = "UPDATE users 
                  SET user_name = :user_name, 
                      user_email = :user_email" .
            ($user_password ? ", user_password = :user_password" : "") .
            (isset($user_force_change_password) ? ", user_force_change_password = :user_force_change_password" : "") .
            " WHERE user_id = :user_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':user_name', $user_name);
        $stmt->bindParam(':user_email', $user_email);
        if ($user_password) {
            $password_hash = password_hash($user_password, PASSWORD_DEFAULT);
            $stmt->bindParam(':user_password', $password_hash);
        }
        if (isset($user_force_change_password)) {
            $user_force_change_password = (bool)$user_force_change_password ? 1 : 0; // Converte true/false para 1/0
            $stmt->bindParam(':user_force_change_password', $user_force_change_password, \PDO::PARAM_INT);
        }

        return $stmt->execute();
    }

    public function delete($user_id) {
        $query = "DELETE FROM users WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    public function count() {
        $query = "SELECT COUNT(*) AS total FROM users";
        $result = $this->executeQuery($query);
        return $result[0]['total'];
    }

    public function executeQuery($query) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll($this->conn::FETCH_ASSOC);
    }
}
