<div class="container my-5 py-5">
    <div class="techzone-container shadow-lg border-0">
        <div class="row g-0 h-100">
            
            <div class="col-md-4 techzone-sidebar p-4 d-flex flex-column text-white">
                <div class="sidebar-header mb-5">
                    <div class="tz-dot-red"></div>
                    <div class="tz-dot-yellow"></div>
                    <div class="tz-dot-green"></div>
                    <h5 class="fw-bold mt-3 text-uppercase">Hồ sơ TechZone</h5>
                </div>
                
                <ul class="nav flex-column techzone-nav" id="aboutTab" role="tablist">
                    <li class="nav-item mb-3">
                        <button class="nav-link active" id="core-tab" data-bs-toggle="tab" data-bs-target="#core-content">
                            <i class="fas fa-microchip me-2"></i> 01. HỆ THỐNG LÕI
                        </button>
                    </li>
                </ul>

                <div class="mt-auto pt-5">
                    <a href="?url=faq" class="techzone-link">Chuyển sang Truy vấn FAQs →</a>
                </div>
            </div>

            <div class="col-md-8 techzone-content p-5 overflow-auto">
                <div class="tab-content" id="aboutTabContent">
                    
                    <div class="tab-pane fade show active" id="core-content" role="tabpanel">
                        <h2 class="techzone-title mb-4 text-uppercase">Hệ thống TechZone [Dữ liệu động]</h2>
                        
                        <div class="techzone-card p-4 mb-4 border-start border-tz-green border-4 shadow-sm">
                            <h6 class="text-tz-green fw-bold mb-3">
                                / <?= isset($contents['about_history']) ? htmlspecialchars($contents['about_history']['section_name']) : 'Tiểu sử' ?>
                            </h6>
                            <p class="text-secondary small leading-relaxed">
                                <?= isset($contents['about_history']) ? nl2br(htmlspecialchars($contents['about_history']['content_value'])) : 'Đang tải dữ liệu...' ?>
                            </p>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="techzone-card p-3 h-100">
                                    <h6 class="text-tz-green fw-bold small">
                                        / <?= isset($contents['about_mission']) ? htmlspecialchars($contents['about_mission']['section_name']) : 'Sứ mệnh' ?>
                                    </h6>
                                    <p class="extra-small text-muted mb-0">
                                        <?= isset($contents['about_mission']) ? htmlspecialchars($contents['about_mission']['content_value']) : 'Đang cập nhật...' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="techzone-card p-3 h-100">
                                    <h6 class="text-tz-green fw-bold small">
                                        / <?= isset($contents['about_goal']) ? htmlspecialchars($contents['about_goal']['section_name']) : 'Mục tiêu' ?>
                                    </h6>
                                    <p class="extra-small text-muted mb-0">
                                        <?= isset($contents['about_goal']) ? htmlspecialchars($contents['about_goal']['content_value']) : 'Đang cập nhật...' ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* CSS giữ nguyên để đảm bảo giao diện đẹp như trang About lõi */
:root {
    --tz-green: #1e3a3a;
    --tz-orange: #ff9d2e;
}
.techzone-container { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(20px); border-radius: 35px; min-height: 600px; border: 1px solid rgba(0,0,0,0.05); }
.techzone-sidebar { background: linear-gradient(180deg, #1e3a3a 0%, #0d1a1a 100%); border-radius: 35px 0 0 35px; }
.techzone-card { background: white; border-radius: 20px; border: 1px solid #f0f0f0; }
.techzone-title { font-weight: 800; color: var(--tz-green); letter-spacing: -1px; }
.text-tz-green { color: var(--tz-green); }
.border-tz-green { border-color: var(--tz-green) !important; }
.techzone-nav .nav-link { color: rgba(255,255,255,0.6); border: none; padding: 15px; font-size: 0.8rem; font-weight: 600; text-align: left; width: 100%; }
.techzone-nav .nav-link.active { background: var(--tz-orange); color: #1e3a3a !important; border-radius: 12px; }
.tz-dot-red, .tz-dot-yellow, .tz-dot-green { width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 4px; }
.tz-dot-red { background: #ff5f56; } .tz-dot-yellow { background: #ffbd2e; } .tz-dot-green { background: #27c93f; }
.techzone-link { color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.75rem; }
.extra-small { font-size: 0.7rem; }
</style>