<?php
 require_once "model/AddressModel.php";
 require_once "view/helpers.php";
 
 class AddressController {
     private $addressModel;
 
     public function __construct() {
         $this->addressModel = new AddressModel();
     }
 
     // Hiển thị danh sách địa chỉ
     public function index() {
         $addresses = $this->addressModel->getAllAddresses();
         renderView("view/address/list.php", compact('addresses'), "Danh sách địa chỉ");
     }
 
     // Lưu danh sách địa chỉ được chọn
     public function save() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $selectedAddressId = $_POST['selected_address'] ?? null;
            $this->addressModel->saveSelectedAddress($selectedAddressId);
            header("Location: /addresses");
            exit;
        }
    }
 
     // Tạo địa chỉ mới
    public function create() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userId = $_SESSION['user']['id']; // Lấy user_id từ session
        $name = $_POST['name'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zipcode = $_POST['zipcode'];
        
        $this->addressModel->createAddress($userId, $name, $street, $city, $state, $zipcode);
        header("Location: /addresses");
        exit;
    } else {
        renderView("view/address/create.php", [], "Tạo địa chỉ mới");
    }
}
 
     // Chỉnh sửa địa chỉ
     public function edit($id) {
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             $name = $_POST['name'];
             $street = $_POST['street'];
             $city = $_POST['city'];
             $state = $_POST['state'];
             $zipcode = $_POST['zipcode'];
 
             $this->addressModel->updateAddress($id, $name, $street, $city, $state, $zipcode);
             header("Location: /addresses");
             exit;
         } else {
             $address = $this->addressModel->getAddressById($id);
             renderView("view/address_edit.php", compact('address'), "Chỉnh sửa địa chỉ");
         }
     }
 
     // Xóa địa chỉ
     public function delete($id) {
         $this->addressModel->deleteAddress($id);
         header("Location: /addresses");
         exit;
     }
 }