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
        // loop through request fields and save all values, if available

        return $request->session()->token();

        // return $request;
    }

}
