<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice — OrdernBrew</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{--bg:#0d0f14;--card:rgba(255,255,255,.05);--border:rgba(255,255,255,.08);--accent:#f59e0b;--accent-2:#10b981;--accent-4:#ef4444;--t1:#f1f5f9;--t2:#94a3b8;--t3:#475569}
        body{font-family:'Outfit',sans-serif;background:var(--bg);color:var(--t1);min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:36px 20px}
        .invoice{background:var(--card);border:1px solid var(--border);border-radius:20px;padding:40px;max-width:480px;width:100%;backdrop-filter:blur(12px)}
        .inv-header{text-align:center;margin-bottom:32px}
        .inv-logo{display:flex;align-items:center;justify-content:center;gap:10px;font-size:1.1rem;font-weight:700;color:var(--accent);margin-bottom:8px}
        .inv-logo .icon{width:36px;height:36px;background:var(--accent);border-radius:10px;display:grid;place-items:center;font-size:1rem}
        .inv-logo span{color:var(--t1)}
        .inv-title{font-size:1.4rem;font-weight:700;margin-bottom:4px}
        .inv-code{font-family:monospace;font-size:.85rem;color:var(--accent);background:rgba(245,158,11,.1);padding:4px 12px;border-radius:8px;display:inline-block}
        .inv-section{border-top:1px solid var(--border);padding-top:20px;margin-top:20px}
        .inv-row{display:flex;justify-content:space-between;margin-bottom:10px;font-size:.875rem}
        .inv-row span:first-child{color:var(--t2)}
        .inv-row span:last-child{font-weight:500}
        .items-title{font-size:.8rem;letter-spacing:.08em;text-transform:uppercase;color:var(--t3);font-weight:600;margin-bottom:12px}
        .item-row{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;font-size:.875rem}
        .item-row .name{flex:1;color:var(--t2)}
        .item-row .qty{color:var(--t3);margin-left:8px;margin-right:8px;white-space:nowrap;font-size:.8rem}
        .item-row .sub{font-weight:600;white-space:nowrap}
        .total-row{display:flex;justify-content:space-between;font-weight:700;font-size:1.1rem;padding-top:16px;border-top:1px solid var(--border);margin-top:8px}
        .total-row span:last-child{color:var(--accent)}
        .status-badge{display:inline-flex;align-items:center;gap:6px;padding:4px 12px;border-radius:999px;font-size:.75rem;font-weight:600}
        .status-pending{background:rgba(99,102,241,.15);color:#6366f1}
        .status-paid{background:rgba(16,185,129,.15);color:var(--accent-2)}
        .status-unpaid{background:rgba(245,158,11,.15);color:var(--accent)}
        .inv-footer{text-align:center;margin-top:28px;padding-top:20px;border-top:1px solid var(--border)}
        .inv-footer p{font-size:.8rem;color:var(--t3);margin-bottom:16px}
        .btn-track{display:inline-block;background:var(--accent);color:#0d0f14;padding:12px 28px;border-radius:12px;font-weight:700;text-decoration:none;font-size:.9rem;margin-right:8px}
        .btn-menu{display:inline-block;background:rgba(255,255,255,.07);color:var(--t2);padding:12px 20px;border-radius:12px;font-weight:600;text-decoration:none;font-size:.9rem}
        @media print{
            body{background:white;color:#000}
            .invoice{background:white;border:1px solid #ddd;color:#000}
            .btn-track,.btn-menu{display:none}
        }
    </style>
</head>
<body>
<div class="invoice">
    <div class="inv-header">
        <div class="inv-logo"><div class="icon">☕</div><span>Order<b>nBrew</b></span></div>
        <div class="inv-title">Digital Receipt</div>
        <div style="margin-top:8px"><span class="inv-code">{{ $order->order_code }}</span></div>
    </div>

    <div class="inv-section">
        <div class="inv-row"><span>Customer</span><span>{{ $order->customer_name }}</span></div>
        <div class="inv-row"><span>Table</span><span>{{ $order->table_number }}</span></div>
        <div class="inv-row"><span>Date</span><span>{{ $order->created_at->format('d M Y, H:i') }}</span></div>
        <div class="inv-row">
            <span>Payment Status</span>
            <span>
                @php $ps = $order->payment_status; @endphp
                <span class="status-badge status-{{ $ps }}">
                    @if($ps==='paid') ✅ Paid
                    @elseif($ps==='pending') ⏳ Pending Verification
                    @else 💳 Unpaid @endif
                </span>
            </span>
        </div>
        @if($order->payment)
        <div class="inv-row"><span>Payment Method</span><span style="text-transform:capitalize">{{ $order->payment->payment_method }}</span></div>
        @endif
    </div>

    <div class="inv-section">
        <div class="items-title">Items Ordered</div>
        @foreach($order->orderDetails as $d)
        <div class="item-row">
            <span class="name">{{ $d->menu->name ?? 'Unknown' }}</span>
            <span class="qty">×{{ $d->quantity }}</span>
            <span class="sub">Rp {{ number_format($d->subtotal,0,',','.') }}</span>
        </div>
        @endforeach
        <div class="total-row"><span>Total</span><span>Rp {{ number_format($order->total_price,0,',','.') }}</span></div>
    </div>

    <div class="inv-footer">
        <p>Thank you for ordering at OrdernBrew! ☕</p>
        <a href="{{ route('tracking') }}?code={{ $order->order_code }}" class="btn-track" id="btn-track-inv">Track Order</a>
        <a href="{{ route('customer.menu') }}" class="btn-menu" id="btn-menu-inv">Order More</a>
    </div>
</div>
</body>
</html>
