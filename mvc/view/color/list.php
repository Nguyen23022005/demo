<h1>Categories List</h1>
<a href="colors/create" class="btn btn-primary mb-3">Create size</a>
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
        <?php foreach ($colors as $color): ?>
            
        <tr>
            <td><?= $color['id'] ?></td>
            <td><?= $color['name'] ?></td>
            <td>
                <a href="/colors/<?= $color['id'] ?>" class="btn btn-info btn-sm">View</a>
                <a href="/colors/edit/<?= $color['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="/colors/delete/<?= $color['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>