<!-- 1. CSS DÀNH CHO KÉO THẢ TRANG ADMIN -->
<style>
    #drop-zone-admin { border: 2px dashed #ffc107; border-radius: 50%; width: 140px; height: 140px; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative; margin: 0 auto; cursor: pointer; background: #f8f9fa; transition: 0.3s; }
    #drop-zone-admin img { width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: 1; }
    #drop-zone-admin .overlay { position: absolute; z-index: 2; background: rgba(0,0,0,0.5); color: white; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0; transition: 0.3s; }
    #drop-zone-admin:hover .overlay { opacity: 1; }
    #drop-zone-admin.dragover { border-color: #28a745; background: #e9f7ef; }
</style>

<!-- 2. GIAO DIỆN KÉO THẢ ẢNH -->
<div class="text-center mb-4">
    <label id="drop-zone-admin" class="mb-2 shadow-sm">
        <img id="previewAvatar" src="<?= !empty($user['avatar']) ? $user['avatar'] . '?v='.time() : 'https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg' ?>">
        <div class="overlay"><i class="fas fa-camera fs-3"></i></div>
        <input type="file" name="avatar" id="avatarInput" hidden accept="image/*">
    </label>
    <h6 class="text-muted small">Nhấn hoặc kéo thả ảnh vào đây</h6>
</div>

<!-- 3. JAVASCRIPT XỬ LÝ KÉO THẢ -->
<script>
    const dropZoneAdmin = document.getElementById('drop-zone-admin');
    const fileInputAdmin = document.getElementById('avatarInput');
    const previewAdmin = document.getElementById('previewAvatar');

    // Ngăn chặn hành vi mặc định của trình duyệt khi kéo file vào
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZoneAdmin.addEventListener(eventName, preventDefaults, false);
    });
    function preventDefaults(e) { e.preventDefault(); e.stopPropagation(); }

    // Thêm hiệu ứng UI khi kéo file ngang qua
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZoneAdmin.addEventListener(eventName, () => dropZoneAdmin.classList.add('dragover'), false);
    });
    ['dragleave', 'drop'].forEach(eventName => {
        dropZoneAdmin.addEventListener(eventName, () => dropZoneAdmin.classList.remove('dragover'), false);
    });

    // Bắt sự kiện thả file
    dropZoneAdmin.addEventListener('drop', (e) => {
        let dt = e.dataTransfer;
        let files = dt.files;
        if (files.length) { 
            fileInputAdmin.files = files; // Đưa file vào thẻ input ẩn
            updatePreviewAdmin(files[0]); // Hiển thị ảnh
        }
    });

    // Bắt sự kiện khi click chọn file thủ công
    fileInputAdmin.addEventListener('change', function() { 
        if(this.files.length) updatePreviewAdmin(this.files[0]); 
    });

    function updatePreviewAdmin(file) { 
        const reader = new FileReader(); 
        reader.onload = (e) => previewAdmin.src = e.target.result; 
        reader.readAsDataURL(file); 
    }
</script>