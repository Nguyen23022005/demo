<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Bóng Đá</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }

        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-container input[type="text"] {
            padding: 8px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-container button {
            padding: 8px 12px;
            background-color: #2ea44f;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .product-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .product-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 250px;
            text-align: center;
            position: relative;
        }

        .product-card img {
            width: 100%;
            border-radius: 8px;
        }

        .product-card h3 {
            font-size: 16px;
            color: #333;
            margin: 10px 0;
        }

        .price {
            font-size: 18px;
            font-weight: bold;
        }

        .old-price {
            text-decoration: line-through;
            color: #888;
            margin-right: 5px;
        }

        .new-price {
            color: green;
        }

        .discount {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #2ea44f;
            color: white;
            padding: 5px 8px;
            font-size: 14px;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Trang chủ</h2>

    <!-- Phần tìm kiếm sản phẩm -->
    <div class="search-container">
        <input type="text" id="searchQuery" placeholder="Tìm kiếm sản phẩm" required>
        <button type="button" onclick="performSearch()">Tìm kiếm</button>
    </div>

    <script>
        function performSearch() {
            var query = document.getElementById('searchQuery').value;
            if (query.trim() !== '') {
                // Chuyển hướng tới route: /products/search/{name}
                window.location.href = "/products/search/" + encodeURIComponent(query);
            }
        }
    </script>
    <form method="GET" action="/" class="d-flex flex-wrap align-items-center">
        <select name="price" class="form-select me-2 mb-2" style="width: 150px;">
            <option value="">Tất cả mức giá</option>
            <option value="low" <?= isset($_GET['price']) && $_GET['price'] === 'low' ? 'selected' : '' ?>>Dưới 50$</option>
            <option value="mid" <?= isset($_GET['price']) && $_GET['price'] === 'mid' ? 'selected' : '' ?>>Từ 50$ - 100$</option>
            <option value="high" <?= isset($_GET['price']) && $_GET['price'] === 'high' ? 'selected' : '' ?>>Trên 100$</option>
        </select>

        <!-- Nút lọc -->
        <button type="submit" class="btn btn-outline-primary mb-2">Lọc</button>
    </form>

    <div class="product-container">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <div class="discount">-14%</div>
                <img src="/uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                <p class="price">
                    <hr>
                    <span class="new-price"><?= htmlspecialchars($product['name']) ?></span>
                    <hr>
                
                    <span class="new-price"><?php echo number_format($product['price'], 0, ',', '.'); ?>₫</span>
                </p>
                <a href="/products/<?= $product['id'] ?>" class="btn btn-info btn-sm">View</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>