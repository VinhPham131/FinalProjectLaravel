<?php
namespace App\Http\Middleware;

use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate as FilamentAuthenticate;
use Filament\Models\Contracts\FilamentUser;

class CustomAuthenticate extends FilamentAuthenticate
{
    /**
     * @param  array<string>  $guards
     */
    protected function authenticate($request, array $guards): void
    {
        $guard = Filament::auth();

        if (!$guard->check()) {
            $this->unauthenticated($request, $guards);

            return; /** @phpstan-ignore-line */
        }

        $this->auth->shouldUse(Filament::getAuthGuard());

        /** @var Model $user */
        $user = $guard->user();

        $panel = Filament::getCurrentPanel();

        // abort_if(
        //     $user instanceof FilamentUser ?
        //     (!$user->canAccessPanel($panel)) :
        //     (config('app.env') !== 'local'),
        //     403,
        // );
        if ($user instanceof FilamentUser) {
            if (!$user->canAccessPanel($panel)) {
                abort(response()->view('errors.no-permissions', [], 403));
            }
        } elseif (config('app.env') !== 'local') {
            abort(response()->view('errors.no-permissions', [], 403));
        }
    }

    protected function redirectTo($request): ?string
    {
        return Filament::getLoginUrl();
    }
}
