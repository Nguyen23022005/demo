<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Bóng Đá</title>
    <link rel="stylesheet" href="">
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


    
        <div class="product-container">
        <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="discount">-14%</div>
                  

                    <img src="/uploads/<?= htmlspecialchars($product['image']) ?>" width="100">

                    <p class="price">
                        <span class="old-price">160,000₫</span>
                        <span class="new-price"><?php echo number_format($product['price'], 0, ',', '.'); ?>₫</span>
                    </p>

                    <a href="/products/<?= $product['id'] ?>" class="btn btn-info btn-sm">view</a>
                </div>
            <?php endforeach; ?>
        </div>
   
</body>