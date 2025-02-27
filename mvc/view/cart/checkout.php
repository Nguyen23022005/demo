<h2 class="mb-4">Checkout</h2>

<!-- Display Cart Items -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Stt</th>
            <th>Sku</th>
            <th>Image</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total = 0;
        foreach ($carts as $cart):
            $itemTotal = $cart['price'] * $cart['quantityy'];
            $total += $itemTotal;
        ?>
            <tr>
                <td><?= $cart['id'] ?></td>
                <td><?= $cart['sku'] ?></td>
                <td>
                    <img src="<?= $cart['image'] ?>" alt="image 404" style="width: 100px">
                </td>
                <td>
                    <form action="/carts/update/<?= $cart['id'] ?>" method="post" class="d-flex">
                        <input type="number" readonly value="<?= $cart['quantityy'] ?>" class="form-control" min="0" style="width: 100px" name="quantityy" />
                    </form>
                </td>
                <td><?= number_format($cart['price'], 0, ',', '.') ?></td>
                <td><?= number_format($itemTotal, 0, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
// Lấy số tiền giảm giá nếu đã áp dụng coupon (được lưu vào session bởi endpoint apply-coupon)
$discountAmount = isset($_SESSION['coupon_discount']) ? $_SESSION['coupon_discount'] : 0;
$finalTotal = $total - $discountAmount;
if ($finalTotal < 0) {
    $finalTotal = 0;
}
?>

<!-- Form nhập mã giảm giá -->
<form action="/apply-coupon.php" method="post" class="mb-3">
    <div class="input-group">
        <input type="text" name="coupon_code" class="form-control" placeholder="Nhập mã giảm giá" required>
        <button type="submit" class="btn btn-success">Áp dụng</button>
    </div>
</form>

<!-- Hiển thị thông báo lỗi coupon nếu có -->
<?php if(isset($_SESSION['coupon_error']) && $_SESSION['coupon_error']): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['coupon_error']; ?>
    </div>
<?php endif; ?>

<!-- Hiển thị tổng đơn hàng và giảm giá nếu có -->
<h4>Tổng đơn hàng: <?= number_format($total, 0, ',', '.') ?> VND</h4>
<?php if ($discountAmount > 0): ?>
    <h4>Giảm giá: -<?= number_format($discountAmount, 0, ',', '.') ?> VND</h4>
<?php endif; ?>
<h4>Tổng thanh toán: <?= number_format($finalTotal, 0, ',', '.') ?> VND</h4>

<!-- Checkout Form -->
<form action="/checkout" method="POST" class="mt-4">
    <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <textarea name="email" id="email" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea name="address" id="address" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label for="note" class="form-label">Note</label>
        <textarea name="note" id="note" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label for="payment" class="form-label">Payment Method</label>
        <select name="payment" id="payment" class="form-control" required>
            <option value="cod">COD</option>
            <option value="vnpay">VNPAY</option>
            <option value="momo">MOMO</option>
            <option value="zalopay">ZALO PAY</option>
            <option value="paypal">PayPal</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Place Order</button>
    <a href="/carts" class="btn btn-secondary">Back to Cart</a>
</form>
