document.addEventListener('DOMContentLoaded', function() {
    const authForm = document.getElementById('authForm');
    if (authForm) {
        authForm.addEventListener('submit', function(e) {
            const pass = document.getElementById('password').value;
            const confirm = document.getElementById('confirm_password').value;
            if (pass.length < 6 || pass !== confirm) {
                alert("Vui lòng kiểm tra lại mật khẩu (tối thiểu 6 ký tự) và xác nhận mật khẩu!");
                e.preventDefault();
            }
        });
    }
});
