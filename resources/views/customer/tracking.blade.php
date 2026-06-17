<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Tracking — OrdernBrew</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{--bg:#0d0f14;--card:rgba(255,255,255,.05);--border:rgba(255,255,255,.08);--accent:#f59e0b;--accent-2:#10b981;--accent-3:#6366f1;--accent-4:#ef4444;--t1:#f1f5f9;--t2:#94a3b8;--t3:#475569}
        body{font-family:'Outfit',sans-serif;background:var(--bg);color:var(--t1);min-height:100vh}
        nav{position:sticky;top:0;z-index:99;background:rgba(13,15,20,.92);backdrop-filter:blur(16px);border-bottom:1px solid var(--border);padding:0 32px;display:flex;align-items:center;justify-content:space-between;height:64px}
        .nav-logo{display:flex;align-items:center;gap:10px;font-size:1.1rem;font-weight:700;color:var(--accent);text-decoration:none}
        .nav-logo .icon{width:32px;height:32px;background:var(--accent);border-radius:8px;display:grid;place-items:center}
        .nav-logo span{color:var(--t1)}
        .nav-link{padding:8px 14px;border-radius:10px;color:var(--t2);text-decoration:none;font-size:.875rem;font-weight:500}
        .nav-link:hover{background:rgba(255,255,255,.08);color:var(--t1)}
        main{max-width:680px;margin:0 auto;padding:60px 24px 40px}
        h1{font-size:1.75rem;font-weight:700;margin-bottom:8px;text-align:center}
        .sub{color:var(--t2);font-size:.9rem;margin-bottom:36px;text-align:center}
        .search-form{background:var(--card);border:1px solid var(--border);border-radius:16px;padding:24px;margin-bottom:32px}
        .search-row{display:flex;gap:12px}
        input[type="text"]{flex:1;padding:12px 16px;background:rgba(255,255,255,.06);border:1px solid var(--border);border-radius:10px;color:var(--t1);font-family:'Outfit',sans-serif;font-size:.95rem;outline:none;transition:border-color .2s}
        input[type="text"]:focus{border-color:var(--accent)}
        .btn-search{background:var(--accent);color:#0d0f14;padding:12px 24px;border-radius:10px;font-weight:700;font-size:.9rem;border:none;cursor:pointer;font-family:'Outfit',sans-serif;white-space:nowrap}
        .result-card{background:var(--card);border:1px solid var(--border);border-radius:16px;overflow:hidden}
        .result-head{padding:20px 24px;border-bottom:1px solid var(--border)}
        .order-code{font-family:monospace;font-size:.85rem;color:var(--accent);background:rgba(245,158,11,.1);padding:3px 10px;border-radius:8px;display:inline-block;margin-bottom:8px}
        .info-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-top:12px}
        .info-cell{font-size:.8rem}
        .info-cell .label{color:var(--t3)}
        .info-cell .val{font-weight:500;margin-top:2px}
        /* Timeline */
        .timeline{padding:24px}
        .step{display:flex;gap:16px;margin-bottom:24px}
        .step:last-child{margin-bottom:0}
        .step-dot-col{display:flex;flex-direction:column;align-items:center}
        .step-dot{width:32px;height:32px;border-radius:50%;display:grid;place-items:center;font-size:.85rem;flex-shrink:0;z-index:1}
        .step-dot.done{background:var(--accent-2);color:white}
        .step-dot.active{background:var(--accent);color:#0d0f14}
        .step-dot.pending{background:rgba(255,255,255,.08);color:var(--t3)}
        .step-line{width:2px;flex:1;background:var(--border);margin-top:4px;min-height:24px}
        .step-line.done{background:var(--accent-2)}
        .step-info{flex:1;padding-top:4px}
        .step-name{font-weight:600;font-size:.9rem;margin-bottom:2px}
        .step-desc{font-size:.78rem;color:var(--t2)}
        /* Items */
        .items-section{padding:0 24px 24px}
        .items-title{font-size:.75rem;letter-spacing:.08em;text-transform:uppercase;color:var(--t3);font-weight:600;margin-bottom:12px;padding-top:16px;border-top:1px solid var(--border)}
        .item-row{display:flex;justify-content:space-between;font-size:.85rem;margin-bottom:8px;color:var(--t2)}
        .total-row{display:flex;justify-content:space-between;font-weight:700;font-size:1rem;padding-top:12px;border-top:1px solid var(--border)}
        .total-row span:last-child{color:var(--accent)}
        .not-found{text-align:center;padding:40px;color:var(--t3)}
        .not-found .icon{font-size:2.5rem;margin-bottom:12px}
        .alert-success{background:rgba(16,185,129,.12);border:1px solid rgba(16,185,129,.3);color:var(--accent-2);padding:12px 18px;border-radius:10px;font-size:.875rem;margin-bottom:20px}
    </style>
</head>
<body>
<nav>
    <a href="{{ route('home') }}" class="nav-logo"><div class="icon">☕</div><span>Order<b>nBrew</b></span></a>
    <a href="{{ route('customer.menu') }}" class="nav-link">Browse Menu</a>
</nav>
<main>
    <h1>🔍 Track Your Order</h1>
    <div class="sub">Enter your order code to check the status.</div>

    @if(session('order_code'))
        <div class="alert-success">✅ Payment submitted! Your order code is <strong>{{ session('order_code') }}</strong> — track it below.</div>
    @endif

    <div class="search-form">
        <form action="{{ route('tracking.check') }}" method="POST">
            @csrf
            <div class="search-row">
                <input type="text" name="order_code" placeholder="e.g. ONB-20260617-001"
                    value="{{ old('order_code', session('order_code', request('code'))) }}" id="input-order-code" required>
                <button type="submit" class="btn-search" id="btn-track">Track</button>
            </div>
        </form>
    </div>

    @if(isset($order))
        @if(!$order)
            <div class="not-found"><div class="icon">❓</div><p>Order not found. Please check your code.</p></div>
        @else
        @php
            $statuses = ['waiting_payment','waiting','processing','ready','completed'];
            $labels   = ['Payment Pending','Queued','In Progress','Ready to Serve','Completed'];
            $descs    = ['Waiting for payment verification','Order received, queued for kitchen','Kitchen is preparing your order','Your order is ready! Grab it from the counter.','Order served. Enjoy!'];
            $icons    = ['💳','⏳','🔥','✅','🎉'];
            $cur      = array_search($order->order_status, $statuses);
        @endphp
        <div class="result-card">
            <div class="result-head">
                <span class="order-code">{{ $order->order_code }}</span>
                <div class="info-grid">
                    <div class="info-cell"><div class="label">Customer</div><div class="val">{{ $order->customer_name }}</div></div>
                    <div class="info-cell"><div class="label">Table</div><div class="val">{{ $order->table_number }}</div></div>
                    <div class="info-cell">
                        <div class="label">Payment</div>
                        <div class="val">
                            @if($order->payment_status==='paid') ✅ Paid
                            @elseif($order->payment_status==='pending') ⏳ Pending
                            @elseif($order->payment_status==='rejected') ❌ Rejected
                            @else 💳 Unpaid @endif
                        </div>
                    </div>
                    <div class="info-cell"><div class="label">Method</div><div class="val" style="text-transform:capitalize">{{ $order->payment->payment_method ?? '-' }}</div></div>
                </div>
            </div>

            <div class="timeline">
                @foreach($statuses as $i => $s)
                @php
                    $isDone   = $cur !== false && $i < $cur;
                    $isActive = $cur !== false && $i === $cur;
                @endphp
                <div class="step">
                    <div class="step-dot-col">
                        <div class="step-dot {{ $isDone ? 'done' : ($isActive ? 'active' : 'pending') }}">
                            {{ $isDone ? '✓' : $icons[$i] }}
                        </div>
                        @if($i < count($statuses)-1)
                            <div class="step-line {{ $isDone ? 'done' : '' }}"></div>
                        @endif
                    </div>
                    <div class="step-info">
                        <div class="step-name" style="{{ $isActive ? 'color:var(--accent)' : ($isDone ? 'color:var(--accent-2)' : 'color:var(--t3)') }}">{{ $labels[$i] }}</div>
                        <div class="step-desc">{{ $descs[$i] }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="items-section">
                <div class="items-title">Items</div>
                @foreach($order->orderDetails as $d)
                <div class="item-row"><span>{{ $d->menu->name ?? '-' }} ×{{ $d->quantity }}</span><span>Rp {{ number_format($d->subtotal,0,',','.') }}</span></div>
                @endforeach
                <div class="total-row"><span>Total</span><span>Rp {{ number_format($order->total_price,0,',','.') }}</span></div>
            </div>
        </div>
        @endif
    @endif
</main>
</body>
</html>
