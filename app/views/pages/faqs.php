<div class="container my-5 py-5">
    <div class="tz-container shadow-lg border-0">
        <div class="row g-0 h-100">
            <div class="col-md-4 tz-sidebar p-4 d-flex flex-column text-white">
                <div class="sidebar-header mb-5">
                    <div class="tz-dot-red"></div>
                    <div class="tz-dot-yellow"></div>
                    <div class="tz-dot-green"></div>
                    <h5 class="fw-bold mt-3 text-uppercase">Hỗ trợ TechZone</h5>
                </div>
                <p class="small opacity-75 mt-4">Tổng hợp giải đáp giúp bạn tối ưu trải nghiệm thiết bị.</p>
                <div class="mt-auto pt-5">
                    <a href="?url=home" class="tz-link">← Quay lại Trang chủ</a>
                </div>
            </div>

            <div class="col-md-8 p-5 overflow-auto bg-white">
                <h2 class="tz-title mb-4 text-uppercase">Cơ sở dữ liệu giải đáp</h2>
                <div class="accordion tz-accordion-clean" id="faqAccordion">
                    <?php if (isset($data['faqs']) && !empty($data['faqs'])): ?>
                        <?php foreach ($data['faqs'] as $index => $faq): ?>
                            <div class="accordion-item mb-3 border-0 shadow-sm rounded-4 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold text-tz-green py-4" 
                                            type="button" data-bs-toggle="collapse" 
                                            data-bs-target="#collapse-<?= $index ?>">
                                        <span class="tz-status-dot me-3"></span>
                                        <span class="text-tz-orange me-2">[<?= htmlspecialchars($faq['title']) ?>]</span> 
                                        <?= htmlspecialchars($faq['question']) ?>
                                    </button>
                                </h2>
                                <div id="collapse-<?= $index ?>" class="accordion-collapse collapse">
                                    <div class="accordion-body tz-answer-clean pt-0 pb-4 px-5">
                                        <div class="ps-4 border-start border-2 border-tz-orange">
                                            <?= nl2br(htmlspecialchars($faq['answer'])) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted italic text-center py-5">/ Hiện chưa có câu hỏi nào được công bố /</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center pb-5">
    <div class="col-lg-10">
        <div class="tz-card p-5 border-0 shadow-lg" style="background: #f4fbfb; border-radius: 30px;">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <h3 class="fw-bold text-tz-green mb-3">BẠN CÒN THẮC MẮC?</h3>
                    <p class="text-secondary small">Gửi câu hỏi và chúng tôi sẽ phản hồi sớm nhất.</p>
                </div>
                <div class="col-md-7">
                    <form id="userQuestionForm">
                        <div class="mb-3">
                            <label class="small fw-bold text-muted text-uppercase mb-2">Chủ đề</label>
                            <input type="text" id="q_title" class="form-control tz-input" placeholder="Ví dụ: Laptop" required>
                        </div>
                        <div class="mb-4">
                            <label class="small fw-bold text-muted text-uppercase mb-2">Câu hỏi</label>
                            <textarea id="q_content" class="form-control tz-input" rows="3" placeholder="Nội dung..." required></textarea>
                        </div>
                        <button type="submit" id="btnSubmitFaq" class="btn btn-tz-orange w-100 fw-bold text-white py-3 rounded-pill shadow">
                            GỬI YÊU CẦU ĐẾN ADMIN
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('userQuestionForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('btnSubmitFaq');
    const title = document.getElementById('q_title').value;
    const question = document.getElementById('q_content').value;

    btn.disabled = true;
    btn.innerHTML = 'ĐANG GỬI...';

    const formData = new FormData();
    formData.append('title', title);
    formData.append('question', question);

    fetch('public_entry.php?url=faq/user-request', { method: 'POST', body: formData })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success') {
            alert('Thành công! Câu hỏi của bạn đang chờ duyệt.');
            document.getElementById('userQuestionForm').reset(); // Empty ô trống
        }
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = 'GỬI YÊU CẦU ĐẾN ADMIN';
    });
});
</script>

<style>
:root { --tz-green: #1e3a3a; --tz-orange: #ff9d2e; }
.tz-container { background: rgba(255,255,255,0.9); border-radius: 35px; min-height: 600px; }
.tz-sidebar { background: linear-gradient(180deg, #1e3a3a 0%, #0d1a1a 100%); border-radius: 35px 0 0 35px; }
.tz-title { color: var(--tz-green); font-weight: 800; }
.text-tz-green { color: var(--tz-green); }
.text-tz-orange { color: var(--tz-orange); }
.tz-answer-clean { color: var(--tz-green); line-height: 1.6; }
.tz-status-dot { width: 10px; height: 10px; background: #27c93f; border-radius: 50%; display: inline-block; }
/* NÚT BẤM CAM TECHZONE */
.btn-tz-orange { 
    background-color: #ff9d2e !important; 
    color: #fff !important; 
    border: none;
    transition: 0.3s;
}
.btn-tz-orange:hover { background-color: #e68a1e !important; transform: translateY(-2px); }
.tz-input { border-radius: 15px; border: 1px solid #ced4da; padding: 12px; }
.tz-input:focus { border-color: var(--tz-orange); box-shadow: none; }
.tz-link { color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.75rem; }
.tz-dot-red { background: #ff5f56; width: 10px; height: 10px; border-radius: 50%; display: inline-block; }
.tz-dot-yellow { background: #ffbd2e; width: 10px; height: 10px; border-radius: 50%; display: inline-block; }
.tz-dot-green { background: #27c93f; width: 10px; height: 10px; border-radius: 50%; display: inline-block; }
</style>