
    <style>
        body .log{
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container22 {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        .order-info {
            margin-bottom: 20px;
            padding: 10px;
            background: #eef;
            border-radius: 5px;
        }
        .order-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .order-item img {
            width: 80px;
            height: 80px;
            margin-right: 15px;
            border-radius: 5px;
        }
        .order-item-info {
            flex: 1;
        }
        .order-item-name {
            font-size: 18px;
            font-weight: bold;
        }
        .order-item-price {
            color: #d9534f;
        }
        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>

<body class="log">
    <div class="container22">
        <h2>Chi Tiết Đơn Hàng</h2>
        <div class="order-info">
            <p><strong>Mã đơn hàng:</strong> #123456</p>
            <p><strong>Ngày đặt hàng:</strong> 21/02/2025</p>
            <p><strong>Trạng thái:</strong> Đang giao</p>
        </div>
        <div class="order-item">
            <img src="product1.jpg" alt="Sản phẩm 1">
            <div class="order-item-info">
                <div class="order-item-name">Tên sản phẩm 1</div>
                <div class="order-item-price">Giá: 500.000 VND</div>
            </div>
        </div>
        <div class="order-item">
            <img src="product2.jpg" alt="Sản phẩm 2">
            <div class="order-item-info">
                <div class="order-item-name">Tên sản phẩm 2</div>
                <div class="order-item-price">Giá: 700.000 VND</div>
            </div>
        </div>
        <div class="total">Tổng tiền: 1.200.000 VND</div>
    </div>
</body>
</html>
