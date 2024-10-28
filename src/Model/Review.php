<?php

namespace App\Model;

use App\Config\Database;

class Review {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function create($question_id, $device_id, $review_response, $review_feedback_text = null) {
        $query = "INSERT INTO reviews (question_id, device_id, review_response, review_feedback_text) 
                  VALUES (:question_id, :device_id, :review_response, :review_feedback_text)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':question_id', $question_id);
        $stmt->bindParam(':device_id', $device_id);
        $stmt->bindParam(':review_response', $review_response);
        $stmt->bindParam(':review_feedback_text', $review_feedback_text);

        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM reviews";
        return $this->executeQuery($query);
    }

    public function getReviewById($id) {
        $query = "SELECT * FROM reviews WHERE review_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch($this->conn::FETCH_ASSOC);
    }

    public function update($review_id, $question_id, $device_id, $review_response, $review_feedback_text = null) {
        $query = "UPDATE reviews 
                  SET question_id = :question_id, 
                      device_id = :device_id, 
                      review_response = :review_response, 
                      review_feedback_text = :review_feedback_text 
                  WHERE review_id = :review_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':review_id', $review_id);
        $stmt->bindParam(':question_id', $question_id);
        $stmt->bindParam(':device_id', $device_id);
        $stmt->bindParam(':review_response', $review_response);
        $stmt->bindParam(':review_feedback_text', $review_feedback_text);

        return $stmt->execute();
    }

    public function delete($review_id) {
        $query = "DELETE FROM reviews WHERE review_id = :review_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':review_id', $review_id);
        return $stmt->execute();
    }

    public function count() {
        $query = "SELECT COUNT(*) AS total FROM reviews";
        $result = $this->executeQuery($query);
        return $result[0]['total'];
    }

    public function executeQuery($query) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll($this->conn::FETCH_ASSOC);
    }
}
