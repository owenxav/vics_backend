<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response(ENV('APP_NAME') . ' is Ok', 200);
});
