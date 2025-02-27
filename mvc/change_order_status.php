
<?php
require_once "controller/OrderController.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];

    $orderController = new OrderController();
    $orderController->changeOrderStatus($order_id, $new_status);
    
}
?>
<a href="/order">order</a>