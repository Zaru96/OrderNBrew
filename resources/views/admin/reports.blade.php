<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Reports — OrdernBrew Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{--bg-base:#0d0f14;--bg-card:rgba(255,255,255,0.05);--bg-card-h:rgba(255,255,255,0.09);--border:rgba(255,255,255,0.08);--accent:#f59e0b;--accent-2:#10b981;--accent-3:#6366f1;--accent-4:#ef4444;--text-1:#f1f5f9;--text-2:#94a3b8;--text-3:#475569;--radius:16px;--sw:240px}
        body{font-family:'Outfit',sans-serif;background:var(--bg-base);color:var(--text-1);min-height:100vh;display:flex}
        .sidebar{width:var(--sw);min-height:100vh;background:rgba(255,255,255,0.03);border-right:1px solid var(--border);display:flex;flex-direction:column;padding:28px 20px;position:fixed;top:0;left:0}
        .logo{display:flex;align-items:center;gap:10px;font-size:1.2rem;font-weight:700;color:var(--accent);margin-bottom:40px}
        .logo .icon{width:36px;height:36px;background:var(--accent);border-radius:10px;display:grid;place-items:center;font-size:1.1rem}
        .logo span{color:var(--text-1)}
        .nav-label{font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;color:var(--text-3);font-weight:600;margin-bottom:10px;padding-left:8px}
        .nav-link{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;color:var(--text-2);text-decoration:none;font-size:.9rem;font-weight:500;transition:background .2s,color .2s;margin-bottom:4px}
        .nav-link:hover{background:var(--bg-card-h);color:var(--text-1)}
        .nav-link.active{background:rgba(245,158,11,0.15);color:var(--accent)}
        .main{margin-left:var(--sw);flex:1;padding:32px 36px}
        .header{margin-bottom:32px}
        .header h1{font-size:1.75rem;font-weight:700}
        .header p{color:var(--text-2);font-size:.875rem;margin-top:2px}
        .stats{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:32px}
        .stat{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:24px;position:relative;overflow:hidden;transition:transform .25s}
        .stat:hover{transform:translateY(-4px);background:var(--bg-card-h)}
        .stat::before{content:'';position:absolute;top:-40px;right:-40px;width:100px;height:100px;border-radius:50%;opacity:.12}
        .stat:nth-child(1)::before{background:var(--accent)}
        .stat:nth-child(2)::before{background:var(--accent-2)}
        .stat:nth-child(3)::before{background:var(--accent-3)}
        .stat:nth-child(4)::before{background:var(--accent-4)}
        .stat-icon{width:44px;height:44px;border-radius:12px;display:grid;place-items:center;font-size:1.3rem;margin-bottom:16px}
        .stat:nth-child(1) .stat-icon{background:rgba(245,158,11,.15);color:var(--accent)}
        .stat:nth-child(2) .stat-icon{background:rgba(16,185,129,.15);color:var(--accent-2)}
        .stat:nth-child(3) .stat-icon{background:rgba(99,102,241,.15);color:var(--accent-3)}
        .stat:nth-child(4) .stat-icon{background:rgba(239,68,68,.15);color:var(--accent-4)}
        .stat-label{font-size:.775rem;color:var(--text-2);font-weight:500;letter-spacing:.04em;text-transform:uppercase;margin-bottom:6px}
        .stat-value{font-size:1.75rem;font-weight:700;letter-spacing:-.02em;line-height:1}
        .stat-sub{font-size:.775rem;color:var(--text-3);margin-top:6px}
        .row2{display:grid;grid-template-columns:320px 1fr;gap:20px;align-items:start}
        .card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden}
        .card-head{padding:16px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between}
        .card-head h2{font-size:1rem;font-weight:600}
        table{width:100%;border-collapse:collapse}
        thead th{padding:12px 16px;font-size:.72rem;letter-spacing:.08em;text-transform:uppercase;color:var(--text-3);font-weight:600;text-align:left;border-bottom:1px solid var(--border);background:rgba(255,255,255,.02)}
        tbody tr{border-bottom:1px solid var(--border);transition:background .15s}
        tbody tr:last-child{border-bottom:none}
        tbody tr:hover{background:var(--bg-card-h)}
        tbody td{padding:12px 16px;font-size:.85rem;vertical-align:middle}
        .badge{padding:3px 10px;border-radius:999px;font-size:.7rem;font-weight:600;text-transform:uppercase}
        .badge-success{background:rgba(16,185,129,.15);color:var(--accent-2)}
        .order-code{font-family:monospace;font-size:.8rem;color:var(--accent);background:rgba(245,158,11,.08);padding:2px 8px;border-radius:6px}
        .bar-wrap{height:8px;background:rgba(255,255,255,.06);border-radius:99px;margin-top:8px;overflow:hidden}
        .bar{height:100%;border-radius:99px;background:var(--accent)}
        .empty{text-align:center;padding:40px;color:var(--text-3);font-size:.875rem}
        ::-webkit-scrollbar{width:6px}
        ::-webkit-scrollbar-thumb{background:var(--border);border-radius:99px}
    </style>
