<?php
require_once "model/UserModel.php";
require_once "view/helpers.php";

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function index() {
        $user = $this->userModel->getAllUser();
        renderView("view/user/list.php", compact('user'), "User List");
    }

    public function show($id) {
        $user = $this->userModel->getUserById($id);
        renderView("view/user/detail.php", compact('user'), "User Detail");
    }
    public function profile($id) {
     
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (!isset($_SESSION['id'])) {
            die("Bạn cần đăng nhập để xem trang này."); // Hoặc có thể redirect đến trang login
            
        }
        $id = $_SESSION['id']; // Lấy ID của người dùng đã đăng nhập
        $profile = $this->userModel->getUserById1($id);
        if (!$id) {
            die("Không tìm thấy người dùng.");
        }
    
        renderView("view/auth/profile.php", compact('profile'), "User Profile");
    }

    public function create() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Validation
            if (empty($name)) {
                $errors['name'] = "Product name is required.";
            }
            if (empty($email)) {
                $errors['email'] = "user email is required.";
            }
            if (empty($password)) {
                $errors['password'] = "user email is required.";
            }
            

            if (empty($errors)) {
                $this->userModel->createUser($name, $email, $password);
                $_SESSION['success_message'] = "product created successfully!";
                header("Location: /users");
                exit;
            } else {
                renderView("view/user/create.php", compact('errors', 'name', 'email', 'password'), "Create user");
            }
        } else {
            renderView("view/user/create.php", [], "Create user");
        }
    }

    public function edit($id) {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Validation
            if (empty($name)) {
                $errors['name'] = "Product name is required.";
            }
            if (empty($email)) {
                $errors['email'] = "user email is required.";
            }
            if (empty($password)) {
                $errors['password'] = "user email is required.";
            }

            if (empty($errors)) {
                $this->userModel->createUser($name, $email, $password);
                $_SESSION['success_message'] = "user edit successfully!";
                header("Location: /users");
                exit;
            } else {
                $user = $this->userModel->getUserById($id);
                renderView("view/user/edit.php", compact('errors',  'name', 'email', 'password'), "Edit user");
            }
        } else {
            $user = $this->userModel->getUserById($id);
            renderView("view/user/edit.php", compact('user'), "Edit user");
        }
    }

    public function delete($id) {
        $this->userModel->deleteUser($id);
        $_SESSION['success_message'] = "user deleted successfully!";
        header("Location: /users");
        exit;
    }
}
