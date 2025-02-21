<h1>Cart List</h1>
<a href="/cart/create" class="btn btn-primary mb-3">Create cart</a>

<?php
if (count($carts) == 0) {
    echo "<h5 class='text-center'>No carts found</h5>";
}

?>
<?php if (!empty($_SESSION['success_message'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['success_message']; ?>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>sku</th>
            <th>quantity</th>
            <th>Price</th>
            <th>total</th>
            <th>Actions
                <form action="/carts/remove" method="post" style="display:inline;">
                    <button type="submit" class="btn btn-danger">Remove All</button>
                </form>
            </th>

        </tr>
    </thead>
    <tbody>
        <?php
        $total = 0;

        ?>


        <?php foreach ($carts as $cart): ?>

            <tr>
                <td><?= $cart['id'] ?></td>
                <td><?= $cart['sku'] ?></td>
                <td>
                    <form action="/carts/update/<?= $cart['user_id'] ?>" method="post" class="d-flex">
                        <input type="number" value="<?= $cart['quantityy'] ?>" class="form-control" min="0" style="width: 100px" name="quantityy" />
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>
                </td>
                <td><?= $cart['price'] ?></td>
                <td><?= $cart['price'] * $cart['quantityy'] ?> <?php
                                                                $total += $cart['price'] * $cart['quantityy'];
                                                                ?>
                </td>

                <td>
                    <a href="/carts/<?= $cart['id'] ?>" class="btn btn-info btn-sm">View</a>
                    <form action="/carts/delete/<?= $cart['id_Cart'] ?>" method="POST" style="display:inline;">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</button>
                    </form>
                    <!-- <a href="/carts/delete/<?= $cart['id_Cart'] ?>" class="btn btn-danger btn-sm">Delete</a> -->
                </td>

            </tr>

        <?php endforeach; ?>
        <tr>
            <td colspan="4">Total</td>
            <td><?= $total ?></td>
        </tr>
    </tbody>

</table>
<a href="/checkout" class="btn btn-primary mb-3">Checkout</a>