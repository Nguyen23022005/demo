<h1 class="text-center mb-4">Danh sách địa chỉ</h1>

<div class="container">
    <form method="POST" action="/addresses/save">
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>Chọn</th>
                    <th>Tên</th>
                    <th>Đường</th>
                    <th>Thành phố</th>
                    <th>Bang</th>
                    <th>Mã bưu điện</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($addresses as $address): ?>
                    <tr>
                        <td class="text-center">
                            <input 
                                type="radio" 
                                name="selected_address" 
                                value="<?= $address['id'] ?>" 
                                <?= $address['selected'] ? 'checked' : '' ?>>
                        </td>
                        <td><?= htmlspecialchars($address['name']) ?></td>
                        <td><?= htmlspecialchars($address['street']) ?></td>
                        <td><?= htmlspecialchars($address['city']) ?></td>
                        <td><?= htmlspecialchars($address['state']) ?></td>
                        <td><?= htmlspecialchars($address['zipcode']) ?></td>
                        <td class="text-center">
                            <a href="/addresses/edit/<?= $address['id'] ?>" class="btn btn-sm btn-primary">Chỉnh sửa</a>
                            <a href="/addresses/delete/<?= $address['id'] ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-success">Lưu lựa chọn</button>
            <a href="/addresses/create" class="btn btn-primary">Thêm địa chỉ mới</a>
        </div>
    </form>
</div>