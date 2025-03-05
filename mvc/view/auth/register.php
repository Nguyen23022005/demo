<h1 class="text-center my-4">Register</h1>
<?php if (isset($error)): ?>
    <div class="alert alert-danger text-center" role="alert">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>
<div class="container">
    <form method="POST" class="w-50 mx-auto border p-4 rounded shadow">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control <?= !empty($errors['name']) ? 'is-invalid' : '' ?>" 
                   id="name" name="name" value="<?= htmlspecialchars($name ?? '') ?>" placeholder="Enter your name" >
            <?php if (!empty($errors['name'])): ?>
                <div class="invalid-feedback"><?= htmlspecialchars($errors['name']) ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>" 
                   value="<?= htmlspecialchars($email ?? '') ?>" placeholder="Enter your email" >
            <?php if (!empty($errors['email'])): ?>
                <div class="invalid-feedback"><?= htmlspecialchars($errors['email']) ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control <?= !empty($errors['password']) ? 'is-invalid' : '' ?>" 
                   placeholder="Enter your password" >
            <?php if (!empty($errors['password'])): ?>
                <div class="invalid-feedback"><?= htmlspecialchars($errors['password']) ?></div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
    <p class="text-center mt-3">
        Already have an account? <a href="/login">Login</a>
    </p>
</div>
