<?php
require_once "Database.php";

class ProductModel {
    private $conn;
    

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllProducts() {
        $query = "SELECT * FROM products";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllProductsHome() {
        $query = "SELECT * FROM products";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //sản phẩm liên quan
    public function getProductById1() {
        $query = "SELECT * FROM products";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
       
    
    public function getRelatedProducts($categoryId, $excludeProductId) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE category_id = ? AND id != ? LIMIT 4");
        $stmt->execute([$categoryId, $excludeProductId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getProductById($id) {
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createProduct($name, $description, $price, $image) {
        $query = "INSERT INTO products (name, description, price, image) VALUES (:name, :description, :price, :image)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        return $stmt->execute();
    }

    public function updateProduct($id, $name, $description, $price, $image) {
        $query = "UPDATE products SET name = :name, description = :description, price = :price WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        return $stmt->execute();
    }

    public function deleteProduct($id) {
        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function searchProducts($name) {
        $query = "SELECT * FROM products WHERE name LIKE :name OR description LIKE :name";
        $stmt = $this->conn->prepare($query);
        $likename = '%' . $name . '%';
        $stmt->bindParam(':name', $likename, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    public function filterProducts($price = null) {
        // Khởi tạo truy vấn với mệnh đề WHERE 1 để có thể nối thêm điều kiện
        $query = "SELECT * FROM products WHERE 1";
        
        // Thêm điều kiện lọc theo giá
        if ($price) {
            if ($price === 'low') {
                $query .= " AND price < 50";
            } elseif ($price === 'mid') {
                $query .= " AND price BETWEEN 50 AND 100";
            } elseif ($price === 'high') {
                $query .= " AND price > 100";
            }
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>