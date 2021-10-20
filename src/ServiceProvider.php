<?php

namespace Takepart\Oreos;

use Statamic\Providers\AddonServiceProvider;
use Takepart\Oreos\Tags\OreoTag;

class ServiceProvider extends AddonServiceProvider
{
    protected $tags = [
        OreoTag::class
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
