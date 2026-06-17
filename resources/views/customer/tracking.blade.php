<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Tracking — OrdernBrew</title>
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
            --accent-2-glow:rgba(16,185,129,0.35);
            --accent-3:#6366f1;
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
            max-width:700px;
            margin:0 auto;
            padding:60px 24px 80px;
            position: relative;
            z-index: 1;
        }
        h1{
            font-size:2rem;
            font-weight:800;
            margin-bottom:8px;
            text-align:center;
            letter-spacing:-0.02em;
        }
        .sub{color:var(--t2);font-size:.95rem;margin-bottom:36px;text-align:center}
        .search-form{
            background:var(--card);
            border:1px solid var(--border);
            border-radius:20px;
            padding:24px;
            margin-bottom:32px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .search-row{display:flex;gap:12px}
        input[type="text"]{
            flex:1;
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
        .btn-search{
            background:linear-gradient(135deg, var(--accent), #f97316);
            color:#07090e;
            padding:14px 28px;
            border-radius:12px;
            font-weight:700;
            font-size:.95rem;
            border:none;
            cursor:pointer;
            font-family:'Outfit',sans-serif;
            white-space:nowrap;
            box-shadow: 0 4px 12px var(--accent-glow);
            transition: all 0.2s ease;
        }
        .btn-search:hover{
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(245,158,11,0.45);
        }
        .result-card{
            background:var(--card);
            border:1px solid var(--border);
            border-radius:20px;
            overflow:hidden;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .result-head{padding:28px;border-bottom:1px solid var(--border)}
        .order-code{
            font-family:monospace;
            font-size:.85rem;
            color:var(--accent);
            background:rgba(245,158,11,.08);
            border: 1px solid rgba(245,158,11,0.15);
            padding:4px 12px;
            border-radius:8px;
            display:inline-block;
            margin-bottom:12px;
        }
        .info-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:16px}
        .info-cell{font-size:.85rem}
        .info-cell .label{color:var(--t2); font-weight: 500}
        .info-cell .val{font-weight:700;margin-top:4px;color:var(--t1)}
        /* Timeline */
        .timeline{padding:32px 28px}
        .step{display:flex;gap:20px;margin-bottom:28px}
        .step:last-child{margin-bottom:0}
        .step-dot-col{display:flex;flex-direction:column;align-items:center}
        .step-dot{
            width:36px;
            height:36px;
            border-radius:50%;
            display:grid;
            place-items:center;
            font-size:.95rem;
            flex-shrink:0;
            z-index:1;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }
        .step-dot.done{
            background:var(--accent-2);
            color:white;
            box-shadow: 0 0 15px var(--accent-2-glow);
        }
        .step-dot.active{
            background:var(--accent);
            color:#0d0f14;
            box-shadow: 0 0 15px var(--accent-glow);
            animation: pulse-active 1.5s infinite ease-in-out;
        }
        @keyframes pulse-active {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.06); }
        }
        .step-dot.pending{
            background:rgba(255,255,255,.03);
            border-color: var(--border);
            color:var(--t3);
        }
        .step-line{width:2px;flex:1;background:var(--border);margin-top:6px;min-height:30px}
        .step-line.done{background:var(--accent-2)}
        .step-info{flex:1;padding-top:6px}
        .step-name{font-weight:700;font-size:.95rem;margin-bottom:4px}
        .step-desc{font-size:.82rem;color:var(--t2)}
        /* Items */
        .items-section{padding:0 28px 28px}
        .items-title{
            font-size:.78rem;
            letter-spacing:.08em;
            text-transform:uppercase;
            color:var(--t3);
            font-weight:700;
            margin-bottom:16px;
            padding-top:20px;
            border-top:1px solid var(--border);
        }
        .item-row{display:flex;justify-content:space-between;font-size:.875rem;margin-bottom:10px;color:var(--t2)}
        .total-row{display:flex;justify-content:space-between;font-weight:800;font-size:1.1rem;padding-top:16px;border-top:1px solid var(--border)}
        .total-row span:last-child{color:var(--accent)}
        .not-found{text-align:center;padding:60px 20px;color:var(--t3)}
        .not-found .icon{font-size:3rem;margin-bottom:16px}
        .alert-success{
            background:rgba(16,185,129,.08);
            border:1px solid rgba(16,185,129,.2);
            color:var(--accent-2);
            padding:16px 20px;
            border-radius:12px;
            font-size:.9rem;
            margin-bottom:24px;
        }
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
                    value="{{ old('order_code', session('order_code', request('code'))) }}" id="input-order-code" required autocomplete="off">
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
