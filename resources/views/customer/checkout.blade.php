<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout — OrdernBrew</title>
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
            max-width:900px;
            margin:0 auto;
            padding:40px 24px 80px;
            position: relative;
            z-index: 1;
        }
        h1{
            font-size:2rem;
            font-weight:800;
            margin-bottom:6px;
            letter-spacing:-0.02em;
        }
        .sub{color:var(--t2);font-size:.95rem;margin-bottom:36px}
        .layout{display:grid;grid-template-columns:1fr 320px;gap:28px;align-items:start}
        .card{
            background:var(--card);
            border:1px solid var(--border);
            border-radius:20px;
            padding:32px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .card-title{
            font-size:1.1rem;
            font-weight:700;
            margin-bottom:24px;
            border-bottom: 1px solid var(--border);
            padding-bottom:12px;
        }
        .form-group{margin-bottom:20px}
        label{
            display:block;
            font-size:.85rem;
            font-weight:600;
            color:var(--t2);
            margin-bottom:8px;
        }
        input[type="text"]{
            width:100%;
            padding:14px 18px;
            background:rgba(255,255,255,.04);
            border:1px solid var(--border);
            border-radius:12px;
            color:var(--t1);
            font-family:'Outfit',sans-serif;
            font-size:.95rem;
            outline:none;
            transition: all 0.2s ease;
        }
        input[type="text"]:focus{
            border-color:var(--accent);
            background: rgba(255,255,255,0.06);
            box-shadow: 0 0 12px rgba(245,158,11,0.15);
        }
        .alert-error{
            background:rgba(239,68,68,.08);
            border:1px solid rgba(239,68,68,.2);
            color:#ef4444;
            padding:14px 20px;
            border-radius:12px;
            font-size:.9rem;
            margin-bottom:24px;
        }
        .btn-submit{
            width:100%;
            background:linear-gradient(135deg, var(--accent), #f97316);
            color:#07090e;
            padding:16px;
            border-radius:14px;
            font-weight:700;
            font-size:1rem;
            border:none;
            cursor:pointer;
            font-family:'Outfit',sans-serif;
            box-shadow: 0 4px 15px var(--accent-glow);
            transition: all 0.25s ease;
            margin-top:10px;
        }
        .btn-submit:hover{
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245,158,11,0.5);
        }
        .order-row{display:flex;justify-content:space-between;font-size:.85rem;color:var(--t2);margin-bottom:12px}
        .order-total{
            display:flex;
            justify-content:space-between;
            font-weight:800;
            font-size:1.1rem;
            padding-top:16px;
            margin-top:8px;
            border-top:1px solid var(--border);
        }
        .order-total span:last-child{color:var(--accent)}
        .order-title{
            font-size:1.1rem;
            font-weight:700;
            margin-bottom:24px;
            border-bottom: 1px solid var(--border);
            padding-bottom:12px;
        }
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
                    <input type="text" id="customer_name" name="customer_name" placeholder="e.g. John Doe" value="{{ old('customer_name') }}" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="table_number">Table Number</label>
                    <input type="text" id="table_number" name="table_number" placeholder="e.g. 5, A3, VIP-1" value="{{ old('table_number') }}" required autocomplete="off">
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
