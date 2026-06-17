<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu — OrdernBrew</title>
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
            --glow-1:rgba(99,102,241,0.08);
            --glow-2:rgba(245,158,11,0.06);
        }
        body{
            font-family:'Outfit',sans-serif;
            background:var(--bg);
            color:var(--t1);
            min-height:100vh;
            position:relative;
            overflow-x:hidden;
        }
        /* Background decorative glow */
        body::before, body::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            filter: blur(120px);
            z-index: 0;
            pointer-events: none;
            opacity: 0.5;
        }
        body::before {
            background: var(--glow-1);
            top: -100px;
            right: -100px;
        }
        body::after {
            background: var(--glow-2);
            bottom: 10%;
            left: -150px;
        }

        nav{
            position:sticky;
            top:0;
            z-index:99;
            background:rgba(7,9,14,0.72);
            backdrop-filter:blur(20px);
            -webkit-backdrop-filter:blur(20px);
            border-bottom:1px solid var(--border);
            padding:0 36px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            height:70px;
        }
        .nav-logo{
            display:flex;
            align-items:center;
            gap:12px;
            font-size:1.2rem;
            font-weight:700;
            color:var(--accent);
            text-decoration:none;
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
        .nav-right{display:flex;align-items:center;gap:12px}
        .nav-link{
            padding:8px 16px;
            border-radius:10px;
            color:var(--t2);
            text-decoration:none;
            font-size:.875rem;
            font-weight:500;
            transition: all 0.2s ease;
        }
        .nav-link:hover{
            background:rgba(255,255,255,.05);
            color:var(--t1);
        }
        .cart-btn{
            display:flex;
            align-items:center;
            gap:8px;
            background:linear-gradient(135deg, var(--accent), #f97316);
            color:#07090e;
            padding:10px 20px;
            border-radius:12px;
            font-weight:700;
            text-decoration:none;
            font-size:.875rem;
            box-shadow: 0 4px 12px var(--accent-glow);
            transition: all 0.2s ease;
        }
        .cart-btn:hover{
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(245,158,11,0.5);
        }
        .cart-count{
            background:#07090e;
            color:var(--accent);
            width:22px;
            height:22px;
            border-radius:50%;
            display:grid;
            place-items:center;
            font-size:.7rem;
            font-weight:800;
        }
        main{
            max-width:1200px;
            margin:0 auto;
            padding:40px 24px 80px;
            position: relative;
            z-index: 1;
        }
        h1{
            font-size:2rem;
            font-weight:800;
            margin-bottom:6px;
            letter-spacing: -0.02em;
        }
        .sub{color:var(--t2);font-size:.95rem;margin-bottom:32px}

        /* Toast Alert Container */
        .toast-container {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .toast{
            background: rgba(13, 18, 30, 0.85);
            border: 1px solid var(--border);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 16px 24px;
            border-radius: 14px;
            color: var(--t1);
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transform: translateX(120%);
            animation: slideIn 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            position: relative;
            overflow: hidden;
        }
        .toast::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 100%;
            background: var(--accent);
            animation: progress 4s linear forwards;
        }
        .toast-success::after { background: var(--accent-2); }
        .toast-error::after { background: #ef4444; }

        @keyframes slideIn {
            to { transform: translateX(0); }
        }
        @keyframes progress {
            to { width: 0; }
        }

        .cat-tabs{
            display:flex;
            gap:10px;
            flex-wrap:wrap;
            margin-bottom:40px;
            padding-bottom:8px;
        }
        .cat-tab{
            padding:10px 22px;
            border-radius:999px;
            font-size:.875rem;
            font-weight:600;
            cursor:pointer;
            border:1px solid var(--border);
            color:var(--t2);
            background:var(--card);
            font-family:'Outfit',sans-serif;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            backdrop-filter: blur(5px);
        }
        .cat-tab:hover{
            border-color: var(--border-hover);
            color: var(--t1);
            transform: translateY(-1px);
        }
        .cat-tab.active{
            background:linear-gradient(135deg, var(--accent), #f97316);
            color:#07090e;
            border-color:var(--accent);
            box-shadow: 0 4px 12px var(--accent-glow);
        }
        .cat-section{
            margin-bottom:56px;
        }
        .cat-title{
            font-size:1.25rem;
            font-weight:700;
            margin-bottom:24px;
            display:flex;
            align-items:center;
            gap:14px;
        }
        .cat-title::after{
            content:'';
            flex:1;
            height:1px;
            background:linear-gradient(90deg, var(--border) 0%, transparent 100%);
        }
        .menu-grid{
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(230px,1fr));
            gap:22px;
        }
        .menu-card{
            background:var(--card);
            border:1px solid var(--border);
            border-radius:20px;
            overflow:hidden;
            display: flex;
            flex-direction: column;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .menu-card:hover{
            transform:translateY(-6px);
            border-color:var(--border-hover);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        }
        .menu-card:hover .menu-img {
            transform: scale(1.05);
        }
        .img-container {
            width: 100%;
            height: 165px;
            overflow: hidden;
            position: relative;
            background: rgba(255,255,255,0.01);
            border-bottom: 1px solid var(--border);
        }
        .menu-img{
            width:100%;
            height:100%;
            object-fit:cover;
            display:block;
            transition: transform 0.5s ease;
        }
        .menu-img-ph{
            width:100%;
            height:100%;
            display:grid;
            place-items:center;
            font-size:3.5rem;
            color: var(--t3);
            background: rgba(255,255,255,0.02);
        }
        .menu-body{
            padding:20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .menu-name{
            font-size:1rem;
            font-weight:700;
            margin-bottom:6px;
            color: var(--t1);
        }
        .menu-desc{
            font-size:.8rem;
            color:var(--t2);
            margin-bottom:20px;
            line-height:1.6;
            flex-grow: 1;
        }
        .menu-footer{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:10px;
            margin-top: auto;
        }
        .menu-price{
            font-size:1.1rem;
            font-weight:800;
            color:var(--accent);
        }
        .btn-add{
            background:var(--accent);
            color:#07090e;
            border:none;
            padding:10px 18px;
            border-radius:10px;
            font-size:.85rem;
            font-weight:700;
            cursor:pointer;
            font-family:'Outfit',sans-serif;
            box-shadow: 0 4px 10px rgba(245,158,11,0.2);
            transition: all 0.2s ease;
        }
        .btn-add:hover{
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(245,158,11,0.4);
        }
        @media(max-width:600px){
            main{padding:24px 16px}
            nav{padding:0 16px}
        }
    </style>
</head>
<body>
<nav>
    <a href="{{ route('home') }}" class="nav-logo"><div class="icon">☕</div><span>Order<b>nBrew</b></span></a>
    <div class="nav-right">
        <a href="{{ route('tracking') }}" class="nav-link">Track Order</a>
        <a href="{{ route('cart.index') }}" class="cart-btn" id="nav-cart">
            🛒 Cart @if($cartCount > 0)<span class="cart-count">{{ $cartCount }}</span>@endif
        </a>
    </div>
</nav>
<main>
    <h1>Our Menu</h1><div class="sub">Browse and add your favorites to cart.</div>
    <!-- Toast Container -->
    <div class="toast-container">
        @if(session('success'))
            <div class="toast toast-success" id="success-toast">
                <span>✅</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="toast toast-error" id="error-toast">
                <span>❌</span>
                <span>{{ session('error') }}</span>
            </div>
        @endif
    </div>

    @if($categories->isEmpty())
        <div style="text-align:center;padding:80px 20px;color:var(--t3)"><div style="font-size:3rem;margin-bottom:12px">🍽️</div><p>No menu available yet.</p></div>
    @else
        <div class="cat-tabs">
            <button class="cat-tab active" data-target="all" id="tab-all">All</button>
            @foreach($categories as $cat) @if($cat->menus->isNotEmpty()) <button class="cat-tab" data-target="cat-{{ $cat->id }}" id="tab-{{ $cat->id }}">{{ $cat->name }}</button> @endif @endforeach
        </div>
        @foreach($categories as $cat)
        @if($cat->menus->isNotEmpty())
        <div class="cat-section" id="cat-{{ $cat->id }}">
            <div class="cat-title">{{ $cat->name }}</div>
            <div class="menu-grid">
                @foreach($cat->menus as $menu)
                <div class="menu-card">
                    <div class="img-container">
                        @if($menu->image) <img src="{{ Storage::url($menu->image) }}" class="menu-img" alt="{{ $menu->name }}">
                        @else <div class="menu-img-ph">☕</div> @endif
                    </div>
                    <div class="menu-body">
                        <div class="menu-name">{{ $menu->name }}</div>
                        @if($menu->description)<div class="menu-desc">{{ Str::limit($menu->description,70) }}</div>@endif
                        <div class="menu-footer">
                            <div class="menu-price">Rp {{ number_format($menu->price,0,',','.') }}</div>
                            <form action="{{ route('cart.add',$menu) }}" method="POST">
                                @csrf <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn-add" id="btn-add-{{ $menu->id }}">+ Add</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @endforeach
    @endif
</main>
<script>
// Category switcher
document.querySelectorAll('.cat-tab').forEach(t=>t.addEventListener('click',()=>{
    document.querySelectorAll('.cat-tab').forEach(x=>x.classList.remove('active'));
    t.classList.add('active');
    const target=t.dataset.target;
    document.querySelectorAll('.cat-section').forEach(s=>{
        if (target==='all' || s.id===target) {
            s.style.display = '';
            s.style.opacity = '0';
            s.style.transform = 'translateY(15px)';
            setTimeout(() => {
                s.style.transition = 'all 0.4s ease';
                s.style.opacity = '1';
                s.style.transform = 'translateY(0)';
            }, 50);
        } else {
            s.style.display = 'none';
        }
    });
}));

// Toast Auto-Dismiss
document.querySelectorAll('.toast').forEach(toast => {
    setTimeout(() => {
        toast.style.transform = 'translateX(120%)';
        toast.style.transition = 'all 0.5s ease';
        setTimeout(() => toast.remove(), 500);
    }, 4000);
});
</script>
</body>
</html>
