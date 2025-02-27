CREATE TABLE coupons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) NOT NULL UNIQUE,           -- Mã coupon, duy nhất
    discount DECIMAL(10,2) NOT NULL,              -- Giá trị giảm giá
    discount_type ENUM('percentage', 'fixed') NOT NULL,  -- Loại giảm giá: phần trăm hoặc cố định
    start_date DATETIME NOT NULL,                 -- Ngày bắt đầu áp dụng
    end_date DATETIME NOT NULL,                   -- Ngày kết thúc áp dụng
    usage_limit INT DEFAULT NULL,                 -- Số lần sử dụng tối đa (NULL: không giới hạn)
    usage_count INT DEFAULT 0,                    -- Số lần đã sử dụng
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,          -- Thời gian tạo
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  -- Thời gian cập nhật
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
