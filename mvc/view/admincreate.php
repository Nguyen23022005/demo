<header>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</header>
<body>
<div class="modal fade" id="addStoreModal" tabindex="-1" aria-labelledby="addStoreModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStoreModalLabel">Thêm Cửa Hàng Mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addStoreForm">
                    <div class="mb-3">
                        <label class="form-label">Tên Cửa Hàng</label>
                        <input type="text" class="form-control" id="storeName" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Địa Chỉ</label>
                        <input type="text" class="form-control" id="storeAddress" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giờ Mở Cửa</label>
                        <input type="text" class="form-control" id="storeHours" placeholder="8:00 - 22:00" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số Điện Thoại</label>
                        <input type="text" class="form-control" id="storePhone" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Lưu Cửa Hàng</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

