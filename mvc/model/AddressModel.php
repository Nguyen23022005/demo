<?php
require_once "Database.php";

class AddressModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllAddresses() {
        $query = "SELECT * FROM addresses ORDER BY selected DESC, id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function saveSelectedAddress($selectedAddressId) {
        // Đặt tất cả các địa chỉ thành không được chọn
        $query = "UPDATE addresses SET selected = 0";
        $this->conn->exec($query);
    
        // Đặt địa chỉ được chọn thành 1
        if (!empty($selectedAddressId)) {
            $query = "UPDATE addresses SET selected = 1 WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$selectedAddressId]);
        }
    }

    public function createAddress($userId, $name, $street, $city, $state, $zipcode) {
        $query = "INSERT INTO addresses (user_id, name, street, city, state, zipcode) 
                  VALUES (:user_id, :name, :street, :city, :state, :zipcode)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId); // Truyền user_id
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':zipcode', $zipcode);
        return $stmt->execute();
    }

    public function getAddressById($id) {
        $query = "SELECT * FROM addresses WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateAddress($id, $name, $street, $city, $state, $zipcode) {
        $query = "UPDATE addresses SET name = :name, street = :street, city = :city, state = :state, zipcode = :zipcode WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':zipcode', $zipcode);
        return $stmt->execute();
    }

    public function deleteAddress($id) {
        $query = "DELETE FROM addresses WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}