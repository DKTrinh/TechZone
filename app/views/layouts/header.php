<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleanTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #2563eb;
            --bg-light-blue: #f0f7ff;
            --dark-bg: #111827;
        }
        body { font-family: 'Inter', system-ui, sans-serif; color: #333; }
        
        /* Navbar */
        .navbar-brand { color: var(--dark-bg); font-weight: 800; font-size: 1.5rem; }
        .navbar-brand i { color: var(--primary-blue); }
        .nav-link { font-size: 0.9rem; color: #555; margin: 0 10px; font-weight: 500; }
        .btn-primary-custom { background-color: var(--primary-blue); color: white; border: none; border-radius: 8px; padding: 8px 20px; font-weight: 600; }
        
        /* Hero Section */
        .hero-section { padding: 80px 0; background: linear-gradient(135deg, #f8fafc 0%, #e0f2fe 100%); }
        .badge-soft { background: #e0e7ff; color: var(--primary-blue); padding: 8px 16px; border-radius: 20px; font-weight: 600; font-size: 0.85rem; }
        .hero-title { font-size: 3.5rem; font-weight: 800; color: var(--dark-bg); line-height: 1.2; }
        .hero-image-wrapper { position: relative; }
        .hero-image { width: 100%; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .floating-stat { position: absolute; bottom: 20px; left: -30px; background: white; padding: 20px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        
        /* Stats Banner */
        .stats-banner { background-color: var(--dark-bg); color: white; padding: 40px 0; }
        .stat-number { font-size: 2.5rem; font-weight: 800; margin-bottom: 0; }
        .stat-text { color: #9ca3af; font-size: 0.9rem; }

        /* General Sections */
        .section-title { font-weight: 800; color: var(--dark-bg); margin-bottom: 15px; }
        
        /* Cards */
        .tech-card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); transition: 0.3s; padding: 20px; }
        .tech-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
        .tech-icon { width: 50px; height: 50px; background: var(--primary-blue); color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 20px; }
        
        .story-card { border: none; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .story-card img { height: 220px; object-fit: cover; }
        .story-badge { position: absolute; top: 15px; right: 15px; background: var(--primary-blue); color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
        
        /* Footer & CTA */
        .cta-section { background: linear-gradient(90deg, #1e3a8a 0%, #3b82f6 100%); color: white; padding: 80px 0; }
        .footer { background-color: #0f172a; color: #9ca3af; padding: 60px 0 20px; }
        .footer a { color: #9ca3af; text-decoration: none; transition: 0.2s; }
        .footer a:hover { color: white; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white sticky-top py-3 shadow-sm">
    <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="?url=home">
    <i class="bi bi-leaf-fill me-2"></i> CleanTech
</a>

<ul class="navbar-nav">
    <li class="nav-item"><a class="nav-link" href="?url=solutions">Solutions</a></li>
    <li class="nav-item"><a class="nav-link" href="?url=technology">Technology</a></li>
    <li class="nav-item"><a class="nav-link" href="?url=case-studies">Case Studies</a></li>
    <li class="nav-item"><a class="nav-link" href="?url=team">Team</a></li>
    <li class="nav-item"><a class="nav-link" href="?url=contact">Contact</a></li>
</ul>

<button type="button" class="btn btn-primary-custom d-none d-lg-block" data-bs-toggle="modal" data-bs-target="#loginModal">
    Login
</button>

</nav>