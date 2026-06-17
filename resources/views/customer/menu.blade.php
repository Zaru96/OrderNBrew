<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu — OrdernBrew</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{--bg:#0d0f14;--card:rgba(255,255,255,.05);--border:rgba(255,255,255,.08);--accent:#f59e0b;--accent-2:#10b981;--t1:#f1f5f9;--t2:#94a3b8;--t3:#475569}
        body{font-family:'Outfit',sans-serif;background:var(--bg);color:var(--t1);min-height:100vh}
        nav{position:sticky;top:0;z-index:99;background:rgba(13,15,20,.92);backdrop-filter:blur(16px);border-bottom:1px solid var(--border);padding:0 32px;display:flex;align-items:center;justify-content:space-between;height:64px}
        .nav-logo{display:flex;align-items:center;gap:10px;font-size:1.1rem;font-weight:700;color:var(--accent);text-decoration:none}
        .nav-logo .icon{width:32px;height:32px;background:var(--accent);border-radius:8px;display:grid;place-items:center}
        .nav-logo span{color:var(--t1)}
        .nav-right{display:flex;align-items:center;gap:8px}
        .nav-link{padding:8px 14px;border-radius:10px;color:var(--t2);text-decoration:none;font-size:.875rem;font-weight:500;transition:background .2s,color .2s}
        .nav-link:hover{background:rgba(255,255,255,.08);color:var(--t1)}
        .cart-btn{display:flex;align-items:center;gap:6px;background:var(--accent);color:#0d0f14;padding:8px 16px;border-radius:10px;font-weight:700;text-decoration:none;font-size:.875rem}
        .cart-count{background:#0d0f14;color:var(--accent);width:20px;height:20px;border-radius:50%;display:grid;place-items:center;font-size:.7rem;font-weight:700}
        main{max-width:1200px;margin:0 auto;padding:36px 24px}
        h1{font-size:1.75rem;font-weight:700;margin-bottom:4px}
        .sub{color:var(--t2);font-size:.9rem;margin-bottom:28px}
        .alert{padding:12px 18px;border-radius:10px;font-size:.875rem;margin-bottom:20px}
        .alert-success{background:rgba(16,185,129,.12);border:1px solid rgba(16,185,129,.3);color:var(--accent-2)}
        .alert-error{background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.3);color:#ef4444}
        .cat-tabs{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:32px}
        .cat-tab{padding:8px 18px;border-radius:999px;font-size:.85rem;font-weight:600;cursor:pointer;border:1px solid var(--border);color:var(--t2);background:transparent;font-family:'Outfit',sans-serif;transition:all .2s}
        .cat-tab:hover,.cat-tab.active{background:var(--accent);color:#0d0f14;border-color:var(--accent)}
        .cat-section{margin-bottom:48px}
        .cat-title{font-size:1.1rem;font-weight:700;margin-bottom:20px;display:flex;align-items:center;gap:10px}
        .cat-title::after{content:'';flex:1;height:1px;background:var(--border)}
        .menu-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:18px}
        .menu-card{background:var(--card);border:1px solid var(--border);border-radius:16px;overflow:hidden;transition:transform .25s,border-color .25s}
        .menu-card:hover{transform:translateY(-4px);border-color:rgba(255,255,255,.14)}
        .menu-img{width:100%;height:155px;object-fit:cover;display:block}
        .menu-img-ph{width:100%;height:155px;background:rgba(255,255,255,.04);display:grid;place-items:center;font-size:3rem}
        .menu-body{padding:16px}
        .menu-name{font-size:.95rem;font-weight:600;margin-bottom:4px}
        .menu-desc{font-size:.78rem;color:var(--t2);margin-bottom:12px;line-height:1.5}
        .menu-footer{display:flex;align-items:center;justify-content:space-between;gap:8px}
        .menu-price{font-size:1rem;font-weight:700;color:var(--accent)}
        .btn-add{background:var(--accent);color:#0d0f14;border:none;padding:8px 14px;border-radius:8px;font-size:.8rem;font-weight:700;cursor:pointer;font-family:'Outfit',sans-serif;transition:opacity .2s}
        .btn-add:hover{opacity:.85}
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
    @if(session('success'))<div class="alert alert-success">✅ {{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-error">❌ {{ session('error') }}</div>@endif
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
                    @if($menu->image) <img src="{{ Storage::url($menu->image) }}" class="menu-img" alt="{{ $menu->name }}">
                    @else <div class="menu-img-ph">☕</div> @endif
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
document.querySelectorAll('.cat-tab').forEach(t=>t.addEventListener('click',()=>{
    document.querySelectorAll('.cat-tab').forEach(x=>x.classList.remove('active'));
    t.classList.add('active');
    const target=t.dataset.target;
    document.querySelectorAll('.cat-section').forEach(s=>{s.style.display=(target==='all'||s.id===target)?'':'none'});
}));
</script>
</body>
</html>
