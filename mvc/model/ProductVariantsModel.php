<?php
require_once "Database.php";

class ProductVariantModel {
    private $conn;
    

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM products_variantss WHERE productvarian_id = :productvarian_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkExistSku($sku) {
        $query = "SELECT * FROM product_variantss WHERE sku = :sku";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sku', $sku);
        $stmt->execute();
        return ($stmt->fetchColumn() > 0);
    }
    
    public function getVariantByProductId1() {
        $query = "SELECT * FROM product_variantss";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVariantByProductId($productId) {
        $query = "SELECT *, c.name as colorName, s.name as sizeName
         FROM product_variantss p INNER JOIN colors c on p.colorId = c.id
            INNER JOIN sizes s on p.sizeId = s.id
         WHERE p.productvarian_id = :productId ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':productId', $productId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createVariants($productvarian_id, $colorId, $sizeId, $image, $quantity, $price, $sku) {
        $query = "INSERT INTO product_variantss (productvarian_id, colorId, sizeId,image, quantity,price,sku) VALUES (:productvarian_id, :colorId, :sizeId, :image, :quantity, :price, :sku)";
        $stmt = $this->conn->prepare($query);   
        $stmt->bindParam(':productvarian_id', $productvarian_id);
        $stmt->bindParam(':colorId', $colorId);
        $stmt->bindParam(':sizeId', $sizeId);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':sku', $sku);
        return $stmt->execute();

    }

    // public function updateProduct($id, $name, $description, $price) {
    //     $query = "UPDATE products SET name = :name, description = :description, price = :price WHERE id = :id";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(':id', $id);
    //     $stmt->bindParam(':name', $name);
    //     $stmt->bindParam(':description', $description);
    //     $stmt->bindParam(':price', $price);
    //     return $stmt->execute();
    // }

    // public function deleteProduct($id) {
    //     $query = "DELETE FROM products WHERE id = :id";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(':id', $id);
    //     return $stmt->execute();
    // }
}
?>