</head>
<body>
<aside class="sidebar">
    <div class="logo"><div class="icon">☕</div><span>Order<b>nBrew</b></span></div>
    <div class="nav-label">Navigation</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link" id="nav-dash">📊 Dashboard</a>
    <a href="{{ route('admin.categories') }}" class="nav-link" id="nav-cat">🏷️ Categories</a>
    <a href="{{ route('admin.menus') }}" class="nav-link" id="nav-menu">🍽️ Menu Items</a>
    <a href="{{ route('admin.reports') }}" class="nav-link active" id="nav-rep">📈 Reports</a>
    <div style="flex:1"></div>
    <form method="POST" action="{{ route('logout') }}">@csrf
        <button type="submit" class="nav-link" style="width:100%;border:none;cursor:pointer;background:none" id="btn-logout">🚪 Logout</button>
    </form>
</aside>
<main class="main">
    <div class="header"><h1>Sales Reports</h1><p>Revenue, top menus, and transaction history.</p></div>

    <div class="stats">
        <div class="stat"><div class="stat-icon">💰</div><div class="stat-label">Total Revenue</div><div class="stat-value">Rp {{ number_format($totalRevenue,0,',','.') }}</div><div class="stat-sub">From paid orders</div></div>
        <div class="stat"><div class="stat-icon">✅</div><div class="stat-label">Today Revenue</div><div class="stat-value">Rp {{ number_format($todayRevenue,0,',','.') }}</div><div class="stat-sub">Today only</div></div>
        <div class="stat"><div class="stat-icon">📦</div><div class="stat-label">Total Orders</div><div class="stat-value">{{ $totalOrders }}</div><div class="stat-sub">Paid orders all time</div></div>
        <div class="stat"><div class="stat-icon">📅</div><div class="stat-label">Today Orders</div><div class="stat-value">{{ $todayOrders }}</div><div class="stat-sub">Today only</div></div>
    </div>

    <div class="row2">
        <!-- Top Menus -->
        <div class="card">
            <div class="card-head"><h2>🏆 Top Selling Items</h2></div>
            @if($topMenus->isEmpty())
                <div class="empty">No sales data yet.</div>
            @else
            @php $maxSold = $topMenus->max('total_sold') ?: 1; @endphp
            <div style="padding:20px">
                @foreach($topMenus as $i => $item)
                <div style="margin-bottom:16px">
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <div>
                            <span style="font-size:.75rem;color:var(--text-3);margin-right:6px">#{{ $i+1 }}</span>
                            <span style="font-weight:500;font-size:.875rem">{{ $item->menu->name ?? 'Unknown' }}</span>
                        </div>
                        <span style="font-size:.8rem;color:var(--accent);font-weight:600">{{ $item->total_sold }} sold</span>
                    </div>
                    <div class="bar-wrap"><div class="bar" style="width:{{ ($item->total_sold/$maxSold)*100 }}%"></div></div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Recent Transactions -->
        <div class="card">
            <div class="card-head"><h2>Recent Transactions</h2><span style="font-size:.8rem;color:var(--text-3)">Last 20 paid orders</span></div>
            @if($recentTransactions->isEmpty())
                <div class="empty">No transactions yet.</div>
            @else
            <table>
                <thead><tr><th>Order Code</th><th>Customer</th><th>Table</th><th>Total</th><th>Method</th><th>Date</th></tr></thead>
                <tbody>
                    @foreach($recentTransactions as $o)
                    <tr>
                        <td><span class="order-code">{{ $o->order_code }}</span></td>
                        <td>{{ $o->customer_name }}</td>
                        <td>{{ $o->table_number }}</td>
                        <td style="font-weight:600;color:var(--accent)">Rp {{ number_format($o->total_price,0,',','.') }}</td>
                        <td style="color:var(--text-2);text-transform:capitalize">{{ $o->payment->payment_method ?? '-' }}</td>
                        <td style="color:var(--text-3);font-size:.8rem">{{ $o->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</main>
</body>
</html>
