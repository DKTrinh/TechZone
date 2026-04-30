<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CleanTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* Nền mờ ảo tông tím/xanh phía sau */
            background: linear-gradient(135deg, #a7b8e1 0%, #c4c1e0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
            margin: 0;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
            max-width: 900px;
            width: 100%;
        }
        .login-left {
            /* Nền Gradient xanh biển sâu của bên trái */
            background: linear-gradient(180deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 60px 50px;
            position: relative;
        }
        /* Tạo hiệu ứng mờ núi non ở background trái */
        .login-left::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url('https://images.unsplash.com/photo-1557682250-33bd709cbe85') center/cover;
            opacity: 0.2;
            mix-blend-mode: overlay;
        }
        .login-left-content { position: relative; z-index: 1; }
        .login-right { padding: 60px 50px; background: #ffffff; }
        
        /* Chỉnh style form */
        .form-control { background: #f4f6fa; border: none; padding: 14px 20px; border-radius: 8px; margin-bottom: 20px; font-size: 0.95rem; }
        .form-control::placeholder { color: #82a0c2; }
        .btn-login { background: #ffffff; color: #3b82f6; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px rgba(0,0,0,0.02); padding: 14px; border-radius: 8px; font-weight: bold; width: 100%; margin-bottom: 30px; transition: 0.2s; }
        .btn-login:hover { background: #f8fafc; }
        .btn-signup { background: linear-gradient(90deg, #38bdf8 0%, #3b82f6 100%); color: white; border: none; padding: 14px; border-radius: 8px; font-weight: bold; width: 100%; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4); }
    </style>
</head>
<body>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="login-card row g-0">
                
                <div class="col-md-6 login-left d-flex flex-column justify-content-between">
                    <div class="login-left-content">
                        <div class="mb-5 d-flex align-items-center fw-bold">
                            <a href="?url=home" class="text-white text-decoration-none fs-5">
                                <span style="background: white; width: 12px; height: 12px; border-radius: 50%; display: inline-block; margin-right: 8px;"></span> 
                                YOUR LOGO
                            </a>
                        </div>
                        <h1 class="fw-bold display-5 mb-4" style="line-height: 1.1;">Hello,<br>welcome!</h1>
                        <p class="mb-5 text-white-50 small" style="max-width: 80%;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nisi risus.</p>
                        <button class="btn btn-outline-light rounded-pill px-4 py-2" style="font-size: 0.85rem;">View more</button>
                    </div>
                </div>

                <div class="col-md-6 login-right">
                    <form action="#" method="POST">
                        <div class="mb-1">
                            <label class="form-label small text-muted fw-semibold">Email address</label>
                            <input type="email" class="form-control" placeholder="name@mail.com" required>
                        </div>
                        <div class="mb-1">
                            <label class="form-label small text-muted fw-semibold">Password</label>
                            <input type="password" class="form-control" placeholder="••••••••••••" required>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-4 small fw-semibold">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember">
                                <label class="form-check-label text-muted" style="font-size: 0.85rem;" for="remember">Remember me</label>
                            </div>
                            <a href="#" class="text-decoration-none" style="color: #60a5fa; font-size: 0.85rem;">Forgot password?</a>
                        </div>
                        
                        <button type="submit" class="btn-login">Login</button>

                        <div class="text-center mt-4 pt-3 border-top">
                            <p class="text-muted small fw-semibold mb-3">Not a member yet?</p>
                            <button type="button" class="btn-signup">Sign up</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>