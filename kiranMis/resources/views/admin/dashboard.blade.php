@extends('layouts.admin')

@section('title', 'Admin Home')
@section('eyebrow', 'Home Page')
@section('page_heading', 'Operations overview')

@section('content')
    <section class="hero-card panel-surface">
        <div>
            <span class="eyebrow">Welcome, {{ auth()->user()->name }}</span>
            <h3>Admin panel template ready for daily operations.</h3>
            <p>
                This home page is the post-login landing experience for the admin portal. It is designed to be a
                clean foundation for future modules such as reports, user management, approvals, and MIS summaries.
            </p>
        </div>

        <a href="{{ route('admin.password.edit') }}" class="button button-primary">Review Password Settings</a>
    </section>

    <section class="stats-grid">
        @foreach ($highlights as $highlight)
            <article class="metric-card panel-surface">
                <span class="metric-label">{{ $highlight['label'] }}</span>
                <strong class="metric-value">{{ $highlight['value'] }}</strong>
                <p>{{ $highlight['detail'] }}</p>
            </article>
        @endforeach
    </section>

    <section class="content-grid">
        <article class="panel-surface">
            <div class="section-heading">
                <span class="eyebrow">Quick actions</span>
                <h3>What you can do next</h3>
            </div>
            <div class="task-list">
                <div class="task-item">
                    <strong>Secure the default account</strong>
                    <p>Rotate the seeded password so the admin account is ready for production use.</p>
                </div>
                <div class="task-item">
                    <strong>Extend this dashboard</strong>
                    <p>Add modules for staff records, approvals, MIS reports, or operational widgets.</p>
                </div>
                <div class="task-item">
                    <strong>Verify environment services</strong>
                    <p>Confirm database sessions and queue-backed jobs are configured as expected.</p>
                </div>
            </div>
        </article>

        <article class="panel-surface accent-panel">
            <div class="section-heading">
                <span class="eyebrow">System note</span>
                <h3>Admin experience</h3>
            </div>
            <p>
                The login page is now the public welcome screen at the root URL. Authenticated users are redirected
                to this home page, and first-time administrators are guided through the password reset step first.
            </p>
            <div class="badge-row">
                <span class="status-badge">Responsive layout</span>
                <span class="status-badge">Session auth</span>
                <span class="status-badge">First-login protection</span>
            </div>
        </article>
    </section>
@endsection
