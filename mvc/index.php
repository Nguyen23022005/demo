<?php
require_once "controller/ProductController.php";
require_once "controller/AuthController.php";
require_once "controller/CategoryController.php";
require_once "controller/ColorController.php";
require_once "controller/SizeController.php";
require_once "controller/ProductVariantController.php";
require_once "controller/CartController.php";
require_once "controller/UserController.php";
require_once "router/Router.php";
require_once "middleware.php";

$router = new Router();
$productController = new ProductController();
$authController = new AuthController();
$categoryController = new CategoryController();
$colorController = new ColorController();
$sizeController = new SizeController();
$productVariantController = new ProductVariantController();
$cartController = new CartController();
$userController = new UserController();
$router->addMiddleware('logRequest');

$router->addRoute("/", [$productController, "home"]);
$router->addRoute("/products", [$productController, "index"], ['isUser']); // Accessible to all logged-in users
$router->addRoute("/products/create", [$productController, "create"], ['isAdmin']); // Admin only
$router->addRoute("/products/{id}", [$productController, "show"], ['isUser']); // Accessible to all logged-in users
$router->addRoute("/products/edit/{id}", [$productController, "edit"], ['isAdmin']); // Admin only
$router->addRoute("/products/delete/{id}", [$productController, "delete"], ['isAdmin']); // Admin only
# routers variant products

$router->addRoute("/productsVariants", [$productVariantController, "index"], ['isUser']);
$router->addRoute("/productsVariants/create/{id}", [$productVariantController, "create"], ['isAdmin']);
$router->addRoute("/productsVariants/{id}", [$productVariantController, "show"], ['isUser']);
$router->addRoute("/productsVariants/delete/{id}", [$productVariantController, "delete"], ['isAdmin']);

// Accessible to all logged-in users
$router->addRoute("/login", [$authController, "login"]);
$router->addRoute("/logout", [$authController, "logout"]);
$router->addRoute("/register", [$authController, "register"]);
$router->addRoute("/categories", [$categoryController, "index"], ['isUser']); 
$router->addRoute("/categories/create", [$categoryController, "create"]);
$router->addRoute("/categories/edit/{id}", [$categoryController, "edit"]); 
$router->addRoute("/categories/delete/{id}", [$categoryController, "delete"], ); 

// 🔹 User Management
$router->addRoute("/users", [$userController, "index"],  ['isAdmin']);
$router->addRoute("/users/create", [$userController, "create"], ['isAdmin']);
$router->addRoute("/users/{id}", [$userController, "show"], ['isUser']);
$router->addRoute("/users/edit/{id}", [$userController, "edit"], ['isAdmin']);
$router->addRoute("/users/delete/{id}", [$userController, "delete"], ['isAdmin']);


// colors

$router->addRoute("/colors", [$colorController, "index"], ['isUser']);
$router->addRoute("/colors/create", [$colorController, "create"], ['isAdmin']);
$router->addRoute("/colors/{id}", [$colorController, "show"], ['isUser']);
$router->addRoute("/colors/edit/{id}", [$colorController, "edit"], ['isAdmin']);
$router->addRoute("/colors/delete/{id}", [$colorController, "delete"], ['isAdmin']);

// sizes
$router->addRoute("/sizes", [$sizeController, "index"], ['isUser']);
$router->addRoute("/sizes/create", [$sizeController, "create"], ['isAdmin']);
$router->addRoute("/sizes/{id}", [$sizeController, "show"], ['isUser']);
$router->addRoute("/sizes/edit/{id}", [$sizeController, "edit"], ['isAdmin']);
$router->addRoute("/sizes/delete/{id}", [$sizeController, "delete"], ['isAdmin']);

// carts
$router->addRoute("/carts", [$cartController, "index"], ['isUser']);
$router->addRoute("/carts/delete/{id_Cart}", [$cartController, "delete"], ['isUser'], 'POST');
$router->addRoute('/carts/create', [$cartController, "create"] , ['isUser']);
$router->addRoute('/carts/update/{id_Cart}', [$cartController, "updateQuantity"], ['isUser']);
// $router->addRoute('/carts/remove/{id_Cart}', [$cartController, "removeCart"] , ['isUser']);
$router->addRoute('/carts/remove', [$cartController, "removeCart"]);
$router->addRoute('/checkout', [$cartController, "checkout"]);
$router->dispatch();
?>