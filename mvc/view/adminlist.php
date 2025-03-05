<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý cửa hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">Quản Lý Cửa Hàng</h2>

    <!-- Search & Add Button -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" id="searchInput" class="form-control" placeholder="🔍 Tìm kiếm cửa hàng..." onkeyup="filterTable()">
        </div>
        <div class="col-md-6 text-end">
            <!-- Button to Open Modal -->
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStoreModal">➕ Thêm Cửa Hàng</button>
        </div>
    </div>

    <!-- Store Table -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Tên Cửa Hàng</th>
                <th>Địa Chỉ</th>
                <th>Giờ Mở Cửa</th>
                <th>Số Điện Thoại</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody id="storeTable">
            <tr>
                <td>1</td>
                <td>YODY Kinh Môn 2</td>
                <td>Ngã tư Hiệp Sơn</td>
                <td>8:00 - 22:00</td>
                <td>0918133258</td>
                <td>
                    <button class="btn btn-warning btn-sm">✏️ Sửa</button>
                    <button class="btn btn-danger btn-sm">🗑️ Xóa</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal: Add Store -->

<!-- JavaScript -->
<script>
    function filterTable() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let rows = document.querySelectorAll("#storeTable tr");
        rows.forEach(row => {
            let name = row.cells[1].textContent.toLowerCase();
            let address = row.cells[2].textContent.toLowerCase();
            row.style.display = (name.includes(input) || address.includes(input)) ? "" : "none";
        });
    }

    document.getElementById("addStoreForm").addEventListener("submit", function (e) {
        e.preventDefault();

        // Get input values
        let storeName = document.getElementById("storeName").value;
        let storeAddress = document.getElementById("storeAddress").value;
        let storeHours = document.getElementById("storeHours").value;
        let storePhone = document.getElementById("storePhone").value;

        // Get table
        let table = document.getElementById("storeTable");

        // Insert new row
        let newRow = table.insertRow();
        newRow.innerHTML = `
            <td>${table.rows.length}</td>
            <td>${storeName}</td>
            <td>${storeAddress}</td>
            <td>${storeHours}</td>
            <td>${storePhone}</td>
            <td>
                <button class="btn btn-warning btn-sm">✏️ Sửa</button>
                <button class="btn btn-danger btn-sm" onclick="this.closest('tr').remove()">🗑️ Xóa</button>
            </td>
        `;

        // Reset form
        document.getElementById("addStoreForm").reset();

        // Close modal
        let modal = new bootstrap.Modal(document.getElementById("addStoreModal"));
        modal.hide();
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>