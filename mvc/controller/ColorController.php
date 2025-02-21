<?php
require_once "model/ColorModel.php";
require_once "view/helpers.php";

class ColorController
{
    private $colorModel;

    public function __construct()
    {
        $this->colorModel = new ColorModel();
    }

    public function index()
    {
        $colors = $this->colorModel->getAll();
        renderView("view/color/list.php", compact('colors'), "Colors List");
    }

    public function show($id)
    {
        $color = $this->colorModel->getById($id);
        renderView("view/color/detail.php", compact('color'), "Color Detail");
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $errors = [];

            // Kiểm tra dữ liệu nhập vào
            if (empty($name)) { // Kiểm tra nếu name rỗng
                $errors['name'] = "Color name is required.";
            } elseif (strlen($name) < 3) { // Kiểm tra độ dài tối thiểu
                $errors['name'] = "Color name must be at least 3 characters.";
            }


            if (empty($errors)) {
                $this->colorModel->create($name);
                $_SESSION['success_message'] = "Color created successfully!";
                header("Location: /colors");
                exit;
            } else {
                renderView("view/color/create.php", compact('errors'), "Create Color");
            }
        } else {
            renderView("view/color/create.php", [], "Create Color");
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $errors = [];

            // Kiểm tra dữ liệu nhập vào
            if (empty($name)) {
                $errors['name'] = "Color name is required.";
            } elseif (strlen($name) < 3) {
                $errors['name'] = "Color name must be at least 3 characters.";
            }

            if (empty($errors)) {
                $this->colorModel->update($id, $name);
                $_SESSION['success_message'] = "Color updated successfully!";
                header("Location: /colors");
                exit;
            } else {
                $color = $this->colorModel->getById($id);
                renderView("view/color/edit.php", compact('color', 'errors'), "Edit Color");
            }
        } else {
            $color = $this->colorModel->getById($id);
            renderView("view/color/edit.php", compact('color'), "Edit Color");
        }
    }

    public function delete($id)
    {
        $this->colorModel->delete($id);
        $_SESSION['success_message'] = "Color deleted successfully!";
        header("Location: /colors");
        exit;
    }
}
