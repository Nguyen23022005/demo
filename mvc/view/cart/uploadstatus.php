<form action="/mvc/view/cart/change_order_status.php" method="post">
    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['id']); ?>">
    <label for="status">Thay đổi trạng thái:</label>
    <select name="status" id="status">
        <option value="pending" <?php if ($order['status'] == 'pending') echo 'selected'; ?>>Chờ xử lý</option>
        <option value="processing" <?php if ($order['status'] == 'processing') echo 'selected'; ?>>Đang xử lý</option>
        <option value="completed" <?php if ($order['status'] == 'completed') echo 'selected'; ?>>Hoàn thành</option>
        <option value="cancelled" <?php if ($order['status'] == 'cancelled') echo 'selected'; ?>>Đã hủy</option>
        <!-- Thêm các trạng thái khác nếu cần -->
    </select>
    <button type="submit">Cập nhật</button>
</form>
