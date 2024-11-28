<?php
namespace App\Model;

use App\Config\Database;

class Sector {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function create($sector_name, $sector_description) {
        $query = "INSERT INTO sectors (sector_name, sector_description) VALUES (:sector_name, :sector_description)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sector_name', $sector_name);
        $stmt->bindParam(':sector_description', $sector_description);

        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM sectors";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update($id, $sector_name, $sector_description) {
        $query = "UPDATE sectors SET sector_name = :sector_name, sector_description = :sector_description WHERE sector_id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':sector_name', $sector_name);
        $stmt->bindParam(':sector_description', $sector_description);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM sectors WHERE sector_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
