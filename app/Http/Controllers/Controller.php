<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\ServerRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected ServerRequest $request;

    public function __construct()
    {
        $this->request = ServerRequest::fromGlobals();
    }
}
