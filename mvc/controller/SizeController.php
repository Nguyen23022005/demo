<?php
require_once "model/SizeModel.php";
require_once "view/helpers.php";

class SizeController {
    private $sizeModel;

    public function __construct() {
        $this->sizeModel = new SizeModel();
    }

    public function index() {
        $sizes = $this->sizeModel->getAll();
        renderView("view/size/list.php", compact('sizes'), "Size List");
    }

    public function show($id) {
        $sizes = $this->sizeModel->getById($id);
        renderView("view/size/detail.php", compact('sizes'), "Size Detail");
    }

    public function create() {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);

            // Kiểm tra dữ liệu nhập vào
            if (empty($name)) {
                $errors['name'] = "Size name is required.";
            } elseif (strlen($name) < 1) {
                $errors['name'] = "Size name must be at least 2 characters.";
            }

            if (empty($errors)) {
                $this->sizeModel->create($name);
                $_SESSION['success_message'] = "Size created successfully!";
                header("Location: /sizes");
                exit;
            } else {
                renderView("view/size/create.php", compact('errors'), "Create Sizes");
            }
        } else {
            renderView("view/size/create.php", [], "Create Sizes");
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $errors = [];

            // Kiểm tra dữ liệu nhập vào
            if (empty($name)) {
                $errors['name'] = "Size name is required.";
            } elseif (strlen($name) < 1) {
                $errors['name'] = "Size name must be at least 2 characters.";
            }

            if (empty($errors)) {
                $this->sizeModel->update($id, $name);
                $_SESSION['success_message'] = "Size updated successfully!";
                header("Location: /sizes");
                exit;
            } else {
                $sizes = $this->sizeModel->getById($id);
                renderView("view/size/edit.php", compact('sizes', 'errors'), "Edit Size");
            }
        } else {
            $sizes = $this->sizeModel->getById($id);
            renderView("view/size/edit.php", compact('sizes'), "Edit Size");
        }
    }

    public function delete($id) {
        $this->sizeModel->delete($id);
        $_SESSION['success_message'] = "Size deleted successfully!";
        header("Location: /sizes");
        exit;
    }
}
