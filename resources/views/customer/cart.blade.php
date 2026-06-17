<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart — OrdernBrew</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{
            --bg:#07090e;
            --card:rgba(255,255,255,0.03);
            --card-hover:rgba(255,255,255,0.06);
            --border:rgba(255,255,255,0.06);
            --border-hover:rgba(255,255,255,0.12);
            --accent:#f59e0b;
            --accent-glow:rgba(245,158,11,0.35);
            --accent-2:#10b981;
            --accent-4:#ef4444;
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
        main{
            max-width:1000px;
            margin:0 auto;
            padding:40px 24px 80px;
            position: relative;
            z-index: 1;
        }
        h1{
            font-size:2rem;
            font-weight:800;
            margin-bottom:28px;
            letter-spacing:-0.02em;
        }

        /* Toast notifications */
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
            background: var(--accent-2);
            animation: progress 4s linear forwards;
        }
        @keyframes slideIn { to { transform: translateX(0); } }
        @keyframes progress { to { width: 0; } }

        .empty-state{
            text-align:center;
            padding:80px 20px;
            background:var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }
        .empty-state .icon{font-size:4.5rem;margin-bottom:20px}
        .empty-state p{color:var(--t2);margin-bottom:28px;font-size:1.05rem}
        .btn-primary{
            background:linear-gradient(135deg, var(--accent), #f97316);
            color:#07090e;
            padding:14px 32px;
            border-radius:12px;
            font-weight:700;
            text-decoration:none;
            font-size:.95rem;
            box-shadow: 0 4px 12px var(--accent-glow);
            transition: all 0.2s ease;
            display: inline-block;
        }
        .btn-primary:hover{
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(245,158,11,0.5);
        }
        .layout{display:grid;grid-template-columns:1fr 320px;gap:28px;align-items:start}
        .card{
            background:var(--card);
            border:1px solid var(--border);
            border-radius:20px;
            overflow:hidden;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .cart-item{
            display:flex;
            align-items:center;
            gap:20px;
            padding:24px;
            border-bottom:1px solid var(--border);
            transition: background 0.2s ease;
        }
        .cart-item:hover{
            background: rgba(255,255,255,0.01);
        }
        .cart-item:last-child{border-bottom:none}
        .item-img{width:64px;height:64px;border-radius:12px;object-fit:cover;flex-shrink:0}
        .item-img-ph{
            width:64px;
            height:64px;
            border-radius:12px;
            background:rgba(255,255,255,.03);
            display:grid;
            place-items:center;
            font-size:1.8rem;
            flex-shrink:0;
            border: 1px solid var(--border);
        }
        .item-info{flex:1}
        .item-name{font-weight:700;font-size:.95rem;color:var(--t1)}
        .item-price{color:var(--t2);font-size:.8rem;margin-top:4px}
        .item-controls{display:flex;align-items:center;gap:12px}
        .qty-btn{
            width:30px;
            height:30px;
            border-radius:9px;
            background:rgba(255,255,255,.05);
            border:1px solid var(--border);
            color:var(--t1);
            font-size:1.1rem;
            cursor:pointer;
            display:grid;
            place-items:center;
            font-family:'Outfit',sans-serif;
            transition: all 0.2s ease;
        }
        .qty-btn:hover{
            background:rgba(255,255,255,.12);
            border-color: var(--border-hover);
        }
        .qty-num{min-width:28px;text-align:center;font-weight:700;font-size:.95rem}
        .btn-remove{
            background:rgba(239,68,68,.08);
            color:var(--accent-4);
            border:1px solid rgba(239,68,68,.15);
            width: 30px;
            height: 30px;
            border-radius:9px;
            font-size:.9rem;
            cursor:pointer;
            display: grid;
            place-items: center;
            transition: all 0.2s ease;
        }
        .btn-remove:hover{
            background:rgba(239,68,68,.2);
            border-color: rgba(239,68,68,0.4);
        }
        .item-subtotal{font-weight:800;color:var(--accent);min-width:90px;text-align:right;font-size:.95rem}
        .summary-card{
            background:var(--card);
            border:1px solid var(--border);
            border-radius:20px;
            padding:28px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .summary-title{font-size:1.1rem;font-weight:700;margin-bottom:24px;border-bottom:1px solid var(--border);padding-bottom:12px}
        .summary-row{display:flex;justify-content:space-between;margin-bottom:12px;font-size:.875rem;color:var(--t2)}
        .summary-total{
            display:flex;
            justify-content:space-between;
            margin-top:20px;
            padding-top:20px;
            border-top:1px solid var(--border);
            font-weight:800;
            font-size:1.15rem;
        }
        .summary-total span:last-child{color:var(--accent)}
        .btn-checkout{
            display:block;
            width:100%;
            background:linear-gradient(135deg, var(--accent), #f97316);
            color:#07090e;
            padding:16px;
            border-radius:14px;
            font-weight:700;
            text-align:center;
            text-decoration:none;
            font-size:1rem;
            margin-top:28px;
            box-shadow: 0 4px 15px var(--accent-glow);
            transition: all 0.25s ease;
        }
        .btn-checkout:hover{
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245,158,11,0.5);
        }
        .btn-continue{
            display:block;
            width:100%;
            background:rgba(255,255,255,.04);
            border: 1px solid var(--border);
            color:var(--t2);
            padding:14px;
            border-radius:14px;
            font-weight:600;
            text-align:center;
            text-decoration:none;
            font-size:.875rem;
            margin-top:12px;
            transition: all 0.2s ease;
        }
        .btn-continue:hover{
            background: rgba(255,255,255,0.08);
            color: var(--t1);
            border-color: var(--border-hover);
        }
    </style>
</head>
<body>
<nav>
    <a href="{{ route('home') }}" class="nav-logo"><div class="icon">☕</div><span>Order<b>nBrew</b></span></a>
    <a href="{{ route('customer.menu') }}" class="nav-link">← Back to Menu</a>
</nav>
<main>
    <h1>🛒 Your Cart</h1>
    
    <!-- Toast Container -->
    <div class="toast-container">
        @if(session('success'))
            <div class="toast" id="success-toast">
                <span>✅</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif
    </div>

    @if(empty($cart))
        <div class="empty-state">
            <div class="icon">🛒</div>
            <p>Your cart is empty. Add some delicious items from the menu!</p>
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
