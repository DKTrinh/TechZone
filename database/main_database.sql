DROP DATABASE IF EXISTS techzone;
CREATE DATABASE techzone CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE techzone;

SET FOREIGN_KEY_CHECKS = 0;

-- ==============================================
-- 1. BẢNG NGƯỜI DÙNG (USERS)
-- ==============================================
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address VARCHAR(255),
    avatar VARCHAR(255),
    gender ENUM('male', 'female', 'other'),
    birthdate DATE,
    bio TEXT,
    role ENUM('admin','client') DEFAULT 'client',
    status TINYINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user_email (email)
);

-- ==============================================
-- 2. BẢNG DANH MỤC (CATEGORIES)
-- ==============================================
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==============================================
-- 3. BẢNG SẢN PHẨM (PRODUCTS)
-- ==============================================
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    brand VARCHAR(50) DEFAULT 'OEM',
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(15,2) NOT NULL DEFAULT 0,
    old_price DECIMAL(15,2) DEFAULT 0,
    installment_info VARCHAR(50),
    thumbnail TEXT,
    stock_count INT DEFAULT 100,
    sold_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_product_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- ==============================================
-- 4. BẢNG TIN TỨC (NEWS)
-- ==============================================
CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    badge VARCHAR(50), 
    category VARCHAR(100), 
    content TEXT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==============================================
-- 5. BẢNG BÌNH LUẬN (COMMENTS)
-- ==============================================
CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NULL,
    news_id INT NULL,
    content TEXT NOT NULL,
    rating INT DEFAULT 5,
    status TINYINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_comment_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_comment_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    CONSTRAINT fk_comment_news FOREIGN KEY (news_id) REFERENCES news(id) ON DELETE CASCADE
);

-- ==============================================
-- 6. BẢNG LIÊN HỆ (CONTACTS)
-- ==============================================
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(255),
    message TEXT NOT NULL,
    status ENUM('unread', 'read', 'replied') DEFAULT 'unread',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==============================================
-- 7. BẢNG NỘI DUNG TRANG (PAGE_CONTENTS)
-- ==============================================
CREATE TABLE IF NOT EXISTS page_contents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_key VARCHAR(50) NOT NULL UNIQUE,
    section_name VARCHAR(100) NOT NULL,
    content_value TEXT NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ==============================================
-- 8. BẢNG CÂU HỎI THƯỜNG GẶP (FAQS)
-- ==============================================
CREATE TABLE IF NOT EXISTS faqs (
    f_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    question TEXT NOT NULL,
    answer TEXT,
    status ENUM('pending', 'answered') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==============================================
-- 9. BẢNG ĐƠN HÀNG (ORDERS & ORDER_DETAILS)
-- ==============================================
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_code VARCHAR(20) UNIQUE,
    user_id INT NOT NULL,
    customer_name VARCHAR(255),
    customer_phone VARCHAR(20),
    customer_address TEXT,
    total_price DECIMAL(15,2) DEFAULT 0,
    original_amount DECIMAL(15,2) DEFAULT 0,
    discount_amount DECIMAL(15,2) DEFAULT 0,
    voucher_code VARCHAR(50) NULL,
    status ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS order_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    price DECIMAL(15,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- ==============================================
-- 10. BẢNG MÃ GIẢM GIÁ (VOUCHERS) & VÍ VOUCHER
-- ==============================================
CREATE TABLE IF NOT EXISTS vouchers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) UNIQUE NOT NULL,
    discount_type ENUM('percent', 'fixed') NOT NULL,
    discount_value DECIMAL(15,2) NOT NULL,
    min_order_value DECIMAL(15,2) DEFAULT 0,
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    usage_limit INT DEFAULT 1,
    used_count INT DEFAULT 0,
    target_type ENUM('all', 'category', 'product') DEFAULT 'all',
    target_ids VARCHAR(255) NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS user_vouchers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    voucher_id INT NOT NULL,
    is_used TINYINT(1) DEFAULT 0,
    saved_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (voucher_id) REFERENCES vouchers(id) ON DELETE CASCADE
);

-- ==============================================
-- 11. BẢNG ĐỔI / TRẢ HÀNG & THÔNG BÁO
-- ==============================================
CREATE TABLE IF NOT EXISTS return_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    reason TEXT NOT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL, 
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==============================================
-- ĐỔ DỮ LIỆU MẪU (TEST DATA)
-- ==============================================

