<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail() && $request->user()->role() === 'admin') {
            return redirect()->intended(RouteServiceProvider::ADMIN);
        }elseif ($request->user()->hasVerifiedEmail() && $request->user()->role() === 'user') {
            return redirect()->intended(RouteServiceProvider::USER);
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
