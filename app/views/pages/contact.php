<?php
// app/views/pages/contact.php
// Đảm bảo file này được gọi từ layout chính có chứa <head> và các thư viện cần thiết
 require_once '../app/views/layouts/header.php'; 
?>

<!-- Thêm FontAwesome nếu chưa có trong layout chính -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->

<!-- Contact Hero -->
<section class="contact-hero">
    <div class="container">
        <h1>Liên hệ với CleanTech</h1>
        <p>
            Chúng tôi luôn sẵn sàng hỗ trợ khách hàng về sản phẩm,
            giải pháp công nghệ và các dịch vụ kỹ thuật.
        </p>
    </div>
</section>

<!-- Main Content -->
<div class="container">

    <div class="contact-grid">

        <!-- LEFT -->
        <div class="info-card">

            <h2>
                <i class="fas fa-building"></i>
                Thông tin liên hệ
            </h2>

            <div class="contact-detail-item">
                <i class="fas fa-phone-alt"></i>

                <div>
                    <h3>Tổng đài hỗ trợ</h3>

                    <p>
                        <strong>1900 6888</strong>
                    </p>

                    <p>Email: support@cleantech.vn</p>

                    <p>Thời gian: 7:30 - 22:00</p>
                </div>
            </div>

            <div class="contact-detail-item">
                <i class="fas fa-location-dot"></i>

                <div>
                    <h3>Văn phòng chính</h3>

                    <p>
                        123 Nguyễn Trãi, Quận 1,
                        TP.Hồ Chí Minh
                    </p>
                </div>
            </div>

            <h3 class="store-title">
                <i class="fas fa-store"></i>
                Chi nhánh
            </h3>

            <div class="store-list">

                <div class="store-item">
                    <h4>CleanTech Hồ Chí Minh</h4>

                    <p>
                        <i class="fas fa-map-pin"></i>
                        Quận 1, TP.HCM
                    </p>

                    <p>
                        <i class="fas fa-phone"></i>
                        028 1234 5678
                    </p>
                </div>

                <div class="store-item">
                    <h4>CleanTech Hà Nội</h4>

                    <p>
                        <i class="fas fa-map-pin"></i>
                        Cầu Giấy, Hà Nội
                    </p>

                    <p>
                        <i class="fas fa-phone"></i>
                        024 1234 5678
                    </p>
                </div>

                <div class="store-item">
                    <h4>CleanTech Đà Nẵng</h4>

                    <p>
                        <i class="fas fa-map-pin"></i>
                        Hải Châu, Đà Nẵng
                    </p>

                    <p>
                        <i class="fas fa-phone"></i>
                        0236 123 456
                    </p>
                </div>

            </div>
        </div>

        <!-- RIGHT -->
        <div class="form-card">

            <h2>
                <i class="fas fa-envelope"></i>
                Gửi liên hệ
            </h2>

            <p class="form-desc">
                Vui lòng để lại thông tin.
                Chúng tôi sẽ phản hồi trong thời gian sớm nhất.
            </p>

            <!-- Success -->
            <div id="alertSuccess" class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                Gửi liên hệ thành công!
            </div>

            <!-- Error -->
            <div id="alertError" class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <span id="errorMessage"></span>
            </div>

            <!-- FORM -->
            <form id="contactForm">
                <!-- CSRF token (nếu backend yêu cầu, cần render từ PHP) -->
                <!-- <input type="hidden" name="csrf_token" value="<?php // echo $_SESSION['csrf_token']; ?>"> -->

                <div class="form-group">
                    <label>
                        Họ và tên
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="fullname"
                        class="form-control"
                        placeholder="Nhập họ tên"
                    >
                </div>

                <div class="form-group">
                    <label>
                        Email
                        <span class="required">*</span>
                    </label>

                    <input
                        type="email"
                        id="email"
                        class="form-control"
                        placeholder="example@gmail.com"
                    >
                </div>

                <div class="form-group">
                    <label>Số điện thoại</label>

                    <input
                        type="tel"
                        id="phone"
                        class="form-control"
                        placeholder="0xxx xxx xxx"
                    >
                </div>

                <div class="form-group">
                    <label>Tiêu đề</label>

                    <input
                        type="text"
                        id="subject"
                        class="form-control"
                        placeholder="Tiêu đề liên hệ"
                    >
                </div>

                <div class="form-group">
                    <label>
                        Nội dung
                        <span class="required">*</span>
                    </label>

                    <textarea
                        id="message"
                        class="form-control"
                        placeholder="Nhập nội dung liên hệ..."
                    ></textarea>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <i class="fas fa-paper-plane"></i>
                    Gửi liên hệ
                </button>

            </form>
        </div>
    </div>

    <!-- MAP -->
    <div class="map-section">

        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.456097167203!2d106.70175527570395!3d10.77653005920554!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f3b4627d8d1%3A0x79c1c3cfef95c0d5!2zTmfDtGkgVHLhuqFpLCBC4bq_biBUaMOgbmgsIFF14bqtbiAxLCBI4buTIENow60gTWluaA!5e0!3m2!1svi!2s!4v1711111111111"
            loading="lazy"
            allowfullscreen=""
        ></iframe>

    </div>

