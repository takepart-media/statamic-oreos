<?php

namespace Takepart\Oreos;

use Statamic\Providers\AddonServiceProvider;
use Takepart\Oreos\Tags\OreosTag;

class ServiceProvider extends AddonServiceProvider
{
    protected $tags = [
        OreosTag::class
    ];

    protected $routes = [
        'actions' => __DIR__ . '/../routes/actions.php',
    ];

    public function boot()
    {
        parent::boot();

        $this->bootAddonConfig();
    }

    protected function bootAddonConfig(): self
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/oreos.php', 'statamic.oreos');

        $this->publishes([
            __DIR__.'/../config/oreos.php' => config_path('statamic/oreos.php'),
        ], 'oreos-config');

        return $this;
    }
}
