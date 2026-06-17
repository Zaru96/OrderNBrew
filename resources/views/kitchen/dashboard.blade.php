<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitchen Dashboard — OrdernBrew</title>
    <meta name="description" content="OrdernBrew kitchen dashboard — view and process incoming orders in real time.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg-base:   #0d0f14;
            --bg-card:   rgba(255,255,255,0.05);
            --bg-card-h: rgba(255,255,255,0.09);
            --border:    rgba(255,255,255,0.08);
            --accent:    #f59e0b;
            --accent-2:  #10b981;
            --accent-3:  #6366f1;
            --accent-4:  #ef4444;
            --accent-5:  #f97316;
            --text-1:    #f1f5f9;
            --text-2:    #94a3b8;
            --text-3:    #475569;
            --radius:    16px;
            --sidebar-w: 240px;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-base);
            color: var(--text-1);
            min-height: 100vh;
            display: flex;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: rgba(255,255,255,0.03);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            padding: 28px 20px;
            position: fixed;
            top: 0; left: 0;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--accent);
            margin-bottom: 40px;
        }

        .sidebar-logo .icon {
            width: 36px; height: 36px;
            background: var(--accent);
            border-radius: 10px;
            display: grid;
            place-items: center;
            font-size: 1.1rem;
        }

        .sidebar-logo span { color: var(--text-1); }

        .nav-label {
            font-size: 0.65rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--text-3);
            font-weight: 600;
            margin-bottom: 10px;
            padding-left: 8px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            color: var(--text-2);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: background .2s, color .2s;
            margin-bottom: 4px;
        }

        .nav-link:hover { background: var(--bg-card-h); color: var(--text-1); }
        .nav-link.active { background: rgba(245,158,11,0.15); color: var(--accent); }
        .nav-link .nav-icon { font-size: 1.05rem; width: 20px; text-align: center; }

        /* ── Live clock ── */
        .live-clock {
            background: rgba(245,158,11,0.08);
            border: 1px solid rgba(245,158,11,0.2);
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 24px;
            text-align: center;
        }

        .live-clock .time {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent);
            letter-spacing: .04em;
            font-variant-numeric: tabular-nums;
        }

        .live-clock .date-label {
            font-size: 0.7rem;
            color: var(--text-3);
            margin-top: 2px;
        }

        /* ── Main ── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            padding: 32px 36px;
            max-width: calc(100vw - var(--sidebar-w));
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 36px;
        }

        .header-title h1 { font-size: 1.75rem; font-weight: 700; }
        .header-title p  { color: var(--text-2); font-size: 0.875rem; margin-top: 2px; }

        .header-date {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 8px 16px;
            font-size: 0.8rem;
            color: var(--text-2);
        }

        /* ── Stats ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 36px;
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            backdrop-filter: blur(12px);
            transition: transform .25s, background .25s;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 100px; height: 100px;
            border-radius: 50%;
            opacity: 0.12;
        }

        .stat-card:nth-child(1)::before { background: var(--accent-3); }
        .stat-card:nth-child(2)::before { background: var(--accent);   }
        .stat-card:nth-child(3)::before { background: var(--accent-5); }
        .stat-card:nth-child(4)::before { background: var(--accent-2); }

        .stat-card:hover { transform: translateY(-4px); background: var(--bg-card-h); }

        .stat-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 1.3rem;
            margin-bottom: 16px;
        }

        .stat-card:nth-child(1) .stat-icon { background: rgba(99,102,241,0.15);  color: var(--accent-3); }
        .stat-card:nth-child(2) .stat-icon { background: rgba(245,158,11,0.15);  color: var(--accent);   }
        .stat-card:nth-child(3) .stat-icon { background: rgba(249,115,22,0.15);  color: var(--accent-5); }
        .stat-card:nth-child(4) .stat-icon { background: rgba(16,185,129,0.15);  color: var(--accent-2); }

        .stat-label {
            font-size: 0.775rem;
            color: var(--text-2);
            font-weight: 500;
            letter-spacing: .04em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .stat-value { font-size: 2rem; font-weight: 700; letter-spacing: -.02em; line-height: 1; }
        .stat-sub   { font-size: 0.775rem; color: var(--text-3); margin-top: 6px; }

        /* ── Alert ── */
        .alert {
            padding: 12px 18px;
            border-radius: 10px;
            font-size: 0.875rem;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: rgba(16,185,129,0.12);
            border: 1px solid rgba(16,185,129,0.3);
            color: var(--accent-2);
        }

        /* ── Section header ── */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .section-header h2 { font-size: 1.1rem; font-weight: 600; }

        /* ── Badge ── */
        .badge {
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .badge-waiting    { background: rgba(245,158,11,0.15);  color: var(--accent);   }
        .badge-processing { background: rgba(249,115,22,0.15);  color: var(--accent-5); }
        .badge-success    { background: rgba(16,185,129,0.15);  color: var(--accent-2); }
        .badge-muted      { background: rgba(255,255,255,0.06); color: var(--text-2);   }

        /* ── Order cards grid ── */
        .orders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }

        .order-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            backdrop-filter: blur(12px);
            overflow: hidden;
            transition: transform .25s, border-color .25s;
            display: flex;
            flex-direction: column;
        }

        .order-card:hover {
            transform: translateY(-3px);
            border-color: rgba(255,255,255,0.14);
        }

        .order-card.status-processing {
            border-color: rgba(249,115,22,0.35);
        }

        .order-card.status-waiting {
            border-color: rgba(245,158,11,0.25);
        }

        /* Card header */
        .card-head {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .card-head-left { display: flex; flex-direction: column; gap: 4px; }

        .order-code {
            font-family: monospace;
            font-size: 0.82rem;
            color: var(--accent);
            background: rgba(245,158,11,0.08);
            padding: 2px 8px;
            border-radius: 6px;
            display: inline-block;
        }

        .card-meta {
            font-size: 0.8rem;
            color: var(--text-2);
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 2px;
        }

        .card-meta .sep { color: var(--text-3); }

        /* Card body — item list */
        .card-body {
            padding: 16px 20px;
            flex: 1;
        }

        .item-list { display: flex; flex-direction: column; gap: 10px; }

        .item-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .item-qty {
            min-width: 28px; height: 28px;
            background: rgba(255,255,255,0.07);
            border-radius: 8px;
            display: grid;
            place-items: center;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-1);
            flex-shrink: 0;
        }

        .item-info { flex: 1; }

        .item-name {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-1);
        }

        .item-note {
            font-size: 0.75rem;
            color: var(--accent-5);
            margin-top: 2px;
            font-style: italic;
        }

        /* Wait timer */
        .wait-timer {
            font-size: 0.72rem;
            color: var(--text-3);
            display: flex;
            align-items: center;
            gap: 4px;
            margin-top: 4px;
        }

        /* Card footer — actions */
        .card-footer {
            padding: 14px 20px;
            border-top: 1px solid var(--border);
            display: flex;
            gap: 10px;
        }

        .btn {
            flex: 1;
            padding: 9px 14px;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-family: 'Outfit', sans-serif;
            transition: opacity .2s, transform .15s;
            text-align: center;
            letter-spacing: .03em;
        }

        .btn:hover  { opacity: 0.85; transform: translateY(-1px); }
        .btn:active { transform: translateY(0); }

        .btn-process {
            background: rgba(249,115,22,0.15);
            color: var(--accent-5);
            border: 1px solid rgba(249,115,22,0.3);
        }

        .btn-complete {
            background: rgba(16,185,129,0.15);
            color: var(--accent-2);
            border: 1px solid rgba(16,185,129,0.3);
        }

        /* ── Empty state ── */
        .empty-state {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            text-align: center;
            padding: 80px 20px;
            color: var(--text-3);
        }

        .empty-state .icon { font-size: 3rem; margin-bottom: 14px; }
        .empty-state h3 { font-size: 1.1rem; color: var(--text-2); margin-bottom: 8px; }
        .empty-state p  { font-size: 0.875rem; }

        /* ── Pulse dot for processing ── */
        .pulse-dot {
            display: inline-block;
            width: 8px; height: 8px;
            border-radius: 50%;
            background: var(--accent-5);
            animation: pulse 1.4s ease-in-out infinite;
            margin-right: 4px;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.7); }
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 99px; }
    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="icon">☕</div>
        <span>Order<b>nBrew</b></span>
    </div>

    <!-- Live clock in sidebar -->
    <div class="live-clock">
        <div class="time" id="live-time">00:00:00</div>
        <div class="date-label" id="live-date-short"></div>
    </div>

    <div class="nav-label">Menu</div>
    <a href="{{ route('kitchen.dashboard') }}" class="nav-link active" id="nav-kitchen">
        <span class="nav-icon">👨‍🍳</span> Kitchen Dashboard
    </a>
    <a href="{{ route('tracking') }}" class="nav-link" id="nav-tracking">
        <span class="nav-icon">🔍</span> Order Tracking
    </a>

    <div style="flex:1"></div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav-link" style="width:100%;border:none;cursor:pointer;background:none;" id="btn-logout">
            <span class="nav-icon">🚪</span> Logout
        </button>
    </form>
