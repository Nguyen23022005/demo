<?php
require_once "model/ProductModel.php";
require_once "model/ProductVariantsModel.php";
require_once "view/helpers.php";

class ProductController {
    private $productModel;
    private $productVariantsModel;

    public function __construct() {
        $this->productModel = new ProductModel();
        $this->productVariantsModel = new ProductVariantModel();
    }

    public function index() {
        $products = $this->productModel->getAllProducts();
        
        //compact: gom bien dien thanh array
        renderView("view/product_list.php", compact('products'), "Product List");
    }

    public function home() {
        $products = $this->productModel->getProductById1();
        
        //compact: gom bien dien thanh array
        renderView("view/home.php", compact('products'), "Product List");
    }
    

    public function show($id) {
        $product = $this->productModel->getProductById($id); 
        $productsVariants = $this->productVariantsModel->getVariantByProductId($id);
        echo "<pre>";
        // var_dump($product_variants);
        echo "</pre>";
        renderView("view/product_detail.php", compact('productsVariants', 'product'), "Product Detail");
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $price = trim($_POST['price']);
            $errors = [];

            // Validate inputs
            if (empty($name)) {
                $errors['name'] = "Product name is required.";
            }
            if (empty($description)) {
                $errors['description'] = "Product description is required.";
            }
            if (empty($price) || !filter_var($price, FILTER_VALIDATE_FLOAT) || $price <= 0) {
                $errors['price'] = "Product price must be a positive number.";
            }

            // Handle image upload
            $image = null;
            if (!empty($_FILES['image']['name'])) {
                $targetDir = "uploads/";
                $fileName = time() . "_" . basename($_FILES["image"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

                // Check valid image types
                $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                if (!in_array($imageFileType, $validExtensions)) {
                    $errors['image'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                }

                // Upload image if no errors
                if (empty($errors) && move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    $image = $fileName;
                } else {
                    $errors['image'] = "Failed to upload image.";
                }
            }

            if (empty($errors)) {
                $this->productModel->createProduct($name, $description, $price, $image);
                $_SESSION['success_message'] = "Product created successfully!";
                header("Location: /products");
                exit;
            } else {
                renderView("view/product_create.php", compact('errors'), "Create Product");
            }
        } else {
            renderView("view/product_create.php", [], "Create Product");
        }
    }

    public function edit($id) {
        $product = $this->productModel->getProductById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $price = trim($_POST['price']);
            $errors = [];

            // Validate inputs
            if (empty($name)) {
                $errors['name'] = "Product name is required.";
            }
            if (empty($description)) {
                $errors['description'] = "Product description is required.";
            }
            if (empty($price) || !filter_var($price, FILTER_VALIDATE_FLOAT) || $price <= 0) {
                $errors['price'] = "Product price must be a positive number.";
            }

            // Handle optional image upload
            $image = null;
            if (!empty($_FILES['image']['name'])) {
                $targetDir = "uploads/";
                $fileName = time() . "_" . basename($_FILES["image"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

                // Check valid image types
                $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                if (!in_array($imageFileType, $validExtensions)) {
                    $errors['image'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                }

                // Upload image if no errors
                if (empty($errors) && move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    $image = $fileName;
                } else {
                    $errors['image'] = "Failed to upload image.";
                }
            }

            if (empty($errors)) {
                $this->productModel->updateProduct($id, $name, $description, $price, $image);
                $_SESSION['success_message'] = "Product updated successfully!";
                header("Location: /products");
                exit;
            } else {
                renderView("view/product_edit.php", compact('product', 'errors'), "Edit Product");
            }
        } else {
            renderView("view/product_edit.php", compact('product'), "Edit Product");
        }
    }
    

    public function delete($id) {
        $this->productModel->deleteProduct($id);
        $_SESSION['success_message'] = "Product delete successfully!";
        header("Location: /products");
        exit;
    }
}