
<h1>Product List</h1>
<a href="/products/create" class="btn btn-primary mb-3">Create Product</a>

<?php if (!empty($_SESSION['success_message'])): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($_SESSION['success_message']); ?>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>image</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($products) && is_array($products)): ?>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['id']) ?></td>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><img src="/uploads/<?= htmlspecialchars($product['image']) ?>" width="100"></td>
                <td>$<?= number_format((float)$product['price'], 2) ?></td>
                <td>
                    <a href="/productsVariants/create/<?= htmlspecialchars($product['id']) ?>" class="btn btn-info btn-sm">Add Variant</a>
                    <a href="/products/<?= htmlspecialchars($product['id']) ?>" class="btn btn-info btn-sm">View</a>
                    <a href="/products/edit/<?= htmlspecialchars($product['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="/products/delete/<?= htmlspecialchars($product['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">No products available.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
