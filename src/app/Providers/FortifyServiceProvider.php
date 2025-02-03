<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CreatesNewUsers::class, CreateNewUser::class);

        $this->app->singleton(\Laravel\Fortify\Contracts\UpdatesUserPasswords::class, UpdateUserPassword::class);
        $this->app->singleton(\Laravel\Fortify\Contracts\UpdatesUserProfileInformation::class, UpdateUserProfileInformation::class);
        $this->app->singleton(\Laravel\Fortify\Contracts\ResetsUserPasswords::class, ResetUserPassword::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::registerView(function () {
        return view('auth.register');
    });

    Fortify::loginView(function () {
        return view('auth.login');
    });

    RateLimiter::for('login', function (Request $request) {
        return Limit::perMinute(5)->by($request->email . '|' . $request->ip());
    });

    RateLimiter::for('two-factor', function (Request $request) {
        return Limit::perMinute(5)->by($request->session()->get('login.id'));
    });
    }
}
