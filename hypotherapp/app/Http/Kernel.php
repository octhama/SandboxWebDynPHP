<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Throwable;

class Kernel extends HttpKernel
{
    // app/Http/Kernel.php
    protected $routeMiddleware = [
        // Autres middlewares...
        'restrict.employee' => \App\Http\Middleware\RestrictEmployeeAccess::class,
    ];
}

