<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Login')</title>
    <link rel="stylesheet" href="{{ asset('css/admin-portal.css') }}">
</head>
<body class="portal-body auth-body">
    <div class="portal-background">
        <div class="portal-glow portal-glow-left"></div>
        <div class="portal-glow portal-glow-right"></div>
    </div>

    <main class="auth-page">
        <section class="auth-hero panel-surface">
            <span class="eyebrow">Secure Administration</span>
            <h1>Run the admin workspace with clarity and control.</h1>
            <p class="auth-copy">
                Welcome to the Kiran MIS admin portal. Sign in to manage the workspace, review system status,
                and update your default credentials before handing the panel over to daily operations.
            </p>

            <div class="feature-list">
                <article>
                    <h2>Professional access flow</h2>
                    <p>Purpose-built authentication, guided first-login security, and a polished dashboard shell.</p>
                </article>
                <article>
                    <h2>Operator-ready layout</h2>
                    <p>Clear hierarchy, quick actions, and responsive presentation for desktop and mobile devices.</p>
                </article>
                <article>
                    <h2>Default onboarding</h2>
                    <p>Start with the seeded admin account, then rotate the password from the dedicated change page.</p>
                </article>
            </div>
        </section>

        <section class="auth-card panel-surface">
            @if (session('status'))
                <div class="flash flash-success">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="flash flash-error">{{ $errors->first() }}</div>
            @endif

            @yield('content')
        </section>
    </main>
</body>
</html>
