<?php
require_once "model/ProductModel.php";
require_once "model/ProductVariantsModel.php";
require_once "model/ColorModel.php";
require_once "model/SizeModel.php";
require_once "view/helpers.php";

class ProductVariantController {
    private $productModel;
    private $sizeModel;
    private $colorModel;
    private $productVariantModel;

    public function __construct() {
        $this->productModel = new ProductModel();
        $this->sizeModel = new SizeModel();
        $this->colorModel = new ColorModel();
        $this->productVariantModel = new ProductVariantModel();
    }

    public function index() {
        $products = $this->productModel->getAllProducts();
        //compact: gom bien dien thanh array
        renderView("view/product_list.php", compact('products'), "Product List");
    }
    

    public function show($id) {
        $product = $this->productModel->getProductById($id);
        renderView("view/product_detail.php", compact('product'), "Product Detail");
    }

    public function create($id) {
        $message = "";
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
    
            $product_id = $_POST['product_id'];
            $colorId = $_POST['colorId'];
            $sizeId = $_POST['sizeId'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $sku = $_POST['sku'];
    
            // Handle file upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $targetDir = "uploads/"; // Directory where images will be stored
                $fileName = basename($_FILES["image"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    
                // Allow only specific file types
                $allowedTypes = ["jpg", "jpeg", "png", "gif"];
                if (!in_array($fileType, $allowedTypes)) {
                    $errors[] = "Only JPG, JPEG, PNG, and GIF files are allowed.";
                }
    
                // Move uploaded file to the target directory
                if (empty($errors) && move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    $image = $targetFilePath; // Save the file path in the database
                } else {
                    $errors[] = "File upload failed.";
                }
            } else {
                $errors[] = "Please upload an image.";
            }
    
            // Check if SKU exists
            if ($this->productVariantModel->checkExistSku($sku)) {
                $errors[] = "SKU already exists.";
            }
    
            if (!empty($errors)) {
                $products = $this->productModel->getAllProducts();
                $sizes = $this->sizeModel->getAll();
                $colors = $this->colorModel->getAll();
                renderView("view/productsvariant/create.php", compact("products", "colors", "sizes", "errors"), "Create Product Variants");
                return;
            }
    
            // Insert product variant into database
            $this->productVariantModel->createVariants($product_id, $colorId, $sizeId, $image, $quantity, $price, $sku);
            $_SESSION['message'] = "<p class='alert alert-primary'>Product variant created successfully.</p>";
    
            header("Location: /products");
            exit;
        } else {
            $products = $this->productModel->getAllProducts();
            $sizes = $this->sizeModel->getAll();
            $colors = $this->colorModel->getAll();
            renderView("view/productsvariant/create.php", compact("products", "colors", "sizes"), "Create Product Variants");
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];

            $this->productModel->updateProduct($id, $name, $description, $price);
            header("Location: /products");
        } else {
            $product = $this->productModel->getProductById($id);
            renderView("view/product_edit.php", compact('product'), "Edit Product");
        }
    }

    public function delete($id) {
        $this->productModel->deleteProduct($id);
        header("Location: /products");
        exit;
    }
}