# TechZone - Website Công ty & Doanh nghiệp (Thương mại điện tử)

<p align="center">
  <img src="https://img.shields.io/badge/PHP-7.4%2B-blue?style=for-the-badge&logo=php">
  <img src="https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge&logo=mysql">
  <img src="https://img.shields.io/badge/MVC-Architecture-success?style=for-the-badge">
  <img src="https://img.shields.io/badge/Bootstrap-5.3.3-purple?style=for-the-badge&logo=bootstrap">
  <img src="https://img.shields.io/badge/Status-Completed-brightgreen?style=for-the-badge">
</p>

<p align="center">
Dự án môn học <b>Lập trình Web (CO3049)</b><br>
Trường Đại học Bách Khoa - ĐHQG TP.HCM
</p>

---

## 📖 Giới thiệu

**TechZone** là một ứng dụng web hoàn chỉnh dành cho doanh nghiệp, được xây dựng như bài tập lớn cho môn **Lập trình Web (CO3049)** tại **Trường Đại học Bách Khoa - ĐHQG TP.HCM**.

Hệ thống được phát triển bằng **PHP thuần** theo mô hình **MVC tự định nghĩa**, tập trung vào:

- ⚡ Hiệu năng
- 🔒 Bảo mật
- 🧩 Khả năng mở rộng
- 💻 Tương thích nhiều môi trường

---

# 🚀 Tính năng chính

## 👤 Phân hệ Khách hàng (Client-side)

### 🏠 Trang chủ
- Hiển thị giải pháp công nghệ
- Sản phẩm mới
- Tin tức nổi bật

### 🛒 Danh mục sản phẩm
- Duyệt sản phẩm theo nhóm:
  - Laptop
  - Điện thoại
  - Smart Home
  - Thiết bị công nghệ
- Tìm kiếm
- Lọc sản phẩm

### 📦 Chi tiết sản phẩm
- Xem thông số kỹ thuật
- Mô tả chi tiết
- Bình luận
- Đánh giá

### 💳 Giỏ hàng & Thanh toán
- Quản lý giỏ hàng bằng Session
- Đặt hàng linh hoạt
- Thanh toán:
  - COD
  - Chuyển khoản

### 📰 Tin tức
- Bài viết truyền thông
- Tin công nghệ
- Kiến thức chuyên ngành

### 👤 Quản lý tài khoản
- Đăng ký
- Đăng nhập
- Chỉnh sửa hồ sơ
- Lịch sử đơn hàng

### ❓ Hỗ trợ
- FAQs
- Form liên hệ

---

## ⚙️ Phân hệ Quản trị (Admin-side)

Sử dụng giao diện:

**Srtdash Admin Template**

### 📊 Dashboard
- Thống kê đơn hàng
- Thống kê doanh thu
- Thành viên
- Biểu đồ:
  - Bar Chart
  - Line Chart

### 📦 Quản lý sản phẩm
CRUD đầy đủ:

- Thêm
- Sửa
- Xóa

Ngoài ra:

- Quản lý tồn kho
- Quản lý hình ảnh

### 📋 Quản lý đơn hàng
Quy trình xử lý:

```text
Chờ duyệt
   ↓
Đang xử lý
   ↓
Đang giao
   ↓
Hoàn thành
```

### 👥 Quản lý thành viên

- Xem danh sách người dùng
- Kích hoạt tài khoản
- Khóa tài khoản
- Phân quyền

### 📰 Quản lý nội dung

- Tin tức
- Danh mục
- Phản hồi liên hệ

### ⭐ Kiểm duyệt

- Bình luận
- Đánh giá khách hàng

---

# 🛠 Công nghệ sử dụng

## Backend

- PHP 7.4 / 8.x
- MySQL
- PDO
- Prepared Statements

## Frontend

- HTML5 Semantic
- CSS3
- JavaScript ES6
- jQuery

## UI Framework

- Bootstrap 5.3.3
- Srtdash Admin Template
- Google Fonts (Inter)

