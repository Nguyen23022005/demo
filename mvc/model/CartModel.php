<?php
require_once "Database.php";

class CartModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getCart($user_id, $session_id) {
        $condition = !empty($user_id) ? "user_id = :user_id" : "cart_session = :cart_session";
        
        $query = "SELECT * FROM carts INNER JOIN product_variantss ON carts.sku = product_variantss.sku WHERE $condition";

        $stmt = $this->conn->prepare($query);
        if (!empty($user_id)) {
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        } else {
            $stmt->bindParam(':cart_session', $session_id, PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function addCart($user_id, $cart_session, $sku, $quantityy, $price) {
        $query = "INSERT INTO carts (user_id, cart_session, sku, quantityy, price) VALUES (:user_id, :cart_session, :sku, :quantityy, :price)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':cart_session', $cart_session, PDO::PARAM_STR);
        $stmt->bindParam(':sku', $sku, PDO::PARAM_STR);
        $stmt->bindParam(':quantityy', $quantityy, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteCart($id_Cart) {
        $query = "DELETE FROM carts WHERE id_Cart = :id_Cart";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_Cart', $id_Cart, PDO::PARAM_INT);
        
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }
    public function clearCart($user_id, $cart_session)
    {
        $condition = !empty($user_id) ? "user_id = :user_id" : "cart_session = :cart_session";

        $query = "DELETE FROM carts WHERE $condition";
        $stmt = $this->conn->prepare($query);
        if (!empty($user_id)) {
            $stmt->bindParam(':user_id', $user_id);
        } else {
            $stmt->bindParam(':cart_session', $cart_session);
        }
        return $stmt->execute();
    }
    

    public function updateQuantity($id_Cart, $quantityy) {
        $query = "UPDATE carts SET quantityy = :quantityy WHERE id_Cart = :id_Cart";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':quantityy', $quantityy, PDO::PARAM_INT);
        $stmt->bindParam(':id_Cart', $id_Cart, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function removeCart($user_id, $session_id) {
        $condition = !empty($user_id) ? "user_id = :user_id" : "cart_session = :cart_session";
        
        $query = "DELETE FROM carts WHERE $condition";
        $stmt = $this->conn->prepare($query);
        if (!empty($user_id)) {
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        } else {
            $stmt->bindParam(':cart_session', $session_id, PDO::PARAM_STR);
        }
        return $stmt->execute();
    }
}
