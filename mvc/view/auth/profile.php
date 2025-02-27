
    <style>
        body .form12 {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container12 {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .info {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .edit-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .edit-btn:hover {
            background-color: #0056b3;
        }
    </style>

<body class="form12">

    <div class="container12">
   
        <h1>profile</h1>
        <img class="avatar" src="avatar.jpg" alt="Avatar Người Dùng">
        <div class="info"><strong>Id</strong> <?= $user['id'] ?></div>
        <div class="info"><strong>Họ và Tên:</strong> <?= $user['name'] ?></div>
        <div class="info"><strong>Email:</strong> <?= $user['email'] ?></div>
        <div class="info"><strong>Số điện thoại:</strong><?= $user['phone'] ?></div>
        <div class="info"><strong>role:</strong><?= $user['role'] ?></div>
        <a href="/users/edit/<?= $user['id'] ?>" class="edit-btn">Chỉnh sửa hồ sơ</a>
       
       
    </div>

</body>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>


<body>
    <h2><?php echo htmlspecialchars($messageee); ?>Lịch sử đơn hàng</h2>

    <?php if (!empty($orders)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['id']); ?></td>
                        <td><?php echo htmlspecialchars($order['createDate']); ?></td>
                        <td><?php echo number_format($order['total'], 0, ',', '.'); ?> VND</td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                       
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Không có đơn hàng nào.</p>
    <?php endif; ?>

</body>



