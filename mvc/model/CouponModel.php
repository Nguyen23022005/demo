<?php
require_once "Database.php";

class CouponModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Lấy danh sách tất cả coupon
   public function getCoupons()
    {
        $query = "SELECT * FROM coupons";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCouponById($id)
    {
        $query = "SELECT * FROM coupons WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    // Thêm coupon mới
    public function addCoupon($code, $discount, $discountType, $startDate, $endDate, $usageLimit = null)
    {
        $query = "INSERT INTO coupons (code, discount, discount_type, start_date, end_date, usage_limit) 
                  VALUES (:code, :discount, :discount_type, :start_date, :end_date, :usage_limit)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':discount', $discount);
        $stmt->bindParam(':discount_type', $discountType);
        $stmt->bindParam(':start_date', $startDate);
        $stmt->bindParam(':end_date', $endDate);
        // Nếu $usageLimit là null, sử dụng PDO::PARAM_NULL, ngược lại sử dụng số nguyên
        if ($usageLimit === null) {
            $stmt->bindValue(':usage_limit', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindParam(':usage_limit', $usageLimit, PDO::PARAM_INT);
        }
        return $stmt->execute();
    }
    

    // Cập nhật coupon
    public function updateCoupon($id, $code, $discount, $discountType, $startDate, $endDate, $usageLimit)
    {
        $query = "UPDATE coupons 
                  SET code = :code, 
                      discount = :discount, 
                      discount_type = :discount_type, 
                      start_date = :start_date, 
                      end_date = :end_date, 
                      usage_limit = :usage_limit
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':discount', $discount);
        $stmt->bindParam(':discount_type', $discountType);
        $stmt->bindParam(':start_date', $startDate);
        $stmt->bindParam(':end_date', $endDate);
        $stmt->bindParam(':usage_limit', $usageLimit, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    

    // Xoá coupon
    public function deleteCoupon($id)
    {
        $query = "DELETE FROM coupons WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function getCouponByCode($code)
{
    $query = "SELECT * FROM coupons WHERE code = :code";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':code', $code);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}
