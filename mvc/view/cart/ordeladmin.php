<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách đơn hàng</title>
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
</head>

<body>
    <h2><?php echo htmlspecialchars($messagee); ?></h2>

    <?php if (!empty($order)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>up</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order as $orders) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($orders['id']); ?></td>
                        <td><?php echo htmlspecialchars($orders['createDate']); ?></td>
                        <td><?php echo number_format($orders['total'], 0, ',', '.'); ?> VND</td>
                        <td><?php echo htmlspecialchars($orders['status']); ?></td>
                        <td>
                            <form action="/change_order_status.php" method="post">
                                <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($orders['id']); ?>">
                                <label for="status">Thay đổi trạng thái:</label>
                                <select name="status" id="status">
                                    <option value="Chờ xử lý" <?php if ($orders['status'] == 'Chờ xử lý') echo 'selected'; ?>>Chờ xử lý</option>
                                    <option value="Đang xử lý" <?php if ($orders['status'] == 'Đang xử lý') echo 'selected'; ?>>Đang xử lý</option>
                                    <option value="Hoàn thành" <?php if ($orders['status'] == 'Hoàn thành') echo 'selected'; ?>>Hoàn thành</option>
                                    <option value="Đã hủy" <?php if ($orders['status'] == 'Đã hủy') echo 'selected'; ?>>Đã hủy</option>
                                    <!-- Thêm các trạng thái khác nếu cần -->
                                </select>
                                <button type="submit">Cập nhật</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Không có đơn hàng nào.</p>
    <?php endif; ?>

</body>

</html>