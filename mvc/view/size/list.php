<h1>size List</h1>
<a href="/sizes/create" class="btn btn-primary mb-3">Create size</a>
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
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sizes as $size): ?>
        <tr>
            <td><?= $size['id'] ?></td>
            <td><?= $size['name'] ?></td>
            <td>
                <a href="/sizes/<?= $size['id'] ?>" class="btn btn-info btn-sm">View</a>
                <a href="/sizes/edit/<?= $size['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="/sizes/delete/<?= $size['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>