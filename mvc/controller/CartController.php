<?php
require_once "model/CategoryModel.php";
require_once "view/helpers.php";
require_once "model/CartModel.php";
require_once 'model/OrderModel.php';
require_once 'Utils.php';

// enum StatusOrder: string
// {
//     case Pending = 'pending';
//     case Confirm = 'confirm';
//     case Shipping = 'shipping';
//     case Success = 'success';
//     case Cancel = 'cancel';
// }

// enum StatusPayment: string
// {
//     case Pending = 'pending';
//     case Success = 'success';
//     case Cancel = 'cancel';
//     case Error = 'error';
// }
class CartController
{
    private $cartModel;
    private $orderModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->orderModel = new OrderModel();
    }

    public function index()
    {
        $user_id = $_SESSION['user']['id'] ?? null;
        $session_id = session_id();
        $carts = $this->cartModel->getCart($user_id, $session_id);
        //compact: gom bien dien thanh array
        renderView("view/cart/list.php", compact('carts'), "carts List");
    }
    public function indexx()
    {
        $user_id = $_SESSION['user']['id'] ?? null;
        $session_id = session_id();
        $carts = $this->cartModel->getCart($user_id, $session_id);
        //compact: gom bien dien thanh array
        renderView("view/product_love.php", compact('carts'), "carts List");
    }
    public function show()
    {
        $user_id = $_SESSION['user']['id'] ?? null;
        $session_id = session_id();
        $carts = $this->cartModel->getCartt($user_id, $session_id
        );  
        renderView("view/cart/productlistlove.php", compact('carts'), "carts Show");
        }
    

    public function checkout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $payment = $_POST['payment'];
            if ($payment == 'cod') {
                /**
                 * carts hien  tai
                 * 
                 */
                $user_id = $_SESSION['user']['id'] ?? null;
                $session_id = session_id();
                $carts = $this->cartModel->getCart($user_id, $session_id);
                $total = 0;
                foreach ($carts as $cart) {
                    $total += $cart['price'] * $cart['quantity'];
                }
                $code = uniqid(); // code của order
                $address = $_POST['address'] ?? null;
                $note = $_POST['note'] ?? null;
                $email = $_POST['email'] ?? null;
                $status = 'pendding';
                $isCreate = $this->orderModel->createOrder(
                    $user_id,
                    $code,
                    $total,
                    $address,
                    $note,
                    $status,
                    $payment,
                    $carts
                );
                /**
                 * xoa gio hang
                 * gui email
                 * hien thi trang thanh toan thanh con
                 */
                sentemail($email, 'DON HANG CUA BAN DA DUOC TAO THANH CONG', 'chuc mung ban');

                $this->cartModel->clearCart($user_id, $session_id);
                $_SESSION['success'] = "Đơn hàng đã được tạo thành công!";
                header("Location: /view/cart/thanksyou.php");
                exit;

            } else if ($payment == 'vnpay') {
            }
        } else {
            $user_id = $_SESSION['user']['id'] ?? null;
            $session_id = session_id();
            $carts = $this->cartModel->getCart($user_id, $session_id);
            //compact: gom bien dien thanh array
            renderView("view/cart/checkout.php", compact('carts'), "carts List");
        }
    }
   


    // public function show($id) {
    //     $categories = $this->categoryModel->getCategoryById($id);
    //     renderView("view/category_detail.php", compact('categories'), "categories Detail");
    // }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $user_id = $_SESSION['user']['id'] ?? null;
            $cart_session = session_id();
            $sku = $_POST['sku'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $this->cartModel->addCart($user_id, $cart_session, $sku, $quantity, $price);
            header("Location: /carts");
        } else {
            renderView("view/category_create.php", [], "Create category");
        }
    }

    public function updateQuantity($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quantityy = $_POST['quantityy'];
            $this->cartModel->updateQuantity($user_id, $quantityy);
            $_SESSION['message'] = "Cart updated successfully";
            header("Location: /carts");
        } else {
            header("Location: /carts");
        }
    }
    // public function edit($id){
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $name = $_POST['name'];
    //         $this->categoryModel->updateCategory($id, $name);
    //         header("Location: /categories");
    //     } else {
    //         $categories = $this->categoryModel->getCategoryById($id);
    //         renderView("view/category_edit.php", compact('categories'), "Edit categories");
    //     }
    // }
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->cartModel->deleteCart($id);
            $_SESSION['success_message'] = "Cart item deleted successfully.";
        } else {
            $_SESSION['error_message'] = "Invalid request method.";
        }
        header("Location: /carts");
        exit;
    }
    public function removeCart()
    {
        $user_id = $_SESSION['user']['id'] ?? null;
        $session_id = session_id();
        $this->cartModel->removeCart($user_id, $session_id);
        $_SESSION['success_message'] = "Cart cleared successfully.";
        header("Location: /carts");
        exit;
    }
    
    
}

    
