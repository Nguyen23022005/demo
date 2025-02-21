


<h1>Create Product Variants</h1>
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <?php if ($products) : ?>
            <label for="product_id" class="form-label">Product</label>
            <select class="form-select" id="product_id" name="product_id" required>
                <option value="">Select a product</option>
                <?php foreach ($products as $product) : ?>
                    <option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <?php if ($sizes) : ?>
            <label for="size" class="form-label">Size</label>
            <select class="form-select" id="size" name="sizeId" required>
                <option value="">Select a Size</option>
                <?php foreach ($sizes as $size) : ?>
                    <option value="<?= $size['id'] ?>"><?= $size['name'] ?></option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <?php if ($colors) : ?>
            <label for="color" class="form-label">Color</label>
            <select class="form-select" id="color" name="colorId" required>
                <option value="">Select a Color</option>
                <?php foreach ($colors as $color) : ?>
                    <option value="<?= $color['id'] ?>"><?= $color['name'] ?></option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="sku" class="form-label">SKU (unique)</label>
        <input type="text" class="form-control" id="sku" name="sku" required>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price" required>
    </div>

    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" required>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image" required>
    </div>

    <button type="submit" class="btn btn-success">Create</button>
</form>






