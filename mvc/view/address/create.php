<h1 class="mb-4 text-center">Thêm địa chỉ mới</h1>

<div class="card shadow-sm mx-auto" style="max-width: 600px;">
    <div class="card-body">
        <form method="POST" action="/addresses/create">
            <!-- Tên -->
            <div class="mb-4">
                <label for="name" class="form-label fw-bold">Tên</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="name" 
                    name="name" 
                    placeholder="Nhập tên" 
                    required>
            </div>

            <!-- Đường -->
            <div class="mb-4">
                <label for="street" class="form-label fw-bold">Đường</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="street" 
                    name="street" 
                    placeholder="Nhập tên đường" 
                    required>
            </div>

            <!-- Thành phố -->
            <div class="mb-4">
                <label for="city" class="form-label fw-bold">Thành phố</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="city" 
                    name="city" 
                    placeholder="Nhập tên thành phố" 
                    required>
            </div>

            <!-- Bang -->
            <div class="mb-4">
                <label for="state" class="form-label fw-bold">Bang</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="state" 
                    name="state" 
                    placeholder="Nhập tên bang" 
                    required>
            </div>

            <!-- Mã bưu điện -->
            <div class="mb-4">
                <label for="zipcode" class="form-label fw-bold">Mã bưu điện</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="zipcode" 
                    name="zipcode" 
                    placeholder="Nhập mã bưu điện" 
                    required>
            </div>

            <!-- Nút hành động -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success px-4">Thêm</button>
                <a href="/addresses" class="btn btn-secondary px-4">Quay lại</a>
            </div>
        </form>
    </div>
</div>