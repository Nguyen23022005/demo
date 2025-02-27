<?php
require_once "model/ProductModel.php";
require_once "model/ProductVariantsModel.php";
require_once "view/helpers.php";

class ProductController
{
    private $productModel;
    private $productVariantsModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->productVariantsModel = new ProductVariantModel();
    }
    public function home() {
   
        $price = isset($_GET['price']) ? $_GET['price'] : null;
    
        // Gọi hàm tìm kiếm hoặc lọc trong Model
        $products = $this->productModel->filterProducts($price);
    
       
        renderView("view/home.php", compact('products',), "Product List");
    }
    public function index(){
        $products = $this->productModel->getAllProducts();
        renderView("view/product_list.php", compact('products'), "Product List");
        }
    

    // public function show($id) {
    //     $product = $this->productModel->getProductById($id); 
    //     $product_variants = $this->productVariantsModel->getVariantByProductId($id);
    //     $categories = $this->productModel->getAllCategories(); // Lấy danh sách danh mục
    //     renderView("view/product_detail.php", compact('product_variants', 'product'), "Product Detail");
    // }


    public function show($id)
    {
        $product = $this->productModel->getProductById($id);
        $product_variants = $this->productVariantsModel->getVariantByProductId($id);
        echo "<pre>";
        // var_dump($product_variants);
        echo "</pre>";
        renderView("view/product_detail.php", compact('product_variants', 'product'), "Product Detail");
    }
    // public function home() {
    //     $product = $this->productModel->getAllProductsHome();
        
        
    //     //compact: gom bien dien thanh array
    //     renderView("view/home.php", compact('product'), "Product List");
    // }
   
    public function lisproduct()
    {
        $products = $this->productModel->getAllProducts();

        //compact: gom bien dien thanh array
        renderView("view/product_detail.php", compact('products'), "Product List");
    }


    public function create()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);
        $price = trim($_POST['price']);
        $errors = [];

        // Xử lý ảnh tải lên
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

        // Kiểm tra lỗi nhập dữ liệu
        if (empty($name)) {
            $errors['name'] = "Tên sản phẩm không được để trống.";
        }
        if (empty($description)) {
            $errors['description'] = "Mô tả sản phẩm không được để trống.";
        }
        if (empty($price) || !filter_var($price, FILTER_VALIDATE_FLOAT) || $price <= 0) {
            $errors['price'] = "Giá sản phẩm phải là số dương.";
        }

        if (empty($errors)) {
            $this->productModel->createProduct($name, $description, $price, $fileName);
            $_SESSION['success_message'] = "Thêm sản phẩm thành công!";
            header("Location: /products");
            exit;
        } else {
            renderView("view/product_create.php", compact('errors'), "Thêm sản phẩm");
        }
    } else {
        renderView("view/product_create.php", [], "Thêm sản phẩm");
    }
}


    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $price = trim($_POST['price']);
            $errors = [];

            if (empty($name)) {
                $errors['name'] = "Product name is required.";
            }
            if (empty($description)) {
                $errors['description'] = "Product description is required.";
            }
            if (empty($price)) {
                $errors['price'] = "Product price is required.";
            } elseif (!filter_var($price, FILTER_VALIDATE_FLOAT) || $price <= 0) {
                $errors['price'] = "Product price must be a positive number.";
            }

            if (empty($errors)) {
                $this->productModel->updateProduct($id, $name, $description, $price);
                $_SESSION['success_message'] = "Product updated successfully!";
                header("Location: /products");
                exit;
            } else {
                $product = $this->productModel->getProductById($id);
                renderView("view/product_edit.php", compact('product', 'errors'), "Edit Product");
            }
        } else {
            $product = $this->productModel->getProductById($id);
            renderView("view/product_edit.php", compact('product'), "Edit Product");
        }
    }


    public function delete($id)
    {
        $this->productModel->deleteProduct($id);
        $_SESSION['success_message'] = "Product delete successfully!";
        header("Location: /products");
        exit;
    }
    public function search($name = null) {
        // Ưu tiên lấy từ tham số route nếu có, nếu không thì từ query string
        if ($name === null) {
            $name = isset($_GET['query']) ? trim($_GET['query']) : '';
        }
        
        if (!empty($name)) {
            $products = $this->productModel->searchProducts($name);
        } else {
            $products = [];
        }
    
        renderView("view/searchResults.php", compact('products'), "Kết quả tìm kiếm sản phẩm");
    }
    
}