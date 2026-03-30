<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $highlights = [
            [
                'label' => 'Portal access',
                'value' => 'Active',
                'detail' => 'Your admin workspace is online and secured with session-based access.',
            ],
            [
                'label' => 'Password policy',
                'value' => $request->user()->must_change_password ? 'Pending' : 'Updated',
                'detail' => 'Keep credentials refreshed to protect operational access.',
            ],
            [
                'label' => 'Login identity',
                'value' => $request->user()->username,
                'detail' => 'Use your username for future sign-ins to the admin portal.',
            ],
        ];

        return view('admin.dashboard', [
            'highlights' => $highlights,
        ]);
    }
}
