<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Dashboard — OrdernBrew</title>
    <meta name="description" content="OrdernBrew cashier dashboard — review and approve incoming customer payments.">
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

        .nav-link.active {
            background: rgba(245,158,11,0.15);
            color: var(--accent);
        }

        .nav-link .nav-icon { font-size: 1.05rem; width: 20px; text-align: center; }

        /* ── Main ── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            padding: 32px 36px;
            max-width: calc(100vw - var(--sidebar-w));
        }

        /* ── Header ── */
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
        .stat-card:nth-child(3)::before { background: var(--accent-2); }
        .stat-card:nth-child(4)::before { background: var(--accent-4); }

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
        .stat-card:nth-child(3) .stat-icon { background: rgba(16,185,129,0.15);  color: var(--accent-2); }
        .stat-card:nth-child(4) .stat-icon { background: rgba(239,68,68,0.15);   color: var(--accent-4); }

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

        /* ── Table ── */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .section-header h2 { font-size: 1.1rem; font-weight: 600; }

        .badge {
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .badge-warning  { background: rgba(245,158,11,0.15); color: var(--accent);   }
        .badge-info     { background: rgba(99,102,241,0.15); color: var(--accent-3); }
        .badge-success  { background: rgba(16,185,129,0.15); color: var(--accent-2); }
        .badge-danger   { background: rgba(239,68,68,0.15);  color: var(--accent-4); }
        .badge-muted    { background: rgba(255,255,255,0.06); color: var(--text-2);  }

        .table-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            backdrop-filter: blur(12px);
            overflow: hidden;
        }

        table { width: 100%; border-collapse: collapse; }

        thead th {
            padding: 14px 20px;
            font-size: 0.72rem;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--text-3);
            font-weight: 600;
            text-align: left;
            border-bottom: 1px solid var(--border);
            background: rgba(255,255,255,0.02);
        }

        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .15s;
        }

        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: var(--bg-card-h); }

        tbody td {
            padding: 14px 20px;
            font-size: 0.875rem;
            color: var(--text-1);
            vertical-align: middle;
        }

        .order-code {
            font-family: monospace;
            font-size: 0.8rem;
            color: var(--accent);
            background: rgba(245,158,11,0.08);
            padding: 2px 8px;
            border-radius: 6px;
        }

        /* ── Action Buttons ── */
        .action-group { display: flex; gap: 8px; align-items: center; }

        .btn {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 0.775rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-family: 'Outfit', sans-serif;
            transition: opacity .2s, transform .15s;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .btn:hover { opacity: 0.85; transform: translateY(-1px); }
        .btn:active { transform: translateY(0); }

        .btn-approve {
            background: rgba(16,185,129,0.15);
            color: var(--accent-2);
            border: 1px solid rgba(16,185,129,0.25);
        }

        .btn-reject {
            background: rgba(239,68,68,0.12);
            color: var(--accent-4);
            border: 1px solid rgba(239,68,68,0.25);
        }

        .no-action { font-size: 0.8rem; color: var(--text-3); }

        /* ── Empty State ── */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-3);
        }

        .empty-state .icon { font-size: 2.5rem; margin-bottom: 12px; }
        .empty-state p { font-size: 0.9rem; }

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

    <div class="nav-label">Menu</div>
    <a href="{{ route('cashier.dashboard') }}" class="nav-link active" id="nav-dashboard">
        <span class="nav-icon">🧾</span> Cashier Dashboard
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
            <h1>Cashier Dashboard</h1>
            <p>Manage and verify incoming customer payment orders.</p>
        </div>
        <div class="header-date" id="live-date"></div>
    </div>

    @if(session('success'))
        <div class="alert alert-success" id="flash-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    @php
        $totalOrders   = $orders->count();
        $pendingOrders = $orders->where('payment_status', 'pending')->count();
        $paidOrders    = $orders->where('payment_status', 'paid')->count();
        $rejectedOrders= $orders->where('payment_status', 'rejected')->count();
    @endphp

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">📋</div>
            <div class="stat-label">Total Orders</div>
            <div class="stat-value">{{ $totalOrders }}</div>
            <div class="stat-sub">All orders</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">⏳</div>
            <div class="stat-label">Awaiting Verification</div>
            <div class="stat-value">{{ $pendingOrders }}</div>
            <div class="stat-sub">Needs confirmation</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">✅</div>
            <div class="stat-label">Paid Orders</div>
            <div class="stat-value">{{ $paidOrders }}</div>
            <div class="stat-sub">Already approved</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">❌</div>
            <div class="stat-label">Rejected</div>
            <div class="stat-value">{{ $rejectedOrders }}</div>
            <div class="stat-sub">Payment failed</div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="section-header">
        <h2>Orders & Payments</h2>
        <span class="badge badge-muted">{{ $totalOrders }} orders</span>
    </div>

    <div class="table-card">
        @if($orders->isEmpty())
            <div class="empty-state">
                <div class="icon">🛒</div>
                <p>No orders yet. Orders will appear here once customers start ordering.</p>
            </div>
        @else
        <table>
            <thead>
                <tr>
                    <th>Order Code</th>
                    <th>Customer</th>
                    <th>Table</th>
                    <th>Total</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td><span class="order-code">{{ $order->order_code }}</span></td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->table_number }}</td>
                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td style="color:var(--text-2)">{{ $order->payment->payment_method ?? '-' }}</td>

                    <td>
                        @php
                            $pMap = [
                                'paid'     => ['label' => 'Paid',     'class' => 'badge-success'],
                                'pending'  => ['label' => 'Pending',  'class' => 'badge-warning'],
                                'rejected' => ['label' => 'Rejected', 'class' => 'badge-danger'],
                                'unpaid'   => ['label' => 'Unpaid',   'class' => 'badge-muted'],
                            ];
                            $p = $pMap[$order->payment_status] ?? ['label' => $order->payment_status, 'class' => 'badge-muted'];
                        @endphp
                        <span class="badge {{ $p['class'] }}">{{ $p['label'] }}</span>
                    </td>

                    <td>
                        @php
                            $sMap = [
                                'waiting_payment' => ['label' => 'Waiting Payment', 'class' => 'badge-warning'],
                                'waiting'         => ['label' => 'Waiting',         'class' => 'badge-info'],
                                'processing'      => ['label' => 'Processing',      'class' => 'badge-info'],
                                'completed'       => ['label' => 'Completed',       'class' => 'badge-success'],
                                'cancelled'       => ['label' => 'Cancelled',       'class' => 'badge-danger'],
                            ];
                            $s = $sMap[$order->order_status] ?? ['label' => $order->order_status, 'class' => 'badge-muted'];
                        @endphp
                        <span class="badge {{ $s['class'] }}">{{ $s['label'] }}</span>
                    </td>

                    <td>
                        @if($order->payment_status === 'pending')
                            <div class="action-group">
                                <form action="{{ route('cashier.approve', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-approve" id="btn-approve-{{ $order->id }}">
                                        ✓ Approve
                                    </button>
                                </form>
                                <form action="{{ route('cashier.reject', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-reject" id="btn-reject-{{ $order->id }}">
                                        ✕ Reject
                                    </button>
                                </form>
                            </div>
                        @else
                            <span class="no-action">— No action</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</main>

<script>
    (function () {
        function updateDate() {
            const now = new Date();
            document.getElementById('live-date').textContent = now.toLocaleDateString('en-GB', {
                weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
            });
        }
        updateDate();
        setInterval(updateDate, 60000);

        // Auto-dismiss flash message
        const flash = document.getElementById('flash-success');
        if (flash) setTimeout(() => flash.style.display = 'none', 4000);
    })();
</script>
</body>
</html>