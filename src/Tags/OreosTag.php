<?php

namespace Takepart\Oreos\Tags;

use Exception;
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

    public function index(): bool
    {
        return $this->check();
    }

    public function check(): bool
    {
        $key = $this->params->get('key');

        if (! $this->manager->isGroupAvailable($key)) {
            throw new Exception('Oreo can not find a group `' . $key . '` in its configuration');
        }

        return $this->manager->isGroupConsent($key);
    }

    public function groups(): array
    {
        return $this->manager->getGroupsWithInfo()
            ->values()
            ->toArray();
    }

    public function form()
    {
        return view('oreos::form');
    }

    public function popup()
    {
        if (! $this->manager->isCookieSet()) {
            return view('oreos::popup');
        }
    }

}
