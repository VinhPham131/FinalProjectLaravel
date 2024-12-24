<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\StatefulGuard;
use Laravel\Fortify\Contracts\LogoutResponse;

class LogoutUserController extends Controller
{
    protected $guard;

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function destroy(Request $request): LogoutResponse
    {
        // Preserve the remembered email before logging out
        $rememberedEmail = session('remembered_email');

        $this->guard->logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        // Restore the remembered email from session before redirecting
        if ($rememberedEmail) {
            session(['remembered_email' => $rememberedEmail]);
        }

        return app(LogoutResponse::class);
    }
}
