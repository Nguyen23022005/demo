<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết đơn hàng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php foreach ($orders as $order): ?>
        <div class="container my-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Chi tiết đơn hàng</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Mã đơn hàng:</strong> <?= $order['code'] ?></p>
                            <p><strong>Khách hàng:</strong> <?= $order['address'] ?></p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p><strong>Ngày đặt hàng:</strong> <?= $order['createDate'] ?></p>
                            <p><strong>Trạng thái: </strong>
                                <?= $order['status'] ?>
                                <!-- <span class="badge bg-success">Đã giao hàng</span> -->
                            </p>
                            <p><strong>rewiew</strong>
                        </div>
                    </div>
                    <h5 class="mb-3">Sản phẩm</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item):
                                    if ($item['orderId'] === $order['id']) { ?>
                                        <tr>
                                            <td><?= $item['sku'] ?></td>
                                            <td><?= $item['quantity'] ?></td>
                                            <td><?= $item['price'] ?></td>
                                        </tr>
                                <?php }
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <p><strong>Phương thức thanh toán:</strong> Thanh toán khi nhận hàng</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <h4 class="text-danger"><strong><?= $order['total'] ?> VNĐ</strong></h4>
                        </div>
                    </div>
                    <h2 class="mb-4">Cập nhật trạng thái đơn hàng</h2>
                    <?php if ($order['status'] === 'Chờ xử lý') : ?>
                        <form method="POST" action="/orders/update/<?= htmlspecialchars($order['id']) ?>" class="p-4 border rounded shadow-sm bg-light">
                            <input type="hidden" id="email" name="email" value="<?= htmlspecialchars($order['email']) ?>">
                            <input type="hidden" id="status" name="status" value="Đang xử lý">
                            <button type="submit" class="btn btn-success">Xác Nhận Đơn Hàng</button>
                        </form>
                    <?php elseif ($order['status'] === 'Đang xử lý') : ?>
                        <form method="POST" action="/orders/update/<?= htmlspecialchars($order['id']) ?>" class="p-4 border rounded shadow-sm bg-light">
                            <input type="hidden" id="email" name="email" value="<?= htmlspecialchars($order['email']) ?>">
                            <input type="hidden" id="status" name="status" value="Đang giao">
                            <button type="submit" class="btn btn-warning">Xác Nhận Giao Hàng</button>
                        </form>
                    <?php elseif ($order['status'] === 'Đang giao') : ?>
                        <form method="POST" action="/orders/update/<?= htmlspecialchars($order['id']) ?>" class="p-4 border rounded shadow-sm bg-light">
                            <input type="hidden" id="email" name="email" value="<?= htmlspecialchars($order['email']) ?>">
                            <input type="hidden" id="status" name="status" value="Đã nhận">
                            <button type="submit" class="btn btn-primary">Xác Nhận Hoàn Thành</button>
                        </form>
                    <?php else : ?>
                        <p class="text-muted">Đơn hàng Đã hoàn Thành .</p>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-primary">Về trang chủ</a>
                </div>
            </div>
        </div>
        <!-- Bootstrap JS -->
    <?php endforeach; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>