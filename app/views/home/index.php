<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>TechZone - Siêu thị công nghệ & điện máy</title>
    <!-- Font Awesome 6 (free icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Font: Inter & Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Roboto', sans-serif;
            background-color: #f5f7fb;
            color: #1e2a3e;
            scroll-behavior: smooth;
        }

        /* container chung */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* header */
        .header-top {
            background-color: #0b2b44;
            color: white;
            font-size: 13px;
            padding: 8px 0;
        }

        .header-top .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .hotline i, .policy i {
            margin-right: 6px;
        }

        .policy span {
            margin-left: 16px;
        }

        /* main header */
        .main-header {
            background-color: white;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            padding: 16px 0;
        }

        .logo h1 {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #0b2b44, #1e6f5c);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: -0.5px;
        }
        .logo span {
            font-size: 12px;
            font-weight: 400;
            color: #5f7f9e;
            display: block;
            letter-spacing: normal;
        }

        .search-bar {
            flex: 1;
            max-width: 500px;
            display: flex;
            background: #f0f2f5;
            border-radius: 40px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            transition: all 0.2s;
        }
        .search-bar:focus-within {
            border-color: #1e6f5c;
            box-shadow: 0 0 0 2px rgba(30,111,92,0.2);
        }
        .search-bar input {
            flex: 1;
            padding: 12px 18px;
            border: none;
            background: transparent;
            font-size: 15px;
            outline: none;
        }
        .search-bar button {
            background: #1e6f5c;
            border: none;
            color: white;
            padding: 0 20px;
            cursor: pointer;
            font-size: 18px;
            transition: 0.2s;
        }
        .search-bar button:hover {
            background: #0e5545;
        }

        .header-actions {
            display: flex;
            gap: 24px;
            align-items: center;
        }
        .action-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 13px;
            color: #2c3e50;
            cursor: pointer;
            transition: 0.2s;
        }
        .action-item i {
            font-size: 22px;
            margin-bottom: 4px;
        }
        .action-item:hover {
            color: #1e6f5c;
        }
        .cart-badge {
            position: relative;
        }
        .badge {
            position: absolute;
            top: -8px;
            right: -12px;
            background-color: #e74c3c;
            color: white;
            font-size: 10px;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 30px;
        }

        /* navbar category */
        .nav-category {
            background-color: white;
            border-top: 1px solid #edf2f7;
            border-bottom: 1px solid #edf2f7;
            margin-bottom: 24px;
        }
        .nav-list {
            display: flex;
            gap: 28px;
            padding: 12px 0;
            overflow-x: auto;
            white-space: nowrap;
            list-style: none;
        }
        .nav-list li a {
            text-decoration: none;
            font-weight: 500;
            color: #1e2a3e;
            font-size: 15px;
            transition: 0.2s;
        }
        .nav-list li a:hover {
            color: #1e6f5c;
        }

        /* banner carousel (đơn giản) */
        .banner-section {
            margin-bottom: 40px;
        }
        .banner-slider {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .banner-main {
            flex: 2;
            background: linear-gradient(145deg, #0b2e3e, #154e5c);
            border-radius: 24px;
            padding: 35px 30px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .banner-main h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .banner-main p {
            font-size: 16px;
            margin-bottom: 24px;
            opacity: 0.9;
        }
        .btn-shop {
            background-color: #ffb347;
            border: none;
            padding: 10px 24px;
            border-radius: 40px;
            font-weight: 600;
            color: #1e2a3e;
            cursor: pointer;
            font-size: 15px;
            transition: 0.2s;
        }
        .btn-shop:hover {
            background-color: #ff9f1c;
            transform: scale(1.02);
        }
        .banner-sub {
            flex: 1;
            background: #eef2f9;
            border-radius: 24px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .banner-sub h4 {
            color: #0b2b44;
            font-size: 20px;
        }
        .banner-sub .price {
            font-size: 28px;
            font-weight: 800;
            color: #c4450c;
            margin: 8px 0;
        }

        /* section title */
        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin: 32px 0 20px 0;
            flex-wrap: wrap;
        }
        .section-title h2 {
            font-size: 26px;
            font-weight: 700;
            border-left: 5px solid #1e6f5c;
            padding-left: 14px;
        }
        .view-all {
            color: #1e6f5c;
            font-weight: 500;
            cursor: pointer;
        }

        /* product grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 24px;
        }
        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.25s ease;
            box-shadow: 0 5px 12px rgba(0,0,0,0.03);
            border: 1px solid #eef2f9;
            cursor: pointer;
        }
        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px -12px rgba(0,0,0,0.12);
            border-color: #d0e2e9;
        }
        .product-img {
            background: #fafcff;
            text-align: center;
            padding: 28px 16px 16px;
            font-size: 80px;
            color: #0b2b44;
        }
        .product-info {
            padding: 12px 16px 20px;
        }
        .product-title {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 8px;
            height: 48px;
            overflow: hidden;
        }
        .product-price {
            font-weight: 800;
            font-size: 20px;
            color: #c0392b;
            margin: 8px 0;
        }
        .old-price {
            font-size: 13px;
            color: #7f8c8d;
            text-decoration: line-through;
            margin-left: 8px;
            font-weight: 400;
        }
        .installment {
            font-size: 13px;
            color: #27ae60;
            background: #e9f7ef;
            display: inline-block;
            padding: 3px 10px;
            border-radius: 30px;
            margin-top: 8px;
        }
        .btn-buy {
            width: 100%;
            background-color: #1e6f5c;
            border: none;
            padding: 10px;
            color: white;
            font-weight: 600;
            border-radius: 40px;
            margin-top: 14px;
            transition: 0.2s;
            cursor: pointer;
        }
        .btn-buy:hover {
            background-color: #0e5545;
        }

        /* deal flash */
        .flash-sale {
            background: linear-gradient(120deg, #fff4e6, #ffe6d5);
            border-radius: 28px;
            padding: 28px 24px;
            margin: 32px 0;
        }
        .flash-header {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }
        .flash-header h3 {
            font-size: 28px;
            font-weight: 800;
            color: #c0392b;
        }
        .timer {
            background: #2c3e50;
            padding: 6px 18px;
            border-radius: 60px;
            color: white;
            font-weight: 600;
            letter-spacing: 1px;
        }

        /* footer */
        footer {
            background-color: #0b2b44;
            color: #cddfe7;
            margin-top: 60px;
            padding: 40px 0 20px;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 32px;
            margin-bottom: 40px;
        }
        .footer-col h4 {
            color: white;
            margin-bottom: 18px;
            font-size: 18px;
        }
        .footer-col p, .footer-col li {
            margin-bottom: 10px;
            font-size: 14px;
            list-style: none;
        }
        .social i {
            font-size: 24px;
            margin-right: 16px;
            cursor: pointer;
        }
        .copyright {
            text-align: center;
            border-top: 1px solid #2c4b66;
            padding-top: 20px;
            font-size: 13px;
        }

        /* responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                align-items: stretch;
            }
            .search-bar {
                max-width: 100%;
            }
            .banner-slider {
                flex-direction: column;
            }
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }
    </style>
</head>
<body>
    <!-- header top -->
    <div class="header-top">
        <div class="container">
            <div class="hotline">
                <i class="fas fa-phone-alt"></i> Hotline: 1900 6888 (7:30 - 22:00)
            </div>
            <div class="policy">
                <i class="fas fa-shield-alt"></i> Bảo hành chính hãng 12 tháng
                <span><i class="fas fa-truck"></i> Giao miễn phí toàn quốc</span>
            </div>
        </div>
    </div>

    <!-- main header -->
    <div class="main-header">
        <div class="container header-content">
            <div class="logo">
                <h1>TechZone <i class="fas fa-microchip"></i></h1>
                <span>Công nghệ đỉnh cao - Giá sốc mỗi ngày</span>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Bạn tìm gì? Laptop, điện thoại, phụ kiện..." id="searchInput">
                <button id="searchBtn"><i class="fas fa-search"></i></button>
            </div>
            <div class="header-actions">
                <div class="action-item">
                    <i class="far fa-user-circle"></i>
                    <span>Tài khoản</span>
                </div>
                <div class="action-item cart-badge">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Giỏ hàng</span>
                    <span class="badge" id="cartCount">0</span>
                </div>
            </div>
        </div>
    </div>

    <!-- danh mục -->
    <div class="nav-category">
        <div class="container">
            <ul class="nav-list">
                <li><a href="#">Điện thoại</a></li>
                <li><a href="#">Laptop</a></li>
                <li><a href="#">Máy tính bảng</a></li>
                <li><a href="#">Tai nghe</a></li>
                <li><a href="#">Đồng hồ thông minh</a></li>
                <li><a href="#">Phụ kiện</a></li>
                <li><a href="#">Máy ảnh</a></li>
                <li><a href="#">Smart Home</a></li>
            </ul>
        </div>
    </div>

    <div class="container">
        <!-- banner slider -->
        <div class="banner-section">
            <div class="banner-slider">
                <div class="banner-main">
                    <h2>iPhone 15 Pro Max <br>Giá cực sốc</h2>
                    <p>Trả góp 0% lãi suất - Đổi máy cũ lên đời ngay</p>
                    <button class="btn-shop" id="bannerBtn">Mua ngay <i class="fas fa-arrow-right"></i></button>
                </div>
                <div class="banner-sub">
                    <h4>Laptop Gaming Acer Nitro 5</h4>
                    <div class="price">21.990.000đ</div>
                    <p><i class="fas fa-gem"></i> RTX 3050 - RAM 16GB</p>
                    <button class="btn-shop" style="background:#ffe0b5; margin-top:10px;">Xem chi tiết</button>
                </div>
            </div>
        </div>

        <!-- flash sale -->
        <div class="flash-sale">
            <div class="flash-header">
                <h3><i class="fas fa-bolt"></i> FLASH SALE</h3>
                <div class="timer" id="timerBox">Kết thúc sau: 23:59:59</div>
                <span style="flex:1; text-align:right; font-weight:500;">Số lượng có hạn</span>
            </div>
            <div class="product-grid" id="flashGrid">
                <!-- flash products will be injected via js -->
            </div>
        </div>

        <!-- Sản phẩm nổi bật -->
        <div class="section-title">
            <h2>🔥 Sản phẩm nổi bật</h2>
            <div class="view-all">Xem tất cả <i class="fas fa-chevron-right"></i></div>
        </div>
        <div class="product-grid" id="featuredGrid">
            <!-- featured products -->
        </div>

        <!-- Công nghệ mới -->
        <div class="section-title">
            <h2>✨ Công nghệ mới 2025</h2>
            <div class="view-all">Khám phá ngay</div>
        </div>
        <div class="product-grid" id="newTechGrid">
            <!-- new tech products -->
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h4>TechZone</h4>
                    <p>Hệ thống siêu thị công nghệ hàng đầu Việt Nam</p>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Nguyễn Trãi, Q.1, TP.HCM</p>
                    <p><i class="fas fa-envelope"></i> cskh@techzone.vn</p>
                </div>
                <div class="footer-col">
                    <h4>Hỗ trợ khách hàng</h4>
                    <p>Chính sách đổi trả</p>
                    <p>Bảo hành & sửa chữa</p>
                    <p>Hướng dẫn mua online</p>
                </div>
                <div class="footer-col">
                    <h4>Về TechZone</h4>
                    <p>Giới thiệu</p>
                    <p>Tuyển dụng</p>
                    <p>Hệ thống cửa hàng</p>
                </div>
                <div class="footer-col social">
                    <h4>Kết nối</h4>
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-youtube"></i>
                    <i class="fab fa-tiktok"></i>
                </div>
            </div>
            <div class="copyright">
                © 2025 TechZone - Siêu thị công nghệ & điện máy. Mọi quyền được bảo lưu.
            </div>
        </div>
    </footer>

    <script>
        // ---------- Dữ liệu sản phẩm mô phỏng ----------
        const productsDB = {
            flash: [
                { id: 1, name: "Tai ngủ Sony WH-1000XM5", price: 5490000, oldPrice: 7990000, imgIcon: "fa-headphones", installment: "Trả góp 0%" },
                { id: 2, name: "Apple Watch Series 9", price: 8990000, oldPrice: 10990000, imgIcon: "fa-clock", installment: "Giảm 1.5tr" },
                { id: 3, name: "Samsung Galaxy S24 Ultra", price: 22990000, oldPrice: 28990000, imgIcon: "fa-mobile-alt", installment: "Quà tặng 500k" },
                { id: 4, name: "Laptop ASUS ROG Zephyrus", price: 31990000, oldPrice: 37990000, imgIcon: "fa-laptop", installment: "Trả góp 0%" }
            ],
            featured: [
                { id: 5, name: "iPhone 15 Pro 256GB", price: 25990000, oldPrice: 28990000, imgIcon: "fa-mobile-alt", installment: "Giảm 3 triệu" },
                { id: 6, name: "MacBook Air M3", price: 28990000, oldPrice: 30990000, imgIcon: "fa-laptop", installment: "Tặng chuột không dây" },
                { id: 7, name: "Loa JBL Charge 5", price: 3290000, oldPrice: 3990000, imgIcon: "fa-music", installment: "Hàng chính hãng" },
                { id: 8, name: "Máy ảnh Canon EOS R50", price: 15490000, oldPrice: 17990000, imgIcon: "fa-camera", installment: "Trả góp 0%" }
            ],
            newTech: [
                { id: 9, name: "Smart Glasses Ray-Ban Meta", price: 8990000, oldPrice: 10990000, imgIcon: "fa-glasses", installment: "Công nghệ AI" },
                { id: 10, name: "Robot hút bụi Ecovacs", price: 12490000, oldPrice: 15900000, imgIcon: "fa-robot", installment: "Tự động lau nhà" },
                { id: 11, name: "Đồng hồ Garmin Fenix 8", price: 15990000, oldPrice: 18990000, imgIcon: "fa-clock", installment: "Thể thao đỉnh cao" },
                { id: 12, name: "iPad Pro 11-inch M4", price: 20990000, oldPrice: 23990000, imgIcon: "fa-tablet-alt", installment: "Học tập siêu đỉnh" }
            ]
        };

        // hàm render sản phẩm theo mảng dữ liệu
        function renderProductGrid(containerId, productsArray) {
            const container = document.getElementById(containerId);
            if (!container) return;
            container.innerHTML = '';
            productsArray.forEach(prod => {
                const card = document.createElement('div');
                card.classList.add('product-card');
                card.innerHTML = `
                    <div class="product-img">
                        <i class="fas ${prod.imgIcon} fa-4x"></i>
                    </div>
                    <div class="product-info">
                        <div class="product-title">${prod.name}</div>
                        <div class="product-price">
                            ${prod.price.toLocaleString('vi-VN')}đ
                            <span class="old-price">${prod.oldPrice.toLocaleString('vi-VN')}đ</span>
                        </div>
                        <div class="installment">${prod.installment}</div>
                        <button class="btn-buy" data-id="${prod.id}" data-name="${prod.name}" data-price="${prod.price}"><i class="fas fa-cart-plus"></i> Mua ngay</button>
                    </div>
                `;
                container.appendChild(card);
            });
            // gán sự kiện cho nút mua hàng sau khi render
            attachBuyEvents();
        }

        // Giỏ hàng đơn giản (localStorage)
        let cart = [];
        function loadCart() {
            const stored = localStorage.getItem('techzone_cart');
            if(stored) {
                cart = JSON.parse(stored);
            } else {
                cart = [];
            }
            updateCartUI();
        }
        function addToCart(productId, productName, productPrice) {
            const existing = cart.find(item => item.id == productId);
            if(existing) {
                existing.quantity += 1;
            } else {
                cart.push({ id: productId, name: productName, price: productPrice, quantity: 1 });
            }
            localStorage.setItem('techzone_cart', JSON.stringify(cart));
            updateCartUI();
            alert(`✅ Đã thêm ${productName} vào giỏ hàng!`);
        }
        function updateCartUI() {
            const cartCountSpan = document.getElementById('cartCount');
            if(cartCountSpan) {
                const totalQty = cart.reduce((sum, item) => sum + item.quantity, 0);
                cartCountSpan.innerText = totalQty;
            }
        }
        function attachBuyEvents() {
            const btns = document.querySelectorAll('.btn-buy');
            btns.forEach(btn => {
                // tránh trùng lặp listener
                btn.removeEventListener('click', buyHandler);
                btn.addEventListener('click', buyHandler);
            });
        }
        function buyHandler(e) {
            e.stopPropagation();
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const price = parseInt(this.getAttribute('data-price'));
            addToCart(id, name, price);
        }

        // Flash Sale Timer đếm ngược 24h từ thời điểm tải trang (mô phỏng)
        function initFlashTimer() {
            let targetTime = localStorage.getItem('flashTargetTime');
            const now = new Date().getTime();
            if(!targetTime || now > parseInt(targetTime)) {
                // đặt timer 24h kể từ bây giờ
                let newTarget = now + (24 * 60 * 60 * 1000);
                localStorage.setItem('flashTargetTime', newTarget);
                targetTime = newTarget;
            }
            function updateTimer() {
                const current = new Date().getTime();
                const distance = parseInt(targetTime) - current;
                if(distance <= 0) {
                    document.getElementById('timerBox').innerHTML = "🔥 SALE KẾT THÚC 🔥";
                    return;
                }
                const hours = Math.floor((distance % (24 * 60 * 60 * 1000)) / (60 * 60 * 1000));
                const minutes = Math.floor((distance % (60 * 60 * 1000)) / (60 * 1000));
                const seconds = Math.floor((distance % (60 * 1000)) / 1000);
                document.getElementById('timerBox').innerHTML = `⏳ Kết thúc: ${hours.toString().padStart(2,'0')}:${minutes.toString().padStart(2,'0')}:${seconds.toString().padStart(2,'0')}`;
            }
            updateTimer();
            setInterval(updateTimer, 1000);
        }

        // search demo
        function setupSearch() {
            const searchInput = document.getElementById('searchInput');
            const searchBtn = document.getElementById('searchBtn');
            function searchAction() {
                const keyword = searchInput.value.trim().toLowerCase();
                if(keyword === "") {
                    alert("Vui lòng nhập từ khóa tìm kiếm (ví dụ: laptop, iphone...)");
                    return;
                }
                // gom tất cả sản phẩm
                const allProds = [...productsDB.flash, ...productsDB.featured, ...productsDB.newTech];
                const results = allProds.filter(p => p.name.toLowerCase().includes(keyword));
                if(results.length === 0) {
                    alert(`Không tìm thấy sản phẩm cho "${keyword}"`);
                } else {
                    let msg = `🔍 Tìm thấy ${results.length} sản phẩm:\n` + results.map(p => `- ${p.name}`).join('\n');
                    alert(msg);
                }
            }
            searchBtn.addEventListener('click', searchAction);
            searchInput.addEventListener('keypress', function(e) {
                if(e.key === 'Enter') searchAction();
            });
        }

        // Banner button demo
        function setupBanner() {
            const bannerBtn = document.getElementById('bannerBtn');
            if(bannerBtn) {
                bannerBtn.addEventListener('click', () => {
                    alert("🔥 Chương trình khuyến mãi iPhone 15 Pro Max: giảm đến 2 triệu + trả góp 0%! Ghé cửa hàng hoặc đặt ngay.");
                });
            }
        }

        // Thêm event view-all demo
        function setupViewAll() {
            const viewAlls = document.querySelectorAll('.view-all');
            viewAlls.forEach(el => {
                el.addEventListener('click', () => {
                    alert("📱 Xem tất cả sản phẩm: Hàng ngàn ưu đãi công nghệ đang chờ bạn! (Tính năng đang phát triển)");
                });
            });
        }

        // Render toàn bộ
        function initRender() {
            renderProductGrid('flashGrid', productsDB.flash);
            renderProductGrid('featuredGrid', productsDB.featured);
            renderProductGrid('newTechGrid', productsDB.newTech);
        }

        // Khởi chạy
        loadCart();
        initRender();
        initFlashTimer();
        setupSearch();
        setupBanner();
        setupViewAll();
    </script>
</body>
</html>