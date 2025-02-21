<h1>Create Product</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
        <?php if (isset($errors['name'])): ?>
            <div class="invalid-feedback"><?= htmlspecialchars($errors['name']) ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>" id="description" name="description" rows="4"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
        <?php if (isset($errors['description'])): ?>
            <div class="invalid-feedback"><?= htmlspecialchars($errors['description']) ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control <?= isset($errors['price']) ? 'is-invalid' : '' ?>" id="price" name="price" step="0.01" value="<?= htmlspecialchars($_POST['price'] ?? '') ?>" required>
        <?php if (isset($errors['price'])): ?>
            <div class="invalid-feedback"><?= htmlspecialchars($errors['price']) ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Product Image</label>
        <input type="file" class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>" id="productImage" name="image">
        <?php if (isset($errors['image'])): ?>
            <div class="invalid-feedback"><?= htmlspecialchars($errors['image']) ?></div>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-success">Create</button>
</form>