<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories — OrdernBrew Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg-base:#0d0f14; --bg-card:rgba(255,255,255,0.05); --bg-card-h:rgba(255,255,255,0.09);
            --border:rgba(255,255,255,0.08); --accent:#f59e0b; --accent-2:#10b981;
            --accent-3:#6366f1; --accent-4:#ef4444; --text-1:#f1f5f9; --text-2:#94a3b8;
            --text-3:#475569; --radius:16px; --sidebar-w:240px;
        }
        body { font-family:'Outfit',sans-serif; background:var(--bg-base); color:var(--text-1); min-height:100vh; display:flex; }
        .sidebar { width:var(--sidebar-w); min-height:100vh; background:rgba(255,255,255,0.03); border-right:1px solid var(--border); display:flex; flex-direction:column; padding:28px 20px; position:fixed; top:0; left:0; }
        .sidebar-logo { display:flex; align-items:center; gap:10px; font-size:1.25rem; font-weight:700; color:var(--accent); margin-bottom:40px; }
        .sidebar-logo .icon { width:36px;height:36px; background:var(--accent); border-radius:10px; display:grid; place-items:center; font-size:1.1rem; }
        .sidebar-logo span { color:var(--text-1); }
        .nav-label { font-size:0.65rem; letter-spacing:.12em; text-transform:uppercase; color:var(--text-3); font-weight:600; margin-bottom:10px; padding-left:8px; }
        .nav-link { display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:10px; color:var(--text-2); text-decoration:none; font-size:0.9rem; font-weight:500; transition:background .2s,color .2s; margin-bottom:4px; }
        .nav-link:hover { background:var(--bg-card-h); color:var(--text-1); }
        .nav-link.active { background:rgba(245,158,11,0.15); color:var(--accent); }
        .nav-link .nav-icon { font-size:1.05rem; width:20px; text-align:center; }
        .main { margin-left:var(--sidebar-w); flex:1; padding:32px 36px; max-width:calc(100vw - var(--sidebar-w)); }
        .header { display:flex; align-items:center; justify-content:space-between; margin-bottom:36px; }
        .header-title h1 { font-size:1.75rem; font-weight:700; }
        .header-title p { color:var(--text-2); font-size:0.875rem; margin-top:2px; }
        .grid-2 { display:grid; grid-template-columns:1fr 340px; gap:28px; align-items:start; }
        .card { background:var(--bg-card); border:1px solid var(--border); border-radius:var(--radius); backdrop-filter:blur(12px); overflow:hidden; }
        .card-header { padding:18px 24px; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
        .card-header h2 { font-size:1rem; font-weight:600; }
        .badge { padding:3px 10px; border-radius:999px; font-size:0.7rem; font-weight:600; text-transform:uppercase; }
        .badge-muted { background:rgba(255,255,255,0.06); color:var(--text-2); }
        table { width:100%; border-collapse:collapse; }
        thead th { padding:12px 20px; font-size:0.72rem; letter-spacing:.08em; text-transform:uppercase; color:var(--text-3); font-weight:600; text-align:left; border-bottom:1px solid var(--border); background:rgba(255,255,255,0.02); }
        tbody tr { border-bottom:1px solid var(--border); transition:background .15s; }
        tbody tr:last-child { border-bottom:none; }
        tbody tr:hover { background:var(--bg-card-h); }
        tbody td { padding:14px 20px; font-size:0.875rem; vertical-align:middle; }
        .empty-state { text-align:center; padding:48px 20px; color:var(--text-3); font-size:0.875rem; }
        .form-group { margin-bottom:16px; }
        label { display:block; font-size:0.8rem; font-weight:500; color:var(--text-2); margin-bottom:6px; }
        input[type="text"] { width:100%; padding:10px 14px; background:rgba(255,255,255,0.06); border:1px solid var(--border); border-radius:10px; color:var(--text-1); font-family:'Outfit',sans-serif; font-size:0.9rem; outline:none; transition:border-color .2s; }
        input[type="text"]:focus { border-color:var(--accent); }
        .btn { padding:10px 18px; border-radius:10px; font-size:0.875rem; font-weight:600; border:none; cursor:pointer; font-family:'Outfit',sans-serif; transition:opacity .2s,transform .15s; width:100%; }
        .btn:hover { opacity:0.85; transform:translateY(-1px); }
        .btn-primary { background:var(--accent); color:#0d0f14; }
        .btn-danger { background:rgba(239,68,68,0.15); color:var(--accent-4); border:1px solid rgba(239,68,68,0.25); padding:6px 12px; width:auto; font-size:0.75rem; }
        .alert { padding:12px 18px; border-radius:10px; font-size:0.875rem; margin-bottom:24px; }
        .alert-success { background:rgba(16,185,129,0.12); border:1px solid rgba(16,185,129,0.3); color:var(--accent-2); }
        .alert-error { background:rgba(239,68,68,0.12); border:1px solid rgba(239,68,68,0.3); color:var(--accent-4); }
        .card-body { padding:24px; }
        ::-webkit-scrollbar { width:6px; }
        ::-webkit-scrollbar-thumb { background:var(--border); border-radius:99px; }
    </style>
</head>
<body>
<aside class="sidebar">
    <div class="sidebar-logo"><div class="icon">☕</div><span>Order<b>nBrew</b></span></div>
    <div class="nav-label">Navigation</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link" id="nav-dashboard"><span class="nav-icon">📊</span> Dashboard</a>
    <a href="{{ route('admin.categories') }}" class="nav-link active" id="nav-categories"><span class="nav-icon">🏷️</span> Categories</a>
    <a href="{{ route('admin.menus') }}" class="nav-link" id="nav-menus"><span class="nav-icon">🍽️</span> Menu Items</a>
    <a href="{{ route('admin.reports') }}" class="nav-link" id="nav-reports"><span class="nav-icon">📈</span> Reports</a>
    <div style="flex:1"></div>
    <form method="POST" action="{{ route('logout') }}">@csrf
        <button type="submit" class="nav-link" style="width:100%;border:none;cursor:pointer;background:none;" id="btn-logout"><span class="nav-icon">🚪</span> Logout</button>
    </form>
</aside>
<main class="main">
    <div class="header">
        <div class="header-title"><h1>Categories</h1><p>Manage your menu categories.</p></div>
    </div>

    @if(session('success'))<div class="alert alert-success">✅ {{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-error">❌ {{ session('error') }}</div>@endif
    @if($errors->any())<div class="alert alert-error">❌ {{ $errors->first() }}</div>@endif

    <div class="grid-2">
        <!-- Category List -->
        <div class="card">
            <div class="card-header">
                <h2>All Categories</h2>
                <span class="badge badge-muted">{{ $categories->count() }} categories</span>
            </div>
            @if($categories->isEmpty())
                <div class="empty-state">🏷️ No categories yet. Add one to get started.</div>
            @else
            <table>
                <thead><tr><th>#</th><th>Name</th><th>Menu Items</th><th>Action</th></tr></thead>
                <tbody>
                    @foreach($categories as $i => $cat)
                    <tr>
                        <td style="color:var(--text-3)">{{ $i + 1 }}</td>
                        <td style="font-weight:500">{{ $cat->name }}</td>
                        <td><span class="badge badge-muted">{{ $cat->menus_count }}</span></td>
                        <td>
                            <form action="{{ route('admin.destroyCategory', $cat) }}" method="POST" onsubmit="return confirm('Delete {{ $cat->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger" id="btn-del-cat-{{ $cat->id }}">🗑 Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>

        <!-- Add Category -->
        <div class="card">
            <div class="card-header"><h2>➕ Add Category</h2></div>
            <div class="card-body">
                <form action="{{ route('admin.storeCategory') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="cat-name">Category Name</label>
                        <input type="text" id="cat-name" name="name" placeholder="e.g. Coffee, Snacks..." value="{{ old('name') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn-add-category">Add Category</button>
                </form>
            </div>
        </div>
    </div>
</main>
</body>
</html>
