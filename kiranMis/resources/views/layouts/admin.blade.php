<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="stylesheet" href="{{ asset('css/admin-portal.css') }}">
</head>
<body class="portal-body admin-body">
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <div>
                <div class="brand-mark">KM</div>
                <p class="sidebar-caption">Kiran MIS</p>
                <h1 class="sidebar-title">Admin Console</h1>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('admin.home') }}" @class(['nav-link', 'is-active' => request()->routeIs('admin.home')])>
                    Home Panel
                </a>
                <a href="{{ route('admin.password.edit') }}" @class(['nav-link', 'is-active' => request()->routeIs('admin.password.*')])>
                    Change Password
                </a>
            </nav>

            <div class="sidebar-footer panel-surface-soft">
                <p class="sidebar-label">Signed in as</p>
                <strong>{{ auth()->user()->name }}</strong>
                <span>{{ auth()->user()->username }}</span>
            </div>
        </aside>

        <div class="admin-main">
            <header class="topbar">
                <div>
                    <span class="eyebrow">@yield('eyebrow', 'Administration')</span>
                    <h2 class="topbar-title">@yield('page_heading', 'Admin Panel')</h2>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="button button-secondary">Sign Out</button>
                </form>
            </header>

            @if (session('status'))
                <div class="flash flash-success">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="flash flash-error">{{ $errors->first() }}</div>
            @endif

            <main class="content-shell">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
