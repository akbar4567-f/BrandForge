<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\KoleksiController;

Route::apiResource('koleksi', KoleksiController::class)
    ->names('api.koleksi');