<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
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
        }
        .product-card img {
            width: 100%;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h2><?= $title ?></h2>
    <?php if (!empty($products)): ?>
        <div class="product-container">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="/uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <p class="price"><?= number_format($product['price'], 0, ',', '.') ?>₫</p>
                    <a href="/products/<?= $product['id'] ?>">Xem chi tiết</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Không có sản phẩm nào phù hợp với khoảng giá đã chọn.</p>
    <?php endif; ?>
</body>
</html>