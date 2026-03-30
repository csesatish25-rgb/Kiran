<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <script>
        (function () {
            try {
                var storedTheme = localStorage.getItem('admin-theme');
                document.documentElement.dataset.theme = storedTheme === 'dark' ? 'dark' : 'light';
            } catch (error) {
                document.documentElement.dataset.theme = 'light';
            }
        })();
    </script>
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
                <div class="topbar-heading">
                    <span class="eyebrow">@yield('eyebrow', 'Administration')</span>
                    <h2 class="topbar-title">@yield('page_heading', 'Admin Panel')</h2>
                </div>

                <nav class="topbar-nav" aria-label="Admin navigation">
                    <a href="{{ route('admin.home') }}" @class(['topbar-link', 'is-active' => request()->routeIs('admin.home')])>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.password.edit') }}" @class(['topbar-link', 'is-active' => request()->routeIs('admin.password.*')])>
                        Security
                    </a>
                </nav>

                <div class="topbar-actions">
                    <button type="button" class="theme-toggle button button-secondary" data-theme-toggle aria-label="Toggle color theme">
                        <span class="theme-toggle-icon" aria-hidden="true"></span>
                        <span class="theme-toggle-label">Dark mode</span>
                    </button>

                    <details class="profile-menu">
                        <summary class="profile-trigger">
                            <span class="profile-avatar" aria-hidden="true">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                            <span class="profile-meta">
                                <strong>{{ auth()->user()->name }}</strong>
                                <span>{{ auth()->user()->username }}</span>
                            </span>
                        </summary>

                        <div class="profile-dropdown panel-surface">
                            <div class="profile-dropdown-head">
                                <strong>{{ auth()->user()->name }}</strong>
                                <span>{{ auth()->user()->username }}</span>
                            </div>

                            <a href="{{ route('admin.password.edit') }}" class="profile-dropdown-link">
                                Change Password
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="profile-dropdown-button">Logout</button>
                            </form>
                        </div>
                    </details>
                </div>
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

    <script>
        (function () {
            var root = document.documentElement;
            var toggle = document.querySelector('[data-theme-toggle]');

            if (! toggle) {
                return;
            }

            var toggleLabel = toggle.querySelector('.theme-toggle-label');

            function applyTheme(theme) {
                root.dataset.theme = theme === 'dark' ? 'dark' : 'light';

                if (toggleLabel) {
                    toggleLabel.textContent = theme === 'dark' ? 'Light mode' : 'Dark mode';
                }
            }

            applyTheme(root.dataset.theme || 'light');

            toggle.addEventListener('click', function () {
                var nextTheme = root.dataset.theme === 'dark' ? 'light' : 'dark';

                applyTheme(nextTheme);

                try {
                    localStorage.setItem('admin-theme', nextTheme);
                } catch (error) {
                    // Ignore storage failures and keep the in-memory theme.
                }
            });
        })();
    </script>
</body>
</html>
