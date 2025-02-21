<?php
require_once "model/UserModel.php";
require_once "view/helpers.php";

class UserController {
    private $usertModel;

    public function __construct() {
        $this->usertModel = new UserModel();
    }

    public function index() {
        $user = $this->usertModel->getAllUser();
        renderView("view/user/list.php", compact('user'), "User List");
    }

    public function show($id) {
        $user = $this->usertModel->getUserById($id);
        renderView("view/user/detail.php", compact('user'), "User Detail");
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
                $this->usertModel->createUser($name, $email, $password);
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
                $this->usertModel->createUser($name, $email, $password);
                $_SESSION['success_message'] = "user edit successfully!";
                header("Location: /users");
                exit;
            } else {
                $user = $this->usertModel->getUserById($id);
                renderView("view/user/edit.php", compact('errors',  'name', 'email', 'password'), "Edit user");
            }
        } else {
            $user = $this->usertModel->getUserById($id);
            renderView("view/user/edit.php", compact('user'), "Edit user");
        }
    }

    public function delete($id) {
        $this->usertModel->deleteUser($id);
        $_SESSION['success_message'] = "user deleted successfully!";
        header("Location: /users");
        exit;
    }
}