</aside>

<!-- Main Content -->
<main class="main">
    <div class="header">
        <div class="header-title">
            <h1>Kitchen Dashboard</h1>
            <p>View and process orders confirmed by the cashier.</p>
        </div>
        <div class="header-date" id="live-date"></div>
    </div>

    @if(session('success'))
        <div class="alert alert-success" id="flash-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">📋</div>
            <div class="stat-label">Total Queue</div>
            <div class="stat-value">{{ $totalQueue }}</div>
            <div class="stat-sub">Waiting & processing</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">⏳</div>
            <div class="stat-label">Waiting</div>
            <div class="stat-value">{{ $waitingCount }}</div>
            <div class="stat-sub">Not yet processed</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">🔥</div>
            <div class="stat-label">In Progress</div>
            <div class="stat-value">{{ $processingCount }}</div>
            <div class="stat-sub">Currently being made</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">✅</div>
            <div class="stat-label">Done Today</div>
            <div class="stat-value">{{ $completedToday }}</div>
            <div class="stat-sub">Successfully served</div>
        </div>
    </div>

    <!-- Orders -->
    <div class="section-header">
        <h2>Order Queue</h2>
        @if($totalQueue > 0)
            <span class="badge badge-waiting">{{ $totalQueue }} active orders</span>
        @else
            <span class="badge badge-muted">No orders in queue</span>
        @endif
    </div>

    @if($orders->isEmpty())
        <div class="empty-state">
            <div class="icon">🍽️</div>
            <h3>Kitchen is Ready!</h3>
            <p>No orders to process. New orders will appear here once the cashier approves a payment.</p>
        </div>
    @else
        <div class="orders-grid">
            @foreach($orders as $order)
            @php
                $isWaiting    = $order->order_status === 'waiting';
                $isProcessing = $order->order_status === 'processing';
                $isReady      = $order->order_status === 'ready';
                $waitMinutes  = $order->updated_at->diffInMinutes(now());
            @endphp
            <div class="order-card {{ $isReady ? 'status-processing' : ($isProcessing ? 'status-processing' : 'status-waiting') }}">

                <!-- Card Header -->
                <div class="card-head">
                    <div class="card-head-left">
                        <span class="order-code">{{ $order->order_code }}</span>
                        <div class="card-meta">
                            <span>🪑 Table {{ $order->table_number }}</span>
                            <span class="sep">·</span>
                            <span>👤 {{ $order->customer_name }}</span>
                        </div>
                    </div>
                    @if($isReady)
                        <span class="badge badge-processing" style="background:rgba(16,185,129,.2);color:#10b981">
                            ✅ Ready to Serve
                        </span>
                    @elseif($isProcessing)
                        <span class="badge badge-processing">
                            <span class="pulse-dot"></span>Processing
                        </span>
                    @else
                        <span class="badge badge-waiting">⏳ Queued</span>
                    @endif
                </div>

                <!-- Item List -->
                <div class="card-body">
                    <div class="item-list">
                        @forelse($order->orderDetails as $detail)
                        <div class="item-row">
                            <div class="item-qty">{{ $detail->quantity }}x</div>
                            <div class="item-info">
                                <div class="item-name">{{ $detail->menu->name ?? 'Item not found' }}</div>
                                @if($detail->note)
                                    <div class="item-note">📝 {{ $detail->note }}</div>
                                @endif
                            </div>
                        </div>
                        @empty
                            <p style="font-size:0.8rem;color:var(--text-3)">No item details available.</p>
                        @endforelse
                    </div>

                    <div class="wait-timer" style="margin-top:14px">
                        🕐 Placed {{ $waitMinutes }} min ago &nbsp;·&nbsp;
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </div>
                </div>

                <!-- Actions -->
                <div class="card-footer">
                    @if($isWaiting)
                        <form action="{{ route('kitchen.process', $order->id) }}" method="POST" style="flex:1">
                            @csrf
                            <button type="submit" class="btn btn-process" id="btn-process-{{ $order->id }}" style="width:100%">
                                🔥 Start Cooking
                            </button>
                        </form>
                    @elseif($isProcessing)
                        <form action="{{ route('kitchen.ready', $order->id) }}" method="POST" style="flex:1">
                            @csrf
                            <button type="submit" class="btn btn-complete" style="width:100%;background:rgba(99,102,241,.2);color:#818cf8;border:1px solid rgba(99,102,241,.3)" id="btn-ready-{{ $order->id }}">
                                🔔 Mark Ready
                            </button>
                        </form>
                    @elseif($isReady)
                        <form action="{{ route('kitchen.complete', $order->id) }}" method="POST" style="flex:1">
                            @csrf
                            <button type="submit" class="btn btn-complete" id="btn-complete-{{ $order->id }}" style="width:100%">
                                ✅ Done
                            </button>
                        </form>
                    @endif
                </div>

            </div>
            @endforeach
        </div>
    @endif
</main>

<script>
    (function () {
        function pad(n) { return String(n).padStart(2, '0'); }

        function tick() {
            const now = new Date();
            const timeEl = document.getElementById('live-time');
            const dateEl = document.getElementById('live-date');
            const shortEl = document.getElementById('live-date-short');

            if (timeEl) {
                timeEl.textContent = pad(now.getHours()) + ':' + pad(now.getMinutes()) + ':' + pad(now.getSeconds());
            }

            const full = now.toLocaleDateString('en-GB', {
                weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
            });
            const short = now.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });

            if (dateEl)  dateEl.textContent  = full;
            if (shortEl) shortEl.textContent = short;
        }

        tick();
        setInterval(tick, 1000);

        // Auto-dismiss flash
        const flash = document.getElementById('flash-success');
        if (flash) setTimeout(() => flash.style.display = 'none', 4000);

        // Auto-refresh every 30 seconds so new orders appear without manual reload
        setTimeout(() => location.reload(), 30000);
    })();
</script>
</body>
</html>
