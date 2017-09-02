<?php

namespace App\Http\Routes;

use App\Http\Controllers\ExchangeController;
use League\Route\RouteCollection;

/**
 * Class Exchange
 * @package App\Http\Routes
 */
class Exchange
{
    /**
     * Map routes
     *
     * @param RouteCollection $route
     */
    public function map(RouteCollection $route)
    {
        $route->get('/exchange/{value}/{from}/{to}/{rate}', [ExchangeController::class, 'index']);
    }
}
