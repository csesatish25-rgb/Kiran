<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('shows the admin login page at the root url', function () {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('Admin Login');
    $response->assertSee('admin / admin');
});

it('logs in with the default admin credentials and forces a password change', function () {
    $this->seed();

    $response = $this->post('/login', [
        'username' => 'admin',
        'password' => 'admin',
    ]);

    $response->assertRedirect(route('admin.password.edit'));
    $this->assertAuthenticated();
});

it('updates the default password and unlocks the admin home page', function () {
    $this->seed();

    $user = User::where('username', 'admin')->firstOrFail();

    $this->actingAs($user)
        ->put(route('admin.password.update'), [
            'current_password' => 'admin',
            'password' => 'SecureAdmin1',
            'password_confirmation' => 'SecureAdmin1',
        ])
        ->assertRedirect(route('admin.home'));

    $user->refresh();

    expect($user->must_change_password)->toBeFalse();
    expect(Hash::check('SecureAdmin1', $user->password))->toBeTrue();

    $this->actingAs($user)
        ->get(route('admin.home'))
        ->assertOk()
        ->assertSee('Operations overview');
});