## Kiến trúc

- MVC (Model - View - Controller)

---

# 🔒 Bảo mật

Dự án áp dụng nhiều cơ chế bảo mật:

### Mã hóa mật khẩu

Sử dụng:

```php
password_hash(
    $password,
    PASSWORD_BCRYPT
);
```

---

### Chống SQL Injection

Sử dụng:

```php
PDO + Prepared Statements
```

Ví dụ:

```php
$stmt=$pdo->prepare(
"SELECT * FROM users
WHERE email=?"
);

$stmt->execute([$email]);
```

---

### Chống XSS

```php
htmlspecialchars()
```

---

### Chống CSRF

Sử dụng:

```php
CSRF Token
```

---

# 📂 Cấu trúc thư mục

```text
TechZone/
│
├── app/
│   │
│   ├── config/
│   │      Database & App Config
│   │
│   ├── core/
│   │      Base classes
│   │
│   ├── controllers/
│   │      Admin + Client Controllers
│   │
│   ├── models/
│   │      Database interaction
│   │
│   ├── views/
│   │      User Interface
│   │
│   ├── routes/
│   │      URL definitions
│   │
│   └── helpers/
│          Session, CSRF, Upload...
│
├── database/
│      main_database.sql
│
├── public/
│   │
│   ├── assets/
│   │      CSS
│   │      JS
│   │      Images
│   │      Uploads
│   │
│   └── public_entry.php
│
└── ...
```

---

# 💻 Cài đặt và sử dụng

## Yêu cầu hệ thống

- PHP >= 7.4
- Khuyến nghị PHP 8.x
- MySQL/MariaDB
- Apache hoặc Nginx

---

## Bước 1: Clone dự án

```bash
git clone https://github.com/DKTrinh/TechZone.git
```

---

## Bước 2: Tạo Database

Mở:

```text
phpMyAdmin
```

Tạo database:

```text
techzone
```

Import file:

```text
database/main_database.sql
```

---

## Bước 3: Cấu hình Database

Mở file:

```text
app/config/db_config.php
```

Chỉnh sửa:

```php
define("DB_HOST","localhost");
define("DB_NAME","techzone");
define("DB_USER","root");
define("DB_PASS","");
```

---

## Bước 4: Chạy ứng dụng

### Cách 1 (Khuyên dùng)

Kiểm tra PHP:

```bash
php -v
```

Nếu hiển thị phiên bản PHP, chạy:

```bash
php -S localhost:8000 -t public
```

Truy cập:

```text
http://localhost:8000/public_entry.php
```

---

Nếu báo lỗi:

```text
'php' is not recognized...
```

hãy dùng đường dẫn trực tiếp tới `php.exe`.

Ví dụ XAMPP cài ở ổ C:

```bash
C:\xampp\php\php.exe -S localhost:8000 -t public
```

Ví dụ XAMPP cài ở ổ D:

```bash
D:\xampp\php\php.exe -S localhost:8000 -t public
```
Sau khi Terminal hiển thị:

```text
Development Server (http://localhost:8000) started
```

truy cập:

```text
http://localhost:8000/public_entry.php
```

---

### Cách 2: Dùng XAMPP / WAMP

Copy project vào:

```text
C:\xampp\htdocs\
```

hoặc:

```text
D:\xampp\htdocs\
```

Sau đó khởi động:

- Apache
- MySQL

trong XAMPP Control Panel.

Truy cập:

```text
http://localhost/TechZone/public/public_entry.php
```

---

# 🔑 Tài khoản kiểm thử

Sau khi cài đặt xong, có thể sử dụng tài khoản demo:

## 👑 Admin

Email:

```text
admin@gmail.com
```

Mật khẩu:

```text
password
```

---

## 👤 User

Email:

```text
user@gmail.com
```

Mật khẩu:

```text
password
```

---

<p align="center">
Made with ❤️ by TechZone Team
</p>
