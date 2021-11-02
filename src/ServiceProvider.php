<?php

namespace Takepart\Oreos;

use Statamic\Facades\CP\Nav;
use Statamic\Facades\Permission;
use Statamic\Facades\User;
use Statamic\Providers\AddonServiceProvider;
use Takepart\Oreos\Tags\OreosTag;

class ServiceProvider extends AddonServiceProvider
{
    protected $tags = [
        OreosTag::class
    ];

    protected $routes = [
        'actions' => __DIR__ . '/../routes/actions.php',
        'cp' => __DIR__ . '/../routes/cp.php',
    ];

    public function boot()
    {
        parent::boot();

        $this->bootAddonConfig()
             ->bootAddonPermissions()
             ->bootAddonNav();
    }

    protected function bootAddonConfig(): self
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/oreos.php', 'statamic.oreos');

        $this->publishes([
            __DIR__.'/../config/oreos.php' => config_path('statamic/oreos.php'),
        ], 'oreos-config');

        return $this;
    }

    protected function bootAddonPermissions()
    {
        $this->app->booted(function () {
            Permission::group('oreos', 'Oreos', function () {
                Permission::register('view oreos settings')->label(__('oreos::messages.permissions.view_settings'));
                Permission::register('edit oreos settings')->label(__('oreos::messages.permissions.edit_settings'));
            });
        });

        return $this;
    }

    protected function bootAddonNav()
    {
        Nav::extend(function ($nav) {
            if ($this->userHasOreosPermissions()) {
                $nav->tools('Oreos')
                    ->route('oreos.edit')
                    ->icon('crane')
                    ->active('oreos');
            }
        });

        return $this;
    }

    private function userHasOreosPermissions()
    {
        $user = User::current();

        return $user->can('view oreos settings')
            || $user->can('edit oreos settings');
    }
}
