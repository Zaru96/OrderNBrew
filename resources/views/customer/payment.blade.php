<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment — OrdernBrew</title>
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
        .sub{color:var(--t2);font-size:.95rem;margin-bottom:20px}
        .order-code{
            font-family:monospace;
            font-size:.85rem;
            color:var(--accent);
            background:rgba(245,158,11,.08);
            border: 1px solid rgba(245,158,11,0.15);
            padding:6px 14px;
            border-radius:8px;
            display:inline-block;
            margin-bottom:32px;
        }
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
        /* Payment method cards */
        .methods{display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:24px}
        .method-label{cursor:pointer}
        .method-label input{display:none}
        .method-card{
            border: 1px solid var(--border);
            border-radius:14px;
            padding:18px 12px;
            text-align:center;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            font-weight:700;
            font-size:.9rem;
            color:var(--t2);
            background: rgba(255,255,255,0.01);
        }
        .method-card .icon{font-size:1.8rem;display:block;margin-bottom:8px}
        .method-label input:checked+.method-card{
            border-color:var(--accent);
            background:rgba(245,158,11,.06);
            color:var(--t1);
            box-shadow: 0 0 15px rgba(245,158,11,0.15);
            transform: translateY(-2px);
        }
        .form-group{margin-bottom:20px}
        label.field{
            display:block;
            font-size:.85rem;
            font-weight:600;
            color:var(--t2);
            margin-bottom:8px;
        }
        input[type="file"]{
            width:100%;
            padding:12px 16px;
            background:rgba(255,255,255,.04);
            border:1px solid var(--border);
            border-radius:12px;
            color:var(--t2);
            font-family:'Outfit',sans-serif;
            font-size:.85rem;
            outline: none;
            transition: all 0.2s ease;
        }
        input[type="file"]:focus{
            border-color: var(--accent);
        }
        .proof-hint{font-size:.78rem;color:var(--t3);margin-top:8px}
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
            margin-top:12px;
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
            font-size:1.15rem;
            padding-top:16px;
            border-top:1px solid var(--border);
        }
        .order-total span:last-child{color:var(--accent)}
        .info-row{display:flex;justify-content:space-between;margin-bottom:12px;font-size:.875rem}
        .info-row span:first-child{color:var(--t2)}
        #proof-wrap{display:none;margin-top:20px;padding: 16px; background: rgba(255,255,255,0.01); border: 1px solid var(--border); border-radius: 14px;}
        .alert-error{
            background:rgba(239,68,68,.08);
            border:1px solid rgba(239,68,68,.2);
            color:#ef4444;
            padding:14px 20px;
            border-radius:12px;
            font-size:.9rem;
            margin-bottom:24px;
        }
    </style>
</head>
<body>
<nav>
    <a href="{{ route('home') }}" class="nav-logo"><div class="icon">☕</div><span>Order<b>nBrew</b></span></a>
</nav>
<main>
    <h1>💳 Payment</h1>
    <div class="sub">Your order has been placed. Complete payment to get started.</div>
    <div class="order-code">Code: {{ $order->order_code }}</div>

    @if($errors->any())<div class="alert-error">❌ {{ $errors->first() }}</div>@endif

    <div class="layout">
        <div class="card">
            <div class="card-title">Select Payment Method</div>
            <form action="{{ route('payment.store',$order) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="methods">
                    <label class="method-label">
                        <input type="radio" name="payment_method" value="cash" checked onchange="toggleProof(this.value)">
                        <div class="method-card"><span class="icon">💵</span>Cash</div>
                    </label>
                    <label class="method-label">
                        <input type="radio" name="payment_method" value="qris" onchange="toggleProof(this.value)">
                        <div class="method-card"><span class="icon">📱</span>QRIS</div>
                    </label>
                    <label class="method-label">
                        <input type="radio" name="payment_method" value="transfer" onchange="toggleProof(this.value)">
                        <div class="method-card"><span class="icon">🏦</span>Transfer</div>
                    </label>
                </div>

                <div id="proof-wrap">
                    <label class="field">Upload Payment Proof</label>
                    <input type="file" name="payment_proof" accept="image/*">
                    <div class="proof-hint">📎 Accepted formats: JPG, PNG, WEBP (max 4MB)</div>
                </div>

                <button type="submit" class="btn-submit" id="btn-pay">Confirm Payment →</button>
            </form>
        </div>

        <div class="card">
            <div class="card-title">📋 Order Details</div>
            <div class="info-row"><span>Customer</span><span>{{ $order->customer_name }}</span></div>
            <div class="info-row"><span>Table</span><span>{{ $order->table_number }}</span></div>
            <div style="border-top:1px solid var(--border);padding-top:16px;margin-top:8px;margin-bottom:16px"></div>
            @foreach($order->orderDetails as $d)
            <div class="order-row">
                <span>{{ $d->menu->name ?? 'Item' }} ×{{ $d->quantity }}</span>
                <span>Rp {{ number_format($d->subtotal,0,',','.') }}</span>
            </div>
            @endforeach
            <div class="order-total"><span>Total</span><span>Rp {{ number_format($order->total_price,0,',','.') }}</span></div>
        </div>
    </div>
</main>
<script>
function toggleProof(val){
    document.getElementById('proof-wrap').style.display=(val==='qris'||val==='transfer')?'block':'none';
}
</script>
</body>
</html>
