<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate; // Раскомментируйте, если будете использовать Gates для определения прав доступа
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy', // Здесь регистрируются политики доступа
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // $this->registerPolicies(); // Раскомментируйте, если определили $policies

        // Здесь можно определять "gates" (шлюзы) для более простых проверок прав доступа
        // Например:
        // Gate::define('edit-settings', function (User $user) {
        //     return $user->isAdmin();
        // });
    }
}
