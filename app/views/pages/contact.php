<?php

?>

<!-- Contact Hero Section -->
<section class="contact-hero">
    <div class="container">
        <h1>Liên hệ với TechZone</h1>
        <p>Chúng tôi luôn sẵn sàng hỗ trợ bạn 24/7 về sản phẩm, bảo hành và dịch vụ</p>
    </div>
</section>

<!-- Main Contact Content -->
<div class="container">
    <div class="contact-grid">
        <!-- Left: Thông tin liên hệ -->
        <div class="info-card">
            <h2><i class="fas fa-map-marker-alt"></i> Hệ thống cửa hàng</h2>
            
            <div class="contact-detail-item">
                <i class="fas fa-phone-alt"></i>
                <div>
                    <h3>Tổng đài hỗ trợ</h3>
                    <p><strong>1900 6888</strong> (7:30 - 22:00 kể cả CN)</p>
                    <p>Email: cskh@techzone.vn</p>
                </div>
            </div>
            
            <div class="contact-detail-item">
                <i class="fas fa-building"></i>
                <div>
                    <h3>Văn phòng giao dịch chính</h3>
                    <p>123 Nguyễn Trãi, Phường Bến Thành, Quận 1, TP.Hồ Chí Minh</p>
                    <p>📞 028 1234 5678</p>
                </div>
            </div>
            
            <h3><i class="fas fa-store"></i> Các chi nhánh khác</h3>
            <div class="store-list">
                <div class="store-item">
                    <h4><i class="fas fa-location-dot"></i> TechZone Hồ Chí Minh</h4>
                    <p><i class="fas fa-map-pin"></i> 123 Nguyễn Trãi, Phường Bến Thành, Quận 1, TP.HCM</p>
                    <p><i class="fas fa-phone"></i> 028 1234 5678</p>
                    <p><i class="fas fa-clock"></i> 8:00 - 21:00</p>
                </div>
                <div class="store-item">
                    <h4><i class="fas fa-location-dot"></i> TechZone Hà Nội</h4>
                    <p><i class="fas fa-map-pin"></i> 456 Cầu Giấy, Quận Cầu Giấy, Hà Nội</p>
                    <p><i class="fas fa-phone"></i> 024 8765 4321</p>
                    <p><i class="fas fa-clock"></i> 8:00 - 21:00</p>
                </div>
                <div class="store-item">
                    <h4><i class="fas fa-location-dot"></i> TechZone Đà Nẵng</h4>
                    <p><i class="fas fa-map-pin"></i> 789 Nguyễn Văn Linh, Quận Thanh Khê, Đà Nẵng</p>
                    <p><i class="fas fa-phone"></i> 0236 9876 543</p>
                    <p><i class="fas fa-clock"></i> 8:00 - 20:30</p>
                </div>
            </div>
        </div>

        <!-- Right: Form liên hệ -->
        <div class="form-card">
            <h2><i class="fas fa-envelope"></i> Gửi tin nhắn cho chúng tôi</h2>
            <p>Mọi thắc mắc, góp ý hoặc yêu cầu hỗ trợ, vui lòng điền form bên dưới. Chúng tôi sẽ phản hồi trong vòng 24h.</p>
            
            <div id="alertSuccess" class="alert alert-success">
                <i class="fas fa-check-circle"></i> Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.
            </div>
            
            <div id="alertError" class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i> <span id="errorMessage"></span>
            </div>
            
            <form id="contactForm">
                <div class="form-group">
                    <label>Họ và tên <span class="required">*</span></label>
                    <input type="text" id="fullname" class="form-control" placeholder="Nhập họ tên của bạn" required>
                </div>
                
                <div class="form-group">
                    <label>Email <span class="required">*</span></label>
                    <input type="email" id="email" class="form-control" placeholder="example@email.com" required>
                </div>
                
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="tel" id="phone" class="form-control" placeholder="0xx xxx xxxx">
                </div>
                
                <div class="form-group">
                    <label>Tiêu đề</label>
                    <input type="text" id="subject" class="form-control" placeholder="Tiêu đề tin nhắn">
                </div>
                
                <div class="form-group">
                    <label>Nội dung tin nhắn <span class="required">*</span></label>
                    <textarea id="message" class="form-control" placeholder="Nhập nội dung chi tiết..." required></textarea>
                </div>
                
                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> Gửi tin nhắn
                </button>
            </form>
        </div>
    </div>
    
    <!-- Google Maps -->
    <div class="map-section">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.123456789012!2d106.700000!3d10.775000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f1234567890%3A0x1234567890abcdef!2zMTIzIE5ndXnhu5VuIFRyw6NpLCBQaMaw4budbmcgQuG6v25oIFRow6BuaCwgUXXhuq1uIDEsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaA!5e0!3m2!1svi!2s!4v1234567890123!5m2!1svi!2s" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>
    
    <!-- Hotline Banner -->
    <div class="hotline-banner">
        <i class="fas fa-headset"></i>
        <h3>Cần hỗ trợ ngay?</h3>
        <div class="hotline-number">1900 6888</div>
        <p>Miễn phí cuộc gọi - Hỗ trợ kỹ thuật, bảo hành, đặt hàng</p>
        <p style="margin-top: 10px; font-size: 14px;">Thời gian làm việc: 7:30 - 22:00 (kể cả Thứ 7, Chủ Nhật)</p>
    </div>
</div>

<!-- CSS cho phần contact -->
<style>
/* Contact Page Styles */
.contact-hero {
    background: linear-gradient(135deg, #0b2b44 0%, #1e6f5c 100%);
    color: white;
    padding: 60px 0;
    margin-bottom: 50px;
}

.contact-hero h1 {
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 16px;
}

.contact-hero p {
    font-size: 18px;
    opacity: 0.95;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    margin-bottom: 60px;
}

@media (max-width: 768px) {
    .contact-grid {
        grid-template-columns: 1fr;
    }
    .contact-hero h1 {
        font-size: 32px;
    }
}

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
        const fullname = document.getElementById('fullname').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const subject = document.getElementById('subject').value.trim();
        const message = document.getElementById('message').value.trim();
        
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
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
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
            } else {
                showError(result.message || 'Gửi thất bại, vui lòng thử lại');
            }
        } catch (error) {
            console.error('Lỗi khi gửi:', error);
            showError('Không thể kết nối đến máy chủ. Vui lòng thử lại sau.');
        } finally {
            // Mở khóa nút bấm trở lại
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnText;
        }
    });

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
