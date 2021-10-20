<?php

namespace Takepart\Oreos\Controllers;

use Illuminate\Support\Facades\Request;
use Takepart\Oreos\OreosManager;

class OreosController
{
    protected OreosManager $manager;

    public function __construct()
    {
        $this->manager = new OreosManager;
    }

    public function save(Request $request)
    {
        // loop through request fields and save all values, if available

        return $request;
    }

    public function saveAll(Request $request)
    {
        // get all and consent all, no matter the request

        return $request;
    }

}
