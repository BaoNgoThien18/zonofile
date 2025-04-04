<?php

use Illuminate\Support\Facades\Route;
function set_active($route)
{
    return Route::currentRouteName() == $route ? 'active' : '';
}