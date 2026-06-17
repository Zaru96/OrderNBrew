<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OrdernBrew — Order Your Favorite Drinks</title>
    <meta name="description" content="Order delicious coffee and food at OrdernBrew. Browse our menu and place your order in seconds.">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{--bg:#0d0f14;--card:rgba(255,255,255,.05);--border:rgba(255,255,255,.08);--accent:#f59e0b;--accent-2:#10b981;--t1:#f1f5f9;--t2:#94a3b8;--t3:#475569}
        body{font-family:'Outfit',sans-serif;background:var(--bg);color:var(--t1);min-height:100vh}
        nav{position:sticky;top:0;z-index:99;background:rgba(13,15,20,.9);backdrop-filter:blur(16px);border-bottom:1px solid var(--border);padding:0 36px;display:flex;align-items:center;justify-content:space-between;height:64px}
        .nav-logo{display:flex;align-items:center;gap:10px;font-size:1.1rem;font-weight:700;color:var(--accent);text-decoration:none}
        .nav-logo .icon{width:32px;height:32px;background:var(--accent);border-radius:8px;display:grid;place-items:center;font-size:1rem}
        .nav-logo span{color:var(--t1)}
        .nav-links{display:flex;align-items:center;gap:8px}
        .nav-link{padding:8px 16px;border-radius:10px;color:var(--t2);text-decoration:none;font-size:.875rem;font-weight:500;transition:background .2s,color .2s}
        .nav-link:hover,.nav-link.active{background:rgba(255,255,255,.08);color:var(--t1)}
        .btn-nav{background:var(--accent);color:#0d0f14;padding:8px 18px;border-radius:10px;font-weight:700;text-decoration:none;font-size:.875rem;transition:opacity .2s}
        .btn-nav:hover{opacity:.85}
        .hero{min-height:calc(100vh - 64px);display:flex;align-items:center;justify-content:center;text-align:center;padding:48px 24px;position:relative;overflow:hidden}
        .hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 50% 40%,rgba(245,158,11,.12) 0%,transparent 65%)}
        .hero-content{position:relative;max-width:640px}
        .hero-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(245,158,11,.12);border:1px solid rgba(245,158,11,.25);border-radius:999px;padding:6px 16px;font-size:.8rem;font-weight:600;color:var(--accent);margin-bottom:28px}
        .hero h1{font-size:clamp(2.5rem,6vw,4rem);font-weight:800;line-height:1.1;letter-spacing:-.03em;margin-bottom:20px}
        .hero h1 span{color:var(--accent)}
        .hero p{font-size:1.1rem;color:var(--t2);line-height:1.7;margin-bottom:36px}
        .hero-btns{display:flex;gap:12px;justify-content:center;flex-wrap:wrap}
        .btn-primary{background:var(--accent);color:#0d0f14;padding:14px 32px;border-radius:12px;font-weight:700;text-decoration:none;font-size:1rem;transition:opacity .2s,transform .15s;display:inline-flex;align-items:center;gap:8px}
        .btn-primary:hover{opacity:.88;transform:translateY(-2px)}
        .btn-ghost{background:rgba(255,255,255,.07);color:var(--t1);padding:14px 32px;border-radius:12px;font-weight:600;text-decoration:none;font-size:1rem;transition:background .2s}
        .btn-ghost:hover{background:rgba(255,255,255,.12)}
        .features{padding:80px 36px;max-width:1100px;margin:0 auto}
        .features-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:20px}
        .feature-card{background:var(--card);border:1px solid var(--border);border-radius:16px;padding:28px;transition:transform .25s,background .25s}
        .feature-card:hover{transform:translateY(-4px);background:rgba(255,255,255,.08)}
        .feature-icon{font-size:2rem;margin-bottom:16px}
        .feature-card h3{font-size:1rem;font-weight:600;margin-bottom:8px}
        .feature-card p{font-size:.875rem;color:var(--t2);line-height:1.6}
        footer{text-align:center;padding:32px;border-top:1px solid var(--border);color:var(--t3);font-size:.8rem}
    </style>
</head>
<body>
<nav>
    <a href="{{ route('home') }}" class="nav-logo"><div class="icon">☕</div><span>Order<b>nBrew</b></span></a>
    <div class="nav-links">
        <a href="{{ route('customer.menu') }}" class="nav-link" id="nav-menu">Menu</a>
        <a href="{{ route('cart.index') }}" class="nav-link" id="nav-cart">🛒 Cart</a>
        <a href="{{ route('tracking') }}" class="nav-link" id="nav-track">Track Order</a>
        <a href="{{ route('customer.menu') }}" class="btn-nav" id="btn-order-now">Order Now</a>
    </div>
</nav>

<section class="hero">
    <div class="hero-content">
        <div class="hero-badge">☕ {{ $totalMenus }}+ items available</div>
        <h1>Craft Coffee,<br>Ordered <span>Your Way</span></h1>
        <p>Browse our full menu, add items to your cart, and place your order — all from your table. No waiting in line.</p>
        <div class="hero-btns">
            <a href="{{ route('customer.menu') }}" class="btn-primary" id="btn-browse-menu">🍽️ Browse Menu</a>
            <a href="{{ route('tracking') }}" class="btn-ghost" id="btn-track">Track My Order</a>
        </div>
    </div>
</section>

<section class="features">
    <div class="features-grid">
        <div class="feature-card"><div class="feature-icon">📱</div><h3>Scan & Order</h3><p>Open the menu from your table and order directly. No app download required.</p></div>
        <div class="feature-card"><div class="feature-icon">⚡</div><h3>Fast Preparation</h3><p>Our kitchen receives your order instantly after payment confirmation.</p></div>
        <div class="feature-card"><div class="feature-icon">🔍</div><h3>Live Tracking</h3><p>Track your order status in real time — from queue to your table.</p></div>
        <div class="feature-card"><div class="feature-icon">💳</div><h3>Flexible Payment</h3><p>Pay with Cash, QRIS, or Bank Transfer — whichever you prefer.</p></div>
    </div>
</section>

<footer>© {{ date('Y') }} OrdernBrew. Crafted with ☕</footer>
</body>
</html>