</div>

<<<<<<< HEAD
<!-- CSS cho phần contact -->
=======
<!-- CSS -->
>>>>>>> 673194b (update contact)
<style>

.contact-hero{
    background: linear-gradient(135deg,#0b2b44,#1e6f5c);
    padding:70px 0;
    color:white;
    text-align:center;
    margin-bottom:50px;
}

.contact-hero h1{
    font-size:48px;
    font-weight:800;
    margin-bottom:15px;
}

.contact-hero p{
    font-size:18px;
    opacity:.9;
}

.contact-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:40px;
    margin-bottom:50px;
}

.info-card,
.form-card{
    background:white;
    border-radius:24px;
    padding:32px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
}

.info-card h2,
.form-card h2{
    font-size:28px;
    margin-bottom:24px;
    color:#0b2b44;
}

.contact-detail-item{
    display:flex;
    gap:18px;
    margin-bottom:28px;
    border-bottom:1px solid #eee;
    padding-bottom:20px;
}

.contact-detail-item i{
    font-size:24px;
    color:#1e6f5c;
}

.contact-detail-item h3{
    margin-bottom:8px;
}

.store-title{
    margin-bottom:20px;
    color:#0b2b44;
}

.store-list{
    display:grid;
    gap:20px;
}

.store-item{
    background:#f8fafc;
    padding:20px;
    border-radius:16px;
    transition:.2s;
}

.store-item:hover{
    transform:translateY(-3px);
}

.store-item h4{
    margin-bottom:10px;
    color:#0b2b44;
}

.store-item p{
    margin:6px 0;
    color:#5f7f9e;
}

.form-desc{
    margin-bottom:24px;
    color:#666;
}

.form-group{
    margin-bottom:20px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
}

.required{
    color:red;
}

.form-control{
    width:100%;
    padding:14px 16px;
    border:1px solid #ddd;
    border-radius:12px;
    font-size:15px;
}

.form-control:focus{
    outline:none;
    border-color:#1e6f5c;
}

textarea.form-control{
    min-height:120px;
    resize:vertical;
}

.btn-submit{
    width:100%;
    border:none;
    background:#1e6f5c;
    color:white;
    padding:14px;
    border-radius:40px;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:.2s;
}

.btn-submit:disabled{
    background:#95a5a6;
    cursor:not-allowed;
}

.btn-submit:hover:not(:disabled){
    background:#0e5545;
}

.alert{
    display:none;
    padding:16px;
    border-radius:12px;
    margin-bottom:20px;
}

.alert.show{
    display:block;
}

.alert-success{
    background:#d4edda;
    color:#155724;
}

.alert-danger{
    background:#f8d7da;
    color:#721c24;
}