-- 1. Tài khoản (Mật khẩu mặc định là: 123456)
INSERT INTO users (fullname, email, password, role, status, address) VALUES
('Quản trị viên', 'admin@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 1, 'Hà Nội'),
('Khách hàng', 'user@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', 1, 'Hồ Chí Minh');

-- 2. Danh mục (Bổ sung thêm danh mục từ 5->8 để chứa sản phẩm mới)
INSERT INTO categories (id, name, slug) VALUES 
(1, 'Điện thoại', 'dien-thoai'), 
(2, 'Laptop', 'laptop'), 
(3, 'Đồng hồ thông minh', 'dong-ho'), 
(4, 'Phụ kiện', 'phu-kien'),
(5, 'Máy tính bảng', 'may-tinh-bang'),
(6, 'Thiết bị âm thanh', 'thiet-bi-am-thanh'),
(7, 'Máy ảnh & Camera', 'may-anh-camera'),
(8, 'Nhà thông minh', 'nha-thong-minh');

-- 3. Sản phẩm (30 sản phẩm công nghệ từ file mới)
INSERT INTO products (name, category_id, brand, price, old_price, stock_count, description, thumbnail) VALUES
('iPhone 15 Pro Max 256GB', 1, 'Apple', 29990000, 34990000, 50, 'Titanium siêu nhẹ, chip A17 Pro.', 'assets/uploads/products/1.png'),
('Samsung Galaxy S24 Ultra', 1, 'Samsung', 31990000, 33990000, 40, 'Galaxy AI đỉnh cao.', 'assets/uploads/products/2.png'),
('MacBook Air M2 13 inch', 2, 'Apple', 24990000, 27990000, 30, 'Laptop mỏng nhẹ, pin 18h.', 'assets/uploads/products/3.png'),
('Laptop Gaming Acer Nitro 5', 2, 'Acer', 21990000, 23990000, 25, 'RTX 3050 chiến game cực mượt.', 'assets/uploads/products/4.png'),
('Apple Watch Series 9', 3, 'Apple', 9990000, 11990000, 60, 'Màn hình siêu sáng, chạm 2 lần.', 'assets/uploads/products/5.png'),
('Samsung Galaxy Watch 6', 3, 'Samsung', 7490000, 8990000, 45, 'Theo dõi sức khỏe toàn diện.', 'assets/uploads/products/6.png'),
('Tai nghe AirPods Pro 2', 6, 'Apple', 5890000, 6990000, 100, 'Chống ồn chủ động ANC.', 'assets/uploads/products/7.png'),
('Sony WH-1000XM5', 6, 'Sony', 7990000, 8490000, 20, 'Tai nghe over-ear chống ồn tốt nhất.', 'assets/uploads/products/8.png'),
('iPad Pro 11 inch M2', 5, 'Apple', 21490000, 23990000, 35, 'Máy tính bảng siêu mạnh.', 'assets/uploads/products/9.png'),
('Samsung Galaxy Tab S9', 5, 'Samsung', 19990000, 21990000, 40, 'Màn hình Dynamic AMOLED 2X.', 'assets/uploads/products/10.png'),
('Máy ảnh Sony Alpha A6700', 7, 'Sony', 34990000, 36990000, 15, 'Lấy nét AI, quay 4K.', 'assets/uploads/products/11.png'),
('Canon EOS R50', 7, 'Canon', 31990000, 33990000, 10, 'Nhỏ gọn, mạnh mẽ cho Vlogger.', 'assets/uploads/products/12.png'),
('Robot Hút Bụi Roborock S8', 8, 'Roborock', 15990000, 18990000, 20, 'Lực hút mạnh, giặt giẻ tự động.', 'assets/uploads/products/13.png'),
('Camera An Ninh Xiaomi C300', 8, 'Xiaomi', 950000, 1200000, 150, 'Quay 2K sắc nét, đàm thoại 2 chiều.', 'assets/uploads/products/14.png'),
('Sạc Dự Phòng Anker 20000mAh', 4, 'Anker', 950000, 1250000, 200, 'Sạc nhanh PD 20W.', 'assets/uploads/products/15.png'),
('Chuột Logitech MX Master 3S', 4, 'Logitech', 2450000, 2800000, 80, 'Chuột văn phòng đỉnh nhất.', 'assets/uploads/products/16.png'),
('Bàn phím cơ Keychron K8 Pro', 4, 'Keychron', 2290000, 2590000, 40, 'Custom switch, không dây.', 'assets/uploads/products/17.png'),
('Oppo Z Flip 5', 1, 'Oppo', 25990000, 28990000, 20, 'Gập sành điệu.', 'assets/uploads/products/18.png'),
('Xiaomi 14 Pro', 1, 'Xiaomi', 23990000, 25990000, 25, 'Leica camera.', 'assets/uploads/products/19.png'),
('Laptop Asus Predator', 2, 'Asus', 35990000, 39990000, 10, 'Gaming cấu hình khủng.', 'assets/uploads/products/20.png'),
('Garmin Fenix 7 Pro', 3, 'Garmin', 21990000, 23990000, 15, 'Pin vô đối, GPS chuẩn.', 'assets/uploads/products/21.png'),
('Đồng hồ Amazfit 4', 3, 'Amazfit', 4500000, 5000000, 40, 'Thể thao chuyên dụng.', 'assets/uploads/products/22.png'),
('Loa Bluetooth JBL Flip 6', 4, 'JBL', 2690000, 2990000, 120, 'Chống nước IP67.', 'assets/uploads/products/23.png'),
('Microphone Rode NT', 4, 'Rode', 3500000, 4000000, 30, 'Thu âm chuyên nghiệp.', 'assets/uploads/products/24.png'),
('Kindle Paperwhite 5', 5, 'Amazon', 3500000, 4000000, 50, 'Đọc sách không mỏi mắt.', 'assets/uploads/products/25.png'),
('iPad Mini 6', 5, 'Apple', 12990000, 14990000, 60, 'Nhỏ gọn cầm tay.', 'assets/uploads/products/26.png'),
('Tai nghe Marshall', 6, 'Marshall', 4500000, 5500000, 35, 'Classic design.', 'assets/uploads/products/27.png'),
('Gopro Hero 12', 7, 'Gopro', 9990000, 11500000, 25, 'Action camera.', 'assets/uploads/products/28.png'),
('Bóng Đèn Philips Hue', 8, 'Philips', 1200000, 1500000, 100, 'Đèn thông minh.', 'assets/uploads/products/29.png'),
('Ổ Cắm Thông Minh Tuya', 8, 'Tuya', 350000, 500000, 200, 'Điều khiển qua WiFi.', 'assets/uploads/products/30.png');

-- 4. Tin tức & Bài viết
INSERT INTO news (title, badge, category, content, image) VALUES
('Apple ra mắt chip M3', 'Mới nhất', 'Công nghệ', 'Chip M3 mới của Apple mang lại hiệu năng vượt trội và tiết kiệm pin đáng kể cho các dòng Macbook thế hệ mới.', '31.png');

-- 5. Bình luận mẫu
INSERT INTO comments (user_id, news_id, product_id, content, rating) VALUES
(2, NULL, 1, 'iPhone 15 Pro Max xài mượt, chụp hình siêu nét.', 5),
(2, 1, NULL, 'Cảm ơn admin đã cập nhật thông tin về chip M3 mới.', 4);

-- 6. Nội dung trang
INSERT INTO page_contents (page_key, section_name, content_value) VALUES 
('about_history', 'Tiểu sử & Hình thành', 'TechZone là hệ thống bán lẻ công nghệ hàng đầu...'),
('about_mission', 'Sứ mệnh & Tầm nhìn', 'Mang công nghệ đỉnh cao tới mọi nhà...'),
('about_goal', 'Mục tiêu chiến lược', 'Phủ sóng 34 tỉnh thành...');

-- 7. FAQs
INSERT INTO faqs (title, question, answer, status) VALUES 
('BẢO HÀNH', 'Chính sách bảo hành Laptop Gaming?', 'Bảo hành 12 tháng chính hãng.', 'answered'),
('TRẢ GÓP', 'Có hỗ trợ trả góp 0% không?', 'Có hỗ trợ qua thẻ tín dụng.', 'answered');

SET FOREIGN_KEY_CHECKS = 1;