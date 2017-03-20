<?php

namespace App\Http\Controllers\Api;

use App\Zwforum\Traits\ApiHelpers;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;

class ApiController extends Controller
{
    use ApiHelpers;

    /**
     * ApiController constructor.
     *
     */
    public function __construct()
    {
        //parent::__construct();
        $this->initFractal();
    }

    /**
     * Initialize the fractal variable in the ApiHelpers.
     *
     */
    private function initFractal(){
        $this->fractal = new Manager;

        if (isset($_GET['include'])) {
            $this->fractal->parseIncludes($_GET['include']);
        }
    }

}
