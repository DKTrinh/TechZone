DROP DATABASE IF EXISTS cleantech;
CREATE DATABASE cleantech CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cleantech;

SET FOREIGN_KEY_CHECKS = 0;

-- 1. Bảng Người dùng
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    role ENUM('admin','client') DEFAULT 'client',
    status TINYINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user_email (email)
);

-- 2. Bảng Danh mục
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Bảng Sản phẩm (Công nghệ - Core Technologies)
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    efficiency VARCHAR(20), -- Vd: '99.8%' để show ra giao diện
    price DECIMAL(10,2) NOT NULL DEFAULT 0,
    thumbnail VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_product_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
    INDEX idx_product_category (category_id)
);

-- 4. Bảng Bài viết (Success Stories / News)
CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    badge VARCHAR(50), -- Vd: '45% reduction'
    category VARCHAR(100), -- Vd: 'Power Generation'
    content TEXT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 5. Bảng Bình luận (Comments)
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NULL,
    news_id INT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_comment_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_comment_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    CONSTRAINT fk_comment_news FOREIGN KEY (news_id) REFERENCES news(id) ON DELETE CASCADE
);

-- 6. Bảng Giỏ hàng & Đơn hàng (Cart & Orders)
CREATE TABLE carts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_cart_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    CONSTRAINT fk_cart_item_cart FOREIGN KEY (cart_id) REFERENCES carts(id) ON DELETE CASCADE,
    CONSTRAINT fk_cart_item_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_price DECIMAL(10,2) DEFAULT 0,
    status ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_order_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE order_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    price DECIMAL(10,2) NOT NULL,
    CONSTRAINT fk_order_detail_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    CONSTRAINT fk_order_detail_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

SET FOREIGN_KEY_CHECKS = 1;

-- DỮ LIỆU MẪU ĐỂ TEST TRANG CHỦ
INSERT INTO categories (name, slug) VALUES ('Flue Gas Treatment', 'flue-gas-treatment');

INSERT INTO products (category_id, name, description, efficiency) VALUES
(1, 'Electrostatic Precipitation', 'High-efficiency particle removal using electrostatic forces to capture fine particulates.', '99.8%'),
(1, 'Wet Scrubbing Systems', 'Liquid-based absorption technology for removing acidic gases and soluble pollutants.', '98.5%'),
(1, 'Selective Catalytic Reduction', 'Advanced catalytic process for converting nitrogen oxides into harmless nitrogen and water vapor.', '95.0%'),
(1, 'Fabric Filtration', 'Baghouse technology using specialized filter media to capture particulate matter.', '99.9%'),
(1, 'Activated Carbon Injection', 'Sorbent-based system for mercury and heavy metal removal through chemical adsorption.', '90.0%'),
(1, 'AI-Powered Optimization', 'Machine learning algorithms that continuously optimize system performance.', '100%');

INSERT INTO news (title, badge, category, content, image) VALUES
('Global Energy Corp', '45% reduction in emissions', 'Power Generation', 'Implemented comprehensive flue gas treatment system across 3 coal-fired power plants.', 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b'),
('SteelTech Industries', '60% NOx reduction', 'Steel Manufacturing', 'Retrofitted existing facilities with SCR technology, dramatically improving air quality.', 'https://images.unsplash.com/photo-1581094288338-2314dddb7ece'),
('Maritime Solutions Ltd', 'IMO 2020 Compliance', 'Shipping', 'Deployed compact scrubber systems across fleet of 50 vessels, ensuring full regulatory compliance.', 'https://images.unsplash.com/photo-1494412574643-ff11b0a5c1c3');