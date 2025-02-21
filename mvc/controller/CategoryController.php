<?php
require_once "model/CategoryModel.php";
require_once "view/helpers.php";

class CategoryController {
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = new categoryModel();
    }

    public function index() {
        $categories = $this->categoryModel->getAllCategory();
        //compact: gom bien dien thanh array
        renderView("view/category_list.php", compact('categories'), "categories List");
    }

    public function show($id) {
        $categories = $this->categoryModel->getCategoryById($id);
        renderView("view/category_detail.php", compact('categories'), "categories Detail");
    }
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $errors = [];

            // Kiểm tra dữ liệu nhập vào
            if (empty($name)) {
                $errors['name'] = "Category name is required.";
            } elseif (strlen($name) < 3) {
                $errors['name'] = "Category name must be at least 3 characters.";
            }

            if (empty($errors)) {
                $this->categoryModel->createCategory($name);
                $_SESSION['success_message'] = "Category created successfully!";
                header("Location: /categories");
                exit;
            } else {
                renderView("view/category_create.php", compact('errors'), "Create Category");
            }
        } else {
            renderView("view/category_create.php", [], "Create Category");
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $errors = [];

            // Kiểm tra dữ liệu nhập vào
            if (empty($name)) {
                $errors['name'] = "Category name is required.";
            } elseif (strlen($name) < 3) {
                $errors['name'] = "Cần 3 kí tự trở lên.";
            }

            if (empty($errors)) {
                $this->categoryModel->updateCategory($id, $name);
                $_SESSION['success_message'] = "Category updated successfully!";
                header("Location: /categories");
                exit;
            } else {
                $categories = $this->categoryModel->getCategoryById($id);
                renderView("view/category_edit.php", compact('categories', 'errors'), "Edit Category");
            }
        } else {
            $categories = $this->categoryModel->getCategoryById($id);
            renderView("view/category_edit.php", compact('categories'), "Edit Category");
        }
    }
    public function delete($id) {
        $this->categoryModel->deleteCategory($id);
        $_SESSION['success_message'] = "Category delete successfully!";
        header("Location: /categories");
        exit;
    }
}