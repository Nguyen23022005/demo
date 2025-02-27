<?php
session_start();
require_once "model/CouponModel.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $coupon_code = trim($_POST['coupon_code']);

    $couponModel = new CouponModel();
    $coupon = $couponModel->getCouponByCode($coupon_code);

    // Nếu coupon không tồn tại
    if (!$coupon) {
        $_SESSION['coupon_discount'] = 0;
        $_SESSION['coupon_error'] = "Mã giảm giá không tồn tại.";
        header("Location: /checkout");
        exit;
    }

    // Kiểm tra thời gian hiệu lực của coupon
    $currentDate = date('Y-m-d');
    if ($currentDate < $coupon['start_date'] || $currentDate > $coupon['end_date']) {
        $_SESSION['coupon_discount'] = 0;
        $_SESSION['coupon_error'] = "Mã giảm giá đã hết hạn hoặc chưa hiệu lực.";
        header("Location: /checkout");
        exit;
    }

    // Nếu coupon hợp lệ, tính số tiền giảm dựa theo kiểu giảm
    // Để tính chính xác, bạn cần tính tổng đơn hàng. Nếu không, bạn có thể lưu thông tin coupon và tính toán sau.
    // Ví dụ, nếu tổng đơn hàng đã được lưu trong session (tạm thời)
    // $total = $_SESSION['cart_total'] ?? 0;
    // Trong ví dụ này, ta sẽ giả sử tổng được tính lại trong trang checkout,
    // vì vậy ta lưu toàn bộ thông tin coupon và để trang checkout tự tính.
    if ($coupon['discount_type'] == 'percent') {
        // Số tiền giảm sẽ được tính trong trang checkout với tổng đơn hàng thực tế
        $_SESSION['coupon_discount'] = 0; // Sẽ tính lại sau
    } else {
        $_SESSION['coupon_discount'] = $coupon['discount'];
    }

    // Lưu coupon vào session nếu cần hiển thị thông tin
    $_SESSION['coupon'] = $coupon;
    $_SESSION['coupon_error'] = "";

    header("Location: /checkout");
    exit;
}
