<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OrdernBrew — Order Your Favorite Drinks</title>
    <meta name="description" content="Order delicious coffee and food at OrdernBrew. Browse our menu and place your order in seconds.">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{
            --bg:#07090e;
            --card:rgba(255,255,255,0.03);
            --card-hover:rgba(255,255,255,0.07);
            --border:rgba(255,255,255,0.06);
            --border-hover:rgba(255,255,255,0.12);
            --accent:#f59e0b;
            --accent-glow:rgba(245,158,11,0.35);
            --accent-2:#10b981;
            --t1:#f8fafc;
            --t2:#94a3b8;
            --t3:#475569;
            --glow-1:rgba(99,102,241,0.15);
            --glow-2:rgba(245,158,11,0.1);
        }
        body{
            font-family:'Outfit',sans-serif;
            background:var(--bg);
            color:var(--t1);
            min-height:100vh;
            overflow-x:hidden;
            position:relative;
        }
        /* Background decorative glow elements */
        body::before, body::after {
            content: '';
            position: absolute;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            filter: blur(100px);
            z-index: 0;
            pointer-events: none;
            opacity: 0.6;
            animation: floatGlow 10s ease-in-out infinite alternate;
        }
        body::before {
            background: var(--glow-1);
            top: 10%;
            left: -100px;
        }
        body::after {
            background: var(--glow-2);
            bottom: 10%;
            right: -100px;
            animation-delay: -5s;
        }
        @keyframes floatGlow {
            0% { transform: translateY(0) scale(1); }
            100% { transform: translateY(30px) scale(1.1); }
        }

        nav{
            position:sticky;
            top:0;
            z-index:99;
            background:rgba(7,9,14,0.7);
            backdrop-filter:blur(20px);
            -webkit-backdrop-filter:blur(20px);
            border-bottom:1px solid var(--border);
            padding:0 36px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            height:70px;
            transition: all 0.3s ease;
        }
        .nav-logo{
            display:flex;
            align-items:center;
            gap:12px;
            font-size:1.2rem;
            font-weight:700;
            color:var(--accent);
            text-decoration:none;
            transition: transform 0.2s ease;
        }
        .nav-logo:hover {
            transform: scale(1.02);
        }
        .nav-logo .icon{
            width:36px;
            height:36px;
            background:linear-gradient(135deg, var(--accent), #d97706);
            border-radius:10px;
            display:grid;
            place-items:center;
            font-size:1.1rem;
            box-shadow: 0 4px 15px var(--accent-glow);
        }
        .nav-logo span{color:var(--t1)}
        .nav-links{display:flex;align-items:center;gap:12px}
        .nav-link{
            padding:8px 16px;
            border-radius:10px;
            color:var(--t2);
            text-decoration:none;
            font-size:.875rem;
            font-weight:500;
            transition: all 0.2s ease;
        }
        .nav-link:hover,.nav-link.active{
            background:rgba(255,255,255,.05);
            color:var(--t1);
        }
        .btn-nav{
            background:var(--accent);
            color:#07090e;
            padding:10px 20px;
            border-radius:10px;
            font-weight:700;
            text-decoration:none;
            font-size:.875rem;
            box-shadow: 0 4px 12px var(--accent-glow);
            transition: all 0.2s ease;
        }
        .btn-nav:hover{
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(245,158,11,0.5);
            opacity: 0.95;
        }

        .hero{
            min-height:calc(85vh - 70px);
            display:flex;
            align-items:center;
            justify-content:center;
            text-align:center;
            padding:80px 24px;
            position:relative;
            z-index: 1;
        }
        .hero-content{
            max-width:720px;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .hero-badge{
            display:inline-flex;
            align-items:center;
            gap:8px;
            background:rgba(245,158,11,.08);
            border:1px solid rgba(245,158,11,.2);
            border-radius:999px;
            padding:6px 18px;
            font-size:.8rem;
            font-weight:600;
            color:var(--accent);
            margin-bottom:28px;
            backdrop-filter: blur(5px);
        }
        .hero h1{
            font-size:clamp(2.8rem, 7vw, 4.5rem);
            font-weight:800;
            line-height:1.05;
            letter-spacing:-.03em;
            margin-bottom:24px;
            background: linear-gradient(180deg, #ffffff 0%, #e2e8f0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero h1 span{
            background: linear-gradient(135deg, var(--accent) 0%, #f97316 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero p{
            font-size:1.15rem;
            color:var(--t2);
            line-height:1.75;
            margin-bottom:40px;
        }
        .hero-btns{
            display:flex;
            gap:16px;
            justify-content:center;
            flex-wrap:wrap;
        }
        .btn-primary{
            background:linear-gradient(135deg, var(--accent), #f97316);
            color:#07090e;
            padding:16px 36px;
            border-radius:14px;
            font-weight:700;
            text-decoration:none;
            font-size:1rem;
            box-shadow: 0 4px 20px var(--accent-glow);
            transition: all 0.25s ease;
            display:inline-flex;
            align-items:center;
            gap:10px;
        }
        .btn-primary:hover{
            transform:translateY(-3px);
            box-shadow: 0 8px 25px rgba(245,158,11,0.5);
        }
        .btn-ghost{
            background:rgba(255,255,255,.04);
            border: 1px solid var(--border);
            color:var(--t1);
            padding:16px 36px;
            border-radius:14px;
            font-weight:600;
            text-decoration:none;
            font-size:1rem;
            transition: all 0.25s ease;
            backdrop-filter: blur(10px);
        }
        .btn-ghost:hover{
            background:rgba(255,255,255,.08);
            border-color: var(--border-hover);
            transform: translateY(-2px);
        }

        .features{
            padding:60px 36px 100px;
            max-width:1150px;
            margin:0 auto;
            position: relative;
            z-index: 1;
        }
        .features-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
            gap:24px;
        }
        .feature-card{
            background:var(--card);
            border:1px solid var(--border);
            border-radius:20px;
            padding:32px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .feature-card:hover{
            transform:translateY(-6px);
            background:var(--card-hover);
            border-color: var(--border-hover);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        .feature-icon{
            font-size:2.2rem;
            margin-bottom:20px;
            display: inline-block;
            background: rgba(255,255,255,0.02);
            width: 60px;
            height: 60px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            border: 1px solid var(--border);
        }
        .feature-card h3{
            font-size:1.1rem;
            font-weight:700;
            margin-bottom:12px;
            color: var(--t1);
        }
        .feature-card p{
            font-size:.9rem;
            color:var(--t2);
            line-height:1.65;
        }
        footer{
            text-align:center;
            padding:40px;
            border-top:1px solid var(--border);
            color:var(--t3);
            font-size:.85rem;
            position: relative;
            z-index: 1;
        }
        @media (max-width: 768px) {
            nav { padding: 0 20px; }
            .nav-links { display: none; } /* On mobile, let's keep it minimal */
        }
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
