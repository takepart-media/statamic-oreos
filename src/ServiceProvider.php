<?php

namespace Takepart\Oreos;

use Statamic\Facades\CP\Nav;
use Statamic\Facades\Permission;
use Statamic\Facades\User;
use Statamic\Providers\AddonServiceProvider;
use Takepart\Oreos\Tags\OreosTag;
use Takepart\Oreos\Tags\OreoTag;

class ServiceProvider extends AddonServiceProvider
{
    protected $tags = [
        OreosTag::class,
        OreoTag::class,
    ];

    protected $routes = [
        'actions' => __DIR__ . '/../routes/actions.php',
        'cp' => __DIR__ . '/../routes/cp.php',
    ];

    public function boot()
    {
        parent::boot();

        $this->bootAddonConfig()
             ->bootAddonViews()
             ->bootAddonPermissions()
             ->bootAddonNav();
    }

    protected function bootAddonConfig(): self
    {
        $this->publishes([
            __DIR__.'/../config/oreos.php' => config_path('oreos.php'),
        ], 'oreos-config');

        $this->mergeConfigFrom(__DIR__ . '/../config/oreos.php', 'oreos');

        return $this;
    }

    protected function bootAddonViews(): self
    {
        $this->publishes([
            __DIR__.'/../resources/views/form.antlers.php' => resource_path('views/vendor/statamic-oreos/form.antlers.php'),
            __DIR__.'/../resources/views/popup.antlers.html' => resource_path('views/vendor/statamic-oreos/popup.antlers.html'),
        ], 'oreos-views');

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
                    ->icon('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M487.8 255.6c-59.98-4.093-107.9-52.11-111.6-112.1c-.2591-4.202-3.51-7.453-7.713-7.712c-60.01-3.7-108-51.6-112-111.6c-.2692-4.042-3.323-7.276-7.356-7.653C245.3 16.18 241.4 16 237.5 16c-19.43 0-38.63 4.525-56 13.48L116.7 62.41c-23.32 11.95-42.31 30.94-54.26 54.26L29.6 181.2c-11.96 23.44-16.17 49.92-12.07 75.94l11.37 71.48c4.102 25.9 16.29 49.8 34.81 68.32l51.36 51.39c18.46 18.46 42.39 30.66 68.18 34.75l71.84 11.37C261.5 495.5 268 496 274.5 496c19.46 0 38.65-4.591 56.17-13.48l64.81-33.05c23.32-11.84 42.31-30.82 54.14-54.14l32.93-64.57c10.69-21.06 15.14-44.76 12.9-68.15C495.1 258.7 491.7 255.9 487.8 255.6zM468.3 323.5l-32.94 64.6c-10.23 20.15-26.96 36.88-47.14 47.13l-64.78 33.03c-15.14 7.685-32.07 11.75-48.96 11.75c-5.629 0-11.31-.4472-16.89-1.33L185.7 467.3c-22.6-3.58-43.14-14.06-59.39-30.32l-51.33-51.33c-16.24-16.24-26.72-36.82-30.32-59.52L33.33 254.7C29.74 231.9 33.38 209 43.86 188.5l32.79-64.52C87.14 103.5 103.5 87.14 123.9 76.67l64.89-32.97c14.86-7.656 31.69-11.7 48.66-11.7c1.232 0 2.471 .0195 3.709 .0625c7.371 62.36 57.39 112.1 119.7 119.1c7.02 62.24 56.73 112.3 119.1 119.8C480.5 289.1 476.5 307.3 468.3 323.5zM176 303.1c-17.62 0-32 14.37-32 31.1s14.38 31.1 32 31.1s32-14.37 32-31.1S193.6 303.1 176 303.1zM176 351.1c-8.822 0-16-7.178-16-15.1c0-8.822 7.178-15.1 16-15.1s15.1 7.177 15.1 15.1C192 344.8 184.8 351.1 176 351.1zM208 144c-17.62 0-32 14.37-32 31.1s14.38 31.1 32 31.1s32-14.37 32-31.1S225.6 144 208 144zM208 192c-8.822 0-16-7.178-16-15.1c0-8.822 7.178-15.1 16-15.1s16 7.177 16 15.1C224 184.8 216.8 192 208 192zM368 271.1c-17.62 0-32 14.37-32 31.1c0 17.62 14.38 31.1 32 31.1s32-14.37 32-31.1C400 286.4 385.6 271.1 368 271.1zM368 319.1c-8.822 0-16-7.178-16-15.1c0-8.822 7.178-15.1 16-15.1s16 7.177 16 15.1C384 312.8 376.8 319.1 368 319.1z"></path></svg>')
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
