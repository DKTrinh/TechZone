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
    price DECIMAL(10,2) NOT NULL DEFAULT 0,
    old_price DECIMAL(10,2) DEFAULT 0,
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
    subject VARCHAR(255),
    message TEXT NOT NULL,
    status ENUM('pending', 'resolved') DEFAULT 'pending',
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
    user_id INT NOT NULL,
    customer_name VARCHAR(255),
    customer_phone VARCHAR(20),
    customer_address TEXT,
    total_price DECIMAL(10,2) DEFAULT 0,
    status ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS order_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- ==============================================
-- ĐỔ DỮ LIỆU MẪU (TEST DATA)
-- ==============================================

-- 1. Tài khoản (Mật khẩu mặc định là: 123456)
INSERT INTO users (fullname, email, password, role, status, address) VALUES
('Quản trị viên', 'admin@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 1, 'Hà Nội'),
('Khách hàng', 'user@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', 1, 'Hồ Chí Minh');

-- 2. Danh mục
INSERT INTO categories (id, name, slug) VALUES 
(1, 'Điện thoại', 'dien-thoai'), 
(2, 'Laptop', 'laptop'), 
(3, 'Đồng hồ thông minh', 'dong-ho'), 
(4, 'Phụ kiện', 'phu-kien');

-- 3. Sản phẩm (20 sản phẩm công nghệ)
INSERT INTO products (category_id, brand, name, description, price, old_price, installment_info, thumbnail, stock_count, sold_count) VALUES
(1, 'Apple', 'iPhone 15 Pro Max 256GB Titan', 'Chip A17 Pro mạnh mẽ, camera zoom quang 5x.', 29990000, 34990000, 'Giảm 2 triệu', 'https://images.unsplash.com/photo-1696446701796-da61225697cc?w=500,https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=500', 50, 120),
(1, 'Samsung', 'Samsung Galaxy S24 Ultra 5G', 'Tích hợp Galaxy AI, khung viền Titanium.', 31990000, 33990000, 'Thu cũ đổi mới', 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?w=500', 30, 85),
(1, 'Apple', 'iPhone 14 Pro 128GB', 'Dynamic Island ấn tượng.', 23490000, 26990000, NULL, 'https://images.unsplash.com/photo-1678685888221-cda773a3dcdb?w=500', 15, 200),
(1, 'Xiaomi', 'Xiaomi 14 5G', 'Camera Leica cao cấp, chip Snapdragon 8 Gen 3.', 20990000, 22990000, NULL, 'https://images.unsplash.com/photo-1598327105666-5b89351cb31b?w=500', 40, 45),
(1, 'Oppo', 'OPPO Find N3 Flip', 'Thiết kế gập thời trang, màn hình phụ lớn.', 21500000, 22990000, NULL, 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500', 20, 15),
(2, 'Apple', 'MacBook Air M3 13 inch', 'Laptop mỏng nhẹ, pin 18h.', 27990000, 29990000, 'Tặng túi chống sốc', 'https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?w=500', 40, 210),
(2, 'Dell', 'Dell XPS 15 9530', 'Màn hình OLED viền siêu mỏng.', 45000000, 48000000, 'Tặng chuột', 'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=500', 20, 45),
(2, 'Asus', 'ASUS ROG Strix G16', 'Laptop Gaming hiệu năng cao, tản nhiệt tốt.', 35990000, 38990000, NULL, 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?w=500', 25, 60),
(2, 'HP', 'HP Envy x360', 'Xoay gập 360 độ tiện lợi.', 22490000, 24000000, NULL, 'https://images.unsplash.com/photo-1525547719571-a2d4ac8945e2?w=500', 10, 30),
(2, 'Lenovo', 'Lenovo ThinkPad X1 Carbon', 'Đẳng cấp doanh nhân.', 39900000, 42000000, NULL, 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=500', 15, 25),
(3, 'Apple', 'Apple Watch Series 9', 'Cảm biến nhịp tim, đo SpO2.', 9990000, 11000000, NULL, 'https://images.unsplash.com/photo-1434493789847-2f02dc6ca35d?w=500', 100, 300),
(3, 'Samsung', 'Galaxy Watch 6 Classic', 'Vòng xoay vật lý huyền thoại.', 7490000, 8990000, NULL, 'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?w=500', 60, 150),
(3, 'Garmin', 'Garmin Fenix 7 Pro', 'Đồng hồ thể thao chuyên nghiệp.', 21990000, 22500000, NULL, 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500', 30, 40),
(4, 'Apple', 'AirPods Pro Gen 2', 'Chống ồn chủ động xuất sắc.', 5890000, 6500000, NULL, 'https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?w=500', 200, 500),
(4, 'Sony', 'Sony WH-1000XM5', 'Tai nghe chụp tai cách âm tốt nhất.', 7990000, 8500000, NULL, 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?w=500', 45, 120),
(4, 'Anker', 'Pin sạc dự phòng Anker 20000mAh', 'Sạc nhanh 20W nhỏ gọn.', 950000, 1200000, NULL, 'https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5?w=500', 150, 400),
(4, 'Logitech', 'Chuột Logitech MX Master 3S', 'Chuột công thái học cao cấp.', 2450000, 2700000, NULL, 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=500', 80, 210),
(1, 'Apple', 'iPhone 13 128GB', 'Lựa chọn quốc dân.', 15990000, 18990000, NULL, 'https://images.unsplash.com/photo-1510557880182-3d4d3cba35a5?w=500', 120, 800),
(2, 'Acer', 'Acer Nitro 5', 'Laptop gaming giá rẻ.', 19990000, 22990000, NULL, 'https://images.unsplash.com/photo-1593640408182-31c70c8268f5?w=500', 55, 180),
(4, 'JBL', 'Loa Bluetooth JBL Flip 6', 'Âm trầm mạnh mẽ, chống nước.', 2690000, 2990000, NULL, 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=500', 90, 250);

-- 4. Tin tức & Bài viết (Chỉ giữ lại của TechZone)
INSERT INTO news (title, badge, category, content, image) VALUES
('Apple ra mắt chip M3', 'Mới nhất', 'Công nghệ', 'Chip M3 mới của Apple mang lại hiệu năng vượt trội và tiết kiệm pin đáng kể cho các dòng Macbook thế hệ mới.', 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8');

-- 5. Bình luận mẫu
INSERT INTO comments (user_id, news_id, product_id, content, rating) VALUES
(2, NULL, 1, 'iPhone 15 Pro Max xài mượt, chụp hình siêu nét.', 5),
(2, 1, NULL, 'Cảm ơn admin đã cập nhật thông tin về chip M3 mới.', 4);

-- 6. Nội dung trang
INSERT INTO page_contents (page_key, section_name, content_value) VALUES 
('about_history', 'Tiểu sử & Hình thành', 'TechZone là hệ thống bán lẻ công nghệ hàng đầu...'),
('about_mission', 'Sứ mệnh & Tầm nhìn', 'Mang công nghệ đỉnh cao tới mọi nhà...'),
('about_goal', 'Mục tiêu chiến lược', 'Phủ sóng 63 tỉnh thành...');

-- 7. FAQs
INSERT INTO faqs (title, question, answer, status) VALUES 
('BẢO HÀNH', 'Chính sách bảo hành Laptop Gaming?', 'Bảo hành 12 tháng chính hãng.', 'answered'),
('TRẢ GÓP', 'Có hỗ trợ trả góp 0% không?', 'Có hỗ trợ qua thẻ tín dụng.', 'answered');

SET FOREIGN_KEY_CHECKS = 1;