<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart — OrdernBrew</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{--bg:#0d0f14;--card:rgba(255,255,255,.05);--border:rgba(255,255,255,.08);--accent:#f59e0b;--accent-2:#10b981;--accent-4:#ef4444;--t1:#f1f5f9;--t2:#94a3b8;--t3:#475569}
        body{font-family:'Outfit',sans-serif;background:var(--bg);color:var(--t1);min-height:100vh}
        nav{position:sticky;top:0;z-index:99;background:rgba(13,15,20,.92);backdrop-filter:blur(16px);border-bottom:1px solid var(--border);padding:0 32px;display:flex;align-items:center;justify-content:space-between;height:64px}
        .nav-logo{display:flex;align-items:center;gap:10px;font-size:1.1rem;font-weight:700;color:var(--accent);text-decoration:none}
        .nav-logo .icon{width:32px;height:32px;background:var(--accent);border-radius:8px;display:grid;place-items:center}
        .nav-logo span{color:var(--t1)}
        .nav-link{padding:8px 14px;border-radius:10px;color:var(--t2);text-decoration:none;font-size:.875rem;font-weight:500;transition:background .2s,color .2s;text-decoration:none}
        .nav-link:hover{background:rgba(255,255,255,.08);color:var(--t1)}
        main{max-width:900px;margin:0 auto;padding:36px 24px}
        h1{font-size:1.75rem;font-weight:700;margin-bottom:28px}
        .alert{padding:12px 18px;border-radius:10px;font-size:.875rem;margin-bottom:20px}
        .alert-success{background:rgba(16,185,129,.12);border:1px solid rgba(16,185,129,.3);color:var(--accent-2)}
        .empty-state{text-align:center;padding:80px 20px}
        .empty-state .icon{font-size:4rem;margin-bottom:16px}
        .empty-state p{color:var(--t2);margin-bottom:24px}
        .btn-primary{background:var(--accent);color:#0d0f14;padding:12px 28px;border-radius:12px;font-weight:700;text-decoration:none;font-size:.95rem}
        .layout{display:grid;grid-template-columns:1fr 300px;gap:24px;align-items:start}
        .card{background:var(--card);border:1px solid var(--border);border-radius:16px;overflow:hidden}
        .cart-item{display:flex;align-items:center;gap:16px;padding:16px 20px;border-bottom:1px solid var(--border)}
        .cart-item:last-child{border-bottom:none}
        .item-img{width:56px;height:56px;border-radius:10px;object-fit:cover;flex-shrink:0}
        .item-img-ph{width:56px;height:56px;border-radius:10px;background:rgba(255,255,255,.06);display:grid;place-items:center;font-size:1.5rem;flex-shrink:0}
        .item-info{flex:1}
        .item-name{font-weight:600;font-size:.9rem}
        .item-price{color:var(--t2);font-size:.8rem;margin-top:2px}
        .item-controls{display:flex;align-items:center;gap:8px}
        .qty-btn{width:28px;height:28px;border-radius:7px;background:rgba(255,255,255,.08);border:1px solid var(--border);color:var(--t1);font-size:1rem;cursor:pointer;display:grid;place-items:center;font-family:'Outfit',sans-serif;transition:background .15s}
        .qty-btn:hover{background:rgba(255,255,255,.15)}
        .qty-num{min-width:28px;text-align:center;font-weight:600;font-size:.9rem}
        .btn-remove{background:rgba(239,68,68,.12);color:var(--accent-4);border:1px solid rgba(239,68,68,.2);padding:5px 10px;border-radius:7px;font-size:.72rem;font-weight:600;cursor:pointer;font-family:'Outfit',sans-serif}
        .item-subtotal{font-weight:700;color:var(--accent);min-width:80px;text-align:right;font-size:.9rem}
        .summary-card{background:var(--card);border:1px solid var(--border);border-radius:16px;padding:24px}
        .summary-title{font-size:1rem;font-weight:600;margin-bottom:20px}
        .summary-row{display:flex;justify-content:space-between;margin-bottom:10px;font-size:.875rem;color:var(--t2)}
        .summary-total{display:flex;justify-content:space-between;margin-top:16px;padding-top:16px;border-top:1px solid var(--border);font-weight:700;font-size:1.1rem}
        .summary-total span:last-child{color:var(--accent)}
        .btn-checkout{display:block;width:100%;background:var(--accent);color:#0d0f14;padding:14px;border-radius:12px;font-weight:700;text-align:center;text-decoration:none;font-size:1rem;margin-top:20px;transition:opacity .2s}
        .btn-checkout:hover{opacity:.85}
        .btn-continue{display:block;width:100%;background:rgba(255,255,255,.06);color:var(--t2);padding:12px;border-radius:12px;font-weight:600;text-align:center;text-decoration:none;font-size:.875rem;margin-top:10px}
    </style>
</head>
<body>
<nav>
    <a href="{{ route('home') }}" class="nav-logo"><div class="icon">☕</div><span>Order<b>nBrew</b></span></a>
    <a href="{{ route('customer.menu') }}" class="nav-link">← Back to Menu</a>
</nav>
<main>
    <h1>🛒 Your Cart</h1>
    @if(session('success'))<div class="alert alert-success">✅ {{ session('success') }}</div>@endif

    @if(empty($cart))
        <div class="empty-state">
            <div class="icon">🛒</div>
            <p>Your cart is empty. Add some items from the menu!</p>
            <a href="{{ route('customer.menu') }}" class="btn-primary">Browse Menu</a>
        </div>
    @else
    <div class="layout">
        <div class="card">
            @foreach($cart as $key => $item)
            <div class="cart-item">
                @if($item['image'])<img src="{{ Storage::url($item['image']) }}" class="item-img" alt="">
                @else<div class="item-img-ph">🍴</div>@endif
                <div class="item-info">
                    <div class="item-name">{{ $item['name'] }}</div>
                    <div class="item-price">Rp {{ number_format($item['price'],0,',','.') }} / item</div>
                </div>
                <div class="item-controls">
                    <form action="{{ route('cart.update') }}" method="POST" style="display:contents">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $key }}">
                        <input type="hidden" name="quantity" id="qty-val-{{ $key }}" value="{{ $item['quantity'] }}">
                        <button type="button" class="qty-btn" onclick="changeQty('{{ $key }}',-1)">−</button>
                        <span class="qty-num" id="qty-show-{{ $key }}">{{ $item['quantity'] }}</span>
                        <button type="button" class="qty-btn" onclick="changeQty('{{ $key }}',1)">+</button>
                        <button type="submit" id="btn-update-{{ $key }}" style="display:none"></button>
                    </form>
                    <form action="{{ route('cart.remove') }}" method="POST">
                        @csrf<input type="hidden" name="menu_id" value="{{ $key }}">
                        <button type="submit" class="btn-remove" id="btn-rm-{{ $key }}">🗑</button>
                    </form>
                </div>
                <div class="item-subtotal">Rp {{ number_format($item['price'] * $item['quantity'],0,',','.') }}</div>
            </div>
            @endforeach
        </div>

        <div class="summary-card">
            <div class="summary-title">Order Summary</div>
            @foreach($cart as $item)
            <div class="summary-row"><span>{{ $item['name'] }} ×{{ $item['quantity'] }}</span><span>Rp {{ number_format($item['price']*$item['quantity'],0,',','.') }}</span></div>
            @endforeach
            <div class="summary-total"><span>Total</span><span>Rp {{ number_format($total,0,',','.') }}</span></div>
            <a href="{{ route('checkout.index') }}" class="btn-checkout" id="btn-checkout">Proceed to Checkout →</a>
            <a href="{{ route('customer.menu') }}" class="btn-continue">+ Add More Items</a>
        </div>
    </div>
    @endif
</main>
<script>
function changeQty(key,delta){
    const show=document.getElementById('qty-show-'+key);
    const val=document.getElementById('qty-val-'+key);
    let q=parseInt(show.textContent)+delta;
    if(q<1)q=1;
    show.textContent=q;
    val.value=q;
    document.getElementById('btn-update-'+key).click();
}
</script>
</body>
</html>