.map-section{
    margin-bottom:50px;
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.map-section iframe{
    width:100%;
    height:400px;
    border:0;
}

@media(max-width:768px){

    .contact-grid{
        grid-template-columns:1fr;
    }

    .contact-hero h1{
        font-size:32px;
    }

}

<<<<<<< HEAD
.info-card {
    background: white;
    border-radius: 24px;
    padding: 32px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.info-card h2 {
    font-size: 28px;
    margin-bottom: 24px;
    color: #0b2b44;
    display: flex;
    align-items: center;
    gap: 12px;
}

.info-card h2 i {
    color: #1e6f5c;
}

.info-card h3 {
    font-size: 20px;
    margin: 24px 0 16px;
    color: #0b2b44;
}

.contact-detail-item {
    display: flex;
    gap: 16px;
    margin-bottom: 28px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eef2f9;
}

.contact-detail-item i {
    font-size: 24px;
    color: #1e6f5c;
    min-width: 40px;
}

.contact-detail-item h3 {
    font-size: 18px;
    margin-bottom: 8px;
    margin-top: 0;
    color: #2c3e50;
}

.contact-detail-item p {
    color: #5f7f9e;
    line-height: 1.5;
}

.store-list {
    display: grid;
    gap: 20px;
    margin-top: 10px;
}

.store-item {
    background: #f8fafc;
    padding: 20px;
    border-radius: 16px;
    transition: 0.2s;
    cursor: pointer;
}

.store-item:hover {
    background: #eef2f9;
    transform: translateX(5px);
}

.store-item h4 {
    font-size: 18px;
    color: #0b2b44;
    margin-bottom: 10px;
}

.store-item p {
    font-size: 14px;
    color: #5f7f9e;
    margin: 6px 0;
}

.store-item i {
    width: 24px;
    margin-right: 8px;
    color: #1e6f5c;
}

.form-card {
    background: white;
    border-radius: 24px;
    padding: 32px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.form-card h2 {
    font-size: 28px;
    margin-bottom: 12px;
    color: #0b2b44;
    display: flex;
    align-items: center;
    gap: 12px;
}

.form-card h2 i {
    color: #1e6f5c;
}

.form-card > p {
    color: #5f7f9e;
    margin-bottom: 24px;
    line-height: 1.5;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #2c3e50;
}

.form-group label .required {
    color: #e74c3c;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    font-family: inherit;
    font-size: 15px;
    transition: 0.2s;
}

.form-control:focus {
    outline: none;
    border-color: #1e6f5c;
    box-shadow: 0 0 0 3px rgba(30,111,92,0.1);
}

textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

.btn-submit {
    background: #1e6f5c;
    color: white;
    border: none;
    padding: 14px 32px;
    border-radius: 40px;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    transition: 0.2s;
    width: 100%;
}

.btn-submit:disabled {
    background: #95a5a6;
    cursor: not-allowed;
}

.btn-submit:hover:not(:disabled) {
    background: #0e5545;
    transform: translateY(-2px);
}

.alert {
    padding: 16px;
    border-radius: 12px;
    margin-bottom: 24px;
    display: none;
}

.alert.show {
    display: block;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.map-section {
    margin: 40px 0;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.map-section iframe {
    width: 100%;
    height: 400px;
    border: 0;
}

.hotline-banner {
    background: linear-gradient(120deg, #1e6f5c, #0b2b44);
    border-radius: 20px;
    padding: 40px 30px;
    text-align: center;
    color: white;
    margin: 40px 0;
}

.hotline-banner i {
    font-size: 48px;
    margin-bottom: 16px;
}

.hotline-banner h3 {
    font-size: 28px;
    margin-bottom: 12px;
}

.hotline-number {
    font-size: 36px;
    font-weight: 800;
    margin: 16px 0;
    letter-spacing: 2px;
}

@media (max-width: 768px) {
    .hotline-number {
        font-size: 28px;
    }
}
</style>

<!-- JavaScript xử lý form gọi API -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const submitBtn = document.querySelector('.btn-submit');
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // 1. Lấy dữ liệu
=======
</style>

<!-- JAVASCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function() {

    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const alertSuccess = document.getElementById('alertSuccess');
    const alertError = document.getElementById('alertError');
    const errorMessageSpan = document.getElementById('errorMessage');

    // Helper ẩn alert
    function hideAlerts() {
        alertSuccess.classList.remove('show');
        alertError.classList.remove('show');
    }

    // Helper hiển thị lỗi
    function showError(message) {
        errorMessageSpan.textContent = message;
        alertError.classList.add('show');
        setTimeout(() => {
            alertError.classList.remove('show');
        }, 5000);
    }

    // Helper hiển thị thành công
    function showSuccess() {
        alertSuccess.classList.add('show');
        setTimeout(() => {
            alertSuccess.classList.remove('show');
        }, 5000);
    }

    // Validate số điện thoại (cơ bản)
    function isValidPhone(phone) {
        if (!phone) return true;
        const phoneRegex = /^(0|\+84)[0-9]{9,10}$/;
        return phoneRegex.test(phone);
    }

    // Xây dựng đường dẫn API dựa trên cấu trúc thư mục thực tế
    // Ví dụ: http://localhost/BTL-Web-pages/public/public_entry.php
    function getApiUrl() {
        // Lấy đường dẫn gốc từ window.location, ví dụ: http://localhost/BTL-Web-pages/public/
        const base = window.location.origin + window.location.pathname.split('/').slice(0, -1).join('/');
        return `${base}/public_entry.php?url=contact/save`;
    }

    // Xử lý submit
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        hideAlerts();

>>>>>>> 673194b (update contact)
        const fullname = document.getElementById('fullname').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const subject = document.getElementById('subject').value.trim();
        const message = document.getElementById('message').value.trim();
<<<<<<< HEAD
        
        // 2. Ẩn các thông báo cũ
        document.getElementById('alertSuccess').classList.remove('show');
        document.getElementById('alertError').classList.remove('show');
        
        // 3. Validate cơ bản ở Frontend
        if (fullname === '') return showError('Vui lòng nhập họ tên');
        if (email === '') return showError('Vui lòng nhập email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) return showError('Email không hợp lệ. Vui lòng nhập đúng định dạng (example@email.com)');
        if (message === '') return showError('Vui lòng nhập nội dung tin nhắn');
        
        // 4. Khóa nút bấm và tạo hiệu ứng loading
        const originalBtnText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-pulse"></i> Đang gửi...';

        try {
            // 5. Gọi API Gửi dữ liệu về Server
            const response = await fetch('public_entry.php?url=contact/save', {
=======

        if (fullname === '') {
            showError('Vui lòng nhập họ tên');
            return;
        }
        if (email === '') {
            showError('Vui lòng nhập email');
            return;
        }
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showError('Email không đúng định dạng');
            return;
        }
        if (phone !== '' && !isValidPhone(phone)) {
            showError('Số điện thoại không hợp lệ (định dạng 0xxxxxxxxx hoặc +84xxxxxxxxx)');
            return;
        }
        if (message === '') {
            showError('Vui lòng nhập nội dung');
            return;
        }

        submitBtn.disabled = true;
        const originalBtnText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-pulse"></i> Đang gửi...';

        try {
            const apiUrl = getApiUrl();
            const response = await fetch(apiUrl, {
>>>>>>> 673194b (update contact)
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
<<<<<<< HEAD
                body: JSON.stringify({
                    fullname: fullname,
                    email: email,
                    phone: phone,
                    subject: subject,
                    message: message
                })
            });

            // Parse JSON từ PHP trả về
            const result = await response.json();

            if (result.success) {
                showSuccess(); // Hiện khung xanh lá báo thành công
                form.reset();  // Chỉ xóa các ô khi đã gửi lọt vào database
=======
                body: JSON.stringify({ fullname, email, phone, subject, message })
            });

            if (!response.ok) {
                const errorText = await response.text();
                console.error('Server error:', response.status, errorText);
                throw new Error(`Lỗi server (${response.status})`);
            }

            const contentType = response.headers.get('content-type');
            let result;
            if (contentType && contentType.includes('application/json')) {
                result = await response.json();
            } else {
                const text = await response.text();
                console.error('Response not JSON:', text);
                throw new Error('Server trả về định dạng không hợp lệ');
            }

            if (result.success) {
                showSuccess();
                form.reset();
>>>>>>> 673194b (update contact)
            } else {
                showError(result.message || 'Gửi thất bại, vui lòng thử lại');
            }
        } catch (error) {
<<<<<<< HEAD
            console.error('Lỗi khi gửi:', error);
            showError('Không thể kết nối đến máy chủ. Vui lòng thử lại sau.');
        } finally {
            // Mở khóa nút bấm trở lại
=======
            console.error('Fetch error:', error);
            showError('Không thể kết nối server hoặc có lỗi xảy ra. Vui lòng thử lại sau.');
        } finally {
>>>>>>> 673194b (update contact)
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnText;
        }
    });
<<<<<<< HEAD

    // Helper: Hàm hiển thị lỗi màu đỏ
    function showError(message) {
        const alertDiv = document.getElementById('alertError');
        document.getElementById('errorMessage').textContent = message;
        alertDiv.classList.add('show');
        setTimeout(() => alertDiv.classList.remove('show'), 5000);
    }

    // Helper: Hàm hiển thị thành công màu xanh
    function showSuccess() {
        const alertDiv = document.getElementById('alertSuccess');
        alertDiv.classList.add('show');
        setTimeout(() => alertDiv.classList.remove('show'), 5000);
        document.querySelector('.form-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // Hiệu ứng click cho các store item
    document.querySelectorAll('.store-item').forEach(item => {
        item.addEventListener('click', function() {
            const storeName = this.querySelector('h4').innerText;
            alert(`🏪 ${storeName}\nThông tin chi tiết:\n${this.innerText}`);
        });
    });
});
</script>
=======
});
</script>


<?php require_once '../app/views/layouts/footer.php'; ?>
>>>>>>> 673194b (update contact)
