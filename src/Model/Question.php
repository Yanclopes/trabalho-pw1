<?php
namespace App\Model;
use App\Config\Database;

class Question {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function getQuestionById($id){
        $query = "
        SELECT * FROM questions 
        WHERE question_id = :id
        LIMIT 1
    ";

        $stmt = $this->conn->prepare($query);
        $id = intval($id);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch($this->conn::FETCH_ASSOC);
    }

    public function getNextQuestion(string $id) {
        $query = "
        SELECT * FROM questions 
        WHERE question_status = 'ativa'
        AND question_id > :id
        LIMIT 1
    ";

        $stmt = $this->conn->prepare($query);
        $id = intval($id);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch($this->conn::FETCH_ASSOC);
    }


    public function create($text, $status) {
        $query = "INSERT INTO questions (texto_pergunta, status) VALUES (:text, :status)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':status', $status);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function executeQuery($query) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll($this->conn::FETCH_ASSOC);
    }

    public function read() {
        $query = "SELECT * FROM questions";
        return $this->executeQuery($query);
    }

    public function getActivesQuestions() {
        $query = "SELECT * FROM questions WHERE status = 'ativa'";
        return $this->executeQuery($query);
    }

    public function count() {
        $query = "SELECT COUNT(*) AS total FROM questions";
        $result = $this->executeQuery($query);
        return $result['total'];
    }

    public function update($id, $text, $status) {
        $query = "UPDATE questions SET question_text = :text, question_status = :status WHERE question_id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM questions WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

