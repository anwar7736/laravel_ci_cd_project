<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\DeployApplicationJob;

class DeployController extends Controller
{
    public function __invoke()
    {
        DeployApplicationJob::dispatch();

        return response()->json([
            'success' => true,
            'message' => 'Deployment queued.'
        ]);
    }
}