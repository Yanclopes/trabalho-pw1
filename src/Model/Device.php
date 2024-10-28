<?php
namespace App\Model;

use App\Config\Database;

class Device {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function create($sector_id, $device_name, $device_status) {
        $query = "INSERT INTO devices (sector_id, device_name, device_status) VALUES (:sector_id, :device_name, :device_status)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sector_id', $sector_id);
        $stmt->bindParam(':device_name', $device_name);
        $stmt->bindParam(':device_status', $device_status);

        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM devices";
        return $this->executeQuery($query);
    }

    public function getById($id) {
        $query = "SELECT * FROM devices WHERE device_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch($this->conn::FETCH_ASSOC);
    }

    public function update($id, $sector_id, $device_name, $device_status) {
        $query = "UPDATE devices SET sector_id = :sector_id, device_name = :device_name, device_status = :device_status WHERE device_id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':sector_id', $sector_id);
        $stmt->bindParam(':device_name', $device_name);
        $stmt->bindParam(':device_status', $device_status);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM devices WHERE device_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function executeQuery($query) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll($this->conn::FETCH_ASSOC);
    }

    public function getActiveDevices($id = null) {
        $query = "SELECT * FROM devices WHERE device_status = 'ativo'";
        if (isset($id)) {
            $query .= " AND sector_id = :id";
        }
        $stmt = $this->conn->prepare($query);
        if (isset($id)) {
            $stmt->bindParam(':id', $id, $this->conn::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll($this->conn::FETCH_ASSOC);
    }

    public function getInactiveDevices() {
        $query = "SELECT * FROM devices WHERE device_status = 'inativo'";
        return $this->executeQuery($query);
    }

    public function count() {
        $query = "SELECT COUNT(*) AS total FROM devices";
        $result = $this->executeQuery($query);
        return $result[0]['total']; // Certifique-se de acessar o índice correto
    }
}
