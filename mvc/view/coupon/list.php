<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách mã giảm giá</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 80%; margin: auto; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .actions a { margin: 0 5px; text-decoration: none; }
        .actions a:hover { text-decoration: underline; }
        .header { text-align: center; margin: 20px 0; }
    </style>
</head>
<body>
    <h1 class="header">Danh sách mã giảm giá</h1>
    <div style="text-align: center; margin-bottom: 20px;">
        <a href="/coupons/add">Thêm mã giảm giá</a>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Mã</th>
            <th>Giá trị giảm</th>
            <th>Kiểu giảm</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Hạn mức sử dụng</th>
            <th>Hành động</th>
        </tr>
        <?php if (!empty($coupons)): ?>
            <?php foreach ($coupons as $coupon): ?>
                <tr>
                    <td><?= $coupon['id'] ?></td>
                    <td><?= $coupon['code'] ?></td>
                    <td><?= $coupon['discount'] ?></td>
                    <td><?= $coupon['discount_type'] ?></td>
                    <td><?= $coupon['start_date'] ?></td>
                    <td><?= $coupon['end_date'] ?></td>
                    <td><?= $coupon['usage_limit'] ?></td>
                    <td class="actions">
                        <a href="/coupons/edit?id=<?= $coupon['id'] ?>">Sửa</a>
                        <a href="/coupons/delete?id=<?= $coupon['id'] ?>" onclick="return confirm('Bạn có chắc muốn xoá mã này?');">Xoá</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">Không có dữ liệu</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
