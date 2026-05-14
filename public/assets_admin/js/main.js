// public/assets/js/main.js

// 1. CHỨC NĂNG TÀI KHOẢN (ĐĂNG XUẤT & CHUYỂN FORM)
function confirmLogout() {
    Swal.fire({
        title: 'Bạn muốn đăng xuất?', text: "Mọi phiên làm việc sẽ kết thúc!", icon: 'warning',
        showCancelButton: true, confirmButtonColor: '#e74c3c', cancelButtonColor: '#64748b',
        confirmButtonText: 'Thoát', cancelButtonText: 'Ở lại'
    }).then((result) => { if (result.isConfirmed) window.location.href = 'public_entry.php?url=logout'; });
}

function toggleAuth(type) {
    document.getElementById('login-form-container').style.display = type === 'signup' ? 'none' : 'block';
    document.getElementById('signup-form-container').style.display = type === 'signup' ? 'block' : 'none';
    document.getElementById('auth-side-title').innerText = type === 'signup' ? "Tham gia ngay!" : "Mừng bạn trở lại!";
}

const Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });

// 2. GIỎ HÀNG BẰNG LOCALSTORAGE
let cart = [];
function loadCart() {
    const stored = localStorage.getItem('techzone_cart');
    cart = stored ? JSON.parse(stored) : [];
    updateCartUI();
}

function addToCart(productId, productName, productPrice) {
    const existing = cart.find(item => item.id == productId);
    if(existing) { existing.quantity += 1; } 
    else { cart.push({ id: productId, name: productName, price: productPrice, quantity: 1 }); }
    localStorage.setItem('techzone_cart', JSON.stringify(cart));
    updateCartUI();
    
    Swal.fire({
        toast: true, position: 'bottom-end', icon: 'success',
        title: 'Đã thêm vào giỏ', text: productName, showConfirmButton: false, timer: 2000
    });
}

function updateCartUI() {
    const cartCountSpan = document.getElementById('cartCount');
    if(cartCountSpan) {
        cartCountSpan.innerText = cart.reduce((sum, item) => sum + item.quantity, 0);
    }
}

// 3. FLASH SALE TIMER
function initFlashTimer() {
    const timerBox = document.getElementById('timerBox');
    if(!timerBox) return;
    
    let targetTime = localStorage.getItem('flashTargetTime');
    const now = new Date().getTime();
    if(!targetTime || now > parseInt(targetTime)) {
        targetTime = now + (24 * 60 * 60 * 1000);
        localStorage.setItem('flashTargetTime', targetTime);
    }
    setInterval(() => {
        const distance = parseInt(targetTime) - new Date().getTime();
        if(distance <= 0) { timerBox.innerHTML = "🔥 ĐÃ KẾT THÚC"; return; }
        const hours = Math.floor((distance % (24 * 60 * 60 * 1000)) / (60 * 60 * 1000));
        const minutes = Math.floor((distance % (60 * 60 * 1000)) / (60 * 1000));
        const seconds = Math.floor((distance % (60 * 1000)) / 1000);
        timerBox.innerHTML = `⏳ Kết thúc: ${String(hours).padStart(2,'0')}:${String(minutes).padStart(2,'0')}:${String(seconds).padStart(2,'0')}`;
    }, 1000);
}

// 4. CHẠY CÁC HÀM KHI TRANG TẢI XONG
document.addEventListener('DOMContentLoaded', function() {
    // Khởi chạy giỏ hàng và flash sale
    loadCart();
    initFlashTimer();

    // Gắn sự kiện cho các nút mua hàng
    const btns = document.querySelectorAll('.btn-buy');
    btns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            addToCart(this.dataset.id, this.dataset.name, parseInt(this.dataset.price));
        });
    });

    // Bật Modal Đăng nhập nếu có lỗi hoặc người dùng click
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('login_error')) {
        new bootstrap.Modal(document.getElementById('loginModal')).show();
        if (urlParams.get('tab') === 'signup') toggleAuth('signup');
    }
});