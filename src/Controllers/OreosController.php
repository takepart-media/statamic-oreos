<?php

namespace Takepart\Oreos\Controllers;

use Illuminate\Http\Request;
use Statamic\Http\Controllers\Controller;
use Takepart\Oreos\OreosManager;

class OreosController extends Controller
{
    protected OreosManager $manager;

    public function __construct()
    {
        $this->manager = new OreosManager;
    }

    public function save(Request $request)
    {
        $action = $request->get('action');
        $oreos = $request->get('oreos') ?? [];

        if ($action === 'accept-all') {
            $oreos = $this->manager->getGroups()->keys()->toArray();
        }

        $required = $this->manager->getGroups()->filter(function($group) {
            return $group['required'];
        })->keys()->toArray();

        $oreos = array_merge($oreos, $required);

        foreach ($oreos as $oreo) {
            $this->manager->setGroupConsent($oreo);
        }

        $this->manager->saveConsents();

        return back();
    }

}
