<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Items — OrdernBrew Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{--bg-base:#0d0f14;--bg-card:rgba(255,255,255,0.05);--bg-card-h:rgba(255,255,255,0.09);--border:rgba(255,255,255,0.08);--accent:#f59e0b;--accent-2:#10b981;--accent-4:#ef4444;--text-1:#f1f5f9;--text-2:#94a3b8;--text-3:#475569;--radius:16px;--sw:240px}
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
        .page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:36px}
        .page-header h1{font-size:1.75rem;font-weight:700}
        .page-header p{color:var(--text-2);font-size:.875rem;margin-top:2px}
        .layout{display:grid;grid-template-columns:1fr 380px;gap:28px;align-items:start}
        .card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden}
        .card-head{padding:16px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between}
        .card-head h2{font-size:1rem;font-weight:600}
        .card-body{padding:20px}
        .badge{padding:3px 10px;border-radius:999px;font-size:.7rem;font-weight:600;text-transform:uppercase}
        .badge-muted{background:rgba(255,255,255,.06);color:var(--text-2)}
        .badge-available{background:rgba(16,185,129,.15);color:var(--accent-2)}
        .badge-unavailable{background:rgba(239,68,68,.12);color:var(--accent-4)}
        table{width:100%;border-collapse:collapse}
        thead th{padding:12px 16px;font-size:.72rem;letter-spacing:.08em;text-transform:uppercase;color:var(--text-3);font-weight:600;text-align:left;border-bottom:1px solid var(--border);background:rgba(255,255,255,.02)}
        tbody tr{border-bottom:1px solid var(--border);transition:background .15s}
        tbody tr:last-child{border-bottom:none}
        tbody tr:hover{background:var(--bg-card-h)}
        tbody td{padding:12px 16px;font-size:.85rem;vertical-align:middle}
        .thumb{width:42px;height:42px;border-radius:8px;object-fit:cover}
        .thumb-ph{width:42px;height:42px;border-radius:8px;background:rgba(255,255,255,.06);display:grid;place-items:center;font-size:1.1rem}
        .empty{text-align:center;padding:48px 20px;color:var(--text-3);font-size:.875rem}
        .form-group{margin-bottom:14px}
        label{display:block;font-size:.8rem;font-weight:500;color:var(--text-2);margin-bottom:5px}
        input[type="text"],input[type="number"],textarea,select,input[type="file"]{width:100%;padding:10px 14px;background:rgba(255,255,255,.06);border:1px solid var(--border);border-radius:10px;color:var(--text-1);font-family:'Outfit',sans-serif;font-size:.9rem;outline:none;transition:border-color .2s}
        input:focus,textarea:focus,select:focus{border-color:var(--accent)}
        select option{background:#1a1c24}
        textarea{resize:vertical;min-height:70px}
        .btn{padding:10px 18px;border-radius:10px;font-size:.875rem;font-weight:600;border:none;cursor:pointer;font-family:'Outfit',sans-serif;transition:opacity .2s,transform .15s}
        .btn:hover{opacity:.85;transform:translateY(-1px)}
        .btn-primary{background:var(--accent);color:#0d0f14;width:100%}
        .btn-danger{background:rgba(239,68,68,.12);color:var(--accent-4);border:1px solid rgba(239,68,68,.25);padding:5px 10px;font-size:.72rem}
        .alert{padding:12px 18px;border-radius:10px;font-size:.875rem;margin-bottom:20px}
        .alert-success{background:rgba(16,185,129,.12);border:1px solid rgba(16,185,129,.3);color:var(--accent-2)}
        .alert-error{background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.3);color:var(--accent-4)}
        .alert-warn{background:rgba(245,158,11,.12);border:1px solid rgba(245,158,11,.3);color:var(--accent)}
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
    <a href="{{ route('admin.menus') }}" class="nav-link active" id="nav-menu">🍽️ Menu Items</a>
    <a href="{{ route('admin.reports') }}" class="nav-link" id="nav-rep">📈 Reports</a>
    <div style="flex:1"></div>
    <form method="POST" action="{{ route('logout') }}">@csrf
        <button type="submit" class="nav-link" style="width:100%;border:none;cursor:pointer;background:none" id="btn-logout">🚪 Logout</button>
    </form>
</aside>
<main class="main">
    <div class="page-header">
        <div><h1>Menu Items</h1><p>Manage cafe menu items with images and pricing.</p></div>
    </div>

    @if(session('success'))<div class="alert alert-success">✅ {{ session('success') }}</div>@endif
    @if($errors->any())<div class="alert alert-error">❌ {{ $errors->first() }}</div>@endif
    @if($categories->isEmpty())
        <div class="alert alert-warn">⚠️ No categories yet. <a href="{{ route('admin.categories') }}" style="color:var(--accent);text-decoration:underline">Add a category first.</a></div>
    @endif

    <div class="layout">
        <div class="card">
            <div class="card-head"><h2>All Menu Items</h2><span class="badge badge-muted">{{ $menus->count() }}</span></div>
            @if($menus->isEmpty())
                <div class="empty">🍽️ No menu items yet.</div>
            @else
            <table>
                <thead><tr><th>Photo</th><th>Name</th><th>Category</th><th>Price</th><th>Status</th><th>Action</th></tr></thead>
                <tbody>
                    @foreach($menus as $m)
                    <tr>
                        <td>@if($m->image)<img src="{{ Storage::url($m->image) }}" class="thumb" alt="">@else<div class="thumb-ph">🍴</div>@endif</td>
                        <td>
                            <div style="font-weight:500">{{ $m->name }}</div>
                            @if($m->description)<div style="font-size:.75rem;color:var(--text-3)">{{ Str::limit($m->description,40) }}</div>@endif
                        </td>
                        <td style="color:var(--text-2)">{{ $m->category->name ?? '-' }}</td>
                        <td style="font-weight:600;color:var(--accent)">Rp {{ number_format($m->price,0,',','.') }}</td>
                        <td><span class="badge badge-{{ $m->status }}">{{ ucfirst($m->status) }}</span></td>
                        <td>
                            <form action="{{ route('admin.destroyMenu',$m) }}" method="POST" onsubmit="return confirm('Delete?')" style="display:inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger" id="btn-del-{{ $m->id }}">🗑</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>

        <div class="card">
            <div class="card-head"><h2>➕ Add Menu Item</h2></div>
            <div class="card-body">
                <form action="{{ route('admin.storeMenu') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" required>
                            <option value="">Select...</option>
                            @foreach($categories as $c)<option value="{{ $c->id }}" {{ old('category_id')==$c->id?'selected':'' }}>{{ $c->name }}</option>@endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Item Name</label>
                        <input type="text" name="name" placeholder="e.g. Iced Americano" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" placeholder="Brief description...">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Price (Rp)</label>
                        <input type="number" name="price" placeholder="25000" min="0" value="{{ old('price') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" required>
                            <option value="available">✅ Available</option>
                            <option value="unavailable">❌ Unavailable</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Photo (optional)</label>
                        <input type="file" name="image" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn-add-menu">Add to Menu</button>
                </form>
            </div>
        </div>
    </div>
</main>
</body>
</html>
