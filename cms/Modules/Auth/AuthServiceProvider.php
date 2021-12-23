<?php

namespace Cms\Modules\Auth;

use Cms\CmsServiceProvider;
use Cms\Modules\Auth\Middlewares\EnsureEmailIsVerified;
use Cms\Modules\Auth\Middlewares\RedirectIfAuthenticated;
use Illuminate\Routing\Router;
use Cms\Modules\Auth\Services\AuthUserService;
use Cms\Modules\Auth\Services\Contracts\AuthUserServiceContract;
use Cms\Modules\Auth\Repositories\AuthUserRepository;
use Cms\Modules\Auth\Repositories\Contracts\AuthUserRepositoryContract;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Middlewares\RoleOrPermissionMiddleware;

class AuthServiceProvider extends CmsServiceProvider
{

    protected $routeMiddleware = [
        'cms.authenticated' => RedirectIfAuthenticated::class,
        'cms.verified' => EnsureEmailIsVerified::class,
        'role' => RoleMiddleware::class,
        'permission' => PermissionMiddleware::class,
        'role_or_permission' => RoleOrPermissionMiddleware::class,
    ];

    public function boot(Router $router)
    {
        parent::boot($router);

        // Implicitly grant "admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });
    }

	public function register()
	{
		$this->app->bind(AuthUserServiceContract::class, AuthUserService::class );
		$this->app->bind(AuthUserRepositoryContract::class, AuthUserRepository::class );
	}
}
