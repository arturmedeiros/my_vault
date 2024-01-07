<?php

namespace App\Providers;

use App\Models\Password;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\VaultType;
use App\Observers\PasswordUuidObserver;
use App\Observers\RoleUsersUuidObserver;
use App\Observers\RoleUuidObserver;
use App\Observers\UserUuidObserver;
use App\Observers\VaultTypeUuidObserver;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(UrlGenerator $url): void
    {
        Schema::defaultStringLength(255);

        // Força o uso do HTTPS nas requisições em Prod.
        if (getenv('APP_ENV') == "production") {
            $url->forceScheme('https');
            $this->app['request']->server->set('HTTPS', 'on');
        }

        // Ativa os Observers
        Password::observe(PasswordUuidObserver::class);
        Role::observe(RoleUuidObserver::class);
        RoleUser::observe(RoleUsersUuidObserver::class);
        User::observe(UserUuidObserver::class);
        VaultType::observe(VaultTypeUuidObserver::class);
    }
}
