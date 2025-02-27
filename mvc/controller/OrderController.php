<?php
require_once "model/OrderModel.php";



class OrderController
{
    private $orderModel;
 

    public function __construct()
    {
        $this->orderModel = new OrderModel();

    }
    public function listAllOrder(){
        $order = $this->orderModel->getOrders();
        $messagee = empty($order) ? "Bạn chưa có đơn hàng nào." : "Danh sách đơn hàng của bạn";
        renderView("view/cart/ordeladmin.php", compact('order', 'messagee'), "Danh sách đơn hàng");
    } 
    public function listOrderById() {
        
        $user_id = $_SESSION['user']['id'] ?? null;
        $session_id = session_id();
        $orders = $this->orderModel->getOrderByUserId($user_id, $session_id);
        
        // Sửa lỗi biến `$order` thành `$orders`
        $message = empty($orders) ? "Bạn chưa có đơn hàng nào." : "Danh sách đơn hàng của bạn";
    
        // Render view
        renderView("view/cart/donhang.php", compact('orders', 'message'), "Danh sách đơn hàng");
    }
 

   
    public function showTotalRevenueAllOrders() {
        $total = $this->orderModel->getTotalRevenueAllOrders();
        renderView("view/cart/revenue.php", compact('total'), "Tổng Doanh Thu Tất Cả Đơn Hàng");
    }


    public function changeOrderStatus($order_id, $new_status) {
        // Gọi phương thức cập nhật trạng thái từ mô hình
        $result = $this->orderModel->updateOrderStatus($order_id, $new_status);
    
        if ($result) {
            // Nếu cập nhật thành công, chuyển hướng hoặc hiển thị thông báo thành công
            echo "<h1>Trạng thái đơn hàng đã được cập nhật thành công.</h1>";
        } else {
            // Nếu cập nhật thất bại, hiển thị thông báo lỗi
            echo "Có lỗi xảy ra khi cập nhật trạng thái đơn hàng.";
        }
    }
}
