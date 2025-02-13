<?php

namespace App\Http;

use App\Http\Middleware\RestrictEmployeeAccess;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Les middlewares de route de l'application.
     *
     * @var array
     */
    protected $routeMiddleware = [
        // Autres middlewares...
        'restrict.employee' => RestrictEmployeeAccess::class,
    ];
}

