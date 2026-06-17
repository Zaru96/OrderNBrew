<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — OrdernBrew</title>
    <meta name="description" content="OrdernBrew admin dashboard — monitor orders, revenue, and menu items in real time.">
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

        .sidebar-logo span {
            color: var(--text-1);
        }

        .sidebar-logo .icon {
            width: 36px; height: 36px;
            background: var(--accent);
            border-radius: 10px;
            display: grid;
            place-items: center;
            font-size: 1.1rem;
        }

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

        .nav-link:hover, .nav-link.active {
            background: var(--bg-card-h);
            color: var(--text-1);
        }

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

        .header-title h1 {
            font-size: 1.75rem;
            font-weight: 700;
        }

        .header-title p {
            color: var(--text-2);
            font-size: 0.875rem;
            margin-top: 2px;
        }

        .header-date {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 8px 16px;
            font-size: 0.8rem;
            color: var(--text-2);
        }

        /* ── Stat Cards ── */
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

        .stat-card:nth-child(1)::before { background: var(--accent);   }
        .stat-card:nth-child(2)::before { background: var(--accent-3); }
        .stat-card:nth-child(3)::before { background: var(--accent-2); }
        .stat-card:nth-child(4)::before { background: var(--accent-4); }

        .stat-card:hover {
            transform: translateY(-4px);
            background: var(--bg-card-h);
        }

        .stat-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 1.3rem;
            margin-bottom: 16px;
        }

        .stat-card:nth-child(1) .stat-icon { background: rgba(245,158,11,0.15); color: var(--accent);   }
        .stat-card:nth-child(2) .stat-icon { background: rgba(99,102,241,0.15); color: var(--accent-3); }
        .stat-card:nth-child(3) .stat-icon { background: rgba(16,185,129,0.15); color: var(--accent-2); }
        .stat-card:nth-child(4) .stat-icon { background: rgba(239,68,68,0.15);  color: var(--accent-4); }

        .stat-label {
            font-size: 0.775rem;
            color: var(--text-2);
            font-weight: 500;
            letter-spacing: .04em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -.02em;
            line-height: 1;
        }

        .stat-sub {
            font-size: 0.775rem;
            color: var(--text-3);
            margin-top: 6px;
        }

        /* ── Orders Table ── */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .section-header h2 {
            font-size: 1.1rem;
            font-weight: 600;
        }

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

        table {
            width: 100%;
            border-collapse: collapse;
        }

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
        }

        .order-code {
            font-family: monospace;
            font-size: 0.8rem;
            color: var(--accent);
            background: rgba(245,158,11,0.08);
            padding: 2px 8px;
            border-radius: 6px;
        }

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

    <div class="nav-label">Navigation</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link active" id="nav-dashboard">
        <span class="nav-icon">📊</span> Dashboard
    </a>
    <a href="{{ route('admin.categories') }}" class="nav-link" id="nav-categories">
        <span class="nav-icon">🏷️</span> Categories
    </a>
    <a href="{{ route('admin.menus') }}" class="nav-link" id="nav-menus">
        <span class="nav-icon">🍽️</span> Menu Items
    </a>
    <a href="{{ route('admin.reports') }}" class="nav-link" id="nav-reports">
        <span class="nav-icon">📈</span> Reports
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
            <h1>Dashboard</h1>
            <p>Welcome back, Admin. Here's what's happening today.</p>
        </div>
        <div class="header-date" id="live-date"></div>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">📦</div>
            <div class="stat-label">Total Orders</div>
            <div class="stat-value">{{ $totalOrders }}</div>
            <div class="stat-sub">All time</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">⏳</div>
            <div class="stat-label">Pending Orders</div>
            <div class="stat-value">{{ $pendingOrders }}</div>
            <div class="stat-sub">Waiting / Processing</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">✅</div>
            <div class="stat-label">Completed</div>
            <div class="stat-value">{{ $completedOrders }}</div>
            <div class="stat-sub">Successfully served</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <div class="stat-label">Total Revenue</div>
            <div class="stat-value">{{ 'Rp ' . number_format($totalRevenue, 0, ',', '.') }}</div>
            <div class="stat-sub">From paid orders</div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="section-header">
        <h2>Recent Orders</h2>
        <span class="badge badge-muted">Last 10 orders</span>
    </div>

    <div class="table-card">
        @if($recentOrders->isEmpty())
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
                    <th>Order Status</th>
                    <th>Payment</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr>
                    <td><span class="order-code">{{ $order->order_code }}</span></td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->table_number }}</td>
                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td>
                        @php
                            $statusMap = [
                                'waiting_payment' => ['label' => 'Waiting Payment', 'class' => 'badge-warning'],
                                'processing'      => ['label' => 'Processing',      'class' => 'badge-info'],
                                'completed'       => ['label' => 'Completed',       'class' => 'badge-success'],
                                'cancelled'       => ['label' => 'Cancelled',       'class' => 'badge-danger'],
                            ];
                            $s = $statusMap[$order->order_status] ?? ['label' => $order->order_status, 'class' => 'badge-muted'];
                        @endphp
                        <span class="badge {{ $s['class'] }}">{{ $s['label'] }}</span>
                    </td>
                    <td>
                        @php
                            $pMap = [
                                'paid'    => ['label' => 'Paid',    'class' => 'badge-success'],
                                'unpaid'  => ['label' => 'Unpaid',  'class' => 'badge-warning'],
                                'pending' => ['label' => 'Pending', 'class' => 'badge-info'],
                            ];
                            $p = $pMap[$order->payment_status] ?? ['label' => $order->payment_status, 'class' => 'badge-muted'];
                        @endphp
                        <span class="badge {{ $p['class'] }}">{{ $p['label'] }}</span>
                    </td>
                    <td style="color:var(--text-2)">{{ $order->created_at->format('d M Y, H:i') }}</td>
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
    })();
</script>
</body>
</html>
