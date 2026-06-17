<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment — OrdernBrew</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{--bg:#0d0f14;--card:rgba(255,255,255,.05);--border:rgba(255,255,255,.08);--accent:#f59e0b;--accent-2:#10b981;--accent-3:#6366f1;--t1:#f1f5f9;--t2:#94a3b8;--t3:#475569}
        body{font-family:'Outfit',sans-serif;background:var(--bg);color:var(--t1);min-height:100vh}
        nav{position:sticky;top:0;z-index:99;background:rgba(13,15,20,.92);backdrop-filter:blur(16px);border-bottom:1px solid var(--border);padding:0 32px;display:flex;align-items:center;justify-content:space-between;height:64px}
        .nav-logo{display:flex;align-items:center;gap:10px;font-size:1.1rem;font-weight:700;color:var(--accent);text-decoration:none}
        .nav-logo .icon{width:32px;height:32px;background:var(--accent);border-radius:8px;display:grid;place-items:center}
        .nav-logo span{color:var(--t1)}
        main{max-width:820px;margin:0 auto;padding:36px 24px}
        h1{font-size:1.75rem;font-weight:700;margin-bottom:8px}
        .sub{color:var(--t2);font-size:.9rem;margin-bottom:32px}
        .order-code{font-family:monospace;font-size:.85rem;color:var(--accent);background:rgba(245,158,11,.1);padding:4px 12px;border-radius:8px;display:inline-block;margin-bottom:28px}
        .layout{display:grid;grid-template-columns:1fr 300px;gap:24px;align-items:start}
        .card{background:var(--card);border:1px solid var(--border);border-radius:16px;padding:24px}
        .card-title{font-size:1rem;font-weight:600;margin-bottom:20px}
        /* Payment method cards */
        .methods{display:grid;grid-template-columns:1fr 1fr 1fr;gap:10px;margin-bottom:20px}
        .method-label{cursor:pointer}
        .method-label input{display:none}
        .method-card{border:2px solid var(--border);border-radius:12px;padding:14px 10px;text-align:center;transition:all .2s;font-weight:600;font-size:.85rem;color:var(--t2)}
        .method-card .icon{font-size:1.5rem;display:block;margin-bottom:6px}
        .method-label input:checked+.method-card{border-color:var(--accent);background:rgba(245,158,11,.1);color:var(--accent)}
        .form-group{margin-bottom:16px}
        label.field{display:block;font-size:.8rem;font-weight:500;color:var(--t2);margin-bottom:6px}
        input[type="file"]{width:100%;padding:10px;background:rgba(255,255,255,.06);border:1px solid var(--border);border-radius:10px;color:var(--t2);font-family:'Outfit',sans-serif;font-size:.85rem}
        .proof-hint{font-size:.75rem;color:var(--t3);margin-top:6px}
        .btn-submit{width:100%;background:var(--accent);color:#0d0f14;padding:14px;border-radius:12px;font-weight:700;font-size:1rem;border:none;cursor:pointer;font-family:'Outfit',sans-serif;transition:opacity .2s;margin-top:8px}
        .btn-submit:hover{opacity:.85}
        .order-row{display:flex;justify-content:space-between;font-size:.85rem;color:var(--t2);margin-bottom:10px}
        .order-total{display:flex;justify-content:space-between;font-weight:700;font-size:1.05rem;padding-top:12px;border-top:1px solid var(--border)}
        .order-total span:last-child{color:var(--accent)}
        .info-row{display:flex;justify-content:space-between;margin-bottom:10px;font-size:.85rem}
        .info-row span:first-child{color:var(--t2)}
        #proof-wrap{display:none;margin-top:14px}
        .alert-error{background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.3);color:#ef4444;padding:12px 18px;border-radius:10px;font-size:.875rem;margin-bottom:20px}
    </style>
</head>
<body>
<nav>
    <a href="{{ route('home') }}" class="nav-logo"><div class="icon">☕</div><span>Order<b>nBrew</b></span></a>
</nav>
<main>
    <h1>💳 Payment</h1>
    <div class="sub">Your order has been placed. Complete payment to get started.</div>
    <div class="order-code">{{ $order->order_code }}</div>

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
                    <div class="proof-hint">📎 Accepted: JPG, PNG, WEBP (max 4MB)</div>
                </div>

                <button type="submit" class="btn-submit" id="btn-pay">Confirm Payment →</button>
            </form>
        </div>

        <div class="card">
            <div class="card-title">📋 Order Details</div>
            <div class="info-row"><span>Customer</span><span>{{ $order->customer_name }}</span></div>
            <div class="info-row"><span>Table</span><span>{{ $order->table_number }}</span></div>
            <div style="border-top:1px solid var(--border);padding-top:14px;margin-top:4px;margin-bottom:14px"></div>
            @foreach($order->orderDetails as $d)
            <div class="order-row">
                <span>{{ $d->menu->name ?? '-' }} ×{{ $d->quantity }}</span>
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
