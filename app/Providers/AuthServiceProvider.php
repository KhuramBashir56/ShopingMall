<?php

namespace App\Providers;

use App\Gates\AdminGate;
use App\Gates\ManagerGate;
use App\Gates\UserGate;
use App\Models\Category;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
    ];

    public function boot(): void
    {
        Gate::define('admin', [AdminGate::class, 'verified_admin_role']);
        Gate::define('manager', [ManagerGate::class, 'verified_manager_role']);
        Gate::define('user', [UserGate::class, 'verified_user_role']);
    }
}