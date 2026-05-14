<div class="container my-5 pt-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <article class="mb-5 bg-white p-4 p-md-5 rounded-4 shadow-sm border-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="public_entry.php?url=news" class="text-decoration-none fw-bold"><i class="fas fa-home me-1"></i>Tin tức</a></li>
                        <li class="breadcrumb-item active text-truncate" style="max-width: 200px;"><?= htmlspecialchars($news['title']) ?></li>
                    </ol>
                </nav>
                <h1 class="fw-bold mb-4 lh-base text-dark"><?= htmlspecialchars($news['title']) ?></h1>
                <p class="text-muted small mb-4">
                    <span class="badge bg-primary fs-6 me-2"><?= htmlspecialchars($news['category']) ?></span>
                    <i class="fas fa-calendar-alt me-1"></i> Đăng lúc: <?= date('H:i d/m/Y', strtotime($news['created_at'])) ?>
                </p>
                <img src="<?= htmlspecialchars($news['image']) ?>" class="img-fluid rounded-4 mb-5 w-100 shadow-sm" style="max-height: 500px; object-fit: cover;">
                <div class="content lh-lg fs-5 text-secondary" style="text-align: justify;">
                    <?= nl2br(htmlspecialchars($news['content'])) ?>
                </div>
            </article>

            <!-- KHU VỰC BÌNH LUẬN -->
            <section class="bg-white p-4 p-md-5 rounded-4 shadow-sm border-0">
                <h4 class="fw-bold mb-4 border-bottom pb-3"><i class="fas fa-comments text-primary me-2"></i>Bình luận (<?= count($comments ?? []) ?>)</h4>
                
                <?php if(isset($_SESSION['user_id'])): ?>
                    <form action="public_entry.php?url=news/comment" method="POST" class="mb-5">
                        <input type="hidden" name="news_id" value="<?= $news['id'] ?>">
                        <div class="mb-3">
                            <textarea name="content" class="form-control bg-light border-0 p-3" rows="3" placeholder="Góc nhìn của bạn về bài viết này là gì?..." style="border-radius: 15px;" required></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4 py-2 fw-bold rounded-pill shadow-sm"><i class="fas fa-paper-plane me-2"></i>Gửi bình luận</button>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="alert alert-info border-0 shadow-sm rounded-3 mb-5 d-flex align-items-center">
                        <i class="fas fa-info-circle fs-4 me-3"></i>
                        <div>Bạn muốn bình luận? Vui lòng <a href="public_entry.php?url=login" class="fw-bold text-decoration-none">Đăng nhập</a> ngay nhé!</div>
                    </div>
                <?php endif; ?>

                <div class="comment-list">
                    <?php if(!empty($comments)): foreach($comments as $cmt): ?>
                        <div class="d-flex mb-4 pb-4 border-bottom">
                            <div class="flex-shrink-0">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                    <?= strtoupper(substr($cmt['fullname'], 0, 1)) ?>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3 bg-light p-3 rounded-4 position-relative">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0 fw-bold text-dark"><?= htmlspecialchars($cmt['fullname']) ?></h6>
                                    <small class="text-muted"><i class="far fa-clock me-1"></i><?= date('H:i d/m/Y', strtotime($cmt['created_at'])) ?></small>
                                </div>
                                <p class="mb-0 mt-2 text-secondary"><?= htmlspecialchars($cmt['content']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-comment-dots text-muted opacity-50 mb-2" style="font-size: 3rem;"></i>
                            <p class="text-muted italic m-0">Hãy trở thành người đầu tiên chia sẻ suy nghĩ!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </div>
</div>