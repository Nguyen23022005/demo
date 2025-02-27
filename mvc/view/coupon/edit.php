<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa mã giảm giá</title>
    <style>
        body { font-family: Arial, sans-serif; }
        form { width: 400px; margin: auto; }
        form div { margin-bottom: 10px; }
        label { display: inline-block; width: 150px; }
        input, select { width: 200px; }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Sửa mã giảm giá</h1>
    <form method="post" action="">
        <div>
            <label>Mã coupon:</label>
            <input type="text" name="code" value="<?= htmlspecialchars($coupon['code']) ?>" required>
        </div>
        <div>
            <label>Giá trị giảm:</label>
            <input type="number" step="0.01" name="discount" value="<?= htmlspecialchars($coupon['discount']) ?>" required>
        </div>
        <div>
            <label>Kiểu giảm (percentage/fixed):</label>
            <select name="discount_type" required>
                <option value="percentage" <?= $coupon['discount_type'] == 'percentage' ? 'selected' : '' ?>>Phần trăm</option>
                <option value="fixed" <?= $coupon['discount_type'] == 'fixed' ? 'selected' : '' ?>>Số tiền cố định</option>
            </select>
        </div>
        <div>
            <label>Ngày bắt đầu:</label>
            <input type="datetime-local" name="start_date" value="<?= date('Y-m-d\TH:i', strtotime($coupon['start_date'])) ?>" required>
        </div>
        <div>
            <label>Ngày kết thúc:</label>
            <input type="datetime-local" name="end_date" value="<?= date('Y-m-d\TH:i', strtotime($coupon['end_date'])) ?>" required>
        </div>
        <div>
            <label>Hạn mức sử dụng:</label>
            <input type="number" name="usage_limit" value="<?= htmlspecialchars($coupon['usage_limit']) ?>">
        </div>
        <div style="text-align: center;">
            <button type="submit">Cập nhật</button>
        </div>
    </form>
    <div style="text-align: center; margin-top: 20px;">
        <a href="/coupons">Quay lại danh sách</a>
    </div>
</body>
</html>
