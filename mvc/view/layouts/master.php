<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Bảng Quản Trị" ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            overflow: auto;
        }

        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background-color: rgb(157, 28, 114);
            color: white;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }

        .sidebar a:hover {
            background-color: rgb(24, 100, 176);
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
        <!-- Sidebar dành cho Quản Trị -->
        <div class="sidebar">
            <h4 class="text-center">Bảng Quản Trị</h4>
            <hr>
            <a href="/">Trang Chủ</a>
            <a href="/products">Quản Lý Sản Phẩm</a>
            <a href="/categories">Quản Lý Danh Mục</a>
            <a href="/ordeladmin">Quản Lý Đơn Hàng người dùng</a>
            <a href="/users">Quản Lý Người Dùng</a>
            <a href="/colors">Quản Lý Màu Sắc</a>
            <a href="/sizes">Quản Lý Kích Thước</a>
            <a href="/product-variants/create/1">Thêm Biến Thể</a>
            <a href="/total">THỐNG KÊ</a>
            <a href="/coupons">coupon</a>
            <a href="/order">Quản Lý Đơn Hàng</a>
            <!-- <a href="/coupons" >free ship</a> -->
            <!-- <a href="/diachi" > địa chỉ người dùng </a> -->

            <hr>
            <a href="/logout" class="text-danger">Đăng Xuất</a>
        </div>

        <div class="content">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-info" role="alert">
                    <?= htmlspecialchars($_SESSION['message']); ?>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>


            <?= $content ?>
        </div>
    <?php else: ?>
        <!-- Giao diện dành cho Người Dùng hoặc Khách -->
        <div class="container mt-4">
            <header>
                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded">
                    <div class="container">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link text-dark fw-semibold" href="/">Trang Chủ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark fw-semibold" href="/categories">Categories</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark fw-semibold" href="/carts">Cart</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark fw-semibold" href="/profile">profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark fw-semibold" href="/orders">order</a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark fw-semibold" href="/addresses">dress</a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark fw-semibold" href="/love">product love</a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark fw-semibold" href="/track_order">Tra Cứu Mã Vận Đơn</a>
                                </li>
                            </ul>
                            <div class="d-flex">
                                <?php if (isset($_SESSION['user'])): ?>
                                    <span class="navbar-text me-3 text-dark fw-semibold">Chào, <?= htmlspecialchars($_SESSION['user']['name']); ?></span>
                                    <a href="/logout" class="btn btn-outline-danger btn-sm">Đăng Xuất</a>
                                <?php else: ?>
                                    <a href="/login" class="btn btn-primary btn-sm me-2">Đăng Nhập</a>
                                    <a href="/register" class="btn btn-success btn-sm">Đăng Ký</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <main class="mt-4">
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($_SESSION['message']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>

                <!-- Nội dung chính -->
                <div class="content shadow-sm rounded bg-light p-4">
                    <?= $content ?>
                </div>
            </main>
        </div>


        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php endif; ?>

</body>

</html>