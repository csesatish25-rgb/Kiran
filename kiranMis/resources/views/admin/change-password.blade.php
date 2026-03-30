@extends('layouts.admin')

@section('title', 'Change Password')
@section('eyebrow', 'Security')
@section('page_heading', 'Change administrator password')

@section('content')
    <section class="content-grid single-column">
        <article class="panel-surface form-panel">
            <div class="section-heading">
                <span class="eyebrow">Credential update</span>
                <h3>Replace the default admin password</h3>
                <p>
                    @if ($forceChange)
                        You must change the default password before you can continue to the admin home page.
                    @else
                        Keep your administrator credentials current to maintain secure access to the portal.
                    @endif
                </p>
            </div>

            <form method="POST" action="{{ route('admin.password.update') }}" class="form-stack">
                @csrf
                @method('PUT')

                <label class="field">
                    <span>Current password</span>
                    <input type="password" name="current_password" autocomplete="current-password" required>
                </label>

                <label class="field">
                    <span>New password</span>
                    <input type="password" name="password" autocomplete="new-password" required>
                </label>

                <label class="field">
                    <span>Confirm new password</span>
                    <input type="password" name="password_confirmation" autocomplete="new-password" required>
                </label>

                <div class="inline-note">
                    Choose a password with at least 8 characters so the seeded default credential is retired.
                </div>

                <div class="button-row">
                    <button type="submit" class="button button-primary">Save New Password</button>
                    <a href="{{ route('admin.home') }}" class="button button-secondary">Back to Home</a>
                </div>
            </form>
        </article>
    </section>
@endsection
