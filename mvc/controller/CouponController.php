<?php
require_once "model/CouponModel.php";

class CouponController {
    private $couponModel;

    public function __construct() {
        $this->couponModel = new CouponModel();
    }

    // Liệt kê danh sách coupon
    public function index() {
        $coupons = $this->couponModel->getCoupons();
        renderView("view/coupon/list.php", compact('coupons'), "coupon List");
    }
    public function show($id){
        $coupon = $this->couponModel->getCouponById($id);
        renderView("view/coupon/create.php", compact('coupon'), "Coupon");
        }
    
    // Thêm coupon mới
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = $_POST['code'];
            $discount = $_POST['discount'];
            $discountType = $_POST['discount_type'];
            $startDate = $_POST['start_date'];
            $endDate = $_POST['end_date'];
            $usageLimit = isset($_POST['usage_limit']) && $_POST['usage_limit'] !== '' ? $_POST['usage_limit'] : null;
    
            if ($this->couponModel->addCoupon($code, $discount, $discountType, $startDate, $endDate, $usageLimit)) {
                header("Location: /coupons");
                exit;
            }
        }
        // Ở đây thay vì truyền biến $coupons (chưa được định nghĩa) hãy truyền biến $coupon hoặc mảng rỗng nếu view không cần dữ liệu coupon
        renderView("view/coupon/create.php", ['coupon' => null], "Thêm Coupon");
    }
    

    // Sửa coupon
    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: /coupons");
            exit;
        }
        $id = $_GET['id'];
        // Lấy danh sách coupon và tìm coupon theo id (bạn có thể tạo thêm phương thức getCouponById() trong model nếu muốn)
        $coupons = $this->couponModel->getCoupons();
        $coupon = null;
        foreach ($coupons as $c) {
            if ($c['id'] == $id) {
                $coupon = $c;
                break;
            }
        }
        if (!$coupon) {
            header("Location: /coupons");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = $_POST['code'];
            $discount = $_POST['discount'];
            $discountType = $_POST['discount_type'];
            $startDate = $_POST['start_date'];
            $endDate = $_POST['end_date'];
            $usageLimit = isset($_POST['usage_limit']) && $_POST['usage_limit'] !== '' ? $_POST['usage_limit'] : null;

            if ($this->couponModel->updateCoupon($id, $code, $discount, $discountType, $startDate, $endDate, $usageLimit)) {
                header("Location: /coupons");
                exit;
            }
        }
        renderView("view/coupon/edit.php", compact('coupons'), "coupon List");
    }

    // Xoá coupon
    public function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->couponModel->deleteCoupon($id);
        }
        header("Location: /coupons");
        exit;
    }
}
