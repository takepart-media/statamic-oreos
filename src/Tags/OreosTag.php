<?php

namespace Takepart\Oreos\Tags;

use Statamic\Tags\Tags;
use Takepart\Oreos\OreosManager;

class OreosTag extends Tags
{
    protected static $handle = 'oreos';

    protected OreosManager $manager;

    public function __construct()
    {
        $this->manager = new OreosManager;
    }

    public function index(): array
    {
        return $this->groups();
    }

    public function groups(): array
    {
        return $this->manager->getGroupsWithInfo()
            ->values()
            ->toArray();
    }

    public function form()
    {
        return view('statamic-oreos::form', [
            'showDescription' => $this->params->get('description') ?? true,
            'showAcceptall' => $this->params->get('acceptall') ?? true,
            'showCancel' => $this->params->get('cancel') ?? true,
            'showReset' => $this->params->get('reset') ?? false,
        ]);
    }

    public function popup()
    {
        if ($this->manager->isCookieSet()) {
            return;
        }

        return view('statamic-oreos::popup', [
            'showDescription' => $this->params->get('description') ?? true,
            'showAcceptall' => $this->params->get('acceptall') ?? true,
            'showCancel' => $this->params->get('cancel') ?? true,
            'showReset' => $this->params->get('reset') ?? false,
        ]);
    }

}
