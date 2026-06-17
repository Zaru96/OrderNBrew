<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout — OrdernBrew</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{--bg:#0d0f14;--card:rgba(255,255,255,.05);--border:rgba(255,255,255,.08);--accent:#f59e0b;--accent-2:#10b981;--t1:#f1f5f9;--t2:#94a3b8;--t3:#475569}
        body{font-family:'Outfit',sans-serif;background:var(--bg);color:var(--t1);min-height:100vh}
        nav{position:sticky;top:0;z-index:99;background:rgba(13,15,20,.92);backdrop-filter:blur(16px);border-bottom:1px solid var(--border);padding:0 32px;display:flex;align-items:center;justify-content:space-between;height:64px}
        .nav-logo{display:flex;align-items:center;gap:10px;font-size:1.1rem;font-weight:700;color:var(--accent);text-decoration:none}
        .nav-logo .icon{width:32px;height:32px;background:var(--accent);border-radius:8px;display:grid;place-items:center}
        .nav-logo span{color:var(--t1)}
        .nav-link{padding:8px 14px;border-radius:10px;color:var(--t2);text-decoration:none;font-size:.875rem;font-weight:500}
        .nav-link:hover{background:rgba(255,255,255,.08);color:var(--t1)}
        main{max-width:820px;margin:0 auto;padding:36px 24px}
        h1{font-size:1.75rem;font-weight:700;margin-bottom:8px}
        .sub{color:var(--t2);font-size:.9rem;margin-bottom:32px}
        .layout{display:grid;grid-template-columns:1fr 280px;gap:24px;align-items:start}
        .card{background:var(--card);border:1px solid var(--border);border-radius:16px;padding:28px}
        .card-title{font-size:1rem;font-weight:600;margin-bottom:20px}
        .form-group{margin-bottom:18px}
        label{display:block;font-size:.8rem;font-weight:500;color:var(--t2);margin-bottom:6px}
        input[type="text"]{width:100%;padding:12px 16px;background:rgba(255,255,255,.06);border:1px solid var(--border);border-radius:10px;color:var(--t1);font-family:'Outfit',sans-serif;font-size:.95rem;outline:none;transition:border-color .2s}
        input[type="text"]:focus{border-color:var(--accent)}
        .alert-error{background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.3);color:#ef4444;padding:12px 18px;border-radius:10px;font-size:.875rem;margin-bottom:20px}
        .btn-submit{width:100%;background:var(--accent);color:#0d0f14;padding:14px;border-radius:12px;font-weight:700;font-size:1rem;border:none;cursor:pointer;font-family:'Outfit',sans-serif;transition:opacity .2s;margin-top:8px}
        .btn-submit:hover{opacity:.85}
        .order-row{display:flex;justify-content:space-between;font-size:.85rem;color:var(--t2);margin-bottom:10px}
        .order-total{display:flex;justify-content:space-between;font-weight:700;font-size:1.05rem;padding-top:14px;margin-top:4px;border-top:1px solid var(--border)}
        .order-total span:last-child{color:var(--accent)}
        .order-title{font-size:1rem;font-weight:600;margin-bottom:16px}
    </style>
</head>
<body>
<nav>
    <a href="{{ route('home') }}" class="nav-logo"><div class="icon">☕</div><span>Order<b>nBrew</b></span></a>
    <a href="{{ route('cart.index') }}" class="nav-link">← Back to Cart</a>
</nav>
<main>
    <h1>Checkout</h1>
    <div class="sub">Almost there! Just fill in your details.</div>

    @if($errors->any())<div class="alert-error">❌ {{ $errors->first() }}</div>@endif

    <div class="layout">
        <div class="card">
            <div class="card-title">📋 Your Details</div>
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="customer_name">Your Name</label>
                    <input type="text" id="customer_name" name="customer_name" placeholder="e.g. John Doe" value="{{ old('customer_name') }}" required>
                </div>
                <div class="form-group">
                    <label for="table_number">Table Number</label>
                    <input type="text" id="table_number" name="table_number" placeholder="e.g. 5, A3, VIP-1" value="{{ old('table_number') }}" required>
                </div>
                <button type="submit" class="btn-submit" id="btn-place-order">Place Order →</button>
            </form>
        </div>

        <div class="card">
            <div class="order-title">🛒 Order Summary</div>
            @foreach($cart as $item)
            <div class="order-row"><span>{{ $item['name'] }} ×{{ $item['quantity'] }}</span><span>Rp {{ number_format($item['price']*$item['quantity'],0,',','.') }}</span></div>
            @endforeach
            <div class="order-total"><span>Total</span><span>Rp {{ number_format($total,0,',','.') }}</span></div>
        </div>
    </div>
</main>
</body>
</html>
