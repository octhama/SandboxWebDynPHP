<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Throwable;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        // Autres middlewares Laravel...
        'restrict.employee' => \App\Http\Middleware\RestrictEmployeeAccess::class,
    ];
}

